<?php extract($data); 
$uuid = $typeDetails['uuid'];
?>
<div id="pageForm">
    <div class="form-group row align-items-center">
        <div class="col-lg-8 col-md-8">
            <label for="typeName">Product Type</label>
            <input type="text" class="form-control" id="typeName" autocomplete="off" placeholder="Enter Product Type" value="<?= $typeDetails['typeName'] ?>">
        </div>
        <div class="col-lg-4 col-md-4 d-flex align-items-center">
            <button type="button" class="btn btn-warning mt-7" id="editData">Update Type</button>
            <button type="button" class="btn btn-primary mt-7 ml-3" id="cancelData">Cancel</button>
        </div>
    </div>
</div>

<script>
     $("#editData").on("click", function(event) {
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
                $.notify("Type updated", {
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
                $('a[href="#addTypeForm"] .nav-text').text('Add Type');
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


    $(document).on('click', '#cancelData', function () {
        $('a[href="#addTypeForm"]').click();
        $('a[href="#addTypeForm"] .nav-text').text('Add Type');
        var dataToSend = {};
        $.post(`${urlroot}/products/addTypes`, dataToSend, function (response) {
            $('#pageForm').html(response);
        });
    });

</script>