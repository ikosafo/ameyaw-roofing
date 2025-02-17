<?php extract($data); ?>
<div class="card-custom viewUserCard mt-5">
   
    <div class="card-header h-auto py-4">
        <div class="card-title">
            <h3 class="card-label"><?= $viewUserDetails['fullName'] ?> 
            <span class="d-block text-muted pt-2 font-size-sm">Full Name</span></h3>
        </div>
    </div>
 
    <div class="card-body py-4">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Email Address:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $viewUserDetails['emailAddress'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Phone Number:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $viewUserDetails['phoneNumber'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Date of Birth:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $viewUserDetails['birthDate'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Job Title/Position:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $viewUserDetails['jobtitle'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Department:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $viewUserDetails['department'] ?></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Gender:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $viewUserDetails['gender'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Marital Status:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $viewUserDetails['maritalStatus'] ?></span>
                    </div>
                </div>
                
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">Employee Type:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $viewUserDetails['employeeType'] ?></span>
                    </div>
                </div>
                <div class="form-group row my-2">
                    <label class="col-4 col-form-label">User Type:</label>
                    <div class="col-8">
                        <span class="form-control-plaintext font-weight-bolder"><?= $viewUserDetails['userType'] ?></span>
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
        var contentSection = document.querySelector('.viewUserCard');
        if (contentSection) {
            contentSection.style.display = 'none';
        }
    });
</script>