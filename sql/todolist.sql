-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2024 at 07:18 AM
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
-- Database: `todolist`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) NOT NULL,
  `task` varchar(255) DEFAULT NULL,
  `process_time` date DEFAULT current_timestamp(),
  `due_time` date DEFAULT NULL,
  `active` varchar(150) NOT NULL DEFAULT 'Y',
  `user` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `task`, `process_time`, `due_time`, `active`, `user`) VALUES
(8, 'show data from xls file', '2024-05-17', NULL, 'N', '1'),
(11, 'add to task', '2024-05-17', NULL, 'N', '7'),
(12, 'new file added', '2024-05-17', NULL, 'N', '7'),
(13, 'Call Client', '2024-05-17', NULL, 'Y', '7'),
(14, 'anik', '2024-05-17', NULL, 'N', '1'),
(17, 'new file added', '2024-05-17', NULL, 'N', '9'),
(18, 'anik112', '2024-05-17', NULL, 'N', '9'),
(19, 'Call Client', '2024-05-17', NULL, 'Y', '9'),
(20, 'show more', '2024-05-17', NULL, 'N', '9'),
(21, 'gdfgertert', '2024-05-17', NULL, 'N', '1'),
(22, 'kjgufuydutd', '2024-05-17', NULL, 'Y', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `user_name` varchar(150) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `v_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `user_name`, `name`, `v_password`) VALUES
(1, 'anik', NULL, 'anik112'),
(7, 'anik1', NULL, 'anik1'),
(8, 'anik2', NULL, 'anik2'),
(9, 'admin', NULL, 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
