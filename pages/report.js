// -*- js-indent-level: 4; indent-tabs-mode: nil -*-
const CHECKBOX_OPTIONS = ["present",
                          "late",
                          "absent"];

$(function() {
    $("#show-by").buttonset();
    $("#show").buttonset();
    $("#generate-button").click(function() {
        $("#loader").show();
        var show_by = $('input[type=radio][name=show-by]:checked').val();
        var show = [];
        for (var i in CHECKBOX_OPTIONS) {
            if ($("#" + CHECKBOX_OPTIONS[i]).prop('checked')) {
                show.push(CHECKBOX_OPTIONS[i]);
            }
        }
        $.ajax({
            type: "POST",
            url: "pages/report-process.php",
            data: "show_by="+show_by+"&show="+show.join(","),
            success: function(data) {
                window.open(data);
                $("#loader").hide();
            }
        });
    });
});