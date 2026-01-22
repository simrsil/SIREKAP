<section class="content">
  <div class="container-fluid" id="konten">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            Laporan Task ID Kirim Antrian Online
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
              <div method="POST">
                <div class="row">
                  <div class="margin">
                    <div class="btn-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal1" name="tanggal1" required>
                    </div>
                    <div class="btn-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal2" name="tanggal2" required>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-info btn-sm" id="tampil-taskid"><i class="fas fa-eye"></i> Tampilkan</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <table class="table table-responsive table-bordered table-sm" id="table-taskid">
              <thead>
                <tr>
                  <th>No.Rawat</th>
                  <th>No.RM</th>
                  <th>Pasien</th>
                  <th>Cara Bayar</th>
                  <th>Status Pasien</th>
                  <th>SEP</th>
                  <th>T1</th>
                  <th>T2</th>
                  <th>T3</th>
                  <th>T4</th>
                  <th>T5</th>
                  <th>T6</th>
                  <th>T7</th>
                  <th>T99</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?= base_url("Assets/js/app/taskid.js") ?>"></script>