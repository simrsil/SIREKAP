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
    pageLength: 50,
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
        { data: 4, title: 'On Site' },
        { data: 5, title: 'SEP Cetak' },
        { data: 6, title: 'Total' },
    ],

    footerCallback: function (row, data, start, end, display) {

        let api = this.api();

        let totalJKN = 0;
        let totalOnsite = 0;
        let totalSep = 0;
        let totalSemua = 0;

        data.forEach(function (row) {
            totalJKN += parseInt(row[3]) || 0;
            totalOnsite += parseInt(row[4]) || 0;
            totalSep += parseInt(row[5]) || 0;
            totalSemua += parseInt(row[6]) || 0;
        });

        $('#total-jkn').text(totalJKN);
        $('#total-onsite').text(totalOnsite);
        $('#total-sep').text(totalSep);
        $('#total-semua').text(totalSemua);

        // Persentase JKN
    let persentaseJKN = totalSemua > 0
        ? (totalJKN / totalSemua) * 100
        : 0;

    // Persentase Onsite
    let persentaseOnsite = totalSemua > 0
        ? (totalOnsite / totalSemua) * 100
        : 0;

    $('#presentase-jkn').text(persentaseJKN.toFixed(2) + '%');
    $('#presentase-onsite').text(persentaseOnsite.toFixed(2) + '%');
    }
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

