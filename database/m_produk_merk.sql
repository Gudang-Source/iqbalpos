-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2017 at 09:00 PM
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
-- Table structure for table `m_produk_merk`
--

CREATE TABLE IF NOT EXISTS `m_produk_merk` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_produk_merk`
--

INSERT INTO `m_produk_merk` (`id`, `nama`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'Merk A', '2017-05-19 01:16:47', '2017-05-19 08:16:47', 1, 1, 1),
(2, 'Merk B', '2017-05-19 01:17:06', '2017-05-19 08:17:06', 1, 1, 1),
(3, 'Merk C', '2017-05-19 01:17:18', '2017-05-19 08:17:18', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_produk_merk`
--
ALTER TABLE `m_produk_merk`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_produk_merk`
--
ALTER TABLE `m_produk_merk`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
