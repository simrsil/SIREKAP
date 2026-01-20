<section class="content">
  <div class="container-fluid" id="konten">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
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
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal3" name="tanggal3" required>
                    </div>
                    <div class="btn-group">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal4" name="tanggal4" required>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-info btn-sm" id="tampil-operasi"><i class="fas fa-eye"></i> Tampilkan</button>
                    </div>
                    <div class="btn-group">
                      <button class="btn btn-success btn-sm" onclick="exportExcelOperasi()"><i class="far fa-file-excel"></i> Export Excel</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <table class="table table-responsive table-bordered table-sm" id="table-operasi">
              <thead>
                <tr>
                  <th>No.Rawat</th>
                  <th>No.RM</th>
                  <th>Pasien</th>
                  <th>Status</th>
                  <th>Operasi</th>
                  <th>Pre Anastesi</th>
                  <th>Pre Operasi</th>
                  <th>Tm.Seb Insisi</th>
                  <th>Sg.Seb Anastesi</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modalDetail" aria-labelledby="modalDetailLabel">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h2 class="modal-title" id="modalDetailLabel">Data Surveilance
            </h2>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="invoice p-3 mb-3">
              <h4>
                <i></i> Data Pasien
              </h4>
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                  <strong>Nama</strong>
                  <address>
                    <p id="detailnamapasien"></p>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <strong>Nomer Rekam Medis</strong>
                  <address>
                    <p id="detailrkm"></p>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <b>Tanggal Lahir</b><br>
                  <address>
                    <p id="detailtgl_lahir"></p>
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">
                  <b>Tanggal Ranap</b><br>
                  <address>
                    <p id="detailtgl_ranap"></p>
                  </address>
                </div>
              </div>
              <div class="dropdown-divider"></div>
              <h4>
                <i></i> Keterangan Operasi
              </h4>
              <div class="row invoice-info">
                <table class="table table-responsive-lg table-bordered table-sm" id="table-detail-operasi">
                  <thead>
                    <tr>
                      <th scope="col">Nama Operasi</th>
                      <th scope="col">Dokter Bedah</th>
                      <th scope="col">Waktu Pembedahan</th>
                      <th scope="col">Diag. Pre Op</th>
                      <th scope="col">Jam Op</th>
                      <th scope="col">Selesai Op</th>
                      <th scope="col">Durasi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div class="dropdown-divider"></div>
              <h4>
                <i></i> Pre Anastesi
              </h4>
              <div class="row invoice-info">
                <table class="table table-responsive-lg table-bordered table-sm" id="table-detail-pre-anastesi">
                  <thead>
                    <tr>
                      <th scope="col">Jam Input</th>
                      <th scope="col">Kebiasaan Merokok</th>
                      <th scope="col">Suhu</th>
                      <th scope="col">Terapi</th>
                      <th scope="col">Angka ASA</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div class="dropdown-divider"></div>
              <h4>
                Pre Operasi
              </h4>
              <div class="row invoice-info">
                <table class="table table-responsive-lg table-bordered table-sm" id="table-detail-pre-operasi">
                  <thead>
                    <tr>
                      <th scope="col">Jam</th>
                      <th scope="col">Perlengkapan Khusus</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div class="dropdown-divider"></div>
              <h4>
                Time Out Sebelum Insisi
              </h4>
              <div class="row invoice-info">
                <table class="table table-responsive-lg table-bordered table-sm" id="table-detail-tosi">
                  <thead>
                    <tr>
                      <th scope="col">Jam</th>
                      <th scope="col">Antibiotik Profilaks</th>
                      <th scope="col">Nama Antibiotik</th>
                      <th scope="col">Jam Pemberian</th>
                      <th scope="col">Petunjuk Sterilisasi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div class="dropdown-divider"></div>
              <h4>
                Signin Sebelum Anestesi
              </h4>
              <div class="row invoice-info">
                <table class="table table-responsive-lg table-bordered table-sm" id="table-detail-ssa">
                  <thead>
                    <tr>
                      <th scope="col">Jam</th>
                      <th scope="col">Resiko Kehilangan Darah</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script src="<?= base_url("Assets/js/app/surveilance.js") ?>"></script>