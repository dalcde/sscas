<?php
session_start();
require_once("../libs/mysql-connect.php");
require_once("../libs/config.php");
require_once("../libs/general.php");

admin_only();

$REGNO = $_POST['id'];
$TIME = $_POST['value'];

$time_regex = "/[0-9]{4}-[0-1][0-9]*-[0-3][0-9] [0-2][0-9]:[0-6][0-9]:[0-6][0-9]/";

if ($TIME == "") {
    $TIME = "0000-00-00 00:00:00";
}
if (preg_match($time_regex, $TIME) !== 1) {
    echo "Incorrect time string";
} else if (strtotime($TIME) === FALSE){
    echo "Incorrect time string";
} else {
    $TABLE=get_save_file_table();

    $query = mysql_query("SELECT * FROM save_files.`".$TABLE."` WHERE REGNO=$REGNO");
    $array = mysql_fetch_array($query);

    $log_line = "EDIT  ".$_SERVER["REMOTE_ADDR"]." $REGNO ".$array["TIME"]."->$TIME";

    $result =  mysql_query("UPDATE save_files.`$TABLE` SET TIME='$TIME' WHERE REGNO=$REGNO");
    if ($result) {
        $log_file = fopen("../log/$TABLE.log", "a");
        if ($log_file) {
            fwrite($log_file, $log_line."\n");
        }
        echo $_POST['value'];
    } else {
        echo "Failed to update time";
    }
}
?>
