<?php
session_start();
require "../../libs/mysql-connect.php";
require "../../libs/config.php";
require "functions.php";

$save_file = get_save_file_table();
$time = $_POST["time"];

echo mysql_query("UPDATE save_files.`$save_file` SET TIME=\"$time\" WHERE REGNO=0");
?>