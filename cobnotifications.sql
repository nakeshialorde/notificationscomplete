-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2018 at 03:07 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cobnotifications`
--

-- --------------------------------------------------------

--
-- Table structure for table `cobnotifications`
--

CREATE TABLE `cobnotifications` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `type` text NOT NULL,
  `message` text NOT NULL,
  `status` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cobnotifications`
--
INSERT INTO `cobnotifications` (`notification_id`, `user_id`, `email`, `subject`, `message`, `status`, `date`) VALUES
(10, '', 'user1', 'tutors246@gmail.com', 'Monthly Update', 'E-PAY and COB will be launching a new app on June 11th', 'unread', '2018-02-09 00:21:21'),
(11, 'user2', 'roderick.sargeant@gmail.com', 'New Service Charge', 'There are no service charges associated with the app.', 'read', '2018-02-09 00:21:34'),
(12, 'user3', 'fabianjholder@gmail.com', 'E-PAY Launch', 'The app is the first of its kind in Barbados', 'unread', '2018-02-09 00:22:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cobnotifications`
--
ALTER TABLE `cobnotifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `cobnotifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
