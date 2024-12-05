-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 04:20 AM
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
  `RoomTypeID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`RoomID`, `RoomName`, `Capacity`, `Location`, `RoomTypeID`) VALUES
(1, 'Lab1', 40, 'อาคารเฉลิมพระเกียรติ', 10),
(2, 'Lab2', 40, 'อาคารเฉลิมพระเกียรติ', 10),
(3, 'Lab3', 40, 'อาคารเฉลิมพระเกียรติ', 10),
(4, 'Lab4', 40, 'อาคารเฉลิมพระเกียรติ', 10),
(5, 'ห้องอินเทอร์เน็ต', 40, 'อาคารวิทยบริการ', 22),
(6, 'ห้องคอมช่างเชื่อม', 30, 'โรงฝึกงานช่างเชื่อม', 14);

-- --------------------------------------------------------

--
-- Table structure for table `roomtypes`
--

CREATE TABLE `roomtypes` (
  `RoomTypeID` int(11) NOT NULL,
  `RoomTypeName` varchar(100) NOT NULL,
  `DepartmentID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `roomtypes`
--

INSERT INTO `roomtypes` (`RoomTypeID`, `RoomTypeName`, `DepartmentID`) VALUES
(1, 'ห้องเรียนทฤษฎี', 1),
(2, 'ห้องเรียนทฤษฎี', 2),
(3, 'ห้องเรียนทฤษฎี', 3),
(4, 'ห้องเรียนทฤษฎี', 4),
(5, 'ห้องเรียนทฤษฎี', 5),
(6, 'ห้องเรียนทฤษฎี', 6),
(7, 'ห้องเรียนทฤษฎี', 7),
(8, 'ห้องเรียนทฤษฎี', 8),
(9, 'ห้องเรียนทฤษฎี', 9),
(10, 'ห้องเรียนทฤษฎี', 10),
(11, 'ห้องเรียนทฤษฎี', 11),
(12, 'ห้องเรียนปฏิบัติ', 1),
(13, 'ห้องเรียนปฏิบัติ', 2),
(14, 'ห้องเรียนปฏิบัติ', 3),
(15, 'ห้องเรียนปฏิบัติ', 4),
(16, 'ห้องเรียนปฏิบัติ', 5),
(17, 'ห้องเรียนปฏิบัติ', 6),
(18, 'ห้องเรียนปฏิบัติ', 7),
(19, 'ห้องเรียนปฏิบัติ', 8),
(20, 'ห้องเรียนปฏิบัติ', 9),
(21, 'ห้องเรียนปฏิบัติ', 10),
(22, 'ห้องเรียนปฏิบัติ', 12);

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
  `Weight` float NOT NULL,
  `SubjectType` float(10,3) NOT NULL,
  `TheoryPractice` float(10,3) NOT NULL,
  `EquipmentWeight` float(10,3) NOT NULL,
  `Continuity` float(10,3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `ScheduleID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `TeacherID` int(11) NOT NULL,
  `RoomID` int(11) NOT NULL,
  `TimeSlot` enum('Mon1','Mon2','Mon3','Mon4','Mon5','Mon6','Mon7','Mon8','Mon9','Mon10','Mon11','Mon12','Tue1','Tue2','Tue3','Tue4','Tue5','Tue6','Tue7','Tue8','Tue9','Tue10','Tue11','Tue12','Wed1','Wed2','Wed3','Wed4','Wed5','Wed6','Wed7','Wed8','Wed9','Wed10','Wed11','Wed12','Thu1','Thu2','Thu3','Thu4','Thu5','Thu6','Thu7','Thu8','Thu9','Thu10','Thu11','Thu12','Fri1','Fri2','Fri3','Fri4','Fri5','Fri6','Fri7','Fri8','Fri9','Fri10','Fri11','Fri12','Sat1','Sat2','Sat3','Sat4','Sat5','Sat6','Sat7','Sat8','Sat9','Sat10','Sat11','Sat12','Sun1','Sun2','Sun3','Sun4','Sun5','Sun6','Sun7','Sun8','Sun9','Sun10','Sun11','Sun12') NOT NULL,
  `DayOfWeek` varchar(10) NOT NULL,
  `ClassGroup` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `studyplans`
--

CREATE TABLE `studyplans` (
  `StudyPlanID` int(11) NOT NULL,
  `ClassGroupID` int(11) NOT NULL,
  `SubjectID` int(11) NOT NULL,
  `Term` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `studyplans`
--

INSERT INTO `studyplans` (`StudyPlanID`, `ClassGroupID`, `SubjectID`, `Term`) VALUES
(1, 15, 71, 2),
(2, 15, 72, 2),
(3, 15, 73, 2),
(4, 15, 74, 2),
(5, 15, 75, 2),
(6, 15, 76, 2),
(7, 15, 77, 2),
(8, 15, 78, 2),
(9, 15, 106, 2),
(10, 15, 107, 2),
(11, 15, 108, 2),
(12, 15, 109, 2),
(13, 15, 110, 2),
(16, 16, 79, 2),
(17, 16, 80, 2),
(18, 16, 81, 2),
(19, 16, 82, 2),
(20, 16, 83, 2),
(21, 16, 84, 2),
(22, 16, 85, 2),
(23, 16, 111, 2),
(24, 16, 112, 2),
(31, 17, 86, 2),
(32, 17, 87, 2),
(33, 17, 88, 2),
(34, 17, 89, 2),
(35, 17, 113, 2),
(36, 17, 114, 2),
(37, 17, 115, 2),
(38, 18, 86, 2),
(39, 18, 87, 2),
(40, 18, 88, 2),
(41, 18, 89, 2),
(42, 18, 113, 2),
(43, 18, 114, 2),
(44, 18, 115, 2),
(45, 19, 90, 2),
(46, 19, 91, 2),
(47, 19, 92, 2),
(48, 19, 93, 2),
(49, 19, 94, 2),
(50, 19, 103, 2),
(52, 20, 94, 2),
(53, 20, 95, 2),
(54, 20, 96, 2),
(55, 20, 97, 2),
(56, 20, 98, 2),
(57, 20, 99, 2),
(58, 20, 100, 2),
(59, 20, 101, 2),
(60, 20, 102, 2),
(61, 20, 103, 2),
(62, 20, 116, 2),
(63, 20, 117, 2),
(64, 20, 118, 2),
(67, 21, 94, 2),
(68, 21, 95, 2),
(69, 21, 96, 2),
(70, 21, 99, 2),
(71, 21, 101, 2),
(72, 21, 102, 2),
(73, 21, 103, 2),
(74, 21, 104, 2),
(75, 21, 105, 2),
(76, 21, 116, 2),
(77, 21, 117, 2),
(78, 21, 118, 2);

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

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`SubjectID`, `SubjectCode`, `SubjectName`, `CreditHours`, `CurriculumYear`, `TheoryHours`, `PracticalHours`, `DepartmentID`, `SubjectType`) VALUES
(71, '20001-1003', 'ธุรกิจเบื้องต้น', 2, '2024', 1, 2, 10, 'ทฤษฎี'),
(72, '21910-1002', 'วิเคราะห์ความต้องการทางธุรกิจ', 2, '2024', 1, 2, 10, 'ทฤษฎี'),
(73, '21910-1003', 'การเขียนโปรแกรมคอมพิวเตอร์เบื้องต้น', 2, '2024', 1, 2, 10, 'ปฏิบัติ'),
(74, '21910-1004', 'พาณิชย์อิเล็กทรอนิกส์เบื้องต้น', 2, '2024', 1, 2, 10, 'ปฏิบัติ'),
(75, '21910-2007', 'โปรแกรมกราฟิกเพื่อสร้างสื่อดิจิทัล', 3, '2024', 2, 2, 10, 'ปฏิบัติ'),
(76, '21910-2009', 'คณิตศาสตร์คอมพิวเตอร์', 2, '2024', 1, 2, 10, 'ทฤษฎี'),
(77, '21910-2010', 'การเขียนโปรแกรมภาษาคอมพิวเตอร์', 3, '2024', 2, 2, 10, 'ปฏิบัติ'),
(78, '20000-2002', 'กิจกรรมลูกเสือวิสามัญ 2', 0, '2024', 0, 2, 10, 'กิจกรรม'),
(79, '20001-1005', 'กฏหมายพาณิชย์', 2, '2019', 2, 0, 10, 'ทฤษฎี'),
(80, '20204-2004', 'หลักการเขียนโปรแกรม', 3, '2019', 2, 2, 10, 'ปฏิบัติ'),
(81, '20204-2006', 'องค์ประกอบศิลป์สำหรับงานคอมพิวเตอร์', 2, '2019', 1, 2, 10, 'ปฏิบัติ'),
(82, '20204-2008', 'การสร้างเว็บไซต์', 3, '2019', 2, 2, 10, 'ปฏิบัติ'),
(83, '20204-2108', 'การเขียนโปรแกรมเชิงวัตถุเบื้องต้น', 3, '2019', 2, 2, 10, 'ปฏิบัติ'),
(84, '20204-2109', 'การผลิตสื่อสิ่งพิมพ์', 3, '2019', 2, 2, 10, 'ปฏิบัติ'),
(85, '20000-2004', 'กิจกรรมองค์การวิชาชีพ 2', 0, '2019', 0, 2, 10, 'กิจกรรม'),
(86, '20204-2106', 'โปรแกรมสำเร็จรูปทางสถิติ', 3, '2019', 2, 2, 10, 'ปฏิบัติ'),
(87, '20204-8501', 'โครงงาน', 4, '2019', 0, 4, 10, 'ปฏิบัติ'),
(88, '20204-2110', 'โปรแกรมมัลติมีเดีย', 3, '2019', 2, 2, 10, 'ปฏิบัติ'),
(89, '20204-2111', 'โปรแกรมสร้างภาพเคลื่อนไหว', 3, '2019', 2, 2, 10, 'ปฏิบัติ'),
(90, '31910-2001', 'การบริหารจัดการความต้องการทางธุรกิจ', 3, '2024', 2, 2, 10, 'สถานประกอบการ'),
(91, '31910-2015', 'การออกแบบสื่อดิจิทัล', 3, '2024', 2, 2, 10, 'สถานประกอบการ'),
(92, '31910-2023', 'การบำรุงรักษาคอมพิวเตอร์และอุปกรณ์พกพา', 3, '2024', 2, 2, 10, 'สถานประกอบการ'),
(93, '31910-2006', 'การสร้างแบรนด์ธุรกิจดิจิทัล', 3, '2024', 2, 2, 10, 'สถานประกอบการ'),
(94, '30000-2005', 'กิจกรรมในสถานประกอบการ 1', 0, '2024', 0, 2, 10, 'สถานประกอบการ'),
(95, '30001-1055', 'กฏหมายธุรกิจ', 3, '2021', 3, 0, 10, 'ทฤษฎี'),
(96, '30200-1002', 'หลักการตลาด', 3, '2021', 2, 2, 10, 'ทฤษฎี'),
(97, '30204-2001', 'พื้นฐานธุรกิจดิจิทัล', 3, '2021', 2, 2, 10, 'ทฤษฎี'),
(98, '30204-2004', 'หลักการคิดเชิงออกแบบและนวัตกรรมธุรกิจฯ', 3, '2021', 2, 2, 10, 'ทฤษฎี'),
(99, '30204-2005', 'การเขียนโปรแกรมคอมพิวเตอร์', 3, '2021', 2, 2, 10, 'ปฏิบัติ'),
(100, '30204-2006', 'การสร้างแบรนด์ธุรกิจดิจิทัล', 3, '2021', 2, 2, 10, 'ทฤษฎี'),
(101, '30204-2007', 'เครือข่ายคอมพิวเตอร์และความปลอดภัยสำหรับธุรกิจฯ', 3, '2021', 2, 2, 10, 'ปฏิบัติ'),
(102, '30204-8501', 'โครงงาน', 4, '2021', 0, 4, 10, 'ปฏิบัติ'),
(103, '30000-2005', 'กิจกรรมส่งเสริมคุณธรรม จริยธรรม', 0, '2021', 0, 2, 10, 'กิจกรรม'),
(104, '30204-2303', 'การพัฒนาโปรแกรมบนอุปกรณ์เคลื่อนที่แบบพกพา', 3, '2021', 2, 2, 10, 'ปฏิบัติ'),
(105, '30204-2204', 'การผลิตสื่อมัลติมีเดียสำหรับธุรกิจดิจิทัล', 3, '2021', 2, 2, 10, 'ปฏิบัติ'),
(106, '20000-1102', 'ภาษาไทยเพื่ออาชีพ', 1, '2024', 0, 2, 11, 'ทฤษฎี'),
(107, '20000-1203', 'การฟังและการพูดภาษาอังกฤษ', 1, '2024', 0, 2, 11, 'ทฤษฎี'),
(108, '20000-1402', 'คณิตศาสตร์อุตสาหกรรม', 2, '2024', 2, 0, 11, 'ทฤษฎี'),
(109, '20000-1602', 'เพศวิถีศึกษา', 1, '2024', 1, 0, 11, 'ทฤษฎี'),
(110, '20000-1603', 'พลศึกษาเพื่อพัฒนาสุขภาพ', 1, '2024', 0, 2, 11, 'ทฤษฎี'),
(111, '20000-1205', 'ภาษาอังกฤษสถานประกอบการ', 1, '2019', 0, 2, 11, 'ทฤษฎี'),
(112, '20000-1210', 'ภาษาอังกฤษสำหรับงานธุรกิจ', 1, '2019', 0, 2, 11, 'ทฤษฎี'),
(113, '20000-1208', 'ภาษาอังกฤษเตรียมความพร้อมเพื่อการทำงาน', 1, '2019', 0, 2, 11, 'ทฤษฎี'),
(114, '20000-1404', 'คณิตศาสตร์ธุรกิจบริการ', 2, '2019', 2, 0, 11, 'ทฤษฎี'),
(115, '20000-1502', 'ประวัติศาสตร์ชาติไทย', 1, '2019', 1, 0, 11, 'ทฤษฎี'),
(116, '30000-1214', 'ภาษาอังกฤษเทคโนโลยีสารสนเทศ', 3, '2021', 3, 0, 11, 'ทฤษฎี'),
(117, '30000-1408', 'คณิตศาสตร์ธุรกิจและบริการ', 3, '2021', 3, 0, 11, 'ทฤษฎี'),
(118, '30000-1609', 'ลีลาศเพื่อพัฒนาสุขภาพและบุคลิกภาพ', 1, '2021', 0, 2, 11, 'ทฤษฎี');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `TeacherID` int(11) NOT NULL,
  `Specialization` varchar(100) DEFAULT NULL,
  `AvailableHours` text DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`TeacherID`, `Specialization`, `AvailableHours`, `UserID`) VALUES
(1, 'Computer', '35', 5);

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
(10, 'headoffice', 'head', '$2y$10$avNpjqogZn0bDjywSAxLmuGj8bVcOguWIRNr/x5lGPKKVrIfijPg2', 'DepartmentHead', '0910171373', '2024-12-01 14:34:19');

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
  ADD KEY `FK_Rooms_RoomTypes` (`RoomTypeID`);

--
-- Indexes for table `roomtypes`
--
ALTER TABLE `roomtypes`
  ADD PRIMARY KEY (`RoomTypeID`),
  ADD KEY `DepartmentID` (`DepartmentID`);

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
  ADD KEY `SubjectID` (`SubjectID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`ScheduleID`),
  ADD KEY `SubjectID` (`SubjectID`),
  ADD KEY `TeacherID` (`TeacherID`),
  ADD KEY `RoomID` (`RoomID`);

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
  ADD KEY `UserID` (`UserID`);

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
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `PriorityID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `ScheduleID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studyplans`
--
ALTER TABLE `studyplans`
  MODIFY `StudyPlanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `SubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `TeacherID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  ADD CONSTRAINT `FK_Rooms_RoomTypes` FOREIGN KEY (`RoomTypeID`) REFERENCES `roomtypes` (`RoomTypeID`);

--
-- Constraints for table `roomtypes`
--
ALTER TABLE `roomtypes`
  ADD CONSTRAINT `RoomTypes_ibfk_1` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`DepartmentID`);

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
  ADD CONSTRAINT `rules_ibfk_1` FOREIGN KEY (`SubjectID`) REFERENCES `subjects` (`SubjectID`) ON DELETE CASCADE;

--
-- Constraints for table `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `Schedule_ibfk_1` FOREIGN KEY (`SubjectID`) REFERENCES `subjects` (`SubjectID`),
  ADD CONSTRAINT `Schedule_ibfk_2` FOREIGN KEY (`TeacherID`) REFERENCES `teachers` (`TeacherID`),
  ADD CONSTRAINT `Schedule_ibfk_3` FOREIGN KEY (`RoomID`) REFERENCES `rooms` (`RoomID`);

--
-- Constraints for table `studyplans`
--
ALTER TABLE `studyplans`
  ADD CONSTRAINT `studyplans_ibfk_1` FOREIGN KEY (`ClassGroupID`) REFERENCES `classgroup` (`ClassGroupID`) ON DELETE CASCADE,
  ADD CONSTRAINT `studyplans_ibfk_2` FOREIGN KEY (`SubjectID`) REFERENCES `subjects` (`SubjectID`) ON DELETE CASCADE;

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `FK_Subjects_Department` FOREIGN KEY (`DepartmentID`) REFERENCES `departments` (`DepartmentID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `Teachers_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
