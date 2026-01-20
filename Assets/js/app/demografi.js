$(function () {
    $("#tgl_awal, #tgl_akhir").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
let tabelDemografiUmur = new DataTable('#tabel-demografi-umur', {
    processing: true,
    serverSide: true,
    ajax: {
        url: 'DemografiRegistrasi/getDemografiUmur',
        type: 'post',
        data: function (data) {
            data.tgl_awal = $('#tgl_awal').val();
            data.tgl_akhir = $('#tgl_akhir').val();
        }
    }
});
let tabelDemografiSuku = new DataTable('#tabel-demografi-suku', {
    processing: true,
    serverSide: true,
    ajax: {
        url: 'DemografiRegistrasi/getDemografiSuku',
        type: 'post',
        data: function (data) {
            data.tgl_awal = $('#tgl_awal').val();
            data.tgl_akhir = $('#tgl_akhir').val();
            data.kabupaten = $('#kabupaten').val();
            data.umur = $('#umur').val();
        }
    }
});
let tabelDemografiPendidikan = new DataTable('#tabel-demografi-pendidikan', {
    processing: true,
    serverSide: true,
    ajax: {
        url: 'DemografiRegistrasi/getDemografiPendidikan',
        type: 'post',
        data: function (data) {
            data.tgl_awal = $('#tgl_awal').val();
            data.tgl_akhir = $('#tgl_akhir').val();
            data.kabupaten = $('#kabupaten').val();
            data.umur = $('#umur').val();
        }
    }
});
let tabelDemografiAgama = new DataTable('#tabel-demografi-agama', {
    processing: true,
    serverSide: true,
    ajax: {
        url: 'DemografiRegistrasi/getDemografiAgama',
        type: 'post',
        data: function (data) {
            data.tgl_awal = $('#tgl_awal').val();
            data.tgl_akhir = $('#tgl_akhir').val();
            data.kabupaten = $('#kabupaten').val();
            data.umur = $('#umur').val();
        }
    }
});
let tabelDemografiBahasa = new DataTable('#tabel-demografi-bahasa', {
    processing: true,
    serverSide: true,
    ajax: {
        url: 'DemografiRegistrasi/getDemografiBahasa',
        type: 'post',
        data: function (data) {
            data.tgl_awal = $('#tgl_awal').val();
            data.tgl_akhir = $('#tgl_akhir').val();
        }
    }
});
let tabelDemografiKec = new DataTable('#tabel-demografi-kecamatan', {
    processing: true,
    serverSide: true,
    ajax: {
        url: 'DemografiRegistrasi/getDemografiKecamatan',
        type: 'post',
        data: function (data) {
            data.tgl_awal = $('#tgl_awal').val();
            data.tgl_akhir = $('#tgl_akhir').val();
        }
    }
});
let tabelDemografiKec2 = new DataTable('#tabel-demografi-kecamatan2', {
    processing: true,
    serverSide: true,
    ajax: {
        url: 'DemografiRegistrasi/getDemografiKecamatan2',
        type: 'post',
        data: function (data) {
            data.tgl_awal = $('#tgl_awal').val();
            data.tgl_akhir = $('#tgl_akhir').val();
        }
    }
});
$('#form-filter-demografi').on('submit', function (e) {
    e.preventDefault();
    tabelDemografiSuku.ajax.reload();
    tabelDemografiPendidikan.ajax.reload();
    tabelDemografiAgama.ajax.reload();
    tabelDemografiBahasa.ajax.reload();
    tabelDemografiUmur.ajax.reload();
    tabelDemografiKec.ajax.reload();
    tabelDemografiKec2.ajax.reload();
    $('#modal-filter-demografi').modal('hide');
});
$('#export-excel').on('click', function () {
    let tgl_awal = $('#tgl_awal').val();
    let tgl_akhir = $('#tgl_akhir').val();
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
            background: '#17a2b8',
            color: 'white'
        });
        Toast.fire({
            icon: 'error',
            title: 'Tanggal Harus di Isi',
        })
    } else {
        let url = window.location.href = 'DemografiRegistrasi/exportExcel/' + tgl_awal + '/' + tgl_akhir;
    }
});