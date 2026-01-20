<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SensusHarian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
        $this->load->model('ModelSensusHarian');
    }
    public function index()
    {
        $data['title'] = 'Sensus Harian';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_sensus_harian');
        $this->load->view('layout/footer');
    }
    public function dataPasienKeluar()
    {
        //menambah percabangan berdasarkan waktu pasien meninggal
        $tglKeluar1 = $this->input->post('tglKeluar1') ?: date('Y-m-d');
        $tglKeluar2 = $this->input->post('tglKeluar2') ?: date('Y-m-d');
        $waktu = $this->input->post('waktu');
        $data = [];
        $pxKeluar =  $this->ModelSensusHarian->pasienKeluar($tglKeluar1, $tglKeluar2)->result();
        $pxKeluar2 =  $this->ModelSensusHarian->pasienKeluar2($tglKeluar1, $tglKeluar2)->result();
        if ($waktu == '1') {
            foreach ($pxKeluar as $px) {
                $row = [];
                $row[] = $px->nm_dokter;
                $row[] = $px->lk;
                $row[] = $px->pr;
                $data[] = $row;
            }
        } elseif ($waktu == '2') {
            foreach ($pxKeluar2 as $px2) {
                $row = [];
                $row[] = $px2->nm_dokter;
                $row[] = $px2->lk;
                $row[] = $px2->pr;
                $data[] = $row;
            }
        }
        $data_json = [
            'data' => $data
        ];
        echo json_encode($data_json);
    }

    public function dataPasienMasuk()
    {
        $tglMasuk1 = $this->input->post('tglMasuk1') ?: date('Y-m-d');
        $tglMasuk2 = $this->input->post('tglMasuk2') ?: date('Y-m-d');
        $getPasienMasuk = $this->ModelSensusHarian->pasienMasuk($tglMasuk1, $tglMasuk2)->result();

        $data = [];
        foreach ($getPasienMasuk as $pxMasuk) {
            $row = [];
            $row[] = $pxMasuk->nm_dokter;
            $row[] = $pxMasuk->jml_pasien_masuk;

            $data[] = $row;
        }
        $data_json = [
            'data' => $data
        ];

        echo json_encode($data_json);
    }
    public function pasienAwal() {}
}
