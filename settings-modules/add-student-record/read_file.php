<?php
session_start();
require_once("../../libs/mysql-connect.php");
require_once("../../libs/config.php");
require_once("functions.php");

function utf8_fopen_read($fileName) {
    $fc = iconv('UTF-16', 'UTF-8', file_get_contents($fileName));
    $handle=fopen("php://memory", "rw");
    fwrite($handle, $fc);
    fseek($handle, 0);
    return $handle;
} 

if ($_FILES["file"]["error"] > 0) {
    echo 0;
} else {
    $file = utf8_fopen_read($_FILES["file"]["tmp_name"], "r");
    $lines = [trim(fgets($file))]; # Add first line (entry order) first so that it doesn't get quoted
    while (!feof($file)) {
        $line = fgetcsv($file);
        for ($i = 0; $i < count($line); $i++) {
            if (!is_numeric($line[$i])) {
               $line[$i] = "\"".$line[$i]."\"";
            }
        }
        array_push($lines, implode(",", $line));
    }
    echo json_encode($lines);
}
?>