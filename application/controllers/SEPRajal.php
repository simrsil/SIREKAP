<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SEPRajal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
        $this->load->model('ModelSEPRajal');
        $this->load->model('ModelCetakSEP');
    }
    public function index()
    {
        $data['title'] = 'Pasien Rawat Jalan';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_sep_rajal');
        $this->load->view('layout/footer');
    }

    public function dataSEPRajal()
    {
        $tglSepRajal1 = $this->input->post('tglSepRajal1') ?: date('Y-m-d');
        $tglSepRajal2 = $this->input->post('tglSepRajal2') ?: date('Y-m-d');
        $search = $this->input->post('search')['value'];
        $dataSEP = $this->ModelSEPRajal->getPoliklinik($tglSepRajal1, $tglSepRajal2, $search)->result();
        $dataKunjungan = $this->ModelSEPRajal->jumlahKunjunganRajal($tglSepRajal1, $tglSepRajal2)->num_rows();
        $data = [];
        foreach ($dataSEP as $sep) {
            $row = [];
            $row[] = '<div class="text-center">
                <button class="btn btn-info kd-dokter-btn btn-sm" data-toggle="modal" data-target="#' . $sep->kd_dokter . '" data-dokter="' . $sep->kd_dokter . '">
                    <i class="fas fa-eye"></i>
                </button>
            </div>';
            //tambah jam kerja
            $row[] = $sep->nm_poli;
            $row[] = $sep->nm_dokter;
            $row[] = $sep->jumlah_sep;
            $row[] = $sep->bpjs;
            $row[] = $sep->lainnya;
            $row[] = $sep->batal;
            $row[] = $sep->total;
            $data[] = $row;
        }

        $data_json = [
            'data' => $data,
        ];

        echo json_encode($data_json);
    }

    public function dataPasienSEP()
    {
        $kd_dokter = $this->input->post('kd_dokter');
        $tglSepRajal1 = $this->input->post('tglSepRajal1') ?: date('Y-m-d');
        $tglSepRajal2 = $this->input->post('tglSepRajal2') ?: date('Y-m-d');
        $search = $this->input->post('search')['value'];
        $getPasienSEP = $this->ModelCetakSEP->getPasien($kd_dokter, $tglSepRajal1, $tglSepRajal2, $search)->result();
        $data = [];
        foreach ($getPasienSEP as $getPasienSEP) {
            $row = [];
            $row[] = $getPasienSEP->no_rawat;
            $row[] = $getPasienSEP->no_rkm_medis;
            $row[] = $getPasienSEP->nm_pasien;
            $row[] = $getPasienSEP->nm_dokter;
            $row[] = $getPasienSEP->nm_poli;
            $row[] = $getPasienSEP->png_jawab;
            $getSEP = $this->ModelCetakSEP->getSEP($getPasienSEP->no_rawat)->row();

            if ($getSEP && !empty($getSEP)) {
                $row[] = '<div class="d-flex justify-content-center align-items-center h-100">
                            <span class="badge bg-success"><i class="fas fa-check"></i></span>
                        </div>';
                $getSuratKontrol = $this->ModelCetakSEP->getSuratKontrol($getSEP->no_sep)->row();

                if ($getSuratKontrol && !empty($getSuratKontrol)) {
                    $row[] = '<div class="d-flex justify-content-center align-items-center h-100">
                    <span class="badge badge-success">
                        <i class="fas fa-check"></i>
                      </span>
                      </div>';
                } else {
                    $row[] = '<div class="d-flex justify-content-center align-items-center h-100">
                    <span class="badge badge-danger"><i class="fas fa-times"></i></span>
                    </div>';
                }
            } else {
                $row[] = '<div class="d-flex justify-content-center align-items-center h-100">
                <span class="badge badge-danger"><i class="fas fa-times"></i></span>
                </div>';
                $row[] = '<div class="d-flex justify-content-center align-items-center h-100">
                <span class="badge badge-danger"><i class="fas fa-times"></i></span>
                </div>';
            }

            $data[] = $row;
        }

        $data_json = ['data' => $data];
        echo json_encode($data_json);
    }
}
