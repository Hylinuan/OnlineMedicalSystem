-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 04, 2023 at 11:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oms`
--

-- --------------------------------------------------------

--
-- Table structure for table `Appointment`
--

CREATE TABLE `Appointment` (
  `AID` int(11) NOT NULL,
  `DID` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `prescription` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Daccount`
--

CREATE TABLE `Daccount` (
  `DID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Daccount`
--

INSERT INTO `Daccount` (`DID`, `username`, `password`, `firstName`, `middleName`, `lastName`, `phone`, `email`) VALUES
(1, 'emilyjohnson', 'emily112233', 'Emily', '', 'Johnson', '+12029182132', 'emilyjohnson@mail.oms.com'),
(2, 'juanrodriguez', 'juan112233', 'Juan', '', 'Rodriguez', '+14125295051', 'juanrodriguez@mail.oms.com'),
(3, 'sarahlee', 'sarah112233', 'Sarah', '', 'Lee', '+12122430468', 'sarahlee@mail.oms.com'),
(4, 'rachellee', 'rachel112233', 'Rachel', '', 'Lee', '+12316145899', 'rachellee@mail.oms.com'),
(5, 'jasonpatel', 'jason112233', 'Jason', '', 'Patel', '+15166716298', 'jasonpatel@mail.oms.com');

-- --------------------------------------------------------

--
-- Table structure for table `Paccount`
--

CREATE TABLE `Paccount` (
  `PID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `birthD` date NOT NULL,
  `phone` varchar(13) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Paccount`
--

INSERT INTO `Paccount` (`PID`, `username`, `password`, `firstName`, `middleName`, `lastName`, `birthD`, `phone`, `email`) VALUES
(1, 'sarahjohnson', 'sarah0000', 'Sarah', '', 'Johnson', '1982-12-14', '+15056466876', 'sarahjohnson@gmail.com'),
(2, 'johnsmith', 'john0000', 'John', '', 'Smith', '1978-05-04', '+12102949714', 'johnsmith@gmail.com'),
(3, 'mariarodriguez', 'maria0000', 'Maria', '', 'Rodriguez', '1969-03-24', '+12032318552', 'mariarodriguez@gmail.com'),
(4, 'michaelnguyen ', 'michael0000', 'Michael', '', 'Nguyen', '1980-06-07', '+15206916162', 'michaelnguyen@gmail.com'),
(5, 'ashleychang ', 'ashley0000', 'Ashley', '', 'Chang', '1962-09-18', '+14148360280', 'ashleychang@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `ScheduleTime`
--

CREATE TABLE `ScheduleTime` (
  `DID` int(11) NOT NULL,
  `date` date NOT NULL,
  `startT` time NOT NULL,
  `endT` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Appointment`
--
ALTER TABLE `Appointment`
  ADD PRIMARY KEY (`AID`),
  ADD KEY `PID` (`PID`),
  ADD KEY `DID` (`DID`);

--
-- Indexes for table `Daccount`
--
ALTER TABLE `Daccount`
  ADD PRIMARY KEY (`DID`);

--
-- Indexes for table `Paccount`
--
ALTER TABLE `Paccount`
  ADD PRIMARY KEY (`PID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Appointment`
--
ALTER TABLE `Appointment`
  MODIFY `AID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Daccount`
--
ALTER TABLE `Daccount`
  MODIFY `DID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Paccount`
--
ALTER TABLE `Paccount`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
