-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 03, 2014 at 03:42 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `guest_house`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_master`
--

CREATE TABLE IF NOT EXISTS `admin_master` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `admin_login` varchar(20) NOT NULL DEFAULT '',
  `admin_pwd` varchar(20) NOT NULL DEFAULT '',
  `admin_email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `registered_date` datetime NOT NULL,
  `last_login` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `is_super` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `admin_master`
--

INSERT INTO `admin_master` (`id`, `first_name`, `last_name`, `admin_login`, `admin_pwd`, `admin_email`, `mobile`, `registered_date`, `last_login`, `status`, `is_super`) VALUES
(1, 'Rituparna', 'Biswas', 'admin', 'admin', 'rituparna.project@gmail.com', '13336678', '2012-03-29 00:53:06', '2014-04-02 23:33:02', 'Active', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_name`, `created_date`, `status`) VALUES
(1, 'Beringer Vineyards', '2014-03-23 19:12:01', 'Active'),
(2, 'Kendall-Jackson', '2014-03-24 16:43:04', 'Active'),
(3, 'Sutter Home', '2014-03-24 16:43:35', 'Active'),
(4, 'Yellow Tail', '2014-03-24 16:43:42', 'Active'),
(7, 'Woodbridge', '2014-03-24 16:45:03', 'Active'),
(26, 'Almaden', '2014-03-24 18:19:26', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `product_godown`
--

CREATE TABLE IF NOT EXISTS `product_godown` (
  `product_godown_id` int(11) NOT NULL AUTO_INCREMENT,
  `stock_type` enum('Opening Balance','Purchase') NOT NULL DEFAULT 'Purchase',
  `product_name` varchar(255) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `mfg_date` date NOT NULL,
  `pass_no` varchar(255) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `invoice_no` varchar(255) NOT NULL,
  `invoice_date` date NOT NULL,
  `bottle_qty` int(11) NOT NULL,
  `qty_2000` int(11) NOT NULL,
  `rate_2000` double(10,2) NOT NULL,
  `qty_1000` int(11) NOT NULL,
  `rate_1000` double(10,2) NOT NULL,
  `qty_750` int(11) NOT NULL,
  `rate_750` double(10,2) NOT NULL,
  `qty_650` int(11) NOT NULL,
  `rate_650` double(10,2) NOT NULL,
  `qty_500` int(11) NOT NULL,
  `rate_500` double(10,2) NOT NULL,
  `qty_375` int(11) NOT NULL,
  `rate_375` double(10,2) NOT NULL,
  `qty_275` int(11) NOT NULL,
  `rate_275` double(10,2) NOT NULL,
  `qty_200` int(11) NOT NULL,
  `rate_200` double(10,2) NOT NULL,
  `qty_180` int(11) NOT NULL,
  `rate_180` double(10,2) NOT NULL,
  `total_amount` double(10,2) NOT NULL,
  `discount` double(10,2) NOT NULL,
  `total_amount_after_discount` double(10,2) NOT NULL,
  `remarks` text NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`product_godown_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product_godown`
--

INSERT INTO `product_godown` (`product_godown_id`, `stock_type`, `product_name`, `brand_id`, `mfg_date`, `pass_no`, `supplier_id`, `invoice_no`, `invoice_date`, `bottle_qty`, `qty_2000`, `rate_2000`, `qty_1000`, `rate_1000`, `qty_750`, `rate_750`, `qty_650`, `rate_650`, `qty_500`, `rate_500`, `qty_375`, `rate_375`, `qty_275`, `rate_275`, `qty_200`, `rate_200`, `qty_180`, `rate_180`, `total_amount`, `discount`, `total_amount_after_discount`, `remarks`, `created_date`) VALUES
(1, 'Purchase', 'Test Product', 1, '2014-01-01', '1234567890', 1, 'INVOICE/04/14', '2014-04-02', 10, 1, 1000.00, 1, 900.00, 3, 750.00, 0, 0.00, 0, 0.00, 0, 0.00, 4, 250.00, 0, 0.00, 1, 250.00, 5400.00, 200.00, 5200.00, 'Remarks', '2014-04-02 17:05:31'),
(2, 'Purchase', 'Test Product 2', 3, '2014-02-04', '1321321', 3, 'BILL/02/14', '2014-04-03', 4, 2, 500.00, 2, 300.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 0, 0.00, 1600.00, 0.00, 1600.00, '', '2014-04-02 18:42:51');

-- --------------------------------------------------------

--
-- Table structure for table `product_godown_batch`
--

CREATE TABLE IF NOT EXISTS `product_godown_batch` (
  `product_godown_batch_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_godown_id` int(11) NOT NULL,
  `batch_no` text NOT NULL,
  PRIMARY KEY (`product_godown_batch_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `product_godown_batch`
--

INSERT INTO `product_godown_batch` (`product_godown_batch_id`, `product_godown_id`, `batch_no`) VALUES
(6, 1, '1234567894234234'),
(7, 1, '4234234234234688'),
(8, 1, '6487164871264872'),
(9, 1, '5638273912303980'),
(10, 1, '346w519749874676'),
(11, 2, '7866646436345345'),
(12, 2, '4234414124124244'),
(13, 2, '5345345345345545'),
(14, 2, '5345345435553455');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `supplier_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(255) NOT NULL,
  `remarks` text NOT NULL,
  `created_date` datetime NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `name`, `address`, `phone`, `remarks`, `created_date`, `status`) VALUES
(1, 'Test Supplier', '3/1 M.G. Road. Kolkata - 700001', '123456789', 'Test Remarks', '2014-03-23 14:51:19', 'Active'),
(2, 'Test Supplier 2', '14 M.G. Road. Kolkata - 700001', '123456789', '', '2014-03-23 14:59:05', 'Active'),
(3, 'Test Supplier 3', '25 M.G. Road. Kolkata - 700001', '123456789', '', '2014-03-23 15:02:36', 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
