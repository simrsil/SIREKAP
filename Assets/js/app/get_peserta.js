$(document).ready(function () {
    $('#form-peserta').on('submit', function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: 'ApiBpjs/getPeserta',
            type: 'POST',
            data: formData,
            success: function (response) {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    iconColor: 'white',
                    customClass: {
                        popup: 'colored-toast',
                    },
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    background: '#3fc3ee',
                    color: '#ffff',
                });
                Toast.fire({
                    icon: 'success',
                    title: response,
                })
            },
            error: function (xhr, status, error) {
                console.error('Terjadi error:', error);
            }
        });
    });
});