<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ObatModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Ujung_Pandang');
    }
    var $table = 'master_obat';
    var $column_order = array('', 'kd_obat', 'nama_obat', 'satuan', 'kemasan', 'harga_jual', 'stok', 'waktu_input');
    var $column_search = array('kd_obat', 'nama_obat', 'satuan', 'kemasan', 'harga_jual', 'stok', 'waktu_input');
    var $order = array('kd_obat' => 'desc');

    public function getAllObat()
    {
        $this->db->from($this->table);
        $this->db->select('*');
        return $this->db->get();
    }
    public function dataObatByName($search)
    {
        $this->db->from($this->table);
        $this->db->select('*');
        $this->db->like('nama_obat', $search);
        $this->db->or_Like('kd_obat', $search);
        return $this->db->get();
    }
    function autoKdObat()
    {
        $q = $this->db->query("SELECT MAX(RIGHT(kd_obat,4)) AS kd_obat FROM master_obat");
        $kd = "";
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $k) {
                $tmp = ((int)$k->kd_obat) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        } else {
            $kd = "0001";
        }
        return $kd;
    }
    function addObat($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    function updateObat($kdObat, $data)
    {
        // $builder = $this->db->table($this->table);
        // $builder->where('kd_obat', $kdObat);
        // $builder->update($data);

        $this->db->update($this->table, $data, ['kd_obat' => $kdObat]);
        return $this->db->affected_rows();
    }

    function getObatbyid($kdObat)
    {
        $this->db->from($this->table);
        $this->db->where('kd_obat', $kdObat);
        $query = $this->db->get();
        return $query->row();
    }

    function getNofaktur($kdObat)
    {
        $query =  $this->db->query("SELECT b.no_faktur,b.tgl_expired from master_obat a left JOIN detail_pembelian b on a.kd_obat= b.kd_obat  where a.kd_obat='$kdObat'");
        return $query;
    }

    public function obatById($kdObat)
    {
        $this->db->from($this->table);
        $this->db->where('kd_obat', $kdObat);
        $query = $this->db->get();
        return $query->row();
    }
    function delete_by_id($id)
    {
        $this->db->where('kd_obat', $id);
        $this->db->delete($this->table);
    }

    //  function update($where, $data)
    // {
    //     $this->db->update($this->table, $data, $where);
    //     return $this->db->affected_rows();
    // }


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

    // end datatable

    function stok_kosong()
    {
        return  $this->db->query("SELECT * FROM master_obat where stok <= 0");
    }
    function get_obat_expired()
    {
        $timenow = date('Y-m-d');

        $plus3M = date('Y-m-d', strtotime("+2 months", strtotime($timenow)));

        // return  $this->db->query("SELECT a.*,b.nama_obat,b.stok FROM detail_pembelian a left join master_obat b ON a.kd_obat =b.kd_obat where tgl_expired BETWEEN '$timenow' AND '$plus3M'");
        return  $this->db->query("SELECT a.*,b.nama_obat,b.stok, c.id FROM tbl_exp_date c left join detail_pembelian a on c.id_dtl_pembelian = a.id_dtl_pembelian left join master_obat b ON a.kd_obat =b.kd_obat where a.tgl_expired <= '$plus3M'");
    }


    public function updateStokByObat($kdObat, $stok)
    {

        $this->db->update($this->table, $stok, ['kd_obat' => $kdObat]);
        return $this->db->affected_rows();
    }
}
