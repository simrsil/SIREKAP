<section class="content">
    <div class="container-fluid" id="konten">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#dokter-ranap" type="button" role="tab" aria-controls="dokter-ranap" aria-selected="true">Pasien Ranap</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#dokter-igd" type="button" role="tab" aria-controls="dokter-igd" aria-selected="false">Pasien IGD</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Meninggal</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="dokter-ranap" role="tabpanel" aria-labelledby="dokter-ranap-tab">
                <div>
                    <div class="card">
                        <div class="card-header">
                            Laporan Pasien Per Dokter Ranap
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalPx">
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
                        <div class="modal fade" id="modalPx" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modal1">Modal title</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div>
                                            <div class="form-row">
                                                <div class="col">
                                                    <?php
                                                    $startYear = '2018';
                                                    $endYear = date('Y');
                                                    ?>
                                                    <div class="form-group">
                                                        <select class="form-control" id="tahun" name="tahun">
                                                            <option>--Pilih Tahun--</option>
                                                            <?php for ($i = $startYear; $i <= $endYear; $i++) : ?>
                                                                <option value="<?= $i ?>"><?= $i ?></option>
                                                            <?php endfor ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <select class="form-control" id="bulan" name="bulan">
                                                            <option>--Pilih Bulan--</option>
                                                            <option value="01">Januari</option>
                                                            <option value="02">Februari</option>
                                                            <option value="03">Maret</option>
                                                            <option value="04">April</option>
                                                            <option value="05">Mei</option>
                                                            <option value="06">Juni</option>
                                                            <option value="07">Juli</option>
                                                            <option value="08">Agustus</option>
                                                            <option value="09">September</option>
                                                            <option value="10">Oktober</option>
                                                            <option value="11">November</option>
                                                            <option value="12">Desember</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button class="btn btn-primary" id="tampil-pasien-ranap">Tampilkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8 flex-wrap">
                                </div>
                            </div>
                            <table class="table table-responsive-lg table-bordered" id="tabel-laporan-pasien">
                                <thead>
                                    <tr>
                                        <th>Nama Dokter</th>
                                        <th>Jumlah Pasien</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="card-footer">
                            Footer
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="dokter-igd" role="tabpanel" aria-labelledby="dokter-igd-tab">
                <div class="card">
                    <div class="card-header">
                        Laporan Pasien Per Dokter IGD
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalPx2">
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
                    <div class="modal fade" id="modalPx2" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal2">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div method="post">
                                        <div class="form-row">
                                            <div class="col">
                                                <?php
                                                $startYear = '2018';
                                                $endYear = date('Y');
                                                ?>
                                                <div class="form-group">
                                                    <select class="form-control" id="tahun2" name="tahun2">
                                                        <option>--Pilih Tahun--</option>
                                                        <?php for ($i = $startYear; $i <= $endYear; $i++) : ?>
                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                        <?php endfor ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <select class="form-control" id="bulan2" name="bulan2">
                                                        <option>--Pilih Bulan--</option>
                                                        <option value="01">Januari</option>
                                                        <option value="02">Februari</option>
                                                        <option value="03">Maret</option>
                                                        <option value="04">April</option>
                                                        <option value="05">Mei</option>
                                                        <option value="06">Juni</option>
                                                        <option value="07">Juli</option>
                                                        <option value="08">Agustus</option>
                                                        <option value="09">September</option>
                                                        <option value="10">Oktober</option>
                                                        <option value="11">November</option>
                                                        <option value="12">Desember</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" id="tampil-pasien-igd">Tampilkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-8 flex-wrap">
                            </div>
                        </div>
                        <table class="table table-responsive-lg table-bordered" id="tabel-laporan-pasien2">
                            <thead>
                                <tr>
                                    <th>Nama Dokter</th>
                                    <th>Jumlah Pasien</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer">
                        Footer
                    </div>
                    <!-- /.card-footer-->
                </div>

            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div>
                    <div class="card">
                        <div class="card-header">
                            Laporan Pasien Meninggal
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
                                    <div class="form-row">
                                        <div class="col">
                                            <?php
                                            $startYear = '2018';
                                            $endYear = date('Y');
                                            ?>
                                            <div class="form-group">
                                                <select class="form-control" id="tahun3" name="tahun3">
                                                    <option>--Pilih Tahun--</option>
                                                    <?php for ($i = $startYear; $i <= $endYear; $i++) : ?>
                                                        <option value="<?= $i ?>"><?= $i ?></option>
                                                    <?php endfor ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <select class="form-control" id="bulan3" name="bulan3">
                                                    <option>--Pilih Bulan--</option>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Februari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <select class="form-control" id="lokasi" name="lokasi">
                                                    <option>--Pilih Lokasi--</option>
                                                    <option value="01">IGD</option>
                                                    <option value="02">Ranap</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <button class="btn btn-info" id="tampil-pasien-meninggal">Tampilkan</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            Footer
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?= base_url("Assets/js/app/laporan_pasien.js") ?>"></script>