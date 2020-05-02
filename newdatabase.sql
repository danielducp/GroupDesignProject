-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2020 at 03:13 PM
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
(2, 'Toys'),
(3, 'Sweeties');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DepartmentID` int(11) NOT NULL,
  `DepartmentName` varchar(30) DEFAULT NULL,
  `TotalExpenditure` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DepartmentID`, `DepartmentName`, `TotalExpenditure`) VALUES
(1, 'Gadgets', '11.94'),
(2, 'Toys', '21.60'),
(3, 'Admin', '93.51'),
(4, 'Automation', '0.00');

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
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newstaff`
--

INSERT INTO `newstaff` (`staffid`, `stafftitle`, `staffname`, `staffrole`, `storeid`, `departmentid`, `password`) VALUES
('AUT123', 'AUT', 'AUTO MATIC', 'AUTOMATION', 1, 4, ''),
('BRE510', 'Mr', 'Jason Brentwood', 'Senior SalesPerson', 1, 3, '$2y$10$A13BcJnrm9sXxjvT8upumuG0.z0OUJB984zMtNwLirE1SvREkfqCy'),
('DANIEL', 'DANIEL', 'DANIEL', 'DANIEL', 1, 1, '$2y$10$05ZWZihfU9MdykNfI5hi6uvrse0iYODcQDq6eY7OwLk3EcP5sk07.'),
('DUN021', 'Ms', 'Sarah Dunkley', 'CEO PG4U', 1, 3, '$2y$10$EYFLSOD1u8v.mw9D1xym9eFJ1dClpr9UZYg8oBJ0mYeXlEpMkjDOW'),
('GRE056', 'Ms', 'Ann Greengold', 'Assistant QA Control', 1, 3, '$2y$10$CDUsckOulcIiwb01qVxyzuuxUeF1dyXDysitEe6zFejuogdqtCTLm'),
('GRE123', 'Miss', 'Jennifer Green', 'Sales Assistant', 1, 1, '$2y$10$31PldSH//xXmeAaAQGc7D.dePTQhOoAPNHyN4XyQdBZLzQEsy3MHC'),
('HID001', 'Sir', 'Adrian Hidcote-Armstrong', 'MD & Chairman of G4U', 1, 3, '$2y$10$1rWOFwEvj7cbapFUkE0ZP.wIhImneEiQTMnQ2vYYzPALr4mmY.TyC'),
('MAH042', 'Mr', 'Mustafa Mahmood', 'Sales Assistant', 1, 2, '$2y$10$/K1v0VmGBSiT.hhHp8oqpubYFvN39ipOCpUMq1ozWWTyh01tu3DIG'),
('PAT201', 'Ms', 'Amanda Patel', 'Sales Assistant', 1, 1, '$2y$10$g0QA3FsN1IeRKx9Ude.W7ufDgns1aeVwGHWnzXsI.Po0.yVwx3lIa'),
('PIA412', 'Mr', 'Enrico Piam', 'Sales Assistant', 1, 1, '$2y$10$/W3Dq8Xw1a//4bJfs47LGONFOYbrRWn00fT2zjEdCZWC7tiMuz/Fm'),
('PIT101', 'Mr', 'Derek Pitts', 'Sales Assistant', 1, 2, '$2y$10$ScGUm3zHTTatNaFflBcx9unqPU1VTY1lgUt2CcQafC2mdcfWTFw7i'),
('TEST', 'TESTING', 'TEST', 'TESTING', 1, 1, '$2y$10$u2/kPHZfs4J08kLaxzhAsOcwrRZUXxD0wr8DDsZRNmS/Y8WF06oAK'),
('VER121', 'Mr', 'John Vermont', 'Manager PG4U', 1, 3, '$2y$10$1F7jKk.kFptVJGUD3GWPa.YAI3CxVvBSQ9OslvBmAh5unNRdVGmmy');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `OrderID` int(11) NOT NULL,
  `OrderDate` date NOT NULL,
  `TransactionID` int(11) NOT NULL,
  `StaffID` varchar(10) DEFAULT NULL,
  `DeliveryStatus` tinyint(4) NOT NULL,
  `OrderTotal` decimal(6,2) DEFAULT 0.00,
  `OrderConfirmed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`OrderID`, `OrderDate`, `TransactionID`, `StaffID`, `DeliveryStatus`, `OrderTotal`, `OrderConfirmed`) VALUES
(2, '2020-04-30', 0, 'AUT123', 0, '48.00', 0),
(3, '2020-04-30', 0, 'AUT123', 0, '24.00', 0),
(4, '2020-04-30', 0, 'HID001', 1, '11.94', 1),
(5, '2020-04-30', 0, 'PIT101', 1, '12.60', 1),
(6, '2020-04-30', 0, 'PIT101', 1, '9.00', 1),
(7, '2020-04-30', 0, 'AUT123', 0, '48.00', 0),
(9, '2020-04-30', 0, 'HID001', 1, '9.22', 1),
(11, '2020-04-30', 0, 'AUT123', 0, '143.88', 0),
(12, '2020-04-30', 0, 'AUT123', 0, '48.00', 0),
(13, '2020-04-30', 0, 'AUT123', 0, '24.00', 0),
(16, '2020-04-30', 0, 'AUT123', 0, '47.96', 0),
(17, '2020-04-30', 0, 'AUT123', 0, '71.94', 0),
(20, '2020-04-30', 0, 'AUT123', 0, '4.78', 0),
(21, '2020-04-30', 0, 'AUT123', 0, '4.78', 0),
(23, '2020-04-30', 0, 'AUT123', 0, '143.94', 0),
(24, '2020-04-30', 0, 'AUT123', 0, '143.94', 0),
(27, '2020-04-30', 0, 'AUT123', 0, '71.64', 0),
(28, '2020-04-30', 0, 'AUT123', 0, '47.76', 0),
(29, '2020-04-30', 0, 'AUT123', 0, '47.76', 0),
(30, '2020-04-30', 0, 'AUT123', 0, '136.74', 0),
(31, '2020-04-30', 0, 'AUT123', 0, '205.86', 0),
(32, '2020-04-30', 0, 'AUT123', 0, '23.88', 0),
(33, '2020-04-30', 0, 'AUT123', 0, '162.72', 0),
(35, '2020-04-30', 0, 'AUT123', 0, '18.00', 0),
(36, '2020-04-30', 0, 'AUT123', 0, '18.00', 0),
(37, '2020-04-30', 0, 'AUT123', 0, '115.20', 0),
(38, '2020-04-30', 0, 'AUT123', 0, '115.20', 0),
(39, '2020-04-30', 0, 'AUT123', 0, '342.98', 0),
(40, '2020-04-30', 0, 'AUT123', 0, '342.98', 0),
(41, '2020-04-30', 0, 'AUT123', 0, '24.00', 0),
(42, '2020-04-30', 0, 'AUT123', 0, '48.00', 0),
(43, '2020-04-30', 0, 'AUT123', 0, '24.00', 0),
(44, '2020-04-30', 0, 'AUT123', 0, '48.00', 0),
(45, '2020-04-30', 0, 'AUT123', 0, '24.00', 0),
(46, '2020-04-30', 0, 'AUT123', 0, '24.00', 0),
(48, '2020-04-30', 0, 'HID001', 0, '9.22', 0),
(49, '2020-05-01', 0, 'HID001', 1, '9.00', 1),
(50, '2020-05-02', 0, '', 0, '12.50', 0),
(51, '2020-05-02', 0, 'DANIEL', 0, '18.00', 0),
(52, '2020-05-02', 0, 'DANIEL', 0, '8.52', 0),
(53, '2020-05-02', 0, 'DANIEL', 1, '11.94', 1),
(54, '2020-05-02', 0, NULL, 0, NULL, 0),
(55, '2020-05-02', 0, 'AUT123', 0, '25.00', 0),
(56, '2020-05-02', 0, 'AUT123', 0, '50.00', 0),
(57, '2020-05-02', 0, 'AUT123', 0, '25.00', 0),
(58, '2020-05-02', 0, 'AUT123', 0, '75.00', 0),
(59, '2020-05-02', 0, 'AUT123', 0, '75.00', 0),
(60, '2020-05-02', 0, 'AUT123', 0, '11.99', 0),
(61, '2020-05-02', 0, 'AUT123', 0, '11.99', 0),
(62, '2020-05-02', 0, 'AUT123', 0, '11.99', 0),
(63, '2020-05-02', 0, 'AUT123', 0, '11.99', 0),
(64, '2020-05-02', 0, 'AUT123', 0, '11.99', 0),
(65, '2020-05-02', 0, 'AUT123', 0, '12.50', 0),
(66, '2020-05-02', 0, 'AUT123', 0, '12.50', 0),
(67, '2020-05-02', 0, 'AUT123', 0, '25.00', 0),
(68, '2020-05-02', 0, 'AUT123', 0, '50.00', 0);

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
  `TotalCost` decimal(6,2) NOT NULL DEFAULT 0.00,
  `DeliveryDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orderedproducts`
--

INSERT INTO `orderedproducts` (`OrderedProductsID`, `OrderID`, `QuantityOrdered`, `Authorised`, `ProductCode`, `TotalCost`, `DeliveryDate`) VALUES
(3, 2, 4, 0, 'TEST1', '48.00', '2020-05-06'),
(4, 3, 2, 0, 'TEST1', '24.00', '2020-05-06'),
(5, 4, 1, 1, 'KST01', '11.94', '2020-05-06'),
(6, 5, 1, 1, 'NRF10', '12.60', '2020-05-06'),
(7, 6, 1, 1, 'KST01', '9.00', '2020-05-06'),
(8, 7, 4, 0, 'TEST1', '48.00', '2020-05-06'),
(10, 9, 1, 1, 'LEX95', '9.22', '2020-05-06'),
(11, 11, 2, 0, 'TEST1', '24.00', '2020-05-06'),
(12, 12, 4, 0, 'TEST1', '48.00', '2020-05-06'),
(13, 13, 2, 0, 'TEST1', '24.00', '2020-05-06'),
(14, 16, 4, 0, 'SW08', '47.96', '2020-05-06'),
(15, 17, 6, 0, 'SW08', '71.94', '2020-05-06'),
(18, 20, 2, 0, 'SC01', '4.78', '2020-05-06'),
(19, 21, 4, 0, 'TEST1', '48.00', '2020-05-06'),
(20, 23, 6, 0, 'PWR44', '143.94', '2020-05-06'),
(21, 24, 2, 0, 'TEST1', '24.00', '2020-05-06'),
(22, 27, 6, 0, 'PWR41', '71.64', '0000-00-00'),
(23, 28, 4, 0, 'PWR41', '47.76', '2020-05-05'),
(24, 29, 6, 0, 'PWR43', '136.74', '0000-00-00'),
(25, 30, 6, 0, 'POL03', '158.40', '0000-00-00'),
(26, 31, 2, 0, 'PWR41', '23.88', '2020-05-05'),
(27, 32, 24, 0, 'PPF03', '162.72', '2020-04-30'),
(28, 33, 2, 0, 'PIN00', '96.00', '2020-05-07'),
(29, 35, 2, 0, 'FP59', '18.00', '2020-05-07'),
(30, 36, 10, 0, 'LEX95', '92.20', '2020-05-07'),
(31, 37, 12, 0, 'LEX95', '110.64', '2020-05-07'),
(32, 38, 20, 0, 'NRF10', '311.80', '2020-05-07'),
(33, 39, 22, 0, 'NRF10', '342.98', '2020-05-07'),
(34, 40, 4, 0, 'TEST1', '43.20', '2020-05-07'),
(35, 41, 2, 0, 'TEST1', '21.60', '2020-05-07'),
(36, 42, 4, 0, 'TEST1', '43.20', '2020-05-07'),
(37, 43, 2, 0, 'TEST1', '21.60', '2020-05-07'),
(38, 44, 4, 0, 'TEST1', '43.20', '2020-05-07'),
(39, 45, 2, 0, 'TEST1', '24.00', '2020-05-06'),
(40, 46, 12, 0, 'KST01', '143.28', '2020-05-12'),
(41, 48, 1, 0, 'LEX95', '9.22', '2020-05-10'),
(42, 49, 1, 1, 'KST01', '9.00', '2020-05-31'),
(43, 50, 1, 0, '123366', '12.50', '2020-05-07'),
(44, 51, 2, 0, 'FP59', '18.00', '2020-05-07'),
(45, 52, 1, 0, 'FP59', '8.52', '2020-05-08'),
(46, 53, 1, 1, 'PWR41', '11.94', '2020-05-07'),
(47, 54, 4, 0, 'TEST1', '50.00', '2020-05-02'),
(48, 55, 2, 0, 'TEST1', '25.00', '2020-05-02'),
(49, 56, 4, 0, 'TEST1', '50.00', '2020-05-02'),
(50, 57, 2, 0, 'TEST1', '25.00', '2020-05-02'),
(51, 58, 6, 0, 'TEST1', '12.50', '2020-05-02'),
(52, 59, 2, 0, 'SW08', '11.99', '2020-05-04'),
(53, 59, 4, 0, 'SW08', '47.96', '2020-05-04'),
(54, 60, 2, 0, 'SW08', '23.98', '2020-05-04'),
(55, 61, 4, 0, 'SW08', '47.96', '2020-05-04'),
(56, 63, 2, 0, 'SW08', '11.99', '2020-05-04'),
(57, 64, 4, 0, 'TEST1', '50.00', '2020-05-04'),
(58, 65, 2, 0, 'TEST1', '25.00', '2020-05-04'),
(59, 66, 4, 0, 'TEST1', '50.00', '2020-05-04'),
(60, 66, 2, 0, 'TEST1', '25.00', '2020-05-02'),
(61, 67, 4, 0, 'TEST1', '50.00', '2020-05-02');

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
('DFDFDF', 'DDFSFDF', 'DFDFDFD', 0, 1, 33, 22, '2020-05-01 09:00:29'),
('FP59', 'Funko Pop! Disney: Frozen 2 - ', 'funko.jpg', 25, 2, 14, 15, '2020-04-30 20:34:32'),
('HAT332', 'Novelty Place Guzzler Drinking', 'drinkhat.jpg', 40, 1, 31, 10, '2020-04-29 10:08:02'),
('KST01', 'KLIKBOT Studio Thud', 'klikbot.jpg', 20, 2, 24, 10, '2020-05-01 15:11:49'),
('LEX95', 'LEGO Classic Bricks and Ideas ', 'lego.jpg', 30, 2, 9, 15, '2020-04-30 20:34:42'),
('NRF10', 'Nerf N-Strike Elite Disruptor', 'nerfgun1.jpg', 25, 2, 4, 15, '2020-04-30 20:35:17'),
('PIN00', 'Plan Toys Pinball', 'pinball.jpg', 15, 2, 4, 5, '2020-04-30 16:11:46'),
('POL03', 'Polaroid Play 3D Pen', '3dpen.jpg', 40, 1, 6, 9, '2020-04-30 15:48:26'),
('PPF03', 'Portable Personal Fan', 'portablefan.jpg', 30, 1, 3, 15, '2020-04-30 16:09:46'),
('PWR41', 'USB Power Bank 10000mAh', 'powerbank1.jpg', 50, 1, 61, 10, '2020-05-02 11:22:32'),
('PWR43', 'USB Power Bank 20000mAh', 'powerbank2.jpg', 40, 1, 7, 10, '2020-04-30 15:45:59'),
('PWR44', 'USB Power Bank 25800mAh', 'powerbank3.png', 35, 1, 5, 8, '2020-04-30 15:29:29'),
('SC01', 'Spider Catcher', 'spidercatcher.jpg', 20, 1, 4, 5, '2020-04-30 15:15:34'),
('SW08', 'Star Wars USB Cup Warmer', 'starwarscupwarmer.jpg', 25, 1, 9, 10, '2020-05-02 11:39:52'),
('TEST1', 'Test Item', '', 20, 1, 8, 10, '2020-05-02 12:21:51');

--
-- Triggers `product`
--
DELIMITER $$
CREATE TRIGGER `Products` AFTER UPDATE ON `product` FOR EACH ROW BEGIN
IF  NEW.CurrentStockLevel < New.LowStockLevel THEN

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


 SET @QuantityOrdered = (
     select (LowStockLevel-CurrentStockLevel)*2 from product AS P
            WHERE P.`ProductCode` = @ProductCode   LIMIT 1
);
    
    
SET @TotalCost = (
			SELECT (TotalCost)*@QuantityOrdered  FROM `suppliedproducts` as SP INNER JOIN `product` as P on P.ProductCode = SP.ProductCode
        WHERE P.`ProductCode` = @ProductCode
        ORDER BY DeliveryTime  ASC
		LIMIT 1
);
    

    
SET @DeliveryDate = (
			SELECT DATE_ADD(OrderDate, INTERVAL SP.DeliveryTime DAY)  FROM `order` as O
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
@QuantityOrdered,
0,
@ProductCode,
@TotalCost,
@DeliveryDate);



  SET @StaffID = (
			SELECT (StaffID) FROM `staff`
        WHERE departmentid = 4
		LIMIT 1
	);





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

END IF;
	
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `product_AFTER_UPDATE` AFTER UPDATE ON `product` FOR EACH ROW BEGIN
IF  NEW.CurrentStockLevel < New.LowStockLevel THEN 
 SET @QuantityOrdered = (
     select (LowStockLevel-CurrentStockLevel)*2 from product AS P
            WHERE P.`ProductCode` = @ProductCode   LIMIT 1
);
    
    
SET @TotalCost = (
			SELECT (TotalCost)*@QuantityOrdered  FROM `suppliedproducts` as SP INNER JOIN `product` as P on P.ProductCode = SP.ProductCode
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
@TotalCost);

    
    
END IF;


END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` varchar(10) NOT NULL,
  `StaffTitle` varchar(10) NOT NULL,
  `StaffName` varchar(30) NOT NULL,
  `StaffRole` varchar(20) NOT NULL,
  `StoreID` int(11) DEFAULT NULL,
  `DepartmentID` int(11) DEFAULT NULL,
  `Password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `StaffTitle`, `StaffName`, `StaffRole`, `StoreID`, `DepartmentID`, `Password`) VALUES
('AUT123', 'AUT', 'AUTO MATIC', 'AUTOMATION', 1, 4, ''),
('BRE510', 'Mr', 'Jason Brentwood', 'Senior SalesPerson G', 1, NULL, 'password3'),
('DANIEL', 'DA', 'DANIEL', 'DANIEL', 1, 1, '$2y$10$gT4'),
('DUN021', 'Ms', 'Sarah Dunkley', 'CEO PG4U', 1, NULL, 'password1'),
('e4ww4w', 'NET', 'dfdrd', 'ddfd', 1, 1, 'blanking'),
('GRE056', 'Ms', 'Ann Greengold', 'Assistant QA Control', 1, NULL, 'password9'),
('GRE123', 'Miss', 'Jennifer Green', 'Sales Assistant GT', 1, 1, 'password6'),
('HID001', 'Sir', 'Adrian Hidcote-Armstrong', 'MD & Chairman of G4U', NULL, 3, 'password'),
('MAH042', 'Mr', 'Mustafa Mahmood', 'Sales Assistant GT', 1, 2, 'password5'),
('PAT201', 'Ms', 'Amanda Patel', 'Sales Assistant GT', 1, 1, 'password4'),
('PIA412', 'Mr', 'Enrico Piam', 'Sales Assistant GT', 1, 1, 'password8'),
('PIT101', 'Mr', 'Derek Pitts', 'Sales Assistant GT', 1, 2, 'password7'),
('TEST', 'TEST', 'TEST', 'TEST', 1, 1, '$2y$10$rSy'),
('VER121', 'Mr', 'John Vermont', 'Mgr PG4U GT Dept.', 1, NULL, 'password2');

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
  `Delivered` tinyint(4) DEFAULT NULL,
  `Checked` tinyint(4) DEFAULT NULL,
  `Returned` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliedorder`
--

INSERT INTO `suppliedorder` (`SuppliedOrderID`, `OrderID`, `SupplierID`, `ProductCode`, `Delivered`, `Checked`, `Returned`) VALUES
(1, 2, 'CT', 'TEST1', 0, 0, 0),
(2, 3, 'CT', 'TEST1', 0, 0, 0),
(3, 4, 'BS', 'KST01', 1, 1, 0),
(4, 5, 'SH', 'NRF10', 1, 1, 0),
(5, 6, 'SH', 'KST01', 1, 1, 0),
(6, 7, 'CT', 'TEST1', 0, 0, 0),
(8, 9, 'SH', 'LEX95', 1, 1, 0),
(9, 11, 'CT', 'TEST1', 0, 0, 0),
(10, 12, 'CT', 'TEST1', 0, 0, 0),
(11, 13, 'CT', 'TEST1', 0, 0, 0),
(12, 16, 'BI', 'SW08', 0, 0, 0),
(13, 17, 'BI', 'SW08', 0, 0, 0),
(14, 20, 'BS', 'SC01', 0, 0, 0),
(15, 21, 'CT', 'TEST1', 0, 0, 0),
(16, 23, 'BI', 'PWR44', NULL, NULL, NULL),
(17, 24, 'CT', 'TEST1', NULL, NULL, NULL),
(18, 27, 'BI', 'PWR41', NULL, NULL, NULL),
(19, 28, 'BI', 'PWR41', NULL, NULL, NULL),
(20, 29, 'BI', 'PWR43', NULL, NULL, NULL),
(21, 30, 'BS', 'POL03', 0, 0, 0),
(22, 31, 'BI', 'PWR41', 0, 0, 0),
(23, 32, 'BI', 'PPF03', 0, 0, 0),
(24, 33, 'BI', 'PIN00', 0, 0, 0),
(25, 35, 'SH', 'FP59', 0, 0, 0),
(26, 36, 'CT', 'LEX95', 0, 0, 0),
(27, 37, 'CT', 'LEX95', 0, 0, 0),
(28, 38, 'BI', 'NRF10', 0, 0, 0),
(29, 39, 'BI', 'NRF10', 0, 0, 0),
(30, 40, 'CT', 'TEST1', 0, 0, 0),
(31, 41, 'CT', 'TEST1', 0, 0, 0),
(32, 42, 'CT', 'TEST1', 0, 0, 0),
(33, 43, 'CT', 'TEST1', 0, 0, 0),
(34, 44, 'CT', 'TEST1', 0, 0, 0),
(35, 45, 'CT', 'TEST1', NULL, NULL, NULL),
(36, 46, 'BS', 'KST01', NULL, NULL, NULL),
(37, 48, 'SH', 'LEX95', 0, 0, 0),
(38, 49, 'SH', 'KST01', 1, 1, 0),
(39, 50, 'TE', '123366', 0, 0, 0),
(40, 51, 'SH', 'FP59', 0, 0, 0),
(41, 52, 'CT', 'FP59', 0, 0, 0),
(42, 53, 'BI', 'PWR41', 1, 1, 0),
(43, 54, 'TE', 'TEST1', NULL, NULL, NULL),
(44, 55, 'TE', 'TEST1', NULL, NULL, NULL),
(45, 56, 'TE', 'TEST1', NULL, NULL, NULL),
(46, 57, 'TE', 'TEST1', NULL, NULL, NULL),
(47, 58, 'TE', 'TEST1', NULL, NULL, NULL),
(48, 59, 'BI', 'SW08', NULL, NULL, NULL),
(49, 59, 'BI', 'SW08', NULL, NULL, NULL),
(50, 60, 'BI', 'SW08', NULL, NULL, NULL),
(51, 61, 'BI', 'SW08', NULL, NULL, NULL),
(52, 63, 'BI', 'SW08', NULL, NULL, NULL),
(53, 64, 'TE', 'TEST1', NULL, NULL, NULL),
(54, 65, 'TE', 'TEST1', NULL, NULL, NULL),
(55, 66, 'TE', 'TEST1', NULL, NULL, NULL),
(56, 66, 'TE', 'TEST1', NULL, NULL, NULL),
(57, 67, 'TE', 'TEST1', NULL, NULL, NULL);

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
(0, 'TE', 'TESTING', 2, '10.00', '2.50', '12.50', 'TEST1'),
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
('SH', 'Shenzhen Hosing Technology Development Co., Ltd.', 'Weixinda Industrial Par Caowei Xixiang Baoan District, Shenzhen, Guangdong 518128');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `fname` varchar(32) DEFAULT NULL,
  `lname` varchar(64) DEFAULT NULL,
  `uname` varchar(64) DEFAULT NULL,
  `password` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `lname`, `uname`, `password`) VALUES
(1, 'daniel', 'dicker', 'ncfcdaniel', '$2y$10$zEpvBnBr8aMJRsxGINYrJOrkOPLxGaAT1SjjlvbtDN0gVZ/e.EbgO');

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
  ADD PRIMARY KEY (`staffid`);

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
  ADD PRIMARY KEY (`StaffID`),
  ADD KEY `stafffk1` (`StoreID`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uname` (`uname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DepartmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `orderedproducts`
--
ALTER TABLE `orderedproducts`
  MODIFY `OrderedProductsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `StoreID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `suppliedorder`
--
ALTER TABLE `suppliedorder`
  MODIFY `SuppliedOrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
