<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapIGDJumlahPasien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelIGD');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }
    public function index()
    {
        $data['title'] = 'Rekap Pasien IGD';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_igd_jml_pasien');
        $this->load->view('layout/footer');
    }

    public function JmlPasienIGDRalanRanap()
    {
        $tglAwalRegistrasi = $this->input->post('tglTriaseAwal');
        $tglAkhirRegistrasi = $this->input->post('tglTriaseAkhir');

        if (empty($tglAwalRegistrasi) || empty($tglAkhirRegistrasi)) {
            $data = [];
        } else {
            $dataPasienIGD = $this->ModelIGD->JumlahPasienRalanRanap($tglAwalRegistrasi, $tglAkhirRegistrasi)->result();

            $data = [];
            foreach ($dataPasienIGD as $JmlPasien) {
                $data[] = [
                    'plan' => $JmlPasien->status_lanjut,
                    'total' => $JmlPasien->total,
                ];
            }
        }
        echo json_encode($data);
    }

    public function JmlPasienIGDStts()
    {
        $tglAwalRegistrasi = $this->input->post('tglTriaseAwal');
        $tglAkhirRegistrasi = $this->input->post('tglTriaseAkhir');

        if (empty($tglAwalRegistrasi) || empty($tglAkhirRegistrasi)) {
            $data = [];
        } else {
            $dataPasienIGDStts = $this->ModelIGD->JumlahPasienBerdasarkanStts($tglAwalRegistrasi, $tglAkhirRegistrasi)->result();

            $data = [];
            foreach ($dataPasienIGDStts as $row) {
                $data[] = [
                    'stts' => $row->status,
                    'total_stts' => $row->total,
                ];
            }
        }
        echo json_encode($data);
    }
}
