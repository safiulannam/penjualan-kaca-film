-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2023 at 06:28 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualankacafilm`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `harga` varchar(10) NOT NULL,
  `stok` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `harga`, `stok`) VALUES
('KF001', 'Eco - (Full Kaca Film 3M Blackbeauty) ', '2000000', '99'),
('KF002', 'Premium - (Full Kaca Film Depan 3M Crystalline , SKKB 3M Blackbeauty)', '4000000', '44'),
('KF003', 'Titanium - (Full Kaca Film 3M Crystalline)', '7000000', '50'),
('KF004', 'Premium - (Full Kaca Film Ilumi)', '2500000', '100'),
('KF006', 'Partial - Kaca Film Belakang 3M Blackbeauty', '600000', '39'),
('KF007', 'Partial - 1 Kaca Samping Kaca Film 3M Blackbeauty', '500000', '8');

-- --------------------------------------------------------

--
-- Table structure for table `detail_jual`
--

CREATE TABLE `detail_jual` (
  `id` int(11) NOT NULL,
  `kode_jual` varchar(20) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_jual`
--

INSERT INTO `detail_jual` (`id`, `kode_jual`, `kode_barang`, `harga`, `jumlah`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 'JUAL000005', 'KF002', 4000000, 1, 4000000, '2023-07-01 14:51:16', '2023-07-01 14:51:16'),
(6, 'JUAL20230701170346', 'KF001', 2000000, 1, 2000000, '2023-07-01 15:03:46', '2023-07-01 15:03:46'),
(7, 'JUAL20230701170408', 'KF001', 2000000, 1, 2000000, '2023-07-01 15:04:08', '2023-07-01 15:04:08'),
(8, 'JUAL20230701170544', 'KF001', 2000000, 1, 2000000, '2023-07-01 15:05:44', '2023-07-01 15:05:44'),
(9, 'JUAL20230701171112', 'KF001', 2000000, 1, 2000000, '2023-07-01 15:11:12', '2023-07-01 15:11:12'),
(10, 'JUAL20230701171113', 'KF007', 500000, 1, 500000, '2023-07-01 15:11:12', '2023-07-01 15:11:12'),
(11, 'JUAL20230701171147', 'KF001', 2000000, 1, 2000000, '2023-07-01 15:11:47', '2023-07-01 15:11:47'),
(12, 'JUAL20230701171148', 'KF007', 500000, 1, 500000, '2023-07-01 15:11:47', '2023-07-01 15:11:47'),
(13, 'JUAL20230701171503', 'KF006', 600000, 1, 600000, '2023-07-01 15:15:03', '2023-07-01 15:15:03'),
(14, 'JUAL20230701173141', 'KF001', 2000000, 1, 2000000, '2023-07-01 15:31:41', '2023-07-01 15:31:41'),
(15, 'JUAL20230701174159', 'KF007', 500000, 2, 1000000, '2023-07-01 15:41:59', '2023-07-01 15:41:59'),
(16, 'JUAL20230701175022', 'KF007', 500000, 2, 1000000, '2023-07-01 15:50:22', '2023-07-01 15:50:22'),
(17, 'JUAL20230701175045', 'KF001', 2000000, 3, 6000000, '2023-07-01 15:50:45', '2023-07-01 15:50:45'),
(18, 'JUAL20230701175140', 'KF003', 7000000, 2, 14000000, '2023-07-01 15:51:40', '2023-07-01 15:51:40'),
(19, 'JUAL20230701180223', 'KF003', 7000000, 2, 14000000, '2023-07-01 16:02:23', '2023-07-01 16:02:23'),
(20, 'JUAL20230701180225', 'KF003', 7000000, 2, 14000000, '2023-07-01 16:02:25', '2023-07-01 16:02:25'),
(21, 'JUAL20230701180243', 'KF006', 600000, 1, 600000, '2023-07-01 16:02:43', '2023-07-01 16:02:43'),
(22, 'JUAL20230701180423', 'KF006', 600000, 1, 600000, '2023-07-01 16:04:23', '2023-07-01 16:04:23'),
(23, 'JUAL20230701180424', 'KF004', 2500000, 1, 2500000, '2023-07-01 16:04:23', '2023-07-01 16:04:23');

-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE `jual` (
  `id` int(11) NOT NULL,
  `kode_jual` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_user` varchar(10) NOT NULL,
  `kode_pelanggan` varchar(10) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jual`
--

INSERT INTO `jual` (`id`, `kode_jual`, `tanggal`, `kode_user`, `kode_pelanggan`, `total`) VALUES
(1, 'JUAL000005', '2023-07-01', 'USR004', 'LMR004', 1000000.00);

-- --------------------------------------------------------

--
-- Table structure for table `keranjang`
--

CREATE TABLE `keranjang` (
  `kode_jual` varchar(100) NOT NULL,
  `kode_user` varchar(100) NOT NULL,
  `kode_pelanggan` varchar(100) NOT NULL,
  `kode_barang` varchar(100) NOT NULL,
  `harga` varchar(100) NOT NULL,
  `Jumlah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `keranjang`
--

INSERT INTO `keranjang` (`kode_jual`, `kode_user`, `kode_pelanggan`, `kode_barang`, `harga`, `Jumlah`) VALUES
('JUAL000002', 'USR003', 'LMR002', 'KF003', '7000000', '2'),
('JUAL000003', 'USR003', 'LMR003', 'KF002', '4000000', '1'),
('JUAL000004', 'USR003', 'LMR004', 'KF004', '2500000', '3'),
('JUAL000005', 'USR004', 'LMR002', 'KF006', '600000', '1'),
('JUAL000006', 'USR004', 'LMR006', 'KF004', '2500000', '1');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `kode_pelanggan` varchar(10) NOT NULL,
  `nama_pelanggan` varchar(35) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `email` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`kode_pelanggan`, `nama_pelanggan`, `telepon`, `alamat`, `email`) VALUES
('LMR002', 'Hani Sinta', '081355663378', 'Jakarta Selatan', 'hani.s78@gmail.com'),
('LMR003', 'Miftah', '08978787878', 'Kota Tangerang', 'miftah@gmail.com'),
('LMR004', 'Qorry', '089684724438', 'Kota Bandung', 'qorry180401@gmail,com'),
('LMR005', 'Hudda', '083855446787', 'Kota Yogyakarta', 'hudda18@hotmail.com'),
('LMR006', 'Algi', '085809879099', 'Jakarta Barat', 'algi.a@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `kode_user` varchar(10) NOT NULL,
  `nama_user` varchar(35) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`kode_user`, `nama_user`, `username`, `password`) VALUES
('USR001', 'Qorry Miftah', 'qormif', '$2y$10$2Y0kqNA1QReYFbrcBDwJPeDXyTbK'),
('USR002', 'Rymifda', 'rymifda', '$2y$10$tmpbVpITA4dApKMXQ88.p..WkO4n'),
('USR003', 'Qorry Miftah ', 'miftah', '$2y$10$ert.HBbceVNqEcJOKcf9decM.ZaSAZ.TgF90H8LX7dSSga0igDyvW'),
('USR004', 'Qorry Miftahul Hudda', 'qorry', '$2y$10$j1GbuUihv4bSGclY1IHlLuMGs/xShQHIvrxqp9pg3jGA2amPpR56u');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `detail_jual`
--
ALTER TABLE `detail_jual`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_jual` (`kode_jual`);

--
-- Indexes for table `jual`
--
ALTER TABLE `jual`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_jual` (`kode_jual`);

--
-- Indexes for table `keranjang`
--
ALTER TABLE `keranjang`
  ADD PRIMARY KEY (`kode_jual`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`kode_pelanggan`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`kode_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_jual`
--
ALTER TABLE `detail_jual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `jual`
--
ALTER TABLE `jual`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
