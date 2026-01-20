  $(function() {
    $("#tanggal1, #tanggal2").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true
    });
  });
let tabelAudit = $('#table-audit-apd').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url:'RekapanAuditAPD/tampilAudit',
        type: "POST",
        data: function (data) {
            data.tanggal1 = $('#tanggal1').val();
            data.tanggal2 = $('#tanggal2').val();
        },
    }
}); 
$('#tampil-audit').on('click', function () {
    tabelAudit.ajax.reload();
});
function exportExcelCAuditApd() {
    let tanggal_1 = $('#tanggal1').val();
    let tanggal_2 = $('#tanggal2').val();
    if (tanggal_1 == '' && tanggal_2 == '') {
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
        background: '#17a2b8', // Warna latar belakang (green)
        color: 'white'
      });
      Toast.fire({
        icon: 'error',
        title: 'Tanggal Harus di Isi',
      })
    } else {
       window.location.href = 'RekapanAuditAPD/export_excel/' + tanggal_1 + '/' + tanggal_2;
    }

  }
