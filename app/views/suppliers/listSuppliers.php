<?php extract($data); ?>
<style>
    .btn-xs {
        padding: 3px 9px;
        font-size: 12px;
    }
</style>


<div class="card card-custom">
    <div class="card-header">
        <h3 class="card-title">
            View Suppliers 
        </h3>
    </div>

    <div class="card-body">
        <table class="table table-sm table-separate table-head-custom table-checkable" id="formTable">
            <thead>
                <tr>
                    <th class="th-col-10">No.</th>
                    <th class="th-col-20">Supplier Name</th>
                    <th class="th-col-20">Email Address</th>
                    <th class="th-col-20">Telephone</th>
                    <th class="th-col-20">Address</th>
                    <th class="th-col-10">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1; // Initialize a counter
                foreach ($listSuppliers as $result) { ?>
                    <tr>
                        <td><strong class="text-black"><?= $no++ ?></strong></td>
                        <td><?= $result->supplierName ?></td>
                        <td><?= $result->emailAddress ?></td>
                        <td><?= $result->phoneNumber ?></td>
                        <td><?= $result->businessAddress ?></td>
                        <td>
                            <div class="d-flex">
                                <a href="javascript:void(0);" class="btn btn-primary viewColumn btn-xs sharp me-1 mr-2" dbid='<?= $result->supplierId ?>'>View</a>
                                <a href="javascript:void(0);" class="btn btn-warning editColumn btn-xs sharp me-1 mr-2" dbid='<?= $result->supplierId ?>'>Edit</a>
                                <a href="javascript:void(0);" class="btn btn-danger deleteColumn btn-xs sharp" dbid='<?= $result->supplierId ?>'>Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table> 
    </div>

</div>



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


   $(document).on('click', '.editColumn', function () {
        var dbid = $(this).attr('dbid'); 
        var dataToSend = { dbid };
        $.post(`${urlroot}/suppliers/editSuppliers`, dataToSend, function (response) {
            $('#pageForm').html(response); 
        });
    });


    $(document).off('click', '.deleteColumn').on('click', '.deleteColumn', function() {
        var dbid = $(this).attr('dbid');
    
        var formData = {};
        formData.dbid = dbid; 
    
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
                        saveForm(formData, `${urlroot}/suppliers/deleteSupplier`, function(response) {
                           $.post(`${urlroot}/suppliers/listSuppliers`, {}, function (response) {
                                $('#pageTable').html(response); 
                            });
                        });
                    }
                }
            }
        });
    });


</script>