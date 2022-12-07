-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2022 at 02:33 AM
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
(64, 'Drinks', 'Food_Category_382.jpg', 'Yes', 'Yes'),
(65, 'Meals', 'Food_Category_963.jpg', 'Yes', 'Yes'),
(66, 'Desserts', 'Food_Category_626.jpg', 'Yes', 'Yes'),
(67, 'Pizza', 'Food_Category_271.jpg', 'Yes', 'Yes'),
(68, 'Pasta', 'Food_Category_653.jpg', 'Yes', 'Yes'),
(69, 'Vegetarian', 'Food_Category_430.jpg', 'Yes', 'Yes'),
(70, 'Burger', 'Food_Category_585.jpg', 'Yes', 'Yes');

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
(42, 'Alfredo', 'Not a fan of spaghetti? You might enjoy this', '75.00', 'Food_Name_2169.jpg', 68, 'Yes', 'Yes'),
(43, 'Jaw Breaker Burger', 'Will satisfy your hunger', '119.00', 'Food_Name_1606.jpg', 70, 'Yes', 'Yes'),
(44, 'Thin Crust Pizza', 'Pizza with a thinner crust', '99.00', 'Food_Name_9416.jpg', 67, 'Yes', 'Yes'),
(45, 'Shawarma', 'Your favorite Pita and Meat combination', '55.00', 'Food_Name_7055.jpg', 65, 'Yes', 'Yes'),
(46, 'Leche Flan', 'Yes, time to eat your fave dessert', '40.00', 'Food_Name_7090.jpg', 66, 'Yes', 'Yes'),
(47, 'Chicken and Rice', 'A simple take on Pinoy chicken and rice', '60.00', 'Food_Name_1714.jpg', 65, 'Yes', 'Yes'),
(49, 'Banana Cake', 'Your favorite fruit in a cake form', '40.00', 'Food_Name_1133.jpg', 64, 'Yes', 'Yes'),
(50, 'Honey Ice Tea', 'Your ice with sweet honey', '25.00', 'Food_Name_8411.jpg', 64, 'Yes', 'Yes'),
(51, 'Iced Coffee', 'Take your daily dose of iced coffee', '40.00', 'Food_Name_9859.jpg', 64, 'Yes', 'Yes'),
(52, 'Chicken Burger', 'Burger with fried chicken as its main meat', '70.00', 'Food_Name_7912.jpg', 70, 'Yes', 'Yes'),
(53, 'Lemon Juice', 'Your juice with lemon', '30.00', 'Food_Name_5215.jpg', 64, 'Yes', 'Yes'),
(54, 'Pizza Pot Pie', 'Eat your pizza without your hand touching it', '70.00', 'Food_Name_9729.jpg', 67, 'Yes', 'Yes'),
(55, 'Orange Juice', 'Juice but with orange pulp', '30.00', 'Food_Name_2932.jpg', 64, 'Yes', 'Yes'),
(56, 'Sushi', 'Taste the Japan world starting with this sushi', '60.00', 'Food_Name_3246.jpg', 66, 'Yes', 'Yes'),
(57, 'Curry and Rice', 'Curry and Rice', '70.00', 'Food_Name_4266.jpg', 65, 'Yes', 'Yes'),
(58, 'Lugaw', 'Hot and steamy lugaw', '50.00', 'Food_Name_3354.jpg', 65, 'Yes', 'Yes');

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
(13, 0, 'Alfredo', '75.00', 2, '150.00', '2022-12-01', '08:13:40', 'Delivered', 'John Doe', 912, 'CCE Building'),
(14, 0, 'Leche Flan', '40.00', 3, '120.00', '2022-11-01', '09:19:01', 'Delivered', 'John Doe', 912, 'CCE Office'),
(15, 1, 'Chicken and Rice', '60.00', 1, '60.00', '2022-10-12', '09:37:07', 'Delivered', 'John Doe', 912, 'Registrar'),
(16, 1, 'Banana Cake', '40.00', 4, '160.00', '2022-11-09', '09:29:07', 'Delivered', 'John Doe', 913, 'MPH'),
(17, 2, 'Iced Coffee', '40.00', 5, '200.00', '2022-10-19', '09:25:55', 'Delivered', 'Jane Doe', 914, 'MPH'),
(18, 3, 'Honey Iced Tea', '25.00', 7, '150.00', '2022-11-16', '09:38:55', 'Ordered', 'Jane Doe', 912, 'MPH'),
(19, 3, 'Shawarma', '55.00', 10, '550.00', '2022-09-22', '09:30:39', 'Delivered', 'Jane Doe', 917, 'Registrar'),
(20, 3, 'Lemon Juice', '30.00', 10, '300.00', '2022-09-22', '09:31:39', 'Delivered', 'Abby Dingh', 917, 'MPH'),
(21, 23, 'Pizza Pot Pie', '70.00', 3, '210.00', '2022-12-06', '15:22:17', 'Delivered', 'Eric Sarmiento', 918, 'MPH'),
(22, 9, 'Sushi', '60.00', 3, '180.00', '2022-11-30', '11:23:55', 'Ordered', 'Mark Daniel', 918, 'MPH'),
(23, 2, 'Curry and Rice', '70.00', 5, '350.00', '2022-11-16', '09:16:55', 'Delivered', 'Alyana Pornelosa', 181, 'CBAA office'),
(24, 20, 'Lugaw', '50.00', 50, '2500.00', '2021-11-16', '00:00:00', 'Delivered', 'Jane Doe', 910, 'MPH'),
(25, 3, 'Orange Juice', '30.00', 25, '750.00', '2021-12-08', '09:24:19', 'Delivered', 'Mark Daniel', 912, 'MPH'),
(26, 3, 'Jaw Breaker Burger', '119.00', 10, '1190.00', '2020-12-01', '08:30:04', 'Delivered', 'Jane Doe', 918, 'CCE Office');

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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
