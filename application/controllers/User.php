<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ObatModel');
        $this->load->model('TrxPenjualanModel');
        date_default_timezone_set('Asia/Ujung_Pandang');
    }

    // public function index()
    // {
    //     $this->load->view('user/index');
    // }

    public function dataObat()
    {
        $data['title'] = 'Data Obat';
        $this->load->view('dataObat/index', $data);
    }
    public function trxPenjualan()
    {
        $data['title'] = 'Trx Penjualan';
        $this->load->view('trxPenjualan/index', $data);
    }
    public function detailTrxPenjualan($kd_trx)
    {
        $data = $this->TrxPenjualanModel->getDetailTrxPenjualanByTime($kd_trx)->result();
        echo json_encode($data);
    }


    public function ajax_list()
    {
        $lists =  $this->ObatModel->get_datatables();
        $data = [];
        $no = $this->input->post("start");
        foreach ($lists as $list) {
            $stok = $list->stok == 0 ? '<b style="color: red;">' . $list->stok . '</b>' : $list->stok;
            $no++;
            $row = [];
            $row[] = $list->kd_obat;
            $row[] = $list->nama_obat;
            $row[] = $list->kemasan;
            $row[] = $list->harga_jual;
            $row[] = $stok;
            //add html for action
            $data[] = $row;
        }
        $output = [
            "draw" => $this->input->post('draw'),
            "recordsTotal" =>  $this->ObatModel->count_all(),
            "recordsFiltered" =>  $this->ObatModel->count_filtered(),
            "data" => $data
        ];
        echo json_encode($output);
    }


    // trx penjualan
    public function ajax_trx_penjualan()
    {
        $data = [];
        $lists = $this->TrxPenjualanModel->getTrxPenjualanByTime()->result();
        foreach ($lists as $list) {
            $row = [];
            $row[] = $list->kd_transaksi;
            $row[] = $list->nama_pembeli;
            $row[] = $list->alamat_pembeli;
            $row[] = $list->note;
            $row[] = $list->total_trx;
            $row[] = $list->total_bayar;
            $row[] = $list->kembalian;
            //add html for action
            // onclick="detail_trx(' . "'" . $value->kd_transaksi . "'" . ')"
            $row[] = '<a class="btn btn-sm btn-warning" href="javascript:void(0)" onclick="detail_trx(' . "'" . $list->kd_transaksi . "'" . ')" title="detail" ><i class="fas fa-info"></i> Detail</a>';
            $data[] = $row;
        }
        $output = [
            "data" => $data
        ];
        echo json_encode($output);
        // getTrxPenjualanByTime
    }

    //--------------------------------------------------------------------

}
