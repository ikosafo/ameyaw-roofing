<?php extract($data); ?>
<div class="card card-custom viewProductCard mt-3">
   
    <div class="card-header h-auto py-4">
        <div class="card-title">
            <h3 class="card-label"><?= $productDetails['productName'] ?> 
            <span class="d-block text-muted pt-2 font-size-sm">Product Details</span></h3>
        </div>
    </div>
 
    <div class="card-body py-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Product Name:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $productDetails['productName'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Product Category:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= Tools::getProductCategoryName($productDetails['categoryId']) ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Material Type:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $productDetails['materialType'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Color:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $productDetails['color'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Thickness:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $productDetails['thickness'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Length:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $productDetails['length'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Width:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $productDetails['width'] ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Unit Price:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $productDetails['unitPrice'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Stock Quantity:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $productDetails['stockQuantity'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Supplier:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= Tools::getProductSupplier($productDetails['supplierId']) ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Thickness:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $productDetails['thickness'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Created At:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $productDetails['createdAt'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Last Updated:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $productDetails['updatedAt'] ?></span>
                    </div>
                </div>
            </div>
        </div>
       
    </div>
    <div class="card-footer">
        <a href="javascript:void(0);" class="btn btn-primary font-weight-bold mr-2" id="goBackBtn">Go Back</a>
        <a href="javascript:void(0);" class="btn btn-light-primary font-weight-bold" id="closeBtn">Close</a>
    </div>
</div>




<script>
    document.getElementById("goBackBtn").addEventListener("click", function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    document.getElementById("closeBtn").addEventListener("click", function() {
        var contentSection = document.querySelector('.viewProductCard');
        if (contentSection) {
            contentSection.style.display = 'none';
        }
    });
</script>