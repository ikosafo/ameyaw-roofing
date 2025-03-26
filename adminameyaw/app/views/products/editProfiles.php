<?php extract($data); 
$uuid = $profileDetails['uuid'];
?>
<div id="pageForm">
    <div class="form-group row align-items-center">
        <div class="col-lg-8 col-md-8">
            <label for="profileName">Product Profile</label>
            <input type="text" class="form-control" id="profileName" autocomplete="off" placeholder="Enter Product Profile" value="<?= $profileDetails['profileName'] ?>">
        </div>
        <div class="col-lg-4 col-md-4 d-flex align-items-center">
            <button type="button" class="btn btn-warning mt-7" id="editData">Update Profile</button>
            <button type="button" class="btn btn-primary mt-7 ml-3" id="cancelData">Cancel</button>
        </div>
    </div>
</div>

<script>
     $("#editData").on("click", function(event) {
        event.preventDefault(); 

        var formData = {
            profileName: $("#profileName").val(),
            uuid: '<?php echo $uuid ?>'

        };
        var url = `${urlroot}/products/saveProfile`;
        var successCallback = function(response) {
            if (response == '2') {
                $("#pageForm").notify("Profile already exists", {
                    position: "top center",
                    className: "error"
                });
            } else {
                $.notify("Profile updated", {
                    position: "top center",
                    className: "success"
                });
                $.post(`${urlroot}/products/addProfiles`, {}, function (response) {
                    $('#pageForm').html(response);
                });
                $.post(`${urlroot}/products/viewProfiles`, {}, function (response) {
                    $('#pageTable').html(response);
                });
                $('a[href="#viewProfiles"]').click();
                $('a[href="#addProfileForm"] .nav-text').text('Add Profile');
            }
           
        };
        var validateFormData = function(formData) {
            var error = '';
            if (!formData.profileName) {
                error += 'Profile is required\n';
                $("#profileName").focus();
            }
            return error;
        };
        saveForm(formData, url, successCallback, validateFormData);
    });


    $(document).on('click', '#cancelData', function () {
        $('a[href="#addProfileForm"]').click();
        $('a[href="#addProfileForm"] .nav-text').text('Add Profile');
        var dataToSend = {};
        $.post(`${urlroot}/products/addProfiles`, dataToSend, function (response) {
            $('#pageForm').html(response);
        });
    });

</script>