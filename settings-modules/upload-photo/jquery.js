function checkExtension() {
    var fileName = document.getElementById("uploadFile");
}

$(function() {
    $("#upload-photo-button").click(function() {
        var formData = new FormData($("#photo-upload-form")[0]); // Don't ask me why this works
        $("#loader").show();
        $.ajax({
            type: "POST",
            url: "settings-modules/upload-photo/process.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {
                $("#loader").hide();
                alert(data);
            }
        });
        return false;
    });
})
