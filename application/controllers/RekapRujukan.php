<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapRujukan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelRujukan');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }
    public function index()
    {
        $data['title'] = 'Rujukan Pasien';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_rujukan');
        $this->load->view('layout/footer');
    }

    public function JmlRujukanKeluar()
    {
        $tglAwalRegistrasi = $this->input->post('tglRujukanAwal');
        $tglAkhirRegistrasi = $this->input->post('tglRujukanAkhir');

        if (empty($tglAwalRegistrasi) || empty($tglAkhirRegistrasi)) {
            $data = [];
        } else {
            $dataRujukan = $this->ModelRujukan->RujukanKeluar($tglAwalRegistrasi, $tglAkhirRegistrasi)->result();

            $data = [];
            foreach ($dataRujukan as $JmlPasien) {
                $data[] = [
                    'status_lanjut' => $JmlPasien->status_lanjut,
                    'rujuk' => $JmlPasien->rujuk,
                    'tidak_rujuk' => $JmlPasien->tidak_rujuk,
                ];
            }
        }
        echo json_encode($data);
    }

    public function JmlRujukanMasuk()
    {
        $tglAwalRegistrasi = $this->input->post('tglRujukanAwal');
        $tglAkhirRegistrasi = $this->input->post('tglRujukanAkhir');

        if (empty($tglAwalRegistrasi) || empty($tglAkhirRegistrasi)) {
            $data = [];
        } else {
            $dataRujukan = $this->ModelRujukan->RujukanMasuk($tglAwalRegistrasi, $tglAkhirRegistrasi)->result();

            $data = [];

            foreach ($dataRujukan as $JmlPasien) {
                $data[] = [
                    'status_lanjut' => $JmlPasien->status_lanjut,
                    'kiriman' => $JmlPasien->kiriman,
                    'rujukan_masuk' => $JmlPasien->rujuk_non_kiriman,
                    'tidak' => $JmlPasien->tidak_rujuk,
                ];
            }
        }
        echo json_encode($data);
    }

    public function TampilRujukanKeluar()
    {
        $tanggal1 = $this->input->post('tglRujukanAwal');
        $tanggal2 = $this->input->post('tglRujukanAkhir');
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

        $RujukanKeluar = $this->ModelRujukan->TampilRujukanKeluar($tanggal1, $tanggal2, $start, $length, $search)->result();
        // $RujukanKeluar = $this->ModelRujukan->TampilRujukanKeluar($tanggal1, $tanggal2)->result();
        $recordTotal = $this->ModelRujukan->JmlHalamanRujukanKeluar($tanggal1, $tanggal2, $search)->num_rows();
        //$no = $this->input->post('start') + 1;
        $data = [];

        foreach ($RujukanKeluar as $rjk) {
            $row = [];
            //$row[] = $no++;
            $row[] = $rjk->tgl_registrasi;
            $row[] = $rjk->tgl_rujuk;
            $row[] = $rjk->no_rawat;
            $row[] = $rjk->nm_pasien;
            $row[] = $rjk->status_lanjut;
            $row[] = $rjk->stts_rujuk;
            $row[] = $rjk->keterangan_diagnosa;
            $row[] = $rjk->keterangan;

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

    public function TampilRujukanMasuk()
    {
        $tanggal1 = $this->input->post('tglRujukanAwal');
        $tanggal2 = $this->input->post('tglRujukanAkhir');
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

        $RujukanMasuk = $this->ModelRujukan->TampilRujukanMasuk($tanggal1, $tanggal2, $start, $length, $search)->result();
        // $RujukanKeluar = $this->ModelRujukan->TampilRujukanKeluar($tanggal1, $tanggal2)->result();
        $recordTotal = $this->ModelRujukan->JmlHalamanRujukanMasuk($tanggal1, $tanggal2, $search)->num_rows();
        //$no = $this->input->post('start') + 1;
        $data = [];

        foreach ($RujukanMasuk as $rjk) {
            $row = [];
            //$row[] = $no++;
            $row[] = $rjk->tgl_registrasi;
            $row[] = $rjk->no_rawat;
            $row[] = $rjk->no_rkm_medis;
            $row[] = $rjk->nm_pasien;
            $row[] = $rjk->status_lanjut;
            $row[] = $rjk->stts_rujuk;
            $row[] = $rjk->rujukan;

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
}
