<?php
session_start();

$path = "../../etc/passwords";
require_once("../../libs/mysql-connect.php");
require_once("../../libs/config.php");
require_once("../../libs/general.php");
require_once("functions.php");

admin_only();

$username = $_POST["username"];
$username = stripslashes($username);
$username = mysql_real_escape_string($username);

$admin_pass = $_POST["admin_pass"];
$admin_pass = hash("sha256", $admin_pass);

$new_pass = $_POST["new_pass"];
$re_pass = $_POST["re_pass"];

if ($admin_pass != $_SESSION["password_hash"]) {
    echo 1;
} else if ($new_pass != $re_pass) {
    echo 2;
} else {
    $password = hash("sha256", $new_pass);
    if (mysql_num_rows(mysql_query("SELECT * FROM sscas.logins WHERE username=\"$username\"")) == 0) {
	mysql_query("INSERT INTO sscas.logins VALUES (\"$username\", \"$password\", 1)");
    } else {
	mysql_query("UPDATE sscas.logins SET password_hash=\"$password\" WHERE username=\"$username\"");
    }
}
?>
