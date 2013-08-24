<?php
function get_all_table() {
    $string = "<table class='stats-table'>\n";

    $string .= "<tr><th>Total</th> <td>".get_student_number(ALL_CONDITION)."</td></tr>\n";
    $string .= "<tr><th>Present</th> <td>".get_student_number(PRESENT_CONDITION)."</td></tr>\n";
    $string .= "<tr><th>Late</th> <td>".get_student_number(LATE_CONDITION)."</td></tr>\n";
    $string .= "<tr><th>Absent</th> <td>".get_student_number(ABSENT_CONDITION)."</td></tr>\n";

    $string .="</table>\n";
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

function get_class_table() {
    $forms = list_field("FORM");
    $classes = list_field("CLASSCODE");

    $present = get_number_by_field("CLASSCODE", PRESENT_CONDITION);
    $late = get_number_by_field("CLASSCODE", LATE_CONDITION);
    $all = get_number_by_field("CLASSCODE", ALL_CONDITION);

    $classcode = [];
    foreach ($classes as $class) {
         if (array_search(substr($class, 1, 1), $classcode) === false) {
             array_push($classcode, substr($class, 1, 1));
         }
    }
    $string = "<table class='stats-table'>\n";

    $string .="<tr>\n";
    $string .="<td />\n";

    foreach ($forms as $row) {
        $string.= "<th>".$row."</th>\n";
    }
    $string .= "</tr>\n";

    foreach ($classcode as $class) {
        $string .="<tr>\n";
        $string .="<th>$class</th>\n";
        foreach ($forms as $form) {
            $cn = $form.$class;
            $string .= "<td>";
            if (array_search($cn, $classes) !== false) {
                $string .= $present[$cn]."+(".$late[$cn].")/".$all[$cn];
            }
            $string .= "</td>\n";
        }
        $string .="</tr>\n";
    }

    $string .= "</table>\n";
    $string .= "NOTE: notation used is as follows: <b>present + (late) / total</b>";
    return $string;
}
?>
