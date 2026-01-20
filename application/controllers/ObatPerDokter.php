<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class ObatPerDokter extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ModelObatRalan');
		$this->load->model('ModelObatDPJP');
		if (!$this->session->userdata('isLogin')) {
			redirect('Auth');
		}
	}

	public function index()
	{
		$data['title'] = 'Obat Per Dokter Ranap';
		$data['dokter'] = $this->ModelObatRalan->getDokterFilter()->result();
		$this->load->view('layout/top-nav', $data);
		$this->load->view('v_obat_perdokter_ranap');
		$this->load->view('layout/footer');
	}

	public function dataObatDokterRanap()
	{
		$tanggal1 = $this->input->post('tanggal1');
		$tanggal2 = $this->input->post('tanggal2');
		$dokter = $this->input->post('status');
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$draw = $this->input->post('draw');

		$dataDokter = $this->ModelObatRalan->getDokter($nmDokter)->result();
		$recordTotal = ($dokter == '2')
			? $this->ModelObatRalan->countDokterById($dokter)->num_rows()
			: count($this->ModelObatDPJP->getDokterDPJP()->result());
		$data = [];
		$nmr = 1;
		if ($dokter == '2') {
			if (!empty($tanggal1) && !empty($tanggal2)) {
				foreach ($dataDokter as $d) {
					$dataPasien = $this->ModelObatRalan->getPasien($d->kd_dokter, $tanggal1, $tanggal2)->result();
					$row = [];
					$row[] = $nmr++;
					$row[] = $d->nm_dokter;
					if (!empty($dataPasien)) {

						$obat = "<table class='table table-bordered'>
						<tr class='text-center'>
							<td>Pasien</td>
							<td>Tanggal</td>
							<td>Nama Obat</td>
							<td>Jml</td>
							<td>Biaya Obat</td>
							<td>Embalase</td>
							<td>Tuslah</td>
						</tr>";
						$total = 0;
						$total2 = 0;
						$total3 = 0;
						foreach ($dataPasien as  $px) {
							$getTglPerawatan = $this->ModelObatRalan->getTglDetailObat($px->no_rawat)->result();

							$obat .= "<tr>";
							$obat .= "
					<td> $px->no_rawat   $px->nm_pasien </td>
					<td></td><td></td><td></td><td></td><td></td><td></td>";
							foreach ($getTglPerawatan as $tgl) {
								$obat .= "<tr><td></td><td> $tgl->tgl_perawatan </td><td></td><td></td><td></td><td></td><td></td></tr>";
								$getDetailObat = $this->ModelObatDPJP->getDetailObat($px->no_rawat, $tgl->tgl_perawatan)->result();
								foreach ($getDetailObat as $ob) {
									$obat .= "<tr>";
									$obat .= "
								<td></td>
								<td></td>
								<td>$ob->kode_brng $ob->nama_brng</td>
								<td>$ob->jml</td>
								<td>" . number_format($ob->total, 0, ',', '.') . "</td>
								<td>" . number_format($ob->embalase, 0, ',', '.') . "</td>
								<td>" . number_format($ob->tuslah, 0, ',', '.') . "</td>";
									$obat .= "</tr>";
									$total += $ob->total;
									$total2 += $ob->embalase;
									$total3 += $ob->tuslah;
								}
							}
							$obat .= "<tr>
							<td colspan='3' class='text-center'><b>Total</b></td>
							<td></td>
							<td>" . number_format($total, 0, ',', '.') . "</td>
							<td>" . number_format($total2, 0, ',', '.') . "</td>
							<td>" . number_format($total3, 0, ',', '.') . "</td>
							</tr>";
							$obat .= "</tr>";
						}
						$obat .= "</table>";
						$row[] = $obat;
					} else {
						$row[] = '';
					}

					$data[] = $row;
				}
			}
		} elseif ($dokter == '1') {
			if (!empty($tanggal1) && !empty($tanggal2)) {
				foreach ($dataDokter as $d) {
					$dataPasien = $this->ModelObatDPJP->getPasien($d->kd_dokter, $tanggal1, $tanggal2)->result();
					$row = [];
					$row[] = $nmr++;
					$row[] = $d->nm_dokter;
					if (!empty($dataPasien)) {
						$obat = "<table class='table table-bordered'>
						<tr class='text-center'>
							<td>Pasien</td>
							<td>Tanggal</td>
							<td>Nama Obat</td>
							<td>Jml</td>
							<td>Biaya Obat</td>
							<td>Embalase</td>
							<td>Tuslah</td>
						</tr>";
						$total = 0;
						$total2 = 0;
						$total3 = 0;
						foreach ($dataPasien as  $px) {
							$getTglPerawatan = $this->ModelObatDPJP->getTglDetailObat($px->no_rawat)->result();

							$obat .= "<tr>";
							$obat .= "
					<td> $px->no_rawat   $px->nm_pasien </td>
					<td></td><td></td><td></td><td></td><td></td><td></td>";
							foreach ($getTglPerawatan as $tgl) {
								$obat .= "<tr><td></td><td> $tgl->tgl_perawatan </td><td></td><td></td><td></td><td></td><td></td></tr>";
								$getDetailObat = $this->ModelObatDPJP->getDetailObat($px->no_rawat, $tgl->tgl_perawatan)->result();
								foreach ($getDetailObat as $ob) {
									$obat .= "<tr>";
									$obat .= "
								<td></td>
								<td></td>
								<td>$ob->kode_brng $ob->nama_brng</td>
								<td>$ob->jml</td>
								<td>" . number_format($ob->total, 0, ',', '.') . "</td>
								<td>" . number_format($ob->embalase, 0, ',', '.') . "</td>
								<td>" . number_format($ob->tuslah, 0, ',', '.') . "</td>";
									$obat .= "</tr>";
									$total += $ob->total;
									$total2 += $ob->embalase;
									$total3 += $ob->tuslah;
								}
							}
							$obat .= "<tr>
							<td colspan='3' class='text-center'><b>Total</b></td>
							<td></td>
							<td>" . number_format($total, 0, ',', '.') . "</td>
							<td>" . number_format($total2, 0, ',', '.') . "</td>
							<td>" . number_format($total3, 0, ',', '.') . "</td>
							</tr>";
							$obat .= "</tr>";
						}
						$obat .= "</table>";
						$row[] = $obat;
					} else {
						$row[] = '';
					}
					$data[] = $row;
				}
			}
		}

		$datajson = [
			'draw' => $draw,
			'recordsTotal' => $recordTotal,
			'recordsFiltered' => $recordTotal,
			'data' => $data
		];
		echo json_encode($datajson);
	}

	public function export_excel($tanggal1, $tanggal2, $status, $nmDokter)
	{
		$dataDokter = $this->ModelObatRalan->getDokter($nmDokter)->result();
		$nm_dokter = $dataDokter[0]->nm_dokter;
		set_time_limit(0);
		ini_set('memory_limit', '-1');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="rekap_obat_dokter_jaga_' . $nm_dokter . '.xlsx"');
		header('Cache-Control: max-age=0');
		$spreadsheet = new Spreadsheet();
		$activeWorksheet = $spreadsheet->getActiveSheet();
		$activeWorksheet->setCellValue('A1', 'No');
		$activeWorksheet->setCellValue('B1', 'Dokter');
		$activeWorksheet->setCellValue('C1', 'Nama Pasien');
		$activeWorksheet->setCellValue('D1', 'Tanggal');
		$activeWorksheet->setCellValue('E1', 'Nama Obat');
		$activeWorksheet->setCellValue('F1', 'Jml');
		$activeWorksheet->setCellValue('G1', 'Biaya Obat');
		$activeWorksheet->setCellValue('H1', 'Embalase');
		$activeWorksheet->setCellValue('I1', 'Tuslah');
		// $writer = new Xlsx($spreadsheet);
		$row = 2;
		$no = 1;

		$total = 0;
		$total2 = 0;
		$total3 = 0;
		foreach ($dataDokter as $d) {

			$activeWorksheet->setCellValue('A' . $row, $no++);
			$activeWorksheet->setCellValue('B' . $row, $d->nm_dokter);
			$dataPasien = $this->ModelObatRalan->getPasien($d->kd_dokter, $tanggal1, $tanggal2)->result();
			$row++;

			foreach ($dataPasien as $px) {
				$getTglPerawatan = $this->ModelObatRalan->getTglDetailObat($px->no_rawat)->result();
				$activeWorksheet->setCellValue('C' . $row, $px->no_rawat . ' ' . $px->nm_pasien);
				$row++;

				foreach ($getTglPerawatan as $tgl) {
					$activeWorksheet->setCellValue('D' . $row, $tgl->tgl_perawatan);
					$getDetailObat = $this->ModelObatRalan->getDetailObat($px->no_rawat, $tgl->tgl_perawatan)->result();

					foreach ($getDetailObat as $ob) {
						$activeWorksheet->setCellValue('E' . $row, $ob->kode_brng . ' ' . $ob->nama_brng);
						$activeWorksheet->setCellValue('F' . $row, number_format($ob->jml, 2, ',', '.'));
						$activeWorksheet->setCellValue('G' . $row, number_format($ob->total, 2, ',', '.'));
						$activeWorksheet->setCellValue('H' . $row, number_format($ob->embalase, 2, ',', '.'));
						$activeWorksheet->setCellValue('I' . $row, number_format($ob->tuslah, 2, ',', '.'));

						// Add the values to the totals
						$total += $ob->total;
						$total2 += $ob->embalase;
						$total3 += $ob->tuslah;
						$row++;
					}
				}
			}
		}

		$activeWorksheet->setCellValue('E' . $row, 'TOTAL');
		$activeWorksheet->setCellValue('G' . $row, number_format($total, 2, ',', '.'));
		$activeWorksheet->setCellValue('H' . $row, number_format($total2, 2, ',', '.'));
		$activeWorksheet->setCellValue('I' . $row, number_format($total3, 2, ',', '.'));

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit();
	}

	public function dataObatDokterDPJP()
	{
		$tanggal1 = $this->input->post('tanggal1');
		$tanggal2 = $this->input->post('tanggal2');
		$dokter = $this->input->post('dokter');
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$draw = $this->input->post('draw');
		$dataDokter = $this->ModelObatDPJP->getDokterDPJP()->result();
		$data = [];
		$nmr = 1;
		if ($dokter == '1') {
			if (!empty($tanggal1) && !empty($tanggal2) && !empty($dokter)) {
				foreach ($dataDokter as $d) {
					$dataPasien = $this->ModelObatDPJP->getPasien($d->kd_dokter, $tanggal1, $tanggal2)->result();
					$row = [];
					$row[] = $nmr++;
					$row[] = $d->nm_dokter;
					if (!empty($dataPasien)) {

						$obat = "<table class='table table-bordered'>
						<tr class='text-center'>
							<td>Pasien</td>
							<td>Tanggal</td>
							<td>Nama Obat</td>
							<td>Jml</td>
							<td>Biaya Obat</td>
							<td>Embalase</td>
							<td>Tuslah</td>
						</tr>";
						$total = 0;
						$total2 = 0;
						$total3 = 0;
						foreach ($dataPasien as  $px) {
							$getTglPerawatan = $this->ModelObatDPJP->getTglDetailObat($px->no_rawat)->result();

							$obat .= "<tr>";
							$obat .= "
					<td> $px->no_rawat   $px->nm_pasien </td>
					<td></td><td></td><td></td><td></td><td></td><td></td>";
							foreach ($getTglPerawatan as $tgl) {
								$obat .= "<tr><td></td><td> $tgl->tgl_perawatan </td><td></td><td></td><td></td><td></td><td></td></tr>";
								$getDetailObat = $this->ModelObatDPJP->getDetailObat($px->no_rawat, $tgl->tgl_perawatan)->result();
								foreach ($getDetailObat as $ob) {
									$obat .= "<tr>";
									$obat .= "
								<td></td>
								<td></td>
								<td>$ob->kode_brng $ob->nama_brng</td>
								<td>$ob->jml</td>
								<td>" . number_format($ob->total, 0, ',', '.') . "</td>
								<td>" . number_format($ob->embalase, 0, ',', '.') . "</td>
								<td>" . number_format($ob->tuslah, 0, ',', '.') . "</td>";
									$obat .= "</tr>";
									$total += $ob->total;
									$total2 += $ob->embalase;
									$total3 += $ob->tuslah;
								}
							}
							$obat .= "<tr>
							<td colspan='3' class='text-center'><b>Total</b></td>
							<td></td>
							<td>" . number_format($total, 0, ',', '.') . "</td>
							<td>" . number_format($total2, 0, ',', '.') . "</td>
							<td>" . number_format($total3, 0, ',', '.') . "</td>
							</tr>";
							$obat .= "</tr>";
						}
						$obat .= "</table>";
						$row[] = $obat;
					} else {
						$row[] = '';
					}

					$data[] = $row;
				}
			}
		} elseif ($dokter == '1') {
		}

		$datajson = [
			// 'draw' => $draw,
			// 'recordsTotal' => $recordTotal,
			// 'recordsFiltered' => $recordTotal,
			'data' => $data
		];
		echo json_encode($datajson);
	}
	public function export_excel_dpjp($tanggal1, $tanggal2, $status, $nmDokter)
	{
		$dataDokter = $this->ModelObatDPJP->getDokterDPJP($nmDokter)->result();
		$nm_dokter = $dataDokter[0]->nm_dokter;
		set_time_limit(0);
		ini_set('memory_limit', '-1');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="rekap_obat_dokter_DPJP_' . $nm_dokter . '.xlsx"');
		header('Cache-Control: max-age=0');
		$spreadsheet = new Spreadsheet();
		$activeWorksheet = $spreadsheet->getActiveSheet();
		$activeWorksheet->setCellValue('A1', 'No');
		$activeWorksheet->setCellValue('B1', 'Dokter');
		$activeWorksheet->setCellValue('C1', 'Nama Pasien');
		$activeWorksheet->setCellValue('D1', 'Tanggal');
		$activeWorksheet->setCellValue('E1', 'Nama Obat');
		$activeWorksheet->setCellValue('F1', 'Jml');
		$activeWorksheet->setCellValue('G1', 'Biaya Obat');
		$activeWorksheet->setCellValue('H1', 'Embalase');
		$activeWorksheet->setCellValue('I1', 'Tuslah');
		$writer = new Xlsx($spreadsheet);
		$row = 2;
		$no = 1;
		$total = 0;
		$total2 = 0;
		$total3 = 0;
		$dataDokter = $this->ModelObatDPJP->getDokterDPJP($nmDokter)->result();
		foreach ($dataDokter as $d) {

			$activeWorksheet->setCellValue('A' . $row, $no++);
			$activeWorksheet->setCellValue('B' . $row, $d->nm_dokter);
			$dataPasien = $this->ModelObatDPJP->getPasien($nmDokter, $tanggal1, $tanggal2)->result();
			$row++;

			foreach ($dataPasien as $px) {
				$getTglPerawatan = $this->ModelObatDPJP->getTglDetailObat($px->no_rawat)->result();
				$activeWorksheet->setCellValue('C' . $row, $px->no_rawat . ' ' . $px->nm_pasien);
				$row++;

				foreach ($getTglPerawatan as $tgl) {
					$activeWorksheet->setCellValue('D' . $row, $tgl->tgl_perawatan);
					$getDetailObat = $this->ModelObatDPJP->getDetailObat($px->no_rawat, $tgl->tgl_perawatan)->result();

					foreach ($getDetailObat as $ob) {
						$activeWorksheet->setCellValue('E' . $row, $ob->kode_brng . ' ' . $ob->nama_brng);
						$activeWorksheet->setCellValue('F' . $row, number_format($ob->jml, 2, ',', '.'));
						$activeWorksheet->setCellValue('G' . $row, number_format($ob->total, 2, ',', '.'));
						$activeWorksheet->setCellValue('H' . $row, number_format($ob->embalase, 2, ',', '.'));
						$activeWorksheet->setCellValue('I' . $row, number_format($ob->tuslah, 2, ',', '.'));

						// Add the values to the totals
						$total += $ob->total;
						$total2 += $ob->embalase;
						$total3 += $ob->tuslah;
						$row++;
					}
				}
			}
		}

		$activeWorksheet->setCellValue('E' . $row, 'TOTAL');
		$activeWorksheet->setCellValue('G' . $row, number_format($total, 2, ',', '.'));
		$activeWorksheet->setCellValue('H' . $row, number_format($total2, 2, ',', '.'));
		$activeWorksheet->setCellValue('I' . $row, number_format($total3, 2, ',', '.'));

		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit();
	}
}
