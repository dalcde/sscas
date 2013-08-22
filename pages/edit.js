// -*- js-indent-level: 4; indent-tabs-mode: nil -*-
const FIELDS = ['ENNAME',
                'CHNAME',
                'SCHHOUSE',
                'CLASSCODE',
                'CLASSNO',
                'SEX'];
var REGNO;

$(function() {
    $("#date-entry").datepicker({dateFormat: "yy-mm-dd",
                                 showOtherMonths: true,
                                 selectOtherMonths: true});
    $("#time-entry").timeEntry({showSeconds: true, show24Hours: true, spinnerImage: ''});

    $("#input").submit(function() {
        $.ajax({
            type: "POST",
            url: "pages/edit-read.php",
            data: "REGNO="+$("#REGNO").val(),
            dataType: 'json',
            success: function(data) {
                var id = $("#REGNO").val();
                if (data) {
                    for (var i in FIELDS) {
                        $('#' + FIELDS[i]).html(data[FIELDS[i]]);
                    }
                    $('#photo').html("<img src=\"photos/"+id+".JPG\" alt=\"No photo found: "+id+"\"width=\"236\" height=\"295\"/>");
                    $('#date-entry').val(data["TIME"].split(" ")[0]);
                    $('#time-entry').val(data["TIME"].split(" ")[1]);
                } else {
                    alert("Student " + id + " does not exist");
                    for (var i in FIELDS) {
                        $('#' + FIELDS[i]).html("");
                        $('#photo').html("");
                    }
                }
                REGNO = $("#REGNO").val();
                $("#REGNO").select();
            }
        });
        return false;
    });
    $("#edit").click(function() {
        $.ajax({
            type: "POST",
            url: "pages/edit-process.php",
            data: "REGNO="+REGNO + "&TIME=" + $("#date-entry").val() + " " + $("#time-entry").val(),
             success: function(data) {
                if (data) {
                    alert("Successfully updated timestamp");
                } else {
                    alert("Failed to update timestamp");
                }
            }
        });
        return false;
    });
    $("#remove").click(function() {
        $.ajax({
            type: "POST",
            url: "pages/edit-process.php",
            data: "REGNO="+REGNO + "&TIME=0",
             success: function(data) {
                if (data) {
                    alert("Successfully updated timestamp");
                    $('#date-entry').val("0000-00-00");
                    $('#time-entry').val("00:00:00");
                } else {
                    alert("Failed to update timestamp");
                }
            }
        });
        return false;
    });
});
