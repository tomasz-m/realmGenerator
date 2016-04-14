<?php

$files = glob('./data/*');
$now = time();

foreach ($files as $file) {
    if (is_file($file)) {
        if ($now - filemtime($file) >= 12*60*60) { // 12 hrs
            unlink($file);
        }
    } else if (is_dir($file)) {
        if ($now - filemtime($file) >= 12*60*60) { // 12 hrs
            deleteDir($file);
        }
    }
}

function deleteDir($path) {
    if (empty($path)) {
        return false;
    }
    
    return is_file($path) ?
            @unlink($path) :
            array_map(__FUNCTION__, glob($path . '/*')) == @rmdir($path);
    
}

?>