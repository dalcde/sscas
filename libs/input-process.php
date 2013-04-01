<?php
if ($_POST["REGNO"] == NULL) {
  return;
}

require "config.php";
// Input-process is called by jQuery/AJAX. Separate connection is needed
require "mysql-connect.php";

$TABLE=get_save_file_table();

$result = mysql_query("SELECT * FROM save_files.`$TABLE` WHERE REGNO=".$_POST["REGNO"]);
$array = mysql_fetch_array($result);

if ($array && $_POST["REGNO"] != 0) { # REGNO=0 corresponds to time property
   $TABLE=get_save_file_table();

   # Check if student is entered
   $result = mysql_query("SELECT * FROM save_files.`$TABLE` WHERE REGNO=".$_POST["REGNO"]);
   $result = mysql_fetch_array($result);
   if ($result["TIME"] != 0) {
      $array["duplicate"]=TRUE;
   } else {
      mysql_query("UPDATE save_files.`$TABLE` SET TIME=CURRENT_TIMESTAMP WHERE REGNO=".$_POST["REGNO"].";");
   }
}

echo json_encode($array);
?>
