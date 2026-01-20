<section class="content">
    <div class="container-fluid" id="konten">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        Pasien Ranap BPJS
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#RanapBPJS">
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
                        <table class="table table-responsive-lg table-bordered table-sm" id="table-ranap-bpjs">
                            <thead>
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Pasien</th>
                                    <th scope="col">No.RM</th>
                                    <th scope="col">Kelas SEP</th>
                                    <th scope="col">Tgl SEP</th>
                                    <th scope="col">Jenis Pembayaran</th>
                                    <th scope="col">Ruang</th>
                                    <th scope="col">MRS</th>
                                    <th scope="col">KRS</th>
                                    <th scope="col">LOS</th>
                                    <th scope="col">DPJP</th>
                                    <th scope="col">Real Cost</th>
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
<div class="modal fade" id="RanapBPJS" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal1" name="tanggal1" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal2" name="tanggal2" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-info btn-sm" id="tampil-bpjs-ranap"><i class="fas fa-eye"></i> Tampilkan</button>
                <button class="btn btn-success btn-sm" id="exportExcelBpjs"><i class="far fa-file-excel"></i> Export Excel</button>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url('Assets/js/app/bpjsRanap.js') ?>"></script>