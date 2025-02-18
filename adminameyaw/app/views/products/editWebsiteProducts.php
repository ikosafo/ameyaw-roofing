<?php extract($data); 
$uuid = $productDetails['uuid']
?>

<div class="card card-custom editProductCard mt-5">
    <div class="card-header">
        <h3 class="card-title">
            Edit <?= $productDetails['productName'] ?> Product 
        </h3>
    </div>
    <div class="alert alert-custom alert-default" role="alert" style="padding:0 20px !important">
        <div class="alert-icon"><i class="flaticon-warning text-primary"></i></div>
        <div class="alert-text">
            Fields marked <code>*</code> are required.
        </div>
    </div>

    <form class="form">
        <div class="card-body">
            
            <div id="pageForm">
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4">
                        <label for="productName2">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="productName2" autocomplete="off" 
                        placeholder="Enter Product Name" value="<?= $productDetails['productName'] ?>">
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <label for="productCategory2">Product Category <span class="text-danger">*</span></label>
                        <select id="productCategory2" style="width: 100%" class="form-control">
                            <option></option>
                            <?php foreach ($listCategories as $record): ?>
                                <option value="<?= $record->categoryId ?>" 
                                    <?= ($record->categoryId == $productDetails['categoryId']) ? 'selected' : '' ?>>
                                    <?= $record->categoryName ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4 col-sm-12">
                        <label class="form-label">Product Image</label>
                        <input id="uploadPic2" name="uploadPic2" type="file" />
                        <input type="hidden" id="selected_file2" />
                        <p class="my-3"><?= Tools::displayImages($productDetails['uuid']) ?></p>
                    </div>
                    
                </div>


                <div class="form-group row">

                    <div class="col-lg-12 col-md-12">
                        <label for="description2">Product description2 <span class="text-danger">*</span></label>
                        <textarea id="description2" rows="5"
                        class="form-control" placeholder="Enter Description" required><?= $productDetails['description'] ?></textarea>
                    </div>
                    
                    
                </div>

            </div>
        </div>

        <div class="card-footer">
            <div class="form-group row">
                <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                    <div class="kt-form__actions">
                        <button type="button" class="btn btn-warning" id="saveData2">Update</button>
                        <a href="javascript:void(0);" class="btn btn-light-primary font-weight-bold" id="closeBtn">Close</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>


<script>
    document.getElementById("closeBtn").addEventListener("click", function() {
        var contentSection = document.querySelector('.editProductCard');
        if (contentSection) {
            contentSection.style.display = 'none';
        }
    });

    $("#productCategory2").select2({
        placeholder: "Select Category"
    });

    $('#uploadPic2').uploadifive({
        'auto': false,
        'method': 'post',
        'buttonText': 'Replace picture',
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
            $.notify("Product updated successfully", {
                position: "top center",
                className: "success"
            });

            setTimeout(function() {
                location.reload();
            }, 500);
           
        },
        'onSelect': function(file) {
            $("#selected_file2").val('yes');

        },
        'onCancel': function(file) {
            $("#selected_file2").val('');
        }
    });


    $("#saveData2").on("click", function (event) {
        event.preventDefault();

        var formData = {
            productName: $("#productName2").val(),
            productCategory: $("#productCategory2").val(),
            description: $("#description2").val(),
            price: $("#price2").val(),
            selectedFile: $("#selected_file2").val(),
            uuid: '<?php echo $uuid ?>'
        };

        var url = `${urlroot}/products/saveWebsiteProducts`;

        var successCallback = function (response) {
            if ($("#selected_file2").val() === 'yes') {
                $('#uploadPic2').uploadifive('upload');
            }

            $.notify("Property updated successfully", {
                position: "top center",
                className: "success"
            });

            setTimeout(function() {
                location.reload();
            }, 500);
        };

        var validateFormData = function (formData) {
            var error = '';

            if (!formData.productName) {
                error += 'Product Name is required\n';
                $("#productName2").focus();
            }
            if (!formData.productCategory) {
                error += 'Product Category is required\n';
                $("#productCategory").focus();
            }
            if (!formData.description) {
                error += 'Product description is required\n';
                $("#description2").focus();
            }


            return error;
        };
        saveForm(formData, url, successCallback, validateFormData);
    });
</script>
