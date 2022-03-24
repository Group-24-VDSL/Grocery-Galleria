-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2022 at 03:58 AM
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
CREATE DATABASE IF NOT EXISTS `ggproject` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `ggproject`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `cancelOrder`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `cancelOrder` (IN `ID` INT)  UPDATE temporarycart tc
                                                                         SET tc.Purchased=0
                                                                         WHERE
                                                                                                          tc.CustomerID=ID$$

DROP PROCEDURE IF EXISTS `checkStock`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `checkStock` (IN `ID` INT)  UPDATE temporarycart tc
                                                                            JOIN shopitem si ON
                                                                            si.ItemID=tc.ItemID AND si.ShopID=tc.ShopID
                                                                            SET tc.Purchased=1
                                                                        WHERE
                                                                            tc.CustomerID=ID AND
                                                                            (si.Stock-tc.Quantity) > 0$$

DROP PROCEDURE IF EXISTS `email_update`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `email_update` (IN `Id` INT, IN `Mail` VARCHAR(55))  BEGIN
UPDATE `login` SET `Email`=Mail WHERE `UserID`=Id;
END$$

DROP PROCEDURE IF EXISTS `fullfillOrder`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `fullfillOrder` (IN `ID` INT, IN `Note` VARCHAR(1000) CHARSET utf8, IN `Recipient_Name` VARCHAR(100) CHARSET utf8, IN `Recipient_Num` VARCHAR(100) CHARSET utf8, IN `Delivery_Fee` FLOAT, IN `Total_Price` FLOAT)  BEGIN
DECLARE cartid INT DEFAULT 0;
DECLARE orderid INT DEFAULT 0;
INSERT INTO `cart` (CustomerID) VALUE (ID);
SET @cartid = LAST_INSERT_ID();

INSERT INTO `orders` (CartID,RecipientName,Note,RecipientContact,DeliveryCost,TotalCost) VALUES (@cartid,Recipient_Name,Note,Recipient_Num,Delivery_Fee,Total_Price);
SET @orderid = LAST_INSERT_ID();
INSERT INTO `ordercart` (CartID,ShopID,ItemID,Quantity,Total)
SELECT @cartid AS CartID,tc.ShopID,tc.ItemID,tc.Quantity,(si.UnitPrice*tc.Quantity) AS Total from `temporarycart` AS tc
                                                                                                      INNER JOIN `shopitem`AS si ON si.ShopID=tc.ShopID AND tc.ItemID=si.ItemID
WHERE tc.Purchased=1 AND tc.CustomerID=ID;

INSERT INTO `shoporder` (ShopID,CartID,ShopTotal)
SELECT  tc.ShopID,@cartid AS CartID,SUM(si.UnitPrice*tc.Quantity) from `temporarycart` AS tc
                                                                           INNER JOIN `shopitem`AS si ON si.ShopID=tc.ShopID AND si.ItemID=tc.ItemID
WHERE tc.Purchased=1 AND tc.CustomerID=ID GROUP BY tc.ShopID;

UPDATE `shopitem` si
    JOIN temporarycart tc ON
    tc.ItemID=si.ItemID AND tc.ShopID=si.ShopID
    SET si.Stock=(si.Stock-tc.Quantity)
WHERE
    tc.CustomerID=ID AND
    (si.Stock-tc.Quantity) > 0 AND
    tc.Purchased=1;

DELETE FROM `temporarycart` WHERE Purchased=1 AND CustomerID=ID;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
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

DROP TABLE IF EXISTS `complaint`;
CREATE TABLE `complaint` (
  `ComplaintID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `Nature` varchar(555) COLLATE utf8mb4_bin NOT NULL,
  `OrderDate` text COLLATE utf8mb4_bin NOT NULL,
  `ComplaintDate` text COLLATE utf8mb4_bin NOT NULL,
  `SpecialDetails` varchar(500) COLLATE utf8mb4_bin NOT NULL,
  `Priority` tinyint(1) NOT NULL,
  `Regarding` tinyint(1) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
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

DROP TABLE IF EXISTS `delivery`;
CREATE TABLE `delivery` (
  `DeliveryID` int(11) NOT NULL,
  `RiderID` int(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` tinyint(1) NOT NULL,
  `CompTime` timestamp NULL DEFAULT NULL,
  `OrderID` int(11) NOT NULL,
  `CartID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryrider`
--

DROP TABLE IF EXISTS `deliveryrider`;
CREATE TABLE `deliveryrider` (
  `RiderID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Email` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `ContactNo` varchar(25) COLLATE utf8mb4_bin NOT NULL,
  `NIC` varchar(25) COLLATE utf8mb4_bin NOT NULL,
  `ProfilePic` varchar(255) COLLATE utf8mb4_bin NOT NULL DEFAULT '/public/img/placeholder-150.png',
  `City` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `Suburb` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `RiderType` int(11) NOT NULL DEFAULT 0,
  `Status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `deliveryriderlocation`
--

DROP TABLE IF EXISTS `deliveryriderlocation`;
CREATE TABLE `deliveryriderlocation` (
  `RiderID` int(11) NOT NULL,
  `LocationLat` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `LocationLng` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `LastUpdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `OrderID` int(11) DEFAULT NULL,
  `Status` int(11) NOT NULL DEFAULT 0
) ENGINE=MEMORY DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `deliverystaff`
--

DROP TABLE IF EXISTS `deliverystaff`;
CREATE TABLE `deliverystaff` (
  `StaffID` int(11) NOT NULL,
  `Name` varchar(200) COLLATE utf8mb4_bin NOT NULL,
  `ContactNo` varchar(20) COLLATE utf8mb4_bin NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `City` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `Suburb` varchar(100) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `ItemID` int(11) NOT NULL,
  `Name` varchar(125) COLLATE utf8mb4_bin NOT NULL,
  `ItemImage` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Brand` varchar(125) COLLATE utf8mb4_bin DEFAULT NULL,
  `UWeight` double NOT NULL,
  `Unit` int(11) NOT NULL,
  `MRP` double DEFAULT 0,
  `MaxCount` float NOT NULL DEFAULT 0,
  `Category` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE `login` (
  `UserID` int(11) NOT NULL,
  `Email` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `PasswordHash` varchar(500) COLLATE utf8mb4_bin NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_bin NOT NULL,
  `Verify_Flag` tinyint(1) NOT NULL DEFAULT 0,
  `Delete_Flag` tinyint(1) NOT NULL DEFAULT 0,
  `Role` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `City` int(11) DEFAULT NULL,
  `Suburb` int(11) DEFAULT NULL,
  `RegTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `ordercart`
--

DROP TABLE IF EXISTS `ordercart`;
CREATE TABLE `ordercart` (
  `CartID` int(11) NOT NULL,
  `ShopID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `Quantity` double NOT NULL,
  `Total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `OrderID` int(11) NOT NULL,
  `CartID` int(11) NOT NULL,
  `OrderDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `RecipientName` varchar(100) COLLATE utf8mb4_bin DEFAULT NULL,
  `Note` varchar(1000) COLLATE utf8mb4_bin DEFAULT NULL,
  `RecipientContact` varchar(10) COLLATE utf8mb4_bin DEFAULT NULL,
  `DeliveryCost` float NOT NULL,
  `TotalCost` float NOT NULL,
  `Status` int(11) NOT NULL,
  `City` int(11) NOT NULL,
  `Suburb` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `TotalPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

DROP TABLE IF EXISTS `shop`;
CREATE TABLE `shop` (
  `ShopID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Email` varchar(55) COLLATE utf8mb4_bin NOT NULL,
  `ContactNo` varchar(25) COLLATE utf8mb4_bin NOT NULL,
  `City` int(11) NOT NULL,
  `Suburb` int(11) NOT NULL,
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

DROP TABLE IF EXISTS `shopitem`;
CREATE TABLE `shopitem` (
  `ItemID` int(11) NOT NULL,
  `ShopID` int(11) NOT NULL,
  `UnitPrice` double NOT NULL,
  `Stock` float NOT NULL,
  `MaxLeadTime` int(11) NOT NULL,
  `MinLeadTime` int(11) NOT NULL,
  `Enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `shopitemsales`
--

DROP TABLE IF EXISTS `shopitemsales`;
CREATE TABLE `shopitemsales` (
  `ItemID` int(11) NOT NULL,
  `ShopID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `shoporder`
--

DROP TABLE IF EXISTS `shoporder`;
CREATE TABLE `shoporder` (
  `ShopID` int(11) NOT NULL,
  `CartID` int(11) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `ShopTotal` float NOT NULL,
  `Status` int(11) NOT NULL,
  `CompleteDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `ContactNo` varchar(25) COLLATE utf8mb4_bin NOT NULL,
  `Email` varchar(55) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `temporarycart`
--

DROP TABLE IF EXISTS `temporarycart`;
CREATE TABLE `temporarycart` (
  `ItemID` int(11) NOT NULL,
  `ShopID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Purchased` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- Table structure for table `verification`
--

DROP TABLE IF EXISTS `verification`;
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
  ADD KEY `RiderID` (`RiderID`,`OrderID`,`CartID`);

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
  ADD PRIMARY KEY (`CartID`,`ShopID`,`ItemID`);

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
-- Indexes for table `temporarycart`
--
ALTER TABLE `temporarycart`
  ADD PRIMARY KEY (`ItemID`,`ShopID`,`CustomerID`);

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
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT;

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

DELIMITER $$
--
-- Events
--
DROP EVENT IF EXISTS `itemSales`$$
CREATE DEFINER=`root`@`localhost` EVENT `itemSales` ON SCHEDULE EVERY 1 MONTH STARTS '2021-12-29 02:40:36' ENDS '2023-01-28 02:40:36' ON COMPLETION PRESERVE ENABLE DO INSERT INTO shopitemsales
SELECT ordercart.ItemID, ordercart.ShopID, ordercart.Quantity y, shoporder.Date
FROM ordercart
         INNER JOIN shoporder ON ordercart.CartID = shoporder.CartID AND ordercart.ShopID = shoporder.ShopID
WHERE shoporder.Date > DATE (DATE_SUB(now()
    , INTERVAL DAYOFMONTH(now())-0 DAY)- INTERVAL 12 MONTH)
  AND shoporder.Date
    < DATE (DATE_SUB(now()
    , INTERVAL DAYOFMONTH(now())-1 DAY))$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
