<?php 
extract($data); 
$uuid = Tools::generateUUID(); ?>

<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            Add Product 
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
            
            <form id="paymentForm">
                <h3>Payment Details</h3>
                
                <div class="form-group row">
                    <div class="col-lg-4 col-md-4">
                        <label>Payment Method</label>
                        <select id="paymentMethod" class="form-control" required>
                            <option value=""></option>
                            <option value="Credit/Debit Card">Credit/Debit Card</option>
                            <option value="Mobile Money">Mobile Money</option>
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Cash">Cash</option>
                        </select>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <label>Amount</label>
                        <input type="number" id="amount" class="form-control" placeholder="Enter Amount" required>
                    </div>

                    <div class="col-lg-4 col-md-4">
                        <label>Currency</label>
                        <select id="currency" class="form-control">
                            <option value="GHS">GHS</option>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                        </select>
                    </div>
                </div>

                <div id="cardDetails" style="display: none;">
                    <h3>Card Payment</h3>
                    <div class="form-group row">
                        <div class="col-lg-4 col-md-4">
                            <label>Card Number</label>
                            <input type="text" id="cardNumber" class="form-control" placeholder="Enter Card Number">
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <label>Expiry Date (MM/YY)</label>
                            <input type="text" id="expiryDate" class="form-control" placeholder="Enter Expiry Date">
                        </div>

                        <div class="col-lg-4 col-md-4">
                            <label>CVV</label>
                            <input type="text" id="cvv" class="form-control" placeholder="Enter CVV">
                        </div>
                    </div>
                </div>

                <div id="mobileMoneyDetails" style="display: none;">
                    <h3>Mobile Money Payment</h3>
                    <div class="form-group row">
                        <div class="col-lg-6 col-md-6">
                            <label>Mobile Money Number</label>
                            <input type="text" id="mobileMoneyNumber" class="form-control" placeholder="Enter Mobile Money Number">
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <label>Provider</label>
                            <select id="mobileMoneyProvider" class="form-control" style="width: 100%;">
                                <option value=""></option>
                                <option value="MTN">MTN</option>
                                <option value="AirtelTigo">AirtelTigo</option>
                                <option value="Telecel">Telecel</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div id="bankTransferDetails" style="display: none;">
                    <h3>Bank Transfer Payment</h3>
                    <div class="form-group row">
                        <div class="col-lg-6 col-md-6">
                            <label>Bank Name</label>
                            <input type="text" id="bankName" class="form-control" placeholder="Enter Bank Name">
                        </div>

                        <div class="col-lg-6 col-md-6">
                            <label>Account Number</label>
                            <input type="text" id="accountNumber" class="form-control" placeholder="Enter Account Number">
                        </div>
                    </div>
                </div>

                <h3>Transaction Details</h3>
                <div class="form-group row">
                    <div class="col-lg-6 col-md-6">
                        <label>Payment Description</label>
                        <textarea id="paymentDescription" class="form-control" placeholder="Enter description or purpose"></textarea>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <label>Reference Number</label>
                        <input type="text" id="referenceNumber" class="form-control" readonly>
                    </div>
                </div>

                <button type="button" id="processPayment" class="btn btn-primary">Submit Payment</button>
            </form>

        </div>

    </form>


    <script>

        $(document).ready(function () {
            $("#paymentMethod").select2({
                placeholder: "Select Payment Method"
            });

            $("#mobileMoneyProvider").select2({
                placeholder: "Select Provider"
            });

            function generateReferenceNumber() {
                return "REF-" + new Date().getTime();
            }
            $("#referenceNumber").val(generateReferenceNumber());

            $("#paymentMethod").change(function () {
                $("#cardDetails, #mobileMoneyDetails, #bankTransferDetails").hide();
                if (this.value === "Credit/Debit Card") {
                    $("#cardDetails").show();
                } else if (this.value === "Mobile Money") {
                    $("#mobileMoneyDetails").show();
                } else if (this.value === "Bank Transfer") {
                    $("#bankTransferDetails").show();
                }
            });

            $("#amount").on("blur", function () {
                let amount = parseFloat($(this).val());
                if (!isNaN(amount)) {
                    $(this).val(amount.toFixed(2));
                }
            });

            $("#processPayment").on("click", function (event) {
                event.preventDefault();

                var formData = {
                    paymentMethod: $("#paymentMethod").val(),
                    amount: $("#amount").val(),
                    currency: $("#currency").val(),
                    referenceNumber: $("#referenceNumber").val(),
                    paymentDescription: $("#paymentDescription").val()
                };

                if (formData.paymentMethod === "Credit/Debit Card") {
                    formData.cardNumber = $("#cardNumber").val();
                    formData.expiryDate = $("#expiryDate").val();
                    formData.cvv = $("#cvv").val();
                } else if (formData.paymentMethod === "Mobile Money") {
                    formData.mobileMoneyNumber = $("#mobileMoneyNumber").val();
                    formData.mobileMoneyProvider = $("#mobileMoneyProvider").val();
                } else if (formData.paymentMethod === "Bank Transfer") {
                    formData.bankName = $("#bankName").val();
                    formData.accountNumber = $("#accountNumber").val();
                }

                var errorMessage = validateFormData(formData);
                if (errorMessage) {
                    $.notify(errorMessage.message,  {position: "top center", className: "error"});
                    $(errorMessage.field).focus();
                    return;
                }

                $.ajax({
                    url: "/payments/savePayment",
                    type: "POST",
                    data: formData,
                    success: function (response) {
                        $.notify("Payment successful!", "success");
                        location.reload();
                    },
                    error: function () {
                        $.notify("Payment failed. Please try again.", "error");
                    }
                });
            });

            function validateFormData(formData) {
                if (formData.paymentMethod === "Credit/Debit Card") {
                    // Expiry date validation (MM/YY)
                    var expiryRegex = /^(0[1-9]|1[0-2])\/\d{2}$/;
                    if (!formData.expiryDate) {
                        return { message: "Please enter expiry date.", field: "#expiryDate" };
                    } else if (!expiryRegex.test(formData.expiryDate)) {
                        return { message: "Expiry date must be in MM/YY format.", field: "#expiryDate" };
                    } else {
                        // Check if expiry date is in the future
                        var parts = formData.expiryDate.split("/");
                        var month = parseInt(parts[0], 10);
                        var year = parseInt("20" + parts[1], 10); // Convert YY to 20YY
                        var currentDate = new Date();
                        var currentYear = currentDate.getFullYear();
                        var currentMonth = currentDate.getMonth() + 1; // getMonth() returns 0-11

                        if (year < currentYear || (year === currentYear && month < currentMonth)) {
                            return { message: "Card expiry date must be in the future.", field: "#expiryDate" };
                        }
                    }

                    // CVV validation (3 or 4 digits)
                    var cvvRegex = /^[0-9]{3,4}$/;
                    if (!formData.cvv) {
                        return { message: "Please enter CVV.", field: "#cvv" };
                    } else if (!cvvRegex.test(formData.cvv)) {
                        return { message: "CVV must be 3 or 4 digits.", field: "#cvv" };
                    }
                }
                if (!formData.paymentMethod) return { message: "Please select a payment method.", field: "#paymentMethod" };
                if (!formData.amount || formData.amount <= 0) return { message: "Please enter a valid amount.", field: "#amount" };
                if (!formData.currency) return { message: "Please select a currency.", field: "#currency" };

                if (formData.paymentMethod === "Credit/Debit Card") {
                    if (!formData.cardNumber) return { message: "Please enter card number.", field: "#cardNumber" };
                    if (!formData.expiryDate) return { message: "Please enter expiry date.", field: "#expiryDate" };
                    if (!formData.cvv) return { message: "Please enter CVV.", field: "#cvv" };
                } else if (formData.paymentMethod === "Mobile Money") {
                    if (!formData.mobileMoneyNumber) return { message: "Please enter mobile money number.", field: "#mobileMoneyNumber" };
                    if (!formData.mobileMoneyProvider) return { message: "Please select a mobile money provider.", field: "#mobileMoneyProvider" };
                } else if (formData.paymentMethod === "Bank Transfer") {
                    if (!formData.bankName) return { message: "Please enter bank name.", field: "#bankName" };
                    if (!formData.accountNumber) return { message: "Please enter account number.", field: "#accountNumber" };
                }
                return null;
            }
        });

    </script>
