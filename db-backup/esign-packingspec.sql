-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 25, 2022 at 07:01 PM
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
  `file_revise_note` varchar(255) DEFAULT NULL,
  `revise_from` varchar(255) DEFAULT NULL,
  `issued_on` timestamp NULL DEFAULT current_timestamp(),
  `last_update_on` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `file_name`, `file_owner`, `file_location`, `file_revise_note`, `revise_from`, `issued_on`, `last_update_on`) VALUES
(80, 'BMKF56580000.jpg', 'XJ55075', 'Staff PE', NULL, NULL, '2022-12-24 04:46:31', '2022-12-24 04:46:31'),
(81, 'BNNF89780000.jpg', 'XJ55075', 'SPV PE', NULL, NULL, '2022-12-24 04:46:31', '2022-12-24 04:46:31'),
(82, 'BPXF11110000.jpg', 'XJ55075', 'SPV PE', NULL, NULL, '2022-12-24 04:46:31', '2022-12-24 04:46:31');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
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
  `password_user` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `id_role`, `nama_user`, `npk_user`, `password_user`, `create_at`, `update_at`) VALUES
(1, 1, 'Super User', 'sudo', '0b180078d994cb2b5ed89d7ce8e7eea2', '2022-11-28 22:22:07', NULL),
(2, 2, 'Muhammad Fattah Al Fattika', 'XJ55075', 'd94db5d56e26aa520f1842a22056c09c', '2022-11-27 09:18:26', NULL),
(3, 2, 'Muhammad Handi Setiawan', 'XJ47462', '9a08173505ddb28ef127627901de2918', '2022-11-27 09:18:26', NULL),
(6, 2, 'Andi Shandy Putra', 'XJ46741', '22c0b2a19a05fff19e92fab5a0b7728b', '2022-11-30 08:41:23', NULL),
(7, 2, 'Wilson Winata', 'XJ37971', 'a6a946f7265ed7f28a6425ee76621c3a', '2022-11-30 08:41:23', NULL),
(8, 5, 'Adi Priyatna', 'XJ20767', '2fca89aef2c792cb67c316a669ffe591', '2022-12-01 09:17:06', NULL),
(9, 5, 'Rian Haryanto', 'XJ25202', 'dfb72f52212ce3e209fcaf3af7388a4d', '2022-12-01 09:17:06', NULL),
(10, 4, 'Priyanto', '', '', '2022-12-10 05:43:49', NULL),
(11, 9, 'Umed Taryana', '', '', '2022-12-10 05:46:17', NULL),
(12, 3, 'Bangkit Budiman', '', '', '2022-12-10 05:46:17', NULL),
(13, 3, 'Albar', '', '', '2022-12-10 05:46:17', NULL),
(14, 3, 'Reza', '', '', '2022-12-10 05:46:17', NULL),
(15, 8, 'Gede Sukma', '', '', '2022-12-10 05:46:17', NULL),
(16, 7, 'Heru Susanto', '', '', '2022-12-10 05:46:17', NULL);

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
  ADD PRIMARY KEY (`role_id`);

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
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`id_role`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
