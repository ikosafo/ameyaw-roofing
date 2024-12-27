<?php include ('includes/header.php');
extract($data);
$uuid = Tools::generateUUID();
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
                                            <div class="wizard-title">Delivery Address</div>
                                            <div class="wizard-desc">Setup Your Address</div>
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
                                            <div class="wizard-title">Purchase</div>
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
                                                <h4 class="mb-10 font-weight-bold text-dark">Enter Your Address</h4>

                                                <!-- Customer Type Selection -->
                                                <div class="form-group">
                                                    <label>Customer Type</label>
                                                    <div>
                                                        <label class="mr-3">
                                                            <input type="radio" name="customerType" value="new" onclick="toggleCustomerForm(true)"> New Customer
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="customerType" value="returning" onclick="toggleCustomerForm(false)"> Returning Customer
                                                        </label>
                                                    </div>
                                                </div>

                                                <!-- Customer Details Form -->
                                                <div id="customerForm" style="display: none;">
                                                    <div class="form-group">
                                                        <label>Full Name</label>
                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="customerName" placeholder="Full Name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Email Address</label>
                                                        <input type="email" class="form-control form-control-solid form-control-lg" name="customerEmail" placeholder="Email Address">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Phone Number</label>
                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="customerPhone" placeholder="Phone Number">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Residence</label>
                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="customerPhone" placeholder="Residence">
                                                    </div>
                                                </div>

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
                                                    <div class="form-group">
                                                        <label>Address Line 1</label>
                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="address1" placeholder="Address Line 1">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Address Line 2</label>
                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="address2" placeholder="Address Line 2">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Postcode</label>
                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="postcode" placeholder="Postcode">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="city" placeholder="City">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>State</label>
                                                        <input type="text" class="form-control form-control-solid form-control-lg" name="state" placeholder="State">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <select name="country" class="form-control form-control-solid form-control-lg">
                                                            <option value="">Select</option>
                                                            <option value="o1">Option 1</option>
                                                            <option value="o2">Option 2</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!--begin: Wizard Step 2-->
                                            <div class="pb-5" data-wizard-type="step-content">
                                                <h4 class="mb-10 font-weight-bold text-dark">Enter your Payment Details</h4>
                                                <div class="row">
                                                    <div class="col-xl-6">
                                                        <!--begin::Input-->
                                                        <div class="form-group fv-plugins-icon-container has-success">
                                                            <label>Name on Card</label>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="ccname" placeholder="Card Name" value="John Wick">
                                                            <span class="form-text text-muted">Please enter your Card Name.</span>
                                                        <div class="fv-plugins-message-container"></div></div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="col-xl-6">
                                                        <!--begin::Input-->
                                                        <div class="form-group fv-plugins-icon-container has-success">
                                                            <label>Card Number</label>
                                                            <input type="text" class="form-control form-control-solid form-control-lg" name="ccnumber" placeholder="Card Number" value="4444 3333 2222 1111">
                                                            <span class="form-text text-muted">Please enter your Address.</span>
                                                        <div class="fv-plugins-message-container"></div></div>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-4">
                                                        <!--begin::Input-->
                                                        <div class="form-group fv-plugins-icon-container has-success">
                                                            <label>Card Expiry Month</label>
                                                            <input type="number" class="form-control form-control-solid form-control-lg" name="ccmonth" placeholder="Card Expiry Month" value="01">
                                                            <span class="form-text text-muted">Please enter your Card Expiry Month.</span>
                                                        <div class="fv-plugins-message-container"></div></div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <!--begin::Input-->
                                                        <div class="form-group fv-plugins-icon-container has-success">
                                                            <label>Card Expiry Year</label>
                                                            <input type="number" class="form-control form-control-solid form-control-lg" name="ccyear" placeholder="Card Expire Year" value="21">
                                                            <span class="form-text text-muted">Please enter your Card Expiry Year.</span>
                                                        <div class="fv-plugins-message-container"></div></div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <div class="col-xl-4">
                                                        <!--begin::Input-->
                                                        <div class="form-group fv-plugins-icon-container has-success">
                                                            <label>Card CVV Number</label>
                                                            <input type="password" class="form-control form-control-solid form-control-lg" name="cccvv" placeholder="Card CVV Number" value="123">
                                                            <span class="form-text text-muted">Please enter your Card CVV Number.</span>
                                                        <div class="fv-plugins-message-container"></div></div>
                                                        <!--end::Input-->
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end: Wizard Step 2-->
                                            <!--begin: Wizard Step 3-->
                                            <div class="pb-5" data-wizard-type="step-content" data-wizard-state="current">
                                                <!--begin::Section-->
                                                <h4 class="mb-10 font-weight-bold text-dark">Review your Order and Submit</h4>
                                                <h6 class="font-weight-bolder mb-3">Delivery Address:</h6>
                                                <div class="text-dark-50 line-height-lg">
                                                    <div>Address Line 1</div>
                                                    <div>Address Line 2</div>
                                                    <div>Melbourne 3000, VIC, Australia</div>
                                                </div>
                                                <div class="separator separator-dashed my-5"></div>
                                                <!--end::Section-->
                                                <!--begin::Section-->
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
                                                                    <!--begin::Symbol-->
                                                                    <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                                                        <div class="symbol-label" style="background-image: url('../../../../theme/html/demo2/dist/assets/media/products/11.png')"></div>
                                                                    </div>
                                                                    <!--end::Symbol-->
                                                                    Street Sneakers</td>
                                                                    <td class="text-right pt-7 align-middle">2</td>
                                                                    <td class="text-right pt-7 align-middle">$90.00</td>
                                                                    <td class="text-primary pr-0 pt-7 text-right align-middle">$180.00</td>
                                                                </tr>
                                                                <tr class="font-weight-boldest border-bottom-0">
                                                                    <td class="border-top-0 pl-0 py-4 d-flex align-items-center">
                                                                    <!--begin::Symbol-->
                                                                    <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                                                        <div class="symbol-label" style="background-image: url('../../../../theme/html/demo2/dist/assets/media/products/2.png')"></div>
                                                                    </div>
                                                                    <!--end::Symbol-->
                                                                    Headphones</td>
                                                                    <td class="border-top-0 text-right py-4 align-middle">1</td>
                                                                    <td class="border-top-0 text-right py-4 align-middle">$449.00</td>
                                                                    <td class="text-primary border-top-0 pr-0 py-4 text-right align-middle">$449.00</td>
                                                                </tr>
                                                                <tr class="font-weight-boldest border-bottom-0">
                                                                    <td class="border-top-0 pl-0 py-4 d-flex align-items-center">
                                                                    <!--begin::Symbol-->
                                                                    <div class="symbol symbol-40 flex-shrink-0 mr-4 bg-light">
                                                                        <div class="symbol-label" style="background-image: url('../../../../theme/html/demo2/dist/assets/media/products/1.png')"></div>
                                                                    </div>
                                                                    <!--end::Symbol-->
                                                                    Smartwatch</td>
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
                                                <!--end::Section-->
                                                <!--begin::Section-->
                                                <h6 class="font-weight-bolder mb-3">Delivery Service Type:</h6>
                                                <div class="text-dark-50 line-height-lg">
                                                    <div>Overnight Delivery with Regular Packaging</div>
                                                    <div>Preferred Morning (8:00AM - 11:00AM) Delivery</div>
                                                </div>
                                                <!--end::Section-->
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

</script>
	
