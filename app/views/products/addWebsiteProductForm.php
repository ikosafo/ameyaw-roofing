<?php 
extract($data); 
$uuid = Tools::generateUUID(); ?>

<div class="card-custom">
    <div class="">
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
                    <label for="price">Price per Unit <span class="text-danger">*</span></label>
                    <input type="text" onkeypress="allowTwoDecimalPlaces(event)" id="price" autocomplete="off" name="price" class="form-control" placeholder="Enter price per unit" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-lg-8 col-md-8">
                    <label for="description">Product Description <span class="text-danger">*</span></label>
                    <textarea type="text" id="description" rows="5" class="form-control" placeholder="Enter description" required></textarea>
                </div>
                <div class="col-lg-4 col-md-4">
                    <label class="form-label">Product Image</label>
                    <input id="uploadPic" name="uploadPic" type="file" />
                    <input type="hidden" id="selected_file" />
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


    $('#uploadPic').uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Upload image',
        'fileType': 'image/*',
        'multi': false,
        'width': 180,
        'formData': {
            'randno': '<?php echo $uuid ?>'
        },
        'dnd': false,
        'uploadScript': '/products/uploadProductImage',
        'onUploadComplete': function(file, data) {
            console.log(data);
            $.notify("Product saved successfully", {
                position: "top center",
                className: "success"
            });

            setTimeout(function() {
                location.reload();
            }, 1000);

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
            productName: $("#productName").val(),
            productCategory: $("#productCategory").val(),
            description: $("#description").val(),
            price: $("#price").val(),
            selectedFile: $("#selected_file").val(),
            uuid: '<?php echo $uuid ?>'
        };

        var url = `${urlroot}/products/saveWebsiteProducts`;

        var successCallback = function (response) {
            if (response == '2') {
                $.notify("Product already exists", {
                    position: "top center",
                    className: "error"
                });
            } else {
                $('#uploadPic').uploadifive('upload');
            }
        };

        var validateFormData = function (formData) {
            var error = '';

            if (formData.selectedFile != "yes") {
                error += 'Please upload product image\n';
            }
            if (!formData.productName) {
                error += 'Product Name is required\n';
                $("#productName").focus();
            }
            if (!formData.productCategory) {
                error += 'Product Category is required\n';
                $("#productCategory").focus();
            }
            if (!formData.description) {
                error += 'Product Description is required\n';
                $("#description").focus();
            }
            if (!formData.price || isNaN(formData.price) || parseFloat(formData.price) <= 0) {
                error += 'Price per Unit is required\n';
                $("#price").focus();
            }

            return error;
        };
        saveForm(formData, url, successCallback, validateFormData);
    });
</script>
