<?php 
extract($data); 
$uuid = Tools::generateUUID(); ?>

<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Add Product 
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
                    <label for="productName">Product Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="productName" autocomplete="off" placeholder="Enter Product Name">
                </div>
                <div class="col-lg-4 col-md-4">
                    <label for="productCategory">Product Category <span class="text-danger">*</span></label>
                    <select id="productCategory" style="width: 100%" class="form-control">
                        <option></option>
                        <?php foreach ($listCategories as $record): ?>
                            <option value="<?= $record->categoryId ?>"><?= $record->categoryName ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-lg-4 col-md-4">
                    <label for="materialType">Material Type <span class="text-danger">*</span></label>
                    <select id="materialType" style="width: 100%" class="form-control">
                        <option></option>
                        <?php foreach ($listTypes as $record): ?>
                            <option value="<?= $record->typeId ?>"><?= $record->typeName ?></option>
                        <?php endforeach; ?>
                    </select>
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
    $("#productCategory").select2({
        placeholder: "Select Category"
    });


    $("#materialType").select2({
        placeholder: "Select Material"
    });

    $("#saveData").on("click", function (event) {
        event.preventDefault();

        var formData = {
            productName: $("#productName").val(),
            productCategory: $("#productCategory").val(),
            materialType: $("#materialType").val(),
            uuid: '<?php echo $uuid ?>'
        };

        var url = `${urlroot}/products/saveProducts`;

        var successCallback = function (response) {
            if (response == '2') {
                $("#pageForm").notify("Product already exists", {
                    position: "top center",
                    className: "error"
                });
            } else {
                $.notify("Product saved", {
                    position: "top center",
                    className: "success"
                });
                $.post(`${urlroot}/products/addProducts`, {}, function (response) {
                    $('#pageForm').html(response);
                });
            }
        };

        var validateFormData = function (formData) {
            var error = '';

            // Validation for required fields
            if (!formData.productName) {
                error += 'Product Name is required\n';
                $("#productName").focus();
            }
            if (!formData.productCategory) {
                error += 'Product Category is required\n';
                $("#productCategory").focus();
            }
            if (!formData.materialType) {
                error += 'Material Type is required\n';
                $("#materialType").focus();
            }

            return error;
        };
        saveForm(formData, url, successCallback, validateFormData);
    });
</script>
