-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2021 at 03:25 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jvg`
--

-- --------------------------------------------------------

--
-- Table structure for table `broker`
--

CREATE TABLE `broker` (
  `id` int(11) NOT NULL,
  `broker_name` varchar(200) NOT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `alternet_no` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `broker`
--

INSERT INTO `broker` (`id`, `broker_name`, `contact_no`, `alternet_no`, `email`, `created_by`, `created_at`, `status`) VALUES
(1, 'ravi', '9770866243', '', 'ravi@gmail.com', 2, '2021-07-18 12:33:16', 1),
(2, 'madhav', '9770866243', '', 'ravi@gmail.com', 2, '2021-07-18 12:33:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company_info`
--

CREATE TABLE `company_info` (
  `id` int(11) NOT NULL,
  `comany_name` varchar(200) NOT NULL,
  `gst_no` varchar(200) NOT NULL,
  `contact_no` varchar(200) NOT NULL,
  `address` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_info`
--

INSERT INTO `company_info` (`id`, `comany_name`, `gst_no`, `contact_no`, `address`) VALUES
(1, 'J.V.G. TRADERS & TRANSPORT', '22AAKFJ5770C1ZK', '', 'NEAR JANKARM PRESS, BEHIND EYE HOSPITAL ,RAIGARH (C.G.) - 496001');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(200) NOT NULL,
  `gst_no` varchar(15) NOT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `alternet_no` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `address` varchar(500) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_name`, `gst_no`, `contact_no`, `alternet_no`, `email`, `address`, `created_by`, `created_at`, `status`) VALUES
(1, 'ajay', '123123123123124', '9770866242', '', NULL, 'kumhari', 2, '2021-07-18 12:39:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `code` varchar(50) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `ppu` float(10,2) NOT NULL COMMENT 'price per unit',
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `name`, `code`, `unit_id`, `ppu`, `status`, `created_at`, `created_by`) VALUES
(1, 'MS BILLET', 'msb', 3, 0.00, 1, '2021-07-18 12:09:42', 2),
(2, 'new p', 'new', 3, 0.00, 1, '2021-07-19 01:12:05', 2);

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` int(11) NOT NULL,
  `bill_date` date DEFAULT NULL,
  `vendor_id` int(50) NOT NULL,
  `broker_id` int(11) DEFAULT NULL,
  `product_total_amount` double(10,2) NOT NULL,
  `purchase_date` date NOT NULL,
  `discount` double NOT NULL,
  `gst_amount` float(10,2) NOT NULL DEFAULT 0.00,
  `grandtotal_amount` double(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_item`
--

CREATE TABLE `purchase_item` (
  `purchase_item_id` int(11) NOT NULL,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `qty` double(10,2) NOT NULL,
  `perunit_price` double(10,2) NOT NULL,
  `product_total_amount` double(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `invoice_no` varchar(100) NOT NULL,
  `GR/RRNo` varchar(50) NOT NULL,
  `invoice_date` date NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `broker_id` int(11) DEFAULT NULL,
  `trasport` varchar(200) NOT NULL,
  `vehicle_no` varchar(20) NOT NULL,
  `eway_no` varchar(20) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `bill_address` longtext NOT NULL,
  `shipping_address` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `state_of_supply` varchar(50) NOT NULL,
  `cgst_amount` double(10,2) NOT NULL COMMENT 'if sale under CG',
  `sgst_amount` double(10,2) NOT NULL COMMENT 'if sale under CG',
  `igst_amount` double(10,2) NOT NULL COMMENT 'if sales out of C.G',
  `total_tax_amount` double(10,2) NOT NULL COMMENT 'cgst + sgst + igst(if apllicable)',
  `grand_total` double(10,2) NOT NULL,
  `insurance` float(10,2) DEFAULT NULL,
  `frieght` float(10,2) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales_item`
--

CREATE TABLE `sales_item` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `qty` double(10,2) NOT NULL,
  `sales_per_unit` double(10,2) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `sales_product_amount` double(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `sales_order_id` int(11) NOT NULL,
  `bill_date` date DEFAULT NULL,
  `vendor_id` int(50) NOT NULL,
  `broker_id` int(11) DEFAULT NULL,
  `product_total_amount` double(10,2) NOT NULL,
  `purchase_date` date NOT NULL,
  `discount` double NOT NULL,
  `cgst` double(10,2) NOT NULL DEFAULT 0.00,
  `sgst` float(10,2) NOT NULL DEFAULT 0.00,
  `igst` float(10,2) NOT NULL DEFAULT 0.00,
  `grandtotal_amount` double(10,2) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_item`
--

CREATE TABLE `sales_order_item` (
  `purchase_item_id` int(11) NOT NULL,
  `sales_order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `qty` double(10,2) NOT NULL,
  `perunit_price` double(10,2) NOT NULL,
  `product_total_amount` double(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(100) NOT NULL,
  `state_code` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`, `state_code`, `status`) VALUES
(1, 'chhattisgarh', 'CG', 1),
(2, 'madhya pradesh', 'MP', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_master`
--

CREATE TABLE `stock_master` (
  `stock_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `unit_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`unit_id`, `name`, `status`) VALUES
(3, 'METRIC TON', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_type_id` int(11) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `contact_no` varchar(12) NOT NULL,
  `password` varchar(50) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_type_id`, `uname`, `fname`, `lname`, `contact_no`, `password`, `active`, `created_by`, `created_at`, `status`) VALUES
(1, 1, 'dev', 'dev', 'loper', '9770866241', '123456', 1, NULL, NULL, 1),
(2, 2, 'jvg', 'test', 'test', '9770866241', '123456', 1, 1, NULL, 1),
(3, 2, 'ram123', 'rahul', 'sinha', '9770866241', '321123', 1, 1, '2021-06-28 01:40:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `user_type_id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`user_type_id`, `type`, `status`) VALUES
(1, 'super-admin', 1),
(2, 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_master`
--

CREATE TABLE `vendor_master` (
  `vendor_id` int(50) NOT NULL,
  `vendor_name` varchar(200) NOT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `Alternate_contact_no` varchar(15) DEFAULT NULL,
  `gst_no` varchar(50) NOT NULL,
  `address` longtext DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `createdate` datetime NOT NULL,
  `created_by` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_master`
--

INSERT INTO `vendor_master` (`vendor_id`, `vendor_name`, `contact_no`, `Alternate_contact_no`, `gst_no`, `address`, `status`, `createdate`, `created_by`) VALUES
(1, 'rahul sinha', '9770866241', '', '234234242432424', 'model town bhilai', 1, '2021-07-18 12:34:16', 2),
(2, 'Avijit', '8982100982', '', '123123123123124', 'smriti nagar', 1, '2021-07-18 12:35:11', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `broker`
--
ALTER TABLE `broker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_info`
--
ALTER TABLE `company_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `vendor_id` (`vendor_id`);

--
-- Indexes for table `purchase_item`
--
ALTER TABLE `purchase_item`
  ADD PRIMARY KEY (`purchase_item_id`),
  ADD KEY `purchase_id` (`purchase_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `customer_id` (`vendor_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `sales_item`
--
ALTER TABLE `sales_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sale_id` (`sale_id`),
  ADD KEY `unit_id` (`unit_id`),
  ADD KEY `item_id` (`product_id`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`sales_order_id`);

--
-- Indexes for table `sales_order_item`
--
ALTER TABLE `sales_order_item`
  ADD PRIMARY KEY (`purchase_item_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `stock_master`
--
ALTER TABLE `stock_master`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`unit_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_type_id` (`user_type_id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`user_type_id`);

--
-- Indexes for table `vendor_master`
--
ALTER TABLE `vendor_master`
  ADD PRIMARY KEY (`vendor_id`),
  ADD KEY `created_by` (`created_by`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `broker`
--
ALTER TABLE `broker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company_info`
--
ALTER TABLE `company_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_item`
--
ALTER TABLE `purchase_item`
  MODIFY `purchase_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_item`
--
ALTER TABLE `sales_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `sales_order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_order_item`
--
ALTER TABLE `sales_order_item`
  MODIFY `purchase_item_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_master`
--
ALTER TABLE `stock_master`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `unit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `user_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendor_master`
--
ALTER TABLE `vendor_master`
  MODIFY `vendor_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unit_id`) ON UPDATE CASCADE;

--
-- Constraints for table `purchase`
--
ALTER TABLE `purchase`
  ADD CONSTRAINT `purchase_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_ibfk_4` FOREIGN KEY (`vendor_id`) REFERENCES `vendor_master` (`vendor_id`) ON UPDATE CASCADE;

--
-- Constraints for table `purchase_item`
--
ALTER TABLE `purchase_item`
  ADD CONSTRAINT `purchase_item_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_item_ibfk_2` FOREIGN KEY (`purchase_id`) REFERENCES `purchase` (`purchase_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_item_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unit_id`) ON UPDATE CASCADE;

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`vendor_id`) REFERENCES `vendor_master` (`vendor_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `sales_item`
--
ALTER TABLE `sales_item`
  ADD CONSTRAINT `sales_item_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_item_ibfk_2` FOREIGN KEY (`sale_id`) REFERENCES `sales` (`sales_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `sales_item_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`unit_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`user_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vendor_master`
--
ALTER TABLE `vendor_master`
  ADD CONSTRAINT `vendor_master_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
