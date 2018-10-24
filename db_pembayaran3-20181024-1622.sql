-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 24, 2018 at 11:22 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pembayaran3`
--

-- --------------------------------------------------------

--
-- Table structure for table `t00_tahunajaran`
--

CREATE TABLE `t00_tahunajaran` (
  `id` int(11) NOT NULL,
  `Awal_Bulan` tinyint(4) NOT NULL,
  `Awal_Tahun` smallint(6) NOT NULL,
  `Akhir_Bulan` tinyint(4) NOT NULL,
  `Akhir_Tahun` smallint(6) NOT NULL,
  `Tahun_Ajaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t00_tahunajaran`
--

INSERT INTO `t00_tahunajaran` (`id`, `Awal_Bulan`, `Awal_Tahun`, `Akhir_Bulan`, `Akhir_Tahun`, `Tahun_Ajaran`) VALUES
(1, 7, 2018, 6, 2019, '2018 / 2019');

-- --------------------------------------------------------

--
-- Table structure for table `t01_sekolah`
--

CREATE TABLE `t01_sekolah` (
  `id` int(11) NOT NULL,
  `NIS` varchar(50) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Alamat` varchar(100) DEFAULT NULL,
  `NoTelpHp` varchar(25) DEFAULT NULL,
  `TTD1Nama` varchar(50) DEFAULT NULL,
  `TTD1Jabatan` varchar(50) DEFAULT NULL,
  `TTD2Nama` varchar(50) DEFAULT NULL,
  `TTD2Jabatan` varchar(50) DEFAULT NULL,
  `Logo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t01_sekolah`
--

INSERT INTO `t01_sekolah` (`id`, `NIS`, `Nama`, `Alamat`, `NoTelpHp`, `TTD1Nama`, `TTD1Jabatan`, `TTD2Nama`, `TTD2Jabatan`, `Logo`) VALUES
(1, '0001', 'MINU', 'Sukorejo', '0353 889900', 'Admin', 'Bendahara', 'Director', 'Kepala MINU', 'officelogo(1).jpg');

-- --------------------------------------------------------

--
-- Table structure for table `t02_kelas`
--

CREATE TABLE `t02_kelas` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t02_kelas`
--

INSERT INTO `t02_kelas` (`id`, `Nama`) VALUES
(1, 'Kelas I'),
(2, 'Kelas II'),
(3, 'Kelas III'),
(4, 'Kelas IV'),
(5, 'Kelas V'),
(6, 'Kelas VI');

-- --------------------------------------------------------

--
-- Table structure for table `t03_siswa`
--

CREATE TABLE `t03_siswa` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `Nomor_Induk` varchar(100) NOT NULL,
  `Nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t03_siswa`
--

INSERT INTO `t03_siswa` (`id`, `kelas_id`, `Nomor_Induk`, `Nama`) VALUES
(1, 1, 'E0001', 'Elisa');

-- --------------------------------------------------------

--
-- Table structure for table `t04_rutin`
--

CREATE TABLE `t04_rutin` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t04_rutin`
--

INSERT INTO `t04_rutin` (`id`, `Nama`) VALUES
(1, 'Infaq'),
(2, 'Catering'),
(3, 'Worksheet'),
(4, 'Beasiswa Infaq');

-- --------------------------------------------------------

--
-- Table structure for table `t05_siswarutin`
--

CREATE TABLE `t05_siswarutin` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `rutin_id` int(11) DEFAULT NULL,
  `Nilai` float(14,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t05_siswarutin`
--

INSERT INTO `t05_siswarutin` (`id`, `siswa_id`, `rutin_id`, `Nilai`) VALUES
(1, 1, 1, 70000.00),
(2, 1, 2, 71000.00),
(3, 1, 3, 72000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t06_siswarutinbayar`
--

CREATE TABLE `t06_siswarutinbayar` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `rutin_id` int(11) NOT NULL,
  `Bulan` tinyint(4) NOT NULL,
  `Tahun` smallint(6) NOT NULL,
  `Bayar_Tgl` date DEFAULT NULL,
  `Bayar_Jumlah` float(14,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t06_siswarutinbayar`
--

INSERT INTO `t06_siswarutinbayar` (`id`, `siswa_id`, `rutin_id`, `Bulan`, `Tahun`, `Bayar_Tgl`, `Bayar_Jumlah`) VALUES
(1, 1, 1, 7, 2018, '2018-10-24', 70000.00),
(2, 1, 1, 8, 2018, '2018-10-24', 70000.00),
(3, 1, 1, 9, 2018, '2018-10-24', 70000.00),
(4, 1, 1, 10, 2018, '2018-10-24', 70000.00),
(5, 1, 1, 11, 2018, NULL, 70000.00),
(6, 1, 1, 12, 2018, NULL, 70000.00),
(7, 1, 1, 1, 2019, NULL, 70000.00),
(8, 1, 1, 2, 2019, NULL, 70000.00),
(9, 1, 1, 3, 2019, NULL, 70000.00),
(10, 1, 1, 4, 2019, NULL, 70000.00),
(11, 1, 1, 5, 2019, NULL, 70000.00),
(12, 1, 1, 6, 2019, NULL, 70000.00),
(13, 1, 2, 7, 2018, NULL, 71000.00),
(14, 1, 2, 8, 2018, NULL, 71000.00),
(15, 1, 2, 9, 2018, NULL, 71000.00),
(16, 1, 2, 10, 2018, NULL, 71000.00),
(17, 1, 2, 11, 2018, NULL, 71000.00),
(18, 1, 2, 12, 2018, NULL, 71000.00),
(19, 1, 2, 1, 2019, NULL, 71000.00),
(20, 1, 2, 2, 2019, NULL, 71000.00),
(21, 1, 2, 3, 2019, NULL, 71000.00),
(22, 1, 2, 4, 2019, NULL, 71000.00),
(23, 1, 2, 5, 2019, NULL, 71000.00),
(24, 1, 2, 6, 2019, NULL, 71000.00),
(25, 1, 3, 7, 2018, NULL, 72000.00),
(26, 1, 3, 8, 2018, NULL, 72000.00),
(27, 1, 3, 9, 2018, NULL, 72000.00),
(28, 1, 3, 10, 2018, NULL, 72000.00),
(29, 1, 3, 11, 2018, NULL, 72000.00),
(30, 1, 3, 12, 2018, NULL, 72000.00),
(31, 1, 3, 1, 2019, NULL, 72000.00),
(32, 1, 3, 2, 2019, NULL, 72000.00),
(33, 1, 3, 3, 2019, NULL, 72000.00),
(34, 1, 3, 4, 2019, NULL, 72000.00),
(35, 1, 3, 5, 2019, NULL, 72000.00),
(36, 1, 3, 6, 2019, NULL, 72000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t06_siswarutinbayar_2`
--

CREATE TABLE `t06_siswarutinbayar_2` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `rutin_id` int(11) NOT NULL,
  `siswarutinbayar1_id` int(11) DEFAULT NULL,
  `siswarutinbayar2_id` int(11) DEFAULT NULL,
  `Bayar_Tgl` date DEFAULT NULL,
  `Bayar_Jumlah` float(14,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t06_siswarutinbayar_2`
--

INSERT INTO `t06_siswarutinbayar_2` (`id`, `siswa_id`, `rutin_id`, `siswarutinbayar1_id`, `siswarutinbayar2_id`, `Bayar_Tgl`, `Bayar_Jumlah`) VALUES
(1, 1, 1, NULL, NULL, NULL, NULL),
(2, 1, 2, NULL, NULL, NULL, NULL),
(3, 1, 3, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t07_nonrutin`
--

CREATE TABLE `t07_nonrutin` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t07_nonrutin`
--

INSERT INTO `t07_nonrutin` (`id`, `Nama`) VALUES
(1, 'Dana Sumbangan'),
(2, 'Daftar Ulang');

-- --------------------------------------------------------

--
-- Table structure for table `t08_siswanonrutin`
--

CREATE TABLE `t08_siswanonrutin` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `nonrutin_id` int(11) DEFAULT NULL,
  `Nilai` float(14,2) DEFAULT '0.00',
  `Terbayar` float(14,2) DEFAULT '0.00',
  `Sisa` float(14,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t09_siswanonrutinbayar`
--

CREATE TABLE `t09_siswanonrutinbayar` (
  `id` int(11) NOT NULL,
  `siswanonrutin_id` int(11) NOT NULL,
  `Bayar_Tgl` date DEFAULT NULL,
  `Bayar_Jumlah` float(14,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t96_employees`
--

CREATE TABLE `t96_employees` (
  `EmployeeID` int(11) NOT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `FirstName` varchar(10) DEFAULT NULL,
  `Title` varchar(30) DEFAULT NULL,
  `TitleOfCourtesy` varchar(25) DEFAULT NULL,
  `BirthDate` datetime DEFAULT NULL,
  `HireDate` datetime DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `Region` varchar(15) DEFAULT NULL,
  `PostalCode` varchar(10) DEFAULT NULL,
  `Country` varchar(15) DEFAULT NULL,
  `HomePhone` varchar(24) DEFAULT NULL,
  `Extension` varchar(4) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `ReportsTo` int(11) DEFAULT NULL,
  `Password` varchar(50) NOT NULL DEFAULT '',
  `UserLevel` int(11) DEFAULT NULL,
  `Username` varchar(20) NOT NULL DEFAULT '',
  `Activated` enum('Y','N') NOT NULL DEFAULT 'N',
  `Profile` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t96_employees`
--

INSERT INTO `t96_employees` (`EmployeeID`, `LastName`, `FirstName`, `Title`, `TitleOfCourtesy`, `BirthDate`, `HireDate`, `Address`, `City`, `Region`, `PostalCode`, `Country`, `HomePhone`, `Extension`, `Email`, `Photo`, `Notes`, `ReportsTo`, `Password`, `UserLevel`, `Username`, `Activated`, `Profile`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', -1, 'admin', 'Y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t97_userlevels`
--

CREATE TABLE `t97_userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t97_userlevels`
--

INSERT INTO `t97_userlevels` (`userlevelid`, `userlevelname`) VALUES
(-2, 'Anonymous'),
(-1, 'Administrator'),
(0, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `t98_userlevelpermissions`
--

CREATE TABLE `t98_userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t98_userlevelpermissions`
--

INSERT INTO `t98_userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
(-2, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}cf01_home.php', 8),
(-2, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t96_employees', 0),
(-2, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t97_userlevels', 0),
(-2, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t98_userlevelpermissions', 0),
(-2, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t99_audittrail', 0),
(0, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}cf01_home.php', 8),
(0, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t96_employees', 0),
(0, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t97_userlevels', 0),
(0, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t98_userlevelpermissions', 0),
(0, '{9A296957-6EE4-4785-AB71-310FFD71D6FE}t99_audittrail', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t99_audittrail`
--

CREATE TABLE `t99_audittrail` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `script` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `keyvalue` longtext,
  `oldvalue` longtext,
  `newvalue` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t99_audittrail`
--

INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(1, '2018-10-10 00:48:34', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(2, '2018-10-10 00:50:41', '/pembayaran3/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(3, '2018-10-10 00:50:54', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(4, '2018-10-10 01:24:45', '/pembayaran3/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(5, '2018-10-10 08:32:48', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(6, '2018-10-10 08:55:12', '/pembayaran3/t01_sekolahlist.php', '1', 'U', 't01_sekolah', 'NIS', '1', '', '0001'),
(7, '2018-10-10 12:56:18', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(8, '2018-10-10 13:00:22', '/pembayaran3/t03_siswaedit.php', '1', '*** Batch update begin ***', 't05_siswarutin', '', '', '', ''),
(9, '2018-10-10 13:00:22', '/pembayaran3/t03_siswaedit.php', '1', '*** Batch update successful ***', 't05_siswarutin', '', '', '', ''),
(16, '2018-10-10 13:21:58', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'kelas_id', '1', '', '1'),
(17, '2018-10-10 13:21:58', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nomor_Induk', '1', '', 'A0001'),
(18, '2018-10-10 13:21:58', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nama', '1', '', 'Asa'),
(19, '2018-10-10 13:21:58', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'id', '1', '', '1'),
(20, '2018-10-10 13:21:58', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't05_siswarutin', '', '', '', ''),
(21, '2018-10-10 13:21:58', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '1', '', '1'),
(22, '2018-10-10 13:21:58', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '1', '', '15000'),
(23, '2018-10-10 13:21:58', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '1', '', '1'),
(24, '2018-10-10 13:21:58', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '1', '', '1'),
(25, '2018-10-10 13:21:58', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '2', '', '2'),
(26, '2018-10-10 13:21:58', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '2', '', '30000'),
(27, '2018-10-10 13:21:58', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '2', '', '1'),
(28, '2018-10-10 13:21:58', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '2', '', '2'),
(29, '2018-10-10 13:21:58', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't05_siswarutin', '', '', '', ''),
(38, '2018-10-10 14:23:26', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'kelas_id', '3', '', '1'),
(39, '2018-10-10 14:23:26', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nomor_Induk', '3', '', 'A0002'),
(40, '2018-10-10 14:23:26', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nama', '3', '', 'Bisa'),
(41, '2018-10-10 14:23:26', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'id', '3', '', '3'),
(42, '2018-10-10 14:23:26', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't05_siswarutin', '', '', '', ''),
(43, '2018-10-10 14:23:26', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '4', '', '1'),
(44, '2018-10-10 14:23:26', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '4', '', '100000'),
(45, '2018-10-10 14:23:26', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '4', '', '3'),
(46, '2018-10-10 14:23:26', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '4', '', '4'),
(47, '2018-10-10 14:23:26', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't05_siswarutin', '', '', '', ''),
(48, '2018-10-10 15:22:09', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'kelas_id', '1', '', '1'),
(49, '2018-10-10 15:22:09', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nomor_Induk', '1', '', 'A0001'),
(50, '2018-10-10 15:22:09', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nama', '1', '', 'Adi'),
(51, '2018-10-10 15:22:09', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'id', '1', '', '1'),
(52, '2018-10-10 15:22:10', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't05_siswarutin', '', '', '', ''),
(53, '2018-10-10 15:22:10', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '1', '', '1'),
(54, '2018-10-10 15:22:10', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '1', '', '10000'),
(55, '2018-10-10 15:22:10', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '1', '', '1'),
(56, '2018-10-10 15:22:10', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '1', '', '1'),
(57, '2018-10-10 15:22:10', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '2', '', '2'),
(58, '2018-10-10 15:22:10', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '2', '', '20000'),
(59, '2018-10-10 15:22:10', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '2', '', '1'),
(60, '2018-10-10 15:22:10', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '2', '', '2'),
(61, '2018-10-10 15:22:10', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't05_siswarutin', '', '', '', ''),
(62, '2018-10-10 15:28:41', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'kelas_id', '1', '', '1'),
(63, '2018-10-10 15:28:41', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nomor_Induk', '1', '', 'A0001'),
(64, '2018-10-10 15:28:41', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nama', '1', '', 'Adi'),
(65, '2018-10-10 15:28:41', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'id', '1', '', '1'),
(66, '2018-10-10 15:28:41', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't05_siswarutin', '', '', '', ''),
(67, '2018-10-10 15:28:41', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '1', '', '1'),
(68, '2018-10-10 15:28:41', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '1', '', '5000'),
(69, '2018-10-10 15:28:41', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '1', '', '1'),
(70, '2018-10-10 15:28:41', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '1', '', '1'),
(71, '2018-10-10 15:28:41', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '2', '', '2'),
(72, '2018-10-10 15:28:41', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '2', '', '10000'),
(73, '2018-10-10 15:28:41', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '2', '', '1'),
(74, '2018-10-10 15:28:41', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '2', '', '2'),
(75, '2018-10-10 15:28:41', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't05_siswarutin', '', '', '', ''),
(76, '2018-10-10 16:08:31', '/pembayaran3/t06_siswarutinbayarlist.php', '1', 'U', 't06_siswarutinbayar', 'Bayar_Tgl', '1', NULL, '2018-07-02'),
(77, '2018-10-10 16:09:49', '/pembayaran3/t06_siswarutinbayarlist.php', '1', 'U', 't06_siswarutinbayar', 'Bayar_Tgl', '2', NULL, '2018-08-06'),
(78, '2018-10-10 16:10:09', '/pembayaran3/t06_siswarutinbayarlist.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar', '', '', '', ''),
(79, '2018-10-10 16:10:09', '/pembayaran3/t06_siswarutinbayarlist.php', '1', 'U', 't06_siswarutinbayar', 'Bayar_Tgl', '3', NULL, '2018-09-03'),
(80, '2018-10-10 16:10:09', '/pembayaran3/t06_siswarutinbayarlist.php', '1', 'U', 't06_siswarutinbayar', 'Bayar_Tgl', '4', NULL, '2018-10-01'),
(81, '2018-10-10 16:10:09', '/pembayaran3/t06_siswarutinbayarlist.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar', '', '', '', ''),
(82, '2018-10-10 18:34:50', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(83, '2018-10-10 19:56:41', '/pembayaran3/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(84, '2018-10-10 19:59:08', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(85, '2018-10-10 20:40:38', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'kelas_id', '2', '', '1'),
(86, '2018-10-10 20:40:38', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nomor_Induk', '2', '', 'A002'),
(87, '2018-10-10 20:40:38', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nama', '2', '', 'Budi'),
(88, '2018-10-10 20:40:38', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'id', '2', '', '2'),
(89, '2018-10-10 20:40:38', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't05_siswarutin', '', '', '', ''),
(90, '2018-10-10 20:40:38', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '3', '', '1'),
(91, '2018-10-10 20:40:38', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '3', '', '500000'),
(92, '2018-10-10 20:40:38', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '3', '', '2'),
(93, '2018-10-10 20:40:38', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '3', '', '3'),
(94, '2018-10-10 20:40:39', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '4', '', '2'),
(95, '2018-10-10 20:40:39', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '4', '', '600000'),
(96, '2018-10-10 20:40:39', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '4', '', '2'),
(97, '2018-10-10 20:40:39', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '4', '', '4'),
(98, '2018-10-10 20:40:39', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't05_siswarutin', '', '', '', ''),
(99, '2018-10-10 20:47:54', '/pembayaran3/t03_siswaedit.php', '1', '*** Batch update begin ***', 't05_siswarutin', '', '', '', ''),
(100, '2018-10-10 20:47:54', '/pembayaran3/t03_siswaedit.php', '1', 'U', 't05_siswarutin', 'Nilai', '3', '500000.00', '550000.00'),
(101, '2018-10-10 20:47:55', '/pembayaran3/t03_siswaedit.php', '1', '*** Batch update successful ***', 't05_siswarutin', '', '', '', ''),
(102, '2018-10-10 20:47:55', '/pembayaran3/t03_siswaedit.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar', '', '', '', ''),
(103, '2018-10-10 20:47:55', '/pembayaran3/t03_siswaedit.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar', '', '', '', ''),
(104, '2018-10-10 20:49:44', '/pembayaran3/t05_siswarutinedit.php', '1', 'U', 't05_siswarutin', 'Nilai', '3', '550000.00', '525000.00'),
(105, '2018-10-11 09:35:55', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(106, '2018-10-11 10:50:02', '/pembayaran3/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(107, '2018-10-11 11:40:43', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(108, '2018-10-11 11:41:19', '/pembayaran3/t07_nonrutinlist.php', '1', 'A', 't07_nonrutin', 'Nama', '1', '', 'Dana Sumbangan'),
(109, '2018-10-11 11:41:19', '/pembayaran3/t07_nonrutinlist.php', '1', 'A', 't07_nonrutin', 'id', '1', '', '1'),
(110, '2018-10-11 11:42:31', '/pembayaran3/t07_nonrutinlist.php', '1', 'A', 't07_nonrutin', 'Nama', '2', '', 'Daftar Ulang'),
(111, '2018-10-11 11:42:31', '/pembayaran3/t07_nonrutinlist.php', '1', 'A', 't07_nonrutin', 'id', '2', '', '2'),
(124, '2018-10-11 13:08:26', '/pembayaran3/t03_siswaedit.php', '1', '*** Batch update begin ***', 't05_siswarutin', '', '', '', ''),
(125, '2018-10-11 13:08:26', '/pembayaran3/t03_siswaedit.php', '1', '*** Batch update successful ***', 't05_siswarutin', '', '', '', ''),
(126, '2018-10-11 13:08:26', '/pembayaran3/t03_siswaedit.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar', '', '', '', ''),
(127, '2018-10-11 13:08:26', '/pembayaran3/t03_siswaedit.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar', '', '', '', ''),
(128, '2018-10-11 13:08:26', '/pembayaran3/t03_siswaedit.php', '1', '*** Batch update begin ***', 't08_siswanonrutin', '', '', '', ''),
(129, '2018-10-11 13:08:26', '/pembayaran3/t03_siswaedit.php', '1', 'A', 't08_siswanonrutin', 'nonrutin_id', '1', '', '1'),
(130, '2018-10-11 13:08:26', '/pembayaran3/t03_siswaedit.php', '1', 'A', 't08_siswanonrutin', 'Nilai', '1', '', '1000000'),
(131, '2018-10-11 13:08:26', '/pembayaran3/t03_siswaedit.php', '1', 'A', 't08_siswanonrutin', 'siswa_id', '1', '', '1'),
(132, '2018-10-11 13:08:26', '/pembayaran3/t03_siswaedit.php', '1', 'A', 't08_siswanonrutin', 'id', '1', '', '1'),
(133, '2018-10-11 13:08:26', '/pembayaran3/t03_siswaedit.php', '1', '*** Batch update successful ***', 't08_siswanonrutin', '', '', '', ''),
(134, '2018-10-11 13:08:26', '/pembayaran3/t03_siswaedit.php', '1', '*** Batch update begin ***', 't09_siswanonrutinbayar', '', '', '', ''),
(135, '2018-10-11 13:08:27', '/pembayaran3/t03_siswaedit.php', '1', '*** Batch update successful ***', 't09_siswanonrutinbayar', '', '', '', ''),
(136, '2018-10-14 21:06:07', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(137, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', '*** Batch delete begin ***', 't03_siswa', '', '', '', ''),
(138, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'id', '1', '1', ''),
(139, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'siswa_id', '1', '1', ''),
(140, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'rutin_id', '1', '1', ''),
(141, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'Nilai', '1', '5000.00', ''),
(142, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'id', '2', '2', ''),
(143, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'siswa_id', '2', '1', ''),
(144, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'rutin_id', '2', '2', ''),
(145, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'Nilai', '2', '10000.00', ''),
(146, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '1', '1', ''),
(147, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '1', '1', ''),
(148, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '1', '1', ''),
(149, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '1', '7', ''),
(150, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '1', '2018', ''),
(151, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '1', '2018-07-02', ''),
(152, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '1', '5000.00', ''),
(153, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '1', 'A0001', ''),
(154, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '1', 'Adi', ''),
(155, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '2', '2', ''),
(156, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '2', '1', ''),
(157, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '2', '1', ''),
(158, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '2', '8', ''),
(159, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '2', '2018', ''),
(160, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '2', '2018-08-06', ''),
(161, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '2', '5000.00', ''),
(162, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '2', 'A0001', ''),
(163, '2018-10-14 21:07:35', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '2', 'Adi', ''),
(164, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '3', '3', ''),
(165, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '3', '1', ''),
(166, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '3', '1', ''),
(167, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '3', '9', ''),
(168, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '3', '2018', ''),
(169, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '3', '2018-09-03', ''),
(170, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '3', '5000.00', ''),
(171, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '3', 'A0001', ''),
(172, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '3', 'Adi', ''),
(173, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '4', '4', ''),
(174, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '4', '1', ''),
(175, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '4', '1', ''),
(176, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '4', '10', ''),
(177, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '4', '2018', ''),
(178, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '4', '2018-10-01', ''),
(179, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '4', '5000.00', ''),
(180, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '4', 'A0001', ''),
(181, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '4', 'Adi', ''),
(182, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '5', '5', ''),
(183, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '5', '1', ''),
(184, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '5', '1', ''),
(185, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '5', '11', ''),
(186, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '5', '2018', ''),
(187, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '5', NULL, ''),
(188, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '5', '5000.00', ''),
(189, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '5', 'A0001', ''),
(190, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '5', 'Adi', ''),
(191, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '6', '6', ''),
(192, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '6', '1', ''),
(193, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '6', '1', ''),
(194, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '6', '12', ''),
(195, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '6', '2018', ''),
(196, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '6', NULL, ''),
(197, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '6', '5000.00', ''),
(198, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '6', 'A0001', ''),
(199, '2018-10-14 21:07:36', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '6', 'Adi', ''),
(200, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '7', '7', ''),
(201, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '7', '1', ''),
(202, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '7', '1', ''),
(203, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '7', '1', ''),
(204, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '7', '2019', ''),
(205, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '7', NULL, ''),
(206, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '7', '5000.00', ''),
(207, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '7', 'A0001', ''),
(208, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '7', 'Adi', ''),
(209, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '8', '8', ''),
(210, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '8', '1', ''),
(211, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '8', '1', ''),
(212, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '8', '2', ''),
(213, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '8', '2019', ''),
(214, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '8', NULL, ''),
(215, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '8', '5000.00', ''),
(216, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '8', 'A0001', ''),
(217, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '8', 'Adi', ''),
(218, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '9', '9', ''),
(219, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '9', '1', ''),
(220, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '9', '1', ''),
(221, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '9', '3', ''),
(222, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '9', '2019', ''),
(223, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '9', NULL, ''),
(224, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '9', '5000.00', ''),
(225, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '9', 'A0001', ''),
(226, '2018-10-14 21:07:37', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '9', 'Adi', ''),
(227, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '10', '10', ''),
(228, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '10', '1', ''),
(229, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '10', '1', ''),
(230, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '10', '4', ''),
(231, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '10', '2019', ''),
(232, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '10', NULL, ''),
(233, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '10', '5000.00', ''),
(234, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '10', 'A0001', ''),
(235, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '10', 'Adi', ''),
(236, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '11', '11', ''),
(237, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '11', '1', ''),
(238, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '11', '1', ''),
(239, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '11', '5', ''),
(240, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '11', '2019', ''),
(241, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '11', NULL, ''),
(242, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '11', '5000.00', ''),
(243, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '11', 'A0001', ''),
(244, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '11', 'Adi', ''),
(245, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '12', '12', ''),
(246, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '12', '1', ''),
(247, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '12', '1', ''),
(248, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '12', '6', ''),
(249, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '12', '2019', ''),
(250, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '12', NULL, ''),
(251, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '12', '5000.00', ''),
(252, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '12', 'A0001', ''),
(253, '2018-10-14 21:07:38', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '12', 'Adi', ''),
(254, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '13', '13', ''),
(255, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '13', '1', ''),
(256, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '13', '2', ''),
(257, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '13', '7', ''),
(258, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '13', '2018', ''),
(259, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '13', NULL, ''),
(260, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '13', '10000.00', ''),
(261, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '13', 'A0001', ''),
(262, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '13', 'Adi', ''),
(263, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '14', '14', ''),
(264, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '14', '1', ''),
(265, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '14', '2', ''),
(266, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '14', '8', ''),
(267, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '14', '2018', ''),
(268, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '14', NULL, ''),
(269, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '14', '10000.00', ''),
(270, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '14', 'A0001', ''),
(271, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '14', 'Adi', ''),
(272, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '15', '15', ''),
(273, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '15', '1', ''),
(274, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '15', '2', ''),
(275, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '15', '9', ''),
(276, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '15', '2018', ''),
(277, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '15', NULL, ''),
(278, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '15', '10000.00', ''),
(279, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '15', 'A0001', ''),
(280, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '15', 'Adi', ''),
(281, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '16', '16', ''),
(282, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '16', '1', ''),
(283, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '16', '2', ''),
(284, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '16', '10', ''),
(285, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '16', '2018', ''),
(286, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '16', NULL, ''),
(287, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '16', '10000.00', ''),
(288, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '16', 'A0001', ''),
(289, '2018-10-14 21:07:39', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '16', 'Adi', ''),
(290, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '17', '17', ''),
(291, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '17', '1', ''),
(292, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '17', '2', ''),
(293, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '17', '11', ''),
(294, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '17', '2018', ''),
(295, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '17', NULL, ''),
(296, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '17', '10000.00', ''),
(297, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '17', 'A0001', ''),
(298, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '17', 'Adi', ''),
(299, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '18', '18', ''),
(300, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '18', '1', ''),
(301, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '18', '2', ''),
(302, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '18', '12', ''),
(303, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '18', '2018', ''),
(304, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '18', NULL, ''),
(305, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '18', '10000.00', ''),
(306, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '18', 'A0001', ''),
(307, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '18', 'Adi', ''),
(308, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '19', '19', ''),
(309, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '19', '1', ''),
(310, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '19', '2', ''),
(311, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '19', '1', ''),
(312, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '19', '2019', ''),
(313, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '19', NULL, ''),
(314, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '19', '10000.00', ''),
(315, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '19', 'A0001', ''),
(316, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '19', 'Adi', ''),
(317, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '20', '20', ''),
(318, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '20', '1', ''),
(319, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '20', '2', ''),
(320, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '20', '2', ''),
(321, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '20', '2019', ''),
(322, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '20', NULL, ''),
(323, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '20', '10000.00', ''),
(324, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '20', 'A0001', ''),
(325, '2018-10-14 21:07:40', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '20', 'Adi', ''),
(326, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '21', '21', ''),
(327, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '21', '1', ''),
(328, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '21', '2', ''),
(329, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '21', '3', ''),
(330, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '21', '2019', ''),
(331, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '21', NULL, ''),
(332, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '21', '10000.00', ''),
(333, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '21', 'A0001', ''),
(334, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '21', 'Adi', ''),
(335, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '22', '22', ''),
(336, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '22', '1', ''),
(337, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '22', '2', ''),
(338, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '22', '4', ''),
(339, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '22', '2019', ''),
(340, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '22', NULL, ''),
(341, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '22', '10000.00', ''),
(342, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '22', 'A0001', ''),
(343, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '22', 'Adi', ''),
(344, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '23', '23', ''),
(345, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '23', '1', ''),
(346, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '23', '2', ''),
(347, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '23', '5', ''),
(348, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '23', '2019', ''),
(349, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '23', NULL, ''),
(350, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '23', '10000.00', ''),
(351, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '23', 'A0001', ''),
(352, '2018-10-14 21:07:41', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '23', 'Adi', ''),
(353, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '24', '24', ''),
(354, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '24', '1', ''),
(355, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '24', '2', ''),
(356, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '24', '6', ''),
(357, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '24', '2019', ''),
(358, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '24', NULL, ''),
(359, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '24', '10000.00', ''),
(360, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '24', 'A0001', ''),
(361, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '24', 'Adi', ''),
(362, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't08_siswanonrutin', 'id', '1', '1', ''),
(363, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't08_siswanonrutin', 'siswa_id', '1', '1', ''),
(364, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't08_siswanonrutin', 'nonrutin_id', '1', '1', ''),
(365, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't08_siswanonrutin', 'Nilai', '1', '1000000.00', ''),
(366, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't03_siswa', 'id', '1', '1', ''),
(367, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't03_siswa', 'kelas_id', '1', '1', ''),
(368, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't03_siswa', 'Nomor_Induk', '1', 'A0001', ''),
(369, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't03_siswa', 'Nama', '1', 'Adi', ''),
(370, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'id', '3', '3', ''),
(371, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'siswa_id', '3', '2', ''),
(372, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'rutin_id', '3', '1', ''),
(373, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'Nilai', '3', '525000.00', ''),
(374, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'id', '4', '4', ''),
(375, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'siswa_id', '4', '2', ''),
(376, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'rutin_id', '4', '2', ''),
(377, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'Nilai', '4', '600000.00', ''),
(378, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '49', '49', ''),
(379, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '49', '2', ''),
(380, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '49', '1', ''),
(381, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '49', '7', ''),
(382, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '49', '2018', ''),
(383, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '49', NULL, ''),
(384, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '49', '525000.00', ''),
(385, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '49', 'A002', ''),
(386, '2018-10-14 21:07:42', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '49', 'Budi', ''),
(387, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '50', '50', ''),
(388, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '50', '2', ''),
(389, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '50', '1', ''),
(390, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '50', '8', ''),
(391, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '50', '2018', ''),
(392, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '50', NULL, ''),
(393, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '50', '525000.00', ''),
(394, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '50', 'A002', ''),
(395, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '50', 'Budi', ''),
(396, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '51', '51', ''),
(397, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '51', '2', ''),
(398, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '51', '1', ''),
(399, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '51', '9', ''),
(400, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '51', '2018', ''),
(401, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '51', NULL, ''),
(402, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '51', '525000.00', ''),
(403, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '51', 'A002', ''),
(404, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '51', 'Budi', ''),
(405, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '52', '52', ''),
(406, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '52', '2', ''),
(407, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '52', '1', ''),
(408, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '52', '10', ''),
(409, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '52', '2018', ''),
(410, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '52', NULL, ''),
(411, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '52', '525000.00', ''),
(412, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '52', 'A002', ''),
(413, '2018-10-14 21:07:43', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '52', 'Budi', ''),
(414, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '53', '53', ''),
(415, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '53', '2', ''),
(416, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '53', '1', ''),
(417, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '53', '11', ''),
(418, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '53', '2018', ''),
(419, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '53', NULL, ''),
(420, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '53', '525000.00', ''),
(421, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '53', 'A002', ''),
(422, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '53', 'Budi', ''),
(423, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '54', '54', ''),
(424, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '54', '2', ''),
(425, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '54', '1', ''),
(426, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '54', '12', ''),
(427, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '54', '2018', ''),
(428, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '54', NULL, ''),
(429, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '54', '525000.00', ''),
(430, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '54', 'A002', '');
INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(431, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '54', 'Budi', ''),
(432, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '55', '55', ''),
(433, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '55', '2', ''),
(434, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '55', '1', ''),
(435, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '55', '1', ''),
(436, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '55', '2019', ''),
(437, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '55', NULL, ''),
(438, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '55', '525000.00', ''),
(439, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '55', 'A002', ''),
(440, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '55', 'Budi', ''),
(441, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '56', '56', ''),
(442, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '56', '2', ''),
(443, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '56', '1', ''),
(444, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '56', '2', ''),
(445, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '56', '2019', ''),
(446, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '56', NULL, ''),
(447, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '56', '525000.00', ''),
(448, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '56', 'A002', ''),
(449, '2018-10-14 21:07:44', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '56', 'Budi', ''),
(450, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '57', '57', ''),
(451, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '57', '2', ''),
(452, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '57', '1', ''),
(453, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '57', '3', ''),
(454, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '57', '2019', ''),
(455, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '57', NULL, ''),
(456, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '57', '525000.00', ''),
(457, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '57', 'A002', ''),
(458, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '57', 'Budi', ''),
(459, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '58', '58', ''),
(460, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '58', '2', ''),
(461, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '58', '1', ''),
(462, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '58', '4', ''),
(463, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '58', '2019', ''),
(464, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '58', NULL, ''),
(465, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '58', '525000.00', ''),
(466, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '58', 'A002', ''),
(467, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '58', 'Budi', ''),
(468, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '59', '59', ''),
(469, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '59', '2', ''),
(470, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '59', '1', ''),
(471, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '59', '5', ''),
(472, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '59', '2019', ''),
(473, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '59', NULL, ''),
(474, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '59', '525000.00', ''),
(475, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '59', 'A002', ''),
(476, '2018-10-14 21:07:45', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '59', 'Budi', ''),
(477, '2018-10-14 21:07:46', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '60', '60', ''),
(478, '2018-10-14 21:07:46', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '60', '2', ''),
(479, '2018-10-14 21:07:46', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '60', '1', ''),
(480, '2018-10-14 21:07:46', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '60', '6', ''),
(481, '2018-10-14 21:07:46', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '60', '2019', ''),
(482, '2018-10-14 21:07:46', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '60', NULL, ''),
(483, '2018-10-14 21:07:46', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '60', '525000.00', ''),
(484, '2018-10-14 21:07:46', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nomor_Induk', '60', 'A002', ''),
(485, '2018-10-14 21:07:46', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Siswa_Nama', '60', 'Budi', ''),
(486, '2018-10-14 21:07:46', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't03_siswa', 'id', '2', '2', ''),
(487, '2018-10-14 21:07:46', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't03_siswa', 'kelas_id', '2', '1', ''),
(488, '2018-10-14 21:07:46', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't03_siswa', 'Nomor_Induk', '2', 'A002', ''),
(489, '2018-10-14 21:07:46', '/pembayaran3/t03_siswadelete.php', '1', 'D', 't03_siswa', 'Nama', '2', 'Budi', ''),
(490, '2018-10-14 21:07:46', '/pembayaran3/t03_siswadelete.php', '1', '*** Batch delete successful ***', 't03_siswa', '', '', '', ''),
(491, '2018-10-14 21:29:56', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'kelas_id', '3', '', '1'),
(492, '2018-10-14 21:29:56', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nomor_Induk', '3', '', 'A0001'),
(493, '2018-10-14 21:29:56', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nama', '3', '', 'Ahmad'),
(494, '2018-10-14 21:29:56', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'id', '3', '', '3'),
(495, '2018-10-14 21:29:57', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't05_siswarutin', '', '', '', ''),
(496, '2018-10-14 21:29:57', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '5', '', '1'),
(497, '2018-10-14 21:29:57', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '5', '', '35000'),
(498, '2018-10-14 21:29:57', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '5', '', '3'),
(499, '2018-10-14 21:29:57', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '5', '', '5'),
(500, '2018-10-14 21:29:57', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '6', '', '2'),
(501, '2018-10-14 21:29:57', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '6', '', '45000'),
(502, '2018-10-14 21:29:57', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '6', '', '3'),
(503, '2018-10-14 21:29:57', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '6', '', '6'),
(504, '2018-10-14 21:29:57', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't05_siswarutin', '', '', '', ''),
(505, '2018-10-14 21:29:57', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't08_siswanonrutin', '', '', '', ''),
(506, '2018-10-14 21:29:57', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't08_siswanonrutin', 'nonrutin_id', '2', '', '1'),
(507, '2018-10-14 21:29:57', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't08_siswanonrutin', 'Nilai', '2', '', '250000'),
(508, '2018-10-14 21:29:57', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't08_siswanonrutin', 'siswa_id', '2', '', '3'),
(509, '2018-10-14 21:29:57', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't08_siswanonrutin', 'id', '2', '', '2'),
(510, '2018-10-14 21:29:57', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't08_siswanonrutin', '', '', '', ''),
(511, '2018-10-14 22:18:22', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(512, '2018-10-14 22:37:53', '/pembayaran3/v01_siswanonrutinedit.php', '1', '*** Batch update begin ***', 't09_siswanonrutinbayar', '', '', '', ''),
(513, '2018-10-14 22:37:53', '/pembayaran3/v01_siswanonrutinedit.php', '1', 'A', 't09_siswanonrutinbayar', 'Bayar_Tgl', '1', '', '2018-10-14'),
(514, '2018-10-14 22:37:53', '/pembayaran3/v01_siswanonrutinedit.php', '1', 'A', 't09_siswanonrutinbayar', 'Bayar_Jumlah', '1', '', '50000'),
(515, '2018-10-14 22:37:53', '/pembayaran3/v01_siswanonrutinedit.php', '1', 'A', 't09_siswanonrutinbayar', 'siswanonrutin_id', '1', '', '2'),
(516, '2018-10-14 22:37:53', '/pembayaran3/v01_siswanonrutinedit.php', '1', 'A', 't09_siswanonrutinbayar', 'id', '1', '', '1'),
(517, '2018-10-14 22:37:53', '/pembayaran3/v01_siswanonrutinedit.php', '1', '*** Batch update successful ***', 't09_siswanonrutinbayar', '', '', '', ''),
(518, '2018-10-15 00:12:35', '/pembayaran3/v01_siswanonrutinedit.php', '1', '*** Batch update begin ***', 't09_siswanonrutinbayar', '', '', '', ''),
(519, '2018-10-15 00:12:35', '/pembayaran3/v01_siswanonrutinedit.php', '1', 'U', 't09_siswanonrutinbayar', 'Bayar_Jumlah', '1', '50000.00', '40000'),
(520, '2018-10-15 00:12:35', '/pembayaran3/v01_siswanonrutinedit.php', '1', '*** Batch update successful ***', 't09_siswanonrutinbayar', '', '', '', ''),
(521, '2018-10-15 00:15:20', '/pembayaran3/v01_siswanonrutinedit.php', '1', '*** Batch update begin ***', 't09_siswanonrutinbayar', '', '', '', ''),
(522, '2018-10-15 00:15:20', '/pembayaran3/v01_siswanonrutinedit.php', '1', '*** Batch delete begin ***', 't09_siswanonrutinbayar', '', '', '', ''),
(523, '2018-10-15 00:15:20', '/pembayaran3/v01_siswanonrutinedit.php', '1', 'D', 't09_siswanonrutinbayar', 'id', '1', '1', ''),
(524, '2018-10-15 00:15:20', '/pembayaran3/v01_siswanonrutinedit.php', '1', 'D', 't09_siswanonrutinbayar', 'siswanonrutin_id', '1', '2', ''),
(525, '2018-10-15 00:15:20', '/pembayaran3/v01_siswanonrutinedit.php', '1', 'D', 't09_siswanonrutinbayar', 'Bayar_Tgl', '1', '2018-10-14', ''),
(526, '2018-10-15 00:15:20', '/pembayaran3/v01_siswanonrutinedit.php', '1', 'D', 't09_siswanonrutinbayar', 'Bayar_Jumlah', '1', '40000.00', ''),
(527, '2018-10-15 00:15:20', '/pembayaran3/v01_siswanonrutinedit.php', '1', '*** Batch delete successful ***', 't09_siswanonrutinbayar', '', '', '', ''),
(528, '2018-10-15 00:15:20', '/pembayaran3/v01_siswanonrutinedit.php', '1', '*** Batch update successful ***', 't09_siswanonrutinbayar', '', '', '', ''),
(529, '2018-10-15 00:16:53', '/pembayaran3/v01_siswanonrutinedit.php', '1', '*** Batch update begin ***', 't09_siswanonrutinbayar', '', '', '', ''),
(530, '2018-10-15 00:16:53', '/pembayaran3/v01_siswanonrutinedit.php', '1', 'A', 't09_siswanonrutinbayar', 'Bayar_Tgl', '2', '', '2018-10-15'),
(531, '2018-10-15 00:16:53', '/pembayaran3/v01_siswanonrutinedit.php', '1', 'A', 't09_siswanonrutinbayar', 'Bayar_Jumlah', '2', '', '75000'),
(532, '2018-10-15 00:16:53', '/pembayaran3/v01_siswanonrutinedit.php', '1', 'A', 't09_siswanonrutinbayar', 'siswanonrutin_id', '2', '', '2'),
(533, '2018-10-15 00:16:53', '/pembayaran3/v01_siswanonrutinedit.php', '1', 'A', 't09_siswanonrutinbayar', 'id', '2', '', '2'),
(534, '2018-10-15 00:16:53', '/pembayaran3/v01_siswanonrutinedit.php', '1', '*** Batch update successful ***', 't09_siswanonrutinbayar', '', '', '', ''),
(535, '2018-10-15 16:19:07', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(536, '2018-10-22 08:56:53', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(537, '2018-10-22 09:52:35', '/pembayaran3/logout.php', 'admin', 'logout', '::1', '', '', '', ''),
(538, '2018-10-22 09:52:41', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(539, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'kelas_id', '4', '', '1'),
(540, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nomor_Induk', '4', '', 'B0001'),
(541, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nama', '4', '', 'Budiman'),
(542, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'id', '4', '', '4'),
(543, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't05_siswarutin', '', '', '', ''),
(544, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '7', '', '1'),
(545, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '7', '', '125500'),
(546, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '7', '', '4'),
(547, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '7', '', '7'),
(548, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '8', '', '2'),
(549, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '8', '', '135500'),
(550, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '8', '', '4'),
(551, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '8', '', '8'),
(552, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '9', '', '3'),
(553, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '9', '', '145500'),
(554, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '9', '', '4'),
(555, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '9', '', '9'),
(556, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't05_siswarutin', '', '', '', ''),
(557, '2018-10-22 11:44:11', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't08_siswanonrutin', '', '', '', ''),
(558, '2018-10-22 11:47:59', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'kelas_id', '5', '', '1'),
(559, '2018-10-22 11:47:59', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nomor_Induk', '5', '', 'C0001'),
(560, '2018-10-22 11:47:59', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nama', '5', '', 'Candra'),
(561, '2018-10-22 11:47:59', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'id', '5', '', '5'),
(562, '2018-10-22 11:47:59', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't05_siswarutin', '', '', '', ''),
(563, '2018-10-22 11:47:59', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '10', '', '1'),
(564, '2018-10-22 11:47:59', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '10', '', '25500'),
(565, '2018-10-22 11:47:59', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '10', '', '5'),
(566, '2018-10-22 11:47:59', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '10', '', '10'),
(567, '2018-10-22 11:47:59', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '11', '', '2'),
(568, '2018-10-22 11:47:59', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '11', '', '35500'),
(569, '2018-10-22 11:47:59', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '11', '', '5'),
(570, '2018-10-22 11:47:59', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '11', '', '11'),
(571, '2018-10-22 11:47:59', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't05_siswarutin', '', '', '', ''),
(572, '2018-10-22 11:47:59', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't08_siswanonrutin', '', '', '', ''),
(573, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'kelas_id', '6', '', '1'),
(574, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nomor_Induk', '6', '', 'D0001'),
(575, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nama', '6', '', 'Dian'),
(576, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'id', '6', '', '6'),
(577, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't05_siswarutin', '', '', '', ''),
(578, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '12', '', '1'),
(579, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '12', '', '88000'),
(580, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '12', '', '6'),
(581, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '12', '', '12'),
(582, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '13', '', '2'),
(583, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '13', '', '88100'),
(584, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '13', '', '6'),
(585, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '13', '', '13'),
(586, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '14', '', '3'),
(587, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '14', '', '88200'),
(588, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '14', '', '6'),
(589, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '14', '', '14'),
(590, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't05_siswarutin', '', '', '', ''),
(591, '2018-10-22 12:16:36', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't08_siswanonrutin', '', '', '', ''),
(592, '2018-10-22 13:16:36', '/pembayaran3/t06_siswarutinbayarlist.php', '1', 'U', 't06_siswarutinbayar', 'Bayar_Tgl', '145', NULL, '2018-10-22'),
(593, '2018-10-23 09:31:30', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(594, '2018-10-23 12:22:53', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(595, '2018-10-23 21:44:37', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(596, '2018-10-24 09:45:28', '/pembayaran3/login.php', 'admin', 'login', '::1', '', '', '', ''),
(597, '2018-10-24 15:07:54', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar_2', '', '', '', ''),
(598, '2018-10-24 15:07:54', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar1_id', '3', '0', '146'),
(599, '2018-10-24 15:07:54', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar2_id', '3', '0', '146'),
(600, '2018-10-24 15:07:54', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'Bayar_Jumlah', '3', '0.00', NULL),
(601, '2018-10-24 15:07:54', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar1_id', '4', '0', NULL),
(602, '2018-10-24 15:07:54', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar2_id', '4', '0', NULL),
(603, '2018-10-24 15:07:54', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'Bayar_Jumlah', '4', '0.00', NULL),
(604, '2018-10-24 15:07:55', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar1_id', '5', '0', NULL),
(605, '2018-10-24 15:07:55', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar2_id', '5', '0', NULL),
(606, '2018-10-24 15:07:55', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'Bayar_Jumlah', '5', '0.00', NULL),
(607, '2018-10-24 15:07:55', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar_2', '', '', '', ''),
(608, '2018-10-24 15:09:14', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar_2', '', '', '', ''),
(609, '2018-10-24 15:09:14', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar1_id', '3', NULL, '146'),
(610, '2018-10-24 15:09:14', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar2_id', '3', NULL, '146'),
(611, '2018-10-24 15:09:14', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar_2', '', '', '', ''),
(612, '2018-10-24 15:11:21', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar_2', '', '', '', ''),
(613, '2018-10-24 15:11:21', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar1_id', '3', '146', '147'),
(614, '2018-10-24 15:11:21', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar2_id', '3', '146', '147'),
(615, '2018-10-24 15:11:21', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar_2', '', '', '', ''),
(616, '2018-10-24 15:16:20', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar_2', '', '', '', ''),
(617, '2018-10-24 15:16:20', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar1_id', '3', NULL, '146'),
(618, '2018-10-24 15:16:20', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar2_id', '3', NULL, '146'),
(619, '2018-10-24 15:16:20', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar_2', '', '', '', ''),
(620, '2018-10-24 15:18:01', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar_2', '', '', '', ''),
(621, '2018-10-24 15:18:01', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar1_id', '3', NULL, '146'),
(622, '2018-10-24 15:18:01', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar2_id', '3', NULL, '146'),
(623, '2018-10-24 15:18:01', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar_2', '', '', '', ''),
(624, '2018-10-24 15:18:51', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar_2', '', '', '', ''),
(625, '2018-10-24 15:18:51', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar1_id', '3', '146', '147'),
(626, '2018-10-24 15:18:51', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar2_id', '3', '146', '149'),
(627, '2018-10-24 15:18:51', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar_2', '', '', '', ''),
(628, '2018-10-24 15:24:02', '/pembayaran3/t06_siswarutinbayarlist.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar', '', '', '', ''),
(629, '2018-10-24 15:24:02', '/pembayaran3/t06_siswarutinbayarlist.php', '1', 'U', 't06_siswarutinbayar', 'Bayar_Tgl', '146', '2018-10-24', NULL),
(630, '2018-10-24 15:24:03', '/pembayaran3/t06_siswarutinbayarlist.php', '1', 'U', 't06_siswarutinbayar', 'Bayar_Tgl', '147', '2018-10-24', NULL),
(631, '2018-10-24 15:24:03', '/pembayaran3/t06_siswarutinbayarlist.php', '1', 'U', 't06_siswarutinbayar', 'Bayar_Tgl', '148', '2018-10-24', NULL),
(632, '2018-10-24 15:24:03', '/pembayaran3/t06_siswarutinbayarlist.php', '1', 'U', 't06_siswarutinbayar', 'Bayar_Tgl', '149', '2018-10-24', NULL),
(633, '2018-10-24 15:24:03', '/pembayaran3/t06_siswarutinbayarlist.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar', '', '', '', ''),
(634, '2018-10-24 15:24:23', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar_2', '', '', '', ''),
(635, '2018-10-24 15:24:23', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar1_id', '3', '147', '146'),
(636, '2018-10-24 15:24:23', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar2_id', '3', '149', '146'),
(637, '2018-10-24 15:24:23', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar_2', '', '', '', ''),
(638, '2018-10-24 15:26:18', '/pembayaran3/t06_siswarutinbayarlist.php', '1', 'U', 't06_siswarutinbayar', 'Bayar_Tgl', '146', '2018-10-24', NULL),
(639, '2018-10-24 15:26:35', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar_2', '', '', '', ''),
(640, '2018-10-24 15:26:35', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar2_id', '3', '146', '147'),
(641, '2018-10-24 15:26:35', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar_2', '', '', '', ''),
(642, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'kelas_id', '1', '', '1'),
(643, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nomor_Induk', '1', '', 'E0001'),
(644, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nama', '1', '', 'Elisa'),
(645, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't03_siswa', 'id', '1', '', '1'),
(646, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't05_siswarutin', '', '', '', ''),
(647, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '1', '', '1'),
(648, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '1', '', '70000'),
(649, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '1', '', '1'),
(650, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '1', '', '1'),
(651, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '2', '', '2'),
(652, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '2', '', '71000'),
(653, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '2', '', '1'),
(654, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '2', '', '2'),
(655, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '3', '', '3'),
(656, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '3', '', '72000'),
(657, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '3', '', '1'),
(658, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '3', '', '3'),
(659, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't05_siswarutin', '', '', '', ''),
(660, '2018-10-24 15:44:18', '/pembayaran3/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't08_siswanonrutin', '', '', '', ''),
(661, '2018-10-24 15:45:14', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar_2', '', '', '', ''),
(662, '2018-10-24 15:45:14', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar1_id', '1', NULL, '1'),
(663, '2018-10-24 15:45:14', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'Bayar_Jumlah', '1', '0.00', NULL),
(664, '2018-10-24 15:45:14', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'Bayar_Jumlah', '2', '0.00', NULL),
(665, '2018-10-24 15:45:14', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'Bayar_Jumlah', '3', '0.00', NULL),
(666, '2018-10-24 15:45:14', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar_2', '', '', '', ''),
(668, '2018-10-24 15:51:25', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(670, '2018-10-24 15:51:41', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(672, '2018-10-24 15:51:55', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(674, '2018-10-24 15:52:05', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(677, '2018-10-24 15:52:14', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(680, '2018-10-24 15:52:24', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(682, '2018-10-24 15:53:07', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(684, '2018-10-24 15:53:15', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(688, '2018-10-24 15:53:57', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(690, '2018-10-24 15:56:21', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(694, '2018-10-24 15:56:27', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(698, '2018-10-24 15:56:32', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(702, '2018-10-24 15:56:48', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(704, '2018-10-24 16:02:27', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(706, '2018-10-24 16:02:32', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(708, '2018-10-24 16:02:36', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(710, '2018-10-24 16:02:43', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(712, '2018-10-24 16:05:24', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(714, '2018-10-24 16:05:34', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(716, '2018-10-24 16:07:34', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(720, '2018-10-24 16:07:43', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(724, '2018-10-24 16:08:31', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(728, '2018-10-24 16:10:52', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(732, '2018-10-24 16:12:22', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update rollback ***', 't06_siswarutinbayar_2', '', '', '', ''),
(733, '2018-10-24 16:13:22', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar_2', '', '', '', ''),
(734, '2018-10-24 16:13:22', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar1_id', '1', NULL, '1'),
(735, '2018-10-24 16:13:22', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar2_id', '1', NULL, '1'),
(736, '2018-10-24 16:13:22', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar_2', '', '', '', ''),
(737, '2018-10-24 16:14:44', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar_2', '', '', '', ''),
(738, '2018-10-24 16:14:44', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar1_id', '1', NULL, '2'),
(739, '2018-10-24 16:14:44', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar2_id', '1', NULL, '2'),
(740, '2018-10-24 16:14:44', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar_2', '', '', '', ''),
(741, '2018-10-24 16:15:53', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar_2', '', '', '', ''),
(742, '2018-10-24 16:15:53', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar1_id', '1', NULL, '3'),
(743, '2018-10-24 16:15:53', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar2_id', '1', NULL, '3'),
(744, '2018-10-24 16:15:53', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar_2', '', '', '', ''),
(745, '2018-10-24 16:17:32', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar_2', '', '', '', ''),
(746, '2018-10-24 16:17:32', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar1_id', '1', NULL, '4'),
(747, '2018-10-24 16:17:32', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar2_id', '1', NULL, '4'),
(748, '2018-10-24 16:17:32', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar_2', '', '', '', ''),
(749, '2018-10-24 16:18:24', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar_2', '', '', '', ''),
(750, '2018-10-24 16:18:24', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar1_id', '1', NULL, '4'),
(751, '2018-10-24 16:18:24', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar2_id', '1', NULL, '4'),
(752, '2018-10-24 16:18:24', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar_2', '', '', '', ''),
(753, '2018-10-24 16:20:11', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update begin ***', 't06_siswarutinbayar_2', '', '', '', ''),
(754, '2018-10-24 16:20:11', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar1_id', '1', NULL, '4'),
(755, '2018-10-24 16:20:11', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', 'U', 't06_siswarutinbayar_2', 'siswarutinbayar2_id', '1', NULL, '4'),
(756, '2018-10-24 16:20:11', '/pembayaran3/t06_siswarutinbayar_2list.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar_2', '', '', '', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v01_siswanonrutin`
-- (See below for the actual view)
--
CREATE TABLE `v01_siswanonrutin` (
`id` int(11)
,`siswa_id` int(11)
,`nonrutin_id` int(11)
,`Nilai` float(14,2)
,`Terbayar` float(14,2)
,`Sisa` float(14,2)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v02_siswarutinbayar`
-- (See below for the actual view)
--
CREATE TABLE `v02_siswarutinbayar` (
`id` int(11)
,`siswa_id` int(11)
,`rutin_id` int(11)
,`Bulan` tinyint(4)
,`Tahun` smallint(6)
,`Periode` varchar(12)
,`Periode2` varchar(16)
,`Bayar_Tgl` date
,`Bayar_Jumlah` float(14,2)
);

-- --------------------------------------------------------

--
-- Structure for view `v01_siswanonrutin`
--
DROP TABLE IF EXISTS `v01_siswanonrutin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v01_siswanonrutin`  AS  select `t08_siswanonrutin`.`id` AS `id`,`t08_siswanonrutin`.`siswa_id` AS `siswa_id`,`t08_siswanonrutin`.`nonrutin_id` AS `nonrutin_id`,`t08_siswanonrutin`.`Nilai` AS `Nilai`,`t08_siswanonrutin`.`Terbayar` AS `Terbayar`,`t08_siswanonrutin`.`Sisa` AS `Sisa` from `t08_siswanonrutin` ;

-- --------------------------------------------------------

--
-- Structure for view `v02_siswarutinbayar`
--
DROP TABLE IF EXISTS `v02_siswarutinbayar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v02_siswarutinbayar`  AS  select `t06_siswarutinbayar`.`id` AS `id`,`t06_siswarutinbayar`.`siswa_id` AS `siswa_id`,`t06_siswarutinbayar`.`rutin_id` AS `rutin_id`,`t06_siswarutinbayar`.`Bulan` AS `Bulan`,`t06_siswarutinbayar`.`Tahun` AS `Tahun`,concat(`t06_siswarutinbayar`.`Tahun`,'-',right(concat('00',`t06_siswarutinbayar`.`Bulan`),2),'-01') AS `Periode`,concat((case `t06_siswarutinbayar`.`Bulan` when 1 then 'Januari' when 2 then 'Februari' when 3 then 'Maret' when 4 then 'April' when 5 then 'Mei' when 6 then 'Juni' when 7 then 'Juli' when 8 then 'Agustus' when 9 then 'September' when 10 then 'Oktober' when 11 then 'November' when 12 then 'Desember' end),' ',`t06_siswarutinbayar`.`Tahun`) AS `Periode2`,`t06_siswarutinbayar`.`Bayar_Tgl` AS `Bayar_Tgl`,`t06_siswarutinbayar`.`Bayar_Jumlah` AS `Bayar_Jumlah` from `t06_siswarutinbayar` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t00_tahunajaran`
--
ALTER TABLE `t00_tahunajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t01_sekolah`
--
ALTER TABLE `t01_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t02_kelas`
--
ALTER TABLE `t02_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t03_siswa`
--
ALTER TABLE `t03_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t04_rutin`
--
ALTER TABLE `t04_rutin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t05_siswarutin`
--
ALTER TABLE `t05_siswarutin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_id__rutin_id` (`siswa_id`,`rutin_id`);

--
-- Indexes for table `t06_siswarutinbayar`
--
ALTER TABLE `t06_siswarutinbayar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t06_siswarutinbayar_2`
--
ALTER TABLE `t06_siswarutinbayar_2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t07_nonrutin`
--
ALTER TABLE `t07_nonrutin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t08_siswanonrutin`
--
ALTER TABLE `t08_siswanonrutin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `siswa_id__nonrutin_id` (`siswa_id`,`nonrutin_id`) USING BTREE;

--
-- Indexes for table `t09_siswanonrutinbayar`
--
ALTER TABLE `t09_siswanonrutinbayar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t96_employees`
--
ALTER TABLE `t96_employees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `t97_userlevels`
--
ALTER TABLE `t97_userlevels`
  ADD PRIMARY KEY (`userlevelid`);

--
-- Indexes for table `t98_userlevelpermissions`
--
ALTER TABLE `t98_userlevelpermissions`
  ADD PRIMARY KEY (`userlevelid`,`tablename`);

--
-- Indexes for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t00_tahunajaran`
--
ALTER TABLE `t00_tahunajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t01_sekolah`
--
ALTER TABLE `t01_sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t02_kelas`
--
ALTER TABLE `t02_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t03_siswa`
--
ALTER TABLE `t03_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t04_rutin`
--
ALTER TABLE `t04_rutin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t05_siswarutin`
--
ALTER TABLE `t05_siswarutin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t06_siswarutinbayar`
--
ALTER TABLE `t06_siswarutinbayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `t06_siswarutinbayar_2`
--
ALTER TABLE `t06_siswarutinbayar_2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `t07_nonrutin`
--
ALTER TABLE `t07_nonrutin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t08_siswanonrutin`
--
ALTER TABLE `t08_siswanonrutin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t09_siswanonrutinbayar`
--
ALTER TABLE `t09_siswanonrutinbayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t96_employees`
--
ALTER TABLE `t96_employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=757;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
