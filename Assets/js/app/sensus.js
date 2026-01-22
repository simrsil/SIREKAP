$(function () {
    $("#tglKeluar1, #tglKeluar2, #tglMasuk1, #tglMasuk2").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});

$(document).ready(function () {
    let tabelPasienKeluar = $('#tabel-pasien-keluar').DataTable({
        processing: true,
        serverSide: true,
        paging: false,
        ajax: {
            url: 'SensusHarian/dataPasienKeluar',
            type: "POST",
            data: function (data) {
                data.tglKeluar1 = $('#tglKeluar1').val();
                data.tglKeluar2 = $('#tglKeluar2').val();
                data.waktu = $('#waktu').val();
            },
        }
    })
    $('#tampil-pasien-keluar').on('click', function () {
        tabelPasienKeluar.ajax.reload();
        $('#modalPxKeluar').modal('hide');
    })
    let tabelPasienMasuk = $('#tabel-pasien-masuk').DataTable({
        processing: true,
        serverSide: true,
        paging: false,
        ajax: {
            url: 'SensusHarian/dataPasienMasuk',
            type: "post",
            data: function (data) {
                data.tglMasuk1 = $('#tglMasuk1').val();
                data.tglMasuk2 = $('#tglMasuk2').val();
            },
        }
    })
    $('#tampil-pasien-masuk').on('click', function () {
        tabelPasienMasuk.ajax.reload();
        $('#modalPxMasuk').modal('hide');
    })
});
