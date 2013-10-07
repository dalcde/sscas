<?php
if ($_FILES["photo-file"]["name"]){
    $filename = $_FILES["photo-file"]["name"];
    $source = $_FILES["photo-file"]["tmp_name"];
    $type = $_FILES["photo-file"]["type"];

    $name = explode(".", $filename);

    if (strtolower($name[1]) == "zip") {
        $zip = new ZipArchive();
        if ($zip->open($source)) {
            $tmpdir = sys_get_temp_dir();
            $tmpdir = rtrim($tmpdir, "/\\");

            mkdir("$tmpdir/photos");
            $zip->extractTo("$tmpdir/photos");
            $zip->close();

            if ($handle = opendir("$tmpdir/photos")) {
                while (false !== ($fileName = readdir($handle))) {
                    $arr = explode(".", $fileName);
                    if ($arr[count($arr)-1] != "jpg" && $arr[count($arr)-1] != "JPG") {
                        continue;
                    }
                    $arr[count($arr)-1] = "JPG";
                    $newFileName = implode(".", $arr);
                    rename("$tmpdir/photos/".$fileName, "../../photos/".$newFileName);
                }
                closedir($handle);
            }

            echo "Success!";
        } else {
            echo "Unable to extract archive";
        }
    } else {
        echo "Uplaoded file is not zip archive";
    }
}
?>
