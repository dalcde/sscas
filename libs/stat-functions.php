<?php
define("ALL_CONDITION", "REGNO!=0");
define("ABSENT_CONDITION", "REGNO!=0 && TIME=0");
define("PRESENT_CONDITION", "REGNO!=0 && TIME>'_TIME'");
define("LATE_CONDITION", "REGNO!=0 && TIME != 0 && TIME<'_TIME'");

function get_time_boundary() {
  return mysql_fetch_row(mysql_query("SELECT TIME FROM save_files.`".get_save_file_table()."` WHERE REGNO=0"))[0];
}

function get_student_number($condition) {
  $condition = str_replace("_TIME", get_time_boundary(), $condition);
  return mysql_fetch_row(mysql_query("SELECT COUNT(IF(".$condition.", 1, NULL)) FROM save_files.`".get_save_file_table()."`"))[0];
}

function count_field($field) {
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

function get_forms() {
 $classes = count_field("CLASSCODE");

 $forms = [];
 foreach ($classes as $class) {
  $string = substr($class, 0, 1);
  if (!in_array($string, $forms)) {
   array_push($forms, $string);
  }
 }
 return $forms;
}

function get_number_by_form($condition) {
 $array = get_number_by_field("CLASSCODE", $condition);

 $forms = get_forms();
 $results = [];

 foreach ($forms as $form) {
  $results[$form] = 0;
 }

 foreach ($array as $class => $number) {
  $form = substr($class, 0, 1);
  $results[$form] = $results[$form] + $number;
 }

 return $results;
}
?>