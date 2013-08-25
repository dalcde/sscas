<?php
function set_save_file_table($database) {
   return mysql_query("UPDATE sscas.config SET save_file_table = '$database'");
}

function get_save_file_table() {
   return mysql_fetch_array(mysql_query("SELECT save_file_table FROM sscas.config"))[0];
}

function set_student_record_table($database) {
   return mysql_query("UPDATE sscas.config SET student_record_table = '".$database."'");
}

function get_student_record_table() {
    return mysql_fetch_array(mysql_query("SELECT student_record_table FROM sscas.config"))[0];
}

function get_time_boundary() {
  return mysql_fetch_row(mysql_query("SELECT TIME FROM save_files.`".get_save_file_table()."` WHERE REGNO=0"))[0];
}
?>
