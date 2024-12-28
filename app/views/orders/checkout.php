<?php include ('includes/header.php');
extract($data);

$encryptionKey = '8FfB$DgF+P!tYw#zKuVmNqRfTjW2x5!@hLgCrX3*pZk67A9Q';

if (isset($_GET['uuid'])) {
    $encryptedUuid = $_GET['uuid'];
    $uuid = Tools::decrypt($encryptedUuid, $encryptionKey);
    $subtotal = Tools::totalPrice($uuid);
}


?>


<div class="content pt-0 flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-top pt-10 mb-10 pb-20">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="font-weight-bolder text-light mb-0">CHECKOUT </h3>
            </div>
        </div>
    </div>

    <div class="container mt-n15 mt-10">
        <div class="flex-row-fluid ml-lg-8">
            <div class="card card-custom card-transparent">
                <div class="card-body p-0">
                    <div class="wizard wizard-4" id="kt_wizard" data-wizard-state="last" data-wizard-clickable="false">
                        <div class="wizard-nav">
                            <div class="wizard-steps" data-total-steps="3">
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="done">
                                    <div class="wizard-wrapper">
                                        <div class="wizard-number">1</div>
                                        <div class="wizard-label">
                                            <div class="wizard-title">Customer Details</div>
                                            <div class="wizard-desc">Setup Address</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="done">
                                    <div class="wizard-wrapper">
                                        <div class="wizard-number">2</div>
                                        <div class="wizard-label">
                                            <div class="wizard-title">Payment</div>
                                            <div class="wizard-desc">Payment Options</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="wizard-step" data-wizard-type="step" data-wizard-state="current">
                                    <div class="wizard-wrapper">
                                        <div class="wizard-number">3</div>
                                        <div class="wizard-label">
                                            <div class="wizard-title">Complete Order</div>
                                            <div class="wizard-desc">Review and Submit</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card card-custom card-shadowless rounded-top-0">
                            <div class="card-body p-0">
                                <div class="row justify-content-center py-8 px-8 py-lg-15 px-lg-10">
                                    <div class="col-xl-12 col-xxl-7">
                                        <form class="form mt-0 mt-lg-10 fv-plugins-bootstrap fv-plugins-framework" id="kt_form">
                                            
                                            <div class="pb-5" data-wizard-type="step-content">
                                                <h4 class="mb-10 font-weight-bold text-dark">Enter Customer Address</h4>

                                                <div id="customerForm">
                                                    <div class="form-group row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="customerName">Full Name <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" id="customerName" value="<?= $orderDetails['customerName'] ?>" placeholder="Full Name">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="customerEmail">Email Address <span class="text-danger">*</span></label>
                                                            <input type="email" class="form-control form-control-solid form-control-lg" id="customerEmail" value="<?= $orderDetails['customerEmail'] ?>" placeholder="Email Address">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="customerPhone">Phone Number <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" id="customerPhone" value="<?= $orderDetails['customerPhone'] ?>" placeholder="Phone Number">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="customerResidence">Residential Address <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" id="customerResidence" value="<?= $orderDetails['customerResidence'] ?>" placeholder="Residence">
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>
                                                <!-- Delivery Mode Selection -->
                                                <div class="form-group">
                                                    <label>Delivery Mode</label>
                                                    <div>
                                                        <label class="mr-3">
                                                            <input type="radio" name="deliveryMode" value="pickup" onclick="toggleDestinationForm(false)" <?= $orderDetails['deliveryMode'] === 'pickup' ? 'checked' : '' ?>> Pickup
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="deliveryMode" value="delivery" onclick="toggleDestinationForm(true)" <?= $orderDetails['deliveryMode'] === 'delivery' ? 'checked' : '' ?>> Delivery
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- Destination Form -->
                                                <div id="destinationForm" style="display: none;">
                                                    <div class="form-group row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="deliveryCost">Delivery Cost <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" id="deliveryCost" onkeypress="allowTwoDecimalPlaces(event)"  value="<?= $orderDetails['deliveryCost'] ?>" placeholder="Enter delivery cost">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="address1">Address Line 1 <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" id="address1" value="<?= $orderDetails['address1'] ?>" placeholder="Address Line 1">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="address2">Address Line 2</label>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" id="address2" value="<?= $orderDetails['address2'] ?>" placeholder="Address Line 2">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="city">City <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" id="city" value="<?= $orderDetails['city'] ?>" placeholder="City">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="region">Region <span class="text-danger">*</span></label><br>
                                                            <select id="region" style="width: 100%;" class="form-control form-control-solid form-control-lg">
                                                                <option value="" disabled <?= empty($orderDetails['region']) ? 'selected' : '' ?>>Select a Region</option>
                                                                <?php
                                                                $regions = [
                                                                    "Ahafo Region", "Ashanti Region", "Bono Region", "Bono East Region", 
                                                                    "Central Region", "Eastern Region", "Greater Accra Region", "North East Region", 
                                                                    "Northern Region", "Oti Region", "Savannah Region", "Upper East Region", 
                                                                    "Upper West Region", "Volta Region", "Western Region", "Western North Region"
                                                                ];
                                                                foreach ($regions as $region) {
                                                                    $selected = $orderDetails['region'] === $region ? 'selected' : '';
                                                                    echo "<option value=\"$region\" $selected>$region</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <!--begin: Wizard Step 2-->
                                            <div class="pb-5" data-wizard-type="step-content">
                                                <h4 class="mb-10 font-weight-bold text-dark">Enter Payment Details</h4>
                                                <div class="form-group row">
                                                    <div class="col-lg-6 col-md-6">
                                                        <label>Amount Due</label>
                                                        <input type="text" class="form-control form-control-solid form-control-lg" value="GHC <?= number_format($subtotal,2) ?>" id="amountDue" onkeypress="allowTwoDecimalPlaces(event)" disabled placeholder="Amount Due">
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <label>Payment Method</label> <br>
                                                        <select id="paymentMethod" style="width: 100%;" class="form-control form-control-solid form-control-lg">
                                                            <option value="" disabled <?= empty($orderDetails['paymentMethod']) ? 'selected' : '' ?>>Select a Method</option>
                                                            <option value="Cash" <?= (strpos($orderDetails['paymentMethod'], 'Cash') !== false) ? 'selected' : '' ?>>Cash</option>
                                                            <option value="Credit/Debit Cards" <?= (strpos($orderDetails['paymentMethod'], 'Credit/Debit Cards') !== false) ? 'selected' : '' ?>>Credit/Debit Cards</option>
                                                            <option value="Digital Wallets" <?= (strpos($orderDetails['paymentMethod'], 'Digital Wallets') !== false) ? 'selected' : '' ?>>Digital Wallets</option>
                                                            <option value="Bank Transfers" <?= (strpos($orderDetails['paymentMethod'], 'Bank Transfers') !== false) ? 'selected' : '' ?>>Bank Transfers</option>
                                                            <option value="Online Payment" <?= (strpos($orderDetails['paymentMethod'], 'Online Payment') !== false) ? 'selected' : '' ?>>Online Payment</option>
                                                            <option value="Mobile Money" <?= (strpos($orderDetails['paymentMethod'], 'Mobile Money') !== false) ? 'selected' : '' ?>>Mobile Money</option>
                                                            <option value="Cheque" <?= (strpos($orderDetails['paymentMethod'], 'Cheque') !== false) ? 'selected' : '' ?>>Cheque</option>
                                                            <option value="Others" <?= (strpos($orderDetails['paymentMethod'], 'Others') !== false) ? 'selected' : '' ?>>Others</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-6 col-md-6">
                                                    <label>Payment Status</label> <br>
                                                        <select id="paymentStatus" style="width: 100%;" class="form-control form-control-solid form-control-lg">
                                                            <option value="" disabled <?= empty($orderDetails['paymentStatus']) ? 'selected' : '' ?>>Select a Status</option>
                                                            <option value="Pending" <?= ($orderDetails['paymentStatus'] === 'Pending') ? 'selected' : '' ?>>Pending</option>
                                                            <option value="Successful" <?= ($orderDetails['paymentStatus'] === 'Successful') ? 'selected' : '' ?>>Successful</option>
                                                            <option value="Failed" <?= ($orderDetails['paymentStatus'] === 'Failed') ? 'selected' : '' ?>>Failed</option>
                                                            <option value="Refunded" <?= ($orderDetails['paymentStatus'] === 'Refunded') ? 'selected' : '' ?>>Refunded</option>
                                                            <option value="Canceled" <?= ($orderDetails['paymentStatus'] === 'Canceled') ? 'selected' : '' ?>>Canceled</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <label>Additional Notes/Comments</label>
                                                        <textarea class="form-control form-control-solid form-control-lg" id="notes" placeholder="Additional notes"><?= $orderDetails['notes'] ?></textarea>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <!--end: Wizard Step 2-->

                                            <!--begin: Wizard Step 3-->
                                            <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                                <h4 class="mb-10 font-weight-bold text-dark">Review Order and Submit</h4>
                                                <h6 class="font-weight-bolder mb-3">Customer Details:</h6>
                                                <div class="text-dark-50 line-height-lg">
                                                    <div id="reviewCustomerName"><?= isset($orderDetails['customerName']) ? $orderDetails['customerName'] : '' ?></div>
                                                    <div id="reviewCustomerEmail"><?= isset($orderDetails['customerEmail']) ? $orderDetails['customerEmail'] : '' ?></div>
                                                    <div id="reviewCustomerPhone"><?= isset($orderDetails['customerPhone']) ? $orderDetails['customerPhone'] : '' ?></div>
                                                    <div id="reviewCustomerResidence"><?= isset($orderDetails['customerResidence']) ? $orderDetails['customerResidence'] : '' ?></div>
                                                </div>

                                                <div class="separator separator-dashed my-5"></div>
                                                <h6 class="font-weight-bolder mb-3">Order Details:</h6>
                                                <div class="text-dark-50 line-height-lg">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th class="pl-0 font-weight-bold text-muted text-uppercase">Ordered Items</th>
                                                                    <th class="text-right font-weight-bold text-muted text-uppercase">Qty</th>
                                                                    <th class="text-right font-weight-bold text-muted text-uppercase">Unit Price (GHC)</th>
                                                                    <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Amount (GHC)</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php foreach ($cartItems as $record): ?>
                                                                <tr class="font-weight-boldest">
                                                                    <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                                                        <?= Tools::getProductName($record->productId) ?>
                                                                    </td>
                                                                    <td class="text-right pt-7 align-middle"><?= $record->quantity ?></td>
                                                                    <td class="text-right pt-7 align-middle"><?= number_format($record->unitPrice,2) ?></td>
                                                                    <td class="text-primary pr-0 pt-7 text-right align-middle"><?= number_format($record->quantity * $record->unitPrice,2) ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>

                                                            <tr>
                                                                <td colspan="2"></td>
                                                                <td class="font-weight-bolder text-right">Subtotal</td>
                                                                <td class="font-weight-bolder text-right pr-0"><?= number_format(Tools::totalPrice($uuid), 2); ?></td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="border-0 pt-0"></td>
                                                                <td class="border-0 pt-0 font-weight-bolder text-right">Delivery Fees</td>
                                                                <td class="border-0 pt-0 font-weight-bolder text-right pr-0">
                                                                    <div id="reviewDeliveryCost">
                                                                        <?= number_format(isset($orderDetails['deliveryCost']) && is_numeric($orderDetails['deliveryCost']) ? (float)$orderDetails['deliveryCost'] : 0.00, 2) ?>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" class="border-0 pt-0"></td>
                                                                <td class="border-0 pt-0 font-weight-bolder font-size-h5 text-right">Total</td>
                                                                <td class="border-0 pt-0 font-weight-bolder font-size-h5 text-success text-right pr-0">
                                                                    GHC <?= number_format(Tools::totalPrice($uuid) + (isset($orderDetails['deliveryCost']) && is_numeric($orderDetails['deliveryCost']) ? (float)$orderDetails['deliveryCost'] : 0.00), 2) ?>
                                                                </td>
                                                            </tr>


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="separator separator-dashed my-5"></div>
                                                <h6 class="font-weight-bolder mb-3">Delivery Service Type:</h6>
                                                <div class="text-dark-50 line-height-lg">
                                                    <div id="reviewDeliveryMode" style="text-transform: uppercase;"><?= isset($orderDetails['deliveryMode']) ? $orderDetails['deliveryMode'] : '' ?> at: </div>
                                                    <div id="reviewAddress1"><?= isset($orderDetails['address1']) ? $orderDetails['address1'] : '' ?></div>
                                                    <div id="reviewAddress2"><?= isset($orderDetails['address2']) ? $orderDetails['address2'] : '' ?></div>
                                                    <div id="reviewCity"><?= isset($orderDetails['city']) ? $orderDetails['city'] : '' ?></div>
                                                    <div id="reviewRegion"><?= isset($orderDetails['region']) ? $orderDetails['region'] : '' ?></div>
                                                </div>
                                            </div>

                                            <!--end: Wizard Step 3-->
                                            <!--begin: Wizard Actions-->
                                            <div class="d-flex justify-content-between border-top mt-5 pt-10">
                                                <div class="mr-2">
                                                    <button type="button" class="btn btn-light-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-prev">Previous</button>
                                                </div>
                                                <div>
                                                    <button type="button" class="btn btn-success font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-submit">Submit</button>
                                                    <button type="button" class="btn btn-primary font-weight-bolder text-uppercase px-9 py-4" data-wizard-type="action-next">Next</button>
                                                </div>
                                            </div>
                                            <!--end: Wizard Actions-->
                                            <div></div><div></div>
                                        </form>
                                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

	
<?php include ('includes/footer.php'); ?>

<script>

    function toggleCustomerForm(isNewCustomer) {
        const customerForm = document.getElementById('customerForm');
        customerForm.style.display = isNewCustomer ? 'block' : 'none';
    }

    function toggleDestinationForm(isDelivery) {
        const destinationForm = document.getElementById('destinationForm');
        destinationForm.style.display = isDelivery ? 'block' : 'none';
    }

    $("#region").select2({
        placeholder : "Select Region"
    })

    $("#paymentMethod").select2({
        placeholder: "Select Method"
    })

    $("#paymentStatus").select2({
        placeholder: "Select Status"
    })

</script>



<script>
    "use strict";

    var KTEcommerceCheckout = function () {
        var _wizardEl;
        var _formEl;
        var _wizardObj;
        var _validations = [];

        var _initWizard = function () {
            _wizardObj = new KTWizard(_wizardEl, {
                startStep: 1,
                clickableSteps: false
            });

            _wizardObj.on('change', function (wizard) {
                if (wizard.getStep() > wizard.getNewStep()) {
                    return;
                }
                var currentStep = wizard.getStep();
            
                if (currentStep == 1) {
                    event.preventDefault();

                    var formData = {
                        customerName: $("#customerName").val(),
                        customerEmail: $("#customerEmail").val(),
                        customerPhone: $("#customerPhone").val(),
                        customerResidence: $("#customerResidence").val(),
                        uuid: '<?php echo $uuid ?>',
                        subtotal: '<?php echo $subtotal ?>',
                        address1: $("#address1").val(),
                        address2: $("#address2").val(),
                        city: $("#city").val(),
                        region: $("#region").val(),
                        deliveryCost: $("#deliveryCost").val(),
                        deliveryMode: $('input[name="deliveryMode"]:checked').val()
                    };

                    var url = `${urlroot}/orders/customerDetails`;

                    var successCallback = function(response) {
                        $.notify("Customer information saved", {
                            position: "top center",
                            className: "success"
                        });
                        wizard.goTo(wizard.getNewStep());
                        KTUtil.scrollTop();
                    };

                    var validateFormData = function(formData) {
                        var error = '';

                        if (!formData.customerName) {
                            error += 'Customer name is required\n';
                            $("#customerName").focus();
                        }
                        if (formData.customerEmail) {
                            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                            if (!emailPattern.test(formData.customerEmail)) {
                                error += 'Please enter a valid Email Address.\n';
                                $("#customerEmail").focus();
                            }
                        }
                        if (!formData.customerPhone) {
                            error += 'Phone Number is required.\n';
                            $("#customerPhone").focus();
                        } else if (!/^\d{10}$/.test(formData.customerPhone)) {
                            error += 'Phone Number must contain only digits and be 10 characters.\n';
                            $("#customerPhone").focus();
                        }
                        if (!formData.customerResidence) {
                            error += 'Residential address is required\n';
                            $("#customerResidence").focus();
                        }

                        var deliveryMode = formData.deliveryMode;
                        if (!deliveryMode) {
                            error += 'Please select a delivery mode.\n';
                            $('input[name="deliveryMode"]').first().focus();
                        } else if (deliveryMode === 'delivery') {
                            if (!formData.address1) {
                                error += 'Address Line 1 is required for delivery.\n';
                                $("#address1").focus();
                            }
                            if (!formData.deliveryCost) {
                                error += 'Delivery Cost is required for delivery.\n';
                                $("#deliveryCost").focus();
                            }
                            if (!formData.city) {
                                error += 'City is required for delivery.\n';
                                $("#city").focus();
                            }
                            if (!formData.region) {
                                error += 'Region is required for delivery.\n';
                                $("#region").focus();
                            }
                        }
                        return error;
                    };

                    saveForm(formData, url, successCallback, validateFormData);
                }

                else if (currentStep == 2) {
                    event.preventDefault();

                    var formData = {
                        paymentMethod: $("#paymentMethod").val(),
                        paymentStatus: $("#paymentStatus").val(),
                        notes: $("#notes").val(),
                        uuid: '<?php echo $uuid ?>'
                    };

                    var url = `${urlroot}/orders/paymentDetails`;

                    var successCallback = function(response) {
                        $.notify("Payment information saved", {
                            position: "top center",
                            className: "success"
                        });
                        wizard.goTo(wizard.getNewStep());
                        KTUtil.scrollTop();
                    };

                    var validateFormData = function(formData) {
                        var error = '';

                        if (!formData.paymentMethod) {
                            error += 'Payment Method is required\n';
                            $("#paymentMethod").focus();
                        }
                        if (!formData.paymentStatus) {
                            error += 'Payment Status is required\n';
                            $("#paymentStatus").focus();
                        }
                        return error;
                    };

                    saveForm(formData, url, successCallback, validateFormData);
                }


               
                return false;
            });

            _wizardObj.on('changed', function (wizard) {
                KTUtil.scrollTop();
            });

            _wizardObj.on('submit', function (wizard) {
               //success message
                $.notify("Form submitted", { 
                        position: "top center",
                        className: "success"
                    });
                    window.location.href = urlroot + "/orders/create";
            });
        }

       
        return {
            init: function () {
                _wizardEl = KTUtil.getById('kt_wizard');
                _formEl = KTUtil.getById('kt_form');

                _initWizard();
            }
        };
    }();

    jQuery(document).ready(function () {
        KTEcommerceCheckout.init();
    });

    function toggleDestinationForm(show) {
        const destinationForm = document.getElementById('destinationForm');
        destinationForm.style.display = show ? 'block' : 'none';
    }

    window.addEventListener('DOMContentLoaded', (event) => {
        const deliveryMode = document.querySelector('input[name="deliveryMode"]:checked');
        if (deliveryMode && deliveryMode.value === 'delivery') {
            toggleDestinationForm(true);
        }
    });

    function updateReviewSection() {
        const customerName = document.getElementById('customerName').value;
        const customerEmail = document.getElementById('customerEmail').value;
        const customerPhone = document.getElementById('customerPhone').value;
        const customerResidence = document.getElementById('customerResidence').value;
        const address1 = document.getElementById('address1').value;
        const address2 = document.getElementById('address2').value;
        const city = document.getElementById('city').value;
        const region = document.getElementById('region').value;
        const deliveryCost = document.getElementById('deliveryCost').value;
        const deliveryMode = document.querySelector('input[name="deliveryMode"]:checked')?.value || '';

        document.getElementById('reviewCustomerName').textContent = customerName || '';
        document.getElementById('reviewCustomerEmail').textContent = customerEmail || '';
        document.getElementById('reviewCustomerPhone').textContent = customerPhone || '';
        document.getElementById('reviewCustomerResidence').textContent = customerResidence || '';
        document.getElementById('reviewAddress1').textContent = address1 || '';
        document.getElementById('reviewAddress2').textContent = address2 || '';
        document.getElementById('reviewCity').textContent = city || '';
        document.getElementById('reviewRegion').textContent = region || '';
        document.getElementById('reviewDeliveryMode').textContent = deliveryMode || '';
        document.getElementById('reviewDeliveryCost').textContent = deliveryCost || '';
    }

    // Add event listeners
    document.getElementById('customerName').addEventListener('input', updateReviewSection);
    document.getElementById('customerEmail').addEventListener('input', updateReviewSection);
    document.getElementById('customerPhone').addEventListener('input', updateReviewSection);
    document.getElementById('customerResidence').addEventListener('input', updateReviewSection);
    document.getElementById('address1').addEventListener('input', updateReviewSection);
    document.getElementById('address2').addEventListener('input', updateReviewSection);
    document.getElementById('city').addEventListener('input', updateReviewSection);
    document.getElementById('region').addEventListener('change', updateReviewSection);
    document.getElementById('deliveryCost').addEventListener('change', updateReviewSection);
    document.querySelectorAll('input[name="deliveryMode"]').forEach((radio) => {
        radio.addEventListener('change', updateReviewSection);
    });

</script>
