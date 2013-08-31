<?php
if ($_FILES["photo-file"]["name"]){
    $filename = $_FILES["photo-file"]["name"];
    $source = $_FILES["photo-file"]["tmp_name"];
    $type = $_FILES["photo-file"]["type"];

    $name = explode(".", $filename);

    $okay = false;

    $accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
    foreach( $accepted_types as $mime_type) {
	if( $mime_type == $type ) {
	    $okay = true;
	    break;
	} 
    }

    if (strtolower($name[1]) != "zip") {
	$okay = false;
    }

    if ($okay) {
	$zip = new ZipArchive();
	if ($zip->open($source)) {
	    $zip->extractTo("../../photos/");
	    $zip->close();
	    echo "Success!";
	} else {
	    echo "Unable to extract archive";
	}
    } else {
	echo "Uplaoded file is not zip archive";
    }
}
?>
