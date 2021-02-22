<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Report extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekAdmin();
        $this->load->model('ReportModel');
        date_default_timezone_set('Asia/Ujung_Pandang');
    }
    public function viewBulanan()
    {
        $data['title'] = 'Laporan Bulanan';
        $this->load->view('report/bulanan/index', $data);
    }
    public function tes()
    {
        $bulan = '02';
        $tahun = '2021';
        if (!empty($bulan) && !empty($tahun)) {
            $data = $this->ReportModel->periodeBulanan($bulan, $tahun)->result();
            var_dump($data);
        }
    }
}
