<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LaporanPasien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelLaporanPasien');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }
    public function index()
    {
        $data['title'] = 'Laporan Pasien';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_laporan_pasien_perdokter');
        $this->load->view('layout/footer');
    }

    public function dataPasienPerBulan()
    {
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $getDokter = $this->ModelLaporanPasien->getDokterDpjp($start, $length)->result();
        $recordTotal = $this->ModelLaporanPasien->getDokterDpjpAll()->num_rows();
        $data = [];
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        foreach ($getDokter as $key => $dpjp) {
            $row = [];
            $getPasien = $this->ModelLaporanPasien->getPasienInap($dpjp->kd_dokter, $bulan, $tahun)->result();
            foreach ($getPasien as $px) {
                $row[] = $dpjp->nm_dokter;
                $row[] = $px->jml_px;
                $data[] = $row;
            }
        }
        $datajson = [
            'draw' => $draw,
            'recordsTotal' => $recordTotal,
            'recordsFiltered' => $recordTotal,
            'data' => $data
        ];
        echo json_encode($datajson);
    }

    public function dataPasienIGD()
    {
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $bulan = $this->input->post('bulan2');
        $tahun = $this->input->post('tahun2');
        $getDokter = $this->ModelLaporanPasien->getDokterIGD($start, $length)->result();
        $recordTotal = $this->ModelLaporanPasien->getDokterIGDAll()->num_rows();
        // var_dump($getDokter);
        $data = [];
        foreach ($getDokter as $dokter) {
            $row = [];
            $getPasien = $this->ModelLaporanPasien->getPasienIGD($dokter->kd_dokter, $bulan, $tahun)->result();
            foreach ($getPasien as $px) {
                $row[] = $dokter->nm_dokter;
                $row[] = $px->jml_px;
                $data[] = $row;
            }
        }
        // var_dump($getPasien);
        $datajson = [
            'draw' => $draw,
            'recordsTotal' => $recordTotal,
            'recordsFiltered' => $recordTotal,
            'data' => $data
        ];
        echo json_encode($datajson);
    }
    public function pasienMeninggal()
    {
        $bulan3 = $this->input->post('bulan3');
        $tahun3 = $this->input->post('tahun3');
        $jumlahPxMati = $this->ModelLaporanPasien->getPasienMatiRanap($bulan3, $tahun3)->num_rows();
        echo json_encode(['jmlPxMati' => $jumlahPxMati]);
    }
}
