<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_suplier';
    protected $allowedFields = ['nama_supplier', 'hp', 'alamat'];
    protected $column_order = array('id_suplier', 'nama_supplier', 'hp', 'alamat');
    protected $column_search = array('id_suplier', 'nama_supplier', 'hp', 'alamat');
    protected $order = array('id_suplier' => 'desc');
    protected $request;
    protected $dt;
    function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }
    // public function addSupplier($data)
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->insert($data);
    // }
    public function delete_by_id($id)
    {
        $this->dt->delete(['id_suplier' => $id]);
    }
    public function updateSupplier($kdSupplier, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_suplier', $kdSupplier);
        $builder->update($data);
    }

    public function geySupplierbyid($kdSupplier)
    {
        return $this->db->table($this->table)->getWhere(['id_suplier' => $kdSupplier]);
    }

    // server side datatable
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
}
