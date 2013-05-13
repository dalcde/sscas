<?php
#                 HEADER, DATABASE_ENTRY, WIDTH
$PAGE_COLUMNS = [["Stud. ID", "REGNO", 20],
		 ["Class", "CLASSCODE", 13],
		 ["Class No", "CLASSNO", 20],
		 ["English Name", "ENNAME", 60],
		 ["Chinese Name", "CHNAME", 40],
		 ["House", "SCHHOUSE", 13],
		 ["Status", "STATUS", 20]];

$HOUSE_NAMES = ["B" => "Barnett",
		"C" => "College",
		"H" => "Hewitt",
		"M" => "Martin",
		"P" => "Priestley",
		"S" => "Stewert"];
		 
function sort_record($record) {
    usort($record, function($a, $b) {
	if ($a["CLASSCODE"] > $b["CLASSCODE"]) {
	    return 1;
	} else if ($a["CLASSCODE"] < $b["CLASSCODE"]) {
	    return -1;
	} else {
	    return ($a["CLASSNO"] > $b["CLASSNO"]) ? 1 : -1;
	}
    });
    return $record;
}

function generate_page($name, $records, $pdf) {
    global $PAGE_COLUMNS;

    usort($records, function($a, $b) {
	if ($a["CLASSCODE"] > $b["CLASSCODE"]) {
	    return 1;
	} else if ($a["CLASSCODE"] < $b["CLASSCODE"]) {
	    return -1;
	} else {
	    return ($a["CLASSNO"] > $b["CLASSNO"]) ? 1 : -1;
	}
    });

    $pdf->AddPage();
    $pdf->SetFont("","B",16);
    $pdf->Cell(40,8,$name);
    $pdf->Ln();

    # Header
    $pdf->SetFont("","",12);
    foreach ($PAGE_COLUMNS as $column) {
	$pdf->Cell($column[2],8,$column[0],1);
    }
    $pdf->Ln();
    
    foreach ($records as $record) {
	foreach ($PAGE_COLUMNS as $column) {
	    if ($column[1] == "CHNAME") {
		$pdf->SetFont('kozminproregular', '', 12);
	    }
	    $pdf->Cell($column[2],8,$record[$column[1]],1);
	    if ($column[1] == "CHNAME") {
		$pdf->SetFont('times', '', 12);
	    }
	}
	$pdf->Ln();
    }
}

require_once("../libs/mysql-connect.php");
require_once("../libs/config.php");
require_once("tcpdf/tcpdf.php");

$show_by = $_POST["show_by"];
$show = explode(",",$_POST["show"]);

$save_file = get_save_file_table();

$time_boundary = mysql_fetch_row(mysql_query("SELECT TIME FROM save_files.`$save_file` WHERE REGNO=0"))[0];

$show_to_condition = ["present" => "(TIME <= '$time_boundary' && TIME != 0)",
                      "late" => "TIME > '$time_boundary'",
                      "absent" => "TIME = 0"];

$results = [];
$SHOW_OPTIONS = ["present", "late", "absent"];

foreach ($SHOW_OPTIONS as $option) {
    if (in_array($option, $show)){
        $query = mysql_query("SELECT * FROM save_files.`$save_file` WHERE ".$show_to_condition[$option]." && REGNO != 0");
        $row = mysql_fetch_array($query);
        while ($row != NULL) {
            $row["STATUS"]=$option;
            array_push($results, $row);
            $row = mysql_fetch_array($query);
        }
    }
}

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->SetFont('times', '', 12);
$pdf->SetHeaderData("", PDF_HEADER_LOGO_WIDTH, "Test", "Test");

if ($show_by == "all") {
    generate_page("All", $results, $pdf);
} else if ($show_by == "house") {
    $houses_query = mysql_query("SELECT DISTINCT SCHHOUSE FROM save_files.`$save_file`");
    $houses = [];
    $row = mysql_fetch_row($houses_query);
    while ($row != NULL) {
        array_push($houses, $row[0]);
	$row = mysql_fetch_row($houses_query);
    }

    sort($houses);

    foreach ($houses as $house) {
	if ($house == "") {
	    continue;
	}
	$filtered = array_filter($results, function ($var) {
	    global $house;
	    return $var["SCHHOUSE"] == $house;
	});
	generate_page($HOUSE_NAMES[$house], $filtered, $pdf);
    }
} else if ($show_by == "class") {
    $classes_query = mysql_query("SELECT DISTINCT CLASSCODE FROM save_files.`$save_file`");
    $classes = [];
    $row = mysql_fetch_row($classes_query);
    while ($row != NULL) {
        array_push($classes, $row[0]);
	$row = mysql_fetch_row($classes_query);
    }

    sort($classes);

    foreach ($classes as $class) {
	if ($class == "") {
	    continue;
	}
	$filtered = array_filter($results, function ($var) {
	    global $class;
	    return $var["CLASSCODE"] == $class;
	});
	generate_page($class, $filtered, $pdf);
    }
}

$name = "tmp/$save_file-$show_by-".implode("-", $show).".pdf";
$pdf->Output("../$name", "F");
echo $name;
?>
