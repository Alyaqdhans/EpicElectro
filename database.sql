-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2023 at 01:37 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epicelectro`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryCode` int(11) NOT NULL COMMENT 'Category Code',
  `categoryDes` varchar(100) NOT NULL COMMENT 'Category Description'
);

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryCode`, `categoryDes`) VALUES
(1, 'Laptops'),
(2, 'Smartphones'),
(3, 'Headphones'),
(4, 'Cameras');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cId` int(10) NOT NULL COMMENT 'Customer ID',
  `cName` varchar(50) NOT NULL COMMENT 'Customer Name',
  `password` varchar(50) NOT NULL COMMENT 'Password',
  `email` varchar(100) NOT NULL COMMENT 'Email',
  `registerDate` date NOT NULL COMMENT 'Register Date',
  `lastLogin` date NOT NULL COMMENT 'Last Login',
  `cAddress` varchar(100) NOT NULL COMMENT 'Customer Address',
  `cType` varchar(1) NOT NULL COMMENT 'Customer Type',
  `phoneNumber` int(8) NOT NULL COMMENT 'Customer Phone Number'
);

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cId`, `cName`, `password`, `email`, `registerDate`, `lastLogin`, `cAddress`, `cType`, `phoneNumber`) VALUES
(1, 'John Doe', '*FB6E1F205D675BC29B052DB14CCEFE7759C5FF7E', 'john.doe@email.com', '2020-01-01', '2023-11-14', '123 Street', 'A', 93215274),
(2, 'Jane Smith', '*FB6E1F205D675BC29B052DB14CCEFE7759C5FF7E', 'jane.smith@email.com', '2020-01-01', '2023-11-10', '456 Avenue', 'N', 48774964),
(3, 'Alyaqdhan Zahran', '*196BDEDE2AE4F84CA44C47D54D78478C7E2BD7B7', 'alyaqdhan690s@gmail.com', '2023-11-10', '2023-11-11', 'Nizwa', 'A', 94028288),
(8, 'Hassan Ambusaidi', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', 'hassanjamal428@gmail.com', '2023-11-11', '2023-11-11', 'Nizwa', 'N', 95322022),
(11, 'Mohamed Ali', '*23AE809DDACAF96AF0FD78ED04B6A265E05AA257', 'ali@gmail.com', '2023-11-12', '2023-11-12', 'firq', 'N', 98787878);

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `dId` int(11) NOT NULL COMMENT 'Delivery ID',
  `company_name` varchar(50) NOT NULL COMMENT 'Company Name',
  `dPhone` int(8) NOT NULL COMMENT 'Delivery Phone Number',
  `orderId` int(11) NOT NULL COMMENT 'Order ID (FK)'
);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `iCode` int(11) NOT NULL COMMENT 'Item Code',
  `iCategoryCode` int(11) NOT NULL COMMENT 'Item Category Code(FK)',
  `iDesc` text NOT NULL COMMENT 'Item Title',
  `iComment` varchar(200) NOT NULL COMMENT 'Item Description',
  `iQty` int(11) NOT NULL COMMENT 'Item Quantity',
  `iCost` int(11) NOT NULL COMMENT 'Item Cost',
  `iPrice` int(11) NOT NULL COMMENT 'Item Price',
  `iSupplierId` int(11) NOT NULL COMMENT 'Item Supplier Id(FK)',
  `iLastPurchasedDate` date NOT NULL COMMENT 'Item Last Purchased Date',
  `iBrand` varchar(10) NOT NULL COMMENT 'Item Brand'
);

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`iCode`, `iCategoryCode`, `iDesc`, `iComment`, `iQty`, `iCost`, `iPrice`, `iSupplierId`, `iLastPurchasedDate`, `iBrand`) VALUES
(101, 1, 'High-Performance Laptop', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Odio praesentium, quas aut dolorem doloremque perspiciatis amet optio fuga eaque voluptatibus iure, eligendi omnis inventore, architecto solut', 0, 800, 1200, 1, '2023-09-15', 'Samsung'),
(102, 2, 'Flagship Smartphone', '', 100, 600, 900, 2, '2023-09-20', 'Xaomi'),
(103, 3, 'Noise-Canceling Headphones', '', 200, 150, 250, 1, '2023-09-18', 'Apple'),
(104, 4, 'Digital Camera with Lens Kit', '', 30, 1200, 1800, 2, '2023-09-10', 'Sony'),
(105, 1, 'High-Performance Laptop', '', 50, 800, 1200, 1, '2023-09-15', 'Samsung'),
(106, 2, 'Flagship Smartphone', '', 100, 600, 900, 2, '2023-09-20', 'Xaomi'),
(107, 3, 'Noise-Canceling Headphones', '', 200, 150, 250, 1, '2023-09-18', 'Apple'),
(108, 4, 'Digital Camera with Lens Kit', '', 30, 1200, 1800, 2, '2023-09-10', 'Sony');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL COMMENT 'Order ID',
  `cId` int(10) NOT NULL COMMENT 'Customer ID (FK)',
  `orderDate` date NOT NULL COMMENT 'Order Date',
  `totalAmount` int(11) NOT NULL COMMENT 'Total Amount'
);

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `cId`, `orderDate`, `totalAmount`) VALUES
(1001, 1, '2023-10-05', 2400),
(1002, 2, '2023-10-08', 1150);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `orderID` int(11) NOT NULL COMMENT 'Order ID (FK)',
  `iCode` int(11) NOT NULL COMMENT 'Item Code (FK)',
  `quantity` int(11) NOT NULL COMMENT 'Quantity'
);

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`orderID`, `iCode`, `quantity`) VALUES
(1001, 101, 2),
(1001, 103, 1),
(1002, 102, 1),
(1002, 104, 1);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `sId` int(11) NOT NULL COMMENT 'Supplier Id',
  `sName` varchar(50) NOT NULL COMMENT 'Supplier Name',
  `sAddress` varchar(100) NOT NULL COMMENT 'Supplier Address',
  `sPhone` int(8) NOT NULL COMMENT 'Supplier Phone Number',
  `sEmail` varchar(100) NOT NULL COMMENT 'Supplier Email'
);

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`sId`, `sName`, `sAddress`, `sPhone`, `sEmail`) VALUES
(1, 'ElectroTech Suppliers', '123 Main Street', 69535679, 'info@electrotech.com'),
(2, 'Gadget World', '456 Tech Avenue', 35855123, 'sales@gadgetworld.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryCode`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cId`);

--
-- Indexes for table `delivery`
--
ALTER TABLE `delivery`
  ADD PRIMARY KEY (`dId`),
  ADD KEY `FK_Delivery_Orders` (`orderId`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`iCode`),
  ADD KEY `FK_Items_Category` (`iCategoryCode`),
  ADD KEY `FK_Items_Suppliers` (`iSupplierId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `FK_Orders_Customers` (`cId`) USING BTREE;

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`orderID`,`iCode`),
  ADD KEY `FK_OrderItems_Items` (`iCode`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`sId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryCode` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Category Code', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cId` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Customer ID', AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `dId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Delivery ID';

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `iCode` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Item Code', AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Order ID', AUTO_INCREMENT=1003;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `sId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Supplier Id', AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `delivery`
--
ALTER TABLE `delivery`
  ADD CONSTRAINT `FK_Delivery_Orders` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `FK_Items_Category` FOREIGN KEY (`iCategoryCode`) REFERENCES `categories` (`categoryCode`),
  ADD CONSTRAINT `FK_Items_Suppliers` FOREIGN KEY (`iSupplierId`) REFERENCES `suppliers` (`sId`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_Orders_Customers` FOREIGN KEY (`cId`) REFERENCES `customers` (`cId`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `FK_OrderItems_Items` FOREIGN KEY (`iCode`) REFERENCES `items` (`iCode`),
  ADD CONSTRAINT `FK_OrderItems_Orders` FOREIGN KEY (`orderID`) REFERENCES `orders` (`orderId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
