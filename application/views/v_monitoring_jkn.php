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
                        <?= $title ?>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#MonitoringBPJS">
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
                        <div class="dropdown-divider"></div>
                        <table class="table table-responsive-lg table-bordered table-sm" id="table-monitoring-jkn">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Dokter</th>
                                    <th scope="col">Poliklinik</th>
                                    <th scope="col">JKN</th>
                                    <th scope="col">Non JKN</th>
                                    <th scope="col">Total</th>
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
<div class="modal fade" id="MonitoringBPJS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
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
                        <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggalawal" name="tanggalawal" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggalakhir" name="tanggalakhir" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info btn-sm" id="btn-tampil"><i class="fas fa-eye"></i> Tampilkan</button>
                <button class="btn btn-success btn-sm" id="btn-export-excel"><i class="far fa-file-excel"></i> Export Excel</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('Assets/js/app/monitoring_jkn.js') ?>"></script>