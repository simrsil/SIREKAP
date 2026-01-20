$(document).ready(function () {
    let tabelLaporanPasien = $('#tabel-laporan-pasien').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: 'LaporanPasien/dataPasienPerBulan',
            type: "POST",
            data: function (data) {
                data.bulan = $('#bulan').val();
                data.tahun = $('#tahun').val();
            }
        }
    });
    $('#tampil-pasien-ranap').on('click', function () {
        tabelLaporanPasien.ajax.reload();
        $('#modalPx').modal('hide');
    });
});
$(document).ready(function () {
    let tabelLaporanPasien2 = $('#tabel-laporan-pasien2').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: 'LaporanPasien/dataPasienIGD',
            type: "POST",
            data: function (data) {
                data.bulan2 = $('#bulan2').val();
                data.tahun2 = $('#tahun2').val();
            }
        }
    });
    $('#tampil-pasien-igd').on('click', function () {
        tabelLaporanPasien2.ajax.reload();
        $('#modalPx2').modal('hide');
    });
});
$('#tampil-pasien-meninggal').on('click', function () {
    $.ajax({
        url: 'LaporanPasien/pasienMeninggal',
        type: "post",
        data: {
            bulan3: $('#bulan3').val(),
            tahun3: $('#tahun3').val(),
            lokasi: $('#lokasi').val()
        },
        dataType: "json",
        success: function (response) {
            if (response.jmlPxMati > 0) {
                Swal.fire({
                    title: 'Jumlah Pasien Meninggal',
                    html: `<h1 style="color: red;">${response.jmlPxMati}</h1>`,
                    icon: 'warning',
                    iconColor: 'red',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'swal2-popup-custom',
                        title: 'swal2-title-custom',
                        confirmButton: 'swal2-confirm-custom'
                    }
                });
            } else {
                Swal.fire({
                    title: 'Jumlah Pasien Meninggal',
                    html: `<h1 style="color: red;">0</h1>`,
                    icon: 'warning',
                    iconColor: 'red',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'swal2-popup-custom',
                        title: 'swal2-title-custom',
                        confirmButton: 'swal2-confirm-custom'
                    }
                });
            }
        }
    });
});