-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 07, 2021 at 10:23 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test3`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2021_02_10_082824_create_products_table', 2),
(4, '2021_02_10_162541_create_product_types_table', 2),
(5, '2021_02_13_084650_add_coloum_address', 2),
(6, '2021_02_13_085955_add_coloum_address', 3),
(7, '2021_02_13_090121_add_coloum_address', 4),
(8, '2021_02_13_091609_add_coloum_users', 5),
(9, '2021_02_13_092200_add_coloum_users', 6),
(10, '2021_02_16_041719_add_coloum_users_name', 7);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderID` int(11) NOT NULL,
  `statusID` int(1) DEFAULT NULL,
  `id` bigint(20) UNSIGNED DEFAULT NULL,
  `orderDate` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderID`, `statusID`, `id`, `orderDate`, `created_at`, `updated_at`) VALUES
(44, 2, 31, '2021-03-04 17:00:00', NULL, NULL),
(45, 2, 31, '2021-03-04 17:00:00', NULL, NULL),
(46, 1, 57, '2021-03-04 17:00:00', NULL, NULL),
(47, 2, 60, '2021-03-04 17:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `OrderDetailID` int(11) NOT NULL,
  `Quantity` int(10) DEFAULT NULL,
  `Price` float DEFAULT NULL,
  `ProductID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`OrderDetailID`, `Quantity`, `Price`, `ProductID`, `orderID`, `updated_at`, `created_at`) VALUES
(104, 5, 3000, 4, 44, NULL, NULL),
(105, 5, 2000, 11, 44, NULL, NULL),
(106, 3, 2000, 104, 45, NULL, NULL),
(107, 3, 2500, 101, 45, NULL, NULL),
(108, 5, 6500, 100, 45, NULL, NULL),
(109, 2, 3000, 4, 46, NULL, NULL),
(110, 10, 3000, 4, 47, NULL, NULL),
(111, 2, 3500, 12, 47, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('admin@gmail.com', '$2y$10$WPbPMUH2ED8BihRW7YPNrOiFQ93BNU2D5DryLqzVsn9P3fuLjhoM6', '2021-02-16 00:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `PaymentDate` timestamp NULL DEFAULT NULL,
  `price` float DEFAULT NULL,
  `comment` varchar(500) DEFAULT NULL,
  `imageFileName` varchar(100) DEFAULT NULL,
  `orderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`PaymentID`, `PaymentDate`, `price`, `comment`, `imageFileName`, `orderID`) VALUES
(41, '2021-03-04 17:00:00', 25000, NULL, 'images.jpg', 44),
(42, '2021-03-04 17:00:00', 46000, NULL, 'images.jpg', 45),
(43, '2021-03-04 17:00:00', 6000, NULL, 'images.jpg', 46),
(44, '2021-03-04 17:00:00', 37000, NULL, 'images.jpg', 47);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` int(11) NOT NULL,
  `ProductName` varchar(100) NOT NULL,
  `Quantity` int(5) NOT NULL,
  `Price` float NOT NULL,
  `ProductDetail` varchar(500) DEFAULT NULL,
  `ProductImage` varchar(100) DEFAULT NULL,
  `ProductTypeID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ProductSize` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ProductID`, `ProductName`, `Quantity`, `Price`, `ProductDetail`, `ProductImage`, `ProductTypeID`, `created_at`, `updated_at`, `ProductSize`) VALUES
(4, 'Airmax', 86, 3000, 'good', '8585788.png', 2, '2021-02-10 02:19:15', '2021-03-04 21:16:15', 26),
(11, 'authentic', 97, 2000, 'goodgood', '1811505559.png', 1, '2021-02-13 01:58:10', '2021-03-04 21:02:11', 28.5),
(12, 'jordan', 101, 3500, 'good', '245797465.png', 2, '2021-02-15 09:47:01', '2021-03-04 21:16:15', 30),
(16, 'jordan-off-white', 104, 3500, 'ใส่แล้วดูดีมีสไตล์', '904713555.png', 2, NULL, '2021-02-28 01:25:22', 42),
(44, 'NMD-R1', 105, 6700, 'โคตรเท่โคตรมา', '1179626671.png', 3, '2021-02-28 01:34:04', '2021-02-28 01:34:04', 42.5),
(77, 'Van-old-skool', 106, 2300, 'โคตรเท่โคตรมา', '177337093.png', 1, '2021-03-01 01:10:19', '2021-03-01 01:10:19', 42.5),
(88, 'All-Star', 107, 2300, 'โคตรเท่โคตรมา', '1705347358.png', 4, '2021-02-28 01:35:09', '2021-02-28 01:35:09', 43.5),
(98, 'Jackpurcell', 107, 2700, 'โคตรเท่โคตรมา', '2139655286.png', 4, '2021-02-28 01:23:47', '2021-02-28 01:23:47', 32),
(99, 'Yeezy', 108, 8000, 'โคตรเท่โคตรมา', '353660226.png', 3, '2021-02-28 00:10:37', '2021-03-04 20:09:07', 45),
(100, 'air-jordan-1-mid', 104, 6500, 'สวยเท่', '609185399.jpg', 3, '2021-03-01 20:36:35', '2021-03-04 21:04:17', 30),
(101, 'mexico66', 107, 2500, 'เท่', '11063977.jpg', 8, '2021-03-01 21:24:06', '2021-03-04 21:04:17', 28),
(104, 'aaa', 108, 2000, 'สวย', '1842984492.jpg', 9, '2021-03-04 20:21:43', '2021-03-04 21:04:17', 30);

-- --------------------------------------------------------

--
-- Table structure for table `producttype`
--

CREATE TABLE `producttype` (
  `ProductTypeID` int(11) NOT NULL,
  `ProductTypeName` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `producttype`
--

INSERT INTO `producttype` (`ProductTypeID`, `ProductTypeName`, `created_at`, `updated_at`) VALUES
(1, 'Vans', NULL, '2021-02-10 09:46:28'),
(2, 'Nike', NULL, NULL),
(3, 'Adidas', '2021-02-10 09:32:31', '2021-02-10 09:32:31'),
(4, 'Converse', '2021-02-28 01:22:47', '2021-02-28 01:22:47'),
(8, 'Onisukaa', '2021-03-01 21:23:01', '2021-03-01 22:11:54'),
(9, 'filbfob', '2021-03-04 20:20:52', '2021-03-04 20:20:52');

-- --------------------------------------------------------

--
-- Table structure for table `shop_cart`
--

CREATE TABLE `shop_cart` (
  `CartID` int(11) NOT NULL,
  `cart_quantity` int(11) NOT NULL,
  `cart_price` float DEFAULT NULL,
  `ProductID` int(11) NOT NULL,
  `id` bigint(20) UNSIGNED NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shop_cart`
--

INSERT INTO `shop_cart` (`CartID`, `cart_quantity`, `cart_price`, `ProductID`, `id`, `updated_at`, `created_at`) VALUES
(367, 2, 3000, 4, 58, NULL, NULL),
(369, 6, 3000, 4, 59, NULL, NULL),
(371, 5, 3500, 12, 59, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `firstname` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `lastname` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` char(12) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `addressdetail` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `road` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `province` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'จังหวัด',
  `subdistrict` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'ตำบล',
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'อำเภอ',
  `zipcode` char(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'รหัสไปรษณีย์',
  `imageFileName` varchar(200) CHARACTER SET utf8 DEFAULT NULL COMMENT 'รูปuser'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `phone`, `remember_token`, `created_at`, `updated_at`, `type`, `addressdetail`, `road`, `province`, `subdistrict`, `district`, `zipcode`, `imageFileName`) VALUES
(30, 'Natchapol', 'Nedruengsaeng', 'admin@gmail.com', 'admin', '4e7436f9bd72d8d37ef4abd0ba84216079ae4473c362088ab5a13d5a9164b196', '0939123123', NULL, '2021-02-23 01:29:53', '2021-03-03 00:29:04', 1, '249/152 หมู่6', 'บ้านกล้วย-ไทรน้อย', 'นนทบุรี', 'พิมลราช', 'บางบัวทอง', '11110', 'teerapat.JPG'),
(31, 'Teerapat', 'Charoensuk', 'emailup1@gmail.com', 'usertest', '4e7436f9bd72d8d37ef4abd0ba84216079ae4473c362088ab5a13d5a9164b196', '0939123123', NULL, '2021-02-23 06:59:51', '2021-03-03 00:21:54', 0, '199/100', 'คอนกรีต', 'ยะลา', 'มะลา', 'เมือง', '11110', 'teerapat.JPG'),
(57, 'Cus1', 'Cus1', 'cus1@gmail.com', 'cus1', '4e7436f9bd72d8d37ef4abd0ba84216079ae4473c362088ab5a13d5a9164b196', '0939123707', NULL, '2021-03-04 19:58:15', '2021-03-04 19:59:14', 0, '249/152', 'บ้านกล้วย', 'นนทบุรี', 'พิมลราช', 'บางบัวทอง', '11110', NULL),
(58, 'Cus2', 'Cus2', 'cus2@gmail.com', 'cus2', '4e7436f9bd72d8d37ef4abd0ba84216079ae4473c362088ab5a13d5a9164b196', '0921245789', NULL, '2021-03-04 20:18:40', '2021-03-04 20:19:22', 1, '2147/78', 'บ้านกล้วย', 'กรุงเทพ', 'พิมลราช', 'บางใหญ๋', '11110', NULL),
(59, 'Fname', 'Lname', 'test1@hotmail.com', 'test1', '4e7436f9bd72d8d37ef4abd0ba84216079ae4473c362088ab5a13d5a9164b196', '0914789547', NULL, '2021-03-04 20:23:40', '2021-03-04 20:23:40', 0, '214/478', 'ดินแดง', 'กรุงเทพ', 'ดินแดง', 'ดินแดง', '11111', ''),
(60, 'Fname', 'Lname', 'test2@hotmail.com', 'test2', '4e7436f9bd72d8d37ef4abd0ba84216079ae4473c362088ab5a13d5a9164b196', '0874597412', NULL, '2021-03-04 20:24:46', '2021-03-04 20:24:46', 0, '144/78', 'ดินแดง', 'กรุงเทพ', 'ดินแดง', 'ดินแดง', '11110', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `type` tinyint(1) NOT NULL,
  `TypeName` varchar(100) CHARACTER SET utf8 COLLATE utf8_german2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`type`, `TypeName`) VALUES
(0, 'user'),
(1, 'employee');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `fk_id` (`id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`OrderDetailID`),
  ADD KEY `fk_orderpro` (`ProductID`),
  ADD KEY `fk_order` (`orderID`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `fk_payment` (`orderID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `ProductTypeID` (`ProductTypeID`);

--
-- Indexes for table `producttype`
--
ALTER TABLE `producttype`
  ADD PRIMARY KEY (`ProductTypeID`);

--
-- Indexes for table `shop_cart`
--
ALTER TABLE `shop_cart`
  ADD PRIMARY KEY (`CartID`),
  ADD KEY `fk_cart_ProID` (`ProductID`),
  ADD KEY `kf_cart_user` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `fk_usertype` (`type`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `OrderDetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `ProductID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `producttype`
--
ALTER TABLE `producttype`
  MODIFY `ProductTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shop_cart`
--
ALTER TABLE `shop_cart`
  MODIFY `CartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=376;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `type` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_id` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `fk_order` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`),
  ADD CONSTRAINT `fk_orderpro` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `fk_payment` FOREIGN KEY (`orderID`) REFERENCES `order` (`orderID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `fk_type` FOREIGN KEY (`ProductTypeID`) REFERENCES `producttype` (`ProductTypeID`);

--
-- Constraints for table `shop_cart`
--
ALTER TABLE `shop_cart`
  ADD CONSTRAINT `fk_cart_ProID` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`),
  ADD CONSTRAINT `kf_cart_user` FOREIGN KEY (`id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_usertype` FOREIGN KEY (`type`) REFERENCES `user_type` (`type`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
