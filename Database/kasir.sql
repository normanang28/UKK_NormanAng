-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 29, 2024 at 04:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(4) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga_barang` text NOT NULL,
  `jumlah` text NOT NULL,
  `maker_barang` int(4) NOT NULL,
  `tanggal_barang` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama_barang`, `harga_barang`, `jumlah`, `maker_barang`, `tanggal_barang`) VALUES
(5, 'kemeja hitam', '280000', '1', 2, '2024-02-29 08:05:39'),
(6, 'kemeja putih', '400000', '5', 2, '2024-02-29 08:09:41'),
(7, 'kaos putih', '250000', '0', 2, '2024-02-29 08:09:54'),
(8, 'celana kain', '280000', '0', 2, '2024-02-29 08:10:06'),
(9, 'dasi kantor (PAKET)', '1500000', '0', 2, '2024-02-29 08:46:00'),
(10, 'koas supreme', '500000', '2', 2, '2024-02-29 08:46:25'),
(11, 'kaos berkera (merah)', '120000', '0', 2, '2024-02-29 08:46:47'),
(12, 'kemeja putih (lengan pendek)', '235000', '6', 2, '2024-02-29 08:47:16'),
(13, 'hoodie', '250000', '0', 2, '2024-02-29 08:47:44'),
(14, 'switter', '250000', '10', 2, '2024-02-29 08:47:54');

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluar`
--

CREATE TABLE `barang_keluar` (
  `id_penjualan_barang` int(4) NOT NULL,
  `id_barang_pp` int(4) NOT NULL,
  `qty` text NOT NULL,
  `dibayar` text NOT NULL,
  `kembalian` text NOT NULL,
  `total_harga` text NOT NULL,
  `maker_pp` int(4) NOT NULL,
  `tanggal_pp` datetime NOT NULL DEFAULT current_timestamp(),
  `tanggal_laporan` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang_keluar`
--

INSERT INTO `barang_keluar` (`id_penjualan_barang`, `id_barang_pp`, `qty`, `dibayar`, `kembalian`, `total_harga`, `maker_pp`, `tanggal_pp`, `tanggal_laporan`) VALUES
(6, 5, '1', '280000', '0', '280000', 2, '2024-02-29 08:13:54', '2024-02-29'),
(7, 5, '1', '280000', '0', '280000', 2, '2024-02-29 08:24:41', '2024-02-29'),
(10, 6, '1', '400000', '0', '400000', 2, '2024-02-29 09:28:53', '2024-02-29');

--
-- Triggers `barang_keluar`
--
DELIMITER $$
CREATE TRIGGER `Hapus_Penjualann` AFTER DELETE ON `barang_keluar` FOR EACH ROW update barang set jumlah = jumlah + old.qty WHERE id_barang = old.id_barang_pp
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `id_log` int(4) NOT NULL,
  `id_user_log` int(4) NOT NULL,
  `aktifitas` text NOT NULL,
  `waktu` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `log_activity`
--

INSERT INTO `log_activity` (`id_log`, `id_user_log`, `aktifitas`, `waktu`) VALUES
(1, 2, 'Menambah Data Barang test', '2024-02-29 09:19:51'),
(2, 2, 'Mengedit Data Barang dasi kantor (FULL PAKET) Dengan ID 9', '2024-02-29 09:21:47'),
(3, 2, 'Menambah Data Pendataan Barang dengan ID barang 5', '2024-02-29 09:23:21'),
(4, 2, 'Menghapus Data Pendataan Barang dengan ID 7', '2024-02-29 09:24:13'),
(5, 2, 'Menambah Data Penjualan Barang/Kasir Dengan ID barang 6', '2024-02-29 09:26:21'),
(6, 2, 'Menambah Data Penjualan Barang/Kasir Dengan ID barang 6', '2024-02-29 09:28:53'),
(7, 2, 'Menghapus Data Penjualan Barang/Kasir Dengan ID 11', '2024-02-29 09:29:20'),
(8, 2, 'Clear Data Penjualan Barang/Kasir Dengan ID ', '2024-02-29 09:29:33'),
(9, 2, 'Clear Data Penjualan Barang/Kasir Dengan ID ', '2024-02-29 09:30:25'),
(10, 2, 'Clear Data Penjualan Barang/Kasir ', '2024-02-29 09:30:43'),
(11, 2, 'menampilkan laporan penjualan dalam format print', '2024-02-29 09:32:47'),
(12, 2, 'menampilkan laporan penjualan dalam format print', '2024-02-29 09:32:54'),
(13, 2, 'menampilkan laporan penjualan dalam format print', '2024-02-29 09:33:26'),
(14, 2, 'menampilkan laporan penjualan dalam format PDF', '2024-02-29 09:33:51'),
(15, 2, 'menampilkan laporan penjualan dalam format excel', '2024-02-29 09:33:54'),
(16, 2, 'LogOut dengan ID 2', '2024-02-29 09:34:59'),
(17, 2, 'Mengganti Password pada dengan ID akun 2', '2024-02-29 09:36:05'),
(18, 2, 'Mereset password pada ID Array', '2024-02-29 09:38:02'),
(19, 2, 'Mereset password dengan ID 5', '2024-02-29 09:38:23'),
(20, 2, 'mengedit data petugas dengan nama bong marvinn', '2024-02-29 09:40:07'),
(21, 2, 'menambah data petugas dengan nama 1', '2024-02-29 09:40:48'),
(22, 2, 'Menghapus data petugas dengan ID 6', '2024-02-29 09:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `pendataan_barang`
--

CREATE TABLE `pendataan_barang` (
  `id_pendataan_barang` int(4) NOT NULL,
  `id_barang_pb` int(4) NOT NULL,
  `stok` text NOT NULL,
  `maker_pb` int(4) NOT NULL,
  `tanggal_pb` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pendataan_barang`
--

INSERT INTO `pendataan_barang` (`id_pendataan_barang`, `id_barang_pb`, `stok`, `maker_pb`, `tanggal_pb`) VALUES
(5, 5, '3', 2, '2024-02-28 14:51:29'),
(6, 6, '5', 2, '2024-02-29 08:48:05'),
(8, 10, '2', 2, '2024-02-29 08:48:15'),
(9, 12, '6', 2, '2024-02-29 08:48:20'),
(10, 14, '10', 2, '2024-02-29 08:48:24');

--
-- Triggers `pendataan_barang`
--
DELIMITER $$
CREATE TRIGGER `Hapus_Pendataan` AFTER DELETE ON `pendataan_barang` FOR EACH ROW update barang set jumlah = jumlah-old.stok WHERE id_barang = old.id_barang_pb
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Pendataan_Barang` AFTER INSERT ON `pendataan_barang` FOR EACH ROW UPDATE barang SET jumlah = jumlah + new.stok WHERE id_barang = new.id_barang_pb
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan_barang`
--

CREATE TABLE `penjualan_barang` (
  `id_penjualan_barang` int(4) NOT NULL,
  `id_barang_pp` int(4) NOT NULL,
  `qty` text NOT NULL,
  `dibayar` text NOT NULL,
  `kembalian` text NOT NULL,
  `total_harga` text NOT NULL,
  `maker_pp` int(4) NOT NULL,
  `tanggal_pp` datetime NOT NULL DEFAULT current_timestamp(),
  `tanggal_laporan` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `penjualan_barang`
--
DELIMITER $$
CREATE TRIGGER `Penjualan_Barang` AFTER INSERT ON `penjualan_barang` FOR EACH ROW UPDATE barang SET jumlah = jumlah - new.qty WHERE id_barang = new.id_barang_pp
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(4) NOT NULL,
  `id_user_petugas` int(4) NOT NULL,
  `nama_petugas` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(13) NOT NULL,
  `maker_petugas` int(4) NOT NULL,
  `tanggal_petugas` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `id_user_petugas`, `nama_petugas`, `alamat`, `no_telp`, `maker_petugas`, `tanggal_petugas`) VALUES
(1, 2, 'norman ang', 'batam', '0811111111111', 2, '2024-02-28 11:50:13'),
(3, 5, 'bong marvinn', 'batam', '0822222222222', 2, '2024-02-29 09:40:07');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `level`) VALUES
(2, 'adminstrator', '3dcf34a6023633a0d92521ec9c8d5ae4', 1),
(5, 'bong marvin', '3dcf34a6023633a0d92521ec9c8d5ae4', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `NAMA_BARANG` (`nama_barang`);

--
-- Indexes for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  ADD PRIMARY KEY (`id_penjualan_barang`);

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id_log`);

--
-- Indexes for table `pendataan_barang`
--
ALTER TABLE `pendataan_barang`
  ADD PRIMARY KEY (`id_pendataan_barang`);

--
-- Indexes for table `penjualan_barang`
--
ALTER TABLE `penjualan_barang`
  ADD PRIMARY KEY (`id_penjualan_barang`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD UNIQUE KEY `TELP` (`no_telp`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `USERNAME` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `barang_keluar`
--
ALTER TABLE `barang_keluar`
  MODIFY `id_penjualan_barang` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id_log` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pendataan_barang`
--
ALTER TABLE `pendataan_barang`
  MODIFY `id_pendataan_barang` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `penjualan_barang`
--
ALTER TABLE `penjualan_barang`
  MODIFY `id_penjualan_barang` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
