-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jan 2021 pada 05.27
-- Versi server: 10.4.16-MariaDB
-- Versi PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ajwa`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pembelian`
--

CREATE TABLE `detail_pembelian` (
  `id_dtl_pembelian` int(11) NOT NULL,
  `no_faktur` varchar(255) NOT NULL,
  `kd_obat` varchar(10) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL,
  `tgl_expired` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `detail_pembelian`
--
DELIMITER $$
CREATE TRIGGER `kurangStokBfUpdate` BEFORE UPDATE ON `detail_pembelian` FOR EACH ROW BEGIN
        UPDATE master_obat SET stok = stok - OLD.qty WHERE kd_obat = OLD.kd_obat;
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `kurang_stok_hapus` AFTER DELETE ON `detail_pembelian` FOR EACH ROW BEGIN
        UPDATE master_obat SET stok = stok - OLD.qty WHERE kd_obat = OLD.kd_obat;
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambahStokAfterUpdate` AFTER UPDATE ON `detail_pembelian` FOR EACH ROW BEGIN
        UPDATE master_obat SET stok = stok + NEW.qty WHERE kd_obat = NEW.kd_obat;
        END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tambah_stok` AFTER INSERT ON `detail_pembelian` FOR EACH ROW BEGIN
        UPDATE master_obat SET stok = stok + NEW.qty WHERE kd_obat = NEW.kd_obat;
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_trx_penjualan`
--

CREATE TABLE `detail_trx_penjualan` (
  `id_dtl_trx_jual` int(11) NOT NULL,
  `kd_transaksi` varchar(20) NOT NULL,
  `kd_obat` varchar(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `detail_trx_penjualan`
--
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

-- --------------------------------------------------------

--
-- Struktur dari tabel `faktur_pembelian`
--

CREATE TABLE `faktur_pembelian` (
  `no_faktur` varchar(255) NOT NULL,
  `id_suplier` int(11) NOT NULL,
  `tgl_beli` date NOT NULL,
  `total_trx` int(20) NOT NULL,
  `waktu_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `faktur_pembelian`
--
DELIMITER $$
CREATE TRIGGER `hapus_dtl_pembelian` BEFORE DELETE ON `faktur_pembelian` FOR EACH ROW BEGIN
        DELETE FROM detail_pembelian WHERE no_faktur= OLD.no_faktur; 
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_obat`
--

CREATE TABLE `master_obat` (
  `kd_obat` varchar(10) NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `kemasan` varchar(255) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `waktu_input` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `supplier`
--

CREATE TABLE `supplier` (
  `id_suplier` int(11) NOT NULL,
  `nama_supplier` varchar(50) NOT NULL,
  `hp` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transkasi_penjualan`
--

CREATE TABLE `transkasi_penjualan` (
  `kd_transaksi` varchar(20) NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_pembeli` varchar(50) NOT NULL,
  `alamat_pembeli` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `total_trx` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `waktu_trx` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Trigger `transkasi_penjualan`
--
DELIMITER $$
CREATE TRIGGER `hapus_trx_penjualan` BEFORE DELETE ON `transkasi_penjualan` FOR EACH ROW BEGIN
        DELETE FROM detail_trx_penjualan WHERE kd_transaksi = OLD.kd_transaksi; 
        END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(156) NOT NULL,
  `role_id` int(11) NOT NULL,
  `waktu_buat` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `password`, `role_id`, `waktu_buat`) VALUES
(5, 'admin', 'admin', '$2y$10$qW3942pbyoJev.HtGwH3H.SD34Be938HGoKYsGaZ4La84vrH8dNgu', 1, '2021-01-16 04:24:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'Karyawan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD PRIMARY KEY (`id_dtl_pembelian`),
  ADD KEY `no_faktur` (`no_faktur`);

--
-- Indeks untuk tabel `detail_trx_penjualan`
--
ALTER TABLE `detail_trx_penjualan`
  ADD PRIMARY KEY (`id_dtl_trx_jual`),
  ADD KEY `kd_transaksi` (`kd_transaksi`);

--
-- Indeks untuk tabel `faktur_pembelian`
--
ALTER TABLE `faktur_pembelian`
  ADD PRIMARY KEY (`no_faktur`),
  ADD KEY `id_suplier` (`id_suplier`);

--
-- Indeks untuk tabel `master_obat`
--
ALTER TABLE `master_obat`
  ADD PRIMARY KEY (`kd_obat`);

--
-- Indeks untuk tabel `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_suplier`);

--
-- Indeks untuk tabel `transkasi_penjualan`
--
ALTER TABLE `transkasi_penjualan`
  ADD PRIMARY KEY (`kd_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  MODIFY `id_dtl_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `detail_trx_penjualan`
--
ALTER TABLE `detail_trx_penjualan`
  MODIFY `id_dtl_trx_jual` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_suplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pembelian`
--
ALTER TABLE `detail_pembelian`
  ADD CONSTRAINT `detail_pembelian_ibfk_1` FOREIGN KEY (`no_faktur`) REFERENCES `faktur_pembelian` (`no_faktur`);

--
-- Ketidakleluasaan untuk tabel `detail_trx_penjualan`
--
ALTER TABLE `detail_trx_penjualan`
  ADD CONSTRAINT `detail_trx_penjualan_ibfk_1` FOREIGN KEY (`kd_transaksi`) REFERENCES `transkasi_penjualan` (`kd_transaksi`);

--
-- Ketidakleluasaan untuk tabel `faktur_pembelian`
--
ALTER TABLE `faktur_pembelian`
  ADD CONSTRAINT `faktur_pembelian_ibfk_1` FOREIGN KEY (`id_suplier`) REFERENCES `supplier` (`id_suplier`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
