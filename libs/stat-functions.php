<?php
define("ALL_CONDITION", "REGNO!=0");
define("ABSENT_CONDITION", "REGNO!=0 && TIME=0");
define("PRESENT_CONDITION", "REGNO!=0 && TIME>'_TIME'");
define("LATE_CONDITION", "REGNO!=0 && TIME != 0 && TIME<'_TIME'");

function get_student_number($condition) {
  $condition = str_replace("_TIME", get_time_boundary(), $condition);
  return mysql_fetch_row(mysql_query("SELECT COUNT(IF(".$condition.", 1, NULL)) FROM save_files.`".get_save_file_table()."`"))[0];
}

function list_field($field) {
 $query = mysql_query("SELECT DISTINCT $field FROM save_files.`".get_save_file_table()."`");

 $field = array();
 $row = mysql_fetch_row($query); # First row is empty
 $row = mysql_fetch_row($query);

 while ($row) {
   array_push($field, $row[0]);
   $row = mysql_fetch_row($query);
 }

 return $field;
}

function get_number_by_field($field, $condition) {
 $condition = str_replace("_TIME", get_time_boundary(), $condition);

 $query = mysql_query("SELECT $field, COUNT(IF($condition, 1, NULL)) FROM save_files.`".get_save_file_table()."` GROUP BY $field");

 $entries = array();
 $row = mysql_fetch_row($query); # First row is empty
 $row = mysql_fetch_row($query);

 while ($row) {
   $entries[$row[0]] = $row[1];
   $row = mysql_fetch_row($query);
 }

 return $entries;
}

?>
