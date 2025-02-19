<?php 
extract($data); 
$uuid = Tools::generateUUID(); ?>

<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Add Customer Form
        </h3>
    </div>
    <div class="alert alert-custom alert-default" role="alert" style="padding:0 20px !important">
        <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
        <div class="alert-text">
            Fields marked <code>*</code> are required.
        </div>
    </div>
 <!--begin::Form-->
 <form class="form">
    <div class="card-body">
        
        <div id="pageForm">
            <div class="form-group row">
                <label class="col-3 col-form-label">Customer/Client Type <span class="text-danger">*</span></label>
                <div class="col-9 col-form-label">
                    <div class="radio-inline">
                        <label class="radio">
                        <input type="radio" name="clientType" value="Business">
                        <span></span>Business</label>
                        <label class="radio">
                        <input type="radio" name="clientType" value="Individual">
                        <span></span>Individual</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4">
                    <label for="clientName">Client/Business Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="clientName" autocomplete="off" placeholder="Enter Name">
                </div>
                <div class="col-lg-4 col-md-4">
                    <label for="displayName">Display Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="displayName" autocomplete="off" placeholder="Enter Display Name">
                </div>
                <div class="col-lg-4 col-md-4">
                    <label for="clientTelephone">Telephone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="clientTelephone" autocomplete="off" placeholder="Enter Telephone">
                </div>
                
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4">
                    <label for="clientEmail">Email Address</label>
                    <input type="text" class="form-control" id="clientEmail" autocomplete="off" placeholder="Enter Email">
                </div>
                <div class="col-lg-4 col-md-4">
                    <label for="region">Region <span class="text-danger">*</span></label>
                    <select id="region" class="form-control" style="width:100%">
                        <option></option>
                        <option value="Ahafo">Ahafo</option>
                        <option value="Ashanti">Ashanti</option>
                        <option value="Bono">Bono</option>
                        <option value="Bono East">Bono East</option>
                        <option value="Central">Central</option>
                        <option value="Eastern">Eastern</option>
                        <option value="Greater Accra">Greater Accra</option>
                        <option value="North East">North East</option>
                        <option value="Northern">Northern</option>
                        <option value="Oti">Oti</option>
                        <option value="Savannah">Savannah</option>
                        <option value="Upper East">Upper East</option>
                        <option value="Upper West">Upper West</option>
                        <option value="Volta">Volta</option>
                        <option value="Western">Western</option>
                        <option value="Western North">Western North</option>
                    </select>  
                </div>
                <div class="col-lg-4 col-md-4">
                    <label for="city">City <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="city" autocomplete="off" placeholder="Enter City">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12">
                    <label for="address">Address <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="address" placeholder="Enter Address"></textarea>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-12 col-md-12">
                    <label for="siteReport">Attention <span class="text-danger">*</span></label>
                    <textarea class="form-control" rows="10" id="siteReport" placeholder="Enter Report"></textarea>
                </div>
            </div>
            <!-- Contact Persons Section -->
            <div class="form-group row">
                <div class="col-lg-6 col-md-6">
                    <label for="contactPerson">Contact Person Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="contactPerson" placeholder="Enter Contact Person Name">
                </div>
                <div class="col-lg-6 col-md-6">
                    <label for="contactPhone">Contact Person Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="contactPhone" placeholder="Enter Contact Person Phone">
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                <div class="kt-form__actions">
                    <button type="button" class="btn btn-facebook" id="saveData">Save</button>
                </div>
            </div>
        </div>
    </div>
 </form>
 <!--end::Form-->
</div>

<script>

    $("#region").select2({
        placeholder: "Select Region"
    })

    $("#saveData").on("click", function (event) {
        event.preventDefault();

        var formData = {
            clientType: $("input[name='clientType']:checked").val(),
            clientName: $("#clientName").val(),
            clientTelephone: $("#clientTelephone").val(),
            clientEmail: $("#clientEmail").val(),
            region: $("#region").val(),
            siteReport: $("#siteReport").val(),
            city: $("#city").val(),
            address: $("#address").val(),
            contactPerson: $("#contactPerson").val(),
            contactPhone: $("#contactPhone").val(),
            displayName: $("#displayName").val(),
            uuid: '<?php echo $uuid ?>'
        };

        var url = `${urlroot}/orders/saveCustomer`;

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

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var phoneRegex = /^[0-9]{10}$/;

            if (!formData.clientType) { 
                error += "Client Type is required\n";
                $("#clientType").focus();
            }
            if (!formData.clientName) { 
                error += "Client/Business Name is required\n";
                $("#clientName").focus();
            }
            if (!formData.clientTelephone) {
                error += "Telephone is required\n";
                $("#clientTelephone").focus();
            }
            if (formData.clientTelephone && !phoneRegex.test(formData.clientTelephone)) {
                error += "Telephone must be a 10-digit number\n";
                $("#clientTelephone").focus();
            }
            if (formData.clientEmail && !emailRegex.test(formData.clientEmail)) {
                error += "Invalid Email format\n";
                $("#clientEmail").focus();
            }
            if (!formData.region) { 
                error += "Region is required\n";
                $("#region").focus();
            }
            if (!formData.city) { 
                error += "City is required\n";
                $("#city").focus();
            }
            if (!formData.address) { 
                error += "Address is required\n";
                $("#address").focus();
            }
            if (!formData.siteReport) { 
                error += "Attention is required\n";
                $("#siteReport").focus();
            }
            if (!formData.contactPerson) { 
                error += "Contact Person is required\n";
                $("#contactPerson").focus();
            }
            if (!formData.contactPhone) { 
                error += "Contact Phone is required\n";
                $("#contactPhone").focus();
            }
            if (formData.contactPhone && !phoneRegex.test(formData.contactPhone)) {
                error += "Contact Phone must be a 10-digit number\n";
                $("#contactPhone").focus();
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