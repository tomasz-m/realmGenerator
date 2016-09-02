<?php

class DataStructure {

    var $classes;
    var $systemName;
    var $addSerializedName = true;

    function setSystem($name) {
        $this->systemName = $name;
    }

    function setSerializedNames($test) {
        $this->addSerializedName = $test;
    }

    function add($className, $objectName, $type, $nameOryginal, $genericParam) {
        if ($className == null) {
            $className = "DataRoot";
        }
        $this->classes[ucfirst($className)][lcfirst($objectName)] = array("type" => $type, "orgName" => $nameOryginal,
            "param" => $genericParam);
    }

    function show($toFile = false, $folderName = null) {
        $isAndroid = FALSE;
        $isSwift = FALSE;
        $isObjectiveC = FALSE;
        if ($this->systemName == 'Android') {
            $this->showAndroid($toFile, $folderName);
        } else if ($this->systemName == 'Swift') {
            $this->showSwift($toFile, $folderName);
        } else if ($this->systemName == 'ObjectiveC') {
            $this->showObjectiveC($toFile, $folderName);
        } else if ($this->systemName == 'ReactNative') {
            $this->showReactNative($toFile, $folderName);
        }
    }

    ////////////ANDROID SHOWER
    function showAndroid($toFile, $folderName) {

        foreach ($this->classes as $x => $x_value) {
            $fileStrig = "";

            if ($toFile) {
                $usesDate = false;
                $usesList = false;
                foreach ($x_value as $key => $x_value_item) {
                    if ($x_value_item['type'] == "Date")
                        $usesDate = true;
                    else if (startsWith($x_value_item['type'], "RealmList<")) {
                        $usesList = true;
                    }
                }
                if ($this->addSerializedName == 'true') {
                    $fileStrig .= "import com.google.gson.annotations.SerializedName;\r\n";
                }
                if ($usesDate)
                    $fileStrig .= "import java.util.Date;\r\n";
                if ($usesList)
                    $fileStrig .= "import io.realm.RealmList;\r\n";
                $fileStrig .= "import io.realm.RealmObject;\r\n\r\n";
            }

            $fileStrig .= "public class " . $x . " extends RealmObject {\r\n";

            $fileStrig .= $this->getConstants($x_value);
            $fileStrig .= "\r\n";
            $fileStrig .= $this->getFields($x_value);
            $fileStrig .= "\r\n";

            $fileStrig .= "    public " . $x . "(){ }\r\n";
            $fileStrig .= "\r\n";

            $fileStrig .= $this->getGetterAndSetter($x_value);

            $fileStrig .= "}\r\n";
            $fileStrig .= "\r\n";

            if ($toFile) {
                $file = $folderName . $x . '.java';
                file_put_contents($file, $fileStrig);
            } else {
                echo $fileStrig;
            }
        }
    }

    function getFields($values) {
        $fileStrig = "";
        foreach ($values as $x => $x_value) {
            if ($this->addSerializedName == 'true') {
                $fileStrig .= '    @SerializedName("' . $x_value['orgName'] . '")' . "\r\n";
            }
            $fileStrig .= "    private " . $x_value['type'] . " " . $x . ";\r\n";
        }
        return $fileStrig;
    }

    function getGetterAndSetter($values) {
        $fileStrig = "";
        foreach ($values as $x => $x_value) {
            $fileStrig .= "    public void set" . ucfirst($x) . "(" . $x_value['type'] . " " . $x . "){\r\n";
            $fileStrig .= "        this." . $x . " = " . $x . ";\r\n    }\r\n";
            $fileStrig .= "    public " . $x_value['type'] . " get" . ucfirst($x) . "(){\r\n";
            $fileStrig .= "        return this." . $x . ";\r\n    }\r\n";
        }
        return $fileStrig;
    }

    function getConstants($values) {
        $fileStrig = "";
        foreach ($values as $x => $x_value) {
            $fileStrig .= "    public static final String " . camelToSnake($x) . ' = "' . $x . '";' . "\r\n";
        }
        return $fileStrig;
    }

    ////////////////
    ////////////SWIFT SHOWER
    function showSwift($toFile, $folderName) {
        foreach ($this->classes as $x => $x_value) {
            $fileStrig = "";
            $fileStrig .= "class " . $x . ": Object {\r\n";
            $fileStrig .= $this->getFieldsSwift($x_value);
            $fileStrig .= "}\r\n";
            $fileStrig .= "\r\n";

            if ($toFile) {
                $file = $folderName . $x . '.swift';
                file_put_contents($file, $fileStrig);
            } else {
                echo $fileStrig;
            }
        }
    }

    function getFieldsSwift($values) {
        $fileStrig = "";
        foreach ($values as $x => $x_value) {
            $type = $x_value['type'];
            $starting = "dynamic var";
            if (startsWith($x_value['type'], "RealmList<")) {

                $type = " = " . str_replace("RealmList<", "List<", $type) . "()";
                $starting = "let";
            } else {
                $type = $this->getSwiftType($x_value['type']);
            }
            $fileStrig .= "    " . $starting . " " . $x . $type . "\r\n";
        }
        return $fileStrig;
    }

    function getSwiftType($type, $argument = null) {
        switch ($type) {
            case "String":
                return " = \"\"";
            case "int":
                return " = 0";
            case "float":
                return " = 0.0";
            case "boolean":
                return " = true";
            case "Date":
                return " = NSDate(timeIntervalSince1970: 1)";
            case "array":
                if (is_numeric(key($val))) {
                    return "List<" . $argument . ">()";
                } else {
                    return $argument;
                }
            default : return ": " . $type . "?";
        }
        return null;
    }

    ////////////////
    ////////////OBJECIVE C SHOWER
    function showObjectiveC($toFile, $folderName) {
        $file_H_String = "";
        $file_M_String = "";
        foreach ($this->classes as $x => $x_value) {
            $file_H_String .= "@interface " . $x . ": RLMObject\r\n";
            $file_H_String .= $this->getFieldsObjectiveC($x_value);
            $file_H_String .= "@end\r\n";
            $file_H_String .= "RLM_ARRAY_TYPE(" . $x . ")\r\n\r\n";

            $file_M_String .= "@implementation " . $x . "\r\n";
            $file_M_String .= "@end\r\n\r\n";

            if (!$toFile) {
                echo $file_H_String;
                echo $file_M_String;
                $file_H_String = "";
                $file_M_String = "";
            }
        }
        if ($toFile) {
            $file = $folderName . 'RealmData.h';
            file_put_contents($file, '#import <Realm/Realm.h>'."\r\n\r\n".$file_H_String);
            $file = $folderName . 'RealmData.m';
            file_put_contents($file, '#import "RealmData.h"'."\r\n\r\n" . $file_M_String);
        }
    }

    function getFieldsObjectiveC($values) {
        $fileStrig = "";
        foreach ($values as $x => $x_value) {
            $type = $x_value['type'];
            $starting = "@property ";
            if (startsWith($type, "RealmList<")) {

                $param = $x_value['param'];
                $type = "RLMArray<" . $param . " *><" . $param . "> ";
            } else {
                $type = $this->getObjectiveType($x_value['type']);
            }
            $fileStrig .= $starting . $type . $x . ";\r\n";
        }
        return $fileStrig;
    }

    function getObjectiveType($type, $argument = null) {
        switch ($type) {
            case "String":
                return "NSString *";
            case "int":
                return "int ";
            case "float":
                return "float ";
            case "boolean":
                return "BOOL ";
            case "Date":
                return "NSDate *";
            case "array":
                if (is_numeric(key($val))) {
                    return "List<" . $argument . " *> <" . $argument . "> ";
                } else {
                    return $argument;
                }
            default : return $type . " *";
        }
        return null;
    }

    ////////////////
    ////////////REACTNATIVE SHOWER
    function showReactNative($toFile, $folderName) {
        $file_String = "";
        $class_list_String = "";
        foreach ($this->classes as $x => $x_value) {
            $file_String .= "class " . $x . " {}\r\n";
            $file_String .=  $x . ".schema = {\r\n";
            $file_String .= "  name: '" . $x . "',\r\n";
            $file_String .= $this->getFieldsReactNative($x_value);
            $file_String .= "};\r\n";
            
            $class_list_String.=$x . ", ";

            if (!$toFile) {
                echo $file_String;
                $file_String = "";
            }
        }
        $class_list_String = "let realm = new Realm({schema: [".rtrim($class_list_String, ", ")."]});";
        
        if ($toFile) {
            
            $file = $folderName . 'Model.js';
            file_put_contents($file, "import React, { Component } from 'react';
import { AppRegistry, Text } from 'react-native';"."\r\n\r\n".$file_String.$class_list_String);
        }else{
            echo $class_list_String;
        }
    }

    function getFieldsReactNative($values) {
        $fileStrig = "  properties: {\r\n";
        foreach ($values as $x => $x_value) {
            $type = $x_value['type'];
            $starting = "    ";
            if (startsWith($type, "RealmList<")) {

                $param = $x_value['param'];
                $type = "{type: 'list', objectType: '" . $param ."'}";
            } else {
                $type = $this->getReactNative($type);
            }
            $fileStrig .= $starting . $x ." ". $type .",\r\n";
        }
        return $fileStrig."  }\r\n";
    }

    function getReactNative($type, $argument = null) {
        switch ($type) {
            case "String":
                return "{type: 'string'}";
            case "int":
                return "{type: 'int'}";
            case "float":
                return "{type: 'float'}";
            case "boolean":
                return "{type: 'bool'}";
            case "Date":
                return "{type: 'date'}";
            case "array":
                if (is_numeric(key($val))) {
                    return "List<" . $argument . " *> <" . $argument . "> ";
                } else {
                    return $argument;
                }
            default : return "{type: '".$type . "'}";
        }
        return null;
    }

    ////////////////

}


    function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }

    function camelToSnake($camelCase) {
        return strtoupper(preg_replace('/([A-Z])/', '_$1', lcfirst($camelCase)));
    }

//function getJavaTypeName($type) {
//    switch ($type) {
//        case "string":
//            return "String";
//        case "integer":
//            return "int";
//        case "double":
//            return "float";
//        case "boolean":
//            return "boolean";          
//    }
//    return null;
//}

    