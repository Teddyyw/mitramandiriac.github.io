-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2023 at 11:25 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `servis_ac`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `username` varchar(250) NOT NULL,
  `password` varchar(250) DEFAULT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`username`, `password`, `email`) VALUES
('admin1', 'admin1', 'taufikgoodman@gmail.com'),
('adminyusuf', 'adminyusuf', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `no_telp` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `nama`, `alamat`, `no_telp`) VALUES
(7, 'Teddy', 'Allogio', '981237918237'),
(9, 'Vincent', 'Allogio', '089561604433'),
(10, 'owen', 'allogio', '08929392222');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `phone` varchar(50) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `feedback` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`phone`, `tanggal`, `name`, `feedback`) VALUES
('0847366363', '2023-06-16', 'nico', 'sangat-baik'),
('0895616044335', '2023-06-16', 'Teddy Wijaya', 'sangat-baik'),
('0895616044444', '2023-06-12', 'teddy', 'sangat-baik'),
('0913012931', '2023-06-13', 'oscar', 'sangat-baik'),
('0934734788', '2023-06-12', 'owen', 'cukup'),
('09889798', '2023-06-12', 'vincent', 'sangat-baik');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_bayar`
--

CREATE TABLE `tbl_jenis_bayar` (
  `id` int(11) NOT NULL,
  `jenis_bayar` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_jenis_bayar`
--

INSERT INTO `tbl_jenis_bayar` (`id`, `jenis_bayar`) VALUES
(1, 'Cash'),
(2, 'Transfer');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_layanan`
--

CREATE TABLE `tbl_layanan` (
  `id` int(11) NOT NULL,
  `jenis_layanan` varchar(50) DEFAULT NULL,
  `harga` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_layanan`
--

INSERT INTO `tbl_layanan` (`id`, `jenis_layanan`, `harga`) VALUES
(4, 'Service / Cuci AC', '70000'),
(6, 'Bongkar AC', '150000'),
(7, 'Pasang AC', '300000'),
(8, 'Jasa Penarikan Instalasi Piva (PerMeter)', '20000'),
(9, 'Jasa Pembuatan Jalur Drain + Bahan PerMeter', '100000'),
(10, 'Service Besar', '250000'),
(11, 'Piva 1 Set', '120000'),
(15, 'Bongkar Pasang AC', '400000'),
(17, 'cuci ac 2', '90000'),
(18, 'cuci ac 4', '80000');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pesanan`
--

CREATE TABLE `tbl_pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `tgl_servis` date DEFAULT NULL,
  `jam_servis` time DEFAULT NULL,
  `id_customer` int(11) DEFAULT NULL,
  `id_teknisi` int(11) DEFAULT NULL,
  `id_layanan` int(11) DEFAULT NULL,
  `id_jenis_bayar` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `alamatt` text NOT NULL,
  `terakhirnotice` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_pesanan`
--

INSERT INTO `tbl_pesanan` (`id_pesanan`, `tgl_servis`, `jam_servis`, `id_customer`, `id_teknisi`, `id_layanan`, `id_jenis_bayar`, `harga`, `alamatt`, `terakhirnotice`) VALUES
(45, '2023-05-24', '02:03:00', 9, 5, 11, 1, 120000, '', '2023-07-29'),
(47, '2023-01-08', '00:05:00', 10, 5, 10, 1, 250000, '', '2023-07-29'),
(48, '2023-02-06', '13:12:00', 7, 6, 15, 1, 400000, '', '2023-07-29'),
(49, '2023-02-13', '12:03:00', 9, 5, 4, 1, 70000, '', '2023-07-29'),
(50, '2023-02-06', '12:12:00', 7, 5, 4, 1, 70000, '', '2023-07-29'),
(51, '2023-02-05', '12:23:00', 9, 6, 15, 1, 400000, '', 'Belum'),
(52, '2023-02-15', '00:08:00', 9, 5, 15, 2, 400000, '', 'Belum'),
(53, '2023-03-15', '12:31:00', 7, 5, 15, 1, 400000, '', 'Belum'),
(54, '2023-03-27', '12:12:00', 9, 6, 15, 1, 400000, '', 'Belum'),
(55, '2023-06-14', '12:31:00', 7, 5, 15, 2, 400000, '', 'Belum'),
(56, '2023-06-06', '00:10:00', 9, 5, 15, 1, 400000, '', 'Belum'),
(57, '2023-03-22', '12:03:00', 7, 6, 15, 1, 400000, '', 'Belum'),
(58, '2023-03-30', '03:06:00', 9, 6, 15, 1, 400000, '', 'Belum'),
(59, '2023-03-29', '12:23:00', 9, 6, 15, 2, 400000, '', 'Belum'),
(60, '2023-03-28', '12:31:00', 9, 6, 4, 1, 70000, '', 'Belum'),
(61, '2023-03-19', '21:03:00', 9, 6, 4, 1, 70000, '', 'Belum'),
(62, '2023-04-11', '12:12:00', 9, 6, 6, 1, 150000, '', 'Belum'),
(63, '2023-04-20', '12:31:00', 9, 5, 4, 1, 70000, '', 'Belum'),
(64, '2023-04-25', '12:03:00', 9, 5, 7, 1, 300000, '', 'Belum'),
(65, '2023-04-11', '12:13:00', 10, 6, 6, 1, 150000, '', 'Belum'),
(66, '2023-04-12', '12:13:00', 9, 6, 7, 2, 300000, '', '2023-07-29'),
(67, '2023-04-24', '21:23:00', 9, 6, 7, 2, 300000, '', 'Belum'),
(68, '2023-04-18', '12:31:00', 9, 6, 7, 2, 300000, '', 'Belum'),
(69, '2023-04-18', '12:12:00', 10, 6, 4, 1, 70000, '', 'Belum'),
(70, '2023-04-18', '12:03:00', 9, 6, 15, 2, 400000, '', 'Belum'),
(71, '2023-04-18', '12:31:00', 9, 6, 15, 2, 400000, '', 'Belum'),
(72, '2023-06-13', '12:03:00', 9, 6, 6, 1, 150000, '', 'Belum'),
(73, '2023-06-07', '03:13:00', 10, 6, 6, 1, 150000, '', 'Belum'),
(74, '2023-06-13', '12:31:00', 9, 6, 4, 2, 70000, '', 'Belum'),
(75, '2023-06-22', '12:12:00', 9, 6, 15, 1, 400000, '', '2023-07-29'),
(76, '2023-06-20', '12:03:00', 9, 6, 15, 1, 400000, '', 'Belum'),
(77, '2023-06-21', '12:03:00', 10, 6, 4, 1, 70000, '', 'Belum'),
(78, '2023-06-12', '12:03:00', 9, 6, 4, 1, 70000, '', 'Belum'),
(79, '2023-06-21', '12:12:00', 9, 6, 4, 1, 70000, '', 'Belum'),
(80, '2023-06-19', '12:23:00', 9, 5, 4, 1, 70000, '', 'Belum'),
(81, '2023-06-13', '12:23:00', 9, 6, 4, 1, 70000, '', 'Belum'),
(82, '2023-06-06', '12:31:00', 10, 5, 15, 1, 400000, '', 'Belum'),
(83, '2023-06-15', '00:16:00', 7, 6, 7, 1, 300000, '', 'Belum'),
(84, '2023-06-13', '12:03:00', 9, 6, 7, 1, 300000, '', 'Belum'),
(85, '2023-06-20', '12:03:00', 9, 6, 7, 2, 300000, '', 'Belum'),
(86, '2022-02-16', '21:21:00', 10, 6, 6, 1, 150000, '', 'Belum'),
(87, '2023-06-15', '11:00:00', 7, 6, 15, 1, 400000, '', 'Belum'),
(88, '2023-07-29', '12:33:00', 7, 5, 4, 1, 70000, '', '2023-07-29'),
(89, '2023-07-29', '12:00:00', 10, 5, 7, 2, 300000, '', '2023-07-29'),
(90, '2023-07-30', '13:00:00', 7, 5, 11, 1, 120000, '', 'Belum'),
(91, '2023-07-29', '13:00:00', 7, 6, 8, 1, 20000, '', '2023-08-04'),
(92, '2023-08-04', '02:34:00', 10, 6, 8, 2, 20000, 'Jl Sudirman', 'Belum'),
(93, '2023-08-04', '13:42:00', 9, 6, 4, 1, 70000, 'Jalan Sumpah', 'Belum'),
(94, '2023-08-05', '13:49:00', 7, 5, 9, 1, 100000, 'Jalan Mandi Api', 'Belum');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teknisi`
--

CREATE TABLE `tbl_teknisi` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `no_telp` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_teknisi`
--

INSERT INTO `tbl_teknisi` (`id`, `nama`, `no_telp`) VALUES
(5, 'Agus', '097461241724'),
(6, 'Owen', '089561604433');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`phone`);

--
-- Indexes for table `tbl_jenis_bayar`
--
ALTER TABLE `tbl_jenis_bayar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_layanan`
--
ALTER TABLE `tbl_layanan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_jenis_bayar` (`id_jenis_bayar`),
  ADD KEY `id_teknisi` (`id_teknisi`),
  ADD KEY `id_customer` (`id_customer`),
  ADD KEY `id_layanan` (`id_layanan`);

--
-- Indexes for table `tbl_teknisi`
--
ALTER TABLE `tbl_teknisi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_jenis_bayar`
--
ALTER TABLE `tbl_jenis_bayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_layanan`
--
ALTER TABLE `tbl_layanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `tbl_teknisi`
--
ALTER TABLE `tbl_teknisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_pesanan`
--
ALTER TABLE `tbl_pesanan`
  ADD CONSTRAINT `tbl_pesanan_ibfk_2` FOREIGN KEY (`id_jenis_bayar`) REFERENCES `tbl_jenis_bayar` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pesanan_ibfk_5` FOREIGN KEY (`id_teknisi`) REFERENCES `tbl_teknisi` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pesanan_ibfk_6` FOREIGN KEY (`id_customer`) REFERENCES `tbl_customer` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_pesanan_ibfk_7` FOREIGN KEY (`id_layanan`) REFERENCES `tbl_layanan` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
