-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2022 at 09:08 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `u_id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `order_date` date NOT NULL,
  `order_time` time NOT NULL,
  `status` varchar(50) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_number` int(20) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `u_id`, `food`, `price`, `qty`, `total`, `order_date`, `order_time`, `status`, `cust_id`, `customer_name`, `customer_number`, `customer_address`) VALUES
(2, 0, 'Menudo', '45.00', 2, '90.00', '2022-10-29', '00:00:00', 'Delivered', 0, 'Mary Cal', 2147483647, 'Cabuyao City'),
(3, 0, 'Fried chicken', '55.00', 2, '110.00', '2022-10-28', '00:00:00', 'Delivered', 0, 'Ken Lay', 2147483647, 'Sta. Rose City, Laguna'),
(4, 0, 'Fried chicken', '55.00', 2, '110.00', '2022-11-01', '00:00:00', 'Delivered', 0, 'Ken Lay', 2147483647, 'Sta. Rosa City, Laguna'),
(5, 0, 'Pizza Pot Pie', '90.00', 2, '180.00', '2022-11-01', '00:00:00', 'Preparing', 0, 'Mary Cal', 2147483647, 'Luzon'),
(6, 0, 'Carbonara', '50.00', 1, '50.00', '2022-11-27', '00:00:00', 'Ordered', 1, 'dddd', 0, 'sadasdasdsadas'),
(7, 0, 'Fried chicken', '55.00', 1, '55.00', '2022-11-27', '00:00:00', 'Ordered', 2, 'sadasd', 0, 'asdasdasdsad'),
(8, 0, 'Fried chicken', '55.00', 1, '55.00', '2022-11-27', '00:00:00', 'Ordered', 2, 'dasdsad', 0, 'asdsdsadsad'),
(9, 0, 'Pizza Pot Pie', '90.00', 1, '90.00', '2022-11-29', '00:00:00', 'Ordered', 1, 'dfdsfd', 0, 'dfdfdsfdsdfs');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `customer_name` (`customer_name`),
  ADD KEY `customer_number` (`customer_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
