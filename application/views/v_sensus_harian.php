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
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Pasien Keluar</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Pasien Masuk</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Pasien Awal</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card">
                            <div class="card-header">
                                Sensus Harian Pasien Keluar Mati
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalPxKeluar">
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
                            <div class="modal fade" id="modalPxKeluar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal1">Filter</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input class="form form-control" type="text" name="tglKeluar1" id="tglKeluar1" placeholder="--Pilih Tanggal--">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input class="form form-control" type="text" name="tglKeluar2" id="tglKeluar2" placeholder="--Pilih Tanggal--">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <!-- menambah filter pilih waktu pada modal filter -->
                                                        <div class="form-group">
                                                            <select class="custom-select" name="waktu" id="waktu">
                                                                <option selected>--Pilih Waktu--</option>
                                                                <option value="1">Kurang dari 48 jam</option>
                                                                <option value="2">Lebih dari 48 jam</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button class="btn btn-primary" id="tampil-pasien-keluar">Tampilkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8 flex-wrap">
                                    </div>
                                </div>
                                <table class="table table-responsive-lg table-bordered table-sm" id="tabel-pasien-keluar">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="align-middle">Nama Dokter</th>
                                            <th>Jumlah Pasien Keluar Mati Pria</th>
                                            <th>Jumlah Pasien Keluar Mati Wanita</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="card-footer">
                                Footer
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <div class="card-header">
                                Sensus Harian Pasien Masuk
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalPxMasuk">
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
                            <div class="modal fade" id="modalPxMasuk" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal1">Filter</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input class="form form-control" type="text" name="tglMasuk1" id="tglMasuk1" placeholder="--Pilih Tanggal--">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input class="form form-control" type="text" name="tglMasuk2" id="tglMasuk2" placeholder="--Pilih Tanggal--">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button class="btn btn-primary" id="tampil-pasien-masuk">Tampilkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8 flex-wrap">
                                    </div>
                                </div>
                                <table class="table table-responsive-lg table-bordered table-sm" id="tabel-pasien-masuk">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="align-middle">Nama Dokter</th>
                                            <th>Jumlah Pasien Masuk</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="card-footer">
                                Footer
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="card">
                            <div class="card-header">
                                Sensus Harian Pasien Masuk
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalPxMasuk">
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
                            <div class="modal fade" id="modalPxMasuk" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modal1">Filter</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span>&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div>
                                                <div class="form-row">
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input class="form form-control" type="text" name="tglMasuk1" id="tglMasuk1" placeholder="--Pilih Tanggal--">
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="form-group">
                                                            <input class="form form-control" type="text" name="tglMasuk2" id="tglMasuk2" placeholder="--Pilih Tanggal--">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button class="btn btn-primary" id="tampil-pasien-masuk">Tampilkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-8 flex-wrap">
                                    </div>
                                </div>
                                <table class="table table-responsive-lg table-bordered table-sm" id="tabel-pasien-masuk">
                                    <thead>
                                        <tr class="text-center">
                                            <th class="align-middle">Nama Dokter</th>
                                            <th>Jumlah Pasien Masuk</th>
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
        </div>
    </div>
</section>
<script src="<?= base_url("Assets/js/app/sensus.js") ?>"></script>