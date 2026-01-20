$(function () {
    $("#tgl_awal, #tgl_akhir,#tgl_awal2, #tgl_akhir2,#tgl_awal3, #tgl_akhir3").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
let tabelDiagnosaUmur = new DataTable('#tabel-data-diagnosa', {
    processing: true,
    serverSide: true,
    ajax: {
        type: "post",
        url: 'DiagnosaPasienPerUmur/getDiagnosaPasienPerUmur',
        data: function (data) {
            data.tgl_awal = $('#tgl_awal').val();
            data.tgl_akhir = $('#tgl_akhir').val();
            data.diagnosa = $('#diagnosa').val();

        },
        dataSrc: function (json) {
            $("#jml-kunjungan-lk").text(json.kunjungan_lk)
            $("#jml-kunjungan-pr").text(json.kunjungan_pr)
            return json.data;
        }
    },
});
$('#form-filter-diagnosa').on('submit', function (e) {
    e.preventDefault();
    tabelDiagnosaUmur.ajax.reload();
});
let tabelDiagnosaUmurRanap = new DataTable('#tabel-data-diagnosa-ranap', {
    processing: true,
    serverSide: true,
    ajax: {
        type: "post",
        url: 'DiagnosaPasienPerUmur/getDiagnosaPasienPerUmurRanap',
        data: function (data) {
            data.tgl_awal2 = $('#tgl_awal2').val();
            data.tgl_akhir2 = $('#tgl_akhir2').val();
            data.diagnosa_ranap = $('#diagnosa_ranap').val();
        },
        dataSrc: function (json) {
            $("#jml-meninggal-lk").text(json.meninggal_lk)
            $("#jml-meninggal-pr").text(json.meninggal_pr)
            return json.data;
        }
    }
});
$('#form-filter-diagnosa-ranap').on('submit', function (e) {
    e.preventDefault();
    tabelDiagnosaUmurRanap.ajax.reload();
});
let tabelDiagnosaKasusBaru = new DataTable('#tabel-data-kasus', {
    processing: true,
    serverSide: true,
    ajax: {
        type: "post",
        url: 'DiagnosaPasienPerUmur/diagnosaKasusBaru',
        data: function (data) {
            data.tgl_awal3 = $('#tgl_awal3').val();
            data.tgl_akhir3 = $('#tgl_akhir3').val();
            data.diagnosa_kasus = $('#diagnosa_kasus').val();
        },
        dataSrc: function (json) {
            $("#jml-knj-kasus-lk").text(json.kunjungan_kasus_lk)
            $("#jml-knj-kasus-pr").text(json.kunjungan_kasus_pr)
            return json.data;
        }
    }
});
$('#form-filter-kasus-baru').on('submit', function (e) {
    e.preventDefault();
    tabelDiagnosaKasusBaru.ajax.reload();
});