
$(function () {
    $("#tanggal1 ,#tanggal2").datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true,
        changeYear: true
    });
});
$(document).ready(function () {
    let tabelOperasi = $('#table-taskid').DataTable({
        processing: true,
        serverSide: true,
        destroy: true, // Mencegah duplikasi DataTables
        autoWidth: false,
        ajax: {
            url: 'RekapanTaskID/tampilTaskId',
            type: "POST",
            data: function (data) {
                data.tanggal1 = $('#tanggal1').val();
                data.tanggal2 = $('#tanggal2').val();
            },
            error: function (xhr, error, thrown) {
                console.log("Error DataTables:", xhr.responseText);
            }
        },
        columnDefs: [{
            targets: 0, // Kolom 1
            orderable: false,
            searchable: false,
            render: function (data, type, row) {
                return data; // Pastikan data bisa menampilkan HTML
            },
            width: "10%"
        },
        {
            targets: 1, // Kolom 2
            width: "10%"
        },
        {
            targets: 2, // Kolom 3
            width: "25%"
        },
        {
            targets: 3, // Kolom 4
            width: "10%"
        },
        {
            targets: 4, // Kolom 5
            width: "5%"
        },
        {
            targets: 5, // Kolom 6
            width: "5%"
        },
        {
            targets: 6, // Kolom 7
            width: "5%"
        },
        {
            targets: 7, // Kolom 8
            width: "5%"
        },
        {
            targets: 8, // Kolom 9
            width: "5%"
        },
        {
            targets: 9, // Kolom 10
            width: "5%"
        },
        {
            targets: 10, // Kolom 11
            width: "5%"
        },
        {
            targets: 11, // Kolom 12
            width: "5%"
        },
        {
            targets: 12, // Kolom 12
            width: "5%"
        },
        {
            targets: 13, // Kolom 12
            width: "5%"
        },
        ]
    });

    // Klik tombol "Tampilkan Data"
    $('#tampil-taskid').on('click', function () {
        let tanggal1 = $('#tanggal1').val();
        let tanggal2 = $('#tanggal2').val();

        if (tanggal1 === '' || tanggal2 === '') {
            alert('Tanggal wajib diisi!');
            return;
        }
        // tabelOperasi.clear().draw(); // Bersihkan tabel sebelum reload data
        tabelOperasi.ajax.reload(null, false); // Tambahkan 'false' agar tidak reset paging

        // setTimeout(() => {
        //   tabelOperasi.columns.adjust().draw(); // Pastikan lebar tetap
        // }, 500);
    });
});
