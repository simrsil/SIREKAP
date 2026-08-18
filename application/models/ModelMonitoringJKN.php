<?php
defined('BASEPATH') or exit('No direct script access allowed');


class ModelMonitoringJKN extends CI_Model
{

  public function getDokterPoli($tanggalawal, $tanggalakhir, $search = " ")
  {
    $this->db->select('d.nm_dokter,p.nm_poli,rp.kd_dokter,rp.kd_poli');
    $this->db->from('reg_periksa rp');
    $this->db->join('poliklinik p', 'rp.kd_poli = p.kd_poli', 'inner');
    $this->db->join('dokter d', 'rp.kd_dokter = d.kd_dokter', 'inner');
    if (!empty($search)) {
      $this->db->group_start();
      $this->db->like('d.nm_dokter', $search);
      $this->db->or_like('p.nm_poli', $search);
      $this->db->group_end();
    }

    if (!empty($tanggalawal) && !empty($tanggalakhir)) {
      $this->db->where('rp.tgl_registrasi >=', $tanggalawal);
      $this->db->where('rp.tgl_registrasi <=', $tanggalakhir);
    }
    $this->db->where('rp.kd_pj', 'BPJ');
    $this->db->where('rp.status_lanjut', 'Ralan');
    $this->db->where_not_in('rp.kd_poli', ['IGDK', 'U0011', 'U0009', 'U0008', 'U0023', 'U0017']);
    $this->db->group_by('d.kd_dokter, p.kd_poli');
  }

  public function tampilDokterPoli($tanggalawal, $tanggalakhir, $start, $length, $search)
  {
    $this->getDokterPoli($tanggalawal, $tanggalakhir, $search);

    $this->db->limit($length, $start);
    return $this->db->get();
  }

  public function countDokterPoli($tanggalawal, $tanggalakhir, $search)
  {
    $this->getDokterPoli($tanggalawal, $tanggalakhir, $search);

    return $this->db->get();
  }

  public function filterDokter($kdDokter)
  {
    $this->db->select('mdd.kd_dokter_bpjs');
    $this->db->from('maping_dokter_dpjpvclaim mdd');
    if (!empty($kdDokter)) {
      $this->db->where('mdd.kd_dokter', $kdDokter);
    }

    return $this->db->get();
  }

  public function filterPoli($kdPoli)
  {
    $this->db->select('mpb.kd_poli_bpjs');
    $this->db->from('maping_poli_bpjs mpb');
    if (!empty($kdPoli)) {
      $this->db->where('mpb.kd_poli_rs', $kdPoli);
    }

    return $this->db->get();
  }

  public function jmlPasienJKN($kd_dokter, $kd_poli, $tanggalawal, $tanggalakhir)
  {
    $this->db->select('count(rmb.no_rawat) as totaljkn');
    $this->db->from('referensi_mobilejkn_bpjs rmb');
    $this->db->where('rmb.kodepoli', $kd_poli);
    $this->db->where('rmb.kodedokter', $kd_dokter);
    $this->db->where('rmb.status <>', 'Gagal');
    $this->db->where('rmb.status <>', 'Batal');

    if (!empty($tanggalawal) && !empty($tanggalakhir)) {
      $this->db->where('rmb.tanggalperiksa >=', $tanggalawal);
      $this->db->where('rmb.tanggalperiksa <=', $tanggalakhir);
    }

    $this->db->limit(1);
    return $this->db->get();
  }

  public function jmlPasienNonJKN($kd_dokter, $kd_poli, $tanggalawal, $tanggalakhir)
  {
    $this->db->select('count(rp.no_rawat) as totalnonjkn');
    $this->db->from('reg_periksa rp');
    $this->db->where('rp.kd_dokter', $kd_dokter);
    $this->db->where('rp.kd_poli', $kd_poli);

    if (!empty($tanggalawal) && !empty($tanggalakhir)) {
      $this->db->where('rp.tgl_registrasi >=', $tanggalawal);
      $this->db->where('rp.tgl_registrasi <=', $tanggalakhir);

      $this->db->where(
        "rp.no_rawat NOT IN (
                SELECT referensi_mobilejkn_bpjs.no_rawat 
                FROM referensi_mobilejkn_bpjs 
                WHERE referensi_mobilejkn_bpjs.tanggalperiksa BETWEEN '$tanggalawal' AND '$tanggalakhir'
            )",
        NULL,
        FALSE
      );
    }

    $this->db->where('rp.stts <>', 'Batal');
    $this->db->where('rp.status_lanjut', 'Ralan');
    $this->db->where('rp.kd_pj', 'BPJ');

    $this->db->limit(1);

    return $this->db->get();
  }

  public function exportMonitoringJKN($tanggalawal, $tanggalakhir)
  {
    $this->db->select('d.nm_dokter,p.nm_poli,rp.kd_dokter,rp.kd_poli');
    $this->db->from('reg_periksa rp');
    $this->db->join('poliklinik p', 'rp.kd_poli = p.kd_poli', 'inner');
    $this->db->join('dokter d', 'rp.kd_dokter = d.kd_dokter', 'inner');

    if (!empty($tanggalawal) && !empty($tanggalakhir)) {
      $this->db->where('rp.tgl_registrasi >=', $tanggalawal);
      $this->db->where('rp.tgl_registrasi <=', $tanggalakhir);
    }

    $this->db->where('rp.status_lanjut', 'Ralan');
    $this->db->where('rp.kd_pj', 'BPJ');
    $this->db->where_not_in('rp.kd_poli', ['IGDK', 'U0011', 'U0009', 'U0008', 'U0023', 'U0017']);
    $this->db->group_by('d.kd_dokter, p.kd_poli');

    return $this->db->get();
  }

  public function SEPTercetak($kd_dokter, $kd_poli, $tanggalawal, $tanggalakhir)
  {
    $this->db->select('COUNT(bs.no_sep) as totalseptercetak');
    $this->db->from('reg_periksa rp');
    $this->db->join('bridging_sep bs', 'rp.no_rawat = bs.no_rawat', 'left');

    if (!empty($tanggalawal) && !empty($tanggalakhir)) {
      $this->db->where('rp.tgl_registrasi >=', $tanggalawal);
      $this->db->where('rp.tgl_registrasi <=', $tanggalakhir);
    }

    $this->db->where('rp.kd_dokter', $kd_dokter);
    $this->db->where('rp.kd_poli', $kd_poli);
    $this->db->where('rp.stts <>', 'Batal');
    $this->db->where('rp.status_lanjut', 'Ralan');
    $this->db->where('rp.kd_pj', 'BPJ');

    $this->db->limit(1);

    return $this->db->get();
  }
}
