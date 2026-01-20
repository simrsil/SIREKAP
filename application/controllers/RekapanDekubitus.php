<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RekapanDekubitus extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelDekubitus');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Penilaian Risiko Dekubitus';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_dekubitus');
        $this->load->view('layout/footer');
    }

    //MENAMPILKAN DATA PENILAIAN DEKUBITUS
    public function tampilanPenilaianDekubitus()
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

        $dataPenilaianDekubitus = $this->ModelDekubitus->tampilanPenilaianDekubitus($tanggal1, $tanggal2, $start, $length, $search)->result();
        $recordTotal = $this->ModelDekubitus->countPenilaianDekubitus($tanggal1, $tanggal2, $search)->num_rows();
        //$no = $this->input->post('start') + 1;
        $data = [];

        foreach ($dataPenilaianDekubitus as $dr) {
            $row = [];
            //$row[] = $no++;
            $row[] = $dr->no_rawat;
            $row[] = $dr->no_rkm_medis;
            $row[] = $dr->nm_pasien;
            $row[] = $dr->tgl_lahir;
            $row[] = $dr->jk;
            $row[] = $dr->tanggal;
            $row[] = $dr->totalnilai;
            $row[] = $dr->kategorinilai;
            $row[] = $dr->nama;

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

    public function TampilanKelengkapanDekubitus()
    {
        $tanggal1 = $this->input->post('tanggal3');
        $tanggal2 = $this->input->post('tanggal4');
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

        $KelengkapanDekubitus = $this->ModelDekubitus->TampilAsesmenAwalIGD($tanggal1, $tanggal2, $start, $length, $search)->result();
        $recordTotal = $this->ModelDekubitus->CountAsesmenAwalIGD($tanggal1, $tanggal2, $search);
        $no = $this->input->post('start') + 1;
        $data = [];

        foreach ($KelengkapanDekubitus as $dr) {
            $row = [];
            $row[] = $no++;
            $row[] = $dr->no_rawat;
            $row[] = $dr->no_rkm_medis;
            $row[] = $dr->nm_pasien;
            $row[] = $dr->tanggal;
            $row[] = $dr->aktifitas;

            $KeteranganDekubitus = $this->ModelDekubitus->KetDekubitus($dr->no_rawat)->result();
            $kelengkapanList = [];

            foreach ($KeteranganDekubitus as $b) {
                $kelengkapanList[] = $b->kelengkapan;
            }

            // Jika hanya ADA, tampilkan button
            // if (!empty($kelengkapanList) && implode(", ", $kelengkapanList) === "Ada") {
            //     $button = '<button class="btn btn-success btn-sm">Ada</button>';
            //     $row[] = $button;
            // } else {
            //     $row[] = implode(", ", $kelengkapanList);
            // }
            $row[] = implode(", ", $kelengkapanList); // Gabungkan hasil menjadi satu kolom

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

    public function ExportExcelKelengkapanDekubitus($tanggal1, $tanggal2)
    {
        $L_KelengkapanDekubitus = $this->ModelDekubitus->ExcelTampilAsesmenAwalIGD($tanggal1, $tanggal2)->result();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Rekap_Kelengkapan_Dekubitus.xlsx"');
        header('Cache-Control: max-age=0');
        $spreadsheet = new Spreadsheet();

        $no = 1;
        $row = 2;
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet1->setTitle('Laporan Kelengkapan Dekubitus');
        $sheet1->setCellValue('A1', 'No');
        $sheet1->setCellValue('B1', 'No.Rawat');
        $sheet1->setCellValue('C1', 'No.RM');
        $sheet1->setCellValue('D1', 'Nama Pasien');
        $sheet1->setCellValue('E1', 'Tanggal Masuk');
        $sheet1->setCellValue('F1', 'Aktifitas');
        $sheet1->setCellValue('G1', 'Pengisian Dekubitus');
        // $sheet1->setCellValue('H1', 'Status Pulang');

        foreach ($L_KelengkapanDekubitus as $value) {

            $sheet1->setCellValue('A' . $row, $no++);
            $sheet1->setCellValue('B' . $row, $value->no_rawat);
            $sheet1->setCellValue('C' . $row, $value->no_rkm_medis);
            $sheet1->setCellValue('D' . $row, $value->nm_pasien);
            $sheet1->setCellValue('E' . $row, $value->tanggal);
            $sheet1->setCellValue('F' . $row, $value->aktifitas);

            // Reset array sebelum setiap iterasi
            $kelengkapanList = [];

            // Ambil data kelengkapan dekubitus
            $KeteranganDekubitus = $this->ModelDekubitus->KetDekubitus($value->no_rawat)->result();
            foreach ($KeteranganDekubitus as $b) {
                $kelengkapanList[] = $b->kelengkapan;
            }

            $sheet1->setCellValue('G' . $row, implode(", ", $kelengkapanList)); // Gabungkan data



            // $sheet1->setCellValue('G' . $row, $value->lama);
            // $sheet1->setCellValue('H' . $row, $value->status_pulang);

            $row++;
        }
        // $sheet1->setCellValue('F' . $row, 'Total');
        // $sheet1->setCellValue('G' . $row, '=SUM(G2:G' . ($row - 1) . ')'); // Rumus SUM

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }

    public function tampilanDekubitus()
    {
        $tanggal1 = $this->input->post('tanggal5');
        $tanggal2 = $this->input->post('tanggal6');
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

        $dataDekubitus = $this->ModelDekubitus->tampilanDekubitus($tanggal1, $tanggal2, $start, $length, $search)->result();
        $recordTotal = $this->ModelDekubitus->countDekubitus($tanggal1, $tanggal2, $search)->num_rows();
        $no = $this->input->post('start') + 1;
        $data = [];

        foreach ($dataDekubitus as $dr) {
            $row = [];
            $row[] = $no++;
            $row[] = $dr->no_rawat;
            $row[] = $dr->no_rkm_medis;
            $row[] = $dr->nm_pasien;
            $row[] = $dr->tgl_registrasi;
            $row[] = $dr->tgl_keluar;
            $row[] = $dr->lama;
            $row[] = $dr->status_pulang;

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

    public function ExportExcelRekapDekubitus($tanggal1, $tanggal2)
    {
        $LaporanDekubitus = $this->ModelDekubitus->ExcelDekubitus($tanggal1, $tanggal2)->result();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Rekap_Laporan_Dekubitus.xlsx"');
        header('Cache-Control: max-age=0');
        $spreadsheet = new Spreadsheet();

        $no = 1;
        $row = 2;
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet1->setTitle('Laporan Dekubitus');
        $sheet1->setCellValue('A1', 'No');
        $sheet1->setCellValue('B1', 'No. Rawat');
        $sheet1->setCellValue('C1', 'No.Rekam Medis');
        $sheet1->setCellValue('D1', 'Nama Pasien');
        $sheet1->setCellValue('E1', 'Tanggal Masuk');
        $sheet1->setCellValue('F1', 'Tanggal Keluar');
        $sheet1->setCellValue('G1', 'Lama');
        $sheet1->setCellValue('H1', 'Status Pulang');

        foreach ($LaporanDekubitus as $value) {

            $sheet1->setCellValue('A' . $row, $no++);
            $sheet1->setCellValue('B' . $row, $value->no_rawat);
            $sheet1->setCellValue('C' . $row, $value->no_rkm_medis);
            $sheet1->setCellValue('D' . $row, $value->nm_pasien);
            $sheet1->setCellValue('E' . $row, $value->tgl_registrasi);
            $sheet1->setCellValue('F' . $row, $value->tgl_keluar);
            $sheet1->setCellValue('G' . $row, $value->lama);
            $sheet1->setCellValue('H' . $row, $value->status_pulang);

            $row++;
        }
        $sheet1->setCellValue('F' . $row, 'Total');
        $sheet1->setCellValue('G' . $row, '=SUM(G2:G' . ($row - 1) . ')'); // Rumus SUM

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
