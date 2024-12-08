-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2024 at 05:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_sds`
--

-- --------------------------------------------------------

--
-- Table structure for table `classgroup`
--

CREATE TABLE `classgroup` (
  `ClassGroupID` int(11) NOT NULL,
  `DepartmentID` int(11) NOT NULL,
  `EntryYear` year(4) NOT NULL,
  `ClassGroupName` varchar(20) NOT NULL,
  `ProgramLevel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `classgroup`
--

INSERT INTO `classgroup` (`ClassGroupID`, `DepartmentID`, `EntryYear`, `ClassGroupName`, `ProgramLevel`) VALUES
(15, 10, '2024', 'ปวช.1/1', 'ปวช.'),
(16, 10, '2023', 'ปวช.2/1', 'ปวช.'),
(17, 10, '2022', 'ปวช.3/1', 'ปวช.'),
(18, 10, '2022', 'ปวช.3/2', 'ปวช.'),
(19, 10, '2024', 'ปวส.1/1', 'ปวส.'),
(20, 10, '2021', 'ปวส.2/1', 'ปวส.'),
(21, 10, '2021', 'ปวส.2/2', 'ปวส.');

-- --------------------------------------------------------

--
-- Table structure for table `constraints`
--

CREATE TABLE `constraints` (
  `ConstraintID` int(11) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Details` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `DepartmentID` int(11) NOT NULL,
  `DepartmentName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`DepartmentID`, `DepartmentName`) VALUES
(1, 'แผนกวิชาช่างยนต์'),
(2, 'แผนกวิชาช่างกลโรงงาน'),
(3, 'แผนกวิชาช่างเชื่อมโลหะการ'),
(4, 'แผนกวิชาช่างไฟฟ้ากำลัง'),
(5, 'แผนกวิชาอิเล็กทรอนิกส์'),
(6, 'แผนกวิชาการบัญชี'),
(7, 'แผนกวิชาการตลาด'),
(8, 'แผนกวิชาการโรงแรม'),
(9, 'แผนกวิชาสามัญสัมพันธ์'),
(10, 'แผนกวิชาเทคโนโลยีธุรกิจดิจิทัล'),
(11, 'แผนกวิชาสามัญสัมพันธ์'),
(12, 'วิทยาลัยการอาชีพวารินชำราบ');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `RoomID` int(11) NOT NULL,
  `RoomName` varchar(100) NOT NULL,
  `Capacity` int(3) NOT NULL,
  `Location` varchar(100) DEFAULT NULL,
  `RoomTypeID` int(11) DEFAULT NULL,
  `DepartmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`RoomID`, `RoomName`, `Capacity`, `Location`, `RoomTypeID`, `DepartmentID`) VALUES
(1, 'Lab1', 40, 'อาคารเฉลิมพระเกียรติ', 10, 10),
(2, 'Lab2', 40, 'อาคารเฉลิมพระเกียรติ', 10, 10),
(3, 'Lab3', 40, 'อาคารเฉลิมพระเกียรติ', 10, 10),
(4, 'Lab4', 40, 'อาคารเฉลิมพระเกียรติ', 10, 10),
(5, 'ห้องอินเทอร์เน็ต', 40, 'อาคารวิทยบริการ', 22, 10),
(6, 'ห้องคอมช่างเชื่อม', 30, 'โรงฝึกงานช่างเชื่อม', 14, 10),
(7, 'ห้องเรียนสามัญสัมพันธ์ 1', 30, 'อาคารเฉลิมพระเกียรติ', 20, 11),
(8, 'ห้องเรียนสามัญสัมพันธ์ 2', 40, 'อาคารเฉลิมพระเกียรติ\r\n', 20, 11),
(9, 'ห้องเรียนสามัญสัมพันธ์ 3', 40, 'อาคารเฉลิมพระเกียรติ\r\n', 20, 11),
(10, 'ห้องเรียนสามัญสัมพันธ์ 4', 40, 'อาคารเฉลิมพระเกียรติ\r\n', 20, 11),
(11, 'ห้องเรียนสามัญสัมพันธ์ 5', 40, 'อาคารเฉลิมพระเกียรติ\r\n', 20, 11);

-- --------------------------------------------------------

--
-- Table structure for table `roomtypes`
--

CREATE TABLE `roomtypes` (
  `RoomTypeID` int(11) NOT NULL,
  `RoomTypeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `roomtypes`
--

INSERT INTO `roomtypes` (`RoomTypeID`, `RoomTypeName`) VALUES
(1, 'ห้องเรียนทฤษฎี'),
(2, 'ห้องเรียนทฤษฎี'),
(3, 'ห้องเรียนทฤษฎี'),
(4, 'ห้องเรียนทฤษฎี'),
(5, 'ห้องเรียนทฤษฎี'),
(6, 'ห้องเรียนทฤษฎี'),
(7, 'ห้องเรียนทฤษฎี'),
(8, 'ห้องเรียนทฤษฎี'),
(9, 'ห้องเรียนทฤษฎี'),
(10, 'ห้องเรียนทฤษฎี'),
(11, 'ห้องเรียนทฤษฎี'),
(12, 'ห้องเรียนปฏิบัติ'),
(13, 'ห้องเรียนปฏิบัติ'),
(14, 'ห้องเรียนปฏิบัติ'),
(15, 'ห้องเรียนปฏิบัติ'),
(16, 'ห้องเรียนปฏิบัติ'),
(17, 'ห้องเรียนปฏิบัติ'),
(18, 'ห้องเรียนปฏิบัติ'),
(19, 'ห้องเรียนปฏิบัติ'),
(20, 'ห้องเรียนปฏิบัติ'),
(21, 'ห้องเรียนปฏิบัติ'),
(22, 'ห้องเรียนปฏิบัติ');

-- --------------------------------------------------------

--
-- Table structure for table `roomusage`
--

CREATE TABLE `roomusage` (
  `UsageID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `ScheduleID` int(11) NOT NULL,
  `Purpose` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rules`
--

CREATE TABLE `rules` (
  `PriorityID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Weight` float(10,3) NOT NULL,
  `SubjectType` float(10,3) NOT NULL,
  `TheoryPractice` float(10,3) NOT NULL,
  `EquipmentWeight` float(10,3) NOT NULL,
  `Continuity` float(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rules`
--

INSERT INTO `rules` (`PriorityID`, `SubjectID`, `UserID`, `Weight`, `SubjectType`, `TheoryPractice`, `EquipmentWeight`, `Continuity`) VALUES
(1, 71, 5, 3.000, 2.000, 2.000, 2.000, 1.000),
(2, 72, 5, 3.000, 2.000, 2.000, 2.000, 1.000),
(3, 73, 5, 5.000, 1.000, 2.000, 3.000, 0.000),
(4, 74, 5, 5.000, 1.000, 2.000, 3.000, 0.000),
(5, 75, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(6, 76, 5, 3.000, 2.000, 2.000, 1.000, 1.000),
(7, 77, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(8, 78, 5, 1.000, 5.000, 1.000, 1.000, 0.000),
(9, 79, 5, 2.000, 2.000, 4.000, 1.000, 0.000),
(10, 80, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(11, 81, 5, 5.000, 1.000, 2.000, 3.000, 0.000),
(12, 82, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(13, 83, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(14, 84, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(15, 85, 5, 1.000, 5.000, 1.000, 1.000, 0.000),
(16, 86, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(17, 87, 5, 5.000, 2.000, 1.000, 3.000, 0.000),
(18, 88, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(19, 89, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(20, 90, 5, 1.000, 2.000, 3.000, 2.000, 0.000),
(21, 91, 5, 1.000, 1.000, 3.000, 3.000, 0.000),
(22, 92, 5, 1.000, 1.000, 3.000, 3.000, 0.000),
(23, 93, 5, 1.000, 2.000, 3.000, 2.000, 1.000),
(24, 94, 5, 1.000, 5.000, 1.000, 1.000, 0.000),
(25, 95, 5, 2.000, 2.000, 4.000, 1.000, 1.000),
(26, 96, 5, 2.000, 2.000, 3.000, 1.000, 1.000),
(27, 97, 5, 3.000, 2.000, 3.000, 2.000, 1.000),
(28, 98, 5, 5.000, 2.000, 3.000, 3.000, 1.000),
(29, 99, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(30, 100, 5, 3.000, 2.000, 3.000, 2.000, 1.000),
(31, 101, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(32, 102, 5, 5.000, 1.000, 1.000, 3.000, 0.000),
(33, 103, 5, 1.000, 5.000, 1.000, 1.000, 0.000),
(34, 104, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(35, 105, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(36, 71, 11, 2.000, 2.000, 2.000, 1.000, 0.000),
(37, 72, 11, 3.000, 2.000, 2.000, 2.000, 0.000),
(38, 73, 11, 5.000, 1.000, 2.000, 3.000, 0.000),
(39, 74, 11, 3.000, 2.000, 2.000, 2.000, 0.000),
(40, 75, 11, 4.000, 1.000, 3.000, 3.000, 0.000),
(41, 76, 11, 5.000, 1.000, 2.000, 2.000, 0.000),
(42, 77, 11, 5.000, 1.000, 3.000, 3.000, 0.000),
(43, 78, 11, 2.000, 4.000, 1.000, 1.000, 0.000),
(44, 79, 11, 2.000, 2.000, 4.000, 2.000, 0.000),
(45, 80, 11, 5.000, 1.000, 3.000, 2.000, 1.000),
(46, 81, 11, 3.000, 1.000, 2.000, 2.000, 1.000),
(47, 82, 11, 5.000, 1.000, 3.000, 3.000, 0.000),
(48, 83, 11, 4.000, 1.000, 3.000, 3.000, 1.000),
(49, 84, 11, 4.000, 1.000, 3.000, 3.000, 0.000),
(50, 85, 11, 2.000, 2.000, 1.000, 1.000, 0.000),
(51, 86, 11, 5.000, 1.000, 3.000, 3.000, 1.000),
(52, 87, 11, 3.000, 1.000, 1.000, 2.000, 0.000),
(53, 88, 11, 4.000, 1.000, 3.000, 3.000, 0.000),
(54, 89, 11, 4.000, 1.000, 3.000, 3.000, 0.000),
(55, 90, 11, 3.000, 2.000, 3.000, 2.000, 1.000),
(56, 91, 11, 4.000, 1.000, 3.000, 3.000, 0.000),
(57, 92, 11, 4.000, 1.000, 3.000, 2.000, 1.000),
(58, 93, 11, 4.000, 2.000, 3.000, 3.000, 0.000),
(59, 94, 11, 2.000, 3.000, 1.000, 1.000, 0.000),
(60, 95, 11, 2.000, 2.000, 4.000, 1.000, 0.000),
(61, 96, 11, 3.000, 2.000, 3.000, 2.000, 1.000),
(62, 97, 11, 4.000, 1.000, 3.000, 2.000, 0.000),
(63, 98, 11, 4.000, 1.000, 3.000, 3.000, 1.000),
(64, 99, 11, 5.000, 1.000, 3.000, 3.000, 1.000),
(65, 100, 11, 4.000, 1.000, 3.000, 3.000, 0.000),
(66, 101, 11, 3.000, 2.000, 3.000, 2.000, 1.000),
(67, 102, 11, 3.000, 1.000, 1.000, 2.000, 0.000),
(68, 103, 11, 2.000, 4.000, 1.000, 1.000, 0.000),
(69, 104, 11, 4.000, 1.000, 3.000, 3.000, 0.000),
(70, 105, 11, 4.000, 1.000, 3.000, 3.000, 0.000),
(71, 71, 12, 4.000, 2.000, 1.000, 3.000, 1.000),
(72, 72, 12, 4.000, 2.000, 1.000, 3.000, 0.000),
(73, 73, 12, 3.000, 4.000, 4.000, 2.000, 1.000),
(74, 74, 12, 3.000, 4.000, 4.000, 2.000, 1.000),
(75, 75, 12, 4.000, 2.000, 1.000, 3.000, 1.000),
(76, 76, 12, 3.000, 4.000, 1.000, 2.000, 0.000),
(77, 77, 12, 3.000, 4.000, 1.000, 2.000, 0.000),
(78, 78, 12, 3.000, 4.000, 1.000, 2.000, 1.000),
(79, 79, 12, 3.000, 2.000, 4.000, 3.000, 1.000),
(80, 80, 12, 4.000, 2.000, 4.000, 3.000, 0.000),
(81, 81, 12, 3.000, 4.000, 4.000, 2.000, 1.000),
(82, 82, 12, 3.000, 2.000, 4.000, 2.000, 0.000),
(83, 83, 12, 3.000, 2.000, 1.000, 3.000, 1.000),
(84, 84, 12, 4.000, 4.000, 2.000, 3.000, 1.000),
(85, 85, 12, 3.000, 4.000, 2.000, 2.000, 1.000),
(86, 86, 12, 4.000, 4.000, 2.000, 3.000, 0.000),
(87, 87, 12, 4.000, 2.000, 2.000, 3.000, 0.000),
(88, 88, 12, 5.000, 1.000, 3.000, 2.000, 0.000),
(89, 89, 12, 3.000, 3.000, 2.000, 3.000, 0.000),
(90, 90, 12, 4.000, 4.000, 3.000, 2.000, 0.000),
(91, 91, 12, 4.000, 4.000, 1.000, 3.000, 1.000),
(92, 92, 12, 3.000, 2.000, 4.000, 2.000, 1.000),
(93, 93, 12, 5.000, 2.000, 3.000, 2.000, 0.000),
(94, 94, 12, 5.000, 2.000, 2.000, 2.000, 0.000),
(95, 95, 12, 3.000, 1.000, 3.000, 2.000, 0.000),
(96, 96, 12, 5.000, 1.000, 3.000, 3.000, 0.000),
(97, 97, 12, 5.000, 5.000, 3.000, 3.000, 0.000),
(98, 98, 12, 2.000, 5.000, 1.000, 2.000, 1.000),
(99, 99, 12, 4.000, 2.000, 3.000, 2.000, 0.000),
(100, 100, 12, 5.000, 4.000, 3.000, 3.000, 0.000),
(101, 101, 12, 5.000, 1.000, 3.000, 2.000, 0.000),
(102, 102, 12, 5.000, 1.000, 3.000, 3.000, 0.000),
(103, 103, 12, 3.000, 4.000, 1.000, 2.000, 1.000),
(104, 104, 12, 3.000, 3.000, 3.000, 2.000, 0.000),
(105, 105, 12, 5.000, 4.000, 3.000, 3.000, 0.000),
(106, 71, 13, 5.000, 4.000, 1.000, 1.000, 0.000),
(107, 72, 13, 5.000, 4.000, 1.000, 1.000, 0.000),
(108, 73, 13, 3.000, 4.000, 4.000, 1.000, 0.000),
(109, 74, 13, 5.000, 4.000, 4.000, 1.000, 0.000),
(110, 75, 13, 3.000, 4.000, 1.000, 1.000, 0.000),
(111, 76, 13, 3.000, 4.000, 1.000, 1.000, 0.000),
(112, 77, 13, 2.000, 4.000, 1.000, 1.000, 0.000),
(113, 78, 13, 4.000, 4.000, 1.000, 1.000, 0.000),
(114, 79, 13, 3.000, 2.000, 4.000, 1.000, 0.000),
(115, 80, 13, 1.000, 4.000, 4.000, 1.000, 0.000),
(116, 81, 13, 5.000, 2.000, 4.000, 1.000, 0.000),
(117, 82, 13, 2.000, 2.000, 4.000, 1.000, 0.000),
(118, 83, 13, 3.000, 4.000, 1.000, 1.000, 0.000),
(119, 84, 13, 3.000, 2.000, 2.000, 1.000, 0.000),
(120, 85, 13, 3.000, 2.000, 2.000, 1.000, 0.000),
(121, 86, 13, 4.000, 1.000, 2.000, 3.000, 1.000),
(122, 87, 13, 4.000, 1.000, 2.000, 3.000, 1.000),
(123, 88, 13, 4.000, 1.000, 3.000, 2.000, 1.000),
(124, 89, 13, 3.000, 1.000, 2.000, 2.000, 0.000),
(125, 90, 13, 4.000, 1.000, 3.000, 3.000, 1.000),
(126, 91, 13, 1.000, 5.000, 1.000, 1.000, 0.000),
(127, 92, 13, 2.000, 2.000, 4.000, 1.000, 0.000),
(128, 93, 13, 3.000, 2.000, 3.000, 3.000, 1.000),
(129, 94, 13, 3.000, 2.000, 2.000, 3.000, 1.000),
(130, 95, 13, 2.000, 1.000, 3.000, 3.000, 1.000),
(131, 96, 13, 3.000, 1.000, 3.000, 3.000, 0.000),
(132, 97, 13, 3.000, 1.000, 3.000, 3.000, 0.000),
(133, 98, 13, 1.000, 5.000, 1.000, 1.000, 0.000),
(134, 99, 13, 4.000, 1.000, 3.000, 3.000, 1.000),
(135, 100, 13, 2.000, 1.000, 1.000, 3.000, 0.000),
(136, 101, 13, 4.000, 1.000, 3.000, 3.000, 1.000),
(137, 102, 13, 3.000, 1.000, 3.000, 3.000, 0.000),
(138, 103, 13, 1.000, 5.000, 1.000, 1.000, 0.000),
(139, 104, 13, 3.000, 2.000, 3.000, 3.000, 0.000),
(140, 105, 13, 2.000, 1.000, 3.000, 3.000, 0.000),
(141, 71, 14, 5.000, 4.000, 1.000, 1.000, 0.000),
(142, 72, 14, 5.000, 4.000, 1.000, 1.000, 0.000),
(143, 73, 14, 5.000, 4.000, 4.000, 1.000, 0.000),
(144, 74, 14, 4.000, 4.000, 4.000, 1.000, 0.000),
(145, 75, 14, 3.000, 4.000, 1.000, 1.000, 0.000),
(146, 76, 14, 5.000, 4.000, 1.000, 2.000, 0.000),
(147, 77, 14, 5.000, 4.000, 1.000, 3.000, 0.000),
(148, 78, 14, 5.000, 4.000, 1.000, 2.000, 0.000),
(149, 79, 14, 5.000, 4.000, 4.000, 3.000, 0.000),
(150, 80, 14, 2.000, 4.000, 4.000, 1.000, 0.000),
(151, 81, 14, 5.000, 4.000, 4.000, 2.000, 0.000),
(152, 82, 14, 5.000, 4.000, 4.000, 1.000, 0.000),
(153, 83, 14, 3.000, 4.000, 1.000, 1.000, 0.000),
(154, 84, 14, 3.000, 2.000, 2.000, 1.000, 1.000),
(155, 85, 14, 3.000, 1.000, 2.000, 1.000, 1.000),
(156, 86, 14, 5.000, 1.000, 2.000, 3.000, 0.000),
(157, 87, 14, 3.000, 2.000, 2.000, 1.000, 1.000),
(158, 88, 14, 4.000, 1.000, 3.000, 2.000, 0.000),
(159, 89, 14, 5.000, 1.000, 2.000, 3.000, 0.000),
(160, 90, 14, 5.000, 1.000, 3.000, 3.000, 0.000),
(161, 91, 14, 1.000, 5.000, 1.000, 1.000, 0.000),
(162, 92, 14, 3.000, 2.000, 4.000, 1.000, 0.000),
(163, 93, 14, 3.000, 1.000, 3.000, 3.000, 0.000),
(164, 94, 14, 3.000, 1.000, 2.000, 2.000, 0.000),
(165, 95, 14, 2.000, 1.000, 3.000, 3.000, 0.000),
(166, 96, 14, 5.000, 1.000, 3.000, 3.000, 0.000),
(167, 97, 14, 1.000, 5.000, 1.000, 1.000, 0.000),
(168, 98, 14, 5.000, 1.000, 3.000, 3.000, 0.000),
(169, 99, 14, 2.000, 1.000, 1.000, 3.000, 1.000),
(170, 100, 14, 3.000, 1.000, 3.000, 2.000, 0.000),
(171, 101, 14, 3.000, 1.000, 3.000, 2.000, 1.000),
(172, 102, 14, 1.000, 5.000, 1.000, 1.000, 0.000),
(173, 103, 14, 5.000, 2.000, 3.000, 3.000, 0.000),
(174, 104, 14, 3.000, 2.000, 3.000, 2.000, 1.000),
(175, 106, 5, 2.000, 4.000, 1.000, 1.000, 0.000),
(176, 107, 5, 3.000, 4.000, 1.000, 1.000, 0.000),
(177, 108, 5, 2.000, 4.000, 4.000, 1.000, 0.000),
(178, 109, 5, 1.000, 4.000, 4.000, 1.000, 0.000),
(179, 110, 5, 1.000, 4.000, 1.000, 1.000, 0.000),
(180, 111, 5, 3.000, 4.000, 1.000, 1.000, 0.000),
(181, 112, 5, 3.000, 4.000, 1.000, 1.000, 0.000),
(182, 113, 5, 3.000, 4.000, 1.000, 1.000, 0.000),
(183, 114, 5, 3.000, 4.000, 4.000, 1.000, 0.000),
(184, 115, 5, 1.000, 4.000, 4.000, 1.000, 0.000),
(185, 116, 5, 3.000, 4.000, 4.000, 3.000, 1.000),
(186, 117, 5, 3.000, 4.000, 4.000, 1.000, 1.000),
(187, 118, 5, 1.000, 4.000, 1.000, 1.000, 0.000),
(188, 116, 13, 3.000, 4.000, 4.000, 2.000, 0.000),
(189, 117, 13, 5.000, 4.000, 4.000, 2.000, 0.000),
(190, 118, 13, 1.000, 4.000, 1.000, 1.000, 0.000),
(191, 119, 5, 1.000, 5.000, 2.000, 1.000, 0.000),
(192, 119, 5, 1.000, 5.000, 2.000, 1.000, 0.000),
(193, 119, 5, 1.000, 5.000, 2.000, 1.000, 0.000);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `ScheduleID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `TeacherID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `TimeSlot` text NOT NULL,
  `DayOfWeek` text NOT NULL,
  `ClassGroupID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`ScheduleID`, `SubjectID`, `TeacherID`, `RoomID`, `TimeSlot`, `DayOfWeek`, `ClassGroupID`) VALUES
(52919, 86, 1, 1, '1-4', 'mon', 17),
(52920, 86, 1, 1, '1-4', 'mon', 17),
(52921, 86, 1, 1, '6-9', 'mon', 18),
(52922, 86, 1, 1, '6-9', 'mon', 18),
(52923, 88, 1, 1, '1-4', 'tue', 17),
(52924, 88, 1, 1, '1-4', 'tue', 17),
(52925, 88, 1, 1, '6-9', 'tue', 18),
(52926, 88, 1, 1, '6-9', 'tue', 18),
(52927, 73, 1, 1, '1-4', 'wed', 15),
(52928, 73, 1, 1, '1-4', 'wed', 15),
(52929, 81, 1, 1, '6-9', 'wed', 16),
(52930, 81, 1, 1, '6-9', 'wed', 16),
(52931, 105, 1, 1, '1-4', 'thu', 21),
(52932, 105, 1, 1, '1-4', 'thu', 21),
(52933, 89, 1, 1, '6-9', 'thu', 17),
(52934, 89, 1, 1, '6-9', 'thu', 17),
(52935, 89, 1, 1, '1-4', 'fri', 18),
(52936, 89, 1, 1, '1-4', 'fri', 18),
(52937, 99, 1, 1, '4', 'mon', 20),
(52938, 99, 1, 1, '4', 'mon', 20),
(52939, 99, 1, 1, '9', 'mon', 21),
(52940, 99, 1, 1, '9', 'mon', 21),
(52941, 77, 1, 1, '6-9', 'fri', 15),
(52942, 77, 1, 1, '6-9', 'fri', 15),
(52943, 101, 1, 1, '10-12', 'mon', 20),
(52944, 101, 1, 1, '10-12', 'mon', 20),
(52945, 101, 1, 1, '4', 'tue', 21),
(52946, 101, 1, 1, '4', 'tue', 21),
(52947, 82, 1, 1, '1-4', 'sat', 16),
(52948, 82, 1, 1, '1-4', 'sat', 16),
(52949, 74, 1, 1, '6-9', 'sat', 15),
(52950, 74, 1, 1, '6-9', 'sat', 15),
(52951, 72, 1, 1, '1-4', 'sun', 15),
(52952, 72, 1, 1, '1-4', 'sun', 15),
(52953, 117, 1, 1, '6-9', 'sun', 20),
(52954, 117, 1, 1, '6-9', 'sun', 20),
(52955, 98, 1, 1, '9', 'tue', 20),
(52956, 98, 1, 1, '9', 'tue', 20),
(52957, 99, 1, 1, '10-12', 'tue', 20),
(52958, 99, 1, 1, '10-12', 'tue', 20),
(52959, 99, 1, 1, '4', 'wed', 21),
(52960, 99, 1, 1, '4', 'wed', 21),
(52961, 101, 1, 1, '9', 'wed', 20),
(52962, 101, 1, 1, '9', 'wed', 20),
(52963, 101, 1, 1, '10-12', 'wed', 21),
(52964, 101, 1, 1, '10-12', 'wed', 21),
(52965, 98, 1, 1, '4', 'thu', 20),
(52966, 98, 1, 1, '4', 'thu', 20),
(52967, 99, 1, 1, '9', 'thu', 20),
(52968, 99, 1, 1, '9', 'thu', 20),
(52969, 99, 1, 1, '10-12', 'thu', 21),
(52970, 99, 1, 1, '10-12', 'thu', 21),
(52971, 101, 1, 1, '4', 'fri', 20),
(52972, 101, 1, 1, '4', 'fri', 20),
(52973, 101, 1, 1, '9', 'fri', 21),
(52974, 101, 1, 1, '9', 'fri', 21),
(52975, 98, 1, 1, '10-12', 'fri', 20),
(52976, 98, 1, 1, '10-12', 'fri', 20),
(52977, 99, 1, 1, '4', 'sat', 20),
(52978, 99, 1, 1, '4', 'sat', 20),
(52979, 99, 1, 1, '9', 'sat', 21),
(52980, 99, 1, 1, '9', 'sat', 21),
(52981, 101, 1, 1, '10-12', 'sat', 20),
(52982, 101, 1, 1, '10-12', 'sat', 20),
(52983, 101, 1, 1, '4', 'sun', 21),
(52984, 101, 1, 1, '4', 'sun', 21),
(52985, 98, 1, 1, '9', 'sun', 20),
(52986, 98, 1, 1, '9', 'sun', 20),
(52987, 99, 1, 1, '10-12', 'sun', 20),
(52988, 99, 1, 1, '10-12', 'sun', 20);

-- --------------------------------------------------------

--
-- Table structure for table `studyplans`
--

CREATE TABLE `studyplans` (
  `StudyPlanID` int(11) NOT NULL,
  `ClassGroupID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `Term` int(11) NOT NULL,
  `Year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `studyplans`
--

INSERT INTO `studyplans` (`StudyPlanID`, `ClassGroupID`, `SubjectID`, `Term`, `Year`) VALUES
(1, 15, 71, 2, 2024),
(2, 15, 72, 2, 2024),
(3, 15, 73, 2, 2024),
(4, 15, 74, 2, 2024),
(5, 15, 75, 2, 2024),
(6, 15, 76, 2, 2024),
(7, 15, 77, 2, 2024),
(8, 15, 78, 2, 2024),
(9, 15, 106, 2, 2024),
(10, 15, 107, 2, 2024),
(11, 15, 108, 2, 2024),
(12, 15, 109, 2, 2024),
(13, 15, 110, 2, 2024),
(16, 16, 79, 2, 2024),
(17, 16, 80, 2, 2024),
(18, 16, 81, 2, 2024),
(19, 16, 82, 2, 2024),
(20, 16, 83, 2, 2024),
(21, 16, 84, 2, 2024),
(22, 16, 85, 2, 2024),
(23, 16, 111, 2, 2024),
(24, 16, 112, 2, 2024),
(31, 17, 86, 2, 2024),
(32, 17, 87, 2, 2024),
(33, 17, 88, 2, 2024),
(34, 17, 89, 2, 2024),
(35, 17, 113, 2, 2024),
(36, 17, 114, 2, 2024),
(37, 17, 115, 2, 2024),
(38, 18, 86, 2, 2024),
(39, 18, 87, 2, 2024),
(40, 18, 88, 2, 2024),
(41, 18, 89, 2, 2024),
(42, 18, 113, 2, 2024),
(43, 18, 114, 2, 2024),
(44, 18, 115, 2, 2024),
(45, 19, 90, 2, 2024),
(46, 19, 91, 2, 2024),
(47, 19, 92, 2, 2024),
(48, 19, 93, 2, 2024),
(49, 19, 94, 2, 2024),
(50, 17, 103, 2, 2024),
(53, 20, 95, 2, 2024),
(54, 20, 96, 2, 2024),
(55, 20, 97, 2, 2024),
(56, 20, 98, 2, 2024),
(57, 20, 99, 2, 2024),
(58, 20, 100, 2, 2024),
(59, 20, 101, 2, 2024),
(60, 20, 102, 2, 2024),
(61, 18, 103, 2, 2024),
(62, 20, 116, 2, 2024),
(63, 20, 117, 2, 2024),
(64, 20, 118, 2, 2024),
(68, 21, 95, 2, 2024),
(69, 21, 96, 2, 2024),
(70, 21, 99, 2, 2024),
(71, 21, 101, 2, 2024),
(72, 21, 102, 2, 2024),
(73, 21, 103, 2, 2024),
(74, 21, 104, 2, 2024),
(75, 21, 105, 2, 2024),
(76, 21, 116, 2, 2024),
(77, 21, 117, 2, 2024),
(78, 21, 118, 2, 2024),
(82, 20, 119, 2, 2024),
(83, 21, 119, 2, 2024),
(84, 20, 103, 2, 2024);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `SubjectID` int(11) NOT NULL,
  `SubjectCode` varchar(20) NOT NULL,
  `SubjectName` varchar(100) NOT NULL,
  `CreditHours` int(2) NOT NULL,
  `CurriculumYear` year(4) NOT NULL,
  `TheoryHours` int(2) NOT NULL,
  `PracticalHours` int(2) NOT NULL,
  `DepartmentID` int(11) DEFAULT NULL,
  `SubjectType` enum('ทฤษฎี','ปฏิบัติ','กิจกรรม','สถานประกอบการ') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `TeacherID` int(11) NOT NULL,
  `Specialization` varchar(100) DEFAULT NULL,
  `AvailableHours` text DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `DepartmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`TeacherID`, `Specialization`, `AvailableHours`, `UserID`, `DepartmentID`) VALUES
(1, 'Computer', '35', 5, 10),
(2, 'Computer', '35', 11, 10),
(3, 'Computer', '35', 12, 10),
(4, 'Computer', '35', 13, 10),
(5, 'Computer', '35', 14, 10),
(6, 'Samun', '35', 15, 11),
(7, 'Samun', '35', 16, 11),
(8, 'Samun', '35', 17, 11),
(9, 'Samun', '35', 18, 11),
(10, 'Samun', '35', 19, 11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Role` enum('Admin','Teacher','AcademicStaff','Executive','DepartmentHead') NOT NULL,
  `ContactInfo` varchar(100) DEFAULT NULL,
  `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `FullName`, `Email`, `Password`, `Role`, `ContactInfo`, `CreatedAt`) VALUES
(4, 'admin', 'w.wimonput@gmail.com', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'Admin', '0910171373', '2024-12-01 14:34:19'),
(5, 'นายวุฒิพงศ์ วิมลพัชร', 'w.wimonput@warinice.ac.th', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'Teacher', '0910171373', '2024-12-01 14:34:19'),
(6, 'poppy', 'dbt@warinice.ac.th', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'AcademicStaff', '0910171373', '2024-12-01 14:34:19'),
(7, 'admin', 'admin', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'Admin', '00000', '2024-12-02 14:04:36'),
(8, 'poppy', 'poppy', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'AcademicStaff', '0910171373', '2024-12-01 14:34:19'),
(9, 'poraor', 'poraor', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'Executive', '0910171373', '2024-12-01 14:34:19'),
(10, 'headoffice', 'head', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'DepartmentHead', '0910171373', '2024-12-01 14:34:19'),
(11, 'นางสาวปวิตรา มังพรมมา', 'audyada@gmai.com', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'Teacher', '0935808511', '2024-12-01 14:34:19'),
(12, 'นางอธิตญาภรณ์ ดาโรจน์', 'noocaredarojana@gmail.com', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'Teacher', '0844899822', '2024-12-01 14:34:19'),
(13, 'นายบุญเกียรติ ใจสว่าง', 'jaisawang.bookiat@hotmail.com', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'Teacher', '0883519395', '2024-12-01 14:34:19'),
(14, 'ครูคอม1', 'com1@warinice.ac.th', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'Teacher', '0883519395', '2024-12-01 14:34:19'),
(15, 'ครูสามัญ1', 'samun1@warinice.ac.th', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'Teacher', '0883519395', '2024-12-01 14:34:19'),
(16, 'ครูสามัญ2', 'samun2@warinice.ac.th', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'Teacher', '0883519395', '2024-12-01 14:34:19'),
(17, 'ครูสามัญ3', 'samun3@warinice.ac.th', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'Teacher', '0883519395', '2024-12-01 14:34:19'),
(18, 'ครูสามัญ4', 'samun4@warinice.ac.th', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'Teacher', '0883519395', '2024-12-01 14:34:19'),
(19, 'ครูสามัญ5', 'samun5@warinice.ac.th', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'Teacher', '0883519395', '2024-12-01 14:34:19'),
(20, 'นายทดสอบ', 'gogo@gmail.com', '$2y$10$jKBVWATwHK0jR3b/ZsNAV.2mx9Js52ZlWU0KelP2USYMACHJo8pzy', 'DepartmentHead', '0910171373', '2024-12-08 02:56:27'),
(22, 'dddd', 'head@gmail.com', '$2y$10$5unyO8Y6qBF5bk3MZllf..iROZg2jBdL4zE6QqQYNZfX8l5HttnDm', 'DepartmentHead', '11111111', '2024-12-08 03:07:08'),
(24, 'ฟฟฟฟฟ', 'qwe@gmail.com', '$2y$10$SAJqO3nHyjNoT98eQZGyseZbLqNYhyJR2PIfIU2q03fLuF1g2G55.', 'DepartmentHead', '121121', '2024-12-08 03:12:10'),
(26, '123456', '', '$2y$10$lLb8bOvJUo3aqtu1HMALdOXUu3wlzuN6oCZwibrwlu.qhxbdzWINO', 'Teacher', '000', '2024-12-08 10:16:19'),
(28, '123123123', '123123@gmail.com', '$2y$10$EPtvFNIlA1baJx3Cg8jsCOE4goySNKPYOdVO4jDj/Ws5utX6IjWfq', 'DepartmentHead', '000', '2024-12-08 10:17:03'),
(32, 'qqqqq', 'admin111111@ggg', '$2y$10$niF5FuGhAkooBLgjSD4O6.lx3s2OmEyBOgv6.xJj23PSgtVbZgInq', 'AcademicStaff', '9999', '2024-12-08 10:19:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classgroup`
--
ALTER TABLE `classgroup`
  ADD PRIMARY KEY (`ClassGroupID`),
  ADD KEY `DepartmentID` (`DepartmentID`);

--
-- Indexes for table `constraints`
--
ALTER TABLE `constraints`
  ADD PRIMARY KEY (`ConstraintID`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`DepartmentID`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`RoomID`),
  ADD KEY `FK_Rooms_RoomTypes` (`RoomTypeID`),
  ADD KEY `FK_Rooms_department` (`DepartmentID`);

--
-- Indexes for table `roomtypes`
--
ALTER TABLE `roomtypes`
  ADD PRIMARY KEY (`RoomTypeID`);

--
-- Indexes for table `roomusage`
--
ALTER TABLE `roomusage`
  ADD PRIMARY KEY (`UsageID`),
  ADD KEY `RoomID` (`RoomID`),
  ADD KEY `ScheduleID` (`ScheduleID`);

--
-- Indexes for table `rules`
--
ALTER TABLE `rules`
  ADD PRIMARY KEY (`PriorityID`),
  ADD KEY `SubjectID` (`SubjectID`),
  ADD KEY `rules_ibfk_2` (`UserID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`ScheduleID`),
  ADD KEY `SubjectID` (`SubjectID`),
  ADD KEY `TeacherID` (`TeacherID`),
  ADD KEY `RoomID` (`RoomID`),
  ADD KEY `Schedule_ibfk_4` (`ClassGroupID`);

--
-- Indexes for table `studyplans`
--
ALTER TABLE `studyplans`
  ADD PRIMARY KEY (`StudyPlanID`),
  ADD KEY `ClassGroupID` (`ClassGroupID`),
  ADD KEY `SubjectID` (`SubjectID`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`SubjectID`),
  ADD KEY `FK_Subjects_Department` (`DepartmentID`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`TeacherID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `Teachers_ibfk_2` (`DepartmentID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classgroup`
--
ALTER TABLE `classgroup`
  MODIFY `ClassGroupID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `constraints`
--
ALTER TABLE `constraints`
  MODIFY `ConstraintID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `DepartmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `roomtypes`
--
ALTER TABLE `roomtypes`
  MODIFY `RoomTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `roomusage`
--
ALTER TABLE `roomusage`
  MODIFY `UsageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rules`
--
ALTER TABLE `rules`
  MODIFY `PriorityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `ScheduleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52989;

--
-- AUTO_INCREMENT for table `studyplans`
--
ALTER TABLE `studyplans`
  MODIFY `StudyPlanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `SubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `TeacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classgroup`
--
ALTER TABLE `classgroup`
  ADD CONSTRAINT `ClassGroup_ibfk_1` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`DepartmentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `FK_Rooms_RoomTypes` FOREIGN KEY (`RoomTypeID`) REFERENCES `roomtypes` (`RoomTypeID`),
  ADD CONSTRAINT `FK_Rooms_department` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`DepartmentID`);

--
-- Constraints for table `roomusage`
--
ALTER TABLE `roomusage`
  ADD CONSTRAINT `RoomUsage_ibfk_1` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`),
  ADD CONSTRAINT `RoomUsage_ibfk_2` FOREIGN KEY (`ScheduleID`) REFERENCES `schedule` (`ScheduleID`);

--
-- Constraints for table `rules`
--
ALTER TABLE `rules`
  ADD CONSTRAINT `rules_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `Schedule_ibfk_2` FOREIGN KEY (`TeacherID`) REFERENCES `teachers` (`TeacherID`),
  ADD CONSTRAINT `Schedule_ibfk_3` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`),
  ADD CONSTRAINT `Schedule_ibfk_4` FOREIGN KEY (`ClassGroupID`) REFERENCES `classgroup` (`ClassGroupID`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `FK_Subjects_Department` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`DepartmentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `Teachers_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`),
  ADD CONSTRAINT `Teachers_ibfk_2` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`DepartmentID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
