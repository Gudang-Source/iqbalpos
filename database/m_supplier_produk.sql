-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2017 at 09:01 PM
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
-- Table structure for table `m_supplier_produk`
--

CREATE TABLE IF NOT EXISTS `m_supplier_produk` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `npwp` varchar(100) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `rekening_an` varchar(150) NOT NULL COMMENT 'Rekening atas nama',
  `keterangan` text NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_supplier_produk`
--

INSERT INTO `m_supplier_produk` (`id`, `nama`, `alamat`, `no_telp`, `email`, `npwp`, `nama_bank`, `no_rekening`, `rekening_an`, `keterangan`, `id_provinsi`, `id_kota`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'Hai', 'hai hai hai', '08194174194', 'hai@hai.com', '', '', '', '', '', 2, 3, '2017-03-10 02:51:46', '0000-00-00 00:00:00', 0, 0, 1),
(2, 'akjshakjf 1', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', '', '', '', '', '', 2, 3, '2017-03-10 02:52:41', '2017-03-15 14:08:35', 0, 1, 1),
(3, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', '', '', '', '', '', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(4, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', '', '', '', '', '', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(5, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', '', '', '', '', '', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(6, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', '', '', '', '', '', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(7, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', '', '', '', '', '', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(8, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', '', '', '', '', '', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(9, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', '', '', '', '', '', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(10, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', '', '', '', '', '', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(11, '1111', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', '', '', '', '', '', 1, 2, '2017-03-10 02:52:41', '2017-03-15 14:15:56', 0, 1, 1),
(12, 'Hai', 'hai hai hai', '08194174194', 'hai@hai.com', '', '', '', '', '', 2, 3, '2017-03-10 02:51:46', '0000-00-00 00:00:00', 0, 0, 0),
(13, 'akjsfhakjsfh', 'kjhasfkjhakj', '09358', 'kasj@kajfha', 'aaa', 'aaa', '10101', 'aaa', 'aaa\r\n', 1, 1, '2017-03-24 09:06:33', '2017-05-18 09:14:06', 0, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_supplier_produk`
--
ALTER TABLE `m_supplier_produk`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_supplier_produk`
--
ALTER TABLE `m_supplier_produk`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
