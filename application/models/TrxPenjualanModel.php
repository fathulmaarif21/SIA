<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TrxPenjualanModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Ujung_Pandang');
    }
    var $table = "transkasi_penjualan";
    var $column_order = array('kd_transaksi ', 'id_user', 'nama_pembeli', 'alamat_pembeli', 'note', 'total_trx', 'total_bayar', 'kembalian', 'waktu_trx');
    var $column_search = array('kd_transaksi ', 'id_user', 'nama_pembeli', 'alamat_pembeli', 'note', 'total_trx', 'total_bayar', 'kembalian', 'waktu_trx');
    var $order = array('waktu_trx ' => 'desc');


    private function _get_datatables_query()
    {

        $this->db->from($this->table);
        ## Date search value
        // $searchByFromdate =  $_POST['searchByFromdate'];
        // $searchByTodate =  $_POST['searchByFromdate'];
        $searchByFromdate = (isset($_POST['searchByFromdate'])) ? $_POST['searchByFromdate'] : '';
        $searchByTodate = (isset($_POST['searchByTodate'])) ? $_POST['searchByTodate'] : '';
        // Date filter
        if ($searchByFromdate != '' && $searchByTodate != '') {
            // $this->db->where("date(waktu_trx) BETWEEN $searchByFromdate AND $searchByTodate");
            $this->db->where("date(waktu_trx)  BETWEEN ' " . date('Y-m-d', strtotime(str_replace('/', '-', $searchByFromdate))) . "'  AND  '" . date('Y-m-d', strtotime(str_replace('/', '-', $searchByTodate))) . "'");
        }

        $i = 0;

        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        } else {
            $this->db->order_by('waktu_trx', 'DESC'); // saya add sneiri untuk order default
        }
    }

    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }




    // protected $table =
    public function getTrxPenjualan()
    {
        $data = $this->db->query('SELECT * FROM `transkasi_penjualan`');
        if (!$data) {
            return $error = $this->db->error();
        }
        return $data;
    }
    public function getTrxPenjualanByTime()
    {
        $currendate = date('Y-m-d');
        $data = $this->db->query("SELECT * FROM `transkasi_penjualan` where DATE(waktu_trx)='$currendate' order by waktu_trx desc");
        if (!$data) {
            return $error = $this->db->error();
        }
        return $data;
    }
    public function getDetailTrxPenjualanByID($kd_trx)
    {
        $data = $this->db->query("SELECT a.*,b.* FROM detail_trx_penjualan a LEFT JOIN master_obat b on a.kd_obat = b.kd_obat WHERE a.kd_transaksi ='$kd_trx'");
        if (!$data) {
            return $error = $this->db->error();
        }
        return $data;
    }



    // AUTO KODE TRANSAKSI
    function autoKdTrxPenjualan()
    {
        $currendate = date('Y-m-d');
        $q = $this->db->query("SELECT MAX(RIGHT(kd_transaksi,3)) AS kd_max FROM transkasi_penjualan WHERE DATE(waktu_trx)='$currendate'");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        return date('dmy') . $kd;
    }

    public function delete_by_id($kd_transaksi)
    {
        $this->db->where('kd_transaksi', $kd_transaksi);
        $this->db->delete($this->table);
    }
    public function sum_total_trx_hari_ini($tgl)
    {
        $query = $this->db->query("SELECT sum(total_trx) as total_pertgl FROM transkasi_penjualan where date(waktu_trx) = '$tgl'");
        return $query;
    }
    public function sum_total_trx_bulan($tgl)
    {
        $query = $this->db->query("SELECT sum(total_trx) as total_pertgl FROM transkasi_penjualan where EXTRACT(YEAR_MONTH FROM waktu_trx)='$tgl'");
        return $query;
    }
    public function sum_total_trx_byDate($searchByFromdate, $searchByTodate)
    {
        $start = date('Y-m-d', strtotime(str_replace('/', '-', $searchByFromdate)));
        $end = date('Y-m-d', strtotime(str_replace('/', '-', $searchByTodate)));
        $query = $this->db->query("SELECT sum(total_trx) as total_pertgl FROM transkasi_penjualan where date(waktu_trx) BETWEEN '$start' AND '$end'");
        return $query;
    }
    public function data_transaksi($tgl)
    {
        $query = $this->db->query("SELECT * FROM transkasi_penjualan where date(waktu_trx) = '$tgl'");
        return $query;
    }
    public function addTrxPenjualan($allTrx, $detailTrx)
    {
        $this->db->trans_start();
        $cek = $this->db->insert($this->table, $allTrx);
        $this->db->insert_batch('detail_trx_penjualan', $detailTrx);
        $this->db->trans_complete();
        if ($cek) {
            return true;
        } else {
            return false;
        }
        // return $this->db->insertID();
    }
    public function qtyDetailJual($kdObat)
    {
        $data = $this->db->query("SELECT SUM(qty) as qty FROM detail_trx_penjualan WHERE kd_obat ='$kdObat'");
        if (!$data) {
            return $error = $this->db->error();
        }
        return $data->row();
    }
    public function getTrxBetDate($start, $end)
    {
        return $this->db->query("SELECT * FROM `transkasi_penjualan` where date(waktu_trx) BETWEEN '$start' and '$end'");
    }
}
