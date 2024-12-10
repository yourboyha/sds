-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 02:36 AM
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
  `ProgramLevel` varchar(10) NOT NULL,
  `HeadCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `classgroup`
--

INSERT INTO `classgroup` (`ClassGroupID`, `DepartmentID`, `EntryYear`, `ClassGroupName`, `ProgramLevel`, `HeadCount`) VALUES
(15, 10, '2024', 'ปวช.1/1', 'ปวช.', 22),
(16, 10, '2023', 'ปวช.2/1', 'ปวช.', 16),
(17, 10, '2022', 'ปวช.3/1', 'ปวช.', 16),
(18, 10, '2022', 'ปวช.3/2', 'ปวช.', 18),
(19, 10, '2024', 'ปวส.1/1', 'ปวส.', 13),
(20, 10, '2021', 'ปวส.2/1', 'ปวส.', 10),
(21, 10, '2021', 'ปวส.2/2', 'ปวส.', 9);

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
(194, 120, 5, 2.000, 4.000, 2.000, 1.000, 0.000),
(195, 121, 5, 3.000, 4.000, 2.000, 1.000, 0.000),
(196, 122, 5, 3.000, 4.000, 1.000, 1.000, 0.000),
(197, 123, 5, 3.000, 4.000, 4.000, 1.000, 1.000),
(198, 124, 5, 2.000, 4.000, 1.000, 1.000, 0.000),
(199, 125, 5, 2.000, 2.000, 4.000, 1.000, 1.000),
(200, 126, 5, 5.000, 1.000, 3.000, 3.000, 1.000),
(201, 127, 5, 4.000, 2.000, 4.000, 2.000, 1.000),
(202, 128, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(203, 129, 5, 5.000, 1.000, 4.000, 3.000, 0.000),
(204, 130, 5, 4.000, 1.000, 4.000, 3.000, 0.000),
(205, 131, 5, 1.000, 5.000, 2.000, 1.000, 0.000),
(206, 132, 5, 2.000, 4.000, 2.000, 1.000, 0.000),
(207, 133, 5, 3.000, 4.000, 2.000, 2.000, 0.000),
(208, 134, 5, 3.000, 4.000, 1.000, 1.000, 0.000),
(209, 135, 5, 4.000, 2.000, 4.000, 1.000, 1.000),
(210, 136, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(211, 137, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(212, 138, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(213, 139, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(214, 140, 5, 1.000, 5.000, 2.000, 1.000, 0.000),
(215, 141, 5, 2.000, 3.000, 2.000, 1.000, 1.000),
(216, 142, 5, 1.000, 5.000, 2.000, 1.000, 0.000),
(217, 141, 5, 2.000, 4.000, 4.000, 1.000, 1.000),
(218, 142, 5, 3.000, 4.000, 4.000, 1.000, 1.000),
(219, 143, 5, 2.000, 4.000, 4.000, 1.000, 1.000),
(220, 144, 5, 3.000, 4.000, 4.000, 1.000, 1.000),
(221, 145, 5, 3.000, 4.000, 3.000, 1.000, 1.000),
(222, 146, 5, 3.000, 4.000, 4.000, 1.000, 1.000),
(223, 147, 5, 2.000, 2.000, 3.000, 1.000, 1.000),
(224, 148, 5, 2.000, 2.000, 1.000, 1.000, 1.000),
(225, 149, 5, 4.000, 1.000, 3.000, 3.000, 1.000),
(226, 150, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(227, 151, 5, 5.000, 1.000, 3.000, 3.000, 1.000),
(228, 152, 5, 5.000, 1.000, 3.000, 3.000, 1.000),
(229, 153, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(230, 154, 5, 5.000, 1.000, 3.000, 3.000, 0.000),
(231, 155, 5, 1.000, 5.000, 2.000, 1.000, 0.000),
(232, 156, 5, 1.000, 3.000, 2.000, 1.000, 1.000),
(233, 157, 5, 1.000, 3.000, 2.000, 1.000, 1.000),
(234, 158, 5, 1.000, 2.000, 2.000, 1.000, 1.000),
(235, 159, 5, 1.000, 5.000, 2.000, 1.000, 0.000),
(236, 160, 5, 1.000, 3.000, 2.000, 1.000, 1.000),
(237, 161, 5, 1.000, 3.000, 2.000, 1.000, 1.000),
(238, 162, 5, 1.000, 5.000, 2.000, 1.000, 0.000),
(239, 120, 11, 1.000, 4.000, 2.000, 1.000, 0.000),
(240, 121, 11, 2.000, 4.000, 2.000, 1.000, 0.000),
(241, 122, 11, 2.000, 4.000, 1.000, 1.000, 0.000),
(242, 123, 11, 2.000, 4.000, 4.000, 1.000, 1.000),
(243, 124, 11, 2.000, 4.000, 1.000, 1.000, 0.000),
(244, 125, 11, 2.000, 2.000, 4.000, 1.000, 1.000),
(245, 126, 11, 4.000, 1.000, 3.000, 2.000, 1.000),
(246, 127, 11, 3.000, 2.000, 4.000, 2.000, 1.000),
(247, 128, 11, 5.000, 1.000, 3.000, 3.000, 0.000),
(248, 129, 11, 4.000, 1.000, 4.000, 3.000, 0.000),
(249, 130, 11, 3.000, 1.000, 4.000, 3.000, 0.000),
(250, 131, 11, 1.000, 5.000, 2.000, 1.000, 0.000),
(251, 132, 11, 2.000, 4.000, 2.000, 1.000, 0.000),
(252, 133, 11, 2.000, 4.000, 2.000, 1.000, 0.000),
(253, 134, 11, 2.000, 4.000, 1.000, 1.000, 0.000),
(254, 135, 11, 3.000, 2.000, 4.000, 1.000, 1.000),
(255, 136, 11, 5.000, 1.000, 3.000, 3.000, 0.000),
(256, 137, 11, 5.000, 1.000, 3.000, 3.000, 0.000),
(257, 138, 11, 5.000, 1.000, 3.000, 3.000, 0.000),
(258, 139, 11, 5.000, 1.000, 3.000, 3.000, 0.000),
(259, 140, 11, 1.000, 5.000, 2.000, 1.000, 0.000),
(260, 141, 11, 2.000, 3.000, 2.000, 1.000, 1.000),
(261, 142, 11, 1.000, 5.000, 2.000, 1.000, 0.000),
(262, 141, 11, 2.000, 4.000, 4.000, 1.000, 1.000),
(263, 142, 11, 2.000, 4.000, 4.000, 1.000, 1.000),
(264, 143, 11, 2.000, 4.000, 4.000, 1.000, 1.000),
(265, 144, 11, 2.000, 4.000, 4.000, 1.000, 1.000),
(266, 145, 11, 2.000, 4.000, 3.000, 1.000, 1.000),
(267, 146, 11, 2.000, 4.000, 4.000, 1.000, 1.000),
(268, 147, 11, 2.000, 2.000, 3.000, 1.000, 1.000),
(269, 148, 11, 2.000, 2.000, 1.000, 1.000, 1.000),
(270, 149, 11, 3.000, 1.000, 3.000, 3.000, 1.000),
(271, 150, 11, 5.000, 1.000, 3.000, 3.000, 0.000),
(272, 151, 11, 5.000, 1.000, 3.000, 3.000, 1.000),
(273, 152, 11, 5.000, 1.000, 3.000, 3.000, 1.000),
(274, 153, 11, 5.000, 1.000, 3.000, 3.000, 0.000),
(275, 154, 11, 5.000, 1.000, 3.000, 3.000, 0.000),
(276, 155, 11, 1.000, 5.000, 2.000, 1.000, 0.000),
(277, 156, 11, 1.000, 3.000, 2.000, 1.000, 1.000),
(278, 157, 11, 1.000, 3.000, 2.000, 1.000, 1.000),
(279, 158, 11, 1.000, 2.000, 2.000, 1.000, 1.000),
(280, 159, 11, 1.000, 5.000, 2.000, 1.000, 0.000),
(281, 160, 11, 1.000, 3.000, 2.000, 1.000, 1.000),
(282, 161, 11, 1.000, 3.000, 2.000, 1.000, 1.000),
(283, 162, 11, 1.000, 5.000, 2.000, 1.000, 0.000),
(284, 120, 12, 2.000, 4.000, 2.000, 1.000, 0.000),
(285, 121, 12, 2.000, 4.000, 2.000, 1.000, 0.000),
(286, 122, 12, 2.000, 4.000, 1.000, 1.000, 0.000),
(287, 123, 12, 2.000, 4.000, 4.000, 1.000, 1.000),
(288, 124, 12, 2.000, 4.000, 1.000, 1.000, 0.000),
(289, 125, 12, 2.000, 2.000, 4.000, 1.000, 1.000),
(290, 126, 12, 5.000, 1.000, 3.000, 2.000, 1.000),
(291, 127, 12, 3.000, 2.000, 4.000, 2.000, 1.000),
(292, 128, 12, 4.000, 1.000, 3.000, 3.000, 0.000),
(293, 129, 12, 3.000, 1.000, 4.000, 3.000, 0.000),
(294, 130, 12, 3.000, 1.000, 4.000, 3.000, 0.000),
(295, 131, 12, 1.000, 5.000, 2.000, 1.000, 0.000),
(296, 132, 12, 1.000, 4.000, 2.000, 1.000, 0.000),
(297, 133, 12, 1.000, 4.000, 2.000, 1.000, 0.000),
(298, 134, 12, 1.000, 4.000, 1.000, 1.000, 0.000),
(299, 135, 12, 2.000, 2.000, 4.000, 1.000, 1.000),
(300, 136, 12, 5.000, 1.000, 3.000, 3.000, 0.000),
(301, 137, 12, 5.000, 1.000, 3.000, 3.000, 0.000),
(302, 138, 12, 5.000, 1.000, 3.000, 3.000, 0.000),
(303, 139, 12, 5.000, 1.000, 3.000, 3.000, 0.000),
(304, 140, 12, 1.000, 5.000, 2.000, 1.000, 0.000),
(305, 141, 12, 2.000, 3.000, 2.000, 1.000, 1.000),
(306, 142, 12, 1.000, 5.000, 2.000, 1.000, 0.000),
(307, 141, 12, 1.000, 4.000, 4.000, 1.000, 1.000),
(308, 142, 12, 1.000, 4.000, 4.000, 1.000, 1.000),
(309, 143, 12, 1.000, 4.000, 4.000, 1.000, 1.000),
(310, 144, 12, 1.000, 4.000, 4.000, 1.000, 1.000),
(311, 145, 12, 1.000, 4.000, 3.000, 1.000, 1.000),
(312, 146, 12, 1.000, 4.000, 4.000, 1.000, 1.000),
(313, 147, 12, 1.000, 2.000, 3.000, 1.000, 1.000),
(314, 148, 12, 1.000, 2.000, 1.000, 1.000, 1.000),
(315, 149, 12, 3.000, 1.000, 3.000, 3.000, 1.000),
(316, 150, 12, 5.000, 1.000, 3.000, 3.000, 0.000),
(317, 151, 12, 5.000, 1.000, 3.000, 3.000, 1.000),
(318, 152, 12, 5.000, 1.000, 3.000, 3.000, 1.000),
(319, 153, 12, 5.000, 1.000, 3.000, 3.000, 0.000),
(320, 154, 12, 5.000, 1.000, 3.000, 3.000, 0.000),
(321, 155, 12, 1.000, 5.000, 2.000, 1.000, 0.000),
(322, 156, 12, 1.000, 3.000, 2.000, 1.000, 1.000),
(323, 157, 12, 1.000, 3.000, 2.000, 1.000, 1.000),
(324, 158, 12, 1.000, 2.000, 2.000, 1.000, 1.000),
(325, 159, 12, 1.000, 5.000, 2.000, 1.000, 0.000),
(326, 160, 12, 1.000, 3.000, 2.000, 1.000, 1.000),
(327, 161, 12, 1.000, 3.000, 2.000, 1.000, 1.000),
(328, 162, 12, 1.000, 5.000, 2.000, 1.000, 0.000),
(329, 120, 13, 2.000, 4.000, 2.000, 1.000, 0.000),
(330, 121, 13, 3.000, 4.000, 2.000, 1.000, 0.000),
(331, 122, 13, 3.000, 4.000, 1.000, 1.000, 0.000),
(332, 123, 13, 3.000, 4.000, 4.000, 1.000, 1.000),
(333, 124, 13, 1.000, 4.000, 1.000, 1.000, 0.000),
(334, 125, 13, 3.000, 2.000, 4.000, 1.000, 1.000),
(335, 126, 13, 4.000, 1.000, 3.000, 2.000, 1.000),
(336, 127, 13, 3.000, 2.000, 4.000, 2.000, 1.000),
(337, 128, 13, 4.000, 1.000, 3.000, 3.000, 0.000),
(338, 129, 13, 4.000, 1.000, 4.000, 3.000, 0.000),
(339, 130, 13, 4.000, 1.000, 4.000, 3.000, 0.000),
(340, 131, 13, 1.000, 5.000, 2.000, 1.000, 0.000),
(341, 132, 13, 2.000, 4.000, 2.000, 1.000, 0.000),
(342, 133, 13, 2.000, 4.000, 2.000, 1.000, 0.000),
(343, 134, 13, 1.000, 4.000, 1.000, 1.000, 0.000),
(344, 135, 13, 3.000, 2.000, 4.000, 1.000, 1.000),
(345, 136, 13, 5.000, 1.000, 3.000, 3.000, 0.000),
(346, 137, 13, 5.000, 1.000, 3.000, 3.000, 0.000),
(347, 138, 13, 5.000, 1.000, 3.000, 3.000, 0.000),
(348, 139, 13, 5.000, 1.000, 3.000, 3.000, 0.000),
(349, 140, 13, 1.000, 5.000, 2.000, 1.000, 0.000),
(350, 141, 13, 2.000, 3.000, 2.000, 1.000, 1.000),
(351, 142, 13, 1.000, 5.000, 2.000, 1.000, 0.000),
(352, 141, 13, 1.000, 4.000, 4.000, 1.000, 1.000),
(353, 142, 13, 1.000, 4.000, 4.000, 1.000, 1.000),
(354, 143, 13, 1.000, 4.000, 4.000, 1.000, 1.000),
(355, 144, 13, 1.000, 4.000, 4.000, 1.000, 1.000),
(356, 145, 13, 1.000, 4.000, 3.000, 1.000, 1.000),
(357, 146, 13, 1.000, 4.000, 4.000, 1.000, 1.000),
(358, 147, 13, 1.000, 2.000, 3.000, 1.000, 1.000),
(359, 148, 13, 1.000, 2.000, 1.000, 1.000, 1.000),
(360, 149, 13, 4.000, 1.000, 3.000, 3.000, 1.000),
(361, 150, 13, 5.000, 1.000, 3.000, 3.000, 0.000),
(362, 151, 13, 5.000, 1.000, 3.000, 3.000, 0.000),
(363, 152, 13, 5.000, 1.000, 3.000, 3.000, 0.000),
(364, 153, 13, 5.000, 1.000, 3.000, 3.000, 0.000),
(365, 154, 13, 5.000, 1.000, 3.000, 3.000, 0.000),
(366, 155, 13, 1.000, 5.000, 2.000, 1.000, 0.000),
(367, 156, 13, 1.000, 3.000, 2.000, 1.000, 1.000),
(368, 157, 13, 1.000, 3.000, 2.000, 1.000, 1.000),
(369, 158, 13, 1.000, 2.000, 2.000, 1.000, 1.000),
(370, 159, 13, 1.000, 5.000, 2.000, 1.000, 0.000),
(371, 160, 13, 1.000, 3.000, 2.000, 1.000, 1.000),
(372, 161, 13, 1.000, 3.000, 2.000, 1.000, 1.000),
(373, 162, 13, 1.000, 5.000, 2.000, 1.000, 0.000),
(374, 120, 14, 1.000, 4.000, 2.000, 1.000, 0.000),
(375, 121, 14, 3.000, 4.000, 2.000, 1.000, 0.000),
(376, 122, 14, 2.000, 4.000, 1.000, 1.000, 0.000),
(377, 123, 14, 2.000, 1.000, 4.000, 1.000, 1.000),
(378, 124, 14, 2.000, 4.000, 1.000, 1.000, 0.000),
(379, 125, 14, 2.000, 2.000, 4.000, 1.000, 1.000),
(380, 126, 14, 4.000, 1.000, 3.000, 2.000, 1.000),
(381, 127, 14, 3.000, 2.000, 4.000, 2.000, 1.000),
(382, 128, 14, 5.000, 1.000, 3.000, 3.000, 0.000),
(383, 129, 14, 4.000, 1.000, 4.000, 3.000, 0.000),
(384, 130, 14, 3.000, 1.000, 4.000, 3.000, 0.000),
(385, 131, 14, 1.000, 5.000, 2.000, 1.000, 0.000),
(386, 132, 14, 2.000, 4.000, 2.000, 1.000, 0.000),
(387, 133, 14, 3.000, 4.000, 2.000, 1.000, 0.000),
(388, 134, 14, 2.000, 4.000, 1.000, 1.000, 0.000),
(389, 135, 14, 4.000, 2.000, 4.000, 1.000, 1.000),
(390, 136, 14, 5.000, 1.000, 3.000, 3.000, 0.000),
(391, 137, 14, 5.000, 1.000, 3.000, 3.000, 0.000),
(392, 138, 14, 5.000, 1.000, 3.000, 3.000, 0.000),
(393, 139, 14, 5.000, 1.000, 3.000, 3.000, 0.000),
(394, 140, 14, 1.000, 5.000, 2.000, 1.000, 0.000),
(395, 141, 14, 2.000, 3.000, 2.000, 1.000, 1.000),
(396, 142, 14, 1.000, 5.000, 2.000, 1.000, 0.000),
(397, 141, 14, 2.000, 4.000, 4.000, 1.000, 1.000),
(398, 142, 14, 4.000, 4.000, 4.000, 1.000, 1.000),
(399, 143, 14, 2.000, 4.000, 4.000, 1.000, 1.000),
(400, 144, 14, 4.000, 4.000, 4.000, 1.000, 1.000),
(401, 145, 14, 2.000, 4.000, 3.000, 1.000, 1.000),
(402, 146, 14, 2.000, 4.000, 4.000, 1.000, 1.000),
(403, 147, 14, 2.000, 2.000, 3.000, 1.000, 1.000),
(404, 148, 14, 2.000, 2.000, 1.000, 1.000, 1.000),
(405, 149, 14, 3.000, 1.000, 3.000, 3.000, 1.000),
(406, 150, 14, 5.000, 1.000, 3.000, 3.000, 0.000),
(407, 151, 14, 5.000, 1.000, 3.000, 3.000, 1.000),
(408, 152, 14, 5.000, 1.000, 3.000, 3.000, 1.000),
(409, 153, 14, 5.000, 1.000, 3.000, 3.000, 0.000),
(410, 154, 14, 5.000, 1.000, 3.000, 3.000, 0.000),
(411, 155, 14, 1.000, 5.000, 2.000, 1.000, 0.000),
(412, 156, 14, 1.000, 3.000, 2.000, 1.000, 1.000),
(413, 157, 14, 1.000, 3.000, 2.000, 1.000, 1.000),
(414, 158, 14, 1.000, 2.000, 2.000, 1.000, 1.000),
(415, 159, 14, 1.000, 5.000, 2.000, 1.000, 0.000),
(416, 160, 14, 1.000, 3.000, 2.000, 1.000, 1.000),
(417, 161, 14, 1.000, 3.000, 2.000, 1.000, 1.000),
(418, 162, 14, 1.000, 5.000, 2.000, 1.000, 0.000);

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
(131, 15, 120, 1, 2024),
(132, 15, 121, 1, 2024),
(133, 15, 122, 1, 2024),
(134, 15, 123, 1, 2024),
(135, 15, 124, 1, 2024),
(136, 15, 125, 1, 2024),
(137, 15, 126, 1, 2024),
(138, 15, 127, 1, 2024),
(139, 15, 128, 1, 2024),
(140, 15, 129, 1, 2024),
(141, 15, 130, 1, 2024),
(142, 15, 131, 1, 2024),
(143, 16, 132, 1, 2024),
(144, 16, 133, 1, 2024),
(145, 16, 134, 1, 2024),
(146, 16, 135, 1, 2024),
(147, 16, 136, 1, 2024),
(148, 16, 137, 1, 2024),
(149, 16, 138, 1, 2024),
(150, 16, 139, 1, 2024),
(151, 16, 140, 1, 2024),
(152, 17, 141, 1, 2024),
(153, 17, 142, 1, 2024),
(154, 18, 141, 1, 2024),
(155, 18, 142, 1, 2024),
(156, 19, 143, 1, 2024),
(157, 19, 144, 1, 2024),
(158, 19, 145, 1, 2024),
(159, 19, 146, 1, 2024),
(160, 19, 147, 1, 2024),
(161, 19, 148, 1, 2024),
(162, 19, 149, 1, 2024),
(163, 19, 150, 1, 2024),
(164, 19, 151, 1, 2024),
(165, 19, 152, 1, 2024),
(166, 19, 153, 1, 2024),
(167, 19, 154, 1, 2024),
(168, 19, 155, 1, 2024),
(169, 20, 156, 1, 2024),
(170, 20, 157, 1, 2024),
(171, 20, 158, 1, 2024),
(172, 20, 159, 1, 2024),
(173, 21, 160, 1, 2024),
(174, 21, 161, 1, 2024),
(175, 21, 162, 1, 2024);

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
  `PracticalHours` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`SubjectID`, `SubjectCode`, `SubjectName`, `CreditHours`, `CurriculumYear`, `TheoryHours`, `PracticalHours`) VALUES
(120, '20000-1101', 'ภาษาไทยเพื่อสื่อสาร', 1, '2024', 0, 2),
(121, '20000-1201', 'ภาษาอังกฤษเพื่อการสื่อสาร', 1, '2024', 0, 2),
(122, '20000-1401', 'คณิตศาสตร์พื้นฐานอาชีพ', 2, '2024', 2, 0),
(123, '20000-1301', 'วิทยาศาสตร์พื้นฐานอาชีพ', 2, '2024', 1, 2),
(124, '20000-1501', 'หน้าที่พลเมืองและศีลธรรม', 2, '2024', 2, 0),
(125, '20001-1001', 'สุขภาพความปลอดภัยและสิ่งแวดล้อม', 2, '2024', 1, 2),
(126, '20001-1005', 'การใช้เทคโนโลยีดิจิทัลเพื่ออาชีพ', 3, '2024', 2, 2),
(127, '21910-0001', 'พื้นฐานธุรกิจดิจิทัล', 2, '2024', 1, 2),
(128, '21910-2001', 'ระบบปฏิบัติการคอมพิวเตอร์', 3, '2024', 2, 2),
(129, '21910-2018', 'คอมพิวเตอร์และการบำรุงรักษา', 2, '2024', 1, 3),
(130, '21910-2002', 'อินเทอร์เน็ตในงานธุรกิจดิจิทัล', 2, '2024', 1, 2),
(131, '20000-2001', 'กิจกรรมลูกเสือวิสามัญ 1', 0, '2024', 0, 2),
(132, '20000-1102', 'ภาษาไทยเพื่ออาชีพ', 1, '2019', 0, 2),
(133, '20000-1218', 'ภาษาอังกฤษสำหรับงานเทคโนโลยีสารสนเทศ', 1, '2019', 0, 2),
(134, '20001-1002', 'พลังงาน ทรัพยากรและสิ่งแวดล้อม', 2, '2019', 2, 0),
(135, '20204-2003', 'คณิตศาสตร์คอมพิวเตอร์', 2, '2019', 1, 2),
(136, '20204-2007', 'โปรแกรมกราฟิก', 3, '2019', 2, 2),
(137, '20204-2103', 'โปรแกรมตารางงาน', 3, '2019', 2, 2),
(138, '20204-2104', 'โปรแกรมนำเสนอ', 3, '2019', 2, 2),
(139, '20204-2105', 'โปรแกรมฐานข้อมูล', 3, '2019', 2, 2),
(140, '20000-2003', 'กิจกรรมองค์การวิชาชีพ 1', 0, '2019', 0, 2),
(141, '20204-8001', 'ฝึกงาน', 4, '2019', 0, 4),
(142, '20000-2005', 'กิจกรรมองค์การวิชาชีพ 3', 0, '2019', 0, 2),
(143, '30000-1101', 'ทักษะภาษาไทยเพื่อสื่อสารในงานอาชีพ', 2, '2024', 1, 2),
(144, '30000-1201', 'ภาษาอังกฤษสำหรับงานอาชีพ', 2, '2024', 1, 2),
(145, '30000-1301', 'วิทยาศาสตร์งานอาชีพธุรกิจและบริการ', 3, '2024', 2, 2),
(146, '30000-1501', 'สังคมไทยในยุคดิจิทัล', 2, '2024', 1, 2),
(147, '30001-1001', 'การเป็นผู้ประกอบการ', 3, '2024', 2, 2),
(148, '30001-1002', 'องค์การและการบริหารงานคุณภาพ', 3, '2024', 3, 0),
(149, '30001-1003', 'การประยุกต์ใช้เทคโนโลยีดิจิทัลในอาชีพ', 3, '2024', 2, 2),
(150, '31910-2002', 'ระบบจัดการฐานข้อมูล', 3, '2024', 2, 2),
(151, '31910-2003', 'วิเคราะห์และออกแบบระบบเชิงวัตถุ', 3, '2024', 2, 2),
(152, '31910-2004', 'หลักการคิดเชิงออกแบบและนวัตกรรมธุรกิจดิจิทัล', 3, '2024', 2, 2),
(153, '31910-2005', 'การเขียนโปรแกรมเชิงวัตถุ', 3, '2024', 2, 2),
(154, '31910-2007', 'เครือข่ายคอมพิวเตอร์และความปลอดภัย', 3, '2024', 2, 2),
(155, '30000-2002', 'กิจกรรมองค์การวิชาชีพ 1', 0, '2024', 0, 2),
(156, '30204-5103', 'งานธุรกิจดิจิทัล 3', 3, '2021', 0, 3),
(157, '30204-5104', 'งานธุรกิจดิจิทัล 4', 3, '2021', 0, 3),
(158, '30204-8003', 'ฝึกงาน 2', 2, '2021', 0, 3),
(159, '30000-2003', 'กิจกรรมองค์การวิชาชีพ 3', 0, '2021', 0, 2),
(160, '30204-8002', 'ฝึกงาน 1', 2, '2021', 0, 3),
(161, '30204-8003', 'ฝึกงาน 2', 2, '2021', 0, 3),
(162, '30000-2003', 'กิจกรรมองค์การวิชาชีพ 3', 0, '2021', 0, 2);

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
  ADD KEY `rules_ibfk_2` (`UserID`),
  ADD KEY `buwegew` (`SubjectID`);

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
  ADD KEY `rules_ibfk_1` (`SubjectID`),
  ADD KEY `classgrouprules` (`ClassGroupID`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`SubjectID`);

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
  MODIFY `PriorityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=419;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `ScheduleID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52989;

--
-- AUTO_INCREMENT for table `studyplans`
--
ALTER TABLE `studyplans`
  MODIFY `StudyPlanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `SubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;

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
  ADD CONSTRAINT `buwegew` FOREIGN KEY (`SubjectID`) REFERENCES `subjects` (`SubjectID`),
  ADD CONSTRAINT `rules_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `Schedule_ibfk_2` FOREIGN KEY (`TeacherID`) REFERENCES `teachers` (`TeacherID`),
  ADD CONSTRAINT `Schedule_ibfk_3` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`),
  ADD CONSTRAINT `Schedule_ibfk_4` FOREIGN KEY (`ClassGroupID`) REFERENCES `classgroup` (`ClassGroupID`),
  ADD CONSTRAINT `subject111111` FOREIGN KEY (`SubjectID`) REFERENCES `subjects` (`SubjectID`);

--
-- Constraints for table `studyplans`
--
ALTER TABLE `studyplans`
  ADD CONSTRAINT `classgrouprules` FOREIGN KEY (`ClassGroupID`) REFERENCES `classgroup` (`ClassGroupID`),
  ADD CONSTRAINT `rules_ibfk_1` FOREIGN KEY (`SubjectID`) REFERENCES `subjects` (`SubjectID`);

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
