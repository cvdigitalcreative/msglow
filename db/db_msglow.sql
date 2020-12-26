-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 26, 2020 at 04:45 PM
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
  `barang_id` int(11) NOT NULL,
  `barang_nama` varchar(50) DEFAULT NULL,
  `barang_stock_awal` int(20) NOT NULL,
  `barang_stock_akhir` int(20) NOT NULL,
  `barang_harga_modal` varchar(50) NOT NULL,
  `barang_foto` varchar(50) DEFAULT NULL,
  `barang_level` int(2) NOT NULL,
  `barang_tanggal` timestamp NULL DEFAULT current_timestamp(),
  `id_kategori` int(11) NOT NULL DEFAULT 0,
  `waktu_berubah` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`barang_id`, `barang_nama`, `barang_stock_awal`, `barang_stock_akhir`, `barang_harga_modal`, `barang_foto`, `barang_level`, `barang_tanggal`, `id_kategori`, `waktu_berubah`) VALUES
(23, 'Paket White Biasa', 0, 0, '175000', 'Paket_Whitening_Biasa.jpeg', 2, '2019-05-01 11:51:29', 1, '2019-08-12 04:43:58'),
(24, 'Paket Acne Biasa', 0, 0, '175000', 'paket_acne_biasa.jpeg', 2, '2019-05-01 11:52:46', 1, '2019-08-12 04:43:58'),
(25, 'Paket Ultimate Biasa', 0, 0, '175000', 'paket_ultimate_biasa.jpeg', 2, '2019-05-01 11:53:48', 1, '2019-08-12 04:43:58'),
(26, 'Paket Luminos Biasa', 0, 0, '175000', 'luminos_biasa.jpeg', 2, '2019-05-01 11:55:52', 1, '2019-08-12 04:43:58'),
(31, 'Paket Body Easy White', 0, 0, '135000', 'body_easy_white.jpeg', 2, '2019-05-01 12:07:56', 16, '2019-08-12 04:43:58'),
(32, 'Red Jelly', 0, 0, '170000', 'red_jelly.jpeg', 2, '2019-05-01 12:09:07', 2, '2019-08-12 04:43:58'),
(33, 'Radiance Gold', 0, 0, '170000', 'Radiance_Gold.jpeg', 2, '2019-05-01 12:10:12', 2, '2019-08-12 04:43:58'),
(34, 'Beauty Drink', 0, 0, '160000', 'Beauty_Drink.jpeg', 2, '2019-05-01 12:12:27', 17, '2019-08-12 04:43:58'),
(35, 'Ms BLACK', 0, 0, '160000', 'ms_slim.jpeg', 2, '2019-05-01 12:13:09', 17, '2019-08-12 04:43:58'),
(36, 'JJ Glow', 0, 0, '85000', 'JJ_Glow.jpeg', 2, '2019-05-01 12:14:08', 18, '2019-08-12 04:43:58'),
(37, 'Serum Luminos', 0, 0, '90000', 'serum_luminos.jpeg', 2, '2019-05-01 12:15:22', 23, '2019-08-12 04:43:58'),
(38, 'Serum Lifting', 0, 0, '90000', 'serum_lifting.jpeg', 2, '2019-05-01 12:16:16', 23, '2019-08-12 04:43:58'),
(39, 'Serum Acne', 0, 0, '60000', 'serum_acne.jpeg', 2, '2019-05-01 12:17:59', 19, '2019-08-12 04:43:58'),
(40, 'Moist Cushion Light', 0, 0, '135000', 'Moist_Cushion_Light.jpeg', 2, '2019-05-01 12:25:57', 4, '2019-08-12 04:43:58'),
(41, 'Moist Cushion Medium Light', 0, 0, '135000', 'Moist_Cushion_Medium_Light.jpeg', 2, '2019-05-01 12:27:01', 4, '2019-08-12 04:43:58'),
(42, 'Losse Powder Natural', 0, 0, '75000', 'Losse_Powder_Natural.jpeg', 2, '2019-05-01 12:28:17', 5, '2019-08-12 04:43:58'),
(43, 'Losse Powder Shine Ivory', 0, 0, '75000', 'IMG-20200121-WA00072.jpg', 2, '2019-05-01 12:31:15', 5, '2019-08-12 04:43:58'),
(44, 'Losse Powder OILY', 0, 0, '75000', 'Losse_Powder_Anti_Sebum.jpeg', 2, '2019-05-01 12:32:20', 5, '2019-08-12 04:43:58'),
(45, 'Clay Mask Green Tea', 0, 0, '90000', 'Clay_Mask_Green_Tea.jpeg', 2, '2019-05-01 12:33:16', 29, '2019-08-12 04:43:58'),
(46, 'Clay Mask Chorcoal', 0, 0, '90000', 'clay_mask_charcoal.jpeg', 2, '2019-05-01 12:36:25', 29, '2019-08-12 04:43:58'),
(48, 'Underarm NEW', 0, 0, '70000', 'Underarm.jpeg', 2, '2019-05-01 12:40:02', 20, '2019-08-12 04:43:58'),
(49, 'Acne Spot', 0, 0, '55000', 'Pimple_Spot.jpeg', 2, '2019-05-01 12:46:57', 21, '2020-07-17 10:44:08'),
(51, 'Glam Matte 01', 0, 0, '60000', 'Glam_Matte.jpeg', 2, '2019-05-01 12:49:19', 7, '2019-08-12 04:43:58'),
(52, 'Glam Matte 02', 0, 0, '60000', 'Glam_Matte1.jpeg', 2, '2019-05-01 12:50:49', 7, '2019-08-12 04:43:58'),
(53, 'Glam Matte 03', 0, 0, '60000', 'Glam_Matte2.jpeg', 2, '2019-05-01 12:51:46', 7, '2019-08-12 04:43:58'),
(54, 'Glam Matte 04', 0, 0, '60000', 'Glam_Matte3.jpeg', 2, '2019-05-01 12:52:21', 7, '2019-08-12 04:43:58'),
(55, 'Glam Matte 05', 0, 0, '60000', 'Glam_Matte4.jpeg', 2, '2019-05-01 12:52:48', 7, '2019-08-12 04:43:58'),
(56, 'Glam Matte 06', 0, 0, '60000', 'Glam_Matte5.jpeg', 2, '2019-05-01 12:53:17', 7, '2019-08-12 04:43:58'),
(57, 'Facial Wash', 0, 0, '45000', 'Facial_Wash.jpeg', 2, '2019-05-01 12:54:16', 22, '2019-08-12 04:43:58'),
(58, 'Toner Glowing', 0, 0, '55000', 'Toner_Glowing_and_toner_acne.jpeg', 2, '2019-05-01 12:56:39', 8, '2019-08-12 04:43:58'),
(59, 'Toner Acne', 0, 0, '55000', 'Toner_Glowing_and_toner_acne1.jpeg', 2, '2019-05-01 12:57:18', 8, '2019-08-12 04:43:58'),
(61, 'Day Cream', 0, 0, '50000', 'day_cream.jpeg', 2, '2019-05-01 12:58:49', 11, '2019-08-12 04:43:58'),
(62, 'Night White Cream', 0, 0, '55000', 'Night_White_Cream.jpeg', 2, '2019-05-01 13:00:03', 11, '2019-08-12 04:43:58'),
(63, 'Night Acne Cream', 0, 0, '55000', 'night_acne.jpeg', 2, '2019-05-01 13:00:43', 11, '2019-08-12 04:43:58'),
(64, 'Night Ultimate Cream', 0, 0, '55000', 'ultimate_night.jpeg', 2, '2019-05-01 13:02:15', 11, '2019-08-12 04:43:58'),
(65, 'Night Luminos Cream', 0, 0, '55000', 'luminos_night.jpeg', 2, '2019-05-01 13:03:07', 11, '2019-08-12 04:43:58'),
(69, 'Pelling Serum', 0, 0, '90000', 'IMG-20190725-WA0078.jpg', 2, '2019-07-25 10:57:48', 23, '2019-08-12 04:43:58'),
(70, 'Serum Gold', 0, 0, '115000', 'serum.jpeg', 2, '2019-12-31 04:55:38', 13, '2019-12-31 04:55:38'),
(71, 'Deep Esence', 0, 0, '115000', 'IMG-20200108-WA0033.jpeg', 2, '2020-01-08 09:01:16', 31, '2020-01-08 09:01:16'),
(72, 'BALM juice YUZU', 0, 0, '85000', 'IMG-20200111-WA0013.jpg', 2, '2020-01-11 02:10:18', 6, '2020-01-11 02:10:18'),
(73, 'BALM juice WATER MELON', 0, 0, '85000', 'IMG-20200111-WA0011.jpg', 2, '2020-01-11 02:10:53', 6, '2020-01-11 02:10:53'),
(74, 'BALM juice CACTUS', 0, 0, '85000', 'IMG-20200111-WA0012.jpg', 2, '2020-01-11 02:11:34', 6, '2020-01-11 02:11:34'),
(75, 'Paket MEN', 0, 0, '165000', 'DDBBB682-4DE9-48BA-A2D0-4B6C2806F771.jpeg', 2, '2020-01-15 16:46:45', 24, '2020-01-15 16:46:45'),
(76, 'SunScreen Spray MEN', 0, 0, '70000', 'B8EA314C-E469-4289-A9B5-413CA2540F26.jpeg', 2, '2020-01-15 16:48:34', 6, '2020-01-15 16:48:34'),
(79, 'Facial Wash MEN', 0, 0, '40000', 'facialwashmen.jpeg', 2, '2020-01-16 02:48:19', 26, '2020-01-16 02:48:19'),
(80, 'POWER SERUM MEN', 0, 0, '60000', 'powerserummen.jpeg', 2, '2020-01-16 02:56:16', 25, '2020-01-16 02:56:16'),
(81, 'Bright Cream Men', 0, 0, '60000', 'BrightCream.jpeg', 2, '2020-01-16 02:57:38', 27, '2020-01-16 02:57:38'),
(82, 'Juice water melon', 0, 0, '95000', 'watermelon.jpeg', 2, '2020-01-31 04:18:02', 14, '2020-01-31 04:18:02'),
(83, 'Juice Yuzu', 0, 0, '95000', 'yuzu.jpeg', 2, '2020-01-31 04:18:40', 14, '2020-01-31 04:18:40'),
(84, 'JUICE CACTUS', 0, 0, '95000', 'IMG-20200312-WA0045.jpg', 2, '2020-03-12 06:20:13', 14, '2020-03-12 06:20:13'),
(85, 'Eye Cream Serum', 0, 0, '95000', 'WhatsApp_Image_2020-03-14_at_12_30_52_(1).jpeg', 2, '2020-03-14 05:37:36', 28, '2020-03-14 05:37:36'),
(86, 'HAND SANITIZER', 0, 0, '85000', 'WhatsApp_Image_2020-04-03_at_19_51_08.jpeg', 2, '2020-04-04 04:14:21', 18, '2020-04-04 04:14:21'),
(87, 'Pore Away', 0, 0, '55000', 'WhatsApp_Image_2020-04-25_at_06_04_27.jpeg', 2, '2020-04-24 23:05:49', 30, '2020-04-24 23:05:49'),
(88, 'DarkSpot', 0, 0, '55000', 'WhatsApp_Image_2020-04-25_at_06_04_27_(1).jpeg', 2, '2020-04-24 23:06:44', 30, '2020-04-24 23:06:44'),
(89, 'SEXY 01', 0, 0, '65000', '73.png', 2, '2020-08-21 04:05:14', 32, '0000-00-00 00:00:00'),
(90, 'SEXY 02', 0, 0, '65000', '74.png', 2, '2020-08-21 04:06:00', 32, '0000-00-00 00:00:00'),
(91, 'SEXY 03', 0, 0, '65000', '75.png', 2, '2020-08-21 04:06:58', 32, '0000-00-00 00:00:00'),
(92, 'SEXY 04', 0, 0, '65000', '76.png', 2, '2020-08-21 04:07:44', 32, '0000-00-00 00:00:00'),
(93, 'SEXY 05', 0, 0, '65000', '77.png', 2, '2020-08-21 04:08:48', 32, '0000-00-00 00:00:00'),
(94, 'SEXY 06', 0, 0, '65000', '78.png', 2, '2020-08-21 04:10:10', 32, '0000-00-00 00:00:00'),
(95, 'FACE PEEL SCRUB', 0, 0, '80000', 'WhatsApp_Image_2020-08-30_at_12_36_39.jpeg', 2, '2020-08-30 05:41:18', 33, '0000-00-00 00:00:00'),
(96, 'MASKULIN', 0, 0, '70000', 'WhatsApp_Image_2020-09-02_at_11_27_44.jpeg', 2, '2020-09-02 05:09:32', 34, '0000-00-00 00:00:00'),
(97, 'MS SLIM CAPSUL', 0, 0, '175000', 'WhatsApp_Image_2020-09-14_at_12_39_27.jpeg', 2, '2020-09-14 05:43:06', 35, '0000-00-00 00:00:00'),
(98, 'BODY OIL TREATMENT', 0, 0, '175000', 'WhatsApp_Image_2020-09-14_at_12_42_43.jpeg', 2, '2020-09-14 05:44:02', 35, '0000-00-00 00:00:00'),
(100, 'Sexy 07', 0, 0, '65000', 'WhatsApp_Image_2020-10-15_at_10_46_06.jpeg', 2, '2020-10-15 03:48:58', 32, '0000-00-00 00:00:00'),
(101, 'Paket MS KIDS', 0, 0, '200000', '9B148467-5E60-44B4-B29C-AD45A7A8EDED.jpeg', 2, '2020-12-03 05:26:16', 36, '0000-00-00 00:00:00'),
(102, 'DAILY BABY CREAM', 0, 0, '65000', '2E7AD842-FC0F-466F-BBA4-74DDF2E13004.jpeg', 2, '2020-12-03 05:31:17', 37, '0000-00-00 00:00:00'),
(103, 'BUBBLE WASH KIDS', 0, 0, '65000', '08ACD06C-57B2-4CA9-9A00-EBF8DE2F3572.jpeg', 2, '2020-12-03 05:40:11', 37, '0000-00-00 00:00:00'),
(104, 'SHAMPO KIDS', 0, 0, '75000', '1237BBB2-84CC-44FF-A8CB-0F11E2F0E8C3.jpeg', 2, '2020-12-03 05:41:25', 37, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `barang_non_reseller`
--

CREATE TABLE `barang_non_reseller` (
  `bnr_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `bnr_harga` varchar(50) NOT NULL,
  `bnr_tanggal` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang_non_reseller`
--

INSERT INTO `barang_non_reseller` (`bnr_id`, `barang_id`, `bnr_harga`, `bnr_tanggal`) VALUES
(10, 23, '300000', '2019-05-01 11:51:29'),
(11, 24, '300000', '2019-05-01 11:52:46'),
(12, 25, '300000', '2019-05-01 11:53:48'),
(13, 26, '300000', '2019-05-01 11:55:52'),
(18, 31, '200000', '2019-05-01 12:07:56'),
(19, 32, '300000', '2019-05-01 12:09:08'),
(20, 33, '300000', '2019-05-01 12:10:12'),
(21, 34, '250000', '2019-05-01 12:12:27'),
(22, 35, '250000', '2019-05-01 12:13:10'),
(23, 36, '125000', '2019-05-01 12:14:08'),
(24, 37, '150000', '2019-05-01 12:15:22'),
(25, 38, '150000', '2019-05-01 12:16:16'),
(26, 39, '100000', '2019-05-01 12:18:00'),
(27, 40, '200000', '2019-05-01 12:25:57'),
(28, 41, '200000', '2019-05-01 12:27:01'),
(29, 42, '100000', '2019-05-01 12:28:17'),
(30, 43, '100000', '2019-05-01 12:31:15'),
(31, 44, '100000', '2019-05-01 12:32:20'),
(32, 45, '125000', '2019-05-01 12:33:16'),
(33, 46, '125000', '2019-05-01 12:36:25'),
(35, 48, '100000', '2019-05-01 12:40:02'),
(36, 49, '100000', '2019-05-01 12:46:58'),
(38, 51, '85000', '2019-05-01 12:49:19'),
(39, 52, '85000', '2019-05-01 12:50:49'),
(40, 53, '85000', '2019-05-01 12:51:46'),
(41, 54, '85000', '2019-05-01 12:52:22'),
(42, 55, '85000', '2019-05-01 12:52:48'),
(43, 56, '85000', '2019-05-01 12:53:17'),
(44, 57, '70000', '2019-05-01 12:54:16'),
(45, 58, '80000', '2019-05-01 12:56:39'),
(46, 59, '80000', '2019-05-01 12:57:18'),
(48, 61, '90000', '2019-05-01 12:58:49'),
(49, 62, '90000', '2019-05-01 13:00:03'),
(50, 63, '90000', '2019-05-01 13:00:43'),
(51, 64, '90000', '2019-05-01 13:02:15'),
(52, 65, '90000', '2019-05-01 13:03:07'),
(56, 69, '150000', '2019-07-25 10:57:48'),
(57, 70, '175000', '2019-12-31 04:55:39'),
(58, 71, '175000', '2020-01-08 09:01:16'),
(59, 72, '120000', '2020-01-11 02:10:18'),
(60, 73, '120000', '2020-01-11 02:10:53'),
(61, 74, '120000', '2020-01-11 02:11:34'),
(62, 75, '250000', '2020-01-15 16:46:45'),
(63, 76, '100000', '2020-01-15 16:48:34'),
(66, 79, '70000', '2020-01-16 02:48:19'),
(67, 80, '100000', '2020-01-16 02:56:16'),
(68, 81, '90000', '2020-01-16 02:57:38'),
(69, 82, '150000', '2020-01-31 04:18:02'),
(70, 83, '150000', '2020-01-31 04:18:40'),
(71, 84, '150000', '2020-03-12 06:20:13'),
(72, 85, '125000', '2020-03-14 05:37:36'),
(73, 86, '125000', '2020-04-04 04:14:21'),
(74, 87, '100000', '2020-04-24 23:05:49'),
(75, 88, '100000', '2020-04-24 23:06:44'),
(76, 89, '90000', '2020-08-21 04:05:14'),
(77, 90, '90000', '2020-08-21 04:06:00'),
(78, 91, '90000', '2020-08-21 04:06:58'),
(79, 92, '90000', '2020-08-21 04:07:44'),
(80, 93, '90000', '2020-08-21 04:08:48'),
(81, 94, '90000', '2020-08-21 04:10:10'),
(82, 95, '125000', '2020-08-30 05:41:18'),
(83, 96, '100000', '2020-09-02 05:09:32'),
(84, 97, '225000', '2020-09-14 05:43:06'),
(85, 98, '225000', '2020-09-14 05:44:02'),
(87, 100, '90000', '2020-10-15 03:48:58'),
(88, 101, '265000', '2020-12-03 05:26:16'),
(89, 102, '100000', '2020-12-03 05:31:17'),
(90, 103, '90000', '2020-12-03 05:40:11'),
(91, 104, '100000', '2020-12-03 05:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `barang_reseller`
--

CREATE TABLE `barang_reseller` (
  `br_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `br_kuantitas` int(50) NOT NULL,
  `br_harga` varchar(50) NOT NULL,
  `br_tanggal` timestamp NULL DEFAULT current_timestamp()
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

-- --------------------------------------------------------

--
-- Table structure for table `diskon_all`
--

CREATE TABLE `diskon_all` (
  `id` int(11) NOT NULL,
  `nama_diskon` varchar(250) NOT NULL,
  `potongan_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `diskon_all`
--

INSERT INTO `diskon_all` (`id`, `nama_diskon`, `potongan_harga`) VALUES
(1, 'Tidak Ada Diskon', 0);

-- --------------------------------------------------------

--
-- Table structure for table `history_stock_barang`
--

CREATE TABLE `history_stock_barang` (
  `hsb_id` int(11) NOT NULL,
  `pemesanan_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `stock_berkurang` int(50) NOT NULL,
  `lvl` int(11) NOT NULL,
  `hsb_tanggal` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_stock_barang`
--

INSERT INTO `history_stock_barang` (`hsb_id`, `pemesanan_id`, `barang_id`, `stock_berkurang`, `lvl`, `hsb_tanggal`) VALUES
(48749, 25376, 23, 1, 2, '2020-12-26 15:33:13'),
(48750, 25377, 24, 1, 2, '2020-12-26 15:42:01');

-- --------------------------------------------------------

--
-- Table structure for table `history_stock_masuk`
--

CREATE TABLE `history_stock_masuk` (
  `id_stock` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `stock` int(50) NOT NULL,
  `pemesanan` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history_stok_barang_keluar`
--

CREATE TABLE `history_stok_barang_keluar` (
  `id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `stok_keluar` int(11) NOT NULL,
  `barang_stock_keluar` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history_stok_barang_kembali`
--

CREATE TABLE `history_stok_barang_kembali` (
  `id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `stok_keluar` int(11) NOT NULL,
  `barang_stock_keluar` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `history_stok_barang_masuk`
--

CREATE TABLE `history_stok_barang_masuk` (
  `id` int(20) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `stok_keluar` int(11) NOT NULL,
  `barang_stock_keluar` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
(7, 'RATU INTAN TRVL', '2019-05-03 05:14:49'),
(8, 'Mobil travel', '2019-05-03 05:15:09'),
(9, 'GOJEK FARID', '2019-05-14 01:59:00'),
(10, 'GOJEK MB ADE', '2019-06-21 00:34:22'),
(11, 'GOJEK/GRAB SHOPEE', '2019-09-03 02:04:10'),
(12, 'GOJEK KURIR', '2020-05-21 04:06:00'),
(13, 'GOJEK KURIR', '2020-05-21 04:07:45'),
(14, 'GOJEK KURIR', '2020-05-21 04:09:18'),
(15, 'ID Express', '2020-07-27 03:17:17'),
(16, 'TAM CHARGO', '2020-09-10 04:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `list_barang`
--

CREATE TABLE `list_barang` (
  `lb_id` int(11) NOT NULL,
  `pemesanan_id` int(11) NOT NULL,
  `lb_qty` int(20) NOT NULL,
  `ktg_qty` int(11) NOT NULL DEFAULT 0,
  `barang_id` int(11) DEFAULT NULL,
  `lb_lvl` int(11) NOT NULL,
  `lb_tanggal` timestamp NULL DEFAULT current_timestamp()
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
-- Table structure for table `pemesanan`
--

CREATE TABLE `pemesanan` (
  `pemesanan_id` int(11) NOT NULL,
  `pemesanan_nama` varchar(50) DEFAULT NULL,
  `pemesanan_tanggal` date NOT NULL,
  `pemesanan_hp` varchar(25) DEFAULT NULL,
  `pemesanan_alamat` text DEFAULT NULL,
  `level` int(11) NOT NULL,
  `kurir_id` int(11) DEFAULT NULL,
  `at_id` int(11) DEFAULT NULL,
  `mp_id` int(11) NOT NULL,
  `id_diskon` int(11) NOT NULL DEFAULT 1,
  `uid` int(11) NOT NULL DEFAULT 5
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_nama`, `user_hp`, `user_alamat`, `user_foto`, `user_level`, `username`, `password`) VALUES
(5, 'Amelia Putri', '082285946767', 'Komplek Horizon Estate Blok C no.4 palembang', 'C360_2015-07-11-14-27-56-274.jpg', 1, 'sabiansabia', '200190'),
(6, 'apri', '083185985031', 'palimo', '-', 2, 'apri', '123456'),
(7, 'munif', '08972473998', 'Palembang', '-', 2, 'munif', '123456'),
(8, 'Aisyah', '082211336300', 'Naskah', '5.png', 2, 'aisyah', '123456'),
(9, 'selly', '081273666752', 'PAKJO', '57.png', 2, 'selly', '123456'),
(10, '5', '081273434989', 'LINGGAU', '45.png', 2, 'Selly', '123456'),
(11, '6', '082211446300', 'Angkatan 66', '-', 2, 'Apri', '232344'),
(16, '7', '082211155080', 'Jahe', '548F5047-F750-42E4-9416-4284DD11C8E7.jpeg', 2, 'Munif', '12345'),
(17, '8', '082211155040', 'Palembang', '31A26F70-C6AA-4AAA-B545-B0C116CBFC1A.jpeg', 2, 'Sella', '12345'),
(18, '9', '082211579922', 'Palembang', '320AC1C6-F110-4AB4-BEB7-9C84BC4F2842.jpeg', 2, 'Mira', '12345'),
(19, '10', '082211578822', 'Palembang', '00D9C1D9-3FCD-40B2-8A60-308084B5D42E.jpeg', 2, 'Rinda', '12345');

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
  MODIFY `at_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `barang_non_reseller`
--
ALTER TABLE `barang_non_reseller`
  MODIFY `bnr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `barang_reseller`
--
ALTER TABLE `barang_reseller`
  MODIFY `br_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60221;

--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
  MODIFY `diskon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `diskon_all`
--
ALTER TABLE `diskon_all`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `history_stock_barang`
--
ALTER TABLE `history_stock_barang`
  MODIFY `hsb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48751;

--
-- AUTO_INCREMENT for table `history_stock_masuk`
--
ALTER TABLE `history_stock_masuk`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2757;

--
-- AUTO_INCREMENT for table `history_stok_barang_keluar`
--
ALTER TABLE `history_stok_barang_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29363;

--
-- AUTO_INCREMENT for table `history_stok_barang_kembali`
--
ALTER TABLE `history_stok_barang_kembali`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1262;

--
-- AUTO_INCREMENT for table `history_stok_barang_masuk`
--
ALTER TABLE `history_stok_barang_masuk`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=683;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `kurir`
--
ALTER TABLE `kurir`
  MODIFY `kurir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `list_barang`
--
ALTER TABLE `list_barang`
  MODIFY `lb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48767;

--
-- AUTO_INCREMENT for table `metode_pembayaran`
--
ALTER TABLE `metode_pembayaran`
  MODIFY `mp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `pemesanan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25378;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
