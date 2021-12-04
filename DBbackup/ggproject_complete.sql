-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2021 at 11:58 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

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
CREATE PROCEDURE `cancelOrder` (IN `ID` INT)  SQL SECURITY INVOKER
UPDATE temporarycart tc
SET tc.Purchased=0
WHERE
        tc.CustomerID=ID$$

DROP PROCEDURE IF EXISTS `checkStock`$$
CREATE PROCEDURE `checkStock` (IN `ID` INT)  SQL SECURITY INVOKER
UPDATE temporarycart tc
    JOIN shopitem si ON
    si.ItemID=tc.ItemID AND si.ShopID=tc.ShopID
    SET tc.Purchased=1
WHERE
    tc.CustomerID=ID AND
    (si.Stock-tc.Quantity) > 0$$

DROP PROCEDURE IF EXISTS `fullfillOrder`$$
CREATE PROCEDURE `fullfillOrder` (IN `ID` INT, IN `Note` VARCHAR(1000) CHARSET utf8, IN `Recipient_Name` VARCHAR(100) CHARSET utf8, IN `Recipient_Num` VARCHAR(100) CHARSET utf8, IN `Delivery_Fee` FLOAT, IN `Total_Price` FLOAT)  SQL SECURITY INVOKER
BEGIN
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
                        `CustomerID` int(11) NOT NULL,
                        `DateTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Truncate table before insert `cart`
--

TRUNCATE TABLE `cart`;
--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `CustomerID`, `DateTime`) VALUES
                                                            (1, 7, '2021-10-23 09:38:23'),
                                                            (2, 3, '2021-12-03 13:24:20'),
                                                            (3, 7, '2021-12-03 17:12:10'),
                                                            (4, 7, '2021-12-04 10:11:49');

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
                             `OrderDate` date NOT NULL,
                             `ComplaintDate` date NOT NULL,
                             `SpecialDetails` varchar(500) COLLATE utf8mb4_bin NOT NULL,
                             `Prority` tinyint(1) NOT NULL,
                             `Regarding` tinyint(1) NOT NULL,
                             `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Truncate table before insert `complaint`
--

TRUNCATE TABLE `complaint`;
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

--
-- Truncate table before insert `customer`
--

TRUNCATE TABLE `customer`;
--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Name`, `Address`, `Email`, `ContactNo`, `City`, `Suburb`, `Location`, `PlaceID`) VALUES
                                                                                                                            (2, 'Customer One', 'Address eka', 'customer1@gmail.com', '0332222548', 'Colombo', 'Colombo', '{&quot;lat&quot;:6.943458914658162,&quot;lng&quot;:79.9875427734375}', ''),
                                                                                                                            (7, 'Customer Two', 'Address eka', 'customer2@mailinator.com', '0713004458', 'Colombo', 'Colombo', '{&quot;lat&quot;:6.932553034671361,&quot;lng&quot;:79.97106328125}', 'GhIJkSVzLO-6G0ARIvau5iX-U0A');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
CREATE TABLE `delivery` (
                            `DeliveryID` int(11) NOT NULL,
                            `RiderID` int(11) NOT NULL,
                            `Date` date NOT NULL,
                            `Status` int(11) NOT NULL,
                            `CompDate` date DEFAULT NULL,
                            `CompTime` time DEFAULT NULL,
                            `OrderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Truncate table before insert `delivery`
--

TRUNCATE TABLE `delivery`;
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
                                 `ProfilePic` varchar(255) COLLATE utf8mb4_bin NOT NULL,
                                 `RiderType` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Truncate table before insert `deliveryrider`
--

TRUNCATE TABLE `deliveryrider`;
--
-- Dumping data for table `deliveryrider`
--

INSERT INTO `deliveryrider` (`RiderID`, `Name`, `Address`, `Email`, `ContactNo`, `NIC`, `ProfilePic`, `RiderType`) VALUES
    (9, 'Rider One', 'Address eka', 'rider1@gmail.com', '0715555468', '981557852V', '/public/img/placeholder-150.png', 0);

-- --------------------------------------------------------

--
-- Table structure for table `deliveryriderlocation`
--

DROP TABLE IF EXISTS `deliveryriderlocation`;
CREATE TABLE `deliveryriderlocation` (
                                         `RiderID` int(11) NOT NULL,
                                         `Location` varchar(255) COLLATE utf8mb4_bin NOT NULL,
                                         `LastUpdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
                                         `OrderID` int(11) DEFAULT NULL
) ENGINE=MEMORY DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Truncate table before insert `deliveryriderlocation`
--

TRUNCATE TABLE `deliveryriderlocation`;
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

--
-- Truncate table before insert `deliverystaff`
--

TRUNCATE TABLE `deliverystaff`;
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
                        `Category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Truncate table before insert `item`
--

TRUNCATE TABLE `item`;
--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemID`, `Name`, `ItemImage`, `Brand`, `UWeight`, `Unit`, `MRP`, `MaxCount`, `Category`) VALUES
                                                                                                                  (1, 'Brinjol', '/img/product-imgs/9500000.jpg', '', 300, 0, 310, 10, 0),
                                                                                                                  (2, 'Beetroot', '/img/product-imgs/9500001.jpg', '', 200, 0, 110, 6, 0),
                                                                                                                  (3, 'Cabbage', '/img/product-imgs/9500002.jpg', '', 300, 0, 170, 4, 0),
                                                                                                                  (4, 'Capsicum', '/img/product-imgs/9500003.jpg', '', 300, 0, 400, 5, 0),
                                                                                                                  (5, 'Carrot', '/img/product-imgs/9500004.jpg', '', 300, 0, 190, 10, 0),
                                                                                                                  (6, 'Green beans', '/img/product-imgs/9500005.jpg', '', 300, 0, 390, 10, 0),
                                                                                                                  (7, 'Cucumber', '/img/product-imgs/9500006.jpg', '', 500, 0, 120, 5, 0),
                                                                                                                  (8, 'Knol Khol', '/img/product-imgs/9500007.jpg', '', 300, 0, 210, 5, 0),
                                                                                                                  (9, 'Leeks', '/img/product-imgs/9500008.jpg', '', 300, 0, 280, 10, 0),
                                                                                                                  (10, 'Drumsticks', '/img/product-imgs/9500009.jpg', '', 300, 0, 330, 5, 0),
                                                                                                                  (11, 'Potatoes', '/img/product-imgs/9500010.jpg', '', 500, 0, 190, 8, 0),
                                                                                                                  (12, 'Tomatoes', '/img/product-imgs/9500011.jpg', '', 300, 0, 140, 4, 0),
                                                                                                                  (13, 'Green Chilies', '/img/product-imgs/9500012.jpg', '', 100, 0, 280, 20, 0);

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
                         `Role` varchar(10) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Truncate table before insert `login`
--

TRUNCATE TABLE `login`;
--
-- Dumping data for table `login`
--

INSERT INTO `login` (`UserID`, `Email`, `PasswordHash`, `Name`, `Verify_Flag`, `Delete_Flag`, `Role`) VALUES
                                                                                                          (2, 'customer1@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Customer One', 1, 0, 'Customer'),
                                                                                                          (3, 'shop1@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Shop One', 1, 0, 'Shop'),
                                                                                                          (4, 'shop2@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Shop Two', 1, 0, 'Shop'),
                                                                                                          (5, 'shop3@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Shop Three', 0, 0, 'Shop'),
                                                                                                          (7, 'customer2@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Customer Two', 1, 0, 'Customer'),
                                                                                                          (8, 'delivery1@gmail.com', '$2y$10$t0N5xYthgYV63x9DKNxFH.RipNC9S.KNJK/QLw0sSNAK9Sk4x4Sfu', 'Delivery One', 1, 0, 'Delivery'),
                                                                                                          (9, 'rider1@gmail.com', '$2y$10$t0N5xYthgYV63x9DKNxFH.RipNC9S.KNJK/QLw0sSNAK9Sk4x4Sfu', 'Rider One', 1, 0, 'Rider'),
                                                                                                          (10, 'staff1@gmail.com', '$2y$10$t0N5xYthgYV63x9DKNxFH.RipNC9S.KNJK/QLw0sSNAK9Sk4x4Sfu', 'Staff One', 1, 0, 'Staff');

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

--
-- Truncate table before insert `ordercart`
--

TRUNCATE TABLE `ordercart`;
--
-- Dumping data for table `ordercart`
--

INSERT INTO `ordercart` (`CartID`, `ShopID`, `ItemID`, `Quantity`, `Total`) VALUES
                                                                                (1, 5, 1, 10, 500),
                                                                                (1, 5, 2, 14, 4000),
                                                                                (1, 5, 3, 5, 1002),
                                                                                (3, 4, 12, 50, 7100),
                                                                                (3, 5, 7, 10, 1100),
                                                                                (3, 5, 8, 20, 6000);

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
                          `TotalCost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Truncate table before insert `orders`
--

TRUNCATE TABLE `orders`;
--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CartID`, `OrderDate`, `RecipientName`, `Note`, `RecipientContact`, `DeliveryCost`, `TotalCost`) VALUES
                                                                                                                                      (1, 1, '2021-10-23 09:00:00', NULL, NULL, NULL, 140, 1500),
                                                                                                                                      (2, 3, '2021-12-03 17:12:10', '\"Hellow\"', '\"Something\"', '\"076764854', 160, 2000),
                                                                                                                                      (3, 4, '2021-12-04 10:11:49', 'Test2', 'Test', '0764854828', 120, 1500);

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

--
-- Truncate table before insert `payment`
--

TRUNCATE TABLE `payment`;
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
                        `City` varchar(55) COLLATE utf8mb4_bin NOT NULL,
                        `Suburb` varchar(55) COLLATE utf8mb4_bin NOT NULL,
                        `ShopName` varchar(125) COLLATE utf8mb4_bin NOT NULL,
                        `ShopDesc` varchar(255) COLLATE utf8mb4_bin NOT NULL,
                        `Category` int(11) NOT NULL,
                        `Location` varchar(255) COLLATE utf8mb4_bin NOT NULL,
                        `PlaceID` varchar(1000) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Truncate table before insert `shop`
--

TRUNCATE TABLE `shop`;
--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`ShopID`, `Name`, `Address`, `Email`, `ContactNo`, `City`, `Suburb`, `ShopName`, `ShopDesc`, `Category`, `Location`, `PlaceID`) VALUES
                                                                                                                                                        (4, 'Shop Two', 'Address Eka', 'shop2@gmail.com', '0701122412', 'Colombo', 'Colombo', 'Kalinga Stores', 'Fresh Stuff', 0, '{&quot;lat&quot;:6.938006006240303,&quot;lng&quot;:79.916131640625}', 'ChIJI4abT9RZ4joR83K0Sg1HrtI'),
                                                                                                                                                        (5, 'Shop Three', '22/2 Old Kesbewa Road, Nugegoda.', 'shop3@gmail.com', '0778571737', 'Colombo', 'Colombo', 'Senarath Grocery', 'Farm Fresh Goods', 0, '{&quot;lat&quot;:6.8672672,&quot;lng&quot;:79.8856714}', 'ChIJr_pa_k9a4joR0Lc1vOefaMQ');

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
                            `Enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Truncate table before insert `shopitem`
--

TRUNCATE TABLE `shopitem`;
--
-- Dumping data for table `shopitem`
--

INSERT INTO `shopitem` (`ItemID`, `ShopID`, `UnitPrice`, `Stock`, `Enabled`) VALUES
                                                                                 (1, 5, 280, 20, 0),
                                                                                 (2, 5, 100, 20, 0),
                                                                                 (3, 5, 150, 20, 1),
                                                                                 (4, 5, 380, 10, 1),
                                                                                 (5, 5, 190, 5, 0),
                                                                                 (6, 5, 380, 20, 1),
                                                                                 (7, 5, 110, 200, 1),
                                                                                 (8, 5, 300, 250, 1),
                                                                                 (11, 4, 125, 150, 0),
                                                                                 (12, 4, 142, 100, 1),
                                                                                 (13, 4, 112, 90, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shoporder`
--

DROP TABLE IF EXISTS `shoporder`;
CREATE TABLE `shoporder` (
                             `ShopID` int(11) NOT NULL,
                             `CartID` int(11) NOT NULL,
                             `Date` date NOT NULL DEFAULT current_timestamp(),
                             `ShopTotal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Truncate table before insert `shoporder`
--

TRUNCATE TABLE `shoporder`;
--
-- Dumping data for table `shoporder`
--

INSERT INTO `shoporder` (`ShopID`, `CartID`, `Date`, `ShopTotal`) VALUES
                                                                      (4, 3, '2021-12-03', 7100),
                                                                      (5, 3, '2021-12-03', 7100);

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

--
-- Truncate table before insert `staff`
--

TRUNCATE TABLE `staff`;
--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `Name`, `Address`, `ContactNo`, `Email`) VALUES
    (10, 'Staff One', 'Address Eka', '0714584685', 'staff1@gmail.com');

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

--
-- Truncate table before insert `temporarycart`
--

TRUNCATE TABLE `temporarycart`;
--
-- Dumping data for table `temporarycart`
--

INSERT INTO `temporarycart` (`ItemID`, `ShopID`, `CustomerID`, `Quantity`, `Purchased`) VALUES
                                                                                            (1, 5, 2, 10, 1),
                                                                                            (2, 5, 2, 2, 1),
                                                                                            (3, 5, 2, 4, 1),
                                                                                            (5, 5, 2, 8, 0),
                                                                                            (6, 5, 2, 4, 1),
                                                                                            (7, 5, 2, 2, 1),
                                                                                            (7, 5, 7, 10, 0),
                                                                                            (8, 5, 7, 20, 0),
                                                                                            (12, 4, 2, 1, 1),
                                                                                            (12, 4, 7, 50, 0),
                                                                                            (13, 4, 2, 11, 1);

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
-- Truncate table before insert `verification`
--

TRUNCATE TABLE `verification`;
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
    MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
    MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
    MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
    MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
    MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
    MODIFY `ShopID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
