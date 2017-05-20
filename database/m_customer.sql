-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2017 at 09:02 PM
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
-- Table structure for table `m_customer`
--

CREATE TABLE IF NOT EXISTS `m_customer` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `kode_pos` varchar(20) NOT NULL,
  `ktp` varchar(50) NOT NULL,
  `npwp` varchar(100) NOT NULL,
  `nama_bank` varchar(100) NOT NULL,
  `no_rekening` varchar(50) NOT NULL,
  `rekening_an` varchar(150) NOT NULL COMMENT 'Rekening atas nama',
  `keterangan` text NOT NULL,
  `sales` varchar(150) NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `id_customer_level` int(11) NOT NULL COMMENT 'dr m_customer_level',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_customer`
--

INSERT INTO `m_customer` (`id`, `nama`, `alamat`, `no_telp`, `email`, `kode_pos`, `ktp`, `npwp`, `nama_bank`, `no_rekening`, `rekening_an`, `keterangan`, `sales`, `id_provinsi`, `id_kota`, `id_customer_level`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'Dimas Virdana', 'jalan panglima sudirman', '08171851857', 'as5lang.s@gmail.com', '65111', '', '', '', '', '', '', '', 1, 1, 2, '2017-03-08 03:21:46', '2017-03-15 13:27:45', 0, 1, 1),
(2, 'sakaf', 'askjfha', 'aksjfh', 'kjash@kajfha', '165', '', '', '', '', '', '', '', 2, 3, 1, '2017-03-08 03:30:19', '0000-00-00 00:00:00', 0, 0, 0),
(3, 'Beni ', 'lkajsflkaj', '0912409184', 'laksjf@lkasfj', '19571', '', '', '', '', '', '', '', 1, 1, 1, '2017-03-08 07:25:32', '2017-03-24 16:54:26', 0, 0, 1),
(4, 'Aayayayya', 'kasjfhajkfh aksfj hasfkjhkjh', '012487148', 'aksjd@ksjahfkajh', '65111', '', '', '', '', '', '', '', 1, 2, 1, '2017-03-10 03:23:17', '2017-03-15 14:27:29', 0, 1, 1),
(5, 'askfhaskfjh', 'kjhaskfjhak', '8914791847', 'asd@askfjha', '98127418', '', '', '', '', '', '', '', 2, 3, 2, '2017-03-24 09:06:20', '2017-03-24 16:06:20', 0, 0, 1),
(6, 'hahahahahah', 'akjshakjfha sfjkh', '2928471', 'asd@aksjhgakj', '1414', '123', '321', 'AAA', '123321', 'AAA123', 'apa ?', 'Diams', 11, 135, 1, '2017-03-24 09:54:08', '2017-05-18 10:38:44', 0, 1, 1),
(7, 'Muhahaha', 'asdasdad', '12104', 'asd@aksjdh', '91247', '1212414', 'akjsdh', 'BRI', '123231123123', 'Anasndad', 'asdads', 'asdmn', 1, 2, 2, '2017-05-18 03:39:32', '2017-05-18 10:39:32', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_customer`
--
ALTER TABLE `m_customer`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_customer`
--
ALTER TABLE `m_customer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
