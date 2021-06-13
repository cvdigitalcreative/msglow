-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 13, 2021 at 11:27 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `disa3435_posamel`
--
CREATE DATABASE IF NOT EXISTS `disa3435_posamel` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `disa3435_posamel`;

-- --------------------------------------------------------

--
-- Table structure for table `asal_transaksi`
--

CREATE TABLE `asal_transaksi` (
  `at_id` int(11) NOT NULL,
  `at_nama` varchar(50) DEFAULT NULL,
  `at_tanggal` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `asal_transaksi`
--

INSERT INTO `asal_transaksi` (`at_id`, `at_nama`, `at_tanggal`) VALUES
(3, 'WhatsApp', '2019-05-01 08:59:03'),
(4, 'Line', '2019-05-01 08:59:20'),
(5, 'SHOPEE', '2019-05-01 08:59:35'),
(6, 'COD', '2019-05-01 08:59:43'),
(7, 'Bukalapak', '2019-05-01 09:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `barang_id` varchar(250) NOT NULL,
  `barang_nama` varchar(50) DEFAULT NULL,
  `barang_stock_awal` int(20) NOT NULL,
  `barang_stock_akhir` int(20) NOT NULL,
  `barang_harga_modal` varchar(50) NOT NULL,
  `barang_foto` varchar(50) DEFAULT NULL,
  `barang_level` int(2) NOT NULL,
  `barang_tanggal` timestamp NULL DEFAULT current_timestamp(),
  `id_kategori` int(11) NOT NULL DEFAULT 0,
  `id_toko` int(11) NOT NULL DEFAULT 1,
  `waktu_berubah` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `suplier` varchar(250) NOT NULL DEFAULT '"-"'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `barang_non_reseller`
--

CREATE TABLE `barang_non_reseller` (
  `bnr_id` int(250) NOT NULL,
  `barang_id` varchar(250) NOT NULL,
  `bnr_harga` varchar(50) NOT NULL,
  `bnr_tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `barang_reseller`
--

CREATE TABLE `barang_reseller` (
  `br_id` int(11) NOT NULL,
  `barang_id` varchar(250) NOT NULL,
  `br_kuantitas` int(50) NOT NULL,
  `br_harga` varchar(50) NOT NULL,
  `br_tanggal` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_pemesanan` varchar(250) NOT NULL,
  `total_omset` int(11) NOT NULL,
  `total_modal` int(11) NOT NULL DEFAULT 0,
  `total_untung` int(11) NOT NULL,
  `list_barang` text NOT NULL,
  `diskon_pesanan` int(11) NOT NULL,
  `diskon_barang` int(11) NOT NULL,
  `total_ongkir` int(11) DEFAULT NULL,
  `uang_diberikan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `diskon_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `potongan_harga` varchar(50) NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diskon`
--

INSERT INTO `diskon` (`diskon_id`, `barang_id`, `potongan_harga`, `tanggal_mulai`, `tanggal_berakhir`) VALUES
(1, 38, '20000', '2019-12-12', '2019-12-12'),
(2, 37, '20000', '2019-12-12', '2019-12-12'),
(3, 32, '36000', '2019-12-12', '2019-12-12'),
(4, 31, '24000', '2019-12-12', '2019-12-12'),
(5, 24, '34000', '2019-12-12', '2019-12-12'),
(6, 26, '34000', '2019-12-12', '2019-12-12'),
(7, 25, '34000', '2019-12-12', '2019-12-12'),
(8, 23, '34000', '2019-12-12', '2019-12-12'),
(9, 28, '37000', '2019-12-12', '2019-12-12'),
(10, 30, '37000', '2019-12-12', '2019-12-12'),
(11, 29, '37000', '2019-12-12', '2019-12-12'),
(12, 27, '37000', '2019-12-12', '2019-12-12'),
(13, 37, '20200', '2019-12-28', '2019-12-31'),
(14, 38, '20200', '2019-12-28', '2019-12-31'),
(15, 31, '20200', '2019-12-28', '2019-12-31'),
(16, 23, '20200', '2019-12-29', '2019-12-31'),
(17, 24, '20200', '2019-12-28', '2019-12-31'),
(18, 25, '20200', '2019-12-28', '2019-12-31'),
(19, 25, '20200', '2019-12-28', '2019-12-31'),
(20, 26, '20200', '2019-12-28', '2019-12-31'),
(21, 27, '20200', '2019-12-28', '2019-12-31'),
(22, 28, '20200', '2019-12-28', '2019-12-31'),
(23, 29, '20200', '2019-12-28', '2019-12-31'),
(24, 30, '20200', '2019-12-28', '2019-12-31'),
(25, 69, '20200', '2019-12-28', '2019-12-31'),
(26, 73, '22000', '2020-02-14', '2020-02-17'),
(27, 74, '22000', '2020-02-14', '2020-02-17'),
(28, 32, '25000', '2020-04-19', '2020-04-24'),
(29, 32, '25000', '2020-04-19', '2020-04-24'),
(30, 34, '25000', '2020-05-10', '2020-05-12'),
(31, 74, '30000', '2020-06-09', '2020-06-14'),
(32, 73, '30000', '2020-06-09', '2020-06-14'),
(33, 72, '30000', '2020-06-09', '2020-06-14'),
(34, 36, '12500', '2020-06-16', '2020-06-21'),
(36, 51, '15000', '2020-07-15', '2020-07-31'),
(37, 52, '15000', '2020-07-15', '2020-07-31'),
(38, 53, '15000', '2020-07-15', '2020-07-31'),
(39, 54, '15000', '2020-07-15', '2020-07-31'),
(40, 55, '15000', '2020-07-15', '2020-07-31'),
(41, 56, '15000', '2020-07-15', '2020-07-31'),
(42, 36, '25000', '2020-06-26', '2020-06-27'),
(43, 84, '17000', '2020-08-17', '2020-08-31'),
(44, 82, '17000', '2020-08-17', '2020-08-31'),
(45, 83, '17000', '2020-08-17', '2020-08-31'),
(46, 74, '17000', '2020-08-17', '2020-08-31'),
(47, 73, '17000', '2020-08-17', '2020-08-31'),
(48, 72, '17000', '2020-08-17', '2020-08-31'),
(49, 40, '17000', '2020-08-17', '2020-08-31'),
(50, 41, '17000', '2020-08-17', '2020-08-31'),
(51, 31, '34000', '2020-08-21', '2020-08-31'),
(52, 33, '30000', '2020-10-10', '2020-10-10'),
(53, 36, '12500', '2020-10-10', '2020-10-10'),
(54, 89, '9000', '2020-10-10', '2020-10-10'),
(55, 90, '9000', '2020-10-10', '2020-10-10'),
(56, 91, '9000', '2020-10-10', '2020-10-10'),
(57, 92, '9000', '2020-10-10', '2020-10-10'),
(58, 93, '9000', '2020-10-10', '2020-10-10'),
(59, 94, '9000', '2020-10-10', '2020-10-10'),
(60, 42, '10000', '2020-10-10', '2020-10-10'),
(61, 44, '10000', '2020-10-10', '2020-10-10'),
(62, 43, '10000', '2020-10-10', '2020-10-10'),
(63, 74, '12000', '2020-10-10', '2020-10-10'),
(64, 73, '12000', '2020-10-10', '2020-10-10'),
(65, 72, '12000', '2020-10-10', '2020-10-10'),
(66, 40, '20000', '2020-10-10', '2020-10-10'),
(67, 41, '20000', '2020-10-10', '2020-10-10'),
(68, 84, '15000', '2020-10-10', '2020-10-10'),
(69, 82, '15000', '2020-10-10', '2020-10-10'),
(70, 83, '15000', '2020-10-10', '2020-10-10'),
(71, 48, '10000', '2020-10-10', '2020-10-10'),
(72, 34, '25000', '2020-11-11', '2020-11-13'),
(73, 40, '11000', '2020-11-11', '2020-11-13'),
(74, 41, '11000', '2020-11-11', '2020-11-13'),
(75, 84, '11000', '2020-11-11', '2020-11-13'),
(76, 82, '11000', '2020-11-11', '2020-11-13'),
(77, 83, '11000', '2020-11-11', '2020-11-13'),
(78, 89, '11000', '2020-11-11', '2020-11-13'),
(79, 90, '11000', '2020-11-11', '2020-11-13'),
(80, 91, '11000', '2020-11-11', '2020-11-13'),
(81, 92, '11000', '2020-11-11', '2020-11-13'),
(82, 93, '11000', '2020-11-11', '2020-11-13'),
(83, 94, '11000', '2020-11-11', '2020-11-13'),
(84, 100, '11000', '2020-11-11', '2020-11-13');

-- --------------------------------------------------------

--
-- Table structure for table `diskon_all`
--

CREATE TABLE `diskon_all` (
  `id` int(11) NOT NULL,
  `nama_diskon` varchar(250) NOT NULL,
  `potongan_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history_stock_barang`
--

CREATE TABLE `history_stock_barang` (
  `hsb_id` int(11) NOT NULL,
  `pemesanan_id` int(11) NOT NULL,
  `barang_id` varchar(250) NOT NULL,
  `stock_berkurang` int(50) NOT NULL,
  `lvl` int(11) NOT NULL DEFAULT 2,
  `hsb_tanggal` timestamp NULL DEFAULT current_timestamp(),
  `id_toko` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history_stock_masuk`
--

CREATE TABLE `history_stock_masuk` (
  `id_stock` int(11) NOT NULL,
  `barang_id` varchar(250) NOT NULL,
  `stock` int(50) NOT NULL,
  `pemesanan` datetime NOT NULL DEFAULT current_timestamp(),
  `id_toko` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history_stok_barang_keluar`
--

CREATE TABLE `history_stok_barang_keluar` (
  `id` int(11) NOT NULL,
  `barang_id` varchar(250) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `stok_keluar` int(11) NOT NULL,
  `barang_stock_keluar` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history_stok_barang_kembali`
--

CREATE TABLE `history_stok_barang_kembali` (
  `id` int(11) NOT NULL,
  `barang_id` varchar(250) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `stok_keluar` int(11) NOT NULL,
  `barang_stock_keluar` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history_stok_barang_masuk`
--

CREATE TABLE `history_stok_barang_masuk` (
  `id` int(20) NOT NULL,
  `barang_id` varchar(250) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `stok_keluar` int(11) NOT NULL,
  `barang_stock_keluar` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history_stok_paket`
--

CREATE TABLE `history_stok_paket` (
  `barang_id` varchar(25) NOT NULL,
  `id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `id_toko` varchar(25) NOT NULL,
  `stok_keluar` int(11) NOT NULL,
  `pemesanan` datetime NOT NULL DEFAULT current_timestamp(),
  `barang_stock_keluar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_customer`
--

CREATE TABLE `jenis_customer` (
  `id` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_customer`
--

INSERT INTO `jenis_customer` (`id`, `nama`) VALUES
(1, 'reseller'),
(2, 'customer biasa');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Paket Wajah Women'),
(2, 'Rad and Red'),
(4, 'Cushion'),
(5, 'Losse Powder'),
(6, 'Blam Juice'),
(7, 'Glam Matte'),
(8, 'Toner Bumil'),
(9, 'Cream Wajah'),
(10, 'Cream Klinik'),
(11, 'Face Women Retail'),
(12, 'Night'),
(13, 'Serum Gold'),
(14, 'Juice'),
(16, 'Paket Body'),
(17, 'Drink'),
(18, 'JJ Glow'),
(19, 'Serum Acne'),
(20, 'Underarm'),
(21, 'acne spot'),
(22, 'FACIAL WASH WOMEN ECER'),
(23, 'Serum Biasa'),
(24, 'Paket Wajah Men'),
(25, 'Serum MEN'),
(26, 'FACIAL WASH MEN ECER'),
(27, 'Face Men ECER'),
(28, 'EYE SERUM'),
(29, 'Masker'),
(30, 'DARK & PORE'),
(31, 'DEEP'),
(32, 'Sexy glammate'),
(33, 'FACE PEEL SCRUB'),
(34, 'MASKULIN'),
(35, 'MS SLIM (OIL & CAPSUL)'),
(36, 'Paket Ms kids'),
(37, 'Ecer Ms Kids');

-- --------------------------------------------------------

--
-- Table structure for table `kurir`
--

CREATE TABLE `kurir` (
  `kurir_id` int(11) NOT NULL,
  `kurir_nama` varchar(50) DEFAULT NULL,
  `kurir_tanggal` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kurir`
--

INSERT INTO `kurir` (`kurir_id`, `kurir_nama`, `kurir_tanggal`) VALUES
(1, 'JNE', '2019-04-19 15:50:14'),
(2, 'J & T', '2019-04-19 15:50:23'),
(4, 'Grab MANUAL', '2019-04-19 15:50:40'),
(5, 'Gojek MANUAL', '2019-05-01 09:05:31'),
(6, 'COD', '2019-05-03 05:14:35'),
(7, '.', '2019-05-03 05:14:49'),
(8, 'Mobil travel', '2019-05-03 05:15:09'),
(9, 'GOJEK MSGLOW', '2019-05-14 01:59:00'),
(10, '.', '2019-06-21 00:34:22'),
(11, 'GOJEK/GRAB SHOPEE', '2019-09-03 02:04:10'),
(12, '.', '2020-05-21 04:06:00'),
(13, 'ANTER AJA', '2020-05-21 04:07:45'),
(14, 'SI CEPAT', '2020-05-21 04:09:18'),
(15, 'ID Express', '2020-07-27 03:17:17'),
(16, 'TAM CHARGO', '2020-09-10 04:41:37'),
(17, 'TOKOTALK', '2021-02-08 07:08:30'),
(18, 'KURIR HELLO', '2021-04-09 04:14:11');

-- --------------------------------------------------------

--
-- Table structure for table `list_barang`
--

CREATE TABLE `list_barang` (
  `lb_id` int(11) NOT NULL,
  `pemesanan_id` varchar(250) NOT NULL,
  `lb_qty` int(20) NOT NULL,
  `ktg_qty` int(11) NOT NULL DEFAULT 0,
  `barang_id` varchar(250) DEFAULT NULL,
  `lb_lvl` int(11) NOT NULL,
  `lb_tanggal` timestamp NULL DEFAULT current_timestamp(),
  `id_toko` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `metode_pembayaran`
--

CREATE TABLE `metode_pembayaran` (
  `mp_id` int(11) NOT NULL,
  `mp_nama` varchar(50) DEFAULT NULL,
  `mp_tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `metode_pembayaran`
--

INSERT INTO `metode_pembayaran` (`mp_id`, `mp_nama`, `mp_tanggal`) VALUES
(1, 'Cash', '2019-05-12 14:10:06'),
(5, 'BANK', '2019-05-13 06:17:15'),
(7, 'EDC BCA', '2020-04-20 06:49:29'),
(10, 'SHOPEE', '2020-05-08 01:29:55');

-- --------------------------------------------------------

--
-- Table structure for table `paket_belong_to`
--

CREATE TABLE `paket_belong_to` (
  `id` int(11) NOT NULL,
  `id_paket` varchar(250) NOT NULL,
  `nama_paket` varchar(250) NOT NULL,
  `id_barang` varchar(250) NOT NULL,
  `nama_barang` varchar(250) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `nomor_telpon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `nama`, `nomor_telpon`) VALUES
(1, 'Ade', NULL),
(3, 'Cici', NULL),
(4, 'Aisya', NULL),
(5, 'Kiki', NULL),
(6, 'Nisa', NULL),
(7, 'Jeny', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `pemesanan_id` varchar(250) NOT NULL,
  `pemesanan_nama` varchar(50) DEFAULT NULL,
  `pemesanan_tanggal` date NOT NULL,
  `pemesanan_hp` varchar(25) DEFAULT NULL,
  `pemesanan_alamat` text DEFAULT NULL,
  `level` int(11) NOT NULL,
  `kurir_id` int(11) DEFAULT NULL,
  `at_id` int(11) DEFAULT NULL,
  `mp_id` int(11) NOT NULL,
  `id_diskon` int(11) NOT NULL DEFAULT 1,
  `uid` int(11) NOT NULL DEFAULT 5,
  `id_pegawai` int(11) NOT NULL DEFAULT 1,
  `id_toko` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request_stok_barang`
--

CREATE TABLE `request_stok_barang` (
  `id_request` int(11) NOT NULL,
  `nama_barang` varchar(250) NOT NULL,
  `id_toko_dari` int(11) NOT NULL,
  `nama_toko_dari` varchar(250) NOT NULL,
  `id_toko_ke` int(11) NOT NULL,
  `nama_toko_ke` varchar(250) NOT NULL,
  `tanggal_request` datetime NOT NULL DEFAULT current_timestamp(),
  `id_admin` int(11) NOT NULL,
  `tanggal_acc` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `jumlah` int(11) NOT NULL,
  `suplier` varchar(250) NOT NULL DEFAULT '"-"'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `toko`
--

CREATE TABLE `toko` (
  `id_toko` int(11) NOT NULL,
  `nama` varchar(250) NOT NULL,
  `alamat` text DEFAULT NULL,
  `nomor_telpon` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `toko`
--

INSERT INTO `toko` (`id_toko`, `nama`, `alamat`, `nomor_telpon`) VALUES
(1, 'Gudang Utama', NULL, NULL),
(3, 'Gudang Pakjo', NULL, NULL),
(4, 'Arisma', NULL, NULL),
(5, 'Toko Baru', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(50) DEFAULT NULL,
  `user_hp` varchar(20) DEFAULT NULL,
  `user_alamat` text DEFAULT NULL,
  `user_foto` varchar(50) DEFAULT NULL,
  `user_level` int(2) NOT NULL,
  `user_toko` int(11) NOT NULL DEFAULT 1,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_hp`, `user_alamat`, `user_foto`, `user_level`, `user_toko`, `username`, `password`) VALUES
(5, 'Amelia Putri', '082285946767', 'Komplek Horizon Estate Blok C no.4 palembang', 'C360_2015-07-11-14-27-56-274.jpg', 1, 1, 'sabiansabia', '757575'),
(6, 'Citra', '083185985031', 'palimo', 'red_jellyy.jpeg', 3, 1, 'citra', '123456'),
(7, 'Leo', '08972473998', 'Palembang', '72.png', 5, 1, 'leo', '123456'),
(8, 'Pakjo', '082211336300', 'Naskah', '5.png', 4, 3, 'pakjo', '123456'),
(9, 'Arisan', '081273666752', 'PAKJO', '57.png', 4, 4, 'arisan', '123456'),
(10, 'Baru', '081273434989', 'LINGGAU', '45.png', 4, 5, 'baru', '123456'),
(11, 'Utama', '082211446300', 'Angkatan 66', 'E510140D-303A-4EC8-A4AB-5F2AFC3BC1FC.jpeg', 4, 1, 'utama', '123456'),
(16, 'Ayu', '082211155080', 'Jahe', '548F5047-F750-42E4-9416-4284DD11C8E7.jpeg', 2, 3, 'ayu', '123456'),
(17, 'Ade', '082211155040', 'Palembang', '31A26F70-C6AA-4AAA-B545-B0C116CBFC1A.jpeg', 2, 3, 'ade', '123456'),
(18, 'Jenny', '082211579922', 'Palembang', '320AC1C6-F110-4AB4-BEB7-9C84BC4F2842.jpeg', 2, 4, 'jenny', '123456'),
(20, 'utm', '082211579922', 'Palembang', '320AC1C6-F110-4AB4-BEB7-9C84BC4F2842.jpeg', 2, 1, 'utm', '123456'),
(21, 'leo', '082211579922', 'Palembang', '320AC1C6-F110-4AB4-BEB7-9C84BC4F2842.jpeg', 5, 1, 'leo', '123456');

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
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`diskon_id`);

--
-- Indexes for table `diskon_all`
--
ALTER TABLE `diskon_all`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_stock_barang`
--
ALTER TABLE `history_stock_barang`
  ADD PRIMARY KEY (`hsb_id`);

--
-- Indexes for table `history_stock_masuk`
--
ALTER TABLE `history_stock_masuk`
  ADD PRIMARY KEY (`id_stock`);

--
-- Indexes for table `history_stok_barang_keluar`
--
ALTER TABLE `history_stok_barang_keluar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_stok_barang_kembali`
--
ALTER TABLE `history_stok_barang_kembali`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_stok_barang_masuk`
--
ALTER TABLE `history_stok_barang_masuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `history_stok_paket`
--
ALTER TABLE `history_stok_paket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jenis_customer`
--
ALTER TABLE `jenis_customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kurir`
--
ALTER TABLE `kurir`
  ADD PRIMARY KEY (`kurir_id`);

--
-- Indexes for table `list_barang`
--
ALTER TABLE `list_barang`
  ADD PRIMARY KEY (`lb_id`);

--
-- Indexes for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  ADD PRIMARY KEY (`mp_id`);

--
-- Indexes for table `paket_belong_to`
--
ALTER TABLE `paket_belong_to`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`pemesanan_id`),
  ADD KEY `indexing all` (`level`,`kurir_id`,`at_id`,`mp_id`,`id_diskon`,`uid`);

--
-- Indexes for table `request_stok_barang`
--
ALTER TABLE `request_stok_barang`
  ADD PRIMARY KEY (`id_request`);

--
-- Indexes for table `toko`
--
ALTER TABLE `toko`
  ADD PRIMARY KEY (`id_toko`);

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
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barang_non_reseller`
--
ALTER TABLE `barang_non_reseller`
  MODIFY `bnr_id` int(250) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `barang_reseller`
--
ALTER TABLE `barang_reseller`
  MODIFY `br_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64999;

--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
  MODIFY `diskon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `diskon_all`
--
ALTER TABLE `diskon_all`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `history_stock_barang`
--
ALTER TABLE `history_stock_barang`
  MODIFY `hsb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73305;

--
-- AUTO_INCREMENT for table `history_stock_masuk`
--
ALTER TABLE `history_stock_masuk`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4976;

--
-- AUTO_INCREMENT for table `history_stok_barang_keluar`
--
ALTER TABLE `history_stok_barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53855;

--
-- AUTO_INCREMENT for table `history_stok_barang_kembali`
--
ALTER TABLE `history_stok_barang_kembali`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2864;

--
-- AUTO_INCREMENT for table `history_stok_barang_masuk`
--
ALTER TABLE `history_stok_barang_masuk`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1286;

--
-- AUTO_INCREMENT for table `history_stok_paket`
--
ALTER TABLE `history_stok_paket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `jenis_customer`
--
ALTER TABLE `jenis_customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `kurir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `list_barang`
--
ALTER TABLE `list_barang`
  MODIFY `lb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73314;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `mp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `paket_belong_to`
--
ALTER TABLE `paket_belong_to`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `request_stok_barang`
--
ALTER TABLE `request_stok_barang`
  MODIFY `id_request` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `toko`
--
ALTER TABLE `toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
