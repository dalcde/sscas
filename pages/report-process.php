<?php
require_once("../libs/mysql-connect.php");
require_once("../libs/config.php");
require_once("tcpdf/tcpdf.php");

$show_by = $_POST["show_by"];
$show = explode(",",$_POST["show"]);
$output_format = $_POST["format"];


#                 HEADER, DATABASE_ENTRY, WIDTH
$PAGE_COLUMNS = [["Class", "CLASSCODE", 13],
		 ["Class No", "CLASSNO", 20],
		 ["English Name", "ENNAME", 60],
		 ["Chinese Name", "CHNAME", 30],
		 ["Sex", "SEX", 10],
		 ["House", "SCHHOUSE", 13],
		 ["Status", "STATUS", 20]];

$HOUSE_NAMES = ["B" => "Barnett",
		"C" => "College",
		"H" => "Hewitt",
		"M" => "Martin",
		"P" => "Priestley",
		"S" => "Stewert"];

$OUTPUT_FORMAT_PDF = "pdf";
$OUTPUT_FORMAT_CSV = "csv";

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

function generate_page($name, $records, $output) {
  global $output_format;
  global $OUTPUT_FORMAT_PDF;
  global $OUTPUT_FORMAT_CSV;

  usort($records, function($a, $b) {
      if ($a["CLASSCODE"] > $b["CLASSCODE"]) {
	return 1;
      } else if ($a["CLASSCODE"] < $b["CLASSCODE"]) {
	return -1;
      } else {
	return ($a["CLASSNO"] > $b["CLASSNO"]) ? 1 : -1;
      }
    });

  switch ($output_format) {
  case $OUTPUT_FORMAT_PDF:
    generate_page_pdf($name, $records, $output);
    break;
  case $OUTPUT_FORMAT_CSV:
    generate_page_csv($name, $records, $output);
    break;
  }
}

function generate_page_pdf($name, $records, $pdf) {
  global $PAGE_COLUMNS;

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
      if ($column[1] == "CHNAME" || $column[1] == "STATUS") {
	$pdf->SetFont('stsongstdlight', '', 12);
      }
      $pdf->Cell($column[2],8,$record[$column[1]],1);
      if ($column[1] == "CHNAME" || $column[1] == "STATUS") {
	$pdf->SetFont('times', '', 12);
      }
    }
    $pdf->Ln();
  }
}

function generate_page_csv($name, $records, $file) {
  global $PAGE_COLUMNS;
  
  foreach ($records as $record) {
    $array = [];
    foreach ($PAGE_COLUMNS as $column) {
      array_push($array,$record[$column[1]]);;
    }
    fputcsv($file, $array);
  }
}

$save_file = get_save_file_table();

$time_boundary = mysql_fetch_row(mysql_query("SELECT TIME FROM save_files.`$save_file` WHERE REGNO=0"))[0];

$show_to_condition = ["present" => "(TIME <= '$time_boundary' && TIME != 0)",
                      "late" => "TIME > '$time_boundary'",
                      "absent" => "TIME = 0"];
$STATUS_TO_SYMBOL = ["present" => "/",
                     "late" => "ϕ",
		     "absent" => "O"];
$results = [];
$SHOW_OPTIONS = ["present", "late", "absent"];

foreach ($SHOW_OPTIONS as $option) {
    if (in_array($option, $show)){
        $query = mysql_query("SELECT * FROM save_files.`$save_file` WHERE ".$show_to_condition[$option]." && REGNO != 0");
        $row = mysql_fetch_array($query);
        while ($row != NULL) {
            $row["STATUS"]=$STATUS_TO_SYMBOL[$option];
            array_push($results, $row);
            $row = mysql_fetch_array($query);
        }
    }
}

if ($output_format == $OUTPUT_FORMAT_PDF) {
  $output = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  $output->SetFont('times', '', 12);
  $output->SetHeaderData("", PDF_HEADER_LOGO_WIDTH, "Test", "Test");
} else if ($output_format == $OUTPUT_FORMAT_CSV) {
  $output = fopen("../tmp/$save_file-$show_by-".implode("-", $show).".csv", "w");
  $items = [];
  foreach ($PAGE_COLUMNS as $column) {
    array_push($items, $column[1]);
  }
  fputcsv($output, $items);
}
if ($show_by == "all") {
    generate_page("All", $results, $output);
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
	generate_page($HOUSE_NAMES[$house], $filtered, $output);
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
	generate_page($class, $filtered, $output);
    }
}

if ($output_format == $OUTPUT_FORMAT_PDF) {
  $name = "tmp/$save_file-$show_by-".implode("-", $show).".pdf";
  $output->Output("../$name", "F");
  echo $name;
} else if ($output_format == $OUTPUT_FORMAT_CSV) {
  fclose($output);
  echo "tmp/$save_file-$show_by-".implode("-", $show).".csv";
}
?>
