<?php 
extract($data); 
$uuid = Tools::generateUUID();
$inspectionid =  $inspectionDetails['inspectionid'];
?>

<div class="card card-custom viewProductCard mt-5">
    <div class="card-header">
        <h3 class="card-title">
            Make Payment for <span class="ml-2 text-uppercase"><strong> <?= $inspectionDetails['clientName'] ?></strong></span>
        </h3>
    </div>

    <!--begin::Form-->
    <form class="form">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">

                        <!-- <div class="col-lg-4 col-md-4">
                                <label for="width">Payment Status</label>
                                <select id="paymentStatus" style="width: 100%;" class="form-control">
                                    <option></option>
                                    <option value="Pending">Pending</option>
                                    <option value="Successful">Successful</option>
                                    <option value="Failed">Failed</option>
                                    <option value="Refunded">Refunded</option>
                                    <option value="Canceled">Canceled</option>
                                </select>
                            </div> -->

                    <div id="pageForm">
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6">
                                <label for="grandTotal">Total Amount to Pay </label>
                                <input type="text" disabled class="form-control form-control-solid form-control-lg" id="grandTotal" 
                                value="<?= number_format(Tools::getTotalPrice($inspectionid),2) ?>" autocomplete="off">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="balance">Balance </label>
                                <input type="text" disabled class="form-control form-control-solid form-control-lg" id="balance" 
                                value="<?= number_format(Tools::getBalance($inspectionid),2) ?>" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6">
                                <label for="rate">Payment Method</label>
                                <select id="paymentMethod" style="width: 100%;" class="form-control">
                                    <option></option>
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
                            <div class="col-lg-6 col-md-6">
                                <label for="amountPaid">Amount Paid</label>
                                <input type="text" class="form-control form-control-lg numeric-field" 
                                id="amountPaid" autocomplete="off" placeholder="Enter Amount">
                            </div>
                            
                        </div> 
                        <div class="form-group row">
                            
                            <div class="col-lg-6 col-md-6">
                                <label for="amountLeft">Amount Left</label>
                                <input type="text" readonly class="form-control form-control-lg numeric-field" 
                                id="amountLeft" autocomplete="off" placeholder="Amount Left">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="changeGiven">Change Given</label>
                                <input type="text" readonly class="form-control form-control-lg numeric-field" 
                                id="changeGiven" autocomplete="off" placeholder="Change Given">
                            </div>
                            
                        </div>

                    </div>
                    <div class="card-footer">
                        <div class="form-group row">
                            <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                                <div class="kt-form__actions">
                                    <button type="button" class="btn btn-facebook" id="saveData">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
        </div>

        
    </form>
</div>

<script>
   $(document).ready(function() {
        $(".numeric-field").on("input", function() {
            let value = $(this).val();
            if (!/^\d*\.?\d{0,2}$/.test(value)) {
                $(this).val(value.slice(0, -1));
            }
        });

        $("#paymentMethod").select2({
            placeholder: "Select Payment Method"
        });

        $("#amountPaid").on("input", function () {
            const totalAmount = parseFloat($("#balance").val().replace(/,/g, "")) || 0;
            const amountPaid = parseFloat($(this).val()) || 0;
            const balanceLeft = totalAmount - amountPaid;
            const changeGiven = balanceLeft < 0 ? Math.abs(balanceLeft).toFixed(2) : "0.00";
            $("#amountLeft").val(balanceLeft.toFixed(2)); 
            $("#changeGiven").val(changeGiven);
        });

        // Handle form submission
        $("#saveData").on("click", function (event) {
            event.preventDefault();
            var formData = {
                amountPaid: $("#amountPaid").val(),
                paymentMethod: $("#paymentMethod").val(),
                changeGiven: $("#changeGiven").val(),
                inspectionid: '<?php echo $inspectionid ?>',
            };

            var url = `${urlroot}/orders/savePayment`;

            var successCallback = function (response) {
                $("#resultTable").DataTable().ajax.reload(null, false);
            };

            var validateFormData = function (formData) {
                var error = '';
                if (!formData.amountPaid) {
                    error += 'Payment Amount is required\n';
                    $("#amountPaid").focus();
                }
                if (!formData.paymentMethod) {
                    error += 'Payment Method is required\n';
                    $("#paymentMethod").focus();
                }
                return error;
            };

            saveForm(formData, url, successCallback, validateFormData);
        });
    });

</script>




 