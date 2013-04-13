<?php
$conn = mysql_connect("localhost", "sscas", "sscas");
if ($conn && ! $_GET("force")) {
   header("location:login.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Setup SSCAS Attendance System</title>
    <link rel="stylesheet" type="text/css" href="page-style.css" />
  </head>
  <body>
    <h1 style="text-align:center">Setup SSCAS Attendance System</h1>
    <div style="width: 222px; margin-left: auto; margin-right: auto">
    <form action="setup-process.php" method="post">
      Enter MySQL root password:<br />
      <input type="password" name="mysql-pass"/><br />
      Enter admin password:<br />
      <input type="password" name="admin-pass" /><br />
      Re-type admin password:<br />
      <input type="password" name="retype-pass" /><br />
      <input type="submit" value="Setup">
    </form>
    </div>
  </body>
</html>
