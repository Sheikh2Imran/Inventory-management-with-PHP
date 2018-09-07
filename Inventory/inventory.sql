-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2017 at 03:53 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` varchar(50) NOT NULL,
  `branch_address` varchar(100) NOT NULL,
  `branch_contact` varchar(50) NOT NULL,
  `skin` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `branch_address`, `branch_contact`, `skin`) VALUES
(1, 'Noapara center', 'Noapara, jessore', '090998278', 'red');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(5, 'Television'),
(6, 'Sofa'),
(7, 'Video Player'),
(8, 'Home Appliance'),
(9, 'Kitchen Appliance'),
(10, 'Gadget'),
(11, 'Rice Cooker'),
(12, 'Brick'),
(13, 'à¦¬à¦¾à¦²à¦¿'),
(14, 'à¦ªà¦¾à¦¥à¦°'),
(15, 'à¦Ÿà¦¾à¦‡à¦²à¦¸'),
(16, 'Cash Payment');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_first` varchar(50) NOT NULL,
  `cust_last` varchar(30) NOT NULL,
  `cust_address` varchar(100) NOT NULL,
  `cust_contact` varchar(30) NOT NULL,
  `balance` decimal(10,2) NOT NULL,
  `cust_pic` varchar(300) NOT NULL,
  `bday` date NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `house_status` varchar(30) NOT NULL,
  `years` varchar(20) NOT NULL,
  `rent` varchar(10) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `emp_no` varchar(30) NOT NULL,
  `emp_address` varchar(100) NOT NULL,
  `emp_year` varchar(10) NOT NULL,
  `occupation` varchar(30) NOT NULL,
  `salary` varchar(30) NOT NULL,
  `spouse` varchar(30) NOT NULL,
  `spouse_no` varchar(30) NOT NULL,
  `spouse_emp` varchar(50) NOT NULL,
  `spouse_details` varchar(100) NOT NULL,
  `spouse_income` decimal(10,2) NOT NULL,
  `comaker` varchar(30) NOT NULL,
  `comaker_details` varchar(100) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `credit_status` varchar(10) NOT NULL,
  `ci_remarks` varchar(1000) NOT NULL,
  `ci_name` varchar(50) NOT NULL,
  `ci_date` date NOT NULL,
  `payslip` int(11) NOT NULL,
  `valid_id` int(11) NOT NULL,
  `cert` int(11) NOT NULL,
  `cedula` int(11) NOT NULL,
  `income` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_first`, `cust_last`, `cust_address`, `cust_contact`, `balance`, `cust_pic`, `bday`, `nickname`, `house_status`, `years`, `rent`, `emp_name`, `emp_no`, `emp_address`, `emp_year`, `occupation`, `salary`, `spouse`, `spouse_no`, `spouse_emp`, `spouse_details`, `spouse_income`, `comaker`, `comaker_details`, `branch_id`, `credit_status`, `ci_remarks`, `ci_name`, `ci_date`, `payslip`, `valid_id`, `cert`, `cedula`, `income`) VALUES
(1, 'Kenneth', 'Aboy', 'Silay City\r\n', '09098', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 1, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(2, 'Honeylee', 'Magbanua', 'Brgy. Busay, bago CIty', '09051914070', '303.20', 'default.gif', '1989-10-14', 'lee', 'owned', '27', 'NA', 'Stratium Software', '034-707-1630', 'Ayala Northpoint', '1', 'Systems Administrator', '12000', 'NA', 'NA', 'NA', 'NA', '0.00', 'Kaye Angela Cueva', 'Cadiz City', 1, 'Approved', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(3, 'ergwer', 'feger', 'dghh', '4576689', '98.88', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 1, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(4, 'jamal', 'Sheikh', 'noapara hat bajar', '093068456', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 2, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(5, 'Amin', 'Mohammad', 'sonadhange, khulna', '989677', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 1, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(6, 'Y', 'Mr. X', 'kjjkhjg', '787987', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 1, '', '', '', '0000-00-00', 0, 0, 0, 0, 0),
(7, 'sdjf', 'abc', 'hgh', '7878', '0.00', 'default.gif', '0000-00-00', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0.00', '', '', 1, '', '', '', '0000-00-00', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `history_log`
--

CREATE TABLE `history_log` (
  `log_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` varchar(100) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `history_log`
--

INSERT INTO `history_log` (`log_id`, `user_id`, `action`, `date`) VALUES
(1, 1, 'added 5 of LG 43" UHD TV UH6100', '2017-02-04 01:10:41'),
(2, 1, 'added 100 of Lotion', '2017-02-04 01:10:49'),
(3, 1, 'added 10 of Rice Cooker', '2017-02-04 01:10:55'),
(4, 1, 'added 5 of Samsung', '2017-02-04 01:11:07'),
(5, 1, 'has logged in the system at ', '2017-02-04 08:22:52'),
(6, 1, 'has logged in the system at ', '2017-02-04 08:51:11'),
(7, 1, 'has logged in the system at ', '2017-02-04 13:13:53'),
(8, 1, 'has logged in the system at ', '2017-02-21 18:56:56'),
(9, 1, 'added a payment of -76.6 for , ', '2017-02-21 00:00:00'),
(10, 1, 'has logged in the system at ', '2017-07-27 17:24:33'),
(11, 1, 'has logged out the system at ', '2017-07-27 17:30:23'),
(12, 1, 'has logged in the system at ', '2017-07-27 17:35:27'),
(13, 1, 'has logged out the system at ', '2017-07-27 17:51:20'),
(14, 1, 'has logged in the system at ', '2017-07-27 17:57:14'),
(15, 1, 'has logged in the system at ', '2017-07-28 02:17:27'),
(16, 1, 'has logged in the system at ', '2017-07-28 02:17:35'),
(17, 1, 'has logged out the system at ', '2017-07-28 02:17:37'),
(18, 1, 'has logged in the system at ', '2017-07-28 02:17:43'),
(19, 1, 'has logged out the system at ', '2017-07-28 02:18:05'),
(20, 7, 'has logged in the system at ', '2017-07-28 21:56:13'),
(21, 7, 'deleted 500 yuy from purchase request', '2017-07-28 22:07:50'),
(22, 7, 'deleted 500 yuy from purchase request', '2017-07-28 22:07:53'),
(23, 7, 'has logged out the system at ', '2017-07-28 22:16:36'),
(24, 1, 'has logged in the system at ', '2017-07-28 22:16:48'),
(25, 7, 'has logged in the system at ', '2017-07-28 22:40:23'),
(26, 7, 'has logged in the system at ', '2017-07-29 20:09:59'),
(27, 7, 'has logged out the system at ', '2017-07-29 20:10:05'),
(28, 1, 'has logged in the system at ', '2017-07-29 20:10:25'),
(29, 1, 'has logged in the system at ', '2017-07-29 20:31:30'),
(30, 7, 'has logged in the system at ', '2017-07-31 01:45:42'),
(31, 7, 'has logged in the system at ', '2017-07-31 18:12:17'),
(32, 7, 'has logged out the system at ', '2017-07-31 18:14:50'),
(33, 1, 'has logged in the system at ', '2017-07-31 18:15:05'),
(34, 1, 'added 20 of LG 43', '2017-07-31 18:15:21'),
(35, 1, 'added 20 of Lotion', '2017-07-31 18:15:30'),
(36, 1, 'added 15 of Rice Cooker', '2017-07-31 18:15:41'),
(37, 1, 'added 25 of Sample', '2017-07-31 18:15:52'),
(38, 1, 'added 18 of Samsung', '2017-07-31 18:16:01'),
(39, 1, 'has logged in the system at ', '2017-07-31 19:00:06'),
(40, 1, 'has logged in the system at ', '2017-07-31 19:17:50'),
(41, 1, 'has logged in the system at ', '2017-07-31 19:36:09'),
(42, 1, 'has logged in the system at ', '2017-07-31 20:31:11'),
(43, 1, 'has logged in the system at ', '2017-07-31 21:09:03'),
(44, 1, 'has logged in the system at ', '2017-08-01 14:09:19'),
(45, 1, 'has logged in the system at ', '2017-08-02 13:47:39'),
(46, 1, 'has logged in the system at ', '2017-08-02 14:36:55'),
(47, 1, 'has logged in the system at ', '2017-08-02 14:40:54'),
(48, 1, 'has logged in the system at ', '2017-08-03 15:56:10'),
(49, 1, 'has logged out the system at ', '2017-08-03 16:17:52'),
(50, 1, 'has logged in the system at ', '2017-08-03 16:22:07'),
(51, 1, 'has logged in the system at ', '2017-08-04 18:11:28'),
(52, 1, 'has logged in the system at ', '2017-08-29 02:15:35'),
(53, 1, 'has logged in the system at ', '2017-09-07 15:27:29'),
(54, 1, 'has logged in the system at ', '2017-09-12 20:16:13'),
(55, 1, 'has logged in the system at ', '2017-09-14 20:35:22'),
(56, 1, 'has logged in the system at ', '2017-09-14 20:36:47'),
(57, 1, 'added 20 of Lotion', '2017-09-14 20:37:02'),
(58, 1, 'has logged in the system at ', '2017-09-14 20:38:11'),
(59, 1, 'has logged in the system at ', '2017-09-15 22:18:37'),
(60, 1, 'has logged in the system at ', '2017-09-20 23:13:22'),
(61, 1, 'has logged in the system at ', '2017-09-20 23:16:27'),
(62, 1, 'has logged in the system at ', '2017-09-21 05:19:32'),
(63, 1, 'has logged in the system at ', '2017-10-16 16:25:22'),
(64, 1, 'has logged in the system at ', '2017-11-02 14:34:30'),
(65, 1, 'has logged in the system at ', '2017-11-02 15:50:45'),
(66, 1, 'has logged in the system at ', '2017-11-06 22:35:43'),
(67, 1, 'added 5 of Lotion', '2017-11-06 22:48:43');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `payment` decimal(10,2) NOT NULL,
  `payment_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `payment_for` date NOT NULL,
  `due` decimal(10,2) NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `remaining` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL,
  `rebate` decimal(10,2) NOT NULL,
  `or_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `cust_id`, `sales_id`, `payment`, `payment_date`, `user_id`, `branch_id`, `payment_for`, `due`, `interest`, `remaining`, `status`, `rebate`, `or_no`) VALUES
(3168, 3, 10, '45.00', '2017-07-28 22:37:19', 1, 1, '2017-07-28', '45.00', '0.00', '0.00', 'paid', '0.00', 1903),
(3169, 2, 11, '3200.00', '2017-07-28 22:39:21', 1, 1, '2017-07-28', '3200.00', '0.00', '0.00', 'paid', '0.00', 1904),
(3170, 3, 12, '125000.00', '2017-07-29 20:30:15', 1, 1, '2017-07-29', '125000.00', '0.00', '0.00', 'paid', '0.00', 1905),
(3171, 4, 14, '456.00', '2017-07-31 01:47:02', 7, 2, '2017-07-31', '456.00', '0.00', '0.00', 'paid', '0.00', 1906),
(3172, 0, 15, '1660.00', '2017-07-31 18:45:35', 1, 1, '2017-07-31', '1660.00', '0.00', '0.00', 'paid', '0.00', 1907),
(3173, 3, 16, '40150.00', '2017-07-31 18:51:39', 1, 1, '2017-07-31', '40150.00', '0.00', '0.00', 'paid', '0.00', 1908),
(3174, 6, 17, '700.00', '2017-07-31 19:27:49', 1, 1, '2017-07-31', '700.00', '0.00', '0.00', 'paid', '0.00', 1909),
(3175, 7, 18, '30150.00', '2017-07-31 19:46:15', 1, 1, '2017-07-31', '30150.00', '0.00', '0.00', 'paid', '0.00', 1910),
(3177, 3, 19, '24.72', '2017-07-31 00:00:00', 1, 1, '2017-07-31', '24.72', '0.00', '0.00', 'paid', '0.00', 3152),
(3178, 3, 20, '45.00', '2017-08-01 14:10:11', 1, 1, '2017-08-01', '45.00', '0.00', '0.00', 'paid', '0.00', 1911),
(3179, 7, 21, '45.00', '2017-08-01 15:02:16', 1, 1, '2017-08-01', '45.00', '0.00', '0.00', 'paid', '0.00', 1912),
(3180, 7, 22, '270.00', '2017-08-01 15:02:36', 1, 1, '2017-08-01', '270.00', '0.00', '0.00', 'paid', '0.00', 1913),
(3181, 3, 23, '700.00', '2017-08-01 15:17:31', 1, 1, '2017-08-01', '700.00', '0.00', '0.00', 'paid', '0.00', 1914),
(3182, 6, 24, '700.00', '2017-08-01 15:21:31', 1, 1, '2017-08-01', '700.00', '0.00', '0.00', 'paid', '0.00', 1915),
(3183, 7, 25, '111.00', '2017-08-01 16:32:44', 1, 1, '2017-08-01', '111.00', '0.00', '0.00', 'paid', '0.00', 1916),
(3184, 3, 26, '0.00', '2017-08-01 16:55:50', 1, 1, '2017-08-01', '0.00', '0.00', '0.00', 'paid', '0.00', 1917),
(3185, 3, 27, '151.00', '2017-08-01 16:57:51', 1, 1, '2017-08-01', '151.00', '0.00', '0.00', 'paid', '0.00', 1918),
(3186, 3, 28, '0.00', '2017-08-01 16:59:44', 1, 1, '2017-08-01', '0.00', '0.00', '0.00', 'paid', '0.00', 1919),
(3187, 3, 29, '90150.00', '2017-08-01 17:02:16', 1, 1, '2017-08-01', '90150.00', '0.00', '0.00', 'paid', '0.00', 1920),
(3188, 3, 30, '151.00', '2017-08-01 17:02:53', 1, 1, '2017-08-01', '151.00', '0.00', '0.00', 'paid', '0.00', 1921),
(3189, 3, 31, '0.00', '2017-08-02 13:57:01', 1, 1, '2017-08-02', '0.00', '0.00', '0.00', 'paid', '0.00', 1922),
(3190, 3, 32, '0.00', '2017-08-02 14:03:16', 1, 1, '2017-08-02', '0.00', '0.00', '0.00', 'paid', '0.00', 1923),
(3191, 3, 33, '0.00', '2017-08-02 14:09:38', 1, 1, '2017-08-02', '0.00', '0.00', '0.00', 'paid', '0.00', 1924),
(3192, 7, 34, '0.00', '2017-09-07 15:27:56', 1, 1, '2017-09-07', '0.00', '0.00', '0.00', 'paid', '0.00', 1925),
(3193, 1, 35, '0.00', '2017-09-07 15:29:02', 1, 1, '2017-09-07', '0.00', '0.00', '0.00', 'paid', '0.00', 1926),
(3194, 1, 36, '270.00', '2017-09-14 20:36:29', 1, 1, '2017-09-14', '270.00', '0.00', '0.00', 'paid', '0.00', 1927),
(3195, 3, 37, '270.00', '2017-09-20 23:13:34', 1, 1, '2017-09-20', '270.00', '0.00', '0.00', 'paid', '0.00', 1928),
(3196, 5, 38, '0.00', '2017-09-20 23:16:32', 1, 1, '2017-09-20', '0.00', '0.00', '0.00', 'paid', '0.00', 1929);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(100) NOT NULL,
  `prod_desc` varchar(500) NOT NULL,
  `prod_price` decimal(10,2) NOT NULL,
  `prod_pic` varchar(300) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `prod_qty` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `reorder` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `serial` varchar(50) NOT NULL,
  `labour` varchar(255) NOT NULL DEFAULT '50',
  `transmission` varchar(255) NOT NULL DEFAULT '50',
  `others` varchar(255) NOT NULL DEFAULT '50'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_name`, `prod_desc`, `prod_price`, `prod_pic`, `cat_id`, `prod_qty`, `branch_id`, `reorder`, `supplier_id`, `serial`, `labour`, `transmission`, `others`) VALUES
(13, 'Rice Cooker', '', '550.00', 'WIN_20160728_16_56_20_Pro (2).jpg', 9, 9, 1, 2, 4, '22ewew', '50', '50', '50'),
(14, 'Samsung', '', '15000.00', 'WIN_20160209_16_45_20_Pro.jpg', 10, 19, 1, 4, 5, 'erere323', '50', '50', '50'),
(15, 'Lotion', '', '120.00', 'default.gif', 12, 101, 1, 4, 6, '1101388911', '50', '50', '50'),
(18, 'Cash Payment', 'Cash Payment', '0.00', 'default.gif', 16, -6, 1, -10000000, 8, 'Payment', '50', '50', '50');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_request`
--

CREATE TABLE `purchase_request` (
  `pr_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `branch_id` int(11) NOT NULL,
  `purchase_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_request`
--

INSERT INTO `purchase_request` (`pr_id`, `prod_id`, `qty`, `request_date`, `branch_id`, `purchase_status`) VALUES
(3, 17, 500, '2017-07-28', 2, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `sales_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cash_tendered` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `amount_due` decimal(10,2) NOT NULL,
  `cash_change` decimal(10,2) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `modeofpayment` varchar(15) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`sales_id`, `cust_id`, `user_id`, `cash_tendered`, `discount`, `amount_due`, `cash_change`, `date_added`, `modeofpayment`, `branch_id`, `total`) VALUES
(1, 1, 1, '500.00', '50.00', '500.00', '0.00', '2017-02-04 01:33:28', 'cash', 1, '450.00'),
(2, 1, 1, '550.00', '0.00', '550.00', '0.00', '2017-02-21 18:57:26', 'cash', 1, '550.00'),
(3, 1, 1, '0.00', '550.00', '0.00', '0.00', '2017-02-21 19:49:41', 'cash', 1, '-550.00'),
(4, 1, 1, '550.00', '0.00', '550.00', '0.00', '2017-02-21 19:55:57', 'cash', 1, '550.00'),
(5, 2, 1, '110.00', '0.00', '110.00', '0.00', '2017-02-21 19:56:17', 'cash', 1, '110.00'),
(6, 1, 1, '550.00', '0.00', '550.00', '0.00', '2017-02-21 19:57:12', 'cash', 1, '550.00'),
(7, 2, 1, '550.00', '0.00', '550.00', '0.00', '2017-02-21 19:57:29', 'cash', 1, '550.00'),
(9, 2, 1, NULL, NULL, '0.00', NULL, '2017-02-21 21:16:52', 'credit', 1, '550.00'),
(10, 3, 1, '0.00', '0.00', '45.00', '0.00', '2017-07-28 22:37:19', 'cash', 1, '45.00'),
(11, 2, 1, '3000.00', '200.00', '3400.00', '-400.00', '2017-07-28 22:39:21', 'cash', 1, '3200.00'),
(12, 3, 1, '100000.00', '5000.00', '130000.00', '-30000.00', '2017-07-29 20:30:15', 'cash', 1, '125000.00'),
(13, 0, 1, NULL, NULL, '0.00', NULL, '2017-07-29 20:38:51', 'credit', 1, '121.00'),
(14, 4, 7, '0.00', '0.00', '456.00', '0.00', '2017-07-31 01:47:02', 'cash', 2, '456.00'),
(15, 0, 1, '2000.00', '20.00', '1680.00', '320.00', '2017-07-31 18:45:35', 'cash', 1, '1660.00'),
(16, 3, 1, '50000.00', '0.00', '40150.00', '9850.00', '2017-07-31 18:51:39', 'cash', 1, '40150.00'),
(17, 6, 1, '0.00', '0.00', '700.00', '-700.00', '2017-07-31 19:27:49', 'cash', 1, '700.00'),
(18, 7, 1, '0.00', '0.00', '30150.00', '-30150.00', '2017-07-31 19:46:15', 'cash', 1, '30150.00'),
(19, 3, 1, NULL, NULL, '0.00', NULL, '2017-07-31 20:58:28', 'credit', 1, '120.00'),
(20, 3, 1, '0.00', '0.00', '45.00', '0.00', '2017-08-01 14:10:11', 'cash', 1, '45.00'),
(21, 7, 1, '0.00', '0.00', '45.00', '0.00', '2017-08-01 15:02:16', 'cash', 1, '45.00'),
(22, 7, 1, '0.00', '0.00', '270.00', '-270.00', '2017-08-01 15:02:36', 'cash', 1, '270.00'),
(23, 3, 1, '0.00', '0.00', '700.00', '-700.00', '2017-08-01 15:17:31', 'cash', 1, '700.00'),
(24, 6, 1, '0.00', '0.00', '700.00', '-700.00', '2017-08-01 15:21:31', 'cash', 1, '700.00'),
(25, 7, 1, '100000.00', '20.00', '131.00', '99869.00', '2017-08-01 16:32:44', 'cash', 1, '111.00'),
(26, 3, 1, '20985.00', '0.00', '0.00', '20985.00', '2017-08-01 16:55:50', 'cash', 1, '0.00'),
(27, 3, 1, '26000.00', '0.00', '151.00', '25849.00', '2017-08-01 16:57:51', 'cash', 1, '151.00'),
(28, 3, 1, '26000.00', '0.00', '0.00', '26000.00', '2017-08-01 16:59:44', 'cash', 1, '0.00'),
(29, 3, 1, '0.00', '0.00', '90150.00', '-90150.00', '2017-08-01 17:02:16', 'cash', 1, '90150.00'),
(30, 3, 1, '85286.00', '0.00', '151.00', '85135.00', '2017-08-01 17:02:53', 'cash', 1, '151.00'),
(31, 3, 1, '26000.00', '0.00', '0.00', '26000.00', '2017-08-02 13:57:01', 'cash', 1, '0.00'),
(32, 3, 1, '2000.00', '0.00', '0.00', '2000.00', '2017-08-02 14:03:16', 'cash', 1, '0.00'),
(33, 3, 1, '1000.00', '0.00', '0.00', '1000.00', '2017-08-02 14:09:38', 'cash', 1, '0.00'),
(34, 7, 1, '0.00', '0.00', '0.00', '0.00', '2017-09-07 15:27:56', 'cash', 1, '0.00'),
(35, 1, 1, '0.00', '0.00', '0.00', '0.00', '2017-09-07 15:29:02', 'cash', 1, '0.00'),
(36, 1, 1, '0.00', '0.00', '270.00', '-270.00', '2017-09-14 20:36:29', 'cash', 1, '270.00'),
(37, 3, 1, '0.00', '0.00', '270.00', '0.00', '2017-09-20 23:13:34', 'cash', 1, '270.00'),
(38, 5, 1, '0.00', '0.00', '0.00', '0.00', '2017-09-20 23:16:32', 'cash', 1, '0.00');

-- --------------------------------------------------------

--
-- Table structure for table `sales_details`
--

CREATE TABLE `sales_details` (
  `sales_details_id` int(11) NOT NULL,
  `sales_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_details`
--

INSERT INTO `sales_details` (`sales_details_id`, `sales_id`, `prod_id`, `price`, `qty`) VALUES
(1, 1, 13, '550.00', 1),
(2, 2, 13, '550.00', 1),
(3, 3, 13, '550.00', 1),
(4, 4, 13, '550.00', 1),
(5, 5, 16, '110.00', 1),
(6, 6, 13, '550.00', 1),
(7, 7, 13, '550.00', 1),
(8, 8, 13, '550.00', 1),
(9, 9, 13, '550.00', 1),
(10, 10, 5, '45000.00', 1),
(11, 11, 15, '120.00', 30),
(12, 12, 5, '45000.00', 3),
(13, 13, 5, '45000.00', 2),
(14, 13, 14, '15000.00', 2),
(15, 13, 15, '120.00', 10),
(16, 14, 17, '456.00', 1),
(17, 15, 13, '550.00', 2),
(18, 16, 5, '40000.00', 1),
(19, 17, 13, '550.00', 1),
(20, 18, 14, '15000.00', 2),
(21, 19, 15, '120.00', 1),
(22, 20, 5, '45000.00', 1),
(23, 20, 13, '550.00', 1),
(24, 21, 5, '45000.00', 1),
(25, 22, 15, '120.00', 1),
(26, 23, 13, '550.00', 1),
(27, 24, 13, '550.00', 1),
(28, 25, 18, '1.00', 1),
(29, 27, 18, '1.00', 1),
(30, 29, 5, '45000.00', 2),
(31, 30, 18, '1.00', 1),
(32, 31, 18, '1.00', 1),
(33, 32, 18, '0.00', 1),
(34, 33, 18, '0.00', 1),
(35, 36, 15, '120.00', 1),
(36, 37, 15, '120.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stockin`
--

CREATE TABLE `stockin` (
  `stockin_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `qty` int(6) NOT NULL,
  `date` datetime NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stockin`
--

INSERT INTO `stockin` (`stockin_id`, `prod_id`, `qty`, `date`, `branch_id`) VALUES
(1, 5, 5, '2017-02-04 01:10:41', 1),
(2, 15, 100, '2017-02-04 01:10:49', 1),
(3, 13, 10, '2017-02-04 01:10:55', 1),
(4, 14, 5, '2017-02-04 01:11:07', 1),
(5, 5, 20, '2017-07-31 18:15:21', 1),
(6, 15, 20, '2017-07-31 18:15:30', 1),
(7, 13, 15, '2017-07-31 18:15:41', 1),
(8, 16, 25, '2017-07-31 18:15:52', 1),
(9, 14, 18, '2017-07-31 18:16:01', 1),
(10, 15, 20, '2017-09-14 20:37:02', 1),
(11, 15, 5, '2017-11-06 22:48:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(100) NOT NULL,
  `supplier_address` varchar(300) NOT NULL,
  `supplier_contact` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `supplier_name`, `supplier_address`, `supplier_contact`) VALUES
(2, 'LG Philippines', 'Makati City, Philippines', '423-4444'),
(3, 'Union Home Appliances', 'Binondo, Manila', '98878'),
(4, 'Hanabishi', 'Bacolod City', '034-666-087611'),
(5, 'Samsung Philippines', 'Philippines', '42424'),
(6, 'Avon', 'Bacolod City', '15562'),
(7, 'iStore PH', 'Manila City,Philippines', '09134567890'),
(8, 'Payment', 'Payment', '####');

-- --------------------------------------------------------

--
-- Table structure for table `temp_trans`
--

CREATE TABLE `temp_trans` (
  `temp_trans_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `term`
--

CREATE TABLE `term` (
  `term_id` int(11) NOT NULL,
  `sales_id` int(11) DEFAULT NULL,
  `payable_for` varchar(10) NOT NULL,
  `term` varchar(11) NOT NULL,
  `due` decimal(10,2) NOT NULL,
  `payment_start` date NOT NULL,
  `down` decimal(10,2) NOT NULL,
  `due_date` date NOT NULL,
  `interest` decimal(10,2) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `term`
--

INSERT INTO `term` (`term_id`, `sales_id`, `payable_for`, `term`, `due`, `payment_start`, `down`, `due_date`, `interest`, `status`) VALUES
(1, 8, '4', 'monthly', '113.30', '2017-02-21', '113.30', '2017-06-21', '16.50', ''),
(2, 9, '4', 'monthly', '113.30', '2017-02-21', '113.30', '2017-06-21', '16.50', ''),
(3, 19, '1', 'monthly', '98.88', '2017-07-31', '24.72', '2017-08-31', '3.60', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `branch_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `name`, `status`, `branch_id`) VALUES
(1, 'admin', 'a1Bz20ydqelm8m1wql21232f297a57a5a743894a0e4a801fc3', 'Emanur Rahman', 'active', 1),
(5, 'Mikee', 'a1Bz20ydqelm8m1wql70a5119905ec54b3edf78c6f515ac7b2', 'Mikee', 'active', 1),
(6, 'administrator', 'a1Bz20ydqelm8m1wql21232f297a57a5a743894a0e4a801fc3', 'Giu Matthew', 'active', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `history_log`
--
ALTER TABLE `history_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `purchase_request`
--
ALTER TABLE `purchase_request`
  ADD PRIMARY KEY (`pr_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`sales_id`);

--
-- Indexes for table `sales_details`
--
ALTER TABLE `sales_details`
  ADD PRIMARY KEY (`sales_details_id`);

--
-- Indexes for table `stockin`
--
ALTER TABLE `stockin`
  ADD PRIMARY KEY (`stockin_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

--
-- Indexes for table `temp_trans`
--
ALTER TABLE `temp_trans`
  ADD PRIMARY KEY (`temp_trans_id`);

--
-- Indexes for table `term`
--
ALTER TABLE `term`
  ADD PRIMARY KEY (`term_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `history_log`
--
ALTER TABLE `history_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3197;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `purchase_request`
--
ALTER TABLE `purchase_request`
  MODIFY `pr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `sales_details`
--
ALTER TABLE `sales_details`
  MODIFY `sales_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `stockin`
--
ALTER TABLE `stockin`
  MODIFY `stockin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `temp_trans`
--
ALTER TABLE `temp_trans`
  MODIFY `temp_trans_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `term`
--
ALTER TABLE `term`
  MODIFY `term_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
