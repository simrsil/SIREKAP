 $(function() {
    $("#tgl_awal, #tgl_akhir").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true
    });
  });
let tabelResepObatPerHari = $('#tabel-resep-obat').DataTable({
    processing: true,
    serverSide: true,
    searching:false,
    ajax: {
        type:"post",
        url: "Farmasi/dataResepObat",
        data: function (data) {
            data.tgl_awal = $("#tgl_awal").val();
            data.tgl_akhir = $("#tgl_akhir").val();
        }
    }
})
$("#tampil-farmasi").on('click', function () {
    tabelResepObatPerHari.ajax.reload();
    $("#modalFilter").modal('hide')
})

function excelResepObat() {
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
       window.location.href = 'Farmasi/ExcelJumlahResep/' + tgl_awal + '/' + tgl_akhir;
    }
};
  
$("#exportExcelResep").on("click", function () {
 excelResepObat()
});
