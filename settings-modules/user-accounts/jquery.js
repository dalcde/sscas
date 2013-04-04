var selection = "";
$(function() {
    $("#submit").prop("disabled", true);
    $("input[type=text]").prop("disabled", true);
    $("input[type=password]").prop("disabled", true);
    $(".user-accounts-select").click(function() {
        selection = $(this).html();
        if (selection != "New User") {
            $("#username").val(selection);
            $("#username").prop('disabled', true);
        } else {
            $("#username").prop('disabled', false);
            $("#username").val("");
        }
        $("input[type=password]").prop("disabled", false);
        $("#submit").prop("disabled", false);
    });
    $("#submit").click(function() {
        var account_type = $("#account-type").val();
        var username = $("#username").val();
        var admin_pass = $("#admin-password").val();
        var new_pass = $("#new-password").val();
        var re_pass = $("#re-password").val();
        $.ajax({
            type: "POST",
            url: "settings-modules/user-accounts/process.php",
            data: "new_user=" + (selection == "New User") + "&username=" + username + "&admin_pass=" + admin_pass + "&new_pass=" + new_pass + "&re_pass=" + re_pass + "&account_type=" + (account_type == "Admin" ? 0: 1),
            success: function (data) {
                switch (data) {
                    case "0":
                    alert("Username already in use");
                    break;
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