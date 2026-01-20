<?php
class Dashboard_Model extends CI_Model
{
    public function jkn($periode)
    {
        list($tahun, $bulan) = explode('-', $periode);

        $bulan_dipilih = "$tahun-$bulan";
        $bulan_sekarang = date('Y-m');

        // Jika bulan yang dipilih = bulan sekarang
        if ($bulan_dipilih == $bulan_sekarang) {
            $awal  = "$tahun-$bulan-01";
            $akhir = date('Y-m-d'); // hari ini
        }
        // Jika bulan yang dipilih = bulan sebelumnya / lama
        else {
            $awal  = "$tahun-$bulan-01";
            $akhir = date('Y-m-t', strtotime($awal)); // akhir bulan
        }

        $this->db->select('referensi_mobilejkn_bpjs.no_rawat');
        $this->db->from('referensi_mobilejkn_bpjs');
        $this->db->where('referensi_mobilejkn_bpjs.tanggalperiksa >=', $awal);
        $this->db->where('referensi_mobilejkn_bpjs.tanggalperiksa <=', $akhir);
    }

    public function jkn_total($periode)
    {
        $this->jkn($periode);
        return $this->db->count_all_results();
    }

    public function jkn_checkin($periode)
    {
        $this->jkn($periode);
        $this->db->where('referensi_mobilejkn_bpjs.status', 'Checkin');
        return $this->db->count_all_results();
    }

    public function jkn_belum($periode)
    {
        $this->jkn($periode);
        $this->db->where('referensi_mobilejkn_bpjs.status', 'Belum');
        return $this->db->count_all_results();
    }

    public function jkn_batal($periode)
    {
        $this->jkn($periode);
        $this->db->where('referensi_mobilejkn_bpjs.status', 'Batal');
        return $this->db->count_all_results();
    }

    public function pasien_bpjs($periode)
    {
        list($tahun, $bulan) = explode('-', $periode);

        $bulan_dipilih = "$tahun-$bulan";
        $bulan_sekarang = date('Y-m');

        // Jika bulan yang dipilih = bulan sekarang
        if ($bulan_dipilih == $bulan_sekarang) {
            $awal  = "$tahun-$bulan-01";
            $akhir = date('Y-m-d'); // hari ini
        }
        // Jika bulan yang dipilih = bulan sebelumnya / lama
        else {
            $awal  = "$tahun-$bulan-01";
            $akhir = date('Y-m-t', strtotime($awal)); // akhir bulan
        }

        $this->db->select('reg_periksa.no_rawat');
        $this->db->from('reg_periksa');
        $this->db->where('reg_periksa.status_lanjut', 'Ralan');
        $this->db->where('reg_periksa.stts <>', 'Batal');
        $this->db->where('reg_periksa.kd_pj', 'BPJ');
        $this->db->where('reg_periksa.tgl_registrasi >=', $awal);
        $this->db->where('reg_periksa.tgl_registrasi <=', $akhir);

        return $this->db->count_all_results();
    }

    public function poliklinik()
    {
        $this->db->select('reg_periksa.no_rawat');
        $this->db->from('reg_periksa');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli=poliklinik.kd_poli');
        $this->db->where('tgl_registrasi', date('Y-m-d'));
        $this->db->where('reg_periksa.kd_poli <>', 'IGDK');

        return $this->db->get();
    }
    public function igd()
    {
        $this->db->select('reg_periksa.no_rawat');
        $this->db->from('reg_periksa');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli=poliklinik.kd_poli', 'inner');
        $this->db->where('tgl_registrasi', date('Y-m-d'));
        $this->db->where('reg_periksa.kd_poli', 'IGDK');

        return $this->db->get();
    }

    public function rawatInap()
    {
        $this->db->select('kamar_inap.no_rawat,kamar_inap.tgl_masuk,bangsal.nm_bangsal,pasien.no_rkm_medis, pasien.nm_pasien, dokter.nm_dokter,kamar_inap.stts_pulang');
        $this->db->from('kamar_inap');
        $this->db->join('kamar', 'kamar_inap.kd_kamar=kamar.kd_kamar');
        $this->db->join('bangsal', 'kamar.kd_bangsal=bangsal.kd_bangsal');
        $this->db->join('reg_periksa', 'kamar_inap.no_rawat = reg_periksa.no_rawat');
        $this->db->join('pasien', 'reg_periksa.no_rkm_medis=pasien.no_rkm_medis');
        $this->db->join('dpjp_ranap', 'reg_periksa.no_rawat=dpjp_ranap.no_rawat');
        $this->db->join('dokter', 'dpjp_ranap.kd_dokter=dokter.kd_dokter');
        $this->db->where('stts_pulang', '-');

        return $this->db->get();
    }

    public function pasienPoliklinik()
    {
        $this->db->select("poliklinik.nm_poli, dokter.nm_dokter, count(reg_periksa.kd_poli) as jumlah");
        $this->db->from("reg_periksa");
        $this->db->join("poliklinik", "reg_periksa.kd_poli=poliklinik.kd_poli");
        $this->db->join("dokter", "reg_periksa.kd_dokter=dokter.kd_dokter");
        $this->db->where("reg_periksa.tgl_registrasi", date('Y-m-d'));
        $this->db->where("reg_periksa.kd_poli <>", 'IGDK');
        $this->db->group_by("reg_periksa.kd_dokter");

        return $this->db->get();
    }

    // public function statusKamar()
    // {
    //     $this->db->select("bangsal.nm_bangsal,count(kamar.kd_bangsal) AS jumlah_kmr,SUM(kamar.status='ISI') AS kmr_isi,SUM(kamar.status='KOSONG') AS kmr_kosong, kamar.kelas");
    //     $this->db->from("kamar");
    //     $this->db->join("bangsal", "kamar.kd_bangsal = bangsal.kd_bangsal");
    //     $this->db->where("statusdata ='1'");
    //     $this->db->group_by("kamar.kd_bangsal");

    //     return $this->db->get();
    // }
    public function statusKamar()
    {
        $this->db->select("
        CASE
            WHEN bangsal.nm_bangsal LIKE 'RUANG ISOLASI%' THEN 'RUANG ISOLASI'
            WHEN bangsal.nm_bangsal LIKE 'RUANGAN ISOLASI%' THEN 'RUANG ISOLASI'
            ELSE SUBSTRING_INDEX(bangsal.nm_bangsal, ' ', 1)
        END AS nama_group, 
        COUNT(kamar.kd_bangsal) AS jumlah_kmr, SUM(kamar.status='ISI') AS kmr_isi, 
        SUM(kamar.status='KOSONG') AS kmr_kosong, kamar.kelas");
        $this->db->from("kamar");
        $this->db->join("bangsal", "kamar.kd_bangsal = bangsal.kd_bangsal");
        $this->db->where("statusdata ='1'");
        $this->db->group_by("nama_group, kamar.kelas");

        return $this->db->get();
    }

    public function pasienPerCaraBayar()
    {
        $this->db->select("COUNT(reg_periksa.kd_pj) as jns_bayar,penjab.png_jawab,reg_periksa.kd_poli,poliklinik.nm_poli,reg_periksa.kd_dokter,dokter.nm_dokter");
        $this->db->from("reg_periksa");
        $this->db->join('penjab', 'reg_periksa.kd_pj=penjab.kd_pj', 'inner');
        $this->db->join('poliklinik', 'reg_periksa.kd_poli=poliklinik.kd_poli');
        $this->db->join('dokter', 'reg_periksa.kd_dokter=dokter.kd_dokter');
        $this->db->where('reg_periksa.tgl_registrasi', date('Y-m-d'));
        $this->db->where('reg_periksa.kd_poli <>', 'IGDK');
        $this->db->group_by('reg_periksa.kd_dokter,reg_periksa.kd_pj');

        return $this->db->get();
    }

    public function GrafikJKNHarian($bulan, $tahun)
    {
        $start = "$tahun-$bulan-01";
        $end   = date('Y-m-t', strtotime($start));

        $this->db->select('DAY(tanggalperiksa) as tanggal,
            SUM(CASE WHEN status = "Checkin" THEN 1 ELSE 0 END) as pasien,
            SUM(CASE WHEN status = "Belum" THEN 1 ELSE 0 END) as kunjungan,
            SUM(CASE WHEN status = "Batal" THEN 1 ELSE 0 END) as batal');
        $this->db->from('referensi_mobilejkn_bpjs');
        $this->db->where('tanggalperiksa >=', $start);
        $this->db->where('tanggalperiksa <=', $end);
        $this->db->group_by('DAY(tanggalperiksa)');
        $this->db->order_by('tanggal', 'ASC');

        return $this->db->get();
    }
}
