
function loadUserAccounts() {
        var gsStatus = $("#gsStatus").val();
        //alert(gsStatus);
        
        var url = `${urlroot}/tables/goodstanding?gsStatus=${gsStatus}`;
        loadPage(url, function(response) {
            $('#pageTable').html(response);
        });
}
    
$(document).ready(function() {
    loadUserAccounts();
});

$("#saveBtn").click(function() {
    loadUserAccounts();
});
    