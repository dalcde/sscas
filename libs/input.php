<?php
function write_log($line) {
    $TABLE=get_save_file_table();
    $log_file = fopen("../log/$TABLE.log", "a");
    if ($log_file) {
        fwrite($log_file, $line."\n");
    }
}

function input_entry($regno, $force) {
    $TABLE=get_save_file_table();

    $result = mysql_query("SELECT * FROM save_files.`$TABLE` WHERE REGNO=$regno");
    $array = mysql_fetch_array($result);

    $date = date("Y-m-d H:i:s", time());
    $log_line = $date." INPUT ".$_SERVER["REMOTE_ADDR"]." $regno $date";

    if ($array) {
        if ($array["TIME"] != 0 && !$force) {
            $array["duplicate"]=TRUE;
            if (is_admin()) {
                $array["prompt"]=TRUE;
            } else {
                $array["prompt"]=FALSE;
            }
            $log_line = $log_line." DUPLICATE";
        } else {
            if ($force) {
                $log_line = $log_line." DUPLICATE OVERWRITE";
            }
            mysql_query("UPDATE save_files.`$TABLE` SET TIME=CURRENT_TIMESTAMP WHERE REGNO=$regno");
            $array["TIME"] = $date;
        }
    } else {
        $log_line = $log_line." NOT-FOUND";
    }
    
    write_log($log_line);

    return json_encode($array);
}

function edit_entry($regno, $new) {
    $TABLE=get_save_file_table();

    $query = mysql_query("SELECT * FROM save_files.`$TABLE` WHERE REGNO=$regno");
    $array = mysql_fetch_array($query);

    $log_line = date("Y-m-d H:i:s", time())." EDIT  ".$_SERVER["REMOTE_ADDR"]." $regno ".$array["TIME"]."-> $new";

    $result =  mysql_query("UPDATE save_files.`$TABLE` SET TIME='$new' WHERE REGNO=$regno");
    if ($result) {
        write_log($log_line);
    }

    return $result;
}
?>
