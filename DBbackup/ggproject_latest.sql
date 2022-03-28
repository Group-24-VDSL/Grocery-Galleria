-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2022 at 09:17 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 8.0.11

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
CREATE DATABASE IF NOT EXISTS `ggproject` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ggproject`;

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `cancelOrder` (IN `ID` INT)  UPDATE temporarycart tc
                                                                         SET tc.Purchased=0
                                                                         WHERE
                                                                                                          tc.CustomerID=ID$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `checkStock` (IN `ID` INT)  UPDATE temporarycart tc
                                                                            JOIN shopitem si ON
                                                                            si.ItemID=tc.ItemID AND si.ShopID=tc.ShopID
                                                                            SET tc.Purchased=1
                                                                        WHERE
                                                                            tc.CustomerID=ID AND
                                                                            (si.Stock-tc.Quantity) > 0$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `email_update` (IN `Id` INT, IN `Mail` VARCHAR(55))  BEGIN
UPDATE `login` SET `Email`=Mail WHERE `UserID`=Id;
END$$

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

CREATE TABLE `cart` (
  `CartID` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `CustomerID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `Date`, `Time`, `CustomerID`) VALUES
(1, '2022-03-25', '20:10:59', 2),
(2, '2022-03-25', '20:22:06', 7),
(3, '2022-03-25', '20:26:57', 7),
(4, '2022-03-27', '11:42:46', 2);

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
  `OrderDate` text COLLATE utf8mb4_bin NOT NULL,
  `ComplaintDate` text COLLATE utf8mb4_bin NOT NULL,
  `SpecialDetails` varchar(500) COLLATE utf8mb4_bin NOT NULL,
  `Priority` tinyint(1) NOT NULL,
  `Regarding` tinyint(1) NOT NULL,
  `Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`ComplaintID`, `CustomerID`, `StaffID`, `OrderID`, `Nature`, `OrderDate`, `ComplaintDate`, `SpecialDetails`, `Priority`, `Regarding`, `Status`) VALUES
(19, 0, 0, 3, 'My Ritzbuy Revello chocalate has not been received.', '2022-03-25 20:26:57', '2022-03-26', '2022.03.26 order', 0, 0, 0);

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

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Name`, `Address`, `Email`, `ContactNo`, `City`, `Suburb`, `Location`, `PlaceID`) VALUES
(2, 'Dilshan Thenuka', '22/2 Old Kesbewa Road, Nugegoda.', 'customer1@gmail.com', '+9477 8571737', '1', '8', '{&quot;lat&quot;:6.871714052860769,&quot;lng&quot;:79.89268108720779}', 'ChIJCSTj6ENa4joReFLBb54J8rk'),
(7, 'Nadil Sankara', '22, 40 Old Kesbewa Rd, Nugegoda', 'customer2@mailinator.com', '+94774381695', '1', '8', '{&quot;lat&quot;:6.871743345215753,&quot;lng&quot;:79.89361717815399}', 'ChIJL9QBVg5b4joRH8BMOlx_Mk8');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

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

--
-- Dumping data for table `deliveryrider`
--

INSERT INTO `deliveryrider` (`RiderID`, `Name`, `Address`, `Email`, `ContactNo`, `NIC`, `ProfilePic`, `City`, `Suburb`, `RiderType`, `Status`) VALUES
(9, 'Kamal Jayawardhana', '32, Pelawatta Rd, Nugegoda', 'rider1@gmail.com', '0715555468', '981557852V', '/public/img/placeholder-150.png', '1', '8', 0, 0),
(11, 'Seenath Batagedara', '13, Edirigoda Road, Nugegoda', 'rider2@gmail.com', '0754555257', '985452455V', '/public/img/placeholder-150.png', '1', '8', 0, 0),
(12, 'Janith Jaalitha', '19 A1, Chapel Rd, Nugegoda', 'rider3@gmail.com', '0754555257', '985478545V', '/public/img/placeholder-150.png', '1', '8', 1, 0),
(13, 'Sunil Keerthi', 'Chapel Rd, Nugegoda', 'rider4@gmail.com', '0754555257', '984578645V', '/public/img/placeholder-150.png', '1', '8', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `deliveryriderlocation`
--

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

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemID`, `Name`, `ItemImage`, `Brand`, `UWeight`, `Unit`, `MRP`, `MaxCount`, `Category`, `Status`) VALUES
(1, 'Brinjol', '/img/product-imgs/9500000.jpg', '', 0.25, 0, 120, 10, 0, 1),
(2, 'Beetroot', '/img/product-imgs/9500001.jpg', '', 0.25, 0, 54, 5, 0, 1),
(3, 'Cabbage', '/img/product-imgs/9500002.jpg', '', 0.3, 0, 90, 4, 0, 1),
(4, 'Capsicum', '/img/product-imgs/9500003.jpg', '', 0.25, 0, 156, 5, 0, 1),
(5, 'Carrot', '/img/product-imgs/9500004.jpg', '', 0.25, 0, 99, 10, 0, 1),
(6, 'Green beans', '/img/product-imgs/9500005.jpg', '', 0.25, 0, 75, 20, 0, 1),
(7, 'Cucumber', '/img/product-imgs/9500006.jpg', '', 0.5, 0, 120, 5, 0, 1),
(8, 'Knol Khol', '/img/product-imgs/9500007.jpg', '', 0.5, 0, 210, 5, 0, 1),
(9, 'Leeks', '/img/product-imgs/9500008.jpg', '', 0.3, 0, 54, 10, 0, 1),
(10, 'Drumsticks', '/img/product-imgs/9500009.jpg', '', 0.25, 0, 190, 5, 0, 1),
(11, 'Potatoes', '/img/product-imgs/9500010.jpg', '', 0.25, 0, 95, 8, 0, 1),
(12, 'Tomatoes', '/img/product-imgs/9500011.jpg', '', 0.3, 0, 140, 4, 0, 1),
(13, 'Green Chilies', '/img/product-imgs/9500012.jpg', '', 0.1, 0, 61, 20, 0, 1),
(14, 'Papaya', '/img/product-imgs/9500013.jpg', '', 1.2, 0, 276, 4, 1, 1),
(15, 'Banana - Ambul', '/img/product-imgs/9500014.jpg', '', 1, 0, 130, 4, 1, 1),
(16, 'Avocado', '/img/product-imgs/9500015.jpg', '', 0.25, 0, 112.5, 10, 1, 1),
(17, 'Harischandra Kurakkan Flour 400g', '/img/product-imgs/9500016.jpg', 'Harischandra', 1, 2, 400, 10, 2, 1),
(18, 'Maliban Chocolate Cream Biscuits 100g', '/img/product-imgs/9500017.jpg', 'Maliban', 1, 2, 75, 10, 2, 1),
(19, 'Motha Jelly Mixed Fruit 100g', '/img/product-imgs/9500018.jpg', 'Motha', 1, 2, 100, 10, 2, 1),
(20, 'Marina Vegetable Oil Pack 500ml', '/img/product-imgs/9500019.jpg', 'Marina', 1, 2, 435, 10, 2, 1),
(21, 'Kumbalawa', '/img/product-imgs/9500020.jpg', '', 0.25, 0, 210, 10, 3, 1),
(22, 'Paraw Fish Slices', '/img/product-imgs/9500021.jpg', '', 0.2, 0, 335, 10, 3, 1),
(23, 'Tuna Cubes', '/img/product-imgs/9500022.jpg', '', 0.5, 0, 900, 4, 3, 1),
(24, 'Tuna Fish', '/img/product-imgs/9500023.jpg', '', 0.25, 0, 450, 5, 3, 1),
(25, 'Ritzbury Revello Milk Chocolate 170g', '/img/product-imgs/9500024.jpg', 'Ritzbury', 1, 2, 120, 10, 2, 1),
(26, 'Mdk Koththu Roti 1kg', '/img/product-imgs/9500025.jpg', 'MDK', 1, 2, 285, 10, 2, 1),
(27, 'Chicken Drumsticks Skinless', '/img/product-imgs/9500026.jpg', '', 0.25, 0, 260, 10, 4, 1),
(28, 'Chicken Full Breast Skinless', '/img/product-imgs/9500027.jpg', '', 0.25, 0, 230, 10, 4, 1),
(29, 'Chicken Gizzard', '/img/product-imgs/9500028.jpg', '', 0.25, 0, 197.5, 10, 4, 1),
(30, 'Chicken Whole Legs Skin On', '/img/product-imgs/9500029.jpg', '', 0.25, 0, 222.5, 10, 4, 1),
(31, 'Melon', '/img/product-imgs/9500030.jpg', '', 0.5, 0, 175, 10, 1, 1),
(32, 'Mandarin - Local ', '/img/product-imgs/9500031.jpg', '', 0.5, 0, 210, 10, 1, 1),
(33, 'Mango - K/C', '/img/product-imgs/9500032.jpg', '', 0.5, 0, 110, 10, 1, 1),
(34, 'Pineapple', '/img/product-imgs/9500033.jpg', '', 0.5, 0, 125, 10, 1, 1),
(35, 'Ginger', '/img/product-imgs/9500034.jpg', '', 0.25, 0, 50, 10, 0, 1),
(36, 'Revello Chocolate Milk 50g', '/img/product-imgs/9500035.jpg', 'Ritzbury', 1, 2, 120, 10, 2, 1),
(37, 'Kist Juice Apple 1L', '/img/product-imgs/9500036.jpg', 'Kist', 1, 2, 450, 10, 2, 1),
(38, 'Lakspray Full Cream Milk Powder', '/img/product-imgs/9500037.jpg', 'Lakspray', 1, 2, 660, 10, 2, 1),
(39, 'Lanka Soy Jaffna Curry 90g', '/img/product-imgs/9500038.jpg', 'Lanka Soy', 1, 2, 85, 10, 2, 1),
(40, 'Elephant House Lemonade 1.5L', '/img/product-imgs/9500039.jpg', 'Elephant House', 1, 2, 250, 5, 2, 1),
(41, 'Md Jam Wood Apple 300g', '/img/product-imgs/9500040.jpg', 'MD', 1, 2, 250, 10, 2, 1),
(42, 'Prima Instant Noodles Multipack 345g', '/img/product-imgs/9500041.jpg', 'Prima ', 1, 2, 275, 10, 2, 1),
(43, 'Harischandra Coffee', '/img/product-imgs/9500042.jpg', 'Harischandra', 1, 2, 190, 10, 2, 1);

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
  `Role` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `City` int(11) DEFAULT NULL,
  `Suburb` int(11) DEFAULT NULL,
  `RegTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`UserID`, `Email`, `PasswordHash`, `Name`, `Verify_Flag`, `Delete_Flag`, `Role`, `City`, `Suburb`, `RegTime`) VALUES
(2, 'customer1@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Dilshan Thenuka', 1, 0, 'Customer', 1, 8, '2022-03-21 14:26:18'),
(3, 'shop1@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Pussallawa Meat Shop', 1, 0, 'Shop', 1, 8, '2022-03-21 14:26:18'),
(4, 'shop2@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'D&J Mini Mart', 1, 0, 'Shop', 1, 8, '2022-03-21 14:26:18'),
(5, 'shop3@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Deli Market', 0, 0, 'Shop', 1, 8, '2022-03-21 14:26:18'),
(7, 'customer2@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Nadil Sankara', 1, 0, 'Customer', 1, 8, '2022-03-21 14:26:18'),
(8, 'delivery1@gmail.com', '$2y$10$t0N5xYthgYV63x9DKNxFH.RipNC9S.KNJK/QLw0sSNAK9Sk4x4Sfu', 'Delivery One', 1, 0, 'Delivery', 1, 8, '2022-03-21 14:26:18'),
(9, 'rider1@gmail.com', '$2y$10$t0N5xYthgYV63x9DKNxFH.RipNC9S.KNJK/QLw0sSNAK9Sk4x4Sfu', 'Kamal Jayawardhana', 1, 0, 'Rider', 1, 8, '2022-03-21 14:26:18'),
(10, 'staff1@gmail.com', '$2y$10$t0N5xYthgYV63x9DKNxFH.RipNC9S.KNJK/QLw0sSNAK9Sk4x4Sfu', 'Staff One', 1, 0, 'Staff', 1, 8, '2022-03-21 14:26:18'),
(11, 'rider2@gmail.com', '$2y$10$N1rtCYTVup.hvDPrNvtt8.zOkLrT.VJ/fC6qnKD6wCRO6Lvj3OQVS', 'Seenath Batagedara', 1, 0, 'Rider', 1, 8, '2022-03-21 14:26:18'),
(12, 'rider3@gmail.com', '$2y$10$N1rtCYTVup.hvDPrNvtt8.zOkLrT.VJ/fC6qnKD6wCRO6Lvj3OQVS', 'Janith Jaalitha', 1, 0, 'Rider', 1, 8, '2022-03-21 14:26:18'),
(13, 'rider4@gmail.com', '$2y$10$N1rtCYTVup.hvDPrNvtt8.zOkLrT.VJ/fC6qnKD6wCRO6Lvj3OQVS', 'Sunil Keerthi', 1, 0, 'Rider', 1, 8, '2022-03-21 14:26:18'),
(14, 'shop4@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Delmage Meats', 0, 0, 'Shop', 1, 8, '2022-03-21 14:26:18'),
(15, 'shop5@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Geenath Vegetables', 0, 0, 'Shop', 1, 8, '2022-03-21 14:26:18'),
(16, 'shop6@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Kamala Enterprises', 1, 0, 'Shop', 1, 8, '2022-03-21 14:26:18'),
(17, 'shop7@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Nugegoda Fruit Shop', 1, 0, 'Shop', 1, 8, '2022-03-21 14:26:18'),
(18, 'shop8@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Akku Fresh Fruits', 1, 0, 'Shop', 1, 8, '2022-03-21 14:26:18'),
(19, 'shop9@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Meegamu Fish', 1, 0, 'Shop', 1, 8, '2022-03-21 14:26:18'),
(20, 'shop10@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Ceylon Fisheries', 1, 0, 'Shop', 1, 8, '2022-03-21 14:26:18'),
(21, 'delivery2@gmail.com', '$2y$10$t0N5xYthgYV63x9DKNxFH.RipNC9S.KNJK/QLw0sSNAK9Sk4x4Sfu', 'Delivery one', 1, 0, 'Delivery', 1, 2, '2022-03-21 14:26:18'),
(23, 'shop11@gmail.com', '$2y$10$uUQKJ2cRdQfh27XPmRreruR/3xmUvqvspN.lAkWbIq71uZCDq3k/.', 'Priyantha Senarath', 0, 0, 'Shop', NULL, NULL, '2022-03-27 03:41:04'),
(24, 'shop12@gmail.com', '$2y$10$o9h5NksftAObLEDNk9Sl3ekRBOZ6Edw6T.GCDtjtDxd4Ii/Dadrs.', 'Sudam Perera', 0, 0, 'Shop', NULL, NULL, '2022-03-27 03:47:12'),
(25, 'shop13@gmail.com', '$2y$10$9D/QJFm.3wU/uK8bBzlAOuQsGgJX.SzTeaR6BUAFGKNUOUeJ16.ZW', 'Ushan Perera', 0, 0, 'Shop', 1, 2, '2022-03-27 03:51:55'),
(26, 'shop14@gmail.com', '$2y$10$covTXinzKLHryjv/jyffNeGIeJBNnk8uYiUokuOo4/sS.FnyX8FKS', 'Ushan Perera', 0, 0, 'Shop', 1, 5, '2022-03-27 03:57:25');

-- --------------------------------------------------------

--
-- Table structure for table `ordercart`
--

CREATE TABLE `ordercart` (
  `CartID` int(11) NOT NULL,
  `ShopID` int(11) NOT NULL,
  `ItemID` int(11) NOT NULL,
  `Quantity` double NOT NULL,
  `Total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `ordercart`
--

INSERT INTO `ordercart` (`CartID`, `ShopID`, `ItemID`, `Quantity`, `Total`) VALUES
(1, 3, 27, 1, 500),
(1, 3, 28, 1, 540),
(1, 4, 17, 3, 1200),
(1, 4, 18, 3, 225),
(1, 15, 1, 1, 250),
(1, 15, 2, 1, 200),
(1, 16, 1, 2, 520),
(1, 16, 2, 2, 410),
(1, 16, 8, 1, 290),
(1, 17, 14, 3, 300),
(1, 17, 15, 3, 120),
(1, 19, 21, 1, 400),
(1, 19, 22, 1, 640),
(2, 3, 28, 1, 540),
(2, 4, 12, 1, 142),
(2, 4, 13, 11, 1232),
(2, 4, 18, 1, 75),
(2, 4, 20, 1, 435),
(2, 5, 2, 2, 200),
(2, 5, 3, 4, 600),
(2, 5, 7, 2, 220),
(2, 16, 2, 1, 205),
(2, 16, 9, 1, 90),
(2, 17, 14, 1, 100),
(2, 17, 15, 1, 40),
(2, 19, 22, 1, 640),
(3, 3, 27, 1, 500),
(3, 3, 28, 1, 540),
(3, 4, 17, 1, 400),
(3, 4, 18, 1, 75),
(3, 15, 1, 1, 250),
(3, 15, 3, 1, 160),
(3, 15, 4, 1, 290),
(3, 17, 14, 1, 100),
(3, 17, 16, 1, 220),
(3, 19, 22, 1, 640),
(4, 4, 18, 1, 75),
(4, 4, 20, 1, 90),
(4, 15, 1, 3, 360),
(4, 15, 2, 1, 110),
(4, 17, 14, 1, 350),
(5, 4, 17, 2, 800),
(5, 4, 18, 1, 75),
(5, 15, 2, 1, 200),
(5, 15, 5, 1, 350),
(5, 16, 2, 1, 205),
(5, 16, 8, 1, 290),
(5, 17, 14, 3, 300),
(5, 17, 15, 2, 80),
(5, 17, 16, 1, 220),
(6, 4, 17, 2, 800),
(6, 4, 18, 1, 75),
(6, 15, 2, 1, 200),
(6, 15, 5, 1, 350),
(6, 16, 2, 1, 205),
(6, 16, 8, 1, 290),
(6, 17, 14, 5, 500),
(6, 17, 15, 3, 120),
(6, 17, 16, 1, 220),
(7, 4, 17, 2, 800),
(7, 4, 18, 1, 75),
(7, 15, 2, 1, 200),
(7, 15, 5, 1, 350),
(7, 16, 2, 1, 205),
(7, 16, 8, 1, 290),
(7, 17, 14, 6, 600),
(7, 17, 15, 3, 120),
(7, 17, 16, 1, 220),
(8, 4, 17, 2, 800),
(8, 4, 18, 1, 75),
(8, 15, 2, 1, 200),
(8, 15, 5, 1, 350),
(8, 16, 2, 1, 205),
(8, 16, 8, 1, 290),
(8, 17, 14, 6, 600),
(8, 17, 15, 4, 160),
(8, 17, 16, 1, 220),
(9, 4, 17, 2, 800),
(9, 4, 18, 1, 75),
(9, 15, 2, 1, 200),
(9, 15, 5, 1, 350),
(9, 16, 2, 1, 205),
(9, 16, 8, 1, 290),
(9, 17, 14, 7, 700),
(9, 17, 15, 4, 160),
(9, 17, 16, 1, 220);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

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

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CartID`, `OrderDate`, `RecipientName`, `Note`, `RecipientContact`, `DeliveryCost`, `TotalCost`, `Status`, `City`, `Suburb`) VALUES
(1, 1, '2022-03-25 14:40:59', 'Sirimanna', 'Leave at door', '0714589632', 160, 5755, 0, 1, 8),
(2, 2, '2022-03-25 14:52:06', 'Fernando', 'Leave at door', '0714589632', 160, 2285, 0, 1, 8),
(3, 3, '2022-03-25 14:56:57', 'Ganesh', 'Leave at door', '0714589633', 160, 3335, 0, 1, 8),
(4, 4, '2022-03-27 06:12:46', 'Fernando', 'leave at door', '0714589637', 160, 1145, 0, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `TotalPrice` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `OrderID`, `TotalPrice`) VALUES
(1, 1, 5755),
(2, 2, 2285),
(3, 3, 3335),
(4, 4, 1145);

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
  `City` int(11) NOT NULL,
  `Suburb` int(11) NOT NULL,
  `ShopName` varchar(125) COLLATE utf8mb4_bin NOT NULL,
  `ShopDesc` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Category` int(11) NOT NULL,
  `Location` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `PlaceID` varchar(1000) COLLATE utf8mb4_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`ShopID`, `Name`, `Address`, `Email`, `ContactNo`, `City`, `Suburb`, `ShopName`, `ShopDesc`, `Category`, `Location`, `PlaceID`) VALUES
(3, 'Farhir Fazil', '10 Chapel Rd, Nugegoda', 'shop1@gmail.com', '+94777854845', 1, 8, 'Pussallawa Meat Shop', 'Fresh Meats', 4, '{&quot;lat&quot;:6.8727925429239685,&quot;lng&quot;:79.89321484680175}', 'ChIJJ1JA2ENa4joRbWhiruJI4sI'),
(4, 'Harin Jayawardhana', 'Chapel Ln, Nugegoda', 'shop2@gmail.com', '+94777875619', 1, 8, 'D&J Mini Mart', 'Everything at One Place', 2, '{&quot;lat&quot;:6.872643418517776,&quot;lng&quot;:79.89244505281448}', 'ChIJS5thDMZb4joRcFj3-om0oto'),
(5, 'Sandun Kaluhitha', '22b Station Ln, Nugegoda 10250', 'shop3@gmail.com', '+94772369469', 1, 8, 'Deli Market', 'One Stop for All Your Needs', 2, '{&quot;lat&quot;:6.871969695171068,&quot;lng&quot;:79.8919622551918}', 'ChIJ3XwA50Na4joR_nza5cs8jWc'),
(14, 'Saantha Pansilu', '45 Jambugasmulla Rd, Nugegoda', 'shop4@gmail.com', '+94772358741', 1, 8, 'Delmage Meats', 'Processed Meats', 4, '{&quot;lat&quot;:6.871000384017071,&quot;lng&quot;:79.89284738416671}', 'ChIJ6YqpvENa4joRAemVeNt6ur0'),
(15, 'Saantha Pansilu', '45 Jambugasmulla Rd, Nugegoda', 'shop5@gmail.com', '+94772365985', 1, 8, 'Geenath Vegetables', 'Vegetable Importers', 0, '{&quot;lat&quot;:6.8728644421745475,&quot;lng&quot;:79.89126756305694}', 'ChIJuyUCVUFa4joRg9mBFNK_wy4'),
(16, 'Kamala Geegana', '1 Edirigoda Rd, Nugegoda', 'shop6@gmail.com', '+94772344582', 1, 8, 'Kamala Enterprises', 'Fresh Vegetables', 0, '{&quot;lat&quot;:6.873250567593335,&quot;lng&quot;:79.89270522708892}', 'ChIJF1avXUFa4joR_25N3N_SnyM'),
(17, 'Thisara Prabudda', '107/1/1,Stanley Thilakarathna Mawatha,Nugegoda', 'shop7@gmail.com', '+9477556982', 1, 8, 'Nugegoda Fruit Shop', 'All Kinds of Fruits', 1, '{&quot;lat&quot;:6.872374461881273,&quot;lng&quot;:79.89076598997116}', 'ChIJgXatAkRa4joRcYX_75Xt09U'),
(18, 'Falil Ahmed', '15/4,St Joseph Rd,Nugegoda', 'shop8@gmail.com', '+9471300982', 1, 8, 'Jambo Fruit Shop', 'Fruit Importers and Distributors', 1, '{&quot;lat&quot;:6.86985331888307,&quot;lng&quot;:79.89195554966926}', 'ChIJuW2he0Na4joROPealbMO0_k'),
(19, 'Gagana Randeepa', '107,Samudradevi Rd, Nugegoda', 'shop9@gmail.com', '+9470006982', 1, 8, 'Meegamu Fish', 'All Kinds of Fish', 3, '{&quot;lat&quot;:6.870877888510723,&quot;lng&quot;:79.89095106239319}', 'ChIJ3brXfURa4joRT3lK547-66E'),
(20, 'Jalitha Kumara', '15/4,Stanley Tilakaratne Mawatha, Nugegoda', 'shop10@gmail.com', '+9478222582', 1, 8, 'Ceylon Fisheries', 'Fish Importers and Distributors', 3, '{&quot;lat&quot;:6.871463736298677,&quot;lng&quot;:79.88989427204132}', 'ChIJEbwlPkRa4joRjjCy7M_tmOs'),
(25, 'Ushan Perera', 'No:52 Gajaman Rd,Nugegoda', 'shop13@gmail.com', '0778127626', 1, 2, 'D &amp; D Grocery', 'All your needs', 2, '{&quot;lat&quot;:6.8717056,&quot;lng&quot;:79.8926808}', 'ChIJCSTj6ENa4joReFLBb54J8rk'),
(26, 'Ushan Perera', 'No:52 Gajaman Rd,Nugegoda', 'shop14@gmail.com', '0778127569', 1, 5, 'D &amp; D Grocery', 'All your needs', 0, '{&quot;lat&quot;:6.874709388516636,&quot;lng&quot;:79.89807740453794}', 'ChIJV7S2aGpa4joRkCZ_TLqJlXI');

-- --------------------------------------------------------

--
-- Table structure for table `shopitem`
--

CREATE TABLE `shopitem` (
  `ItemID` int(11) NOT NULL,
  `ShopID` int(11) NOT NULL,
  `UnitPrice` double NOT NULL,
  `Stock` float NOT NULL,
  `MinStock` float NOT NULL,
  `MaxLeadTime` int(11) NOT NULL,
  `MinLeadTime` int(11) NOT NULL,
  `Enabled` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `shopitem`
--

INSERT INTO `shopitem` (`ItemID`, `ShopID`, `UnitPrice`, `Stock`, `MinStock`, `MaxLeadTime`, `MinLeadTime`, `Enabled`) VALUES
(1, 15, 120, 27, 0, 8, 2, 1),
(1, 16, 135, 98, 0, 3, 1, 1),
(2, 15, 110, 97, 0, 5, 2, 1),
(2, 16, 105, 96, 0, 6, 4, 1),
(3, 15, 72, 99, 0, 7, 2, 1),
(4, 15, 100, 99, 0, 9, 3, 1),
(5, 15, 99, 99, 0, 3, 1, 1),
(8, 16, 200, 100, 0, 4, 1, 1),
(9, 15, 54, 166.667, 5, 5, 2, 1),
(9, 16, 278, 30, 0, 8, 3, 1),
(14, 17, 279, 87, 0, 15, 8, 1),
(15, 17, 130, 92, 0, 6, 3, 1),
(16, 17, 345, 98, 0, 25, 12, 1),
(17, 4, 100, 94, 0, 7, 2, 1),
(18, 4, 75, 68, 0, 15, 3, 1),
(19, 4, 100, 100, 5, 7, 2, 0),
(20, 4, 90, 98, 0, 25, 5, 1),
(21, 19, 200, 99, 0, 3, 2, 1),
(22, 19, 640, 97, 0, 11, 5, 1),
(24, 19, 420, 100, 0, 6, 2, 1),
(25, 4, 120, 200, 10, 7, 2, 1),
(27, 3, 250, 98, 0, 30, 15, 1),
(28, 3, 220, 97, 0, 12, 8, 1),
(30, 3, 220, 440, 0, 5, 1, 1),
(31, 17, 179, 100, 5, 7, 2, 1),
(34, 17, 135, 100, 5, 7, 2, 1),
(37, 4, 450, 100, 5, 7, 2, 1),
(38, 4, 660, 100, 5, 7, 2, 1),
(39, 4, 85, 100, 5, 7, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shopitemsales`
--

CREATE TABLE `shopitemsales` (
  `ItemID` int(11) NOT NULL,
  `ShopID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `shopitemsales`
--

INSERT INTO `shopitemsales` (`ItemID`, `ShopID`, `Quantity`, `Date`) VALUES
(4, 5, 30, '0000-00-00'),
(5, 5, 80, '0000-00-00'),
(4, 5, 60, '0000-00-00'),
(4, 5, 30, '0000-00-00'),
(5, 5, 80, '0000-00-00'),
(7, 1, 40, '0000-00-00'),
(4, 5, 100, '0000-00-00'),
(4, 5, 50, '0000-00-00'),
(4, 5, 500, '0000-00-00'),
(4, 5, 400, '0000-00-00'),
(1, 5, 500, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `shoporder`
--

CREATE TABLE `shoporder` (
  `ShopID` int(11) NOT NULL,
  `CartID` int(11) NOT NULL,
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `ShopTotal` float NOT NULL,
  `Status` int(11) NOT NULL,
  `CompleteDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `shoporder`
--

INSERT INTO `shoporder` (`ShopID`, `CartID`, `Date`, `ShopTotal`, `Status`, `CompleteDate`) VALUES
(3, 1, '2022-03-25', 1040, 0, NULL),
(3, 2, '2022-03-25', 540, 0, NULL),
(3, 3, '2022-03-25', 1040, 0, NULL),
(4, 1, '2022-03-25', 1425, 0, NULL),
(4, 2, '2022-03-25', 510, 0, NULL),
(4, 3, '2022-03-25', 475, 0, NULL),
(4, 4, '2022-03-27', 165, 0, NULL),
(15, 1, '2022-03-25', 450, 0, NULL),
(15, 3, '2022-03-25', 700, 0, NULL),
(15, 4, '2022-03-27', 470, 0, NULL),
(16, 1, '2022-03-25', 1220, 0, NULL),
(16, 2, '2022-03-25', 295, 0, NULL),
(17, 1, '2022-03-25', 420, 0, NULL),
(17, 2, '2022-03-25', 140, 0, NULL),
(17, 3, '2022-03-25', 320, 0, NULL),
(17, 4, '2022-03-27', 350, 0, NULL),
(19, 1, '2022-03-25', 1040, 0, NULL),
(19, 2, '2022-03-25', 640, 0, NULL),
(19, 3, '2022-03-25', 640, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `Address` varchar(255) COLLATE utf8mb4_bin NOT NULL,
  `ContactNo` varchar(25) COLLATE utf8mb4_bin NOT NULL,
  `Email` varchar(55) COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `Name`, `Address`, `ContactNo`, `Email`) VALUES
(10, 'Staff One', 'Address Eka', '0714584685', 'staff1@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `systemcost`
--

CREATE TABLE `systemcost` (
  `Date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `systemcost`
--

INSERT INTO `systemcost` (`Date`, `Cost`) VALUES
('2021-12-25 02:19:40', 9500),
('2022-01-25 02:19:12', 12500),
('2022-02-25 02:19:12', 10000),
('2022-03-25 02:18:08', 10000);

-- --------------------------------------------------------

--
-- Table structure for table `temporarycart`
--

CREATE TABLE `temporarycart` (
  `ItemID` int(11) NOT NULL,
  `ShopID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Purchased` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `temporarycart`
--

INSERT INTO `temporarycart` (`ItemID`, `ShopID`, `CustomerID`, `Quantity`, `Purchased`) VALUES
(1, 15, 2, 2, 1),
(5, 15, 2, 1, 1),
(14, 17, 2, 1, 1),
(15, 17, 2, 2, 1),
(37, 4, 2, 1, 1);

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
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`UserID`, `VerificationCode`, `UniqueID`) VALUES
(11, 'yGM5xcT9Z2Si3d8EC4xBYdRM', 'GWxnwqSqH9xnaBB0614reDfJ'),
(25, 'lIR1mYZBOTSi94IbFdapbnA8', 'SUuyOjiDv8HKihyO5fR2JwZv'),
(26, 'ku0TLrGwuzswCGd4EKgaqOhT', 'tOkwkgL4wnuT0Vp4cXFc8SVl');

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
-- Indexes for table `systemcost`
--
ALTER TABLE `systemcost`
  ADD PRIMARY KEY (`Date`);

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
  MODIFY `ComplaintID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `DeliveryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `ItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `ShopID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

DELIMITER $$
--
-- Events
--
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
