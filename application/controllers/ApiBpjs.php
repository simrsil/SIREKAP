<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ApiBpjs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->library('curl');
        if (!$this->session->userdata('isLogin')) {
            redirect('Auth');
        }
    }

    public function index()
    {
        $data['title'] = 'Get Peserta BPJS';
        // $this->load->view('layout/header', $data);
        //$this->load->view('layout/sidebar');
        $this->load->view('layout/top-nav', $data);
        $this->load->view('v_get_peserta_bpjs');
        $this->load->view('layout/footer');
    }

    public function getPeserta()
    {

        $base_url = 'https://apijkn.bpjs-kesehatan.go.id'; // Ganti dengan URL API BPJS yang benar
        $service_name = 'vclaim-rest'; // Ganti dengan nama service yang sesuai, misal 'sep'
        $nik = $this->input->post('nik'); // NIK peserta BPJS
        $tgl_sep = date('Y-m-d'); // Tanggal SEP // Replace with your API URL
        $url = "{$base_url}/{$service_name}/Peserta/nik/{$nik}/tglSEP/{$tgl_sep}";
        $cons_id = '29633';  // Ganti dengan Konsumen ID
        $user_key = '7ca936087b5ae60510fc3dc3e8c208d9'; // Ganti dengan User Key
        $secretKey = "1eX48C7B70";
        $this->curl->setUrl($url);
        //create signature
        date_default_timezone_set('UTC');
        $tStamp = strval(time() - strtotime('1970-01-01 00:00:00'));
        $signature = hash_hmac('sha256', $cons_id . "&" . $tStamp, $secretKey, true);
        $encodedSignature = base64_encode($signature);
        // Set custom headers
        $headers = [
            'Content-Type: application/json',    // Tipe konten JSON
            'x-cons-id: ' . $cons_id,           // Konsumen ID
            'x-timestamp: ' . $tStamp,       // Timestamp
            'x-signature: ' . $encodedSignature,       // Signature yang dihasilkan
            'user_key: ' . $user_key            // User key
        ];
        $this->curl->setHeaders($headers);

        $result = $this->curl->execute();
        $this->curl->close();
        $http_code =  $result['http_code'];
        $http_time =   $result['http_time'];
        echo $http_code  . '<br>' . round($http_time, 4) . ' ms';
        // Process your data

    }
}
