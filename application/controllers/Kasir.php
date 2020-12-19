<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ObatModel', 'dataObat');
        $this->load->model('TrxPenjualanModel');
        date_default_timezone_set('Asia/Ujung_Pandang');
    }

    public function index()
    {
        $data['title'] = 'Kasir';
        $this->load->view('kasir/index', $data);
    }

    public function getObat()
    {
        $search = $this->input->post('search');
        $data_trx = $this->dataObat->dataObatByName($search)->result();
        if ($data_trx) {
            foreach ($data_trx as $value) {
                $selectajax[] = array(
                    'id' => $value->kd_obat,
                    'text' => $value->nama_obat . ' | Kemasan :' . $value->kemasan . ' | Stok = ' . $value->stok,
                );
            }
            echo json_encode($selectajax);
        }
    }
    public function getObatById()
    {
        $id = $this->input->post('data');
        $value = $this->dataObat->getObatbyid($id);
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
        $tagihan_simpan = $this->input->post('tagihan_simpan');
        $bayar_simpan = $this->input->post('bayar_simpan');
        $kembalian_simpan = $this->input->post('kembalian_simpan');

        $arr_kd_obat = $this->input->post('arr_kd_obat');
        // $arr_stok = $this->input->post('arr_stok');
        $arr_qty = $this->input->post('arr_qty');
        $arr_subtotal = $this->input->post('arr_subtotal');

        $nama = $this->input->post('catatanPembeli')[3]['value'];
        $alamat = $this->input->post('catatanPembeli')[4]['value'];
        $note = $this->input->post('catatanPembeli')[5]['value'];


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
