<?php

defined('BASEPATH') or exit('No direct script access allowed');

class FakturPembelianModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Ujung_Pandang');
    }
    var $table = "faktur_pembelian";
    var $column_order = array('no_faktur', 'faktur_pembelian.id_suplier', 'total_trx', 'tgl_beli', 'jt_tempo', 'waktu_input', 'supplier.nama_supplier');
    var $column_search = array('no_faktur', 'faktur_pembelian.id_suplier', 'total_trx', 'tgl_beli', 'waktu_input', 'supplier.nama_supplier');
    var $order = array('no_faktur' => 'desc');


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

        $this->db->from($this->table);
        $this->db->join('supplier', 'supplier.id_suplier = faktur_pembelian.id_suplier', 'left');

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


    public function delete_by_id($id)
    {
        $this->db->where('no_faktur', $id);
        $this->db->delete($this->table);
    }
    public function deleteDtlFakturPembelian($id)
    {
        $this->db->where('id_dtl_pembelian', $id);
        $this->db->delete('detail_pembelian');
    }
    public function addFakturPembelian($data, $detailTrx)
    {
        $this->db->trans_start();
        $this->db->insert($this->table, $data);
        $this->db->insert_batch('detail_pembelian', $detailTrx);
        $this->db->trans_complete();

        // return $this->db->insertID();
    }
    public function addFakturPembelian2($detailTrx)
    {
        $this->db->trans_start();
        $this->db->insert('detail_pembelian', $detailTrx);
        $this->db->trans_complete();

        // return $this->db->insertID();
    }
    public function qtyObatFaktur($kdObat)
    {
        $data = $this->db->query("SELECT SUM(qty) as qty FROM detail_pembelian WHERE kd_obat ='$kdObat'");
        if (!$data) {
            return $error = $this->db->error();
        }
        return $data->row();
    }

    public function getFakturBetDate($start, $end)
    {
        return $this->db->query("SELECT a.*, b.nama_supplier FROM  faktur_pembelian a LEFT JOIN supplier b ON a.id_suplier = b.id_suplier where a.tgl_beli BETWEEN '$start' and '$end'");
    }
}
