<?php include ('includes/header.php');
extract($data);
?>

<div class="content pt-0 flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-top pt-10 mb-10 pb-20">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="font-weight-bolder text-light mb-0">MANAGE INVENTORY</h3>
            </div>
        </div>
    </div>

    <div class="container mt-n15 mt-10">
        <div class="card mb-8">
            <div class="card card-custom" style="width:100%">
                <div class="card-header">
                    <div class="card-toolbar">
                        <ul class="nav nav-light-primary nav-bold nav-pills">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#addMovementForm">
                                <span class="nav-text">Manage Stock Movement</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#viewInventory">
                                    <span class="nav-text">View Stock Movement</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="addMovementForm" role="tabpanel" aria-labelledby="addMovementForm">
                            <div id="pageTable"></div>
                        </div>
                        <div class="tab-pane fade show" id="viewInventory" role="tabpanel" aria-labelledby="viewInventory">
                            <div id="movementTableDiv"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

	
<?php include ('includes/footer.php'); ?>

<script>
    var dataToSend = {};
    $.post(`${urlroot}/inventory/manageInventory`, dataToSend, function (response) {
        $('#pageTable').html(response);
    });

    $.post(`${urlroot}/inventory/viewInventory`, dataToSend, function (response) {
        $('#movementTableDiv').html(response);
    });
</script>
	

	
