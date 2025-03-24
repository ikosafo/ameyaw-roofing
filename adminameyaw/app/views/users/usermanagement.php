<?php 
extract($data);
$uuid = Tools::generateUUID();
?>
<div class="card card-custom" style="width:100%">
    <div class="card-header">
        <div class="card-toolbar">
            <ul class="nav nav-light-primary nav-bold nav-pills">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#addUserForm">
                       <span class="nav-text">Add User</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#viewUsers">
                        <span class="nav-text">View Users</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="addUserForm" role="tabpanel" aria-labelledby="addUserForm">
                
               
                    <!-- <div class="alert alert-danger" id="errorMessage">
                        Your user level does not meet the requirements for this page.
                    </div> -->

                    <div id="userForm">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-6">
                                <label for="fullName">Full Name</label>
                                <input type="text" class="form-control" id="fullName" autocomplete="off" placeholder="Enter Full Name">
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label for="emailAddress">Email Address</label>
                                <input type="text" class="form-control" id="emailAddress" autocomplete="off" placeholder="Enter Email Address">
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label for="phoneNumber">Phone Number</label>
                                <input type="text" class="form-control" id="phoneNumber"
                                maxlength="10" autocomplete="off" placeholder="Enter Phone Number">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-6">
                                <label for="birthDate">Date of Birth</label>
                                <input type="text" class="form-control" id="birthDate" autocomplete="off" placeholder="Select Date of Birth">
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label for="gender">Gender</label>
                                <select id="gender" style="width: 100%" class="form-control">
                                    <option></option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label for="maritalStatus">Marital Status</label>
                                <select id="maritalStatus" style="width: 100%" class="form-control">
                                    <option></option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Engaged">Engaged</option>
                                    <option value="Annulled">Annulled</option>
                                    <option value="Not Disclosed">Not Disclosed</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-6">
                                <label for="jobTitle">Job Title/Position</label>
                                <input type="text" class="form-control" id="jobTitle" autocomplete="off" placeholder="Enter Job Title/Position">
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label for="departments">Department</label>
                                <select id="departments" style="width: 100%" class="form-control">
                                    <option></option>
                                    <option value="Sales and Marketing">Sales and Marketing</option>
                                    <option value="Production/Manufacturing">Production/Manufacturing</option>
                                    <option value="Research and Development (R&D)">Research and Development (R&D)</option>
                                    <option value="Procurement and Supply Chain">Procurement and Supply Chain</option>
                                    <option value="Quality Assurance/Control">Quality Assurance/Control</option>
                                    <option value="Logistics and Distribution">Logistics and Distribution</option>
                                    <option value="Human Resources (HR)">Human Resources (HR)</option>
                                    <option value="Finance and Accounting">Finance and Accounting</option>
                                    <option value="Customer Service">Customer Service</option>
                                    <option value="Maintenance and Repairs">Maintenance and Repairs</option>
                                    <option value="IT and Systems">IT and Systems</option>
                                    <option value="Legal and Compliance">Legal and Compliance</option>
                                    <option value="Management">Management</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <label for="employeeType">Employee Type</label>
                                <select id="employeeType" style="width: 100%" class="form-control">
                                    <option></option>
                                    <option value="Full-Time">Full-Time</option>
                                    <option value="Part-Time">Part-Time</option>
                                    <option value="Contract">Contract</option>
                                    <option value="Intern">Intern</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-6">
                                <label for="userType">User Type</label>
                                <select id="userType" style="width: 100%" class="form-control">
                                    <option></option>
                                    <option value="Regular">Regular</option>
                                    <option value="Administrator">Administrator</option>
                                    <option value="Super Administrator">Super Administrator</option>
                                </select>
                            </div>
                            <div class="col-lg-8 col-md-6">
                                <label for="permissions">Permissions</label>
                                <div id="permissions" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                                    <div>
                                        <input type="checkbox" id="all-permissions" name="permissions[]" value="All Permissions">
                                        <label for="all-permissions">All Permissions</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="productManagement" name="permissions[]" value="Product Management">
                                        <label for="productManagement">Product Management</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="websiteManagement" name="permissions[]" value="Website Management">
                                        <label for="websiteManagement">Website Management</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="inventoryManagement" name="permissions[]" value="Inventory Management">
                                        <label for="inventoryManagement">Inventory Management</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="orderManagement" name="permissions[]" value="Order Management">
                                        <label for="orderManagement">Order Management</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="payments" name="permissions[]" value="Account Management">
                                        <label for="payments">Account Management</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="userManagement" name="permissions[]" value="User Management">
                                        <label for="userManagement">User Management</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="userManagement" name="permissions[]" value="Reporting">
                                        <label for="userManagement">Reporting</label>
                                    </div>
                                    
                                </div>
                            </div>

                        </div>

                       

                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" autocomplete="off" placeholder="Enter username">
                            </div>
                            <div class="col-lg-6 col-md-6 buttonSearchDiv">
                                <label for="password">Password</label><br>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="password" autocomplete="off" placeholder="Enter password">
                                        <div class="input-group-append">
                                            <button class="btn btn-danger" type="button" id="generatePassword">Generate Password</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                                <div class="kt-form__actions">
                                    <button type="button" class="btn btn-facebook" style="border-radius: 0;" id="saveChanges">Save User</button>
                                </div>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="tab-pane fade show" id="viewUsers" role="tabpanel" aria-labelledby="viewUsers">
                <table class="table table-sm table-separate table-head-custom table-checkable" id="usersTable">
                    <thead>
                        <tr>
                            <th class="th-col-30">Full Name</th>
                            <th class="th-col-20">Email</th>
                            <th class="th-col-20">Telephone</th>
                            <th class="th-col-20">Job Title</th>
                            <th class="th-col-20">User Type</th>
                            <th class="th-col-20">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div id="tableActions"></div>
    </div>
</div>



<script>

    $(document).ready(function() {
        function loadPage(url, dbid) {
            $.post(url, { dbid: dbid }, function (response) {
                $('#pageContent').html(response);
            });
        }

        $("#userType").select2({
            placeholder: "Select Type"
        });
        $("#gender").select2({
             placeholder: "Select Gender"
        });
        $("#birthDate").flatpickr({
             placeholder: "Select Date"
        });
        $("#maritalStatus").select2({
            placeholder: "Select Status"
        });
        $("#departments").select2({
            placeholder: "Select Department"
        });
        $("#employeeType").select2({
            placeholder: "Select Type"
        });

        // Function to generate a random password
        function generateRandomPassword(length) {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()_+';
            let password = '';
            for (let i = 0; i < length; i++) {
                password += characters.charAt(Math.floor(Math.random() * characters.length));
            }
            return password;
        }

        // Event listener for the generate password button
        document.getElementById('generatePassword').addEventListener('click', function() {
            const password = generateRandomPassword(12); // Change the number to adjust the password length
            document.getElementById('password').value = password;
        });

     

        $("#saveChanges").click(function () {
            var formData = {
                fullName: $("#fullName").val().trim(),
                email: $("#emailAddress").val().trim(),
                phoneNumber: $("#phoneNumber").val().trim(),
                birthDate: $("#birthDate").val().trim(),
                gender: $("#gender").val(),
                maritalStatus: $("#maritalStatus").val(),
                jobTitle: $("#jobTitle").val().trim(),
                department: $("#departments").val(),
                employeeType: $("#employeeType").val(),
                userType: $("#userType").val(),
                permissions: $("input[name='permissions[]']:checked").map(function () {
                    return this.value;
                }).get(),
                username: $("#username").val().trim(),
                password: $("#password").val().trim(),
                uuid: '<?php echo $uuid ?>'
            };

            var validateForm = function (formData) {
                var errors = [];
                var phoneRegex = /^[0-9]{10}$/;
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!formData.fullName) errors.push({ field: "#fullName", message: "Please enter full name." });
                if (formData.email && !emailRegex.test(formData.email)) errors.push({ field: "#emailAddress", message: "Please enter a valid email address." });
                if (!formData.phoneNumber.match(phoneRegex)) errors.push({ field: "#phoneNumber", message: "Please enter a valid 10-digit phone number." });
                if (!formData.birthDate) errors.push({ field: "#birthDate", message: "Please select date of birth." });
                if (!formData.gender) errors.push({ field: "#gender", message: "Please select gender." });
                if (!formData.maritalStatus) errors.push({ field: "#maritalStatus", message: "Please select marital status." });
                if (!formData.jobTitle) errors.push({ field: "#jobTitle", message: "Please enter job title/position." });
                if (!formData.department) errors.push({ field: "#departments", message: "Please select department." });
                if (!formData.employeeType) errors.push({ field: "#employeeType", message: "Please select employee type." });
                if (!formData.userType) errors.push({ field: "#userType", message: "Please select user type." });
                if (!formData.permissions.length) errors.push({ field: "input[name='permissions[]']", message: "Please select at least one permission." });
                if (!formData.username || formData.username.length < 4) errors.push({ field: "#username", message: "Username must be at least 4 characters long." });
                if (!formData.password) errors.push({ field: "#password", message: "Please generate a password." });

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
                url: "/users/addUser",
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


        var oTable = $('#usersTable').DataTable({
            stateSave: true,
            "bLengthChange": false,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
               'url': '/paginations/listUsers',
                'error': function (xhr, error, code) {
                    console.log("Error: ", error);
                }
            },
            'columns': [
                { data: 'fullName' },
                { data: 'emailAddress' },
                { data: 'telephone' },
                { data: 'jobTitle'},
                { data: 'userType'},
                { data: 'action'}
            ],
            "language": {
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "Showing 0 to 0 of 0 entries",
                "infoFiltered": "(filtered from _MAX_ total entries)",
                "lengthMenu": "Show _MENU_ entries"
            }
        });
        

        $('#usersTable_filter').html(`
            <div class="input-icon">
                <input type="text" id="usersTable_search" class="form-control" placeholder="Search...">
                <span>
                    <i class="flaticon2-search-1 text-muted"></i>
                </span>
            </div>
        `);

        $('#usersTable_search').val(" ").keyup(function() {
            oTable.search($(this).val()).draw();
        });
        oTable.search('').draw();


        $(document).off('click', '.editColumn').on('click', '.editColumn', function(e) {
            e.preventDefault();
            var dbid = $(this).attr('dbid');
            //alert(dbid);
            var dataToSend = { dbid };
            $('html, body').animate({
                scrollTop: $("#tableActions").offset().top
            }, 500);
            $.post(`${urlroot}/users/editUser`, dataToSend, function (response) {
                $('#tableActions').html(response); 
            });
        });


        $(document).off('click', '.deleteColumn').on('click', '.deleteColumn', function() {
            var dbid = $(this).attr('dbid');
        
            var formData = {};
            formData.dbid = dbid; 
        
            $.confirm({
                title: 'Delete Record!',
                content: 'Are you sure to continue?',
                buttons: {
                    no: {
                        text: 'No',
                        keys: ['enter', 'shift'],
                        backdrop: 'static',
                        keyboard: false,
                        action: function() {
                            $.alert('Data is safe');
                        }
                    },
                    yes: {
                        text: 'Yes, Delete it!',
                        btnClass: 'btn-blue',
                        action: function() {
                            saveForm(formData, `${urlroot}/users/deleteUser`, function(response) {
                            $("#usersTable").DataTable().ajax.reload(null, false);
                            $.post(`${urlroot}/users/usermanagement`, {}, function (response) {
                                    $('#pageTable').html(response); 
                                });
                            });
                        }
                    }
                }
            });
        });


        $(document).on('click', '.viewColumn', function () {
            var dbid = $(this).attr('dbid'); 
            var dataToSend = { dbid };
            $('html, body').animate({
                scrollTop: $("#tableActions").offset().top
            }, 500);
            $.post(`${urlroot}/users/viewUsers`, dataToSend, function (response) {
                $('#tableActions').html(response); 
            });
        });

                
    });


</script>






