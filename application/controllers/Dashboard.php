<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dashboard_Model');
		if (!$this->session->userdata('isLogin')) {
			redirect('Auth');
		}
	}

	public function index()
	{
		$periode = $this->input->post('periode') ?? date('Y-m');

		$data['periode'] = $periode;

		//$data = $this->Dashboard_Model->jkn($periode);

		$data['pasienPoli'] = $this->Dashboard_Model->pasienPoliklinik()->result();
		// $data['jkn_total'] = $this->Dashboard_Model->jkn_total($periode);
		// $data['jkn_checkin'] = $this->Dashboard_Model->jkn_checkin($periode);
		// $data['jkn_belum'] = $this->Dashboard_Model->jkn_belum($periode);
		// $data['jkn_batal'] = $this->Dashboard_Model->jkn_batal($periode);
		//$data['pasien_bpjs'] = $this->Dashboard_Model->pasien_bpjs()->num_rows();
		$data['poli'] = $this->Dashboard_Model->poliklinik()->num_rows();
		$data['igd'] = $this->Dashboard_Model->igd()->num_rows();
		$data['ranap'] = $this->Dashboard_Model->rawatInap()->num_rows();
		$data['statusKamar'] = $this->Dashboard_Model->statusKamar()->result();
		$data['caraBayar'] = $this->Dashboard_Model->pasienPerCaraBayar()->result();
		$data['title'] = 'Dashboard';
		//$this->load->view('layout/header', $data);
		//$this->load->view('layout/sidebar', $data);
		$this->load->view('layout/top-nav', $data);
		$this->load->view('v_dashboard', $data);
		$this->load->view('layout/footer');
	}

	public function JKN()
	{
		$periode = $this->input->post('periode');

		$jkn_total   = $this->Dashboard_Model->jkn_total($periode);
		$jkn_checkin   = $this->Dashboard_Model->jkn_checkin($periode);
		//$jkn_belum   = $this->Dashboard_Model->jkn_belum($periode);
		$pasien_bpjs = $this->Dashboard_Model->pasien_bpjs($periode);

		// aman dari pembagian nol
		$presentase = ($pasien_bpjs > 0)
			? round((($jkn_checkin) / $pasien_bpjs) * 100, 2)
			: 0;

		$data = [
			'jkn_total'   => $this->Dashboard_Model->jkn_total($periode),
			'jkn_checkin' => $this->Dashboard_Model->jkn_checkin($periode),
			'jkn_belum'  => $this->Dashboard_Model->jkn_belum($periode),
			'jkn_batal'  => $this->Dashboard_Model->jkn_batal($periode),
			'pasien_bpjs' => $this->Dashboard_Model->pasien_bpjs($periode),
			'presentase_jkn' => $presentase
		];

		echo json_encode($data);
	}

	public function ChartJKN()
	{
		$periode = $this->input->get('periode') ?? date('Y-m');
		list($tahun, $bulan) = explode('-', $periode);

		// SELALU pakai total hari 1 bulan penuh (lebih stabil)
		$total_hari = date('t', strtotime("$tahun-$bulan-01"));

		// LABEL (1 s/d total hari)
		$labels = range(1, $total_hari);

		// DATA ARRAY (index 0 s/d total_hari-1)
		$pasien    = array_fill(0, $total_hari, 0);
		$kunjungan = array_fill(0, $total_hari, 0);
		$batal     = array_fill(0, $total_hari, 0);

		$rows = $this->Dashboard_Model->GrafikJKNHarian($bulan, $tahun)->result();

		foreach ($rows as $r) {
			$index = ((int) $r->tanggal) - 1;

			// ⛑️ Safety check (ANTI ERROR)
			if ($index >= 0 && $index < $total_hari) {
				$pasien[$index]    = (int) $r->pasien;
				$kunjungan[$index] = (int) $r->kunjungan;
				$batal[$index]     = (int) $r->batal;
			}
		}

		// RESPONSE JSON (PASTI ARRAY)
		echo json_encode([
			'labels'    => $labels,
			'pasien'    => $pasien,
			'kunjungan' => $kunjungan,
			'batal'     => $batal
		]);
	}
}
