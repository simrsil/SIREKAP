$(function () {
    $("#tanggal1, #tanggal2").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});

let tabelBpjsRanap = $('#table-ranap-bpjs').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: 'PasienRanapBpjs/dataPasienBpjs',
        type: "POST",
        data: function (data) {
            data.tanggal1 = $('#tanggal1').val();
            data.tanggal2 = $('#tanggal2').val();
        },
    }
});
$('#tampil-bpjs-ranap').on('click', function () {
  $('#RanapBPJS').modal('hide');
    tabelBpjsRanap.ajax.reload();
});
function exportExcelBPJSRanap() {
    let tanggal1 = $('#tanggal1').val();
    let tanggal2 = $('#tanggal2').val();
    if (tanggal1 == '' && tanggal2 == '') {
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
       window.location.href = 'PasienRanapBpjs/export_excel/' + tanggal1 + '/' + tanggal2;
    }

}
  
$('#exportExcelBpjs').on('click', function () {
  exportExcelBPJSRanap()
})

