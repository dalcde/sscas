<?php
session_start();

require "../../libs/mysql-connect.php";
require "../../libs/config.php";
require "../../libs/general.php";
require "functions.php";

admin_only();

echo add_student_record_to_save_file($_POST["record"]);
?>
