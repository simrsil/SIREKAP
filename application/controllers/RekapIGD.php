<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapIGD extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelIGD');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }
    public function index()
    {
        $data['title'] = 'Indikator Triase IGD/UGD';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_igd');
        $this->load->view('layout/footer');
    }

    public function RekapJumlahIndikatorPrimer()
    {
        $tglTriaseAwalPrimer = $this->input->post('tglTriaseAwal');
        $tglTriaseAkhirPrimer = $this->input->post('tglTriaseAkhir');

        if (empty($tglTriaseAwalPrimer) || empty($tglTriaseAkhirPrimer)) {
            $data = [];
        } else {
            $dataTriasePrimer = $this->ModelIGD->JumlahIndikatorTriasePrimer($tglTriaseAwalPrimer, $tglTriaseAkhirPrimer)->result();

            $data = [];
            foreach ($dataTriasePrimer as $triasePrimer) {
                $data[] = [
                    'plan' => $triasePrimer->plan,
                    'total' => $triasePrimer->total,
                ];
            }
        }
        echo json_encode($data);
    }

    public function RekapJumlahIndikatorSekunder()
    {
        $tglTriaseAwalSekunder = $this->input->post('tglTriaseAwal');
        $tglTriaseAkhirSekunder = $this->input->post('tglTriaseAkhir');

        if (empty($tglTriaseAwalSekunder) || empty($tglTriaseAkhirSekunder)) {
            $data = [];
        } else {
            $dataTriaseSekunder = $this->ModelIGD->JumlahIndikatorTriaseSekunder($tglTriaseAwalSekunder, $tglTriaseAkhirSekunder)->result();

            $data = [];
            foreach ($dataTriaseSekunder as $triasesekunder) {
                $data[] = [
                    'plan' => $triasesekunder->plan,
                    'total' => $triasesekunder->total,
                ];
            }
        }
        echo json_encode($data);
    }
}
