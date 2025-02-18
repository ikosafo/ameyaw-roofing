<?php include ('includes/header.php');?>
    <div class="content pt-0 d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="d-flex flex-row-fluid bgi-size-cover bgi-position-top pt-10 pb-20">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="font-weight-bolder text-light mb-0">USER MANAGEMENT</h3>
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
                                    <a class="navi-link active" data-toggle="tab" href="#" id="addUser">
                                        <span class="navi-text text-dark-50 font-size-md text-uppercase font-weight-bold">Add User</span>
                                    </a>
                                </li>
                                <li class="navi-item mb-2">
                                    <a class="navi-link" data-toggle="tab" href="#" id="permissions">
                                        <span class="navi-text text-dark-50 font-size-md text-uppercase font-weight-bold">Permissions</span>
                                    </a>
                                </li>
                              </ul>
                        </div>
                        <div class="col-lg-10">
                            <div class="tab-content">
                                <div class="row" id="pageContent"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include ('includes/footer.php'); ?>

<script>
    $(document).ready(function () {
        function loadPage(url) {
            $.post(url, {}, function (response) {
                $('#pageContent').html(response);
            });
        }

        loadPage(`${urlroot}/users/usermanagement`);

        $('#addUser').on('click', function (e) {
            e.preventDefault();
            loadPage(`${urlroot}/users/usermanagement`);
            $('.navi-link').removeClass('active');
            $(this).addClass('active');
        });

        $('#permissions').on('click', function (e) {
            e.preventDefault();
            loadPage(`${urlroot}/users/permissions`);
            $('.navi-link').removeClass('active');
            $(this).addClass('active');
        });
    });
</script>
