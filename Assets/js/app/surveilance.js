
  $(function() {
    $("#tanggal1, #tanggal2, #tanggal3").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true
    });
  });
$(function () {
  $("#tanggal4").datepicker({
    dateFormat: "yy-mm-dd",
    changeMonth: true,
    changeYear: true
  });
});

  function hapusdata() {
    document.getElementById("detailnamapasien").innerHTML = "";
    document.getElementById("detailrkm").innerHTML = "";
    document.getElementById("detailtgl_lahir").innerHTML = "";
    document.getElementById("detailtgl_ranap").innerHTML = "";
  }

$(document).ready(function () {
  $('#btn_tampil').on('click', function () {
    var norawat = $('#no_rawat').val();
    hapusdata();
    $.ajax({
      type: "POST",
      url: 'RekapanSurveilanceOperasi1/data',
      async: true,
      dataType: "JSON",
      data: {
        jnorawat: norawat,
      },
      success: function (data) {
        let operasi = data['validasi_operasi'][0]['row'];
        if (operasi == '0') {
          alert("Data Rekapan Surveilance yang dicari tidak ada");
        } else {
          $("#modal-xl").modal('show');

          document.getElementById("namapasien").innerHTML += data['pasien'][0]['nm_pasien'];
          document.getElementById("norkm").innerHTML += data['pasien'][0]['no_rkm_medis'];
          document.getElementById("tgl_lahir").innerHTML += data['pasien'][0]['tgl_lahir'];
          document.getElementById("tgl_ranap").innerHTML += data['pasien'][0]['tgl_registrasi'];

          document.getElementById("nm_operasi").innerHTML += data['operasi'][0]['nm_operasi'];
          document.getElementById("dokter_bedah").innerHTML += data['operasi'][0]['nm_dokter'];
          document.getElementById("waktu_pembedahan").innerHTML += data['operasi'][0]['waktu_pembedahan'];
          document.getElementById("diagnosa_preop").innerHTML += data['operasi'][0]['diagnosa_preop'];
          document.getElementById("tanggal").innerHTML += data['operasi'][0]['tanggal'];
          document.getElementById("durasi").innerHTML += data['operasi'][0]['durasi'];

          document.getElementById("merokok").innerHTML += data['preanastesi'][0]['riwayat_kebiasaan_merokok'];
          document.getElementById("suhu").innerHTML += data['preanastesi'][0]['suhu'];
          document.getElementById("terapi").innerHTML += data['preanastesi'][0]['riwayat_penyakit_terapi'];
          document.getElementById("asa").innerHTML += data['preanastesi'][0]['asa'];

          document.getElementById("perlengkapan_khusus").innerHTML += data['checklist_preoperasi'][0]['perlengkapan_khusus'];
          document.getElementById("antibiotik_profilaks").innerHTML += data['datatimeout'][0]['antibiotik_profilaks'];
          document.getElementById("nama_antibiotik").innerHTML += data['datatimeout'][0]['nama_antibiotik'];
          document.getElementById("jam_pemberian").innerHTML += data['datatimeout'][0]['jam_pemberian'];
          document.getElementById("petujuk_sterilisasi").innerHTML += data['datatimeout'][0]['petujuk_sterilisasi'];
          document.getElementById("resiko_kehilangan_darah").innerHTML += data['signin_sebelum_anestesi'][0]['resiko_kehilangan_darah'];
        }
      }
    });
  });
});

  function exportExcelOperasi() {
    let tanggal_1 = $('#tanggal3').val();
    let tanggal_2 = $('#tanggal4').val();
    if (tanggal_1 == '' && tanggal_2 == '') {
      alert('Tanggal Wajib Di Isi');
    } else {
      window.location.href = 'RekapanSurveilanceOperasi1/export_excel/' + tanggal_1 + '/' + tanggal_2;
    }
  }

$(document).ready(function () {
  let tabelOperasi = $('#table-operasi').DataTable({
    processing: true,
    serverSide: true,
    destroy: true, // Mencegah duplikasi DataTables
    autoWidth: false,
    ajax: {
      url: 'RekapanSurveilanceOperasi1/tampilanRekapOperasi',
      type: "POST",
      data: function (data) {
        data.tanggal3 = $('#tanggal3').val();
        data.tanggal4 = $('#tanggal4').val();
      },
      error: function (xhr, _, _) {
        console.log("Error DataTables:", xhr.responseText);
      }
    },
    columnDefs: [{
      targets: 0, // Kolom 1
      orderable: false,
      searchable: false,
      render: function (data, type, row) {
        return data; // Pastikan data bisa menampilkan HTML
      },
      width: "10%"
    },
    {
      targets: 1, // Kolom 2
      width: "5%"
    },
    {
      targets: 2, // Kolom 3
      width: "33%"
    },
    {
      targets: 3, // Kolom 4
      width: "5%"
    },
    {
      targets: 4, // Kolom 5
      width: "10%"
    },
    {
      targets: 5, // Kolom 6
      width: "10%"
    },
    {
      targets: 6, // Kolom 7
      width: "10%"
    },
    {
      targets: 7, // Kolom 8
      width: "10%"
    },
    ]
  });

  // Klik tombol "Tampilkan Data"
  $('#tampil-operasi').on('click', function () {
    let tanggal3 = $('#tanggal3').val();
    let tanggal4 = $('#tanggal4').val();

    if (tanggal3 === '' || tanggal4 === '') {
      alert('Tanggal wajib diisi!');
      return;
    }
    tabelOperasi.clear().draw(); // Bersihkan tabel sebelum reload data
    tabelOperasi.ajax.reload(null, false); // Tambahkan 'false' agar tidak reset paging

    setTimeout(() => {
      tabelOperasi.columns.adjust().draw(); // Pastikan lebar tetap
    }, 500);
  });
});

$(document).ready(function () {
  $('#table-operasi').on('click', '.detail-btn', function () {
    let norawat = $(this).data('no_rawat');
    hapusdata();
    $.ajax({
      type: "POST",
      url: 'RekapanSurveilanceOperasi1/data1',
      async: true,
      dataType: "JSON",
      data: {
        jnorawat: norawat
      },
      success: function (data) {
        $('#modalDetail').modal('show');

        if (data.pasien.length > 0) {
          $('#detail_no_rawat').text(norawat);
          $('#detailnamapasien').text(data.pasien[0].nm_pasien);
          $('#detailrkm').text(data.pasien[0].no_rkm_medis);
          $('#detailtgl_lahir').text(data.pasien[0].tgl_lahir);
          $('#detailtgl_ranap').text(data.pasien[0].tgl_registrasi);
        } else {
          $('#detailnamapasien').text('Data tidak ditemukan');
          $('#detailrkm').text('-');
          $('#detailtgl_lahir').text('-');
          $('#detailtgl_ranap').text('-');
        }

        // Kosongkan tabel sebelum mengisi ulang
        $('#table-detail-operasi tbody').empty();
        $('#table-detail-pre-anastesi tbody').empty();
        $('#table-detail-pre-operasi tbody').empty();
        $('#table-detail-tosi tbody').empty();
        $('#table-detail-ssa tbody').empty();

        if (data.operasi.length > 0) {
          data.operasi.forEach(function (item) {
            let row = `<tr>
                            <td>${item.nm_operasi}</td>
                            <td>${item.nm_dokter}</td>
                            <td>${item.waktu_pembedahan}</td>
                            <td>${item.diagnosa_preop}</td>
                            <td>${item.tanggal}</td>
                            <td>${item.selesaioperasi}</td>
                            <td>${item.durasi}</td>
                        </tr>`;
            $('#table-detail-operasi tbody').append(row);
          });
        } else {
          $('#table-detail-operasi tbody').append('<tr><td colspan="7">Data tidak ditemukan</td></tr>');
        }

        if (data.preanastesi.length > 0) {
          data.preanastesi.forEach(function (item) {
            let row = `<tr>
                            <td>${item.tanggal}</td>
                            <td>${item.riwayat_kebiasaan_merokok}</td>
                            <td>${item.suhu}</td>
                            <td>${item.riwayat_penyakit_terapi}</td>
                            <td>${item.asa}</td>
                        </tr>`;
            $('#table-detail-pre-anastesi tbody').append(row);
          });
        } else {
          $('#table-detail-pre-anastesi tbody').append('<tr><td colspan="5" class="text-center">Data tidak ditemukan</td></tr>');
        }

        if (data.checklist_preoperasi.length > 0) {
          data.checklist_preoperasi.forEach(function (item) {
            let row = `<tr>
                            <td>${item.tanggal}</td>
                            <td>${item.perlengkapan_khusus}</td>
                        </tr>`;
            $('#table-detail-pre-operasi tbody').append(row);
          });
        } else {
          $('#table-detail-pre-operasi tbody').append('<tr><td colspan="2" class="text-center">Data tidak ditemukan</td></tr>');
        }

        if (data.datatimeout.length > 0) {
          data.datatimeout.forEach(function (item) {
            let row = `<tr>
                            <td>${item.tanggal}</td>
                            <td>${item.antibiotik_profilaks}</td>
                            <td>${item.nama_antibiotik}</td>
                            <td>${item.jam_pemberian}</td>
                            <td>${item.petujuk_sterilisasi}</td>
                        </tr>`;
            $('#table-detail-tosi tbody').append(row);
          });
        } else {
          $('#table-detail-tosi tbody').append('<tr><td colspan="5" class="text-center">Data tidak ditemukan</td></tr>');
        }

        if (data.signin_sebelum_anestesi.length > 0) {
          data.signin_sebelum_anestesi.forEach(function (item) {
            let row = `<tr>
                            <td>${item.tanggal}</td>
                            <td>${item.resiko_kehilangan_darah}</td>
                        </tr>`;
            $('#table-detail-ssa tbody').append(row);
          });
        } else {
          $('#table-detail-ssa tbody').append('<tr><td colspan="2" class="text-center">Data tidak ditemukan</td></tr>');
        }
      },
      error: function (xhr, _,_) {
        console.error("Error AJAX:", xhr.responseText);
      }
    });
  });
});
