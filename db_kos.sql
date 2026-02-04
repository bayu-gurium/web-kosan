-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 24, 2024 at 03:18 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kos`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_fasilitas`
--

CREATE TABLE `tabel_fasilitas` (
  `id_fasilitas` int(11) NOT NULL,
  `nama_fasilitas` varchar(100) NOT NULL,
  `gambar_fasilitas` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tabel_kamar`
--

CREATE TABLE `tabel_kamar` (
  `id_kamar` int(11) NOT NULL,
  `nama_kamar` varchar(50) NOT NULL,
  `ukuran_kamar` varchar(50) NOT NULL,
  `kapasitas` varchar(50) NOT NULL,
  `harga_per_bulan` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `foto_kamar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_kamar`
--

INSERT INTO `tabel_kamar` (`id_kamar`, `nama_kamar`, `ukuran_kamar`, `kapasitas`, `harga_per_bulan`, `status`, `foto_kamar`) VALUES
(36, 'Kamar 01', '3 x 2.5m', '2 Orang', 550000.00, 'Sudah Terisi', '66ee34ff41e19.jpg'),
(37, 'Kamar 02', '3 x 2.5m', '2 Orang', 550000.00, 'Tersedia', '66ee351ccc6a9.jpg'),
(38, 'Kamar 03', '3 x 2.5m', '2 Orang', 550000.00, 'Tersedia', '66ee352e8ebbd.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tabel_penghuni`
--

CREATE TABLE `tabel_penghuni` (
  `id_penghuni` int(11) NOT NULL,
  `nama_penghuni` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_tlp` varchar(20) NOT NULL,
  `tgl_registrasi` date NOT NULL,
  `id_kamar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_penghuni`
--

INSERT INTO `tabel_penghuni` (`id_penghuni`, `nama_penghuni`, `alamat`, `no_tlp`, `tgl_registrasi`, `id_kamar`) VALUES
(22, 'Bayu', 'Gorom', '+6285142959238', '2024-09-21', 36);

-- --------------------------------------------------------

--
-- Table structure for table `tabel_user`
--

CREATE TABLE `tabel_user` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tabel_user`
--

INSERT INTO `tabel_user` (`id_user`, `nama_user`, `username`, `password`) VALUES
(1, 'Esau Faumasa', 'cafa', '$2y$10$jIe.BUxuPG7KmHYZWDHRROPSdcFpaS1zFuJ5l7gZgA10ZpUdFp2Ju');

-- --------------------------------------------------------

--
-- Table structure for table `tagihan_kos`
--

CREATE TABLE `tagihan_kos` (
  `id_tagihan` int(11) NOT NULL,
  `id_penghuni` int(11) DEFAULT NULL,
  `jumlah_tagihan` decimal(10,2) DEFAULT NULL,
  `tanggal_pembayaran` date DEFAULT NULL,
  `status_pembayaran` enum('Belum Dibayar','Sudah Dibayar') DEFAULT 'Belum Dibayar',
  `tanggal_dibayar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tagihan_kos`
--

INSERT INTO `tagihan_kos` (`id_tagihan`, `id_penghuni`, `jumlah_tagihan`, `tanggal_pembayaran`, `status_pembayaran`, `tanggal_dibayar`) VALUES
(29, 22, 550000.00, '2024-09-23', 'Belum Dibayar', '2024-09-25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_fasilitas`
--
ALTER TABLE `tabel_fasilitas`
  ADD PRIMARY KEY (`id_fasilitas`);

--
-- Indexes for table `tabel_kamar`
--
ALTER TABLE `tabel_kamar`
  ADD PRIMARY KEY (`id_kamar`);

--
-- Indexes for table `tabel_penghuni`
--
ALTER TABLE `tabel_penghuni`
  ADD PRIMARY KEY (`id_penghuni`);

--
-- Indexes for table `tabel_user`
--
ALTER TABLE `tabel_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `tagihan_kos`
--
ALTER TABLE `tagihan_kos`
  ADD PRIMARY KEY (`id_tagihan`),
  ADD KEY `id_penghuni` (`id_penghuni`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_fasilitas`
--
ALTER TABLE `tabel_fasilitas`
  MODIFY `id_fasilitas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tabel_kamar`
--
ALTER TABLE `tabel_kamar`
  MODIFY `id_kamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tabel_penghuni`
--
ALTER TABLE `tabel_penghuni`
  MODIFY `id_penghuni` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tabel_user`
--
ALTER TABLE `tabel_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tagihan_kos`
--
ALTER TABLE `tagihan_kos`
  MODIFY `id_tagihan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tagihan_kos`
--
ALTER TABLE `tagihan_kos`
  ADD CONSTRAINT `tagihan_kos_ibfk_1` FOREIGN KEY (`id_penghuni`) REFERENCES `tabel_penghuni` (`id_penghuni`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
