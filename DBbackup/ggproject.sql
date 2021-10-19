-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2021 at 01:55 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

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
CREATE DATABASE IF NOT EXISTS `ggproject` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `ggproject`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `CustomerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
                             `ComplaintID` int(11) NOT NULL,
                             `CustomerID` int(11) NOT NULL,
                             `StaffID` int(11) NOT NULL,
                             `OrderID` int(11) NOT NULL,
                             `Nature` varchar(555) COLLATE utf8mb4_bin NOT NULL,
                             `OrderDate` date NOT NULL,
                             `ComplaintDate` date NOT NULL,
                             `SpecialDetails` varchar(500) COLLATE utf8mb4_bin NOT NULL,
                             `Prority` tinyint(1) NOT NULL,
                             `Regarding` tinyint(1) NOT NULL,
                             `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `CustomerID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Email` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `ContactNo` varchar(25) COLLATE utf8mb4_bin NOT NULL,
  `City` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `Suburb` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `Location` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `PlaceID` varchar(1000) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `DeliveryID` int(11) NOT NULL,
  `RiderID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Status` int(11) NOT NULL,
  `CompDate` date DEFAULT NULL,
  `CompTime` time DEFAULT NULL,
  `OrderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryrider`
--

CREATE TABLE `deliveryrider` (
  `RiderID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Email` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `ContactNo` varchar(25) COLLATE utf8mb4_bin NOT NULL,
  `NIC` varchar(25) COLLATE utf8mb4_bin NOT NULL,
  `ProfilePic` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `RiderType` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryriderlocation`
--

CREATE TABLE `deliveryriderlocation` (
  `RiderID` int(11) NOT NULL,
  `Location` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MEMORY DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `ItemID` int(11) NOT NULL,
  `Name` varchar(125) COLLATE utf8mb4_bin NOT NULL,
  `ItemImage` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Brand` varchar(125) COLLATE utf8mb4_bin DEFAULT NULL,
  `UWeight` double NOT NULL,
  `Unit` int(11) NOT NULL,
  `MRP` double DEFAULT 0,
  `MaxCount` float NOT NULL DEFAULT 0,
  `Category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemID`, `Name`, `ItemImage`, `Brand`, `UWeight`, `Unit`, `MRP`, `MaxCount`, `Category`) VALUES
(1, 'Potato', '/img/product-imgs/9500000.jpg', '', 1, 0, 160, 5, 0),
(2, 'Big Onion', '/img/product-imgs/9500001.jpg', '', 1, 0, 120, 5, 1),
(3, 'Tomato', '/img/product-imgs/9500002.jpg', '', 1, 0, 200, 5, 1),
(4, 'Carrot', '/img/product-imgs/9500003.jpg', '', 1, 0, 120, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `UserID` int(11) NOT NULL,
  `Email` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `PasswordHash` varchar(500) COLLATE utf8mb4_bin NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `Verify_Flag` tinyint(1) NOT NULL DEFAULT 0,
  `Delete_Flag` tinyint(1) NOT NULL DEFAULT 0,
  `Role` varchar(10) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`UserID`, `Email`, `PasswordHash`, `Name`, `Verify_Flag`, `Delete_Flag`, `Role`) VALUES
    (2, 'sandunisandeepa1@gmail.com', '$2y$10$tC4L/GAcCFLchV3/.mVd0uu7adCT6FEi7p5S7i9wshCpVYxtlxd1C', 'Vindy', 0, 0, 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `ordercart`
--

CREATE TABLE `ordercart` (
  `CartID` int(11) NOT NULL,
  `ShopID` int(11) NOT NULL,
  `ItemIDList` varchar(555) COLLATE utf8mb4_bin NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `QuantityList` varchar(555) COLLATE utf8mb4_bin NOT NULL,
  `ShopTotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
                          `OrderID` int(11) NOT NULL,
                          `CartID` int(11) NOT NULL,
                          `OrderDate` date NOT NULL,
                          `DeliveryCost` float NOT NULL,
                          `TotalCost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `TotalPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `ShopID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Email` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `ContactNo` varchar(25) COLLATE utf8mb4_bin NOT NULL,
  `City` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `Suburb` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `ShopName` varchar(125) COLLATE utf8mb4_bin NOT NULL,
  `ShopDesc` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Category` int(11) NOT NULL,
  `Location` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `PlaceID` varchar(1000) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `shopitem`
--

CREATE TABLE `shopitem` (
  `ItemID` int(11) NOT NULL,
  `ShopID` int(11) NOT NULL,
  `UnitPrice` double NOT NULL,
  `Stock` float NOT NULL,
  `Enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `shoporder`
--

CREATE TABLE `shoporder` (
  `ShopID` int(11) NOT NULL,
  `CartID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `ShopTotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
                         `StaffID` int(11) NOT NULL,
                         `Name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
                         `ContactNo` varchar(25) COLLATE utf8mb4_bin NOT NULL,
                         `Email` varchar(55) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

CREATE TABLE `verification` (
  `UserID` int(11) NOT NULL,
  `VerificationCode` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `UniqueID` varchar(100) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CartID`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`ComplaintID`) USING BTREE,
  ADD KEY `ComplaintID` (`ComplaintID`,`CustomerID`,`StaffID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`DeliveryID`),
  ADD KEY `RiderID` (`RiderID`,`OrderID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `deliveryrider`
--
ALTER TABLE `deliveryrider`
  ADD PRIMARY KEY (`RiderID`);

--
-- Indexes for table `deliveryriderlocation`
--
ALTER TABLE `deliveryriderlocation`
  ADD PRIMARY KEY (`RiderID`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`ItemID`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `ordercart`
--
ALTER TABLE `ordercart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `ShopID` (`ShopID`,`CustomerID`) USING BTREE;

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `CartID` (`CartID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `OrderID` (`OrderID`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`ShopID`);

--
-- Indexes for table `shopitem`
--
ALTER TABLE `shopitem`
  ADD PRIMARY KEY (`ItemID`,`ShopID`),
  ADD KEY `ShopID` (`ShopID`);

--
-- Indexes for table `shoporder`
--
ALTER TABLE `shoporder`
  ADD PRIMARY KEY (`ShopID`,`CartID`),
  ADD KEY `CartID` (`CartID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`);

--
-- Indexes for table `verification`
--
ALTER TABLE `verification`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `UniqueID` (`UniqueID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `ComplaintID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `DeliveryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
    MODIFY `ShopID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
