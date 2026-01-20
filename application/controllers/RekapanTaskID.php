<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

class RekapanTaskID extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelTaskID');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }
    public function index()
    {
        $data['title'] = 'Rekapan Antrian Online (TASK ID)';
        $this->load->view('layout/header', $data);
        $this->load->view('layout/sidebar', $data);
        $this->load->view('v_taskid');
        $this->load->view('layout/footer');
    }

    public function tampilTaskId()
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

        $dataRekapTaskID = $this->ModelTaskID->TampilTaskID($tanggal1, $tanggal2, $start, $length, $search)->result();
        $recordTotal = $this->ModelTaskID->CountTampilTaskID($tanggal1, $tanggal2, $search);

        $data = [];

        foreach ($dataRekapTaskID as $dr) {
            $row = [];
            $row[] = $dr->no_rawat;
            $row[] = $dr->no_rkm_medis;
            $row[] = $dr->nm_pasien;
            $row[] = $dr->png_jawab;
            //$row[] = $dr->stts_daftar;

            $row[] = $this->renderTaskButtons($this->ModelTaskID->JKN($dr->no_rawat)->result(), 'jkn');
            $row[] = $this->renderTaskButtons($this->ModelTaskID->SEP($dr->no_rawat)->result(), 'sep');
            $row[] = $this->renderTaskButtons($this->ModelTaskID->TaskID_1($dr->no_rawat)->result(), 'taskid1');
            $row[] = $this->renderTaskButtons($this->ModelTaskID->TaskID_2($dr->no_rawat)->result(), 'taskid2');
            $row[] = $this->renderTaskButtons($this->ModelTaskID->TaskID_3($dr->no_rawat)->result(), 'taskid3');
            $row[] = $this->renderTaskButtons($this->ModelTaskID->TaskID_4($dr->no_rawat)->result(), 'taskid4');
            $row[] = $this->renderTaskButtons($this->ModelTaskID->TaskID_5($dr->no_rawat)->result(), 'taskid5');
            $row[] = $this->renderTaskButtons($this->ModelTaskID->TaskID_6($dr->no_rawat)->result(), 'taskid6');
            $row[] = $this->renderTaskButtons($this->ModelTaskID->TaskID_7($dr->no_rawat)->result(), 'taskid7');
            $row[] = $this->renderTaskButtons($this->ModelTaskID->TaskID_99($dr->no_rawat)->result(), 'taskid99');

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

    private function renderTaskButtons($results, $field)
    {
        $values = array_column($results, $field);
        $output = [];

        foreach ($values as $val) {
            if ($val == 1) {
                $output[] = '<button class="btn btn-success btn-sm"><i class="fa fa-check"></i></button>';
            } else {
                $output[] = '<button class="btn btn-danger btn-sm"><i class="fa fa-times"></i></button>';
            }
        }

        return implode(" ", $output);
    }
}
