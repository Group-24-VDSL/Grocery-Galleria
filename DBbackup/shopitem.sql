-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 08:27 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ggproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `shopitem`
--

CREATE TABLE `shopitem` (
  `ItemID` int(11) NOT NULL,
  `ShopID` int(11) NOT NULL,
  `UnitPrice` double NOT NULL,
  `Stock` float NOT NULL,
  `MaxLeadTime` int(11) NOT NULL,
  `MinLeadTime` int(11) NOT NULL,
  `Enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Truncate table before insert `shopitem`
--

TRUNCATE TABLE `shopitem`;
--
-- Dumping data for table `shopitem`
--

INSERT INTO `shopitem` (`ItemID`, `ShopID`, `UnitPrice`, `Stock`, `MaxLeadTime`, `MinLeadTime`, `Enabled`) VALUES
(1, 15, 250, 100, 1, 1, 1),
(1, 16, 260, 100, 1, 1, 1),
(2, 15, 200, 100, 1, 1, 1),
(2, 16, 205, 100, 1, 1, 1),
(3, 15, 160, 100, 1, 1, 1),
(4, 15, 290, 100, 1, 1, 1),
(5, 15, 350, 100, 1, 1, 1),
(8, 16, 290, 100, 1, 1, 1),
(9, 16, 90, 100, 1, 1, 1),
(14, 17, 100, 100, 1, 1, 1),
(15, 17, 40, 100, 1, 1, 1),
(16, 17, 220, 100, 1, 1, 1),
(17, 4, 400, 100, 1, 1, 1),
(18, 4, 75, 75, 1, 1, 1),
(20, 4, 435, 100, 1, 1, 1),
(21, 19, 400, 100, 1, 1, 1),
(22, 19, 640, 100, 1, 1, 1),
(24, 19, 870, 100, 1, 1, 1),
(27, 3, 500, 100, 1, 1, 1),
(28, 3, 540, 100, 1, 1, 1),
(30, 3, 290, 440, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shopitem`
--
ALTER TABLE `shopitem`
  ADD PRIMARY KEY (`ItemID`,`ShopID`),
  ADD KEY `ShopID` (`ShopID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
