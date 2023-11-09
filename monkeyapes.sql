-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 09, 2023 at 02:00 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monkeyapes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'admin@test.com', 'Tommy123!');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'Mario'),
(2, 'Paul Frank Julius and Friends'),
(3, 'No Brands');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `productsinfo` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `cust_id`, `product_id`, `productsinfo`, `quantity`) VALUES
(30, 1, 1, '3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_title`) VALUES
(1, 'T-Shirt'),
(2, 'Jeans'),
(3, 'Skirt'),
(4, 'Suit'),
(5, 'Dress');

-- --------------------------------------------------------

--
-- Table structure for table `chatusers`
--

CREATE TABLE `chatusers` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chatusers`
--

INSERT INTO `chatusers` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `status`, `reset_token`) VALUES
(1, 1565309945, 'Tommy', 'Tan', 'tommytan2002@hotmail.com', '$2y$10$iqsYIHtWsltwB.rPJDv26.2fRoFaw7escTvyHpZ2amp61mx9TWjA.', 'Active', 'a0634717ec86b49ec5a6ab9bf169d7a2New Token'),
(2, 1480164470, 'Monkey Apes', 'Admin', 'admintest@gmail.com', 'bb5fae71a22dd50054414efb06c5a216', 'Offline', '');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `checkout_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `payment_cart` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`checkout_id`, `user`, `payment_cart`, `total_price`, `payment_method`, `date`) VALUES
(52, 1, 20, '199.00', 'cash-on-delivery', '2023-10-25 15:12:09'),
(53, 1, 20, '199.00', 'cash-on-delivery', '2023-10-25 15:12:44'),
(54, 1, 20, '497.00', 'credit-card', '2023-11-02 14:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `color`
--

CREATE TABLE `color` (
  `color_id` int(11) NOT NULL,
  `color_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `color`
--

INSERT INTO `color` (`color_id`, `color_title`) VALUES
(1, 'Pink'),
(2, 'White'),
(3, 'Blue'),
(4, 'Black');

-- --------------------------------------------------------

--
-- Table structure for table `creditcards`
--

CREATE TABLE `creditcards` (
  `card_id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `card_holder` varchar(255) NOT NULL,
  `expiration_month` int(11) NOT NULL,
  `expiration_year` int(11) NOT NULL,
  `cvv` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `creditcards`
--

INSERT INTO `creditcards` (`card_id`, `user`, `card_number`, `card_holder`, `expiration_month`, `expiration_year`, `cvv`) VALUES
(5, 1, '2222222222222222', 'Tom', 2, 2026, '$2y$');

-- --------------------------------------------------------

--
-- Table structure for table `fittingroom`
--

CREATE TABLE `fittingroom` (
  `fittingroom_id` int(11) NOT NULL,
  `fittingheight` int(11) NOT NULL,
  `fittingweight` int(11) NOT NULL,
  `fittingroom_image` varchar(255) NOT NULL,
  `products` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fittingroom`
--

INSERT INTO `fittingroom` (`fittingroom_id`, `fittingheight`, `fittingweight`, `fittingroom_image`, `products`) VALUES
(14, 1, 1, 'polkadot_front.jpg', 1),
(15, 1, 1, 'polkadot_side1.jpg', 1),
(16, 1, 1, 'polkadot_side2.jpg', 1),
(17, 1, 1, 'polkadot_back.jpg', 1),
(18, 1, 1, 'polkadots_side3.jpg', 1),
(19, 1, 1, 'polkadot_side4.jpg', 1),
(20, 1, 2, 'polkadot_front.jpg', 1),
(21, 1, 2, 'polkadot_side1.jpg', 1),
(22, 1, 2, 'polkadot_side2.jpg', 1),
(23, 1, 2, 'polkadot_back.jpg', 1),
(24, 1, 2, 'polkadots_side3.jpg', 1),
(25, 1, 2, 'polkadot_side4.jpg', 1),
(26, 1, 3, 'polkadot_front.jpg', 1),
(27, 1, 3, 'polkadot_side1.jpg', 1),
(28, 1, 3, 'polkadot_side2.jpg', 1),
(29, 1, 3, 'polkadot_back.jpg', 1),
(30, 1, 3, 'polkadots_side3.jpg', 1),
(31, 1, 3, 'polkadot_side4.jpg', 1),
(32, 1, 4, 'polkadot_front_1.jpg', 1),
(33, 1, 4, 'polkadot_side1_1.jpg', 1),
(34, 1, 4, 'polkadot_side2_1.jpg', 1),
(35, 1, 4, 'polkadot_back_1.jpg', 1),
(36, 1, 4, 'polkadots_side3_1.jpg', 1),
(37, 1, 4, 'polkadot_side4_1.jpg', 1),
(38, 1, 5, 'polkadot_front_2.jpg', 1),
(39, 1, 5, 'polkadot_side1_2.jpg', 1),
(40, 1, 5, 'polkadot_side2_2.jpg', 1),
(41, 1, 5, 'polkadot_back_2.jpg', 1),
(42, 1, 5, 'polkadot_side3_2.jpg', 1),
(43, 1, 5, 'polkadot_side4_2.jpg', 1),
(44, 2, 1, 'polkadot_front_3.jpg', 1),
(45, 2, 1, 'polkadot_side1_3.jpg', 1),
(46, 2, 1, 'polkadot_side2_3.jpg', 1),
(47, 2, 1, 'polkadot_back_3.jpg', 1),
(48, 2, 1, 'polkadot_side3_3.jpg', 1),
(49, 2, 1, 'polkadot_side4_3.jpg', 1),
(50, 2, 2, 'polkadot_front_3.jpg', 1),
(51, 2, 2, 'polkadot_side1_3.jpg', 1),
(52, 2, 2, 'polkadot_side2_3.jpg', 1),
(53, 2, 2, 'polkadot_back_3.jpg', 1),
(54, 2, 2, 'polkadot_side3_3.jpg', 1),
(55, 2, 2, 'polkadot_side4_3.jpg', 1),
(56, 2, 3, 'polkadot_front_3.jpg', 1),
(57, 2, 3, 'polkadot_side1_3.jpg', 1),
(58, 2, 3, 'polkadot_side2_3.jpg', 1),
(59, 2, 3, 'polkadot_back_3.jpg', 1),
(60, 2, 3, 'polkadot_side3_3.jpg', 1),
(61, 2, 3, 'polkadot_side4_3.jpg', 1),
(62, 2, 4, 'polkadot_front_4.jpg', 1),
(63, 2, 4, 'polkadot_side1_4.jpg', 1),
(64, 2, 4, 'polkadot_side2_4.jpg', 1),
(65, 2, 4, 'polkadot_back_4.jpg', 1),
(66, 2, 4, 'polkadot_side3_4.jpg', 1),
(67, 2, 4, 'polkadot_side4_4.jpg', 1),
(68, 2, 5, 'polkadot_front_4.jpg', 1),
(69, 2, 5, 'polkadot_side1_4.jpg', 1),
(70, 2, 5, 'polkadot_side2_4.jpg', 1),
(71, 2, 5, 'polkadot_back_4.jpg', 1),
(72, 2, 5, 'polkadot_side3_4.jpg', 1),
(73, 2, 5, 'polkadot_side4_4.jpg', 1),
(74, 3, 2, 'polkadot_front_5.jpg', 1),
(75, 3, 2, 'polkadot_side1_5.jpg', 1),
(76, 3, 2, 'polkadot_side2_5.jpg', 1),
(77, 3, 2, 'polkadot_back_5.jpg', 1),
(78, 3, 2, 'polkadot_side3_5.jpg', 1),
(79, 3, 2, 'polkadot_side4_5.jpg', 1),
(80, 3, 3, 'polkadot_front_5.jpg', 1),
(81, 3, 3, 'polkadot_side1_5.jpg', 1),
(82, 3, 3, 'polkadot_side2_5.jpg', 1),
(83, 3, 3, 'polkadot_back_5.jpg', 1),
(84, 3, 3, 'polkadot_side3_5.jpg', 1),
(85, 3, 3, 'polkadot_side4_5.jpg', 1),
(86, 3, 4, 'polkadot_front_6.jpg', 1),
(87, 3, 4, 'polkadot_side1_6.jpg', 1),
(88, 3, 4, 'polkadot_side2_6.jpg', 1),
(89, 3, 4, 'polkadot_back_6.jpg', 1),
(90, 3, 4, 'polkadot_side3_6.jpg', 1),
(91, 3, 4, 'polkadot_side4_6.jpg', 1),
(92, 3, 5, 'polkadot_front_7.jpg', 1),
(93, 3, 5, 'polkadot_side1_7.jpg', 1),
(94, 3, 5, 'polkadot_side2_7.jpg', 1),
(95, 3, 5, 'polkadot_back_7.jpg', 1),
(96, 3, 5, 'polkadot_side3_7.jpg', 1),
(97, 3, 5, 'polkadot_side4_7.jpg', 1),
(98, 4, 3, 'polkadot_front_8.jpg', 1),
(99, 4, 3, 'polkadot_side1_8.jpg', 1),
(100, 4, 3, 'polkadot_side2_8.jpg', 1),
(101, 4, 3, 'polkadot_back_8.jpg', 1),
(102, 4, 3, 'polkadot_side3_8.jpg', 1),
(103, 4, 3, 'polkadot_side4_8.jpg', 1),
(104, 4, 4, 'polkadot_front_8.jpg', 1),
(105, 4, 4, 'polkadot_side1_8.jpg', 1),
(106, 4, 4, 'polkadot_side2_8.jpg', 1),
(107, 4, 4, 'polkadot_back_8.jpg', 1),
(108, 4, 4, 'polkadot_side3_8.jpg', 1),
(109, 4, 4, 'polkadot_side4_8.jpg', 1),
(110, 4, 5, 'polkadot_front_9.jpg', 1),
(111, 4, 5, 'polkadot_side1_9.jpg', 1),
(112, 4, 5, 'polkadot_side2_9.jpg', 1),
(113, 4, 5, 'polkadot_back_9.jpg', 1),
(114, 4, 5, 'polkadot_side3_9.jpg', 1),
(115, 4, 5, 'polkadot_side4_9.jpg', 1),
(116, 4, 6, 'polkadot_front_9.jpg', 1),
(117, 4, 6, 'polkadot_side1_9.jpg', 1),
(118, 4, 6, 'polkadot_side2_9.jpg', 1),
(119, 4, 6, 'polkadot_back_9.jpg', 1),
(120, 4, 6, 'polkadot_side3_9.jpg', 1),
(121, 4, 6, 'polkadot_side4_9.jpg', 1),
(122, 5, 3, 'polkadot_front_10.jpg', 1),
(123, 5, 3, 'polkadot_side1_10.jpg', 1),
(124, 5, 3, 'polkadot_side2_10.jpg', 1),
(125, 5, 3, 'polkadot_back_10.jpg', 1),
(126, 5, 3, 'polkadot_side3_10.jpg', 1),
(127, 5, 3, 'polkadot_side4_10.jpg', 1),
(128, 5, 4, 'polkadot_front_10.jpg', 1),
(129, 5, 4, 'polkadot_side1_10.jpg', 1),
(130, 5, 4, 'polkadot_side2_10.jpg', 1),
(131, 5, 4, 'polkadot_back_10.jpg', 1),
(132, 5, 4, 'polkadot_side3_10.jpg', 1),
(133, 5, 4, 'polkadot_side4_10.jpg', 1),
(134, 5, 5, 'polkadot_front_10.jpg', 1),
(135, 5, 5, 'polkadot_side1_10.jpg', 1),
(136, 5, 5, 'polkadot_side2_10.jpg', 1),
(137, 5, 5, 'polkadot_back_10.jpg', 1),
(138, 5, 5, 'polkadot_side3_10.jpg', 1),
(139, 5, 5, 'polkadot_side4_10.jpg', 1),
(140, 5, 6, 'polkadot_front_10.jpg', 1),
(141, 5, 6, 'polkadot_side1_10.jpg', 1),
(142, 5, 6, 'polkadot_side2_10.jpg', 1),
(143, 5, 6, 'polkadot_back_10.jpg', 1),
(144, 5, 6, 'polkadot_side3_10.jpg', 1),
(145, 5, 6, 'polkadot_side4_10.jpg', 1),
(146, 1, 1, 'oneshoulder_front.jpg', 6),
(147, 1, 1, 'oneshoulder_side1.jpg', 6),
(148, 1, 1, 'oneshoulder_side2.jpg', 6),
(149, 1, 1, 'oneshoulder_back.jpg', 6),
(150, 1, 1, 'oneshoulder_side3.jpg', 6),
(151, 1, 1, 'oneshoulder_side4.jpg', 6),
(152, 1, 2, 'oneshoulder_front.jpg', 6),
(153, 1, 2, 'oneshoulder_side1.jpg', 6),
(154, 1, 2, 'oneshoulder_side2.jpg', 6),
(155, 1, 2, 'oneshoulder_back.jpg', 6),
(156, 1, 2, 'oneshoulder_side3.jpg', 6),
(157, 1, 2, 'oneshoulder_side4.jpg', 6),
(158, 1, 3, 'oneshoulder_front.jpg', 6),
(159, 1, 3, 'oneshoulder_side1.jpg', 6),
(160, 1, 3, 'oneshoulder_side2.jpg', 6),
(161, 1, 3, 'oneshoulder_back.jpg', 6),
(162, 1, 3, 'oneshoulder_side3.jpg', 6),
(163, 1, 3, 'oneshoulder_side4.jpg', 6),
(164, 1, 4, 'oneshoulder_front_1.jpg', 6),
(165, 1, 4, 'oneshoulder_side1_1.jpg', 6),
(166, 1, 4, 'oneshoulder_side2_1.jpg', 6),
(167, 1, 4, 'oneshoulder_back_1.jpg', 6),
(168, 1, 4, 'oneshoulder_side3_1.jpg', 6),
(169, 1, 4, 'oneshoulder_side4_1.jpg', 6),
(170, 1, 5, 'oneshoulder_front_1.jpg', 6),
(171, 1, 5, 'oneshoulder_side1_1.jpg', 6),
(172, 1, 5, 'oneshoulder_side2_1.jpg', 6),
(173, 1, 5, 'oneshoulder_back_1.jpg', 6),
(174, 1, 5, 'oneshoulder_side3_1.jpg', 6),
(175, 1, 5, 'oneshoulder_side4_1.jpg', 6),
(176, 2, 1, 'oneshoulder_front_2.jpg', 6),
(177, 2, 1, 'oneshoulder_side1_2.jpg', 6),
(178, 2, 1, 'oneshoulder_side2_2.jpg', 6),
(179, 2, 1, 'oneshoulder_back_2.jpg', 6),
(180, 2, 1, 'oneshoulder_side3_2.jpg', 6),
(181, 2, 1, 'oneshoulder_side4_2.jpg', 6),
(182, 2, 2, 'oneshoulder_front_2.jpg', 6),
(183, 2, 2, 'oneshoulder_side1_2.jpg', 6),
(184, 2, 2, 'oneshoulder_side2_2.jpg', 6),
(185, 2, 2, 'oneshoulder_back_2.jpg', 6),
(186, 2, 2, 'oneshoulder_side3_2.jpg', 6),
(187, 2, 2, 'oneshoulder_side4_2.jpg', 6),
(188, 2, 3, 'oneshoulder_front_2.jpg', 6),
(189, 2, 3, 'oneshoulder_side1_2.jpg', 6),
(190, 2, 3, 'oneshoulder_side2_2.jpg', 6),
(191, 2, 3, 'oneshoulder_back_2.jpg', 6),
(192, 2, 3, 'oneshoulder_side3_2.jpg', 6),
(193, 2, 3, 'oneshoulder_side4_2.jpg', 6),
(194, 2, 4, 'oneshoulder_front_3.jpg', 6),
(195, 2, 4, 'oneshoulder_side1_3.jpg', 6),
(196, 2, 4, 'oneshoulder_side2_3.jpg', 6),
(197, 2, 4, 'oneshoulder_back_3.jpg', 6),
(198, 2, 4, 'oneshoulder_side3_3.jpg', 6),
(199, 2, 4, 'oneshoulder_side4_3.jpg', 6),
(200, 2, 5, 'oneshoulder_front_3.jpg', 6),
(201, 2, 5, 'oneshoulder_side1_3.jpg', 6),
(202, 2, 5, 'oneshoulder_side2_3.jpg', 6),
(203, 2, 5, 'oneshoulder_back_3.jpg', 6),
(204, 2, 5, 'oneshoulder_side3_3.jpg', 6),
(205, 2, 5, 'oneshoulder_side4_3.jpg', 6),
(206, 3, 2, 'oneshoulder_front_3.jpg', 6),
(207, 3, 2, 'oneshoulder_side1_3.jpg', 6),
(208, 3, 2, 'oneshoulder_side2_4.jpg', 6),
(209, 3, 2, 'oneshoulder_back_4.jpg', 6),
(210, 3, 2, 'oneshoulder_side3_4.jpg', 6),
(211, 3, 2, 'oneshoulder_side4_4.jpg', 6),
(212, 3, 3, 'oneshoulder_front_4.jpg', 6),
(213, 3, 3, 'oneshoulder_side1_4.jpg', 6),
(214, 3, 3, 'oneshoulder_side2_4.jpg', 6),
(215, 3, 3, 'oneshoulder_back_4.jpg', 6),
(216, 3, 3, 'oneshoulder_side3_4.jpg', 6),
(217, 3, 3, 'oneshoulder_side4_4.jpg', 6),
(218, 3, 4, 'oneshoulder_front_5.jpg', 6),
(219, 3, 4, 'oneshoulder_side1_5.jpg', 6),
(220, 3, 4, 'oneshoulder_side2_5.jpg', 6),
(221, 3, 4, 'oneshoulder_back_5.jpg', 6),
(222, 3, 4, 'oneshoulder_side3_5.jpg', 6),
(223, 3, 4, 'oneshoulder_side4_5.jpg', 6),
(224, 3, 5, 'oneshoulder_front_5.jpg', 6),
(225, 3, 5, 'oneshoulder_side1_5.jpg', 6),
(226, 3, 5, 'oneshoulder_side2_5.jpg', 6),
(227, 3, 5, 'oneshoulder_back_5.jpg', 6),
(228, 3, 5, 'oneshoulder_side3_5.jpg', 6),
(229, 3, 5, 'oneshoulder_side4_5.jpg', 6),
(230, 4, 3, 'oneshoulder_front_6.jpg', 6),
(231, 4, 3, 'oneshoulder_side1_6.jpg', 6),
(232, 4, 3, 'oneshoulder_side2_6.jpg', 6),
(233, 4, 3, 'oneshoulder_back_6.jpg', 6),
(234, 4, 3, 'oneshoulder_side3_6.jpg', 6),
(235, 4, 3, 'oneshoulder_side4_6.jpg', 6),
(236, 4, 4, 'oneshoulder_front_6.jpg', 6),
(237, 4, 4, 'oneshoulder_side1_6.jpg', 6),
(238, 4, 4, 'oneshoulder_side2_6.jpg', 6),
(239, 4, 4, 'oneshoulder_back_6.jpg', 6),
(240, 4, 4, 'oneshoulder_side3_6.jpg', 6),
(241, 4, 4, 'oneshoulder_side4_6.jpg', 6),
(242, 4, 5, 'oneshoulder_front_7.jpg', 6),
(243, 4, 5, 'oneshoulder_side1_7.jpg', 6),
(244, 4, 5, 'oneshoulder_side2_7.jpg', 6),
(245, 4, 5, 'oneshoulder_back_7.jpg', 6),
(246, 4, 5, 'oneshoulder_side3_7.jpg', 6),
(247, 4, 5, 'oneshoulder_side4_7.jpg', 6),
(248, 4, 6, 'oneshoulder_front_7.jpg', 6),
(249, 4, 6, 'oneshoulder_side1_7.jpg', 6),
(250, 4, 6, 'oneshoulder_side2_7.jpg', 6),
(251, 4, 6, 'oneshoulder_back_7.jpg', 6),
(252, 4, 6, 'oneshoulder_side3_7.jpg', 6),
(253, 4, 6, 'oneshoulder_side4_7.jpg', 6),
(254, 4, 4, 'oneshoulder_front_8.jpg', 6),
(255, 4, 4, 'oneshoulder_side1_8.jpg', 6),
(256, 4, 4, 'oneshoulder_side2_7.jpg', 6),
(257, 4, 4, 'oneshoulder_back_7.jpg', 6),
(258, 5, 4, 'oneshoulder_side3_8.jpg', 6),
(259, 5, 4, 'oneshoulder_side4_8.jpg', 6),
(260, 5, 5, 'oneshoulder_front_8.jpg', 6),
(261, 5, 5, 'oneshoulder_side1_8.jpg', 6),
(262, 5, 5, 'oneshoulder_side2_8.jpg', 6),
(263, 5, 5, 'oneshoulder_back_8.jpg', 6),
(264, 5, 5, 'oneshoulder_side3_8.jpg', 6),
(265, 5, 5, 'oneshoulder_side4_8.jpg', 6),
(266, 5, 6, 'oneshoulder_front_8.jpg', 6),
(267, 5, 6, 'oneshoulder_side1_8.jpg', 6),
(268, 5, 6, 'oneshoulder_side2_8.jpg', 6),
(269, 5, 6, 'oneshoulder_back_8.jpg', 6),
(270, 5, 6, 'oneshoulder_side3_8.jpg', 6),
(271, 5, 6, 'oneshoulder_side4_8.jpg', 6),
(272, 5, 3, 'oneshoulder_front_8.jpg', 6),
(273, 5, 3, 'oneshoulder_side1_8.jpg', 6),
(274, 5, 3, 'oneshoulder_side2_8.jpg', 6),
(275, 5, 3, 'oneshoulder_back_8.jpg', 6),
(276, 5, 3, 'oneshoulder_side3_8.jpg', 6),
(277, 5, 3, 'oneshoulder_side4_8.jpg', 6),
(278, 2, 1, 'tshirt_front.jpg', 5),
(279, 2, 1, 'tshirt_side1.jpg', 5),
(280, 2, 1, 'tshirt_side2.jpg', 5),
(281, 2, 1, 'tshirt_back.jpg', 5),
(282, 2, 1, 'tshirt_side3.jpg', 5),
(283, 2, 1, 'tshirt_side4.jpg', 5),
(284, 2, 2, 'tshirt_front.jpg', 5),
(285, 2, 2, 'tshirt_side1.jpg', 5),
(286, 2, 2, 'tshirt_side2.jpg', 5),
(287, 2, 2, 'tshirt_back.jpg', 5),
(288, 2, 2, 'tshirt_side3.jpg', 5),
(289, 2, 2, 'tshirt_side4.jpg', 5),
(290, 2, 3, 'tshirt_front.jpg', 5),
(291, 2, 3, 'tshirt_side1.jpg', 5),
(292, 2, 3, 'tshirt_side2.jpg', 5),
(293, 2, 3, 'tshirt_back.jpg', 5),
(294, 2, 3, 'tshirt_side3.jpg', 5),
(295, 2, 3, 'tshirt_side4.jpg', 5),
(296, 2, 4, 'tshirt_front_1.jpg', 5),
(297, 2, 4, 'tshirt_side1_1.jpg', 5),
(298, 2, 4, 'tshirt_side2_1.jpg', 5),
(299, 2, 4, 'tshirt_back_1.jpg', 5),
(300, 2, 4, 'tshirt_side3_1.jpg', 5),
(301, 2, 4, 'tshirt_side4_1.jpg', 5),
(302, 2, 5, 'tshirt_front_1.jpg', 5),
(303, 2, 5, 'tshirt_side1_1.jpg', 5),
(304, 2, 5, 'tshirt_side2_1.jpg', 5),
(305, 2, 5, 'tshirt_back_1.jpg', 5),
(306, 2, 5, 'tshirt_side3_1.jpg', 5),
(307, 2, 5, 'tshirt_side4_1.jpg', 5),
(308, 2, 6, 'tshirt_front_1.jpg', 5),
(309, 2, 6, 'tshirt_side1_1.jpg', 5),
(310, 2, 6, 'tshirt_side2_1.jpg', 5),
(311, 2, 6, 'tshirt_back_1.jpg', 5),
(312, 2, 6, 'tshirt_side3_1.jpg', 5),
(313, 2, 6, 'tshirt_side4_1.jpg', 5),
(314, 3, 2, 'tshirt_front_2.jpg', 5),
(315, 3, 2, 'tshirt_side1_2.jpg', 5),
(316, 3, 2, 'tshirt_side2_2.jpg', 5),
(317, 3, 2, 'tshirt_back_2.jpg', 5),
(318, 3, 2, 'tshirt_side3_2.jpg', 5),
(319, 3, 2, 'tshirt_side4_2.jpg', 5),
(320, 3, 3, 'tshirt_front_2.jpg', 5),
(321, 3, 3, 'tshirt_side1_2.jpg', 5),
(322, 3, 3, 'tshirt_side2_2.jpg', 5),
(323, 3, 3, 'tshirt_back_2.jpg', 5),
(324, 3, 3, 'tshirt_side3_2.jpg', 5),
(325, 3, 3, 'tshirt_side4_2.jpg', 5),
(326, 3, 4, 'tshirt_front_3.jpg', 5),
(327, 3, 4, 'tshirt_side1_3.jpg', 5),
(328, 3, 4, 'tshirt_side2_3.jpg', 5),
(329, 3, 4, 'tshirt_back_3.jpg', 5),
(330, 3, 4, 'tshirt_side3_3.jpg', 5),
(331, 3, 4, 'tshirt_side4_3.jpg', 5),
(332, 3, 5, 'tshirt_front_3.jpg', 5),
(333, 3, 5, 'tshirt_side1_3.jpg', 5),
(334, 3, 5, 'tshirt_side2_3.jpg', 5),
(335, 3, 5, 'tshirt_back_3.jpg', 5),
(336, 3, 5, 'tshirt_side3_3.jpg', 5),
(337, 3, 5, 'tshirt_side4_3.jpg', 5),
(338, 3, 6, 'tshirt_front_3.jpg', 5),
(339, 3, 6, 'tshirt_side1_3.jpg', 5),
(340, 3, 6, 'tshirt_side2_3.jpg', 5),
(341, 3, 6, 'tshirt_back_3.jpg', 5),
(342, 3, 6, 'tshirt_side3_3.jpg', 5),
(343, 3, 6, 'tshirt_side4_3.jpg', 5),
(344, 4, 3, 'tshirt_front_4jpg', 5),
(345, 4, 3, 'tshirt_side1_4.jpg', 5),
(346, 4, 3, 'tshirt_side2_4.jpg', 5),
(347, 4, 3, 'tshirt_back_4.jpg', 5),
(348, 4, 3, 'tshirt_side3_4.jpg', 5),
(349, 4, 3, 'tshirt_side4_4.jpg', 5),
(350, 4, 4, 'tshirt_front_4.jpg', 5),
(351, 4, 4, 'tshirt_side1_4.jpg', 5),
(352, 4, 4, 'tshirt_side2_4.jpg', 5),
(353, 4, 4, 'tshirt_back_4.jpg', 5),
(354, 4, 4, 'tshirt_side3_4.jpg', 5),
(355, 4, 4, 'tshirt_side4_4.jpg', 5),
(356, 4, 5, 'tshirt_front_5.jpg', 5),
(357, 4, 5, 'tshirt_side1_5.jpg', 5),
(358, 4, 5, 'tshirt_side2_5.jpg', 5),
(359, 4, 5, 'tshirt_back_5.jpg', 5),
(360, 4, 5, 'tshirt_side3_5.jpg', 5),
(361, 4, 5, 'tshirt_side4_5.jpg', 5),
(362, 4, 6, 'tshirt_front_5.jpg', 5),
(363, 4, 6, 'tshirt_side1_5.jpg', 5),
(364, 4, 6, 'tshirt_side2_5.jpg', 5),
(365, 4, 6, 'tshirt_back_5.jpg', 5),
(366, 4, 6, 'tshirt_side3_5.jpg', 5),
(367, 4, 6, 'tshirt_side4_5.jpg', 5),
(368, 5, 3, 'tshirt_front_6jpg', 5),
(369, 5, 3, 'tshirt_side1_6.jpg', 5),
(370, 5, 3, 'tshirt_side2_6.jpg', 5),
(371, 5, 3, 'tshirt_back_6.jpg', 5),
(372, 5, 3, 'tshirt_side3_6.jpg', 5),
(373, 5, 3, 'tshirt_side4_6.jpg', 5),
(374, 5, 4, 'tshirt_front_6.jpg', 5),
(375, 5, 4, 'tshirt_side1_6.jpg', 5),
(376, 5, 4, 'tshirt_side2_6.jpg', 5),
(377, 5, 4, 'tshirt_back_6.jpg', 5),
(378, 5, 4, 'tshirt_side3_6.jpg', 5),
(379, 5, 4, 'tshirt_side4_6.jpg', 5),
(380, 5, 5, 'tshirt_front_6jpg', 5),
(381, 5, 5, 'tshirt_side1_6.jpg', 5),
(382, 5, 5, 'tshirt_side2_6.jpg', 5),
(383, 5, 5, 'tshirt_back_6.jpg', 5),
(384, 5, 5, 'tshirt_side3_6.jpg', 5),
(385, 5, 5, 'tshirt_side4_6.jpg', 5),
(386, 5, 6, 'tshirt_front_6.jpg', 5),
(387, 5, 6, 'tshirt_side1_6.jpg', 5),
(388, 5, 6, 'tshirt_side2_6.jpg', 5),
(389, 5, 6, 'tshirt_back_6.jpg', 5),
(390, 5, 6, 'tshirt_side3_6.jpg', 5),
(391, 5, 6, 'tshirt_side4_6.jpg', 5),
(392, 2, 1, 'suit_front.jpg', 7),
(393, 2, 1, 'suit_side1.jpg', 7),
(394, 2, 1, 'suit_side2.jpg', 7),
(395, 2, 1, 'suit_back.jpg', 7),
(396, 2, 1, 'suit_side3.jpg', 7),
(397, 2, 1, 'suit_side4.jpg', 7),
(398, 2, 2, 'suit_front.jpg', 7),
(399, 2, 2, 'suit_side1.jpg', 7),
(400, 2, 2, 'suit_side2.jpg', 7),
(401, 2, 2, 'suit_back.jpg', 7),
(402, 2, 2, 'suit_side3.jpg', 7),
(403, 2, 2, 'suit_side4.jpg', 7),
(404, 2, 3, 'suit_front.jpg', 7),
(405, 2, 3, 'suit_side1.jpg', 7),
(406, 2, 3, 'suit_side2.jpg', 7),
(407, 2, 3, 'suit_back.jpg', 7),
(408, 2, 3, 'suit_side3.jpg', 7),
(409, 2, 3, 'suit_side4.jpg', 7),
(410, 2, 4, 'suit_front_1.jpg', 7),
(411, 2, 4, 'suit_side1_1.jpg', 7),
(412, 2, 4, 'suit_side2_1.jpg', 7),
(413, 2, 4, 'suit_back_1.jpg', 7),
(414, 2, 4, 'suit_side3_1.jpg', 7),
(415, 2, 4, 'suit_side4_1.jpg', 7),
(416, 2, 5, 'suit_front_1.jpg', 7),
(417, 2, 5, 'suit_side1_1.jpg', 7),
(418, 2, 5, 'suit_side2_1.jpg', 7),
(419, 2, 5, 'suit_back_1.jpg', 7),
(420, 2, 5, 'suit_side3_1.jpg', 7),
(421, 2, 5, 'suit_side4_1.jpg', 7),
(422, 2, 6, 'suit_front_1.jpg', 7),
(423, 2, 6, 'suit_side1_1.jpg', 7),
(424, 2, 6, 'suit_side2_1.jpg', 7),
(425, 2, 6, 'suit_back_1.jpg', 7),
(426, 2, 6, 'suit_side3_1.jpg', 7),
(427, 2, 6, 'suit_side4_1.jpg', 7),
(428, 3, 2, 'suit_front_2.jpg', 7),
(429, 3, 2, 'suit_side1_2.jpg', 7),
(430, 3, 2, 'suit_side2_2.jpg', 7),
(431, 3, 2, 'suit_back_2.jpg', 7),
(432, 3, 2, 'suit_side3_2.jpg', 7),
(433, 3, 2, 'suit_side4_2.jpg', 7),
(434, 3, 3, 'suit_front_2.jpg', 7),
(435, 3, 3, 'suit_side1_2.jpg', 7),
(436, 3, 3, 'suit_side2_2.jpg', 7),
(437, 3, 3, 'suit_back_2.jpg', 7),
(438, 3, 3, 'suit_side3_2.jpg', 7),
(439, 3, 3, 'suit_side4_2.jpg', 7),
(440, 3, 4, 'suit_front_3.jpg', 7),
(441, 3, 4, 'suit_side1_3.jpg', 7),
(442, 3, 4, 'suit_side2_3.jpg', 7),
(443, 3, 4, 'suit_back_3.jpg', 7),
(444, 3, 4, 'suit_side3_3.jpg', 7),
(445, 3, 4, 'suit_side4_3.jpg', 7),
(446, 3, 5, 'suit_front_3.jpg', 7),
(447, 3, 5, 'suit_side1_3.jpg', 7),
(448, 3, 5, 'suit_side2_3.jpg', 7),
(449, 3, 5, 'suit_back_3.jpg', 7),
(450, 3, 5, 'suit_side3_3.jpg', 7),
(451, 3, 5, 'suit_side4_3.jpg', 7),
(452, 3, 6, 'suit_front_3.jpg', 7),
(453, 3, 6, 'suit_side1_3.jpg', 7),
(454, 3, 6, 'suit_side2_3.jpg', 7),
(455, 3, 6, 'suit_back_3.jpg', 7),
(456, 3, 6, 'suit_side3_3.jpg', 7),
(457, 3, 6, 'suit_side4_3.jpg', 7),
(458, 4, 3, 'suit_front_4jpg', 5),
(459, 4, 3, 'suit_side1_4.jpg', 5),
(460, 4, 3, 'suit_side2_4.jpg', 5),
(461, 4, 3, 'suit_back_4.jpg', 5),
(462, 4, 3, 'suit_side3_4.jpg', 5),
(463, 4, 3, 'suit_side4_4.jpg', 7),
(464, 4, 4, 'suit_front_4.jpg', 7),
(465, 4, 4, 'suit_side1_4.jpg', 7),
(466, 4, 4, 'suit_side2_4.jpg', 7),
(467, 4, 4, 'suit_back_4.jpg', 7),
(468, 4, 4, 'suit_side3_4.jpg', 7),
(469, 4, 4, 'suit_side4_4.jpg', 7),
(470, 4, 6, 'suit_front_5.jpg', 7),
(471, 4, 6, 'suit_side1_5.jpg', 7),
(472, 4, 6, 'suit_side2_5.jpg', 7),
(473, 4, 6, 'suit_back_5.jpg', 7),
(474, 4, 6, 'suit_side3_5.jpg', 7),
(475, 4, 6, 'suit_side4_5.jpg', 7),
(476, 4, 5, 'suit_front_5.jpg', 7),
(477, 4, 5, 'suit_side1_5.jpg', 7),
(478, 4, 5, 'suit_side2_5.jpg', 7),
(479, 4, 5, 'suit_back_5.jpg', 7),
(480, 4, 5, 'suit_side3_5.jpg', 7),
(481, 4, 5, 'suit_side4_5.jpg', 7),
(482, 5, 3, 'suit_front_6jpg', 7),
(483, 5, 3, 'suit_side1_6.jpg', 7),
(484, 5, 3, 'suit_side2_6.jpg', 7),
(485, 5, 3, 'suit_back_6.jpg', 7),
(486, 5, 3, 'suit_side3_6.jpg', 7),
(487, 5, 3, 'suit_side4_6.jpg', 7),
(488, 5, 4, 'suit_front_6.jpg', 7),
(489, 5, 4, 'suit_side1_6.jpg', 7),
(490, 5, 4, 'suit_side2_6.jpg', 7),
(491, 5, 4, 'suit_back_6.jpg', 7),
(492, 5, 4, 'suit_side3_6.jpg', 7),
(493, 5, 4, 'suit_side4_6.jpg', 7),
(494, 5, 5, 'suit_front_6.jpg', 7),
(495, 5, 5, 'suit_side1_6.jpg', 7),
(496, 5, 5, 'suit_side2_6.jpg', 7),
(497, 5, 5, 'suit_back_6.jpg', 7),
(498, 5, 5, 'suit_side3_6.jpg', 7),
(499, 5, 5, 'suit_side4_6.jpg', 7),
(500, 5, 6, 'suit_front_8.jpg', 7),
(501, 5, 6, 'suit_side1_8.jpg', 7),
(502, 5, 6, 'suit_side2_8.jpg', 7),
(503, 5, 6, 'suit_back_8.jpg', 7),
(504, 5, 6, 'suit_side3_8.jpg', 7),
(505, 5, 6, 'suit_side4_8.jpg', 7);

-- --------------------------------------------------------

--
-- Table structure for table `fitting_height`
--

CREATE TABLE `fitting_height` (
  `fittingheight_id` int(11) NOT NULL,
  `fittingheight_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fitting_height`
--

INSERT INTO `fitting_height` (`fittingheight_id`, `fittingheight_title`) VALUES
(1, '150'),
(2, '160'),
(3, '170'),
(4, '180'),
(5, '190');

-- --------------------------------------------------------

--
-- Table structure for table `fitting_weight`
--

CREATE TABLE `fitting_weight` (
  `fittingweight_id` int(11) NOT NULL,
  `fittingweight_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fitting_weight`
--

INSERT INTO `fitting_weight` (`fittingweight_id`, `fittingweight_title`) VALUES
(1, '40'),
(2, '50'),
(3, '60'),
(4, '70'),
(5, '80'),
(6, '90');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(255) NOT NULL,
  `outgoing_msg_id` int(255) NOT NULL,
  `msg` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(1, 1480164470, 1565309945, 'hi');

-- --------------------------------------------------------

--
-- Table structure for table `payment_cart`
--

CREATE TABLE `payment_cart` (
  `paymentcart_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_cart`
--

INSERT INTO `payment_cart` (`paymentcart_id`, `cust_id`, `product_id`, `quantity`) VALUES
(20, 1, 2, 1),
(21, 1, 2, 1),
(22, 1, 2, 1),
(23, 1, 2, 2),
(24, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_cat` int(11) NOT NULL,
  `product_brand` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `product_desc` text NOT NULL,
  `product_materialused` text NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_cat`, `product_brand`, `product_title`, `product_price`, `product_desc`, `product_materialused`, `product_image`, `product_keywords`) VALUES
(1, 1, 2, 'Men\\\'s Paul Frank Julius and Friends T-Shirt', '99.00', 'Test', 'Cotton', 'test.png', 'Monkey'),
(2, 1, 1, 'Mario', '199.00', 'Nice', 'Silly', 'Mario_t_shirt.jpg', 'Mario'),
(5, 1, 3, 'T-Shirt', '99.00', 'Casual ', 'Cloth', 't-shirt.jpg', 'Shirt and Pants'),
(6, 5, 3, 'One Shoulder Dress', '1999.00', 'Suitable for a dinner meeting with boyfriends or husbands.', 'Cotton, Bling Star, Cloth', 'oneshoulder.jpg', 'One Shoulder'),
(7, 4, 3, 'Suit', '3999.00', 'Suitable for interview and dinner ', 'Cloth', 'suit.jpg', 'Suit');

-- --------------------------------------------------------

--
-- Table structure for table `products_info`
--

CREATE TABLE `products_info` (
  `productsinfo_id` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products_info`
--

INSERT INTO `products_info` (`productsinfo_id`, `size`, `color`, `quantity`, `product`) VALUES
(1, 3, 3, 0, 2),
(2, 2, 2, 0, 2),
(3, 3, 3, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE `ratings` (
  `rating_id` int(11) NOT NULL,
  `rating` varchar(255) DEFAULT NULL,
  `review` varchar(255) DEFAULT NULL,
  `cust_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`rating_id`, `rating`, `review`, `cust_id`) VALUES
(1, '3', 'try', 1),
(2, '3', 'try', 1);

-- --------------------------------------------------------

--
-- Table structure for table `size`
--

CREATE TABLE `size` (
  `size_id` int(11) NOT NULL,
  `size_title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `size`
--

INSERT INTO `size` (`size_id`, `size_title`) VALUES
(1, 'S'),
(2, 'XL'),
(3, 'M'),
(4, 'XXL');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `cust_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `reset_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`cust_id`, `username`, `email`, `password`, `gender`, `dob`, `address`, `registration_date`, `reset_token`) VALUES
(1, 'Tommy', 'drbread2002@gmail.com', '$2y$10$5w20vtrjNiLIwRl9JF6iLOu9RcGhN2jgSVXOq1B1SS6eMo3Im4w7G', 'male', '2023-10-02', '3B-17-03 N-Park, Jalan Batu Uban', '2023-10-16', NULL),
(2, 'T', 'tommytan2002@hotmail.com', '$2y$10$IeU.fZHsLJV6/tCC3ieKO.O504Bjkc18QzC.qHXr8KWhRw80lzb7G', 'male', '0000-00-00', '', '2023-11-05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `wishlist_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wishlist`
--

INSERT INTO `wishlist` (`wishlist_id`, `cust_id`, `product_id`) VALUES
(7, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `chatusers`
--
ALTER TABLE `chatusers`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`checkout_id`),
  ADD KEY `user` (`user`),
  ADD KEY `payment_cart` (`payment_cart`);

--
-- Indexes for table `color`
--
ALTER TABLE `color`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `creditcards`
--
ALTER TABLE `creditcards`
  ADD PRIMARY KEY (`card_id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `fittingroom`
--
ALTER TABLE `fittingroom`
  ADD PRIMARY KEY (`fittingroom_id`),
  ADD KEY `fittingheight` (`fittingheight`),
  ADD KEY `fittingweight` (`fittingweight`),
  ADD KEY `products` (`products`);

--
-- Indexes for table `fitting_height`
--
ALTER TABLE `fitting_height`
  ADD PRIMARY KEY (`fittingheight_id`);

--
-- Indexes for table `fitting_weight`
--
ALTER TABLE `fitting_weight`
  ADD PRIMARY KEY (`fittingweight_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `payment_cart`
--
ALTER TABLE `payment_cart`
  ADD PRIMARY KEY (`paymentcart_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `product_cat` (`product_cat`),
  ADD KEY `product_brand` (`product_brand`);

--
-- Indexes for table `products_info`
--
ALTER TABLE `products_info`
  ADD PRIMARY KEY (`productsinfo_id`),
  ADD KEY `size` (`size`),
  ADD KEY `color` (`color`),
  ADD KEY `product` (`product`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `cust_id` (`cust_id`);

--
-- Indexes for table `size`
--
ALTER TABLE `size`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`wishlist_id`),
  ADD KEY `cust_id` (`cust_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chatusers`
--
ALTER TABLE `chatusers`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `checkout_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `color`
--
ALTER TABLE `color`
  MODIFY `color_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `creditcards`
--
ALTER TABLE `creditcards`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fittingroom`
--
ALTER TABLE `fittingroom`
  MODIFY `fittingroom_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=506;

--
-- AUTO_INCREMENT for table `fitting_height`
--
ALTER TABLE `fitting_height`
  MODIFY `fittingheight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `fitting_weight`
--
ALTER TABLE `fitting_weight`
  MODIFY `fittingweight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment_cart`
--
ALTER TABLE `payment_cart`
  MODIFY `paymentcart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products_info`
--
ALTER TABLE `products_info`
  MODIFY `productsinfo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `size`
--
ALTER TABLE `size`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `wishlist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `user` (`cust_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`cust_id`),
  ADD CONSTRAINT `checkout_ibfk_2` FOREIGN KEY (`payment_cart`) REFERENCES `payment_cart` (`paymentcart_id`);

--
-- Constraints for table `creditcards`
--
ALTER TABLE `creditcards`
  ADD CONSTRAINT `creditcards_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`cust_id`);

--
-- Constraints for table `payment_cart`
--
ALTER TABLE `payment_cart`
  ADD CONSTRAINT `payment_cart_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `user` (`cust_id`),
  ADD CONSTRAINT `payment_cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`product_cat`) REFERENCES `category` (`cat_id`),
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`product_brand`) REFERENCES `brands` (`brand_id`);

--
-- Constraints for table `products_info`
--
ALTER TABLE `products_info`
  ADD CONSTRAINT `products_info_ibfk_1` FOREIGN KEY (`size`) REFERENCES `size` (`size_id`),
  ADD CONSTRAINT `products_info_ibfk_2` FOREIGN KEY (`color`) REFERENCES `color` (`color_id`),
  ADD CONSTRAINT `products_info_ibfk_3` FOREIGN KEY (`product`) REFERENCES `products` (`product_id`);

--
-- Constraints for table `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `user` (`cust_id`);

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `user` (`cust_id`),
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
