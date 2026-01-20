<?php

use PhpOffice\PhpSpreadsheet\Calculation\TextData\Search;

defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class DemografiRegistrasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelDemografiRegistrasi');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }
    public function index()
    {
        $data['title'] = 'Demografi Registrasi';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_demografi_registrasi');
        $this->load->view('layout/footer');
    }

    public function getDemografiSuku()
    {
        $tgl_awal = $this->input->post('tgl_awal') ?: date('Y-m-d');
        $tgl_akhir = $this->input->post('tgl_akhir') ?: date('Y-m-d');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'];
        $recordTotal = $this->ModelDemografiRegistrasi->countPasienSuku($tgl_awal, $tgl_akhir, $search)->num_rows();
        $dataDemografi = $this->ModelDemografiRegistrasi->getPasienSuku($tgl_awal, $tgl_akhir, $start, $length, $draw, $search)->result();
        $data = [];
        if (!empty($dataDemografi)) {
            foreach ($dataDemografi as $demografi) {
                $row = [];
                $row[] = $demografi->nama_suku_bangsa;
                $row[] = $demografi->jml_px;

                $data[] = $row;
            }
        } else {
            $data = "";
        }
        $dataJson = [
            'draw' => $draw,
            'recordsTotal' => $recordTotal,
            'recordsFiltered' => $recordTotal,
            'data' => $data
        ];

        echo json_encode($dataJson);
    }
    public function getDemografiPendidikan()
    {
        $tgl_awal = $this->input->post('tgl_awal') ?: date('Y-m-d');
        $tgl_akhir = $this->input->post('tgl_akhir') ?: date('Y-m-d');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'];
        $recordTotal = $this->ModelDemografiRegistrasi->countPasienPendidikan($tgl_awal, $tgl_akhir, $search)->num_rows();
        $dataDemografi = $this->ModelDemografiRegistrasi->getPasienPendidikan($tgl_awal, $tgl_akhir, $start, $length, $draw, $search)->result();
        $data = [];
        if (!empty($dataDemografi)) {
            foreach ($dataDemografi as $demografi) {
                $row = [];
                $row[] = $demografi->pnd;
                $row[] = $demografi->jml_px;
                $data[] = $row;
            }
        } else {
            $data = "";
        }
        $dataJson = [
            'draw' => $draw,
            'recordsTotal' => $recordTotal,
            'recordsFiltered' => $recordTotal,
            'data' => $data
        ];

        echo json_encode($dataJson);
    }
    public function getDemografiAgama()
    {
        $tgl_awal = $this->input->post('tgl_awal') ?: date('Y-m-d');
        $tgl_akhir = $this->input->post('tgl_akhir') ?: date('Y-m-d');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'];
        $recordTotal = $this->ModelDemografiRegistrasi->countPasienAgama($tgl_awal, $tgl_akhir, $search)->num_rows();
        $dataDemografi = $this->ModelDemografiRegistrasi->getPasienAgama($tgl_awal, $tgl_akhir, $start, $length, $draw, $search)->result();
        $data = [];
        if (!empty($dataDemografi)) {
            foreach ($dataDemografi as $demografi) {
                $row = [];
                $row[] = $demografi->agama;
                $row[] = $demografi->jml_px;
                $data[] = $row;
            }
        } else {
            $data = "";
        }
        $dataJson = [
            'draw' => $draw,
            'recordsTotal' => $recordTotal,
            'recordsFiltered' => $recordTotal,
            'data' => $data
        ];

        echo json_encode($dataJson);
    }
    public function getDemografiBahasa()
    {
        $tgl_awal = $this->input->post('tgl_awal') ?: date('Y-m-d');
        $tgl_akhir = $this->input->post('tgl_akhir') ?: date('Y-m-d');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'];
        $recordTotal = $this->ModelDemografiRegistrasi->countPasienBahasa($tgl_awal, $tgl_akhir, $search)->num_rows();
        $dataDemografi = $this->ModelDemografiRegistrasi->getPasienBahasa($tgl_awal, $tgl_akhir, $start, $length, $draw, $search)->result();
        $data = [];
        if (!empty($dataDemografi)) {
            foreach ($dataDemografi as $demografi) {
                $row = [];
                $row[] = $demografi->nama_bahasa;
                $row[] = $demografi->jml_px;
                $data[] = $row;
            }
        } else {
            $data = "";
        }
        $dataJson = [
            'draw' => $draw,
            'recordsTotal' => $recordTotal,
            'recordsFiltered' => $recordTotal,
            'data' => $data
        ];

        echo json_encode($dataJson);
    }
    public function getDemografiUmur()
    {
        $tgl_awal = $this->input->post('tgl_awal') ?: date('Y-m-d');
        $tgl_akhir = $this->input->post('tgl_akhir') ?: date('Y-m-d');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'];
        $dataUmur = $this->ModelDemografiRegistrasi->getPasienUmur($tgl_awal, $tgl_akhir, $start, $length, $draw, $search)->result();
        $recordTotal = $this->ModelDemografiRegistrasi->countPasienUmur($tgl_awal, $tgl_akhir, $search = "")->num_rows();
        $data = [];
        foreach ($dataUmur as $umur) {
            $row = [];
            $row[] = $umur->kelompok_umur;
            $row[] = $umur->jumlah;
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
    public function getDemografiKecamatan()
    {
        $tgl_awal = $this->input->post('tgl_awal') ?: date('Y-m-d');
        $tgl_akhir = $this->input->post('tgl_akhir') ?: date('Y-m-d');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'];
        $dataKecamatan = $this->ModelDemografiRegistrasi->getPasienKecamatan($tgl_awal, $tgl_akhir, $start, $length, $draw, $search)->result();
        $recordTotal = $this->ModelDemografiRegistrasi->countPasienKecamatan($tgl_awal, $tgl_akhir, $search = "")->num_rows();
        $data = [];
        foreach ($dataKecamatan as $kec) {
            $row = [];
            $row[] = $kec->nm_kab;
            $row[] = $kec->nm_kec;
            $row[] = $kec->jumlah;
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
    public function getDemografiKecamatan2()
    {
        $tgl_awal = $this->input->post('tgl_awal') ?: date('Y-m-d');
        $tgl_akhir = $this->input->post('tgl_akhir') ?: date('Y-m-d');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'];
        $dataKecamatan = $this->ModelDemografiRegistrasi->getPasienKecamatan2($tgl_awal, $tgl_akhir, $start, $length, $draw, $search)->result();
        $recordTotal = $this->ModelDemografiRegistrasi->countPasienKecamatan2($tgl_awal, $tgl_akhir, $search = "")->num_rows();
        $data = [];
        foreach ($dataKecamatan as $kec) {
            $row = [];
            $row[] = $kec->nm_kab;
            $row[] = $kec->nm_kec;
            $row[] = $kec->jumlah;
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

    public function exportExcel($tgl_awal, $tgl_akhir)
    {
        $dataDemografi = $this->ModelDemografiRegistrasi->excelPasienSuku($tgl_awal, $tgl_akhir)->result();
        $dataPendidikan = $this->ModelDemografiRegistrasi->excelPasienPendidikan($tgl_awal, $tgl_akhir)->result();
        $dataAgama = $this->ModelDemografiRegistrasi->excelPasienAgama($tgl_awal, $tgl_akhir)->result();
        $dataBahasa = $this->ModelDemografiRegistrasi->excelPasienBahasa($tgl_awal, $tgl_akhir)->result();
        $dataUmur = $this->ModelDemografiRegistrasi->excelPasienUmur($tgl_awal, $tgl_akhir)->result();
        $dataKecamatan = $this->ModelDemografiRegistrasi->excelKecamatan($tgl_awal, $tgl_akhir)->result();
        $dataKecamatan2 = $this->ModelDemografiRegistrasi->excelKecamatan2($tgl_awal, $tgl_akhir)->result();
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Rekap_Demografi_Registrasi.xlsx"');
        header('Cache-Control: max-age=0');
        //suku bangsa
        $spreadsheet = new Spreadsheet();

        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet1->setTitle("Suku Bangsa");
        $sheet1->setCellValue('A1', 'Suku Bangsa');
        $sheet1->setCellValue('B1', 'Jumlah Pasien');
        $row = 2;

        foreach ($dataDemografi as $dd) {
            $sheet1->setCellValue('A' . $row, $dd->nama_suku_bangsa);
            $sheet1->setCellValue('B' . $row, $dd->jml_px);

            $row++;
        }
        //Pendidikan
        $spreadsheet->createSheet();
        $sheet2 = $spreadsheet->setActiveSheetIndex(1);
        $sheet2->setTitle('Pendidikan');
        $sheet2->setCellValue('A1', 'Pendidikan');
        $sheet2->setCellValue('B1', 'Jumlah Pasien');
        $row2 = 2;

        foreach ($dataPendidikan as $dp) {
            $sheet2->setCellValue('A' . $row2, $dp->pnd);
            $sheet2->setCellValue('B' . $row2, $dp->jml_px);

            $row2++;
        }
        //Agama
        $spreadsheet->createSheet();
        $sheet3 = $spreadsheet->setActiveSheetIndex(2);
        $sheet3->setTitle('Agama');
        $sheet3->setCellValue('A1', 'Agama');
        $sheet3->setCellValue('B1', 'Jumlah Pasien');
        $row3 = 2;
        foreach ($dataAgama as $da) {
            $sheet3->setCellValue('A' . $row3, $da->agama);
            $sheet3->setCellValue('B' . $row3, $da->jml_px);
            $row3++;
        }
        //Bahasa
        $spreadsheet->createSheet();
        $sheet4 = $spreadsheet->setActiveSheetIndex(3);
        $sheet4->setTitle('Bahasa');
        $sheet4->setCellValue('A1', 'Bahasa');
        $sheet4->setCellValue('B1', 'Jumlah Pasien');
        $row4 = 2;

        foreach ($dataBahasa as $db) {
            $sheet4->setCellValue('A' . $row4, $db->nama_bahasa);
            $sheet4->setCellValue('B' . $row4, $db->jml_px);

            $row4++;
        }
        //Umur
        $spreadsheet->createSheet();
        $sheet5 = $spreadsheet->setActiveSheetIndex(4);
        $sheet5->setTitle('Umur');
        $sheet5->setCellValue('A1', 'Umur');
        $sheet5->setCellValue('B1', 'Jumlah Pasien');
        $row5 = 2;

        foreach ($dataUmur as $du) {
            $sheet5->setCellValue('A' . $row5, $du->kelompok_umur);
            $sheet5->setCellValue('B' . $row5, $du->jumlah);

            $row5++;
        }
        //Lumajang
        $spreadsheet->createSheet();
        $sheet6 = $spreadsheet->setActiveSheetIndex(5);
        $sheet6->setTitle('Lumajang');
        $sheet6->setCellValue('A1', 'Kabupaten');
        $sheet6->setCellValue('B1', 'Kecamatan');
        $sheet6->setCellValue('C1', 'Jumlah Pasien');
        $row6 = 2;

        foreach ($dataKecamatan as $dk) {
            $sheet6->setCellValue('A' . $row6, $dk->nm_kab);
            $sheet6->setCellValue('B' . $row6, $dk->nm_kec);
            $sheet6->setCellValue('C' . $row6, $dk->jumlah);

            $row6++;
        }
        //lainnya
        $spreadsheet->createSheet();
        $sheet7 = $spreadsheet->setActiveSheetIndex(6);
        $sheet7->setTitle('Lainnya');
        $sheet7->setCellValue('A1', 'Kabupaten');
        $sheet7->setCellValue('B1', 'Kecamatan');
        $sheet7->setCellValue('C1', 'Jumlah Pasien');
        $row7 = 2;

        foreach ($dataKecamatan2 as $dk2) {
            $sheet7->setCellValue('A' . $row7, $dk2->nm_kab);
            $sheet7->setCellValue('B' . $row7, $dk2->nm_kec);
            $sheet7->setCellValue('C' . $row7, $dk2->jumlah);

            $row7++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
