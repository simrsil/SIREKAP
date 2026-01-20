<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapanRanap extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelRanap');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }
    public function index()
    {
        $data['title'] = 'Pasien Rawat Inap';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_ranap');
        $this->load->view('layout/footer');
    }

    public function ViewKamarInap()
    {
        $data['title'] = 'Kamar Inap';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_ranap');
        $this->load->view('layout/footer');
    }

    public function RawatInap()
    {
        $tanggal1 = $this->input->post('tanggal1');
        $tanggal2 = $this->input->post('tanggal2');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'] ?? '';

        //JIKA KOLOM TANGGAL TIDAK DIISI, DATA YANG DI TAMPILKAN KOSONG
        if (empty($tanggal1) || empty($tanggal2)) {
            echo json_encode([
                'draw' => $draw,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            ]);
            return;
        }

        $v_pasienranap = $this->ModelRanap->TampilPasienRanap($tanggal1, $tanggal2, $start, $length, $search)->result();
        $recordTotal = $this->ModelRanap->JmlHalamanPasienRanap($tanggal1, $tanggal2, $search)->num_rows();
        //$no = $this->input->post('start') + 1;
        $data = [];

        foreach ($v_pasienranap as $dr) {
            $row = [];
            //$row[] = $no++;
            $row[] = $dr->no_rawat;
            $row[] = $dr->tgl_registrasi;
            $row[] = $dr->tgl_masuk;
            $row[] = $dr->nm_pasien;
            $row[] = $dr->nm_bangsal;

            $data[] = $row;
        }
        $data_json = [
            'draw' => $draw,
            'recordsTotal' => $recordTotal,
            'recordsFiltered' => $recordTotal,
            'data' => $data
        ];

        echo json_encode($data_json);
    }
}
