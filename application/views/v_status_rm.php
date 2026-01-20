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
                        <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Rawat Jalan</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Rawat Inap</button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card">
                            <div class="card-header">
                                Data Status Rekam Medis Rawat Jalan
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#filter-status-rm-ralan">
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
                                <table class="table table-responsive-lg table-bordered table-sm" id="tabel-rm-ralan">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.Rawat</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">Dokter Dituju</th>
                                            <th scope="col">Nomer RM</th>
                                            <th scope="col">Pasien</th>
                                            <th scope="col">Poliklinik</th>
                                            <th scope="col">SOAPIE</th>
                                            <th scope="col">Resume</th>
                                            <th scope="col">ICD 9</th>
                                            <th scope="col">ICD 10</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="card-footer">
                                Footer
                            </div>
                            <!-- /.card-footer-->
                        </div>
                        <!-- filter ralan -->
                        <div class="modal fade" id="filter-status-rm-ralan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered  ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Filter Status Rekam Medis</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form id="form-filter-status" method="post">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm" placeholder="Tanggal Awal" id="tgl_awal" name="tgl_awal" required>
                                                </div>
                                                <div class="col">
                                                    <input type="text" class="form-control form-control-sm" placeholder="Tanggal Akhir" id="tgl_akhir" name="tgl_akhir" require>
                                                </div>
                                                <div class="col">
                                                    <select class="form-control form-control-sm" id="status-ralan" name="status-ralan">
                                                        <option value="">Semua</option>
                                                        <option value="Belum">Belum</option>
                                                        <option value="Sudah">Sudah</option>
                                                        <option value="Batal">Batal</option>
                                                        <option value="Dirujuk">Dirujuk</option>
                                                        <option value="Meninggal">Meninggal</option>
                                                        <option value="Dirawat">Dirawat</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-success btn-sm" id="export-ralan">Export Excel</button>
                                            <button type="submit" class="btn btn-info btn-sm">Tampilkan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end filter ralan -->
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="card">
                            <div class="card-header">
                                Data Status Rekam Medis Rawat Jalan
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#filter-status-rm-ranap">
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
                                <table class="table table-responsive-lg table-bordered table-sm" id="tabel-rm-ranap">
                                    <thead>
                                        <tr>
                                            <th scope="col">No.Rawat</th>
                                            <th scope="col">Tanggal</th>
                                            <th scope="col">DPJP</th>
                                            <th scope="col">Dokter IGD</th>
                                            <th scope="col">Nomer RM</th>
                                            <th scope="col">Pasien</th>
                                            <th scope="col">SOAPIE</th>
                                            <th scope="col">Resume</th>
                                            <th scope="col">Triase IGD</th>
                                            <th scope="col">Askep IGD</th>
                                            <th scope="col">ICD 9</th>
                                            <th scope="col">ICD 10</th>
                                        </tr>
                                    </thead>
                                </table>
                                <div id="rekap-ranap"></div>
                            </div>
                            <div class="modal fade" id="filter-status-rm-ranap" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered  ">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Filter Status Rekam Medis</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form id="form-filter-status-ranap" method="post">
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <input type="text" class="form-control form-control-sm" placeholder="Tanggal Awal" id="tgl_awal2" name="tgl_awal2" required>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control form-control-sm" placeholder="Tanggal Akhir" id="tgl_akhir2" name="tgl_akhir2" required>
                                                    </div>
                                                    <div class="col">
                                                        <select class="form-control form-control-sm" id="status-ranap" name="status-ranap">
                                                            <option value="">Semua</option>
                                                            <option value="Sehat">Sehat</option>
                                                            <option value="Rujuk">Rujuk</option>
                                                            <option value="APS">APS</option>
                                                            <option value="+">+</option>
                                                            <option value="Meninggal">Meninggal</option>
                                                            <option value="Sembuh">Sembuh</option>
                                                            <option value="Membaik">Membaik</option>
                                                            <option value="Pulang Paksa">Pulang Paksa</option>
                                                            <option value="-">-</option>
                                                            <option value="Status Belum Lengkap">Status Belum Lengkap</option>
                                                            <option value="Atas Persetujuan Dokter">Atas Persetujuan Dokter</option>
                                                            <option value="Atas Permintaan Sendiri">Atas Permintaan Sendiri</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success btn-sm" id="export-ranap">Export Excel</button>
                                                <button type="submit" class="btn btn-info btn-sm">Tampilkan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

    <script>
        $("#tgl_awal, #tgl_akhir,#tgl_awal2, #tgl_akhir2").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
    </script>
    <script>
        let tabelStatusRMRalan = new DataTable('#tabel-rm-ralan', {
            serverSide: true,
            processing: true,
            ajax: {
                url: '<?= base_url('StatusRM/statusRMRalan') ?>',
                type: 'post',
                data: function(data) {
                    data.tgl_awal = $('#tgl_awal').val()
                    data.tgl_akhir = $('#tgl_akhir').val()
                    data.status_ralan = $('#status-ralan').val();
                }

            }

        });
        $('#form-filter-status').on('submit', function(e) {
            e.preventDefault();
            tabelStatusRMRalan.ajax.reload();
            $('#filter-status-rm-ralan').modal('hide');
        })
    </script>
    <script>
        $('#export-ralan').on('click', function(e) {
            e.preventDefault();
            let tgl_awal = $('#tgl_awal').val();
            let tgl_akhir = $('#tgl_akhir').val();
            let status_ralan = $('#status-ralan').val();
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
                    background: '#17a2b8', // Warna latar belakang (green)
                    color: 'white'
                });
                Toast.fire({
                    icon: 'error',
                    title: 'Tanggal Harus di Isi',
                })
            } else {
                const url = '<?= base_url('StatusRM/exportExcelRalan') ?>'
                const params = new URLSearchParams({
                    tgl_awal: tgl_awal,
                    tgl_akhir: tgl_akhir,
                    status_ralan: status_ralan

                })
                window.location.href = `${url}?${params.toString()}`;
            }

        })
    </script>

    <script>
        let tabelStatusRMRanap = new DataTable('#tabel-rm-ranap', {
            serverSide: true,
            processing: true,
            ajax: {
                url: '<?= base_url('StatusRM/statusRMRanap') ?>',
                type: 'post',
                data: function(data) {
                    data.tgl_awal2 = $('#tgl_awal2').val()
                    data.tgl_akhir2 = $('#tgl_akhir2').val()
                    data.status_ranap = $('#status-ranap').val();
                }

            }
        });
        $('#form-filter-status-ranap').on('submit', function(e) {
            e.preventDefault();
            tabelStatusRMRanap.ajax.reload()
            $('#filter-status-rm-ranap').modal('hide');

        })
    </script>
    <script>
        $('#export-ranap').on('click', function(e) {
            e.preventDefault();
            let tgl_awal = $('#tgl_awal2').val();
            let tgl_akhir = $('#tgl_akhir2').val();
            let status_ranap = $('#status-ranap').val();
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
                    background: '#17a2b8', // Warna latar belakang (green)
                    color: 'white'
                });
                Toast.fire({
                    icon: 'error',
                    title: 'Tanggal Harus di Isi',
                })
            } else {
                const url = '<?= base_url('StatusRM/exportExcelRanap') ?>'
                const params = new URLSearchParams({
                    tgl_awal2: tgl_awal,
                    tgl_akhir2: tgl_akhir,
                    status_ranap2: status_ranap

                })
                window.location.href = `${url}?${params.toString()}`;
            }

        })
    </script>

</section>