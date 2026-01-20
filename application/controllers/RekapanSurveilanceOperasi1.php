<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RekapanSurveilanceOperasi1 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelSurveilanceOperasi');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }
    public function index()
    {
        $data['title'] = 'Surveilance Infeksi Luka Operasi';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_rekap_surveilance_operasi');
        $this->load->view('layout/footer');
    }

    public function tampilanRekapOperasi()
    {
        $tanggal3 = $this->input->post('tanggal3');
        $tanggal4 = $this->input->post('tanggal4');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'] ?? '';

        //JIKA KOLOM TANGGAL TIDAK DIISI, DATA YANG DI TAMPILKAN KOSONG
        if (empty($tanggal3) || empty($tanggal4)) {
            echo json_encode([
                'draw' => $draw,
                'recordsTotal' => 0,
                'recordsFiltered' => 0,
                'data' => []
            ]);
            return;
        }

        $dataRekapOperasi = $this->ModelSurveilanceOperasi->DaftarPasien_OP($tanggal3, $tanggal4, $start, $length, $search)->result();
        $recordTotal = $this->ModelSurveilanceOperasi->CountDaftarPasien_OP($tanggal3, $tanggal4, $search);
        // $no = $this->input->post('start') + 1;
        $data = [];

        foreach ($dataRekapOperasi as $dr) {
            $row = [];
            $row[] = '<button type="button" class="btn btn-default detail-btn" id="btn-data" 
                                data-bs-toggle="modal"                               
                                data-no_rawat="' . $dr->no_rawat . '" 
                                data-norm="' . $dr->no_rkm_medis . '" 
                                data-nmpasien="' . $dr->nm_pasien . '" 
                                data-status="' . $dr->status_lanjut . '">
                            ' . $dr->no_rawat . '
                        </button>';
            $row[] = $dr->no_rkm_medis;
            $row[] = $dr->nm_pasien;
            $row[] = $dr->status_lanjut;

            // $TOperasi = $this->ModelSurveilanceOperasi->totalOperasi($dr->no_rawat)->result();
            // $ROperasi = [];
            // foreach ($TOperasi as $b) {
            //     $ROperasi[] = $b->total_op;
            // }
            // $row[] = implode(", ", $ROperasi);

            $row[] = implode(", ", array_column($this->ModelSurveilanceOperasi->totalOperasi($dr->no_rawat)->result(), 'total_op'));
            $row[] = implode(", ", array_column($this->ModelSurveilanceOperasi->totalPreAnastesi($dr->no_rawat)->result(), 'total_preanastesi'));
            $row[] = implode(", ", array_column($this->ModelSurveilanceOperasi->totalPreOp($dr->no_rawat)->result(), 'total_preop'));
            $row[] = implode(", ", array_column($this->ModelSurveilanceOperasi->totalTimeoutSebelumInsisi($dr->no_rawat)->result(), 'total_tsi'));
            $row[] = implode(", ", array_column($this->ModelSurveilanceOperasi->totalSigninSebelumAnestesi($dr->no_rawat)->result(), 'total_ssa'));

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

    public function data1()
    {
        $norawat = $this->input->post('jnorawat');

        $data['operasi']                    = $this->ModelSurveilanceOperasi->GabunganOperasi($norawat);
        $data['validasi_operasi']           = $this->ModelSurveilanceOperasi->operasi_validasi($norawat)->result() ?: [];
        $data['pasien']                     = $this->ModelSurveilanceOperasi->pasien($norawat)->result() ?: [];
        $data['preanastesi']                = $this->ModelSurveilanceOperasi->preanastesi($norawat)->result() ?: [];
        $data['checklist_preoperasi']       = $this->ModelSurveilanceOperasi->preoperasi($norawat)->result() ?: [];
        $data['datatimeout']                = $this->ModelSurveilanceOperasi->timeout_sebelum_insisi($norawat)->result() ?: [];
        $data['signin_sebelum_anestesi']    = $this->ModelSurveilanceOperasi->signin_sebelum_anestesi($norawat)->result() ?: [];

        echo json_encode($data);
    }

    public function export_excel($tanggal1, $tanggal2)
    {
        $LaporanOperasiExcel = $this->ModelSurveilanceOperasi->excelLaporanOperasi($tanggal1, $tanggal2)->result();
        $LaporanPreAnestesExcel = $this->ModelSurveilanceOperasi->excelPreAnastesi($tanggal1, $tanggal2)->result();
        $LaporanChecklistPreOperasi = $this->ModelSurveilanceOperasi->excelChecklistPreOperasi($tanggal1, $tanggal2)->result();
        $LaporanTimeoutSebelumInsisi = $this->ModelSurveilanceOperasi->excelTimeoutSebelumInsisi($tanggal1, $tanggal2)->result();
        $LaporanSigninSebelumAnestesi = $this->ModelSurveilanceOperasi->excelSigninSebelumAnestesi($tanggal1, $tanggal2)->result();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Rekap_Laporan_Operasi.xlsx"');
        header('Cache-Control: max-age=0');
        $spreadsheet = new Spreadsheet();

        //SHEET 1 (LAPORAN OPERASI)
        $sheet1 = $spreadsheet->getActiveSheet();
        $sheet1->setTitle('LaporanOperasi');
        $sheet1->setCellValue('A1', 'Nomer Rawat');
        $sheet1->setCellValue('B1', 'No.Rekam Medis');
        $sheet1->setCellValue('C1', 'Pasien');
        $sheet1->setCellValue('D1', 'Dokter');
        $sheet1->setCellValue('E1', 'Diagnosa Pre Operasi');
        $sheet1->setCellValue('F1', 'Mulai');
        $sheet1->setCellValue('G1', 'Selesai');
        $sheet1->setCellValue('H1', 'Durasi');
        $row = 2;

        foreach ($LaporanOperasiExcel as $value) {

            $sheet1->setCellValue('A' . $row, $value->no_rawat);
            $sheet1->setCellValue('B' . $row, $value->no_rkm_medis);
            $sheet1->setCellValue('C' . $row, $value->nm_pasien);
            $sheet1->setCellValue('D' . $row, $value->nm_dokter);
            $sheet1->setCellValue('E' . $row, $value->diagnosa_preop);
            $sheet1->setCellValue('F' . $row, $value->tanggal);
            $sheet1->setCellValue('G' . $row, $value->selesaioperasi);
            $sheet1->setCellValue('H' . $row, $value->durasi);

            $row++;
        }

        //SHEET 2 (PRE ANASTESI)
        $spreadsheet->createSheet();
        $sheet2 = $spreadsheet->setActiveSheetIndex(1);
        $sheet2->setTitle('PreAnastesi');
        $sheet2->setCellValue('A1', 'Nomer Rawat');
        $sheet2->setCellValue('B1', 'No.Rekam Medis');
        $sheet2->setCellValue('C1', 'Pasien');
        $sheet2->setCellValue('D1', 'Dokter');
        $sheet2->setCellValue('E1', 'Kebiasaan Merokok');
        $sheet2->setCellValue('F1', 'Suhu');
        $sheet2->setCellValue('G1', 'Riwayat Penyakit');
        $sheet2->setCellValue('H1', 'ASA');
        $row2 = 2;

        foreach ($LaporanPreAnestesExcel as $value2) {

            $sheet2->setCellValue('A' . $row2, $value2->no_rawat);
            $sheet2->setCellValue('B' . $row2, $value2->no_rkm_medis);
            $sheet2->setCellValue('C' . $row2, $value2->nm_pasien);
            $sheet2->setCellValue('D' . $row2, $value2->nm_dokter);
            $sheet2->setCellValue('E' . $row2, $value2->riwayat_kebiasaan_merokok);
            $sheet2->setCellValue('F' . $row2, $value2->suhu);
            $sheet2->setCellValue('G' . $row2, $value2->riwayat_penyakit_terapi);
            $sheet2->setCellValue('H' . $row2, $value2->asa);

            $row2++;
        }

        //SHEET 3 (CHECK LIST PRE OPERASI)
        $spreadsheet->createSheet();
        $sheet3 = $spreadsheet->setActiveSheetIndex(2);
        $sheet3->setTitle('ChecklistPreOperasi');
        $sheet3->setCellValue('A1', 'Nomer Rawat');
        $sheet3->setCellValue('B1', 'No.Rekam Medis');
        $sheet3->setCellValue('C1', 'Pasien');
        $sheet3->setCellValue('D1', 'Dokter');
        $sheet3->setCellValue('E1', 'Perlengkapan Khusus');

        $row3 = 2;

        foreach ($LaporanChecklistPreOperasi as $value3) {

            $sheet3->setCellValue('A' . $row3, $value3->no_rawat);
            $sheet3->setCellValue('B' . $row3, $value3->no_rkm_medis);
            $sheet3->setCellValue('C' . $row3, $value3->nm_pasien);
            $sheet3->setCellValue('D' . $row3, $value3->nm_dokter);
            $sheet3->setCellValue('E' . $row3, $value3->perlengkapan_khusus);

            $row3++;
        }

        //SHEET 4 (TIME SEBELUM INSISI)
        $spreadsheet->createSheet();
        $sheet4 = $spreadsheet->setActiveSheetIndex(3);
        $sheet4->setTitle('TimeoutSebelumInsisi');
        $sheet4->setCellValue('A1', 'Nomer Rawat');
        $sheet4->setCellValue('B1', 'No.Rekam Medis');
        $sheet4->setCellValue('C1', 'Pasien');
        $sheet4->setCellValue('D1', 'Dokter');
        $sheet4->setCellValue('E1', 'Antibiotik Profilaks');
        $sheet4->setCellValue('F1', 'Nama Antibiotik');
        $sheet4->setCellValue('G1', 'Jam Pemberian');
        $sheet4->setCellValue('H1', 'Petunjuk Sterilisasi');

        $row4 = 2;

        foreach ($LaporanTimeoutSebelumInsisi as $value4) {

            $sheet4->setCellValue('A' . $row4, $value4->no_rawat);
            $sheet4->setCellValue('B' . $row4, $value4->no_rkm_medis);
            $sheet4->setCellValue('C' . $row4, $value4->nm_pasien);
            $sheet4->setCellValue('D' . $row4, $value4->nm_dokter);
            $sheet4->setCellValue('E' . $row4, $value4->antibiotik_profilaks);
            $sheet4->setCellValue('F' . $row4, $value4->nama_antibiotik);
            $sheet4->setCellValue('G' . $row4, $value4->jam_pemberian);
            $sheet4->setCellValue('H' . $row4, $value4->petujuk_sterilisasi);

            $row4++;
        }

        //SHEET 5 (SIGN SEBELUM ANESTESI)
        $spreadsheet->createSheet();
        $sheet5 = $spreadsheet->setActiveSheetIndex(4);
        $sheet5->setTitle('SigninSebelumAnestesi');
        $sheet5->setCellValue('A1', 'Nomer Rawat');
        $sheet5->setCellValue('B1', 'No.Rekam Medis');
        $sheet5->setCellValue('C1', 'Pasien');
        $sheet5->setCellValue('D1', 'Dokter');
        $sheet5->setCellValue('E1', 'Resiko Kehilangan Darah');

        $row5 = 2;

        foreach ($LaporanSigninSebelumAnestesi as $value5) {

            $sheet5->setCellValue('A' . $row5, $value5->no_rawat);
            $sheet5->setCellValue('B' . $row5, $value5->no_rkm_medis);
            $sheet5->setCellValue('C' . $row5, $value5->nm_pasien);
            $sheet5->setCellValue('D' . $row5, $value5->nm_dokter);
            $sheet5->setCellValue('E' . $row5, $value5->resiko_kehilangan_darah);

            $row5++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
