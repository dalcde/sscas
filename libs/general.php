<?php
function admin_only() {
    if (!is_admin()) {
        header("location:index.php");
    }
}

function is_admin() {
    return $_SESSION["type"] == 0 && logged_in();
}

function logged_in() {
    return $_SESSION["loggedin"];
}
?>
