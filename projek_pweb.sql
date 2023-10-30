-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2023 at 03:30 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projek_pweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `motor`
--

CREATE TABLE `motor` (
  `plat_nomor` varchar(10) NOT NULL,
  `merek` varchar(45) NOT NULL,
  `tipe` varchar(45) NOT NULL,
  `sewa_perhari` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `id_pemilik` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `username` varchar(45) NOT NULL,
  `nik` varchar(45) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `no_hp` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `tgl_penyewaan` date NOT NULL,
  `tgl_pengembalian` date NOT NULL,
  `plat_nomor` varchar(45) DEFAULT NULL,
  `id_penyewaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyewa`
--

CREATE TABLE `penyewa` (
  `username` varchar(45) NOT NULL,
  `nik` varchar(45) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `no_hp` varchar(45) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id_penyewaan` int(11) NOT NULL,
  `tgl_penyewaan` date NOT NULL,
  `merek_motor` varchar(45) NOT NULL,
  `tipe_motor` varchar(45) NOT NULL,
  `plat_nomor` varchar(45) DEFAULT NULL,
  `id_pemilik` varchar(45) NOT NULL,
  `sewa_perhari` int(11) NOT NULL,
  `id_penyewa` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `motor`
--
ALTER TABLE `motor`
  ADD PRIMARY KEY (`plat_nomor`),
  ADD KEY `id_pemilik` (`id_pemilik`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_penyewaan` (`id_penyewaan`);

--
-- Indexes for table `penyewa`
--
ALTER TABLE `penyewa`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id_penyewaan`),
  ADD KEY `id_penyewa` (`id_penyewa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penyewaan`
--
ALTER TABLE `penyewaan`
  MODIFY `id_penyewaan` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `motor`
--
ALTER TABLE `motor`
  ADD CONSTRAINT `motor_ibfk_1` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`username`) ON UPDATE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_penyewaan`) REFERENCES `penyewaan` (`id_penyewaan`) ON UPDATE CASCADE;

--
-- Constraints for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD CONSTRAINT `penyewaan_ibfk_1` FOREIGN KEY (`id_penyewa`) REFERENCES `penyewa` (`username`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
