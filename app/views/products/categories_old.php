<?php include ('includes/header.php');
extract($data);
?>

<div class="content pt-0 d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-top pt-10 pb-20">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="font-weight-bolder text-light mb-0">PRODUCTS</h3>
            </div>
        </div>
    </div>

    <div class="container mt-n15">
        <div class="card mb-8">
            <div class="card-body p-10">
                <div class="row">
                    <div class="col-lg-2">
                        <ul class="navi navi-link-rounded navi-accent navi-hover navi-active nav flex-column mb-8 mb-lg-0" role="tablist">
                            <li class="navi-item mb-2">
                                <a class="navi-link active" data-toggle="tab" href="#" id="mainCategories">
                                    <span class="navi-text text-dark-50 font-size-md text-uppercase font-weight-bold">Main Categories</span>
                                </a>
                            </li>
                            <li class="navi-item mb-2">
                                <a class="navi-link" data-toggle="tab" href="#" id="subCategories">
                                    <span class="navi-text text-dark-50 font-size-md text-uppercase font-weight-bold">Sub Categories</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-10">
                        <div class="tab-content">
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
	
