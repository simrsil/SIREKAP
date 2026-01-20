<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DiagnosaPasienPerUmur extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelDiagnosaPerUmur');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }
    public function index()
    {
        $data['title'] = 'Diagnosa Per Umur';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_diagnosa_per_umur');
        $this->load->view('layout/footer');
    }
    public function getDiagnosaPasienPerUmur()
    {
        $diagnosa = $this->input->post('diagnosa');
        $tgl_awal = $this->input->post('tgl_awal') ?: date('Y-m-d');
        $tgl_akhir = $this->input->post('tgl_akhir') ?: date('Y-m-d');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'];
        $recordTotal =  $recordTotal = $this->ModelDiagnosaPerUmur->countDiagnosaUmur($diagnosa, $tgl_awal, $tgl_akhir, $search = "")->num_rows();
        $dataDiagnosaPerUmur = $this->ModelDiagnosaPerUmur->getDiagnosaUmur($diagnosa, $tgl_awal, $tgl_akhir, $start, $length, $draw, $search)->result();
        $JumlahKunjungan = $this->ModelDiagnosaPerUmur->jumlahKunjungan($tgl_awal, $tgl_akhir)->result();
        $data = [];
        foreach ($dataDiagnosaPerUmur as $du) {
            $row = [];
            $row[] = $du->kategori_umur;
            $row[] = $du->kd_penyakit;
            $row[] = $du->px_lk;
            $row[] = $du->px_pr;
            $data[] = $row;
        }

        $dataJson = [
            'draw' => $draw,
            'recordsTotal' => $recordTotal,
            'recordsFiltered' => $recordTotal,
            'data' => $data,
            'kunjungan_lk' => $JumlahKunjungan[0]->kunjungan_lk ?: 0,
            'kunjungan_pr' => $JumlahKunjungan[0]->kunjungan_pr ?: 0
        ];
        echo json_encode($dataJson);
    }
    public function getDiagnosaPasienPerUmurRanap()
    {
        $diagnosa = $this->input->post('diagnosa_ranap');
        $tgl_awal = $this->input->post('tgl_awal2') ?: date('Y-m-d');
        $tgl_akhir = $this->input->post('tgl_akhir2') ?: date('Y-m-d');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'];
        $recordTotal =  $recordTotal = $this->ModelDiagnosaPerUmur->countDiagnosaUmurRanap($diagnosa, $tgl_awal, $tgl_akhir, $search = "")->num_rows();
        $dataDiagnosaPerUmur = $this->ModelDiagnosaPerUmur->getDiagnosaUmurRanap($diagnosa, $tgl_awal, $tgl_akhir, $start, $length, $draw, $search)->result();
        $pasien_meninggal = $this->ModelDiagnosaPerUmur->pasienMeninggal($tgl_awal, $tgl_akhir)->result();
        $data = [];
        foreach ($dataDiagnosaPerUmur as $du) {
            $row = [];
            $row[] = $du->kategori_umur;
            $row[] = $du->kd_penyakit;
            $row[] = $du->px_lk;
            $row[] = $du->px_pr;
            $data[] = $row;
        }
        $dataJson = [
            'draw' => $draw,
            'recordsTotal' => $recordTotal,
            'recordsFiltered' => $recordTotal,
            'data' => $data,
            'meninggal_lk' => $pasien_meninggal[0]->mati_lk ?: 0,
            'meninggal_pr' => $pasien_meninggal[0]->mati_pr ?: 0
        ];
        echo json_encode($dataJson);
    }

    public function diagnosaKasusBaru()
    {
        $diagnosa = $this->input->post('diagnosa_kasus');
        $tgl_awal = $this->input->post('tgl_awal3') ?: date('Y-m-d');
        $tgl_akhir = $this->input->post('tgl_akhir3') ?: date('Y-m-d');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'];
        $recordTotal =  $recordTotal = $this->ModelDiagnosaPerUmur->countDiagnosaKasusBaru($diagnosa, $tgl_awal, $tgl_akhir, $search = "")->num_rows();
        $dataDiagnosaPerKasus= $this->ModelDiagnosaPerUmur->diagnosaKasusBaru($diagnosa, $tgl_awal, $tgl_akhir, $start, $length, $draw, $search)->result();
        $data = [];
        foreach ($dataDiagnosaPerKasus as $du) {
            $row = [];
            $row[] = $du->kategori_umur;
            $row[] = $du->kd_penyakit;
            $row[] = $du->px_lk;
            $row[] = $du->px_pr;
            $data[] = $row;
        }
        $dataJson = [
            'draw' => $draw,
            'recordsTotal' => $recordTotal,
            'recordsFiltered' => $recordTotal,
            'data' => $data,
        ];
        echo json_encode($dataJson);
    }
}
