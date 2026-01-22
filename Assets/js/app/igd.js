
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
            url: 'RekapIGD/RekapJumlahIndikatorPrimer',
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

    $('#tampil-triase').on('click', function () {
        tabelTriase.ajax.reload();
    });
});
$(document).ready(function () {
    let tabelTriaseSekunder = $('#tabel-triase-sekunder').DataTable({
        processing: true,
        serverSide: false,
        paging: false,
        info: false,
        searching: false,
        ajax: {
            url: 'RekapIGD/RekapJumlahIndikatorSekunder',
            type: "POST",
            data: function (data) {
                data.tglTriaseAwal = $('#tglTriaseAwal').val();
                data.tglTriaseAkhir = $('#tglTriaseAkhir').val();
            },
            dataSrc: ''
        },
        columns: [{
            data: 'plan',
            width: '70%'
        },
        {
            data: 'total',
            width: '30%'
        }
        ]
    });

    $('#tampil-triase').on('click', function () {
        tabelTriaseSekunder.ajax.reload();
    });
});
