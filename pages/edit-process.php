<?php
session_start();

$path = "../etc/passwords";
require_once("../libs/mysql-connect.php");
require_once("../libs/config.php");
require_once("../libs/general.php");
require_once("../libs/input.php");

admin_only();

$TIME=$_POST["TIME"];
$REGNO=$_POST["REGNO"];

if ($REGNO == NULL || $REGNO == 0) {
    return;
}

echo edit_entry($REGNO, $TIME);
?>
