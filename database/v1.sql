-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.54-0ubuntu0.14.04.1 - (Ubuntu)
-- Server OS:                    debian-linux-gnu
-- HeidiSQL Version:             9.4.0.5154
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for pos
CREATE DATABASE IF NOT EXISTS `pos` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pos`;

-- Dumping structure for table pos.h_login
CREATE TABLE IF NOT EXISTS `h_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL COMMENT '1 login, 2 logout',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `add_by` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.h_login: ~0 rows (approximately)
/*!40000 ALTER TABLE `h_login` DISABLE KEYS */;
/*!40000 ALTER TABLE `h_login` ENABLE KEYS */;

-- Dumping structure for table pos.h_stok_bahan
CREATE TABLE IF NOT EXISTS `h_stok_bahan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_bahan` int(11) NOT NULL COMMENT 'table m_bahan',
  `jumlah` int(11) NOT NULL COMMENT 'stok yang berkurang atau bertambah',
  `stok_akhir` int(11) NOT NULL COMMENT 'stok setelah dijumlah atau di dikurangi',
  `keterangan` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 berkurang, 2 bertambah',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.h_stok_bahan: ~0 rows (approximately)
/*!40000 ALTER TABLE `h_stok_bahan` DISABLE KEYS */;
/*!40000 ALTER TABLE `h_stok_bahan` ENABLE KEYS */;

-- Dumping structure for table pos.h_stok_produk
CREATE TABLE IF NOT EXISTS `h_stok_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` int(11) NOT NULL COMMENT ' 0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.h_stok_produk: ~0 rows (approximately)
/*!40000 ALTER TABLE `h_stok_produk` DISABLE KEYS */;
/*!40000 ALTER TABLE `h_stok_produk` ENABLE KEYS */;

-- Dumping structure for table pos.m_bahan
CREATE TABLE IF NOT EXISTS `m_bahan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `versi_foto` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_bahan: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_bahan` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_bahan` ENABLE KEYS */;

-- Dumping structure for table pos.m_bahan_det_warna
CREATE TABLE IF NOT EXISTS `m_bahan_det_warna` (
  `id_bahan` int(11) NOT NULL COMMENT 'm_bahan',
  `id_warna` int(11) NOT NULL COMMENT 'table m_produk_warna'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_bahan_det_warna: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_bahan_det_warna` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_bahan_det_warna` ENABLE KEYS */;

-- Dumping structure for table pos.m_bahan_kategori
CREATE TABLE IF NOT EXISTS `m_bahan_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_bahan_kategori: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_bahan_kategori` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_bahan_kategori` ENABLE KEYS */;

-- Dumping structure for table pos.m_bahan_warna
CREATE TABLE IF NOT EXISTS `m_bahan_warna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_bahan_warna: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_bahan_warna` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_bahan_warna` ENABLE KEYS */;

-- Dumping structure for table pos.m_customer
CREATE TABLE IF NOT EXISTS `m_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_customer: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_customer` ENABLE KEYS */;

-- Dumping structure for table pos.m_customer_level
CREATE TABLE IF NOT EXISTS `m_customer_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_customer_level: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_customer_level` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_customer_level` ENABLE KEYS */;

-- Dumping structure for table pos.m_gudang
CREATE TABLE IF NOT EXISTS `m_gudang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_gudang: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_gudang` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_gudang` ENABLE KEYS */;

-- Dumping structure for table pos.m_kota
CREATE TABLE IF NOT EXISTS `m_kota` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_provinsi` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_kota: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_kota` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_kota` ENABLE KEYS */;

-- Dumping structure for table pos.m_metode_pembayaran
CREATE TABLE IF NOT EXISTS `m_metode_pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_metode_pembayaran: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_metode_pembayaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_metode_pembayaran` ENABLE KEYS */;

-- Dumping structure for table pos.m_pegawai
CREATE TABLE IF NOT EXISTS `m_pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_pegawai: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_pegawai` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_pegawai` ENABLE KEYS */;

-- Dumping structure for table pos.m_pegawai_level
CREATE TABLE IF NOT EXISTS `m_pegawai_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `permission` text NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_pegawai_level: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_pegawai_level` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_pegawai_level` ENABLE KEYS */;

-- Dumping structure for table pos.m_pegawai_permission
CREATE TABLE IF NOT EXISTS `m_pegawai_permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_pegawai_permission: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_pegawai_permission` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_pegawai_permission` ENABLE KEYS */;

-- Dumping structure for table pos.m_produk
CREATE TABLE IF NOT EXISTS `m_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `versi_foto` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_produk: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_produk` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_produk` ENABLE KEYS */;

-- Dumping structure for table pos.m_produk_bahan
CREATE TABLE IF NOT EXISTS `m_produk_bahan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `adited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_produk_bahan: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_produk_bahan` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_produk_bahan` ENABLE KEYS */;

-- Dumping structure for table pos.m_produk_det_harga
CREATE TABLE IF NOT EXISTS `m_produk_det_harga` (
  `id_produk` int(11) NOT NULL COMMENT 'table m_produk',
  `id_customer_level` int(11) NOT NULL COMMENT 'table m_customer_level',
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_produk_det_harga: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_produk_det_harga` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_produk_det_harga` ENABLE KEYS */;

-- Dumping structure for table pos.m_produk_det_ukuran
CREATE TABLE IF NOT EXISTS `m_produk_det_ukuran` (
  `id_produk` int(11) NOT NULL COMMENT 'table m_produk',
  `id_ukuran` int(11) NOT NULL COMMENT 'table m_produk_ukuran'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_produk_det_ukuran: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_produk_det_ukuran` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_produk_det_ukuran` ENABLE KEYS */;

-- Dumping structure for table pos.m_produk_det_warna
CREATE TABLE IF NOT EXISTS `m_produk_det_warna` (
  `id_produk` int(11) NOT NULL COMMENT 'm_produk',
  `id_warna` int(11) NOT NULL COMMENT 'table m_produk_warna'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_produk_det_warna: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_produk_det_warna` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_produk_det_warna` ENABLE KEYS */;

-- Dumping structure for table pos.m_produk_katalog
CREATE TABLE IF NOT EXISTS `m_produk_katalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_produk_katalog: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_produk_katalog` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_produk_katalog` ENABLE KEYS */;

-- Dumping structure for table pos.m_produk_kategori
CREATE TABLE IF NOT EXISTS `m_produk_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_produk_kategori: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_produk_kategori` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_produk_kategori` ENABLE KEYS */;

-- Dumping structure for table pos.m_produk_ukuran
CREATE TABLE IF NOT EXISTS `m_produk_ukuran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `adited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_produk_ukuran: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_produk_ukuran` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_produk_ukuran` ENABLE KEYS */;

-- Dumping structure for table pos.m_produk_warna
CREATE TABLE IF NOT EXISTS `m_produk_warna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `adited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_produk_warna: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_produk_warna` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_produk_warna` ENABLE KEYS */;

-- Dumping structure for table pos.m_provinsi
CREATE TABLE IF NOT EXISTS `m_provinsi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_provinsi: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_provinsi` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_provinsi` ENABLE KEYS */;

-- Dumping structure for table pos.m_satuan
CREATE TABLE IF NOT EXISTS `m_satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_satuan: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_satuan` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_satuan` ENABLE KEYS */;

-- Dumping structure for table pos.m_supplier_bahan
CREATE TABLE IF NOT EXISTS `m_supplier_bahan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(150) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `id_provinsi` int(11) NOT NULL,
  `id_kota` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_supplier_bahan: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_supplier_bahan` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_supplier_bahan` ENABLE KEYS */;

-- Dumping structure for table pos.m_supplier_produk
CREATE TABLE IF NOT EXISTS `m_supplier_produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.m_supplier_produk: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_supplier_produk` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_supplier_produk` ENABLE KEYS */;

-- Dumping structure for table pos.tm_item
CREATE TABLE IF NOT EXISTS `tm_item` (
  `kode_item` int(11) NOT NULL AUTO_INCREMENT,
  `nama_item` varchar(50) DEFAULT NULL,
  `deskripsi_item` varchar(50) DEFAULT NULL,
  `sku_item` varchar(50) DEFAULT NULL,
  `barcode_item` varchar(50) DEFAULT NULL,
  `image_item` varchar(50) DEFAULT NULL,
  `status_item` int(11) DEFAULT NULL,
  PRIMARY KEY (`kode_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.tm_item: ~0 rows (approximately)
/*!40000 ALTER TABLE `tm_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_item` ENABLE KEYS */;

-- Dumping structure for table pos.tm_jenis_item
CREATE TABLE IF NOT EXISTS `tm_jenis_item` (
  `kode_jenis` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kode_jenis`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.tm_jenis_item: ~0 rows (approximately)
/*!40000 ALTER TABLE `tm_jenis_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_jenis_item` ENABLE KEYS */;

-- Dumping structure for table pos.tm_owner
CREATE TABLE IF NOT EXISTS `tm_owner` (
  `kode_owner` int(11) NOT NULL AUTO_INCREMENT,
  `nama_owner` varchar(255) NOT NULL DEFAULT '0',
  `email_owner` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `identitas_owner` varchar(255) NOT NULL DEFAULT '0',
  `alamat_owner` varchar(255) NOT NULL DEFAULT '0',
  `telp_owner` varchar(255) NOT NULL DEFAULT '0',
  `key_owner` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kode_owner`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table pos.tm_owner: ~7 rows (approximately)
/*!40000 ALTER TABLE `tm_owner` DISABLE KEYS */;
INSERT IGNORE INTO `tm_owner` (`kode_owner`, `nama_owner`, `email_owner`, `password`, `identitas_owner`, `alamat_owner`, `telp_owner`, `key_owner`) VALUES
	(1, 'Muhammad Handharbeni', 'mhandharbeni@gmail.com', '12345', '3573032002930011', 'puri cempaka putih as 20', '081945503841', 'c4880o04swckowo8c8cwccck80448404c0s8008c'),
	(2, 'Muhammad Handharbeni', 'mhandharbeni@gmail.com', '12345', '3573032002930011', 'puri cempaka putih as 20', '081945503841', 'g44k8wsk88k844w4c048gw40gc8wscgc8s40ckos'),
	(3, 'Muhammad Handharbeni', 'mhandharbeni@gmail.com', '12345', '3573032002930011', 'puri cempaka putih as 20', '081945503841', 'cs0sk4okksc4skk0004k4c8sw48ks4ccw4ss0008'),
	(4, 'Muhammad Handharbeni', 'mhandharbeni@gmail.com', '12345', '3573032002930011', 'puri cempaka putih as 20', '081945503841', 'kk0gw0kows0gck8kso4csk4go8k8wogcgw40csgc'),
	(5, 'Muhammad Handharbeni', 'mhandharbeni@gmail.com', '12345', '3573032002930011', 'puri cempaka putih as 20', '081945503841', 'oc4080s4ksc04sckggsg0wgcccw4oo8owo48gogg'),
	(6, 'Muhammad Handharbeni', 'mhandharbeni@gmail.com', '12345', '3573032002930011', 'puri cempaka putih as 20', '081945503841', 'o4wko4ogg0ckkswgcckoowwogggc0s4wskoggo00'),
	(7, 'Muhammad Handharbeni', 'mhandharbeni@gmail.com', '12345', '3573032002930011', 'puri cempaka putih as 20', '081945503841', 'o0oksskks80k0ok8k8wswgocc8gss0goccsgw4s0');
/*!40000 ALTER TABLE `tm_owner` ENABLE KEYS */;

-- Dumping structure for table pos.tm_staff
CREATE TABLE IF NOT EXISTS `tm_staff` (
  `kode_staff` int(11) NOT NULL AUTO_INCREMENT,
  `nama_staff` varchar(255) NOT NULL DEFAULT '0',
  `email_staff` varchar(255) NOT NULL DEFAULT '0',
  `password_staff` varchar(255) NOT NULL DEFAULT '0',
  `identitas_staff` varchar(255) NOT NULL DEFAULT '0',
  `status_login_staff` varchar(255) NOT NULL DEFAULT '0',
  `status_staff` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`kode_staff`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.tm_staff: ~0 rows (approximately)
/*!40000 ALTER TABLE `tm_staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_staff` ENABLE KEYS */;

-- Dumping structure for table pos.tm_supplier
CREATE TABLE IF NOT EXISTS `tm_supplier` (
  `kode_supplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_supplier` varchar(255) NOT NULL DEFAULT '0',
  `instansi_supplier` varchar(255) NOT NULL DEFAULT '0',
  `alamat_supplier` varchar(255) NOT NULL DEFAULT '0',
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  PRIMARY KEY (`kode_supplier`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.tm_supplier: ~0 rows (approximately)
/*!40000 ALTER TABLE `tm_supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_supplier` ENABLE KEYS */;

-- Dumping structure for table pos.tm_usaha
CREATE TABLE IF NOT EXISTS `tm_usaha` (
  `kode_usaha` int(11) NOT NULL AUTO_INCREMENT,
  `nama_usaha` varchar(255) NOT NULL,
  `alamat_usaha` varchar(255) NOT NULL,
  `telp_usaha` varchar(255) NOT NULL,
  `pin_usaha` varchar(255) NOT NULL,
  PRIMARY KEY (`kode_usaha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.tm_usaha: ~0 rows (approximately)
/*!40000 ALTER TABLE `tm_usaha` DISABLE KEYS */;
/*!40000 ALTER TABLE `tm_usaha` ENABLE KEYS */;

-- Dumping structure for table pos.tt_harga
CREATE TABLE IF NOT EXISTS `tt_harga` (
  `kode_item` int(11) DEFAULT NULL,
  `harga_beli` int(11) DEFAULT NULL,
  `harga_dasar` int(11) DEFAULT NULL,
  `harga_eceran` int(11) DEFAULT NULL,
  `harga_grosir` int(11) DEFAULT NULL,
  `harga_sales` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` int(11) DEFAULT NULL,
  KEY `FK__tm_item` (`kode_item`),
  CONSTRAINT `FK__tm_item` FOREIGN KEY (`kode_item`) REFERENCES `tm_item` (`kode_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.tt_harga: ~0 rows (approximately)
/*!40000 ALTER TABLE `tt_harga` DISABLE KEYS */;
/*!40000 ALTER TABLE `tt_harga` ENABLE KEYS */;

-- Dumping structure for table pos.tt_item
CREATE TABLE IF NOT EXISTS `tt_item` (
  `kode_usaha` int(11) DEFAULT NULL,
  `kode_item` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` time DEFAULT NULL,
  KEY `FK_tt_item_tm_usaha` (`kode_usaha`),
  KEY `FK_tt_item_tm_item` (`kode_item`),
  CONSTRAINT `FK_tt_item_tm_item` FOREIGN KEY (`kode_item`) REFERENCES `tm_item` (`kode_item`),
  CONSTRAINT `FK_tt_item_tm_usaha` FOREIGN KEY (`kode_usaha`) REFERENCES `tm_usaha` (`kode_usaha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.tt_item: ~0 rows (approximately)
/*!40000 ALTER TABLE `tt_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `tt_item` ENABLE KEYS */;

-- Dumping structure for table pos.tt_pajak_item
CREATE TABLE IF NOT EXISTS `tt_pajak_item` (
  `kode_item` int(11) DEFAULT NULL,
  `pajak` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` time DEFAULT NULL,
  KEY `FK_tt_pajak_item_tm_item` (`kode_item`),
  CONSTRAINT `FK_tt_pajak_item_tm_item` FOREIGN KEY (`kode_item`) REFERENCES `tm_item` (`kode_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.tt_pajak_item: ~0 rows (approximately)
/*!40000 ALTER TABLE `tt_pajak_item` DISABLE KEYS */;
/*!40000 ALTER TABLE `tt_pajak_item` ENABLE KEYS */;

-- Dumping structure for table pos.tt_staff
CREATE TABLE IF NOT EXISTS `tt_staff` (
  `kode_usaha` int(11) DEFAULT NULL,
  `kode_staff` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` time DEFAULT NULL,
  KEY `FK_tt_staff_tm_usaha` (`kode_usaha`),
  KEY `FK_tt_staff_tm_staff` (`kode_staff`),
  CONSTRAINT `FK_tt_staff_tm_staff` FOREIGN KEY (`kode_staff`) REFERENCES `tm_staff` (`kode_staff`),
  CONSTRAINT `FK_tt_staff_tm_usaha` FOREIGN KEY (`kode_usaha`) REFERENCES `tm_usaha` (`kode_usaha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.tt_staff: ~0 rows (approximately)
/*!40000 ALTER TABLE `tt_staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `tt_staff` ENABLE KEYS */;

-- Dumping structure for table pos.tt_stok
CREATE TABLE IF NOT EXISTS `tt_stok` (
  `kode_item` int(11) DEFAULT NULL,
  `kode_transaksi` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `status` int(11) DEFAULT NULL COMMENT '0: Masuk/ 1:Keluar',
  `quantity` int(11) DEFAULT NULL,
  KEY `FK_tt_stok_tm_item` (`kode_item`),
  CONSTRAINT `FK_tt_stok_tm_item` FOREIGN KEY (`kode_item`) REFERENCES `tm_item` (`kode_item`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.tt_stok: ~0 rows (approximately)
/*!40000 ALTER TABLE `tt_stok` DISABLE KEYS */;
/*!40000 ALTER TABLE `tt_stok` ENABLE KEYS */;

-- Dumping structure for table pos.tt_supplier
CREATE TABLE IF NOT EXISTS `tt_supplier` (
  `kode_usaha` int(11) DEFAULT NULL,
  `kode_supplier` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` time DEFAULT NULL,
  KEY `FK__tm_usaha` (`kode_usaha`),
  KEY `FK__tm_supplier` (`kode_supplier`),
  CONSTRAINT `FK__tm_supplier` FOREIGN KEY (`kode_supplier`) REFERENCES `tm_supplier` (`kode_supplier`),
  CONSTRAINT `FK__tm_usaha` FOREIGN KEY (`kode_usaha`) REFERENCES `tm_usaha` (`kode_usaha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.tt_supplier: ~0 rows (approximately)
/*!40000 ALTER TABLE `tt_supplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `tt_supplier` ENABLE KEYS */;

-- Dumping structure for table pos.tt_usaha
CREATE TABLE IF NOT EXISTS `tt_usaha` (
  `kode_owner` int(11) DEFAULT NULL,
  `kode_usaha` int(11) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu` time DEFAULT NULL,
  KEY `FK_tt_usaha_tm_owner` (`kode_owner`),
  KEY `FK_tt_usaha_tm_usaha` (`kode_usaha`),
  CONSTRAINT `FK_tt_usaha_tm_owner` FOREIGN KEY (`kode_owner`) REFERENCES `tm_owner` (`kode_owner`),
  CONSTRAINT `FK_tt_usaha_tm_usaha` FOREIGN KEY (`kode_usaha`) REFERENCES `tm_usaha` (`kode_usaha`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.tt_usaha: ~0 rows (approximately)
/*!40000 ALTER TABLE `tt_usaha` DISABLE KEYS */;
/*!40000 ALTER TABLE `tt_usaha` ENABLE KEYS */;

-- Dumping structure for table pos.t_beli
CREATE TABLE IF NOT EXISTS `t_beli` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.t_beli: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_beli` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_beli` ENABLE KEYS */;

-- Dumping structure for table pos.t_beli_detail
CREATE TABLE IF NOT EXISTS `t_beli_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_beli` int(11) NOT NULL COMMENT 'table t_beli',
  `id_produk` int(11) NOT NULL COMMENT 'table m_produk',
  `id_ukuran` int(11) NOT NULL COMMENT 'table m_produk_ukuran',
  `id_warna` int(11) NOT NULL COMMENT 'table m_produk_warna',
  `jumlah` int(11) NOT NULL,
  `total_berat` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL COMMENT 'jumlah*harga_beli',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.t_beli_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_beli_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_beli_detail` ENABLE KEYS */;

-- Dumping structure for table pos.t_order
CREATE TABLE IF NOT EXISTS `t_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `id_metode_pembayaran` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.t_order: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_order` ENABLE KEYS */;

-- Dumping structure for table pos.t_order_detail
CREATE TABLE IF NOT EXISTS `t_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `nama_ukuran` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.t_order_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_order_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_order_detail` ENABLE KEYS */;

-- Dumping structure for table pos.t_purchase_order
CREATE TABLE IF NOT EXISTS `t_purchase_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_supplier` int(11) NOT NULL COMMENT 'table m_supplier_produk',
  `catatan` text NOT NULL,
  `total_berat` int(11) NOT NULL COMMENT 'dalam gram',
  `total_qty` int(11) NOT NULL,
  `total_harga_beli` int(11) NOT NULL COMMENT 'hasil penjumlahan total harga beli dr beberapa barang',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_edited` datetime NOT NULL,
  `add_by` int(11) NOT NULL,
  `edited_by` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.t_purchase_order: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_purchase_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_purchase_order` ENABLE KEYS */;

-- Dumping structure for table pos.t_purchase_order_detail
CREATE TABLE IF NOT EXISTS `t_purchase_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_purchase_order` int(11) NOT NULL COMMENT 'table t_purchase_order',
  `id_produk` int(11) NOT NULL COMMENT 'table m_produk',
  `id_ukuran` int(11) NOT NULL COMMENT 'table m_produk_ukuran',
  `id_warna` int(11) NOT NULL COMMENT 'table m_produk_warna',
  `jumlah` int(11) NOT NULL,
  `total_berat` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL COMMENT 'jumlah*harga_beli',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.t_purchase_order_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_purchase_order_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_purchase_order_detail` ENABLE KEYS */;

-- Dumping structure for table pos.t_retur
CREATE TABLE IF NOT EXISTS `t_retur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.t_retur: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_retur` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_retur` ENABLE KEYS */;

-- Dumping structure for table pos.t_retur_detail
CREATE TABLE IF NOT EXISTS `t_retur_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_retur` int(11) NOT NULL COMMENT 'table t_retur',
  `id_produk` int(11) NOT NULL COMMENT 'table m_produk',
  `harga_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL COMMENT 'diambil dr table t_order_detail, sesuai id_order nya',
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL COMMENT 'harga_jual*jumlah',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.t_retur_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_retur_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_retur_detail` ENABLE KEYS */;

-- Dumping structure for table pos.t_service
CREATE TABLE IF NOT EXISTS `t_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `deleted` int(11) NOT NULL COMMENT '0 terhapus, 1 aktif',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.t_service: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_service` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_service` ENABLE KEYS */;

-- Dumping structure for table pos.t_service_detail
CREATE TABLE IF NOT EXISTS `t_service_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_service` int(11) NOT NULL COMMENT 'table t_service',
  `id_produk` int(11) NOT NULL COMMENT 'table m_produk',
  `harga_beli` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL COMMENT 'harga_beli*jumlah',
  `uang_kembali` int(11) NOT NULL COMMENT 'kolom ini != 0 jika admin pilih dikembalikan uang',
  `kurangi_stok` int(11) NOT NULL COMMENT '1 mengurangi stok, 2 tidak mengurani stok',
  `status` int(11) NOT NULL COMMENT '1 sedang di proses supplier,2 dikembalikan barang,3 dikembalikan uang, 4 dikembalikan uang dan barang',
  `jumlah_barang_kembali` int(11) DEFAULT NULL,
  `stok_kembali` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table pos.t_service_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `t_service_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `t_service_detail` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
