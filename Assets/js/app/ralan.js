$(function () {
    $("#tglSepRajal1, #tglSepRajal2").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
let tabelSEPRajal = $('#tabel-sep-rajal').DataTable({
    processing: true,
    serverSide: true,
    orderable: false,
    paging: false,
    info: false,
    ajax: {
        url: 'SEPRajal/dataSEPRajal',
        type: "post",
        data: function (data) {
            data.tglSepRajal1 = $('#tglSepRajal1').val();
            data.tglSepRajal2 = $('#tglSepRajal2').val();
            // data.kd_dokter = kd_dokter
        },
    }
});
$('#tampil-sep-rajal').on('click', function () {
    $('#modalSEPRajal').modal('hide');
    tabelSEPRajal.ajax.reload();
});
$('#refresh-sep-rajal').on('click', function () {
    location.reload();
});

$(document).on('click', '.kd-dokter-btn', function () {
    // Ambil nilai dari atribut data-dokter
    const kd_dokter = $(this).data('dokter');
    // Tampilkan modal
    $('#modalDokter').modal('show');
    //menghapus inisialisasi dataTable
    if ($.fn.dataTable.isDataTable('#tabel-data-sep2')) {
        $('#tabel-data-sep2').DataTable().clear().destroy();
    }
$('#tabel-data-sep2').DataTable({
        processing: true,
        serverSide: true,
        orderable: false,
        paging: false,
        info: false,
        searching: false,
        ajax: {
            url: 'SEPRajal/dataPasienSEP',
            type: "post",
            data: function (data) {
                data.kd_dokter = kd_dokter;
                data.tglSepRajal1 = $('#tglSepRajal1').val();
                data.tglSepRajal2 = $('#tglSepRajal2').val();
            }
        }
    });
});