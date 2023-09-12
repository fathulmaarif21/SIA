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

    public function tes()
    {

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.bi.go.id/bi/antasena/antasena/v1/validasi/tandaTerima?idPelapor=135001000&kelompokInformasi=sozimhoegmi&periodeLaporan=vozukeberubfodoc&periodeData=lecolojoakevo",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "accept: application/json",
                "authorization: Bearer AAIgYzFiNDM1Y2YwNzJlMTRmMmM5ZWE0Yzc2NjcwOWM4MjZwsIJdgyy42FEsvv0rKuq6FUkcWecvxXFKVszy9hL1CrpXlfkhostA0hPC4DEFA5IFDBl95o4v_RhP6OeJkIgn0Kskyovgit6amq7J0ykzVzoJ4-llgpKlf9z7Waie6c5rhntiFfKG4TpMEyPIczH9EkfL_V9tlEe1kyABQ92b6Q",
                "x-bi-client-id: c1b435cf072e14f2c9ea4c766709c826"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }


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
        $data = $this->TrxPenjualanModel->getDetailTrxPenjualanByID($kd_trx)->result();
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
            $row[] = $no;
            $row[] = $list->kd_obat;
            $row[] = $list->satuan;
            $row[] = $list->nama_obat;
            $row[] = $list->kemasan;
            $row[] = rupiah($list->harga_jual);
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
        $sumtotal = $this->TrxPenjualanModel->sum_total_trx_hari_ini(date(date('Y-m-d')))->row();
        $data = [];
        $total = [];
        $total[] = '';
        $total[] = '';
        $total[] = '';
        $total[] = '<b>Total : </b>';
        $total[] = $sumtotal->total_pertgl == null ? '<b>Rp. 0 </b>' : '<b>' . rupiah($sumtotal->total_pertgl) . '</b>';
        $total[] = '';
        $total[] = '';
        $total[] = '';
        $data[] = $total;
        $lists = $this->TrxPenjualanModel->getTrxPenjualanByTime()->result();
        foreach ($lists as $list) {
            $row = [];
            $row[] = $list->kd_transaksi;
            $row[] = $list->nama_pembeli;
            $row[] = $list->alamat_pembeli;
            $row[] = $list->note;
            $row[] = rupiah($list->total_trx);
            $row[] = rupiah($list->total_bayar);
            $row[] = rupiah($list->kembalian);
            //add html for action
            // onclick="detail_trx(' . "'" . $value->kd_transaksi . "'" . ')"
            $row[] = '<a class="btn btn-sm btn-warning" href="javascript:void(0)" onclick="detail_trx(' . "'" . $list->kd_transaksi . "'" . ')" title="detail" ><i class="fas fa-info"></i> Detail</a>
            <a class="btn btn-sm btn-success" href="javascript:void(0)"  onclick="CetakNota(this)" 
            data-id="' . $list->kd_transaksi . '"
            data-nama="' . $list->nama_pembeli . '"
            data-alamat="' . $list->alamat_pembeli . '"
            data-note="' . $list->note . '"
            data-tot_trx="' . rupiah($list->total_trx) . '"
            data-tot_bayar="' . rupiah($list->total_bayar) . '"
            data-kembali="' . rupiah($list->kembalian) . '"
            data-tgl_nota="' . date('d/m/Y', strtotime($list->waktu_trx)) . '"
            title="detail" ><i class="fas fa-print"></i> Nota</a>
            
            ';
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
