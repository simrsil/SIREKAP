<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class PeriksaLab  extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelPemeriksaanLaborat');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Data Periksa Laboratorium';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_periksa_lab');
        $this->load->view('layout/footer');
    }

    public function dataPeriksaLab()
    {
        $bulan = $this->input->post('bulan4') ?: '';
        $tahun = $this->input->post('tahun4') ?: '';
        $draw = $this->input->post('draw');
        if (empty($bulan) || empty($tahun)) {
            echo json_encode([
                'draw' => $draw,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            ]);
            return;
        }
        $start = $this->input->post('start');
        $length = $this->input->post('length');

        $jns_perawatan_lab = $this->ModelPemeriksaanLaborat->getJnsPerawatan($start, $length)->result();
        $recordTotal = $this->ModelPemeriksaanLaborat->getJnsPerawatanAll()->num_rows();

        $data = [];

        if ($recordTotal > 0) {
            foreach ($jns_perawatan_lab as $jnsPerawatanLab) {
                $periksa_lab = $this->ModelPemeriksaanLaborat->getPeriksaLab($jnsPerawatanLab->kd_jenis_prw, $tahun, $bulan)->result();
                $row = [];
                $lab = $jnsPerawatanLab->kd_jenis_prw;
                $lab2 = $jnsPerawatanLab->nm_perawatan . '<br>';

                foreach ($periksa_lab as $periksaLab) {
                    $lab3 = "<table class='table table-borderless'><tr><td> $periksaLab->jml_periksa</td></tr></table>";
                    $lab5 = "<table class='table table-borderless'><tr><td>" . (!empty($periksaLab->laki) ? $periksaLab->laki : 0) . "</td></tr></table>";
                    $lab6 = "<table class='table table-borderless'><tr><td>" . (!empty($periksaLab->perempuan) ? $periksaLab->perempuan : 0) . "</td></tr></table>";
                    $lab7 = "<table class='table table-borderless'><tr><td>" . (!empty($periksaLab->rata_periksa_laki) && is_numeric($periksaLab->rata_periksa_laki) ? round($periksaLab->rata_periksa_laki, 2) : 0) . "</td></tr></table>";
                    $lab8 = "<table class='table table-borderless'><tr><td>" . (!empty($periksaLab->rata_periksa_laki) && is_numeric($periksaLab->rata_periksa_perempuan) ? round($periksaLab->rata_periksa_perempuan, 2) : 0) . "</td></tr></table>";
                }

                $template_lab = $this->ModelPemeriksaanLaborat->getTemplateLab($jnsPerawatanLab->kd_jenis_prw)->result();
                foreach ($template_lab as $templateLab) {
                    $lab2 .= "<table class='table table-borderless'><tr><td>$templateLab->Pemeriksaan</td></tr></table>";
                    $detail_periksa = $this->ModelPemeriksaanLaborat->getDetailPeriksaLab($templateLab->id_template, $bulan, $tahun)->result();
                    foreach ($detail_periksa as $detailPeriksa) {
                        $lab3 .= "<table class='table table-borderless'><tr><td>$detailPeriksa->jml_detail</td></tr></table>";
                        $lab5 .= "<table class='table table-borderless'><tr><td>" . (!empty($detailPeriksa->laki) ? $detailPeriksa->laki : 0) . "</td></tr></table>";
                        $lab6 .= "<table class='table table-borderless'><tr><td>" . (!empty($detailPeriksa->perempuan) ? $detailPeriksa->perempuan : 0) . "</td></tr></table>";
                        $lab7 .= "<table class='table table-borderless'><tr><td>" . (!empty($detailPeriksa->rata_periksa_laki) && is_numeric($detailPeriksa->rata_periksa_laki) ? round($detailPeriksa->rata_periksa_laki, 2) : 0) . "</td></tr></table>";
                        $lab8 .= "<table class='table table-borderless'><tr><td>" . (!empty($detailPeriksa->rata_periksa_laki) && is_numeric($detailPeriksa->rata_periksa_perempuan) ? round($detailPeriksa->rata_periksa_perempuan, 2) : 0) . "</td></tr></table>";
                    }
                }
                $row[] = $lab;
                $row[] = $lab2;
                $row[] = $lab3;
                $row[] = $lab5;
                $row[] = $lab6;
                $row[] = $lab7;
                $row[] = $lab8;
                $data[] = $row;
            }
        }

        $data_json = [
            'draw' => $draw,
            'recordsTotal' => $recordTotal,
            'recordsFiltered' => $recordTotal,
            'data' => $data
        ];
        echo json_encode($data_json);
    }

    public function export_excel($tahun, $bulan)
    {
        set_time_limit(0);
        ini_set('memory_limit', '-1');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Periksa_laborat_' . $tahun . '_' . $bulan . '.xlsx"');
        header('Cache-Control: max-age=0');

        $spreadsheet = new Spreadsheet();
        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'Kode');
        $activeWorksheet->setCellValue('B1', 'Nama Pemeriksaan');
        $activeWorksheet->setCellValue('C1', 'Jumlah Pemeriksaan');
        $activeWorksheet->setCellValue('D1', 'Laki-Laki');
        $activeWorksheet->setCellValue('E1', 'Perempuan');
        $activeWorksheet->setCellValue('F1', 'Rata-rata Periksa Laki-laki');
        $activeWorksheet->setCellValue('G1', 'Rata-rata Periksa Perempuan');
        $row = 2;
        $jns_perawataan_lab = $this->ModelPemeriksaanLaborat->getJnsPerawatanAll()->result();

        foreach ($jns_perawataan_lab as $jnsPerawatanLab) {
            $activeWorksheet->setCellValue('A' . $row, $jnsPerawatanLab->kd_jenis_prw);
            $activeWorksheet->setCellValue('B' . $row, $jnsPerawatanLab->nm_perawatan);

            $periksa_lab = $this->ModelPemeriksaanLaborat->getPeriksaLab($jnsPerawatanLab->kd_jenis_prw, $tahun, $bulan)->result();
            if (!empty($periksa_lab)) {
                foreach ($periksa_lab as $periksaLab) {
                    $activeWorksheet->setCellValue('C' . $row, $periksaLab->jml_periksa);
                    $activeWorksheet->setCellValue('D' . $row, (!empty($periksaLab->laki) ? $periksaLab->laki : 0));
                    $activeWorksheet->setCellValue('E' . $row, (!empty($periksaLab->perempuan) ? $periksaLab->perempuan : 0));
                    $activeWorksheet->setCellValue('F' . $row, (!empty($periksaLab->rata_periksa_laki) && is_numeric($periksaLab->rata_periksa_laki) ? round($periksaLab->rata_periksa_laki, 2) : 0));
                    $activeWorksheet->setCellValue('G' . $row, (!empty($periksaLab->rata_periksa_perempuan) && is_numeric($periksaLab->rata_periksa_perempuan) ? round($periksaLab->rata_periksa_perempuan, 2) : 0));
                }
            } else {
                $activeWorksheet->setCellValue('C' . $row, 0);
                $activeWorksheet->setCellValue('D' . $row, 0);
                $activeWorksheet->setCellValue('E' . $row, 0);
            }
            $row++;

            $template_lab = $this->ModelPemeriksaanLaborat->getTemplateLab($jnsPerawatanLab->kd_jenis_prw)->result();
            foreach ($template_lab as $templateLab) {
                $activeWorksheet->setCellValue('B' . $row, $templateLab->Pemeriksaan);
                $detail_periksa = $this->ModelPemeriksaanLaborat->getDetailPeriksaLab($templateLab->id_template, $bulan, $tahun)->result();
                if (!empty($detail_periksa)) {
                    foreach ($detail_periksa as $detailPeriksa) {
                        $activeWorksheet->setCellValue('C' . $row, $detailPeriksa->jml_detail);
                        $activeWorksheet->setCellValue('D' . $row, (!empty($detailPeriksa->laki) ? $detailPeriksa->laki : 0));
                        $activeWorksheet->setCellValue('E' . $row, (!empty($detailPeriksa->perempuan) ? $detailPeriksa->perempuan : 0));
                        $activeWorksheet->setCellValue('F' . $row, (!empty($detailPeriksa->rata_periksa_laki) && is_numeric($detailPeriksa->rata_periksa_laki) ? round($detailPeriksa->rata_periksa_laki, 2) : 0));
                        $activeWorksheet->setCellValue('G' . $row, (!empty($detailPeriksa->rata_periksa_perempuan) && is_numeric($detailPeriksa->rata_periksa_perempuan) ? round($detailPeriksa->rata_periksa_perempuan, 2) : 0));
                        $row++;
                    }
                } else {
                    $activeWorksheet->setCellValue('C' . $row, 0);
                    $activeWorksheet->setCellValue('D' . $row, 0);
                    $activeWorksheet->setCellValue('E' . $row, 0);
                    $activeWorksheet->setCellValue('F' . $row, 0);
                    $activeWorksheet->setCellValue('G' . $row, 0);
                    $row++;
                }
            }
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
