<?php include ('includes/header.php');
extract($data);
?>

<div class="content pt-0 flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-top pt-10 mb-10 pb-20">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="font-weight-bolder text-light mb-0">PRODUCT CATEGORIES</h3>
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
                                <a class="nav-link active" data-toggle="tab" href="#addCategoryForm">
                                <span class="nav-text">Add Category</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#viewCategories">
                                    <span class="nav-text">View Categories</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="addCategoryForm" role="tabpanel" aria-labelledby="addCategoryForm">
                            <div id="pageForm"></div>
                        </div>
                        <div class="tab-pane fade show" id="viewCategories" role="tabpanel" aria-labelledby="viewCategories">
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
    var dataToSend = {};
    $.post(`${urlroot}/products/addCategories`, dataToSend, function (response) {
        $('#pageForm').html(response);
    });

    $.post(`${urlroot}/products/viewCategories`, dataToSend, function (response) {
        $('#pageTable').html(response);
    });
</script>
	
