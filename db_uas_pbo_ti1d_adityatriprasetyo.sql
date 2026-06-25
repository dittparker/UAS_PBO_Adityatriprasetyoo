-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 25, 2026 at 06:37 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_uas_pbo_ti_1d_adityatriprasetyo`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_mahasiswa`
--

CREATE TABLE `tabel_mahasiswa` (
  `id_mahasiswa` int NOT NULL,
  `nama_mahasiswa` varchar(255) NOT NULL,
  `nilai` decimal(4,2) NOT NULL,
  `semester` int NOT NULL,
  `tarif_ukt` int NOT NULL,
  `jenis_pembiayaan` enum('mandiri','bidikmisi','prestasi') NOT NULL,
  `golongan_ukt` varchar(10) DEFAULT NULL,
  `nama_wali` varchar(150) DEFAULT NULL,
  `nomor_kip_kuliah` varchar(50) DEFAULT NULL,
  `minimal_ipk_syarat` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_mahasiswa`
--

INSERT INTO `tabel_mahasiswa` (`id_mahasiswa`, `nama_mahasiswa`, `nilai`, `semester`, `tarif_ukt`, `jenis_pembiayaan`, `golongan_ukt`, `nama_wali`, `nomor_kip_kuliah`, `minimal_ipk_syarat`) VALUES
(1, 'Aditya Tri Prasetyo', '3.45', 2, 4500000, 'mandiri', 'Golongan 4', 'Suryono', NULL, NULL),
(2, 'Fawwaz Hudzaifah', '3.60', 4, 5500000, 'mandiri', 'Golongan 5', 'Rahmat', NULL, NULL),
(3, 'Pandu Wijaya', '3.12', 2, 3500000, 'mandiri', 'Golongan 3', 'Bambang', NULL, NULL),
(4, 'Rian Hidayat', '2.90', 6, 4500000, 'mandiri', 'Golongan 4', 'Agus Hadi', NULL, NULL),
(5, 'Siti Aminah', '3.70', 2, 5500000, 'mandiri', 'Golongan 5', 'Mulyono', NULL, NULL),
(6, 'Budi Setiawan', '3.25', 4, 3500000, 'mandiri', 'Golongan 3', 'Eko Susilo', NULL, NULL),
(7, 'Dimas Saputra', '3.40', 2, 4500000, 'mandiri', 'Golongan 4', 'Herianto', NULL, NULL),
(8, 'Ahmad Dahlan', '3.80', 4, 0, 'bidikmisi', NULL, NULL, 'KIP-K-2026-001', NULL),
(9, 'Dewi Lestari', '3.65', 2, 0, 'bidikmisi', NULL, NULL, 'KIP-K-2026-002', NULL),
(10, 'Eko Prasetyo', '3.50', 6, 0, 'bidikmisi', NULL, NULL, 'KIP-K-2026-003', NULL),
(11, 'Fitriani Nur', '3.92', 2, 0, 'bidikmisi', NULL, NULL, 'KIP-K-2026-004', NULL),
(12, 'Gani Rahman', '3.42', 4, 0, 'bidikmisi', NULL, NULL, 'KIP-K-2026-005', NULL),
(13, 'Hendra Wijaya', '3.73', 2, 0, 'bidikmisi', NULL, NULL, 'KIP-K-2026-006', NULL),
(14, 'Indah Permata', '3.58', 4, 0, 'bidikmisi', NULL, NULL, 'KIP-K-2026-007', NULL),
(15, 'Joko Widodo', '3.85', 4, 1000000, 'prestasi', NULL, NULL, NULL, '3.50'),
(16, 'Kartika Putri', '3.90', 2, 1500000, 'prestasi', NULL, NULL, NULL, '3.60'),
(17, 'Laksana Tri', '3.78', 6, 1200000, 'prestasi', NULL, NULL, NULL, '3.30'),
(18, 'Mega Utami', '3.95', 2, 2000000, 'prestasi', NULL, NULL, NULL, '3.75'),
(19, 'Naufal Abdi', '3.82', 4, 1000000, 'prestasi', NULL, NULL, NULL, '3.50'),
(20, 'Putri Rizky', '3.88', 2, 1500000, 'prestasi', NULL, NULL, NULL, '3.60');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  ADD PRIMARY KEY (`id_mahasiswa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_mahasiswa`
--
ALTER TABLE `tabel_mahasiswa`
  MODIFY `id_mahasiswa` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
