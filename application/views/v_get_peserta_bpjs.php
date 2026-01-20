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
                        Get Peserta BPJS
                        <!-- <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div> -->
                    </div>
                    <div class="card-body">
                        <form id="form-peserta">
                            <div class="form-row">
                                <div class="col-10">
                                    <input type="number" class="form-control" placeholder="Masukkan NIK Peserta" id="nik" name="nik">
                                </div>
                                <div class="col">
                                    <button class="btn btn-info">Kirim</button>
                                </div>
                            </div>
                        </form>
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
    $(document).ready(function() {
        $('#form-peserta').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();
            $.ajax({
                url: '<?= base_url('ApiBpjs/getPeserta') ?>',
                type: 'POST',
                data: formData,
                success: function(response) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        iconColor: 'white',
                        customClass: {
                            popup: 'colored-toast',
                        },
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        background: '#3fc3ee',
                        color: '#ffff',
                    });
                    Toast.fire({
                        icon: 'success',
                        title: response,
                    })
                },
                error: function(xhr, status, error) {
                    console.error('Terjadi error:', error);
                }
            })
        });
    });
</script>