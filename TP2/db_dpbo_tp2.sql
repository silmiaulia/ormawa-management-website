-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2022 at 05:59 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_dpbo_tp2`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidang_divisi`
--

CREATE TABLE `bidang_divisi` (
  `id_bidang` int(11) NOT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `id_divisi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bidang_divisi`
--

INSERT INTO `bidang_divisi` (`id_bidang`, `jabatan`, `id_divisi`) VALUES
(1, 'Ketua', 1),
(2, 'Bendahara', 1),
(5, 'Sekretaris', 5),
(6, 'Ketua', 2),
(7, 'Koordinator', 6),
(8, 'Ketua', 6),
(12, 'Sekretaris', 1),
(17, 'Anggota', 2),
(22, 'Sekretaris', 2);

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(1, 'Olahraga'),
(2, 'Pendidikan'),
(5, 'Seni dan Budaya'),
(6, 'Penelitian dan Pengembangan');

-- --------------------------------------------------------

--
-- Table structure for table `pengurus`
--

CREATE TABLE `pengurus` (
  `id_pengurus` int(11) NOT NULL,
  `nim` varchar(20) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `semester` int(10) DEFAULT NULL,
  `foto` varchar(200) DEFAULT '',
  `id_bidang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengurus`
--

INSERT INTO `pengurus` (`id_pengurus`, `nim`, `nama`, `semester`, `foto`, `id_bidang`) VALUES
(5, '2103913', 'Wildan Assafari', 2, '8.png', 8),
(6, '2193203', 'Karina Kusuma', 2, '1.jpg', 7),
(25, '2000318', 'Silmi Aulia Rohmah', 4, '9.png', 12),
(44, '2131381', 'Sandi Angkasa', 2, '6.png', 6),
(54, '1921383', 'Diah Putri', 6, '7.png', 5),
(55, '2103193', 'Reza Raihan', 2, '5.png', 17),
(56, '20319311', 'Azkia Putra', 4, '4.jpg', 2),
(57, '2031313', 'Ahmad Fadhil', 4, '3.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidang_divisi`
--
ALTER TABLE `bidang_divisi`
  ADD PRIMARY KEY (`id_bidang`),
  ADD KEY `fk_id_divisi` (`id_divisi`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD PRIMARY KEY (`id_pengurus`),
  ADD KEY `fk_id_bidang` (`id_bidang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidang_divisi`
--
ALTER TABLE `bidang_divisi`
  MODIFY `id_bidang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `pengurus`
--
ALTER TABLE `pengurus`
  MODIFY `id_pengurus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bidang_divisi`
--
ALTER TABLE `bidang_divisi`
  ADD CONSTRAINT `fk_id_divisi` FOREIGN KEY (`id_divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengurus`
--
ALTER TABLE `pengurus`
  ADD CONSTRAINT `fk_id_bidang` FOREIGN KEY (`id_bidang`) REFERENCES `bidang_divisi` (`id_bidang`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
