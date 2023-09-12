

DELIMITER $$
CREATE TRIGGER `insert_tbl_exp` AFTER INSERT ON `detail_pembelian` FOR EACH ROW BEGIN
INSERT INTO tbl_exp_date(id_dtl_pembelian)
VALUES
    (NEW.id_dtl_pembelian );
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_stok` AFTER INSERT ON `detail_pembelian` FOR EACH ROW BEGIN
        UPDATE master_obat SET stok = stok + NEW.qty WHERE kd_obat = NEW.kd_obat;
        END
$$
DELIMITER ;    

DELIMITER $$
CREATE TRIGGER `hapus_trx_restorestok` AFTER DELETE ON `detail_trx_penjualan` FOR EACH ROW BEGIN
        UPDATE master_obat SET stok = stok + OLD.qty WHERE kd_obat = OLD.kd_obat;
        END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `pengurangan_stok` AFTER INSERT ON `detail_trx_penjualan` FOR EACH ROW BEGIN
        UPDATE master_obat SET stok = stok - NEW.qty WHERE kd_obat = NEW.kd_obat;
        END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `hapus_dtl_pembelian` BEFORE DELETE ON `faktur_pembelian` FOR EACH ROW BEGIN
        DELETE FROM detail_pembelian WHERE no_faktur= OLD.no_faktur; 
        END
$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER `hapus_trx_penjualan` BEFORE DELETE ON `transkasi_penjualan` FOR EACH ROW BEGIN
        DELETE FROM detail_trx_penjualan WHERE kd_transaksi = OLD.kd_transaksi; 
        END
$$
DELIMITER ;    