<?php
session_start();
require "../../libs/mysql-connect.php";
require "../../libs/config.php";
require "functions.php";

if ($_POST["new"]) {
    echo new_save_file($_POST["record"]);
} else {
    echo set_save_file_table($_POST["record"]);
}
?>
