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
<script src="<?= base_url("Assets/js/app/dekubitus.js") ?>"></script>