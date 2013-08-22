<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css"/>
<script src="settings-modules/save-file/jquery.js" type="text/javascript"></script>
Select attendance record
<div id="save-file-select-div">
    <?php
        require_once("settings-modules/save-file/functions.php");
        $table = list_tables();
        $curr_table = get_save_file_table();
        foreach ($table as $rec) {
            $class = "save-file-select";
	    if ($rec == $curr_table) {
	        $class = "save-file-select save-file-select-current";
            }
            echo "<a href=\"#\" class=\"$class\">".$rec."</a>";
       }
    ?>
    <a href="#" class="save-file-select">New Save File</a>
</div>