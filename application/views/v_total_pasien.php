<section class="content">
    <div class="container-fluid" id="konten">
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        Data Pasien Per-Dokter Rawat Jalan
                        <div class="card-tools">
                            <button type="button" class="btn btn-warning" id="refresh-sep-rajal">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modalSEPRajal">
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
                    <div class="modal fade" id="modalSEPRajal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalSEPRajal">Filter</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div>
                                        <div class="form-row">
                                            <div class="col">
                                                <input type="text" name="tglSepRajal1" id="tglSepRajal1" class="form-control" placeholder="--Pilih Tanggal--">
                                            </div>
                                            <div class="col">
                                                <input type="text" name="tglSepRajal2" id="tglSepRajal2" class="form-control" placeholder="--Pilih Tanggal--">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" id="tampil-sep-rajal">Tampilkan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-responsive-lg table-bordered table-sm" id="tabel-sep-rajal">
                            <thead>
                                <tr class="text-center">
                                    <th>Action</th>
                                    <th>Poliklinik</th>
                                    <th>Dokter</th>
                                    <!-- <th>Jam</th> -->
                                    <th>SEP Tercetak</th>
                                    <th>BPJS</th>
                                    <th>Umum</th>
                                    <th>Lain-lain</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="card-footer">
                        Footer
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDokter" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pxRajal2">Data Pasien Rawat Jalan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-sm table-responsive-lg table-bordered table-sm" id="tabel-data-sep2">
                        <thead>
                            <tr class="text-center">
                                <th>No Rawat</th>
                                <th>No.RM</th>
                                <th>Nama pasien</th>
                                <th>Dokter</th>
                                <th>Poliklinik</th>
                                <th>Jenis Bayar</th>
                                <th>No SEP</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function() {
        $("#tglSepRajal1, #tglSepRajal2").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
    });
</script>
<script>
    let tabelSEPRajal = $('#tabel-sep-rajal').DataTable({
        processing: true,
        serverSide: true,
        orderable: false,
        paging: false,
        info: false,
        ajax: {
            url: "<?= base_url('TotalPasien/dataSEPRajal') ?>",
            type: "post",
            data: function(data) {
                data.tglSepRajal1 = $('#tglSepRajal1').val();
                data.tglSepRajal2 = $('#tglSepRajal2').val();
                // data.kd_dokter = kd_dokter
            }
        }
    })
    $('#tampil-sep-rajal').on('click', function() {
        $('#modalSEPRajal').modal('hide');
        tabelSEPRajal.ajax.reload();
    });
    $('#refresh-sep-rajal').on('click', function() {
        location.reload();
    });
</script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.kd-dokter-btn', function() {
            // Ambil nilai dari atribut data-dokter
            const kd_dokter = $(this).data('dokter');

            // Sekarang variabelnya sudah didefinisikan dan bisa dipakai
            // console.log("Kode dokter:", kd_dokter);

            // Tampilkan modal
            $('#modalDokter').modal('show');
            if ($.fn.dataTable.isDataTable('#tabel-data-sep2')) {
                $('#tabel-data-sep2').DataTable().clear().destroy();
            }
            let tabelPasienSEP = $('#tabel-data-sep2').DataTable({
                processing: true,
                serverSide: true,
                orderable: false,
                paging: false,
                info: false,
                searching: false,
                ajax: {
                    url: "<?= base_url('TotalPasien/dataPasienSEP') ?>",
                    type: "post",
                    data: function(data) {
                        data.kd_dokter = kd_dokter;
                        data.tglSepRajal1 = $('#tglSepRajal1').val();
                        data.tglSepRajal2 = $('#tglSepRajal2').val();
                    }
                }
            })
        });
    });
</script>