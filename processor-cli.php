<?php
/*
Just to explain how it works it as short as possible - we can find 2 stages:
1 Json reading - its putting information about calsses and its object to a structure which is just a map of maps:) (key of the first map is a parent class name, and a key of the inner map is an object name, the value is a type name)
2 Code generation -
It started as an gnerator for android files only and I've added Swift later.
Becase of that the first phase is prepring data for andorid when actually the plan is to make it independed to chosen language.
*/
$json = file_get_contents($argv[2]);
$system = $argv[1]; //Android/Swift/ObjectiveC
$addSeriazedNames = FALSE;
$useGsonPrimitives = FALSE;
$detectDateMode = 0;
$toFile = TRUE;

//echo $json
set_error_handler(function() {
    die("Json processing error :(. I cannot tell you were exactly so please use third-party parser to check your json.");
});
//
//function myErrorHandler($errno, $errstr, $errfile, $errline) {
//    echo "<b>Custom error:</b> [$errno] $errstr<br>";
//    echo " Error on line $errline in $errfile<br>";
//}
//set_error_handler("myErrorHandler");

require 'engine.php';

$map = new DataStructure();
$map->setSystem($system);
$map->setSerializedNames($addSeriazedNames);

$json_array = json_decode($json, TRUE);

$depth = 0;
$stack = array();

require 'dateTest.php';

function getTypeName($val, $argument = null) {
    $type = gettype($val);
    global $detectDateMode;
    switch ($type) {
        case "string":
            if ($detectDateMode == 1 && isDate($val)) {
                return "Date";
            } else if ($detectDateMode == 2 && (bool) strtotime($val)) {
                return "Date";
            } else {
                return "String";
            }
        case "integer":
            return "int";
        case "double":
            return "float";
        case "boolean":
            return "boolean";
        case "array":
            if (is_numeric(key($val))) {
                return "RealmList<" . $argument . ">";
            } else {
                return $argument;
            }
    }
    return null;
}

class contentType {

    const NORMAL = 0;
    const PRIMITIVE_INT = 1;
    const PRIMITIVE_STRING = 2;

}

function browse($json_array) {
    global $useGsonPrimitives;
    global $depth;
    global $stack;
    global $map;
    $contentType = contentType::NORMAL;
    foreach ($json_array as $key => $val) {
        if (is_numeric($key)) { //===>is an item of an array ( within [...])
            if (is_array($val)) { //item in array is an {}object
                browse($val);
            } else { //item in array is a primitive
                if ($useGsonPrimitives && getTypeName($val) == "int") {
                    $contentType = contentType::PRIMITIVE_INT;
                    $map->add("RealmInt", 'val', "int", null,null);
                } elseif ($useGsonPrimitives && getTypeName($val) == "String") {
                    $contentType = contentType::PRIMITIVE_STRING;
                    $map->add("RealmString", 'val', "String", null,null);
                } else {
                    $map->add(end($stack), 'value', getTypeName($val), null,null);
                }
            }
        } else if (is_array($val)) { //===>is a new object ({} or [])
            $depth++;
            array_push($stack, $key);
            $innerType = browse($val);
            array_pop($stack);
            $depth--;
            if ($useGsonPrimitives && $innerType == contentType::PRIMITIVE_INT) {
                $map->add(end($stack), lcfirst($key), getTypeName($val, "RealmInt"), $key, "RealmInt");
            } else if ($useGsonPrimitives && $innerType == contentType::PRIMITIVE_STRING) {
                $map->add(end($stack), lcfirst($key), getTypeName($val, "RealmString"), $key, "RealmString");
            } else {
                $map->add(end($stack), lcfirst($key), getTypeName($val, ucfirst($key)), $key, ucfirst($key));
            }
        } else {
            if (getTypeName($val) != NULL) {
                $map->add(end($stack), lcfirst($key), getTypeName($val), $key, null);
            }
        }
    }
    return $contentType;
}

browse($json_array);

if ($toFile) {
    $uuid = uniqid("realm_model");
    $path = "./data/" . $uuid . "/";
    mkdir($path, 0777, true);
    $map->show(TRUE, $path);

    echo $path;
} else {
    $map->show();
}

function createZipFromDir($dir, $zip_file) {
    $zip = new ZipArchive;
    if (true !== $zip->open($zip_file, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE)) {
        return false;
    }
    zipDir($dir, $zip);
    return $zip;
}

function zipDir($dir, $zip, $relative_path = DIRECTORY_SEPARATOR) {
    if ($handle = opendir($dir)) {
        while (false !== ($file = readdir($handle))) {
            if ($file === '.' || $file === '..') {
                continue;
            }
            if (is_file($dir . $file)) {
                $zip->addFile($dir . $file, $file);
            } elseif (is_dir($dir . $file)) {
                zipDir($dir . $file, $zip, $relative_path . $file);
            }
        }
    }
    closedir($handle);
}
