-- --------------------------------------------------------
-- Host:                         localhost
-- Versi server:                 10.1.13-MariaDB - mariadb.org binary distribution
-- OS Server:                    Win32
-- HeidiSQL Versi:               9.4.0.5141
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Membuang struktur basisdata untuk kuisioner_dosen
CREATE DATABASE IF NOT EXISTS `kuisioner_dosen` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `kuisioner_dosen`;

-- membuang struktur untuk table kuisioner_dosen.tm_dosen
CREATE TABLE IF NOT EXISTS `tm_dosen` (
  `kd_dosen` int(11) NOT NULL AUTO_INCREMENT,
  `nama_dosen` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kd_dosen`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kuisioner_dosen.tm_dosen: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `tm_dosen` DISABLE KEYS */;
INSERT INTO `tm_dosen` (`kd_dosen`, `nama_dosen`) VALUES
	(1, 'Pak Dwijas'),
	(2, 'Pak Sunu'),
	(3, 'Pak Rofiq'),
	(4, 'Bu Vivi Aida');
/*!40000 ALTER TABLE `tm_dosen` ENABLE KEYS */;

-- membuang struktur untuk table kuisioner_dosen.tm_kelas
CREATE TABLE IF NOT EXISTS `tm_kelas` (
  `kd_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kd_kelas`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kuisioner_dosen.tm_kelas: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `tm_kelas` DISABLE KEYS */;
INSERT INTO `tm_kelas` (`kd_kelas`, `nama_kelas`) VALUES
	(1, 'EKS1_a'),
	(2, 'EKS1_b'),
	(3, 'EKS2_a'),
	(4, 'EKS2_b');
/*!40000 ALTER TABLE `tm_kelas` ENABLE KEYS */;

-- membuang struktur untuk table kuisioner_dosen.tm_mahasiswa
CREATE TABLE IF NOT EXISTS `tm_mahasiswa` (
  `kd_mahasiswa` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `nim` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT '827ccb0eea8a706c4c34a16891f84e7b',
  `status` varchar(255) DEFAULT '0',
  PRIMARY KEY (`kd_mahasiswa`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kuisioner_dosen.tm_mahasiswa: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `tm_mahasiswa` DISABLE KEYS */;
INSERT INTO `tm_mahasiswa` (`kd_mahasiswa`, `nama`, `nim`, `password`, `status`) VALUES
	(1, 'Muhammad Handharbeni', '122123', '827ccb0eea8a706c4c34a16891f84e7b', '0'),
	(2, 'Muhammad Lukmanul Hakim', '122124', '827ccb0eea8a706c4c34a16891f84e7b', '0'),
	(3, 'Ibnu Shodiqin Suhaemy', '122125', '827ccb0eea8a706c4c34a16891f84e7b', '0');
/*!40000 ALTER TABLE `tm_mahasiswa` ENABLE KEYS */;

-- membuang struktur untuk table kuisioner_dosen.tm_matkul
CREATE TABLE IF NOT EXISTS `tm_matkul` (
  `kd_matkul` int(11) NOT NULL AUTO_INCREMENT,
  `matkul` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kd_matkul`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kuisioner_dosen.tm_matkul: ~7 rows (lebih kurang)
/*!40000 ALTER TABLE `tm_matkul` DISABLE KEYS */;
INSERT INTO `tm_matkul` (`kd_matkul`, `matkul`) VALUES
	(1, 'Matematika'),
	(2, 'Bahasa Inggris'),
	(3, 'PBO'),
	(4, 'WEB'),
	(5, 'MPI'),
	(14, 'test1'),
	(15, 'test');
/*!40000 ALTER TABLE `tm_matkul` ENABLE KEYS */;

-- membuang struktur untuk table kuisioner_dosen.tm_pertanyaan
CREATE TABLE IF NOT EXISTS `tm_pertanyaan` (
  `kd_pertanyaan` int(11) NOT NULL AUTO_INCREMENT,
  `pertanyaan` longtext,
  `nilai` int(11) DEFAULT '5',
  PRIMARY KEY (`kd_pertanyaan`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kuisioner_dosen.tm_pertanyaan: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `tm_pertanyaan` DISABLE KEYS */;
INSERT INTO `tm_pertanyaan` (`kd_pertanyaan`, `pertanyaan`, `nilai`) VALUES
	(1, 'APAKAH', 5),
	(2, 'BAGAIMANA', 5),
	(3, 'MENGAPA', 5),
	(4, 'SIAPAKAH', 5),
	(5, 'AKANKAH', 12);
/*!40000 ALTER TABLE `tm_pertanyaan` ENABLE KEYS */;

-- membuang struktur untuk table kuisioner_dosen.tm_user
CREATE TABLE IF NOT EXISTS `tm_user` (
  `kd_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`kd_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kuisioner_dosen.tm_user: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `tm_user` DISABLE KEYS */;
INSERT INTO `tm_user` (`kd_user`, `nama`, `username`, `password`) VALUES
	(1, 'ADMIN', 'admin', '827ccb0eea8a706c4c34a16891f84e7b');
/*!40000 ALTER TABLE `tm_user` ENABLE KEYS */;

-- membuang struktur untuk table kuisioner_dosen.tt_jadwal
CREATE TABLE IF NOT EXISTS `tt_jadwal` (
  `kd_tt_kelas` int(11) DEFAULT NULL,
  `kd_tt_matkul` int(11) DEFAULT NULL,
  KEY `FK_tt_jadwal_tt_kelas` (`kd_tt_kelas`),
  KEY `FK_tt_jadwal_tt_matkul` (`kd_tt_matkul`),
  CONSTRAINT `FK_tt_jadwal_tt_kelas` FOREIGN KEY (`kd_tt_kelas`) REFERENCES `tt_kelas` (`kd_tt_kelas`),
  CONSTRAINT `FK_tt_jadwal_tt_matkul` FOREIGN KEY (`kd_tt_matkul`) REFERENCES `tt_matkul` (`kd_tt_matkul`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kuisioner_dosen.tt_jadwal: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `tt_jadwal` DISABLE KEYS */;
INSERT INTO `tt_jadwal` (`kd_tt_kelas`, `kd_tt_matkul`) VALUES
	(1, 1),
	(2, 3),
	(3, 4),
	(7, 5),
	(4, 2);
/*!40000 ALTER TABLE `tt_jadwal` ENABLE KEYS */;

-- membuang struktur untuk table kuisioner_dosen.tt_kelas
CREATE TABLE IF NOT EXISTS `tt_kelas` (
  `kd_tt_kelas` int(11) NOT NULL AUTO_INCREMENT,
  `kd_kelas` int(11) DEFAULT NULL,
  `kd_mahasiswa` int(11) DEFAULT NULL,
  `password` varchar(255) DEFAULT '827ccb0eea8a706c4c34a16891f84e7b',
  `status` int(11) DEFAULT '0',
  PRIMARY KEY (`kd_tt_kelas`),
  KEY `FK_tt_kelas_tm_kelas` (`kd_kelas`),
  KEY `FK_tt_kelas_tm_mahasiswa` (`kd_mahasiswa`),
  CONSTRAINT `FK_tt_kelas_tm_kelas` FOREIGN KEY (`kd_kelas`) REFERENCES `tm_kelas` (`kd_kelas`),
  CONSTRAINT `FK_tt_kelas_tm_mahasiswa` FOREIGN KEY (`kd_mahasiswa`) REFERENCES `tm_mahasiswa` (`kd_mahasiswa`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kuisioner_dosen.tt_kelas: ~7 rows (lebih kurang)
/*!40000 ALTER TABLE `tt_kelas` DISABLE KEYS */;
INSERT INTO `tt_kelas` (`kd_tt_kelas`, `kd_kelas`, `kd_mahasiswa`, `password`, `status`) VALUES
	(1, 1, 1, '827ccb0eea8a706c4c34a16891f84e7b', 0),
	(2, 1, 3, '827ccb0eea8a706c4c34a16891f84e7b', 0),
	(3, 2, 2, '827ccb0eea8a706c4c34a16891f84e7b', 0),
	(4, 2, 1, '827ccb0eea8a706c4c34a16891f84e7b', 0),
	(5, 3, 2, '827ccb0eea8a706c4c34a16891f84e7b', 0),
	(6, 3, 3, '827ccb0eea8a706c4c34a16891f84e7b', 0),
	(7, 4, 1, '827ccb0eea8a706c4c34a16891f84e7b', 0);
/*!40000 ALTER TABLE `tt_kelas` ENABLE KEYS */;

-- membuang struktur untuk table kuisioner_dosen.tt_matkul
CREATE TABLE IF NOT EXISTS `tt_matkul` (
  `kd_tt_matkul` int(11) NOT NULL AUTO_INCREMENT,
  `kd_dosen` int(11) DEFAULT NULL,
  `kd_matkul` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `tahun_ajaran` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`kd_tt_matkul`),
  KEY `FK_tt_jadwal_tm_dosen` (`kd_dosen`),
  KEY `FK_tt_jadwal_tm_matkul` (`kd_matkul`),
  CONSTRAINT `FK_tt_jadwal_tm_dosen` FOREIGN KEY (`kd_dosen`) REFERENCES `tm_dosen` (`kd_dosen`),
  CONSTRAINT `FK_tt_jadwal_tm_matkul` FOREIGN KEY (`kd_matkul`) REFERENCES `tm_matkul` (`kd_matkul`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kuisioner_dosen.tt_matkul: ~5 rows (lebih kurang)
/*!40000 ALTER TABLE `tt_matkul` DISABLE KEYS */;
INSERT INTO `tt_matkul` (`kd_tt_matkul`, `kd_dosen`, `kd_matkul`, `semester`, `tahun_ajaran`) VALUES
	(1, 1, 2, 1, '2015-2016'),
	(2, 1, 3, 1, '2015-2016'),
	(3, 2, 4, 1, '2015-2016'),
	(4, 3, 5, 1, '2015-2016'),
	(5, 3, 1, 1, '2015-2016');
/*!40000 ALTER TABLE `tt_matkul` ENABLE KEYS */;

-- membuang struktur untuk table kuisioner_dosen.tt_rating
CREATE TABLE IF NOT EXISTS `tt_rating` (
  `kd_tt_matkul` int(11) DEFAULT NULL,
  `kd_mahasiswa_kelas` int(11) DEFAULT NULL,
  `kd_pertanyaan` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  KEY `FK_tt_rating_tt_matkul` (`kd_tt_matkul`),
  KEY `FK_tt_rating_tt_kelas` (`kd_mahasiswa_kelas`),
  KEY `FK_tt_rating_tm_pertanyaan` (`kd_pertanyaan`),
  CONSTRAINT `FK_tt_rating_tm_pertanyaan` FOREIGN KEY (`kd_pertanyaan`) REFERENCES `tm_pertanyaan` (`kd_pertanyaan`),
  CONSTRAINT `FK_tt_rating_tt_kelas` FOREIGN KEY (`kd_mahasiswa_kelas`) REFERENCES `tt_kelas` (`kd_tt_kelas`),
  CONSTRAINT `FK_tt_rating_tt_matkul` FOREIGN KEY (`kd_tt_matkul`) REFERENCES `tt_matkul` (`kd_tt_matkul`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kuisioner_dosen.tt_rating: ~19 rows (lebih kurang)
/*!40000 ALTER TABLE `tt_rating` DISABLE KEYS */;
/*!40000 ALTER TABLE `tt_rating` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
