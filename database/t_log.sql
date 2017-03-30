-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.54-0ubuntu0.14.04.1 - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             9.4.0.5168
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table pos.t_log
DROP TABLE IF EXISTS `t_log`;
CREATE TABLE IF NOT EXISTS `t_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `modul` varchar(255) DEFAULT NULL,
  `fungsi` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

-- Dumping data for table pos.t_log: ~61 rows (approximately)
/*!40000 ALTER TABLE `t_log` DISABLE KEYS */;
INSERT INTO `t_log` (`id`, `id_user`, `modul`, `fungsi`) VALUES
	(1, 1, 'Bahanbaku/Master', 'index'),
	(2, 1, 'Bahanbaku/Master', 'data'),
	(3, 1, 'Bahanbaku/Master', 'edit'),
	(4, 1, 'Bahanbaku/Master', 'Insert Detail'),
	(5, 1, 'Bahanbaku/Master', 'data'),
	(6, 1, 'Bahan_baku/Master', 'index'),
	(7, 1, 'Bahan_baku/Master', 'data'),
	(8, 1, 'Bahan_baku/Master', 'index'),
	(9, 1, 'Bahan_baku/Master', 'data'),
	(10, 1, 'index', 'modul'),
	(11, 1, 'Master', 'data'),
	(12, 1, 'Master', 'edit'),
	(13, 1, 'Master', 'edit'),
	(14, 1, 'Master', 'data'),
	(15, 1, 'Bahan_bakuMaster', 'edit'),
	(16, 1, 'Bahan_bakuMaster', 'add'),
	(17, 1, 'Bahan_baku/index', 'modul'),
	(18, 1, 'Bahan_baku/Master', 'data'),
	(19, 1, 'Bahan_baku/index', 'modul'),
	(20, 1, 'Bahan_baku/Master', 'data'),
	(21, 1, 'Bahan_baku/Master', 'edit'),
	(22, 1, 'Bahan_baku/Master', 'edit'),
	(23, 1, 'Bahan_baku/Master', 'data'),
	(24, 1, 'Transaksi_retur/index', 'modul'),
	(25, 1, 'Transaksi_retur/Transaksi', 'data'),
	(26, 1, 'Transaksi_penjualan/index', 'modul'),
	(27, 1, 'Transaksi_penjualan/Transaksi', 'tambahCart'),
	(28, 1, 'Transaksi_penjualan/Transaksi', 'getTotal'),
	(29, 1, 'Transaksi_penjualan/Transaksi', 'tambahCart'),
	(30, 1, 'Transaksi_penjualan/Transaksi', 'getTotal'),
	(31, 1, 'Transaksi_penjualan/Transaksi', 'tambahCart'),
	(32, 1, 'Transaksi_penjualan/Transaksi', 'getTotal'),
	(33, 1, 'Transaksi_penjualan/Transaksi', 'tambahCart'),
	(34, 1, 'Transaksi_penjualan/Transaksi', 'getTotal'),
	(35, 1, 'Transaksi_penjualan/Transaksi', 'tambahCart'),
	(36, 1, 'Transaksi_penjualan/Transaksi', 'getTotal'),
	(37, 1, 'Transaksi_penjualan/Transaksi', 'payment'),
	(38, 1, 'Transaksi_penjualan/Transaksi', 'getTotal'),
	(39, 1, 'Transaksi_penjualan/Transaksi', 'invoices'),
	(40, 1, 'Transaksi_penjualan/Transaksi', 'invoices'),
	(41, 1, 'Transaksi_penjualan/Transaksi', 'invoices'),
	(42, NULL, 'Transaksi_retur/index', 'modul'),
	(43, NULL, 'Bahan_baku/index', 'modul'),
	(44, NULL, 'Bahan_baku/index', 'modul'),
	(45, NULL, 'Bahan_baku/index', 'modul'),
	(46, 1, 'Master_pegawai/index', 'modul'),
	(47, 1, 'Transaksi_penjualan/Transaksi', 'tambahCart'),
	(48, 1, 'Transaksi_penjualan/Transaksi', 'getTotal'),
	(49, 1, 'Transaksi_penjualan/Transaksi', 'tambahCart'),
	(50, 1, 'Transaksi_penjualan/Transaksi', 'getTotal'),
	(51, 1, 'Transaksi_penjualan/Transaksi', 'tambahCart'),
	(52, 1, 'Transaksi_penjualan/Transaksi', 'tambahCart'),
	(53, 1, 'Transaksi_penjualan/Transaksi', 'getTotal'),
	(54, 1, 'Transaksi_penjualan/Transaksi', 'getTotal'),
	(55, 1, 'Transaksi_penjualan/Transaksi', 'tambahCart'),
	(56, 1, 'Transaksi_penjualan/Transaksi', 'getTotal'),
	(57, 1, 'Transaksi_penjualan/Transaksi', 'tambahCart'),
	(58, 1, 'Transaksi_penjualan/Transaksi', 'getTotal'),
	(59, 1, 'Transaksi_penjualan/Transaksi', 'tambahCart'),
	(60, 1, 'Transaksi_penjualan/Transaksi', 'getTotal'),
	(61, 1, 'Master_pegawai/index', 'modul'),
	(62, 1, 'Produk_kategori/index', 'modul'),
	(63, 1, 'Produk_ukuran/index', 'modul'),
	(64, 1, 'Produk_ukuran/Master', 'add'),
	(65, 1, 'Produk_ukuran/Master', 'delete'),
	(66, 1, 'Produk_ukuran/index', 'modul'),
	(67, 1, 'Produk_kategori/index', 'modul'),
	(68, 1, 'Master_hak_akses/index', 'modul'),
	(69, 1, 'Master_pegawai/index', 'modul'),
	(70, 1, 'Master_hak_akses/index', 'modul'),
	(71, 1, 'Produk_kategori/index', 'modul'),
	(72, 1, 'Produk_kategori/index', 'modul'),
	(73, 1, 'Produk_kategori/Master', 'edit'),
	(74, 1, 'Master_pegawai/index', 'modul'),
	(75, 1, 'Master_pegawai/index', 'modul'),
	(76, 1, 'Master_pegawai/index', 'modul'),
	(77, NULL, 'Master_pegawai/index', 'modul'),
	(78, 1, 'Master_pegawai/index', 'modul'),
	(79, 1, 'Master_pegawai/index', 'modul'),
	(80, 1, 'Master_pegawai/index', 'modul'),
	(81, 1, 'Master_pegawai/index', 'modul');
/*!40000 ALTER TABLE `t_log` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
