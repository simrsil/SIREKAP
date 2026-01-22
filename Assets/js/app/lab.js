$('#button-export-excel').on('click', function () {
    exportExcel();
    $('#modalPLab').modal('hide');
});

let dataPeriksalab = $('#tabel-periksa-lab').DataTable({
    processing: true,
    serverSide: true,
    orderable: false,
    searching: false,
    ajax: {
        url: 'PeriksaLab/dataPeriksaLab',
        type: "POST",
        data: function (data) {
            data.tahun4 = $('#tahun4').val();
            data.bulan4 = $('#bulan4').val();
        },
    }
});
$('#tampil-periksa-lab').on('click', function () {
    $('#modalPLab').modal('hide');
    dataPeriksalab.ajax.reload();
});

function exportExcel() {
    let tahun4 = $('#tahun4').val();
    let bulan4 = $('#bulan4').val();
    if (tahun4 == '' && bulan4 == '') {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            iconColor: 'white',
            customClass: {
                popup: 'colored-toast',
            },
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            background: '#17a2b8', // Warna latar belakang (green)
            color: 'white'
        });
         Toast.fire({
            icon: 'error',
             title: 'Tanggal Harus di Isi',
         })
    } else {
        window.location.href = 'PeriksaLab/export_excel/' + tahun4 + '/' + bulan4;
    }

}