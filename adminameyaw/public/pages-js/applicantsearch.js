
$("#searchBtn").click(function() {
    var formData = {
        registrationSearch: $("#registrationSearch").val()
    };

    var url = "/tables/applicantSearch";
    var successCallback = function(response) {
        //alert(response[0]);

        if (response[0] == 2) {
            $.notify("Duplicate record", {
                    position: "top center"
            },"error");
        }
        else if (response[0] == 3) {
            $.notify("Data not found", {
                    position: "top center"
            },"error");
        } else {
            $.notify("Data found", {
                position: "top center",
                className: "success"
            });         
            //$('#registrationSearch').val('');
            $('#applicantSearchDiv').html(response);
        }

    };

    var validateForm = function(formData) {
        var error = '';
        if (!formData.registrationSearch) {
            error += 'Please enter PIN, Email Address, Telephone or Index Number \n';
            $("#registrationSearch").focus();
        }
        return error;
    };
    saveForm(formData, url, successCallback, validateForm);
});