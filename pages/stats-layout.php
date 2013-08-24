<?php
function get_all_table() {
    $string = "";

    $string .= "Total: ".get_student_number(ALL_CONDITION)."<br />\n";
    $string .= "Present: ".get_student_number(PRESENT_CONDITION)."<br />\n";
    $string .= "Late: ".get_student_number(LATE_CONDITION)."<br />\n";
    $string .= "Absent: ".get_student_number(ABSENT_CONDITION)."<br />\n";

    return $string;
}

function get_form_table() {
    $string = "<table class='stats-table'>\n";

    $string .= "<tr>\n<th>Form</th>\n";

    $forms = get_forms();
    foreach ($forms as $row) {
        $string.= "<th>".$row."</th>\n";
    }
    $string .= "</tr>\n";

    $string .= "<tr>\n<th>Present</th>\n";
    $present = get_number_by_form(PRESENT_CONDITION);
    foreach ($forms as $form) {
        $string .= "<td>".$present[$form]."</td>\n";
    }
    $string .= "</tr>\n";

    $string .= "<tr>\n<th>Absent</th>\n";
    $absent = get_number_by_form(ABSENT_CONDITION);
    foreach ($forms as $form) {
        $string .= "<td>".$absent[$form]."</td>\n";
    }
    $string .= "</tr>\n";

    $string .= "<tr>\n<th>Late</th>\n";
    $late = get_number_by_form(LATE_CONDITION);
    foreach ($forms as $form) {
        $string .= "<td>".$late[$form]."</td>\n";
    }
    $string .= "</tr>\n";
    
    $string .= "<tr>\n<th>All</th>\n";
    $all = get_number_by_form(ALL_CONDITION);
    foreach ($forms as $form) {
        $string .= "<td>".$all[$form]."</td>\n";
    }
    $string .= "</tr>\n</table>\n";
    return $string;
}

function get_house_table() {
    $string = "<table class='stats-table'>\n";

    $string .= "<tr>\n<th>House</th>\n";

    $houses = count_field("SCHHOUSE");
    foreach ($houses as $row) {
        $string.= "<th>".$row."</th>\n";
    }
    $string .= "</tr>\n";

    $string .= "<tr>\n<th>Present</th>\n";
    $present = get_number_by_field("SCHHOUSE", PRESENT_CONDITION);
    foreach ($houses as $house) {
        $string .= "<td>".$present[$house]."</td>\n";
    }
    $string .= "</tr>\n";

    $string .= "<tr>\n<th>Absent</th>\n";
    $absent = get_number_by_field("SCHHOUSE", ABSENT_CONDITION);
    foreach ($houses as $house) {
        $string .= "<td>".$absent[$house]."</td>\n";
    }
    $string .= "</tr>\n";

    $string .= "<tr>\n<th>Late</th>\n";
    $late = get_number_by_field("SCHHOUSE", LATE_CONDITION);
    foreach ($houses as $house) {
        $string .= "<td>".$late[$house]."</td>\n";
    }
    $string .= "</tr>\n";
    
    $string .= "<tr>\n<th>All</th>\n";
    $all = get_number_by_field("SCHHOUSE", ALL_CONDITION);
    foreach ($houses as $house) {
        $string .= "<td>".$all[$house]."</td>\n";
    }
    $string .= "</tr>\n</table>\n";
    return $string;
}

?>
