 $(function() {
    $("#tanggal1, #tanggal2, #tgl_awal, #tgl_akhir").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true
    });
  });
let tabelRadiologi = $('#table-radiologi').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: "RekapanRadiologi/tampilRadiologi",
    type: "POST",
    data: function (data) {
      data.tanggal1 = $('#tanggal1').val();
      data.tanggal2 = $('#tanggal2').val();
    },
  }
});
$('#tampil-radiologi').on('click', function () {
$('#modalFilterRad').modal('hide');
  tabelRadiologi.ajax.reload();
});
  function exportExcel() {
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
        background: '#17a2b8',
        color: 'white'
      });
      Toast.fire({
        icon: 'error',
        title: 'Tanggal Harus di Isi',
      })
    } else {
       window.location.href = 'RekapanRadiologi/export_excel/' + tanggal_1 + '/' + tanggal_2;
    }
  };
$("#exportExcelRad").on("click", function () {
  exportExcel()
});
// Jumlah Pasien Per Hari
let tabelJumlahPasienPerHari = $('#tabel-jumlah').DataTable({
  processing: true,
  serverSide: true,
  searching:false,
  ajax: {
    type: 'post',
    url: 'RekapanRadiologi/dataRadiologiPerHari',
    data: function (data) {
      data.tgl_awal = $('#tgl_awal').val();
      data.tgl_akhir = $('#tgl_akhir').val();
    }
  }
})
$('#tampil-radiologi2').on('click', function () {
$('#modalFilterRad2').modal('hide');
  tabelJumlahPasienPerHari.ajax.reload();
});

function excelPasienPerHari() {
    let tgl_awal = $('#tgl_awal').val();
    let tgl_akhir = $('#tgl_akhir').val();
    if (tgl_awal == '' && tgl_akhir == '') {
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
       window.location.href = 'RekapanRadiologi/excel_pasien_per_hari/' + tgl_awal + '/' + tgl_akhir;
    }
  };
$("#exportExcelRad2").on("click", function () {
  excelPasienPerHari()
});
