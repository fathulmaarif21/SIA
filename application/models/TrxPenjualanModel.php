<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class TrxPenjualanModel extends Model
{
    protected $table = "transkasi_penjualan";
    protected $column_order = array('kd_transaksi ', 'id_user', 'nama_pembeli', 'alamat_pembeli', 'note', 'total_trx', 'total_bayar', 'kembalian');
    protected $column_search = array('kd_transaksi ', 'id_user', 'nama_pembeli', 'alamat_pembeli', 'note', 'total_trx', 'total_bayar', 'kembalian');
    protected $order = array('kd_transaksi ' => 'desc');
    protected $request;
    protected $dt;
    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
        date_default_timezone_set('Asia/Ujung_Pandang');
    }

    private function _get_datatables_query()
    {
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                if (count($this->column_search) - 1 == $i)
                    $this->dt->groupEnd();
            }
            $i++;
        }

        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($this->request->getPost('length') != -1)
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        $query = $this->dt->get();
        return $query->getResult();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        return $this->dt->countAllResults();
    }
    public function count_all()
    {
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
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
    public function getDetailTrxPenjualanByTime($kd_trx)
    {
        $data = $this->db->query("SELECT a.kd_transaksi,b.nama_obat,a.qty,a.sub_total FROM detail_trx_penjualan a LEFT JOIN master_obat b on a.kd_obat = b.kd_obat WHERE a.kd_transaksi ='$kd_trx'");
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
        if (count($q->getResultArray()) > 0) {
            foreach ($q->getResult() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        } else {
            $kd = "001";
        }
        return date('dmy') . $kd;
    }
    public function addTrxPenjualan($allTrx, $detailTrx)
    {
        $this->db->transStart();
        $builder = $this->db->table('transkasi_penjualan');
        $cek = $builder->insert($allTrx);
        $detail = $this->db->table('detail_trx_penjualan');
        $detail->insertBatch($detailTrx);
        $this->db->transComplete();
        if ($cek) {
            return true;
        } else {
            return false;
        }
        // return $this->db->insertID();
    }
    public function delete_by_id($kd_transaksi)
    {
        $this->dt->delete(['kd_transaksi' => $kd_transaksi]);
    }
    public function sum_total_trx_hari_ini($tgl)
    {
        $query = $this->db->query("SELECT sum(total_trx) as total_pertgl FROM transkasi_penjualan where date(waktu_trx) = '$tgl'");
        return $query;
    }
    public function data_transaksi($tgl)
    {
        $query = $this->db->query("SELECT * FROM transkasi_penjualan where date(waktu_trx) = '$tgl'");
        return $query;
    }
}
