$("#loginBtn").click(function() {
    var formData = {
        username: $("#username").val(),
        password: $("#password").val(),
    };
    alert(formData.username);

    var url = urlroot + "/auth/login";

    var successCallback = function(response) {
        response = JSON.parse(response);
        //alert(response.status);

        if (response.status == 1) {
            window.location.href = urlroot + "/dashboard/index";
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



$("#forgotpasswordBtn").click(function() {
    var formData = {
        emailaddress: $("#emailaddress").val(),
    };
    var url = urlroot + "/auth/forgotpassword";
    var successCallback = function(response) {
        console.log(response);
        //alert(response);
            if (response == 1) {
                window.location.href = urlroot + "/auth/resetpassword";
            } 
            else if (response == 2) {
                $.notify("Wrong email address", {
                    position: "top center"
                },"error");
            } 
            else if (response == 3) {
                $.notify("Email address is not verified", {
                    position: "top center"
                },"error");
            } 
            else {
                $.notify("Connection Error: Please check your internet connection and try again", {
                    position: "top center"
                },"error");
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



$("#updateUserBtn").click(function() {
    var formData = {
        jobtitle: $("#jobtitle").val(),
        department: $("#department").val(),
        emailaddress: $("#emailaddress").val(),
        telephone: $("#telephone").val(),
        id: $("#uid").val()
    };

    var url = urlroot + "/auth/updateuser";
    var successCallback = function(response) {
        console.log(response);
        //alert(response);
        if (response == 1) {
            window.location.href = urlroot + "/auth/verifycode";
        }
        else if (response == 2) {
            $.notify("Email or telephone already exists", {
                position: "top center"
            },"error");
        }
        else {
            $.notify("Error updating details", {
                position: "top center"
            },"error");
        }
    };
    var validateForm = function(formData) {
        var error = '';
        if (!formData.jobtitle) {
            error += 'Job Title is required\n';
            $("#jobtitle").focus();
        }
        if (!formData.department) {
            error += 'Department is required\n';
            $("#department").focus();
        }
        if (!formData.emailaddress) {
            error += 'Email address is required\n';
            $("#emailaddress").focus();
        } else if (!/\S+@\S+\.\S+/.test(formData.emailaddress)) {
            error += 'Invalid email address\n';
            $("#emailaddress").focus();
        }
        if (!formData.telephone) {
            error += 'Telephone is required\n';
            $("#telephone").focus();
        } else if (!/^\d{10}$/.test(formData.telephone)) {
            error += 'Telephone must be 10 digits\n';
            $("#telephone").focus();
        }
        return error;
    };
    
    saveForm(formData, url, successCallback, validateForm);
});



$("#verifyCodeBtn").click(function() {
    var formData = {
        verification_code: $("#verification_code").val(),
        id: $("#uid").val()
    };

    var url = urlroot + "/auth/verifycode";
    var successCallback = function(response) {
        //console.log(response);
        //alert(response);
        if (response == 1) {
            window.location.href = urlroot + "/auth/login";
        }
        else {
            $.notify("Invalid code", {
                position: "top center"
            },"error");
        }
    };
    var validateForm = function(formData) {
        var error = '';
        if (!formData.verification_code) {
            error += 'Verification code is required\n';
            $("#verification_code").focus();
        }
        return error;
    };
    
    saveForm(formData, url, successCallback, validateForm);
});



