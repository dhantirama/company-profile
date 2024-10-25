-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2024 at 09:53 AM
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
-- Database: `ang3_compro`
--

-- --------------------------------------------------------

--
-- Table structure for table `general_setting`
--

CREATE TABLE `general_setting` (
  `id` int(11) NOT NULL,
  `website_name` varchar(50) NOT NULL,
  `website_link` varchar(50) DEFAULT NULL,
  `website_email` varchar(100) NOT NULL,
  `website_phone` varchar(16) NOT NULL,
  `website_address` text NOT NULL,
  `twitter_link` varchar(100) DEFAULT NULL,
  `fb_link` varchar(100) DEFAULT NULL,
  `ig_link` varchar(100) DEFAULT NULL,
  `linkedin_link` varchar(100) DEFAULT NULL,
  `utube_link` varchar(100) DEFAULT NULL,
  `logo` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `general_setting`
--

INSERT INTO `general_setting` (`id`, `website_name`, `website_link`, `website_email`, `website_phone`, `website_address`, `twitter_link`, `fb_link`, `ig_link`, `linkedin_link`, `utube_link`, `logo`, `created_at`, `updated_at`) VALUES
(7, 'Dhntram', 'https://dhanram.my.id/', 'kue@gmail.com', '212121212121', 'jl. yg penting maju no 21a', NULL, NULL, NULL, NULL, NULL, 'team-3.jpg', '2024-10-24 06:45:53', '2024-10-25 03:13:28');

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE `instructors` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jurusan` varchar(40) NOT NULL,
  `fb_link` varchar(50) DEFAULT NULL,
  `ig_link` varchar(50) DEFAULT NULL,
  `twitter_link` varchar(50) DEFAULT NULL,
  `foto` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `nama`, `jurusan`, `fb_link`, `ig_link`, `twitter_link`, `foto`, `created_at`, `updated_at`) VALUES
(4, 'dhans', 'webpro', NULL, NULL, NULL, 'team-1.jpg', '2024-10-25 04:08:57', '2024-10-25 06:53:11'),
(5, 'Parex', 'webpro', NULL, NULL, NULL, 'team-2.jpg', '2024-10-25 06:51:59', '2024-10-25 06:53:17'),
(6, 'Ramen', 'webpro', NULL, NULL, NULL, 'team-3.jpg', '2024-10-25 06:52:19', '2024-10-25 06:53:23'),
(7, 'Kue', 'webpro', NULL, NULL, NULL, 'team-4.jpg', '2024-10-25 06:52:29', '2024-10-25 06:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul` varchar(50) NOT NULL,
  `slug` text NOT NULL,
  `isi` text NOT NULL,
  `foto` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_cat`
--

CREATE TABLE `profile_cat` (
  `id` int(11) NOT NULL,
  `nama_cat` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profile_cat`
--

INSERT INTO `profile_cat` (`id`, `nama_cat`, `created_at`, `updated_at`) VALUES
(1, 'Latar Belakang', '2024-10-25 07:38:39', '2024-10-25 07:38:39'),
(2, 'Visi dan Misi', '2024-10-25 07:38:39', '2024-10-25 07:38:39');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `email`, `password`, `foto`, `created_at`, `updated_at`) VALUES
(16, 'Bacang', 'bacang@gmail.com', 'bacang@gmail.com', '', '2024-10-23 04:31:41', '2024-10-23 04:45:05'),
(19, 'Ramen', 'ramen@gmail.com', 'ramen@gmail.com', '', '2024-10-23 04:40:17', '2024-10-23 04:45:30'),
(20, 'Ayam', 'ayam@gmail.com', 'ayam@gmail.com', '', '2024-10-23 04:44:28', '2024-10-23 06:20:39'),
(29, 'Kue', 'kue@gmail.com', 'kue@gmail.com', 'l.jpeg', '2024-10-24 01:07:28', '2024-10-24 01:07:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `general_setting`
--
ALTER TABLE `general_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_cat`
--
ALTER TABLE `profile_cat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `general_setting`
--
ALTER TABLE `general_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profile_cat`
--
ALTER TABLE `profile_cat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
