-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 15, 2022 at 06:13 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.25

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

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`ItemID`, `Name`, `ItemImage`, `Brand`, `UWeight`, `Unit`, `MRP`, `MaxCount`, `Category`) VALUES
(1, 'Brinjol', '/img/product-imgs/9500000.jpg', '', 300, 0, 310, 10, 1),
(2, 'Beetroot', '/img/product-imgs/9500001.jpg', '', 1000, 0, 490, 5, 1),
(3, 'Cabbage', '/img/product-imgs/9500002.jpg', '', 300, 0, 170, 4, 1),
(4, 'Capsicum', '/img/product-imgs/9500003.jpg', '', 300, 0, 400, 5, 1),
(5, 'Carrot', '/img/product-imgs/9500004.jpg', '', 300, 0, 190, 10, 1),
(6, 'Green beans', '/img/product-imgs/9500005.jpg', '', 300, 0, 390, 10, 1),
(7, 'Cucumber', '/img/product-imgs/9500006.jpg', '', 500, 0, 120, 5, 1),
(8, 'Knol Khol', '/img/product-imgs/9500007.jpg', '', 300, 0, 210, 5, 1),
(9, 'Leeks', '/img/product-imgs/9500008.jpg', '', 300, 0, 280, 10, 1),
(10, 'Drumsticks', '/img/product-imgs/9500009.jpg', '', 300, 0, 330, 5, 1),
(11, 'Potatoes', '/img/product-imgs/9500010.jpg', '', 500, 0, 190, 8, 1),
(12, 'Tomatoes', '/img/product-imgs/9500011.jpg', '', 300, 0, 140, 4, 1),
(13, 'Green Chilies', '/img/product-imgs/9500012.jpg', '', 100, 0, 280, 20, 1),
(14, 'Papaya', '/img/product-imgs/9500013.jpg', '', 500, 1, 105, 20, 4),
(15, 'Banana - Ambul', '/img/product-imgs/9500014.jpg', '', 500, 1, 50, 10, 4),
(16, 'Avocado', '/img/product-imgs/9500015.jpg', '', 500, 1, 225, 10, 4),
(17, 'Harischandra Kurakkan Flour 400g', '/img/product-imgs/9500016.jpg', 'Harischandra', 400, 1, 400, 10, 0),
(18, 'Maliban Chocolate Cream Biscuits 100g', '/img/product-imgs/9500017.jpg', 'Maliban', 100, 1, 75, 10, 0),
(19, 'Motha Jelly Mixed Fruit 100g', '/img/product-imgs/9500018.jpg', 'Motha', 100, 1, 100, 10, 0),
(20, 'Marina Vegetable Oil Pack 500ml', '/img/product-imgs/9500019.jpg', 'Marina', 500, 1, 435, 10, 0),
(21, 'Kumbalawa', '/img/product-imgs/9500020.jpg', '', 500, 1, 420, 10, 3),
(22, 'Paraw Fish Slices', '/img/product-imgs/9500021.jpg', '', 400, 1, 768, 10, 3),
(23, 'Tuna Cubes', '/img/product-imgs/9500022.jpg', '', 200, 1, 648, 10, 3),
(24, 'Tuna Fish', '/img/product-imgs/9500023.jpg', '', 500, 1, 875, 10, 3),
(25, 'Ritzbury Revello Milk Chocolate 170g', '/img/product-imgs/9500024.jpg', 'Ritzbury', 170, 1, 370, 10, 3),
(26, 'Mdk Koththu Roti 1kg', '/img/product-imgs/9500025.jpg', 'MDK', 1000, 1, 285, 10, 0),
(27, 'Chicken Drumsticks Skinless', '/img/product-imgs/9500026.jpg', '', 500, 1, 520, 10, 2),
(28, 'Chicken Full Breast Skinless', '/img/product-imgs/9500027.jpg', '', 500, 1, 455, 10, 2),
(29, 'Chicken Gizzard', '/img/product-imgs/9500028.jpg', '', 500, 1, 395, 10, 2),
(30, 'Chicken Whole Legs Skin On', '/img/product-imgs/9500029.jpg', '', 500, 1, 445, 10, 2),
(31, 'Melon', '/img/product-imgs/9500030.jpg', '', 500, 1, 175, 10, 4),
(32, 'Mandarin - Local ', '/img/product-imgs/9500031.jpg', '', 500, 1, 210, 10, 4),
(33, 'Mango - K/C', '/img/product-imgs/9500032.jpg', '', 500, 1, 110, 10, 4),
(34, 'Pineapple', '/img/product-imgs/9500033.jpg', '', 500, 1, 125, 10, 4),
(35, 'Ginger', '/img/product-imgs/9500034.jpg', '', 500, 1, 115, 10, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
