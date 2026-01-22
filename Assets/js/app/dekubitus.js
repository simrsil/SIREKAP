$(function() {
    $("#tanggal1, #tanggal2, #tanggal3, #tanggal4, #tanggal5, #tanggal6").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true
    });
})
$(document).ready(function() {
    let tabelPenilaianDekubitus = $('#tabel-penilaian-dekubitus').DataTable({
      // "buttons": ["copy", "csv", "excel", "pdf", "print"],
      processing: true,
      serverSide: true,
      ajax: {
        url: 'RekapanDekubitus/tampilanPenilaianDekubitus',
        type: "POST",
        data: function(data) {
          data.tanggal1 = $('#tanggal1').val();
          data.tanggal2 = $('#tanggal2').val();
        },
      }
    })
    $('#tampil-penilaian-dekubitus').on('click', function() {
      let tanggal1 = $('#tanggal1').val();
      let tanggal2 = $('#tanggal2').val();

      if (tanggal1 === '' || tanggal2 === '') {
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
        return;
      }
      tabelPenilaianDekubitus.ajax.reload();
    })

});
$(document).ready(function() {
    let tabelKelengkapatanDekubitus = $('#tabel-kelengkapan-dekubitus').DataTable({
      // "buttons": ["copy", "csv", "excel", "pdf", "print"],
      processing: true,
      serverSide: true,
      ajax: {
        url:'RekapanDekubitus/TampilanKelengkapanDekubitus',
        type: "POST",
        data: function(data) {
          data.tanggal3 = $('#tanggal3').val();
          data.tanggal4 = $('#tanggal4').val();
        },
      }
    })
    $('#tampil-kelengkapan-dekubitus').on('click', function() {
      let tanggal3 = $('#tanggal3').val();
      let tanggal4 = $('#tanggal4').val();

      if (tanggal3 === '' || tanggal4 === '') {
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
        return;
      }
      tabelKelengkapatanDekubitus.ajax.reload();
    })

});
$(document).ready(function() {
    let tabelDekubitus = $('#table-dekubitus').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: 'RekapanDekubitus/tampilanDekubitus',
        type: "POST",
        data: function(data) {
          data.tanggal5 = $('#tanggal5').val();
          data.tanggal6 = $('#tanggal6').val();
        },
      }
    })
    $('#tampil-dekubitus').on('click', function() {
      let tanggal5 = $('#tanggal5').val();
      let tanggal6 = $('#tanggal6').val();

      if (tanggal5 === '' || tanggal6 === '') {
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
        return;
      }
      tabelDekubitus.ajax.reload();
    })

});
$(document).ready(function() {
    let tabelDekubitus = $('#tabel-Penilaian-Risiko-Dekubitus').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: "<?= base_url('') ?>",
        type: "POST",
        data: function(data) {
          data.tanggal5 = $('#tanggal5').val();
          data.tanggal6 = $('#tanggal6').val();
        },
      }
    })
    $('#tampil-dekubitus').on('click', function() {
      let tanggal5 = $('#tanggal5').val();
      let tanggal6 = $('#tanggal6').val();

      if (tanggal5 === '' || tanggal6 === '') {
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
        return;
      }
      tabelDekubitus.ajax.reload();
    })

});
function exportExcel(controller, tanggalAwalId, tanggalAkhirId) {
    let tgl1 = $('#' + tanggalAwalId).val();
    let tgl2 = $('#' + tanggalAkhirId).val();

    if (!tgl1 || !tgl2) {
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
      return;
    }
    window.location.href = `${controller}/export_excel/${tgl1}/${tgl2}`;
}
function BtnExportExcelKelengkapanDekubitus() {
    let tanggal_3 = $('#tanggal3').val();
    let tanggal_4 = $('#tanggal4').val();
    if (tanggal_3 == '' && tanggal_4 == '') {
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
      let url = window.location.href = 'RekapanDekubitus/ExportExcelKelengkapanDekubitus/' + tanggal_3 + '/' + tanggal_4;
    }

}
function BtnExportExcelRekapDekubitus() {
    let tanggal_5 = $('#tanggal5').val();
    let tanggal_6 = $('#tanggal6').val();
    if (tanggal_5 == '' && tanggal_6 == '') {
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
       window.location.href = 'RekapanDekubitus/ExportExcelRekapDekubitus/' + tanggal_5 + '/' + tanggal_6;
    }

}
  