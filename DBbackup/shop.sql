-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2022 at 08:28 PM
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
(3, 'Farhir Fazil', '10 Chapel Rd, Nugegoda', 'shop1@gmail.com', '+94777854845', 1, 8, 'Pussallawa Meat Shop', 'Fresh Meats', 2, '{&quot;lat&quot;:6.8727925429239685,&quot;lng&quot;:79.89321484680175}', 'ChIJJ1JA2ENa4joRbWhiruJI4sI'),
(4, 'Harin Jayawardhana', 'Chapel Ln, Nugegoda', 'shop2@gmail.com', '+94777875619', 1, 8, 'D&J Mini Mart', 'Everything at One Place', 0, '{&quot;lat&quot;:6.872643418517776,&quot;lng&quot;:79.89244505281448}', 'ChIJS5thDMZb4joRcFj3-om0oto'),
(5, 'Sandun Kaluhitha', '22b Station Ln, Nugegoda 10250', 'shop3@gmail.com', '+94772369469', 1, 8, 'Deli Market', 'One Stop for All Your Needs', 0, '{&quot;lat&quot;:6.871969695171068,&quot;lng&quot;:79.8919622551918}', 'ChIJ3XwA50Na4joR_nza5cs8jWc'),
(14, 'Saantha Pansilu', '45 Jambugasmulla Rd, Nugegoda', 'shop4@gmail.com', '+94772358741', 1, 8, 'Delmage Meats', 'Processed Meats', 2, '{&quot;lat&quot;:6.871000384017071,&quot;lng&quot;:79.89284738416671}', 'ChIJ6YqpvENa4joRAemVeNt6ur0'),
(15, 'Saantha Pansilu', '45 Jambugasmulla Rd, Nugegoda', 'shop5@gmail.com', '+94772365985', 1, 8, 'Geenath Traders', 'Vegetable Importers', 1, '{&quot;lat&quot;:6.8728644421745475,&quot;lng&quot;:79.89126756305694}', 'ChIJuyUCVUFa4joRg9mBFNK_wy4'),
(16, 'Kamala Geegana', '1 Edirigoda Rd, Nugegoda', 'shop6@gmail.com', '+94772344582', 1, 8, 'Kamala Enterprises', 'Fresh Vegetables', 1, '{&quot;lat&quot;:6.873250567593335,&quot;lng&quot;:79.89270522708892}', 'ChIJF1avXUFa4joR_25N3N_SnyM'),
(17, 'Thisara Prabudda', '107/1/1,Stanley Thilakarathna Mawatha,Nugegoda', 'shop7@gmail.com', '+9477556982', 1, 8, 'Nugegoda Fruit Shop', 'All Kinds of Fruits', 4, '{&quot;lat&quot;:6.872374461881273,&quot;lng&quot;:79.89076598997116}', 'ChIJgXatAkRa4joRcYX_75Xt09U'),
(18, 'Falil Ahmed', '15/4,St Joseph Rd,Nugegoda', 'shop8@gmail.com', '+9471300982', 1, 8, 'Nugegoda Fruit Shop', 'Fruit Importers and Distributors', 4, '{&quot;lat&quot;:6.86985331888307,&quot;lng&quot;:79.89195554966926}', 'ChIJuW2he0Na4joROPealbMO0_k'),
(19, 'Gagana Randeepa', '107,Samudradevi Rd, Nugegoda', 'shop9@gmail.com', '+9470006982', 1, 8, 'Meegamu Fish', 'All Kinds of Fish', 3, '{&quot;lat&quot;:6.870877888510723,&quot;lng&quot;:79.89095106239319}', 'ChIJ3brXfURa4joRT3lK547-66E'),
(20, 'Jalitha Kumara', '15/4,Stanley Tilakaratne Mawatha, Nugegoda', 'shop10@gmail.com', '+9478222582', 1, 8, 'Ceylon Fisheries', 'Fish Importers and Distributors', 3, '{&quot;lat&quot;:6.871463736298677,&quot;lng&quot;:79.88989427204132}', 'ChIJEbwlPkRa4joRjjCy7M_tmOs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`ShopID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `ShopID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
