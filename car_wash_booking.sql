-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2021 at 07:08 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `car_wash`
--

CREATE TABLE `car_wash` (
  `wash_id` int(11) NOT NULL,
  `id` varchar(11) NOT NULL,
  `wash_type_id` varchar(255) NOT NULL,
  `slot_time` varchar(255) NOT NULL,
  `registration_number` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `manage_pricing`
--

CREATE TABLE `manage_pricing` (
  `id` int(11) NOT NULL,
  `car_type` varchar(255) NOT NULL,
  `wash_type` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `manage_pricing`
--

INSERT INTO `manage_pricing` (`id`, `car_type`, `wash_type`, `amount`) VALUES
(4, 'SUV', 'body_wash', '600'),
(5, 'SUV', 'full_wash', '700'),
(7, 'sedan', 'body_wash', '600'),
(8, 'sedan', 'full_wash', '800'),
(9, 'sedan', 'interior_wash', '1100'),
(10, 'hatchback', 'body_wash', '700'),
(11, 'hatchback', 'full_wash', '900'),
(12, 'hatchback', 'interior_wash', '1150');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `userid` int(8) NOT NULL,
  `username` varchar(55) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `signupDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `usertype` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`userid`, `username`, `email`, `password`, `phone_number`, `signupDate`, `usertype`) VALUES
(111, 'admin', 'admin@gmail.com', '73803249c6667c5af2d51c0dedfae487', '8888888888', '2021-02-04 06:46:28', 'Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `car_wash`
--
ALTER TABLE `car_wash`
  ADD PRIMARY KEY (`wash_id`);

--
-- Indexes for table `manage_pricing`
--
ALTER TABLE `manage_pricing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `car_wash`
--
ALTER TABLE `car_wash`
  MODIFY `wash_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=198;

--
-- AUTO_INCREMENT for table `manage_pricing`
--
ALTER TABLE `manage_pricing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `userid` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=369;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
