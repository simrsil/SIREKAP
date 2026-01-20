<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RekapanRadiologi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('RadiologiModel');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Data Periksa Radiologi';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_rekap_radiologi');
        $this->load->view('layout/footer');
    }

    public function tampilRadiologi()
    {
        $tanggal1 = $this->input->post('tanggal1') ?: date('Y-m-d');
        $tanggal2 = $this->input->post('tanggal2') ?: date('Y-m-d');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'];
        $dataRadiologi = $this->RadiologiModel->radiologi($tanggal1, $tanggal2, $start, $length, $search)->result();
        $recordTotal = $this->RadiologiModel->countRadiologi($tanggal1, $tanggal2, $search)->num_rows();
        $no = $this->input->post('start') + 1;
        $data = [];

        foreach ($dataRadiologi as $dr) {
            $row = [];
            $row[] = $no++;
            $row[] = $dr->tgl_periksa;
            $row[] = $dr->nm_dokter;
            $row[] = $dr->nm_pasien;
            $row[] = $dr->nm_perawatan;

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

    public function export_excel($tanggal1, $tanggal2)
    {
        $radiologiExcel = $this->RadiologiModel->excelRadiologi($tanggal1, $tanggal2)->result();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="radiologi.xlsx"');
        header('Cache-Control: max-age=0');
        $spreadsheet = new Spreadsheet();

        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'Tanggal Periksa');
        $activeWorksheet->setCellValue('B1', 'Nama Dokter');
        $activeWorksheet->setCellValue('C1', 'Nama Pasien');
        $activeWorksheet->setCellValue('D1', 'Pemeriksaan');
        $row = 2;
        foreach ($radiologiExcel as $value) {

            $activeWorksheet->setCellValue('A' . $row, $value->tgl_periksa);
            $activeWorksheet->setCellValue('B' . $row, $value->nm_dokter);
            $activeWorksheet->setCellValue('C' . $row, $value->nm_pasien);
            $activeWorksheet->setCellValue('D' . $row, $value->nm_perawatan);

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
