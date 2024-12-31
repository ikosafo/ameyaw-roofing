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
                        <label for="productName">Product Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="productName" autocomplete="off" 
                        placeholder="Enter Product Name" value="<?= $productDetails['productName'] ?>">
                    </div>
                    <div class="col-lg-4 col-md-4">
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
                    <div class="col-lg-4 col-md-4">
                        <label for="thickness">Thickness (mm)</label>
                        <input type="text" onkeypress="allowTwoDecimalPlaces(event)" class="form-control"
                        value="<?= $productDetails['thickness'] ?>"
                        id="thickness" autocomplete="off" placeholder="Enter thickness in mm">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-4">
                        <label for="materialType">Material Type <span class="text-danger">*</span></label>
                        <select id="materialType" style="width: 100%" class="form-control">
                            <option></option>
                            <option value="Metal Roofing" <?= (strpos($productDetails['materialType'], 'Metal Roofing') !== false) ? 'selected' : '' ?>>Metal Roofing</option>
                            <option value="Asphalt-Based" <?= (strpos($productDetails['materialType'], 'Asphalt-Based') !== false) ? 'selected' : '' ?>>Asphalt-Based</option>
                            <option value="Synthetic/Plastic" <?= (strpos($productDetails['materialType'], 'Synthetic/Plastic') !== false) ? 'selected' : '' ?>>Synthetic/Plastic</option>
                            <option value="Concrete and Clay" <?= (strpos($productDetails['materialType'], 'Concrete and Clay') !== false) ? 'selected' : '' ?>>Concrete and Clay</option>
                            <option value="Others" <?= (strpos($productDetails['materialType'], 'Others') !== false) ? 'selected' : '' ?>>Others</option>
                        </select>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <label for="color">Colour</label>
                        <input type="color" class="form-control" id="color" autocomplete="off" value="<?= $productDetails['color'] ?>" placeholder="Select color">
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <label for="length">Length (m)</label>
                        <input type="text" onkeypress="allowTwoDecimalPlaces(event)" autocomplete="off" id="length" 
                        value="<?= $productDetails['length'] ?>" 
                        name="length" class="form-control" placeholder="Enter length in meters">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-4">
                        <label for="width">Width (m)</label>
                        <input type="text" onkeypress="allowTwoDecimalPlaces(event)" autocomplete="off" 
                        value="<?= $productDetails['width'] ?>" 
                        id="width" name="width" class="form-control" placeholder="Enter width in meters">
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <label for="stockQuantity">Stock Quantity <span class="text-danger">*</span></label>
                        <input type="number" step="1" class="form-control" id="stockQuantity" autocomplete="off"
                            value="<?= $productDetails['stockQuantity'] ?>" 
                        placeholder="Enter stock quantity">
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <label for="price">Price per Unit <span class="text-danger">*</span></label>
                        <input type="text" onkeypress="allowTwoDecimalPlaces(event)" id="price" 
                        value="<?= $productDetails['unitPrice'] ?>"
                        autocomplete="off" name="price" class="form-control" placeholder="Enter price per unit" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-4">
                        <label for="supplier">Supplier</label>
                        <select id="supplier" style="width: 100%" class="form-control">
                            <option></option>

                            <?php foreach ($listSuppliers as $record): ?>
                                <option value="<?= $record->supplierId ?>" 
                                    <?= ($record->supplierId == $productDetails['supplierId']) ? 'selected' : '' ?>>
                                    <?= $record->supplierName ?>
                                </option>
                            <?php endforeach; ?>
                            <option value="0" <?= (strpos($productDetails['supplierId'], '0') !== false) ? 'selected' : '' ?>>Not Applicable</option>
                        </select>
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
    document.getElementById("closeBtn").addEventListener("click", function() {
        var contentSection = document.querySelector('.editProductCard');
        if (contentSection) {
            contentSection.style.display = 'none';
        }
    });

    $("#productCategory").select2({
        placeholder: "Select Category"
    });

    $("#supplier").select2({
        placeholder: "Select Supplier"
    });

    $("#materialType").select2({
        placeholder: "Select Material"
    });

    $("#saveData").on("click", function (event) {
        event.preventDefault();

        var formData = {
            productName: $("#productName").val(),
            productCategory: $("#productCategory").val(),
            thickness: $("#thickness").val(),
            materialType: $("#materialType").val(),
            color: $("#color").val(),
            length: $("#length").val(),
            width: $("#width").val(),
            stockQuantity: $("#stockQuantity").val(),
            price: $("#price").val(),
            supplier: $("#supplier").val(),
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
            if (!formData.stockQuantity || !/^\d+$/.test(formData.stockQuantity)) {
                error += 'Stock Quantity is required and must be a valid positive number\n';
                $("#stockQuantity").focus();
            }
            if (!formData.price || isNaN(formData.price) || parseFloat(formData.price) <= 0) {
                error += 'Price per Unit is required\n';
                $("#price").focus();
            }
            if (!formData.supplier) {
                error += 'Supplier is required\n';
                $("#supplier").focus();
            }

            // Optional fields validation
            if (formData.length && (isNaN(formData.length) || parseFloat(formData.length) <= 0)) {
                error += 'Length must be a positive number if provided\n';
                $("#length").focus();
            }
            if (formData.width && (isNaN(formData.width) || parseFloat(formData.width) <= 0)) {
                error += 'Width must be a positive number if provided\n';
                $("#width").focus();
            }
            if (formData.thickness && (isNaN(formData.thickness) || parseFloat(formData.thickness) <= 0)) {
                error += 'Thickness must be a positive number if provided\n';
                $("#thickness").focus();
            }

            return error;
        };
        saveForm(formData, url, successCallback, validateFormData);
    });
</script>
