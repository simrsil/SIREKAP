<?php
defined('BASEPATH') or exit('No direct script access allowed');

class error_404 extends CI_Controller
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
        //$data['title'] = 'Get Peserta BPJS';
        // $this->load->view('layout/header', $data);
        //$this->load->view('layout/sidebar');
        $this->load->view('layout/top-nav');
        $this->load->view('errors/error_404');
        $this->load->view('layout/footer');
    }
}
