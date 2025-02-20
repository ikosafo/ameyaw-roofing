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
                    <div class="col-lg-6 col-md-6">
                        <label for="productName">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="productName" autocomplete="off" 
                        placeholder="Enter Product Name" value="<?= $productDetails['productName'] ?>">
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <label for="productCategory">Product Category <span class="text-danger">*</span></label>
                        <select id="productCategory" style="width: 100%" class="form-control">
                            <option></option>
                            <?php foreach ($listCategories as $record): ?>
                                <option value="<?= $record->categoryId ?>" 
                                    <?= ($record->categoryId == $productDetails['categoryId']) ? 'selected' : '' ?>>
                                    <?= $record->categoryName ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-lg-6 col-md-6">
                        <label for="materialType">Material Type <span class="text-danger">*</span></label>
                        <select id="materialType" style="width: 100%" class="form-control">
                            <option></option>
                            <?php foreach ($listTypes as $record): ?>
                                <option value="<?= $record->typeId ?>" 
                                    <?= ($record->typeId == $productDetails['materialType']) ? 'selected' : '' ?>>
                                    <?= $record->typeName ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <label for="rate">Rate <span class="text-danger">*</span></label>
                        <input type="text" class="form-control numeric-field" id="rate" autocomplete="off" 
                        placeholder="Enter Rate" value="<?= $productDetails['rate'] ?>">
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

</div>


<script>
    $(".numeric-field").on("input", function() {
        let value = $(this).val();
        if (!/^\d*\.?\d{0,2}$/.test(value)) {
            $(this).val(value.slice(0, -1));
        }
    });


    document.getElementById("closeBtn").addEventListener("click", function() {
        var contentSection = document.querySelector('.editProductCard');
        if (contentSection) {
            contentSection.style.display = 'none';
        }
    });

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
            rate: $("#rate").val(),
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
                $.post(`${urlroot}/products/listProducts`, dataToSend, function (response) {
                    $('#pageTable').html(response);
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
            if (!formData.rate) {
                error += 'Rate is required\n';
                $("#rate").focus();
            }

            return error;
        };
        saveForm(formData, url, successCallback, validateFormData);
    });
</script>
