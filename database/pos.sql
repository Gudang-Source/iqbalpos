-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2017 at 10:43 AM
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
-- Table structure for table `fin_kas`
--

CREATE TABLE IF NOT EXISTS `fin_kas` (
`id` int(11) NOT NULL,
  `rincian` text NOT NULL,
  `debet` int(11) NOT NULL,
  `kredit` int(11) NOT NULL,
  `saldo_akhir` int(11) NOT NULL,
  `nama_foto` varchar(50) NOT NULL,
  `versi_foto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fin_transfer_harian`
--

CREATE TABLE IF NOT EXISTS `fin_transfer_harian` (
`id` int(11) NOT NULL,
  `id_bank` int(11) NOT NULL,
  `nominal` int(11) NOT NULL,
  `tanggal_transfer` datetime NOT NULL,
  `keterangan` text NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `h_login`
--

CREATE TABLE IF NOT EXISTS `h_login` (
`id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 login, 2 logout',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_by` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `h_stok_bahan`
--

CREATE TABLE IF NOT EXISTS `h_stok_bahan` (
`id` int(11) NOT NULL,
  `id_bahan` int(11) NOT NULL COMMENT 'table m_bahan',
  `jumlah` int(11) NOT NULL COMMENT 'stok yang berkurang atau bertambah',
  `stok_akhir` int(11) NOT NULL COMMENT 'stok setelah dijumlah atau di dikurangi',
  `keterangan` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 berkurang, 2 bertambah',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `h_stok_produk`
--

CREATE TABLE IF NOT EXISTS `h_stok_produk` (
`id` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL COMMENT 'table m_produk',
  `id_order_detail` int(11) NOT NULL COMMENT ' terisi != 0 jika stok berkurang dr proses penjualan',
  `id_service` int(11) NOT NULL COMMENT 'terisi != 0 jika stok berkurang/bertambah dr proses service',
  `jumlah` int(11) NOT NULL COMMENT 'stok yang berkurang atau bertambah',
  `stok_akhir` int(11) NOT NULL COMMENT 'stok setelah dijumlah atau di dikurangi',
  `keterangan` text NOT NULL,
  `status` int(11) NOT NULL COMMENT ' 1 berkurang dr proses penjualan, 2 berkurang dr proses service, 3 dikurangi manual oleh admin, 4 ditambah manual oleh admin, 5 ditambah dr barang yg telah diservice',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT ' 0 terhapus, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `h_transaksi`
--

CREATE TABLE IF NOT EXISTS `h_transaksi` (
`id` int(11) NOT NULL,
  `jenis_transaksi` int(11) NOT NULL COMMENT '1 service, 2 purchase order, 3 pembelian, 4 penjualan/order, 5 retur, 6 dropship, 7 pesanan',
  `id_referensi` int(11) NOT NULL COMMENT 'jika jenis_transaksi nya service, maka id_referdiisi diisi dengan id_service, jika jenis_transaksi purchase order, diisi dengan id_purchase_order dst',
  `keterangan` text NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_bahan`
--

CREATE TABLE IF NOT EXISTS `m_bahan` (
`id` int(11) NOT NULL,
  `id_supplier_bahan` int(11) NOT NULL COMMENT 'table m_supplier_bahan',
  `id_satuan` int(11) NOT NULL COMMENT 'table m_satuan',
  `id_gudang` int(11) NOT NULL COMMENT 'table m_gudang',
  `id_kategori_bahan` int(11) NOT NULL COMMENT 'table m_bahan_kategori',
  `nama` varchar(100) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `berat` int(11) NOT NULL COMMENT 'dalam gram',
  `tanggal_tambah_stok` datetime DEFAULT NULL,
  `tanggal_kurang_stok` datetime DEFAULT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  `foto` varchar(20) NOT NULL,
  `versi_foto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_bahan_det_warna`
--

CREATE TABLE IF NOT EXISTS `m_bahan_det_warna` (
  `id_bahan` int(11) NOT NULL COMMENT 'm_bahan',
  `id_warna` int(11) NOT NULL COMMENT 'table m_produk_warna'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_bahan_kategori`
--

CREATE TABLE IF NOT EXISTS `m_bahan_kategori` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_bahan_warna`
--

CREATE TABLE IF NOT EXISTS `m_bahan_warna` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_bank`
--

CREATE TABLE IF NOT EXISTS `m_bank` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `id_provinsi` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `id_customer_level` int(11) NOT NULL COMMENT 'dr m_customer_level',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_customer`
--

INSERT INTO `m_customer` (`id`, `nama`, `alamat`, `no_telp`, `email`, `kode_pos`, `id_provinsi`, `id_kota`, `id_customer_level`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'Dimas Virdana', 'jalan panglima sudirman', '08171851857', 'as5lang.s@gmail.com', '65111', 1, 1, 2, '2017-03-08 03:21:46', '0000-00-00 00:00:00', 0, 0, 1),
(2, 'sakaf', 'askjfha', 'aksjfh', 'kjash@kajfha', '165', 2, 3, 1, '2017-03-08 03:30:19', '0000-00-00 00:00:00', 0, 0, 0),
(3, 'kalfjalkfj', 'lkajsflkaj', 'aklsjf', 'laksjf@lkasfj', '19571', 1, 1, 1, '2017-03-08 07:25:32', '0000-00-00 00:00:00', 0, 0, 0),
(4, 'akjsfhakjf', 'kasjfhajkfh aksfj hasfkjhkjh', '012487148', 'aksjd@ksjahfkajh', '65111', 1, 2, 1, '2017-03-10 03:23:17', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_customer_level`
--

CREATE TABLE IF NOT EXISTS `m_customer_level` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_customer_level`
--

INSERT INTO `m_customer_level` (`id`, `nama`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'Test Level 2', '2017-03-08 07:10:51', '0000-00-00 00:00:00', 0, 0, 1),
(2, 'cacack', '2017-03-08 07:11:13', '0000-00-00 00:00:00', 0, 0, 1),
(3, 'Test lagi', '2017-03-08 07:12:12', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_gudang`
--

CREATE TABLE IF NOT EXISTS `m_gudang` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_gudang`
--

INSERT INTO `m_gudang` (`id`, `nama`, `alamat`, `id_provinsi`, `id_kota`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'Gudang 1', 'Jalan container 1', 3, 5, '2017-03-10 09:14:46', '0000-00-00 00:00:00', 0, 0, 1),
(2, 'Gudang 2', 'Kontainer 2', 1, 1, '2017-03-10 09:15:20', '0000-00-00 00:00:00', 0, 0, 1),
(3, 'Gudang 3', 'askjfkajfhkjah aksjfh askfj', 2, 6, '2017-03-10 09:34:00', '0000-00-00 00:00:00', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_kota`
--

CREATE TABLE IF NOT EXISTS `m_kota` (
`id` int(11) NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_kota`
--

INSERT INTO `m_kota` (`id`, `id_provinsi`, `nama`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 1, 'Malang', '2017-03-07 06:26:19', '0000-00-00 00:00:00', 1, 1, 1),
(2, 1, 'Surabaya', '2017-03-07 06:26:19', '0000-00-00 00:00:00', 1, 1, 1),
(3, 2, 'Semarang', '2017-03-07 06:27:12', '0000-00-00 00:00:00', 1, 1, 1),
(4, 3, 'Tangerang', '2017-03-10 08:36:04', '0000-00-00 00:00:00', 0, 0, 1),
(5, 3, 'Bekasi', '2017-03-10 08:45:54', '0000-00-00 00:00:00', 0, 0, 1),
(6, 2, 'Magelang', '2017-03-10 08:54:09', '0000-00-00 00:00:00', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_metode_pembayaran`
--

CREATE TABLE IF NOT EXISTS `m_metode_pembayaran` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_metode_pembayaran`
--

INSERT INTO `m_metode_pembayaran` (`id`, `nama`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'BRI', '2017-03-10 07:09:49', '0000-00-00 00:00:00', 0, 0, 0),
(2, 'MANDIRI', '2017-03-10 07:09:57', '0000-00-00 00:00:00', 0, 0, 0),
(3, 'BNI', '2017-03-10 07:42:18', '0000-00-00 00:00:00', 0, 0, 1),
(4, 'Transfer', '2017-03-10 08:24:41', '0000-00-00 00:00:00', 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_pegawai`
--

CREATE TABLE IF NOT EXISTS `m_pegawai` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL COMMENT 'pakai sha512 nya php',
  `kode_pos` varchar(20) NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `id_pegawai_level` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_pegawai`
--

INSERT INTO `m_pegawai` (`id`, `nama`, `alamat`, `no_telp`, `email`, `password`, `kode_pos`, `id_provinsi`, `id_kota`, `id_pegawai_level`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'adam alis', 'asdasd', '0981471', 'adam@adam', 'db4a3027ecedcc3a3afd4019c4b34e1f816db4ffe5026645ff4c52793548e6ab74e6b72c72154ff067d2b45149ed1afbcfbedd3d971126f4974493b92fb15af7', '64111', 2, 6, 1, '2017-03-02 02:40:52', '0000-00-00 00:00:00', 0, 0, 1),
(2, 'asfh', 'kjhaskj', 'kjhaskaj', 'kjhfkja@alkfja', '5a83fd61add7a4e5b2ac3889049a473392f8036a91df7edf9d3c1b0c60fe5e5380d07de13f2179c78966b93eb93cfcda3d77b8e4bf5ab7e268004299091f06a9', 'kjhfdskjfh', 0, 0, 0, '2017-03-02 04:17:56', '0000-00-00 00:00:00', 0, 0, 0),
(3, 'as1', 'jhg', 'jhg', 'as1@as1.com', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', 'jhg', 2, 6, 2, '2017-03-03 02:26:33', '0000-00-00 00:00:00', 0, 0, 1),
(4, 'asdmn', 'mnb', 'mnb', 'mb@mnbm', '783c47f33bdcbf475a16ac866bff1bc34704c3cd280385b4dd606552f1f93299f53e160ab83bb77a93e1c9c3b277be4ac0404165879cbe0a2d7cb401762f7edf', 'mnb', 0, 0, 0, '2017-03-03 02:27:20', '0000-00-00 00:00:00', 0, 0, 1),
(5, 'nasjasfhg', 'jahsg', 'jjhg', 'jhgjhg@jhgjhg', 'c7ad44cbad762a5da0a452f9e854fdc1e0e7a52a38015f23f3eab1d80b931dd472634dfac71cd34ebc35d16ab7fb8a90c81f975113d6c7538dc69dd8de9077ec', ',mn', 0, 0, 0, '2017-03-03 03:06:49', '0000-00-00 00:00:00', 0, 0, 1),
(6, 'snmd', ',mn', ',mn', 'asda@kjh', 'f4cf93f77a78b272270c2bf4375d6914d763af013f2afa6c5c6658203e0ace90a2cff70f4e42a75033a17387dcdccdd47c73c27c65643ed0f6f138fba7b26fdc', ',mn', 0, 0, 0, '2017-03-03 03:16:53', '0000-00-00 00:00:00', 0, 0, 1),
(7, 'dasd', 'asdgh', 'hgfhf', 'hgfhgf@hgfhgf', 'e12e75d43e654864a79789abcedf44f73c7b764bd8ff2d4e1b402454d11d318259a2b1b6ba8896b27943a4a50197afe75d749e52efa6047649561a6f017c5fc8', 'hgf', 1, 1, 0, '2017-03-03 03:17:22', '0000-00-00 00:00:00', 0, 0, 1),
(8, 'anbsdjhasdb', 'jahdsbjahsdb', 'jhabsdj', 'ajshdb@jhsfbajhfb', 'c655b4bfc0570668354bb30f321fe1518d2e2f9895862affe06bf963aa7d6b36f024bc91d2206081214d4dc207d2b1cd300b8b51fb5c36f40e7fe3c6d1cf441b', 'jhbjh', 2, 3, 0, '2017-03-03 04:22:48', '0000-00-00 00:00:00', 0, 0, 0),
(9, 'test', 'fds', 'fds', 'fds@Fds', '6e45b4f02ceaadd9051f8638a55ee0cca3b96cf2c522246b816e94d6f6d2ff71604d49564386dfc93ccd1cac30ed7aeb6d2cddda22af6f6f94648f9f4e04d651', 'fds', 0, 0, 0, '2017-03-03 08:44:26', '0000-00-00 00:00:00', 0, 0, 1),
(10, 'asdasd', 'hgf', 'hgf', 'hgfhg@hgfg', '2241bc8fc70705b42efead371fd4982c5ba69917e5b4b895810002644f0386da9c3131793458c2bf47608480d64a07278133c99912e0ba2daf23098f3520eb97', 'hgfhgf', 1, 1, 2, '2017-03-06 06:29:43', '0000-00-00 00:00:00', 0, 0, 1),
(11, 'Diams', 'kajsfha sfhsaf kash fkjahf', '1571987198', 'kjsdhgjk@sakajk', 'cf83e1357eefb8bdf1542850d66d8007d620e4050b5715dc83f4a921d36ce9ce47d0d13c5d85f2b0ff8318d2877eec2f63b931bd47417a81a538327af927da3e', '815561', 2, 3, 1, '2017-03-08 03:18:14', '0000-00-00 00:00:00', 0, 0, 1),
(12, 'askf', 'askjf', '097987', 'asf@kasjfh', 'e54ee7e285fbb0275279143abc4c554e5314e7b417ecac83a5984a964facbaad68866a2841c3e83ddf125a2985566261c4014f9f960ec60253aebcda9513a9b4', '18476', 1, 1, 1, '2017-03-08 03:31:01', '0000-00-00 00:00:00', 0, 0, 0),
(13, 'test', 'test alamat', '0182471847', 'test@test.com', 'ee26b0dd4af7e749aa1a8ee3c10ae9923f618980772e473f8819a5d4940e0db27ac185f8a0e1d5f84f88bc887fd67b143732c304cc5fa9ad8e6f57f50028a8ff', '65111', 1, 1, 1, '2017-03-13 04:05:06', '0000-00-00 00:00:00', 0, 0, 1),
(14, 'anjay', 'anjay', 'anjay', 'anjay@anjay', 'e66c5ee38c4771dd5e0bf93a4671f0fbcbe5fcb52101e61b03a5379bace001d1ccbc73e03745f0349e2e6440a7dd601e1d31ffbdebde30cb64bd7263365551bc', '87814', 1, 2, 3, '2017-03-14 15:12:47', '0000-00-00 00:00:00', 0, 0, 1),
(15, 'asdad', 'asda', '123', 'asd@asd', 'e54ee7e285fbb0275279143abc4c554e5314e7b417ecac83a5984a964facbaad68866a2841c3e83ddf125a2985566261c4014f9f960ec60253aebcda9513a9b4', 'asd123', 1, 1, 2, '2017-03-15 02:22:15', '0000-00-00 00:00:00', 0, 0, 1),
(16, 'test 2', 'test 2 alamat', '081247614', 'test@test.com', '6d201beeefb589b08ef0672dac82353d0cbd9ad99e1642c83a1601f3d647bcca003257b5e8f31bdc1d73fbec84fb085c79d6e2677b7ff927e823a54e789140d9', '652221', 2, 6, 1, '2017-03-15 02:57:40', '0000-00-00 00:00:00', 0, 0, 1),
(17, 'ayay', 'ayay', '09124', 'ayay@ayay', '4f08c26f150db88680ae97cbc2d64f4c96e926631c8809e4c48739473287dca5d8efa5e677563553e1d3fcd50b233c074adb231f8391fd483a89d49da543b4f7', '8147', 1, 2, 1, '2017-03-15 02:59:38', '2017-03-15 09:59:38', 0, 0, 1),
(18, 'ajuur', 'asdasd asd asd ', '0', 'test@testz.com', 'e54ee7e285fbb0275279143abc4c554e5314e7b417ecac83a5984a964facbaad68866a2841c3e83ddf125a2985566261c4014f9f960ec60253aebcda9513a9b4', '2', 1, 1, 1, '2017-03-15 03:21:17', '2017-03-15 10:21:17', 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `m_pegawai_level`
--

CREATE TABLE IF NOT EXISTS `m_pegawai_level` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `permission` text NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_pegawai_level`
--

INSERT INTO `m_pegawai_level` (`id`, `nama`, `permission`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'Ada aja', '["1","2","3","12","13"]', '2017-03-13 04:04:00', '0000-00-00 00:00:00', 1, 1, 1),
(2, 'Level 1', '["1","2","3","12","13","14","18","20"]', '2017-03-13 08:43:57', '0000-00-00 00:00:00', 0, 0, 1),
(3, 'asfaf', 'null', '2017-03-13 08:44:25', '0000-00-00 00:00:00', 0, 0, 1),
(4, 'ayayaya', 'null', '2017-03-13 08:51:11', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_pegawai_permission`
--

CREATE TABLE IF NOT EXISTS `m_pegawai_permission` (
`id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kategori` enum('master','produk','bahan_baku','stok','transaksi','laporan','finance','log') NOT NULL COMMENT 'Tambahan delevoper'
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_pegawai_permission`
--

INSERT INTO `m_pegawai_permission` (`id`, `nama`, `kategori`) VALUES
(1, 'Hak Akses', 'master'),
(2, 'Pegawai', 'master'),
(3, 'Customer', 'master'),
(4, 'Customer Level', 'master'),
(5, 'Supplier Produk', 'master'),
(6, 'Supplier Bahan', 'master'),
(7, 'Satuan', 'master'),
(8, 'Metode Pembayaran', 'master'),
(9, 'Provinsi', 'master'),
(10, 'Kota', 'master'),
(11, 'Lokasi Gudang', 'master'),
(12, 'Kategori', 'produk'),
(13, 'Ukuran', 'produk'),
(14, 'Warna', 'produk'),
(15, 'Bahan', 'produk'),
(16, 'Semua Produk', 'produk'),
(17, 'Edisi Katalog', 'produk'),
(18, 'Kategori', 'bahan_baku'),
(19, 'Warna', 'bahan_baku'),
(20, 'Semua Bahan', 'bahan_baku'),
(21, 'Semua Stok', 'stok'),
(22, 'Pesanan', 'stok'),
(23, 'Service', 'stok'),
(24, 'Purchase Order', 'transaksi'),
(25, 'Pembelian', 'transaksi'),
(26, 'Input Barang Masuk', 'transaksi'),
(27, 'Penjualan', 'transaksi'),
(28, 'Retur', 'transaksi'),
(29, 'Dropship', 'transaksi'),
(30, 'Penjualan', 'laporan'),
(31, 'Pembelian', 'laporan'),
(32, 'TOP Customer', 'laporan'),
(33, 'Best Seller', 'laporan'),
(34, 'Stok', 'laporan'),
(35, 'Kas Kecil', 'finance'),
(36, 'Transfer Harian', 'finance'),
(37, 'Login User', 'log');

-- --------------------------------------------------------

--
-- Table structure for table `m_produk`
--

CREATE TABLE IF NOT EXISTS `m_produk` (
`id` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL COMMENT 'table m_supplier_produk',
  `id_satuan` int(11) NOT NULL COMMENT 'table m_satuan',
  `id_gudang` int(11) NOT NULL COMMENT 'table m_gudang',
  `id_kategori` int(11) NOT NULL COMMENT 'table m_produk_kategori',
  `id_bahan` int(11) NOT NULL COMMENT 'table m_produk_bahan',
  `id_katalog` int(11) NOT NULL COMMENT 'table m_produk_katalog',
  `nama` varchar(100) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `berat` int(11) NOT NULL COMMENT 'dalam garam',
  `tanggal_tambah_stok` datetime DEFAULT NULL,
  `tanggal_kurang_stok` datetime DEFAULT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  `foto` varchar(20) NOT NULL,
  `versi_foto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_produk_bahan`
--

CREATE TABLE IF NOT EXISTS `m_produk_bahan` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `adited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_produk_det_harga`
--

CREATE TABLE IF NOT EXISTS `m_produk_det_harga` (
  `id_produk` int(11) NOT NULL COMMENT 'table m_produk',
  `id_customer_level` int(11) NOT NULL COMMENT 'table m_customer_level',
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_produk_det_ukuran`
--

CREATE TABLE IF NOT EXISTS `m_produk_det_ukuran` (
  `id_produk` int(11) NOT NULL COMMENT 'table m_produk',
  `id_ukuran` int(11) NOT NULL COMMENT 'table m_produk_ukuran'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_produk_det_warna`
--

CREATE TABLE IF NOT EXISTS `m_produk_det_warna` (
  `id_produk` int(11) NOT NULL COMMENT 'm_produk',
  `id_warna` int(11) NOT NULL COMMENT 'table m_produk_warna'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_produk_kategori`
--

CREATE TABLE IF NOT EXISTS `m_produk_kategori` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `adited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_produk_warna`
--

CREATE TABLE IF NOT EXISTS `m_produk_warna` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `adited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_provinsi`
--

INSERT INTO `m_provinsi` (`id`, `nama`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'Jawa Timur', '2017-03-07 06:27:54', '0000-00-00 00:00:00', 1, 1, 1),
(2, 'Jawa Tengah', '2017-03-07 06:27:54', '0000-00-00 00:00:00', 1, 1, 1),
(3, 'Jawa Barat', '2017-03-10 08:27:41', '0000-00-00 00:00:00', 0, 0, 1),
(4, 'bumer', '2017-03-10 08:28:04', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `m_satuan`
--

CREATE TABLE IF NOT EXISTS `m_satuan` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_satuan`
--

INSERT INTO `m_satuan` (`id`, `nama`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'Satuan apa?', '2017-03-10 06:47:30', '0000-00-00 00:00:00', 0, 0, 0),
(2, 'Apanya yang disatuin?', '2017-03-10 06:47:38', '0000-00-00 00:00:00', 0, 0, 1),
(3, 'tambah satu', '2017-03-10 07:26:39', '0000-00-00 00:00:00', 0, 0, 1),
(4, 'tese', '2017-03-10 07:36:24', '0000-00-00 00:00:00', 0, 0, 0),
(5, 'byars', '2017-03-10 07:36:51', '0000-00-00 00:00:00', 0, 0, 1);

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
  `id_provinsi` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_supplier_bahan`
--

INSERT INTO `m_supplier_bahan` (`id`, `nama`, `alamat`, `no_telp`, `email`, `id_provinsi`, `id_kota`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'asddas', 'asdad', '871418', 'ajshg@jhsgfajh', 1, 2, '2017-03-10 04:17:05', '0000-00-00 00:00:00', 0, 0, 1);

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
  `id_provinsi` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_supplier_produk`
--

INSERT INTO `m_supplier_produk` (`id`, `nama`, `alamat`, `no_telp`, `email`, `id_provinsi`, `id_kota`, `date_add`, `last_edited`, `add_by`, `edited_by`, `deleted`) VALUES
(1, 'Hai', 'hai hai hai', '08194174194', 'hai@hai.com', 2, 3, '2017-03-10 02:51:46', '0000-00-00 00:00:00', 0, 0, 1),
(2, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(3, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(4, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(5, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(6, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(7, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(8, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(9, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(10, 'akjshakjf', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(11, '1111', 'kjahs', 'kasjhf', 'kasjh@kjhfakjfh', 2, 3, '2017-03-10 02:52:41', '0000-00-00 00:00:00', 0, 0, 1),
(12, 'Hai', 'hai hai hai', '08194174194', 'hai@hai.com', 2, 3, '2017-03-10 02:51:46', '0000-00-00 00:00:00', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
`id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `nilai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tm_item`
--

CREATE TABLE IF NOT EXISTS `tm_item` (
`kode_item` int(11) NOT NULL,
  `nama_item` varchar(50) DEFAULT NULL,
  `deskripsi_item` varchar(50) DEFAULT NULL,
  `sku_item` varchar(50) DEFAULT NULL,
  `barcode_item` varchar(50) DEFAULT NULL,
  `image_item` varchar(50) DEFAULT NULL,
  `status_item` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tm_jenis_item`
--

CREATE TABLE IF NOT EXISTS `tm_jenis_item` (
`kode_jenis` int(11) NOT NULL,
  `nama_jenis` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tm_owner`
--

CREATE TABLE IF NOT EXISTS `tm_owner` (
`kode_owner` int(11) NOT NULL,
  `nama_owner` varchar(255) NOT NULL DEFAULT '0',
  `email_owner` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `identitas_owner` varchar(255) NOT NULL DEFAULT '0',
  `alamat_owner` varchar(255) NOT NULL DEFAULT '0',
  `telp_owner` varchar(255) NOT NULL DEFAULT '0',
  `key_owner` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tm_owner`
--

INSERT INTO `tm_owner` (`kode_owner`, `nama_owner`, `email_owner`, `password`, `identitas_owner`, `alamat_owner`, `telp_owner`, `key_owner`) VALUES
(1, 'Muhammad Handharbeni', 'mhandharbeni@gmail.com', '12345', '3573032002930011', 'puri cempaka putih as 20', '081945503841', 'c4880o04swckowo8c8cwccck80448404c0s8008c'),
(2, 'Muhammad Handharbeni', 'mhandharbeni@gmail.com', '12345', '3573032002930011', 'puri cempaka putih as 20', '081945503841', 'g44k8wsk88k844w4c048gw40gc8wscgc8s40ckos'),
(3, 'Muhammad Handharbeni', 'mhandharbeni@gmail.com', '12345', '3573032002930011', 'puri cempaka putih as 20', '081945503841', 'cs0sk4okksc4skk0004k4c8sw48ks4ccw4ss0008'),
(4, 'Muhammad Handharbeni', 'mhandharbeni@gmail.com', '12345', '3573032002930011', 'puri cempaka putih as 20', '081945503841', 'kk0gw0kows0gck8kso4csk4go8k8wogcgw40csgc'),
(5, 'Muhammad Handharbeni', 'mhandharbeni@gmail.com', '12345', '3573032002930011', 'puri cempaka putih as 20', '081945503841', 'oc4080s4ksc04sckggsg0wgcccw4oo8owo48gogg'),
(6, 'Muhammad Handharbeni', 'mhandharbeni@gmail.com', '12345', '3573032002930011', 'puri cempaka putih as 20', '081945503841', 'o4wko4ogg0ckkswgcckoowwogggc0s4wskoggo00'),
(7, 'Muhammad Handharbeni', 'mhandharbeni@gmail.com', '12345', '3573032002930011', 'puri cempaka putih as 20', '081945503841', 'o0oksskks80k0ok8k8wswgocc8gss0goccsgw4s0');

-- --------------------------------------------------------

--
-- Table structure for table `tm_staff`
--

CREATE TABLE IF NOT EXISTS `tm_staff` (
`kode_staff` int(11) NOT NULL,
  `nama_staff` varchar(255) NOT NULL DEFAULT '0',
  `email_staff` varchar(255) NOT NULL DEFAULT '0',
  `password_staff` varchar(255) NOT NULL DEFAULT '0',
  `identitas_staff` varchar(255) NOT NULL DEFAULT '0',
  `status_login_staff` varchar(255) NOT NULL DEFAULT '0',
  `status_staff` varchar(255) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tm_supplier`
--

CREATE TABLE IF NOT EXISTS `tm_supplier` (
`kode_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(255) NOT NULL DEFAULT '0',
  `instansi_supplier` varchar(255) NOT NULL DEFAULT '0',
  `alamat_supplier` varchar(255) NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tm_usaha`
--

CREATE TABLE IF NOT EXISTS `tm_usaha` (
`kode_usaha` int(11) NOT NULL,
  `nama_usaha` varchar(255) NOT NULL,
  `alamat_usaha` varchar(255) NOT NULL,
  `telp_usaha` varchar(255) NOT NULL,
  `pin_usaha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tt_harga`
--

CREATE TABLE IF NOT EXISTS `tt_harga` (
  `kode_item` int(11) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_dasar` int(11) DEFAULT NULL,
  `harga_eceran` int(11) DEFAULT NULL,
  `harga_grosir` int(11) DEFAULT NULL,
  `harga_sales` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tt_item`
--

CREATE TABLE IF NOT EXISTS `tt_item` (
  `kode_usaha` int(11) DEFAULT NULL,
  `kode_item` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tt_pajak_item`
--

CREATE TABLE IF NOT EXISTS `tt_pajak_item` (
  `kode_item` int(11) DEFAULT NULL,
  `pajak` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tt_staff`
--

CREATE TABLE IF NOT EXISTS `tt_staff` (
  `kode_usaha` int(11) DEFAULT NULL,
  `kode_staff` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tt_stok`
--

CREATE TABLE IF NOT EXISTS `tt_stok` (
  `kode_item` int(11) DEFAULT NULL,
  `kode_transaksi` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0: Masuk/ 1:Keluar',
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tt_supplier`
--

CREATE TABLE IF NOT EXISTS `tt_supplier` (
  `kode_usaha` int(11) DEFAULT NULL,
  `kode_supplier` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tt_usaha`
--

CREATE TABLE IF NOT EXISTS `tt_usaha` (
  `kode_owner` int(11) DEFAULT NULL,
  `kode_usaha` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_beli`
--

CREATE TABLE IF NOT EXISTS `t_beli` (
`id` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL COMMENT 'table m_supplier_produk',
  `id_purchase_order` int(11) NOT NULL COMMENT 'ada kemungkinan isinya 0, karena untuk pembelian, tidak selalu lewat purchase order dahulu',
  `total_berat` int(11) NOT NULL COMMENT 'dalam gram',
  `total_qty` int(11) NOT NULL,
  `total_harga_beli` int(11) NOT NULL COMMENT 'hasil penjumlahan total harga beli dr beberapa barang',
  `catatan` text NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `total_harga` int(11) NOT NULL COMMENT 'jumlah*harga_beli'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_order`
--

CREATE TABLE IF NOT EXISTS `t_order` (
`id` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL COMMENT 'table m_customer',
  `detail_dropship` int(11) NOT NULL COMMENT 'isinya JSON',
  `total_berat` int(11) NOT NULL COMMENT 'dalam gram',
  `total_qty` int(11) NOT NULL,
  `biaya_kirim` int(11) NOT NULL COMMENT 'defaultnya 0, jika kirim sebagai dropship, maka isinya tidak 0',
  `total_harga_barang` int(11) NOT NULL COMMENT 'hanya total harga barang saja',
  `grand_total` int(11) NOT NULL COMMENT 'jumlah dr biaya_kirim dan total_harga_barang',
  `profit` int(11) NOT NULL,
  `catatan` text NOT NULL,
  `jenis_order` int(11) NOT NULL COMMENT '1 normal, 2 dropship',
  `status` int(11) NOT NULL COMMENT '1 booking, 2 antrian, 3 selesai',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  `id_metode_pembayaran` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_order_detail`
--

CREATE TABLE IF NOT EXISTS `t_order_detail` (
`id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL COMMENT 'table t_order',
  `id_produk` int(11) NOT NULL COMMENT 'table m_produk',
  `id_ukuran` int(11) NOT NULL COMMENT 'table m_produk_ukuran',
  `id_warna` int(11) NOT NULL COMMENT 'table m_produk_warna',
  `jumlah` int(11) NOT NULL,
  `total_berat` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL COMMENT 'diambil dr table m_produk_det_harga, sesuai level customer yg beli',
  `total_harga` int(11) NOT NULL COMMENT 'jumlah*harga_jual',
  `profit` int(11) NOT NULL COMMENT 'rumusnya : (harga_jual - harga_beli)',
  `nama_warna` varchar(100) DEFAULT NULL,
  `nama_ukuran` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_purchase_order`
--

CREATE TABLE IF NOT EXISTS `t_purchase_order` (
`id` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL COMMENT 'table m_supplier_produk',
  `catatan` text NOT NULL,
  `total_berat` int(11) NOT NULL COMMENT 'dalam gram',
  `total_qty` int(11) NOT NULL,
  `total_harga_beli` int(11) NOT NULL COMMENT 'hasil penjumlahan total harga beli dr beberapa barang',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_purchase_order_detail`
--

CREATE TABLE IF NOT EXISTS `t_purchase_order_detail` (
`id` int(11) NOT NULL,
  `id_purchase_order` int(11) NOT NULL COMMENT 'table t_purchase_order',
  `id_produk` int(11) NOT NULL COMMENT 'table m_produk',
  `id_ukuran` int(11) NOT NULL COMMENT 'table m_produk_ukuran',
  `id_warna` int(11) NOT NULL COMMENT 'table m_produk_warna',
  `jumlah` int(11) NOT NULL,
  `total_berat` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL COMMENT 'jumlah*harga_beli'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_retur`
--

CREATE TABLE IF NOT EXISTS `t_retur` (
`id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL COMMENT 'table t_order',
  `id_customer` int(11) NOT NULL COMMENT 'table m_customer',
  `catatan` text NOT NULL,
  `total_qty` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 belum diproses, 2 sudah diproses',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_retur_detail`
--

CREATE TABLE IF NOT EXISTS `t_retur_detail` (
`id` int(11) NOT NULL,
  `id_retur` int(11) NOT NULL COMMENT 'table t_retur',
  `id_produk` int(11) NOT NULL COMMENT 'table m_produk',
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL COMMENT 'diambil dr table t_order_detail, sesuai id_order nya',
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL COMMENT 'harga_jual*jumlah'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_service`
--

CREATE TABLE IF NOT EXISTS `t_service` (
`id` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL COMMENT 'table m_supplier_produk',
  `catatan` text NOT NULL,
  `jumlah_barang_service` int(11) NOT NULL COMMENT 'jumlah barang yang dikirim admin untuk di service ke supplier',
  `total_harga` int(11) NOT NULL COMMENT 'total harga barang yg di service, patokan nya ambil dr harga_beli',
  `jumlah_barang_kembali` int(11) NOT NULL COMMENT 'jika barang dikembalikan berupa barang lagi',
  `jumlah_uang_kembali` int(11) NOT NULL COMMENT 'jika barang dikembalikan berupa uang',
  `status` int(11) NOT NULL COMMENT '1 baru,2 proses pengembalian/belum dikembalikan semua oleh supplier,3 selesai',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_service_detail`
--

CREATE TABLE IF NOT EXISTS `t_service_detail` (
`id` int(11) NOT NULL,
  `id_service` int(11) NOT NULL COMMENT 'table t_service',
  `id_produk` int(11) NOT NULL COMMENT 'table m_produk',
  `harga_beli` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL COMMENT 'harga_beli*jumlah',
  `uang_kembali` int(11) NOT NULL COMMENT 'kolom ini != 0 jika admin pilih dikembalikan uang',
  `kurangi_stok` int(11) NOT NULL COMMENT '1 mengurangi stok, 2 tidak mengurani stok',
  `status` int(11) NOT NULL COMMENT '1 sedang di proses supplier,2 dikembalikan barang,3 dikembalikan uang, 4 dikembalikan uang dan barang',
  `jumlah_barang_kembali` int(11) DEFAULT NULL,
  `stok_kembali` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fin_kas`
--
ALTER TABLE `fin_kas`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fin_transfer_harian`
--
ALTER TABLE `fin_transfer_harian`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `h_login`
--
ALTER TABLE `h_login`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `h_stok_bahan`
--
ALTER TABLE `h_stok_bahan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `h_stok_produk`
--
ALTER TABLE `h_stok_produk`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `h_transaksi`
--
ALTER TABLE `h_transaksi`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_bahan`
--
ALTER TABLE `m_bahan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_bahan_kategori`
--
ALTER TABLE `m_bahan_kategori`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_bahan_warna`
--
ALTER TABLE `m_bahan_warna`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_bank`
--
ALTER TABLE `m_bank`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_customer`
--
ALTER TABLE `m_customer`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_customer_level`
--
ALTER TABLE `m_customer_level`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_gudang`
--
ALTER TABLE `m_gudang`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_kota`
--
ALTER TABLE `m_kota`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_metode_pembayaran`
--
ALTER TABLE `m_metode_pembayaran`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_pegawai`
--
ALTER TABLE `m_pegawai`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_pegawai_level`
--
ALTER TABLE `m_pegawai_level`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_pegawai_permission`
--
ALTER TABLE `m_pegawai_permission`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_produk`
--
ALTER TABLE `m_produk`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_produk_bahan`
--
ALTER TABLE `m_produk_bahan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_produk_katalog`
--
ALTER TABLE `m_produk_katalog`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_produk_kategori`
--
ALTER TABLE `m_produk_kategori`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_produk_ukuran`
--
ALTER TABLE `m_produk_ukuran`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_produk_warna`
--
ALTER TABLE `m_produk_warna`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_provinsi`
--
ALTER TABLE `m_provinsi`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_satuan`
--
ALTER TABLE `m_satuan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_supplier_bahan`
--
ALTER TABLE `m_supplier_bahan`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_supplier_produk`
--
ALTER TABLE `m_supplier_produk`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tm_item`
--
ALTER TABLE `tm_item`
 ADD PRIMARY KEY (`kode_item`);

--
-- Indexes for table `tm_jenis_item`
--
ALTER TABLE `tm_jenis_item`
 ADD PRIMARY KEY (`kode_jenis`);

--
-- Indexes for table `tm_owner`
--
ALTER TABLE `tm_owner`
 ADD PRIMARY KEY (`kode_owner`);

--
-- Indexes for table `tm_staff`
--
ALTER TABLE `tm_staff`
 ADD PRIMARY KEY (`kode_staff`);

--
-- Indexes for table `tm_supplier`
--
ALTER TABLE `tm_supplier`
 ADD PRIMARY KEY (`kode_supplier`);

--
-- Indexes for table `tm_usaha`
--
ALTER TABLE `tm_usaha`
 ADD PRIMARY KEY (`kode_usaha`);

--
-- Indexes for table `tt_harga`
--
ALTER TABLE `tt_harga`
 ADD KEY `FK__tm_item` (`kode_item`);

--
-- Indexes for table `tt_item`
--
ALTER TABLE `tt_item`
 ADD KEY `FK_tt_item_tm_usaha` (`kode_usaha`), ADD KEY `FK_tt_item_tm_item` (`kode_item`);

--
-- Indexes for table `tt_pajak_item`
--
ALTER TABLE `tt_pajak_item`
 ADD KEY `FK_tt_pajak_item_tm_item` (`kode_item`);

--
-- Indexes for table `tt_staff`
--
ALTER TABLE `tt_staff`
 ADD KEY `FK_tt_staff_tm_usaha` (`kode_usaha`), ADD KEY `FK_tt_staff_tm_staff` (`kode_staff`);

--
-- Indexes for table `tt_stok`
--
ALTER TABLE `tt_stok`
 ADD KEY `FK_tt_stok_tm_item` (`kode_item`);

--
-- Indexes for table `tt_supplier`
--
ALTER TABLE `tt_supplier`
 ADD KEY `FK__tm_usaha` (`kode_usaha`), ADD KEY `FK__tm_supplier` (`kode_supplier`);

--
-- Indexes for table `tt_usaha`
--
ALTER TABLE `tt_usaha`
 ADD KEY `FK_tt_usaha_tm_owner` (`kode_owner`), ADD KEY `FK_tt_usaha_tm_usaha` (`kode_usaha`);

--
-- Indexes for table `t_beli`
--
ALTER TABLE `t_beli`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_beli_detail`
--
ALTER TABLE `t_beli_detail`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_order`
--
ALTER TABLE `t_order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_order_detail`
--
ALTER TABLE `t_order_detail`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_purchase_order`
--
ALTER TABLE `t_purchase_order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_purchase_order_detail`
--
ALTER TABLE `t_purchase_order_detail`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_retur`
--
ALTER TABLE `t_retur`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_retur_detail`
--
ALTER TABLE `t_retur_detail`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_service`
--
ALTER TABLE `t_service`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_service_detail`
--
ALTER TABLE `t_service_detail`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fin_kas`
--
ALTER TABLE `fin_kas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fin_transfer_harian`
--
ALTER TABLE `fin_transfer_harian`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `h_login`
--
ALTER TABLE `h_login`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `h_stok_bahan`
--
ALTER TABLE `h_stok_bahan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `h_stok_produk`
--
ALTER TABLE `h_stok_produk`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `h_transaksi`
--
ALTER TABLE `h_transaksi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_bahan`
--
ALTER TABLE `m_bahan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_bahan_kategori`
--
ALTER TABLE `m_bahan_kategori`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_bahan_warna`
--
ALTER TABLE `m_bahan_warna`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_bank`
--
ALTER TABLE `m_bank`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_customer`
--
ALTER TABLE `m_customer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `m_customer_level`
--
ALTER TABLE `m_customer_level`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `m_gudang`
--
ALTER TABLE `m_gudang`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `m_kota`
--
ALTER TABLE `m_kota`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `m_metode_pembayaran`
--
ALTER TABLE `m_metode_pembayaran`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `m_pegawai`
--
ALTER TABLE `m_pegawai`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `m_pegawai_level`
--
ALTER TABLE `m_pegawai_level`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `m_pegawai_permission`
--
ALTER TABLE `m_pegawai_permission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `m_produk`
--
ALTER TABLE `m_produk`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_produk_bahan`
--
ALTER TABLE `m_produk_bahan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_produk_katalog`
--
ALTER TABLE `m_produk_katalog`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_produk_kategori`
--
ALTER TABLE `m_produk_kategori`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_produk_ukuran`
--
ALTER TABLE `m_produk_ukuran`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_produk_warna`
--
ALTER TABLE `m_produk_warna`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_provinsi`
--
ALTER TABLE `m_provinsi`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `m_satuan`
--
ALTER TABLE `m_satuan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `m_supplier_bahan`
--
ALTER TABLE `m_supplier_bahan`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `m_supplier_produk`
--
ALTER TABLE `m_supplier_produk`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_item`
--
ALTER TABLE `tm_item`
MODIFY `kode_item` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_jenis_item`
--
ALTER TABLE `tm_jenis_item`
MODIFY `kode_jenis` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_owner`
--
ALTER TABLE `tm_owner`
MODIFY `kode_owner` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `tm_staff`
--
ALTER TABLE `tm_staff`
MODIFY `kode_staff` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_supplier`
--
ALTER TABLE `tm_supplier`
MODIFY `kode_supplier` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tm_usaha`
--
ALTER TABLE `tm_usaha`
MODIFY `kode_usaha` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_beli`
--
ALTER TABLE `t_beli`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_beli_detail`
--
ALTER TABLE `t_beli_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_order`
--
ALTER TABLE `t_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_order_detail`
--
ALTER TABLE `t_order_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_purchase_order`
--
ALTER TABLE `t_purchase_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_purchase_order_detail`
--
ALTER TABLE `t_purchase_order_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_retur`
--
ALTER TABLE `t_retur`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_retur_detail`
--
ALTER TABLE `t_retur_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_service`
--
ALTER TABLE `t_service`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `t_service_detail`
--
ALTER TABLE `t_service_detail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tt_harga`
--
ALTER TABLE `tt_harga`
ADD CONSTRAINT `FK__tm_item` FOREIGN KEY (`kode_item`) REFERENCES `tm_item` (`kode_item`);

--
-- Constraints for table `tt_item`
--
ALTER TABLE `tt_item`
ADD CONSTRAINT `FK_tt_item_tm_item` FOREIGN KEY (`kode_item`) REFERENCES `tm_item` (`kode_item`),
ADD CONSTRAINT `FK_tt_item_tm_usaha` FOREIGN KEY (`kode_usaha`) REFERENCES `tm_usaha` (`kode_usaha`);

--
-- Constraints for table `tt_pajak_item`
--
ALTER TABLE `tt_pajak_item`
ADD CONSTRAINT `FK_tt_pajak_item_tm_item` FOREIGN KEY (`kode_item`) REFERENCES `tm_item` (`kode_item`);

--
-- Constraints for table `tt_staff`
--
ALTER TABLE `tt_staff`
ADD CONSTRAINT `FK_tt_staff_tm_staff` FOREIGN KEY (`kode_staff`) REFERENCES `tm_staff` (`kode_staff`),
ADD CONSTRAINT `FK_tt_staff_tm_usaha` FOREIGN KEY (`kode_usaha`) REFERENCES `tm_usaha` (`kode_usaha`);

--
-- Constraints for table `tt_stok`
--
ALTER TABLE `tt_stok`
ADD CONSTRAINT `FK_tt_stok_tm_item` FOREIGN KEY (`kode_item`) REFERENCES `tm_item` (`kode_item`);

--
-- Constraints for table `tt_supplier`
--
ALTER TABLE `tt_supplier`
ADD CONSTRAINT `FK__tm_supplier` FOREIGN KEY (`kode_supplier`) REFERENCES `tm_supplier` (`kode_supplier`),
ADD CONSTRAINT `FK__tm_usaha` FOREIGN KEY (`kode_usaha`) REFERENCES `tm_usaha` (`kode_usaha`);

--
-- Constraints for table `tt_usaha`
--
ALTER TABLE `tt_usaha`
ADD CONSTRAINT `FK_tt_usaha_tm_owner` FOREIGN KEY (`kode_owner`) REFERENCES `tm_owner` (`kode_owner`),
ADD CONSTRAINT `FK_tt_usaha_tm_usaha` FOREIGN KEY (`kode_usaha`) REFERENCES `tm_usaha` (`kode_usaha`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
