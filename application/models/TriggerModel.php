<?php

namespace App\Models;

use CodeIgniter\Model;

class TriggerModel extends Model
{
    public function createTiger()
    {
        $this->db->transStart();
        // trigger kurang stok sebelum update detail pembelian
        $this->db->query("DROP TRIGGER IF EXISTS kurangStokBfUpdate");
        $this->db->query("CREATE TRIGGER kurangStokBfUpdate 
        BEFORE UPDATE ON detail_pembelian
        FOR EACH ROW 
        BEGIN
        UPDATE master_obat SET stok = stok - OLD.qty WHERE kd_obat = OLD.kd_obat;
        END");
        // trigger TAMBAH stok SETELAH update detail pembelian
        $this->db->query("DROP TRIGGER IF EXISTS tambahStokAfterUpdate");
        $this->db->query("CREATE TRIGGER tambahStokAfterUpdate 
        AFTER UPDATE ON detail_pembelian
        FOR EACH ROW 
        BEGIN
        UPDATE master_obat SET stok = stok + NEW.qty WHERE kd_obat = NEW.kd_obat;
        END");
        $this->db->transComplete();
    }
    public function dropTrigger()
    {
        $this->db->transStart();
        $this->db->query("DROP TRIGGER IF EXISTS kurangStokBfUpdate");
        $this->db->query("DROP TRIGGER IF EXISTS tambahStokAfterUpdate");
        $this->db->transComplete();
    }
}
