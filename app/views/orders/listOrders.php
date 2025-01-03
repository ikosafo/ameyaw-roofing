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
            Orders
        </h3>
    </div>

    <div class="card-body">
        <table class="table table-sm table-separate table-head-custom table-checkable" id="orderTable">
            <thead>
                <tr>
                    <th class="th-col-10">No.</th>
                    <th class="th-col-20">Order ID</th>
                    <th class="th-col-20">Customer</th>
                    <th class="th-col-20">Total Amount</th>
                    <th class="th-col-20">Payment Status</th>
                    <th class="th-col-20">Delivery Mode</th>
                    <th class="th-col-10">Action</th>
                </tr>
            </thead>
        </table> 
    </div>
</div>
<div id="tableActions"></div>


<script>

    var oTableOrder = $('#orderTable').DataTable({
        stateSave: true,
        "bLengthChange": false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url' : `${urlroot}/paginations/listOrders`,
            'data': {},
            'error': function (xhr, error, code) {
                console.log("Error: ", error);
            }
        },
        'columns': [
            { data: 'number' },
            { data: 'orderId' },
            { data: 'customer' },
            { data: 'totalAmount' },
            { data: 'paymentStatus' },
            { data: 'deliveryMode' },
            { data: 'action' },
        ],
        "language": {
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "Showing 0 to 0 of 0 entries",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "lengthMenu": "Show _MENU_ entries"
        }
    });

    
    $('#orderTable_filter').html(`
        <div class="input-icon">
            <input type="text" id="orderTable_search" class="form-control" placeholder="Search...">
            <span>
                <i class="flaticon2-search-1 text-muted"></i>
            </span>
        </div>
    `);


    $('#orderTable_search').on('keyup', function () {
        oTableOrder.search($(this).val()).draw();
    });


    $(document).on('click', '.viewColumn', function () {
        var dbid = $(this).attr('dbid'); 
        var dataToSend = { dbid };
        $('html, body').animate({
            scrollTop: $("#tableActions").offset().top
        }, 500);
        $.post(`${urlroot}/orders/viewOrder`, dataToSend, function (response) {
            $('#tableActions').html(response); 
        });
    });


    $(document).on('click', '.editColumn', function () {
        var encryptedUuid = $(this).attr('dbid'); 
        window.location.href = urlroot + `/orders/checkout?uuid=${encodeURIComponent(encryptedUuid)}`;
    });

    $(document).on('click', '.printColumn', function () {
        var encryptedUuid = $(this).attr('dbid'); 
        window.location.href = urlroot + `/orders/receipt?uuid=${encodeURIComponent(encryptedUuid)}`;
    });


</script>    