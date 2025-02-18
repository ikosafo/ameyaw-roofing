<?php $uuid = Tools::generateUUID(); ?>
<div id="pageForm">
    <div class="form-group row align-items-center">
        <div class="col-lg-8 col-md-8">
            <label for="typeName">Product Type</label>
            <input type="text" class="form-control" id="typeName" autocomplete="off" placeholder="Enter Product Type">
        </div>
        <div class="col-lg-4 col-md-4 d-flex align-items-center">
            <button type="button" class="btn btn-facebook mr-2 mt-7" id="saveData">Save Type</button>
        </div>
    </div>
</div>

<script>
    $("#saveData").on("click", function(event) {
        event.preventDefault(); 

        var formData = {
            typeName: $("#typeName").val(),
            uuid: '<?php echo $uuid ?>'
        };
        var url = `${urlroot}/products/saveTypes`;

        var successCallback = function(response) {
            if (response == '2') {
                $("#pageForm").notify("Type already exists", {
                    position: "top center",
                    className: "error"
                });
            } else {
                $.notify("Type saved", {
                    position: "top center",
                    className: "success"
                });
                $.post(`${urlroot}/products/addTypes`, {}, function (response) {
                    $('#pageForm').html(response);
                });
                $.post(`${urlroot}/products/viewTypes`, {}, function (response) {
                    $('#pageTable').html(response);
                });
                $('a[href="#viewTypes"]').click();
            }
           
        };
        var validateFormData = function(formData) {
            var error = '';
            if (!formData.typeName) {
                error += 'Product Type is required\n';
                $("#typeName").focus();
            }
            return error;
        };
        saveForm(formData, url, successCallback, validateFormData);
    });
</script>