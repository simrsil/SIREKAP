
    $(function() {
        $("#tglRujukanKeluarAwal, #tglRujukanKeluarAkhir, #tglRujukanMasukAwal, #tglRujukanMasukAkhir").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true
        });
    });

    let tabelRujukanKeluarAsek = $('#tabel-rujukan-keluar-detail').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: 'RekapRujukan/TampilRujukanKeluar',
            type: "post",
            data: function(data) {
                data.tglRujukanAwal = $('#tglRujukanKeluarAwal').val();
                data.tglRujukanAkhir = $('#tglRujukanKeluarAkhir').val();
                // data.kd_dokter = kd_dokter
            }
        }
    })
    $('#btn-rujukan-keluar').on('click', function() {
        $('#modalRujukanKeluar').modal('hide');
        tabelRujukanKeluarAsek.ajax.reload();
    });

    $(document).ready(function() {
        let tabelRujukKeluar = $('#tabel-rujuk-keluar').DataTable({
            processing: true,
            serverSide: false,
            paging: false,
            info: false,
            searching: false,
            ajax: {
                url: 'RekapRujukan/JmlRujukanKeluar',
                type: "POST",
                data: function(data) {
                    data.tglRujukanAwal = $('#tglRujukanKeluarAwal').val();
                    data.tglRujukanAkhir = $('#tglRujukanKeluarAkhir').val();
                },
                dataSrc: ''
            },
            columns: [{
                    data: 'status_lanjut',
                    width: "50%"
                },
                {
                    data: 'rujuk',
                    width: "20%"
                },
                {
                    data: 'tidak_rujuk',
                    width: "20%"
                }
            ]
        });

        // $('#btn-tampil-rujukan').on('click', function() {
        $('#btn-rujukan-keluar').on('click', function() {
            tabelRujukKeluar.ajax.reload();
        });
    });

    let tabelRujukanMasukAsek = $('#tabel-rujukan-masuk-detail').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: 'RekapRujukan/TampilRujukanMasuk',
            type: "post",
            data: function(data) {
                data.tglRujukanAwal = $('#tglRujukanMasukAwal').val();
                data.tglRujukanAkhir = $('#tglRujukanMasukAkhir').val();
            }
        }
    })
    $('#btn-tampil-masuk').on('click', function() {
        $('#modalRujukanMasuk').modal('hide');
        tabelRujukanMasukAsek.ajax.reload();
    });

    $(document).ready(function() {
        let tabelRujukMasuk = $('#tabel-rujuk-masuk').DataTable({
            processing: true,
            serverSide: false,
            paging: false,
            info: false,
            searching: false,
            ajax: {
                url: 'RekapRujukan/JmlRujukanMasuk',
                type: "POST",
                data: function(data) {
                    data.tglRujukanAwal = $('#tglRujukanMasukAwal').val();
                    data.tglRujukanAkhir = $('#tglRujukanMasukAkhir').val();
                },
                dataSrc: ''
            },
            columns: [{
                    data: 'status_lanjut',
                    width: "50%"
                },
                {
                    data: 'kiriman',
                    width: "20%"
                },
                {
                    data: 'rujukan_masuk',
                    width: "20%"
                },
                {
                    data: 'tidak',
                    width: "10%"
                }
            ]
        });

        $('#btn-tampil-masuk').on('click', function() {
            $('#modalRujukanMasuk').modal('hide');
            tabelRujukMasuk.ajax.reload();
        });
    });
