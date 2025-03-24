<?php
extract($data); 
?>
<div class="editUserCard mt-5">
    <div class="card-header">
            <h3 class="card-title">
                Edit User - <?= $userDetails['fullName'] ?> 
            </h3>
    </div>
    <div id="userForm" class="mt-5">
        <div class="form-group row">
            <div class="col-lg-4 col-md-6">
                <label for="fullNameEdit">Full Name</label>
                <input type="text" class="form-control" id="fullNameEdit" autocomplete="off" 
                placeholder="Enter Full Name" value="<?= $userDetails['fullName'] ?>">
            </div>
            <div class="col-lg-4 col-md-6">
                <label for="emailAddressEdit">Email Address</label>
                <input type="text" class="form-control" id="emailAddressEdit" autocomplete="off" 
                placeholder="Enter Email Address" value="<?= $userDetails['emailAddress'] ?>">
            </div>
            <div class="col-lg-4 col-md-6">
                <label for="phoneNumberEdit">Phone Number</label>
                <input type="text" class="form-control" id="phoneNumberEdit"
                maxlength="10" autocomplete="off" placeholder="Enter Phone Number" value="<?= $userDetails['phoneNumber'] ?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-6">
                <label for="birthDateEdit">Date of Birth</label>
                <input type="text" class="form-control" id="birthDateEdit" autocomplete="off" 
                placeholder="Select Date of Birth" value="<?= $userDetails['birthDate'] ?>">
            </div>
            <div class="col-lg-4 col-md-6">
                <label for="genderEdit">Gender</label>
                <select id="genderEdit" class="form-control" style="width:100%">
                    <option></option>
                    <?php
                    $genders = ["Male", "Female", "Other"];
                    foreach ($genders as $gender) {
                        $selected = ($gender == $userDetails['gender']) ? 'selected' : '';
                        echo "<option value='$gender' $selected>$gender</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-4 col-md-6">
                <label for="maritalStatusEdit">Marital Status</label>
                <select id="maritalStatusEdit" style="width: 100%" class="form-control">
                    <option></option>
                    <?php
                    $statuses = ["Single", "Married", "Divorced", "Separated", "Widowed", "Engaged", "Annulled", "Not Disclosed"];
                    foreach ($statuses as $status) {
                        $selected = ($status == $userDetails['maritalStatus']) ? 'selected' : '';
                        echo "<option value='$status' $selected>$status</option>";
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-4 col-md-6">
                <label for="jobTitleEdit">Job Title/Position</label>
                <input type="text" class="form-control" id="jobTitleEdit" autocomplete="off" 
                placeholder="Enter Job Title/Position" value="<?= $userDetails['jobtitle'] ?>">
            </div>
            <div class="col-lg-4 col-md-6">
                <label for="departmentsEdit">Department</label>
                <select id="departmentsEdit" style="width: 100%" class="form-control">
                    <option></option>
                    <?php
                    $departments = [
                        "Sales and Marketing", "Production/Manufacturing", "Research and Development (R&D)", 
                        "Procurement and Supply Chain", "Quality Assurance/Control", "Logistics and Distribution", 
                        "Human Resources (HR)", "Finance and Accounting", "Customer Service", 
                        "Maintenance and Repairs", "IT and Systems", "Legal and Compliance", "Management"
                    ];
                    foreach ($departments as $department) {
                        $selected = ($department == $userDetails['department']) ? 'selected' : '';
                        echo "<option value='$department' $selected>$department</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-4 col-md-6">
                <label for="employeeTypeEdit">Employee Type</label>
                <select id="employeeTypeEdit" style="width: 100%" class="form-control">
                    <option></option>
                    <?php
                    $employeeTypes = ["Full-Time", "Part-Time", "Contract", "Intern"];
                    foreach ($employeeTypes as $type) {
                        $selected = ($type == $userDetails['employeeType']) ? 'selected' : '';
                        echo "<option value='$type' $selected>$type</option>";
                    }
                    ?>
                </select>
            </div>
        </div>


        <div class="form-group row">
            <div class="col-lg-4 col-md-6">
                <label for="userTypeEdit">User Type</label>
                <select id="userTypeEdit" style="width: 100%" class="form-control">
                    <option></option>
                    <?php
                    $userTypes = ["Regular", "Administrator", "Super Administrator"];
                    foreach ($userTypes as $type) {
                        $selected = ($type == $userDetails['userType']) ? 'selected' : '';
                        echo "<option value='$type' $selected>$type</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="col-lg-8 col-md-6">
                <label for="permissions">Permissions</label>
                <div id="permissions" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    <?php
                    $permissionsList = [
                        "All Permissions", "Product Management", "Website Management", "Inventory Management",
                        "Order Management", "Account Management", "User Management", "Reporting"
                    ];

                    foreach ($permissionsList as $perm) {
                        $checked = in_array($perm, $userPermissions) ? 'checked' : '';
                        $permId = strtolower(str_replace(' ', '', $perm));
                        echo "<div>
                                <input type='checkbox' id='$permId' name='permissions[]' value='$perm' $checked>
                                <label for='$permId'>$perm</label>
                            </div>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                <div class="kt-form__actions">
                    <button type="button" class="btn btn-warning" style="border-radius: 0;" id="editUserChanges">Edit User</button>
                </div>
            </div>
        </div>
    </div>
</div>



<script>

        $("#userTypeEdit").select2({
            placeholder: "Select Type"
        });
        $("#genderEdit").select2({
             placeholder: "Select Gender"
        });
        $("#birthDateEdit").flatpickr({
             placeholder: "Select Date"
        });
        $("#maritalStatusEdit").select2({
            placeholder: "Select Status"
        });
        $("#departmentsEdit").select2({
            placeholder: "Select Department"
        });
        $("#employeeTypeEdit").select2({
            placeholder: "Select Type"
        });



        $("#editUserChanges").click(function () {
            var formData = {
                fullName: $("#fullNameEdit").val().trim(),
                email: $("#emailAddressEdit").val().trim(),
                phoneNumber: $("#phoneNumberEdit").val().trim(),
                birthDate: $("#birthDateEdit").val().trim(),
                gender: $("#genderEdit").val(),
                maritalStatus: $("#maritalStatusEdit").val(),
                jobTitle: $("#jobTitleEdit").val().trim(),
                department: $("#departmentsEdit").val(),
                employeeType: $("#employeeTypeEdit").val(),
                userType: $("#userTypeEdit").val(),
                permissions: $("input[name='permissions[]']:checked").map(function () {
                    return this.value;
                }).get(),
                uuid: '<?php echo $uuid ?>'
            };
            //alert(formData.uuid);

            var validateForm = function (formData) {
                var errors = [];
                var phoneRegex = /^[0-9]{10}$/;
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!formData.fullName) errors.push({ field: "#fullNameEdit", message: "Please enter full name." });
                if (formData.email && !emailRegex.test(formData.email)) errors.push({ field: "#emailAddressEdit", message: "Please enter a valid email address." });
                if (!formData.phoneNumber.match(phoneRegex)) errors.push({ field: "#phoneNumberEdit", message: "Please enter a valid 10-digit phone number." });
                if (!formData.birthDate) errors.push({ field: "#birthDateEdit", message: "Please select date of birth." });
                if (!formData.gender) errors.push({ field: "#genderEdit", message: "Please select gender." });
                if (!formData.maritalStatus) errors.push({ field: "#maritalStatusEdit", message: "Please select marital status." });
                if (!formData.jobTitle) errors.push({ field: "#jobTitleEdit", message: "Please enter job title/position." });
                if (!formData.department) errors.push({ field: "#departmentsEdit", message: "Please select department." });
                if (!formData.employeeType) errors.push({ field: "#employeeTypeEdit", message: "Please select employee type." });
                if (!formData.userType) errors.push({ field: "#userTypeEdit", message: "Please select user type." });
                if (!formData.permissions.length) errors.push({ field: "input[name='permissions[]']", message: "Please select at least one permission." });
               
                return errors;
            };

            var validationErrors = validateForm(formData);
            if (validationErrors.length > 0) {
                var firstError = validationErrors[0]; // Get the first error
                $.notify(firstError.message, {
                    className: "error",
                    position: "top center"
                });
                $(firstError.field).focus(); 
                return;
            }

            $.ajax({
                url: "/users/editUserDetails",
                type: "POST",
                data: formData,
                success: function (response) {
                    //alert(response);

                    try {                      
                        if (response == 1) {
                            $.notify("Form submitted", { position: "top center", className: "success" });
                            $('#userForm input, #userForm select').val('').prop('checked', false);
                            $("#usersTable").DataTable().ajax.reload(null, false);
                            $('a[href="#viewUsers"]').click();
                            var contentSection = document.querySelector('.editUserCard');
                            if (contentSection) {
                                contentSection.style.display = 'none';
                            }
                        }
                        else if (response == 2) {
                            $.notify("User already exists", { position: "top center", className: "error" });
                        }
                        else if (response == 3) {
                            $.notify("User data is empty", { position: "top center", className: "error" });
                        }
                        else {
                            $.notify(res.message, { position: "top center", className: "error" });
                        }
                    } catch (e) {
                        console.error("Invalid JSON response:", response);
                        $.notify("Unexpected server response. Check console for details.", { position: "top center", className: "error" });
                    }
                },

                error: function (xhr, status, error) {
                    console.error("AJAX Error:", xhr.responseText);
                    $.notify("An error occurred. Please try again.", { position: "top center", className: "error" });
                }
            });
        });

</script>