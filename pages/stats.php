<script src="pages/stats.js" type="text/javascript"></script>
<?php
require_once("libs/stat-functions.php");
?>
<div id="tabs">
  <ul>
    <li><a href="#overall">Overall</a></li>
    <li><a href="#by-form">By Form</a></li>
    <li><a href="#by-house">By House</a></li>
    <li><a href="#by-class">By Class</a></li>
  </ul>
  <div id="overall">
    <?php
      echo "Total: ".get_student_number(ALL_CONDITION)."<br />";
      echo "Present: ".get_student_number(PRESENT_CONDITION)."<br />";
      echo "Late: ".get_student_number(LATE_CONDITION)."<br />";
      echo "Absent: ".get_student_number(ABSENT_CONDITION)."<br />";
    ?>
  </div>
  <div id="by-form">
     <table class="stats-table">
      <?php
	echo "<tr><th>Form</th>";
	$forms = get_forms();
	foreach ($forms as $row) {
	  echo "<th>".$row."</th>";
	}
        echo "</tr>";

	echo "<tr><th>Present</th>";
	$present = get_number_by_form(PRESENT_CONDITION);
	foreach ($forms as $form) {
	  echo "<td>".$present[$form]."</td>";
	}
        echo "</tr>";

	echo "<tr><th>Absent</th>";
	$absent = get_number_by_form(ABSENT_CONDITION);
	foreach ($forms as $form) {
	  echo "<td>".$absent[$form]."</td>";
	}
        echo "</tr>";

	echo "<tr><th>Late</th>";
	$late = get_number_by_form(LATE_CONDITION);
	foreach ($forms as $form) {
	  echo "<td>".$late[$form]."</td>";
	}
        echo "</tr>";

	echo "<tr><th>All</th>";
	$all = get_number_by_form(ALL_CONDITION);
	foreach ($forms as $form) {
	  echo "<td>".$all[$form]."</td>";
	}
        echo "</tr>";
      ?>
    </table>
  </div>
  <div id="by-house">
     <table class="stats-table">
      <?php
	echo "<tr><th>House</th>";
	$houses = count_field("SCHHOUSE");
	foreach ($houses as $row) {
	  echo "<th>".$row."</th>";
	}
        echo "</tr>";

	echo "<tr><th>Present</th>";
	$present = get_number_by_field("SCHHOUSE", PRESENT_CONDITION);
	foreach ($houses as $house) {
	  echo "<td>".$present[$house]."</td>";
	}
        echo "</tr>";

	echo "<tr><th>Absent</th>";
	$absent = get_number_by_field("SCHHOUSE", ABSENT_CONDITION);
	foreach ($houses as $house) {
	  echo "<td>".$absent[$house]."</td>";
	}
        echo "</tr>";

	echo "<tr><th>Late</th>";
	$late = get_number_by_field("SCHHOUSE", LATE_CONDITION);
	foreach ($houses as $house) {
	  echo "<td>".$late[$house]."</td>";
	}
        echo "</tr>";

	echo "<tr><th>All</th>";
	$all = get_number_by_field("SCHHOUSE", ALL_CONDITION);
	foreach ($houses as $house) {
	  echo "<td>".$all[$house]."</td>";
	}
        echo "</tr>";
      ?>
    </table>
  </div>
  <div id="by-class">
  </div>
</div>
