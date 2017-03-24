-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2017 at 08:33 AM
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
  `id_metode_pembayaran` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_order`
--

INSERT INTO `t_order` (`id`, `id_customer`, `detail_dropship`, `total_berat`, `total_qty`, `biaya_kirim`, `total_harga_barang`, `grand_total`, `profit`, `catatan`, `jenis_order`, `status`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`, `id_metode_pembayaran`) VALUES
(1, 1, '0', 1, 1, 1000, 2500, 3500, 500, 'Transaksi percobaan', 1, 3, '2017-03-21 02:50:35', '0000-00-00 00:00:00', 1, 1, 1, 1),
(2, 2, '2', 2, 2, 2000, 50000, 52000, 2000, 'percobaan', 2, 3, '2017-03-16 17:00:00', '0000-00-00 00:00:00', 1, 1, 1, 2),
(3, 1, '0', 1, 1, 500, 5500, 6000, 500, 'Transaksi percobaan 2', 1, 3, '2017-03-21 02:50:35', '0000-00-00 00:00:00', 1, 1, 1, 1);

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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
