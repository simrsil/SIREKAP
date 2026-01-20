<?php
class ModelTaskID extends CI_Model
{
    public function TampilTaskID($tanggal1, $tanggal2, $start, $length, $search)
    {
        $this->db->select('reg_periksa.no_rawat, pasien.no_rkm_medis, pasien.nm_pasien, reg_periksa.tgl_registrasi,reg_periksa.stts_daftar, penjab.png_jawab');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'inner');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli', 'inner');
        $this->db->join('penjab', 'reg_periksa.kd_pj = penjab.kd_pj', 'inner');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('reg_periksa.no_rawat', $search);
            $this->db->or_like('pasien.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->group_end();
        }

        $this->db->where('date(reg_periksa.tgl_registrasi) >=', $tanggal1);
        $this->db->where('date(reg_periksa.tgl_registrasi) <=', $tanggal2);
        $this->db->where('reg_periksa.kd_poli !=', 'IGDK');

        $this->db->order_by('reg_periksa.no_rawat');
        $this->db->limit($length, $start);

        return $this->db->get();
    }

    public function CountTampilTaskID($tanggal1, $tanggal2, $search)
    {
        $this->db->select('reg_periksa.no_rawat, pasien.no_rkm_medis, pasien.nm_pasien, reg_periksa.tgl_registrasi, reg_periksa.stts_daftar');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'inner');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli = poliklinik.kd_poli', 'inner');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('reg_periksa.no_rawat', $search);
            $this->db->or_like('pasien.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->group_end();
        }

        $this->db->where('date(reg_periksa.tgl_registrasi) >=', $tanggal1);
        $this->db->where('date(reg_periksa.tgl_registrasi) <=', $tanggal2);
        $this->db->where('reg_periksa.kd_poli !=', 'IGDK');


        $this->db->order_by('reg_periksa.no_rawat');

        return $this->db->count_all_results();
    }

    public function SEP($norawat)
    {
        $this->db->select('COUNT(bridging_sep.no_rawat) AS sep');
        $this->db->from('bridging_sep');
        $this->db->where('bridging_sep.no_rawat', $norawat);

        return $this->db->get();
    }

    public function JKN($norawat){
        $this->db->select('COUNT(referensi_mobilejkn_bpjs.no_rawat) as jkn');
        $this->db->from('referensi_mobilejkn_bpjs');
        $this->db->where('referensi_mobilejkn_bpjs.no_rawat', $norawat);

        return $this->db->get();
    }

    public function TaskID_1($norawat)
    {

        //SELECT COUNT(rmbt.no_rawat) AS taskid1 FROM referensi_mobilejkn_bpjs_taskid rmbt WHERE rmbt.no_rawat='2025/04/14/000128' AND rmbt.taskid='3'
        $this->db->select('COUNT(referensi_mobilejkn_bpjs_taskid.no_rawat) AS taskid1');
        $this->db->from('referensi_mobilejkn_bpjs_taskid');
        $this->db->where('referensi_mobilejkn_bpjs_taskid.no_rawat', $norawat);
        $this->db->where('referensi_mobilejkn_bpjs_taskid.taskid', '1');

        return $this->db->get();
    }
    public function TaskID_2($norawat)
    {

        //SELECT COUNT(rmbt.no_rawat) AS taskid1 FROM referensi_mobilejkn_bpjs_taskid rmbt WHERE rmbt.no_rawat='2025/04/14/000128' AND rmbt.taskid='3'
        $this->db->select('COUNT(referensi_mobilejkn_bpjs_taskid.no_rawat) AS taskid2');
        $this->db->from('referensi_mobilejkn_bpjs_taskid');
        $this->db->where('referensi_mobilejkn_bpjs_taskid.no_rawat', $norawat);
        $this->db->where('referensi_mobilejkn_bpjs_taskid.taskid', '2');

        return $this->db->get();
    }
    public function TaskID_3($norawat)
    {

        //SELECT COUNT(rmbt.no_rawat) AS taskid1 FROM referensi_mobilejkn_bpjs_taskid rmbt WHERE rmbt.no_rawat='2025/04/14/000128' AND rmbt.taskid='3'
        $this->db->select('COUNT(referensi_mobilejkn_bpjs_taskid.no_rawat) AS taskid3');
        $this->db->from('referensi_mobilejkn_bpjs_taskid');
        $this->db->where('referensi_mobilejkn_bpjs_taskid.no_rawat', $norawat);
        $this->db->where('referensi_mobilejkn_bpjs_taskid.taskid', '3');

        return $this->db->get();
    }
    public function TaskID_4($norawat)
    {
        //SELECT COUNT(rmbt.no_rawat) AS taskid1 FROM referensi_mobilejkn_bpjs_taskid rmbt WHERE rmbt.no_rawat='2025/04/14/000128' AND rmbt.taskid='3'
        $this->db->select('COUNT(referensi_mobilejkn_bpjs_taskid.no_rawat) AS taskid4');
        $this->db->from('referensi_mobilejkn_bpjs_taskid');
        $this->db->where('referensi_mobilejkn_bpjs_taskid.no_rawat', $norawat);
        $this->db->where('referensi_mobilejkn_bpjs_taskid.taskid', '4');

        return $this->db->get();
    }
    public function TaskID_5($norawat)
    {
        //SELECT COUNT(rmbt.no_rawat) AS taskid1 FROM referensi_mobilejkn_bpjs_taskid rmbt WHERE rmbt.no_rawat='2025/04/14/000128' AND rmbt.taskid='3'
        $this->db->select('COUNT(referensi_mobilejkn_bpjs_taskid.no_rawat) AS taskid5');
        $this->db->from('referensi_mobilejkn_bpjs_taskid');
        $this->db->where('referensi_mobilejkn_bpjs_taskid.no_rawat', $norawat);
        $this->db->where('referensi_mobilejkn_bpjs_taskid.taskid', '5');

        return $this->db->get();
    }
    public function TaskID_6($norawat)
    {

        //SELECT COUNT(rmbt.no_rawat) AS taskid1 FROM referensi_mobilejkn_bpjs_taskid rmbt WHERE rmbt.no_rawat='2025/04/14/000128' AND rmbt.taskid='3'
        $this->db->select('COUNT(referensi_mobilejkn_bpjs_taskid.no_rawat) AS taskid6');
        $this->db->from('referensi_mobilejkn_bpjs_taskid');
        $this->db->where('referensi_mobilejkn_bpjs_taskid.no_rawat', $norawat);
        $this->db->where('referensi_mobilejkn_bpjs_taskid.taskid', '6');

        return $this->db->get();
    }
    public function TaskID_7($norawat)
    {

        //SELECT COUNT(rmbt.no_rawat) AS taskid1 FROM referensi_mobilejkn_bpjs_taskid rmbt WHERE rmbt.no_rawat='2025/04/14/000128' AND rmbt.taskid='3'
        $this->db->select('COUNT(referensi_mobilejkn_bpjs_taskid.no_rawat) AS taskid7');
        $this->db->from('referensi_mobilejkn_bpjs_taskid');
        $this->db->where('referensi_mobilejkn_bpjs_taskid.no_rawat', $norawat);
        $this->db->where('referensi_mobilejkn_bpjs_taskid.taskid', '7');

        return $this->db->get();
    }
    public function TaskID_99($norawat)
    {
        //SELECT COUNT(rmbt.no_rawat) AS taskid1 FROM referensi_mobilejkn_bpjs_taskid rmbt WHERE rmbt.no_rawat='2025/04/14/000128' AND rmbt.taskid='3'
        $this->db->select('COUNT(referensi_mobilejkn_bpjs_taskid.no_rawat) AS taskid99');
        $this->db->from('referensi_mobilejkn_bpjs_taskid');
        $this->db->where('referensi_mobilejkn_bpjs_taskid.no_rawat', $norawat);
        $this->db->where('referensi_mobilejkn_bpjs_taskid.taskid', '99');

        return $this->db->get();
    }
}
