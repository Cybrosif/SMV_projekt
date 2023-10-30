-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Oct 23, 2023 at 04:26 PM
-- Server version: 8.1.0
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `classorbit`
--
CREATE DATABASE IF NOT EXISTS `classorbit` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `classorbit`;

-- --------------------------------------------------------

--
-- Table structure for table `gradiva`
--

CREATE TABLE `gradiva` (
  `Gradivo_ID` int NOT NULL,
  `Razred_ID` int DEFAULT NULL,
  `Naslov` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Pot_Do_Datoteke` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `naloge`
--

CREATE TABLE `naloge` (
  `Naloga_ID` int NOT NULL,
  `Razred_ID` int DEFAULT NULL,
  `Gradiva_ID` int DEFAULT NULL,
  `Naslov` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Rok` date DEFAULT NULL,
  `Visible` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `razredi`
--

CREATE TABLE `razredi` (
  `Razred_ID` int NOT NULL,
  `Kljuc_Vpisa` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `Ime_razreda` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `razredi`
--

INSERT INTO `razredi` (`Razred_ID`, `Ime_razreda`, `Kljuc_Vpisa`) VALUES
(7, 'Predmet1', 'KljucVpisa1'),
(8, 'Predmet2', 'KljucVpisa2'),
(9, 'Predmet3', 'KljucVpisa3'),
(10, 'Predmet4', 'KljucVpisa4'),
(11, 'Predmet5', 'KljucVpisa5'),
(12, 'Predmet6', 'KljucVpisa6'),
(13, 'Predmet7', 'KljucVpisa7'),
(14, 'Predmet8', 'KljucVpisa8'),
(15, 'Predmet9', 'KljucVpisa9'),
(16, 'Predmet10', 'KljucVpisa10'),
(17, 'Predmet11', 'KljucVpisa11'),
(18, 'Predmet12', 'KljucVpisa12'),
(19, 'Predmet13', 'KljucVpisa13'),
(20, 'Predmet14', 'KljucVpisa14'),
(21, 'Predmet15', 'KljucVpisa15'),
(22, 'Predmet16', 'KljucVpisa16'),
(23, 'Predmet17', 'KljucVpisa17'),
(24, 'Predmet18', 'KljucVpisa18'),
(25, 'Predmet19', 'KljucVpisa19'),
(26, 'Predmet20', 'KljucVpisa20'),
(27, 'Predmet21', 'KljucVpisa21'),
(28, 'Predmet22', 'KljucVpisa22'),
(29, 'Predmet23', 'KljucVpisa23'),
(30, 'Predmet24', 'KljucVpisa24'),
(31, 'Predmet25', 'KljucVpisa25'),
(32, 'Predmet26', 'KljucVpisa26'),
(33, 'Predmet27', 'KljucVpisa27'),
(34, 'Predmet28', 'KljucVpisa28'),
(35, 'Predmet29', 'KljucVpisa29'),
(36, 'Predmet30', 'KljucVpisa30'),
(37, 'Predmet31', 'KljucVpisa31'),
(38, 'Predmet32', 'KljucVpisa32'),
(39, 'Predmet33', 'KljucVpisa33'),
(40, 'Predmet34', 'KljucVpisa34'),
(41, 'Predmet35', 'KljucVpisa35'),
(42, 'Predmet36', 'KljucVpisa36'),
(43, 'Predmet37', 'KljucVpisa37'),
(44, 'Predmet38', 'KljucVpisa38'),
(45, 'Predmet39', 'KljucVpisa39'),
(46, 'Predmet40', 'KljucVpisa40'),
(47, 'Predmet41', 'KljucVpisa41'),
(48, 'Predmet42', 'KljucVpisa42'),
(49, 'Predmet43', 'KljucVpisa43'),
(50, 'Predmet44', 'KljucVpisa44'),
(51, 'Predmet45', 'KljucVpisa45'),
(52, 'Predmet46', 'KljucVpisa46'),
(53, 'Predmet47', 'KljucVpisa47'),
(54, 'Predmet48', 'KljucVpisa48'),
(55, 'Predmet49', 'KljucVpisa49'),
(56, 'Predmet50', 'KljucVpisa50');

-- --------------------------------------------------------

--
-- Table structure for table `student_naloge`
--

CREATE TABLE `student_naloge` (
  `Student_Naloga_ID` int NOT NULL,
  `Student_ID` int DEFAULT NULL,
  `Naloga_ID` int DEFAULT NULL,
  `Datum_Oddaje` date DEFAULT NULL,
  `Pot_Do_Datoteke` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Original_Filename` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ucitelji_razredi`
--

CREATE TABLE `ucitelji_razredi` (
  `Ucitelj_ID` int NOT NULL,
  `Razred_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `uporabniki`
--

CREATE TABLE `uporabniki` (
  `ID` int NOT NULL,
  `Ime` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Priimek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Vloga` enum('Administrator','Profesor','Dijak') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'Dijak',
  `Geslo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uporabniki`
--

INSERT INTO `uporabniki` (`ID`, `Ime`, `Priimek`, `Vloga`, `Geslo`, `Email`) VALUES
(114, 'Uporabnik1', 'Priimek1', 'Dijak', 'geslo1', 'uporabnik1@example.com'),
(115, 'Uporabnik2', 'Priimek2', 'Profesor', 'geslo2', 'uporabnik2@example.com'),
(116, 'Uporabnik3', 'Priimek3', 'Administrator', 'geslo3', 'uporabnik3@example.com'),
(117, 'Uporabnik4', 'Priimek4', 'Profesor', 'geslo4', 'uporabnik4@example.com'),
(118, 'Uporabnik5', 'Priimek5', 'Dijak', 'geslo5', 'uporabnik5@example.com'),
(119, 'Uporabnik6', 'Priimek6', 'Administrator', 'geslo6', 'uporabnik6@example.com'),
(120, 'Uporabnik7', 'Priimek7', 'Dijak', 'geslo7', 'uporabnik7@example.com'),
(121, 'Uporabnik8', 'Priimek8', 'Profesor', 'geslo8', 'uporabnik8@example.com'),
(122, 'Uporabnik9', 'Priimek9', 'Administrator', 'geslo9', 'uporabnik9@example.com'),
(123, 'Uporabnik10', 'Priimek10', 'Profesor', 'geslo10', 'uporabnik10@example.com'),
(124, 'Uporabnik11', 'Priimek11', 'Dijak', 'geslo11', 'uporabnik11@example.com'),
(125, 'Uporabnik12', 'Priimek12', 'Administrator', 'geslo12', 'uporabnik12@example.com'),
(126, 'Uporabnik13', 'Priimek13', 'Dijak', 'geslo13', 'uporabnik13@example.com'),
(127, 'Uporabnik14', 'Priimek14', 'Profesor', 'geslo14', 'uporabnik14@example.com'),
(128, 'Uporabnik15', 'Priimek15', 'Administrator', 'geslo15', 'uporabnik15@example.com'),
(129, 'Uporabnik16', 'Priimek16', 'Profesor', 'geslo16', 'uporabnik16@example.com'),
(130, 'Uporabnik17', 'Priimek17', 'Dijak', 'geslo17', 'uporabnik17@example.com'),
(131, 'Uporabnik18', 'Priimek18', 'Administrator', 'geslo18', 'uporabnik18@example.com'),
(132, 'Uporabnik19', 'Priimek19', 'Dijak', 'geslo19', 'uporabnik19@example.com'),
(133, 'Uporabnik20', 'Priimek20', 'Profesor', 'geslo20', 'uporabnik20@example.com'),
(134, 'Uporabnik21', 'Priimek21', 'Administrator', 'geslo21', 'uporabnik21@example.com'),
(135, 'Uporabnik22', 'Priimek22', 'Profesor', 'geslo22', 'uporabnik22@example.com'),
(136, 'Uporabnik23', 'Priimek23', 'Dijak', 'geslo23', 'uporabnik23@example.com'),
(137, 'Uporabnik24', 'Priimek24', 'Administrator', 'geslo24', 'uporabnik24@example.com'),
(138, 'Uporabnik25', 'Priimek25', 'Dijak', 'geslo25', 'uporabnik25@example.com'),
(139, 'Uporabnik26', 'Priimek26', 'Profesor', 'geslo26', 'uporabnik26@example.com'),
(140, 'Uporabnik27', 'Priimek27', 'Administrator', 'geslo27', 'uporabnik27@example.com'),
(141, 'Uporabnik28', 'Priimek28', 'Profesor', 'geslo28', 'uporabnik28@example.com'),
(142, 'Uporabnik29', 'Priimek29', 'Dijak', 'geslo29', 'uporabnik29@example.com'),
(143, 'Uporabnik30', 'Priimek30', 'Administrator', 'geslo30', 'uporabnik30@example.com'),
(144, 'Uporabnik31', 'Priimek31', 'Dijak', 'geslo31', 'uporabnik31@example.com'),
(145, 'Uporabnik32', 'Priimek32', 'Profesor', 'geslo32', 'uporabnik32@example.com'),
(146, 'Uporabnik33', 'Priimek33', 'Administrator', 'geslo33', 'uporabnik33@example.com'),
(147, 'Uporabnik34', 'Priimek34', 'Profesor', 'geslo34', 'uporabnik34@example.com'),
(148, 'Uporabnik35', 'Priimek35', 'Dijak', 'geslo35', 'uporabnik35@example.com'),
(149, 'Uporabnik36', 'Priimek36', 'Administrator', 'geslo36', 'uporabnik36@example.com'),
(150, 'Uporabnik37', 'Priimek37', 'Dijak', 'geslo37', 'uporabnik37@example.com'),
(151, 'Uporabnik38', 'Priimek38', 'Profesor', 'geslo38', 'uporabnik38@example.com'),
(152, 'Uporabnik39', 'Priimek39', 'Administrator', 'geslo39', 'uporabnik39@example.com'),
(153, 'Uporabnik40', 'Priimek40', 'Profesor', 'geslo40', 'uporabnik40@example.com'),
(154, 'Uporabnik41', 'Priimek41', 'Dijak', 'geslo41', 'uporabnik41@example.com'),
(155, 'Uporabnik42', 'Priimek42', 'Administrator', 'geslo42', 'uporabnik42@example.com'),
(156, 'Uporabnik43', 'Priimek43', 'Dijak', 'geslo43', 'uporabnik43@example.com'),
(157, 'Uporabnik44', 'Priimek44', 'Profesor', 'geslo44', 'uporabnik44@example.com'),
(158, 'Uporabnik45', 'Priimek45', 'Administrator', 'geslo45', 'uporabnik45@example.com'),
(159, 'Uporabnik46', 'Priimek46', 'Profesor', 'geslo46', 'uporabnik46@example.com'),
(160, 'Uporabnik47', 'Priimek47', 'Dijak', 'geslo47', 'uporabnik47@example.com'),
(161, 'Uporabnik48', 'Priimek48', 'Administrator', 'geslo48', 'uporabnik48@example.com'),
(162, 'Uporabnik49', 'Priimek49', 'Dijak', 'geslo49', 'uporabnik49@example.com'),
(163, 'Uporabnik50', 'Priimek50', 'Profesor', 'geslo50', 'uporabnik50@example.com'),
(164, 'Uporabnik51', 'Priimek51', 'Administrator', 'geslo51', 'uporabnik51@example.com'),
(165, 'Uporabnik52', 'Priimek52', 'Profesor', 'geslo52', 'uporabnik52@example.com'),
(166, 'Uporabnik53', 'Priimek53', 'Dijak', 'geslo53', 'uporabnik53@example.com'),
(167, 'Uporabnik54', 'Priimek54', 'Administrator', 'geslo54', 'uporabnik54@example.com'),
(168, 'Uporabnik55', 'Priimek55', 'Dijak', 'geslo55', 'uporabnik55@example.com'),
(169, 'Uporabnik56', 'Priimek56', 'Profesor', 'geslo56', 'uporabnik56@example.com'),
(170, 'Uporabnik57', 'Priimek57', 'Administrator', 'geslo57', 'uporabnik57@example.com'),
(171, 'Uporabnik58', 'Priimek58', 'Profesor', 'geslo58', 'uporabnik58@example.com'),
(172, 'Uporabnik59', 'Priimek59', 'Dijak', 'geslo59', 'uporabnik59@example.com'),
(173, 'Uporabnik60', 'Priimek60', 'Administrator', 'geslo60', 'uporabnik60@example.com'),
(174, 'Uporabnik61', 'Priimek61', 'Dijak', 'geslo61', 'uporabnik61@example.com'),
(175, 'Uporabnik62', 'Priimek62', 'Profesor', 'geslo62', 'uporabnik62@example.com'),
(176, 'Uporabnik63', 'Priimek63', 'Administrator', 'geslo63', 'uporabnik63@example.com'),
(177, 'Uporabnik64', 'Priimek64', 'Profesor', 'geslo64', 'uporabnik64@example.com'),
(178, 'Uporabnik65', 'Priimek65', 'Dijak', 'geslo65', 'uporabnik65@example.com'),
(179, 'Uporabnik66', 'Priimek66', 'Administrator', 'geslo66', 'uporabnik66@example.com'),
(180, 'Uporabnik67', 'Priimek67', 'Dijak', 'geslo67', 'uporabnik67@example.com'),
(181, 'Uporabnik68', 'Priimek68', 'Profesor', 'geslo68', 'uporabnik68@example.com'),
(182, 'Uporabnik69', 'Priimek69', 'Administrator', 'geslo69', 'uporabnik69@example.com'),
(183, 'Uporabnik70', 'Priimek70', 'Profesor', 'geslo70', 'uporabnik70@example.com'),
(184, 'Uporabnik71', 'Priimek71', 'Dijak', 'geslo71', 'uporabnik71@example.com'),
(185, 'Uporabnik72', 'Priimek72', 'Administrator', 'geslo72', 'uporabnik72@example.com'),
(186, 'Uporabnik73', 'Priimek73', 'Dijak', 'geslo73', 'uporabnik73@example.com'),
(187, 'Uporabnik74', 'Priimek74', 'Profesor', 'geslo74', 'uporabnik74@example.com'),
(188, 'Uporabnik75', 'Priimek75', 'Administrator', 'geslo75', 'uporabnik75@example.com'),
(189, 'Uporabnik76', 'Priimek76', 'Profesor', 'geslo76', 'uporabnik76@example.com'),
(190, 'Uporabnik77', 'Priimek77', 'Dijak', 'geslo77', 'uporabnik77@example.com'),
(191, 'Uporabnik78', 'Priimek78', 'Administrator', 'geslo78', 'uporabnik78@example.com'),
(192, 'Uporabnik79', 'Priimek79', 'Dijak', 'geslo79', 'uporabnik79@example.com'),
(193, 'Uporabnik80', 'Priimek80', 'Profesor', 'geslo80', 'uporabnik80@example.com'),
(194, 'Uporabnik81', 'Priimek81', 'Administrator', 'geslo81', 'uporabnik81@example.com'),
(195, 'Uporabnik82', 'Priimek82', 'Profesor', 'geslo82', 'uporabnik82@example.com'),
(196, 'Uporabnik83', 'Priimek83', 'Dijak', 'geslo83', 'uporabnik83@example.com'),
(197, 'Uporabnik84', 'Priimek84', 'Administrator', 'geslo84', 'uporabnik84@example.com'),
(198, 'Uporabnik85', 'Priimek85', 'Dijak', 'geslo85', 'uporabnik85@example.com'),
(199, 'Uporabnik86', 'Priimek86', 'Profesor', 'geslo86', 'uporabnik86@example.com'),
(200, 'Uporabnik87', 'Priimek87', 'Administrator', 'geslo87', 'uporabnik87@example.com'),
(201, 'Uporabnik88', 'Priimek88', 'Profesor', 'geslo88', 'uporabnik88@example.com'),
(202, 'Uporabnik89', 'Priimek89', 'Dijak', 'geslo89', 'uporabnik89@example.com'),
(203, 'Uporabnik90', 'Priimek90', 'Administrator', 'geslo90', 'uporabnik90@example.com'),
(204, 'Uporabnik91', 'Priimek91', 'Dijak', 'geslo91', 'uporabnik91@example.com'),
(205, 'Uporabnik92', 'Priimek92', 'Profesor', 'geslo92', 'uporabnik92@example.com'),
(206, 'Uporabnik93', 'Priimek93', 'Administrator', 'geslo93', 'uporabnik93@example.com'),
(207, 'Uporabnik94', 'Priimek94', 'Profesor', 'geslo94', 'uporabnik94@example.com'),
(208, 'Uporabnik95', 'Priimek95', 'Dijak', 'geslo95', 'uporabnik95@example.com'),
(209, 'Uporabnik96', 'Priimek96', 'Administrator', 'geslo96', 'uporabnik96@example.com'),
(210, 'Uporabnik97', 'Priimek97', 'Dijak', 'geslo97', 'uporabnik97@example.com'),
(211, 'Uporabnik98', 'Priimek98', 'Profesor', 'geslo98', 'uporabnik98@example.com'),
(212, 'Uporabnik99', 'Priimek99', 'Administrator', 'geslo99', 'uporabnik99@example.com'),
(213, 'Uporabnik100', 'Priimek100', 'Profesor', 'geslo100', 'uporabnik100@example.com'),
(214, 'Anej', 'Doler Črep', 'Administrator', '$2y$10$ty/KeGM0iYPmk4ewGCaww.diZCz5mNhH2pqDwkwVI/FIw6khLLZ76', 'anej@test.com');

-- --------------------------------------------------------

--
-- Table structure for table `uporabniki_razredi`
--

CREATE TABLE `uporabniki_razredi` (
  `Uporabnik_ID` int NOT NULL,
  `Razred_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gradiva`
--
ALTER TABLE `gradiva`
  ADD PRIMARY KEY (`Gradivo_ID`),
  ADD KEY `Razred_ID` (`Razred_ID`);

--
-- Indexes for table `naloge`
--
ALTER TABLE `naloge`
  ADD PRIMARY KEY (`Naloga_ID`),
  ADD KEY `Razred_ID` (`Razred_ID`),
  ADD KEY `gradivo_ibfk_1` (`Gradiva_ID`);

--
-- Indexes for table `razredi`
--
ALTER TABLE `razredi`
  ADD PRIMARY KEY (`Razred_ID`);

--
-- Indexes for table `student_naloge`
--
ALTER TABLE `student_naloge`
  ADD PRIMARY KEY (`Student_Naloga_ID`),
  ADD KEY `Student_ID` (`Student_ID`),
  ADD KEY `Naloga_ID` (`Naloga_ID`);

--
-- Indexes for table `ucitelji_razredi`
--
ALTER TABLE `ucitelji_razredi`
  ADD PRIMARY KEY (`Ucitelj_ID`,`Razred_ID`),
  ADD KEY `ucitelji_razredi_ibfk_2` (`Razred_ID`);

--
-- Indexes for table `uporabniki`
--
ALTER TABLE `uporabniki`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `uporabniki_razredi`
--
ALTER TABLE `uporabniki_razredi`
  ADD PRIMARY KEY (`Uporabnik_ID`,`Razred_ID`),
  ADD KEY `uporabniki_razredi_ibfk_2` (`Razred_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gradiva`
--
ALTER TABLE `gradiva`
  MODIFY `Gradivo_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `naloge`
--
ALTER TABLE `naloge`
  MODIFY `Naloga_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `razredi`
--
ALTER TABLE `razredi`
  MODIFY `Razred_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `student_naloge`
--
ALTER TABLE `student_naloge`
  MODIFY `Student_Naloga_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `uporabniki`
--
ALTER TABLE `uporabniki`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=215;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gradiva`
--
ALTER TABLE `gradiva`
  ADD CONSTRAINT `gradiva_ibfk_1` FOREIGN KEY (`Razred_ID`) REFERENCES `razredi` (`Razred_ID`);

--
-- Constraints for table `naloge`
--
ALTER TABLE `naloge`
  ADD CONSTRAINT `gradivo_ibfk_1` FOREIGN KEY (`Gradiva_ID`) REFERENCES `gradiva` (`Gradivo_ID`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `naloge_ibfk_1` FOREIGN KEY (`Razred_ID`) REFERENCES `razredi` (`Razred_ID`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `student_naloge`
--
ALTER TABLE `student_naloge`
  ADD CONSTRAINT `student_naloge_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `uporabniki` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_naloge_ibfk_2` FOREIGN KEY (`Naloga_ID`) REFERENCES `naloge` (`Naloga_ID`) ON DELETE SET NULL ON UPDATE RESTRICT;

--
-- Constraints for table `ucitelji_razredi`
--
ALTER TABLE `ucitelji_razredi`
  ADD CONSTRAINT `ucitelji_razredi_ibfk_1` FOREIGN KEY (`Ucitelj_ID`) REFERENCES `uporabniki` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `ucitelji_razredi_ibfk_2` FOREIGN KEY (`Razred_ID`) REFERENCES `razredi` (`Razred_ID`) ON DELETE CASCADE;

--
-- Constraints for table `uporabniki_razredi`
--
ALTER TABLE `uporabniki_razredi`
  ADD CONSTRAINT `uporabniki_razredi_ibfk_1` FOREIGN KEY (`Uporabnik_ID`) REFERENCES `uporabniki` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `uporabniki_razredi_ibfk_2` FOREIGN KEY (`Razred_ID`) REFERENCES `razredi` (`Razred_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
