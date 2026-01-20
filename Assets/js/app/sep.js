$(function () {
    $("#tglSep1, #tglSep2").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
let tabelDataSEP = $('#tabel-data-sep').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: 'RekapSEP/dataSEP',
        type: "post",
        data: function (data) {
            data.tglSep1 = $('#tglSep1').val();
            data.tglSep2 = $('#tglSep2').val();
        }
    }
});
$('#tampil-rekap-sep').on('click', function () {
    $('#modalSEP').modal('hide');
    tabelDataSEP.ajax.reload();
});