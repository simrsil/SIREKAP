<?php
class ModelFarmasi extends CI_Model
{
    public function getResepObat($tgl_awal, $tgl_akhir, $start, $length)
    {
        $this->db->select("count(resep_obat.no_rawat) as jml_px, COUNT(CASE WHEN tgl_peresepan <> '0000-00-00' AND resep_obat.status = 'ralan' THEN 1 END) as obat_ralan, COUNT(CASE WHEN tgl_peresepan <> '0000-00-00' AND resep_obat.status = 'ranap' THEN 1 END) as obat_ranap, resep_obat.tgl_perawatan");
        $this->db->from("resep_obat");
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where("resep_obat.tgl_perawatan >=", $tgl_awal);
            $this->db->where("resep_obat.tgl_perawatan <=", $tgl_akhir);
        }

        $this->db->group_by("resep_obat.tgl_perawatan");
        $this->db->limit($length, $start);
        return $this->db->get();
    }
    public function countResepObat($tgl_awal, $tgl_akhir)
    {
        $this->db->select("count(resep_obat.no_rawat) as jml_px,resep_obat.tgl_perawatan,sum(resep_obat.status = 'ralan') as obat_ralan,sum(resep_obat.status = 'ranap') as obat_ranap");
        $this->db->from("resep_obat");
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where("resep_obat.tgl_perawatan >=", $tgl_awal);
            $this->db->where("resep_obat.tgl_perawatan <=", $tgl_akhir);
        }
        $this->db->group_by("resep_obat.tgl_perawatan");
        return $this->db->get();
    }

    public function excelResepObat($tgl_awal, $tgl_akhir)
    {
        $this->db->select("count(resep_obat.no_rawat) as jml_px, COUNT(CASE WHEN tgl_peresepan <> '0000-00-00' AND resep_obat.status = 'ralan' THEN 1 END) as obat_ralan, COUNT(CASE WHEN tgl_peresepan <> '0000-00-00' AND resep_obat.status = 'ranap' THEN 1 END) as obat_ranap, resep_obat.tgl_perawatan");
        $this->db->from("resep_obat");
        if (!empty($tgl_awal) && !empty($tgl_akhir)) {
            $this->db->where("resep_obat.tgl_perawatan >=", $tgl_awal);
            $this->db->where("resep_obat.tgl_perawatan <=", $tgl_akhir);
        }
        $this->db->group_by("resep_obat.tgl_perawatan");
        return $this->db->get();
    }
}
