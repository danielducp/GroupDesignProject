-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2020 at 09:07 PM
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
  `DepartmentName` varchar(30) DEFAULT NULL,
  `TotalExpenditure` decimal(6,2) NOT NULL DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DepartmentID`, `DepartmentName`, `TotalExpenditure`) VALUES
(1, 'Gadgets', '0.00'),
(2, 'Toys', '0.00'),
(3, 'Admin', '51.13'),
(4, 'Automation', '21.00');

-- --------------------------------------------------------

--
-- Table structure for table `newstaff`
--

CREATE TABLE `newstaff` (
  `staffid` varchar(7) NOT NULL,
  `stafftitle` varchar(45) NOT NULL,
  `staffname` varchar(45) NOT NULL,
  `staffrole` varchar(45) NOT NULL,
  `storeid` int(2) DEFAULT NULL,
  `departmentid` int(3) DEFAULT NULL,
  `password` text NOT NULL,
  `PasswordNeedsResetting` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newstaff`
--

INSERT INTO `newstaff` (`staffid`, `stafftitle`, `staffname`, `staffrole`, `storeid`, `departmentid`, `password`, `PasswordNeedsResetting`) VALUES
('AUT123', 'AUT', 'AUTO MATIC', 'AUTOMATION', 1, 4, '', 0),
('BRE510', 'Mr', 'Jason Brentwood', 'Senior SalesPerson', 1, 3, '$2y$10$A13BcJnrm9sXxjvT8upumuG0.z0OUJB984zMtNwLirE1SvREkfqCy', 0),
('DANIEL', 'DANIEL1', 'DANIEL', 'DANIEL', 1, 1, '$2y$10$dV0OsXTMneO6ruHnWyMRhuVs/43YFpJH1F8aCwbR1DjIlmMud9xRm', 0),
('DUN021', 'Ms', 'Sarah Dunkley', 'CEO PG4U', 1, 3, '$2y$10$EYFLSOD1u8v.mw9D1xym9eFJ1dClpr9UZYg8oBJ0mYeXlEpMkjDOW', 0),
('FINAL', 'FINAL', 'FINAL', 'FINAL', 1, 3, '$2y$10$5I7/DtJqlWhBSV7UDEfTB.EseeJ7qcDLSyOHtyEqoO9hj0mAutcf2', 0),
('GRE056', 'Ms', 'Ann Greengold', 'Assistant QA Control', 1, 3, '$2y$10$CDUsckOulcIiwb01qVxyzuuxUeF1dyXDysitEe6zFejuogdqtCTLm', 0),
('GRE123', 'Miss', 'Jennifer Green', 'Sales Assistant', 1, 1, '$2y$10$31PldSH//xXmeAaAQGc7D.dePTQhOoAPNHyN4XyQdBZLzQEsy3MHC', 0),
('HID001', 'Sir', 'Adrian Hidcote-Armstrong', 'MD & Chairman of G4U', 1, 3, '$2y$10$1rWOFwEvj7cbapFUkE0ZP.wIhImneEiQTMnQ2vYYzPALr4mmY.TyC', 0),
('MAH042', 'Mr', 'Mustafa Mahmood', 'Sales Assistant', 1, 2, '$2y$10$/K1v0VmGBSiT.hhHp8oqpubYFvN39ipOCpUMq1ozWWTyh01tu3DIG', 0),
('PAT201', 'Ms', 'Amanda Patel', 'Sales Assistant', 1, 1, '$2y$10$g0QA3FsN1IeRKx9Ude.W7ufDgns1aeVwGHWnzXsI.Po0.yVwx3lIa', 0),
('PIA412', 'Mr', 'Enrico Piam', 'Sales Assistant', 1, 1, '$2y$10$/W3Dq8Xw1a//4bJfs47LGONFOYbrRWn00fT2zjEdCZWC7tiMuz/Fm', 0),
('PIT101', 'Mr', 'Derek Pitts', 'Sales Assistant', 1, 2, '$2y$10$ScGUm3zHTTatNaFflBcx9unqPU1VTY1lgUt2CcQafC2mdcfWTFw7i', 0),
('TEST', 'TESTING', 'TEST', 'TESTING', 1, 1, '$2y$10$u2/kPHZfs4J08kLaxzhAsOcwrRZUXxD0wr8DDsZRNmS/Y8WF06oAK', 0),
('VER121', 'Mr', 'John Vermont', 'Manager PG4U', 1, 3, '$2y$10$1F7jKk.kFptVJGUD3GWPa.YAI3CxVvBSQ9OslvBmAh5unNRdVGmmy', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `OrderDate` date NOT NULL,
  `TransactionID` int(11) NOT NULL,
  `StaffID` varchar(10) NOT NULL,
  `DeliveryStatus` tinyint(4) NOT NULL,
  `OrderTotal` decimal(6,2) NOT NULL DEFAULT 0.00,
  `OrderConfirmed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderID`, `OrderDate`, `TransactionID`, `StaffID`, `DeliveryStatus`, `OrderTotal`, `OrderConfirmed`) VALUES
(16, '2020-04-28', 0, 'HID001', 1, '9.00', 1),
(17, '2020-04-28', 0, 'HID001', 1, '9.22', 0),
(18, '2020-04-28', 0, 'HID001', 1, '15.59', 1),
(19, '2020-04-29', 0, '', 0, '12.00', 0),
(20, '2020-04-29', 0, '', 0, '12.00', 0),
(21, '2020-04-29', 0, '', 0, '12.00', 0),
(22, '2020-04-29', 0, '', 0, '11.99', 0),
(23, '2020-04-29', 0, '', 0, '12.00', 0),
(24, '2020-04-29', 0, '', 0, '11.99', 0),
(25, '2020-04-29', 0, '', 0, '12.00', 0),
(26, '2020-04-29', 0, '', 0, '0.00', 0),
(27, '2020-04-29', 0, '', 0, '11.99', 0),
(28, '2020-04-29', 0, '', 0, '12.00', 0),
(29, '2020-04-29', 0, '', 0, '12.00', 0),
(30, '2020-04-29', 0, '', 0, '12.00', 0),
(31, '2020-04-29', 0, '', 0, '12.00', 0),
(32, '2020-04-29', 0, '', 0, '12.00', 0),
(36, '2020-04-29', 0, '', 0, '12.00', 0),
(37, '2020-04-29', 0, '', 0, '600.00', 0),
(39, '2020-04-29', 0, '', 0, '12.00', 0),
(40, '2020-04-29', 0, 'AUT123', 0, '600.00', 0),
(47, '2020-04-29', 0, '', 0, '12.00', 0),
(48, '2020-04-29', 0, 'AUT123', 0, '600.00', 0),
(52, '2020-04-29', 0, '', 0, '12.00', 0),
(53, '2020-04-29', 0, 'AUT123', 0, '600.00', 0),
(54, '2020-04-29', 0, '', 0, '12.00', 0),
(55, '2020-04-29', 0, 'AUT123', 0, '600.00', 0),
(56, '2020-04-29', 0, '', 0, '12.00', 0),
(57, '2020-04-29', 0, 'AUT123', 0, '600.00', 0),
(58, '2020-04-29', 0, '', 0, '12.00', 0),
(59, '2020-04-29', 0, 'AUT123', 0, '600.00', 0),
(63, '2020-04-29', 0, '', 0, '12.00', 0),
(64, '2020-04-29', 0, 'AUT123', 0, '12.00', 0),
(65, '2020-04-29', 0, '', 0, '0.00', 0),
(67, '2020-04-29', 0, '', 0, '12.00', 0),
(68, '2020-04-29', 0, 'AUT123', 0, '600.00', 0),
(69, '2020-04-29', 0, '', 0, '12.00', 0),
(70, '2020-04-29', 0, 'AUT123', 0, '600.00', 0),
(71, '2020-04-29', 0, '', 0, '0.00', 0),
(72, '2020-04-29', 0, '', 0, '12.00', 0),
(73, '2020-04-29', 0, 'AUT123', 0, '600.00', 0),
(74, '2020-04-29', 0, '', 0, '12.00', 0),
(75, '2020-04-29', 0, 'AUT123', 0, '72.00', 0),
(76, '2020-04-29', 0, 'HID001', 0, '9.00', 0),
(79, '2020-04-29', 0, '', 0, '12.00', 0),
(80, '2020-04-29', 0, 'AUT123', 0, '48.00', 0),
(81, '2020-04-29', 0, '', 0, '12.00', 0),
(82, '2020-04-29', 0, 'AUT123', 0, '72.00', 0),
(86, '2020-04-29', 0, '', 0, '12.00', 0),
(87, '2020-04-29', 0, 'AUT123', 0, '96.00', 0),
(88, '2020-04-29', 0, '', 0, '12.00', 0),
(89, '2020-04-29', 0, 'AUT123', 0, '72.00', 0),
(90, '2020-04-29', 0, '', 0, '12.00', 0),
(91, '2020-04-29', 0, 'AUT123', 0, '96.00', 0),
(92, '2020-04-29', 0, '', 0, '11.99', 0),
(93, '2020-04-29', 0, 'AUT123', 0, '143.88', 0),
(98, '2020-04-29', 0, '', 0, '11.99', 0),
(99, '2020-04-29', 0, 'AUT123', 0, '143.88', 0),
(100, '2020-04-29', 0, 'HID001', 0, '9.00', 1),
(101, '2020-05-06', 0, 'HID001', 0, '11.94', 0),
(103, '2020-05-06', 0, 'AUT123', 0, '12.00', 0),
(104, '2020-05-06', 0, 'AUT123', 1, '12.00', 1),
(105, '2020-05-06', 0, 'HID001', 1, '26.40', 1),
(109, '2020-05-06', 0, 'AUT123', 0, '11.99', 0),
(110, '2020-05-06', 0, 'AUT123', 1, '12.00', 1),
(112, '2020-05-06', 0, 'AUT123', 0, '11.99', 0),
(113, '2020-05-06', 0, 'AUT123', 0, '12.00', 0),
(114, '2020-05-06', 0, 'AUT123', 0, '15.59', 0),
(118, '2020-05-06', 0, 'AUT123', 0, '48.00', 0),
(119, '2020-05-06', 0, 'HID001', 0, '26.40', 0),
(120, '2020-05-06', 0, 'AUT123', 0, '12.00', 0),
(122, '2020-05-06', 0, 'AUT123', 0, '11.99', 0),
(123, '2020-05-06', 0, 'AUT123', 0, '11.99', 0),
(126, '2020-05-06', 0, 'AUT123', 0, '12.00', 0),
(127, '2020-05-06', 0, 'AUT123', 0, '12.00', 0),
(131, '2020-05-06', 0, 'HID001', 1, '11.99', 1),
(133, '2020-05-06', 0, 'AUT123', 0, '11.94', 0),
(134, '2020-05-06', 0, 'AUT123', 0, '11.99', 0),
(135, '2020-05-06', 0, 'AUT123', 1, '9.00', 1);

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
  `QuantityOrdered` int(3) NOT NULL,
  `Authorised` tinyint(1) NOT NULL,
  `ProductCode` varchar(7) NOT NULL,
  `TotalCost` decimal(6,2) NOT NULL,
  `DeliveryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderedproducts`
--

INSERT INTO `orderedproducts` (`OrderedProductsID`, `OrderID`, `QuantityOrdered`, `Authorised`, `ProductCode`, `TotalCost`, `DeliveryDate`) VALUES
(9, 16, 2, 1, 'FP59', '18.00', '2020-05-11'),
(10, 16, 3, 1, 'LEX95', '27.66', '2020-05-08'),
(11, 17, 1, 0, 'LEX95', '9.22', '2020-05-08'),
(12, 18, 1, 1, 'NRF10', '12.60', '2020-05-28'),
(13, 18, 1, 1, 'LEX95', '9.22', '2020-05-08'),
(14, 19, 50, 2, 'TEST1', '12.00', '0000-00-00'),
(15, 20, 50, 2, 'TEST1', '600.00', '0000-00-00'),
(16, 21, 1, 2, 'TEST1', '12.00', '0000-00-00'),
(17, 22, 1, 2, 'SW08', '11.99', '2020-05-03'),
(18, 23, 1, 2, 'TEST1', '600.00', '0000-00-00'),
(19, 24, 1, 2, 'SW08', '599.50', '2020-05-03'),
(20, 25, 1, 2, 'TEST1', '600.00', '0000-00-00'),
(21, 26, 1, 2, 'SC01', '119.50', '0000-00-00'),
(22, 27, 1, 2, 'SW08', '599.50', '2020-05-03'),
(23, 28, 1, 2, 'TEST1', '600.00', '0000-00-00'),
(24, 29, 1, 2, 'TEST1', '600.00', '0000-00-00'),
(25, 30, 1, 2, 'TEST1', '600.00', '0000-00-00'),
(26, 31, 1, 2, 'TEST1', '600.00', '0000-00-00'),
(27, 32, 1, 2, 'TEST1', '600.00', '0000-00-00'),
(31, 36, 1, 2, 'TEST1', '600.00', '0000-00-00'),
(33, 39, 1, 2, 'TEST1', '600.00', '0000-00-00'),
(37, 47, 1, 2, 'TEST1', '600.00', '0000-00-00'),
(39, 52, -4, 2, 'TEST1', '600.00', '0000-00-00'),
(40, 54, -15, 2, 'TEST1', '600.00', '0000-00-00'),
(41, 56, 4, 2, 'TEST1', '600.00', '0000-00-00'),
(42, 58, 6, 2, 'TEST1', '600.00', '0000-00-00'),
(46, 63, 4, 2, 'TEST1', '600.00', '0000-00-00'),
(47, 64, 2, 2, 'TEST1', '600.00', '0000-00-00'),
(48, 67, 4, 2, 'TEST1', '600.00', '0000-00-00'),
(49, 69, 10, 2, 'TEST1', '600.00', '0000-00-00'),
(50, 72, 12, 2, 'TEST1', '600.00', '0000-00-00'),
(51, 74, 6, 2, 'TEST1', '72.00', '0000-00-00'),
(52, 76, 1, 0, 'FP59', '9.00', '2020-05-11'),
(53, 79, 4, 2, 'TEST1', '48.00', '0000-00-00'),
(54, 81, 6, 2, 'TEST1', '72.00', '0000-00-00'),
(55, 86, 8, 2, 'TEST1', '96.00', '2020-04-29'),
(56, 88, 6, 2, 'TEST1', '72.00', '0000-00-00'),
(57, 90, 8, 2, 'TEST1', '96.00', '2020-05-05'),
(58, 92, 12, 2, 'SW08', '143.88', '2020-05-03'),
(63, 98, 12, 2, 'SW08', '143.88', '2020-05-03'),
(64, 100, 2, 1, 'FP59', '18.00', '2020-05-11'),
(65, 100, 1, 1, 'LEX95', '9.22', '2020-05-09'),
(66, 101, 1, 0, 'KST01', '11.94', '2020-05-18'),
(68, 103, 1, 0, 'TEST1', '12.00', '2020-05-05'),
(69, 104, 1, 1, 'TEST1', '12.00', '2020-05-05'),
(70, 105, 1, 1, 'POL03', '26.40', '2020-05-31'),
(74, 109, 1, 0, 'SW08', '11.99', '2020-05-03'),
(75, 110, 1, 1, 'TEST1', '12.00', '2020-05-05'),
(76, 112, 1, 0, 'SW08', '11.99', '2020-05-03'),
(77, 113, 1, 0, 'TEST1', '12.00', '2020-05-12'),
(78, 114, 1, 0, 'NRF10', '15.59', '2020-05-18'),
(80, 118, 1, 0, 'PIN00', '48.00', '0000-00-00'),
(81, 119, 1, 0, 'POL03', '26.40', '2020-05-31'),
(82, 120, 1, 0, 'TEST1', '12.00', '0000-00-00'),
(84, 122, 1, 0, 'SW08', '11.99', '2020-05-03'),
(85, 123, 1, 0, 'SC01', '2.39', '2020-05-02'),
(88, 126, 1, 0, 'TEST1', '12.00', '2020-05-05'),
(89, 127, 1, 0, 'TEST1', '12.00', '2020-05-05'),
(92, 131, 1, 1, 'PWR41', '11.94', '2020-05-11'),
(93, 131, 1, 1, 'SW08', '13.19', '2020-05-03'),
(94, 131, 1, 1, 'POL03', '26.40', '2020-05-31'),
(96, 133, 1, 0, 'PWR41', '11.94', '2020-05-11'),
(97, 134, 1, 0, 'SW08', '11.99', '2020-05-03'),
(98, 135, 1, 1, 'FP59', '9.00', '2020-05-11');

--
-- Triggers `orderedproducts`
--
DELIMITER $$
CREATE TRIGGER `orderedproducts_AFTER_UPDATE` AFTER UPDATE ON `orderedproducts` FOR EACH ROW BEGIN

END
$$
DELIMITER ;

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
  `CurrentStockLevel` int(10) DEFAULT NULL,
  `LowStockLevel` int(10) DEFAULT NULL,
  `EditedTime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductCode`, `ProductName`, `ProductImage`, `QuantityPerPack`, `CategoryID`, `CurrentStockLevel`, `LowStockLevel`, `EditedTime`) VALUES
('123366', 'Nerf N-Strike Elite Dart Blast', 'nerfdarts.jpg', 20, 1, 36, 20, '2020-04-29 10:08:02'),
('123872', 'RED5 Robotic Toy Hedgehog', 'hedhgoe.jpg', 40, 1, 31, 10, '2020-04-29 10:08:02'),
('172907', 'NERF Fortnite AR-L', 'fortnitescarnerf.jpg', 25, 1, 31, 10, '2020-04-29 10:08:02'),
('321698', 'OOTB 78/5900 Golden Poo', 'poo.jpg', 30, 1, 26, 10, '2020-04-29 10:08:02'),
('918320', 'Funko Pop Animation Morty Pick', 'morty.jpg', 10, 1, 23, 10, '2020-04-29 10:08:02'),
('FP59', 'Funko Pop! Disney: Frozen 2 - ', 'funko.jpg', 25, 2, 35, 15, '2020-05-06 19:05:42'),
('HAT332', 'Novelty Place Guzzler Drinking', 'drinkhat.jpg', 40, 1, 31, 10, '2020-04-29 10:08:02'),
('KST01', 'KLIKBOT Studio Thud', 'klikbot.jpg', 20, 2, 34, 10, '2020-04-29 10:08:02'),
('LEX95', 'LEGO Classic Bricks and Ideas ', 'lego.jpg', 30, 2, 76, 15, '2020-04-29 10:08:02'),
('NRF10', 'Nerf N-Strike Elite Disruptor', 'nerfgun1.jpg', 25, 2, 10, 15, '2020-05-06 18:36:55'),
('PIN00', 'Plan Toys Pinball', 'pinball.jpg', 15, 2, 4, 5, '2020-05-06 18:39:16'),
('POL03', 'Polaroid Play 3D Pen', '3dpen.jpg', 40, 1, 186, 9, '2020-05-06 18:12:24'),
('PPF03', 'Portable Personal Fan', 'portablefan.jpg', 30, 1, 31, 15, '2020-04-29 10:08:02'),
('PWR41', 'USB Power Bank 10000mAh', 'powerbank1.jpg', 50, 1, 9, 10, '2020-05-06 19:02:18'),
('PWR43', 'USB Power Bank 20000mAh', 'powerbank2.jpg', 40, 1, 36, 10, '2020-04-29 10:08:02'),
('PWR44', 'USB Power Bank 25800mAh', 'powerbank3.png', 35, 1, 26, 8, '2020-04-29 10:08:02'),
('SC01', 'Spider Catcher', 'spidercatcher.jpg', 20, 1, 3, 5, '2020-05-06 18:54:16'),
('SW08', 'Star Wars USB Cup Warmer', 'starwarscupwarmer.jpg', 25, 1, 9, 10, '2020-05-06 19:02:58'),
('TEST1', 'Test Item', '', 20, 1, 8, 10, '2020-05-06 18:56:02');

--
-- Triggers `product`
--
DELIMITER $$
CREATE TRIGGER `Trigger` AFTER UPDATE ON `product` FOR EACH ROW BEGIN

IF  NEW.CurrentStockLevel < New.LowStockLevel THEN 


  SET @StaffID = (
			SELECT (StaffID) FROM `newstaff`
        WHERE departmentid = 4
		LIMIT 1
	);
    
SET @TotalCost = (
			SELECT (TotalCost) FROM `suppliedproducts` as SP INNER JOIN `product` as P on P.ProductCode = SP.ProductCode
        WHERE P.`ProductCode` = @ProductCode
        ORDER BY DeliveryTime  ASC
		LIMIT 1
);
    
    INSERT INTO `g4udatabase`.`order`
(`StaffID`,
`OrderTotal`)
VALUES
(
@StaffID,
0);


SET @OrderID = (
		SELECT (O.OrderID) FROM `order` as O
        ORDER BY OrderID DESC
		LIMIT 1
	);

SET @ProductCode = (

		SELECT (P.ProductCode) FROM `product` as P

		WHERE CurrentStockLevel < LowStockLevel 
                order by EditedTime DESC LIMIT 1
            
);



    
SET @TotalCost = (
			SELECT (TotalCost)  FROM `suppliedproducts` as SP INNER JOIN `product` as P on P.ProductCode = SP.ProductCode
        WHERE P.`ProductCode` = @ProductCode
        ORDER BY DeliveryTime  ASC
		LIMIT 1
);
    

    
SET @DeliveryDate = (
			SELECT DATE_ADD(CURDATE(), INTERVAL SP.DeliveryTime DAY)  FROM `order` as O
			INNER JOIN `orderedproducts` as OP on O.OrderID = OP.OrderID
            INNER JOIN `product` as P on P.ProductCode = OP.ProductCode
            INNER JOIN `suppliedproducts` AS SP ON P.ProductCode = SP.ProductCode
        WHERE P.`ProductCode` = @ProductCode 
        ORDER BY DeliveryTime  ASC
		LIMIT 1
	);
    


INSERT INTO `g4udatabase`.`orderedproducts`
(`OrderID`,
`QuantityOrdered`,
`Authorised`,
`ProductCode`,
`TotalCost`, `DeliveryDate`)
VALUES
(
@OrderID,
1,
0,
@ProductCode,
@TotalCost,
0);








    SET @SupplierID = (
			SELECT (SupplierID) FROM `suppliedproducts` AS SP INNER JOIN `product` as P on P.ProductCode = SP.ProductCode
      WHERE P.`ProductCode` = @ProductCode
        ORDER BY DeliveryTime  ASC
		LIMIT 1
	);

INSERT INTO `g4udatabase`.`suppliedorder`
(`OrderID`,
`SupplierID`,
`ProductCode`
)
VALUES
(
@OrderID,
@SupplierID,

@ProductCode
);
UPDATE `order` 
INNER JOIN orderedproducts ON `order`.OrderID = orderedproducts.OrderID
SET OrderTotal = @TotalCost WHERE orderedproducts.`ProductCode` = @ProductCode ;

UPDATE `orderedproducts` 
INNER JOIN suppliedproducts ON `suppliedproducts`.ProductCode = orderedproducts.ProductCode
SET DeliveryDate = @DeliveryDate WHERE orderedproducts.`ProductCode` = @ProductCode ;
END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `product_BEFORE_INSERT` BEFORE INSERT ON `product` FOR EACH ROW BEGIN
IF NEW.CategoryID != 1 OR 2 OR 3 THEN SET NEW.CategoryID = 1 OR 2 OR 3; END IF;

END
$$
DELIMITER ;

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
  `ProductCode` varchar(7) NOT NULL,
  `Delivered` tinyint(4) NOT NULL DEFAULT 0,
  `Checked` tinyint(4) NOT NULL DEFAULT 0,
  `Returned` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliedorder`
--

INSERT INTO `suppliedorder` (`SuppliedOrderID`, `OrderID`, `SupplierID`, `ProductCode`, `Delivered`, `Checked`, `Returned`) VALUES
(8, 16, 'SH', 'FP59', 1, 0, 0),
(9, 16, 'SH', 'LEX95', 1, 0, 0),
(10, 17, 'SH', 'LEX95', 1, 0, 0),
(11, 18, 'SH', 'NRF10', 1, 0, 0),
(12, 18, 'SH', 'LEX95', 0, 0, 0),
(14, 47, 'CT', 'TEST1', 0, 0, 0),
(15, 52, 'CT', 'TEST1', 0, 0, 0),
(16, 54, 'CT', 'TEST1', 0, 0, 0),
(17, 56, 'CT', 'TEST1', 0, 0, 0),
(18, 58, 'CT', 'TEST1', 0, 0, 0),
(19, 63, 'CT', 'TEST1', 0, 0, 0),
(20, 64, 'CT', 'TEST1', 0, 0, 0),
(21, 67, 'CT', 'TEST1', 0, 0, 0),
(22, 69, 'CT', 'TEST1', 0, 0, 0),
(23, 72, 'CT', 'TEST1', 0, 0, 0),
(24, 74, 'CT', 'TEST1', 0, 0, 0),
(25, 76, 'SH', 'FP59', 0, 0, 0),
(26, 79, 'CT', 'TEST1', 0, 0, 0),
(27, 81, 'CT', 'TEST1', 0, 0, 0),
(28, 86, 'CT', 'TEST1', 0, 0, 0),
(29, 88, 'CT', 'TEST1', 0, 0, 0),
(30, 90, 'CT', 'TEST1', 0, 0, 0),
(31, 92, 'BI', 'SW08', 0, 0, 0),
(32, 98, 'BI', 'SW08', 0, 0, 0),
(33, 100, 'SH', 'FP59', 0, 0, 0),
(34, 100, 'SH', 'LEX95', 0, 0, 0),
(35, 101, 'BS', 'KST01', 0, 0, 0),
(36, 103, 'CT', 'TEST1', 0, 0, 0),
(37, 104, 'CT', 'TEST1', 1, 1, 1),
(38, 105, 'SH', 'POL03', 1, 1, 0),
(42, 109, 'BI', 'SW08', 0, 0, 0),
(43, 110, 'CT', 'TEST1', 1, 1, 0),
(44, 112, 'BI', 'SW08', 0, 0, 0),
(45, 113, 'CT', 'TEST1', 0, 0, 0),
(46, 114, 'BI', 'NRF10', 0, 0, 0),
(47, 118, 'BI', 'PIN00', 0, 0, 0),
(48, 119, 'SH', 'POL03', 0, 0, 0),
(49, 120, 'CT', 'TEST1', 0, 0, 0),
(50, 122, 'BI', 'SW08', 0, 0, 0),
(51, 123, 'BS', 'SC01', 0, 0, 0),
(54, 126, 'CT', 'TEST1', 0, 0, 0),
(55, 127, 'CT', 'TEST1', 0, 0, 0),
(58, 131, 'BI', 'PWR41', 1, 1, 0),
(59, 131, 'BS', 'SW08', 1, 1, 0),
(60, 131, 'SH', 'POL03', 1, 0, 0),
(62, 133, 'BI', 'PWR41', 0, 0, 0),
(63, 134, 'BI', 'SW08', 0, 0, 0),
(64, 135, 'SH', 'FP59', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `suppliedproducts`
--

CREATE TABLE `suppliedproducts` (
  `SuppliedProductsID` int(11) NOT NULL,
  `SupplierID` varchar(3) NOT NULL,
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
(1, 'BI', 'Bitmore Inc', 5, '9.95', '1.99', '11.94', 'PWR41'),
(2, 'BS', 'BrainStorm Ltd', 5, '9.95', '1.99', '11.94', 'PWR41'),
(3, 'BI', 'Bitmore Inc', 5, '18.99', '3.80', '22.79', 'PWR43'),
(4, 'BS', 'BrainStorm Ltd', 5, '18.64', '3.73', '22.37', 'PWR43'),
(5, 'BI', 'Bitmore Inc', 5, '19.99', '4.00', '23.99', 'PWR44'),
(6, 'BS', 'BrainStorm Ltd', 5, '19.00', '3.80', '22.80', 'PWR44'),
(7, 'SH', 'Shenzhen Hosing Technology Development Co., Ltd.', 20, '1.58', '0.32', '1.90', 'SC01'),
(8, 'BS', 'BrainStorm Ltd', 3, '1.99', '0.40', '2.39', 'SC01'),
(9, 'BI', 'Bitmore Inc', 5, '5.65', '1.13', '6.78', 'PPF03'),
(10, 'SH', 'Shenzhen Hosing Technology Development Co., Ltd.', 15, '4.80', '0.96', '5.76', 'PPF03'),
(11, 'BS', 'BrainStorm Ltd', 5, '10.99', '2.20', '13.19', 'SW08'),
(12, 'BI', 'Bitmore Inc', 4, '9.99', '2.00', '11.99', 'SW08'),
(13, 'SH', 'Shenzhen Hosing Technology Development Co., Ltd.', 25, '9.85', '1.97', '11.82', 'SW08'),
(14, 'SH', 'Shenzhen Hosing Technology Development Co., Ltd.', 25, '22.00', '4.40', '26.40', 'POL03'),
(15, 'BS', 'BrainStorm Ltd', 4, '28.59', '5.72', '34.31', 'POL03'),
(16, 'BI', 'Bitmore Inc', 12, '12.99', '2.60', '15.59', 'NRF10'),
(17, 'SH', 'Shenzhen Hosing Technology Development Co., Ltd.', 30, '10.50', '2.10', '12.60', 'NRF10'),
(18, 'BS', 'BrainStorm Ltd', 12, '9.95', '1.99', '11.94', 'KST01'),
(19, 'SH', 'Shenzhen Hosing Technology Development Co., Ltd.', 30, '7.50', '1.50', '9.00', 'KST01'),
(20, 'BI', 'Bitmore Inc', 5, '40.00', '8.00', '48.00', 'PIN00'),
(21, 'CT', 'Cottage Toys', 6, '38.25', '7.65', '45.90', 'PIN00'),
(22, 'SH', 'Shenzhen Hosing Technology Development Co., Ltd.', 5, '7.50', '1.50', '9.00', 'FP59'),
(23, 'CT', 'Cottage Toys', 6, '7.10', '1.42', '8.52', 'FP59'),
(24, 'SH', 'Shenzhen Hosing Technology Development Co., Ltd.', 10, '7.68', '1.54', '9.22', 'LEX95'),
(25, 'CT', 'Cottage Toys', 5, '8.00', '1.60', '9.60', 'LEX95'),
(26, 'CT', 'Cottage Toys', 4, '9.00', '1.80', '10.80', 'SC01'),
(27, 'BI', 'Bitmore Inc', 7, '9.00', '1.80', '10.80', 'TEST1'),
(28, 'CT', 'Cottage Toys', 6, '10.00', '2.00', '12.00', 'TEST1');

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
('SH', 'Shenzhen Hosing Technology Development Co., Ltd.', 'Weixinda Industrial Par Caowei Xixiang Baoan District, Shenzhen, Guangdong 518128'),
('TE', 'TEST', 'TESTADDRESS1');

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
-- Indexes for table `newstaff`
--
ALTER TABLE `newstaff`
  ADD PRIMARY KEY (`staffid`),
  ADD KEY `stafffk1` (`storeid`),
  ADD KEY `stafffk2` (`departmentid`);

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
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`StoreID`);

--
-- Indexes for table `suppliedorder`
--
ALTER TABLE `suppliedorder`
  ADD PRIMARY KEY (`SuppliedOrderID`),
  ADD KEY `orderfk2` (`SupplierID`),
  ADD KEY `orderfk1` (`OrderID`);

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
  MODIFY `DepartmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `orderedproducts`
--
ALTER TABLE `orderedproducts`
  MODIFY `OrderedProductsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `StoreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliedorder`
--
ALTER TABLE `suppliedorder`
  MODIFY `SuppliedOrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `suppliedproducts`
--
ALTER TABLE `suppliedproducts`
  MODIFY `SuppliedProductsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orderedproducts`
--
ALTER TABLE `orderedproducts`
  ADD CONSTRAINT `orderedproductsfk1` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`),
  ADD CONSTRAINT `orderedproductsfk2` FOREIGN KEY (`ProductCode`) REFERENCES `product` (`ProductCode`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `productfk1` FOREIGN KEY (`CategoryID`) REFERENCES `category` (`CategoryID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `suppliedorder`
--
ALTER TABLE `suppliedorder`
  ADD CONSTRAINT `orderfk1` FOREIGN KEY (`OrderID`) REFERENCES `order` (`OrderID`),
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
