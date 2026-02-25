<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIREKAP | <?= $title ?></title>
    <link rel="icon" href="<?= base_url('Assets/') ?>img/rsi-logo.ico" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <script src="<?= base_url('Assets/') ?>js/jquery-3.7.1.min.js"></script>
    <script src="<?= base_url('Assets/') ?>js/jquery-ui.min.js"></script>
    <script src="<?= base_url('Assets/') ?>js/dataTables.min.js"></script>
    <script src="<?= base_url('Assets/') ?>js/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url('Assets/') ?>js/sweetalert2@11.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link href="<?= base_url('Assets/') ?>css/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('Assets/') ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('Assets/') ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('Assets/') ?>plugins/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="<?= base_url('Assets/') ?>css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url('Assets/') ?>css/jquery-ui.min.css">
    <link rel="stylesheet" href="<?= base_url('Assets/') ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="<?= base_url('Assets/') ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
</head>

<body class="hold-transition layout-top-nav layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container-fluid">
                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse order-1" id="navbarCollapse">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="<?= base_url('Dashboard') ?>" class="nav-link">Dashboard</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Statistik & Laporan</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">BPJS</a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                        <li>
                                            <a tabindex="-1" href="<?= base_url('PasienRanapBpjs') ?>" class="dropdown-item">Pasien Ranap BPJS</a>
                                            <a tabindex="-1" href="<?= base_url('ApiBpjs') ?>" class="dropdown-item">Monitoring Bridging</a>
                                            <a tabindex="-1" href="<?= base_url('RekapanTaskID') ?>" class="dropdown-item">Task ID</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">PPI</a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                        <li>
                                            <a tabindex="-1" href="<?= base_url('rekapanAuditAPD') ?>" class="dropdown-item">Audit APD</a>
                                            <a tabindex="-1" href="<?= base_url('rekapanCuciTangan') ?>" class="dropdown-item">Cuci Tangan</a>
                                            <a tabindex="-1" href="<?= base_url('RekapanDekubitus') ?>" class="dropdown-item">Dekubitus</a>
                                            <a tabindex="-1" href="<?= base_url('RekapanSurveilanceOperasi1') ?>" class="dropdown-item">Surveilance Operasi</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="dropdown-submenu dropdown-hover">
                                    <a id="dropdownSubMenu2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="dropdown-item dropdown-toggle">Rekam Medis</a>
                                    <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
                                        <li>
                                            <a tabindex="-1" href="<?= base_url('DemografiRegistrasi') ?>" class="dropdown-item">Demografi</a>
                                            <a tabindex="-1" href="<?= base_url('DiagnosaPasienPerUmur') ?>" class="dropdown-item">Diagnosa</a>
                                            <a tabindex="-1" href="<?= base_url('LaporanPasien') ?>" class="dropdown-item">Jumlah Pasien Per-Dokter</a>
                                            <a tabindex="-1" href="<?= base_url('SensusHarian') ?>" class="dropdown-item">Sensus Harian Pasien</a>
                                            <a tabindex="-1" href="<?= base_url('StatusRM') ?>" class="dropdown-item">Status Rekam Medis</a>
                                            <a tabindex="-1" href="<?= base_url('RekapRujukan') ?>" class="dropdown-item">Rujukan Pasien</a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">IGD/UGD</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="<?= base_url('RekapIGDJumlahPasien') ?>" class="dropdown-item">Indikator Triase</a></li>
                                <li><a href="<?= base_url('RekapIGD') ?>" class="dropdown-item">Pasien IGD</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Laborat</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="<?= base_url('PeriksaLab') ?>" class="dropdown-item">Data Pemeriksaan</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Radiologi</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="<?= base_url('rekapanRadiologi') ?>" class="dropdown-item">Data Radiologi</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Farmasi</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="<?= base_url('ObatPerDokter') ?>" class="dropdown-item">Obat Per-Dokter Ranap</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Rawat Inap</a>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="<?= base_url('RekapanRanap') ?>" class="dropdown-item">Kamar Inap</a></li>
                                <li><a href="<?= base_url('RekapanRanapKamar') ?>" class="dropdown-item">Pasien Inap</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('SEPRajal') ?>" class="nav-link">Rawat Jalan</a>
                        </li>
                    </ul>
                    <!-- <form class="form-inline ml-0 ml-md-3">
                        <div class="input-group input-group-sm">
                            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-navbar" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->
                </div>
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <form action="<?= base_url('auth/logout') ?>" method="post" style="display: inline;">
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="content-wrapper">
            <div class="content-header">