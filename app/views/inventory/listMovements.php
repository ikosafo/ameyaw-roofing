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
            View Movements 
        </h3>
    </div>

    <div class="card-body">
        <table class="table table-sm table-separate table-head-custom table-checkable" id="movementTable">
            <thead>
                <tr>
                    <th class="th-col-10">No.</th>
                    <th class="th-col-20">Product Name</th>
                    <th class="th-col-20">Movement Type</th>
                    <th class="th-col-20">Quantity</th>
                    <th class="th-col-20">Description</th>
                </tr>
            </thead>
        </table> 
    </div>
</div>
<div id="tableActions"></div>


<script>

    var oTable2 = $('#movementTable').DataTable({
        stateSave: true,
        "bLengthChange": false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url' : `${urlroot}/paginations/listMovements`,
            'data': {},
            'error': function (xhr, error, code) {
                console.log("Error: ", error);
            }
        },
        'columns': [
            { data: 'number' },
            { data: 'productName' },
            { data: 'movementType' },
            { data: 'quantity' },
            { data: 'description' },
        ],
        "language": {
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "Showing 0 to 0 of 0 entries",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "lengthMenu": "Show _MENU_ entries"
        }
    });

    
    $('#movementTable_filter').html(`
        <div class="input-icon">
            <input type="text" id="movementTable_search" class="form-control" placeholder="Search...">
            <span>
                <i class="flaticon2-search-1 text-muted"></i>
            </span>
        </div>
    `);


    $('#movementTable_search').on('keyup', function () {
        oTable2.search($(this).val()).draw();
    });


</script>    