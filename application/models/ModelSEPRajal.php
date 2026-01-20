<?php
class ModelSEPRajal extends CI_Model
{
    public function getPoliklinik($tglSepRajal1, $tglSepRajal2, $search = "")
    {
        //menambah query menampilkan jam praktek
        $hari = date('l');
        $hariIndo = [
            'Sunday'    => 'Akhad',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu'
        ];
        $hariSekarang = $hariIndo[$hari];
        $this->db->select('
            poliklinik.nm_poli,
            dokter.nm_dokter,
            dokter.kd_dokter,
            COUNT(reg_periksa.no_rawat) as total,
            CONCAT(jadwal.jam_mulai,"-",jadwal.jam_selesai) as jam_kerja,
            SUM(CASE WHEN reg_periksa.kd_pj = "Bpj" THEN 1 ELSE 0 END) AS bpjs,
            SUM(CASE WHEN reg_periksa.kd_pj != "BPJ" THEN 1 ELSE 0 END) AS lainnya,
            SUM(CASE WHEN reg_periksa.stts = "Batal" THEN 1 ELSE 0 END) AS batal,
            COUNT(CASE WHEN bridging_sep.no_sep IS NOT NULL AND bridging_sep.no_sep != "" THEN 1 END) AS jumlah_sep
            
        ');
        $this->db->from('reg_periksa');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli=poliklinik.kd_poli', 'inner');
        $this->db->join('dokter', 'reg_periksa.kd_dokter=dokter.kd_dokter', 'left');
        $this->db->join('bridging_sep', 'reg_periksa.no_rawat=bridging_sep.no_rawat', 'left');
        $this->db->join('jadwal', 'dokter.kd_dokter=jadwal.kd_dokter', 'left');
        $this->db->where('poliklinik.kd_poli<>', 'IGDK');
        $this->db->where('hari_kerja', $hariSekarang);
        //CUSTOMM
        // $this->db->where('reg_periksa.stts <>', 'batal');
        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('dokter.nm_dokter', $search);
            $this->db->or_like('poliklinik.nm_poli', $search);
            $this->db->group_end();
        }
        if (!empty($tglSepRajal1) && !empty($tglSepRajal1)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tglSepRajal1);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tglSepRajal2);
        }
        $this->db->order_by('dokter.nm_dokter');
        $this->db->group_by('reg_periksa.kd_dokter');
        return $this->db->get();
    }

    public function jumlahKunjunganRajal($tglSepRajal1, $tglSepRajal2)
    {
        $this->db->select('reg_periksa.no_rawat');
        $this->db->from('reg_periksa');
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');
        $this->db->where('reg_periksa.kd_poli <>', 'IGDK');
        //CUSTOMM
        $this->db->where('reg_periksa.stts <>', 'batal');
        if (!empty($tglSepRajal1) && !empty($tglSepRajal1)) {
            $this->db->where('reg_periksa.tgl_registrasi >=', $tglSepRajal1);
            $this->db->where('reg_periksa.tgl_registrasi <=', $tglSepRajal2);
        }
        return $this->db->get();
    }
}
