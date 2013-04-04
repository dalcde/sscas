// -*- php-indent-level: 4; indent-tabs-mode: nil -*-
<?php
session_start();
require "libs/mysql-connect.php";

$DATABASE="sscas";
$TABLE="logins";

mysql_select_db($DATABASE);
$username = $_POST['username'];
$password = $_POST['password'];

// Protect username from SQL injection
$username = stripslashes($username);
$username = mysql_real_escape_string($username);

$password = hash("sha256", $password);
$query = "SELECT type FROM $TABLE WHERE username=\"$username\" and password_hash=\"$password\"";
$result = mysql_query($query);
$count = mysql_num_rows($result);

$account_type = mysql_fetch_array($result)[0];

if ($count == 1) {
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['type'] = $account_type;
    $_SESSION['username'] = $username;
    $_SESSION['password_hash'] = $password;

  if ($_GET["redirect"]&& $_GET["redirect"] != "logout") {
    header("location:index.php?p=".$_GET["redirect"]);
  } else {
    header("location:index.php");
  }
} else {
  header("location:index.php?p=login&fail=true");
}
?>