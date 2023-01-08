-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2023 at 12:39 AM
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
-- Database: `esign-packingspec`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(255) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_owner` varchar(255) DEFAULT NULL,
  `file_location` varchar(255) DEFAULT NULL,
  `revise_note` varchar(255) DEFAULT NULL,
  `revise_from` varchar(255) DEFAULT NULL,
  `issued_on` timestamp NULL DEFAULT current_timestamp(),
  `last_update_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `file_name`, `file_owner`, `file_location`, `revise_note`, `revise_from`, `issued_on`, `last_update_on`) VALUES
(94, 'BPXF11110000.jpg', 'XJ55075', 'Staff PE', 'Need Revise', 'Muhammad Fattah Al Fattika', '2023-01-08 13:05:34', '2023-01-08 13:05:34');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id_role`, `role_name`) VALUES
(1, 'Superuser'),
(2, 'Staff PE'),
(3, 'Staff QA'),
(4, 'General Foreman Prod.'),
(5, 'SPV PE'),
(6, 'Manager PE'),
(7, 'SPV QA'),
(8, 'MGR QA'),
(9, 'MGR Prod.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `id_role` int(11) DEFAULT NULL,
  `nama_user` varchar(255) NOT NULL,
  `npk_user` varchar(255) NOT NULL,
  `password_user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_role`, `nama_user`, `npk_user`, `password_user`) VALUES
(1, 1, 'Super User', 'sudo', '0b180078d994cb2b5ed89d7ce8e7eea2'),
(2, 2, 'Muhammad Fattah Al Fattika', 'XJ55075', 'd94db5d56e26aa520f1842a22056c09c'),
(3, 2, 'Muhammad Handi Setiawan', 'XJ47462', '9a08173505ddb28ef127627901de2918'),
(6, 2, 'Andi Shandy Putra', 'XJ46741', '22c0b2a19a05fff19e92fab5a0b7728b'),
(7, 2, 'Wilson Winata', 'XJ37971', 'a6a946f7265ed7f28a6425ee76621c3a'),
(8, 5, 'Adi Priyatna', 'XJ20767', '2fca89aef2c792cb67c316a669ffe591'),
(9, 5, 'Rian Haryanto', 'XJ25202', 'dfb72f52212ce3e209fcaf3af7388a4d'),
(10, 4, 'Priyanto', '', ''),
(11, 9, 'Umed Taryana', '', ''),
(12, 3, 'Bangkit Budiman', '', ''),
(13, 3, 'Albar', '', ''),
(14, 3, 'Reza', '', ''),
(15, 8, 'Gede Sukma', '', ''),
(16, 7, 'Heru Susanto', '', ''),
(17, 6, 'Rohmadi', 'XJ00000', 'dcddb75469b4b4875094e14561e573d8');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id__role` (`id_role`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
