<?php
$table_items = ["REGNO", "ENNAME", "CHNAME", "CLASSCODE", "CLASSNO", "SCHHOUSE", "TIME"];
?>
<link rel="stylesheet" type="text/css" href="ext-libs/jquery.datatable.css" />

<script src="ext-libs/jquery.dataTables.js" type="text/javascript"></script>
<script src="ext-libs/jquery.jeditable.js" type="text/javascript"></script>
<script src="ext-libs/jquery.dataTables.editable.js" type="text/javascript"></script>

<script src="pages/view-all.js" type="text/javascript"></script>
<div style="float: left">
<table id="view-all" width="100%">
  <thead>
    <tr>
      <th>Student Number</th>
      <th>English Name</th>
      <th>Chinese Name</th>
      <th>Class</th>
      <th>Class No.</th>
      <th>House</th>
      <th>Time</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $table = get_save_file_table();
      $query = mysql_query("SELECT * FROM save_files.`$table`");
      $time = strtotime(get_time_boundary());
      while ($row = mysql_fetch_assoc($query)) {
          if ($row["REGNO"] == 0) {
	      continue;
	  }

	  echo "<tr id=\"".$row["REGNO"]."\">\n";
	  foreach ($table_items as $item) {
	      echo "<td>".$row[$item]."</td>\n";
	  }
	  $status = "Late";
	  if ($row["TIME"] == "0000-00-00 00:00:00") {
	      $status = "Absent";
	  } else if (strtotime($row["TIME"]) > $time) {
	      $status = "Present";
	  }

	  echo "<td>".$status."</td>\n";
	  echo "</tr>\n";
      }
    ?>
  </tbody>
</table>
</div>
