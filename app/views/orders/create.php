<?php include ('includes/header.php');
extract($data);
$uuid = Tools::generateUUID();
?>

<div class="content pt-0 flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-top pt-10 mb-10 pb-6">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="font-weight-bolder text-light mb-0">CREATE ORDERS</h3>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="d-flex flex-row">
            <div class="flex-column offcanvas-mobile w-350px w-xl-425px" id="kt_profile_aside">
                <div class="card card-custom gutter-b">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">Search Products</span>
                            <span id="resultsShow"  style="display: none;" class="text-muted mt-3 font-weight-bold font-size-sm"></span>
                        </h3>
                    </div>
                    
                    <div class="card-body pt-4">
                        <div class="input-icon mb-6">
                            <input type="text" id="searchProduct" class="form-control" placeholder="Search Product..." autocomplete="off">
                            <span>
                                <i class="flaticon2-search-1 text-muted"></i>
                            </span>
                        </div>
                        <div id="orderItems"></div>
                    </div>
                </div>
               
            </div>
            <div class="flex-row-fluid ml-lg-8">
                <div class="card card-custom gutter-b">
                    <div class="card-header flex-wrap border-0 pt-6 pb-0">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder font-size-h3 text-dark">Shopping Cart</span>
                        </h3>
                    </div>
                    <div id="cartTable"></div>
                </div>
            </div>
            <!--end::Layout-->
        </div>
    </div>
</div>

	
<?php include ('includes/footer.php'); ?>

<script>

    $("#searchProduct").on("keyup", function(event) {
        event.preventDefault(); 

        var searchTerm = $("#searchProduct").val();
        var uuid = '<?php echo $uuid ?>';
        var dataToSend = {searchTerm,uuid};
        
        $.post(`${urlroot}/orders/orderItems`, dataToSend, function (response) {
            $('#orderItems').html(response);
        });
    })
</script>
	
