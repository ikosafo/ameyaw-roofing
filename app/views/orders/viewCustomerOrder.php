<?php extract($data); 
$dbid = $_POST['dbid'];
?>
<style>
    .btn-xs {
        padding: 3px 9px;
        font-size: 12px;
    }
</style>

<div class="card card-custom mt-6">
    <div class="card-header">
        <h3 class="card-title">
            Orders
        </h3>
    </div>

    <div class="card-body">
        <table class="table table-sm table-separate table-head-custom table-checkable" id="resultTable">
            <thead>
                <tr>
                    <th class="th-col-10">No.</th>
                    <th class="th-col-20">Order ID</th>
                    <th class="th-col-20">Total Amount</th>
                    <th class="th-col-20">Payment Status</th>
                    <th class="th-col-20">Delivery Mode</th>
                    <th class="th-col-20">Delivery Cost</th>
                    <th class="th-col-10">Action</th>
                </tr>
            </thead>
        </table> 
    </div>
</div>
<div id="customerActions"></div>


<script>

   var customerPhone = '<?php echo $dbid ?>'; 
    var oTableNew = $('#resultTable').DataTable({
        stateSave: true,
        "bLengthChange": false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url' : `${urlroot}/paginations/listCustomerOrders`,
            'data': {customerPhone},
            'error': function (xhr, error, code) {
                console.log("Error: ", error);
            }
        },
        'columns': [
            { data: 'number' },
            { data: 'orderId' },
            { data: 'totalAmount' },
            { data: 'paymentStatus' },
            { data: 'deliveryMode' },
            { data: 'deliveryCost' },
            { data: 'action' },
        ],
        "language": {
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "Showing 0 to 0 of 0 entries",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "lengthMenu": "Show _MENU_ entries"
        }
    });

    
    $('#resultTable_filter').html(`
        <div class="input-icon">
            <input type="text" id="resultTable_search" class="form-control" placeholder="Search...">
            <span>
                <i class="flaticon2-search-1 text-muted"></i>
            </span>
        </div>
    `);


    $('#resultTable_search').on('keyup', function () {
        oTableNew.search($(this).val()).draw();
    });


    $(document).on('click', '.viewColumn', function () {
        var dbid = $(this).attr('dbid'); 
        var dataToSend = { dbid };
        $('html, body').animate({
            scrollTop: $("#customerActions").offset().top
        }, 500);
        $.post(`${urlroot}/orders/viewOrder`, dataToSend, function (response) {
            $('#customerActions').html(response); 
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