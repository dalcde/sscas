<?php
function get_all_table() {
    $string = "";

    $string .= "Total: ".get_student_number(ALL_CONDITION)."<br />\n";
    $string .= "Present: ".get_student_number(PRESENT_CONDITION)."<br />\n";
    $string .= "Late: ".get_student_number(LATE_CONDITION)."<br />\n";
    $string .= "Absent: ".get_student_number(ABSENT_CONDITION)."<br />\n";

    return $string;
}

function get_field_table($field, $name) {
    $string = "<table class='stats-table'>\n";

    $string .= "<tr>\n<th>$name</th>\n";

    $field_insts = list_field($field);
    foreach ($field_insts as $row) {
        $string.= "<th>".$row."</th>\n";
    }
    $string .= "</tr>\n";

    $string .= "<tr>\n<th>Present</th>\n";
    $present = get_number_by_field($field, PRESENT_CONDITION);
    foreach ($field_insts as $field_inst) {
        $string .= "<td>".$present[$field_inst]."</td>\n";
    }
    $string .= "</tr>\n";

    $string .= "<tr>\n<th>Absent</th>\n";
    $absent = get_number_by_field($field, ABSENT_CONDITION);
    foreach ($field_insts as $field_inst) {
        $string .= "<td>".$absent[$field_inst]."</td>\n";
    }
    $string .= "</tr>\n";

    $string .= "<tr>\n<th>Late</th>\n";
    $late = get_number_by_field($field, LATE_CONDITION);
    foreach ($field_insts as $field_inst) {
        $string .= "<td>".$late[$field_inst]."</td>\n";
    }
    $string .= "</tr>\n";
    
    $string .= "<tr>\n<th>All</th>\n";
    $all = get_number_by_field($field, ALL_CONDITION);
    foreach ($field_insts as $field_inst) {
        $string .= "<td>".$all[$field_inst]."</td>\n";
    }
    $string .= "</tr>\n</table>\n";
    return $string;
}

?>
