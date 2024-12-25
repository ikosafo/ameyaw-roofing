document.addEventListener("DOMContentLoaded", function () {
    const context = 'renewal'; 
    const storageKey = `activeTab_${context}`; 

    var activeTab = localStorage.getItem(storageKey) || 'overview';
    $('.navi-link').removeClass('active'); 
    $("#" + activeTab).addClass('active'); 

    loadContent(activeTab);
    $('.navi-link').on('click', function (event) {
        event.preventDefault();

        $('.navi-link').removeClass('active');
        $(this).addClass('active');

        var tabId = $(this).attr('id');
        localStorage.setItem(storageKey, tabId); 

        loadContent(tabId);
    });
});

// Function to load content based on tab ID
function loadContent(tabId) {
    var url;
    var dataToSend = {};

    switch (tabId) {
        case 'misAdmin':
            url = `${urlroot}/renewal/misadmin`;
            break;
        case 'superAdmin':
            url = `${urlroot}/renewal/superadmin`;
            break;
        case 'examException':
            url = `${urlroot}/permanent/examexception`;
            break;
        case 'specialRegistration':
            url = `${urlroot}/renewal/specialcase`;
            break;
        case 'cpdList':
            url = `${urlroot}/renewal/cpdList`;
            break;
        case 'renewalBills':
            url = `${urlroot}/renewal/renewalBills`;
            break;
        case 'generateReport':
            url = `${urlroot}/renewal/generateReport`;
            break;
        case 'uploadPins':
            url = `${urlroot}/renewal/uploadPins`;
            break;
        case 'exportData':
            url = `${urlroot}/registration/exportData`;
            dataToSend = { regType: 'Renewal' };
            break;
        case 'summaryData':
            url = `${urlroot}/registration/summaryData`;
            dataToSend = { regType: 'Renewal' };
            break;
        case 'overview':
        default:
            url = `${urlroot}/renewal/overview`;
            break;
    }

   // Show loading overlay before the request
   $('#loadingOverlay').show();

    // Load content with POST or GET based on data to send
    if (Object.keys(dataToSend).length > 0) {
        $.post(url, dataToSend, function (response) {
            $('#pageContent').html(response);
            $('#loadingOverlay').hide(); // Hide loading overlay after content is loaded
        }).fail(function() {
            $('#loadingOverlay').hide(); // Hide even if there's an error
            alert('Failed to load content');
        });
    } else {
        $.get(url, function (response) {
            $('#pageContent').html(response);
            $('#loadingOverlay').hide(); // Hide loading overlay after content is loaded
        }).fail(function() {
            $('#loadingOverlay').hide(); // Hide even if there's an error
            alert('Failed to load content');
        });
    }
}