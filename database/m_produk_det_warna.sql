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
-- Table structure for table `m_produk_det_warna`
--

CREATE TABLE IF NOT EXISTS `m_produk_det_warna` (
  `id_produk` int(11) NOT NULL COMMENT 'm_produk',
  `id_warna` int(11) NOT NULL COMMENT 'table m_produk_warna'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_produk_det_warna`
--

INSERT INTO `m_produk_det_warna` (`id_produk`, `id_warna`) VALUES
(11, 1),
(11, 3),
(5, 1),
(2, 2),
(2, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
