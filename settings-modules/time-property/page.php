<?php
  require_once("settings-modules/time-property/functions.php");
?>
<script src="settings-modules/time-property/jquery.js" type="text/javascript"></script>
<div style="float: left"><!-- float:left is a hack to prevent div from expanding to occupy the whole screen -->
<form id="time-form">
  Select Time:<br />
  <input type="text" id="date-entry" value="<?php echo get_date()?>" />
  <input type="text" id="time-entry" value="<?php echo get_time()?>" /><br />
  <input type="button" id="time-now" value="Set as 'Now'" /><br /><br />
  <input type="button" id="submit-time" value="Submit" />
</form>
</div>
