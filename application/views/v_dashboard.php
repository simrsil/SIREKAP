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
            <div class="col-lg-3 col-6">
                <div class="info-box bg-info">
                    <span class="info-box-icon"><i class="fas fa-procedures"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">JKN</span>
                        <span class="info-box-number">
                            <span id="jkn_total"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="info-box bg-success">
                    <span class="info-box-icon"><i class="fas fa-clinic-medical"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Checkin | Belum | Batal</span>
                        <span class="info-box-number">
                            <span id="jkn_checkin"></span> |
                            <span id="jkn_belum"></span> |
                            <span id="jkn_batal"></span></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="info-box bg-warning">
                    <span class="info-box-icon"><i class="fas fa-ambulance"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Pasien BPJS [NON BATAL]</span>
                        <span class="info-box-number">
                            <span id="pasien_bpjs"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="info-box bg-danger">
                    <span class="info-box-icon"><i class="fas fa-mobile-alt"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Presentase JKN</span>
                        <span class="info-box-number">
                            <span id="presentase_jkn"></span>
                            <span>%</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Statistik Mobile JKN Periode <span id="periode-text"></span>
                        <div class="card-tools">
                            <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" id="periode" class="form-control datetimepicker-input" data-target="#reservationdate" />
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Kamar Inap
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
                        <table class="table table-responsive-lg table-sm table-bordered" id="tabel-ranap">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Kamar</th>
                                    <th scope="col">Jumlah Kamar</th>
                                    <th scope="col">Isi</th>
                                    <th scope="col">Kosong</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($statusKamar as $sk): ?>
                                    <tr>
                                        <td><?= $sk->nama_group ?></td>
                                        <td><?= $sk->jumlah_kmr ?></td>
                                        <td><?= $sk->kmr_isi ?></td>
                                        <td><?= $sk->kmr_kosong ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Poliklinik
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
                        <table class="table table-responsive-lg table-sm table-bordered" id="tabel-poli">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Poliklinik</th>
                                    <th scope="col">Nama Dokter</th>
                                    <th scope="col">Jumlah Pasien</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pasienPoli as $px): ?>
                                    <tr>
                                        <td><?= str_ireplace(['Poliklinik ', 'Poli '], '', $px->nm_poli) ?></td>
                                        <td><?= mb_strimwidth($px->nm_dokter, 0, 15, '...') ?></td>
                                        <td><?= $px->jumlah ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card">
                    <div class="card-header">
                        Poliklinik
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
                        <table class="table table-responsive-lg table-sm table-bordered" id="tabel-bayar">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Poliklinik</th>
                                    <th scope="col">Nama Dokter</th>
                                    <th scope="col">Jenis Bayar</th>
                                    <th scope="col">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($caraBayar as $cb): ?>
                                    <tr>
                                        <td><?= $cb->nm_poli ?></td>
                                        <td><?= $cb->nm_dokter ?></td>
                                        <td><?= $cb->png_jawab ?></td>
                                        <td><?= $cb->jns_bayar ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    let jknChart = null;

    $(function() {

        // init month picker
        $('#reservationdate').datetimepicker({
            format: 'MMMM YYYY',
            viewMode: 'months',
            defaultDate: moment()
        });

        // load pertama
        let periodeAwal = moment().format('YYYY-MM');
        $('#periode-text').text(moment().format('MMMM YYYY'));
        loadStatistik(periodeAwal);
        loadChart(periodeAwal);

        // saat bulan diganti
        $('#reservationdate').on('change.datetimepicker', function(e) {
            if (!e.date) return;

            let periode = e.date.format('YYYY-MM');

            $('#periode-text').text(e.date.format('MMMM YYYY'));

            loadStatistik(periode);
            loadChart(periode);
        });
    });

    function loadStatistik(periode) {
        $.ajax({
            url: "<?= base_url('Dashboard/JKN') ?>",
            type: "POST",
            data: {
                periode: periode
            },
            dataType: "json",
            success: function(res) {
                $('#jkn_total').text(res.jkn_total);
                $('#jkn_checkin').text(res.jkn_checkin);
                $('#jkn_belum').text(res.jkn_belum);
                $('#jkn_batal').text(res.jkn_batal);
                $('#pasien_bpjs').text(res.pasien_bpjs);
                $('#presentase_jkn').text(res.presentase_jkn);
            }
        });
    }

    function loadChart(periode) {
        if (!periode) return;

        $.getJSON("<?= site_url('Dashboard/ChartJKN') ?>", {
            periode: periode,
            _: Date.now()
        }, function(res) {

            var ctx = $('#lineChart').get(0).getContext('2d');

            if (jknChart) {
                jknChart.destroy();
            }

            jknChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: res.labels,
                    datasets: [{
                            label: 'Checkin',
                            borderColor: 'rgba(15, 177, 0, 0.8)',
                            fill: false,
                            data: res.pasien
                        },
                        {
                            label: 'Belum',
                            borderColor: 'rgba(238, 255, 0, 1)',
                            fill: false,
                            data: res.kunjungan
                        },
                        {
                            label: 'Batal',
                            borderColor: 'rgba(255, 0, 0, 1)',
                            fill: false,
                            data: res.batal
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false
                }
            });
        });
    }
</script>

<script>
    $('#tabel-ranap').DataTable();
    $('#tabel-poli').DataTable();
    $('#tabel-bayar').DataTable();
</script>