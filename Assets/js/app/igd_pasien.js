
$(function () {
    $("#tglTriaseAwal, #tglTriaseAkhir").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
$(document).ready(function () {
    let tabelTriase = $('#tabel-triase-primer').DataTable({
        processing: true,
        serverSide: false,
        paging: false,
        info: false,
        searching: false,
        ajax: {
            url: 'RekapIGDJumlahPasien/JmlPasienIGDRalanRanap',
            type: "POST",
            data: function (data) {
                data.tglTriaseAwal = $('#tglTriaseAwal').val();
                data.tglTriaseAkhir = $('#tglTriaseAkhir').val();
            },
            dataSrc: ''
        },
        columns: [{
            data: 'plan',
            width: "80%"
        },
        {
            data: 'total',
            width: "30%"
        }
        ]
    });

    $('#btn-tampil').on('click', function () {
        tabelTriase.ajax.reload();
    });
});

$(document).ready(function () {
    let tabelPasienIGDStts = $('#tabel-status-pasien').DataTable({
        processing: true,
        serverSide: false,
        paging: false,
        info: false,
        searching: false,
        ajax: {
            url: 'RekapIGDJumlahPasien/JmlPasienIGDStts',
            type: "POST",
            data: function (data) {
                data.tglTriaseAwal = $('#tglTriaseAwal').val();
                data.tglTriaseAkhir = $('#tglTriaseAkhir').val();
            },
            dataSrc: ''
        },
        columns: [{
            data: 'stts',
            width: "80%"
        },
        {
            data: 'total_stts',
            width: "30%"
        }
        ]
    });

    $('#btn-tampil').on('click', function () {
        tabelPasienIGDStts.ajax.reload();
    });
});
