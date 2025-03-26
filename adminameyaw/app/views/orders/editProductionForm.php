<?php extract($data);
$inspectionid =  $productionDetails['customerid'];
$uuid =  $productionDetails['uuid'];
$productionid =  $productionDetails['productionid'];
?>

<!--begin::Form-->
<form id="editProductForm" class="form">
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <div id="pageForm" class="card shadow-sm p-3">
                    <div class="form-group">
                        <label for="product">Product <span class="text-danger">*</span></label>
                        <select id="product" class="form-control" required>
                            <option value="">Select a product</option>
                            <?php foreach ($listProducts as $record): ?>
                                <option 
                                    value="<?= $record->productId ?>"
                                    data-material="<?= Tools::getProductTypeName($record->materialType) ?>"
                                    data-category="<?= Tools::getProductCategoryName($record->categoryId) ?>"
                                    <?= ($record->productId == $productionDetails['productid']) ? 'selected' : '' ?>>
                                    <?= $record->productName ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Length and Quantity Inputs -->
                    <div id="lengthQuantityWrapper">
                        <div class="length-quantity-group row mb-2">

                            <!-- Length in Metres -->
                            <div class="col-md-3">
                                <label for="lengthMetres">Length (Metres)</label>
                                <input type="number" id="lengthMetres" 
                                       class="form-control numeric-field length-input" 
                                       placeholder="Enter Length in Metres" 
                                       value="<?= $productionDetails['length'] ?>"
                                       step="0.01" min="0">
                            </div>

                            <!-- Length in Feet -->
                            <div class="col-md-3">
                                <label for="lengthFeet">Length (Feet)</label>
                                <input type="number" id="lengthFeet" 
                                       class="form-control numeric-field length-input" 
                                       placeholder="Enter Length in Feet" 
                                       step="0.01" min="0">
                            </div>

                            <!-- Quantity -->
                            <div class="col-md-4">
                                <label for="quantity">Quantity <span class="text-danger">*</span></label>
                                <input type="number" id="quantity" 
                                       class="form-control" 
                                       placeholder="Enter Quantity" 
                                       min="1" required
                                       value="<?= $productionDetails['quantity'] ?>">
                            </div>

                            <!-- Action Buttons -->
                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" id="editData" class="btn btn-success btn-sm">
                                    Update
                                </button>
                                <button type="button" id="cancelEdit" class="btn btn-default ml-2 btn-sm">
                                    Cancel
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cart Display Section -->
        <div class="row">
            <div class="col-md-12">
                <div id="cartDiv"></div>
            </div>
        </div>
    </div>
</form>



<script>

    $(document).ready(function () {
        $("#lengthMetres").on("input", function () {
            let metres = parseFloat($(this).val()) || 0;
            if (metres > 0) {
                $("#lengthFeet").prop("disabled", true).val("");
            } else {
                $("#lengthFeet").prop("disabled", false);
            }
        });

        $("#lengthFeet").on("input", function () {
            let feet = parseFloat($(this).val()) || 0;
            if (feet > 0) {
                let convertedMetres = (feet * 0.3048).toFixed(2); // Convert feet to metres
                $("#lengthMetres").val(convertedMetres).prop("readonly", true); // Set metres and make readonly
            } else {
                $("#lengthMetres").val("").prop("readonly", false); // Clear and make editable if feet is empty
            }
        });
    });

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
        $("#quantity").on("input", calculateTotal);
    });


    $(document).ready(function () {
        var inspectionid = '<?= $inspectionid ?>'; 
        $.post(`${urlroot}/orders/productionItems`, { inspectionid: inspectionid }, function (response) {
            $('#cartDiv').html(response);
        });


        $("#editData").on("click", function (event) {
            event.preventDefault();

            var formData = {
                product: $("#product").val(),
                length: $("#lengthMetres").val(),
                quantity: $("#quantity").val(),
                uuid: '<?= $uuid ?>',
                productionid: '<?= $productionid ?>',
                inspectionid: inspectionid 
            };
            var url = `${urlroot}/orders/editProduction`;

            var successCallback = function (response) {
                if (response == 2) {
                    $("#pageForm").notify("Product already exists for production", {
                        position: "top center",
                        className: "error"
                    });
                } else {
                    $.notify("Product saved", {
                        position: "top center",
                        className: "success"
                    });

                    var dbid = '<?= $inspectionid ?>'; 
                    var dataToSend = { dbid };
                    $('html, body').animate({
                        scrollTop: $("#pageActions").offset().top
                    }, 500);
                    $.post(`${urlroot}/orders/productionForm`, dataToSend, function (response) {
                        $('#pageActions').html(response); 
                    });

                    // Refresh the cart
                    $.post(`${urlroot}/orders/productionItems`, { inspectionid: inspectionid }, function (response) {
                        $('#cartDiv').html(response);
                    });

                    // Clear the form fields after saving
                    $("#lengthMetres, #lengthFeet, #quantity").val(""); 
                    $("#lengthFeet").prop("disabled", false); 
                    $("#lengthMetres").prop("readonly", false); 

                }
            };

            var validateFormData = function (formData) {
                var error = '';

                if (!formData.product) {
                    error += 'Product is required\n';
                    $("#product").focus();
                }
               
                if (!formData.quantity) {
                    error += 'Quantity is required\n';
                    $("#quantity").focus();
                }

                return error;
            };

            saveForm(formData, url, successCallback, validateFormData);
        });


        $("#cancelEdit").on("click", function (event) {
            event.preventDefault();

            var dbid = '<?= $inspectionid ?>'; 
            var dataToSend = { dbid };
            $('html, body').animate({
                scrollTop: $("#pageActions").offset().top
            }, 500);
            $.post(`${urlroot}/orders/productionForm`, dataToSend, function (response) {
                $('#pageActions').html(response); 
            });

        });
        
    });


    

</script>




 