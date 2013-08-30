<script src="pages/stats.js" type="text/javascript"></script>
<?php
require_once("libs/stat-functions.php");
require_once("pages/stats-layout.php");
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
      echo get_all_table();
    ?>
  </div>
  <div id="by-form">
    <?php
      echo get_field_table("FORM", "Form");
    ?>
  </div>
  <div id="by-house">
    <?php
      echo get_field_table("SCHHOUSE", "House");
    ?>
  </div>
  <div id="by-class">
    <?php
      echo get_field_table("CLASSCODE", "Class");
    ?>
  </div>
</div>
