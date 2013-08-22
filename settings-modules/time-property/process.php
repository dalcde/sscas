<?php
session_start();
require_once("../../libs/mysql-connect.php");
require_once("../../libs/config.php");
require_once("functions.php");

$save_file = get_save_file_table();
$time = $_POST["time"];

echo mysql_query("UPDATE save_files.`$save_file` SET TIME=\"$time\" WHERE REGNO=0");
?>