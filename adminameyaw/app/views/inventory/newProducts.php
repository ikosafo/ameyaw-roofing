<?php 
extract($data); 
$productId = $productDetails['productId'];
$uuid = $productDetails['uuid'];

?>

<div class="card card-custom editProductCard mt-5">
    <div class="card-header">
        <h3 class="card-title">
            Add New <?= $productDetails['productName'] ?> Product 
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
                        <input type="text" class="form-control" id="productName" autocomplete="off" disabled
                        placeholder="Enter Product Name" value="<?= $productDetails['productName'] ?>">
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <label for="productCategory">Product Category <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="productCategory" autocomplete="off" disabled
                        placeholder="Enter Product Name" value="<?= Tools::getProductCategoryName($productDetails['categoryId']) ?>">
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <label for="stockQuantity">Restock Quantity <span class="text-danger">*</span></label>
                        <input type="number" step="1" class="form-control" id="stockQuantity" autocomplete="off" placeholder="Enter stock quantity">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-4 col-md-4">
                        <label for="price">Price per Unit <span class="text-danger">*</span></label>
                        <input type="text" onkeypress="allowTwoDecimalPlaces(event)" id="price" autocomplete="off" name="price" class="form-control" placeholder="Enter price per unit" required>
                    </div>
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
    $("#supplier").select2({
        placeholder: "Select Supplier"
    }); 

    $("#saveData").on("click", function (event) {
        event.preventDefault();

        var formData = {
            stockQuantity: $("#stockQuantity").val(),
            price: $("#price").val(),
            supplier: $("#supplier").val(),
            productId: '<?php echo $productId ?>',
            uuid: '<?php echo $uuid ?>'
        };

        var url = `${urlroot}/inventory/saveNewProducts`;

        var successCallback = function (response) {
            $.notify("Product saved", {
                position: "top center",
                className: "success"
            });
            $.post(`${urlroot}/inventory/restockProducts`, dataToSend, function (response) {
                $('#pageForm').html(response);
            });
        };

        var validateFormData = function (formData) {
            var error = '';

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

            return error;
        };
        saveForm(formData, url, successCallback, validateFormData);
    });
</script>
