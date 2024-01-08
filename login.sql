-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 08, 2024 at 08:50 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `payment_requests`
--

CREATE TABLE `payment_requests` (
  `request_id` int(11) NOT NULL,
  `requester_id` varchar(55) DEFAULT NULL,
  `payee_id` varchar(55) DEFAULT NULL,
  `amount` decimal(10,2) NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','approved','rejected') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_requests`
--

INSERT INTO `payment_requests` (`request_id`, `requester_id`, `payee_id`, `amount`, `request_date`, `status`) VALUES
(1, 'ali', 'test', 500.00, '2024-01-06 10:09:25', 'pending'),
(2, 'ali', 'test', 500.00, '2024-01-06 10:11:51', 'pending'),
(3, 'ali', 'test', 500.00, '2024-01-06 10:12:23', 'pending'),
(4, 'ali', 'test', 500.00, '2024-01-06 10:12:57', 'pending'),
(5, 'ali', 'test', 500.00, '2024-01-06 10:14:05', 'pending'),
(6, 'ali', 'test', 500.00, '2024-01-06 10:14:29', 'pending'),
(7, 'ali', 'test', 500.00, '2024-01-06 10:14:52', 'pending'),
(8, 'ali', 'test', 500.00, '2024-01-06 10:22:27', 'pending'),
(9, 'Elie', 'ali', 100.00, '2024-01-06 10:40:53', 'approved'),
(10, 'Elie', 'Elie', 100.00, '2024-01-06 10:55:01', 'pending'),
(11, 'root', 'ali', 20.00, '2024-01-06 14:46:20', 'approved'),
(12, 'Elie', 'ali', 500.00, '2024-01-06 17:20:55', 'approved'),
(13, 'Jam', 'ali', 15.00, '2024-01-07 08:03:23', 'approved'),
(14, 'Jam', 'ali', 15.00, '2024-01-07 08:03:23', 'approved'),
(15, 'test', 'ali', 100.00, '2024-01-07 08:38:35', 'rejected'),
(16, 'test', 'ali', 100.00, '2024-01-07 08:49:16', 'approved'),
(17, 'ali', 'ali', 100.00, '2024-01-07 09:41:23', 'rejected');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `sending_user` varchar(50) NOT NULL,
  `recieving_user` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`transaction_id`, `sending_user`, `recieving_user`, `amount`, `date`) VALUES
(1, 'ali', 'Elie', 500, '2024-01-30 22:00:00'),
(2, 'ali', 'Elie', 500, '2024-01-04 22:00:00'),
(3, 'ali', 'Elie', 500, '2024-01-04 22:00:00'),
(4, 'ali', 'root', 250, '2024-01-04 22:00:00'),
(5, 'ali', 'root', 250, '2024-01-04 22:00:00'),
(6, 'ali', 'root', 250, '2024-01-04 22:00:00'),
(7, 'ali', 'test', 100, '2024-01-04 22:00:00'),
(8, 'ali', 'test', 100, '2024-01-04 22:00:00'),
(9, 'ali', 'hamoudi', 100, '2024-01-04 22:00:00'),
(10, 'ali', 'hamoudi', 100, '2024-01-04 22:00:00'),
(11, 'ali', 'test', 1, '2024-01-04 22:00:00'),
(12, 'ali', 'root', 500, '2024-01-05 22:00:00'),
(13, 'ali', 'Elie', 100, '2024-01-06 09:23:57'),
(14, 'ali', 'Elie', 500, '2024-01-07 07:12:09'),
(15, 'ali', 'Jam', 15, '2024-01-07 07:13:07'),
(16, 'ali', 'Elie', 500, '2024-01-07 07:13:58'),
(17, 'ali', 'Jam', 15, '2024-01-07 07:14:00'),
(18, 'ali', 'Jam', 15, '2024-01-07 07:14:01'),
(19, 'ali', 'Jam', 15, '2024-01-07 07:14:03'),
(20, 'ali', 'Elie', 500, '2024-01-07 07:19:39'),
(21, 'ali', 'Elie', 500, '2024-01-07 07:20:15'),
(22, 'ali', 'Jam', 15, '2024-01-07 07:20:17'),
(23, 'ali', 'Jam', 15, '2024-01-07 07:20:19'),
(24, 'ali', 'test', 100, '2024-01-07 08:41:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(55) NOT NULL,
  `password` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` char(1) NOT NULL,
  `balance` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `dob`, `gender`, `balance`) VALUES
('ali', 'pass', '2004-03-05', 'M', 29900),
('Elie', 'root', '2023-11-02', 'M', 15075),
('ergsdfg', 'sdfg', '2023-11-10', 'M', 0),
('hamoudi', 'hmar', '2023-11-15', 'M', 200),
('Jam', 'pass', '2024-01-05', 'F', 90),
('qewrtwr', 'qwrt', '2023-11-02', 'F', 50),
('Rama', 'pass', '2024-01-04', 'F', 500),
('root', 'sdgf', '2023-11-04', 'M', 1250),
('setertert', 'ewrterwt', '2023-11-25', 'M', 0),
('test', 'etgrwfed', '2023-11-25', 'M', 301),
('try', 'test', '2023-11-04', 'F', 0),
('user', 'test', '2023-06-07', 'M', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `payment_requests`
--
ALTER TABLE `payment_requests`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `requester_id` (`requester_id`),
  ADD KEY `payee_id` (`payee_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `payment_requests`
--
ALTER TABLE `payment_requests`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payment_requests`
--
ALTER TABLE `payment_requests`
  ADD CONSTRAINT `payment_requests_ibfk_1` FOREIGN KEY (`requester_id`) REFERENCES `users` (`username`),
  ADD CONSTRAINT `payment_requests_ibfk_2` FOREIGN KEY (`payee_id`) REFERENCES `users` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
