<?php
    function list_tables() {
    $result = mysql_query("SHOW TABLES FROM student_records");

    $list = [];
    $row = mysql_fetch_row($result);
    while ($row != NULL) {
        array_push($list, $row[0]);
        $row = mysql_fetch_row($result);
    }
    return $list;
}

function add_student_record_to_save_file($student_record) {
    $save_file = get_save_file_table();
    $list = mysql_query("SELECT * FROM `student_records`.`$student_record`;");

    $row = mysql_fetch_array($list);

    $duplicate = 0;
    while ($row != NULL) {
        $regno = $row["REGNO"];
        $check_result = mysql_query("SELECT * FROM `save_files`.`$save_file` WHERE REGNO=$regno");
        if (mysql_num_rows($check_result) == 0 ) {
            mysql_query("INSERT `save_files`.`$save_file` (REGNO, ENNAME, CHNAME, CLASSCODE, CLASSNO, SCHHOUSE, SEX) SELECT * from `student_records`.`$student_record` WHERE REGNO=$regno;");
        } else {
            $duplicate ++;
        }
        $row = mysql_fetch_array($list);
    }
    return $duplicate;
#}

#    return mysql_query("INSERT `save_files`.`$save_file` (REGNO, ENNAME, CHNAME, CLASSCODE, CLASSNO, SCHHOUSE, SEX) SELECT * from `student_records`.`$student_record`;");
}

function new_save_file($save_file) {
    $result =  mysql_query("CREATE TABLE `save_files`.`".$save_file."` (REGNO INT(11), ENNAME VARCHAR(50), CHNAME VARCHAR(50), CLASSCODE CHAR(2), CLASSNO tinyint(4), SCHHOUSE CHAR(1), SEX CHAR(1), TIME TIMESTAMP DEFAULT 0);");
    return set_save_file_table($_POST["record"]) && $result;
}
?>
