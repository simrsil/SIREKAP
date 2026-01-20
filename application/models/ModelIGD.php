<?php
class ModelIGD extends CI_Model
{
    public function JumlahIndikatorTriasePrimer($tglTriaseAwal, $tglTriaseAkhir)
    {
        $this->db->select('data_triase_igdprimer.plan, COUNT(data_triase_igdprimer.plan) AS total');
        $this->db->from('data_triase_igdprimer');
        if (!empty($tglTriaseAwal) && !empty($tglTriaseAkhir)) {
            $this->db->where('data_triase_igdprimer.tanggaltriase >=', $tglTriaseAwal . ' 00:00:00');
            $this->db->where('data_triase_igdprimer.tanggaltriase <=', $tglTriaseAkhir . ' 23:59:59');
        }
        $this->db->group_by('data_triase_igdprimer.plan');

        return $this->db->get();
    }

    public function JumlahIndikatorTriaseSekunder($tglTriaseAwalSekunder, $tglTriaseAkhirSekunder)
    {
        $this->db->select('data_triase_igdsekunder.plan, COUNT(data_triase_igdsekunder.plan) AS total');
        $this->db->from('data_triase_igdsekunder');
        if (!empty($tglTriaseAwalSekunder) && !empty($tglTriaseAkhirSekunder)) {
            $this->db->where('data_triase_igdsekunder.tanggaltriase >=', $tglTriaseAwalSekunder . ' 00:00:00');
            $this->db->where('data_triase_igdsekunder.tanggaltriase <=', $tglTriaseAkhirSekunder . ' 23:59:59');
        }
        $this->db->group_by('data_triase_igdsekunder.plan');

        return $this->db->get();
    }

    public function JumlahPasienRalanRanap($tglAwalRegistrasi, $tglAkhirRegistrasi)
    {
        $this->db->select('reg_periksa.status_lanjut, count(reg_periksa.status_lanjut) as total');
        $this->db->from('reg_periksa');
        if (!empty($tglAwalRegistrasi) && !empty($tglAkhirRegistrasi)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tglAwalRegistrasi);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tglAkhirRegistrasi);
        }
        $this->db->where('reg_periksa.kd_poli', 'IGDK');
        $this->db->group_by('reg_periksa.status_lanjut');

        return $this->db->get();
    }

    public function JumlahPasienBerdasarkanStts($tglAwalRegistrasi, $tglAkhirRegistrasi)
    {
        $this->db->select('reg_periksa.stts as status, count(reg_periksa.stts) as total');
        $this->db->from('reg_periksa');
        if (!empty($tglAwalRegistrasi) && !empty($tglAkhirRegistrasi)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tglAwalRegistrasi);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tglAkhirRegistrasi);
        }
        $this->db->where('reg_periksa.kd_poli', 'IGDK');
        $this->db->group_by('reg_periksa.stts');

        return $this->db->get();
    }
}
