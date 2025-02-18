
function loadPinSuspended() {
    var pinStatus = $("#pinStatus").val();

    var url = `${urlroot}/tables/pinssuspended?pinStatus=${pinStatus}`;
    loadPage(url, function(response) {
        $('#pageTable').html(response);
    });
}

/* $(document).ready(function() {
    loadPinSuspended();
}); */

$("#searchBtn").click(function() {
    loadPinSuspended();
});
