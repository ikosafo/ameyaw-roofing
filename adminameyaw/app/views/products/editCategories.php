<?php extract($data); 
$uuid = $categoryDetails['uuid'];
?>
<div id="pageForm">
    <div class="form-group row align-items-center">
        <div class="col-lg-8 col-md-8">
            <label for="fullName">Category Name</label>
            <input type="text" class="form-control" id="categoryName" autocomplete="off" placeholder="Enter Category Name" value="<?= $categoryDetails['categoryName'] ?>">
        </div>
        <div class="col-lg-4 col-md-4 d-flex align-items-center">
            <button type="button" class="btn btn-warning mt-7" id="editData">Update Category</button>
            <button type="button" class="btn btn-primary mt-7 ml-3" id="cancelData">Cancel</button>
        </div>
    </div>
</div>

<script>
     $("#editData").on("click", function(event) {
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
                $.notify("Category updated", {
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
                $('a[href="#addCategoryForm"] .nav-text').text('Add Category');
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


    $(document).on('click', '#cancelData', function () {
        $('a[href="#addCategoryForm"]').click();
        $('a[href="#addCategoryForm"] .nav-text').text('Add Category');
        var dataToSend = {};
        $.post(`${urlroot}/products/addCategories`, dataToSend, function (response) {
            $('#pageForm').html(response);
        });
    });

</script>