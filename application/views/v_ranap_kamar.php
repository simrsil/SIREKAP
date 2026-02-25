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
                        Data Rekap Kamar Inap
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
                                            <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tglKamarInapMasuk" name="tglKamarInapMasuk" required>
                                        </div>
                                        <div class="btn-group">
                                            <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal2" name="tanggal2" required>
                                        </div>
                                        <div class="btn-group">
                                            <button class="btn btn-info btn-sm" id="tampil-radiologi"><i class="fas fa-eye"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <table class="table table-responsive-lg table-bordered table-sm" id="table-radiologi">
                            <thead>
                                <tr>
                                    <th scope="col">Bangsal</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Jumlah Hari Perawatan</th>
                                    <th scope="col">Jumlah Pemakaian</th>
                                </tr>
                            </thead>
                            <!-- <tbody></tbody> -->
                            <tfoot>
                                <tr>
                                    <th colspan="2" style="text-align:right">Total:</th>
                                    <th id="total-jumlah-perawatan">0</th>
                                    <th id="total-jumlah-pemakaian">0</th>
                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">TT:</th>
                                    <th colspan="2" id="total-jumlah-tt" class="text-center">0</th>

                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">BOR:</th>
                                    <th colspan="2" id="total-jumlah-bor" class="text-center">0</th>

                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">TOI:</th>
                                    <th colspan="2" id="total-jumlah-toi" class="text-center">0</th>

                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">BTO:</th>
                                    <th colspan="2" id="total-jumlah-bto" class="text-center">0</th>

                                </tr>
                                <tr>
                                    <th colspan="2" class="text-right">ALOS:</th>
                                    <th colspan="2" id="total-jumlah-alos" class="text-center">0</th>

                                </tr>
                            </tfoot>
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
<script src="<?= base_url("Assets/js/app/kamar.js") ?>"></script>