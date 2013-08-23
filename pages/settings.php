<?php
admin_only();
$PAGES=['save-file'=>'Save Files',
        'add-student-record'=>'Add Student Record',
        'time-property'=>'Time Property',
        'user-accounts'=>'User Accounts'];
?>

<script src="pages/settings.js" type="text/javascript"></script>
<div id="tabs">
  <ul>
    <?php
      foreach ($PAGES as $page => $name) {
          echo "<li><a href='#$page'>$name</a></li>";
      }
    ?>
  </ul>
  <?php
    foreach ($PAGES as $page => $name) {
        echo "<div id='$page'>";
	include "settings-modules/$page/page.php";
	echo "</div>";
    }
  ?>
</div>

