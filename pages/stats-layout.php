<?php
function get_all_table() {
    $string = "<table class='stats-table'>\n";

    $string .= "<tr>\n";
    $string .= "<th>Present</th>\n";
    $string .= "<th>Late</th>\n";
    $string .= "<th>Absent</th>\n";
    $string .= "<th>All</th>\n";
    $string .= "</tr>\n";

    $string .= "<tr>\n";
    $string .= "<td>".get_student_number(ALL_CONDITION)."</td>\n";
    $string .= "<td>".get_student_number(PRESENT_CONDITION)."</td>\n";
    $string .= "<td>".get_student_number(LATE_CONDITION)."</td>\n";
    $string .= "<td>".get_student_number(ABSENT_CONDITION)."</td>\n";
    $string .= "</tr>\n";

    $string .="</table>\n";
    return $string;
}

function get_field_table($field, $name) {
    $string = "<table class='stats-table'>\n";

    $string .= "<tr>\n";

    $field_insts = list_field($field);

    $string .= "<th>$name</th>\n";
    $string .= "<th>Present</th>\n";
    $string .= "<th>Late</th>\n";
    $string .= "<th>Absent</th>\n";
    $string .= "<th>All</th>\n";
    $string .= "</tr>\n";

    $present = get_number_by_field($field, PRESENT_CONDITION);
    $late = get_number_by_field($field, LATE_CONDITION);
    $absent = get_number_by_field($field, ABSENT_CONDITION);
    $all = get_number_by_field($field, ALL_CONDITION);

    foreach ($field_insts as $field_inst) {
        $string .= "<tr>";
        $string .= "<th>".$field_inst."</th>\n";
        $string .= "<td>".$present[$field_inst]."</td>\n";
        $string .= "<td>".$late[$field_inst]."</td>\n";
        $string .= "<td>".$absent[$field_inst]."</td>\n";
        $string .= "<td>".$all[$field_inst]."</td>\n";
        $string .= "</tr>\n";
    }

    $string .= "</table>\n";
    return $string;
}
