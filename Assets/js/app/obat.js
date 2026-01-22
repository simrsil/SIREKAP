  $(function() {
    $("#tanggal1, #tanggal2").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true
    });
  });
   // $(document).ready(function() {
  //   let tabelObatDokterRanap = $('#table-obat-dokter-ranap').DataTable({
  //     processing: true,
  //     serverSide: true,
  //     orderable: false,
  //     searching: false,
  //     paging: false,
  //     info: false,
  //     ajax: {
  //       url: "<?= base_url('ObatPerDokterRanap/dataObatDokterRanap') ?>",
  //       type: "POST",
  //       data: function(data) {
  //         data.tanggal1 = $('#tanggal1').val();
  //         data.tanggal2 = $('#tanggal2').val();
  //         data.status = $('#status').val();
  //       },
  //     }
  //   })
  //   $('#tampil-obat-ranap').on('click', function() {
  //     let tanggal1 = $('#tanggal1').val();
  //     let tanggal2 = $('#tanggal2').val();
  //     let dokter = $('#status').val();
  //     if (tanggal1 == '' || tanggal2 == '' || dokter == '') {
  //       alert("Tanggal dan dokter harus di isi");
  //     } else {
  //       tabelObatDokterRanap.ajax.reload();
  //     }

  //   })

  // });

  $('#btn-export-excel').on('click', function() {
    exportExcelObat();
  })

function exportExcelObat() {
    let tanggal1 = $('#tanggal1').val();
    let tanggal2 = $('#tanggal2').val();
    let status = $('#status').val();
    let dokter = $("#dokter").val();
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
    if (tanggal1 == '' && tanggal2 == '') {
      Toast.fire({
        icon: 'error',
        title: 'Tanggal Harus di Isi',
      })
    } else if (status == '') {
      Toast.fire({
        icon: 'error',
        title: 'Status Harus di Isi',
      })
    } else if (dokter == '') {
      Toast.fire({
        icon: 'error',
        title: 'Dokter Harus di Isi',
      })
    } else {
      let baseUrl = ($('#status').val() == '2') ?
        'ObatPerDokter/export_excel/' :
       'ObatPerDokter/export_excel_dpjp/';
      window.location.href = baseUrl + tanggal1 + '/' + tanggal2 + '/' + status + '/' + dokter;
    }
};