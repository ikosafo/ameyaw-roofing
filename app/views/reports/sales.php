<?php include ('includes/header.php');
extract($data);
?>

<div class="content pt-0 flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-top pt-10 mb-10 pb-20">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="font-weight-bolder text-light mb-0">SALES REPORT</h3>
            </div>
        </div>
    </div>

    <div class="container mt-n15">
        <div class="card card-custom">
            

            <form class="form">
                <div class="card-body">
                    
                    <div id="pageForm">
                        <div class="form-group row">
                            <div class="col-lg-6 col-md-6">
                                <label for="fullName">Sales From</label>
                                <input type="text" class="form-control" id="salesFrom" autocomplete="off" placeholder="Select Date">
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <label for="fullName">Sales To</label>
                                <input type="text" class="form-control" id="salesTo" autocomplete="off" placeholder="Select Date">
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

    $("#salesFrom").flatpickr({
        placeholder: "Select Date"
    })

    $("#salesTo").flatpickr({
        placeholder: "Select Date"
    })

 


    $("#saveData").on("click", function (event) {
        event.preventDefault();

        var formData = {
            salesFrom: $("#salesFrom").val(),
            salesTo: $("#salesTo").val()
        };

        var url = `${urlroot}/reports/sales`;

        var successCallback = function (response) {
            $('#pageTable').html(response);
        };

        var validateFormData = function (formData) {
            var error = '';

            if (!formData.salesFrom) {
                error += 'Date Start is required\n';
                $("#salesFrom").focus();
            }
            if (!formData.salesTo) {
                error += 'Date End is required\n';
                $("#salesTo").focus();
            }
            if (formData.salesTo && formData.salesFrom > formData.salesTo) {
                error += 'Specify appropriate date interval\n';
                $("#salesTo").focus();
            }
    
            return error;
        };
        saveForm(formData, url, successCallback, validateFormData);
    });
</script>
	
