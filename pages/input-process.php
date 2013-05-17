<?php
session_start();

if ($_POST["REGNO"] == NULL || $_POST["REGNO"] == 0) {
  return;
}

require_once("../libs/general.php");
require_once("../libs/mysql-connect.php");
require_once("../libs/config.php");

$TABLE=get_save_file_table();

$result = mysql_query("SELECT * FROM save_files.`".$TABLE."` WHERE REGNO=".$_POST["REGNO"]);
$array = mysql_fetch_array($result);

$log_line = $_SERVER["REMOTE_ADDR"]." ".date("Y-m-d h:i:s", time())." ".$_POST["REGNO"]." ";

if ($array) {
  $TABLE=get_save_file_table();

  if ($array["TIME"] != 0 && !$_POST["FORCE"]) {
    $array["duplicate"]=TRUE;
    if (is_admin()) {
      $array["prompt"]=TRUE;
    } else {
      $array["prompt"]=FALSE;
    }
    $log_line = $log_line."DUPLICATE";
  } else {
    if ($_POST["FORCE"]) {
      $log_line = $log_line."DUPLICATE OVERWRITE";
    }
    mysql_query("UPDATE save_files.`".$TABLE."` SET TIME=CURRENT_TIMESTAMP WHERE REGNO=".$_POST["REGNO"].";");
    $array["TIME"] = date("Y-m-d h:i:s", time());
  }
} else {
  $log_line = $log_line."NOT FOUND";
}

$log_file = fopen("../log/$TABLE.log", "a");
if ($log_file) {
  fwrite($log_file, $log_line."\n");
}

echo json_encode($array);
?>
