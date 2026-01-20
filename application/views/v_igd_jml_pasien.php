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
                                        <button class="btn btn-info btn-sm" id="btn-tampil"><i class="fas fa-eye"></i> Tampilkan</button>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <b>Status Lanjut Pasien</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-responsive-lg table-bordered" id="tabel-triase-primer">
                            <thead>
                                <tr class="text-center">
                                    <th>Indikator</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer">
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <b>Status Pasien</b>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-responsive-lg table-bordered" id="tabel-status-pasien">
                            <thead>
                                <tr class="text-center">
                                    <th>Indikator</th>
                                    <th>Jumlah</th>
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
<script>
    $(function() {
        $("#tglTriaseAwal, #tglTriaseAkhir").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
    });
</script>
<script>
    $(document).ready(function() {
        let tabelTriase = $('#tabel-triase-primer').DataTable({
            processing: true,
            serverSide: false,
            paging: false,
            info: false,
            searching: false,
            ajax: {
                url: "<?= base_url('RekapIGDJumlahPasien/JmlPasienIGDRalanRanap') ?>",
                type: "POST",
                data: function(data) {
                    data.tglTriaseAwal = $('#tglTriaseAwal').val();
                    data.tglTriaseAkhir = $('#tglTriaseAkhir').val();
                },
                dataSrc: ''
            },
            columns: [{
                    data: 'plan',
                    width: "80%"
                },
                {
                    data: 'total',
                    width: "30%"
                }
            ]
        });

        $('#btn-tampil').on('click', function() {
            tabelTriase.ajax.reload();
        });
    });

    $(document).ready(function() {
        let tabelPasienIGDStts = $('#tabel-status-pasien').DataTable({
            processing: true,
            serverSide: false,
            paging: false,
            info: false,
            searching: false,
            ajax: {
                url: "<?= base_url('RekapIGDJumlahPasien/JmlPasienIGDStts') ?>",
                type: "POST",
                data: function(data) {
                    data.tglTriaseAwal = $('#tglTriaseAwal').val();
                    data.tglTriaseAkhir = $('#tglTriaseAkhir').val();
                },
                dataSrc: ''
            },
            columns: [{
                    data: 'stts',
                    width: "80%"
                },
                {
                    data: 'total_stts',
                    width: "30%"
                }
            ]
        });

        $('#btn-tampil').on('click', function() {
            tabelPasienIGDStts.ajax.reload();
        });
    });
</script>