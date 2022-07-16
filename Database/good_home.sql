-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2021 at 03:52 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `good_home`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `Id` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Owner_ID` int(11) NOT NULL,
  `Flat_ID` int(11) NOT NULL,
  `Day` varchar(50) NOT NULL,
  `Time` time NOT NULL,
  `Status` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`Id`, `Customer_ID`, `Owner_ID`, `Flat_ID`, `Day`, `Time`, `Status`) VALUES
(2, 9, 1, 6, 'sunday', '09:00:00', ''),
(3, 9, 1, 6, 'monday', '09:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `Client_ID` int(11) NOT NULL,
  `Bank_Name` varchar(50) NOT NULL,
  `Bank_Branch` varchar(50) NOT NULL,
  `Account_No` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`Client_ID`, `Bank_Name`, `Bank_Branch`, `Account_No`) VALUES
(8, 'Al-Ahly', 'sidisalem', 1234566);

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `ID` int(11) NOT NULL,
  `Client_ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `BirthDate` date NOT NULL,
  `Mobile` int(11) NOT NULL,
  `Telephone` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Client_Type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`ID`, `Client_ID`, `Name`, `Email`, `BirthDate`, `Mobile`, `Telephone`, `Username`, `Password`, `Client_Type`) VALUES
(1, 123456789, 'Najd mansour\n', 'Najd.mansoor9@gmail.com\n', '2000-07-04', 594627477, 22488163, 'admin', '1admin', 'admin'),
(8, 123456789, 'abdallah mohamed', 'abdallah.mohamed.conan@gmail.com', '1999-11-01', 12234345, 345345435, 'colonel', '1colonel', 'owner'),
(9, 123456789, 'bassem', 'abdallah.mohamed.conan@gmail.com', '2021-12-08', 11322, 123213, 'drcolonel', '1drcolonel', 'customer');

-- --------------------------------------------------------

--
-- Table structure for table `flat`
--

CREATE TABLE `flat` (
  `Id` int(11) NOT NULL,
  `Cost` decimal(10,0) NOT NULL,
  `Built` year(4) NOT NULL,
  `Bedrooms_No` int(11) NOT NULL,
  `Bathrooms_No` int(11) NOT NULL,
  `Size` decimal(10,0) NOT NULL,
  `Features` varchar(255) NOT NULL,
  `Approved` varchar(1) NOT NULL,
  `Owner_ID` int(11) NOT NULL,
  `Rent_Condition` varchar(20) NOT NULL,
  `Rent_Period` int(11) NOT NULL,
  `Available_Date` date NOT NULL,
  `Timetable_Days` varchar(255) NOT NULL,
  `Timetable_Start` time NOT NULL,
  `Timetable_End` time NOT NULL,
  `Detail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flat`
--

INSERT INTO `flat` (`Id`, `Cost`, `Built`, `Bedrooms_No`, `Bathrooms_No`, `Size`, `Features`, `Approved`, `Owner_ID`, `Rent_Condition`, `Rent_Period`, `Available_Date`, `Timetable_Days`, `Timetable_Start`, `Timetable_End`, `Detail`) VALUES
(2, '56000', 2010, 3, 2, '200', 'Has_AirCondition,Has_Heating,Has_Acecss,Has_CarParking,Has_BackYard,Has_PlayGround', 'T', 1, 'rented', 3, '2023-12-13', 'sunday,monday', '10:00:00', '18:00:00', 'Fusce quis ex tincidunt, posuere lacus maximus ipsum suspendisse scelerisque elit ut nunc aliquam a pretium lacus tempor phasellus gravida nibh et molestie semper. Nam dignissim, tellus non eleifend rutrum turpis nulla pharetra dolor eu suscipit sapien neque non turpis. Fusce dignissim sodales arcu, quis vehicula sem dignissim non donec molestie posuere dignissim. Cras vel arcu libero. Vivamus ex enim, euismod porttitor arcu sagittis, bibendum interdum enim.'),
(3, '1050', 2014, 2, 2, '180', 'Has_AirCondition,Has_Heating,Has_Acecss,Has_CarParking,Has_BackYard,Has_PlayGround', 'T', 1, 'rented', 2, '2023-12-28', 'monday,wednesday', '11:00:00', '16:00:00', 'Fusce quis ex tincidunt, posuere lacus maximus ipsum suspendisse scelerisque elit ut nunc aliquam a pretium lacus tempor phasellus gravida nibh et molestie semper. Nam dignissim, tellus non eleifend rutrum turpis nulla pharetra dolor eu suscipit sapien neque non turpis. Fusce dignissim sodales arcu, quis vehicula sem dignissim non donec molestie posuere dignissim. Cras vel arcu libero. Vivamus ex enim, euismod porttitor arcu sagittis, bibendum interdum enim.'),
(4, '1350', 2012, 2, 2, '200', 'Has_AirCondition,Has_Heating,Has_Acecss,Has_CarParking,Has_BackYard,Has_PlayGround', 'T', 1, 'available', 5, '2016-12-01', 'saturday,monday', '10:00:00', '15:00:00', 'Fusce quis ex tincidunt, posuere lacus maximus ipsum suspendisse scelerisque elit ut nunc aliquam a pretium lacus tempor phasellus gravida nibh et molestie semper. Nam dignissim, tellus non eleifend rutrum turpis nulla pharetra dolor eu suscipit sapien neque non turpis. Fusce dignissim sodales arcu, quis vehicula sem dignissim non donec molestie posuere dignissim. Cras vel arcu libero. Vivamus ex enim, euismod porttitor arcu sagittis, bibendum interdum enim.'),
(5, '2000', 2015, 2, 2, '300', 'Has_AirCondition,Has_Heating,Has_Acecss,Has_CarParking,Has_BackYard,Has_PlayGround', 'T', 1, 'rented', 4, '2026-12-03', 'sunday,wednesday', '08:00:00', '17:00:00', 'Fusce quis ex tincidunt, posuere lacus maximus ipsum suspendisse scelerisque elit ut nunc aliquam a pretium lacus tempor phasellus gravida nibh et molestie semper. Nam dignissim, tellus non eleifend rutrum turpis nulla pharetra dolor eu suscipit sapien neque non turpis. Fusce dignissim sodales arcu, quis vehicula sem dignissim non donec molestie posuere dignissim. Cras vel arcu libero. Vivamus ex enim, euismod porttitor arcu sagittis, bibendum interdum enim.'),
(6, '2350', 2016, 4, 2, '700', 'Has_AirCondition,Has_Heating,Has_Acecss,Has_CarParking,Has_BackYard,Has_PlayGround', 'T', 1, 'available', 1, '2021-12-27', 'sunday,monday,wednesday', '09:00:00', '13:00:00', 'Fusce quis ex tincidunt, posuere lacus maximus ipsum suspendisse scelerisque elit ut nunc aliquam a pretium lacus tempor phasellus gravida nibh et molestie semper. Nam dignissim, tellus non eleifend rutrum turpis nulla pharetra dolor eu suscipit sapien neque non turpis. Fusce dignissim sodales arcu, quis vehicula sem dignissim non donec molestie posuere dignissim. Cras vel arcu libero. Vivamus ex enim, euismod porttitor arcu sagittis, bibendum interdum enim.'),
(7, '1900', 2011, 2, 2, '450', 'Has_AirCondition,Has_Heating,Has_Acecss,Has_CarParking,Has_BackYard,Has_PlayGround', 'T', 1, 'rented', 1, '2024-12-03', 'saturday,sunday,monday', '07:00:00', '12:00:00', 'Fusce quis ex tincidunt, posuere lacus maximus ipsum suspendisse scelerisque elit ut nunc aliquam a pretium lacus tempor phasellus gravida nibh et molestie semper. Nam dignissim, tellus non eleifend rutrum turpis nulla pharetra dolor eu suscipit sapien neque non turpis. Fusce dignissim sodales arcu, quis vehicula sem dignissim non donec molestie posuere dignissim. Cras vel arcu libero. Vivamus ex enim, euismod porttitor arcu sagittis, bibendum interdum enim.'),
(13, '1234', 2021, 2, 2, '122', 'Has_AirCondition,Has_Heating,Has_Acecss,Has_CarParking,Has_BackYard,Has_PlayGround', 'T', 8, 'available', 2, '1970-01-01', 'saturday,sunday,monday,wednesday', '02:00:00', '14:58:00', 'Fusce quis ex tincidunt, posuere lacus maximus ipsum suspendisse scelerisque elit ut nunc aliquam a pretium lacus tempor phasellus gravida nibh et molestie semper. Nam dignissim, tellus non eleifend rutrum turpis nulla pharetra dolor eu suscipit sapien neque non turpis. Fusce dignissim sodales arcu, quis vehicula sem dignissim non donec molestie posuere dignissim. Cras vel arcu libero. Vivamus ex enim, euismod porttitor arcu sagittis, bibendum interdum enim.'),
(14, '1234', 2021, 2, 2, '122', 'Has_AirCondition,Has_Heating,Has_Acecss,Has_CarParking,Has_BackYard,Has_PlayGround', '', 1, 'available', 3, '2021-12-26', 'saturday,sunday,monday,wednesday', '02:00:00', '14:58:00', 'Fusce quis ex tincidunt, posuere lacus maximus ipsum suspendisse scelerisque elit ut nunc aliquam a pretium lacus tempor phasellus gravida nibh et molestie semper. Nam dignissim, tellus non eleifend rutrum turpis nulla pharetra dolor eu suscipit sapien neque non turpis. Fusce dignissim sodales arcu, quis vehicula sem dignissim non donec molestie posuere dignissim. Cras vel arcu libero. Vivamus ex enim, euismod porttitor arcu sagittis, bibendum interdum enim.');

-- --------------------------------------------------------

--
-- Table structure for table `flat_features`
--

CREATE TABLE `flat_features` (
  `Flat_ID` int(11) NOT NULL,
  `Has_Heating` varchar(1) DEFAULT NULL,
  `Has_AirCondition` varchar(1) DEFAULT NULL,
  `Has_Acecss` varchar(1) DEFAULT NULL,
  `Has_CarParking` varchar(1) NOT NULL,
  `Has_BackYard` varchar(1) NOT NULL,
  `Has_PlayGround` varchar(1) NOT NULL,
  `Has_Storage` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flat_features`
--

INSERT INTO `flat_features` (`Flat_ID`, `Has_Heating`, `Has_AirCondition`, `Has_Acecss`, `Has_CarParking`, `Has_BackYard`, `Has_PlayGround`, `Has_Storage`) VALUES
(2, 'T', 'T', 'T', 'T', 'T', 'T', 'T'),
(3, 'T', 'F', 'T', 'F', 'T', 'T', 'T'),
(4, 'T', 'T', 'T', 'T', 'T', 'F', 'F'),
(5, 'T', 'T', 'T', 'T', 'T', 'T', 'T'),
(6, 'T', 'T', 'F', 'F', 'F', 'F', 'F'),
(7, 'T', 'T', 'T', 'T', 'T', 'T', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `flat_img`
--

CREATE TABLE `flat_img` (
  `Flat_ID` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flat_img`
--

INSERT INTO `flat_img` (`Flat_ID`, `image`) VALUES
(2, 'flat-1.jpg'),
(3, 'flat-2.jpg'),
(4, 'flat-3.jpg'),
(5, 'flat-4.jpg'),
(6, 'flat-5.jpg'),
(7, 'flat-6.jpg'),
(13, 'flat-13.jpg,flat-14.jpg,flat-15.jpg'),
(14, 'flat-13.jpg,flat-14.jpg,flat-15.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `flat_location`
--

CREATE TABLE `flat_location` (
  `Flat_ID` int(11) NOT NULL,
  `House_No` int(11) NOT NULL,
  `Street_Name` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `flat_location`
--

INSERT INTO `flat_location` (`Flat_ID`, `House_No`, `Street_Name`, `City`) VALUES
(2, 0, '123 S Sawyer Ave', 'Chicago'),
(3, 0, '344 N Kentucky Ave', 'Atlantic City'),
(4, 0, '202 St Cliff Str', 'Dallas'),
(5, 0, '17-16 Mississippi Blv', 'Memphis'),
(6, 0, '440 7th Ave', 'Pierre'),
(7, 0, '440 E Locust Str', '440 E Locust Str'),
(13, 3, '23 July St', 'Sidisalem'),
(14, 3, '23 July St', 'Sidisalem');

-- --------------------------------------------------------

--
-- Table structure for table `flat_nearby`
--

CREATE TABLE `flat_nearby` (
  `Id` int(11) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Detail` int(255) NOT NULL,
  `Flat_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `Client_ID` int(11) NOT NULL,
  `House_No` int(11) NOT NULL,
  `Street_Name` varchar(255) NOT NULL,
  `City` varchar(50) NOT NULL,
  `Postal_Code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`Client_ID`, `House_No`, `Street_Name`, `City`, `Postal_Code`) VALUES
(1, 0, 'Saffa street\r\n', 'Ramallah', 972),
(8, 4, 'Egypt - Kafr el sheikh - Sidi slaem', 'Sidisalem', 33511),
(9, 20, 'Egypt - Kafr el sheikh - Sidi slaem', 'Sidisalem', 33511);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Client_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Username`, `Password`, `Client_type`) VALUES
('admin', '1admin', ''),
('colonel', '1colonel', ''),
('', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

CREATE TABLE `rent` (
  `ID` int(11) NOT NULL,
  `Owner_ID` int(11) NOT NULL,
  `Customer_ID` int(11) NOT NULL,
  `Customer_Name` varchar(50) NOT NULL,
  `Customer_Mobile` int(11) NOT NULL,
  `Flat_ID` int(11) NOT NULL,
  `Rent_Period` int(11) NOT NULL,
  `Status` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rent`
--

INSERT INTO `rent` (`ID`, `Owner_ID`, `Customer_ID`, `Customer_Name`, `Customer_Mobile`, `Flat_ID`, `Rent_Period`, `Status`) VALUES
(3, 1, 9, 'bassem', 11322, 3, 2, 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Owner_Id` (`Owner_ID`),
  ADD KEY `Customer_Id` (`Customer_ID`),
  ADD KEY `Flat_ID` (`Flat_ID`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD KEY `Client_ID` (`Client_ID`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `flat`
--
ALTER TABLE `flat`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Owner_Id` (`Owner_ID`);

--
-- Indexes for table `flat_features`
--
ALTER TABLE `flat_features`
  ADD KEY `Flat_ID` (`Flat_ID`);

--
-- Indexes for table `flat_img`
--
ALTER TABLE `flat_img`
  ADD KEY `Flat_ID` (`Flat_ID`);

--
-- Indexes for table `flat_location`
--
ALTER TABLE `flat_location`
  ADD KEY `flat_location_ibfk_1` (`Flat_ID`);

--
-- Indexes for table `flat_nearby`
--
ALTER TABLE `flat_nearby`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Flat_Id` (`Flat_ID`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD KEY `Client_Location` (`Client_ID`);

--
-- Indexes for table `rent`
--
ALTER TABLE `rent`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Customer_ID` (`Customer_ID`),
  ADD KEY `Owner_ID` (`Owner_ID`),
  ADD KEY `Flat_ID` (`Flat_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `flat`
--
ALTER TABLE `flat`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `flat_nearby`
--
ALTER TABLE `flat_nearby`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rent`
--
ALTER TABLE `rent`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `client` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`Owner_ID`) REFERENCES `client` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`Flat_ID`) REFERENCES `flat` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `bank`
--
ALTER TABLE `bank`
  ADD CONSTRAINT `Client_ID` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flat`
--
ALTER TABLE `flat`
  ADD CONSTRAINT `Owner_ID` FOREIGN KEY (`Owner_ID`) REFERENCES `client` (`ID`);

--
-- Constraints for table `flat_features`
--
ALTER TABLE `flat_features`
  ADD CONSTRAINT `flat_features_ibfk_1` FOREIGN KEY (`Flat_ID`) REFERENCES `flat` (`Id`);

--
-- Constraints for table `flat_img`
--
ALTER TABLE `flat_img`
  ADD CONSTRAINT `Flat_ID` FOREIGN KEY (`Flat_ID`) REFERENCES `flat` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flat_location`
--
ALTER TABLE `flat_location`
  ADD CONSTRAINT `flat_location_ibfk_1` FOREIGN KEY (`Flat_ID`) REFERENCES `flat` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flat_nearby`
--
ALTER TABLE `flat_nearby`
  ADD CONSTRAINT `flat_nearby_ibfk_1` FOREIGN KEY (`Flat_ID`) REFERENCES `flat` (`Id`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `Client_Location` FOREIGN KEY (`Client_ID`) REFERENCES `client` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rent`
--
ALTER TABLE `rent`
  ADD CONSTRAINT `rent_ibfk_1` FOREIGN KEY (`Customer_ID`) REFERENCES `client` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rent_ibfk_2` FOREIGN KEY (`Owner_ID`) REFERENCES `client` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rent_ibfk_3` FOREIGN KEY (`Flat_ID`) REFERENCES `flat` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
