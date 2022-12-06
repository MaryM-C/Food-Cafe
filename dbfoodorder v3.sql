-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2022 at 05:46 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

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
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(19, 'Johnny Doe', 'jdoe', 'a31405d272b94e5d12e9a52a665d3bfe'),
(20, 'Jane Doe', 'jaDoe', '16efe60b28dd199adbde24bfa21ea2c5');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` int(10) UNSIGNED NOT NULL,
  `pid` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(10) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(100) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(55, 'Desserts', 'Food_Category_730.jpg', 'Yes', 'Yes'),
(57, 'Burger', 'Food_Category_368.jpg', 'Yes', 'Yes'),
(59, 'Drinks', 'Food_Category_772.jpg', 'Yes', 'Yes'),
(61, 'Pizza', 'Food_Category_818.jpg', 'Yes', 'Yes'),
(62, 'Meals', 'Food_Category_994.jpg', 'Yes', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(34, 'Pizza Pot Pie', 'Its pizza but served in a more portable manner', '90.00', 'Food_Name_144.jpg', 56, 'Yes', 'Yes'),
(35, 'Curry', 'your favorite recipe', '23.00', 'Food_Name_4648.jpg', 53, 'Yes', 'Yes'),
(36, 'Ice Tea', 'Tea but cold', '25.00', 'Food_Name_9865.jpg', 54, 'Yes', 'Yes'),
(37, 'Orange Juice', 'Juice but its orange', '25.00', 'Food_Name_988.jpg', 54, 'Yes', 'Yes'),
(38, 'Carbonara', 'White spaghetti', '50.00', 'Food_Name_9324.jpg', 55, 'Yes', 'Yes');

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
  `customer_name` varchar(150) NOT NULL,
  `customer_number` int(20) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `u_id`, `food`, `price`, `qty`, `total`, `order_date`, `order_time`, `status`, `customer_name`, `customer_number`, `customer_address`) VALUES
(6, 0, 'Carbonara', '50.00', 1, '50.00', '2022-11-22', '00:00:00', 'Delivered', 'John Doe', 2147483647, 'CCE Office, Main Building'),
(7, 0, 'Ice Tea', '25.00', 2, '75.00', '2022-12-23', '00:00:00', 'Delivered', 'John Doe', 919, 'CCE Office, Main Building'),
(8, 1, 'Lechon', '50.00', 3, '150.00', '2022-10-03', '10:47:05', 'Delivered', 'J Doe', 1, 'CCE Office'),
(9, 1, 'Carbonara', '50.00', 1, '50.00', '2022-09-09', '08:39:29', 'Cancelled', 'John Doe', 1, 'CCE Building'),
(10, 2, 'Carbonara', '50.00', 2, '100.00', '2023-12-01', '17:50:47', 'Delivered', 'Doe', 1, '3'),
(11, 0, 'Lemon Tea', '75.00', 1, '75.00', '2022-12-01', '16:47:06', 'Delivered', 'Lemon though', 2, 'Building'),
(12, 0, 'Fried Chicken', '75.00', 1, '75.00', '2022-12-01', '16:47:06', 'Delivered', 'Lemon though', 33, 'Building');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `customer_number` int(20) NOT NULL,
  `room` varchar(150) NOT NULL,
  `floor` varchar(20) NOT NULL,
  `building` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `password`, `customer_number`, `room`, `floor`, `building`) VALUES
(123456, 'Ken', '', 0, 'CCE\'s Office', 'Ground', 'Main Building'),
(1903317, 'Mary', '', 0, 'CCE\'s Office', 'Ground', 'Main Building');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `customer_name` (`customer_name`),
  ADD KEY `customer_number` (`customer_number`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `customer_number` (`customer_number`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `tbl_cart_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_cart_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `tbl_food` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
