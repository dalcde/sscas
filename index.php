<?php
session_start();

require_once("libs/mysql-connect.php");
require_once("libs/general.php");
require_once("libs/config.php");
?>
<!DOCTYPE html>
<html>
  <head>
    <script type="text/javascript" src="ext-libs/jquery.js"></script>
    <script type="text/javascript" src="ext-libs/jquery-ui.js"></script>
    <script type="text/javascript" src="ext-libs/jquery-timeentry.js"></script>
    <link rel="stylesheet" type="text/css" href="page-style.css" />
    <link rel="stylesheet" type="text/css" href="ext-libs/aristo.css" />
    <meta charset="utf-8" />

    <script type="text/javascript">
    $(function() {
        $("input[type=submit], input[type=button]").button();
    });
    </script>
  </head>
  <body>
    <?php if (logged_in()) {
      echo '<div id="navigation-bar">';
      require 'navigation-bar.php';
      echo '</div>';
    }
    ?>
    <div id="content-area">
      <?php
        $page = $_GET["p"];
        if (!$page) {
          $page = "home";
        }
        include "pages/$page.php";
      ?>
    </div>
    <div id="loader"><div id="loader-gif">&nbsp</div></div>
    <!-- Hide loader -->
    <script type="text/javascript">
      $("#loader").hide();
      $("#loader").addClass("loader");
      $("#loader-gif").addClass("loader-gif");
    </script>
  </body>
</html>

<?php
# Redirect to login page if not logged in
if (!logged_in() && $page != "login" && $page != "check-login") {
  header("location:login.php?redirect=$page");
}
?>
