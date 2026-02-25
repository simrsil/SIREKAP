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
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Pasien Radiologi</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Jumlah Per Hari</button>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="card">
              <div class="card-header">
                Data Pasien Radiologi
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalFilterRad">
                    <i class="fas fa-filter"></i>
                  </button>
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
                </div>
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
              <!-- /.card-footer-->
            </div>
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card">
              <div class="card-header">
                Pasien Radiologi Per Hari
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalFilterRad2">
                    <i class="fas fa-filter"></i>
                  </button>
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
                </div>
                <table class="table table-responsive-lg table-bordered table-sm" id="tabel-jumlah">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Tanggal Periksa</th>
                      <th scope="col">Jumlah Pasien Ralan</th>
                      <th scope="col">Jumlah Pasien Ranap</th>
                      <th scope="col">Jumlah Pasien</th>
                    </tr>
                  </thead>
                </table>
              </div>
              <!-- /.card-footer-->
            </div>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
</section>
<!-- modal filter radiologi -->
<div class="modal fade" id="modalFilterRad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal1" name="tanggal1" required>
          </div>
          <div class="col">
            <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal2" name="tanggal2" required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-info btn-sm" id="tampil-radiologi">Tampilkan</button>
        <button class="btn btn-success btn-sm" id="exportExcelRad"><i class="far fa-file-excel"></i> Export Excel</button>
      </div>
    </div>
  </div>
</div>

<!-- filter radiologi jumlah pasien per hari -->
<div class="modal fade" id="modalFilterRad2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Filter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col">
            <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tgl_awal" name="tgl_awal" required>
          </div>
          <div class="col">
            <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tgl_akhir" name="tgl_akhir" required>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-info btn-sm" id="tampil-radiologi2">Tampilkan</button>
        <button class="btn btn-success btn-sm" id="exportExcelRad2"><i class="far fa-file-excel"></i> Export Excel</button>
      </div>
    </div>
  </div>
</div>

<script src="<?= base_url("Assets/js/app/radiologi.js") ?>"></script>