
<script src="settings-modules/add-student-record/jquery.js" type="text/javascript"></script>
Select attendance record
<div id="student-record-select-div">
    <?php
        require "settings-modules/add-student-record/functions.php";
        $table = list_tables();
        foreach ($table as $rec) {
	    echo "<a href=\"#\" class=\"student-record-select\">".$rec."</a>";
       }
    ?>
    <a href="#" class="student-record-select">New Student Record From CSV</a>
</div>

<div id="upload_dialog" title="Select file to upload">
<form id="upload_form" method="post" enctype="multipart/form-data">
 Enter name of new student record: <br />
 <input type="text" name="name" id="name" /><br />
 Select CSV: <br />
 <input type="file" name="file" id="file" /><br />
 <input type="submit" name="submit" value="submit" />
</form>
</div>