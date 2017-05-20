-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2017 at 09:03 PM
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
-- Table structure for table `t_order`
--

CREATE TABLE IF NOT EXISTS `t_order` (
`id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL COMMENT 'table m_customer',
  `detail_dropship` text NOT NULL COMMENT 'isinya JSON',
  `total_berat` int(11) NOT NULL COMMENT 'dalam gram',
  `total_qty` int(11) NOT NULL,
  `biaya_kirim` int(11) NOT NULL COMMENT 'defaultnya 0, jika kirim sebagai dropship, maka isinya tidak 0',
  `total_harga_barang` int(11) NOT NULL COMMENT 'hanya total harga barang saja',
  `grand_total` int(11) NOT NULL COMMENT 'jumlah dr biaya_kirim dan total_harga_barang',
  `profit` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `jenis_order` int(11) NOT NULL COMMENT '1 normal, 2 dropship',
  `status` int(11) NOT NULL COMMENT '1 booking, 2 antrian, 3 selesai',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  `id_metode_pembayaran` int(11) NOT NULL,
  `id_bank` int(11) NOT NULL,
  `nomor_kartu` varchar(50) NOT NULL,
  `cash` int(11) NOT NULL,
  `uang_kembali` int(11) NOT NULL,
  `total_potongan` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_order`
--

INSERT INTO `t_order` (`id`, `id_customer`, `detail_dropship`, `total_berat`, `total_qty`, `biaya_kirim`, `total_harga_barang`, `grand_total`, `profit`, `catatan`, `jenis_order`, `status`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`, `id_metode_pembayaran`, `id_bank`, `nomor_kartu`, `cash`, `uang_kembali`, `total_potongan`) VALUES
(1, 1, '', 5000, 4, 0, 520, 520, -70482, '', 1, 3, '2017-05-03 03:14:55', '0000-00-00 00:00:00', 1, 0, 1, 0, 0, '', 1000, 480, 72680),
(2, 1, '', 10000, 6, 0, 2010, 2010, -81992, '', 1, 3, '2017-05-05 03:05:53', '0000-00-00 00:00:00', 1, 0, 1, 0, 0, '', 3000, 990, 86190),
(3, 3, '', 6000, 3, 0, 60, 60, -149940, '', 1, 3, '2017-05-05 06:51:03', '0000-00-00 00:00:00', 1, 0, 1, 0, 0, '', 100, 40, 152940),
(4, 1, '', 500, 1, 0, 500, 500, 0, 'cacak tunai', 1, 3, '2017-05-19 06:09:13', '0000-00-00 00:00:00', 1, 0, 1, 5, 0, '', 1000, 500, 21500),
(5, 1, '', 500, 1, 0, 500, 500, -20500, 'cacak tunai', 1, 3, '2017-05-19 06:09:59', '0000-00-00 00:00:00', 1, 0, 1, 5, 0, '', 1000, 500, 21500),
(6, 3, '', 2000, 1, 0, 20, 20, -49980, 'cacak kredit', 1, 3, '2017-05-19 06:11:19', '0000-00-00 00:00:00', 1, 0, 1, 3, 0, '', 30, 10, 50980),
(7, 3, '', 2000, 1, 0, 20, 20, -49980, 'cacak debit', 1, 3, '2017-05-19 06:17:44', '0000-00-00 00:00:00', 1, 0, 1, 3, 1, '012312414', 1000, 980, 50980),
(8, 1, '', 2000, 1, 0, 10, 10, -49990, '', 1, 3, '2017-05-19 10:08:20', '0000-00-00 00:00:00', 1, 0, 1, 1, 1, '1209481092481', 10, 0, 50990),
(9, 1, '', 2000, 1, 0, 10, 10, -49990, '', 1, 3, '2017-05-20 13:04:48', '0000-00-00 00:00:00', 1, 0, 1, 5, 0, '', 20, 10, 50990);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_order`
--
ALTER TABLE `t_order`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_order`
--
ALTER TABLE `t_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
