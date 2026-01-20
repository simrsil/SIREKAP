<section class="content">
  <div class="container-fluid" id="konten">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            Audit Kepatuhan APD
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
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal1" name="tanggal1">
                    </div>
                    <div class="btn-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal2" name="tanggal2">
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-info btn-sm" id="tampil-audit"><i class="fas fa-eye"></i> Tampilkan</button>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-success btn-sm" onclick="exportExcelCAuditApd()"><i class="far fa-file-excel"></i> Export Excel</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <table class="table table-responsive-lg table-bordered table-sm" id="table-audit-apd">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Tanggal Audit</th>
                  <th scope="col">Tindakan</th>
                  <th scope="col">NIP/Kode</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Jabatan</th>
                  <th scope="col">Topi</th>
                  <th scope="col">Masker</th>
                  <th scope="col">Kacamata</th>
                  <th scope="col">Sarung Tangan</th>
                  <th scope="col">Apron</th>
                  <th scope="col">Sepatu</th>
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
<script src="<?= base_url('Assets/js/app/apd.js') ?>"></script>