// public/js/datatables.js

$(document).ready(function() {
    $('#jquery-data-table').DataTable({
        "pageLength": 50, // Default to show 50 records
        "lengthMenu": [10, 25, 50, 100], // Options for number of records per page
        "responsive": true
    });
    $('#active-users-table,#inactive-users-table').DataTable({
        "pageLength": 50, // Default to show 50 records
        "lengthMenu": [10, 25, 50, 100], // Options for number of records per page
        "responsive": true
    });

    $('#active-clients-table,#inactive-clients-table').DataTable({
        "pageLength": 50, // Default to show 50 records
        "lengthMenu": [10, 25, 50, 100], // Options for number of records per page
        "responsive": true
    });
});