<?php
function get_date() {
    $save_file = get_save_file_table();
    $result = mysql_query("SELECT TIME FROM save_files.`$save_file` WHERE REGNO=0");
    $result = mysql_fetch_row($result);
    return explode(" ", $result[0])[0];
}

function get_time() {
    $save_file = get_save_file_table();
    $result = mysql_query("SELECT TIME FROM save_files.`$save_file` WHERE REGNO=0");
    $result = mysql_fetch_row($result);
    return explode(" ", $result[0])[1];
}
?>