-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2017 at 11:19 AM
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
-- Table structure for table `m_pegawai_menu`
--

CREATE TABLE IF NOT EXISTS `m_pegawai_menu` (
`id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `icon_class` varchar(50) NOT NULL COMMENT 'additional class untuk icon menu',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Aktif, 0 = Terhapus'
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_pegawai_menu`
--

INSERT INTO `m_pegawai_menu` (`id`, `nama`, `icon_class`, `date_add`, `deleted`) VALUES
(1, 'master', 'fa fa-dashboard', '2017-03-29 13:37:07', 1),
(2, 'produk', 'fa fa-shopping-cart', '2017-03-29 13:43:40', 1),
(3, 'bahan baku', 'fa fa-archive', '2017-03-29 13:47:14', 1),
(4, 'transaksi', 'fa fa-dollar', '2017-05-09 04:02:49', 1),
(5, 'stok', 'fa fa-cubes', '2017-05-09 04:02:52', 1),
(6, 'laporan', 'fa fa-line-chart', '2017-03-29 13:42:48', 1),
(7, 'finance', 'fa fa-money', '2017-03-29 13:47:57', 1),
(8, 'log', 'fa fa-desktop', '2017-03-29 13:37:51', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_pegawai_menu`
--
ALTER TABLE `m_pegawai_menu`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_pegawai_menu`
--
ALTER TABLE `m_pegawai_menu`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
