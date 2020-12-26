-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11 Apr 2019 pada 14.02
-- Versi Server: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Struktur dari tabel `asal_transaksi`
--

CREATE TABLE `asal_transaksi` (
  `at_id` int(11) NOT NULL,
  `at_nama` varchar(50) DEFAULT NULL,
  `at_tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
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
-- Struktur dari tabel `barang_non_reseller`
--

CREATE TABLE `barang_non_reseller` (
  `bnr_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `bnr_harga` varchar(50) NOT NULL,
  `bnr_tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang_reseller`
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
-- Struktur dari tabel `history_stock_barang`
--

CREATE TABLE `history_stock_barang` (
  `hsb_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `stock_berkurang` int(50) NOT NULL,
  `hsb_tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kurir`
--

CREATE TABLE `kurir` (
  `kurir_id` int(11) NOT NULL,
  `kurir_nama` varchar(50) DEFAULT NULL,
  `kurir_tanggal` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `list_barang_pemesanan`
--

CREATE TABLE `list_barang_pemesanan` (
  `lbp_id` int(11) NOT NULL,
  `pemesanan_id` int(11) DEFAULT NULL,
  `barang_id` int(11) NOT NULL,
  `lbp_jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `pemesanan_id` int(11) NOT NULL,
  `pemesanan_nama` varchar(50) DEFAULT NULL,
  `pemesanan_tanggal` date NOT NULL,
  `pemesanan_hp` varchar(25) DEFAULT NULL,
  `pemesanan_alamat` text,
  `kurir_id` int(11) DEFAULT NULL,
  `at_id` int(11) DEFAULT NULL,
  `lbp_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
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
  ADD PRIMARY KEY (`hsb_id`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`kurir_id`);

--
-- Indexes for table `list_barang_pemesanan`
--
ALTER TABLE `list_barang_pemesanan`
  ADD PRIMARY KEY (`lbp_id`),
  ADD KEY `pemesanan_id` (`pemesanan_id`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`pemesanan_id`),
  ADD KEY `kurir_id` (`kurir_id`),
  ADD KEY `at_id` (`at_id`),
  ADD KEY `lbp_id` (`lbp_id`);

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
  MODIFY `bnr_id` int(11) NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `list_barang_pemesanan`
--
ALTER TABLE `list_barang_pemesanan`
  MODIFY `lbp_id` int(11) NOT NULL AUTO_INCREMENT;

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
