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
-- Table structure for table `m_supplier_bahan`
--

CREATE TABLE IF NOT EXISTS `m_supplier_bahan` (
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_supplier_bahan`
--

INSERT INTO `m_supplier_bahan` (`id`, `nama`, `alamat`, `no_telp`, `email`, `npwp`, `nama_bank`, `no_rekening`, `rekening_an`, `keterangan`, `id_provinsi`, `id_kota`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'Ossas', 'asdad', '871418', 'ajshg@jhsgfajh', '', '', '', '', '', 1, 2, '2017-03-10 04:17:05', '2017-03-15 14:25:46', 0, 1, 1),
(2, 'Mosses', 'kjashfa fjkashf', '010418', 'mosses@mosses', '', '', '', '', '', 1, 2, '2017-03-15 07:26:12', '2017-03-15 14:26:12', 1, 1, 1),
(3, 'Uwevwevwe', 'North pole', '0151', 'asd@lafkja', '123321', 'BRI', '123231123123', 'Anasndad', 'aslkjasflkj\r\n', 11, 143, '2017-03-24 13:22:25', '2017-05-18 09:03:36', 0, 1, 1),
(4, 'asdasdasd', 'kajsdhaskjd aksjdh', '019281490', 'asd@skfa', 'akjsdh', 'askdhj', 'aksdjh', 'akjshd', 'kasjdh', 1, 1, '2017-05-18 02:13:33', '2017-05-18 09:13:33', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_supplier_bahan`
--
ALTER TABLE `m_supplier_bahan`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_supplier_bahan`
--
ALTER TABLE `m_supplier_bahan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
