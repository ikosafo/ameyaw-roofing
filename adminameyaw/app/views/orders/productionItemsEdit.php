<?php extract($data);
    $encryptionKey = '8FfB$DgF+P!tYw#zKuVmNqRfTjW2x5!@hLgCrX3*pZk67A9Q';
    $encryptedUuid = Tools::encrypt($orderId, $encryptionKey);
?>
<div class="card-body">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>QTY</th>
                    <th>ITEM DESCRIPTION</th>
                    <th>LENGTH (M)</th>
                    <th>RATE</th>
                    <th>ACTION</th>
                </tr>
            </thead>
            <tbody>
                
                <?php foreach ($listProduction as $record): ?>
                    <?php 
                        $productName = Tools::getProductName($record->productid);
                        $rate = Tools::getProductRate($record->productid);
                        $productCategory = Tools::getProductCategoryName(Tools::getCategoryName($record->productid));
                        ?>
                    <tr>
                        <td><?= $record->quantity ?></td>
                        <td><?= $productName. ' - '.$productCategory ?></td>
                        <td><?= $record->length ?></td>
                        <td><?= $rate ?></td>
                        <td>
                            <a href="#" class="btn btn-sm btn-warning editProductionItem font-weight-bolder font-size-sm" 
                                inspectionid="<?= $record->customerid ?>" invoiceid="<?= $record->productionid ?>">
                                Edit
                            </a>
                            <a href="#" class="btn btn-sm btn-danger deleteProductionItem font-weight-bolder font-size-sm" 
                                inspectionid="<?= $record->customerid ?>" invoiceid="<?= $record->productionid ?>">
                                Remove
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
            </tbody>
        </table>
    </div>

    <!-- FORM MOVED HERE -->
    <div id="pageForm">
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="profile">Profile <span class="text-danger">*</span></label>
                <select id="profile" style="width: 100%" class="form-control">
                    <option></option>
                    <?php foreach ($listProfiles as $record): ?>
                        <option value="<?= $record->profileId ?>" 
                            <?= (isset($orderDetails['profileid']) && $orderDetails['profileid'] == $record->profileId) ? 'selected' : '' ?>>
                            <?= $record->profileName ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="materialType">Material Type <span class="text-danger">*</span></label>
                <select id="materialType" style="width: 100%" class="form-control">
                    <option></option>
                    <?php foreach ($listTypes as $record): ?>
                        <option value="<?= $record->typeId ?>" 
                            <?= (isset($orderDetails['materialType']) && $orderDetails['materialType'] == $record->typeId) ? 'selected' : '' ?>>
                            <?= $record->typeName ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="delivery">Delivery Fee<span class="text-danger">*</span></label>
                <input type="text" class="form-control numeric-field" id="delivery" autocomplete="off" 
                placeholder="Enter Delivery" value="<?= $orderDetails['delivery'] ?? '0.00' ?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="installation">Installation Fee<span class="text-danger">*</span></label>
                <input type="text" class="form-control numeric-field" id="installation" autocomplete="off" 
                placeholder="Enter Installation" value="<?= $orderDetails['installation'] ?? '0.00' ?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="discount">Discount <span class="text-danger">*</span></label>
                <input type="text" class="form-control numeric-field" id="discount" autocomplete="off" 
                placeholder="Enter Discount" value="<?= $orderDetails['discount'] ?? '0.00' ?>">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-lg-12 col-md-12">
                <label for="paymentStatus">Payment Status : </label>
                <?php 
                    $paymentStatus = $orderDetails['paymentStatus'] ?? null;
                    $statusText = $paymentStatus ? htmlspecialchars($paymentStatus) : 'Not paid';
                ?>
                <span class="form-status-label <?= $statusText == 'Successful' ? 'text-success' : ($statusText == 'Not paid' ? 'text-danger' : 'text-warning') ?>">
                    <?= $statusText ?>
                </span>
            </div>
        </div>
    </div>

    <div class="text-center pt-10">
        <a href="#" id="checkOut" class="btn btn-success font-weight-bolder px-8">Save</a>
        <a href="#" id="printInvoice" class="btn btn-primary font-weight-bolder px-8" onclick="printInvoice()">Print Invoice</a>
        <a href="#" id="printProduction" class="btn btn-danger font-weight-bolder px-8" onclick="printProduction()">Production Form</a>
        <!-- <?php if ($statusText == 'Successful'): ?>
            <a href="#" id="printProduction" class="btn btn-danger font-weight-bolder px-8" onclick="printProduction()">Production Form</a>
        <?php endif; ?> -->
    </div>

</div>




<script>
    $("#materialType").select2({
        placeholder: "Select Material Type"
    })

    $("#profile").select2({
        placeholder: "Select Profile"
    })

    $(".numeric-field").on("input", function() {
        let value = $(this).val();
        if (!/^\d*\.?\d{0,2}$/.test(value)) {
            $(this).val(value.slice(0, -1));
        }
    });


    $(document).off('click', '.editProductionItem').on('click', '.editProductionItem', function () {
        var productionid = $(this).attr('invoiceid');
        var inspectionid = $(this).attr('inspectionid');

        var dataToSend = { productionid };
        $('html, body').animate({
            scrollTop: $("#productionProductForm").offset().top
        }, 500);
        $.post(`${urlroot}/orders/editProductionForm`, dataToSend, function (response) {
            $('#productionProductForm').html(response); 
        });
    });

    
    $(document).off('click', '.deleteProductionItem').on('click', '.deleteProductionItem', function() {
        var dbid = $(this).attr('invoiceid');
        var inspectionid = $(this).attr('inspectionid');
        var uuid = '<?php echo $uuid ?>';
    
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
                        saveForm(formData, `${urlroot}/orders/deleteProduction`, function(response) {
                            $.post(`${urlroot}/orders/productionItems`, 
                            { 
                                inspectionid: inspectionid,
                                uuid:uuid
                             },
                             function (response) {
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
            inspectionid: '<?php echo $inspectionid ?>',
            uuid: '<?php echo $uuid ?>',
        };

        var url = `${urlroot}/orders/saveInvoiceDetails`;

        var successCallback = function (response) {
            //alert(response);
            $.notify("Details saved", {
                position: "top center",
                className: "success"
            });
            /* const checkoutUrl = `/orders/getproduction?uuid=${encodeURIComponent(encryptedUuid)}`;
            window.location.href = checkoutUrl; */
            $.post(`${urlroot}/orders/invoicing`, dataToSend, function (response) {
                $('#pageTable').html(response);
            });
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


    function printInvoice() {
        const encryptedUuid = '<?= $encryptedUuid ?>';
        window.location.href = `/orders/getinvoice?uuid=${encodeURIComponent(encryptedUuid)}`;
    }

    function printProduction() {
        const encryptedUuid = '<?= $encryptedUuid ?>';
        window.location.href = `/orders/getproduction?uuid=${encodeURIComponent(encryptedUuid)}`;
    }


</script>
