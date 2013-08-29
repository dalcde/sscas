<?php
session_start();
?>

<!DOCTYPE html>
<html>
  <head>
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
    <h3 style="text-align: center">Login to SSC Attendance System</h3>
    <div id="login-div">
      <form id="login-form" method="post" action="check-login.php<?php if ($_GET["redirect"]) echo "?redirect=".$_GET["redirect"] ?>">
      <input type="text" name="username" id="username" placeholder="Username"/> <br />
      <input type="password" name="password" id="password" placeholder="Password"/><br />
      <input type="submit" value="Login" />
    </form>

    <?php
      if ($_GET["fail"]) {
      echo "Login failed";
      }
    ?>
  </div>
</body>
</html>
