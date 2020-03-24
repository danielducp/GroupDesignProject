-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 24, 2020 at 12:36 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `g4udatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(11) NOT NULL,
  `CategoryName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
(1, 'Gadgets'),
(2, 'Toys');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DepartmentID` int(11) NOT NULL,
  `DepartmentName` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DepartmentID`, `DepartmentName`) VALUES
(1, 'Gadgets'),
(2, 'Toys'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `OrderDate` datetime NOT NULL,
  `DeliveryDate` datetime DEFAULT NULL,
  `TransactionID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL,
  `DeliveryStatus` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderID`, `OrderDate`, `DeliveryDate`, `TransactionID`, `StaffID`, `DeliveryStatus`) VALUES
(1, '2020-03-10 00:00:00', '2021-01-29 00:00:00', 1, 1, 0);

--
-- Triggers `order`
--
DELIMITER $$
CREATE TRIGGER `order_BEFORE_INSERT` BEFORE INSERT ON `order` FOR EACH ROW IF NEW.OrderDate != CURDATE() THEN SET NEW.OrderDate = CURDATE(); END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `orderedproducts`
--

CREATE TABLE `orderedproducts` (
  `OrderedProductsID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `QuantityOrdered` int(3) DEFAULT NULL,
  `Authorised` tinyint(1) DEFAULT NULL,
  `ProductCode` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductCode` varchar(7) NOT NULL,
  `ProductName` varchar(30) NOT NULL,
  `ProductImage` varchar(50) NOT NULL,
  `QuantityPerPack` int(3) NOT NULL,
  `CategoryID` int(11) DEFAULT NULL,
  `CurrentStockLevel` int(10) UNSIGNED DEFAULT NULL,
  `LowStockLevel` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductCode`, `ProductName`, `ProductImage`, `QuantityPerPack`, `CategoryID`, `CurrentStockLevel`, `LowStockLevel`) VALUES
('123366', 'Nerf N-Strike Elite Dart Blast', 'nerfdarts.jpg', 20, 1, 25, 20),
('123872', 'RED5 Robotic Toy Hedgehog', 'hedhgoe.jpg', 40, 1, 20, 10),
('172907', 'NERF Fortnite AR-L', 'fortnitescarnerf.jpg', 25, 1, 20, 10),
('321698', 'OOTB 78/5900 Golden Poo', 'poo.jpg', 30, 1, 15, 10),
('918320', 'Funko Pop Animation Morty Pick', 'morty.jpg', 10, 1, 12, 10),
('FP59', 'Funko Pop! Disney: Frozen 2 - ', 'funko.jpg', 25, 2, 20, 15),
('HAT332', 'Novelty Place Guzzler Drinking', 'drinkhat.jpg', 40, 1, 20, 10),
('KST01', 'KLIKBOT Studio Thud', 'klikbot.jpg', 20, 2, 20, 10),
('LEX95', 'LEGO Classic Bricks and Ideas ', 'lego.jpg', 30, 2, 20, 15),
('NRF10', 'Nerf N-Strike Elite Disruptor', 'nerfgun1.jpg', 25, 2, 20, 15),
('PIN00', 'Plan Toys Pinball', 'pinball.jpg', 15, 2, 10, 5),
('POL03', 'Polaroid Play 3D Pen', '3dpen.jpg', 40, 1, 15, 9),
('PPF03', 'Portable Personal Fan', 'portablefan.jpg', 30, 1, 20, 15),
('PWR41', 'USB Power Bank 10000mAh', 'powerbank1.jpg', 50, 1, 20, 10),
('PWR43', 'USB Power Bank 20000mAh', 'powerbank2.jpg', 40, 1, 25, 10),
('PWR44', 'USB Power Bank 25800mAh', 'powerbank3.png', 35, 1, 15, 8),
('SC01', 'Spider Catcher', 'spidercatcher.jpg', 20, 1, 10, 5),
('SW08', 'Star Wars USB Cup Warmer', 'starwarscupwarmer.jpg', 25, 1, 20, 10);

--
-- Triggers `product`
--
DELIMITER $$
CREATE TRIGGER `product_BEFORE_INSERT` BEFORE INSERT ON `product` FOR EACH ROW IF NEW.CategoryID != 1 OR 2 OR 3 THEN SET NEW.CategoryID = 1 OR 2 OR 3; END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffNumber` int(11) NOT NULL,
  `staffid` varchar(10) NOT NULL,
  `StaffTitle` varchar(10) NOT NULL,
  `StaffName` varchar(30) NOT NULL,
  `StaffRole` varchar(20) NOT NULL,
  `StoreID` int(11) DEFAULT NULL,
  `departmentid` int(11) DEFAULT NULL,
  `Password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffNumber`, `staffid`, `StaffTitle`, `StaffName`, `StaffRole`, `StoreID`, `departmentid`, `Password`) VALUES
(1, 'HID001', 'Sir', 'Adrian Hidcote-Armstrong', 'MD & Chairman of G4U', NULL, 3, 'password'),
(2, 'DUN021', 'Ms', 'Sarah Dunkley', 'CEO PG4U', 1, NULL, 'password1'),
(3, 'VER121', 'Mr', 'John Vermont', 'Mgr PG4U GT Dept.', 1, NULL, 'password2'),
(4, 'BRE510', 'Mr', 'Jason Brentwood', 'Senior SalesPerson G', 1, NULL, 'password3'),
(5, 'PAT201', 'Ms', 'Amanda Patel', 'Sales Assistant GT', 1, 1, 'password4'),
(6, 'MAH042', 'Mr', 'Mustafa Mahmood', 'Sales Assistant GT', 1, 2, 'password5'),
(7, 'GRE123', 'Miss', 'Jennifer Green', 'Sales Assistant GT', 1, 1, 'password6'),
(8, 'PIT101', 'Mr', 'Derek Pitts', 'Sales Assistant GT', 1, 2, 'password7'),
(9, 'PIA412', 'Mr', 'Enrico Piam', 'Sales Assistant GT', 1, 1, 'password8'),
(10, 'GRE056', 'Ms', 'Ann Greengold', 'Assistant QA Control', 1, NULL, 'password9'),
(11, 'e4ww4w', 'dfdrdvs', 'dfdrd', 'ddfd', 1, 1, 'dsfdfsdrs');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `StoreID` int(11) NOT NULL,
  `StoreName` varchar(30) DEFAULT NULL,
  `StoreLocation` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`StoreID`, `StoreName`, `StoreLocation`) VALUES
(1, 'PG4U', 'Peterborough');

-- --------------------------------------------------------

--
-- Table structure for table `suppliedorder`
--

CREATE TABLE `suppliedorder` (
  `SuppliedOrderID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `SupplierID` varchar(3) NOT NULL,
  `Delivered` tinyint(4) DEFAULT NULL,
  `Checked` tinyint(4) DEFAULT NULL,
  `Returned` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `suppliedproducts`
--

CREATE TABLE `suppliedproducts` (
  `SuppliedProductsID` int(11) NOT NULL,
  `SupplierID` int(11) NOT NULL,
  `SupplierName` varchar(80) DEFAULT NULL,
  `DeliveryTime` int(11) NOT NULL,
  `ItemCost` decimal(4,2) NOT NULL,
  `VATCost` decimal(4,2) NOT NULL,
  `TotalCost` decimal(4,2) DEFAULT NULL,
  `ProductCode` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliedproducts`
--

INSERT INTO `suppliedproducts` (`SuppliedProductsID`, `SupplierID`, `SupplierName`, `DeliveryTime`, `ItemCost`, `VATCost`, `TotalCost`, `ProductCode`) VALUES
(1, 1, 'Bitmore Inc', 5, '9.95', '1.99', '11.94', 'PWR41'),
(2, 3, 'BrainStorm Ltd', 5, '9.95', '1.99', '11.94', 'PWR41'),
(3, 1, 'Bitmore Inc', 5, '18.99', '3.80', '22.79', 'PWR43'),
(4, 3, 'BrainStorm Ltd', 5, '18.64', '3.73', '22.37', 'PWR43'),
(5, 1, 'Bitmore Inc', 5, '19.99', '4.00', '23.99', 'PWR44'),
(6, 3, 'BrainStorm Ltd', 5, '19.00', '3.80', '22.80', 'PWR44'),
(7, 4, 'Shenzhen Hosing Technology Development Co., Ltd.', 20, '1.58', '0.32', '1.90', 'SC01'),
(8, 3, 'BrainStorm Ltd', 3, '1.99', '0.40', '2.39', 'SC01'),
(9, 1, 'Bitmore Inc', 5, '5.65', '1.13', '6.78', 'PPF03'),
(10, 4, 'Shenzhen Hosing Technology Development Co., Ltd.', 15, '4.80', '0.96', '5.76', 'PPF03'),
(11, 3, 'BrainStorm Ltd', 5, '10.99', '2.20', '13.19', 'SW08'),
(12, 1, 'Bitmore Inc', 4, '9.99', '2.00', '11.99', 'SW08'),
(13, 4, 'Shenzhen Hosing Technology Development Co., Ltd.', 25, '9.85', '1.97', '11.82', 'SW08'),
(14, 4, 'Shenzhen Hosing Technology Development Co., Ltd.', 25, '22.00', '4.40', '26.40', 'POL03'),
(15, 3, 'BrainStorm Ltd', 4, '28.59', '5.72', '34.31', 'POL03'),
(16, 1, 'Bitmore Inc', 12, '12.99', '2.60', '15.59', 'NRF10'),
(17, 4, 'Shenzhen Hosing Technology Development Co., Ltd.', 30, '10.50', '2.10', '12.60', 'NRF10'),
(18, 3, 'BrainStorm Ltd', 12, '9.95', '1.99', '11.94', 'KST01'),
(19, 4, 'Shenzhen Hosing Technology Development Co., Ltd.', 30, '7.50', '1.50', '9.00', 'KST01'),
(20, 1, 'Bitmore Inc', 5, '40.00', '8.00', '48.00', 'PIN00'),
(21, 2, 'Cottage Toys', 6, '38.25', '7.65', '45.90', 'PIN00'),
(22, 4, 'Shenzhen Hosing Technology Development Co., Ltd.', 5, '7.50', '1.50', '9.00', 'FP59'),
(23, 2, 'Cottage Toys', 6, '7.10', '1.42', '8.52', 'FP59'),
(24, 4, 'Shenzhen Hosing Technology Development Co., Ltd.', 10, '7.68', '1.54', '9.22', 'LEX95'),
(25, 2, 'Cottage Toys', 5, '8.00', '1.60', '9.60', 'LEX95');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `SupplierID` varchar(3) NOT NULL,
  `SupplierName` varchar(80) NOT NULL,
  `SupplierAddress` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`SupplierID`, `SupplierName`, `SupplierAddress`) VALUES
('BI', 'Bitmore Inc', 'Park House15-19 Greenhill CrescentWatford Business ParkHertfordshire WD18 8PH'),
('BS', 'BrainStorm Ltd', 'BrainStorm Limited Unit 1A, Mill Lane GISBURN Lancashire BB7 4LN UK'),
('CT', 'Cottage Toys', 'Unit 11, Spitfire Business Park, Hawker Road, Croydon, CR0 4WD ENGLAND'),
('SH', 'Shenzhen Hosing Technology Development Co., Ltd.', 'Weixinda Industrial Par Caowei Xixiang Baoan District, Shenzhen, Guangdong 518128');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DepartmentID`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`OrderID`);

--
-- Indexes for table `orderedproducts`
--
ALTER TABLE `orderedproducts`
  ADD PRIMARY KEY (`OrderedProductsID`),
  ADD KEY `orderedproductsfk1` (`OrderID`),
  ADD KEY `orderedproductsfk2` (`ProductCode`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductCode`),
  ADD KEY `productfk1` (`CategoryID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffNumber`),
  ADD KEY `stafffk1` (`StoreID`),
  ADD KEY `stafffk2` (`departmentid`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`StoreID`);

--
-- Indexes for table `suppliedorder`
--
ALTER TABLE `suppliedorder`
  ADD PRIMARY KEY (`SuppliedOrderID`),
  ADD KEY `orderfk1` (`OrderID`),
  ADD KEY `orderfk2` (`SupplierID`);

--
-- Indexes for table `suppliedproducts`
--
ALTER TABLE `suppliedproducts`
  ADD PRIMARY KEY (`SuppliedProductsID`),
  ADD KEY `supplierfk1` (`SupplierName`),
  ADD KEY `supplierfk2` (`ProductCode`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`SupplierID`),
  ADD KEY `SupplierName` (`SupplierName`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DepartmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orderedproducts`
--
ALTER TABLE `orderedproducts`
  MODIFY `OrderedProductsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `StaffNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `StoreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliedproducts`
--
ALTER TABLE `suppliedproducts`
  MODIFY `SuppliedProductsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderedproducts`
--
ALTER TABLE `orderedproducts`
  ADD CONSTRAINT `orderedproductsfk1` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orderedproductsfk2` FOREIGN KEY (`ProductCode`) REFERENCES `product` (`ProductCode`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `productfk1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `stafffk1` FOREIGN KEY (`StoreID`) REFERENCES `store` (`StoreID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stafffk2` FOREIGN KEY (`departmentid`) REFERENCES `department` (`DepartmentID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `suppliedorder`
--
ALTER TABLE `suppliedorder`
  ADD CONSTRAINT `orderfk1` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `orderfk2` FOREIGN KEY (`SupplierID`) REFERENCES `supplier` (`SupplierID`);

--
-- Constraints for table `suppliedproducts`
--
ALTER TABLE `suppliedproducts`
  ADD CONSTRAINT `supplierfk1` FOREIGN KEY (`SupplierName`) REFERENCES `supplier` (`SupplierName`),
  ADD CONSTRAINT `supplierfk2` FOREIGN KEY (`ProductCode`) REFERENCES `product` (`ProductCode`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
