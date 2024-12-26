<?php $uuid = Tools::generateUUID(); ?>
<div id="pageForm">
    <div class="form-group row align-items-center">
        <div class="col-lg-8 col-md-8">
            <label for="fullName">Category Name</label>
            <input type="text" class="form-control" id="categoryName" autocomplete="off" placeholder="Enter Category Name">
        </div>
        <div class="col-lg-4 col-md-4 d-flex align-items-center">
            <button type="button" class="btn btn-facebook mr-2 mt-7" id="saveData">Save Category</button>
        </div>
    </div>
</div>

<script>
    $("#saveData").on("click", function(event) {
        event.preventDefault(); 

        var formData = {
            categoryName: $("#categoryName").val(),
            uuid: '<?php echo $uuid ?>'
        };
        var url = `${urlroot}/products/saveCategories`;

        var successCallback = function(response) {
            if (response == '2') {
                $("#pageForm").notify("Category already exists", {
                    position: "top center",
                    className: "error"
                });
            } else {
                $.notify("Category saved", {
                    position: "top center",
                    className: "success"
                });
                $.post(`${urlroot}/products/addCategories`, {}, function (response) {
                    $('#pageForm').html(response);
                });
                $.post(`${urlroot}/products/viewCategories`, {}, function (response) {
                    $('#pageTable').html(response);
                });
                $('a[href="#viewCategories"]').click();
            }
           
        };
        var validateFormData = function(formData) {
            var error = '';
            if (!formData.categoryName) {
                error += 'Category is required\n';
                $("#categoryName").focus();
            }
            return error;
        };
        saveForm(formData, url, successCallback, validateFormData);
    });
</script>