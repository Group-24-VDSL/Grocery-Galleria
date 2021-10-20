-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 19, 2021 at 11:33 PM
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
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`CustomerID`, `Name`, `Address`, `Email`, `ContactNo`, `City`, `Suburb`, `Location`, `PlaceID`) VALUES
(2, 'Ravin Sabare', 'Address eka', 'ravinsabre@gmail.com', '0332222548', 'Colombo', 'Colombo', '{&quot;lat&quot;:6.943458914658162,&quot;lng&quot;:79.9875427734375}', '');

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

INSERT INTO `login` (`UserID`, `Email`, `PasswordHash`, `Name`, `Verify_Flag`, `Delete_Flag`, `Role`) VALUES
(2, 'ravinsabre@gmail.com', '$2y$10$Ok7PVcJLplQFzfI39kEF4.TG.mt/RqIY/DJX.voiYdAJB5iR7SPsK', 'Ravin Sabare', 1, 0, 'Customer'),
(3, 'samantha@mailinator.com', '$2y$10$6eBEINCKhomU394KEVwY2upe5XVlKqJhnHyQSsUSEYcLQ8KtaVPWq', 'samantha', 1, 0, 'Shop'),
(4, 'damintha@something.com', '$2y$10$k3vVEQWSo3Czo9HMoUyyGuAwdYFLqOVoc53B97j42rsJ6cr6cgh0S', 'damintha', 1, 0, 'Shop'),
(5, 'dilshanthenuka9@gmail.com', '$2y$10$rriBh61q3NbFzQJwGoTUh.7tfij.K0nB9EfomH1kNUiUHvqJNzNJC', 'S.A Dilshan Thenuka', 0, 0, 'Shop');

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`ShopID`, `Name`, `Address`, `Email`, `ContactNo`, `City`, `Suburb`, `ShopName`, `ShopDesc`, `Category`, `Location`, `PlaceID`) VALUES
(5, 'S.A Dilshan Thenuka', '22/2 Old Kesbewa Road, Nugegoda.', 'dilshanthenuka9@gmail.com', '0778571737', 'Colombo', 'Colombo', 'Senarath Grocery', 'Farm Fresh Goods', 0, '{&quot;lat&quot;:6.8672672,&quot;lng&quot;:79.8856714}', 'ChIJr_pa_k9a4joR0Lc1vOefaMQ');

--
-- Dumping data for table `shopitem`
--

INSERT INTO `shopitem` (`ItemID`, `ShopID`, `UnitPrice`, `Stock`, `Enabled`) VALUES
(1, 5, 280, 20, 0),
(2, 5, 100, 20, 0),
(3, 5, 150, 20, 0),
(4, 5, 380, 10, 0),
(5, 5, 190, 15, 0),
(6, 5, 380, 20, 0),
(7, 5, 110, 20000, 0),
(8, 5, 300, 25000, 0);

--
-- Dumping data for table `temporarycart`
--

INSERT INTO `temporarycart` (`ItemID`, `ShopID`, `CustomerID`, `Quantity`, `Purchased`) VALUES
(5, 5, 2, 2, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
