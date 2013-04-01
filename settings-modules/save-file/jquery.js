// -*- js-indent-level: 4; indent-tabs-mode: nil -*-
function get_date_string() {
    return new Date().toISOString().split("T")[0];
}

$(function() {
    $(".save-file-select").click(function() {
        var selected = $(this);
        var record = selected.html();
        if (record != "New Save File") {
            $.ajax ({
                type: "POST",
                url: "settings-modules/save-file/process.php",
                data: "record="+record,
                success: function (data) {
                    if (data) {
                        $("a").removeClass("save-file-select-current");
                        selected.addClass("save-file-select-current");
                        alert ("Successfully updated save file");
                    } else {
                        alert ("Failed to update save file");
                    }
                }
            });
        } else {
            var name = prompt("Name of new save file:", get_date_string());
            $.ajax ({
                type: "POST",
                url: "settings-modules/save-file/process.php",
                data: "new=true&record="+name,
                success: function (data) {
                    if (data) {
                        alert ("Successfully created save file");
                    } else {
                        alert ("Failed to create save file");
                    }
                }
            });
         }
    });
});