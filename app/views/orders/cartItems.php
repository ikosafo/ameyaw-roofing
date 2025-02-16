<?php extract($data);
$encryptionKey = '8FfB$DgF+P!tYw#zKuVmNqRfTjW2x5!@hLgCrX3*pZk67A9Q';
$encryptedUuid = Tools::encrypt($inspectionid, $encryptionKey);
?>
<div class="card-body">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th width="50%">PRODUCT DETAILS</th>
                    <th class="text-right" colspan="2" width="20%">TOTAL PRICE (GHC)</th>
                </tr>
            </thead>
            <tbody>
                <?php $subtotal = 0; ?>
                <?php foreach ($listInvoice as $record): ?>
                    <?php 
                        $productName = Tools::getProductName($record->productid);
                        $subtotal += $record->totalPrice;
                    ?>
                    
                    <tr>
                        <td class="font-weight-bolder">
                            <div class="d-flex flex-column py-2 w-100">
                                <span class="text-dark-75 font-weight-bold text-hover-primary font-size-lg mb-1">
                                    <?= $productName ?>
                                </span>
                                <span class="text-muted font-weight-bold">Length: <?= $record->length ?></span>
                                <span class="text-muted font-weight-bold">Width: <?= $record->width ?></span>
                                <span class="text-muted font-weight-bold">Rate: GHC <?= number_format($record->rate, 2) ?></span>
                                <span class="text-muted font-weight-bold">Quantity: <?= $record->quantity ?></span>
                            </div>
                        </td>
                        <td class="text-right align-middle font-weight-bolder font-sm">
                            <span class="total-price"><?= number_format($record->totalPrice, 2) ?></span>
                        </td>
                        <td class="text-right align-middle">
                            <a href="#" class="btn btn-sm btn-danger deleteCartItem font-weight-bolder font-size-sm" 
                                inspectionid="<?= $record->inspectionid ?>" invoiceid="<?= $record->invoiceid ?>">
                                Remove
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
                <tr>
                    <td class="font-weight-bolder font-size-h4 text-right">Subtotal</td>
                    <td class="font-weight-bolder font-size-h4 text-right" colspan="2">
                        <span id="subtotalPrice">GHC <?= number_format($subtotal, 2) ?></span>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" class="border-0 text-muted text-right pt-0">Excludes Taxes, Discounts</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- FORM MOVED HERE -->
    <div id="pageForm">
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="profile">Profile <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="profile" autocomplete="off" 
                placeholder="Enter Profile" value="<?= $inspectionDetails['profile'] ?? '' ?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="materialType">Main Material Type <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="materialType" autocomplete="off" 
                placeholder="Enter Main Material Type" value="<?= $inspectionDetails['materialType'] ?? '' ?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="delivery">Delivery Fee<span class="text-danger">*</span></label>
                <input type="text" class="form-control numeric-field" id="delivery" autocomplete="off" 
                placeholder="Enter Delivery" value="<?= $inspectionDetails['delivery'] ?? '0.00' ?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="installation">Installation Fee<span class="text-danger">*</span></label>
                <input type="text" class="form-control numeric-field" id="installation" autocomplete="off" 
                placeholder="Enter Installation" value="<?= $inspectionDetails['installation'] ?? '0.00' ?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="discount">Discount <span class="text-danger">*</span></label>
                <input type="text" class="form-control numeric-field" id="discount" autocomplete="off" 
                placeholder="Enter Discount" value="<?= $inspectionDetails['discount'] ?? '0.00' ?>">
            </div>
        </div>
    </div>

    <div class="text-right pt-10">
        <a href="#" id="checkOut" class="btn btn-success font-weight-bolder px-8">Proceed to Checkout</a>
    </div>
</div>




<script>

    $(".numeric-field").on("input", function() {
        let value = $(this).val();
        if (!/^\d*\.?\d{0,2}$/.test(value)) {
            $(this).val(value.slice(0, -1));
        }
    });
    
    $(document).off('click', '.deleteCartItem').on('click', '.deleteCartItem', function() {
        var dbid = $(this).attr('invoiceid');
        var inspectionid = $(this).attr('inspectionid');
    
        var formData = { dbid: dbid };

        $.confirm({
            title: 'Delete Record!',
            content: 'Are you sure to continue?',
            buttons: {
                no: {
                    text: 'No',
                    keys: ['enter', 'shift'],
                    backdrop: 'static',
                    keyboard: false,
                    action: function() {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function() {
                        saveForm(formData, `${urlroot}/orders/deleteInvoice`, function(response) {
                            $.post(`${urlroot}/orders/cartItems`, { inspectionid: inspectionid }, function (response) {
                                $('#cartDiv').html(response);
                                
                                // Scroll to the bottom after updating the cart
                                $('html, body').animate({ scrollTop: $(document).height() }, 'slow');
                            });
                        });
                    }
                }
            }
        });
    });


    $("#checkOut").on("click", function (event) {
        event.preventDefault();
        const encryptedUuid = '<?= $encryptedUuid ?>';

        var formData = {
            profile: $("#profile").val().trim(),
            materialType: $("#materialType").val().trim(),
            delivery: $("#delivery").val().trim(),
            installation: $("#installation").val(),
            discount: $("#discount").val(),
            inspectionid: '<?php echo $inspectionid ?>'
        };

        var url = `${urlroot}/orders/saveInvoiceDetails`;

        var successCallback = function (response) {
            //alert(response);
            const checkoutUrl = `/orders/getinvoice?uuid=${encodeURIComponent(encryptedUuid)}`;
            window.location.href = checkoutUrl;
        };

        var validateFormData = function (formData) {
            var error = '';

            if (!formData.profile) {
                error += 'Profile is required\n';
                $("#profile").focus();
            }
            if (!formData.materialType) {
                error += 'Material Type is required\n';
                $("#materialType").focus();
            }
            if (!formData.delivery) {
                error += 'Delivery is required\n';
                $("#delivery").focus();
            }
            if (!formData.installation) {
                error += 'Installation is required\n';
                $("#installation").focus();
            }
            if (!formData.discount) {
                error += 'Discount is required\n';
                $("#discount").focus();
            }

            return error;
        };


        saveForm(formData, url, successCallback, validateFormData);
    });


</script>
