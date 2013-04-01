<?php
admin_only();

$module = $_GET["mod"];
if (!$module) {
    $module = "homepage";
}
include "settings-modules/$module/page.php";
?>

