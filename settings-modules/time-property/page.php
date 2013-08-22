<?php
  require_once("settings-modules/time-property/functions.php");
?>
<script src="settings-modules/time-property/jquery.js" type="text/javascript"></script>
<form id="time-form">
  Select Time:<br />
  <input type="text" id="date-entry" value="<?php echo get_date()?>" />
  <input type="text" id="time-entry" value="<?php echo get_time()?>" /><br />
  <input type="button" id="time-now" value="Set as 'Now'" /><br /><br />
  <input type="button" id="submit" value="Submit" />
</form>
