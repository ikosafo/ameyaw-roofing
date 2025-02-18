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
                    overlayColor: '#000000',
                    state: 'danger',
                    message: 'Please wait...'
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


function loadPage(url, successCallback) {
    $.ajax({
        url: url,
        beforeSend: function () {
            KTApp.blockPage({
                overlayColor: '#000000',
                state: 'danger',
                message: 'Please wait...'
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


function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}


function allowTwoDecimalPlaces(event) {
    let inputField = event.target;
    let charCode = event.which ? event.which : event.keyCode;
    let inputValue = inputField.value;

    if ((charCode >= 48 && charCode <= 57) || charCode === 46 || charCode === 8 || charCode === 37 || charCode === 39) {
        if (charCode == 46 && inputValue.includes('.')) {
            event.preventDefault(); 
        }

        if (inputValue.includes('.')) {
            let decimalPosition = inputValue.indexOf('.');
            let decimalLength = inputValue.length - decimalPosition - 1;

            if (decimalLength >= 2 && charCode !== 8) {
                event.preventDefault();
            }
        }

    } else {
        event.preventDefault();
    }
}


function handlePaste(event) {
    let pasteData = event.clipboardData.getData('text');
    let regex = /^\d*(\.\d{0,2})?$/; 

    // Prevent pasting if the data is not valid
    if (!regex.test(pasteData)) {
        event.preventDefault();
    }
}

function allowNumbersCommasDecimals(event) {
    const charCode = event.which || event.keyCode;
    const charTyped = String.fromCharCode(charCode);
    
    const input = event.target.value;
    
    const isNumber = /[0-9]/.test(charTyped);
    const isComma = charTyped === ',';
    const isDecimal = charTyped === '.';

    if (isDecimal) {
        const lastNumber = input.split(',').pop().trim(); 
        if (lastNumber.includes('.')) {
            event.preventDefault(); 
        }
    }

    if (isNumber) {
        const lastNumber = input.split(',').pop().trim();
        if (lastNumber.includes('.')) {
            const decimalPart = lastNumber.split('.')[1];
            if (decimalPart && decimalPart.length >= 2) {
                event.preventDefault(); 
            }
        }
    }

    if (!isNumber && !isComma && !isDecimal) {
        event.preventDefault();
    }
}
