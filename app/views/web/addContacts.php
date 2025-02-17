<?php 
extract($data); 
$uuid = $contactDetails['uuid'] ?? null; 

if (is_null($uuid)) {
    $uuid = Tools::generateUUID();
}
?>


<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Update Details
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
            <div class="col-lg-6 col-md-6">
                <label for="primaryContact">Primary Phone <span class="text-danger">*</span></label>
                <input type="text" class="form-control" maxlength="10"  id="primaryContact" autocomplete="off" 
                placeholder="Enter Primary Phone Number" value="<?= $contactDetails['primaryPhone'] ?? '' ?>">
            </div>
            <div class="col-lg-6 col-md-6">
                <label for="secondaryContact">Secondary Phone <span class="text-danger">*</span></label>
                <input type="text" class="form-control" maxlength="10"  id="secondaryContact" autocomplete="off" 
                placeholder="Enter Secondary Phone Number" value="<?= $contactDetails['secondaryPhone'] ?? '' ?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-6 col-md-6">
                <label for="location">Location <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="location" autocomplete="off" 
                placeholder="Enter Location" value="<?= $contactDetails['location'] ?? '' ?>">
            </div>
            <div class="col-lg-6 col-md-6">
                <label class="form-label">Logo</label>
                <input id="uploadPic" name="uploadPic" type="file" />
                <input type="hidden" id="selected_file" />
                <p class="my-3"><?= Tools::displayImages($contactDetails['uuid'] ?? '') ?></p>
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

    $('#uploadPic').uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload logo',
        'fileType': 'image/*',
        'multi': false,
        'width': 180,
        'formData': {
            'randno': '<?php echo $uuid ?>'
        },
        'dnd': false,
        'uploadScript': '/web/uploadLogo',
        'onUploadComplete': function(file, data) {
            console.log(data);
            $.notify("Product updated successfully", {
                position: "top center",
                className: "success"
            });

            /* setTimeout(function() {
                location.reload();
            }, 500); */
           
        },
        'onSelect': function(file) {
            $("#selected_file").val('yes');
        },
        'onCancel': function(file) {
            $("#selected_file").val('');
        }
    });



    $("#saveData").on("click", function (event) {
        event.preventDefault();

        var formData = {
            primaryContact: $("#primaryContact").val().trim(),
            secondaryContact: $("#secondaryContact").val().trim(),
            location: $("#location").val().trim(),
            selectedFile: $("#selected_file").val(),
            uuid: '<?php echo $uuid ?>'
        };

        var url = `${urlroot}/web/saveContacts`;

        var successCallback = function (response) {
            if ($("#selected_file").val() === 'yes') {
                $('#uploadPic').uploadifive('upload');
            }

            $.notify("Details updated successfully", {
                position: "top center",
                className: "success"
            });

           /*  setTimeout(function () {
                location.reload();
            }, 500); */
        };

        var validatePhoneNumber = function (number) {
            var phoneRegex = /^[0-9]{10}$/; // Adjust for country-specific formats if needed
            return phoneRegex.test(number);
        };

        var validateFormData = function (formData) {
            var error = '';

            // Check if an image is required (only if no image was previously uploaded)
            var hasExistingImage = '<?= !empty($contactDetails["uuid"]) ?>'; // Convert PHP to JS boolean
            if (formData.selectedFile !== "yes" && !hasExistingImage) {
                error += 'Please upload logo\n';
            }

            if (!formData.primaryContact) {
                error += 'Primary Phone Number is required\n';
                $("#primaryContact").focus();
            } else if (!validatePhoneNumber(formData.primaryContact)) {
                error += 'Invalid Primary Phone Number. It must be 10 digits.\n';
                $("#primaryContact").focus();
            }

            if (!formData.secondaryContact) {
                error += 'Secondary Phone Number is required\n';
                $("#secondaryContact").focus();
            } else if (!validatePhoneNumber(formData.secondaryContact)) {
                error += 'Invalid Secondary Phone Number. It must be 10 digits.\n';
                $("#secondaryContact").focus();
            }

            if (!formData.location) {
                error += 'Location is required\n';
                $("#location").focus();
            }

            return error;
        };


        saveForm(formData, url, successCallback, validateFormData);
    });

</script>
