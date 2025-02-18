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
            <th class="th-col-20">Types</th>
            <th class="th-col-10">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1; // Initialize a counter
        foreach ($listTypes as $result) { ?>
            <tr>
                <td><strong class="text-black"><?= $no++ ?></strong></td>
                <td><?= $result->typeName ?></td>
                <td>
                    <div class="d-flex">
                        <a href="javascript:void(0);" class="btn btn-warning editType btn-xs sharp me-1 mr-2" typeid='<?= $result->typeId ?>'>Edit</a>
                        <a href="javascript:void(0);" class="btn btn-danger deleteType btn-xs sharp" typeid='<?= $result->typeId ?>'>Delete</a>
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


   $(document).on('click', '.editType', function () {
        var typeid = $(this).attr('typeid'); 

        $('a[href="#addTypeForm"]').click();
        $('a[href="#addTypeForm"] .nav-text').text('Edit Type');

        var dataToSend = { typeid };
        $.post(`${urlroot}/products/editTypes`, dataToSend, function (response) {
            $('#pageForm').html(response); 
        });
    });


    $(document).off('click', '.deleteType').on('click', '.deleteType', function() {
        var typeid = $(this).attr('typeid');
    
        var formData = {};
        formData.typeid = typeid; 
    
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
                        saveForm(formData, `${urlroot}/products/deleteType`, function(response) {
                            // Reload the table after deletion
                            $.post(`${urlroot}/products/viewTypes`, {}, function (response) {
                                $('#pageTable').html(response); // Update table with the response
                            });
                        });
                    }
                }
            }
        });
    });


</script>