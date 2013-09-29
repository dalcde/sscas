<link rel="stylesheet" type="text/css" href="ext-libs/jquery.datatable.css" />

<script src="ext-libs/jquery.dataTables.js" type="text/javascript"></script>
<script src="ext-libs/jquery.jeditable.js" type="text/javascript"></script>
<script src="ext-libs/jquery.dataTables.editable.js" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
    var table = $('#view-all').dataTable({
        "bJQueryUI": true,
        "sPaginationType": "full_numbers",
        "iDisplayLength": 25,
        "aoColumns": [
        {"sWidth": "20%"},
        {"sWidth": "10%", "sClass": "center"},
        {"sWidth": "15%", "sClass": "center"},
        {"sWidth": "15%", "sClass": "center"},
        {"sWidth": "20%"},
        {"sWidth": "20%"}]
    });

    $("#filter").change(function() {
        table.fnFilter($(this).val(), 7);
    });
});
</script>
<div style="float: left">
<table id="view-all" width="100%">
  <thead>
    <tr>
      <th>Timestamp</th>
      <th>Event</th>
      <th>Computer</th>
      <th>Regno</th>
      <th>Time</th>
      <th>Remarks</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $TABLE = get_save_file_table();
    $lines = file("log/$TABLE.log");
    foreach ($lines as $line) {
        $line = str_replace("  ", " ", $line);
        $i = split(" ", $line);
	echo "<tr>\n";
	echo "<td>";
	echo $i[0]." ".$i[1];
	echo "</td>\n";
	echo "<td>";
	echo $i[2];
	echo "</td>\n";
	echo "<td>";
	echo $i[3];
	echo "</td>\n";
	echo "<td>";
	echo $i[4];
	echo "</td>\n";
	echo "<td>";
	if ($i[2] == "EDIT") {
	    echo $i[5]." ".$i[6]." -><br />".$i[8]." ".$i[9];
	    echo "</td>\n<td>";
	} else {
	    echo $i[5]." ".$i[6];
	    echo "</td>\n<td>";
	    echo $i[7]." ".$i[8];
	}
	echo "</td>\n";
	echo "</tr>\n";
    }
  ?>
  </tbody>
</table>
</div>

