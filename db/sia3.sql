-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Des 2020 pada 12.12
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
-- Database: `sia3`
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
-- Dumping data untuk tabel `detail_pembelian`
--

INSERT INTO `detail_pembelian` (`id_dtl_pembelian`, `no_faktur`, `kd_obat`, `harga_beli`, `qty`, `sub_total`, `tgl_expired`) VALUES
(5, '2147483647', '1012O0003', 20000, 4, 80, '2020-12-31'),
(6, '232131231hbndsda', '1012O0003', 1000, 3, 3000, '2020-10-23'),
(7, '232131231hbndsda', '1012O0004', 15000, 5, 75000, '2021-04-22'),
(9, '987787892377321', '1712O0007', 5000, 5, 25000, '2020-02-12');

--
-- Trigger `detail_pembelian`
--
DELIMITER $$
CREATE TRIGGER `kurang_stok_hapus` AFTER DELETE ON `detail_pembelian` FOR EACH ROW BEGIN
 UPDATE master_obat SET stok = stok - OLD.qty WHERE kd_obat = OLD.kd_obat;
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
-- Dumping data untuk tabel `detail_trx_penjualan`
--

INSERT INTO `detail_trx_penjualan` (`id_dtl_trx_jual`, `kd_transaksi`, `kd_obat`, `qty`, `sub_total`) VALUES
(20, '291120003', 'B00001', 1, 5000),
(21, '291120003', 'B00002', 2, 15000),
(22, '291120004', 'B00002', 1, 7500),
(23, '291120005', 'B00001', 1, 5000),
(24, '291120006', 'B00002', 1, 7500),
(25, '291120006', 'B00001', 1, 5000),
(26, '291120007', 'B00002', 1, 7500),
(27, '291120008', 'B00001', 1, 5000),
(28, '291120009', 'B00002', 1, 7500),
(29, '291120009', 'B00001', 4, 20000),
(30, '301120001', 'B00002', 1, 7500),
(31, '301120002', 'B00001', 1, 5000),
(32, '301120002', 'B00002', 1, 7500),
(34, '301120004', 'B00001', 1, 5000),
(35, '301120005', 'B00001', 1, 5000),
(36, '301120006', 'B00001', 1, 5000),
(40, '161220001', '1012O0003', 2, 4000),
(41, '161220002', '1012O0004', 3, 22500),
(42, '161220003', 'B00002', 8, 60400),
(43, '161220004', 'B00001', 6, 30000),
(44, '161220004', 'B00002', 7, 52850),
(45, '171220001', 'B00002', 7, 52850),
(46, '171220002', '1012O0004', 2, 15000);

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
-- Dumping data untuk tabel `faktur_pembelian`
--

INSERT INTO `faktur_pembelian` (`no_faktur`, `id_suplier`, `tgl_beli`, `total_trx`, `waktu_input`) VALUES
('2147483647', 1, '2020-12-10', 80000, '2020-12-10 15:14:23'),
('232131231hbndsda', 7, '2020-12-16', 78000, '2020-12-15 17:22:20'),
('987787892377321', 8, '2020-12-22', 33000, '2020-12-16 16:08:58');

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

--
-- Dumping data untuk tabel `master_obat`
--

INSERT INTO `master_obat` (`kd_obat`, `nama_obat`, `kemasan`, `harga_jual`, `stok`, `waktu_input`) VALUES
('1012O0003', 'Vitamin', '', 2000, 5, '2020-12-15 17:22:20'),
('1012O0004', 'Minyak Gosok', '', 7500, 0, '2020-12-16 16:28:47'),
('1712O0006', 'obat mag', '', 30000, 0, '2020-12-16 16:09:24'),
('1712O0007', 'obat sakit perut', '', 2000, 5, '2020-12-16 16:08:58'),
('1912O0008', 'Obat sakit Perut', 'box', 20000, 0, '2020-12-19 07:13:16'),
('B00001', 'MINYAK KAYU PUTIH', '', 5000, 22, '2020-12-16 15:34:09'),
('B00002', 'Laserin 30 ml', 'satuan', 7550, 33, '2020-12-19 07:13:59');

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

--
-- Dumping data untuk tabel `supplier`
--

INSERT INTO `supplier` (`id_suplier`, `nama_supplier`, `hp`, `alamat`) VALUES
(1, 'Kima Farma', '9872888', 'jalan nusa indah'),
(2, 'Pabrik Obat', '987627282', 'jalan kharisma 3 no a.50\r\n'),
(7, 'Kima Farma 14', '32313', 'jhdjasda'),
(8, 'pt obat sejahtera', '111123213213', 'jalan mantandu'),
(9, 'pt kakao', '9882992929', '87282929');

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
-- Dumping data untuk tabel `transkasi_penjualan`
--

INSERT INTO `transkasi_penjualan` (`kd_transaksi`, `id_user`, `nama_pembeli`, `alamat_pembeli`, `note`, `total_trx`, `total_bayar`, `kembalian`, `waktu_trx`) VALUES
('161220001', 1, 'fathul', 'maratandi', 'nda ad', 4000, 5000, 1000, '2020-12-15 16:44:42'),
('161220002', 1, '', '', '', 22500, 30000, 7500, '2020-12-15 16:52:47'),
('161220003', 1, 'laila', 'martandu', 'kharisma 3', 60400, 70000, 9600, '2020-12-16 10:32:49'),
('161220004', 1, 'amman', 'kampus', '3 kali seminggu', 82850, 100000, 17150, '2020-12-16 15:34:09'),
('171220001', 1, '', '', '', 52850, 60000, 7150, '2020-12-16 16:27:59'),
('171220002', 1, 'Faisal Ganteng', 'tamboakboyo', '', 15000, 20000, 5000, '2020-12-16 16:28:47'),
('291120003', 1, '', '', '', 20000, 20000, 0, '2020-11-29 13:26:48'),
('291120004', 1, '', '', '', 7500, 10000, 2500, '2020-11-29 13:32:11'),
('291120005', 1, '', '', '', 5000, 5000, 0, '2020-11-29 13:33:01'),
('291120006', 1, '', '', '', 12500, 13000, 500, '2020-11-29 15:40:05'),
('291120007', 1, '', '', '', 7500, 10000, 2500, '2020-11-29 15:42:33'),
('291120008', 1, '', '', '', 5000, 10000, 5000, '2020-11-29 15:46:40'),
('291120009', 1, '', '', '', 27500, 30000, 2500, '2020-11-29 15:48:04'),
('301120001', 1, '', '', '', 7500, 10000, 2500, '2020-11-29 16:04:11'),
('301120002', 1, '', '', '', 12500, 100000, 87500, '2020-11-29 16:04:40'),
('301120004', 1, '', '', '', 5000, 5000, 0, '2020-11-29 16:06:55'),
('301120005', 1, '', '', '', 5000, 10000, 5000, '2020-11-29 16:08:30'),
('301120006', 1, '', '', '', 5000, 6000, 1000, '2020-11-29 16:13:18');

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
(1, 'fathul', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, '2020-12-15 09:43:23'),
(2, 'karyawan', 'user', 'user', 1, '2020-12-19 09:50:52'),
(3, 'fathul', 'fathul', '$2y$10$ZZCnIqrGOwQTPTA7SXFw5OEClhtQKNttJjhhYC3lOFkw45Vg5dCsG', 1, '2020-12-15 09:49:14'),
(4, 'bayu', 'bayu', '$2y$10$YIiSJx6xo8Ab1CuDdmH3J.MqsWc2Z59FhXtDXvOkZNy0.xmXgpUcK', 1, '2020-12-19 11:04:07');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
