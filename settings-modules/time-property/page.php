<?php
  require "libs/config.php";
  require "settings-modules/time-property/functions.php";
?>
<script src="settings-modules/time-property/jquery.js" type="text/javascript"></script>
<form id="time-form">
    Select Time:<br />
    <input type="text" id="date-entry" value="<?php echo get_date()?>" />
    <input type="text" id="time-entry" value="<?php echo get_time()?>" /><br /><br />
    <input type="button" id="submit" value="Submit" />
</form>
