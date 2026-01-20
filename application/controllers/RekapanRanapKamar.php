<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RekapanRanapKamar extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelRanap');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }
    public function index()
    {
        $data['title'] = 'Kamar Inap/Bangsal';
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_ranap_kamar');
        $this->load->view('layout/footer');
    }

    public function Bangsal()
    {
        $tglAwal = $this->input->post('tglKamarInapMasuk');
        $tglAkhir = $this->input->post('tanggal2');

        // var_dump($tglAwal);
        // var_dump($tglAkhir);

        if (empty($tglAwal) || empty($tglAkhir)) {
            $data = [];
        } else {
            $dataBangsal = $this->ModelRanap->TampilJmlBangsal($tglAwal, $tglAkhir)->result();
            $dataJumlahKunjunganRanap = $this->ModelRanap->kunjunganRanap($tglAwal, $tglAkhir)->result();
            // $dataBangsal = $this->ModelRanap->($tglAwal, $tglAkhir)->result();
            $jumlahTT2 = $this->ModelRanap->jumlahTT()->result();
            $jumlahTT = $jumlahTT2[0]->jml_tt;
            $timestampAwal = strtotime($tglAwal);
            $timestampAkhir = strtotime($tglAkhir);
            $selisih_detik = $timestampAkhir - $timestampAwal;
            $jumlah_hari = $selisih_detik / (60 * 60 * 24);
            $jumlahKunjunganRanap = $dataJumlahKunjunganRanap[0]->jml_kunjungan_ranap;
            $jumlah = $jumlahTT * ($jumlah_hari + 1);
            // var_dump($jumlahTT);
            // die();
            $data = [];
            foreach ($dataBangsal as $row) {
                $data[] = [
                    'nama_group' => $row->nama_group,
                    'kelas' => $row->kelas,
                    'total_perawatan' => $row->total_perawatan,
                    'total' => $row->total,
                    'jumlah' => $jumlah,
                    'jumlah_tt' => $jumlahTT,
                    'jumlah_kunjungan_ranap' => $jumlahKunjunganRanap
                ];
            }
        }
        echo json_encode($data);
    }
}
