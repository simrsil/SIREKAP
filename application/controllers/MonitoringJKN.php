<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MonitoringJKN extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelMonitoringJKN');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }
    public function index()
    {
        $data['title'] = 'Monitoring JKN';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_monitoring_jkn');
        $this->load->view('layout/footer');
    }

    public function dataDokterPoli()
    {
        $tanggalawal  = $this->input->post('tanggalawal')  ?: date('Y-m-d');
        $tanggalakhir = $this->input->post('tanggalakhir') ?: date('Y-m-d');
        $start        = $this->input->post('start')  ?? 0;
        $length       = $this->input->post('length') ?? 10;
        $draw         = $this->input->post('draw');
        $search       = $this->input->post('search') ? $this->input->post('search')['value'] : ''; // ✅ fix null

        $data_result = $this->ModelMonitoringJKN->tampilDokterPoli($tanggalawal, $tanggalakhir, $start, $length, $search)->result();
        $recordTotal = $this->ModelMonitoringJKN->countDokterPoli($tanggalawal, $tanggalakhir, $search)->num_rows();

        $no   = (int)$start + 1; // ✅ ikut pagination
        $data = [];

        foreach ($data_result as $ds) {

            $kd_dokter = $this->ModelMonitoringJKN->filterDokter($ds->kd_dokter)->row();
            $kd_poli   = $this->ModelMonitoringJKN->filterPoli($ds->kd_poli)->row();

            $nilai_dokter = $kd_dokter ? $kd_dokter->kd_dokter_bpjs : null;
            $nilai_poli   = $kd_poli   ? $kd_poli->kd_poli_bpjs     : null;

            // JKN — dari referensi_mobilejkn_bpjs
            $jkn_row = $this->ModelMonitoringJKN->jmlPasienJKN($nilai_dokter, $nilai_poli, $tanggalawal, $tanggalakhir)->row();

            // Total semua pasien — dari reg_periksa
            $total_row = $this->ModelMonitoringJKN->jmlPasienNonJKN($ds->kd_dokter, $ds->kd_poli, $tanggalawal, $tanggalakhir)->row();

            $jkn     = $jkn_row   ? (int)$jkn_row->totaljkn     : 0;
            $total   = $total_row ? (int)$total_row->totalnonjkn : 0;
            $non_jkn = $total - $jkn; // ✅ Non JKN = Total - JKN

            $data[] = [
                $no++,
                $ds->nm_dokter, // ✅ urutan benar
                $ds->nm_poli,
                $jkn,
                $non_jkn,
                $total,
            ];
        }

        echo json_encode([
            'draw'            => $draw,
            'recordsTotal'    => $recordTotal,
            'recordsFiltered' => $recordTotal,
            'data'            => $data,
        ]);
    }

    public function export_excel($tanggalawal, $tanggalakhir)
    {

        $dataPasien = $this->ModelMonitoringJKN->exportMonitoringJKN($tanggalawal, $tanggalakhir)->result();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Monitoring_JKN_BPJS_' . $tanggalawal . '_' . $tanggalakhir . '.xlsx"');
        header('Cache-Control: max-age=0');

        $spreadsheet = new Spreadsheet();

        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'No');
        $activeWorksheet->setCellValue('B1', 'Nama Dokter');
        $activeWorksheet->setCellValue('C1', 'Poliklinik');
        $activeWorksheet->setCellValue('D1', 'JKN');
        $activeWorksheet->setCellValue('E1', 'On Site');
        $activeWorksheet->setCellValue('F1', 'Total');

        $row = 2;
        $no = 1;
        foreach ($dataPasien as $dp) {

            $kd_dokter = $this->ModelMonitoringJKN->filterDokter($dp->kd_dokter)->row();
            $kd_poli   = $this->ModelMonitoringJKN->filterPoli($dp->kd_poli)->row();

            $nilai_dokter = $kd_dokter ? $kd_dokter->kd_dokter_bpjs : null;
            $nilai_poli   = $kd_poli   ? $kd_poli->kd_poli_bpjs     : null;

            // JKN — dari referensi_mobilejkn_bpjs
            $jkn_row = $this->ModelMonitoringJKN->jmlPasienJKN($nilai_dokter, $nilai_poli, $tanggalawal, $tanggalakhir)->row();

            // Total semua pasien — dari reg_periksa
            $total_row = $this->ModelMonitoringJKN->jmlPasienNonJKN($dp->kd_dokter, $dp->kd_poli, $tanggalawal, $tanggalakhir)->row();

            $jkn     = $jkn_row   ? (int)$jkn_row->totaljkn     : 0;
            $total   = $total_row ? (int)$total_row->totalnonjkn : 0;
            $non_jkn = $total - $jkn; // ✅ Non JKN = Total - JKN

            $activeWorksheet->setCellValue('A' . $row, $no++);
            $activeWorksheet->setCellValue('B' . $row, $dp->nm_dokter);
            $activeWorksheet->setCellValue('C' . $row, $dp->nm_poli);
            $activeWorksheet->setCellValue('D' . $row, $jkn);
            $activeWorksheet->setCellValue('E' . $row, $non_jkn);
            $activeWorksheet->setCellValue('F' . $row, $total);

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
