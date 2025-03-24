<?php extract($data);  ?>
<div id="userForm">
    <div class="form-group row">
        <div class="col-lg-4 col-md-6">
            <label for="currentPassword">Current Password</label>
            <input type="password" class="form-control" id="currentPassword" autocomplete="off" placeholder="Enter Current Password">
        </div>
        <div class="col-lg-4 col-md-6">
            <label for="newPassword">New Password</label>
            <input type="password" class="form-control" id="newPassword" autocomplete="off" placeholder="Enter New Password">
        </div>
        <div class="col-lg-4 col-md-6">
            <label for="confirmPassword">Confirm Password</label>
            <input type="password" class="form-control" id="confirmPassword"
            maxlength="10" autocomplete="off" placeholder="Confirm New Password">
        </div>
    </div>
   

    <div class="form-group row">
        <div class="col-lg-12 col-md-12 d-flex justify-content-center">
            <div class="kt-form__actions">
                <button type="button" class="btn btn-facebook" style="border-radius: 0;" id="updatePassword">Update Password</button>
            </div>
        </div>
    </div>
</div>


<script>


$("#updatePassword").on("click", function (event) {
        event.preventDefault();

        var formData = {
            currentPassword: $("#currentPassword").val(),
            newPassword: $("#newPassword").val(),
            confirmPassword: $("#confirmPassword").val(),
            uuid: '<?php echo $uuid ?>'
        };

        var url = `${urlroot}/users/changeUserPassword`;

        var successCallback = function (response) {
                $.notify("Customer saved", {
                    position: "top center",
                    className: "success"
                });
                $.post(`${urlroot}/orders/addCustomerForm`, {}, function (response) {
                    $('#pageForm').html(response);
                });

                $.post(`${urlroot}/orders/viewCustomers`, {}, function (response) {
                    $('#pageTable').html(response);
                });
                $('a[href="#viewCustomers"]').click();
        };

        var validateFormData = function (formData) {
            var error = '';

            if (!formData.currentPassword) { 
                error += "Current Password is required\n";
                $("#currentPassword").focus();
            }
            if (!formData.newPassword) { 
                error += "New Password is required\n";
                $("#newPassword").focus();
            }
            if (formData.newPassword && formData.newPassword.length < 6) { 
                error += "Password should not be less than 6 characters\n";
                $("#newPassword").focus();
            }
            if (!formData.confirmPassword) {
                error += "Confirm New password\n";
                $("#confirmPassword").focus();
            }
            if (formData.confirmPassword && (formData.newPassword != formData.confirmPassword)) {
                error += "Passwords does not match\n";
                $("#confirmPassword").focus();
            }
           
            if (error) {
                $.notify(error, { position: "top center", className: "error" });
                return false;
            }
            return true;
        };

        if (validateFormData(formData)) {
            saveForm(formData, url, successCallback);
        }
    });
    
</script>