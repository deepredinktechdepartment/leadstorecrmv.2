// public/js/sweetalert.js

$(document).ready(function() {
    // Handle the delete confirmation
    $('.delete-form').on('submit', function(e) {
        e.preventDefault();
        var form = this;

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});