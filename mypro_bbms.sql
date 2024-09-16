-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2024 at 06:40 PM
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
-- Database: `mypro_bbms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uname` varchar(20) DEFAULT NULL,
  `pass` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uname`, `pass`) VALUES
(1, 'admin', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

CREATE TABLE `blood_requests` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `message` varchar(100) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_requests`
--

INSERT INTO `blood_requests` (`id`, `email`, `message`, `name`, `contact`) VALUES
(12, 'vehanrajintha17@gmail.com', 'hii i need blood Its urgent contact me immediatly', 'Lana rhoads', '0724567865'),
(13, 'reilyreid@gmail.com', 'Hii its me kristin i need blood   its emergency', 'Kristin scott', '0721234567'),
(14, 'IT23646360@my.sliit.lk', 'i need blood ', 'sanuka beruwala', '07035675467');

-- --------------------------------------------------------

--
-- Table structure for table `donor_registration`
--

CREATE TABLE `donor_registration` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `age` int(25) DEFAULT NULL,
  `bgroup` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `mno` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donor_registration`
--

INSERT INTO `donor_registration` (`id`, `name`, `fname`, `address`, `city`, `age`, `bgroup`, `email`, `mno`) VALUES
(58, 'Rayan Dinel', 'Roshan Shirantha', '8/200 siddhamulla piliyandala', 'Piliyandala', 13, 'AB+', 'rayan@gmail.com', '0702683824'),
(60, 'Thekshana', 'Sumanasiri', '8/200 siddhamulla piliyandala', 'nigambo', 20, 'B+', 'thekshana@gmail.com', '0723456782'),
(62, 'Chalitha Disanayake', 'S K Disanayake', 'Colombo', 'Colombo', 22, 'B-', 'chalithadisanayake@gmail.com', '0745783452'),
(63, 'Kaveen bro', 'C K Beruwala', 'Colombo,Kadawatha', 'Colombo', 20, 'AB+', 'kaveenbro@gmail.com', '0728763457'),
(64, 'Oshadi', 'H K Weerasiri', '8/200 piliyandala', 'Piliyandala', 23, 'AB+', 'oshadi@gmail.com', '0713910417'),
(65, 'Samajith sanuka', 'C K Weerathunge', 'Colombo', 'Colombo', 25, 'B-', 'samjithsanuka@gmail.com', '07598234535'),
(66, 'Reily reid', 'Jonny sinse', 'Viyana USA', 'viana', 21, 'A+', 'reilyreid@gmail.com', '0705674356'),
(67, 'Mia malcova', 'John dev', 'USA newyork', 'Newyork', 21, 'A+', 'miamalcowa@gmail.com', '0713459875'),
(68, 'Mia malcova', 'John dev', 'USA newyork', 'Newyork', 21, NULL, 'miama@gmail.com', '0713459877'),
(70, 'V Rajintha', 'Vehan ', '8/200 siddhamulla piliyandala', 'Piliyandala', 21, 'A+', 'IT23646360@my.sliit.lk', '0713910417');

-- --------------------------------------------------------

--
-- Table structure for table `exchange_b`
--

CREATE TABLE `exchange_b` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `age` int(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mno` varchar(50) DEFAULT NULL,
  `bgroup` varchar(50) DEFAULT NULL,
  `ebgroup` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exchange_b`
--

INSERT INTO `exchange_b` (`id`, `name`, `fname`, `address`, `city`, `age`, `email`, `mno`, `bgroup`, `ebgroup`) VALUES
(9, 'Lira law', 'jonny sinse', 'USA verginiya', 'USA', 20, 'lyralaw@gmail.com', '0718994254', 'A+', 'O-'),
(10, 'Pahan rashmika', 'duresh', 'super city road', 'nigambo', 18, 'pahan@gmail.com', '0718994254', 'A+', 'O-'),
(11, 'Pahan rashmika', 'duresh', 'super city road', 'nigambo', 18, 'pahan@gmail.com', '0718994254', 'A+', 'B-');

-- --------------------------------------------------------

--
-- Table structure for table `out_stoke_b`
--

CREATE TABLE `out_stoke_b` (
  `id` int(11) NOT NULL,
  `bname` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `mno` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `out_stoke_b`
--

INSERT INTO `out_stoke_b` (`id`, `bname`, `name`, `mno`) VALUES
(7, 'A+', 'Vehan Rajintha', 713910417),
(8, 'A+', 'sanuka beruwala', 712564789),
(9, 'A+', 'Dulara fernando', 702345679);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pass` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `pass`) VALUES
(5, 'vehanrajintha17@gmail.com', 'Vehan@123'),
(6, 'rayan@gmail.com', 'Rayan@123'),
(7, 'sanukaberuwala@gmail.com', 'Sanuka@123'),
(8, 'thekshana@gmail.com', 'Thekshana@123'),
(9, 'dularafernando@gmail.com', 'Dulara@123'),
(10, 'chalithadisanayake@gmail.com', 'chalitha@123'),
(11, 'kaveenbro@gmail.com', 'Kaveen@123'),
(12, 'oshadi@gmail.com', 'Oshadi@123'),
(13, 'samjithsanuka@gmail.com', 'Samajith@123'),
(14, 'reilyreid@gmail.com', 'Reily@123'),
(15, 'miamalcowa@gmail.com', 'miya@123'),
(16, 'miama@gmail.com', 'miyamal@123'),
(17, 'IT23646360@my.sliit.lk', 'Vehan@123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `donor_registration`
--
ALTER TABLE `donor_registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exchange_b`
--
ALTER TABLE `exchange_b`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `out_stoke_b`
--
ALTER TABLE `out_stoke_b`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blood_requests`
--
ALTER TABLE `blood_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `donor_registration`
--
ALTER TABLE `donor_registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `exchange_b`
--
ALTER TABLE `exchange_b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `out_stoke_b`
--
ALTER TABLE `out_stoke_b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
