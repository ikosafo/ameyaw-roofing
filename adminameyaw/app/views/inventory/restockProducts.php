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
            Restock Products 
        </h3>
    </div>

    <div class="card-body">
        <table class="table table-sm table-separate table-head-custom table-checkable" id="formTable">
            <thead>
                <tr>
                    <th class="th-col-10">No.</th>
                    <th class="th-col-20">Product Name</th>
                    <th class="th-col-20">Product Category</th>
                    <th class="th-col-20">Material Type</th>
                    <th class="th-col-20">Unit Price</th>
                    <th class="th-col-20">Quantity</th>
                    <th class="th-col-10">Action</th>
                </tr>
            </thead>
        </table> 
    </div>
</div>
<div id="tableActions"></div>


<script>
    var pageStatus = "Restock";

    var oTable = $('#formTable').DataTable({
        stateSave: true,
        "bLengthChange": false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url' : `${urlroot}/paginations/listProducts`,
            'data': {pageStatus},
            'error': function (xhr, error, code) {
                console.log("Error: ", error);
            }
        },
        'columns': [
            { data: 'number' },
            { data: 'productName' },
            { data: 'categoryId' },
            { data: 'materialType' },
            { data: 'unitPrice' },
            { data: 'stockQuantity' },
            { data: 'action' },
        ],
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


    $(document).on('click', '.restockProduct', function () {
        var dbid = $(this).attr('dbid'); 
        var dataToSend = { dbid };
        $('html, body').animate({
            scrollTop: $("#tableActions").offset().top
        }, 500);
        $.post(`${urlroot}/inventory/newProducts`, dataToSend, function (response) {
            $('#tableActions').html(response); 
        });
    });


</script>    