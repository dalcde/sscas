<?php

$HOSTNAME="localhost";
$USERNAME="sscas";
$PASSWORD="sscas";

if ($_SESSION["loggedin"] && $_SESSION["type"] == 0) {
  $USERNAME="sscas_admin";
  $PASSWORD="sscas_admin";
}

$connection = mysql_connect($HOSTNAME,$USERNAME,$PASSWORD);
if (!$connection) {
  header("location:setup.php");
}
mysql_set_charset('utf8');
?>