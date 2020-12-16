<?php

namespace App\Controllers;

use App\Models\KasirModel;
use App\Models\TrxPenjualanModel;
use Config\Services;


class Kasir extends BaseController
{
    protected $dataObat;
    public function __construct()
    {
        $this->dataObat = new KasirModel();
        $this->TrxPenjualanModel = new TrxPenjualanModel(Services::request());
        date_default_timezone_set('Asia/Ujung_Pandang');
    }
    public function index()
    {
        $data['title'] = 'Kasir';
        return view('kasir/index', $data);
    }

    public function getObat()
    {
        $search = $this->request->getPost('search');
        $data_trx = $this->dataObat->dataObatByName($search)->getResult();
        if ($data_trx) {
            foreach ($data_trx as $value) {
                $selectajax[] = array(
                    'id' => $value->kd_obat,
                    'text' => $value->nama_obat . ' | ' . $value->stok,
                );
            }
            echo json_encode($selectajax);
        }
    }
    public function getObatById()
    {
        $id = $this->request->getPost('data');
        $value = $this->dataObat->getObatById($id)->getRow();
        $selectajax = array(
            'id' => $value->kd_obat,
            'harga' => $value->harga_jual,
            'nama_obat' => $value->nama_obat,
            'stok' => $value->stok
        );

        echo json_encode($selectajax);
    }
    public function submitTrx()
    {
        $tagihan_simpan = $this->request->getPost('tagihan_simpan');
        $bayar_simpan = $this->request->getPost('bayar_simpan');
        $kembalian_simpan = $this->request->getPost('kembalian_simpan');

        $arr_kd_obat = $this->request->getPost('arr_kd_obat');
        // $arr_stok = $this->request->getPost('arr_stok');
        $arr_qty = $this->request->getPost('arr_qty');
        $arr_subtotal = $this->request->getPost('arr_subtotal');

        $nama = $this->request->getPost('catatanPembeli')[3]['value'];
        $alamat = $this->request->getPost('catatanPembeli')[4]['value'];
        $note = $this->request->getPost('catatanPembeli')[5]['value'];


        if ($arr_kd_obat) {
            $autokode = $this->TrxPenjualanModel->autoKdTrxPenjualan();

            $allTrx = [
                "kd_transaksi" => $autokode,
                "id_user" => '1',
                "nama_pembeli" => $nama,
                "alamat_pembeli" => $alamat,
                "note" => $note,
                "total_trx" => $tagihan_simpan,
                "total_bayar" => $bayar_simpan,
                "kembalian" => $kembalian_simpan

            ];

            $detailTrx = [];
            for ($i = 0; $i < count($arr_kd_obat); $i++) {
                $detail = [
                    "kd_transaksi" => $autokode,
                    "kd_obat" => $arr_kd_obat[$i],
                    "qty" => $arr_qty[$i],
                    "sub_total" => $arr_subtotal[$i]
                ];
                array_push($detailTrx, $detail);
            }


            $cek =  $this->TrxPenjualanModel->addTrxPenjualan($allTrx, $detailTrx);
        }
        if ($cek) {
            $data["id_nota"] = $autokode;
        } else {
            $data["id_nota"] = '';
        }
        $data["status"] = 'sukses';


        echo json_encode($data);
    }
    public function tes()
    {

        // echo Time::now('Asia/Ujung_Pandang');
        // echo Time::now('Asia/Ujung_Pandang');
        echo date("Y-m-d") . '<br>';
        var_dump($this->TrxPenjualanModel->autoKdTrxPenjualan());
    }

    //--------------------------------------------------------------------

}
