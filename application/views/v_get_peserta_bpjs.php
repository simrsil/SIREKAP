<section class="content">
    <div class="container-fluid" id="konten">
        <div class="row">
            <div class="col-6">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        Get Peserta BPJS
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
                        <form id="form-peserta">
                            <div class="form-row">
                                <div class="col-10">
                                    <input type="number" class="form-control" placeholder="Masukkan NIK Peserta" id="nik" name="nik">
                                </div>
                                <div class="col">
                                    <button class="btn btn-info">Kirim</button>
                                </div>
                            </div>
                        </form>
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
<script src="<?= base_url("Assets/js/app/get_peserta.js") ?>"></script>