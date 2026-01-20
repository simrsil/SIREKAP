<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PasienRanapBpjs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelBpjsRanap');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }
    public function index() {
        $data['title'] = 'Pasien Ranap BPJS';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_pasien_bpjs_ranap');
        $this->load->view('layout/footer');
    }

    public function dataPasienBpjs()  {
        $tanggal1 = $this->input->post('tanggal1') ?: date('Y-m-d');
        $tanggal2 = $this->input->post('tanggal2') ?: date('Y-m-d');
        $start = $this->input->post('start');
        $length = $this->input->post('length');
        $draw = $this->input->post('draw');
        $search = $this->input->post('search')['value'];
        $dataPasien = $this->ModelBpjsRanap->getPasien($tanggal1, $tanggal2, $start, $length, $search)->result();
        $recordTotal = $this->ModelBpjsRanap->countPasien($tanggal1, $tanggal2, $search)->num_rows();
        $data = [];
        $totalBiaya = [];
        $no = 1;
        foreach ($dataPasien as $dpb) {
            $row = [];

            if (!empty($dpb->peserta)) {
                $kelasBpjs = 'Kelas ' . $dpb->klsrawat . ', ' . $dpb->peserta;
            }else{
                $kelasBpjs = '';
            }

            $row[] = $no++;
            $row[] = $dpb->nm_pasien;
            $row[] = $dpb->no_rkm_medis;
            $row[] = $kelasBpjs;
            $row[] = $dpb->tglsep;
            $row[] = $dpb->png_jawab;

            $dataKamar =  $this->ModelBpjsRanap->getKamar($dpb->no_rawat)->result();
            foreach ($dataKamar as $dk) {
                $row[] = $dk->kamar;
                $row[] = $dk->tgl_masuk_awal;
                $row[] = $dk->tgl_keluar_akhir;
                if (substr($dk->tgl_keluar_akhir,0,10) != '0000-00-00') {
                    $tglKeluar = new DateTime(substr($dk->tgl_keluar_akhir, 0, 10));
                }else{
                    $tglKeluar = new DateTime((date('Y-m-d')));
                }
                $tglMasuk =  new DateTime(substr($dk->tgl_masuk_awal, 0, 10));
                $row[] =$tglKeluar->diff($tglMasuk)->days + 1;
                
            }
            $row[] = $dpb->nm_dokter;
            $biayaLab =  $this->ModelBpjsRanap->getPeriksaLab($dpb->no_rawat)->result();
            $biayaRad =  $this->ModelBpjsRanap->getPeriksaRad($dpb->no_rawat)->result();
            $biayaOperasi =  $this->ModelBpjsRanap->getOperasi($dpb->no_rawat)->result();
            $biayaObat =  $this->ModelBpjsRanap->getObat($dpb->no_rawat)->result();
            $biayaDokter=  $this->ModelBpjsRanap->getDokterRanap($dpb->no_rawat)->result();
            $getPerawatRanap=  $this->ModelBpjsRanap->getPerawatRanap($dpb->no_rawat)->result();
            $biayaDokterRalan=  $this->ModelBpjsRanap->getDokterRalan($dpb->no_rawat)->result();
            $biayaPerawatRalan=  $this->ModelBpjsRanap->getPerawatRalan($dpb->no_rawat)->result();
            $biayaPerawatDokterRalan=  $this->ModelBpjsRanap->getPerawatDokterRalan($dpb->no_rawat)->result();
            $tambahanBiaya=  $this->ModelBpjsRanap->getTambahanBiaya($dpb->no_rawat)->result();
            $potonganBiaya=  $this->ModelBpjsRanap->getPotonganBiaya($dpb->no_rawat)->result();
            $kamarInap=  $this->ModelBpjsRanap->getKamarInap($dpb->no_rawat)->result();
            $returnObat=  $this->ModelBpjsRanap->getReturnObat($dpb->no_rawat)->result();
            $biayaTotal = (int) $biayaLab[0]->biaya_lab + (int) $biayaRad[0]->biaya_rad + (int) $biayaOperasi[0]->total + (int) $biayaObat[0]->total_obat + (int) $biayaDokter[0]->total_dokter + $biayaDokterRalan[0]->total_dokter_ralan+ (int) $biayaPerawatRalan[0]->total_perawat_ralan+ (int) $biayaPerawatDokterRalan[0]->perawat_dokter+(int)  $tambahanBiaya[0]->tambahan_biaya + (int) $potonganBiaya[0]->potongan_biaya+(int) $kamarInap[0]->kamar_inap+(int) $returnObat[0]->return_obat + $getPerawatRanap[0]->total_perawat;
            $row[] = "Rp " . number_format($biayaTotal, 0, ',', '.');
             
            // var_dump($biayaObat);

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

    public function export_excel($tanggal1, $tanggal2){
 
        $dataPasien = $this->ModelBpjsRanap->exportGetPasien($tanggal1, $tanggal2)->result();
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Pasien_Ranap_BPJS_'.$tanggal1.'_'. $tanggal2.'.xlsx"');
        header('Cache-Control: max-age=0');

        $spreadsheet = new Spreadsheet();

        $activeWorksheet = $spreadsheet->getActiveSheet();
        $activeWorksheet->setCellValue('A1', 'No');
        $activeWorksheet->setCellValue('B1', 'Nama Pasien');
        $activeWorksheet->setCellValue('C1', 'No RM');
        $activeWorksheet->setCellValue('D1', 'Kelas SEP');
        $activeWorksheet->setCellValue('E1', 'Tgl SEP');
        $activeWorksheet->setCellValue('F1', 'Jenis Pembayaran');
        $activeWorksheet->setCellValue('G1', 'Ruang');
        $activeWorksheet->setCellValue('H1', 'MRS');
        $activeWorksheet->setCellValue('I1', 'KRS');
        $activeWorksheet->setCellValue('J1', 'LOS');
        $activeWorksheet->setCellValue('K1', 'Dokter');
        $activeWorksheet->setCellValue('L1', 'Diagnosa');
        $activeWorksheet->setCellValue('M1', 'INA BPJS');
        $activeWorksheet->setCellValue('N1', 'Real Cost');
        $activeWorksheet->setCellValue('O1', 'Selisih');
        $activeWorksheet->setCellValue('P1', 'Keterangan');
        $row = 2;
        $no = 1;
        foreach ($dataPasien as $dp) {
            if (!empty($dp->peserta)) {
                $kelasBpjs = 'Kelas ' . $dp->klsrawat . ', ' . $dp->peserta;
            } else {
                $kelasBpjs = '';
            }
            $dataKamar = $this->ModelBpjsRanap->exportGetKamar($dp->no_rawat)->result();

            $activeWorksheet->setCellValue('A' . $row, $no++);
            $activeWorksheet->setCellValue('B' . $row, $dp->nm_pasien);
            $activeWorksheet->setCellValue('C' . $row, $dp->no_rkm_medis);
            $activeWorksheet->setCellValue('D' . $row, $kelasBpjs);
            $activeWorksheet->setCellValue('E' . $row, $dp->tglsep);
            $activeWorksheet->setCellValue('F' . $row, $dp->png_jawab);
            foreach ($dataKamar as $dk) {
                $activeWorksheet->setCellValue('G' . $row, $dk->kamar);
                $activeWorksheet->setCellValue('H' . $row, $dk->tgl_masuk_awal);
                $activeWorksheet->setCellValue('I' . $row, $dk->tgl_keluar_akhir);
                if (substr($dk->tgl_keluar_akhir, 0, 10) != '0000-00-00') {
                    $tglKeluar = new DateTime(substr($dk->tgl_keluar_akhir, 0, 10));
                } else {
                    $tglKeluar = new DateTime((date('Y-m-d')));
                }
                $tglMasuk =  new DateTime(substr($dk->tgl_masuk_awal, 0, 10));
                $los = $tglKeluar->diff($tglMasuk)->days + 1;
                $activeWorksheet->setCellValue('J' . $row, $los);
            }

            $activeWorksheet->setCellValue('K' . $row, $dp->nm_dokter);
            $biayaLab =  $this->ModelBpjsRanap->getPeriksaLab($dp->no_rawat)->result();
            $biayaRad =  $this->ModelBpjsRanap->getPeriksaRad($dp->no_rawat)->result();
            $biayaOperasi =  $this->ModelBpjsRanap->getOperasi($dp->no_rawat)->result();
            $biayaObat =  $this->ModelBpjsRanap->getObat($dp->no_rawat)->result();
            $biayaDokter =  $this->ModelBpjsRanap->getDokterRanap($dp->no_rawat)->result();
            $getPerawatRanap =  $this->ModelBpjsRanap->getPerawatRanap($dp->no_rawat)->result();
            $biayaDokterRalan =  $this->ModelBpjsRanap->getDokterRalan($dp->no_rawat)->result();
            $biayaPerawatRalan =  $this->ModelBpjsRanap->getPerawatRalan($dp->no_rawat)->result();
            $biayaPerawatDokterRalan =  $this->ModelBpjsRanap->getPerawatDokterRalan($dp->no_rawat)->result();
            $tambahanBiaya =  $this->ModelBpjsRanap->getTambahanBiaya($dp->no_rawat)->result();
            $potonganBiaya =  $this->ModelBpjsRanap->getPotonganBiaya($dp->no_rawat)->result();
            $kamarInap =  $this->ModelBpjsRanap->getKamarInap($dp->no_rawat)->result();
            $returnObat =  $this->ModelBpjsRanap->getReturnObat($dp->no_rawat)->result();
            $biayaTotal = (int) $biayaLab[0]->biaya_lab + (int) $biayaRad[0]->biaya_rad + (int) $biayaOperasi[0]->total + (int) $biayaObat[0]->total_obat + (int) $biayaDokter[0]->total_dokter + $biayaDokterRalan[0]->total_dokter_ralan + (int) $biayaPerawatRalan[0]->total_perawat_ralan + (int) $biayaPerawatDokterRalan[0]->perawat_dokter + (int)  $tambahanBiaya[0]->tambahan_biaya + (int) $potonganBiaya[0]->potongan_biaya + (int) $kamarInap[0]->kamar_inap + (int) $returnObat[0]->return_obat + $getPerawatRanap[0]->total_perawat;
            $total = "Rp " . number_format($biayaTotal, 0, ',', '.');
            $activeWorksheet->setCellValue('N' . $row, $total);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }

}