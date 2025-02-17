<?php include ('includes/header.php');
extract($data);
?>

<div class="content pt-0 flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-top pt-10 mb-10 pb-20">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="font-weight-bolder text-light mb-0">INSPECTIONS</h3>
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
                                <a class="nav-link" data-toggle="tab" href="#addInspectionForm" id="tab-add-product">
                                <span class="nav-text">Add Inspection</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#viewInspections" id="tab-view-products">
                                    <span class="nav-text">View Inspections Made</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="addInspectionForm" role="tabpanel" aria-labelledby="addInspectionForm">
                            <div id="pageForm"></div>
                        </div>
                        <div class="tab-pane fade" id="viewInspections" role="tabpanel" aria-labelledby="viewInspections">
                            <div id="pageTable"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include ('includes/footer.php'); ?>

<script>
    
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var tabId = $(e.target).attr('href'); 
        localStorage.setItem('activeTab', tabId); 
    });

    $(document).ready(function () {
        var activeTab = localStorage.getItem('activeTab');
        if (activeTab) {
            $('a[href="' + activeTab + '"]').tab('show');
        } else {
            $('a[href="#addInspectionForm"]').tab('show'); 
        }

        var dataToSend = {};
        $.post(`${urlroot}/orders/addInspectionForm`, dataToSend, function (response) {
            $('#pageForm').html(response);
        });

        $.post(`${urlroot}/orders/viewInspections`, dataToSend, function (response) {
            $('#pageTable').html(response);
        });
    });
</script>
