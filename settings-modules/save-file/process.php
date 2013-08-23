<?php
session_start();
require_once("../../libs/mysql-connect.php");
require_once("../../libs/config.php");
require_once("functions.php");

if ($_POST["new"]) {
    echo new_save_file($_POST["record"]);
} else {
    echo set_save_file_table($_POST["record"]);
}
?>
