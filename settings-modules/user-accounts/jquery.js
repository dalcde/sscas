$(function() {
    $(".user-accounts-select").click(function() {
        if ($(this).html() != "New User") {
            $("#username").val($(this).html());
            $("#username").prop('disabled', true);
        } else {
            $("#username").prop('disabled', false);
            $("#username").val("");
        }
        $("input[type=password]").prop("disabled", false);
        $("#submit").prop("disabled", false);
        $("#new-password").val("");
        $("#re-password").val("");
        $("#admin-password").val("");
    });
    $("#submit-user").click(function() {
        var account_type = $("#account-type").val();
        var username = $("#username").val();
        var admin_pass = $("#admin-password").val();
        var new_pass = $("#new-password").val();
        var re_pass = $("#re-password").val();
        $.ajax({
            type: "POST",
            url: "settings-modules/user-accounts/process.php",
            data: "username=" + username + "&admin_pass=" + admin_pass + "&new_pass=" + new_pass + "&re_pass=" + re_pass),
            success: function (data) {
                switch (data) {
                    case "1":
                    alert("Admin password incorrect");
                    break;
                    case "2":
                    alert("Passwords do not match");
                    break;
                    default:
                    alert("Success!");
                }
                document.location.reload();
            }
        });
    });
});
