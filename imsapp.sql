-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2020 at 11:44 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imsapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `b_status` enum('1','0') COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `b_status`, `created_at`, `updated_at`) VALUES
(1, 'Prada', '1', '2020-04-26 21:05:54', '2020-04-26 21:05:54'),
(2, 'Gucci', '1', '2020-04-27 18:54:25', '2020-04-27 18:54:25'),
(3, 'Nike', '1', '2020-04-27 19:28:28', '2020-04-27 19:28:28'),
(12, 'tommy hill', '1', '2020-04-29 16:40:28', '2020-04-29 16:40:28'),
(13, 'armani', '1', '2020-04-29 16:40:42', '2020-04-29 16:40:42'),
(14, 'carpisa', '1', '2020-04-29 16:40:54', '2020-04-29 16:40:54'),
(15, 'reebok', '1', '2020-04-29 16:41:22', '2020-04-29 16:41:22'),
(16, 'rolex', '1', '2020-04-29 16:41:52', '2020-04-29 16:41:52'),
(17, 'titan', '1', '2020-04-29 16:41:59', '2020-04-29 16:41:59'),
(18, 'zara', '1', '2020-04-29 16:42:13', '2020-04-29 16:42:13'),
(19, 'raymond', '1', '2020-04-29 16:43:17', '2020-04-29 16:43:17'),
(20, 'vimal', '1', '2020-04-29 16:43:25', '2020-04-29 16:43:25'),
(21, 'LG', '1', '2020-05-02 11:00:43', '2020-05-02 11:00:43'),
(22, 'Samsung', '1', '2020-05-02 11:01:00', '2020-05-02 11:01:00'),
(23, 'Bajaj', '1', '2020-05-02 11:01:05', '2020-05-02 11:01:05'),
(24, 'toshiba', '1', '2020-05-02 11:01:13', '2020-05-02 11:01:13'),
(25, 'sony', '1', '2020-05-02 11:01:18', '2020-05-02 11:01:18'),
(26, 'hitachi', '1', '2020-05-02 11:01:34', '2020-05-02 11:01:34'),
(27, 'eletrolux', '1', '2020-05-02 11:01:53', '2020-05-02 11:01:53'),
(28, 'whirlpool', '1', '2020-05-02 11:03:39', '2020-05-02 11:03:39');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `main_cat` int(11) NOT NULL,
  `category_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `main_cat`, `category_name`, `status`, `created_at`) VALUES
(1, 0, 'Fashion', '1', '2020-04-25 06:04:21'),
(2, 0, 'Electronics', '1', '2020-04-25 06:04:21'),
(3, 0, 'Movies', '1', '2020-04-25 06:04:21'),
(4, 0, 'Mobiles', '1', '2020-04-25 06:04:21'),
(5, 0, 'Games', '1', '2020-04-25 06:04:21'),
(6, 0, 'Books', '0', '2020-04-25 06:04:21'),
(7, 0, 'Home Accessories', '1', '2020-04-25 06:04:21'),
(8, 0, 'Kitchen Appliances', '1', '2020-04-25 06:04:21'),
(9, 0, 'Computers', '1', '2020-04-25 06:04:21'),
(10, 0, 'Laptops', '1', '2020-05-16 21:04:43'),
(11, 0, 'Smart Phones', '1', '2020-05-16 21:05:07'),
(12, 0, 'Cosmetics', '1', '2020-05-16 21:08:23'),
(14, 0, 'Sports', '1', '2020-05-19 08:39:44');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_qty` int(11) NOT NULL,
  `price_per_item` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `product_name`, `order_qty`, `price_per_item`, `created_at`) VALUES
(1, 1, 'Terminator', 12, 499, '2020-05-17 10:34:18'),
(2, 1, 'Jeans', 12, 1499, '2020-05-17 10:34:18'),
(3, 1, 'Air Condition', 4, 35000, '2020-05-17 10:34:18'),
(4, 1, 'Galalxy Prime', 2, 21999, '2020-05-17 10:34:18'),
(5, 1, 'Play Station 3', 1, 14999, '2020-05-17 10:34:18'),
(6, 1, 'Juicer Mixer', 1, 2999, '2020-05-17 10:34:18'),
(7, 2, 'Jeans', 1, 1499, '2020-05-17 11:24:23'),
(8, 2, 'Terminator', 1, 499, '2020-05-17 11:24:24'),
(9, 2, 'Play Station 3', 1, 14999, '2020-05-17 11:24:24'),
(10, 3, 'Jeans', 8, 1499, '2020-05-19 09:32:20'),
(11, 3, 'Air Condition', 8, 35000, '2020-05-19 09:32:20'),
(12, 3, 'Galalxy Prime', 2, 21999, '2020-05-19 09:32:20'),
(13, 3, 'Washing Machine', 2, 36000, '2020-05-19 09:32:20'),
(14, 3, 'Terminator 3', 7, 299, '2020-05-19 09:32:21'),
(15, 4, 'Jeans', 1, 1499, '2020-05-19 09:37:27'),
(16, 5, 'Air Condition', 1, 35000, '2020-05-19 09:38:04'),
(17, 6, 'Air Condition', 2, 35000, '2020-05-19 09:41:37'),
(18, 7, 'Jeans', 2, 1499, '2020-05-19 09:42:26');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `invoice_no` int(11) NOT NULL,
  `customer_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtotal` double NOT NULL,
  `gst` double NOT NULL,
  `discount` double NOT NULL,
  `net_total` double NOT NULL,
  `paid` double NOT NULL,
  `due` double NOT NULL,
  `payment_method` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_date` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`invoice_no`, `customer_name`, `address`, `subtotal`, `gst`, `discount`, `net_total`, `paid`, `due`, `payment_method`, `order_date`) VALUES
(1, 'Mic Rakesh', 'delhi', 225972, 40675, 75, 266572, 266500, 72, 'Cash', '17-05-2020'),
(2, 'aman kumar', 'hyderbad', 16997, 3059, 0, 20056, 0, 20056, 'Credit Card', '17-05-2020'),
(3, 'Munna Jhon', 'Africa', 410083, 73815, 15, 483883, 483800, 83, 'Cash', '19-05-2020'),
(4, 'Rahul four', 'Kanpur', 1499, 270, 0, 1769, 1769, 0, 'Cash', '19-05-2020'),
(5, 'mukesh cena', 'jalandhar', 35000, 6300, 0, 41300, 41300, 0, 'Cash', '19-05-2020'),
(6, 'vikcy five', 'lucknow', 70000, 12600, 0, 82600, 82600, 0, 'Cash', '19-05-2020'),
(7, 'manish six', 'haryana', 2998, 540, 0, 3538, 3538, 0, 'Cash', '19-05-2020');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `price` double NOT NULL,
  `description` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `cat_id`, `brand_id`, `product_name`, `stock`, `price`, `description`, `p_status`, `created_at`) VALUES
(1, 1, 1, 'Jeans', 11, 1499, 'Nice jeans', '1', '2020-05-12 17:02:26'),
(2, 2, 27, 'Air Condition', 11, 35000, 'nice aircondition', '1', '2020-05-12 17:05:46'),
(4, 4, 22, 'Galalxy Prime', 0, 21999, 'Smart Phone', '1', '2020-05-12 17:07:24'),
(5, 5, 21, 'Play Station 3', 0, 14999, 'nice game', '1', '2020-05-12 17:08:50'),
(7, 7, 23, 'Juicer Mixer', 0, 2999, 'juicer mixer for juice', '1', '2020-05-12 17:10:06'),
(8, 8, 26, 'Washing Machine', 0, 36000, 'Washing Machine', '1', '2020-05-12 17:10:42'),
(9, 3, 25, 'Terminator 3', 11, 299, 'very nice movies', '1', '2020-05-19 09:29:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('Master','User') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `vcode` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `vcode`, `country`) VALUES
(1, 'Admin', 'admin@gmail.com', '$2y$10$sNU3LDmg/ccjayGhRkioluU/WLb8c5h9jwmk4fdHi.gLXunmY4eqW', 'Master', '1', '1234flx786', 'India'),
(4, 'Naman Doe', 'naman@demo.com', '$2y$10$MpDIUApT2i/GESMM9vdTuOBGCztNLExynnNe5KMyEHuGfNVhEmUxi', 'User', '1', '7zg5wRhtM&8qh$A', NULL),
(6, 'aman micheal', 'aman@demo.com', '$2y$10$Z4aH9HL.I7CrfVNe4WZ2QeTvQMVtW92/bzmN.aY.gjzJZ/qJOqx3e', 'User', '1', 'rXpb1w0LPdMtn37', 'Africa'),
(7, 'daman calcutta', 'daman123@demo.com', '$2y$10$5VyxBXmKwmjIPPyW7T1GZu1Sugc5DtOtD6/CKsnOu11f8BuJv.F8m', 'User', '1', 'ghe8nsmzb&u90Mw', 'Londonn'),
(9, 'tapan mohan', 'tapan_das@demo.com', '$2y$10$UX4rupH6qUnwkPXRiCAL4.1.WqY/v46PCYPhtSjm67XynVUqGpufm', 'User', '0', 'vZ751Yo$9ksbMKh', 'Chennai'),
(10, 'munna chulbull', 'munna@demo.com', '$2y$10$Cs.15/mol6VW1BE0R5l7R.AB.V9Od41XrxV7wNBiRj2VgyOh3CPQK', 'User', '0', 'kr5qy$0&Yx16bhg', 'dubai'),
(11, 'rajiv none', 'rajiv@demo.com', '$2y$10$OxmgwdVvTSr1oYN20wXYdunJBlKZCVILT4OadyupygOgotAYDLbR.', 'User', '1', 'beZM3X0znLbPmdA', 'kanpur'),
(12, 'mukesh gone', 'muksesh@demo.com', '$2y$10$VoNLbll8sgxKENyIsvFhW.c6OYjLPF7W7rZ85Kw.bgDP5ZuIhg7Jm', 'User', '1', 'ZT#$$2ob7ntxKLY', 'portugal'),
(16, 'Pandey cena', 'pandey@demo.com', '$2y$10$qF8rn0VBFLIf4lA2ybWwQel8B5RK.TmPt1wLptyB342P0KXNPyXs6', 'User', '1', 'e5M#csT$hR0L3rP', 'NewZealand'),
(19, 'smart infotechsys', 'smart@demo.com', '$2y$10$xAsMNCeTNE79tCEBNQWWWu1LHuvTtXWqgNqJhRt2GUw1OANwEpZvS', 'User', '1', 'AXwdPMhZ%0o8sL9', 'india');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_no` (`invoice_no`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`invoice_no`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `cat_id` (`cat_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `invoice_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`invoice_no`) REFERENCES `orders` (`invoice_no`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cat_id`) REFERENCES `categories` (`cat_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
