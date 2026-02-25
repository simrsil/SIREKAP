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
                <button class="nav-link active" id="rujukan-keluar-tab" data-toggle="tab" data-target="#rujukan-keluar" type="button" role="tab" aria-controls="rujukan-keluar" aria-selected="true">Ruj. Keluar</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="rujukan-masuk-tab" data-toggle="tab" data-target="#rujukan-masuk" type="button" role="tab" aria-controls="rujukan-masuk" aria-selected="false">Ruj. Masuk</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <!-- TAB 1 -->
            <div class="tab-pane fade show active" id="rujukan-keluar" role="tabpanel" aria-labelledby="rujukan-keluar-tab">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalRujukanKeluar">
                                <i class="fas fa-filter"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="modal fade" id="modalRujukanKeluar" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalRujukanKeluar">Filter Rujukan Keluar</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <div class="form-row">
                                            <div class="col">
                                                <input type="text" name="tglRujukanKeluarAwal" id="tglRujukanKeluarAwal" class="form-control" placeholder="--Pilih Tanggal Awal--">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="tglRujukanKeluarAkhir" id="tglRujukanKeluarAkhir" class="form-control" placeholder="--Pilih Tanggal Akhir--">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" id="btn-rujukan-keluar">Tampilkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-lg table-bordered" id="tabel-rujuk-keluar">
                            <thead>
                                <tr>
                                    <th>Status Lanjut</th>
                                    <th>Rujuk</th>
                                    <th>Tidak Rujuk</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="card-body">
                        <table class="table table-responsive-lg table-bordered" id="tabel-rujukan-keluar-detail">
                            <thead>
                                <tr>
                                    <th>Tgl. Registrasi</th>
                                    <th>Tgl. Ruj. Keluar</th>
                                    <th>No.Rawat</th>
                                    <th>Pasien</th>
                                    <th>Stts</th>
                                    <th>Stts. Rujuk</th>
                                    <th>Ket. Diagnosa</th>
                                    <th>Ket.</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer">Footer</div>
                </div>
            </div>

            <!-- TAB 2 -->
            <div class="tab-pane fade" id="rujukan-masuk" role="tabpanel" aria-labelledby="rujukan-masuk-tab">
                <div class="card">
                    <div class="card-header">
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalRujukanMasuk">
                                <i class="fas fa-filter"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="modal fade" id="modalRujukanMasuk" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalRujukanMasuk">Filter</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <div class="form-row">
                                            <div class="col">
                                                <input type="text" name="tglRujukanMasukAwal" id="tglRujukanMasukAwal" class="form-control" placeholder="--Pilih Tanggal Awal--">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="tglRujukanMasukAkhir" id="tglRujukanMasukAkhir" class="form-control" placeholder="--Pilih Tanggal Akhir--">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" id="btn-tampil-masuk">Tampilkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-responsive-lg table-bordered" id="tabel-rujuk-masuk">
                            <thead>
                                <tr class="text-center">
                                    <th>Status Lanjut</th>
                                    <th>Kiriman</th>
                                    <th>Rujuk Masuk</th>
                                    <th>Tidak Rujuk</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-lg table-bordered table-sm" id="tabel-rujukan-masuk-detail">
                            <thead>
                                <tr>
                                    <th>Tgl. Registrasi</th>
                                    <th>No.Rawat</th>
                                    <th>No.RM</th>
                                    <th>Pasien</th>
                                    <th>Stts. Rawat</th>
                                    <th>Stts. Rujuk</th>
                                    <th>Perujuk/Rujukan</th>
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
<script src="<?= base_url("Assets/js/app/rujukan.js") ?>"></script>