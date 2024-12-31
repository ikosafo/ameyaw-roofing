<?php extract($data); 
$uuid = Tools::generateUUID();
$productId = $productDetails['productId'];
?>

<div class="card card-custom updateStateCard mt-5">
    <div class="card-header">
        <h3 class="card-title">
            Update <?= $productDetails['productName'] ?> State 
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
        
        <div id="pageForm">
            <div class="form-group row">
                <div class="col-lg-4 col-md-4">
                    <label for="productName">Product Name</label>
                    <input type="text" class="form-control" id="productName" autocomplete="off" 
                    placeholder="Enter Product Name" value="<?= $productDetails['productName'] ?>" disabled>
                </div>
                <div class="col-lg-4 col-md-4">
                    <label for="movementType">Movement Type <span class="text-danger">*</span></label>
                    <select id="movementType" style="width: 100%" class="form-control">
                        <option></option>
                        <option value="Added">Added</option>
                        <option value="Removed">Removed</option>
                        <option value="Transfered">Transfered</option>
                        <option value="Scrapped">Scrapped</option>
                        <option value="Repaired">Repaired</option>
                    </select>
                </div>
                <div class="col-lg-4 col-md-4">
                    <label for="quantity">Quantity <span class="text-danger">*</span></label>
                    <input type="number" step="1" class="form-control" id="quantity" autocomplete="off" 
                        placeholder="Enter quantity">
                </div>
            </div>

            <div class="form-group row">
                <div class="col-lg-12 col-md-12">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" rows="4" placeholder="Describe event"></textarea>
                </div>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                <div class="kt-form__actions">
                    <button type="button" class="btn btn-warning" id="saveData">Update</button>
                    <a href="javascript:void(0);" class="btn btn-light-primary font-weight-bold" id="closeBtn">Close</a>
                </div>
            </div>
        </div>
    </div>
 </form>
 <!--end::Form-->
</div>


<script>
    document.getElementById("closeBtn").addEventListener("click", function() {
        var contentSection = document.querySelector('.updateStateCard');
        if (contentSection) {
            contentSection.style.display = 'none';
        }
    });

    $("#movementType").select2({
        placeholder: "Select Movement Type"
    });

    $("#saveData").on("click", function (event) {
        event.preventDefault();

        var formData = {
            movementType: $("#movementType").val(),
            description: $("#description").val(),
            quantity: $("#quantity").val(),
            uuid: '<?php echo $uuid ?>',
            productId: '<?php echo $productId ?>'
        };

        var url = `${urlroot}/inventory/saveState`;

        var successCallback = function (response) {


            if (response.charAt(0) == '1') {
                $.notify("State saved", {
                position: "top center",
                className: "success"
                });
                var contentSection = document.querySelector('.updateStateCard');
                if (contentSection) {
                    contentSection.style.display = 'none';
                }
                $.post(`${urlroot}/inventory/manageInventory`, {}, function (response) {
                    $('#pageTable').html(response);
                });
            } else {
                $.notify(response, {
                    position: "top center",
                    className: "error"
                });
            }


            
        };

        var validateFormData = function (formData) {
            var error = '';
            
            if (!formData.movementType) {
                error += 'Movement Type is required\n';
                $("#movementType").focus();
            }
            if (!formData.quantity || !/^\d+$/.test(formData.quantity)) {
                error += 'Quantity is required and must be a valid positive number\n';
                $("#quantity").focus();
            }
            if (!formData.description) {
                error += 'Description is required\n';
                $("#description").focus();
            }

            return error;
        };
        saveForm(formData, url, successCallback, validateFormData);
    });
</script>
