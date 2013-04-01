<?php
if ($_POST["REGNO"] == NULL || $_POST["REGNO"] == 0) {
  return;
}

require_once("../libs/mysql-connect.php");
require_once("../libs/config.php");

$TABLE=get_save_file_table();

$result = mysql_query("SELECT * FROM save_files.`".$TABLE."` WHERE REGNO=".$_POST["REGNO"]);
$array = mysql_fetch_array($result);

if ($array) {
   $TABLE=get_save_file_table();

   # Check if student is entered
   $result = mysql_query("SELECT * FROM save_files.`".$TABLE."` WHERE REGNO=".$_POST["REGNO"]);
   $result = mysql_fetch_array($result);
   if ($result["TIME"] != 0) {
      $array["duplicate"]=TRUE;
   } else {
      mysql_query("UPDATE save_files.`".$TABLE."` SET TIME=CURRENT_TIMESTAMP WHERE REGNO=".$_POST["REGNO"].";");
   }
}

echo json_encode($array);
?>
