<?php
if ($_POST["REGNO"] == NULL || $_POST["REGNO"] == 0) {
     return;
}

$path = "../etc/passwords";
require_once("../libs/mysql-connect.php");
require_once("../libs/config.php");

$TABLE=get_save_file_table();

$result = mysql_query("SELECT * FROM save_files.`".$TABLE."` WHERE REGNO=".$_POST["REGNO"]);
$array = mysql_fetch_array($result);

echo json_encode($array);
?>
