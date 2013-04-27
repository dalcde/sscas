<?php
$TIME=$_POST["TIME"];
$REGNO=$_POST["REGNO"];

if ($REGNO == NULL || $REGNO == 0) {
  return;
}

require_once("../libs/mysql-connect.php");
require_once("../libs/config.php");

$TABLE=get_save_file_table();

echo mysql_query("UPDATE save_files.`$TABLE` SET TIME='$TIME' WHERE REGNO=$REGNO");
?>
