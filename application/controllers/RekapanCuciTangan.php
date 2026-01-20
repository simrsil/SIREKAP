<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RekapanCuciTangan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelCuciTangan');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Data Audit Cuci Tangan';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_bulanan_cuci_tangan', $data);
        $this->load->view('layout/footer');
    }

    public function tampilCuciTangan()
    {
        $tanggal1 = $this->input->post('tanggal1') ?: date('Y-m-d');
        $tanggal2 = $this->input->post('tanggal2') ?: date('Y-m-d');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'];
        $recordTotal = $this->ModelCuciTangan->countCuciTangan($tanggal1, $tanggal2, $search)->num_rows();
        $no = $this->input->post('start') + 1;
        $dataCuciTangan = $this->ModelCuciTangan->cuciTangan($tanggal1, $tanggal2, $start, $length, $search)->result();
        $data = [];

        foreach ($dataCuciTangan as $value) {
            $row = [];
            $row[] = $no++;
            $row[] = $value->tanggal;
            $row[] = $value->nik;
            $row[] = $value->nama;
            $row[] = $value->jabatan;
            $row[] = $value->sebelum_menyentuh_pasien;
            $row[] = $value->sebelum_tehnik_aseptik;
            $row[] = $value->setelah_terpapar_cairan_tubuh_pasien;
            $row[] = $value->setelah_kontak_dengan_pasien;
            $row[] = $value->setelah_kontak_dengan_lingkungan_pasien;

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
        $cuciTanganExcel = $this->ModelCuciTangan->excelCuciTangan($tanggal1, $tanggal2)->result();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Rekap_Bulanan_Cuci_Tangan.xlsx"');
        header('Cache-Control: max-age=0');
        $spreadsheet = new Spreadsheet();

        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'Tanggal');
        $activeWorksheet->setCellValue('B1', 'NIP/Kode');
        $activeWorksheet->setCellValue('C1', 'Nama');
        $activeWorksheet->setCellValue('D1', 'Jabatan');
        $activeWorksheet->setCellValue('E1', 'Sebelum Menyentuh Pasien');
        $activeWorksheet->setCellValue('F1', 'Sebelum Tehnik Aseptik');
        $activeWorksheet->setCellValue('G1', 'Setelah Terpapar Cairan Tubuh Pasien');
        $activeWorksheet->setCellValue('H1', 'Setelah Kontak Dengan Pasien');
        $activeWorksheet->setCellValue('I1', 'Setelah Kontak Dengan Lingkungan Pasien');
        $row = 2;
        foreach ($cuciTanganExcel as $value) {

            $activeWorksheet->setCellValue('A' . $row, $value->tanggal);
            $activeWorksheet->setCellValue('B' . $row, $value->nik);
            $activeWorksheet->setCellValue('C' . $row, $value->nama);
            $activeWorksheet->setCellValue('D' . $row, $value->jabatan);
            $activeWorksheet->setCellValue('E' . $row, $value->sebelum_menyentuh_pasien);
            $activeWorksheet->setCellValue('F' . $row, $value->sebelum_tehnik_aseptik);
            $activeWorksheet->setCellValue('G' . $row, $value->setelah_terpapar_cairan_tubuh_pasien);
            $activeWorksheet->setCellValue('H' . $row, $value->setelah_kontak_dengan_pasien);
            $activeWorksheet->setCellValue('I' . $row, $value->setelah_kontak_dengan_lingkungan_pasien);

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
