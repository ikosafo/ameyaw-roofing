/* FUNCTION TO SAVE FORM */
function saveForm(formData, url, successCallback, validateForm) {
    var error = '';

    // Validate form fields using custom validation function
    if (validateForm && typeof validateForm === 'function') {
        error = validateForm(formData);
    }

    if (error === "") {
        // Perform AJAX request to save form data
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            beforeSend: function () {
                KTApp.blockPage({
                    overlayColor: "#000000",
                    type: "v2",
                    state: "success",
                    message: "Please wait..."
                });
            },
            success: function (response) {
                // Call the successCallback function with the response
                successCallback(response);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status + " " + thrownError);
            },
            complete: function () {
                KTApp.unblockPage();
            }
        });
    } else {
        // Display error message
        $.notify(error, {
            position: "top center"
        });
    }

    return false;
}


/* FUNCTION TO LOAD PAGE */
function loadPage(url, successCallback) {
    $.ajax({
        url: url,
        beforeSend: function () {
            KTApp.blockPage({
                overlayColor: "#000000",
                type: "v2",
                state: "success",
                message: "Please wait..."
            });
        },
        success: function (response) {
            // Call the successCallback function with the response
            successCallback(response);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status + " " + thrownError);
        },
        complete: function () {
            KTApp.unblockPage();
        }
    });
}
