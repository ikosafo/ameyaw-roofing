<?php extract($data);
?>
<style>
    .btn-xs {
        padding: 3px 9px;
        font-size: 12px;
    }

    .kt-form__actions {
        display: flex;
        justify-content: center; 
        gap: 10px; 
    }
</style>

<div class="card card-custom viewSupplierCard mt-5">
    <div class="card-header">
        <h3 class="card-title">
            View Products supplied by <?= Tools::getProductSupplier($dbid) ?>
        </h3>
    </div>

    <div class="card-body">
        <table class="table table-sm table-separate table-head-custom table-checkable" id="productTable">
            <thead>
                <tr>
                    <th class="th-col-10">No.</th>
                    <th class="th-col-20">Product Name</th>
                    <th class="th-col-20">Product Category</th>
                    <th class="th-col-20">Material Type</th>
                    <th class="th-col-20">Quantity</th>
                </tr>
            </thead>
        </table> 
    </div>

    
    <div class="card-footer">
        <div class="form-group row">
            <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                <div class="kt-form__actions">
                    <a href="javascript:void(0);" class="btn btn-primary font-weight-bold mr-2" id="goBackBtn">Go Back</a>
                    <a href="javascript:void(0);" class="btn btn-light-primary font-weight-bold" id="closeBtn">Close</a>
                </div>
            </div>
        </div>
    </div>

</div>
<div id="tableActions"></div>


<script>

    var supplierId = '<?php echo $dbid ?>'; 
    var oTable = $('#productTable').DataTable({
        stateSave: true,
        "bLengthChange": false,
        'processing': true,
        'serverSide': true,
        'serverMethod': 'post',
        'ajax': {
            'url' : `${urlroot}/paginations/listSupplierProducts`,
            'data': {supplierId},
            'error': function (xhr, error, code) {
                console.log("Error: ", error);
            }
        },
        'columns': [
            { data: 'number' },
            { data: 'productName' },
            { data: 'categoryId' },
            { data: 'materialType' },
            { data: 'stockQuantity' },
        ],
        "language": {
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "Showing 0 to 0 of 0 entries",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "lengthMenu": "Show _MENU_ entries"
        }
    });

    
    $('#productTable_filter').html(`
        <div class="input-icon">
            <input type="text" id="productTable_search" class="form-control" placeholder="Search...">
            <span>
                <i class="flaticon2-search-1 text-muted"></i>
            </span>
        </div>
    `);


    $('#productTable_search').on('keyup', function () {
        oTable.search($(this).val()).draw();
    });


    $(document).on('click', '.editColumn', function () {
        var dbid = $(this).attr('dbid'); 
        var dataToSend = { dbid };
        $('html, body').animate({
            scrollTop: $("#tableActions").offset().top
        }, 500);
        $.post(`${urlroot}/products/editProducts`, dataToSend, function (response) {
            $('#tableActions').html(response); 
        });
    });

    
    $(document).on('click', '.viewColumn', function () {
        var dbid = $(this).attr('dbid'); 
        var dataToSend = { dbid };
        $('html, body').animate({
            scrollTop: $("#tableActions").offset().top
        }, 500);
        $.post(`${urlroot}/products/viewProduct`, dataToSend, function (response) {
            $('#tableActions').html(response); 
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
                        saveForm(formData, `${urlroot}/products/deleteProduct`, function(response) {
                        $.post(`${urlroot}/products/listProducts`, {}, function (response) {
                                $('#pageTable').html(response); 
                            });
                        });
                    }
                }
            }
        });
    });

    document.getElementById("goBackBtn").addEventListener("click", function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    document.getElementById("closeBtn").addEventListener("click", function() {
        var contentSection = document.querySelector('.viewSupplierCard');
        if (contentSection) {
            contentSection.style.display = 'none';
        }
    });


</script>    