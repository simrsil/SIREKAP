<?php
class ModelCetakSEP extends CI_Model
{
    public function getPasien($kd_dokter, $tglSepRajal1, $tglSepRajal2, $search = "")
    {
        $this->db->select('reg_periksa.no_rawat,reg_periksa.no_rkm_medis,pasien.nm_pasien,dokter.nm_dokter,poliklinik.nm_poli,penjab.png_jawab');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'left');
        $this->db->join('dokter', 'reg_periksa.kd_dokter=dokter.kd_dokter', 'inner');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli=poliklinik.kd_poli');
        $this->db->join('penjab', 'reg_periksa.kd_pj=penjab.kd_pj');
        $this->db->where('poliklinik.kd_poli<>', 'IGDK');
        $this->db->where('dokter.kd_dokter', $kd_dokter);
        if (!empty($tglSepRajal1) && !empty($tglSepRajal1)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tglSepRajal1);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tglSepRajal2);
        }
        return $this->db->get();
    }

    public function getSEP($no_rawat)
    {
        $this->db->select('bridging_sep.no_sep');
        $this->db->from('reg_periksa');
        $this->db->join('bridging_sep', 'reg_periksa.no_rawat=bridging_sep.no_rawat', 'left');
        $this->db->where('bridging_sep.no_rawat', $no_rawat);
        return $this->db->get();
    }

    public function getSuratKontrol($no_sep)
    {
        $this->db->select('bridging_surat_kontrol_bpjs.no_sep');
        $this->db->from('bridging_surat_kontrol_bpjs');
        $this->db->join('bridging_sep', 'bridging_surat_kontrol_bpjs.no_sep=bridging_sep.no_sep', 'left');
        $this->db->where('bridging_surat_kontrol_bpjs.no_sep', $no_sep);
        return $this->db->get();
    }
}
