-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Dec 04, 2023 at 06:27 AM
-- Server version: 8.0.32
-- PHP Version: 8.1.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carpooling`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int NOT NULL,
  `destination` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `destination`, `date`, `description`, `price`) VALUES
(1, 'albi', '2023-01-01 00:00:00', 'test', 1),
(3, 'abli-W ggr', '2015-01-01 00:00:00', 'voyage nana na a', 10);

-- --------------------------------------------------------

--
-- Table structure for table `announcements_cars`
--

CREATE TABLE `announcements_cars` (
  `id` int NOT NULL,
  `announcement_id` int NOT NULL,
  `car_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `announcements_reservations`
--

CREATE TABLE `announcements_reservations` (
  `id` int NOT NULL,
  `announcement_id` int NOT NULL,
  `reservation_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int NOT NULL,
  `brand` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `place` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `brand`, `model`, `color`, `place`) VALUES
(2, 'peugeot', '307', '2016-05-04 00:00:00', 5);

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int NOT NULL,
  `date` datetime NOT NULL,
  `announcement` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `birthday` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `birthday`) VALUES
(1, 'Vincent', 'Godé', 'hello@vincentgo.fr', '1990-11-08 00:00:00'),
(2, 'Albert', 'Dupond', 'sonemail@gmail.com', '1985-11-08 00:00:00'),
(3, 'Thomas', 'Dumoulin', 'sonemail2@gmail.com', '1985-10-08 00:00:00'),
(4, 'Maxime', 'Canac', 'maxime.canac@etu.unilim.fr', '2003-09-04 00:00:00'),
(5, 'test', 'test', 'test@gmail.com', '2015-02-01 00:00:00'),
(6, 'test2', 'test2', 'test2', '2023-01-01 00:00:00'),
(7, 'tete', 'efe', 'fef', '2032-05-08 00:00:00'),
(8, 'test', 'sfsef', 'esfse', '2023-10-01 00:00:00'),
(9, 'sdvdsv', 'dvssd', 'dvsv', '2015-10-02 00:00:00'),
(10, 'bnnn', 'nnfn', 'fnnnfnn', '2015-06-10 00:00:00'),
(11, 'szfqf', 'qsfqf', 'sqfqf', '2023-10-01 00:00:00'),
(12, 'gsseg', 'seggg', 'sgesgsg', '2015-10-02 00:00:00'),
(13, 'vdwvv', 'wvvv', 'wvdwvv', '2020-01-20 00:00:00'),
(14, 'qzfqzf', 'gqzgg', 'gqegqgqg', '2045-01-10 00:00:00'),
(15, 'qzfzfzq', 'qzfq', 'zqfff', '2023-10-01 00:00:00'),
(16, 'qzfzf', 'qzffqz', 'qzfqf', '2023-10-01 00:00:00'),
(17, 'rthrh', 'rthrh', 'rthrh', '1985-10-08 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users_announcements`
--

CREATE TABLE `users_announcements` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `announcement_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Table structure for table `users_cars`
--

CREATE TABLE `users_cars` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `car_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `users_cars`
--

INSERT INTO `users_cars` (`id`, `user_id`, `car_id`) VALUES
(1, 1, 2),
(4, 12, 2),
(5, 13, 2),
(6, 14, 2),
(7, 15, 2),
(8, 16, 2),
(9, 17, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users_reservations`
--

CREATE TABLE `users_reservations` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `reservation_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements_cars`
--
ALTER TABLE `announcements_cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `announcements_reservations`
--
ALTER TABLE `announcements_reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_announcements`
--
ALTER TABLE `users_announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_cars`
--
ALTER TABLE `users_cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users_reservations`
--
ALTER TABLE `users_reservations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `announcements_cars`
--
ALTER TABLE `announcements_cars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcements_reservations`
--
ALTER TABLE `announcements_reservations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users_announcements`
--
ALTER TABLE `users_announcements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users_cars`
--
ALTER TABLE `users_cars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users_reservations`
--
ALTER TABLE `users_reservations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
