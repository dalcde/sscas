<?php
$TIME=$_POST["TIME"];
$REGNO=$_POST["REGNO"];

if ($REGNO == NULL || $REGNO == 0) {
    return;
}

require_once("../libs/mysql-connect.php");
require_once("../libs/config.php");

$TABLE=get_save_file_table();

$query = mysql_query("SELECT * FROM save_files.`".$TABLE."` WHERE REGNO=".$_POST["REGNO"]);
$array = mysql_fetch_array($query);

$log_line = "EDIT  ".$_SERVER["REMOTE_ADDR"]." ".$_POST["REGNO"]." ".$array["TIME"]."->$TIME";

$result =  mysql_query("UPDATE save_files.`$TABLE` SET TIME='$TIME' WHERE REGNO=$REGNO");
if ($result) {
    $log_file = fopen("../log/$TABLE.log", "a");
    if ($log_file) {
        fwrite($log_file, $log_line."\n");
    }
}

echo $result;
?>
