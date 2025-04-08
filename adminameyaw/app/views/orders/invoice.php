<?php include ('includes/header.php');
extract($data);
?>

<div class="content pt-0 flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-top pt-10 mb-10 pb-20">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="font-weight-bolder text-light mb-0">MANAGE INVOICES</h3>
            </div>
        </div>
    </div>

    <div class="container mt-n15 mt-10">
        <div id="pageTable"></div>
    </div>
</div>

	
<?php include ('includes/footer.php'); ?>

<script>
    var dataToSend = {};
    $.post(`${urlroot}/orders/invoicing`, dataToSend, function (response) {
        $('#pageTable').html(response);
    });
</script>
	
