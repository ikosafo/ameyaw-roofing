<?php 
extract($data); 
$uuid = $supplierDetails['uuid'];
?>

<div class="card card-custom mt-5 editSupplierCard">
    <div class="card-header">
    <h3 class="card-title">
            Edit <?= $supplierDetails['supplierName'] ?> Supplier 
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
                    <div class="col-lg-4 col-md-4">
                        <label for="supplierName">Supplier or Company Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="supplierName" autocomplete="off" 
                        placeholder="Enter Name of Supplier or Company" value="<?= $supplierDetails['supplierName'] ?>">
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <label for="emailAddress">Email Address </label>
                        <input type="text" class="form-control" id="emailAddress" autocomplete="off"
                         value="<?= $supplierDetails['emailAddress'] ?>" placeholder="Enter Email Address">
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <label for="phoneNumber">Phone Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="phoneNumber" maxlength="10"
                         value="<?= $supplierDetails['phoneNumber'] ?>" autocomplete="off" placeholder="Enter Phone Number" 
                         onkeypress="return allowTwoDecimalPlaces(event)">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-4">
                        <label for="businessAddress">Business Address <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="businessAddress" autocomplete="off" 
                        placeholder="Enter Address"><?= $supplierDetails['businessAddress'] ?></textarea>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <label for="productCategory">Product Category <span class="text-danger">*</span></label>
                        <select id="productCategory" style="width: 100%" class="form-control">
                            <option></option>
                            <?php foreach ($listCategories as $record): ?>
                                <option value="<?= $record->categoryId ?>" 
                                    <?= ($record->categoryId == $supplierDetails['productCategory']) ? 'selected' : '' ?>>
                                    <?= $record->categoryName ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <label for="notes">Notes/Comments</label>
                        <textarea class="form-control" id="notes" autocomplete="off" 
                        placeholder="Enter Notes/Comments"><?= $supplierDetails['notes'] ?></textarea>
                    </div>
                </div>

            </div>
        </div>

        <div class="card-footer">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                    <div class="kt-form__actions">
                        <button type="button" class="btn btn-warning" id="saveData">Update</button>
                        <a href="javascript:void(0);" class="btn btn-light-primary font-weight-bold" id="closeBtn">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--end::Form-->

</div>


<script>
     document.getElementById("closeBtn").addEventListener("click", function() {
        var contentSection = document.querySelector('.editSupplierCard');
        if (contentSection) {
            contentSection.style.display = 'none';
        }
    });

    $("#productCategory").select2({
        placeholder: "Select Category"
    })

    $("#saveData").on("click", function(event) {
        event.preventDefault(); 

        var formData = {
            supplierName: $("#supplierName").val(),
            emailAddress: $("#emailAddress").val(),
            phoneNumber: $("#phoneNumber").val(),
            businessAddress: $("#businessAddress").val(),
            productCategory: $("#productCategory").val(),
            notes: $("#notes").val(),
            uuid: '<?php echo $uuid ?>'
        };
        var url = `${urlroot}/suppliers/saveSuppliers`;

        var successCallback = function(response) {
            if (response == '2') {
                $("#pageForm").notify("Supplier already exists", {
                    position: "top center",
                    className: "error"
                });
            } else {
                $.notify("Supplier saved", {
                    position: "top center",
                    className: "success"
                });
                $.post(`${urlroot}/suppliers/listSuppliers`, dataToSend, function (response) {
                    $('#pageTable').html(response);
                });
            }
            
        };
        var validateFormData = function(formData) {
            var error = '';

            if (!formData.supplierName) {
                error += 'Supplier or Company Name is required.\n';
                $("#supplierName").focus();
            }

            if (formData.emailAddress) {
                var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(formData.emailAddress)) {
                    error += 'Please enter a valid Email Address.\n';
                    $("#emailAddress").focus();
                }
            }

            if (!formData.phoneNumber) {
                error += 'Phone Number is required.\n';
                $("#phoneNumber").focus();
            } else if (!/^\d{10}$/.test(formData.phoneNumber)) {
                error += 'Phone Number must contain only digits and be 10 characters.\n';
                $("#phoneNumber").focus();
            }

            if (!formData.businessAddress) {
                error += 'Business Address is required.\n';
                $("#businessAddress").focus();
            }

            if (!formData.productCategory) {
                error += 'Product Category is required.\n';
                $("#productCategory").focus();
            }

            return error; 
        };

        saveForm(formData, url, successCallback, validateFormData);
    });
</script>