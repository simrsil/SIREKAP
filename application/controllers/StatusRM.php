<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class StatusRM extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelStatusRMRalan');
        $this->load->model('ModelStatusRMRanap');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Status Rekam Medis';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_status_rm');
        $this->load->view('layout/footer');
    }

    public function statusRMRalan()
    {
        $tgl_awal = $this->input->post('tgl_awal') ?: date('Y-m-d');
        $tgl_akhir = $this->input->post('tgl_akhir') ?: date('Y-m-d');
        $status_ralan = $this->input->post('status_ralan') ?: "";
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'];
        $status_ralan = $this->input->post('status_ralan');
        $dataPasien = $this->ModelStatusRMRalan->getPasienRalan($tgl_awal, $tgl_akhir, $status_ralan, $start, $length, $search)->result();
        $recordTotal = $this->ModelStatusRMRalan->countPasienRalan($tgl_awal, $tgl_akhir, $status_ralan, $search)->num_rows();
        $data = [];
        foreach ($dataPasien as $px) {
            $soapie = $this->ModelStatusRMRalan->getSoapieRalan($px->no_rawat)->result();
            $resume = $this->ModelStatusRMRalan->resumeRalan($px->no_rawat)->result();
            $dataIcd9 = $this->ModelStatusRMRalan->getICD9($px->no_rawat)->result();
            $dataIcd10 = $this->ModelStatusRMRalan->getIcd10($px->no_rawat)->result();
            $caraDaftar = $this->ModelStatusRMRalan->getCaraDaftar($px->no_rawat)->result();
            $row = [];
            $row[] = $px->no_rawat;
            $row[] = $px->tgl_registrasi;
            $row[] = $px->nm_dokter;
            $row[] = $px->no_rkm_medis;
            $row[] = $px->nm_pasien;
            $row[] = $px->nm_poli;
            $row[] = $soapie[0]->soap;
            $row[] = $resume[0]->resume;
            $row[] = $dataIcd9[0]->icd9;
            $row[] = $dataIcd10[0]->icd10;
            $row[] = $px->png_jawab;
            $row[] = $caraDaftar[0]->cara_daftar;
            $row[] = $px->stts;

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

    public function exportExcelRalan()
    {
        $tgl_awal = $this->input->get('tgl_awal');
        $tgl_akhir = $this->input->get('tgl_akhir');
        $status_ralan = $this->input->get('status_ralan');
        $dataPasien = $this->ModelStatusRMRalan->exportExcel($tgl_awal, $tgl_akhir, $status_ralan)->result();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="status_RM_ralan.xlsx"');
        header('Cache-Control: max-age=0');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header kolom
        $sheet->fromArray([
            'No Rawat',
            'Tanggal',
            'Dokter Dituju',
            'Nomer RM',
            'Pasien',
            'Poliklinik',
            'SOAPIE',
            'Resume',
            'ICD9',
            'ICD10',
            'Cara Bayar',
            'Cara Daftar',
            'Status'
        ], null, 'A1');

        $row = 2;

        foreach ($dataPasien as $px) {
            $sheet->setCellValue('A' . $row, $px->no_rawat);
            $sheet->setCellValue('B' . $row, $px->tgl_registrasi);
            $sheet->setCellValue('C' . $row, $px->nm_dokter);
            $sheet->setCellValue('D' . $row, $px->no_rkm_medis);
            $sheet->setCellValue('E' . $row, $px->nm_pasien);
            $sheet->setCellValue('F' . $row, $px->nm_poli);

            // SOAPIE
            $soapie = $this->ModelStatusRMRalan->getSoapieRalan($px->no_rawat)->row();
            $soapStatus = ($soapie && $soapie->soap == 'Ada') ? 'Ada' : 'Tidak Ada';
            $sheet->setCellValue('G' . $row, $soapStatus);

            // Resume
            $resume = $this->ModelStatusRMRalan->resumeRalan($px->no_rawat)->row();
            $resumeStatus = ($resume && $resume->resume == 'Ada') ? 'Ada' : 'Tidak Ada';
            $sheet->setCellValue('H' . $row, $resumeStatus);

            // ICD9
            $icd9 = $this->ModelStatusRMRalan->getICD9($px->no_rawat)->row();
            $icd9Status = ($icd9 && $icd9->icd9 == 'Ada') ? 'Ada' : 'Tidak Ada';
            $sheet->setCellValue('I' . $row, $icd9Status);

            // ICD10
            $icd10 = $this->ModelStatusRMRalan->getIcd10($px->no_rawat)->row();
            $icd10Status = ($icd10 && $icd10->icd10 == 'Ada') ? 'Ada' : 'Tidak Ada';
            $sheet->setCellValue('J' . $row, $icd10Status);
            //cara bayar
            $sheet->setCellValue('K' . $row, $px->png_jawab);
            // Cara Daftar
            $caraDaftar = $this->ModelStatusRMRalan->getCaraDaftar($px->no_rawat)->row();
            $caraDaftar2 = ($caraDaftar && $caraDaftar->cara_daftar == 'JKN') ? 'JKN' : 'Onsite';
            $sheet->setCellValue('L' . $row, $caraDaftar2);
            // Status daftar
            $sheet->setCellValue('M' . $row, $px->stts);

            $row++;
        }

        $totalRow = $row;

        // Status Data Ada
        $sheet->setCellValue('E' . $totalRow, 'Status Data Ada');
        $sheet->setCellValue('G' . $totalRow, '=COUNTIF(G2:G' . ($row - 1) . ',"Ada")');
        $sheet->setCellValue('H' . $totalRow, '=COUNTIF(H2:H' . ($row - 1) . ',"Ada")');
        $sheet->setCellValue('I' . $totalRow, '=COUNTIF(I2:I' . ($row - 1) . ',"Ada")');
        $sheet->setCellValue('J' . $totalRow, '=COUNTIF(J2:J' . ($row - 1) . ',"Ada")');

        $totalRow++;

        // Status Data Tidak Ada
        $sheet->setCellValue('E' . $totalRow, 'Status Data Tidak Ada');
        $sheet->setCellValue('G' . $totalRow, '=COUNTIF(G2:G' . ($row - 1) . ',"Tidak Ada")');
        $sheet->setCellValue('H' . $totalRow, '=COUNTIF(H2:H' . ($row - 1) . ',"Tidak Ada")');
        $sheet->setCellValue('I' . $totalRow, '=COUNTIF(I2:I' . ($row - 1) . ',"Tidak Ada")');
        $sheet->setCellValue('J' . $totalRow, '=COUNTIF(J2:J' . ($row - 1) . ',"Tidak Ada")');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }


    public function statusRMRanap()
    {
        $tgl_awal = $this->input->post('tgl_awal2') ?: date('Y-m-d');
        $tgl_akhir = $this->input->post('tgl_akhir2') ?: date('Y-m-d');
        $status_ranap = $this->input->post('status_ranap');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'];
        $dataPasienRanap = $this->ModelStatusRMRanap->getPasienRanap($tgl_awal, $tgl_akhir, $status_ranap, $start, $length, $search)->result();
        $recordTotal = $this->ModelStatusRMRanap->countPasienRanap($tgl_awal, $tgl_akhir, $status_ranap, $search)->num_rows();
        $data = [];
        foreach ($dataPasienRanap as $px) {
            $dataSoapie = $this->ModelStatusRMRanap->getSoapie($px->no_rawat)->result();
            $dataResume = $this->ModelStatusRMRanap->getResume($px->no_rawat)->result();
            $dataTriaseIGD = $this->ModelStatusRMRanap->getTriaseIGD($px->no_rawat)->result();
            $dataAskepIGD = $this->ModelStatusRMRanap->getAskepIGD($px->no_rawat)->result();
            $dataICD9 = $this->ModelStatusRMRanap->getICD9($px->no_rawat)->result();
            $dataICD10 = $this->ModelStatusRMRanap->getICD10($px->no_rawat)->result();
            $row = [];
            $row[] = $px->no_rawat;
            $row[] = $px->tgl_registrasi;
            $row[] = $px->dpjp;
            $row[] = $px->dr_jaga;
            $row[] = $px->no_rkm_medis;
            $row[] = $px->nm_pasien;
            $row[] = $dataSoapie[0]->soap;
            $row[] = $dataResume[0]->resume;
            $row[] = $dataTriaseIGD[0]->triase;
            $row[] = $dataAskepIGD[0]->askep;
            $row[] = $dataICD9[0]->icd9;
            $row[] = $dataICD10[0]->icd10;

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
    public function exportExcelRanap()
    {
        $tgl_awal = $this->input->get('tgl_awal2');
        $tgl_akhir = $this->input->get('tgl_akhir2');
        $status_ranap = $this->input->get('status_ranap');
        $dataPasienRanap = $this->ModelStatusRMRanap->exportExcelRanap($tgl_awal, $tgl_akhir, $status_ranap)->result();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="status_RM_ranap.xlsx"');
        header('Cache-Control: max-age=0');

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();

        // Header
        $activeWorksheet->fromArray([
            'No Rawat',
            'Tanggal',
            'Dokter DPJP',
            'Dokter Jaga',
            'Nomer RM',
            'Pasien',
            'SOAPIE',
            'Resume',
            'Triase IGD',
            'Askep IGD',
            'ICD9',
            'ICD10'
        ], null, 'A1');

        $row = 2;

        foreach ($dataPasienRanap as $px) {
            $activeWorksheet->setCellValue('A' . $row, $px->no_rawat);
            $activeWorksheet->setCellValue('B' . $row, $px->tgl_registrasi);
            $activeWorksheet->setCellValue('C' . $row, $px->dpjp);
            $activeWorksheet->setCellValue('D' . $row, $px->dr_jaga);
            $activeWorksheet->setCellValue('E' . $row, $px->no_rkm_medis);
            $activeWorksheet->setCellValue('F' . $row, $px->nm_pasien);

            // SOAPIE
            $soapie = $this->ModelStatusRMRanap->getSoapie($px->no_rawat)->row();
            $soapieStatus = ($soapie && $soapie->soap == 'Ada') ? 'Ada' : 'Tidak Ada';
            $activeWorksheet->setCellValue('G' . $row, $soapieStatus);

            // Resume
            $resume = $this->ModelStatusRMRanap->getResume($px->no_rawat)->row();
            $resumeStatus = ($resume && $resume->resume == 'Ada') ? 'Ada' : 'Tidak Ada';
            $activeWorksheet->setCellValue('H' . $row, $resumeStatus);

            // Triase IGD
            $triase = $this->ModelStatusRMRanap->getTriaseIGD($px->no_rawat)->row();
            $triaseStatus = ($triase && $triase->triase == 'Ada') ? 'Ada' : 'Tidak Ada';
            $activeWorksheet->setCellValue('I' . $row, $triaseStatus);

            // Askep IGD
            $askep = $this->ModelStatusRMRanap->getAskepIGD($px->no_rawat)->row();
            $askepStatus = ($askep && $askep->askep == 'Ada') ? 'Ada' : 'Tidak Ada';
            $activeWorksheet->setCellValue('J' . $row, $askepStatus);

            // ICD9
            $icd9 = $this->ModelStatusRMRanap->getICD9($px->no_rawat)->row();
            $icd9Status = ($icd9 && $icd9->icd9 == 'Ada') ? 'Ada' : 'Tidak Ada';
            $activeWorksheet->setCellValue('K' . $row, $icd9Status);

            // ICD10
            $icd10 = $this->ModelStatusRMRanap->getICD10($px->no_rawat)->row();
            $icd10Status = ($icd10 && $icd10->icd10 == 'Ada') ? 'Ada' : 'Tidak Ada';
            $activeWorksheet->setCellValue('L' . $row, $icd10Status);

            $row++;
        }

        $totalRow = $row;

        // Baris: Status Data Ada
        $activeWorksheet->setCellValue('F' . $totalRow, 'Status Data Ada');
        $activeWorksheet->setCellValue('G' . $totalRow, '=COUNTIF(G2:G' . ($row - 1) . ',"Ada")');
        $activeWorksheet->setCellValue('H' . $totalRow, '=COUNTIF(H2:H' . ($row - 1) . ',"Ada")');
        $activeWorksheet->setCellValue('I' . $totalRow, '=COUNTIF(I2:I' . ($row - 1) . ',"Ada")');
        $activeWorksheet->setCellValue('J' . $totalRow, '=COUNTIF(J2:J' . ($row - 1) . ',"Ada")');
        $activeWorksheet->setCellValue('K' . $totalRow, '=COUNTIF(K2:K' . ($row - 1) . ',"Ada")');
        $activeWorksheet->setCellValue('L' . $totalRow, '=COUNTIF(L2:L' . ($row - 1) . ',"Ada")');

        $totalRow++;

        // Baris: Status Data Tidak Ada
        $activeWorksheet->setCellValue('F' . $totalRow, 'Status Data Tidak Ada');
        $activeWorksheet->setCellValue('G' . $totalRow, '=COUNTIF(G2:G' . ($row - 1) . ',"Tidak Ada")');
        $activeWorksheet->setCellValue('H' . $totalRow, '=COUNTIF(H2:H' . ($row - 1) . ',"Tidak Ada")');
        $activeWorksheet->setCellValue('I' . $totalRow, '=COUNTIF(I2:I' . ($row - 1) . ',"Tidak Ada")');
        $activeWorksheet->setCellValue('J' . $totalRow, '=COUNTIF(J2:J' . ($row - 1) . ',"Tidak Ada")');
        $activeWorksheet->setCellValue('K' . $totalRow, '=COUNTIF(K2:K' . ($row - 1) . ',"Tidak Ada")');
        $activeWorksheet->setCellValue('L' . $totalRow, '=COUNTIF(L2:L' . ($row - 1) . ',"Tidak Ada")');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
