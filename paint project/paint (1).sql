-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2024 at 09:06 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paint`
--

-- --------------------------------------------------------

--
-- Table structure for table `art`
--

CREATE TABLE `art` (
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `art`
--

INSERT INTO `art` (`type`) VALUES
('image'),
('painting'),
('frame'),
('black and white');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `username` varchar(100) NOT NULL,
  `password` varchar(10) NOT NULL,
  `user_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`username`, `password`, `user_type`) VALUES
('artist', '123', 'paint'),
('hari', '123', 'customer'),
('Prakash', '123', 'paint'),
('siva', '123', 'customer'),
('sutharsan', '123', 'paint');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `username` varchar(100) NOT NULL,
  `art_types` varchar(100) NOT NULL,
  `user_img` varchar(100) NOT NULL,
  `location` varchar(300) NOT NULL,
  `delivery_date` date NOT NULL,
  `amount` int(11) NOT NULL,
  `amount_type` varchar(100) NOT NULL,
  `d_id` int(11) NOT NULL DEFAULT 1,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`username`, `art_types`, `user_img`, `location`, `delivery_date`, `amount`, `amount_type`, `d_id`, `status`, `description`) VALUES
('artist', 'image', '', 'qwertyu', '2024-04-12', 500, 'Ready cash', 1, 'complete', 'jhjgv'),
('artist', 'j', '9628f66c2ff48d0e5ceb375f0ac87ca7.png', 'nm,', '2024-04-11', 400, 'Online', 2, 'pending', 'klnl'),
('artist', 'frame', '', 'nm,', '2024-04-26', 2000, 'Online', 3, 'pending', 'klnl'),
('artist', 'frame', '', 'nm,', '2024-04-13', 500, 'Online', 4, 'pending', 'klnl'),
('artist', 'frame', '', 'nm,', '2024-04-12', 700, 'Online', 5, 'pending', 'klnl'),
('artist', 'painting', '', 'nm,', '2024-04-14', 500, 'Online', 6, 'pending', 'klnl'),
('artist', 'black and white', '9628f66c2ff48d0e5ceb375f0ac87ca7.png', 'thanjavur', '2024-04-16', 1000, 'Ready cash', 7, 'pending', 'black'),
('artist', 'frame', 'image1.png', 'kumbakonam', '2024-04-27', 500, 'gpay', 8, 'pending', 'food'),
('artist', 'frame', '', 'kumbakonam', '2024-04-17', 500, 'gpay', 9, 'pending', 'food'),
('artist', 'image', '', 'kumbakonam', '2024-04-29', 500, 'gpay', 10, 'pending', 'travel'),
('artist', 'painting', '', 'kumbakonam', '2024-04-14', 5000, 'gpay', 11, 'pending', 'moon'),
('hari', 'painting', '', 'kumbakonam', '2024-04-18', 5000, 'gpay', 12, 'pending', 'moon'),
('hari', 'pencil', 'item1.png', 'kumbakonam', '2024-04-19', 3200, 'Online', 13, 'pending', 'klnl'),
('hari', 'paint', '', 'kumbakonam', '2024-04-25', 3000, 'Online', 14, 'pending', 's'),
('hari', 'watercolor', '', 'kumbakonam', '2024-04-19', 3200, 'Online', 15, 'pending', 's');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `d_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `description` varchar(250) NOT NULL,
  `qr` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`d_id`, `username`, `status`, `description`, `qr`) VALUES
(1, 'hari', 'accept', '', ''),
(9, 'hari', 'request', '', ''),
(6, 'sutharsan', 'request', '', ''),
(7, 'sutharsan', 'request', '', ''),
(3, 'hari', 'accept', '', ''),
(2, 'hari', 'accept', '', ''),
(12, 'artist', 'request', '', ''),
(13, 'artist', 'request', 'food', 'item4.png');

-- --------------------------------------------------------

--
-- Table structure for table `signup`
--

CREATE TABLE `signup` (
  `username` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `phone` int(11) NOT NULL,
  `street` varchar(100) NOT NULL,
  `landmark` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `signup`
--

INSERT INTO `signup` (`username`, `dob`, `phone`, `street`, `landmark`, `district`, `state`) VALUES
('sutharsan', '2003-09-17', 2147483647, 'kavari street', 'rasi mahal', 'thanjavur', 'tamilnadu'),
('hari', '2024-04-16', 2147483647, 'ig street', 'kum', 'thanjavur', 'tamilnadu'),
('gokul', '2003-09-21', 2147483647, 'ign street', 'bus stop', 'thanjavur', 'tamilnadu'),
('Prakash', '2017-06-06', 2147483647, 'ign street', 'bus stop', 'thanjavur', 'tamilnadu'),
('siva', '2024-04-02', 2147483647, 'ign street', 'bus stop', 'thanjavur', 'Tamil Nadu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
