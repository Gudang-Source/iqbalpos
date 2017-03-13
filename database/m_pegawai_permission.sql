-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2017 at 03:56 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `m_pegawai_permission`
--

CREATE TABLE IF NOT EXISTS `m_pegawai_permission` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kategori` enum('master','produk','bahan_baku','stok','transaksi','laporan','finance','log') NOT NULL COMMENT 'Tambahan delevoper'
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_pegawai_permission`
--

INSERT INTO `m_pegawai_permission` (`id`, `nama`, `kategori`) VALUES
(1, 'Hak Akses', 'master'),
(2, 'Pegawai', 'master'),
(3, 'Customer', 'master'),
(4, 'Customer Level', 'master'),
(5, 'Supplier Produk', 'master'),
(6, 'Supplier Bahan', 'master'),
(7, 'Satuan', 'master'),
(8, 'Metode Pembayaran', 'master'),
(9, 'Provinsi', 'master'),
(10, 'Kota', 'master'),
(11, 'Lokasi Gudang', 'master'),
(12, 'Kategori', 'produk'),
(13, 'Ukuran', 'produk'),
(14, 'Warna', 'produk'),
(15, 'Bahan', 'produk'),
(16, 'Semua Produk', 'produk'),
(17, 'Edisi Katalog', 'produk'),
(18, 'Kategori', 'bahan_baku'),
(19, 'Warna', 'bahan_baku'),
(20, 'Semua Bahan', 'bahan_baku'),
(21, 'Semua Stok', 'stok'),
(22, 'Pesanan', 'stok'),
(23, 'Service', 'stok'),
(24, 'Purchase Order', 'transaksi'),
(25, 'Pembelian', 'transaksi'),
(26, 'Input Barang Masuk', 'transaksi'),
(27, 'Penjualan', 'transaksi'),
(28, 'Retur', 'transaksi'),
(29, 'Dropship', 'transaksi'),
(30, 'Penjualan', 'laporan'),
(31, 'Pembelian', 'laporan'),
(32, 'TOP Customer', 'laporan'),
(33, 'Best Seller', 'laporan'),
(34, 'Stok', 'laporan'),
(35, 'Kas Kecil', 'finance'),
(36, 'Transfer Harian', 'finance'),
(37, 'Login User', 'log');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_pegawai_permission`
--
ALTER TABLE `m_pegawai_permission`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_pegawai_permission`
--
ALTER TABLE `m_pegawai_permission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
