<?php
session_start();

if ($_POST["REGNO"] == NULL || $_POST["REGNO"] == 0) {
    return;
}

$path = "../etc/passwords";
require_once("../libs/general.php");
require_once("../libs/mysql-connect.php");
require_once("../libs/config.php");
require_once("../libs/input.php");

echo input_entry($_POST["REGNO"], $_POST["FORCE"]);
?>
