$(function () {
    $("#tanggal1, #tanggal2").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
$(document).ready(function () {
    let tabelRadiologi = $('#table-radiologi').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: 'RekapanRanap/RawatInap',
            type: "POST",
            data: function (data) {
                data.tanggal1 = $('#tanggal1').val();
                data.tanggal2 = $('#tanggal2').val();
            },
        }
    })
    $('#tampil-radiologi').on('click', function () {
        tabelRadiologi.ajax.reload();
    });
});