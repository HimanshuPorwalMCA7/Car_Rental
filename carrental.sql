-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2024 at 08:23 PM
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
-- Database: `carrental`
--

-- --------------------------------------------------------

--
-- Table structure for table `agencyregistration`
--

CREATE TABLE `agencyregistration` (
  `id` int(50) NOT NULL,
  `agency_name` varchar(50) NOT NULL,
  `contact_person` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `agencyregistration`
--

INSERT INTO `agencyregistration` (`id`, `agency_name`, `contact_person`, `email`, `phone`, `password`, `role`) VALUES
(2, 'RACER', 'Himanshu Porwal', 'hpplacement2024@gmail.com', '+917417545740', '123', 'admin'),
(3, 'RACER', 'Rishu Racer', 'H@gmail.com', '12345678', '$2y$10$PwIkJvz//ukndem86iklqOPFTGYCTdHe/c2zOTCRh3v', 'admin'),
(4, 'RACER', 'Rishu Racer', 'jj@gmail.com', '12345678', '$2y$10$qXYXvSrZ6CAsHbNWAregUuJkBIbX.mhL3sKeqpvj43T', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cardetails`
--

CREATE TABLE `cardetails` (
  `id` int(11) NOT NULL,
  `vehicle_model` varchar(50) NOT NULL,
  `vehicle_number` varchar(50) NOT NULL,
  `seating_capacity` varchar(50) NOT NULL,
  `rent_per_day` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cardetails`
--

INSERT INTO `cardetails` (`id`, `vehicle_model`, `vehicle_number`, `seating_capacity`, `rent_per_day`) VALUES
(3, 'TATA', '2144', '7', '1000'),
(4, 'Jaugar', '7777', '7', '7000'),
(5, 'Jaugar', '9876', '5', '1255');

-- --------------------------------------------------------

--
-- Table structure for table `customerregistration`
--

CREATE TABLE `customerregistration` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(20) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customerregistration`
--

INSERT INTO `customerregistration` (`id`, `name`, `email`, `password`, `role`) VALUES
(10, 'Himanshu Porwal', 'hpplacement2024@gmail.com', '123', 'user'),
(11, 'Rishu Racer', 'H@gmail.com', '123', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `rentedcar`
--

CREATE TABLE `rentedcar` (
  `id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `car_id` int(50) NOT NULL,
  `days` varchar(20) NOT NULL,
  `start_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentedcar`
--

INSERT INTO `rentedcar` (`id`, `user_id`, `car_id`, `days`, `start_date`) VALUES
(17, 10, 3, '4', '2024-04-27'),
(18, 10, 4, '7', '2024-04-17'),
(19, 10, 5, '10', '2024-05-03'),
(20, 10, 3, '2', '2024-04-27'),
(21, 11, 3, '2', '2024-04-24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `agencyregistration`
--
ALTER TABLE `agencyregistration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `cardetails`
--
ALTER TABLE `cardetails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicle_number` (`vehicle_number`);

--
-- Indexes for table `customerregistration`
--
ALTER TABLE `customerregistration`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `rentedcar`
--
ALTER TABLE `rentedcar`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `agencyregistration`
--
ALTER TABLE `agencyregistration`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cardetails`
--
ALTER TABLE `cardetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `customerregistration`
--
ALTER TABLE `customerregistration`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rentedcar`
--
ALTER TABLE `rentedcar`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
