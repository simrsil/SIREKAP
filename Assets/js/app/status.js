
$("#tgl_awal, #tgl_akhir,#tgl_awal2, #tgl_akhir2").datepicker({
    dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true
});
let tabelStatusRMRalan = new DataTable('#tabel-rm-ralan', {
    serverSide: true,
    processing: true,
    ajax: {
        url: 'StatusRM/statusRMRalan',
        type: 'post',
        data: function (data) {
            data.tgl_awal = $('#tgl_awal').val()
            data.tgl_akhir = $('#tgl_akhir').val()
            data.status_ralan = $('#status-ralan').val();
        }
    }
});
$('#form-filter-status').on('submit', function (e) {
    e.preventDefault();
    tabelStatusRMRalan.ajax.reload();
    $('#filter-status-rm-ralan').modal('hide');
});

$('#export-ralan').on('click', function (e) {
    e.preventDefault();
    let tgl_awal = $('#tgl_awal').val();
    let tgl_akhir = $('#tgl_akhir').val();
    let status_ralan = $('#status-ralan').val();
    if (tgl_awal == '' && tgl_akhir == '') {
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
        const url = 'StatusRM/exportExcelRalan'
        const params = new URLSearchParams({
            tgl_awal: tgl_awal,
            tgl_akhir: tgl_akhir,
            status_ralan: status_ralan

        })
        window.location.href = `${url}?${params.toString()}`;
    }

});

let tabelStatusRMRanap = new DataTable('#tabel-rm-ranap', {
    serverSide: true,
    processing: true,
    ajax: {
        url: 'StatusRM/statusRMRanap',
        type: 'post',
        data: function (data) {
            data.tgl_awal2 = $('#tgl_awal2').val()
            data.tgl_akhir2 = $('#tgl_akhir2').val()
            data.status_ranap = $('#status-ranap').val();
        }
    }
});
        $('#form-filter-status-ranap').on('submit', function(e) {
            e.preventDefault();
            tabelStatusRMRanap.ajax.reload()
            $('#filter-status-rm-ranap').modal('hide');
        })

$('#export-ranap').on('click', function (e) {
    e.preventDefault();
    let tgl_awal = $('#tgl_awal2').val();
    let tgl_akhir = $('#tgl_akhir2').val();
    let status_ranap = $('#status-ranap').val();
    if (tgl_awal == '' && tgl_akhir == '') {
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
        const url = 'StatusRM/exportExcelRanap';
        const params = new URLSearchParams({
            tgl_awal2: tgl_awal,
            tgl_akhir2: tgl_akhir,
            status_ranap2: status_ranap

        })
        window.location.href = `${url}?${params.toString()}`;
    }

});
