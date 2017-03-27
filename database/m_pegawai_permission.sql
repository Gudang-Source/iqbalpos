-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2017 at 08:15 AM
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
  `id_menu` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `url` text NOT NULL COMMENT 'url segment setelah base_url()',
  `icon_class` varchar(50) NOT NULL COMMENT 'additional class untuk icon menu'
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_pegawai_permission`
--

INSERT INTO `m_pegawai_permission` (`id`, `id_menu`, `nama`, `url`, `icon_class`) VALUES
(1, 1, 'Hak Akses', 'index/modul/Master_hak_akses-master-index', ''),
(2, 1, 'Pegawai', 'index/modul/Master_pegawai-master-index', ''),
(3, 1, 'Customer', 'index/modul/Master_customer-master-index', ''),
(4, 1, 'Customer Level', 'index/modul/Master_customer_level-master-index', ''),
(5, 1, 'Supplier Produk', '', ''),
(6, 1, 'Supplier Bahan', '', ''),
(7, 1, 'Satuan', '', ''),
(8, 1, 'Metode Pembayaran', '', ''),
(9, 1, 'Provinsi', '', ''),
(10, 1, 'Kota', '', ''),
(11, 1, 'Lokasi Gudang', '', ''),
(12, 2, 'Kategori', '', ''),
(13, 2, 'Ukuran', '', ''),
(14, 2, 'Warna', '', ''),
(15, 2, 'Bahan', '', ''),
(16, 2, 'Semua Produk', '', ''),
(17, 2, 'Edisi Katalog', '', ''),
(18, 3, 'Kategori', '', ''),
(19, 3, 'Warna', '', ''),
(20, 3, 'Semua Bahan', '', ''),
(21, 4, 'Semua Stok', '', ''),
(22, 4, 'Pesanan', '', ''),
(23, 4, 'Service', '', ''),
(24, 5, 'Purchase Order', '', ''),
(25, 5, 'Pembelian', '', ''),
(26, 5, 'Input Barang Masuk', '', ''),
(27, 5, 'Penjualan', '', ''),
(28, 5, 'Retur', '', ''),
(29, 5, 'Dropship', '', ''),
(30, 6, 'Penjualan', '', ''),
(31, 6, 'Pembelian', '', ''),
(32, 6, 'TOP Customer', '', ''),
(33, 6, 'Best Seller', '', ''),
(34, 6, 'Stok', '', ''),
(35, 7, 'Kas Kecil', '', ''),
(36, 7, 'Transfer Harian', '', ''),
(37, 8, 'Log Aktivitas', '', '');

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
