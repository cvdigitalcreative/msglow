-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2019 at 06:56 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sistemposamel`
--
CREATE DATABASE IF NOT EXISTS `sistemposamel` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sistemposamel`;

-- --------------------------------------------------------

--
-- Table structure for table `asal_transaksi`
--

CREATE TABLE `asal_transaksi` (
  `at_id` int(11) NOT NULL,
  `at_nama` varchar(50) DEFAULT NULL,
  `at_tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `barang_id` int(11) NOT NULL,
  `barang_nama` varchar(50) DEFAULT NULL,
  `barang_stock_awal` int(20) NOT NULL,
  `barang_stock_akhir` int(20) NOT NULL,
  `barang_harga_modal` varchar(50) NOT NULL,
  `barang_foto` varchar(50) DEFAULT NULL,
  `barang_tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `barang_non_reseller`
--

CREATE TABLE `barang_non_reseller` (
  `bnr_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `bnr_harga` varchar(50) NOT NULL,
  `bnr_tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_non_reseller`
--

INSERT INTO `barang_non_reseller` (`bnr_id`, `barang_id`, `bnr_harga`, `bnr_tanggal`) VALUES
(1, 1, '100.000', '2019-04-04 02:45:11'),
(2, 1, '200.000', '2019-04-04 02:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `barang_reseller`
--

CREATE TABLE `barang_reseller` (
  `br_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `br_kuantitas` int(50) NOT NULL,
  `br_harga` varchar(50) NOT NULL,
  `br_tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history_stock_barang`
--

CREATE TABLE `history_stock_barang` (
  `hsb_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `stock_berkurang` int(50) NOT NULL,
  `hsb_tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `kurir_id` int(11) NOT NULL,
  `kurir_nama` varchar(50) DEFAULT NULL,
  `kurir_tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `pemesanan_id` int(11) NOT NULL,
  `pemesanan_nama` varchar(50) DEFAULT NULL,
  `pemesanan_tanggal` date NOT NULL,
  `pemesanan_hp` varchar(25) DEFAULT NULL,
  `pemesanan_alamat` text,
  `kurir_id` int(11) DEFAULT NULL,
  `at_id` int(11) DEFAULT NULL,
  `lb_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(50) DEFAULT NULL,
  `user_hp` varchar(20) DEFAULT NULL,
  `user_alamat` text,
  `user_foto` varchar(50) DEFAULT NULL,
  `user_level` int(2) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_hp`, `user_alamat`, `user_foto`, `user_level`, `username`, `password`) VALUES
(1, 'Owner', '081255555555', 'Jl.Tnabun', 'a.jpg', 1, 'owner', '123456'),
(2, 'Admin', '08666666666', 'Jl.Kucung', 'a.jpg', 2, 'admin', '123456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `asal_transaksi`
--
ALTER TABLE `asal_transaksi`
  ADD PRIMARY KEY (`at_id`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indexes for table `barang_non_reseller`
--
ALTER TABLE `barang_non_reseller`
  ADD PRIMARY KEY (`bnr_id`);

--
-- Indexes for table `barang_reseller`
--
ALTER TABLE `barang_reseller`
  ADD PRIMARY KEY (`br_id`);

--
-- Indexes for table `history_stock_barang`
--
ALTER TABLE `history_stock_barang`
  ADD PRIMARY KEY (`hsb_id`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`kurir_id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`pemesanan_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asal_transaksi`
--
ALTER TABLE `asal_transaksi`
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `barang_non_reseller`
--
ALTER TABLE `barang_non_reseller`
  MODIFY `bnr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `barang_reseller`
--
ALTER TABLE `barang_reseller`
  MODIFY `br_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `history_stock_barang`
--
ALTER TABLE `history_stock_barang`
  MODIFY `hsb_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `kurir_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `pemesanan_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
