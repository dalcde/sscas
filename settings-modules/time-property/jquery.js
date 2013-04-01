// -*- js-indent-level: 4; indent-tabs-mode: nil -*-
$(function() {
      $("#date-entry").datepicker({dateFormat: "yy-mm-dd",
                                      showOtherMonths: true,
                                      selectOtherMonths: true});
      $("#time-entry").timeEntry({showSeconds: true, show24Hours: true, spinnerImage: ''});
      $("#submit").click(function() {
          $.ajax({
                 type: "POST",
                 url: "settings-modules/time-property/process.php",
                 data: "time="+$("#date-entry").val() + " " + $("#time-entry").val(),
                 success: function(data) {
                     if (data) {
                         alert("Successfully updated time");
                     } else {
                         alert("Failed to update time");
                     }
                 }
          });
      });
});