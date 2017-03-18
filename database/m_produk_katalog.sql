-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2017 at 09:40 PM
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
-- Table structure for table `m_produk_katalog`
--

CREATE TABLE IF NOT EXISTS `m_produk_katalog` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_produk_katalog`
--

INSERT INTO `m_produk_katalog` (`id`, `nama`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'Katalog 1', '2017-03-16 02:13:49', '2017-03-16 09:13:59', 13, 13, 1),
(2, 'Katalog 2', '2017-03-16 02:13:54', '2017-03-16 09:14:05', 13, 13, 1),
(3, 'katalog 3', '2017-03-16 04:08:39', '2017-03-16 11:08:45', 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_produk_katalog`
--
ALTER TABLE `m_produk_katalog`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_produk_katalog`
--
ALTER TABLE `m_produk_katalog`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
