<?php
class ModelStatusRMRalan extends CI_Model
{
    public function getPasienRalan($tgl_awal, $tgl_akhir, $status_ralan, $start, $length, $search = "")
    {
        $this->db->select('reg_periksa.no_rawat,reg_periksa.no_rkm_medis,pasien.nm_pasien,poliklinik.nm_poli,reg_periksa.tgl_registrasi,dokter.nm_dokter,reg_periksa.status_lanjut,reg_periksa.stts,penjab.png_jawab');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'inner');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli=poliklinik.kd_poli', 'inner');
        $this->db->join('dokter', 'reg_periksa.kd_dokter=dokter.kd_dokter', 'inner');
        $this->db->join('penjab', 'reg_periksa.kd_pj=penjab.kd_pj', 'inner');
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');

        if (!empty($status_ralan)) {
            $this->db->where('reg_periksa.stts', $status_ralan);
        } else {
            $this->db->where('reg_periksa.stts <>', 'Batal');
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('reg_periksa.no_rawat', $search);
            $this->db->or_like('reg_periksa.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->or_like('poliklinik.nm_poli', $search);
            $this->db->or_like('dokter.nm_dokter', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }


        $this->db->limit($length, $start);
        return $this->db->get();
    }

    public function countPasienRalan($tgl_awal, $tgl_akhir, $status_ralan, $search = "")
    {
        $this->db->select('reg_periksa.no_rawat,reg_periksa.no_rkm_medis,pasien.nm_pasien,poliklinik.nm_poli,reg_periksa.tgl_registrasi,dokter.nm_dokter,reg_periksa.status_lanjut');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'inner');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli=poliklinik.kd_poli', 'inner');
        $this->db->join('dokter', 'reg_periksa.kd_dokter=dokter.kd_dokter', 'inner');
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');
        if (!empty($status_ralan)) {
            $this->db->where('reg_periksa.stts', $status_ralan);
        }
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('reg_periksa.no_rawat', $search);
            $this->db->or_like('reg_periksa.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->or_like('poliklinik.nm_poli', $search);
            $this->db->or_like('dokter.nm_dokter', $search);
            $this->db->group_end();
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }

        return $this->db->get();
    }

    public function getSoapieRalan($no_rawat)
    {
        $this->db->select('if(count(pemeriksaan_ralan.no_rawat)>0,"Ada","Tidak Ada") as soap');
        $this->db->from('pemeriksaan_ralan');
        $this->db->where('pemeriksaan_ralan.no_rawat', $no_rawat);
        return $this->db->get();
    }

    public function resumeRalan($no_rawat)
    {
        $this->db->select('if(count(resume_pasien.no_rawat)>0,"Ada","Tidak Ada") as resume');
        $this->db->from('resume_pasien');
        $this->db->where('resume_pasien.no_rawat', $no_rawat);
        return $this->db->get();
    }

    public function getICD9($no_rawat)
    {
        $this->db->select('if(count(diagnosa_pasien.no_rawat)>0,"Ada","Tidak Ada") as icd9');
        $this->db->from('diagnosa_pasien');
        $this->db->where('diagnosa_pasien.no_rawat', $no_rawat);
        $this->db->where('diagnosa_pasien.status', 'Ralan');

        return $this->db->get();
    }

    public function getIcd10($no_rawat)
    {
        $this->db->select('if(count(prosedur_pasien.no_rawat)>0,"Ada","Tidak Ada") as icd10');
        $this->db->from('prosedur_pasien');
        $this->db->where('prosedur_pasien.no_rawat', $no_rawat);
        $this->db->where('prosedur_pasien.status', 'Ralan');
        return $this->db->get();
    }

    public function getCaraDaftar($no_rawat)
    {
        $this->db->select('if(count(referensi_mobilejkn_bpjs.no_rawat)> 0,"JKN","Onsite") as cara_daftar');
        $this->db->from('referensi_mobilejkn_bpjs');
        $this->db->where('referensi_mobilejkn_bpjs.no_rawat', $no_rawat);
        return $this->db->get();
    }
    public function exportExcel($tgl_awal, $tgl_akhir, $status_ralan)
    {
        $this->db->select('reg_periksa.no_rawat,reg_periksa.no_rkm_medis,pasien.nm_pasien,poliklinik.nm_poli,reg_periksa.tgl_registrasi,dokter.nm_dokter,reg_periksa.status_lanjut,reg_periksa.stts,penjab.png_jawab');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis', 'inner');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli=poliklinik.kd_poli', 'inner');
        $this->db->join('dokter', 'reg_periksa.kd_dokter=dokter.kd_dokter', 'inner');
        $this->db->join('penjab', 'reg_periksa.kd_pj=penjab.kd_pj', 'inner');
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');
        if (!empty($status_ralan)) {
            $this->db->where('reg_periksa.stts', $status_ralan);
        } else {
            $this->db->where('reg_periksa.stts <>', 'Batal');
        }
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tgl_awal);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tgl_akhir);
        }
        return $this->db->get();
    }
}
