<?php extract($data); ?>
<div class="card card-custom viewProductCard mt-5">
   
    <div class="card-header h-auto py-4">
        <div class="card-title">
            <h3 class="card-label"><?= $supplierDetails['supplierName'] ?> 
            <span class="d-block text-muted pt-2 font-size-sm">Supplier Details</span></h3>
        </div>
    </div>
 
    <div class="card-body py-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Supplier Name:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $supplierDetails['supplierName'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Product Category:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= Tools::getProductCategoryName($supplierDetails['productCategory']) ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Email Address:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $supplierDetails['emailAddress'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Phone Number:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $supplierDetails['phoneNumber'] ?></span>
                    </div>
                </div>
                
            </div>
            <div class="col-md-6">
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Additional Notes:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $supplierDetails['notes'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Created At:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $supplierDetails['createdAt'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Last Updated:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $supplierDetails['updatedAt'] ?></span>
                    </div>
                </div>
            </div>
        </div>
       
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