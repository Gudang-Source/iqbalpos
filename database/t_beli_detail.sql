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
-- Table structure for table `t_beli_detail`
--

CREATE TABLE IF NOT EXISTS `t_beli_detail` (
`id` int(11) NOT NULL,
  `id_beli` int(11) NOT NULL COMMENT 'table t_beli',
  `id_produk` int(11) NOT NULL COMMENT 'table m_produk',
  `id_ukuran` int(11) NOT NULL COMMENT 'table m_produk_ukuran',
  `id_warna` int(11) NOT NULL COMMENT 'table m_produk_warna',
  `jumlah` int(11) NOT NULL,
  `total_berat` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL COMMENT 'jumlah*harga_beli',
  `nama_warna` varchar(100) NOT NULL,
  `nama_ukuran` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_beli_detail`
--
ALTER TABLE `t_beli_detail`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_beli_detail`
--
ALTER TABLE `t_beli_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
