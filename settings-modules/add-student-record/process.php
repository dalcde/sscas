<?php
session_start();

require_once("../../libs/mysql-connect.php");
require_once("../../libs/config.php");
require_once("../../libs/general.php");
require_once("functions.php");

admin_only();

echo add_student_record_to_save_file($_POST["record"]);
?>
