-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2017 at 08:04 PM
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
-- Table structure for table `m_produk`
--

CREATE TABLE IF NOT EXISTS `m_produk` (
`id` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL COMMENT 'table m_supplier_produk',
  `id_satuan` int(11) NOT NULL COMMENT 'table m_satuan',
  `id_gudang` int(11) NOT NULL COMMENT 'table m_gudang',
  `id_kategori` int(11) NOT NULL COMMENT 'table m_produk_kategori',
  `id_bahan` int(11) NOT NULL COMMENT 'table m_produk_bahan',
  `id_katalog` int(11) NOT NULL COMMENT 'table m_produk_katalog',
  `nama` varchar(100) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual_normal` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `berat` int(11) NOT NULL COMMENT 'dalam garam',
  `tanggal_tambah_stok` datetime DEFAULT NULL,
  `tanggal_kurang_stok` datetime DEFAULT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  `foto` varchar(20) NOT NULL,
  `versi_foto` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_produk`
--

INSERT INTO `m_produk` (`id`, `id_supplier`, `id_satuan`, `id_gudang`, `id_kategori`, `id_bahan`, `id_katalog`, `nama`, `sku`, `kode_barang`, `deskripsi`, `harga_beli`, `harga_jual_normal`, `stok`, `berat`, `tanggal_tambah_stok`, `tanggal_kurang_stok`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`, `foto`, `versi_foto`) VALUES
(1, 1, 2, 1, 1, 1, 1, 'Anjay Gila', '1', '1', '1', 1, 0, 4, 1, '2017-04-26 12:16:03', '2017-04-26 12:20:43', '2017-03-16 03:27:49', '2017-04-26 12:20:43', 1, 1, 1, 'productImage1.jpg', 1),
(2, 2, 3, 2, 2, 3, 3, 'anjay cuek', '20', '20', 'woow', 2, 0, 6, 2, '2017-04-25 16:50:33', NULL, '2017-03-16 06:25:15', '2017-04-25 16:50:33', 0, 1, 1, 'productImage2.jpg', 0),
(3, 0, 0, 0, 0, 0, 0, 'bah', '', '', '', 10000, 0, 5, 0, NULL, NULL, '2017-03-16 06:38:23', '2017-03-16 13:38:23', 0, 0, 1, '', 0),
(4, 0, 0, 0, 0, 0, 0, 'test', '', '', '', 2000, 0, 5, 0, NULL, NULL, '2017-03-16 06:59:43', '2017-03-16 13:59:43', 0, 0, 1, '', 0),
(5, 3, 2, 1, 1, 1, 1, 'asda', '1', 'q', 'nvjhhj', 30000, 0, 5, 1, NULL, NULL, '2017-03-16 07:03:03', '2017-03-18 19:37:11', 0, 0, 1, 'productImage5.jpg', 0),
(6, 0, 0, 0, 0, 0, 0, 'asdasd', '', '', '', 50000, 0, 5, 0, NULL, NULL, '2017-03-16 07:06:48', '2017-03-16 14:06:48', 0, 0, 1, '', 0),
(7, 0, 0, 0, 0, 0, 0, 'kjashdkjad', '', '', '', 50000, 0, 5, 0, NULL, NULL, '2017-03-16 07:09:51', '2017-03-16 14:09:51', 0, 0, 1, '', 0),
(8, 0, 0, 0, 0, 0, 0, 'dsad', '', '', '', 102030, 0, 5, 0, NULL, NULL, '2017-03-16 07:10:13', '2017-03-16 14:10:13', 0, 0, 1, '', 0),
(9, 0, 0, 0, 0, 0, 0, 'Anjay Gerhana', '', '', 'anjae', 129149, 0, 7, 0, NULL, NULL, '2017-03-17 03:59:36', '2017-03-17 19:19:06', 0, 0, 1, 'productImage9.jpg', 0),
(10, 0, 0, 0, 0, 0, 0, 'ppp', '', '', '', 10085, 0, 7, 0, NULL, NULL, '2017-03-17 04:35:10', '2017-03-17 11:35:10', 0, 0, 1, '', 0),
(11, 4, 2, 1, 1, 1, 1, 'Wajyur', 's', '1', 'asdmna', 1, 0, 8, 2, NULL, NULL, '2017-03-17 04:37:02', '2017-03-18 17:35:07', 0, 0, 1, 'productImage11.jpg', 0),
(12, 0, 0, 0, 0, 0, 0, 'Wow panji', '', '', '', 4914898, 0, 4, 0, NULL, NULL, '2017-03-17 12:30:59', '2017-03-17 19:30:59', 0, 0, 0, 'productImage14.jpg', 0),
(13, 0, 0, 0, 0, 0, 0, 'pacji', '', '', '', 19481598, 0, 2, 0, NULL, NULL, '2017-03-17 12:32:51', '2017-03-17 19:32:51', 0, 0, 1, 'productImage13.jpg', 0),
(14, 1, 2, 1, 1, 1, 1, 'wow', 'asd', 'ada', 'asdasd', 25000, 0, 3, 1500, '2017-04-26 11:30:32', '2017-04-26 12:20:43', '2017-03-18 16:10:32', '2017-04-26 12:20:43', 0, 1, 1, 'productImage14.jpg', 0),
(15, 3, 5, 3, 3, 3, 3, 'aia', 's', 'ada', 'sa', 1500000, 0, 6, 3, NULL, NULL, '2017-03-18 16:13:06', '2017-03-19 08:48:36', 0, 0, 0, 'productImage15.jpg', 0),
(16, 1, 2, 1, 4, 4, 2, 'BAJU BEKAS', 'apaan', '012', 'coba', 50000, 51000, 0, 2000, NULL, NULL, '2017-04-23 03:46:53', '2017-04-26 20:01:26', 1, 1, 1, 'productImage16.jpg', 0),
(17, 11, 2, 1, 3, 1, 1, 'Produk Baru', '0123', '12312', 'Barangnya Anjaay', 21000, 22000, 0, 500, NULL, NULL, '2017-04-26 13:04:11', '2017-04-26 20:04:11', 1, 1, 1, 'productImage17.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_produk`
--
ALTER TABLE `m_produk`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_produk`
--
ALTER TABLE `m_produk`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
