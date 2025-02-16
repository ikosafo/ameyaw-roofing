<?php extract($data); ?>
<style>
    .btn-xs {
        padding: 3px 9px;
        font-size: 12px;
    }
</style>

<div class="card card-custom mt-6">
    <div class="card-header">
        <h3 class="card-title">
            View Inspections
        </h3>
    </div>

    <div class="card-body">
        <table class="table table-sm table-separate table-head-custom table-checkable" id="resultTable">
            <thead>
                <tr>
                    <th class="th-col-10">No.</th>
                    <th class="th-col-20">Client Name</th>
                    <th class="th-col-20">Telephone</th>
                    <th class="th-col-20">Client Email</th>
                    <th class="th-col-20">Site Location</th>
                    <th class="th-col-20">Inspection Date</th>
                    <th class="th-col-10">Action</th>
                </tr>
            </thead>
        </table> 
    </div>
</div>
<div id="pageActions"></div>


<script>

    var oTableNew = $('#resultTable').DataTable({
        stateSave: true,
        "bLengthChange": false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url' : `${urlroot}/paginations/viewInspections`,
            'error': function (xhr, error, code) {
                console.log("Error: ", error);
            }
        },
        'columns': [
            { data: 'number' },
            { data: 'clientName' },
            { data: 'telephone' },
            { data: 'clientEmail' },
            { data: 'siteLocation' },
            { data: 'inspectionDate' },
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
            scrollTop: $("#pageActions").offset().top
        }, 500);
        $.post(`${urlroot}/orders/viewInspection`, dataToSend, function (response) {
            $('#pageActions').html(response); 
        });
    });


    $(document).on('click', '.editColumn', function () {
        var encryptedUuid = $(this).attr('dbid'); 
        window.location.href = urlroot + `/orders/checkout?uuid=${encodeURIComponent(encryptedUuid)}`;
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
                        saveForm(formData, `${urlroot}/orders/deleteInspection`, function(response) {
                            $.post(`${urlroot}/orders/viewInspections`, {}, function (response) {
                                $('#pageTable').html(response);
                            });
                        });
                    }
                }
            }
        });
    });



</script>    