-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2023 at 10:40 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
(1, 'Computer'),
(2, 'Smartphone'),
(3, 'Headphone'),
(4, 'Camera'),
(5, 'Monitor'),
(6, 'Tablet'),
(7, 'Accessory'),
(8, 'Smart Device'),
(9, 'Wearable'),
(10, 'Network'),
(11, 'Component'),
(12, 'Other');

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
  `lastLogin` datetime NOT NULL COMMENT 'Last Login',
  `meridiem` varchar(2) NOT NULL COMMENT 'AM / PM',
  `cAddress` varchar(100) NOT NULL COMMENT 'Customer Address',
  `cType` varchar(1) NOT NULL COMMENT 'Customer Type',
  `phoneNumber` int(8) NOT NULL COMMENT 'Customer Phone Number',
  `Active` varchar(10) NOT NULL DEFAULT 'active'
);

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cId`, `cName`, `password`, `email`, `registerDate`, `lastLogin`, `meridiem`, `cAddress`, `cType`, `phoneNumber`, `Active`) VALUES
(1, 'Admin', '*196BDEDE2AE4F84CA44C47D54D78478C7E2BD7B7', 'admin@email.com', '2020-01-01', '2023-11-30 00:00:00', 'AM', '123 Street', 'A', 93215274, 'active'),
(2, 'Normal', '*196BDEDE2AE4F84CA44C47D54D78478C7E2BD7B7', 'normal@email.com', '2020-01-01', '2023-11-17 00:00:00', 'AM', '456 Avenue', 'N', 48774964, 'active'),
(3, 'Alyaqdhan Zahran Alazri', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', 's26s2025@nct.edu.om', '2023-11-10', '2023-12-17 00:00:00', 'AM', 'Nizwa', 'A', 94028288, 'active'),
(4, 'Hassan Ambusaidi', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', 's26s1969@nct.edu.om', '2023-11-11', '2023-11-29 00:00:00', 'AM', 'Nizwa', 'A', 95322022, 'active'),
(5, 'Abdulrahman Alriyami', '*84AAC12F54AB666ECFC2A83C676908C8BBC381B1', 's76s1937@nct.edu.om', '2023-11-12', '2023-11-12 00:00:00', 'AM', 'firq', 'A', 98787878, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `delivery`
--

CREATE TABLE `delivery` (
  `dId` int(11) NOT NULL COMMENT 'Delivery ID',
  `company_name` varchar(50) NOT NULL COMMENT 'Company Name',
  `dPhone` int(8) NOT NULL COMMENT 'Delivery Phone Number',
  `Active` varchar(10) NOT NULL DEFAULT 'active'
);

--
-- Dumping data for table `delivery`
--

INSERT INTO `delivery` (`dId`, `company_name`, `dPhone`, `Active`) VALUES
(1, 'Aramex', 24473000, 'active'),
(2, 'DHL', 25432033, 'active'),
(3, 'FedEx', 80070112, 'active'),
(4, 'UPS', 22351800, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `iCode` int(11) NOT NULL COMMENT 'Item Code',
  `iCategoryCode` int(11) NOT NULL COMMENT 'Item Category Code(FK)',
  `iDesc` varchar(50) NOT NULL COMMENT 'Item Title',
  `iComment` varchar(300) NOT NULL COMMENT 'Item Description',
  `iQty` int(11) NOT NULL COMMENT 'Item Quantity',
  `iSold` int(5) NOT NULL COMMENT 'Item Sales',
  `iCost` int(11) NOT NULL COMMENT 'Item Cost',
  `iPrice` int(11) NOT NULL COMMENT 'Item Price',
  `iSupplierId` int(11) NOT NULL COMMENT 'Item Supplier Id(FK)',
  `iLastPurchasedDate` date NOT NULL COMMENT 'Item Last Purchased Date',
  `iBrand` varchar(10) NOT NULL COMMENT 'Item Brand',
  `img_ext` varchar(10) NOT NULL COMMENT 'Image Extension',
  `Active` varchar(10) NOT NULL DEFAULT 'active'
);

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`iCode`, `iCategoryCode`, `iDesc`, `iComment`, `iQty`, `iSold`, `iCost`, `iPrice`, `iSupplierId`, `iLastPurchasedDate`, `iBrand`, `img_ext`, `Active`) VALUES
(110, 2, 'iPhone 15 Pro Max', 'The Latest iPhone', 0, 0, 600, 618, 4, '2023-11-16', 'Apple', 'jpg', 'active'),
(111, 2, 'iPhone 14 Pro Max', '', 133, 16, 480, 496, 4, '2023-12-01', 'Apple', 'jpg', 'active'),
(112, 2, 'Galaxy S22', '', 15, 4, 195, 207, 4, '2023-11-19', 'Samsung', 'jpg', 'active'),
(113, 2, 'P30', '', 14, 4, 135, 147, 4, '2023-11-19', 'Huawei', 'jpg', 'active'),
(114, 2, 'Galaxy S23', '', 2, 5, 195, 209, 4, '2023-11-20', 'Samsung', 'jpg', 'active'),
(115, 2, 'Z Fold 3', '', 19, 1, 295, 303, 4, '2023-11-16', 'Samsung', 'jpg', 'active'),
(116, 2, 'Galaxy A54', '', 19, 1, 110, 125, 4, '2023-11-16', 'Samsung', 'jpg', 'active'),
(117, 2, 'Z Flip 5', '', 4, 7, 310, 321, 4, '2023-11-20', 'Samsung', 'jpg', 'active'),
(118, 2, 'Noza Y90', '', 20, 0, 50, 66, 4, '2023-11-16', 'Huawei', 'jpg', 'active'),
(119, 2, 'honor x7', '', 14, 2, 65, 75, 1, '2023-11-29', 'Huawei', 'jpg', 'active'),
(120, 2, 'Galaxy A40s', '', 20, 0, 35, 41, 4, '2023-11-16', 'Samsung', 'jpg', 'active'),
(121, 2, 'OnePlus 11', '', 20, 0, 280, 293, 4, '2023-11-16', 'OnePlus', 'jpg', 'active'),
(122, 2, 'Poco X5', '', 20, 0, 95, 107, 4, '2023-11-16', 'Xiaomi', 'jpg', 'active'),
(123, 2, 'Redmi Note 11', '', 20, 0, 55, 62, 4, '2023-11-16', 'Xiaomi', 'jpg', 'active'),
(124, 2, 'Y9 Prime', '', 20, 0, 35, 41, 4, '2023-11-16', 'Huawei', 'jpg', 'active'),
(125, 2, '13T Pro', '', 20, 0, 235, 240, 4, '2023-11-16', 'Xiaomi', 'jpg', 'active'),
(126, 1, 'ROG Zephyrus M16', '', 20, 0, 710, 727, 4, '2023-11-16', 'ASUS', 'jpg', 'active'),
(127, 1, 'Legion 7', '', 17, 3, 430, 444, 4, '2023-11-16', 'Lenovo', 'jpg', 'active'),
(128, 1, 'Macbook Pro 16', '', 20, 0, 680, 693, 4, '2023-11-16', 'Apple', 'jpg', 'active'),
(129, 1, 'Victus', '', 20, 0, 270, 293, 4, '2023-11-16', 'HP', 'jpg', 'active'),
(130, 1, 'GF63 Thin', '', 20, 0, 230, 245, 4, '2023-11-16', 'MSI', 'jpg', 'active'),
(131, 1, 'Nitro 5', '', 20, 0, 440, 462, 4, '2023-11-16', 'Acer', 'jpg', 'active'),
(132, 1, 'Vivobook 14', '', 20, 0, 200, 208, 4, '2023-11-16', 'Lenovo', 'jpg', 'active'),
(133, 5, 'Odyssey GS 27', '', 20, 0, 70, 88, 4, '2023-11-16', 'Samsung', 'jpg', 'active'),
(134, 5, 'Neo G8', '', 20, 0, 370, 382, 4, '2023-11-16', 'Samsung', 'jpg', 'active'),
(135, 5, 'E2222HS', '', 20, 0, 30, 44, 4, '2023-11-16', 'Dell', 'jpg', 'active'),
(136, 5, 'V20 HD', '', 20, 0, 40, 50, 4, '2023-11-16', 'HP', 'jpg', 'active'),
(137, 5, 'G24C4 E2', '', 20, 0, 55, 61, 4, '2023-11-16', 'MSI', 'jpg', 'active'),
(138, 6, 'iPad 10th', '', 20, 0, 240, 246, 4, '2023-11-16', 'Apple', 'jpg', 'active'),
(139, 6, 'Surface Go3', '', 20, 0, 200, 209, 4, '2023-11-16', 'Microsoft', 'jpg', 'active'),
(140, 6, 'Tab A7 lite', '', 20, 0, 35, 41, 4, '2023-11-16', 'Samsung', 'jpg', 'active'),
(141, 6, 'Tab A8', '', 20, 0, 75, 80, 4, '2023-11-16', 'Samsung', 'jpg', 'active'),
(142, 4, 'Sony A6000', 'Sonys latest 24.3-megapixel Exmor® HD APS CMOS sensor; Advanced Fast Hybrid autofocus; SVGA Tru-Finder™. 16-50mm zoom lens included.', 5, 0, 1000, 1200, 4, '2023-11-19', 'Sony', 'jpg', 'active'),
(143, 4, 'Sony Alpha a7 III', '24MP Full-Frame Exmor R BSI CMOS Sensor | UHD 4K30p Video with HLG & S-Log3 Gammas | 2.36m-Dot Tru-Finder OLED EVF | 3.0\" 922k-Dot Tilting Touchscreen LCD | FE 28-70mm f/3.5-5.6 OSS Lens', 2, 0, 1300, 1500, 4, '2023-11-19', 'Sony', 'jpg', 'active'),
(144, 3, 'AirPods Max Space Gray', 'Requires AirPods Max with the latest version of software, and iPhone and iPod touch models with the latest version of iOS; iPad models with the latest version of iPadOS; Apple Watch models with the latest version of watchOS; Mac models with the latest version of macOS; or Apple TV models with the la', 0, 1, 450, 500, 4, '2023-11-19', 'Apple', 'jpg', 'active'),
(145, 1, 'new', '', 0, 0, 0, 0, 4, '0000-00-00', '', 'jpg', 'disabled');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL COMMENT 'Order ID',
  `cId` int(10) NOT NULL COMMENT 'Customer ID (FK)',
  `dId` int(11) NOT NULL COMMENT 'Delivery ID (FK)',
  `orderDate` date NOT NULL COMMENT 'Order Date',
  `totalPrice` int(11) NOT NULL COMMENT 'Total Order Items Price'
);

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `cId`, `dId`, `orderDate`, `totalPrice`) VALUES
(1001, 1, 2, '2023-10-05', 2400),
(1002, 2, 1, '2023-10-06', 1150),
(1003, 3, 1, '2023-10-08', 1150),
(1004, 3, 3, '2023-10-08', 21150),
(1005, 4, 2, '2023-11-29', 1332);

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
(1001, 136, 1),
(1002, 112, 1),
(1002, 141, 1),
(1003, 125, 6),
(1003, 138, 2),
(1003, 144, 1),
(1004, 112, 1),
(1004, 115, 5),
(1004, 123, 1),
(1005, 127, 3);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `sId` int(11) NOT NULL COMMENT 'Supplier Id',
  `sName` varchar(50) NOT NULL COMMENT 'Supplier Name',
  `sAddress` varchar(100) NOT NULL COMMENT 'Supplier Address',
  `sPhone` int(8) NOT NULL COMMENT 'Supplier Phone Number',
  `sEmail` varchar(100) NOT NULL COMMENT 'Supplier Email',
  `Active` varchar(10) NOT NULL DEFAULT 'active'
);

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`sId`, `sName`, `sAddress`, `sPhone`, `sEmail`, `Active`) VALUES
(1, 'SharafDG', 'Shop No-F38, Level 1 Muscat Grand mall, Al Khuwair, Muscat, Oman.', 80066753, 'Feedback@om.sharafdg.com', 'active'),
(2, 'Gadgets', 'Mall of Oman, Mall of Muscat, Muscat Grand Mall, Avenues Mall, Al Araimi Boulevard.', 99349886, 'info@gadgetsoman.com', 'active'),
(3, 'Bahwan', 'P.O.Box 169, Postal Code 100,\r\nMuscat. Sultanate of Oman.', 24650000, 'info@suhailbahwangroup.com', 'active'),
(4, 'eXtra', 'Way3703 - Block 237 Near Sultan Qaboos Grand Mosque Al Gubrah Al Janubi, 1', 80077880, 'customerservice.os1@extra.com', 'active');

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
  ADD PRIMARY KEY (`dId`);

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
  ADD KEY `FK_Orders_Customers` (`cId`) USING BTREE,
  ADD KEY `FK_Orders_Delivery` (`dId`);

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
  MODIFY `categoryCode` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Category Code', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `cId` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Customer ID', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `delivery`
--
ALTER TABLE `delivery`
  MODIFY `dId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Delivery ID', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `iCode` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Item Code', AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Order ID', AUTO_INCREMENT=1006;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `sId` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Supplier Id', AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

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
  ADD CONSTRAINT `FK_Orders_Customers` FOREIGN KEY (`cId`) REFERENCES `customers` (`cId`),
  ADD CONSTRAINT `FK_Orders_Delivery` FOREIGN KEY (`dId`) REFERENCES `delivery` (`dId`);

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
