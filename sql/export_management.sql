-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2018 at 08:22 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `export_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_payment`
--

CREATE TABLE `booking_payment` (
  `payment_id` int(10) NOT NULL,
  `booking_id` int(10) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `cheque_dd_number` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_reference_no` varchar(255) NOT NULL,
  `remark` text,
  `details` text,
  `transaction_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `vendor_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `booking_request`
--

CREATE TABLE `booking_request` (
  `booking_id` int(10) NOT NULL,
  `vendor_id` int(10) NOT NULL,
  `destination_country` varchar(255) DEFAULT NULL,
  `from_country` varchar(255) DEFAULT NULL,
  `booking_date` datetime NOT NULL,
  `shipping_date` datetime DEFAULT NULL,
  `container_count` int(10) DEFAULT NULL,
  `net_amount` float(10,2) DEFAULT NULL,
  `balance_amount` float(10,2) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `delivery_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `container`
--

CREATE TABLE `container` (
  `container_id` int(10) NOT NULL,
  `vendor_id` int(10) NOT NULL,
  `container_no` varchar(255) NOT NULL,
  `sea_name` varchar(255) DEFAULT NULL,
  `container_company` varchar(255) NOT NULL,
  `booking_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `container_items`
--

CREATE TABLE `container_items` (
  `ci_id` int(10) NOT NULL,
  `container_id` int(10) NOT NULL,
  `item_id` int(10) NOT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `booking_id` int(10) NOT NULL,
  `vendor_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `thickness` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `name`, `type`, `size`, `thickness`, `color`, `unit`, `photo`, `entry_date`) VALUES
(11, 'marbel', 'stone', '200 foot', '20o mm', 'white', 'test', 'natural-stone-marble-stone-stone-slab-chines-p174005-1b.jpg', '2017-12-13 05:06:01'),
(12, 'marbel ', 'stone', '300 foot', '200 mm', 'grey', 'test', 'new-arrival-imperial-white-marbles-slabs-tiles-turkey-white-marble-p365459-1s.jpg', '2017-12-13 05:06:52'),
(16, 'marbel', 'stone', '500ft', '500', 'black', '10', 'black.jpg', '2018-02-19 06:34:23'),
(17, 'marbel', 'stone', '300', '500', 'yello', '200', 'black.jpg', '2018-02-19 06:34:51'),
(18, 'Marbel ', 'stone', '100', '20', 'red', '20', 'black.jpg', '2018-02-20 10:09:44');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(10) NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT NULL,
  `full_name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `vendor_id` int(10) DEFAULT NULL,
  `address` text,
  `phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `gst_no` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `email`, `password`, `creation_date`, `update_date`, `full_name`, `vendor_id`, `address`, `phone`, `mobile`, `email_id`, `company_name`, `gst_no`, `role`) VALUES
(1, 'admin', 'admin', '2017-11-13 06:46:48', '2018-02-24 02:25:49', 'bhanu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin'),
(6, 'new', 'new', '2018-02-15 18:30:00', '2018-02-20 02:21:33', 'hello', NULL, 'test', NULL, NULL, NULL, NULL, NULL, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendor_id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text,
  `phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `gst_no` varchar(255) DEFAULT NULL,
  `entry_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `name`, `address`, `phone`, `mobile`, `email`, `company_name`, `gst_no`, `entry_date`, `update_date`, `role`, `password`) VALUES
(1, 'Bhanu Pratap Singh Rathore', 'D-36 shushant city kalwar road', '07014244430', '07014244430', 'abc', 'Hola', '123456789gtsrs5838', '2018-01-05 00:33:35', '2018-02-24 02:22:22', 'user', '1'),
(2, 'ram singh', 'D-36 shushant city kalwar road', '07014244430', '07014244430', 'bbc', 'Hero', '123456789gtsrs5838', '2018-01-05 00:33:50', '2018-02-20 07:33:21', 'user', '2'),
(3, ' Pratap Singh Rathore', 'nagovggvvv', '07014244430', '07014244430', 'asrathore63@gmail.com2', 'Hero', '123456789gtsrs5838', '2018-01-05 00:34:04', NULL, NULL, NULL),
(4, 'bhanu paratp', 'test', '841635625', '70144300', 'asrathore63@gamil.com3', 'hero', 'kjvnsd66332', '2018-02-19 06:06:15', NULL, NULL, NULL),
(5, 'test', 'test', '3333333', '33333333', 'test', 'test', 'tttff3333', '2018-02-20 02:41:37', NULL, NULL, '3433'),
(6, 'test', 'sdgvsdg', 'test', 'test', 'est', 'tst', 'segvsgedge', '2018-02-20 06:27:01', NULL, NULL, '35435');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking_payment`
--
ALTER TABLE `booking_payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `booking_request`
--
ALTER TABLE `booking_request`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `container`
--
ALTER TABLE `container`
  ADD PRIMARY KEY (`container_id`);

--
-- Indexes for table `container_items`
--
ALTER TABLE `container_items`
  ADD PRIMARY KEY (`ci_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking_payment`
--
ALTER TABLE `booking_payment`
  MODIFY `payment_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking_request`
--
ALTER TABLE `booking_request`
  MODIFY `booking_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `container`
--
ALTER TABLE `container`
  MODIFY `container_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `container_items`
--
ALTER TABLE `container_items`
  MODIFY `ci_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendor_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
