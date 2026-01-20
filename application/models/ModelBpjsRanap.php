<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class ModelBpjsRanap extends CI_Model {

  public function getPasien($tanggal1, $tanggal2, $start, $length, $search = " ")
  {
      $this->db->select('rp.no_rawat,p.nm_pasien,p.no_rkm_medis,bs.tglsep,bs.peserta,pj.png_jawab,dokter.nm_dokter,bs.klsrawat');
      $this->db->from('reg_periksa rp');
      $this->db->join('kamar_inap ki', 'rp.no_rawat=ki.no_rawat', 'inner');
      $this->db->join('pasien p', 'rp.no_rkm_medis=p.no_rkm_medis','left');
      $this->db->join('bridging_sep bs', 'rp.no_rawat=bs.no_rawat','left');
      $this->db->join('penjab pj', 'rp.kd_pj=pj.kd_pj','left');
      $this->db->join('dpjp_ranap dpjp', 'ki.no_rawat=dpjp.no_rawat', 'left');
      $this->db->join('dokter', 'dpjp.kd_dokter=dokter.kd_dokter', 'left');
        if (!empty($search)) {
          $this->db->group_start();
          $this->db->like('p.nm_pasien', $search);
          $this->db->or_like('p.no_rkm_medis', $search);
          $this->db->or_like('bs.tglsep', $search);
          $this->db->or_like('bs.peserta', $search);
          $this->db->or_like('pj.png_jawab', $search);
          $this->db->or_like('dokter.nm_dokter', $search);
          $this->db->group_end();
        }

      if (!empty($tanggal1) && !empty($tanggal2)) {
        $this->db->where('ki.tgl_masuk >=', $tanggal1);
        $this->db->where('ki.tgl_masuk <=', $tanggal2);
      }
    $this->db->group_by('ki.no_rawat');
      $this->db->limit($length, $start);

      return $this->db->get();
  }
  public function countPasien($tanggal1, $tanggal2, $search = " ")
  {
      $this->db->select('rp.no_rawat,p.nm_pasien,p.no_rkm_medis,bs.tglsep,bs.peserta,pj.png_jawab,dokter.nm_dokter');
      $this->db->from('reg_periksa rp');
      $this->db->join('kamar_inap ki', 'rp.no_rawat=ki.no_rawat', 'inner');
      $this->db->join('pasien p', 'rp.no_rkm_medis=p.no_rkm_medis','left');
      $this->db->join('bridging_sep bs', 'rp.no_rawat=bs.no_rawat','left');
      $this->db->join('penjab pj', 'rp.kd_pj=pj.kd_pj','left');
      $this->db->join('dpjp_ranap dpjp','ki.no_rawat=dpjp.no_rawat','left');
      $this->db->join('dokter','dokter.kd_dokter=dpjp.kd_dokter','left');
        if (!empty($search)) {
          $this->db->group_start();
          $this->db->like('p.nm_pasien', $search);
          $this->db->or_like('p.no_rkm_medis', $search);
          $this->db->or_like('bs.tglsep', $search);
          $this->db->or_like('bs.peserta', $search);
          $this->db->or_like('pj.png_jawab', $search);
          $this->db->or_like('dokter.nm_dokter', $search);
          $this->db->group_end();
        }
     

      if (!empty($tanggal1) && !empty($tanggal2)) {
        $this->db->where('ki.tgl_masuk >=', $tanggal1);
        $this->db->where('ki.tgl_masuk <=', $tanggal2);
      }

    $this->db->group_by('ki.no_rawat');
      return $this->db->get();
  }
  public function getKamar($no_rawat) {
  $this->db->select("GROUP_CONCAT(b.nm_bangsal
  ORDER BY TIMESTAMP(ki.tgl_masuk, ki.jam_masuk) ASC SEPARATOR ', ') AS kamar,
  COALESCE(MIN(CONCAT(tgl_masuk, ' ', jam_masuk)),'1970-01-01 00:00:00') AS tgl_masuk_awal,
  MAX(CASE WHEN stts_pulang <> 'Pindah Kamar' THEN CONCAT(ki.tgl_keluar, ' ', ki.jam_keluar) ELSE '' END) AS tgl_keluar_akhir");
    $this->db->from('kamar_inap ki');
    $this->db->join('kamar k','ki.kd_kamar=k.kd_kamar', 'inner');
    $this->db->join('bangsal b','k.kd_bangsal=b.kd_bangsal','inner');
    $this->db->where('ki.no_rawat', $no_rawat);
    $this->db->order_by('tgl_masuk_awal', 'ASC');
    $this->db->order_by('tgl_keluar_akhir', 'DESC');
    return $this->db->get();
  }
  public function getPeriksaLab($no_rawat){
    $this->db->select('SUM(dpl.biaya_item) as biaya_lab');
    $this->db->from('detail_periksa_lab dpl');
    $this->db->where('dpl.no_rawat', $no_rawat);
    return $this->db->get();
  }
  public function getPeriksaRad($no_rawat){
    $this->db->select('SUM(pr.biaya) as biaya_rad');
    $this->db->from('periksa_radiologi pr');
    $this->db->where('pr.no_rawat', $no_rawat);
    return $this->db->get();
  }
  public function getOperasi($no_rawat) {
    $this->db->select('SUM(o.biayaoperator1 + o.biayaoperator2 + o.biayaoperator3 + o.biayaasisten_operator1 + o.biayaasisten_operator2 + o.biayaasisten_operator3 + o.biayainstrumen + o.biayadokter_anak + o.biayaperawaat_resusitas + o.biayadokter_anestesi + o.biayaasisten_anestesi + o.biayaasisten_anestesi2 + o.biayabidan + o.biayabidan2 + o.biayabidan3 + o.biayaperawat_luar + o.biayaalat + o.biayasewaok + o.akomodasi + o.bagian_rs + o.biayasarpras + o.biaya_dokter_pjanak + o.biaya_dokter_umum + o.biaya_omloop +o.biaya_omloop2+o.biaya_omloop3+o.biaya_omloop4+o.biaya_omloop5) AS total');
    $this->db->from('operasi o');
    $this->db->where('no_rawat', $no_rawat);
    return $this->db->get();
  }
  public function getObat($no_rawat) {
    $this->db->select('SUM(detail_pemberian_obat.total) as total_obat');
    $this->db->from('detail_pemberian_obat ');
    $this->db->where('detail_pemberian_obat.no_rawat', $no_rawat);
    return $this->db->get();
  }
  public function getDokterRanap($no_rawat) {
    $this->db->select('SUM(rid.biaya_rawat) as total_dokter');
    $this->db->from('rawat_inap_dr rid');
    $this->db->where('rid.no_rawat', $no_rawat);
    return $this->db->get();
  }
  public function getPerawatRanap($no_rawat) {
    $this->db->select('SUM(rip.biaya_rawat) as total_perawat');
    $this->db->from('rawat_inap_pr rip');
    $this->db->where('rip.no_rawat', $no_rawat);
    return $this->db->get();
  }
  public function getDokterRalan($no_rawat) {
    $this->db->select('SUM(rjd.biaya_rawat) as total_dokter_ralan');
    $this->db->from('rawat_jl_dr rjd');
    $this->db->where('rjd.no_rawat', $no_rawat);
    return $this->db->get();
  }
  public function getPerawatRalan($no_rawat) {
    $this->db->select('SUM(rjp.biaya_rawat) as total_perawat_ralan');
    $this->db->from('rawat_jl_pr rjp');
    $this->db->where('rjp.no_rawat', $no_rawat);
    return $this->db->get();
  }
  public function getPerawatDokterRalan($no_rawat) {
    $this->db->select('SUM(rjd.biaya_rawat) as perawat_dokter');
    $this->db->from('rawat_jl_drpr rjd');
    $this->db->where('rjd.no_rawat', $no_rawat);
    return $this->db->get();
  }
  public function getTambahanBiaya($no_rawat) {
    $this->db->select('SUM(tb.besar_biaya) as tambahan_biaya');
    $this->db->from('tambahan_biaya tb');
    $this->db->where('tb.no_rawat', $no_rawat);
    return $this->db->get();
  }
  public function getPotonganBiaya($no_rawat) {
    $this->db->select('SUM(pb.besar_pengurangan*(-1)) as potongan_biaya');
    $this->db->from('pengurangan_biaya pb');
    $this->db->where('pb.no_rawat', $no_rawat);
    return $this->db->get();
  }
  public function getKamarInap($no_rawat) {
    $this->db->select('SUM(ki.ttl_biaya) as kamar_inap');
    $this->db->from('kamar_inap ki');
    $this->db->where('ki.no_rawat', $no_rawat);
    return $this->db->get();
  }

  public function getReturnObat($no_rawat) {
    $this->db->select('SUM(detreturjual.subtotal*(-1)) as return_obat');
    $this->db->from('detreturjual');
    $this->db->like('no_retur_jual',$no_rawat);
    return $this->db->get();
  }

  public function getBiayaReg($no_rawat)
  {
    $this->db->select('SUM(ki.ttl_biaya) as kamar_inap');
    $this->db->from('kamar_inap ki');
    $this->db->where('ki.no_rawat', $no_rawat);
    return $this->db->get();
  }

  public function exportGetPasien($tanggal1, $tanggal2)  {

  {
    $this->db->select('rp.no_rawat,p.nm_pasien,p.no_rkm_medis,bs.tglsep,bs.peserta,pj.png_jawab,dokter.nm_dokter,bs.klsrawat');
    $this->db->from('reg_periksa rp');
    $this->db->join('kamar_inap ki', 'rp.no_rawat=ki.no_rawat', 'inner');
    $this->db->join('pasien p', 'rp.no_rkm_medis=p.no_rkm_medis', 'left');
    $this->db->join('bridging_sep bs', 'rp.no_rawat=bs.no_rawat', 'left');
    $this->db->join('penjab pj', 'rp.kd_pj=pj.kd_pj', 'left');
    $this->db->join('dpjp_ranap dpjp', 'ki.no_rawat=dpjp.no_rawat', 'left');
    $this->db->join('dokter', 'dpjp.kd_dokter=dokter.kd_dokter', 'left');

    if (!empty($tanggal1) && !empty($tanggal2)) {
      $this->db->where('ki.tgl_masuk >=', $tanggal1);
      $this->db->where('ki.tgl_masuk <=', $tanggal2);
    }
    $this->db->group_by('ki.no_rawat');

    return $this->db->get();
  }

}
  public function exportGetKamar($no_rawat)
  {
    $this->db->select("GROUP_CONCAT(b.nm_bangsal
  ORDER BY TIMESTAMP(ki.tgl_masuk, ki.jam_masuk) ASC SEPARATOR ', ') AS kamar,
  COALESCE(MIN(CONCAT(tgl_masuk, ' ', jam_masuk)),'1970-01-01 00:00:00') AS tgl_masuk_awal,
  MAX(CASE WHEN stts_pulang <> 'Pindah Kamar' THEN CONCAT(ki.tgl_keluar, ' ', ki.jam_keluar) ELSE '' END) AS tgl_keluar_akhir");
    $this->db->from('kamar_inap ki');
    $this->db->join('kamar k', 'ki.kd_kamar=k.kd_kamar', 'inner');
    $this->db->join('bangsal b', 'k.kd_bangsal=b.kd_bangsal', 'inner');
    $this->db->where('ki.no_rawat', $no_rawat);
    $this->db->order_by('tgl_masuk_awal', 'ASC');
    $this->db->order_by('tgl_keluar_akhir', 'DESC');
    return $this->db->get();
  }
}