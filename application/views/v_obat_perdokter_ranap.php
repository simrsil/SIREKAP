<section class="content">
  <div class="container-fluid" id="konten">
    <div class="row">
      <div class="col-12">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            Obat Per Dokter Ranap
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
            <div class="row">
              <div class="col-8 flex-wrap">
                <div>
                  <div class="row">
                    <div class="col- ">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal1" name="tanggal1" required>
                    </div>
                    <div class="col-">
                      <input type="text" class="form-control form-control-sm" placeholder="Pilih Tanggal" id="tanggal2" name="tanggal2" required>
                    </div>
                    <div class="col-">
                      <select class="form-control form-control-sm" name="status" id="status">
                        <option value="">--Pilih Status--</option>
                        <option value="1">Dokter DPJP</option>
                        <option value="2">Dokter Jaga</option>
                      </select>
                    </div>
                    <div class="col-">
                      <select class="form-control form-control-sm" name="dokter" id="dokter">
                        <option value="">--Pilih Dokter--</option>
                        <?php foreach ($dokter as $d) : ?>
                          <option value="<?= $d->kd_dokter ?>"><?= $d->nm_dokter ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col- ml-2">
                      <button class="btn btn-info btn-sm" id="tampil-obat-ranap" disabled><i class="fas fa-eye"></i> Tampilkan</button>
                      <button class="btn btn-success btn-sm" id="btn-export-excel"><i class="far fa-file-excel"></i> Export Excel</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="dropdown-divider"></div>
            <table class="table table-responsive-lg table-bordered table-sm" id="table-obat-dokter-ranap">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Dokter</th>
                  <th scope="col">Obat</th>
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
</section>
<script src="<?= base_url("Assets/js/app/obat.js") ?>"></script>