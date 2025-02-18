$("#loginBtn").on("click", function() {
    var formData = {
        username: $("#username").val(),
        password: $("#password").val(),
    };

    var url = urlroot + "/auth/login";

    var successCallback = function(response) {
        response = JSON.parse(response);
        //alert(response.status);

        if (response.status == 1) {
            window.location.href = urlroot + "/pages/index";
        } 
        else if (response.status == 6) {
            window.location.href = urlroot + "/pages/client";
        }
        else if (response.status == 7) {
            window.location.href = urlroot + "/pages/worker";
        }
        else if (response.status == 8) {
            window.location.href = urlroot + "/pages/inspector";
        } else if (response.status == 3) {
            window.location.href = urlroot + "/auth/updateuser";
        } else if (response.status == 4) {
            window.location.href = urlroot + "/auth/verifycode";
        } else if (response.status == 2) {
            $("#attemptMessage").html(response.message);

            // Check if the account is blocked
            if (response.message.includes("Account blocked")) {
                $.notify("Account has been blocked. Please contact IT for assistance.", {
                    position: "top center"
                }, "error");
            } else {
                $.notify("Wrong username or password", {
                    position: "top center"
                }, "error");
            }
        } 
        else if (response.status == 5) {
            $.notify("Wrong username or password", {
                position: "top center"
            }, "error");
        }
        else {
            $.notify("Connection Error: Please check your internet connection and try again", {
                position: "top center"
            }, "error");
        }
    };

    var validateForm = function(formData) {
        var error = '';
        if (!formData.username) {
            error += 'Username is required\n';
            $("#username").focus();
        }
        if (!formData.password) {
            error += 'Password is required\n';
            $("#password").focus();
        }
        return error;
    };

    saveForm(formData, url, successCallback, validateForm);
});

$("#togglePassword").on("click", function() {
    var passwordField = $("#password");
    var eyeClosedIcon = $("#eyeClosed");
    var eyeOpenIcon = $("#eyeOpen");

    if (passwordField.attr("type") === "password") {
        passwordField.attr("type", "text");
        eyeClosedIcon.addClass("d-none");
        eyeOpenIcon.removeClass("d-none");
    } else {
        passwordField.attr("type", "password");
        eyeClosedIcon.removeClass("d-none");
        eyeOpenIcon.addClass("d-none");
    }
});
