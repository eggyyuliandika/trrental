-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 05, 2026 at 12:35 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_trrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `armada`
--

CREATE TABLE `armada` (
  `id_armada` int NOT NULL,
  `nama_armada` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `merk_armada` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipe_armada` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `plat_armada` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tahun_armada` int DEFAULT NULL,
  `transmisi` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `harga_sewa_perhari` int DEFAULT NULL,
  `status_armada` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `gambar_armada` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `armada`
--

INSERT INTO `armada` (`id_armada`, `nama_armada`, `merk_armada`, `tipe_armada`, `plat_armada`, `tahun_armada`, `transmisi`, `harga_sewa_perhari`, `status_armada`, `gambar_armada`) VALUES
(1, 'Beat', 'Honda', '150 CC', 'DK 235 OP', 2025, 'Matic', 230000, 'tersedia', 'armada_69d122737cc12.webp');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id_booking` int NOT NULL,
  `id_cust` int NOT NULL,
  `id_armada` int NOT NULL,
  `id_staff` int DEFAULT NULL,
  `tgl_pinjam` date DEFAULT NULL,
  `tgl_kembali` date DEFAULT NULL,
  `jumlah_hari` int DEFAULT NULL,
  `metode_pengambilan` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `titik_jemput` text COLLATE utf8mb4_general_ci,
  `alamat_pengantaran` text COLLATE utf8mb4_general_ci,
  `metode_pembayaran` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status_booking` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_bayar` int DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `foto_sim` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto_ktp` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto_tiket` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `foto_hotel` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id_booking`, `id_cust`, `id_armada`, `id_staff`, `tgl_pinjam`, `tgl_kembali`, `jumlah_hari`, `metode_pengambilan`, `titik_jemput`, `alamat_pengantaran`, `metode_pembayaran`, `status_booking`, `total_bayar`, `created_at`, `foto_sim`, `foto_ktp`, `foto_tiket`, `foto_hotel`) VALUES
(2, 3, 1, NULL, '2026-04-05', '2026-04-11', 6, 'antar_jemput', '', '', '0', 'selesai', 1380000, '2026-04-04 14:40:32', 'foto_sim_69d122e02cb90.png', 'foto_ktp_69d122e02d1af.png', 'foto_tiket_69d122e02d598.png', 'foto_hotel_69d122e02d85c.jpeg'),
(3, 4, 1, NULL, '2026-04-12', '2026-04-22', 10, 'ambil_sendiri', '', '', '0', 'selesai', 2300000, '2026-04-04 14:48:35', 'foto_sim_69d124c318e13.png', 'foto_ktp_69d124c3198f8.webp', 'foto_tiket_69d124c31a385.webp', 'foto_hotel_69d124c31abfd.webp');

-- --------------------------------------------------------

--
-- Table structure for table `cust`
--

CREATE TABLE `cust` (
  `id_cust` int NOT NULL,
  `nama_cust` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `no_tlp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_general_ci,
  `country_origin` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cust`
--

INSERT INTO `cust` (`id_cust`, `nama_cust`, `no_tlp`, `alamat`, `country_origin`) VALUES
(3, 'Ida Ayu Eggy Yuliandika', '082145773643', 'Jln. Bedahulu No. 5', 'Indonesia'),
(4, 'Putroi', '08522343212', 'Jln. Bedahulu No. 51', 'Indonesia');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id_staff` int NOT NULL,
  `nama_staff` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `no_tlp` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id_staff`, `nama_staff`, `username`, `password`, `no_tlp`, `alamat`) VALUES
(1, 'staff1', 'admin', '$2y$10$ONOcy6MbqMyvXhqQ5IZXEecUY7yO8f6GH41USGOeGh3i5tkt.7/Ru', '082145573643', 'Denpasar');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `armada`
--
ALTER TABLE `armada`
  ADD PRIMARY KEY (`id_armada`),
  ADD UNIQUE KEY `plat_armada` (`plat_armada`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id_booking`),
  ADD KEY `id_cust` (`id_cust`),
  ADD KEY `id_armada` (`id_armada`),
  ADD KEY `id_staff` (`id_staff`);

--
-- Indexes for table `cust`
--
ALTER TABLE `cust`
  ADD PRIMARY KEY (`id_cust`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id_staff`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `armada`
--
ALTER TABLE `armada`
  MODIFY `id_armada` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id_booking` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cust`
--
ALTER TABLE `cust`
  MODIFY `id_cust` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id_staff` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`id_cust`) REFERENCES `cust` (`id_cust`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`id_armada`) REFERENCES `armada` (`id_armada`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`id_staff`) REFERENCES `staff` (`id_staff`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
