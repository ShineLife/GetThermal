-- phpMyAdmin SQL Dump
-- version 4.9.2deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 16, 2020 at 11:04 PM
-- Server version: 10.3.22-MariaDB-1
-- PHP Version: 7.3.12-1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `temperature`
--

-- --------------------------------------------------------

--
-- Table structure for table `temperature`
--

CREATE TABLE `temperature` (
  `id` int(11) NOT NULL,
  `value` double NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `temperature`
--

INSERT INTO `temperature` (`id`, `value`, `date`, `image`) VALUES
(0, 37.299999, '2020-02-16 23:04:22', ''),
(0, 37.360001, '2020-02-16 23:04:23', ''),
(0, 37.299999, '2020-02-16 23:04:24', ''),
(0, 37.02, '2020-02-16 23:04:24', ''),
(0, 37.209999, '2020-02-16 23:04:25', ''),
(0, 37.189999, '2020-02-16 23:04:26', ''),
(0, 37.099998, '2020-02-16 23:04:27', ''),
(0, 37.150002, '2020-02-16 23:04:28', ''),
(0, 37.040001, '2020-02-16 23:04:28', ''),
(0, 37.060001, '2020-02-16 23:04:29', ''),
(0, 37.099998, '2020-02-16 23:04:30', ''),
(0, 36.889999, '2020-02-16 23:04:31', ''),
(0, 37.060001, '2020-02-16 23:04:31', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
