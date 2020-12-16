<?php

namespace App\Models;

use CodeIgniter\Model;

class KasirModel extends Model
{
    public function getAllObat()
    {
        $data = $this->db->query('SELECT * FROM `master_obat`');
        if (!$data) {
            return $error = $this->db->error();
        }
        return $data;
    }


    public function dataObatByName($search)
    {
        $builder = $this->db->table('master_obat');
        $builder->select('kd_obat, nama_obat,stok');
        $builder->like('nama_obat', $search);
        $builder->orLike('kd_obat', $search);
        return $builder->get();
    }
    public function getObatById($id)
    {
        $builder = $this->db->table('master_obat');
        // $builder->select('kd_obat, nama_obat,stok');
        // $builder->where('kd_obat', $id);
        return $builder->getWhere(['kd_obat' => $id]);
    }

    public function tes()
    {
        return $this->setDate();
    }
}
