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
<script>
    $(function() {
        $("#tglKamarInapMasuk, #tanggal2").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
    });
</script>

<script>
    $(document).ready(function() {
        let tabelTriase = $('#table-radiologi').DataTable({
            processing: true,
            serverSide: true,
            paging: false,
            info: false,
            searching: false,
            ajax: {
                url: "<?= base_url('RekapanRanapKamar/Bangsal') ?>",
                type: "POST",
                data: function(data) {
                    data.tglKamarInapMasuk = $('#tglKamarInapMasuk').val();
                    data.tanggal2 = $('#tanggal2').val();
                },
                dataSrc: ''
            },
            columns: [{
                    data: 'nama_group',
                    width: "25%"
                },
                {
                    data: 'kelas',
                    width: "25%"
                },
                {
                    data: 'total_perawatan',
                    width: "25%"
                },
                {
                    data: 'total',
                    width: "25%"
                }
            ],
            drawCallback: function(settings) {
                // Hitung total dari kolom 'total'
                let totalJumlah = 0;
                let jumlahTT;
                let totalJumlahPemakaian = 0;
                let totalJumlahBor = 0;
                let totalJumlahTOI = 0;
                let totalJumlahBTO = 0;
                let totalJumlahALOS = 0;
                let totalKunjunganRanap;
                let persen;
                let data = tabelTriase.rows({
                    page: 'current'
                }).data();
                for (let i = 0; i < data.length; i++) {
                    totalJumlah += parseInt(data[i].total_perawatan);
                    totalJumlahPemakaian += parseInt(data[i].total);
                    totalKunjunganRanap = parseInt(data[i].jumlah_kunjungan_ranap);
                    jumlahTT = parseInt(data[i].jumlah_tt);
                    persen = (totalJumlah / data[i].jumlah) * 100;
                    totalJumlahBor = persen.toFixed(2) + '%'
                    totalJumlahTOI = ((parseInt(data[i].jumlah) - totalJumlah) / totalKunjunganRanap).toFixed(2)
                    totalJumlahBTO = (totalKunjunganRanap / jumlahTT).toFixed(2) //100 adalah jumlah TT
                    totalJumlahALOS = (totalJumlah / totalKunjunganRanap).toFixed(2)

                }

                // Tampilkan di <tfoot>
                $('#total-jumlah-tt').html(jumlahTT);
                $('#total-jumlah-perawatan').html(totalJumlah);
                $('#total-jumlah-pemakaian').html(totalJumlahPemakaian);
                $('#total-jumlah-bor').html(totalJumlahBor);
                $('#total-jumlah-toi').html(totalJumlahTOI);
                $('#total-jumlah-bto').html(totalJumlahBTO);
                $('#total-jumlah-alos').html(totalJumlahALOS);
            }
        });
        $('#tampil-radiologi').on('click', function() {
            tabelTriase.ajax.reload();
        });
    });
</script>