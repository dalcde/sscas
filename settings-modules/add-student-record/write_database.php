<?php
session_start();

$path = "../../etc/passwords";
require_once("../../libs/mysql-connect.php");
require_once("../../libs/config.php");
require_once("functions.php");

$data = json_decode($_POST["array"]);
$record = $_POST["record"];

$table_exists = FALSE !== mysql_query("SELECT * FROM student_records.`$record`");

if ($table_exists) {
    echo FALSE;
} else {
    mysql_query("CREATE TABLE student_records.`$record` (REGNO INT(11), ENNAME VARCHAR(50), CHNAME VARCHAR(50), CLASSCODE CHAR(2), CLASSNO tinyint(4), FORM CHAR(1), SCHHOUSE CHAR(1), SEX CHAR(1))");
    $values = "";
    for ($i = 1; $i < count($data); $i++) {
        $values = $values."(".$data[$i]."),";
    }
    mysql_query("INSERT INTO student_records.`$record` (".$data[0].") VALUES ".rtrim($values, ","));
    mysql_query("UPDATE student_records.`$record` SET `FORM` = `CLASSCODE`");
}
echo add_student_record_to_save_file($_POST["record"]);
?>
