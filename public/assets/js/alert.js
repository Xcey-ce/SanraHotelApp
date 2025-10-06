// public/assets/js/alert.js
document.addEventListener('DOMContentLoaded', function () {
    const alertData = window.alertData || {};

    if (alertData.success) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: alertData.success,
            confirmButtonColor: '#3085d6'
        });
    }

    if (alertData.error) {
        Swal.fire({
            icon: 'error',
            title: 'Failed!',
            text: alertData.error,
            confirmButtonColor: '#d33'
        });
    }

    if (alertData.info) {
        Swal.fire({
            icon: 'info',
            title: 'Notice',
            text: alertData.info,
            confirmButtonColor: '#3085d6'
        });
    }
});
