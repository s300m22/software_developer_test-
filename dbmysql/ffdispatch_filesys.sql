-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 13, 2022 at 12:11 PM
-- Server version: 5.7.38
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ffdispatch_filesys`
--

-- --------------------------------------------------------

--
-- Table structure for table `file_system`
--

CREATE TABLE `file_system` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `type` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_system`
--

INSERT INTO `file_system` (`id`, `name`, `pid`, `type`) VALUES
(9, 'Accountant', 7, 'directory'),
(10, 'Accounting.xls', 9, 'file'),
(11, 'AnnualReport.xls', 9, 'file'),
(1, 'C', 0, 'root'),
(2, 'Documents', 1, 'directory'),
(4, 'Image1.jpg', 3, 'file'),
(5, 'Image2.jpg', 3, 'file'),
(6, 'Image3.png', 3, 'file'),
(3, 'Images', 2, 'directory'),
(8, 'Letter.doc', 7, 'file'),
(16, 'Mysql', 12, 'directory'),
(18, 'Mysql.com', 16, 'file'),
(17, 'Mysql.exe', 16, 'file'),
(12, 'Program Files', 1, 'directory'),
(15, 'Readme.txt', 13, 'file'),
(13, 'Skype', 12, 'directory'),
(14, 'Skype.exe', 13, 'file'),
(7, 'Works', 2, 'directory');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file_system`
--
ALTER TABLE `file_system`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`,`pid`,`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file_system`
--
ALTER TABLE `file_system`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
