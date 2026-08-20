<?php

class ModelRujukan extends CI_Model
{
    public function RujukanKeluar($tglRegistrasiAwal, $tglRegistrasiAkhir)
    {
        $this->db->select('reg_periksa.status_lanjut,
                        COUNT(DISTINCT CASE WHEN rujuk.no_rujuk IS NOT NULL THEN reg_periksa.no_rawat END) AS rujuk,
                        COUNT(DISTINCT CASE WHEN rujuk.no_rujuk IS NULL THEN reg_periksa.no_rawat END) AS tidak_rujuk');
        $this->db->from('reg_periksa');
        $this->db->join('rujuk', 'reg_periksa.no_rawat = rujuk.no_rawat', 'left');
        $this->db->where('reg_periksa.tgl_registrasi >=', $tglRegistrasiAwal);
        $this->db->where('reg_periksa.tgl_registrasi <=', $tglRegistrasiAkhir);
        $this->db->group_by('reg_periksa.status_lanjut');

        return $this->db->get();
    }

    public function RujukanMasuk($tglRegistrasiAwal, $tglRegistrasiAkhir)
    {
        $this->db->select('reg_periksa.status_lanjut,
                         COUNT(DISTINCT CASE WHEN rujuk_masuk.perujuk LIKE "%KIRIMAN%" THEN reg_periksa.no_rawat END) AS kiriman,
                         COUNT(DISTINCT CASE WHEN rujuk_masuk.no_rujuk IS NOT NULL AND rujuk_masuk.perujuk NOT LIKE "%KIRIMAN%" THEN reg_periksa.no_rawat END) AS rujuk_non_kiriman,
                         COUNT(DISTINCT CASE WHEN rujuk_masuk.no_rujuk IS NULL THEN reg_periksa.no_rawat END) AS tidak_rujuk');
        $this->db->from('reg_periksa');
        $this->db->join('rujuk_masuk', 'reg_periksa.no_rawat = rujuk_masuk.no_rawat', 'left');
        $this->db->where('reg_periksa.tgl_registrasi >=', $tglRegistrasiAwal);
        $this->db->where('reg_periksa.tgl_registrasi <=', $tglRegistrasiAkhir);
        $this->db->group_by('reg_periksa.status_lanjut');

        return $this->db->get();
    }

    public function getRujukanKeluar($tglRegistrasiAwal, $tglRegistrasiAkhir, $search)
    {
        $this->db->select('reg_periksa.tgl_registrasi, rujuk.tgl_rujuk,reg_periksa.no_rawat, pasien.nm_pasien, reg_periksa.status_lanjut,
                    IF(rujuk.no_rujuk IS NOT NULL, "Rujuk", "Tidak Rujuk") AS stts_rujuk, IF(rujuk.keterangan_diagnosa IS NOT NULL, rujuk.keterangan_diagnosa, "-") as keterangan_diagnosa, IF(rujuk.keterangan IS NOT NULL, rujuk.keterangan, "-") as keterangan');
        $this->db->from('reg_periksa');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis = pasien.no_rkm_medis', 'inner');
        $this->db->join('dokter', 'reg_periksa.kd_dokter = dokter.kd_dokter', 'inner');
        $this->db->join('rujuk', 'reg_periksa.no_rawat = rujuk.no_rawat', 'inner');
        $this->db->not_like('rujuk.no_rujuk', '0188R');

        if (!empty($search)) {
            $this->db->group_start();
            $this->db->like('reg_periksa.no_rawat', $search);
            $this->db->or_like('pasien.no_rkm_medis', $search);
            $this->db->or_like('pasien.nm_pasien', $search);
            $this->db->or_like('reg_periksa.status_lanjut', $search);
            // $this->db->or_like('rujuk.no_rujuk', $search);
            $this->db->group_end();
        }

        $this->db->where('reg_periksa.tgl_registrasi >=', $tglRegistrasiAwal);
        $this->db->where('reg_periksa.tgl_registrasi <=', $tglRegistrasiAkhir);
        // $this->db->group_by('reg_periksa.no_rawat');
        $this->db->order_by('reg_periksa.tgl_registrasi, reg_periksa.jam_reg, reg_periksa.no_rawat');
    }

    public function TampilRujukanKeluar($tglRegistrasiAwal, $tglRegistrasiAkhir, $start, $length, $search)
    {
        $this->getRujukanKeluar($tglRegistrasiAwal, $tglRegistrasiAkhir, $search);

        $this->db->limit($length, $start);

        return $this->db->get();
    }

    public function JmlHalamanRujukanKeluar($tglRegistrasiAwal, $tglRegistrasiAkhir, $search)
    {
        $this->getRujukanKeluar($tglRegistrasiAwal, $tglRegistrasiAkhir, $search);

        return $this->db->get();
    }

    public function jmlRujukanMasuk($tglRegistrasiAwal, $tglRegistrasiAkhir, $status)
    {
        $this->db->select("CASE 
                            WHEN rm.no_rawat IS NULL THEN 'TIDAK ADA RUJUKAN'
                            WHEN rm.perujuk IS NULL OR rm.perujuk = '' THEN 'TIDAK ADA RUJUKAN'
                            ELSE rm.perujuk
                        END AS perujuk,
                        COUNT(DISTINCT rp.no_rawat) AS jumlah", FALSE);
        $this->db->from('reg_periksa rp');
        $this->db->join('rujuk_masuk rm', 'rp.no_rawat = rm.no_rawat', 'left');
        $this->db->where('rp.status_lanjut', $status);
        $this->db->where('rp.tgl_registrasi >=', $tglRegistrasiAwal);
        $this->db->where('rp.tgl_registrasi <=', $tglRegistrasiAkhir);
        $this->db->group_by('
                    CASE 
                        WHEN rm.no_rawat IS NULL THEN "TIDAK ADA RUJUKAN"
                        WHEN rm.perujuk IS NULL OR rm.perujuk = "" THEN "TIDAK ADA RUJUKAN" 
                        ELSE rm.perujuk
                    END', FALSE);
        $this->db->order_by('jumlah', 'DESC');

        return $this->db->get();
    }
}
