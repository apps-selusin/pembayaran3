-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 10, 2018 at 11:10 AM
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
(1, 1, 'A0001', 'Adi');

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
  `rutin_id` int(11) NOT NULL,
  `Nilai` float(14,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t05_siswarutin`
--

INSERT INTO `t05_siswarutin` (`id`, `siswa_id`, `rutin_id`, `Nilai`) VALUES
(1, 1, 1, 5000.00),
(2, 1, 2, 10000.00);

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
(1, 1, 1, 7, 2018, '2018-07-02', 5000.00),
(2, 1, 1, 8, 2018, '2018-08-06', 5000.00),
(3, 1, 1, 9, 2018, '2018-09-03', 5000.00),
(4, 1, 1, 10, 2018, '2018-10-01', 5000.00),
(5, 1, 1, 11, 2018, NULL, 5000.00),
(6, 1, 1, 12, 2018, NULL, 5000.00),
(7, 1, 1, 1, 2019, NULL, 5000.00),
(8, 1, 1, 2, 2019, NULL, 5000.00),
(9, 1, 1, 3, 2019, NULL, 5000.00),
(10, 1, 1, 4, 2019, NULL, 5000.00),
(11, 1, 1, 5, 2019, NULL, 5000.00),
(12, 1, 1, 6, 2019, NULL, 5000.00),
(13, 1, 2, 7, 2018, NULL, 10000.00),
(14, 1, 2, 8, 2018, NULL, 10000.00),
(15, 1, 2, 9, 2018, NULL, 10000.00),
(16, 1, 2, 10, 2018, NULL, 10000.00),
(17, 1, 2, 11, 2018, NULL, 10000.00),
(18, 1, 2, 12, 2018, NULL, 10000.00),
(19, 1, 2, 1, 2019, NULL, 10000.00),
(20, 1, 2, 2, 2019, NULL, 10000.00),
(21, 1, 2, 3, 2019, NULL, 10000.00),
(22, 1, 2, 4, 2019, NULL, 10000.00),
(23, 1, 2, 5, 2019, NULL, 10000.00),
(24, 1, 2, 6, 2019, NULL, 10000.00);

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
(81, '2018-10-10 16:10:09', '/pembayaran3/t06_siswarutinbayarlist.php', '1', '*** Batch update successful ***', 't06_siswarutinbayar', '', '', '', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t06_siswarutinbayar`
--
ALTER TABLE `t06_siswarutinbayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `t96_employees`
--
ALTER TABLE `t96_employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
