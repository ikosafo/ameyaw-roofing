<?php 
extract($data); 
$uuid = Tools::generateUUID();
$inspectionid =  $inspectionDetails['inspectionid'];
//$grandTotal = ($inspectionDetails['totalPrice'] + $inspectionDetails['delivery'] + $inspectionDetails['installation']) - $inspectionDetails['discount'];
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

                    <div id="pageForm">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4">
                                <label for="grandTotal">Total Amount to Pay </label>
                                <input type="text" disabled class="form-control form-control-solid form-control-lg" id="grandTotal" 
                                value="<?= number_format(Tools::getTotalPrice($inspectionid),2) ?>" autocomplete="off">
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="width">Payment Status</label>
                                <select id="paymentStatus" style="width: 100%;" class="form-control">
                                    <option></option>
                                    <option value="Pending">Pending</option>
                                    <option value="Successful">Successful</option>
                                    <option value="Failed">Failed</option>
                                    <option value="Refunded">Refunded</option>
                                    <option value="Canceled">Canceled</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4">
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
    <!--end::Form-->
</div>

<script>
    $(document).ready(function() {
        $("#paymentStatus").select2({
            placeholder: "Select Payment Status"
        });

        $("#paymentMethod").select2({
            placeholder: "Select Payment Method"
        });
    });

    $(document).ready(function () {
        $("#saveData").on("click", function (event) {
            event.preventDefault();
            var formData = {
                paymentStatus: $("#paymentStatus").val(),
                paymentMethod: $("#paymentMethod").val(),
                inspectionid: '<?php echo $inspectionid ?>',
            };

            var url = `${urlroot}/orders/savePayment`;

            var successCallback = function (response) {
                $("#resultTable").DataTable().ajax.reload(null, false);
            };

            var validateFormData = function (formData) {
                var error = '';

                if (!formData.paymentStatus) {
                    error += 'Payment Status is required\n';
                    $("#paymentStatus").focus();
                }
                if (!formData.paymentMethod) {
                    error += 'Payment Method is required\n';
                    $("#PaymentMethod").focus();
                }
                return error;
            };

            saveForm(formData, url, successCallback, validateFormData);
        });
    });


</script>




 