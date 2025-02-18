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
                        <input type="radio" name="radios6">
                        <span></span>Business</label>
                        <label class="radio">
                        <input type="radio" name="radios6">
                        <span></span>Individual</label>
                        <label class="radio">
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
                    <input type="text" class="form-control" id="clientTelephone" autocomplete="off" placeholder="Enter Client Telephone">
                </div>
                
            </div>
            <div class="form-group row">
                <div class="col-lg-4 col-md-4">
                    <label for="clientEmail">Email Address</label>
                    <input type="text" class="form-control" id="clientEmail" autocomplete="off" placeholder="Enter Client Email">
                </div>
                <div class="col-lg-4 col-md-4">
                    <label for="inspectionDate">Inspection Date <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="inspectionDate" placeholder="Select Date">
                </div>
                <div class="col-lg-4 col-md-4">
                    <label for="inspectorName">Inspector's Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="inspectorName" autocomplete="off" placeholder="Enter Inspector's Name">
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

    $("#inspectionDate").flatpickr();

    $("#saveData").on("click", function (event) {
        event.preventDefault();

        var formData = {
            clientName: $("#clientName").val(),
            clientTelephone: $("#clientTelephone").val(),
            clientEmail: $("#clientEmail").val(),
            siteLocation: $("#siteLocation").val(),
            inspectionDate: $("#inspectionDate").val(),
            inspectorName: $("#inspectorName").val(),
            siteReport: $("#siteReport").val(),
            address: $("#address").val(),
            uuid: '<?php echo $uuid ?>'
        };

        var url = `${urlroot}/orders/saveInspection`;

        var successCallback = function (response) {
                $.notify("Category saved", {
                    position: "top center",
                    className: "success"
                });
                $.post(`${urlroot}/orders/addInspectionForm`, {}, function (response) {
                    $('#pageForm').html(response);
                });

                $.post(`${urlroot}/orders/viewInspections`, {}, function (response) {
                    $('#pageTable').html(response);
                });
                $('a[href="#viewInspections"]').click();
        };

        var validateFormData = function (formData) {
            var error = '';

            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var phoneRegex = /^[0-9]{10}$/;

            if (!formData.clientName) { 
                error += "Client Name is required\n";
                $("#clientName").focus();
            }
            if (!formData.clientTelephone) {
                error += "Client Telephone is required\n";
                $("#clientTelephone").focus();
            }
            if (formData.clientTelephone && !phoneRegex.test(formData.clientTelephone)) {
                error += "Client Telephone must be a 10-digit number\n";
                $("#clientTelephone").focus();
            }
            if (formData.clientEmail && !emailRegex.test(formData.clientEmail)) {
                error += "Invalid Email format\n";
                $("#clientEmail").focus();
            }
            if (!formData.siteLocation) { 
                error += "Site Location is required\n";
                $("#siteLocation").focus();
            }
            if (!formData.inspectionDate) { 
                error += "Inspection Date is required\n";
                $("#inspectionDate").focus();
            }
            if (!formData.inspectorName) { 
                error += "Inspector Name is required\n";
                $("#inspectorName").focus();
            }
            if (!formData.address) { 
                error += "Address is required\n";
                $("#address").focus();
            }
            if (!formData.siteReport) { 
                error += "Attention is required\n";
                $("#siteReport").focus();
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
