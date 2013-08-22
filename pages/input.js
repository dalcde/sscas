// -*- js-indent-level: 4; indent-tabs-mode: nil -*-
const FIELDS = ['ENNAME',
                'CHNAME',
                'SCHHOUSE',
                'CLASSCODE',
                'CLASSNO',
                'SEX',
                'TIME'];
const TIMEOUT_INTERVAL = 10*1000;
var last_record = null;

function check_remove_info(id) {
    if (last_record == id) {
        for (var i in FIELDS) {
            $('#' + FIELDS[i]).html("");
            $('#photo').html("");
        }
    }
}

function on_success(data) {
    var id = $("#REGNO").val();
    if (data) {
        for (var i in FIELDS) {
            $('#' + FIELDS[i]).html(data[FIELDS[i]]);
        }
        $('#photo').html("<img src=\"photos/"+id+".JPG\" alt=\"No photo found: "+id+"\"width=\"236\" height=\"295\"/>");

        if (data["duplicate"]) {
            if (data["prompt"]) {
                result = confirm("Student "+ id + " already entered. Update timestamp?");
                if (result) { 
                    $.ajax({
                        type: "POST",
                        url: "pages/input-process.php",
                        data: "REGNO="+$("#REGNO").val() + "&FORCE=true",
                        dataType: 'json',
                        success: on_success
                    });
                }
            } else {
                alert("Student "+ id + " already entered.");
            }
        }
        last_record = data["TIME"];
        setTimeout(function() {check_remove_info(data["TIME"]);}, TIMEOUT_INTERVAL);
    } else {
        alert("Student " + id + " does not exist");
        for (var i in FIELDS) {
            $('#' + FIELDS[i]).html("");
            $('#photo').html("");
        }
    }
    $("#REGNO").select();
}

$(function() {
    $("#input").submit(function() {
        $.ajax({
            type: "POST",
            url: "pages/input-process.php",
            data: "REGNO="+$("#REGNO").val(),
            dataType: 'json',
            success: on_success
        });
        return false;
    });
});
