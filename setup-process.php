<?php
$HOSTNAME = "localhost";
$USERNAME = "root";
$PASSWORD = $_POST["mysql-pass"];

$conn = mysql_connect($HOSTNAME,$USERNAME,$PASSWORD);
if (!$conn) {
  echo "<script type='text/javascript'>
        alert('Incorrect MySQL password');
	window.location = 'setup.php';
        </script>";
}

if (strcmp($_POST["admin-pass"], $_POST["retype-pass"]) != 0) {
  echo "<script type='text/javascript'>
        alert('Passwords do not match');
	window.location = 'setup.php';
        </script>";
}

$password_hash = hash("sha256", $_POST["admin-pass"]);

$sscas_password = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,8); // Random string
$sscas_admin_password = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),0,8);

$file = fopen("etc/passwords", "w");
fwrite($file, $sscas_password);
fwrite($file, "\n");
fwrite($file, $sscas_admin_password);
fclose($file);

mysql_query("CREATE DATABASE sscas CHARACTER SET utf8 COLLATE utf8_bin");
mysql_query("CREATE DATABASE save_files CHARACTER SET utf8 COLLATE utf8_bin");
mysql_query("CREATE DATABASE student_records CHARACTER SET utf8 COLLATE utf8_bin");

mysql_query("CREATE TABLE sscas.logins(username VARCHAR(20),
                                       password_hash CHAR(65),
                                       type TINYINT)");
mysql_query("CREATE TABLE sscas.config(save_file_table VARCHAR(50))"); 

mysql_query("INSERT INTO sscas.logins VALUES ('admin', '$password_hash', 0)");
mysql_query("INSERT INTO sscas.config VALUES ('')");

mysql_query("CREATE USER 'sscas'@'localhost' IDENTIFIED BY '$sscas_password'");
mysql_query("CREATE USER 'sscas_admin'@'localhost' IDENTIFIED BY '$sscas_admin_password'");

mysql_query("GRANT SELECT on sscas.* TO 'sscas'@'localhost'");
mysql_query("GRANT SELECT,UPDATE on save_files.* TO 'sscas'@'localhost'");
mysql_query("GRANT SELECT on student_records.* TO 'sscas'@'localhost'");

mysql_query("GRANT SELECT,UPDATE,INSERT on sscas.* TO 'sscas_admin'@'localhost'");
mysql_query("GRANT SELECT,UPDATE,CREATE,DROP,INSERT on save_files.* TO 'sscas_admin'@'localhost'");
mysql_query("GRANT SELECT,UPDATE,CREATE,DROP,INSERT on student_records.* TO 'sscas_admin'@'localhost'");

header("location:login.php");
?>