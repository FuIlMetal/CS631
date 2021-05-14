-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: sql1.njit.edu
-- Generation Time: May 01, 2021 at 11:10 PM
-- Server version: 8.0.17
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";# MySQL returned an empty result set (i.e. zero rows).

SET time_zone = "+00:00";# MySQL returned an empty result set (i.e. zero rows).



/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;# MySQL returned an empty result set (i.e. zero rows).

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;# MySQL returned an empty result set (i.e. zero rows).

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;# MySQL returned an empty result set (i.e. zero rows).

/*!40101 SET NAMES utf8 */;# MySQL returned an empty result set (i.e. zero rows).


--
-- Database: `aa2296`
--

-- --------------------------------------------------------

--
-- Table structure for table `BillP`
--

CREATE TABLE IF NOT EXISTS `BillP` (
  `PartID` int(11) NOT NULL,
  `AID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;# MySQL returned an empty result set (i.e. zero rows).


-- --------------------------------------------------------

--
-- Table structure for table `BillT`
--

CREATE TABLE IF NOT EXISTS `BillT` (
  `TestID` int(5) NOT NULL,
  `AID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;# MySQL returned an empty result set (i.e. zero rows).


-- --------------------------------------------------------

--
-- Table structure for table `Car`
--

CREATE TABLE IF NOT EXISTS `Car` (
  `CarID` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Cost` int(15) NOT NULL,
  `Color` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `VID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;# MySQL returned an empty result set (i.e. zero rows).



-- --------------------------------------------------------

--
-- Table structure for table `Customer`
--

CREATE TABLE IF NOT EXISTS `Customer` (
  `CID` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Fname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Lname` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;# MySQL returned an empty result set (i.e. zero rows).


-- --------------------------------------------------------

--
-- Table structure for table `Part`
--

CREATE TABLE IF NOT EXISTS `Part` (
  `PartID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `CostOfPart` int(11) NOT NULL,
  `PartName` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;# MySQL returned an empty result set (i.e. zero rows).


-- --------------------------------------------------------

--
-- Table structure for table `Purchase`
--

CREATE TABLE IF NOT EXISTS `Purchase` (
  `TransID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `DateOfPurchase` date NOT NULL,
  `CID` int(5) NOT NULL,
  `CarID` int(5) NOT NULL,
  `SalePrice` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;# MySQL returned an empty result set (i.e. zero rows).




-- --------------------------------------------------------

--
-- Table structure for table `Service Appointment`
--

CREATE TABLE IF NOT EXISTS `Service Appointment` (
  `AID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `PickupDate` datetime NOT NULL,
  `ActualDropoff` datetime DEFAULT NULL,
  `ScheduledDropoff` datetime NOT NULL,
  `AppMadeDate` date NOT NULL,
  `PID` int(10) NOT NULL,
  `CID` int(5) NOT NULL,
  `CarID` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;# MySQL returned an empty result set (i.e. zero rows).


-- --------------------------------------------------------

--
-- Table structure for table `Service Package`
--

CREATE TABLE IF NOT EXISTS `Service Package` (
  `PID` int(10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `PackageCost` int(10) NOT NULL,
  `TimeSincePurchased` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;# MySQL returned an empty result set (i.e. zero rows).



-- --------------------------------------------------------

--
-- Table structure for table `PPart`
--

CREATE TABLE IF NOT EXISTS `PPart` (
  `PartID` int(11) NOT NULL,
  `PID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;# MySQL returned an empty result set (i.e. zero rows).

-- --------------------------------------------------------

--
-- Table structure for table `PTask`
--

CREATE TABLE IF NOT EXISTS `PTask` (
  `TestID` int(5) NOT NULL,
  `PID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;# MySQL returned an empty result set (i.e. zero rows).

-- --------------------------------------------------------

--
-- Table structure for table `Test`
--

CREATE TABLE IF NOT EXISTS `Test` (
  `TestID` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `TestName` varchar(30) NOT NULL,
  `LabourCost` int(10) NOT NULL,
  `Time` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;# MySQL returned an empty result set (i.e. zero rows).




-- --------------------------------------------------------

--
-- Table structure for table `Vehicle Type`
--

CREATE TABLE IF NOT EXISTS `Vehicle Type` (
  `VID` int(5) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Make` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Model` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;# MySQL returned an empty result set (i.e. zero rows).



--
-- Indexes for dumped tables
--

--
-- Indexes for table `BillP`
--
ALTER TABLE `BillP`
 ADD KEY `AID` (`AID`), ADD KEY `PartID` (`PartID`);


--
-- Indexes for table `BillT`
--
ALTER TABLE `BillT`
 ADD KEY `AID` (`AID`), ADD KEY `TestID` (`TestID`);

--
-- Indexes for table `Car`
--
ALTER TABLE `Car`
 ADD KEY `VID` (`VID`);# MySQL returned an empty result set (i.e. zero rows).


--
-- Indexes for table `Customer`
--
ALTER TABLE `Customer`
 ADD UNIQUE KEY `cid` (`CID`);# MySQL returned an empty result set (i.e. zero rows).


--
-- Indexes for table `Purchase`
--
ALTER TABLE `Purchase`
 ADD KEY `CarID` (`CarID`), ADD KEY `CID` (`CID`);# MySQL returned an empty result set (i.e. zero rows).


--
-- Indexes for table `Service Appointment`
--
ALTER TABLE `Service Appointment`
 ADD KEY `PID` (`PID`), ADD KEY `CID` (`CID`), ADD KEY `CarID` (`CarID`);# MySQL returned an empty result set (i.e. zero rows).



--
-- Indexes for table `PPart`
--
ALTER TABLE `PPart`
 ADD KEY `PartID` (`PartID`), ADD KEY `PID` (`PID`);# MySQL returned an empty result set (i.e. zero rows).


--
-- Indexes for table `PTask`
--
ALTER TABLE `PTask`
 ADD KEY `TestID` (`TestID`), ADD KEY `PID` (`PID`);# MySQL returned an empty result set (i.e. zero rows).


--
-- Constraints for dumped tables
--

--
-- Constraints for table `BillP`
--
ALTER TABLE `BillP`
ADD CONSTRAINT `BillP_ibfk_1` FOREIGN KEY (`PartID`) REFERENCES `Part` (`PartID`),
ADD CONSTRAINT `BillP_ibfk_2` FOREIGN KEY (`AID`) REFERENCES `Service Appointment` (`AID`);# 1 row affected.

--
-- Constraints for table `BillT`
--
ALTER TABLE `BillT`
ADD CONSTRAINT `BillT_ibfk_1` FOREIGN KEY (`TestID`) REFERENCES `Test` (`TestID`),
ADD CONSTRAINT `BillT_ibfk_2` FOREIGN KEY (`AID`) REFERENCES `Service Appointment` (`AID`);

--
-- Constraints for table `Car`
--
ALTER TABLE `Car`
ADD CONSTRAINT `Car_ibfk_1` FOREIGN KEY (`VID`) REFERENCES `Vehicle Type` (`VID`);# 4 rows affected.


--
-- Constraints for table `Purchase`
--
ALTER TABLE `Purchase`
ADD CONSTRAINT `Purchase_ibfk_1` FOREIGN KEY (`CarID`) REFERENCES `Car` (`CarID`),
ADD CONSTRAINT `Purchase_ibfk_2` FOREIGN KEY (`CID`) REFERENCES `Customer` (`CID`);# 2 rows affected.


--
-- Constraints for table `Service Appointment`
--
ALTER TABLE `Service Appointment`
ADD CONSTRAINT `Service Appointment_ibfk_2` FOREIGN KEY (`PID`) REFERENCES `Service Package` (`PID`),
ADD CONSTRAINT `Service Appointment_ibfk_3` FOREIGN KEY (`CID`) REFERENCES `Customer` (`CID`),
ADD CONSTRAINT `Service Appointment_ibfk_4` FOREIGN KEY (`CarID`) REFERENCES `Car` (`CarID`);# 1 row affected.


--
-- Constraints for table `PPart`
--
ALTER TABLE `PPart`
ADD CONSTRAINT `PPart_ibfk_1` FOREIGN KEY (`PartID`) REFERENCES `Part` (`PartID`),
ADD CONSTRAINT `PPart_ibfk_2` FOREIGN KEY (`PID`) REFERENCES `Service Package` (`PID`);

--
-- Constraints for table `PTask`
--
ALTER TABLE `PTask`
ADD CONSTRAINT `PTask_ibfk_1` FOREIGN KEY (`TestID`) REFERENCES `Test` (`TestID`),
ADD CONSTRAINT `PTask_ibfk_2` FOREIGN KEY (`PID`) REFERENCES `Service Package` (`PID`);

--
-- Dumping data for table `Customer`
--

INSERT INTO `Customer` (`Fname`, `Lname`, `Email`) VALUES
('Akash', 'Ak', 'aa01@gmail.com'),
('Ben', 'T', 'bt02@gmail.com'),
('Smith', 'B', 'sb03@gmail.com'),
('John', 'C', 'jc04@gmail.com');# 4 rows affected.


--
-- Dumping data for table `Vehicle Type`
--

INSERT INTO `Vehicle Type` (`Make`, `Model`, `Year`) VALUES
('Ford', 'SUV', 2018),
('Tesla', 'model X', 2016),
('Ford', 'sedan', 2015),
('Tesla', 'model Y', 2020);# 4 rows affected.

--
-- Dumping data for table `Test`
--

INSERT INTO `Test` (`TestName`, `LabourCost`, `Time`) VALUES
('Braking System', 250, 2),
('tyre alignment', 200, 1);# 2 rows affected.


--
-- Dumping data for table `Part`
--

INSERT INTO `Part` (`CostOfPart`, `PartName`) VALUES
(100, 'Brakes'),
(500, 'Tyres');# 2 rows affected.


--
-- Dumping data for table `Car`
--

INSERT INTO `Car` (`Cost`, `Color`, `VID`) VALUES
(30000, 'Red', 1),
(25000, 'sliver', 2),
(20000, 'Blue', 3),
(35000, 'Black', 4);# 4 rows affected.


--
-- Dumping data for table `Purchase`
--

INSERT INTO `Purchase` (`DateOfPurchase`, `CID`, `CarID`, `SalePrice`) VALUES
('2020-11-04', 1, 1, 35000),
('2020-08-11', 2, 4, 45000);# 2 rows affected.



--
-- Dumping data for table `Service Package`
--

INSERT INTO `Service Package` (`PackageCost`, `TimeSincePurchased`) VALUES
(2500, 0),
(3000, 1),
(3000, 2),
(3500, 3);# 4 rows affected.

--
-- Dumping data for table `Service Appointment`
--

INSERT INTO `Service Appointment` (`PickupDate`, `ActualDropoff`, `ScheduledDropoff`, `AppMadeDate`, `PID`, `CID`, `CarID`) VALUES
('2021-02-05 22:03:28', '2021-02-05 19:03:28', '2021-02-05 19:03:28', '2021-02-02', 1, 1, 1);# 1 row affected.


--
-- Dumping data for table `PPart`
--

INSERT INTO `PPart` (`PartID`, `PID`) VALUES
(2, 1);# 2 rows affected.

--
-- Dumping data for table `PTask`
--

INSERT INTO `PTask` (`TestID`, `PID`) VALUES
(1, 1),
(2, 2),
(1, 3),
(1, 4),
(2, 4);

--
-- Dumping data for table `BillP`
--

INSERT INTO `BillP` ( `PartID`, `AID`) VALUES
(1, 1);# 1 row affected.


--
-- Dumping data for table `BillT`
--

INSERT INTO `BillT` ( `TestID`, `AID`) VALUES
(2, 1);# 1 row affected.

 
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;# MySQL returned an empty result set (i.e. zero rows).

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;# MySQL returned an empty result set (i.e. zero rows).

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;# MySQL returned an empty result set (i.e. zero rows).
