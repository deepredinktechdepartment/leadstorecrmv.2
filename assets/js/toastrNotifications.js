$(document).ready(function() {
    const toastrOptions = {
        closeButton: true,
        progressBar: true,
        timeOut: 60000, // Time before hiding (60 seconds)
        extendedTimeOut: 10000, // Time for extended timeout on mouse hover (10 seconds)
        preventDuplicates: false,
        tapToDismiss: false,
        hideEasing: 'linear', // Easing method for hiding
        hideMethod: 'fadeOut', // Animation method for hiding
        hideDuration: 5000, // Duration for the hiding animation (5 seconds)
        closeDuration: 100 // Duration for the closing animation (0.1 seconds)
    };

    toastr.options = toastrOptions;

    if (typeof toastrMessages !== 'undefined') {
        if (toastrMessages.toast_success) {
            toastr.success(toastrMessages.toast_success);
        }
        if (toastrMessages.message) {
            toastr.success(toastrMessages.message);
        }
        if (toastrMessages.success) {
            toastr.success(toastrMessages.success);
        }
        if (toastrMessages.error) {
            toastr.error(toastrMessages.error);
        }
        if (toastrMessages.info) {
            toastr.info(toastrMessages.info);
        }
        if (toastrMessages.warning) {
            toastr.warning(toastrMessages.warning);
        }
    }
});