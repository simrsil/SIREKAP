<?php
class RadiologiModel extends CI_Model
{
    public function radiologi($tanggal1, $tanggal2, $start, $length, $search = "")
    {
        $this->db->select('p.nm_pasien, pr.tgl_periksa, jpr.nm_perawatan, d.nm_dokter');
        $this->db->from('periksa_radiologi pr');
        $this->db->join('reg_periksa rp', 'pr.no_rawat = rp.no_rawat', 'inner');
        $this->db->join('pasien p', 'rp.no_rkm_medis = p.no_rkm_medis', 'inner');
        $this->db->join('jns_perawatan_radiologi jpr', 'pr.kd_jenis_prw = jpr.kd_jenis_prw', 'inner');
        $this->db->join('dokter d', 'pr.kd_dokter = d.kd_dokter', 'inner');
        $this->db->not_like('jpr.nm_perawatan', 'RETRIBUSI');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('jpr.nm_perawatan', $search);
            $this->db->or_like('p.nm_pasien', $search);
            $this->db->or_like('d.nm_dokter', $search);
            $this->db->group_end();
        }
        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('pr.tgl_periksa >=', $tanggal1);
            $this->db->where('pr.tgl_periksa <=', $tanggal2);
        }
        $this->db->order_by('pr.tgl_periksa', 'DESC');
        $this->db->limit($length, $start);
        return $this->db->get();
    }

    public function countRadiologi($tanggal1, $tanggal2, $search = "")
    {
        $this->db->select('p.nm_pasien, pr.tgl_periksa, jpr.nm_perawatan, d.nm_dokter');
        $this->db->from('periksa_radiologi pr');
        $this->db->join('reg_periksa rp', 'pr.no_rawat = rp.no_rawat', 'inner');
        $this->db->join('pasien p', 'rp.no_rkm_medis = p.no_rkm_medis', 'inner');
        $this->db->join('jns_perawatan_radiologi jpr', 'pr.kd_jenis_prw = jpr.kd_jenis_prw', 'inner');
        $this->db->join('dokter d', 'pr.kd_dokter = d.kd_dokter', 'inner');
        $this->db->not_like('jpr.nm_perawatan', 'RETRIBUSI');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('jpr.nm_perawatan', $search);
            $this->db->or_like('p.nm_pasien', $search);
            $this->db->or_like('d.nm_dokter', $search);
            $this->db->group_end();
        }

        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('pr.tgl_periksa >=', $tanggal1);
            $this->db->where('pr.tgl_periksa <=', $tanggal2);
        }

        return $this->db->get();
    }

    public function excelRadiologi($tanggal1, $tanggal2)
    {
        $this->db->select('p.nm_pasien, pr.tgl_periksa, jpr.nm_perawatan, d.nm_dokter');
        $this->db->from('periksa_radiologi pr');
        $this->db->join('reg_periksa rp', 'pr.no_rawat = rp.no_rawat', 'inner');
        $this->db->join('pasien p', 'rp.no_rkm_medis = p.no_rkm_medis', 'inner');
        $this->db->join('jns_perawatan_radiologi jpr', 'pr.kd_jenis_prw = jpr.kd_jenis_prw', 'inner');
        $this->db->join('dokter d', 'pr.kd_dokter = d.kd_dokter', 'inner');
        $this->db->not_like('jpr.nm_perawatan', 'RETRIBUSI');

        if (!empty($tanggal1) && !empty($tanggal2)) {
            $this->db->where('pr.tgl_periksa >=', $tanggal1);
            $this->db->where('pr.tgl_periksa <=', $tanggal2);
        }

        return $this->db->get();
    }
    public function getJumlahRadiologiPerHari($tgl_awal, $tgl_akhir, $start, $length)
    {
        $this->db->select("periksa_radiologi.tgl_periksa,count(periksa_radiologi.no_rawat) as jmlPx,sum(periksa_radiologi.status = 'Ralan') as px_ralan,sum(periksa_radiologi.status = 'Ranap') as px_ranap");
        $this->db->from("periksa_radiologi");
        $this->db->join("jns_perawatan_radiologi", "periksa_radiologi.kd_jenis_prw=jns_perawatan_radiologi.kd_jenis_prw", "inner");
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where("periksa_radiologi.tgl_periksa >=", $tgl_awal);
            $this->db->where("periksa_radiologi.tgl_periksa <=", $tgl_akhir);
        }
        $this->db->not_like("jns_perawatan_radiologi.nm_perawatan", "RETRIBUSI");
        $this->db->group_by("periksa_radiologi.tgl_periksa");
        $this->db->limit($length, $start);

        return $this->db->get();
    }
    public function countJumlahRadiologiPerHari($tgl_awal, $tgl_akhir)
    {
        $this->db->select("periksa_radiologi.tgl_periksa,count(periksa_radiologi.no_rawat) as jmlPx");
        $this->db->from("periksa_radiologi");
        $this->db->join("jns_perawatan_radiologi", "periksa_radiologi.kd_jenis_prw=jns_perawatan_radiologi.kd_jenis_prw", "inner");
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where("periksa_radiologi.tgl_periksa >=", $tgl_awal);
            $this->db->where("periksa_radiologi.tgl_periksa <=", $tgl_akhir);
        }
        $this->db->not_like("jns_perawatan_radiologi.nm_perawatan", "RETRIBUSI");
        $this->db->group_by("periksa_radiologi.tgl_periksa");
        return $this->db->get();
    }

    public function dataExportExcel($tgl_awal, $tgl_akhir)
    {
        $this->db->select("periksa_radiologi.tgl_periksa,count(periksa_radiologi.no_rawat) as jmlPx,sum(periksa_radiologi.status = 'Ralan') as px_ralan,sum(periksa_radiologi.status = 'Ranap') as px_ranap");
        $this->db->from("periksa_radiologi");
        $this->db->join("jns_perawatan_radiologi", "periksa_radiologi.kd_jenis_prw=jns_perawatan_radiologi.kd_jenis_prw", "inner");
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where("periksa_radiologi.tgl_periksa >=", $tgl_awal);
            $this->db->where("periksa_radiologi.tgl_periksa <=", $tgl_akhir);
        }
        $this->db->not_like("jns_perawatan_radiologi.nm_perawatan", "RETRIBUSI");
        $this->db->group_by("periksa_radiologi.tgl_periksa");
        return $this->db->get();
    }
}
