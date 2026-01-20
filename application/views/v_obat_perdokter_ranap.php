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
            Obat Per Dokter Ranap
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
            <div class="row">
              <div class="col-8 flex-wrap">
                <div>
                  <div class="row">
                    <div class="col- ">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal1" name="tanggal1" required>
                    </div>
                    <div class="col-">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal2" name="tanggal2" required>
                    </div>
                    <div class="col-">
                      <select class="form-control form-control-sm" name="status" id="status">
                        <option value="">--Pilih Status--</option>
                        <option value="1">Dokter DPJP</option>
                        <option value="2">Dokter Jaga</option>
                      </select>
                    </div>
                    <div class="col-">
                      <select class="form-control form-control-sm" name="dokter" id="dokter">
                        <option value="">--Pilih Dokter--</option>
                        <?php foreach ($dokter as $d) : ?>
                          <option value="<?= $d->kd_dokter ?>"><?= $d->nm_dokter ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col- ml-2">
                      <button class="btn btn-info btn-sm" id="tampil-obat-ranap" disabled><i class="fas fa-eye"></i> Tampilkan</button>
                      <button class="btn btn-success btn-sm" id="btn-export-excel"><i class="far fa-file-excel"></i> Export Excel</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <table class="table table-responsive-lg table-bordered table-sm" id="table-obat-dokter-ranap">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Dokter</th>
                  <th scope="col">Obat</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="card-footer">
            Footer
          </div>
        </div>
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
        '<?= base_url('ObatPerDokter/export_excel/') ?>' :
        '<?= base_url('ObatPerDokter/export_excel_dpjp/') ?>';
      window.location.href = baseUrl + tanggal1 + '/' + tanggal2 + '/' + status + '/' + dokter;
    }

  }
</script>