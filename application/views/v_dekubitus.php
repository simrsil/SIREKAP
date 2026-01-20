<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?= $title ?></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url('Dashboard') ?>">Home</a></li>
          <li class="breadcrumb-item active"><?= $title ?></li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="container-fluid" id="konten">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="ranap-tab" data-toggle="tab" data-target="#dokter-ranap" type="button" role="tab" aria-controls="dokter-ranap" aria-selected="true">Penilaian Risiko Dekubitus</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="igd-tab" data-toggle="tab" data-target="#dokter-igd" type="button" role="tab" aria-controls="dokter-igd" aria-selected="false">Kelengkapan Dekubitus</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="rekap-tab" data-toggle="tab" data-target="#rekapan-dekubitus" type="button" role="tab" aria-controls="rekapan-dekubitus" aria-selected="false">Rekapan Dekubitus</button>
      </li>
    </ul>

    <div class="tab-content" id="myTabContent">
      <!-- TAB 1 -->
      <div class="tab-pane fade show active" id="dokter-ranap" role="tabpanel" aria-labelledby="ranap-tab">
        <div class="card">
          <div class="card-header">
            Laporan Penilaian Risiko Dekubitus
          </div>
          <div class="card-body">
            <div class="col-12">
              <form method="POST">
                <div class="row">
                  <div class="margin">
                    <div class="btn-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal1" name="tanggal1" required>
                    </div>
                    <div class="btn-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal2" name="tanggal2" required>
                    </div>
                    <div class="btn-group">
                      <button type="button" class="btn btn-info btn-sm" id="tampil-penilaian-dekubitus"><i class="fas fa-eye"></i> Tampilkan</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="dropdown-divider"></div>
            <table class="table table-responsive-lg table-bordered" id="tabel-penilaian-dekubitus">
              <thead>
                <tr>
                  <th>No. Rawat</th>
                  <th>No. R.M</th>
                  <th>Nama Pasien</th>
                  <th>Tgl Lahir</th>
                  <th>JK</th>
                  <th>Tanggal</th>
                  <th>Total</th>
                  <th>Kategori</th>
                  <th>Petugas</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="card-footer">Footer</div>
        </div>
      </div>

      <!-- TAB 2 -->
      <div class="tab-pane fade" id="dokter-igd" role="tabpanel" aria-labelledby="igd-tab">
        <div class="card">
          <div class="card-header">
            Laporan Kelengkapan Dekubitus
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="col-12">
              <form method="POST">
                <div class="row">
                  <div class="margin">
                    <div class="btn-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal3" name="tanggal3" required>
                    </div>
                    <div class="btn-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal4" name="tanggal4" required>
                    </div>
                    <div class="btn-group">
                      <button type="button" class="btn btn-info btn-sm" id="tampil-kelengkapan-dekubitus"><i class="fas fa-eye"></i> Tampilkan</button>
                    </div>
                    <div class="btn-group">
                      <button type="button" class="btn btn-success btn-sm" onclick="BtnExportExcelKelengkapanDekubitus()"><i class="far fa-file-excel"></i> Export Excel</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="dropdown-divider"></div>
            <table class="table table-responsive-lg table-bordered table-sm" id="tabel-kelengkapan-dekubitus">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No. Rawat</th>
                  <th>No. RM</th>
                  <th>Nama Pasien</th>
                  <th>Tanggal Masuk</th>
                  <th>Aktifitas</th>
                  <th>Pengisian Dekubitus</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="card-footer">Footer</div>
        </div>
      </div>

      <!-- TAB 3 -->
      <div class="tab-pane fade" id="rekapan-dekubitus" role="tabpanel" aria-labelledby="rekap-tab">
        <div class="card">
          <div class="card-header">
            Laporan Jumlah Tirah Baring
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
            </div>
          </div>
          <div class="card-body">
            <div class="col-12">
              <form method="POST">
                <div class="row">
                  <div class="margin">
                    <div class="btn-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal5" name="tanggal5" required>
                    </div>
                    <div class="btn-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal6" name="tanggal6" required>
                    </div>
                    <div class="btn-group">
                      <button type="button" class="btn btn-info btn-sm" id="tampil-dekubitus"><i class="fas fa-eye"></i> Tampilkan</button>
                    </div>
                    <div class="btn-group">
                      <button type="button" class="btn btn-success btn-sm" onclick="BtnExportExcelRekapDekubitus()"><i class="far fa-file-excel"></i> Export Excel</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="dropdown-divider"></div>
            <table class="table table-responsive-lg table-bordered table-sm" id="table-dekubitus">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No. Rawat</th>
                  <th>Nama</th>
                  <th>No. RM</th>
                  <th>Tanggal Masuk</th>
                  <th>Tanggal Keluar</th>
                  <th>Lama</th>
                  <th>Status Pulang</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="card-footer">Footer</div>
        </div>
      </div>
    </div>
  </div>
</section>


<script>
  $(function() {
    $("#tanggal1, #tanggal2, #tanggal3, #tanggal4, #tanggal5, #tanggal6").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true
    });
  });
</script>

<script>
  $(document).ready(function() {
    let tabelPenilaianDekubitus = $('#tabel-penilaian-dekubitus').DataTable({
      // "buttons": ["copy", "csv", "excel", "pdf", "print"],
      processing: true,
      serverSide: true,
      ajax: {
        url: "<?= base_url('RekapanDekubitus/tampilanPenilaianDekubitus') ?>",
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
        url: "<?= base_url('RekapanDekubitus/TampilanKelengkapanDekubitus') ?>",
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
        url: "<?= base_url('RekapanDekubitus/tampilanDekubitus') ?>",
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
    window.location.href = `<?= base_url() ?>${controller}/export_excel/${tgl1}/${tgl2}`;
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
      let url = window.location.href = '<?= base_url('RekapanDekubitus/ExportExcelKelengkapanDekubitus/') ?>' + tanggal_3 + '/' + tanggal_4;
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
      let url = window.location.href = '<?= base_url('RekapanDekubitus/ExportExcelRekapDekubitus/') ?>' + tanggal_5 + '/' + tanggal_6;
    }

  }
</script>