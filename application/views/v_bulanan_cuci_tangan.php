<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1><?= $title ?></h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="<?= base_url('rekapanCuciTangan') ?>">Home</a></li>
          <li class="breadcrumb-item active"><?= $title ?></li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="container-fluid" id="konten">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            Data Audit Cuci Tangan
          </div>
          <div class="card-body">
            <div class="col-12">
              <div>
                <div class="row">
                  <div class="margin">
                    <div class="btn-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal1" name="tanggal1">
                    </div>
                    <div class="btn-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal2" name="tanggal2">
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-info btn-sm" id="tampil-cuci-tangan"><i class="fas fa-eye"></i> Tampilkan</button>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-success btn-sm" onclick="exportExcelCuciTangan()"><i class="far fa-file-excel"></i> Export Excel</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <table class="table table-responsive-lg table-bordered table-sm" id="table-cuci-tangan">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Tanggal</th>
                  <th scope="col">NIP/Kode</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Jabatan</th>
                  <th scope="col">Sebelum Menyentuh Pasien</th>
                  <th scope="col">Sebelum Tehnik Aseptik</th>
                  <th scope="col">Setelah Terpapar Cairan Tubuh Pasien</th>
                  <th scope="col">Setelah Kontak Dengan Pasien</th>
                  <th scope="col">Setelah Kontak Dengan Lingkungan Pasien</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="card-footer">
            Footer
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>
<script>
  $(function() {
    $("#tanggal1, #tanggal2").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true
    });
  });
</script>
<script>
  $(document).ready(function() {
    let tabelCuciTangan = $('#table-cuci-tangan').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
        url: "<?= base_url('RekapanCuciTangan/tampilCuciTangan') ?>",
        type: "POST",
        data: function(data) {
          data.tanggal1 = $('#tanggal1').val();
          data.tanggal2 = $('#tanggal2').val();
        },
      }
    })
    $('#tampil-cuci-tangan').on('click', function() {
      tabelCuciTangan.ajax.reload();
    })

  });

  function exportExcelCuciTangan() {
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
      let url = window.location.href = '<?= base_url('RekapanCuciTangan/export_excel/') ?>' + tanggal_1 + '/' + tanggal_2;
    }

  }
</script>