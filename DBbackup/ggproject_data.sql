-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 06:30 PM
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

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CartID`, `Date`, `Time`, `CustomerID`) VALUES
                                                                (1, '2021-12-04', '14:52:46', 7),
                                                                (2, '2021-12-27', '19:32:18', 2);

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Name`, `Address`, `Email`, `ContactNo`, `City`, `Suburb`, `Location`, `PlaceID`) VALUES
                                                                                                                            (2, 'Dilshan Thenuka', '22/2 Old Kesbewa Road, Nugegoda.', 'customer1@gmail.com', '+9477 8571737', '0', '8', '{&quot;lat&quot;:6.871714052860769,&quot;lng&quot;:79.89268108720779}', 'ChIJCSTj6ENa4joReFLBb54J8rk'),
                                                                                                                            (7, 'Nadil Sankara', '22, 40 Old Kesbewa Rd, Nugegoda', 'customer2@mailinator.com', '+94774381695', '0', '8', '{&quot;lat&quot;:6.871743345215753,&quot;lng&quot;:79.89361717815399}', 'ChIJL9QBVg5b4joRH8BMOlx_Mk8');

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`DeliveryID`, `RiderID`, `Date`, `Status`, `CompTime`, `OrderID`, `CartID`) VALUES
    (1, 9, '2021-12-22 15:05:06', 0, NULL, 1, 1);

--
-- Dumping data for table `deliveryrider`
--

INSERT INTO `deliveryrider` (`RiderID`, `Name`, `Address`, `Email`, `ContactNo`, `NIC`, `ProfilePic`, `City`, `Suburb`, `RiderType`) VALUES
                                                                                                                                         (9, 'Kamal Jayawardhana', '32, Pelawatta Rd, Nugegoda', 'rider1@gmail.com', '0715555468', '981557852V', '/public/img/placeholder-150.png', '0', '8', 0),
                                                                                                                                         (11, 'Seenath Batagedara', '13, Edirigoda Road, Nugegoda', 'rider2@gmail.com', '0754555257', '985452455V', '/public/img/placeholder-150.png', '0', '8', 0),
                                                                                                                                         (12, 'Janith Jaalitha', '19 A1, Chapel Rd, Nugegoda', 'rider3@gmail.com', '0754555257', '985478545V', '/public/img/placeholder-150.png', '0', '8', 1),
                                                                                                                                         (13, 'Sunil Keerthi', 'Chapel Rd, Nugegoda', 'rider4@gmail.com', '0754555257', '984578645V', '/public/img/placeholder-150.png', '0', '8', 1);

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemID`, `Name`, `ItemImage`, `Brand`, `UWeight`, `Unit`, `MRP`, `MaxCount`, `Category`, `Status`) VALUES
                                                                                                                            (1, 'Brinjol', '/img/product-imgs/9500000.jpg', '', 300, 0, 310, 10, 0, 1),
                                                                                                                            (2, 'Beetroot', '/img/product-imgs/9500001.jpg', '', 1000, 0, 490, 5, 0, 1),
                                                                                                                            (3, 'Cabbage', '/img/product-imgs/9500002.jpg', '', 300, 0, 170, 4, 0, 1),
                                                                                                                            (4, 'Capsicum', '/img/product-imgs/9500003.jpg', '', 300, 0, 400, 5, 0, 1),
                                                                                                                            (5, 'Carrot', '/img/product-imgs/9500004.jpg', '', 300, 0, 190, 10, 0, 1),
                                                                                                                            (6, 'Green beans', '/img/product-imgs/9500005.jpg', '', 300, 0, 390, 10, 0, 1),
                                                                                                                            (7, 'Cucumber', '/img/product-imgs/9500006.jpg', '', 500, 0, 120, 5, 0, 1),
                                                                                                                            (8, 'Knol Khol', '/img/product-imgs/9500007.jpg', '', 300, 0, 210, 5, 0, 1),
                                                                                                                            (9, 'Leeks', '/img/product-imgs/9500008.jpg', '', 300, 0, 280, 10, 0, 1),
                                                                                                                            (10, 'Drumsticks', '/img/product-imgs/9500009.jpg', '', 300, 0, 330, 5, 0, 1),
                                                                                                                            (11, 'Potatoes', '/img/product-imgs/9500010.jpg', '', 500, 0, 190, 8, 0, 1),
                                                                                                                            (12, 'Tomatoes', '/img/product-imgs/9500011.jpg', '', 300, 0, 140, 4, 0, 1),
                                                                                                                            (13, 'Green Chilies', '/img/product-imgs/9500012.jpg', '', 100, 0, 280, 20, 0, 1),
                                                                                                                            (14, 'Papaya', '/img/product-imgs/9500013.jpg', '', 500, 1, 105, 20, 1, 1),
                                                                                                                            (15, 'Banana - Ambul', '/img/product-imgs/9500014.jpg', '', 500, 1, 50, 10, 1, 1),
                                                                                                                            (16, 'Avocado', '/img/product-imgs/9500015.jpg', '', 500, 1, 225, 10, 1, 1),
                                                                                                                            (17, 'Harischandra Kurakkan Flour 400g', '/img/product-imgs/9500016.jpg', 'Harischandra', 400, 1, 400, 10, 2, 1),
                                                                                                                            (18, 'Maliban Chocolate Cream Biscuits 100g', '/img/product-imgs/9500017.jpg', 'Maliban', 100, 1, 75, 10, 2, 1),
                                                                                                                            (19, 'Motha Jelly Mixed Fruit 100g', '/img/product-imgs/9500018.jpg', 'Motha', 100, 1, 100, 10, 2, 1),
                                                                                                                            (20, 'Marina Vegetable Oil Pack 500ml', '/img/product-imgs/9500019.jpg', 'Marina', 500, 1, 435, 10, 2, 1),
                                                                                                                            (21, 'Kumbalawa', '/img/product-imgs/9500020.jpg', '', 500, 1, 420, 10, 3, 1),
                                                                                                                            (22, 'Paraw Fish Slices', '/img/product-imgs/9500021.jpg', '', 400, 1, 768, 10, 3, 1),
                                                                                                                            (23, 'Tuna Cubes', '/img/product-imgs/9500022.jpg', '', 200, 1, 648, 10, 3, 1),
                                                                                                                            (24, 'Tuna Fish', '/img/product-imgs/9500023.jpg', '', 500, 1, 875, 10, 3, 1),
                                                                                                                            (25, 'Ritzbury Revello Milk Chocolate 170g', '/img/product-imgs/9500024.jpg', 'Ritzbury', 170, 1, 370, 10, 2, 1),
                                                                                                                            (26, 'Mdk Koththu Roti 1kg', '/img/product-imgs/9500025.jpg', 'MDK', 1000, 1, 285, 10, 2, 1),
                                                                                                                            (27, 'Chicken Drumsticks Skinless', '/img/product-imgs/9500026.jpg', '', 500, 1, 520, 10, 4, 1),
                                                                                                                            (28, 'Chicken Full Breast Skinless', '/img/product-imgs/9500027.jpg', '', 500, 1, 455, 10, 4, 1),
                                                                                                                            (29, 'Chicken Gizzard', '/img/product-imgs/9500028.jpg', '', 500, 1, 395, 10, 4, 1),
                                                                                                                            (30, 'Chicken Whole Legs Skin On', '/img/product-imgs/9500029.jpg', '', 500, 1, 445, 10, 4, 1),
                                                                                                                            (31, 'Melon', '/img/product-imgs/9500030.jpg', '', 500, 1, 175, 10, 1, 1),
                                                                                                                            (32, 'Mandarin - Local ', '/img/product-imgs/9500031.jpg', '', 500, 1, 210, 10, 1, 1),
                                                                                                                            (33, 'Mango - K/C', '/img/product-imgs/9500032.jpg', '', 500, 1, 110, 10, 1, 1),
                                                                                                                            (34, 'Pineapple', '/img/product-imgs/9500033.jpg', '', 500, 1, 125, 10, 1, 1),
                                                                                                                            (35, 'Ginger', '/img/product-imgs/9500034.jpg', '', 500, 1, 115, 10, 0, 1);

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`UserID`, `Email`, `PasswordHash`, `Name`, `Verify_Flag`, `Delete_Flag`, `Role`, `City`, `Suburb`, `RegTime`) VALUES
                                                                                                                                       (2, 'customer1@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Dilshan Thenuka', 1, 0, 'Customer', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (3, 'shop1@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Pussallawa Meat Shop', 1, 0, 'Shop', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (4, 'shop2@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'D&J Mini Mart', 1, 0, 'Shop', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (5, 'shop3@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Deli Market', 0, 0, 'Shop', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (7, 'customer2@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Nadil Sankara', 1, 0, 'Customer', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (8, 'delivery1@gmail.com', '$2y$10$t0N5xYthgYV63x9DKNxFH.RipNC9S.KNJK/QLw0sSNAK9Sk4x4Sfu', 'Delivery One', 1, 0, 'Delivery', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (9, 'rider1@gmail.com', '$2y$10$t0N5xYthgYV63x9DKNxFH.RipNC9S.KNJK/QLw0sSNAK9Sk4x4Sfu', 'Kamal Jayawardhana', 1, 0, 'Rider', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (10, 'staff1@gmail.com', '$2y$10$t0N5xYthgYV63x9DKNxFH.RipNC9S.KNJK/QLw0sSNAK9Sk4x4Sfu', 'Staff One', 1, 0, 'Staff', 1, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (11, 'rider2@gmail.com', '$2y$10$N1rtCYTVup.hvDPrNvtt8.zOkLrT.VJ/fC6qnKD6wCRO6Lvj3OQVS', 'Seenath Batagedara', 1, 0, 'Rider', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (12, 'rider3@gmail.com', '$2y$10$N1rtCYTVup.hvDPrNvtt8.zOkLrT.VJ/fC6qnKD6wCRO6Lvj3OQVS', 'Janith Jaalitha', 1, 0, 'Rider', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (13, 'rider4@gmail.com', '$2y$10$N1rtCYTVup.hvDPrNvtt8.zOkLrT.VJ/fC6qnKD6wCRO6Lvj3OQVS', 'Sunil Keerthi', 1, 0, 'Rider', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (14, 'shop4@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Delmage Meats', 0, 0, 'Shop', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (15, 'shop5@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Geenath Traders', 0, 0, 'Shop', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (16, 'shop6@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Kamala Enterprises', 1, 0, 'Shop', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (17, 'shop7@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Nugegoda Fruit Shop', 1, 0, 'Shop', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (18, 'shop8@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Akku Fresh Fruits', 1, 0, 'Shop', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (19, 'shop9@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Meegamu Fish', 1, 0, 'Shop', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (20, 'shop10@gmail.com', '$2y$10$LccaU64pC43mF4yhFgDMbu5HEqVaTdcRKz/5cPjEEaOiwdJuuR4aK', 'Ceylon Fisheries', 1, 0, 'Shop', 0, 8, '2022-03-21 14:26:18'),
                                                                                                                                       (21, 'delivery2@gmail.com', '$2y$10$t0N5xYthgYV63x9DKNxFH.RipNC9S.KNJK/QLw0sSNAK9Sk4x4Sfu', 'Delivery one', 1, 0, 'Delivery', 1, 2, '2022-03-21 14:26:18');

--
-- Dumping data for table `ordercart`
--

INSERT INTO `ordercart` (`CartID`, `ShopID`, `ItemID`, `Quantity`, `Total`) VALUES
                                                                                (1, 4, 12, 50, 7100),
                                                                                (1, 5, 7, 10, 1100),
                                                                                (1, 5, 8, 20, 6000),
                                                                                (2, 4, 12, 1, 142),
                                                                                (2, 4, 13, 11, 1232),
                                                                                (2, 5, 2, 2, 200),
                                                                                (2, 5, 3, 4, 600),
                                                                                (2, 5, 7, 2, 220);

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CartID`, `OrderDate`, `RecipientName`, `Note`, `RecipientContact`, `DeliveryCost`, `TotalCost`, `Status`, `City`, `Suburb`) VALUES
                                                                                                                                                                  (1, 1, '2021-12-04 14:52:46', '', '', '', 160, 14360, 0, 1, 2),
                                                                                                                                                                  (2, 2, '2021-12-27 19:32:18', '', '', '', 160, 2554, 0, 0, 0),
                                                                                                                                                                  (3, 3, '2021-11-04 14:52:46', 'Customer three', 'none', '0785489634', 320, 2850, 1, 0, 0),
                                                                                                                                                                  (4, 4, '2021-10-04 14:52:46', 'Customer four', 'None', '0711251256', 420, 3690, 1, 0, 0),
                                                                                                                                                                  (5, 5, '2021-02-04 14:52:46', 'Customer five', 'None', '0176589632', 160, 5690, 2, 0, 0),
                                                                                                                                                                  (6, 6, '2022-10-04 14:52:46', 'Customer six', 'None', '0718595263', 320, 5860, 2, 1, 1),
                                                                                                                                                                  (7, 7, '2022-01-04 14:52:46', 'Customer seven', 'None', '0785489563', 160, 5870, 0, 1, 2),
                                                                                                                                                                  (8, 8, '2022-07-04 14:52:46', 'Customer eight', 'None', '075485695', 80, 4860, 0, 1, 2),
                                                                                                                                                                  (9, 9, '2022-03-18 03:46:21', 'Customer nine', 'None', '0741258963', 80, 720, 1, 1, 3),
                                                                                                                                                                  (10, 10, '2022-03-18 04:46:21', 'Customer ten', 'None', '0765896523', 160, 2500, 1, 1, 3),
                                                                                                                                                                  (11, 11, '2022-03-18 05:48:53', 'Customer eleven', 'None', '0741258963', 320, 2800, 2, 1, 2),
                                                                                                                                                                  (12, 12, '2022-03-18 06:05:36', 'Customer tweleve', 'None', '0784589565', 160, 1800, 2, 1, 3),
                                                                                                                                                                  (13, 13, '2022-03-18 07:50:08', 'Customer thirteen', 'None', '0784568923', 160, 3200, 0, 1, 2),
                                                                                                                                                                  (14, 14, '2022-03-18 07:56:41', 'Customer fourteen', 'None', '0798656963', 160, 3690, 0, 1, 2),
                                                                                                                                                                  (15, 15, '2022-03-18 09:51:13', 'Customer fifteen', 'None', '0754895634', 160, 3680, 1, 1, 3);

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `OrderID`, `TotalPrice`) VALUES
                                                                 (1, 1, 14360),
                                                                 (2, 2, 2554);

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`ShopID`, `Name`, `Address`, `Email`, `ContactNo`, `City`, `Suburb`, `ShopName`, `ShopDesc`, `Category`, `Location`, `PlaceID`) VALUES
                                                                                                                                                        (3, 'Farhir Fazil', '10 Chapel Rd, Nugegoda', 'shop1@gmail.com', '+94777854845', 0, 8, 'Pussallawa Meat Shop', 'Fresh Meats', 2, '{&quot;lat&quot;:6.8727925429239685,&quot;lng&quot;:79.89321484680175}', 'ChIJJ1JA2ENa4joRbWhiruJI4sI'),
                                                                                                                                                        (4, 'Harin Jayawardhana', 'Chapel Ln, Nugegoda', 'shop2@gmail.com', '+94777875619', 0, 8, 'D&J Mini Mart', 'Everything at One Place', 0, '{&quot;lat&quot;:6.872643418517776,&quot;lng&quot;:79.89244505281448}', 'ChIJS5thDMZb4joRcFj3-om0oto'),
                                                                                                                                                        (5, 'Sandun Kaluhitha', '22b Station Ln, Nugegoda 10250', 'shop3@gmail.com', '+94772369469', 0, 8, 'Deli Market', 'One Stop for All Your Needs', 0, '{&quot;lat&quot;:6.871969695171068,&quot;lng&quot;:79.8919622551918}', 'ChIJ3XwA50Na4joR_nza5cs8jWc'),
                                                                                                                                                        (14, 'Saantha Pansilu', '45 Jambugasmulla Rd, Nugegoda', 'shop4@gmail.com', '+94772358741', 0, 8, 'Delmage Meats', 'Processed Meats', 2, '{&quot;lat&quot;:6.871000384017071,&quot;lng&quot;:79.89284738416671}', 'ChIJ6YqpvENa4joRAemVeNt6ur0'),
                                                                                                                                                        (15, 'Saantha Pansilu', '45 Jambugasmulla Rd, Nugegoda', 'shop5@gmail.com', '+94772365985', 0, 8, 'Geenath Traders', 'Vegetable Importers', 1, '{&quot;lat&quot;:6.8728644421745475,&quot;lng&quot;:79.89126756305694}', 'ChIJuyUCVUFa4joRg9mBFNK_wy4'),
                                                                                                                                                        (16, 'Kamala Geegana', '1 Edirigoda Rd, Nugegoda', 'shop6@gmail.com', '+94772344582', 0, 8, 'Kamala Enterprises', 'Fresh Vegetables', 1, '{&quot;lat&quot;:6.873250567593335,&quot;lng&quot;:79.89270522708892}', 'ChIJF1avXUFa4joR_25N3N_SnyM'),
                                                                                                                                                        (17, 'Thisara Prabudda', '107/1/1,Stanley Thilakarathna Mawatha,Nugegoda', 'shop7@gmail.com', '+9477556982', 0, 8, 'Nugegoda Fruit Shop', 'All Kinds of Fruits', 4, '{&quot;lat&quot;:6.872374461881273,&quot;lng&quot;:79.89076598997116}', 'ChIJgXatAkRa4joRcYX_75Xt09U'),
                                                                                                                                                        (18, 'Falil Ahmed', '15/4,St Joseph Rd,Nugegoda', 'shop8@gmail.com', '+9471300982', 0, 8, 'Nugegoda Fruit Shop', 'Fruit Importers and Distributors', 4, '{&quot;lat&quot;:6.86985331888307,&quot;lng&quot;:79.89195554966926}', 'ChIJuW2he0Na4joROPealbMO0_k'),
                                                                                                                                                        (19, 'Gagana Randeepa', '107,Samudradevi Rd, Nugegoda', 'shop9@gmail.com', '+9470006982', 0, 8, 'Meegamu Fish', 'All Kinds of Fish', 3, '{&quot;lat&quot;:6.870877888510723,&quot;lng&quot;:79.89095106239319}', 'ChIJ3brXfURa4joRT3lK547-66E'),
                                                                                                                                                        (20, 'Jalitha Kumara', '15/4,Stanley Tilakaratne Mawatha, Nugegoda', 'shop10@gmail.com', '+9478222582', 0, 8, 'Ceylon Fisheries', 'Fish Importers and Distributors', 3, '{&quot;lat&quot;:6.871463736298677,&quot;lng&quot;:79.88989427204132}', 'ChIJEbwlPkRa4joRjjCy7M_tmOs');

--
-- Dumping data for table `shopitem`
--

INSERT INTO `shopitem` (`ItemID`, `ShopID`, `UnitPrice`, `Stock`, `MaxLeadTime`, `MinLeadTime`, `Enabled`) VALUES
                                                                                                               (1, 5, 206, 15, 1, 1, 1),
                                                                                                               (2, 5, 100, 1000, 1, 1, 1),
                                                                                                               (3, 1, 50, 20, 0, 0, 1),
                                                                                                               (3, 5, 100, 45, 1, 1, 1),
                                                                                                               (4, 1, 100, 40, 0, 0, 1),
                                                                                                               (4, 5, 200, 10, 1, 1, 1),
                                                                                                               (5, 1, 100, 90, 0, 0, 0),
                                                                                                               (5, 5, 100, 70, 1, 1, 1),
                                                                                                               (6, 5, 380, 45, 1, 1, 1),
                                                                                                               (7, 1, 10, 23, 0, 0, 1),
                                                                                                               (7, 5, 100, 30, 1, 1, 1),
                                                                                                               (8, 1, 67, 245, 0, 0, 1),
                                                                                                               (8, 5, 100, 50, 1, 1, 1),
                                                                                                               (9, 5, 56, 120, 1, 1, 1),
                                                                                                               (10, 1, 40, 100, 0, 0, 1),
                                                                                                               (10, 5, 40, 100, 5, 2, 1),
                                                                                                               (11, 5, 40, 100, 5, 2, 1);

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

--
-- Dumping data for table `shoporder`
--

INSERT INTO `shoporder` (`ShopID`, `CartID`, `Date`, `ShopTotal`, `Status`, `CompleteDate`) VALUES
                                                                                                (1, 1, '0000-00-00', 2000, 1, '0000-00-00'),
                                                                                                (1, 2, '0000-00-00', 3000, 1, '0000-00-00'),
                                                                                                (1, 3, '0000-00-00', 2000, 1, '0000-00-00'),
                                                                                                (1, 5, '0000-00-00', 1000, 1, '0000-00-00'),
                                                                                                (1, 6, '0000-00-00', 1000, 1, '0000-00-00'),
                                                                                                (1, 20, '0000-00-00', 4000, 0, '0000-00-00'),
                                                                                                (1, 22, '0000-00-00', 4000, 0, '0000-00-00'),
                                                                                                (1, 23, '0000-00-00', 4000, 0, '0000-00-00'),
                                                                                                (1, 25, '0000-00-00', 4000, 0, '0000-00-00'),
                                                                                                (1, 26, '0000-00-00', 4000, 0, '0000-00-00'),
                                                                                                (1, 28, '0000-00-00', 4000, 0, '0000-00-00'),
                                                                                                (1, 29, '0000-00-00', 4000, 0, '0000-00-00'),
                                                                                                (1, 30, '0000-00-00', 4000, 0, '0000-00-00'),
                                                                                                (1, 31, '0000-00-00', 4000, 0, '0000-00-00'),
                                                                                                (1, 34, '0000-00-00', 4000, 0, '0000-00-00'),
                                                                                                (2, 2, '0000-00-00', 3000, 0, '0000-00-00'),
                                                                                                (2, 6, '0000-00-00', 1000, 1, '0000-00-00'),
                                                                                                (2, 16, '0000-00-00', 2000, 0, '0000-00-00'),
                                                                                                (2, 17, '0000-00-00', 4000, 1, '0000-00-00'),
                                                                                                (3, 2, '0000-00-00', 200.8, 0, '0000-00-00'),
                                                                                                (4, 2, '0000-00-00', 4000, 1, '0000-00-00'),
                                                                                                (5, 1, '0000-00-00', 590, 1, '0000-00-00'),
                                                                                                (5, 2, '0000-00-00', 2000, 1, '0000-00-00'),
                                                                                                (5, 4, '0000-00-00', 2000, 1, '0000-00-00'),
                                                                                                (5, 16, '0000-00-00', 2000, 1, '0000-00-00'),
                                                                                                (5, 17, '0000-00-00', 4000, 1, '0000-00-00');

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `Name`, `Address`, `ContactNo`, `Email`) VALUES
    (10, 'Staff One', 'Address Eka', '0714584685', 'staff1@gmail.com');

--
-- Dumping data for table `verification`
--

INSERT INTO `verification` (`UserID`, `VerificationCode`, `UniqueID`) VALUES
    (11, 'yGM5xcT9Z2Si3d8EC4xBYdRM', 'GWxnwqSqH9xnaBB0614reDfJ');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
