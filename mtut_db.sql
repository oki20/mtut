-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2024 at 04:21 AM
-- Server version: 10.4.10-MariaDB
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
-- Database: `mtut_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_docdata`
--

CREATE TABLE `tb_docdata` (
  `kode` int(11) NOT NULL,
  `dvnm` varchar(255) DEFAULT NULL,
  `dscr` varchar(255) DEFAULT NULL,
  `fpdf` varchar(255) DEFAULT NULL,
  `lgfo` varchar(255) DEFAULT NULL,
  `catgor` varchar(255) DEFAULT NULL,
  `docdt` varchar(255) DEFAULT NULL,
  `dura` int(11) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `waktu` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_docdata`
--

INSERT INTO `tb_docdata` (`kode`, `dvnm`, `dscr`, `fpdf`, `lgfo`, `catgor`, `docdt`, `dura`, `foto`, `waktu`) VALUES
(1, 'sales', 'Teknik Penjualan Dasar', '125949772.pdf', '', 'modul', NULL, 10, 'splash.png', '0000-00-00 00:00:00'),
(2, 'sales', 'Teknik Penjualan Middle', 'Ajeng Ayu Agustini TI22.pdf', '', 'modul', '1', 10, 'lampu.jpg', '0000-00-00 00:00:00'),
(3, 'sales', 'Teknik Penjualan Advanced', '168120025 - Muhammad Faisal Nasution Fulltext.pdf', '', 'modul', '1', 10, 'Alur penelitian hani.png', '0000-00-00 00:00:00'),
(4, 'sales', 'Teknik Negoisasi', 'Tutorial 4.pdf', '', 'modul', NULL, 10, '', '0000-00-00 00:00:00'),
(5, 'sales', 'Teknik Penjualan Dasar', '', 'https://forms.gle/X7sQYFKg6mu43Gy4A', 'test', NULL, 0, '', '0000-00-00 00:00:00'),
(6, 'sales', 'Teknik Penjualan Middle', '', 'https://forms.gle/ZB7mePSPb6dYX7nj8', 'test', NULL, 0, '', '0000-00-00 00:00:00'),
(7, 'sales', 'Teknik Penjualan Advanced', '', 'https://forms.gle/M8gUSXu12pCADegn8', 'test', NULL, 0, '', '0000-00-00 00:00:00'),
(8, 'sales', 'Teknik Negoisasi', '', 'https://forms.gle/t4iTEQYLtEqGf7Ah9', 'test', NULL, 0, '', '0000-00-00 00:00:00'),
(9, 'production', 'Cara Cutting', 'Tutorial 5.pdf', '', 'modul', NULL, 20, '', '0000-00-00 00:00:00'),
(10, 'production', 'Cara Bending', 'Tutorial 6.pdf', '', 'modul', NULL, 20, '', '0000-00-00 00:00:00'),
(11, 'production', 'Cara Welding', 'Tutorial 7.pdf', '', 'modul', NULL, 20, '', '0000-00-00 00:00:00'),
(12, 'production', 'Cara Repaint', 'Tutorial 8.pdf', '', 'modul', '1', 21, '', '0000-00-00 00:00:00'),
(13, 'production', 'Cara Cutting', '', 'Link Googleform 5', 'test', NULL, 0, '', '0000-00-00 00:00:00'),
(14, 'production', 'Cara Welding', '', 'Link Googleform 6', 'test', NULL, 0, '', '0000-00-00 00:00:00'),
(15, 'production', 'Cara Bending', '', 'Link Googleform 7', 'test', NULL, 0, '', '0000-00-00 00:00:00'),
(16, 'production', 'Cara Repaint', '', 'Link Googleform 8', 'test', NULL, 0, '', '0000-00-00 00:00:00'),
(17, 'maintenance', 'Service Mesin A', 'Tutorial 9.pdf', '', 'modul', '1', 30, '', '2024-02-17 22:15:00'),
(18, 'maintenance', 'Service Mesin B', 'Tutorial 10.pdf', '-', 'modul', '1', 30, '', '2024-02-17 22:20:00'),
(19, 'maintenance', 'Service Mesin C', 'Tutorial 11.pdf', '', 'modul', NULL, 30, '', '0000-00-00 00:00:00'),
(20, 'maintenance', 'Service Mesin D', 'Tutorial 12.pdf', '', 'modul', NULL, 30, '', '0000-00-00 00:00:00'),
(21, 'maintenance', 'Service Mesin A', '', 'https://forms.gle/X7sQYFKg6mu43Gy4A', 'test', NULL, 0, '', '0000-00-00 00:00:00'),
(22, 'maintenance', 'Service Mesin B', '', 'https://forms.gle/ZB7mePSPb6dYX7nj8', 'test', NULL, 0, '', '0000-00-00 00:00:00'),
(23, 'maintenance', 'Service Mesin C', '', 'https://forms.gle/M8gUSXu12pCADegn8', 'test', NULL, 0, '', '0000-00-00 00:00:00'),
(24, 'maintenance', 'Service Mesin D', '', 'https://forms.gle/t4iTEQYLtEqGf7Ah9', 'test', NULL, 0, '', '0000-00-00 00:00:00'),
(64, 'delivery', 'Test', '168120025 - Muhammad Faisal Nasution Fulltext.pdf', '-', 'modul', '1', 1, '', '2024-02-18 10:15:00'),
(65, 'delivery', 'Test', '5591-Article Text-13806-1-10-20221017.pdf', '-', 'modul', '1', 1, '', '0000-00-00 00:00:00'),
(66, 'packing', 'test', '1161-Article Text-2829-1-10-20230116.pdf', '-', 'modul', '1', 1, '', '0000-00-00 00:00:00'),
(67, 'project', 'test', '5591-Article Text-13806-1-10-20221017.pdf', '-', 'modul', '1', 60, 'WhatsApp Image 2024-01-05 at 08.46.17.jpeg', '2024-02-18 07:40:00'),
(68, 'purchase', 'test', 'Ajeng Ayu Agustini TI22.pdf', '-', 'modul', '1', 60, 'ac.png', '2024-02-18 09:00:00'),
(69, 'project', 'Basic', 'jy992d48301j.pdf', 'tesst', 'modul', '1', 3, 'Rancangan Website.png', '0000-00-00 00:00:00'),
(74, 'delivery', 'ase', 'jy992d48301j.pdf', 'tesr', 'modul', '1', 30, 'Air-conditioner-PNG.png', '2024-02-18 03:20:00'),
(75, 'delivery', 'Test', 'Statistik-PLN-2022-Final-2.pdf', '', 'modul', '1', 30, 'Rancangan Website.png', '2024-02-17 21:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pdflock`
--

CREATE TABLE `tb_pdflock` (
  `id` int(11) NOT NULL,
  `usnm` varchar(255) DEFAULT NULL,
  `kode` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `usnm` varchar(255) DEFAULT NULL,
  `pasw` varchar(255) DEFAULT NULL,
  `levl` varchar(255) DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `usnm`, `pasw`, `levl`, `foto`) VALUES
(1, 'admin', 'admin', '1', 'fadmin.jpg'),
(2, 'uzer', 'uzer', '2', 'fuzer.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_docdata`
--
ALTER TABLE `tb_docdata`
  ADD PRIMARY KEY (`kode`);

--
-- Indexes for table `tb_pdflock`
--
ALTER TABLE `tb_pdflock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_docdata`
--
ALTER TABLE `tb_docdata`
  MODIFY `kode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `tb_pdflock`
--
ALTER TABLE `tb_pdflock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
