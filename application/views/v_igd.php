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
                <div class="card">
                    <div class="card-header">
                        <h5><b>Cara Berdasarkan Tanggal</b></h5>
                    </div>
                    <div class="card-body">
                        <div class="col-12">
                            <div class="row">
                                <div class="margin">
                                    <div class="btn-group">
                                        <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tglTriaseAwal" name="tglTriaseAwal">
                                    </div>
                                    <div class="btn-group">
                                        <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tglTriaseAkhir" name="tglTriaseAkhir">
                                    </div>
                                    <div class="btn-group">
                                        <button class="btn btn-info btn-sm" id="tampil-triase"><i class="fas fa-eye"></i> Tampilkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <b>Triase IGD Primer</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-responsive-lg table-bordered" id="tabel-triase-primer">
                            <thead>
                                <tr class="text-center">
                                    <th>Indikator</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
            <div class="col-6">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <b>Triase IGD Sekunder</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-responsive-lg table-bordered" id="tabel-triase-sekunder">
                            <thead>
                                <tr class="text-center">
                                    <th>Indikator</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="<?= base_url("Assets/js/app/igd.js") ?>"></script>