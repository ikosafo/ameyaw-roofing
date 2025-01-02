<?php include ('includes/header.php');
extract($data);
?>

<div class="content pt-0 flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-top pt-10 mb-10 pb-20">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="font-weight-bolder text-light mb-0">ORDER STATUS</h3>
            </div>
        </div>
    </div>

    <div class="container mt-n15">
        <div class="card card-custom">
            <div class="card-header">
                <h3 class="card-title">
                    Select Status
                </h3>
            </div>

            <form class="form">
                <div class="card-body">
                    
                    <div id="pageForm">
                        <div class="form-group row">
                            <div class="col-lg-4 col-md-4">
                                <label for="orderStatus">Select Status <span class="text-danger">*</span></label>
                                <select id="orderStatus" style="width: 100%" class="form-control">
                                    <option></option>
                                    <option value="All">All</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Successful">Successful</option>
                                    <option value="Failed">Failed</option>
                                    <option value="Refunded">Refunded</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="fullName">Order From</label>
                                <input type="text" class="form-control" id="orderFrom" autocomplete="off" placeholder="Select Date">
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <label for="fullName">Order To</label>
                                <input type="text" class="form-control" id="orderTo" autocomplete="off" placeholder="Select Date">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="form-group row">
                        <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                            <div class="kt-form__actions">
                                <button type="button" class="btn btn-facebook" id="saveData">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <div id="pageTable" class="mt-4"></div>
    </div>
    
</div>


	
<?php include ('includes/footer.php'); ?>

<script>
    $("#orderStatus").select2({
        placeholder: "Select Status"
    })

    $("#orderFrom").flatpickr({
        placeholder: "Select Date"
    })

    $("#orderTo").flatpickr({
        placeholder: "Select Date"
    })

    /* $("#orderStatus").change(function() {
        var orderStatus = $("#orderStatus").val();
        var dataToSend = {orderStatus};
        $.post(`${urlroot}/orders/statusOrders`, dataToSend, function (response) {
            $('#pageTable').html(response);
        });
    }) */


    $("#saveData").on("click", function (event) {
        event.preventDefault();

        var formData = {
            orderStatus: $("#orderStatus").val(),
            orderFrom: $("#orderFrom").val(),
            orderTo: $("#orderTo").val()
        };

        var url = `${urlroot}/orders/statusOrders`;

        var successCallback = function (response) {
            $('#pageTable').html(response);
        };

        var validateFormData = function (formData) {
            var error = '';

            if (!formData.orderStatus) {
                error += 'Status is required\n';
                $("#orderStatus").focus();
            }
            if (!formData.orderFrom) {
                error += 'Date Start is required\n';
                $("#orderFrom").focus();
            }
            if (!formData.orderTo) {
                error += 'Date End is required\n';
                $("#orderTo").focus();
            }
            if (formData.orderTo && formData.orderFrom > formData.orderTo) {
                error += 'Specify appropriate date interval\n';
                $("#orderTo").focus();
            }
    
            return error;
        };
        saveForm(formData, url, successCallback, validateFormData);
    });
</script>
	
