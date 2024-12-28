<?php include ('includes/header.php');
extract($data);

function decrypt($data, $key) {
    list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
    return openssl_decrypt($encrypted_data, 'aes-256-cbc', $key, 0, $iv);
}

$encryptionKey = '8FfB$DgF+P!tYw#zKuVmNqRfTjW2x5!@hLgCrX3*pZk67A9Q';

if (isset($_GET['uuid']) && isset($_GET['subtotal'])) {
    $encryptedUuid = $_GET['uuid'];
    $encryptedSubtotal = $_GET['subtotal'];

    $uuid = decrypt($encryptedUuid, $encryptionKey);
    $subtotal = "Total: ".decrypt($encryptedSubtotal, $encryptionKey);

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
                                                            <input type="text" class="form-control form-control-solid form-control-lg" id="customerName" name="customerName" placeholder="Full Name">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="customerEmail">Email Address <span class="text-danger">*</span></label>
                                                            <input type="email" class="form-control form-control-solid form-control-lg" id="customerEmail" name="customerEmail" placeholder="Email Address">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="customerPhone">Phone Number <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" id="customerPhone" placeholder="Phone Number">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="customerResidence">Residential Address <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" id="customerResidence" placeholder="Residence">
                                                        </div>
                                                    </div>
                                                </div>

                                                <hr>
                                                <!-- Delivery Mode Selection -->
                                                <div class="form-group">
                                                    <label>Delivery Mode</label>
                                                    <div>
                                                        <label class="mr-3">
                                                            <input type="radio" name="deliveryMode" value="pickup" onclick="toggleDestinationForm(false)"> Pickup
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="deliveryMode" value="delivery" onclick="toggleDestinationForm(true)"> Delivery
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- Destination Form -->
                                                <div id="destinationForm" style="display: none;">
                                                    <div class="form-group row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="address1">Address Line 1</label>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" id="address1" placeholder="Address Line 1">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="address2">Address Line 2</label>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" id="address2" placeholder="Address Line 2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="city">City</label>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" id="city" placeholder="City">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <label for="region">Region</label><br>
                                                            <select id="region" style="width: 100%;" class="form-control form-control-solid form-control-lg">
                                                                <option value="" disabled selected>Select a Region</option>
                                                                <option value="Ahafo Region">Ahafo Region</option>
                                                                <option value="Ashanti Region">Ashanti Region</option>
                                                                <option value="Bono Region">Bono Region</option>
                                                                <option value="Bono East Region">Bono East Region</option>
                                                                <option value="Central Region">Central Region</option>
                                                                <option value="Eastern Region">Eastern Region</option>
                                                                <option value="Greater Accra Region">Greater Accra Region</option>
                                                                <option value="North East Region">North East Region</option>
                                                                <option value="Northern Region">Northern Region</option>
                                                                <option value="Oti Region">Oti Region</option>
                                                                <option value="Savannah Region">Savannah Region</option>
                                                                <option value="Upper East Region">Upper East Region</option>
                                                                <option value="Upper West Region">Upper West Region</option>
                                                                <option value="Volta Region">Volta Region</option>
                                                                <option value="Western Region">Western Region</option>
                                                                <option value="Western North Region">Western North Region</option>
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
                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="amountDue" placeholder="Amount Due">
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                    <label>Payment Method</label> <br>
                                                        <select name="paymentMethod" id="paymentMethod" style="width: 100%;" class="form-control form-control-solid form-control-lg">
                                                            <option value="" disabled selected>Select a Method</option>
                                                            <option value="Cash">Cash</option>
                                                            <option value="Credit/Debit Cards">Credit/Debit Cards</option>
                                                            <option value="Digital Wallets">Digital Wallets</option>
                                                            <option value="Bank Transfers">Bank Transfers</option>
                                                            <option value="Online Payment">Online Payment</option>
                                                            <option value="Mobile Money">Mobile Money</option>
                                                            <option value="Cheque">Cheque</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-lg-6 col-md-6">
                                                    <label>Payment Status</label> <br>
                                                        <select name="paymentStatus" id="paymentStatus" style="width: 100%;" class="form-control form-control-solid form-control-lg">
                                                            <option value="" disabled selected>Select a Method</option>
                                                            <option value="Pending">Pending</option>
                                                            <option value="Successful">Successful</option>
                                                            <option value="Failed">Failed</option>
                                                            <option value="Refunded">Refunded</option>
                                                            <option value="Canceled">Canceled</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6">
                                                        <label>Additional Notes/Comments</label>
                                                        <textarea class="form-control form-control-solid form-control-lg" name="notes" placeholder="Additional notes"></textarea>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <!--end: Wizard Step 2-->
                                            <!--begin: Wizard Step 3-->
                                            <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                                <h4 class="mb-10 font-weight-bold text-dark">Review Order and Submit</h4>
                                                <h6 class="font-weight-bolder mb-3">Customer Details:</h6>
                                                <div class="text-dark-50 line-height-lg">
                                                    <div>// Name here</div>
                                                    <div>// Email address</div>
                                                    <div>// Phone Number</div>
                                                    <div>// Residential Address</div>
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
                                                                    <th class="text-right font-weight-bold text-muted text-uppercase">Unit Price</th>
                                                                    <th class="text-right pr-0 font-weight-bold text-muted text-uppercase">Amount</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="font-weight-boldest">
                                                                    <td class="border-0 pl-0 pt-7 d-flex align-items-center">
                                                                        Street Sneakers
                                                                    </td>
                                                                    <td class="text-right pt-7 align-middle">2</td>
                                                                    <td class="text-right pt-7 align-middle">$90.00</td>
                                                                    <td class="text-primary pr-0 pt-7 text-right align-middle">$180.00</td>
                                                                </tr>
                                                                <tr class="font-weight-boldest border-bottom-0">
                                                                    <td class="border-top-0 pl-0 py-4 d-flex align-items-center">
                                                                        Headphones
                                                                    </td>
                                                                    <td class="border-top-0 text-right py-4 align-middle">1</td>
                                                                    <td class="border-top-0 text-right py-4 align-middle">$449.00</td>
                                                                    <td class="text-primary border-top-0 pr-0 py-4 text-right align-middle">$449.00</td>
                                                                </tr>
                                                                <tr class="font-weight-boldest border-bottom-0">
                                                                    <td class="border-top-0 pl-0 py-4 d-flex align-items-center">
                                                                        Smartwatch
                                                                    </td>
                                                                    <td class="border-top-0 text-right py-4 align-middle">1</td>
                                                                    <td class="border-top-0 text-right py-4 align-middle">$160.00</td>
                                                                    <td class="text-primary border-top-0 pr-0 py-4 text-right align-middle">$160.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"></td>
                                                                    <td class="font-weight-bolder text-right">Subtotal</td>
                                                                    <td class="font-weight-bolder text-right pr-0">$1538.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="border-0 pt-0"></td>
                                                                    <td class="border-0 pt-0 font-weight-bolder text-right">Delivery Fees</td>
                                                                    <td class="border-0 pt-0 font-weight-bolder text-right pr-0">$15.00</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" class="border-0 pt-0"></td>
                                                                    <td class="border-0 pt-0 font-weight-bolder font-size-h5 text-right">Grand Total</td>
                                                                    <td class="border-0 pt-0 font-weight-bolder font-size-h5 text-success text-right pr-0">$1553.00</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="separator separator-dashed my-5"></div>
                                                <h6 class="font-weight-bolder mb-3">Delivery Service Type:</h6>
                                                <div class="text-dark-50 line-height-lg">
                                                    <div>Pickup / Delivery</div>
                                                    <div>// If delivery, details here</div>
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
        placeholder : "Selecr Region"
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
                        address1: $("#address1").val(),
                        address2: $("#address2").val(),
                        city: $("#city").val(),
                        region: $("#region").val(),
                        deliveryMode: $('input[name="deliveryMode"]:checked').val()
                    };

                    var url = `${urlroot}/orders/customerDetails`;

                    var successCallback = function(response) {
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


               
                return false;
            });

            _wizardObj.on('changed', function (wizard) {
                KTUtil.scrollTop();
            });

            _wizardObj.on('submit', function (wizard) {
                Swal.fire({
                    text: "All is good! Please confirm the form submission.",
                    icon: "success",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Yes, submit!",
                    cancelButtonText: "No, cancel",
                    customClass: {
                        confirmButton: "btn font-weight-bold btn-primary",
                        cancelButton: "btn font-weight-bold btn-default"
                    }
                }).then(function (result) {
                    if (result.value) {
                        _formEl.submit();
                    } else if (result.dismiss === 'cancel') {
                        Swal.fire({
                            text: "Your form has not been submitted!.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn font-weight-bold btn-primary",
                            }
                        });
                    }
                });
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
</script>
