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

   if ($array["TIME"] != 0 && !$_POST["FORCE"]) {
      $array["duplicate"]=TRUE;
   } else {
      mysql_query("UPDATE save_files.`".$TABLE."` SET TIME=CURRENT_TIMESTAMP WHERE REGNO=".$_POST["REGNO"].";");
      $array["TIME"] = date("Y-m-d h:i:s", time());
   }
}

echo json_encode($array);
?>
