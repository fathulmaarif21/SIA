<?php

namespace App\Controllers;

use App\Models\ObatModel;
use App\Models\TrxPenjualanModel;
use Config\Services;


class User extends BaseController
{
    protected $dataObat;
    public function __construct()
    {
        $this->dataObat = new ObatModel(Services::request());
        $this->trxPenjualan = new TrxPenjualanModel(Services::request());
    }
    public function index()
    {
        return view('user/index');
    }

    public function dataObat()
    {
        $data['title'] = 'Data Obat';
        return view('dataObat/index', $data);
    }
    public function trxPenjualan()
    {
        $data['title'] = 'Trx Penjualan';
        return view('trxPenjualan/index', $data);
    }
    public function detailTrxPenjualan($kd_trx)
    {
        $data = $this->trxPenjualan->getDetailTrxPenjualanByTime($kd_trx)->getResult();
        echo json_encode($data);
    }


    public function ajax_list()
    {
        if ($this->request->getMethod(true) == 'POST') {
            $lists =  $this->dataObat->get_datatables();
            $data = [];
            $no = $this->request->getPost("start");
            foreach ($lists as $list) {
                $stok = $list->stok == 0 ? '<b style="color: red;">' . $list->stok . '</b>' : $list->stok;
                $no++;
                $row = [];
                $row[] = $list->kd_obat;
                $row[] = $list->nama_obat;
                $row[] = $list->harga_jual;
                $row[] = $stok;
                //add html for action
                $row[] = '';
                $data[] = $row;
            }
            $output = [
                "draw" => $this->request->getPost('draw'),
                "recordsTotal" =>  $this->dataObat->count_all(),
                "recordsFiltered" =>  $this->dataObat->count_filtered(),
                "data" => $data
            ];
            echo json_encode($output);
        }
    }


    // trx penjualan
    public function ajax_trx_penjualan()
    {
        $data = [];
        $lists = $this->trxPenjualan->getTrxPenjualanByTime()->getResult();
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
