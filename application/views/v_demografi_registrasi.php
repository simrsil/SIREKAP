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
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#suku" type="button" role="tab" aria-controls="suku" aria-selected="true">Suku Bangsa</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#pendidikan" type="button" role="tab" aria-controls="pendidikan" aria-selected="false">Pendidikan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#agama" type="button" role="tab" aria-controls="agama" aria-selected="false">Agama</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#bahasa" type="button" role="tab" aria-controls="bahasa" aria-selected="false">Bahasa</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#umur" type="button" role="tab" aria-controls="umur" aria-selected="false">Umur</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#kecamatan" type="button" role="tab" aria-controls="umur" aria-selected="false">Lumajang</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#kecamatan2" type="button" role="tab" aria-controls="umur" aria-selected="false">Lainnya</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="suku" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card">
                            <div class="card-header">
                                Data Demografi Registrasi Per Suku Bangsa
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-filter-demografi">
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
                                <table class="table table-responsive-lg table-striped table-bordered" id="tabel-demografi-suku">
                                    <thead>
                                        <tr>
                                            <th>Suku Bangsa</th>
                                            <th>Jumlah Pasien</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="tab-pane fade" id="pendidikan" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <div class="card-header">
                                Data Demografi Registrasi Per Pendidikan
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-filter-demografi">
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
                                <table class="table table-responsive-lg table-striped table-bordered" id="tabel-demografi-pendidikan">
                                    <thead>
                                        <tr>
                                            <th>Pendidikan</th>
                                            <th>Jumlah Pasien</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="tab-pane fade" id="bahasa" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="card">
                            <div class="card-header">
                                Data Demografi Registrasi Per Bahasa
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-filter-demografi">
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
                                <table class="table table-responsive-lg table-striped table-bordered" id="tabel-demografi-bahasa">
                                    <thead>
                                        <tr>
                                            <th>Bahasa</th>
                                            <th>Jumlah Pasien</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="agama" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="card">
                            <div class="card-header">
                                Data Demografi Registrasi Per Agama
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-filter-demografi">
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
                                <table class="table table-responsive-lg table-striped table-bordered" id="tabel-demografi-agama">
                                    <thead>
                                        <tr>
                                            <th>Agama</th>
                                            <th>Jumlah Pasien</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="umur" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="card">
                            <div class="card-header">
                                Data Demografi Registrasi Per Umur
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-filter-demografi">
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
                                <table class="table table-responsive-lg table-striped table-bordered" id="tabel-demografi-umur">
                                    <thead>
                                        <tr>
                                            <th>Umur</th>
                                            <th>Jumlah Pasien</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="kecamatan" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="card">
                            <div class="card-header">
                                Data Demografi Registrasi Per Umur
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-filter-demografi">
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
                                <table class="table table-responsive-lg table-striped table-bordered" id="tabel-demografi-kecamatan">
                                    <thead>
                                        <tr>
                                            <th>Kabupaten</th>
                                            <th>Kecamatan</th>
                                            <th>Jumlah Pasien</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                    </div>
                    <div class="tab-pane fade" id="kecamatan2" role="tabpanel" aria-labelledby="contact-tab">
                        <div class="card">
                            <div class="card-header">
                                Data Demografi Registrasi Per Umur
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-filter-demografi">
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
                                <table class="table table-responsive-lg table-striped table-bordered" id="tabel-demografi-kecamatan2">
                                    <thead>
                                        <tr>
                                            <th>Kabupaten</th>
                                            <th>Kecamatan</th>
                                            <th>Jumlah Pasien</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <!-- /.card-footer-->
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div> -->
                </div>

                <div class="modal fade" id="modal-filter-demografi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Filter Demografi Registrasi</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="form-filter-demografi">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm" placeholder="Tanggal Awal" name="tgl_awal" id="tgl_awal" required>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control form-control-sm" placeholder="Tanggal Akhir" name="tgl_akhir" id="tgl_akhir" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success btn-sm" id="export-excel">Export Excel</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Tampilkan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function() {
        $("#tgl_awal, #tgl_akhir").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
    });
</script>
<script>
    let tabelDemografiSuku = new DataTable('#tabel-demografi-suku', {
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url('DemografiRegistrasi/getDemografiSuku') ?>',
            type: 'post',
            data: function(data) {
                data.tgl_awal = $('#tgl_awal').val();
                data.tgl_akhir = $('#tgl_akhir').val();
                data.kabupaten = $('#kabupaten').val();
                data.umur = $('#umur').val();
            }
        }
    });
</script>
<script>
    let tabelDemografiPendidikan = new DataTable('#tabel-demografi-pendidikan', {
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url('DemografiRegistrasi/getDemografiPendidikan') ?>',
            type: 'post',
            data: function(data) {
                data.tgl_awal = $('#tgl_awal').val();
                data.tgl_akhir = $('#tgl_akhir').val();
                data.kabupaten = $('#kabupaten').val();
                data.umur = $('#umur').val();
            }
        }
    });
</script>
<script>
    let tabelDemografiAgama = new DataTable('#tabel-demografi-agama', {
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url('DemografiRegistrasi/getDemografiAgama') ?>',
            type: 'post',
            data: function(data) {
                data.tgl_awal = $('#tgl_awal').val();
                data.tgl_akhir = $('#tgl_akhir').val();
                data.kabupaten = $('#kabupaten').val();
                data.umur = $('#umur').val();
            }
        }
    });
</script>
<script>
    let tabelDemografiBahasa = new DataTable('#tabel-demografi-bahasa', {
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url('DemografiRegistrasi/getDemografiBahasa') ?>',
            type: 'post',
            data: function(data) {
                data.tgl_awal = $('#tgl_awal').val();
                data.tgl_akhir = $('#tgl_akhir').val();
            }
        }
    });
</script>
<script>
    let tabelDemografiUmur = new DataTable('#tabel-demografi-umur', {
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url('DemografiRegistrasi/getDemografiUmur') ?>',
            type: 'post',
            data: function(data) {
                data.tgl_awal = $('#tgl_awal').val();
                data.tgl_akhir = $('#tgl_akhir').val();
            }
        }
    });
</script>
<script>
    let tabelDemografiKec = new DataTable('#tabel-demografi-kecamatan', {
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url('DemografiRegistrasi/getDemografiKecamatan') ?>',
            type: 'post',
            data: function(data) {
                data.tgl_awal = $('#tgl_awal').val();
                data.tgl_akhir = $('#tgl_akhir').val();
            }
        }
    });
</script>
<script>
    let tabelDemografiKec2 = new DataTable('#tabel-demografi-kecamatan2', {
        processing: true,
        serverSide: true,
        ajax: {
            url: '<?= base_url('DemografiRegistrasi/getDemografiKecamatan2') ?>',
            type: 'post',
            data: function(data) {
                data.tgl_awal = $('#tgl_awal').val();
                data.tgl_akhir = $('#tgl_akhir').val();
            }
        }
    });
</script>
<script>
    $('#form-filter-demografi').on('submit', function(e) {
        e.preventDefault();
        tabelDemografiSuku.ajax.reload();
        tabelDemografiPendidikan.ajax.reload();
        tabelDemografiAgama.ajax.reload();
        tabelDemografiBahasa.ajax.reload();
        tabelDemografiUmur.ajax.reload();
        tabelDemografiKec.ajax.reload();
        tabelDemografiKec2.ajax.reload();
        $('#modal-filter-demografi').modal('hide');
    });
</script>
<script>
    $('#export-excel').on('click', function() {
        let tgl_awal = $('#tgl_awal').val();
        let tgl_akhir = $('#tgl_akhir').val();
        if (tgl_awal == '' && tgl_akhir == '') {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast',
                },
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                background: '#17a2b8',
                color: 'white'
            });
            Toast.fire({
                icon: 'error',
                title: 'Tanggal Harus di Isi',
            })
        } else {
            let url = window.location.href = '<?= base_url('DemografiRegistrasi/exportExcel/') ?>' + tgl_awal + '/' + tgl_akhir;
        }
    })
</script>