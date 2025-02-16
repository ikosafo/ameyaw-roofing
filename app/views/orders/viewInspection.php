<?php extract($data); ?>

<style>
  table.no-border {
    border-collapse: collapse;
    border: none;
  }
  table.no-border th,
  table.no-border td {
    border: none;
  }
</style>

<div class="card card-custom viewProductCard mt-5">
   
    <div class="card-header h-auto py-4">
        <div class="card-title">
            <h3 class="card-label" style="text-transform: uppercase;"><?= $inspectionDetails['clientName'] ?> 
            <span class="d-block text-muted pt-2 font-size-sm">CLIENT</span></h3>
        </div>
    </div>


    <div class="card-body py-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Client Name:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $inspectionDetails['clientName'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Client Telephone:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $inspectionDetails['clientTelephone'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Client Email:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $inspectionDetails['clientEmail'] ?></span>
                    </div>
                </div>  
                
            </div>
            <div class="col-md-6">
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Site Location:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $inspectionDetails['siteLocation'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Inspection Date:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $inspectionDetails['inspectionDate'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Inspector Name:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $inspectionDetails['inspectorName'] ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row my-2">
                    <label class="col-2 col-form-label">Address:</label>
                    <div class="col-10">
                        <span class="form-control-plaintext font-weight-bolder"><?= $inspectionDetails['address'] ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group row my-2">
                    <label class="col-2 col-form-label">Site Report:</label>
                    <div class="col-10">
                        <span class="form-control-plaintext font-weight-bolder"><?= $inspectionDetails['siteReport'] ?></span>
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