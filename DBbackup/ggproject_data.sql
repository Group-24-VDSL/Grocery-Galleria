-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2021 at 07:34 PM
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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `CustomerID`, `Address`, `DateTime`) VALUES
    (1, 7, 'Address eka', '2021-12-04 14:52:46');

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Name`, `Address`, `Email`, `ContactNo`, `City`, `Suburb`, `Location`, `PlaceID`) VALUES
                                                                                                                            (2, 'Customer One', 'Address eka', 'customer1@gmail.com', '0332222548', 'Colombo', 'Colombo', '{&quot;lat&quot;:6.943458914658162,&quot;lng&quot;:79.9875427734375}', ''),
                                                                                                                            (7, 'Customer Two', 'Address eka', 'customer2@mailinator.com', '0713004458', 'Colombo', 'Colombo', '{&quot;lat&quot;:6.932553034671361,&quot;lng&quot;:79.97106328125}', 'GhIJkSVzLO-6G0ARIvau5iX-U0A');

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`DeliveryID`, `RiderID`, `Date`, `Status`, `CompTime`, `OrderID`, `CartID`, `City`, `Suburb`) VALUES
    (1, 9, '2021-12-22 15:05:06', 0, NULL, 1, 1, 1, 2);

--
-- Dumping data for table `deliveryrider`
--

INSERT INTO `deliveryrider` (`RiderID`, `Name`, `Address`, `Email`, `ContactNo`, `NIC`, `ProfilePic`, `City`, `Suburb`, `RiderType`) VALUES
                                                                                                                                         (9, 'Rider One', 'Address eka', 'rider1@gmail.com', '0715555468', '981557852V', '/public/img/placeholder-150.png', '', '', 0),
                                                                                                                                         (11, 'Seenath Batagedara', 'Address eka', 'rider2@gmail.com', '0754555257', '985452645V', '', 'Colombo', 'Colombo', 0);

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

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`UserID`, `Email`, `PasswordHash`, `Name`, `Verify_Flag`, `Delete_Flag`, `Role`, `City`, `Suburb`) VALUES
                                                                                                                            (2, 'customer1@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Customer One', 1, 0, 'Customer', 1, 1),
                                                                                                                            (3, 'shop1@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Shop One', 1, 0, 'Shop', NULL, NULL),
                                                                                                                            (4, 'shop2@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Shop Two', 1, 0, 'Shop', 1, 2),
                                                                                                                            (5, 'shop3@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Shop Three', 0, 0, 'Shop', 1, 1),
                                                                                                                            (7, 'customer2@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Customer Two', 1, 0, 'Customer', 1, 2),
                                                                                                                            (8, 'delivery1@gmail.com', '$2y$10$t0N5xYthgYV63x9DKNxFH.RipNC9S.KNJK/QLw0sSNAK9Sk4x4Sfu', 'Delivery One', 1, 0, 'Delivery', 1, 2),
                                                                                                                            (9, 'rider1@gmail.com', '$2y$10$t0N5xYthgYV63x9DKNxFH.RipNC9S.KNJK/QLw0sSNAK9Sk4x4Sfu', 'Rider One', 1, 0, 'Rider', 1, 2),
                                                                                                                            (10, 'staff1@gmail.com', '$2y$10$t0N5xYthgYV63x9DKNxFH.RipNC9S.KNJK/QLw0sSNAK9Sk4x4Sfu', 'Staff One', 1, 0, 'Staff', NULL, NULL),
                                                                                                                            (11, 'rider2@gmail.com', '$2y$10$N1rtCYTVup.hvDPrNvtt8.zOkLrT.VJ/fC6qnKD6wCRO6Lvj3OQVS', 'Seenath Batagedara', 0, 0, 'Rider', 1, 1);

--
-- Dumping data for table `ordercart`
--

INSERT INTO `ordercart` (`CartID`, `ShopID`, `ItemID`, `Quantity`, `Total`) VALUES
                                                                                (1, 4, 12, 50, 7100),
                                                                                (1, 5, 7, 10, 1100),
                                                                                (1, 5, 8, 20, 6000);

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CartID`, `OrderDate`, `RecipientName`, `Note`, `RecipientContact`, `DeliveryCost`, `TotalCost`) VALUES
    (1, 1, '2021-12-04 14:52:46', '', '', '', 160, 14360);

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `OrderID`, `TotalPrice`) VALUES
    (1, 1, 14360);

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`ShopID`, `Name`, `Address`, `Email`, `ContactNo`, `City`, `Suburb`, `ShopName`, `ShopDesc`, `Category`, `Location`, `PlaceID`) VALUES
                                                                                                                                                        (4, 'Shop Two', 'Address Eka', 'shop2@gmail.com', '0701122412', 'Colombo', 'Colombo', 'Kalinga Stores', 'Fresh Stuff', 0, '{&quot;lat&quot;:6.938006006240303,&quot;lng&quot;:79.916131640625}', 'ChIJI4abT9RZ4joR83K0Sg1HrtI'),
                                                                                                                                                        (5, 'Shop Three', '22/2 Old Kesbewa Road, Nugegoda.', 'shop3@gmail.com', '0778571737', 'Colombo', 'Colombo', 'Senarath Grocery', 'Farm Fresh Goods', 0, '{&quot;lat&quot;:6.8672672,&quot;lng&quot;:79.8856714}', 'ChIJr_pa_k9a4joR0Lc1vOefaMQ');

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
                                                                                 (7, 5, 110, 190, 1),
                                                                                 (8, 5, 300, 230, 1),
                                                                                 (11, 4, 125, 150, 0),
                                                                                 (12, 4, 142, 50, 1),
                                                                                 (13, 4, 112, 90, 1);

--
-- Dumping data for table `shoporder`
--

INSERT INTO `shoporder` (`ShopID`, `CartID`, `Date`, `ShopTotal`) VALUES
                                                                      (4, 1, '2021-12-04', 7100),
                                                                      (5, 1, '2021-12-04', 7100);

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `Name`, `Address`, `ContactNo`, `Email`) VALUES
    (10, 'Staff One', 'Address Eka', '0714584685', 'staff1@gmail.com');

--
-- Dumping data for table `temporarycart`
--

INSERT INTO `temporarycart` (`ItemID`, `ShopID`, `CustomerID`, `Quantity`, `Purchased`) VALUES
                                                                                            (1, 5, 2, 10, 0),
                                                                                            (2, 5, 2, 2, 1),
                                                                                            (3, 5, 2, 4, 1),
                                                                                            (5, 5, 2, 10, 0),
                                                                                            (6, 5, 2, 5, 0),
                                                                                            (7, 5, 2, 2, 1),
                                                                                            (12, 4, 2, 1, 1),
                                                                                            (13, 4, 2, 11, 1);

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`UserID`, `VerificationCode`, `UniqueID`) VALUES
    (11, 'yGM5xcT9Z2Si3d8EC4xBYdRM', 'GWxnwqSqH9xnaBB0614reDfJ');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
