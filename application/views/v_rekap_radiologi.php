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
  </div><!-- /.container-fluid -->
</section>
<section class="content">
  <div class="container-fluid" id="konten">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            Data Periksa Radiologi
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="col-12">
              <div>
                <div class="row">
                  <div class="margin">
                    <div class="btn-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal1" name="tanggal1" required>
                    </div>
                    <div class="btn-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal2" name="tanggal2" required>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-info btn-sm" id="tampil-radiologi"><i class="fas fa-eye"></i> Tampilkan</button>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-success btn-sm" onclick="exportExcel()"><i class="far fa-file-excel"></i> Export Excel</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <table class="table table-responsive-lg table-bordered table-sm" id="table-radiologi">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Tanggal Periksa</th>
                  <th scope="col">Nama Dokter</th>
                  <th scope="col">Nama Pasien</th>
                  <th scope="col">Pemeriksaan</th>
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
    let tabelRadiologi = $('#table-radiologi').DataTable({
      processing: true,
      serverSide: true,

      ajax: {
        url: "<?= base_url('RekapanRadiologi/tampilRadiologi') ?>",
        type: "POST",
        data: function(data) {
          data.tanggal1 = $('#tanggal1').val();
          data.tanggal2 = $('#tanggal2').val();
        },
      }
    })
    $('#tampil-radiologi').on('click', function() {
      tabelRadiologi.ajax.reload();
    })
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
        background: '#17a2b8', // Warna latar belakang (green)
        color: 'white'
      });
      Toast.fire({
        icon: 'error',
        title: 'Tanggal Harus di Isi',
      })
    } else {
      let url = window.location.href = '<?= base_url('RekapanRadiologi/export_excel/') ?>' + tanggal_1 + '/' + tanggal_2;
    }

  }
</script>