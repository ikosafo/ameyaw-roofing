<?php 
extract($data);
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
                                <input type="text" class="form-control" id="phoneNumber" autocomplete="off" placeholder="Enter Phone Number">
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
                                        <input type="checkbox" id="supplierManagement" name="permissions[]" value="Supplier Management">
                                        <label for="supplierManagement">Supplier Management</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="payments" name="permissions[]" value="Payments">
                                        <label for="payments">Payments</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" id="userManagement" name="permissions[]" value="User Management">
                                        <label for="userManagement">User Management</label>
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
                <table class="table table-sm table-separate table-head-custom table-checkable" id="misUsersTable">
                    <thead>
                        <tr>
                            <th class="th-col-20">MIS User</th>
                            <th class="th-col-20">Username</th>
                            <th class="th-col-20">User Type</th>
                            <th class="th-col-30">Permissions</th>
                            <th class="th-col-20">Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>



<script>

    $(document).ready(function() {

        $("#userType").select2({
            placeholder: "Select Type"
        });

        $("#gender").select2({
             placeholder: "Select Gender"
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

       /*  $("#permissions").select2({
            placeholder: "Select Permission(s)"
        }) */

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

     
        $("#saveChanges").click(function() {
            var formData = {
                fullName: $("#fullName").val(),
                userType : $("#userType").val(),
                permissions : $("#permissions").val(),
                username : $("#username").val(),
                password : $("#password").val()
            };

            var url = "/forms/addUser";
            var successCallback = function(response) {
                //alert(response);
                if (response == 1) {
                    $.notify("Form submitted successfully", {
                        position: "top center",
                        className: "success"
                    });
                    $('#fullName').val('');
                    $('#userType').val('');
                    $('#permissions').val('');
                    $('#username').val('');
                    $('#password').val('');

                    $("#misUsersTable").DataTable().ajax.reload(null, false);
                    $('a[href="#viewUsers"]').click();
                }
                else {
                    $.notify("Username already exists", {
                                position: "top center",
                                className: "error"
                            });
                }
            };

            var validateForm = function(formData) {
                var error = '';
                if (!formData.fullName) {
                    error += 'Please enter full name \n';
                    $("#fullName").focus();
                }
                if (!formData.userType) {
                    error += 'Please select user type \n';
                }
                if (!formData.permissions || formData.permissions.length === 0) {
                    error += 'Please select permission(s) \n';
                    $("#permissions").focus();
                }
                if (!formData.username) {
                    error += 'Please enter username \n';
                    $("#username").focus();
                } else if (formData.username.length < 4) {
                    error += 'Username must be at least 4 characters long \n';
                    $("#username").focus();
                }
                if (!formData.password) {
                    error += 'Please generate password \n';
                    $("#password").focus();
                }
                
                return error;
            };
            saveForm(formData, url, successCallback, validateForm);
        });


        var oTable = $('#misUsersTable').DataTable({
            stateSave: true,
            "bLengthChange": false,
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
               'url': '/paginations/misUsers',
                'error': function (xhr, error, code) {
                    console.log("Error: ", error);
                    //console.log("Code: ", code);
                    //console.log("Response: ", xhr.responseText);
                }
            },
            'columns': [
                { data: 'fullName' },
                { data: 'username' },
                { data: 'userType' },
                { data: 'permissions'},
                { data: 'action'}
            ],
            "language": {
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "Showing 0 to 0 of 0 entries",
                "infoFiltered": "(filtered from _MAX_ total entries)",
                "lengthMenu": "Show _MENU_ entries"
            }
        });

        $('#misUsersTable_filter').html(`
            <div class="input-icon">
                <input type="text" id="misUsersTable_search" class="form-control" placeholder="Search...">
                <span>
                    <i class="flaticon2-search-1 text-muted"></i>
                </span>
            </div>
        `);

        $('#misUsersTable_search').val(" ").keyup(function() {
            oTable.search($(this).val()).draw();
        });

        oTable.search('').draw();


        $(document).on('click', '.deleteBtn', function() {
            var idIndex = $(this).attr('i_index');
           
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
                                var formData = {
                                    i_index: idIndex
                                };
                                var url = "/tables/deletemisUser";
                                var successCallback = function(response) {
                                    if (response == 2) {
                                            $.notify("Your user level does not meet the requirements for deletion.", {
                                            position: "top center",
                                            className: "error" 
                                        });
                                    } else {
                                        $.notify("MIS User has been deleted", {
                                            position: "top center",
                                            className: "success" 
                                        });
                                        $("#misUsersTable").DataTable().ajax.reload(null, false);
                                    }
                                
                                };

                                // Call the saveForm function with form data, URL, success callback, and validation function
                                saveForm(formData, url, successCallback);
                            }
                        }
                    }
                });
        });

                
    });


</script>






