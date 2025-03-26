<?php $uuid = Tools::generateUUID(); ?>
<div id="pageForm">
    <div class="form-group row align-items-center">
        <div class="col-lg-8 col-md-8">
            <label for="profileName">Profile</label>
            <input type="text" class="form-control" id="profileName" autocomplete="off" placeholder="Enter Profile">
        </div>
        <div class="col-lg-4 col-md-4 d-flex align-items-center">
            <button type="button" class="btn btn-facebook mr-2 mt-7" id="saveData">Save Profile</button>
        </div>
    </div>
</div>

<script>
    $("#saveData").on("click", function(event) {
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
                $.notify("Profile saved", {
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
</script>