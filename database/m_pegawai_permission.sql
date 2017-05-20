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
-- Table structure for table `m_pegawai_permission`
--

CREATE TABLE IF NOT EXISTS `m_pegawai_permission` (
`id` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `url` text NOT NULL COMMENT 'url segment setelah base_url()',
  `icon_class` varchar(50) NOT NULL COMMENT 'additional class untuk icon menu',
  `urutan` int(3) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `deleted` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 = Aktif, 0 = Terhapus'
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `m_pegawai_permission`
--

INSERT INTO `m_pegawai_permission` (`id`, `id_menu`, `nama`, `url`, `icon_class`, `urutan`, `date_add`, `deleted`) VALUES
(1, 1, 'Provinsi', 'index/modul/Master_provinsi-master-index', '', 1, '2017-05-19 02:02:30', 1),
(2, 1, 'Kota', 'index/modul/Master_kota-master-index', '', 2, '2017-05-19 02:02:58', 1),
(3, 1, 'Hak Akses', 'index/modul/Master_hak_akses-master-index', '', 3, '2017-05-19 02:02:59', 1),
(4, 1, 'Pegawai', 'index/modul/Master_pegawai-master-index', '', 4, '2017-05-19 02:02:59', 1),
(5, 1, 'Customer Level', 'index/modul/Master_customer_level-master-index', '', 5, '2017-05-19 02:03:00', 1),
(6, 1, 'Customer', 'index/modul/Master_customer-master-index', '', 6, '2017-05-19 02:03:00', 1),
(7, 1, 'Supplier Produk', 'index/modul/Master_supplier_produk-master-index', '', 7, '2017-05-19 02:03:01', 1),
(8, 1, 'Supplier Bahan', 'index/modul/Master_supplier_bahan-master-index', '', 8, '2017-05-19 02:03:02', 1),
(9, 1, 'Lokasi Gudang', 'index/modul/Master_gudang-master-index', '', 9, '2017-05-19 02:03:02', 1),
(10, 1, 'Metode Pembayaran', 'index/modul/Master_metode_pembayaran-master-index', '', 10, '2017-05-19 02:03:05', 1),
(11, 1, 'Satuan', 'index/modul/Master_satuan-master-index', '', 11, '2017-05-19 02:03:06', 1),
(12, 1, 'Bank', 'index/modul/Master_bank-master-index', '', 12, '2017-05-19 02:03:08', 1),
(13, 2, 'Kategori', 'index/modul/Produk_kategori-master-index', '', 1, '2017-05-19 02:01:13', 1),
(14, 2, 'Bahan', 'index/modul/Produk_bahan-master-index', '', 2, '2017-05-19 02:01:16', 1),
(15, 2, 'Ukuran', 'index/modul/Produk_ukuran-master-index', '', 3, '2017-05-19 02:01:19', 1),
(16, 2, 'Warna', 'index/modul/Produk_warna-master-index', '', 4, '2017-05-19 02:01:22', 1),
(17, 2, 'Edisi Katalog', 'index/modul/Produk_katalog-master-index', '', 6, '2017-05-19 02:01:26', 1),
(18, 2, 'Semua Produk', 'index/modul/Produk-master-index', '', 7, '2017-05-19 02:01:29', 1),
(19, 3, 'Kategori', 'index/modul/Bahan_baku_kategori-master-index', '', 1, '2017-05-19 02:03:11', 1),
(20, 3, 'Warna', 'index/modul/Bahan_baku_warna-master-index', '', 2, '2017-05-19 02:03:11', 1),
(21, 3, 'Semua Bahan', 'index/modul/Bahan_baku-master-index', '', 3, '2017-05-19 02:03:11', 1),
(22, 4, 'Input Barang Masuk', 'index/modul/Transaksi_barangmasuk-transaksi-index', '', 1, '2017-05-19 02:03:14', 1),
(23, 4, 'Input Bahan Masuk', 'index/modul/Transaksi_bahanmasuk-transaksi-index', '', 2, '2017-05-19 02:03:14', 1),
(24, 4, 'Purchase Order', 'index/modul/Transaksi_purchaseorder-transaksi-index', '', 3, '2017-05-19 02:03:15', 1),
(25, 4, 'Pembelian', 'index/modul/Transaksi_pembelian-transaksi-index', '', 4, '2017-05-19 02:03:16', 1),
(26, 4, 'Penjualan', 'index/modul/Transaksi_penjualan-transaksi-index', '', 5, '2017-05-19 02:03:17', 1),
(27, 4, 'Dropship', 'index/modul/Transaksi_dropship-transaksi-index', '', 6, '2017-05-19 02:03:17', 1),
(28, 4, 'Retur', 'index/modul/Transaksi_retur-transaksi-index', '', 7, '2017-05-19 02:03:20', 1),
(29, 5, 'Semua Stok', 'index/modul/Stok-master-index', '', 1, '2017-05-19 02:03:27', 1),
(30, 5, 'Pesanan', 'index/modul/Stok_pesanan-master-index', '', 2, '2017-05-19 02:03:28', 1),
(31, 5, 'Service', 'index/modul/Stok_service-transaksi-index', '', 3, '2017-05-19 02:03:29', 1),
(32, 6, 'Penjualan', 'index/modul/Laporan_penjualan-master-index', '', 1, '2017-05-19 02:03:33', 1),
(33, 6, 'Pembelian', 'index/modul/Laporan_pembelian-master-index', '', 2, '2017-05-19 02:03:33', 1),
(34, 6, 'TOP Member', 'index/modul/Laporan_top_member-master-index', '', 3, '2017-05-19 02:03:34', 1),
(35, 6, 'Best Seller', 'index/modul/Laporan_best_seller-master-index', '', 4, '2017-05-19 02:03:35', 1),
(36, 6, 'Stok', 'index/modul/Laporan_stok-master-index', '', 5, '2017-05-19 02:03:35', 1),
(37, 7, 'Kas Kecil', 'index/modul/Finance_kas-master-index', '', 1, '2017-05-19 02:03:37', 1),
(38, 7, 'Transfer Harian', 'index/modul/Finance_transfer-master-index', '', 2, '2017-05-19 02:03:38', 1),
(39, 8, 'Log Aktivitas', 'index/modul/Log_aktivitas-log-index', '', 1, '2017-05-19 02:03:40', 1),
(40, 2, 'Merk', 'index/modul/Produk_merk-master-index', '', 5, '2017-05-19 02:01:36', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_pegawai_permission`
--
ALTER TABLE `m_pegawai_permission`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_pegawai_permission`
--
ALTER TABLE `m_pegawai_permission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
