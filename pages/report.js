// -*- js-indent-level: 4; indent-tabs-mode: nil -*-
const CHECKBOX_OPTIONS = ["present",
                          "late",
                          "absent"];

$(function() {
    $("#show-by").buttonset();
    $("#show").buttonset();
    $("#format").buttonset();
    $("#generate-button").click(function() {
        $("#loader").show();
        var show_by = $('input[type=radio][name=show-by]:checked').val();
        var output_format = $('input[type=radio][name=format]:checked').val();
        var show = [];
        for (var i in CHECKBOX_OPTIONS) {
            if ($("#" + CHECKBOX_OPTIONS[i]).prop('checked')) {
                show.push(CHECKBOX_OPTIONS[i]);
            }
        }
        $.ajax({
            type: "POST",
            url: "pages/report-process.php",
            data: "show_by="+show_by+"&show="+show.join(",")+"&format="+output_format,
            success: function(data) {
                window.open(data);
                $("#loader").hide();
            }
        });
    });
});