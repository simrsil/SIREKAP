$(function () {
    $("#tanggalawal, #tanggalakhir").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true,
        // ✅ Set default hari ini
        defaultDate: new Date()
    });

    // ✅ Set nilai default hari ini saat halaman load
    let today = new Date().toISOString().slice(0, 10);
    $('#tanggalawal').val(today);
    $('#tanggalakhir').val(today);
});

let tabelMonitoringJKN = $('#table-monitoring-jkn').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: 'MonitoringJKN/dataDokterPoli',
        type: "POST",
        data: function (data) {
            data.tanggalawal  = $('#tanggalawal').val();
            data.tanggalakhir = $('#tanggalakhir').val();
        },
    },
    columns: [
        { data: 0, title: 'No' },
        { data: 1, title: 'Nama Dokter' },
        { data: 2, title: 'Poliklinik' },
        { data: 3, title: 'JKN' },
        { data: 4, title: 'Non JKN' },
        { data: 5, title: 'Total' },
    ]
});

// ✅ Fix: ID modal sesuai view
$('#btn-tampil').on('click', function () {
    $('#MonitoringBPJS').modal('hide'); // ✅ bukan RanapBPJS
    tabelMonitoringJKN.ajax.reload();
});

function exportExcelJKN() {
    let tanggalawal = $('#tanggalawal').val();
    let tanggalakhir = $('#tanggalakhir').val();
    if (tanggalawal == '' && tanggalakhir == '') {
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
       window.location.href = 'MonitoringJKN/export_excel/' + tanggalawal + '/' + tanggalakhir;
    }

}
  
$('#btn-export-excel').on('click', function () {
  exportExcelJKN()
})

