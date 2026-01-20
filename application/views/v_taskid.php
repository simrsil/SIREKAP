<section class="content">
  <div class="container-fluid" id="konten">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            Laporan Task ID Kirim Antrian Online
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
              <div method="POST">
                <div class="row">
                  <div class="margin">
                    <div class="btn-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal1" name="tanggal1" required>
                    </div>
                    <div class="btn-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal2" name="tanggal2" required>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-info btn-sm" id="tampil-taskid"><i class="fas fa-eye"></i> Tampilkan</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <table class="table table-responsive table-bordered table-sm" id="table-taskid">
              <thead>
                <tr>
                  <th>No.Rawat</th>
                  <th>No.RM</th>
                  <th>Pasien</th>
                  <th>Cara Bayar</th>
                  <th>JKN</th>
                  <th>SEP</th>
                  <th>T1</th>
                  <th>T2</th>
                  <th>T3</th>
                  <th>T4</th>
                  <th>T5</th>
                  <th>T6</th>
                  <th>T7</th>
                  <th>T99</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  $(function() {
    $("#tanggal1 ,#tanggal2").datepicker({
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true
    });
  });
</script>

<script>
  $(document).ready(function() {
    let tabelOperasi = $('#table-taskid').DataTable({
      processing: true,
      serverSide: true,
      destroy: true, // Mencegah duplikasi DataTables
      autoWidth: false,
      ajax: {
        url: "<?= base_url('RekapanTaskID/tampilTaskId') ?>",
        type: "POST",
        data: function(data) {
          data.tanggal1 = $('#tanggal1').val();
          data.tanggal2 = $('#tanggal2').val();
        },
        error: function(xhr, error, thrown) {
          console.log("Error DataTables:", xhr.responseText);
        }
      },
      columnDefs: [{
          targets: 0, // Kolom 1
          orderable: false,
          searchable: false,
          render: function(data, type, row) {
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
    $('#tampil-taskid').on('click', function() {
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
</script>