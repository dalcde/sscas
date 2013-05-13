// -*- js-indent-level: 4; indent-tabs-mode: nil -*-

function prepend_zero(x) {
    if (x < 10)
        x = "0" + x;
    return x;
}
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
    $("#time-now").click(function() {
        var date = new Date();
        $("#date-entry").val(date.getFullYear() + "-" + prepend_zero(date.getMonth()+1) + "-" + prepend_zero(date.getDate()));
        $("#time-entry").val(prepend_zero(date.getHours()) + ":" + prepend_zero(date.getMinutes()) + ":" + prepend_zero(date.getSeconds()));
    });
});