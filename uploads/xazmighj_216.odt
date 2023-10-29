-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Oct 20, 2023 at 08:39 PM
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
  `Naloga_ID` int DEFAULT NULL,
  `Naslov` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Pot_Do_Datoteke` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gradiva`
--

INSERT INTO `gradiva` (`Gradivo_ID`, `Razred_ID`, `Naloga_ID`, `Naslov`, `Pot_Do_Datoteke`) VALUES
(1, 1, NULL, 'test', 'test'),
(3, 1, 3, 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `naloge`
--

CREATE TABLE `naloge` (
  `Naloga_ID` int NOT NULL,
  `Razred_ID` int DEFAULT NULL,
  `Naslov` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `Rok` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `naloge`
--

INSERT INTO `naloge` (`Naloga_ID`, `Razred_ID`, `Naslov`, `Rok`) VALUES
(1, 2, 'Testna naloga', '2023-10-13'),
(2, 2, 'testna naloga 2', '2023-10-28'),
(3, 1, 'testna naloga 3', '2023-10-16'),
(4, 1, 'hizuet5rqhzurtzh', '2023-10-21');

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

INSERT INTO `razredi` (`Razred_ID`, `Kljuc_Vpisa`, `Ime_razreda`) VALUES
(1, 'KVP1', 'R1A'),
(2, 'KVP2', 'R2B'),
(3, 'KVP3', 'R3C'),
(4, 'KVP4', 'R4D'),
(5, 'KVP5', 'R5E'),
(6, 'KVP6', 'R6F');

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

--
-- Dumping data for table `student_naloge`
--

INSERT INTO `student_naloge` (`Student_Naloga_ID`, `Student_ID`, `Naloga_ID`, `Datum_Oddaje`, `Pot_Do_Datoteke`, `Original_Filename`) VALUES
(16, 1, 3, '2023-10-17', 'rnxjctqp_1.doc', 'NRPA_Vaja03_OOP_kapsulacija_moduli_knjižnice_static_const_readonly_.doc');

-- --------------------------------------------------------

--
-- Table structure for table `ucitelji_razredi`
--

CREATE TABLE `ucitelji_razredi` (
  `Ucitelj_ID` int NOT NULL,
  `Razred_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ucitelji_razredi`
--

INSERT INTO `ucitelji_razredi` (`Ucitelj_ID`, `Razred_ID`) VALUES
(1, 1),
(13, 1),
(111, 1),
(112, 1),
(1, 2),
(13, 2),
(1, 3),
(13, 3),
(1, 4),
(13, 4),
(13, 5),
(13, 6);

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
(1, 'Anej', 'Doler Črep', 'Administrator', '$2y$10$ffrFwAQ8sxVsIDFjqrlFl.igjkp9L/UPb9Nbtqo8iccdfS0xfQ19G', 'anej@test.com'),
(5, 'User2test', 'Surname2test', 'Profesor', 'password2', 'user2@example.com'),
(6, 'User3', 'Surname3', 'Administrator', 'password3', 'user3@example.com'),
(7, 'User4', 'Surname4', 'Administrator', '$2y$10$yYwMsuWaVLrwB1icL/DMD.NHCKcQBPau42phqCxqFirUbljbL.7aq', 'user4@example.com'),
(9, 'User100', 'Surname100', 'Administrator', 'password100', 'user100@example.com'),
(10, 'Uporabnik1', 'Priimek1', 'Dijak', 'geslo1', 'uporabnik1@example.com'),
(11, 'Uporabnik2', 'Priimek2', 'Profesor', 'geslo2', 'uporabnik2@example.com'),
(12, 'Uporabnik3', 'Priimek3', 'Administrator', 'geslo3', 'uporabnik3@example.com'),
(13, 'Uporabnik4', 'Priimek4', 'Profesor', 'geslo4', 'uporabnik4@example.com'),
(14, 'Uporabnik5', 'Priimek5', 'Dijak', 'geslo5', 'uporabnik5@example.com'),
(15, 'Uporabnik6', 'Priimek6', 'Administrator', 'geslo6', 'uporabnik6@example.com'),
(16, 'Uporabnik7', 'Priimek7', 'Dijak', 'geslo7', 'uporabnik7@example.com'),
(17, 'Uporabnik8', 'Priimek8', 'Profesor', 'geslo8', 'uporabnik8@example.com'),
(18, 'Uporabnik9', 'Priimek9', 'Administrator', 'geslo9', 'uporabnik9@example.com'),
(19, 'Uporabnik10', 'Priimek10', 'Profesor', 'geslo10', 'uporabnik10@example.com'),
(20, 'Uporabnik11', 'Priimek11', 'Dijak', 'geslo11', 'uporabnik11@example.com'),
(21, 'Uporabnik12', 'Priimek12', 'Administrator', 'geslo12', 'uporabnik12@example.com'),
(22, 'Uporabnik13', 'Priimek13', 'Dijak', 'geslo13', 'uporabnik13@example.com'),
(23, 'Uporabnik14', 'Priimek14', 'Profesor', 'geslo14', 'uporabnik14@example.com'),
(24, 'Uporabnik15', 'Priimek15', 'Administrator', 'geslo15', 'uporabnik15@example.com'),
(25, 'Uporabnik16', 'Priimek16', 'Profesor', 'geslo16', 'uporabnik16@example.com'),
(26, 'Uporabnik17', 'Priimek17', 'Dijak', 'geslo17', 'uporabnik17@example.com'),
(27, 'Uporabnik18', 'Priimek18', 'Administrator', 'geslo18', 'uporabnik18@example.com'),
(28, 'Uporabnik19', 'Priimek19', 'Dijak', 'geslo19', 'uporabnik19@example.com'),
(29, 'Uporabnik20', 'Priimek20', 'Profesor', 'geslo20', 'uporabnik20@example.com'),
(30, 'Uporabnik21', 'Priimek21', 'Administrator', 'geslo21', 'uporabnik21@example.com'),
(31, 'Uporabnik22', 'Priimek22', 'Profesor', 'geslo22', 'uporabnik22@example.com'),
(32, 'Uporabnik23', 'Priimek23', 'Dijak', 'geslo23', 'uporabnik23@example.com'),
(33, 'Uporabnik24', 'Priimek24', 'Administrator', 'geslo24', 'uporabnik24@example.com'),
(34, 'Uporabnik25', 'Priimek25', 'Dijak', 'geslo25', 'uporabnik25@example.com'),
(35, 'Uporabnik26', 'Priimek26', 'Profesor', 'geslo26', 'uporabnik26@example.com'),
(36, 'Uporabnik27', 'Priimek27', 'Administrator', 'geslo27', 'uporabnik27@example.com'),
(37, 'Uporabnik28', 'Priimek28', 'Profesor', 'geslo28', 'uporabnik28@example.com'),
(38, 'Uporabnik29', 'Priimek29', 'Dijak', 'geslo29', 'uporabnik29@example.com'),
(39, 'Uporabnik30', 'Priimek30', 'Administrator', 'geslo30', 'uporabnik30@example.com'),
(40, 'Uporabnik31', 'Priimek31', 'Dijak', 'geslo31', 'uporabnik31@example.com'),
(41, 'Uporabnik32', 'Priimek32', 'Profesor', 'geslo32', 'uporabnik32@example.com'),
(42, 'Uporabnik33', 'Priimek33', 'Administrator', 'geslo33', 'uporabnik33@example.com'),
(43, 'Uporabnik34', 'Priimek34', 'Profesor', 'geslo34', 'uporabnik34@example.com'),
(44, 'Uporabnik35', 'Priimek35', 'Dijak', 'geslo35', 'uporabnik35@example.com'),
(45, 'Uporabnik36', 'Priimek36', 'Administrator', 'geslo36', 'uporabnik36@example.com'),
(46, 'Uporabnik37', 'Priimek37', 'Dijak', 'geslo37', 'uporabnik37@example.com'),
(47, 'Uporabnik38', 'Priimek38', 'Profesor', 'geslo38', 'uporabnik38@example.com'),
(48, 'Uporabnik39', 'Priimek39', 'Administrator', 'geslo39', 'uporabnik39@example.com'),
(49, 'Uporabnik40', 'Priimek40', 'Profesor', 'geslo40', 'uporabnik40@example.com'),
(50, 'Uporabnik41', 'Priimek41', 'Dijak', 'geslo41', 'uporabnik41@example.com'),
(51, 'Uporabnik42', 'Priimek42', 'Administrator', 'geslo42', 'uporabnik42@example.com'),
(52, 'Uporabnik43', 'Priimek43', 'Dijak', 'geslo43', 'uporabnik43@example.com'),
(53, 'Uporabnik44', 'Priimek44', 'Profesor', 'geslo44', 'uporabnik44@example.com'),
(54, 'Uporabnik45', 'Priimek45', 'Administrator', 'geslo45', 'uporabnik45@example.com'),
(55, 'Uporabnik46', 'Priimek46', 'Profesor', 'geslo46', 'uporabnik46@example.com'),
(56, 'Uporabnik47', 'Priimek47', 'Dijak', 'geslo47', 'uporabnik47@example.com'),
(57, 'Uporabnik48', 'Priimek48', 'Administrator', 'geslo48', 'uporabnik48@example.com'),
(58, 'Uporabnik49', 'Priimek49', 'Dijak', 'geslo49', 'uporabnik49@example.com'),
(59, 'Uporabnik50', 'Priimek50', 'Profesor', 'geslo50', 'uporabnik50@example.com'),
(60, 'Uporabnik51', 'Priimek51', 'Administrator', 'geslo51', 'uporabnik51@example.com'),
(61, 'Uporabnik52', 'Priimek52', 'Profesor', 'geslo52', 'uporabnik52@example.com'),
(62, 'Uporabnik53', 'Priimek53', 'Dijak', 'geslo53', 'uporabnik53@example.com'),
(63, 'Uporabnik54', 'Priimek54', 'Administrator', 'geslo54', 'uporabnik54@example.com'),
(64, 'Uporabnik55', 'Priimek55', 'Dijak', 'geslo55', 'uporabnik55@example.com'),
(65, 'Uporabnik56', 'Priimek56', 'Profesor', 'geslo56', 'uporabnik56@example.com'),
(66, 'Uporabnik57', 'Priimek57', 'Administrator', 'geslo57', 'uporabnik57@example.com'),
(67, 'Uporabnik58', 'Priimek58', 'Profesor', 'geslo58', 'uporabnik58@example.com'),
(68, 'Uporabnik59', 'Priimek59', 'Dijak', 'geslo59', 'uporabnik59@example.com'),
(69, 'Uporabnik60', 'Priimek60', 'Administrator', 'geslo60', 'uporabnik60@example.com'),
(70, 'Uporabnik61', 'Priimek61', 'Dijak', 'geslo61', 'uporabnik61@example.com'),
(71, 'Uporabnik62', 'Priimek62', 'Profesor', 'geslo62', 'uporabnik62@example.com'),
(72, 'Uporabnik63', 'Priimek63', 'Administrator', 'geslo63', 'uporabnik63@example.com'),
(73, 'Uporabnik64', 'Priimek64', 'Profesor', 'geslo64', 'uporabnik64@example.com'),
(74, 'Uporabnik65', 'Priimek65', 'Dijak', 'geslo65', 'uporabnik65@example.com'),
(75, 'Uporabnik66', 'Priimek66', 'Administrator', 'geslo66', 'uporabnik66@example.com'),
(76, 'Uporabnik67', 'Priimek67', 'Dijak', 'geslo67', 'uporabnik67@example.com'),
(77, 'Uporabnik68', 'Priimek68', 'Profesor', 'geslo68', 'uporabnik68@example.com'),
(78, 'Uporabnik69', 'Priimek69', 'Administrator', 'geslo69', 'uporabnik69@example.com'),
(79, 'Uporabnik70', 'Priimek70', 'Profesor', 'geslo70', 'uporabnik70@example.com'),
(80, 'Uporabnik71', 'Priimek71', 'Dijak', 'geslo71', 'uporabnik71@example.com'),
(81, 'Uporabnik72', 'Priimek72', 'Administrator', 'geslo72', 'uporabnik72@example.com'),
(83, 'Uporabnik74', 'Priimek74', 'Profesor', 'geslo74', 'uporabnik74@example.com'),
(84, 'Uporabnik75', 'Priimek75', 'Administrator', 'geslo75', 'uporabnik75@example.com'),
(85, 'Uporabnik76', 'Priimek76', 'Profesor', 'geslo76', 'uporabnik76@example.com'),
(86, 'Uporabnik77', 'Priimek77', 'Dijak', 'geslo77', 'uporabnik77@example.com'),
(87, 'Uporabnik78', 'Priimek78', 'Administrator', 'geslo78', 'uporabnik78@example.com'),
(88, 'Uporabnik79', 'Priimek79', 'Dijak', 'geslo79', 'uporabnik79@example.com'),
(89, 'Uporabnik80', 'Priimek80', 'Profesor', 'geslo80', 'uporabnik80@example.com'),
(90, 'Uporabnik81', 'Priimek81', 'Administrator', 'geslo81', 'uporabnik81@example.com'),
(91, 'Uporabnik82', 'Priimek82', 'Profesor', 'geslo82', 'uporabnik82@example.com'),
(92, 'Uporabnik83', 'Priimek83', 'Dijak', 'geslo83', 'uporabnik83@example.com'),
(93, 'Uporabnik84', 'Priimek84', 'Administrator', 'geslo84', 'uporabnik84@example.com'),
(94, 'Uporabnik85', 'Priimek85', 'Dijak', 'geslo85', 'uporabnik85@example.com'),
(95, 'Uporabnik86', 'Priimek86', 'Profesor', 'geslo86', 'uporabnik86@example.com'),
(96, 'Uporabnik87', 'Priimek87', 'Administrator', 'geslo87', 'uporabnik87@example.com'),
(97, 'Uporabnik88', 'Priimek88', 'Profesor', 'geslo88', 'uporabnik88@example.com'),
(98, 'Uporabnik89', 'Priimek89', 'Dijak', 'geslo89', 'uporabnik89@example.com'),
(99, 'Uporabnik90', 'Priimek90', 'Administrator', 'geslo90', 'uporabnik90@example.com'),
(100, 'Uporabnik91', 'Priimek91', 'Dijak', 'geslo91', 'uporabnik91@example.com'),
(101, 'Uporabnik92', 'Priimek92', 'Profesor', 'geslo92', 'uporabnik92@example.com'),
(102, 'Uporabnik93', 'Priimek93', 'Administrator', 'geslo93', 'uporabnik93@example.com'),
(103, 'Uporabnik94', 'Priimek94', 'Profesor', 'geslo94', 'uporabnik94@example.com'),
(104, 'Uporabnik95', 'Priimek95', 'Dijak', 'geslo95', 'uporabnik95@example.com'),
(105, 'Uporabnik96', 'Priimek96', 'Administrator', 'geslo96', 'uporabnik96@example.com'),
(106, 'Uporabnik97', 'Priimek97', 'Dijak', 'geslo97', 'uporabnik97@example.com'),
(107, 'Uporabnik98', 'Priimek98', 'Profesor', 'geslo98', 'uporabnik98@example.com'),
(108, 'Uporabnik99', 'Priimek99', 'Administrator', 'geslo99', 'uporabnik99@example.com'),
(109, 'Uporabnik100', 'Priimek100', 'Profesor', 'geslo100', 'uporabnik100@example.com'),
(110, 'test123', 'test123', 'Dijak', '$2y$10$GCrxcb/fWcevThvo/lEF8ObtSpHnrtM0Gl5MF6QVSs4IjPIdVo4BS', 'a@a.com'),
(111, 'dijak', 'dijak', 'Dijak', '$2y$10$nUMq1FcAFlcLlecG1XoOBOgszv/H6sp4HqwH/bqaqHzYC.meYLI7q', 'dijak'),
(112, 'profesor', 'profesor', 'Profesor', '$2y$10$pjNCI5A1vSgU2AUXgL6X9eHYN6mF3osiLJ4Z2DJRlcKpishjtq5EC', 'profesor'),
(113, '123', '123', 'Profesor', '$2y$10$Tg9yqQX1mfZCtaIdw5rLjeLIRubZJg9pVNWv0bog3z9JiYV78tYLy', '123');

-- --------------------------------------------------------

--
-- Table structure for table `uporabniki_razredi`
--

CREATE TABLE `uporabniki_razredi` (
  `Uporabnik_ID` int NOT NULL,
  `Razred_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uporabniki_razredi`
--

INSERT INTO `uporabniki_razredi` (`Uporabnik_ID`, `Razred_ID`) VALUES
(1, 1),
(111, 1),
(1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gradiva`
--
ALTER TABLE `gradiva`
  ADD PRIMARY KEY (`Gradivo_ID`),
  ADD KEY `Razred_ID` (`Razred_ID`),
  ADD KEY `naloga_ibfk_1` (`Naloga_ID`);

--
-- Indexes for table `naloge`
--
ALTER TABLE `naloge`
  ADD PRIMARY KEY (`Naloga_ID`),
  ADD KEY `Razred_ID` (`Razred_ID`);

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
  MODIFY `Gradivo_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `naloge`
--
ALTER TABLE `naloge`
  MODIFY `Naloga_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `razredi`
--
ALTER TABLE `razredi`
  MODIFY `Razred_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `student_naloge`
--
ALTER TABLE `student_naloge`
  MODIFY `Student_Naloga_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `uporabniki`
--
ALTER TABLE `uporabniki`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gradiva`
--
ALTER TABLE `gradiva`
  ADD CONSTRAINT `gradiva_ibfk_1` FOREIGN KEY (`Razred_ID`) REFERENCES `razredi` (`Razred_ID`),
  ADD CONSTRAINT `naloga_ibfk_1` FOREIGN KEY (`Naloga_ID`) REFERENCES `naloge` (`Naloga_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `naloge`
--
ALTER TABLE `naloge`
  ADD CONSTRAINT `naloge_ibfk_1` FOREIGN KEY (`Razred_ID`) REFERENCES `razredi` (`Razred_ID`);

--
-- Constraints for table `student_naloge`
--
ALTER TABLE `student_naloge`
  ADD CONSTRAINT `student_naloge_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `uporabniki` (`ID`),
  ADD CONSTRAINT `student_naloge_ibfk_2` FOREIGN KEY (`Naloga_ID`) REFERENCES `naloge` (`Naloga_ID`);

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
