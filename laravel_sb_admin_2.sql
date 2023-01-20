-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2023 at 07:39 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_sb_admin_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `book_id` int(12) NOT NULL,
  `category_id` text NOT NULL,
  `penerbit_id` int(12) NOT NULL,
  `name` text NOT NULL,
  `jumlah` int(12) NOT NULL,
  `jumlah_dipinjam` int(12) NOT NULL,
  `image` varchar(255) NOT NULL,
  `tahun_terbit` varchar(255) NOT NULL,
  `status` int(12) NOT NULL,
  `createdAt` varchar(255) NOT NULL,
  `updatedAt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `category_id`, `penerbit_id`, `name`, `jumlah`, `jumlah_dipinjam`, `image`, `tahun_terbit`, `status`, `createdAt`, `updatedAt`) VALUES
(1, '1,2,3', 1, 'Sejarah Indonesia', 0, 0, 'undraw_profile.jpg', '2000', 2, '2022-01-01 12:00:00', '2023-01-16 04:56:43'),
(2, '2', 3, 'Tutorial Pemrograman PHP', 0, 0, '', '2017', 1, '2022-01-01 12:00:00', '2022-01-01 12:00:00'),
(3, '3,2', 3, 'Kalkulus', 0, 0, '2-undraw_profile.jpg', '2021', 1, '2023-01-17 03:29:23', '2023-01-17 03:29:23'),
(4, '2', 2, 'Matematika Diskrit', 0, 0, '2-2-undraw_profile.jpg', '2019', 1, '2023-01-17 03:44:59', '2023-01-17 03:44:59'),
(5, '1,3', 3, 'Sejarah Transportasi di Indo', 0, 0, '3-2-undraw_profile.jpg', '2020', 1, '2023-01-17 03:50:11', '2023-01-17 03:50:11'),
(6, '1,3', 3, 'Sejarah Transportasi di Indo', 0, 0, '4-2-undraw_profile.jpg', '2020', 3, '2023-01-17 03:51:34', '2023-01-17 03:52:01'),
(7, '1', 2, 'Hikayat Nusantara', 0, 0, '', '2019', 1, '2023-01-17 03:53:59', '2023-01-17 03:53:59'),
(8, '2', 2, 'Machine Learning', 0, 0, '', '2020', 1, '2023-01-17 04:00:22', '2023-01-17 04:00:22'),
(9, '2', 2, 'Rekayasa Perangkat Lunak', 0, 0, 'logo-ckl-cargo.png', '2014', 1, '2023-01-17 04:05:46', '2023-01-17 04:05:46'),
(10, '1,2', 1, 'Sistem Operasi dengan Windows', 0, 0, '2-4-2-undraw_profile.jpg', '2010', 2, '2023-01-17 04:41:23', '2023-01-17 05:07:30');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(12) NOT NULL,
  `createdAt` varchar(255) NOT NULL,
  `updatedAt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`, `description`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'Sejarah', 'Ini Kategori Sejarah', 1, '2022-01-01 12:00:00', '2022-01-01 12:00:00'),
(2, 'Teknologi Informasi', '', 2, '2022-01-01 12:00:00', '2022-01-01 12:00:00'),
(3, 'Transportasi', '', 2, '2022-01-01 12:00:00', '2023-01-18 04:46:42'),
(4, 'Non Fiksi', 'Ini adalah non fiksi', 2, '2023-01-19 10:12:56', '2023-01-19 10:15:10'),
(5, 'Fiksi', '', 1, '2023-01-19 10:18:37', '2023-01-19 10:18:37'),
(6, 'Komik', '', 1, '2023-01-19 10:18:55', '2023-01-19 10:18:55'),
(7, 'Majalah', '', 1, '2023-01-19 10:19:09', '2023-01-19 10:19:09'),
(8, 'Agama', '', 1, '2023-01-19 10:27:22', '2023-01-19 10:27:22');

-- --------------------------------------------------------

--
-- Table structure for table `penerbit`
--

CREATE TABLE `penerbit` (
  `penerbit_id` int(12) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(12) NOT NULL,
  `createdAt` varchar(255) NOT NULL,
  `updatedAt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penerbit`
--

INSERT INTO `penerbit` (`penerbit_id`, `name`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'Tony K.', 1, '2022-01-01 12:00:00', '2022-01-01 12:00:00'),
(2, 'Abdurahman', 1, '2022-01-01 12:00:00', '2022-01-01 12:00:00'),
(3, 'Endang S.', 1, '2022-01-01 12:00:00', '2022-01-01 12:00:00'),
(4, 'Leon', 3, '2023-01-19 10:57:06', '2023-01-19 11:00:32');

-- --------------------------------------------------------

--
-- Table structure for table `pinjam`
--

CREATE TABLE `pinjam` (
  `pinjam_id` int(12) NOT NULL,
  `user_id` int(12) NOT NULL,
  `book_id` int(12) NOT NULL,
  `batas_pengembalian` varchar(255) NOT NULL,
  `status` int(12) NOT NULL,
  `createdAt` varchar(255) NOT NULL,
  `updatedAt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pinjam`
--

INSERT INTO `pinjam` (`pinjam_id`, `user_id`, `book_id`, `batas_pengembalian`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 6, 1, '2022-11-14 11:00:00', 3, '2022-11-11 11:00:00', '2023-01-19 04:48:22'),
(2, 6, 3, '2022-11-15 11:00:00', 3, '2022-11-11 12:00:00', '2022-11-15 12:00:00'),
(3, 6, 7, '2022-01-25 12:00:00', 1, '2023-01-20 10:36:36', ''),
(4, 6, 9, '2022-01-25 12:00:00', 1, '2023-01-20 11:08:30', ''),
(5, 6, 9, '2022-01-25 12:00:00', 1, '2023-01-20 11:10:58', ''),
(6, 6, 8, '2023-01-22 11:29:33', 1, '2023-01-20 11:29:34', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(12) NOT NULL,
  `role` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(12) NOT NULL,
  `createdAt` varchar(255) NOT NULL,
  `updatedAt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `role`, `name`, `email`, `phone`, `password`, `status`, `createdAt`, `updatedAt`) VALUES
(1, 'Admin', 'tes', 'tes@gmail.com', '08122288282', '4297f44b13955235245b2497399d7a93', 1, '2022-01-13 12:00:00', '2022-01-13 12:00:00'),
(2, 'Peminjam', 'tester', 'tesssst@test.com', '08272772', '4297f44b13955235245b2497399d7a93', 1, '2022-01-13 12:00:00', '2022-01-13 12:00:00'),
(3, 'Admin', 'testertes', 'teeeest@test.com', '08272772', '4297f44b13955235245b2497399d7a93', 1, '2022-01-13 12:00:00', '2022-01-13 12:00:00'),
(4, 'Admin', 'testerr', 'tester@test.com', '08272772', '4297f44b13955235245b2497399d7a93', 1, '2022-01-13 13:00:00', '2022-01-13 16:00:00'),
(5, 'Admin', 'teesterr', 'tester@tester.com', '08272772', '4297f44b13955235245b2497399d7a93', 2, '2022-01-13 14:00:00', '2022-01-13 14:00:00'),
(6, 'Peminjam', 'abcde', 'abcde@gmail.com', '082727797', '4297f44b13955235245b2497399d7a93', 2, '2022-01-14 12:00:00', '2023-01-16 11:47:04'),
(7, 'Admin', 'Bagas', 'bagas@gmail.com', '08272772', '4297f44b13955235245b2497399d7a93', 2, '2023-01-16 11:38:28', '2023-01-16 11:46:48'),
(8, 'Admin', 'Terbaru', 'testbaru@test.com', '08272772', '4297f44b13955235245b2497399d7a93', 2, '2023-01-18 05:09:06', '2023-01-18 05:09:18'),
(9, 'Peminjam', 'Bayu', 'bayu@gmail.com', '08272772', '4297f44b13955235245b2497399d7a93', 1, '2023-01-19 01:43:28', '2023-01-19 01:43:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `penerbit`
--
ALTER TABLE `penerbit`
  ADD PRIMARY KEY (`penerbit_id`);

--
-- Indexes for table `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`pinjam_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `book_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `penerbit`
--
ALTER TABLE `penerbit`
  MODIFY `penerbit_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `pinjam_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
