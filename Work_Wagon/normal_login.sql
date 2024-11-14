-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2023 at 08:37 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `normal_login`
--

CREATE TABLE `normal_login` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `normal_login`
--

INSERT INTO `normal_login` (`id`, `name`, `email`, `mobile_number`, `password`) VALUES
(1, 'yadhidya', 'ulliyadhidya6002@gmail.com', '8074729571', 'yadhi@1962'),
(3, 'sai', 'rrr@gmail.com', '55566545151', '12345678'),
(5, 'karthikeya', 'viratkarthikeya647@gmail.com', '6303285679', 'karthikeya'),
(6, 'saivignesh', 'rrrr@gmail.com', '9492188027', 'yadhi@1962'),
(8, 'yaddyhj', 'ulliyadhidya@gmail.com', '9030949796', 'yadhi@1962'),
(13, 'sai', 'yag@gmail.com', '9020909087', 'yadhi@1962'),
(14, 'yaddyhj', 'hhy@gmail.com', '0987654399', 'qwerty23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `normal_login`
--
ALTER TABLE `normal_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile_number` (`mobile_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `normal_login`
--
ALTER TABLE `normal_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
