-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2021 at 05:48 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2x01`
--

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE `api` (
  `id` int(3) NOT NULL,
  `command` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`id`, `command`) VALUES
(1, 'FORWARD'),
(2, 'FORWARD RIGHT LEFT RIGHT'),
(3, 'FORWARD FORWARD FORWARD'),
(4, 'right'),
(5, 'movement:right');

-- --------------------------------------------------------

--
-- Table structure for table `car_status`
--

CREATE TABLE `car_status` (
  `id` int(1) NOT NULL,
  `connectivity` int(1) NOT NULL,
  `objectDistance` int(5) NOT NULL,
  `speed` int(5) NOT NULL,
  `datetime` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_status`
--

INSERT INTO `car_status` (`id`, `connectivity`, `objectDistance`, `speed`, `datetime`) VALUES
(1, 1, 1, 1, '2021-12-01 18:19:18');

-- --------------------------------------------------------

--
-- Table structure for table `challenges`
--

CREATE TABLE `challenges` (
  `id` int(3) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` longtext NOT NULL,
  `commands` varchar(200) NOT NULL,
  `difficulty` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `challenges`
--

INSERT INTO `challenges` (`id`, `name`, `image`, `commands`, `difficulty`) VALUES
(7, 'First Challenge', 'uploads/test.png', 'Forward Right Left Right Forward Forward Forward Forward Forward Forward Forward Forward Right Right Right Right Left Left Left Left Right Right Forward Right Left Left Right ', 'Hard');

-- --------------------------------------------------------

--
-- Table structure for table `challenge_status`
--

CREATE TABLE `challenge_status` (
  `id` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  `remarks` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `challenge_status`
--

INSERT INTO `challenge_status` (`id`, `status`, `remarks`) VALUES
(1, 0, '0 = No Commands Received\r\n1 = Challenge Failed\r\n2 = Challenge Succeeded');

-- --------------------------------------------------------

--
-- Table structure for table `current_commands`
--

CREATE TABLE `current_commands` (
  `id` int(1) NOT NULL,
  `commands` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `current_commands`
--

INSERT INTO `current_commands` (`id`, `commands`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- Table structure for table `pin`
--

CREATE TABLE `pin` (
  `id` int(100) NOT NULL,
  `datetime` varchar(100) NOT NULL,
  `pin` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pin`
--

INSERT INTO `pin` (`id`, `datetime`, `pin`) VALUES
(1, '2021-11-25 12:54:14', 111111);

-- --------------------------------------------------------

--
-- Table structure for table `scoreboard`
--

CREATE TABLE `scoreboard` (
  `id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `score` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scoreboard`
--

INSERT INTO `scoreboard` (`id`, `name`, `score`) VALUES
(1, 'XzeL', 1800),
(2, 'Test', 0),
(3, 'Jub', 300);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `challenges`
--
ALTER TABLE `challenges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pin`
--
ALTER TABLE `pin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scoreboard`
--
ALTER TABLE `scoreboard`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `challenges`
--
ALTER TABLE `challenges`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `scoreboard`
--
ALTER TABLE `scoreboard`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
