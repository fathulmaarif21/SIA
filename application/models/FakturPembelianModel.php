<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class FakturPembelianModel extends Model
{
    protected $table = "faktur_pembelian";
    protected $column_order = array('no_faktur', 'id_suplier', 'total_trx', 'tgl_beli', 'waktu_input');
    protected $column_search = array('no_faktur', 'id_suplier', 'total_trx', 'tgl_beli', 'waktu_input');
    protected $order = array('no_faktur' => 'desc');
    protected $request;
    protected $dt;
    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }
    public function addFakturPembelian($data, $detailTrx)
    {
        $this->db->transStart();
        $builder = $this->db->table('faktur_pembelian');
        $builder->insert($data);
        $detail = $this->db->table('detail_pembelian');
        $detail->insertBatch($detailTrx);
        $this->db->transComplete();

        // return $this->db->insertID();
    }
    public function getDetailFaktur($kdFaktur)
    {
        $data = $this->db->query("SELECT a.*,b.nama_obat FROM detail_pembelian a LEFT JOIN master_obat b ON a.kd_obat = b.kd_obat WHERE a.no_faktur ='$kdFaktur'");
        if (!$data) {
            return $error = $this->db->error();
        }
        return $data;
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
    public function delete_by_id($id)
    {
        $this->dt->delete(['no_faktur' => $id]);
    }
    public function deleteDtlFakturPembelian($id)
    {
        $builder = $this->db->table('detail_pembelian');
        $builder->delete(['id_dtl_pembelian' => $id]);
    }
}
