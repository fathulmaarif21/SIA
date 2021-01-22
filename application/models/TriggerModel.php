<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TriggerModel extends CI_Model
{
    public function createTiger()
    {
        // detail Pembelian
        $this->db->trans_start();
        // trigger kurang stok sebelum update detail pembelian
        $this->db->query("CREATE TRIGGER IF NOT EXISTS kurangStokBfUpdate 
        BEFORE UPDATE ON detail_pembelian
        FOR EACH ROW 
        BEGIN
        UPDATE master_obat SET stok = stok - OLD.qty WHERE kd_obat = OLD.kd_obat;
        END");
        // trigger TAMBAH stok SETELAH update detail pembelian
        // $this->db->query("DROP TRIGGER IF EXISTS tambahStokAfterUpdate");
        $this->db->query("CREATE TRIGGER IF NOT EXISTS tambahStokAfterUpdate 
        AFTER UPDATE ON detail_pembelian
        FOR EACH ROW 
        BEGIN
        UPDATE master_obat SET stok = stok + NEW.qty WHERE kd_obat = NEW.kd_obat;
        END");

        // TAMBAH STOK OBAT SETELAH INSERT
        $this->db->query("CREATE TRIGGER IF NOT EXISTS tambah_stok 
        AFTER INSERT ON detail_pembelian
        FOR EACH ROW 
        BEGIN
        UPDATE master_obat SET stok = stok + NEW.qty WHERE kd_obat = NEW.kd_obat;
        END");

        // kURANG STOK OBAT SETELAH DELETE
        $this->db->query("CREATE TRIGGER IF NOT EXISTS kurang_stok_hapus 
        AFTER DELETE ON detail_pembelian
        FOR EACH ROW 
        BEGIN
        UPDATE master_obat SET stok = stok - OLD.qty WHERE kd_obat = OLD.kd_obat;
        END");

        // TABLE DETAIL TRANSAKSI PENJUALAN
        // TAMBAH STOK OBAT SETELAH DELETE
        $this->db->query("CREATE TRIGGER IF NOT EXISTS hapus_trx_restorestok 
        AFTER DELETE ON detail_trx_penjualan
        FOR EACH ROW 
        BEGIN
        UPDATE master_obat SET stok = stok + OLD.qty WHERE kd_obat = OLD.kd_obat;
        END");
        // kURANG STOK OBAT SETELAH INSERT
        $this->db->query("CREATE TRIGGER IF NOT EXISTS pengurangan_stok 
        AFTER INSERT ON detail_trx_penjualan
        FOR EACH ROW 
        BEGIN
        UPDATE master_obat SET stok = stok - NEW.qty WHERE kd_obat = NEW.kd_obat;
        END");

        // TABLE FAKTUR PEMBELIAN
        // HAPUS DETAIL PEMBELIAN
        $this->db->query("CREATE TRIGGER IF NOT EXISTS hapus_dtl_pembelian 
        BEFORE DELETE ON faktur_pembelian
        FOR EACH ROW 
        BEGIN
        DELETE FROM detail_pembelian WHERE no_faktur= OLD.no_faktur; 
        END");

        // TABLE TRANSKASI PENJUALAN
        // HAPUS SETAIL TRANSKASI
        $this->db->query("CREATE TRIGGER IF NOT EXISTS hapus_trx_penjualan 
        BEFORE DELETE ON transkasi_penjualan
        FOR EACH ROW 
        BEGIN
        DELETE FROM detail_trx_penjualan WHERE kd_transaksi = OLD.kd_transaksi; 
        END");
        $this->db->trans_complete();
        // end detail pembelian
    }
    public function dropTrigger()
    {
        $this->db->trans_start();
        // TRIGGER DI DETAIL PEMBELIAN
        $this->db->query("DROP TRIGGER IF EXISTS kurangStokBfUpdate");
        $this->db->query("DROP TRIGGER IF EXISTS tambahStokAfterUpdate");
        $this->db->query("DROP TRIGGER IF EXISTS tambah_stok");
        $this->db->query("DROP TRIGGER IF EXISTS kurang_stok_hapus");

        // TRIGGER DI DETAIL TRANSAKSI PENJUALAN
        $this->db->query("DROP TRIGGER IF EXISTS hapus_trx_restorestok");
        $this->db->query("DROP TRIGGER IF EXISTS pengurangan_stok");

        // FAKTUR PEMBELIAN
        $this->db->query("DROP TRIGGER IF EXISTS hapus_dtl_pembelian");

        // TABEL TRANSAKSI PENJUALAN
        $this->db->query("DROP TRIGGER IF EXISTS hapus_trx_penjualan");

        $this->db->trans_complete();
    }

    public function tablecreate()
    {
        $this->db->query("ALTER TABLE master_obat ADD prinsipal VARCHAR(100) AFTER kemasan");
        $this->db->query("ALTER TABLE detail_pembelian ADD no_batch  VARCHAR(100) AFTER kd_obat");
    }
}
