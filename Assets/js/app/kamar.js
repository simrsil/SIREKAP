$(function () {
    $("#tglKamarInapMasuk, #tanggal2").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
$(document).ready(function () {
    let tabelTriase = $('#table-radiologi').DataTable({
        processing: true,
        serverSide: true,
        paging: false,
        info: false,
        searching: false,
        ajax: {
            url: 'RekapanRanapKamar/Bangsal',
            type: "POST",
            data: function (data) {
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
        drawCallback: function () {
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
    $('#tampil-radiologi').on('click', function () {
        tabelTriase.ajax.reload();
    });
});