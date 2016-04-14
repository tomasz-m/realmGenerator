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

    function add($className, $objectName, $type, $nameOryginal) {
        if ($className == null) {
            $className = "DataRoot";
        }
        $this->classes[ucfirst($className)][lcfirst($objectName)] = array("type"=>$type, "orgName"=>$nameOryginal);
    }

    function show($toFile = false, $folderName = null) {
        $isAndroid = FALSE;
        $isSwift = FALSE;
        $isObjectiveC = FALSE;
        if ($this->systemName == 'Android') {
            $isAndroid = TRUE;
        } else if ($this->systemName == 'Swift') {
            $isSwift = TRUE;
        } else if ($this->systemName == 'ObjectiveC') {
            $isObjectiveC = TRUE;
        }

        foreach ($this->classes as $x => $x_value) {
            $fileStrig = "";

            if ($isAndroid) {
                if ($toFile) {
                    $usesDate = false;
                    $usesList = false;
                    foreach ($x_value as $key => $x_value_item) {
                        if ($x_value_item['type'] == "Date")
                            $usesDate = true;
                        else if ($this->startsWith($x_value_item['type'], "RealmList<")) {
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
            } else if ($isSwift) {
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

    function startsWith($haystack, $needle) {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
    }

    function getFieldsSwift($values) {
        $fileStrig = "";
        foreach ($values as $x => $x_value) {
            $type = $x_value;
            $starting = "dynamic var";
            if ($this->startsWith($x_value['type'], "RealmList<")) {

                $type = " " . str_replace("RealmList<", "List<", $type) . "()";
                $starting = "let";
            } else {
                $type = getSwiftType($x_value['type']);
            }
            $fileStrig .= "    " . $starting . " " . $x . $type . "\r\n";
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
            $fileStrig .= "    public static final String " . $this->camelToSnake($x) . ' = "' . $x . '";' . "\r\n";
        }
        return $fileStrig;
    }

    function camelToSnake($camelCase) {
        return strtoupper(preg_replace('/([A-Z])/', '_$1', lcfirst($camelCase)));
    }

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
