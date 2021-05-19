-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2021 at 01:13 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `userName` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `status` varchar(40) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `userName`, `password`, `status`, `createdDate`) VALUES
(1, 'Dhairya', 'Dd!01032000', 'Enable', '2021-05-10 10:30:05'),
(2, 'Bhavesh', 'Bhavesh@123', 'Enable', '2021-05-10 10:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `attributeId` int(11) NOT NULL,
  `entityTypeId` enum('product','category','customer') NOT NULL,
  `name` varchar(40) NOT NULL,
  `code` varchar(20) NOT NULL,
  `inputType` varchar(20) NOT NULL,
  `backendType` varchar(40) NOT NULL,
  `sortOrder` int(4) NOT NULL,
  `backendModel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attributeId`, `entityTypeId`, `name`, `code`, `inputType`, `backendType`, `sortOrder`, `backendModel`) VALUES
(1, 'product', 'attrubute1', 'attr1', 'select', 'varchar(255)', 1, 'Model_Product'),
(2, 'product', 'attribute2', 'attr2', 'text', 'varchar(255)', 2, 'Model_Product'),
(3, 'product', 'attrinute3', 'attr3', 'text', 'varchar(255)', 3, 'Model_Product');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_options`
--

CREATE TABLE `attribute_options` (
  `optionId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `attributeId` int(11) NOT NULL,
  `sortOrder` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute_options`
--

INSERT INTO `attribute_options` (`optionId`, `name`, `attributeId`, `sortOrder`) VALUES
(1, 'name1', 2, '1'),
(2, 'name2', 2, '2'),
(3, 'name4', 2, '4'),
(4, 'name3', 2, '3'),
(5, 'name1', 1, '1'),
(6, 'name2', 1, '2'),
(7, 'name3', 1, '3'),
(8, 'name4', 1, '4'),
(9, 'name4', 3, '4'),
(10, 'name3', 3, '3'),
(11, 'name2', 3, '2'),
(12, 'name1', 3, '1');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `paymentMethodId` int(11) DEFAULT NULL,
  `shippingMethodId` int(11) DEFAULT NULL,
  `shippingAmount` decimal(10,2) DEFAULT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cartaddress`
--

CREATE TABLE `cartaddress` (
  `cartAddressId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `address` varchar(400) DEFAULT NULL,
  `addressType` varchar(40) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `country` varchar(40) NOT NULL,
  `zipCode` int(11) NOT NULL,
  `sameAsBilling` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `cartItemId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `basePrice` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
--

CREATE TABLE `cms_page` (
  `pageId` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `identifier` varchar(40) NOT NULL,
  `content` varchar(40) NOT NULL,
  `status` varchar(40) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_page`
--

INSERT INTO `cms_page` (`pageId`, `title`, `identifier`, `content`, `status`, `createdDate`) VALUES
(1, 'Title1', 'Indentifierq', '<p><em><strong>Dhairya Bhaveshkumar Pate', 'Enable', '2021-05-14 15:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `code` varchar(40) NOT NULL,
  `value` varchar(40) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`configId`, `groupId`, `title`, `code`, `value`, `createdDate`) VALUES
(3, 1, 'title1', 'code1', '1.00', '2021-04-28 21:03:56'),
(4, 1, 'title2', 'code2', '2.00', '2021-04-28 21:04:18'),
(5, 1, 'title3', 'code3', '3.00', '2021-04-29 11:47:39');

-- --------------------------------------------------------

--
-- Table structure for table `config_group`
--

CREATE TABLE `config_group` (
  `groupId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config_group`
--

INSERT INTO `config_group` (`groupId`, `name`, `createdDate`) VALUES
(1, 'group1', '2021-04-28 17:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `firstName` varchar(40) NOT NULL,
  `lastName` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `password` varchar(40) NOT NULL,
  `status` varchar(40) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDate` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `groupId`, `firstName`, `lastName`, `email`, `phone`, `password`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 1, 'Dhairya', 'Patel', 'dhairya762@gmail.com', '', '12345', 'Enable', '2021-05-14 19:43:51', NULL),
(2, 2, 'Bhavesh', 'Patel', 'abc@gmail.com', '', '12345', 'Enable', '2021-05-14 19:44:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `addressId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `zipCode` int(11) NOT NULL,
  `country` varchar(20) NOT NULL,
  `addressType` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`addressId`, `customerId`, `address`, `city`, `state`, `zipCode`, `country`, `addressType`) VALUES
(1, 1, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'KALAVAD(SHITALA)', 'Gujarat', 361160, 'India', 'billing'),
(2, 1, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'KALAVAD(SHITALA)', 'Gujarat', 361160, 'India', 'shipping'),
(3, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'KALAVAD(SHITALA)', 'Gujarat', 361160, 'India', 'billing'),
(4, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'KALAVAD(SHITALA)', 'Gujarat', 361160, 'India', 'shipping');

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE `customer_group` (
  `groupId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `status` varchar(40) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_group`
--

INSERT INTO `customer_group` (`groupId`, `name`, `status`, `createdDate`) VALUES
(1, 'Retailer', 'Enable', '2021-03-11 11:22:56'),
(2, 'WholeSeller', 'Enable', '2021-03-11 11:24:05'),
(6, 'Distributer', 'Enable', '2021-03-17 06:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `new_category`
--

CREATE TABLE `new_category` (
  `categoryId` int(11) UNSIGNED NOT NULL,
  `name` varchar(40) NOT NULL,
  `parentId` int(11) DEFAULT NULL,
  `pathId` varchar(40) DEFAULT NULL,
  `status` varchar(40) NOT NULL DEFAULT '1',
  `attribute2` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `new_category`
--

INSERT INTO `new_category` (`categoryId`, `name`, `parentId`, `pathId`, `status`, `attribute2`) VALUES
(3, 'Small Bed', 0, '3', 'Enable', NULL),
(4, 'LivingRoom', 3, '3=4', 'Enable', NULL),
(26, 'pqr', 0, '26', 'Enable', NULL),
(30, 'ABC', 4, '3=4=30', 'Enable', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `methodId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `code` varchar(40) NOT NULL,
  `description` varchar(40) NOT NULL,
  `status` varchar(40) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`methodId`, `name`, `code`, `description`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'COD', 'COD', 'COD', 'Enable', '2021-02-21 11:09:40', NULL),
(2, 'Net Banking', 'Net Banking', 'Net Banking', 'Enable', '2021-02-21 11:24:01', '0000-00-00 00:00:00'),
(13, 'UPI', 'UPI', 'UPI', 'Enable', '2021-04-28 10:31:00', NULL),
(15, 'Debit Card', 'Debit Card', 'Debit Card', 'Enable', '2021-04-28 10:33:00', NULL),
(16, 'Credit Card', 'Credit Card', 'Credit Card', 'Enable', '2021-04-28 10:33:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `placeorder`
--

CREATE TABLE `placeorder` (
  `placeOrderId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `customerId` varchar(40) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `paymentMethodId` int(11) NOT NULL,
  `shippingmethodId` int(11) NOT NULL,
  `shippingAmount` decimal(10,2) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `placeorder`
--

INSERT INTO `placeorder` (`placeOrderId`, `cartId`, `customerId`, `total`, `discount`, `paymentMethodId`, `shippingmethodId`, `shippingAmount`, `createdDate`) VALUES
(1, 2, '1', '100.00', '10.00', 2, 2, '100.00', '2021-05-16 18:32:17'),
(2, 1, '1', '100.00', '10.00', 13, 4, '50.00', '2021-05-18 15:17:06'),
(3, 1, '1', '100.00', '10.00', 13, 4, '50.00', '2021-05-18 15:18:24'),
(4, 1, '1', '100.00', '10.00', 13, 4, '50.00', '2021-05-18 15:18:49'),
(5, 1, '1', '100.00', '10.00', 13, 4, '50.00', '2021-05-18 15:19:20'),
(6, 1, '1', '100.00', '10.00', 13, 4, '50.00', '2021-05-18 15:19:40'),
(7, 1, '1', '100.00', '10.00', 13, 4, '50.00', '2021-05-18 15:20:20'),
(8, 1, '1', '100.00', '10.00', 13, 4, '50.00', '2021-05-18 15:31:13'),
(9, 1, '1', '100.00', '10.00', 13, 4, '50.00', '2021-05-18 15:31:41'),
(10, 1, '1', '100.00', '10.00', 13, 4, '50.00', '2021-05-18 15:33:03'),
(11, 1, '1', '100.00', '10.00', 13, 4, '50.00', '2021-05-18 15:33:29'),
(12, 1, '1', '100.00', '10.00', 13, 4, '50.00', '2021-05-18 15:37:33'),
(13, 1, '1', '100.00', '10.00', 13, 4, '50.00', '2021-05-18 15:37:58'),
(14, 1, '1', '100.00', '10.00', 13, 4, '50.00', '2021-05-18 15:38:36'),
(15, 1, '1', '100.00', '10.00', 13, 4, '50.00', '2021-05-18 15:39:04'),
(16, 1, '1', '100.00', '10.00', 13, 4, '50.00', '2021-05-18 15:39:18');

-- --------------------------------------------------------

--
-- Table structure for table `placeorderaddress`
--

CREATE TABLE `placeorderaddress` (
  `placeOrderAddressId` int(11) NOT NULL,
  `placeOrderId` int(11) NOT NULL,
  `address` varchar(400) NOT NULL,
  `addressType` varchar(40) NOT NULL,
  `city` varchar(40) NOT NULL,
  `state` varchar(40) NOT NULL,
  `country` varchar(40) NOT NULL,
  `zipCode` int(11) NOT NULL,
  `sameAsBilling` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `placeorderaddress`
--

INSERT INTO `placeorderaddress` (`placeOrderAddressId`, `placeOrderId`, `address`, `addressType`, `city`, `state`, `country`, `zipCode`, `sameAsBilling`) VALUES
(1, 1, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'billing', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 0),
(2, 1, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'shipping', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 1),
(3, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'billing', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 0),
(4, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'shipping', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 1),
(5, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'billing', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 0),
(6, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'shipping', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 1),
(7, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'billing', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 0),
(8, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'shipping', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 1),
(9, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'billing', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 0),
(10, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'shipping', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 1),
(11, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'billing', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 0),
(12, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'shipping', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 1),
(13, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'billing', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 0),
(14, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'shipping', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 1),
(15, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'billing', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 0),
(16, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'shipping', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 1),
(17, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'billing', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 0),
(18, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'shipping', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 1),
(19, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'billing', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 0),
(20, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'shipping', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 1),
(21, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'billing', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 0),
(22, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'shipping', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 1),
(23, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'billing', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 0),
(24, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'shipping', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 1),
(25, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'billing', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 0),
(26, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'shipping', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 1),
(27, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'billing', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 0),
(28, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'shipping', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 1),
(29, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'billing', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 0),
(30, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'shipping', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 1),
(31, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'billing', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 0),
(32, 2, 'SONI SHERI,OPP. JAIN DERASAR MAIN BAJAR KALAVAD', 'shipping', 'KALAVAD(SHITALA)', 'Gujarat', 'India', 361160, 1);

-- --------------------------------------------------------

--
-- Table structure for table `placeorderitem`
--

CREATE TABLE `placeorderitem` (
  `placeOrderItemId` int(11) NOT NULL,
  `placeOrderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `basePrice` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `placeorderitem`
--

INSERT INTO `placeorderitem` (`placeOrderItemId`, `placeOrderId`, `productId`, `quantity`, `basePrice`, `discount`, `price`) VALUES
(1, 1, 1, 1, '100.00', '10.00', '100.00'),
(2, 2, 1, 1, '100.00', '10.00', '100.00'),
(3, 2, 1, 1, '100.00', '10.00', '100.00'),
(4, 2, 1, 1, '100.00', '10.00', '100.00'),
(5, 2, 1, 1, '100.00', '10.00', '100.00'),
(6, 2, 1, 1, '100.00', '10.00', '100.00'),
(7, 2, 1, 1, '100.00', '10.00', '100.00'),
(8, 2, 1, 1, '100.00', '10.00', '100.00'),
(9, 2, 1, 1, '100.00', '10.00', '100.00'),
(10, 2, 1, 1, '100.00', '10.00', '100.00'),
(11, 2, 1, 1, '100.00', '10.00', '100.00'),
(12, 2, 1, 1, '100.00', '10.00', '100.00'),
(13, 2, 1, 1, '100.00', '10.00', '100.00'),
(14, 2, 1, 1, '100.00', '10.00', '100.00'),
(15, 2, 1, 1, '100.00', '10.00', '100.00'),
(16, 2, 1, 1, '100.00', '10.00', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `sku` varchar(40) NOT NULL,
  `name` varchar(40) NOT NULL,
  `price` double NOT NULL,
  `discount` double NOT NULL,
  `quantity` float NOT NULL,
  `description` varchar(40) NOT NULL,
  `status` varchar(40) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp(),
  `attr1` varchar(255) DEFAULT NULL,
  `attr2` varchar(255) DEFAULT NULL,
  `attr3` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `sku`, `name`, `price`, `discount`, `quantity`, `description`, `status`, `createdDate`, `attr1`, `attr2`, `attr3`) VALUES
(1, 'p1', 'product1', 100, 10, 1, 'Good.', 'Enable', '2021-04-24 22:37:47', 'name1', 'name1', 'name1'),
(2, 'p2', 'product2', 50, 5, 20, 'Very Good.', 'Enable', '2021-04-24 22:40:13', 'name2', 'name2', 'name2');

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `product_group_price`
--

CREATE TABLE `product_group_price` (
  `entityId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `customerGroupId` int(11) NOT NULL,
  `groupPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_group_price`
--

INSERT INTO `product_group_price` (`entityId`, `productId`, `customerGroupId`, `groupPrice`) VALUES
(1, 1, 1, '100.00'),
(2, 1, 2, '90.00'),
(3, 1, 6, '80.00'),
(4, 2, 1, '100.00'),
(5, 2, 2, '90.00'),
(6, 2, 6, '80.00');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `imageId` int(11) NOT NULL,
  `productId` int(11) NOT NULL DEFAULT 0,
  `image` varchar(100) NOT NULL,
  `label` varchar(255) NOT NULL,
  `small` tinyint(4) NOT NULL,
  `thumb` tinyint(4) DEFAULT 0,
  `base` tinyint(4) NOT NULL DEFAULT 0,
  `gallery` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`imageId`, `productId`, `image`, `label`, `small`, `thumb`, `base`, `gallery`) VALUES
(1, 1, 'Upload/Photo1.jpg', 'Photo1.jpg', 0, 0, 1, 1),
(2, 1, 'Upload/Photo2.jpg', 'Photo2.jpg', 0, 1, 0, 1),
(3, 1, 'Upload/Photo3.jpg', 'Photo3.jpg', 1, 0, 0, 1),
(4, 2, 'Upload/Photo1.jpg', 'Photo1.jpg', 0, 1, 0, 1),
(5, 2, 'Upload/Photo2.jpg', 'Photo2.jpg', 0, 0, 1, 1),
(8, 2, 'Upload/Photo3.jpg', 'Photo3.jpg', 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `questionId` int(11) NOT NULL,
  `question` text NOT NULL,
  `status` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`questionId`, `question`, `status`) VALUES
(1, 'q11', 'Enable'),
(2, 'q2', 'Enable'),
(5, 'q3', 'Enable'),
(7, 'q4', 'Enable'),
(9, 'q5', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `questionoption`
--

CREATE TABLE `questionoption` (
  `optionId` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `optionName` varchar(400) NOT NULL,
  `is_right_choice` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questionoption`
--

INSERT INTO `questionoption` (`optionId`, `questionId`, `optionName`, `is_right_choice`) VALUES
(2, 1, 'B', 1),
(3, 1, 'C', 0),
(4, 1, 'D', 0),
(5, 2, 'D', 0),
(6, 2, 'C', 0),
(7, 2, 'B', 1),
(8, 2, 'A', 0),
(13, 1, 'A', 0),
(18, 5, 'A', 0),
(19, 5, 'B', 0),
(20, 5, 'C', 1),
(21, 5, 'D', 0),
(26, 7, 'A', 0),
(27, 7, 'B', 1),
(28, 7, 'C', 0),
(29, 7, 'D', 0),
(34, 9, 'A', 0),
(35, 9, 'B', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `methodId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `code` varchar(40) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `description` varchar(40) NOT NULL,
  `status` varchar(40) NOT NULL,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`methodId`, `name`, `code`, `amount`, `description`, `status`, `createdDate`) VALUES
(2, 'Platinum', 'Platinum', '100', '1 day delivery', 'Enable', '2021-02-21 12:11:07'),
(4, 'Gold', 'Gold', '50', '3 day delivery.', 'Enable', '2021-02-22 09:54:47'),
(5, 'Silver', 'Silver', '0', '7 day delivery', 'Enable', '2021-02-22 10:11:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attributeId`);

--
-- Indexes for table `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD PRIMARY KEY (`optionId`),
  ADD KEY `attributeId` (`attributeId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `cartaddress`
--
ALTER TABLE `cartaddress`
  ADD PRIMARY KEY (`cartAddressId`),
  ADD KEY `cartId` (`cartId`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`cartItemId`),
  ADD KEY `cartId` (`cartId`);

--
-- Indexes for table `cms_page`
--
ALTER TABLE `cms_page`
  ADD PRIMARY KEY (`pageId`),
  ADD UNIQUE KEY `identifier` (`identifier`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configId`),
  ADD KEY `groupId` (`groupId`);

--
-- Indexes for table `config_group`
--
ALTER TABLE `config_group`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `groupId` (`groupId`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `customerId` (`customerId`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `new_category`
--
ALTER TABLE `new_category`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `parentId` (`parentId`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `placeorder`
--
ALTER TABLE `placeorder`
  ADD PRIMARY KEY (`placeOrderId`);

--
-- Indexes for table `placeorderaddress`
--
ALTER TABLE `placeorderaddress`
  ADD PRIMARY KEY (`placeOrderAddressId`),
  ADD KEY `placeOrderId` (`placeOrderId`);

--
-- Indexes for table `placeorderitem`
--
ALTER TABLE `placeorderitem`
  ADD PRIMARY KEY (`placeOrderItemId`),
  ADD KEY `placeOrderId` (`placeOrderId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_group_price`
--
ALTER TABLE `product_group_price`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `productId` (`productId`),
  ADD KEY `customerGroupId` (`customerGroupId`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`questionId`);

--
-- Indexes for table `questionoption`
--
ALTER TABLE `questionoption`
  ADD PRIMARY KEY (`optionId`),
  ADD KEY `questionId` (`questionId`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`methodId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attribute_options`
--
ALTER TABLE `attribute_options`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cartaddress`
--
ALTER TABLE `cartaddress`
  MODIFY `cartAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cms_page`
--
ALTER TABLE `cms_page`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `config_group`
--
ALTER TABLE `config_group`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `new_category`
--
ALTER TABLE `new_category`
  MODIFY `categoryId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `placeorder`
--
ALTER TABLE `placeorder`
  MODIFY `placeOrderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `placeorderaddress`
--
ALTER TABLE `placeorderaddress`
  MODIFY `placeOrderAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `placeorderitem`
--
ALTER TABLE `placeorderitem`
  MODIFY `placeOrderItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product_group_price`
--
ALTER TABLE `product_group_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `questionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `questionoption`
--
ALTER TABLE `questionoption`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_options`
--
ALTER TABLE `attribute_options`
  ADD CONSTRAINT `attribute_options_ibfk_1` FOREIGN KEY (`attributeId`) REFERENCES `attribute` (`attributeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cartaddress`
--
ALTER TABLE `cartaddress`
  ADD CONSTRAINT `cartaddress_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `cartitem_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `config`
--
ALTER TABLE `config`
  ADD CONSTRAINT `config_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `config_group` (`groupId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `customer_group` (`groupId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `placeorderaddress`
--
ALTER TABLE `placeorderaddress`
  ADD CONSTRAINT `placeorderaddress_ibfk_1` FOREIGN KEY (`placeOrderId`) REFERENCES `placeorder` (`placeOrderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `placeorderitem`
--
ALTER TABLE `placeorderitem`
  ADD CONSTRAINT `placeorderitem_ibfk_1` FOREIGN KEY (`placeOrderId`) REFERENCES `placeorder` (`placeOrderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_group_price`
--
ALTER TABLE `product_group_price`
  ADD CONSTRAINT `product_group_price_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_group_price_ibfk_2` FOREIGN KEY (`customerGroupId`) REFERENCES `customer_group` (`groupId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questionoption`
--
ALTER TABLE `questionoption`
  ADD CONSTRAINT `questionoption_ibfk_1` FOREIGN KEY (`questionId`) REFERENCES `question` (`questionId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
