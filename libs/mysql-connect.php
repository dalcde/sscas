<?php
if (!$path) {
  $path = "etc/passwords";
}
$file = fopen($path, "r");
$sscas_password = trim(fgets($file));
$sscas_admin_password = trim(fgets($file));
fclose($file);

$HOSTNAME="localhost";
$USERNAME="sscas";
$PASSWORD=$sscas_password;

if ($_SESSION["loggedin"] && $_SESSION["type"] == 0) {
  $USERNAME="sscas_admin";
  $PASSWORD=$sscas_admin_password;
}

$connection = mysql_connect($HOSTNAME,$USERNAME,$PASSWORD);
if (!$connection) {
  header("location:setup.php");
  exit();
}
mysql_set_charset('utf8');
?>