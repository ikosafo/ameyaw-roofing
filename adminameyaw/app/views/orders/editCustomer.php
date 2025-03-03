<?php 
extract($data); 
$uuid = $customerDetails['uuid']; 
echo $uuid;
?>

<div class="card card-custom mt-5">
    <div class="card-header">
        <h3 class="card-title">
            Edit Customer Form - <?= $customerDetails['clientName'] ?>
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
                        <?php $clientType = $customerDetails['clientType'] ?? ''; ?>

                        <label class="radio">
                            <input type="radio" name="clientTypeEdit" value="Business" <?= $clientType === 'Business' ? 'checked' : '' ?> >
                            <span></span>Business
                        </label>

                        <label class="radio">
                            <input type="radio" name="clientTypeEdit" value="Individual" <?= $clientType === 'Individual' ? 'checked' : '' ?> >
                            <span></span>Individual
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4 col-md-4">
                    <label for="clientNameEdit">Client/Business Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="clientNameEdit" autocomplete="off" 
                    placeholder="Enter Name" value="<?= $customerDetails['clientName'] ?? ''; ?>">
                </div>
                <div class="col-lg-4 col-md-4">
                    <label for="displayNameEdit">Display Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="displayNameEdit" autocomplete="off" 
                    placeholder="Enter Display Name" value="<?= $customerDetails['displayName'] ?? ''; ?>">
                </div>
                <div class="col-lg-4 col-md-4">
                    <label for="clientTelephoneEdit">Telephone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="clientTelephoneEdit" autocomplete="off" 
                    placeholder="Enter Telephone" value="<?= $customerDetails['clientTelephone'] ?? ''; ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4 col-md-4">
                    <label for="clientEmailEdit">Email Address</label>
                    <input type="text" class="form-control" id="clientEmailEdit" autocomplete="off" 
                    placeholder="Enter Email" value="<?= $customerDetails['clientEmail'] ?? ''; ?>">
                </div>

                <div class="col-lg-4 col-md-4">
                    <label for="regionEdit">Region <span class="text-danger">*</span></label>
                    <select id="regionEdit" class="form-control" style="width:100%">
                        <option></option>
                        <?php
                        $regions = [
                            "Ahafo", "Ashanti", "Bono", "Bono East", "Central", "Eastern", "Greater Accra", "North East",
                            "Northern", "Oti", "Savannah", "Upper East", "Upper West", "Volta", "Western", "Western North"
                        ];
                        $selectedRegion = $customerDetails['region'] ?? '';
                        foreach ($regions as $region) {
                            $selected = ($region == $selectedRegion) ? 'selected' : '';
                            echo "<option value='" . htmlspecialchars($region) . "' $selected>" . htmlspecialchars($region) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="col-lg-4 col-md-4">
                    <label for="cityEdit">City <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="cityEdit" autocomplete="off" placeholder="Enter City" 
                    value="<?= $customerDetails['city'] ?? ''; ?>">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-4 col-md-4">
                    <label for="siteLocationEdit">Site Location <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="siteLocationEdit" autocomplete="off" 
                    placeholder="Enter Site Location" value="<?= $customerDetails['siteLocation'] ?? ''; ?>">
                </div>
                <div class="col-lg-8 col-md-8">
                    <label for="addressEdit">Address <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="addressEdit" placeholder="Enter Address"> <?= $customerDetails['address'] ?? ''; ?></textarea>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-12 col-md-12">
                    <label for="siteReportEdit">Attention <span class="text-danger">*</span></label>
                    <textarea class="form-control" rows="10" id="siteReportEdit" placeholder="Enter Report"> <?= $customerDetails['siteReport'] ?? ''; ?></textarea>
                </div>
            </div>

            <!-- Contact Persons Section -->
            <div class="form-group row">
                <div class="col-lg-6 col-md-6">
                    <label for="contactPersonEdit">Contact Person Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="contactPersonEdit" 
                    placeholder="Enter Contact Person Name" value="<?= $customerDetails['contactPerson'] ?? ''; ?>">
                </div>

                <div class="col-lg-6 col-md-6">
                    <label for="contactPhoneEdit">Contact Person Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="contactPhoneEdit" 
                    placeholder="Enter Contact Person Phone" value="<?= $customerDetails['contactPhone'] ?? ''; ?>">
                </div>
            </div>

        </div>
    </div>

    <div class="card-footer">
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                <div class="kt-form__actions">
                    <button type="button" class="btn btn-warning" id="saveDataEdit">Update</button>
                </div>
            </div>
        </div>
    </div>
 </form>
 <!--end::Form-->
</div>

<script>

    $("#regionEdit").select2({
        placeholder: "Select Region"
    })

    $("#saveDataEdit").on("click", function (event) {
        event.preventDefault();

        var formData = {
            clientType: $("input[name='clientTypeEdit']:checked").val(),
            clientName: $("#clientNameEdit").val(),
            clientTelephone: $("#clientTelephoneEdit").val(),
            clientEmail: $("#clientEmailEdit").val(),
            region: $("#regionEdit").val(),
            siteReport: $("#siteReportEdit").val(),
            city: $("#cityEdit").val(),
            address: $("#addressEdit").val(),
            contactPerson: $("#contactPersonEdit").val(),
            contactPhone: $("#contactPhoneEdit").val(),
            displayName: $("#displayNameEdit").val(),
            siteLocation: $("#siteLocationEdit").val(),
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
                $("#clientTypeEdit").focus();
            }
            if (!formData.clientName) { 
                error += "Client/Business Name is required\n";
                $("#clientNameEdit").focus();
            }
            if (!formData.clientTelephone) {
                error += "Telephone is required\n";
                $("#clientTelephoneEdit").focus();
            }
            if (formData.clientTelephone && !phoneRegex.test(formData.clientTelephone)) {
                error += "Telephone must be a 10-digit number\n";
                $("#clientTelephoneEdit").focus();
            }
            if (formData.clientEmail && !emailRegex.test(formData.clientEmail)) {
                error += "Invalid Email format\n";
                $("#clientEmailEdit").focus();
            }
            if (!formData.region) { 
                error += "Region is required\n";
                $("#regionEdit").focus();
            }
            if (!formData.city) { 
                error += "City is required\n";
                $("#cityEdit").focus();
            }
            if (!formData.address) { 
                error += "Address is required\n";
                $("#addressEdit").focus();
            }
            if (!formData.siteReport) { 
                error += "Attention is required\n";
                $("#siteReportEdit").focus();
            }
            if (!formData.siteLocation) { 
                error += "Location is required\n";
                $("#siteLocationEdit").focus();
            }
            if (!formData.contactPerson) { 
                error += "Contact Person is required\n";
                $("#contactPersonEdit").focus();
            }
            if (!formData.contactPhone) { 
                error += "Contact Phone is required\n";
                $("#contactPhoneEdit").focus();
            }
            if (formData.contactPhone && !phoneRegex.test(formData.contactPhone)) {
                error += "Contact Phone must be a 10-digit number\n";
                $("#contactPhoneEdit").focus();
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