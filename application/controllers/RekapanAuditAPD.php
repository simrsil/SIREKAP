<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RekapanAuditAPD extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelAuditKepatuhan');
		if (!$this->session->userdata('isLogin')) {
			redirect('Auth');
		}
	}
	public function index()
	{
		$data['title'] = 'Audit Kepatuhan APD';
		$this->load->view('layout/top-nav', $data);
		$this->load->view('v_audit_kepatuhan_apd');
		$this->load->view('layout/footer');
	}

	public function tampilAudit()
	{
		$tanggal1 = $this->input->post('tanggal1') ?: date('Y-m-d');
		$tanggal2 = $this->input->post('tanggal2') ?: date('Y-m-d');
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$draw = $this->input->post('draw');
		$search = $this->input->post('search')['value'];
		$recordTotal = $this->ModelAuditKepatuhan->countAuditKepatuhan($tanggal1, $tanggal2, $search)->num_rows();
		$dataAuditKepatuhan = $this->ModelAuditKepatuhan->auditKepatuhan($tanggal1, $tanggal2, $start, $length, $search)->result();
		$no = $this->input->post('start') + 1;
		$data = [];
		foreach ($dataAuditKepatuhan as $dataApd) {
			$row = [];
			$row[] = $no++;
			$row[] = $dataApd->tanggal;
			$row[] = $dataApd->tindakan;
			$row[] = $dataApd->nik;
			$row[] = $dataApd->nama;
			$row[] = $dataApd->jabatan;
			$row[] = $dataApd->topi;
			$row[] = $dataApd->masker;
			$row[] = $dataApd->kacamata;
			$row[] = $dataApd->sarungtangan;
			$row[] = $dataApd->apron;
			$row[] = $dataApd->sepatu;
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

	public function export_excel($tanggal1, $tanggal2)
	{
		$AuditApdExcel = $this->ModelAuditKepatuhan->excelAuditApd($tanggal1, $tanggal2)->result();

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="Rekap_Audit_Kepatuhan_APD.xlsx"');
		header('Cache-Control: max-age=0');
		$spreadsheet = new Spreadsheet();

		$activeWorksheet = $spreadsheet->getActiveSheet();
		$activeWorksheet->setCellValue('A1', 'Tanggal');
		$activeWorksheet->setCellValue('B1', 'Tindakan');
		$activeWorksheet->setCellValue('C1', 'NIP/Kode');
		$activeWorksheet->setCellValue('D1', 'Nama');
		$activeWorksheet->setCellValue('E1', 'Jabatan');
		$activeWorksheet->setCellValue('F1', 'Topi');
		$activeWorksheet->setCellValue('G1', 'Masker');
		$activeWorksheet->setCellValue('H1', 'Kacamata');
		$activeWorksheet->setCellValue('I1', 'Sarung Tangan');
		$activeWorksheet->setCellValue('J1', 'Apron');
		$activeWorksheet->setCellValue('K1', 'Sepatu');
		$row = 2;
		foreach ($AuditApdExcel as $value) {

			$activeWorksheet->setCellValue('A' . $row, $value->tanggal);
			$activeWorksheet->setCellValue('B' . $row, $value->tindakan);
			$activeWorksheet->setCellValue('C' . $row, $value->nik);
			$activeWorksheet->setCellValue('D' . $row, $value->nama);
			$activeWorksheet->setCellValue('E' . $row, $value->jabatan);
			$activeWorksheet->setCellValue('F' . $row, $value->topi);
			$activeWorksheet->setCellValue('G' . $row, $value->masker);
			$activeWorksheet->setCellValue('H' . $row, $value->kacamata);
			$activeWorksheet->setCellValue('I' . $row, $value->sarungtangan);
			$activeWorksheet->setCellValue('J' . $row, $value->apron);
			$activeWorksheet->setCellValue('K' . $row, $value->sepatu);

			$row++;
		}

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit();
	}
}
