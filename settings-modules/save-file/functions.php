<?
function list_tables() {
    mysql_select_db("save_files");
    $result = mysql_query("SHOW TABLES");

    $list = [];
    $row = mysql_fetch_row($result);
    while ($row != NULL) {
        array_push($list, $row[0]);
        $row = mysql_fetch_row($result);
    }
    return $list;
}

function new_save_file($save_file) {
    $result =  mysql_query("CREATE TABLE `save_files`.`".$save_file."` (REGNO INT(11), ENNAME VARCHAR(50), CHNAME VARCHAR(50), CLASSCODE CHAR(2), CLASSNO tinyint(4), SCHHOUSE CHAR(1), SEX CHAR(1), TIME TIMESTAMP DEFAULT 0);");
    if ($result) {
        mysql_query("INSERT INTO save_files.`$save_file` VALUES (0, 'TIME_PROPERTY', '', '', 0, '', '', CURRENT_TIMESTAMP)");
    }
    return set_save_file_table($save_file) && $result;
}
?>
