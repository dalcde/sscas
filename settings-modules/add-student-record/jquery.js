// -*- js-indent-level: 4; indent-tabs-mode: nil -*-
function get_date_string() {
    var d = new Date();
    var year = d.getFullYear();
    var month = d.getMonth() + 1; // getMonth gives month number starting from 0, i.e. 0=January, 1=February etc.
    var date = d.getDate();

    if (date < 10) {
        date = "0" + date; // Append "0" if needed for ISO 8601 compliance
    }
    if (month < 10) {
        month = "0" + month;
    }

    return year + "-" + month + "-" + date;
}

$(function() {
    $("#upload_dialog").hide();
    $(".student-record-select").click(function() {
        var record = $(this).html();
        if (record != "New Student Record From CSV") {
            $("#loader").show();
            $.ajax ({
                type: "POST",
                url: "settings-modules/add-student-record/process.php",
                data: "record="+record,
                success: function (data) {
                    $("#loader").hide();
                    if (data == 0) {
                        alert ("Successfully imported student record");
                    } else {
                        alert ("Successfully imported student record \n" + data + " duplicate(s) found ");
                    }
                }
            });
        } else {
            $("#upload_dialog").dialog({width: "auto", height: "auto"});
        }
    });
    $("#upload_form").submit(function() {
        $("#loader").show();
        var formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: "settings-modules/add-student-record/read_file.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $.ajax({
                    type: "POST",
                    url: "settings-modules/add-student-record/write_database.php",
                    data: "array=" + data + "&record=" + $("#name").val(),
                    success: function(data) {
                        $("#loader").hide();
                        if(data) {
                            alert ("Successfully imported student record");
                        } else {
                            alert ("failed");
                        }
                        $("#upload_dialog").dialog('close');
                        document.location.reload();
                    }
                });
            }
        });
        return false;
    });
});