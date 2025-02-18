document.addEventListener("DOMContentLoaded", function () {
    const context = 'temporal'; 
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
            url = `${urlroot}/temporal/misadmin`;
            break;
        case 'superAdmin':
            url = `${urlroot}/temporal/superadmin`;
            break;
        case 'examException':
            url = `${urlroot}/permanent/examexception`;
            break;
        case 'specialRegistration':
            url = `${urlroot}/registration/specialcase`;
            dataToSend = { regType: 'Temporal' };
            break;
        case 'generateReport':
            url = `${urlroot}/temporal/generateReport`;
            break;
        case 'exportData':
            url = `${urlroot}/registration/exportData`;
            dataToSend = { regType: 'Temporal' };
            break;
        case 'summaryData':
            url = `${urlroot}/registration/summaryData`;
            dataToSend = { regType: 'Temporal' };
            break;
        case 'overview':
        default:
            url = `${urlroot}/temporal/overview`;
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