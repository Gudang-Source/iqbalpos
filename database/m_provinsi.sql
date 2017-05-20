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
-- Table structure for table `m_provinsi`
--

CREATE TABLE IF NOT EXISTS `m_provinsi` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_provinsi`
--

INSERT INTO `m_provinsi` (`id`, `nama`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'Bali', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(2, 'Bangka Belitung', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(3, 'Banten', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(4, 'Bengkulu', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(5, 'DI Yogyakarta', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(6, 'DKI Jakarta', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(7, 'Gorontalo', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(8, 'Jambi', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(9, 'Jawa Barat', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(10, 'Jawa Tengah', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(11, 'Jawa Timur', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(12, 'Kalimantan Barat', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(13, 'Kalimantan Selatan', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(14, 'Kalimantan Tengah', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(15, 'Kalimantan Timur', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(16, 'Kalimantan Utara', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(17, 'Kepulauan Riau', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(18, 'Lampung', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(19, 'Maluku', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(20, 'Maluku Utara', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(21, 'Nanggroe Aceh Darussalam', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(22, 'Nusa Tenggara Barat', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(23, 'Nusa Tenggara Timur', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(24, 'Papua', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(25, 'Papua Barat', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(26, 'Riau', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(27, 'Sulawesi Barat', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(28, 'Sulawesi Selatan', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(29, 'Sulawesi Tengah', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(30, 'Sulawesi Tenggara', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(31, 'Sulawesi Utara', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(32, 'Sumatera Barat', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(33, 'Sumatera Selatan', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1),
(34, 'Sumatera Utara', '2017-05-18 00:35:00', '2017-05-18 07:35:00', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_provinsi`
--
ALTER TABLE `m_provinsi`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_provinsi`
--
ALTER TABLE `m_provinsi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
