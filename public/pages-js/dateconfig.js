document.addEventListener("DOMContentLoaded", function () {
    const context = 'dateconfig'; 
    const storageKey = `activeTab_${context}`; 

    var activeTab = localStorage.getItem(storageKey) || 'changePassword';
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
        case 'updateConfig':
        default:
            url = `${urlroot}/dateconfig/updateConfig`;
            break;
    }

    // Load content based on whether data needs to be sent or not
    if (Object.keys(dataToSend).length > 0) {
        $.post(url, dataToSend, function (response) {
            $('#pageContent').html(response);
        });
    } else {
        $.get(url, function (response) {
            $('#pageContent').html(response);
        });
    }
}