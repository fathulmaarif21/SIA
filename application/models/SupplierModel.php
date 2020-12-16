<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SupplierModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Ujung_Pandang');
    }

    var $table = 'supplier';
    var $allowedFields = ['nama_supplier', 'hp', 'alamat'];
    var $column_order = array('id_suplier', 'nama_supplier', 'hp', 'alamat');
    var $column_search = array('id_suplier', 'nama_supplier', 'hp', 'alamat');
    var $order = array('id_suplier' => 'desc');


    // public function addSupplier($data)
    // {
    //     $builder = $this->db->table($this->table);
    //     $builder->insert($data);
    // }
    public function getAllsupp()
    {
        return $this->db->get($this->table);
    }
    public function delete_by_id($id)
    {
        $this->db->where('id_suplier', $id);
        $this->db->delete($this->table);
    }
    public function updateSupplier($kdSupplier, $data)
    {

        $this->db->update($this->table, $data, ['id_suplier' => $kdSupplier]);
        return $this->db->affected_rows();
    }

    public function geySupplierbyid($kdSupplier)
    {

        $this->db->from($this->table);
        $this->db->where('id_suplier', $kdSupplier);
        return $this->db->get();
    }

    public function addSupplier($data)
    {
        $this->db->insert($this->table, $data);
    }

    // server side datatable
    private function _get_datatables_query()
    {

        $this->db->from($this->table);

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
}
