<?php
function list_users(){
    $result = mysql_query("SELECT * FROM sscas.logins");

    $list = [];
    $row = mysql_fetch_array($result);
    while ($row != NULL) {
	array_push($list, [$row["username"], $row["type"]]);
	$row = mysql_fetch_array($result);
    }
    return $list;
}
?>