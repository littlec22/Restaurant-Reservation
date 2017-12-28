-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 24, 2017 at 03:17 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `c-preciosa`
--

-- --------------------------------------------------------

--
-- Table structure for table `additional_food_table`
--

CREATE TABLE `additional_food_table` (
  `additional_food` int(11) NOT NULL,
  `additional_food_name` varchar(100) NOT NULL,
  `additional_food_price` varchar(100) NOT NULL,
  `additional_food_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `additional_food_table`
--

INSERT INTO `additional_food_table` (`additional_food`, `additional_food_name`, `additional_food_price`, `additional_food_status`) VALUES
(1, 'Adobong paa ng ostrich', '1', 'active'),
(2, 'nilagang buhay na aso', '1', 'active'),
(3, 'Alimango nilaga', '50', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `add_food_information`
--

CREATE TABLE `add_food_information` (
  `add_food_id` int(11) NOT NULL,
  `event_system_id` varchar(50) NOT NULL,
  `add_food` varchar(150) NOT NULL,
  `food_price` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_food_information`
--

INSERT INTO `add_food_information` (`add_food_id`, `event_system_id`, `add_food`, `food_price`) VALUES
(1, '1-0', 'Pusit P 600 good for 20 pax', '600'),
(2, '1-2', 'Pusit P 600 good for 20 pax', '600'),
(3, '1-2', 'Pusit P 600 good for 20 pax', '600'),
(4, '1-3', 'Hipon P 600 good for 20 pax', '600'),
(5, '1-3', 'Pusit P 600 good for 20 pax', '600');

-- --------------------------------------------------------

--
-- Table structure for table `add_services_information`
--

CREATE TABLE `add_services_information` (
  `add_services_id` int(11) NOT NULL,
  `event_system_id` varchar(50) NOT NULL,
  `add_services` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `add_services_information`
--

INSERT INTO `add_services_information` (`add_services_id`, `event_system_id`, `add_services`) VALUES
(1, '1-0', ''),
(2, '1-0', ''),
(3, '1-0', ''),
(4, '1-0', ''),
(5, '1-1', ''),
(6, '1-1', ''),
(7, '1-1', ''),
(8, '1-1', ''),
(9, '1-2', ''),
(10, '1-2', ''),
(11, '1-2', ''),
(12, '1-2', ''),
(13, '1-3', ''),
(14, '1-3', ''),
(15, '1-3', ''),
(16, '1-3', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer_table`
--

CREATE TABLE `customer_table` (
  `cust_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `pass_word` varchar(250) NOT NULL,
  `contact_number` varchar(50) NOT NULL,
  `email_address` varchar(100) NOT NULL,
  `birthday` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_table`
--

INSERT INTO `customer_table` (`cust_id`, `first_name`, `last_name`, `user_name`, `pass_word`, `contact_number`, `email_address`, `birthday`) VALUES
(1, 'carl noel', 'Villar', 'admin', 'admin', '09468361124', 'carlnoelvillar22@yahoo.com', '1997-05-22'),
(2, 'narjes', 'deoso', 'narjes123', 'narjes123', '123456789', 'narjes123@yahoo.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `event_info`
--

CREATE TABLE `event_info` (
  `event_id` int(11) NOT NULL,
  `event_type` varchar(50) NOT NULL,
  `event_area` varchar(50) NOT NULL,
  `event_pax` varchar(50) NOT NULL,
  `event_representative` varchar(50) NOT NULL,
  `event_date` varchar(50) NOT NULL,
  `event_start` varchar(50) NOT NULL,
  `event_end` varchar(50) NOT NULL,
  `cust_id` varchar(50) NOT NULL,
  `event_system_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event_information`
--

CREATE TABLE `event_information` (
  `event_status` varchar(50) NOT NULL,
  `event_id` int(11) NOT NULL,
  `event_system_id` varchar(30) NOT NULL,
  `typeEvent` varchar(150) NOT NULL,
  `areaEvent` varchar(150) NOT NULL,
  `paxEvent` varchar(150) NOT NULL,
  `repEvent` varchar(150) NOT NULL,
  `dateEvent` varchar(150) NOT NULL,
  `startEvent` varchar(150) NOT NULL,
  `endEvent` varchar(150) NOT NULL,
  `packageCost` varchar(150) NOT NULL,
  `perheadCost` varchar(150) NOT NULL,
  `addservicesCost` varchar(150) NOT NULL,
  `addfoodCost` varchar(150) NOT NULL,
  `totalCost` varchar(150) NOT NULL,
  `event_hours` varchar(20) NOT NULL,
  `area_rate` varchar(20) NOT NULL,
  `cust_id` varchar(20) NOT NULL,
  `event_update` varchar(10) NOT NULL,
  `payment_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_information`
--

INSERT INTO `event_information` (`event_status`, `event_id`, `event_system_id`, `typeEvent`, `areaEvent`, `paxEvent`, `repEvent`, `dateEvent`, `startEvent`, `endEvent`, `packageCost`, `perheadCost`, `addservicesCost`, `addfoodCost`, `totalCost`, `event_hours`, `area_rate`, `cust_id`, `event_update`, `payment_status`) VALUES
('Pending', 1, '1-0', 'Meeting', 'vp1', '10', 'aaa', '2017-08-18', '07:00', '08:00', '7944.5', '530', '', '600', '9544.5', '01:00', '1000', '1', '', 'Unpaid'),
('Pending', 2, '1-1', 'Christening', 'vp1', '20', 'carl', '2017-08-19', '10:00', '12:00', '11123.5', '445', '', '', '13123.5', '02:00', '1000', '1', '', 'Unpaid'),
('Reserve', 3, '1-2', 'Meeting', 'VIP 1 max capacity is 30 pax', '30', 'carl', '2017-09-28', '13:00', '18:00', '19869', '568', '', '1200', '26069', '05:00', '1000', '1', '', 'Unpaid'),
('Pending', 4, '1-3', 'Weddings', 'VIP 1 max capacity is 30 pax', '20', 'asdasd', '2017-08-31', '07:00', '12:00', '11123.5', '445', '0', '1200', '17323.5', '05:00', '1000', '1', '', 'Unpaid');

-- --------------------------------------------------------

--
-- Table structure for table `event_package_information`
--

CREATE TABLE `event_package_information` (
  `event_package_id` int(11) NOT NULL,
  `packageType` varchar(50) NOT NULL,
  `porkPackage` varchar(150) NOT NULL,
  `chickenPackage` varchar(150) NOT NULL,
  `fishPackage` varchar(150) NOT NULL,
  `vegetablePackage` varchar(150) NOT NULL,
  `ricePackage` varchar(150) NOT NULL,
  `icedteaPackage` varchar(150) NOT NULL,
  `lemonPackage` varchar(150) NOT NULL,
  `bukoPackage` varchar(150) NOT NULL,
  `event_system_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event_package_information`
--

INSERT INTO `event_package_information` (`event_package_id`, `packageType`, `porkPackage`, `chickenPackage`, `fishPackage`, `vegetablePackage`, `ricePackage`, `icedteaPackage`, `lemonPackage`, `bukoPackage`, `event_system_id`) VALUES
(1, 'Package 2', 'Pork1', 'chicken1', 'Fish Fillet', 'Pusit P 600 good for 20 pax-600', 'Steamed Rice', 'Iced Tea', 'Glass of lemon', 'Buko Pandan', '1-0'),
(2, 'Package 2', 'Pork2', 'chicken1', 'vp1', 'Pusit P 600 good for 20 pax-600', 'vp1', 'vp1', 'vp1', 'vp1', '1-1'),
(3, 'Package 1', '', 'chicken1', 'Fish Fillet', 'Chopsuey', 'Steamed Rice', 'Iced Tea', 'Glass of lemon', 'Buko Pandan', '1-2'),
(4, 'Package 1', '', 'chicken1', 'Fish Fillet', 'Chopsuey', 'Steamed Rice', 'Iced Tea', 'Glass of lemon', 'Buko Pandan', '1-3');

-- --------------------------------------------------------

--
-- Table structure for table `holiday`
--

CREATE TABLE `holiday` (
  `holiday_id` int(11) NOT NULL,
  `holiday_day` varchar(50) NOT NULL,
  `holiday_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holiday`
--

INSERT INTO `holiday` (`holiday_id`, `holiday_day`, `holiday_status`) VALUES
(1, '2017-08-17', 'active'),
(2, '2017-08-01', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `payment_table`
--

CREATE TABLE `payment_table` (
  `payment_id` int(11) NOT NULL,
  `event_id` varchar(50) NOT NULL,
  `contract_payment` varchar(50) NOT NULL,
  `payment` varchar(50) NOT NULL,
  `payment_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_table`
--

INSERT INTO `payment_table` (`payment_id`, `event_id`, `contract_payment`, `payment`, `payment_status`) VALUES
(1, '1-2', '25000', '0', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `additional_food_table`
--
ALTER TABLE `additional_food_table`
  ADD PRIMARY KEY (`additional_food`);

--
-- Indexes for table `add_food_information`
--
ALTER TABLE `add_food_information`
  ADD PRIMARY KEY (`add_food_id`);

--
-- Indexes for table `add_services_information`
--
ALTER TABLE `add_services_information`
  ADD PRIMARY KEY (`add_services_id`);

--
-- Indexes for table `customer_table`
--
ALTER TABLE `customer_table`
  ADD PRIMARY KEY (`cust_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `event_info`
--
ALTER TABLE `event_info`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_information`
--
ALTER TABLE `event_information`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_package_information`
--
ALTER TABLE `event_package_information`
  ADD PRIMARY KEY (`event_package_id`);

--
-- Indexes for table `holiday`
--
ALTER TABLE `holiday`
  ADD PRIMARY KEY (`holiday_id`);

--
-- Indexes for table `payment_table`
--
ALTER TABLE `payment_table`
  ADD PRIMARY KEY (`payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `additional_food_table`
--
ALTER TABLE `additional_food_table`
  MODIFY `additional_food` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `add_food_information`
--
ALTER TABLE `add_food_information`
  MODIFY `add_food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `add_services_information`
--
ALTER TABLE `add_services_information`
  MODIFY `add_services_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `customer_table`
--
ALTER TABLE `customer_table`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `event_info`
--
ALTER TABLE `event_info`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_information`
--
ALTER TABLE `event_information`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `event_package_information`
--
ALTER TABLE `event_package_information`
  MODIFY `event_package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `holiday`
--
ALTER TABLE `holiday`
  MODIFY `holiday_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `payment_table`
--
ALTER TABLE `payment_table`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
