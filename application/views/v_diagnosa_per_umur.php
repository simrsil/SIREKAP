<section class="content">
    <div class="container-fluid" id="konten">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="diagnosa-ralan" data-toggle="tab" data-target="#ralan" type="button" role="tab" aria-controls="home" aria-selected="true">Ralan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="diagnosa-ranap" data-toggle="tab" data-target="#ranap" type="button" role="tab" aria-controls="profile" aria-selected="false">Ranap</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="kasus-baru" data-toggle="tab" data-target="#kasusBaru" type="button" role="tab" aria-controls="profile" aria-selected="false">Kasus Baru</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="ralan" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card">
                            <form id="form-filter-diagnosa">
                                <div class="card-header">
                                    <div>
                                        <div class="form-row">
                                            <div class="col">
                                                <input type="text" name="tgl_awal" id="tgl_awal" class="form-control" placeholder="--Pilih Tanggal--" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="tgl_akhir" id="tgl_akhir" class="form-control" placeholder="--Pilih Tanggal--" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="diagnosa" id="diagnosa" class="form-control" placeholder="Masukkan Kode Diagnosa..." required>
                                            </div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-info btn-sm">Tampilkan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="card-body">
                                <table class="table table-sm table-responsive-lg table-bordered" id="tabel-data-diagnosa">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Umur</th>
                                            <th>Kode Diagnosa</th>
                                            <th>Laki-Laki</th>
                                            <th>Perempuan</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <th class="text-center" colspan="2">Jumlah Kunjungan</th>
                                        <th class="text-center" id="jml-kunjungan-lk"></th>
                                        <th class="text-center" id="jml-kunjungan-pr"></th>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="kasusBaru" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <form id="form-filter-kasus-baru">
                                <div class="card-header">
                                    <div>
                                        <div class="form-row">
                                            <div class="col">
                                                <input type="text" name="tgl_awal3" id="tgl_awal3" class="form-control" placeholder="--Pilih Tanggal--" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="tgl_akhir3" id="tgl_akhir3" class="form-control" placeholder="--Pilih Tanggal--" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="diagnosa_kasus" id="diagnosa_kasus" class="form-control" placeholder="Masukkan Kode Diagnosa..." required>
                                            </div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-info btn-sm">Tampilkan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="card-body">
                                <table class="table table-sm table-responsive-lg table-bordered" id="tabel-data-kasus">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Umur</th>
                                            <th>Kode Diagnosa</th>
                                            <th>Laki-Laki</th>
                                            <th>Perempuan</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <th class="text-center" colspan="2">Jumlah Kunjungan</th>
                                        <th class="text-center" id="jml-knj-kasus-lk"></th>
                                        <th class="text-center" id="jml-knj-kasus-pr"></th>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="ranap" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <form id="form-filter-diagnosa-ranap">
                                <div class="card-header">
                                    <div>
                                        <div class="form-row">
                                            <div class="col">
                                                <input type="text" name="tgl_awal2" id="tgl_awal2" class="form-control" placeholder="--Pilih Tanggal--" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="tgl_akhir2" id="tgl_akhir2" class="form-control" placeholder="--Pilih Tanggal--" required>
                                            </div>
                                            <div class="col">
                                                <input type="text" name="diagnosa_ranap" id="diagnosa_ranap" class="form-control" placeholder="Masukkan Kode Diagnosa..." required>
                                            </div>
                                            <div class="col">
                                                <button type="submit" class="btn btn-info btn-sm">Tampilkan</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="card-body">
                                <table class="table table-sm table-responsive-lg table-bordered" id="tabel-data-diagnosa-ranap">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Umur</th>
                                            <th>Kode Diagnosa</th>
                                            <th>Laki-Laki</th>
                                            <th>Perempuan</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <th class="text-center" colspan="2">Pasien Meninggal</th>
                                        <th class="text-center" id="jml-meninggal-lk"></th>
                                        <th class="text-center" id="jml-meninggal-pr"></th>
                                    </tfoot>
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
<script src="<?= base_url("Assets/js/app/diagnosa.js") ?>"></script>