<?php
$file = fopen("etc/passwords", "r");
$password = trim(fgets($file));
fclose($file);

$conn = mysql_connect("localhost","sscas",$password);
if ($conn && !isset($_GET["force"])) {
   header("location:login.php");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Setup SSCAS Attendance System</title>
    <script type="text/javascript" src="ext-libs/jquery.js"></script>
    <script type="text/javascript" src="ext-libs/jquery-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="page-style.css" />
    <link rel="stylesheet" type="text/css" href="ext-libs/bootstrap.css" />
    <meta charset="utf-8" />

    <script type="text/javascript">
    $(function() {
        $("input[type=submit], input[type=button]").button();
    });
    </script>
  </head>
  <body>
    <h1 style="text-align:center">Setup SSCAS Attendance System</h1>
    <div style="width: 210px; margin-left: auto; margin-right: auto">
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
