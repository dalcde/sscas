<?php
session_start();

$path = "../etc/passwords";
require_once("../libs/mysql-connect.php");
require_once("../libs/config.php");
require_once("../libs/general.php");
require_once("../libs/input.php");

admin_only();

$REGNO = $_POST['id'];
$TIME = $_POST['value'];

$time_regex = "/[0-9]{4}-[0-1][0-9]*-[0-3][0-9] [0-2][0-9]:[0-6][0-9]:[0-6][0-9]/";

if ($TIME == "") {
    $TIME = "0000-00-00 00:00:00";
}
if (preg_match($time_regex, $TIME) !== 1) {
    echo "Incorrect time string";
} else if (strtotime($TIME) === FALSE && $TIME != "0000-00-00 00:00:00"){
    echo "Incorrect time string";
} else {
    $result = edit_entry($REGNO, $TIME);
    if ($result) {
        echo $_POST['value'];
    } else {
        echo "Failed to update time";
    }
}
?>
