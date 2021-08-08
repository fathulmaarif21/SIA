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
    public function getLaporanBulanan()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        // $bulan = '02';
        // $tahun = '2021';
        $data = [];
        $saldoAwal = 0;
        $no = 0;
        if (!empty($bulan) && !empty($tahun)) {
            $lists = $this->ReportModel->periodeBulanan($bulan, $tahun)->result();
            foreach ($lists as $list) {
                $saldoAkhir = $saldoAwal + $list->penambahan - $list->pengurangan;
                $row = [];
                $row[] = $no++;
                // $row[] = $list->kd_obat;
                $row[] = $list->nama_obat;
                $row[] = 'saldo awal = ' . $saldoAwal;
                $row[] = 'penambahan = ' . $list->penambahan;
                $row[] = 'pengurangan = ' . $list->pengurangan;
                $row[] = $saldoAkhir;
                // $row[] = rupiah($list->harga);
                $data[] = $row;
            }
        }
        $output = [
            "data" => $data
        ];
        echo json_encode($output);
        // getTrxPenjualanModelByTime
    }

    function getSaldoAwal()
    {
        $bulan = '01';
        $tahun = '2021';
        $kd_obat = '1901O0002';
        $nama_obat = 'minyak gosok';
        $harga = '9000';
        $list = $this->ReportModel->saldoawal($bulan . $tahun, $kd_obat, $nama_obat, $harga)->result();
        echo json_encode($list);
    }
}
