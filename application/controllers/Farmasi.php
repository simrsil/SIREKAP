<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Farmasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("ModelFarmasi");
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }
    public function index()
    {
        $data['title'] = 'Data Resep Per Hari';
        //$this->load->view('layout/header', $data);
        $this->load->view('layout/top-nav', $data);
        //$this->load->view('layout/sidebar');
        $this->load->view('v_farmasi');
        $this->load->view('layout/footer');
    }
    public function dataResepObat()
    {
        $tgl_awal = $this->input->post('tgl_awal') ?: date('Y-m-d');
        $tgl_akhir = $this->input->post('tgl_akhir') ?: date('Y-m-d');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $dataResep = $this->ModelFarmasi->getResepObat($tgl_awal, $tgl_akhir, $start, $length)->result();
        $recordTotal = $this->ModelFarmasi->countResepObat($tgl_awal, $tgl_akhir)->num_rows();
        $data = [];
        $no = 1;
        foreach ($dataResep as $dr) {
            $row = [];
            $row[] = $no++;
            $row[] = $dr->tgl_perawatan;
            $row[] = $dr->obat_ralan;
            $row[] = $dr->obat_ranap;
            $row[] = $dr->jml_px;

            $data[] = $row;
        }
        $dataJson = [
            'draw' => $draw,
            'recordsTotal' => $recordTotal,
            'recordsFiltered' => $recordTotal,
            'data' => $data
        ];
        echo json_encode($dataJson);
    }

    public function ExcelJumlahResep($tgl_awal, $tgl_akhir)
    {
        $resepObatExcel = $this->ModelFarmasi->excelResepObat($tgl_awal, $tgl_akhir)->result();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="rekap_Jumlah_Resep_Obat_' . $tgl_awal . '_' . $tgl_akhir . '.xlsx"');
        header('Cache-Control: max-age=0');
        $spreadsheet = new Spreadsheet();

        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'Tanggal Resep');
        $activeWorksheet->setCellValue('B1', 'Jumlah Resep Ralan');
        $activeWorksheet->setCellValue('C1', 'Jumlah Resep Ranap');
        $activeWorksheet->setCellValue('D1', 'Jumlah Resep');
        $row = 2;
        foreach ($resepObatExcel as $value) {

            $activeWorksheet->setCellValue('A' . $row, $value->tgl_perawatan);
            $activeWorksheet->setCellValue('B' . $row, $value->obat_ralan);
            $activeWorksheet->setCellValue('C' . $row, $value->obat_ranap);
            $activeWorksheet->setCellValue('D' . $row, $value->jml_px);

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
