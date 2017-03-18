-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2017 at 09:41 PM
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
-- Table structure for table `m_produk_ukuran`
--

CREATE TABLE IF NOT EXISTS `m_produk_ukuran` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_produk_ukuran`
--

INSERT INTO `m_produk_ukuran` (`id`, `nama`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'senti', '2017-03-16 02:02:03', '2017-03-16 09:02:26', 13, 13, 1),
(2, 'meter', '2017-03-16 02:02:10', '2017-03-16 09:02:31', 13, 13, 1),
(3, 'mili', '2017-03-16 04:07:43', '2017-03-16 11:07:43', 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_produk_ukuran`
--
ALTER TABLE `m_produk_ukuran`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_produk_ukuran`
--
ALTER TABLE `m_produk_ukuran`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
