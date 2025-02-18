<?php 
extract($data); 
$uuid = Tools::generateUUID();
$inspectionid =  $inspectionDetails['inspectionid'];
?>

<div class="card card-custom viewProductCard mt-5">
    <div class="card-header">
        <h3 class="card-title">
            Create Invoice for <span class="ml-2 text-uppercase"><strong> <?= $inspectionDetails['clientName'] ?></strong></span>
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
            <div class="row">
                <div class="col-md-6">

                    <div id="pageForm">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12">
                                <label for="product">Product <span class="text-danger">*</span></label>
                                <select id="product" style="width: 100%" class="form-control">
                                    <option></option>
                                    <?php foreach ($listProducts as $record): ?>
                                        <option 
                                            value="<?= $record->productId ?>"
                                            data-material="<?= Tools::getProductTypeName($record->materialType) ?>"
                                            data-category="<?= Tools::getProductCategoryName($record->categoryId) ?>">
                                            <?= $record->productName ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4">
                                <label for="length">Length <span class="text-danger">*</span></label>
                                <input type="number" class="form-control numeric-field" id="length" autocomplete="off" placeholder="Enter Length" step="0.01" min="0">
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="width">Width <span class="text-danger">*</span></label>
                                <input type="number" class="form-control numeric-field" id="width" autocomplete="off" placeholder="Enter Width" step="0.01" min="0">
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="rate">Rate <span class="text-danger">*</span></label>
                                <input type="number" class="form-control numeric-field" id="rate" autocomplete="off" placeholder="Enter Rate" step="0.01" min="0">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4">
                                <label for="quantity">Quantity <span class="text-danger">*</span></label>
                                <input type="number" class="form-control numeric-field" id="quantity" autocomplete="off" placeholder="Enter Quantity" min="1">
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="totalPrice">Total Price</label>
                                <input type="text" class="form-control" readonly id="totalPrice" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                                <div class="kt-form__actions">
                                    <button type="button" class="btn btn-facebook" id="saveData">Add</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div id="cartDiv"></div>
                </div>

            </div>
            
        </div>

        
    </form>
    <!--end::Form-->
</div>

<script>
    $(document).ready(function() {
        $("#product").select2({
            templateResult: formatProduct,  
            templateSelection: formatSelection,
            placeholder: "Select Product"
        });

        function formatProduct(product) {
            if (!product.id) return product.text;
            let $option = $(product.element);
            let material = $option.data("material");
            let category = $option.data("category");
            return $(`
                <div>
                    <strong style="font-size: 14px;">${product.text}</strong>
                    <div style="font-size: 12px; color: gray;">${material}</div>
                    <div style="color: #007bff; font-weight: bold;">${category}</div>
                </div>
            `);
        }

        function formatSelection(product) {
            return product.text; 
        }

        $(".numeric-field").on("input", function() {
            let value = $(this).val();
            if (!/^\d*\.?\d{0,2}$/.test(value)) {
                $(this).val(value.slice(0, -1));
            }
        });

        function calculateTotal() {
            let rate = parseFloat($("#rate").val()) || 0;
            let quantity = parseInt($("#quantity").val()) || 0;
            let total = (rate * quantity).toFixed(2);
            $("#totalPrice").val(total);
        }

        $("#rate, #quantity").on("input", calculateTotal);
    });

    $(document).ready(function () {
        var inspectionid = '<?= $inspectionid ?>'; 
        $.post(`${urlroot}/orders/cartItems`, { inspectionid: inspectionid }, function (response) {
            $('#cartDiv').html(response);
        });

        $("#saveData").on("click", function (event) {
            event.preventDefault();

            var formData = {
                product: $("#product").val(),
                length: $("#length").val(),
                width: $("#width").val(),
                rate: $("#rate").val(),
                quantity: $("#quantity").val(),
                totalPrice: $("#totalPrice").val(),
                uuid: '<?= $uuid ?>',
                inspectionid: inspectionid 
            };

            var url = `${urlroot}/orders/saveInvoice`;

            var successCallback = function (response) {
                if (response == 2) {
                    $("#pageForm").notify("Product already exists for invoice", {
                        position: "top center",
                        className: "error"
                    });
                } else {
                    $.notify("Product saved", {
                        position: "top center",
                        className: "success"
                    });

                    // Refresh the cart
                    $.post(`${urlroot}/orders/cartItems`, { inspectionid: inspectionid }, function (response) {
                        $('#cartDiv').html(response);
                    });

                    // Clear the form fields after saving
                    $("#product").val(null).trigger('change'); // Reset select2 dropdown
                    $("#length, #width, #rate, #quantity, #totalPrice").val(""); // Clear input fields
                }
            };

            var validateFormData = function (formData) {
                var error = '';

                if (!formData.product) {
                    error += 'Product is required\n';
                    $("#product").focus();
                }
                if (!formData.length) {
                    error += 'Length is required\n';
                    $("#length").focus();
                }
                if (!formData.width) {
                    error += 'Width is required\n';
                    $("#width").focus();
                }
                if (!formData.rate) {
                    error += 'Rate is required\n';
                    $("#rate").focus();
                }
                if (!formData.quantity) {
                    error += 'Quantity is required\n';
                    $("#quantity").focus();
                }

                return error;
            };

            saveForm(formData, url, successCallback, validateFormData);
        });
    });



</script>




 