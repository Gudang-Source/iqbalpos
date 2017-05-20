-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2017 at 09:04 PM
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
-- Table structure for table `t_beli`
--

CREATE TABLE IF NOT EXISTS `t_beli` (
`id` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL COMMENT 'table m_supplier_produk',
  `id_purchase_order` int(11) NOT NULL COMMENT 'ada kemungkinan isinya 0, karena untuk pembelian, tidak selalu lewat purchase order dahulu',
  `total_berat` int(11) NOT NULL COMMENT 'dalam gram',
  `total_qty` int(11) NOT NULL,
  `total_harga_beli` int(11) NOT NULL COMMENT 'hasil penjumlahan total harga beli dr beberapa barang',
  `catatan` text NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  `id_metode_pembayaran` int(11) NOT NULL COMMENT 'm_metode_pembayaran',
  `id_bank` int(11) NOT NULL COMMENT 'm_bank',
  `nomor_kartu` varchar(50) NOT NULL,
  `cash` int(11) NOT NULL,
  `uang_kembali` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_beli`
--
ALTER TABLE `t_beli`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_beli`
--
ALTER TABLE `t_beli`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
