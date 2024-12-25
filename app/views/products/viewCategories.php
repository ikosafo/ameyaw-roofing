<?php extract($data); ?>
<style>
    .btn-xs {
        padding: 3px 9px;
        font-size: 12px;
    }
</style>

<table class="table table-sm table-separate table-head-custom table-checkable" id="formTable">
    <thead>
        <tr>
            <th class="th-col-10">No.</th>
            <th class="th-col-20">Categories</th>
            <th class="th-col-10">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1; // Initialize a counter
        foreach ($listCategories as $result) { ?>
            <tr>
                <td><strong class="text-black"><?= $no++ ?></strong></td>
                <td><?= $result->categoryName ?></td>
                <td>
                    <div class="d-flex">
                        <a href="javascript:void(0);" class="btn btn-warning editCategory btn-xs sharp me-1 mr-2" catid='<?= $result->categoryId ?>'>Edit</a>
                        <a href="javascript:void(0);" class="btn btn-danger deleteCategory btn-xs sharp" catid='<?= $result->categoryId ?>'>Delete</a>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<script>
     var oTable = $('#formTable').DataTable({
        stateSave: true,
        "bLengthChange": false,
        "language": {
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "Showing 0 to 0 of 0 entries",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "lengthMenu": "Show _MENU_ entries"
        }
    });

    $('#formTable_filter').html(`
        <div class="input-icon">
            <input type="text" id="formTable_search" class="form-control" placeholder="Search...">
            <span>
                <i class="flaticon2-search-1 text-muted"></i>
            </span>
        </div>
    `);

    $('#formTable_search').on('keyup', function () {
        oTable.search($(this).val()).draw();
    });


   $(document).on('click', '.editCategory', function () {
        var catid = $(this).attr('catid'); 

        $('a[href="#addCategoryForm"]').click();
        $('a[href="#addCategoryForm"] .nav-text').text('Edit Category');

        var dataToSend = { catid };
        $.post(`${urlroot}/products/editCategories`, dataToSend, function (response) {
            $('#pageForm').html(response); 
        });
    });


    $(document).off('click', '.deleteCategory').on('click', '.deleteCategory', function() {
        var catid = $(this).attr('catid');
    
        var formData = {};
        formData.catid = catid; 
    
        $.confirm({
            title: 'Delete Record!',
            content: 'Are you sure to continue?',
            buttons: {
                no: {
                    text: 'No',
                    keys: ['enter', 'shift'],
                    backdrop: 'static',
                    keyboard: false,
                    action: function() {
                        $.alert('Data is safe');
                    }
                },
                yes: {
                    text: 'Yes, Delete it!',
                    btnClass: 'btn-blue',
                    action: function() {
                        // Perform delete and update the table
                        saveForm(formData, `${urlroot}/products/deleteCategory`, function(response) {
                            // Reload the table after deletion
                            $.post(`${urlroot}/products/viewCategories`, {}, function (response) {
                                $('#pageTable').html(response); // Update table with the response
                            });
                        });
                    }
                }
            }
        });
    });


</script>