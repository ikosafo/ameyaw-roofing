
function populateYearDropdown(startYear) {
    const dropdown = document.getElementById('yearDropdown');

    // Check if the dropdown element exists
    if (!dropdown) {
        console.error('Error: The element with ID "yearDropdown" was not found.');
        return;
    }

    const currentYear = new Date().getFullYear();

    // Add the "All" option
    const allOption = document.createElement('option');
    allOption.value = "all";
    allOption.textContent = "All";
    dropdown.appendChild(allOption);

    // Add year options
    for (let year = startYear; year <= currentYear; year++) {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        dropdown.appendChild(option);
    }
}

// Call the function with the starting year
populateYearDropdown(2019);


function loadUserAccounts() {
    var yearDropdown = $("#yearDropdown").val();
    var verification = $("#verification").val();

    var url = `${urlroot}/tables/useraccounts?year=${yearDropdown}&verification=${verification}`;
    loadPage(url, function(response) {
        $('#pageTable').html(response);
    });
}

/* $(document).ready(function() {
    loadUserAccounts();
}); */

$("#searchBtn").click(function() {
    loadUserAccounts();
});

