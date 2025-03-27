-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 17, 2025 at 08:59 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `templers_cafe`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `adm_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `code` varchar(222) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`adm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
(1, 'admin0', 'e10adc3949ba59abbe56e057f20f883e', 'admin@mail.com', '1', '2025-02-09 11:37:55'),
(2, 'admin1', 'e10adc3949ba59abbe56e057f20f883e', 'ad2@gmail.com', '23', '2025-02-09 11:38:54'),
(3, 'admin2', 'e10adc3949ba59abbe56e057f20f883e', 'ad3@gmail.com', '34', '2025-02-09 11:40:19'),
(4, 'admin3', 'e10adc3949ba59abbe56e057f20f883e', 'ad4@gmail.com', '66', '2025-02-09 11:41:18'),
(5, 'admin4', '827ccb0eea8a706c4c34a16891f84e7b', 'ad5@gmail.com', '99', '2025-02-09 11:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

DROP TABLE IF EXISTS `contact_messages`;
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `contact_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `contact_message` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `contact_name`, `contact_email`, `contact_message`, `created_at`) VALUES
(1, 'clarkent', 'clark@gmail.com', 'Best', '2025-03-16 15:57:30'),
(3, 'peter', 'peter@gmail.com', 'need more categories', '2025-03-17 08:44:46'),
(4, 'bruce', 'bruce@gmail.com', 'improve', '2025-03-17 08:46:01'),
(5, 'oliver', 'oliver@gmail.com', 'add more items', '2025-03-17 08:47:58'),
(6, 'dexter', 'dexter@gmail.com', 'need to add more categories', '2025-03-17 08:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `dishes`
--

DROP TABLE IF EXISTS `dishes`;
CREATE TABLE IF NOT EXISTS `dishes` (
  `d_id` int NOT NULL AUTO_INCREMENT,
  `ff_id` int NOT NULL,
  `title` varchar(222) NOT NULL,
  `slogan` varchar(222) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `img` varchar(222) NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `dishes`
--

INSERT INTO `dishes` (`d_id`, `ff_id`, `title`, `slogan`, `price`, `img`) VALUES
(1, 2, 'Beef burger', 'A quarter pound flattened piece of meat typically a beef mixture that has been shaped into a circle and covered with a slice of cheese.', 2450.00, '6790947e7b601.jpg'),
(2, 3, 'Cappuccino', 'A freshly pulled shot of espresso layered with steamed whole milk and thick rich foam to offer a luxurious velvety texture and complex aroma.', 1150.00, '6790955a1ff7b.jpg'),
(3, 1, 'Mocha chocolate marathon', 'a shot of espresso is combined with chocolate powder or syrup, followed by milk or cream.', 1200.00, '67909610bb6cf.jpg'),
(4, 4, 'Sea food rice', 'encompasses all commercially obtained freshwater and saltwater fish, molluscan shellfish, and crustaceans.', 1150.00, '679096fce876b.jpg'),
(5, 5, 'Chocolate fudge cake', 'creamy candy made with butter, sugar, milk, and usually chocolate, cooked together and beaten to a soft, smooth texture.', 900.00, '679098ae48416.jpg'),
(6, 4, 'Templers special rice', 'an easy and flavorful Chinese rice dish made by stir-frying cooked rice with vegetables and protein, seasoned with soy sauce and spices.', 3550.00, '679099817de37.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `featured_food`
--

DROP TABLE IF EXISTS `featured_food`;
CREATE TABLE IF NOT EXISTS `featured_food` (
  `ff_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(222) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ff_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `featured_food`
--

INSERT INTO `featured_food` (`ff_id`, `title`, `description`, `image`, `date`) VALUES
(1, 'Beverages', 'Tasty', '67908fb4483dd.jpg', '2025-01-22 07:10:26'),
(2, 'Burger', 'Best', '67908fc096c67.jpg', '2025-01-22 07:10:42'),
(3, 'Coffee', 'Hot', '67908f9dea63d.jpg', '2025-01-22 07:11:17'),
(4, 'Fried-Rice', 'Delicious', '67908f6fcb031.jpg', '2025-01-22 07:11:35'),
(5, 'Desserts', 'Top', '679090dcd023b.jpg', '2025-01-22 07:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `remark`
--

DROP TABLE IF EXISTS `remark`;
CREATE TABLE IF NOT EXISTS `remark` (
  `id` int NOT NULL AUTO_INCREMENT,
  `frm_id` int NOT NULL,
  `status` varchar(255) NOT NULL,
  `remark` mediumtext NOT NULL,
  `remarkDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `remark`
--

INSERT INTO `remark` (`id`, `frm_id`, `status`, `remark`, `remarkDate`) VALUES
(13, 6, 'closed', 'success', '2025-01-14 07:05:47'),
(14, 6, 'closed', 'good', '2025-01-14 07:06:16'),
(15, 2, 'closed', 'ok', '2025-01-18 18:22:37'),
(16, 27, 'closed', 'ok', '2025-01-19 11:29:26'),
(17, 32, 'closed', 'success', '2025-02-09 11:47:08'),
(18, 33, 'closed', 'good', '2025-02-09 11:49:17'),
(19, 34, 'closed', 'good', '2025-02-09 11:49:42'),
(20, 35, 'closed', 'good', '2025-02-09 11:50:14'),
(21, 36, 'closed', 'good', '2025-02-09 11:50:33'),
(22, 37, 'rejected', 'cancelled', '2025-03-10 15:45:35'),
(23, 38, 'in process', 'on the way', '2025-03-10 15:46:11');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `guests` int NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `special_requests` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `name`, `email`, `phone`, `guests`, `date`, `time`, `special_requests`, `created_at`) VALUES
(2, 'oliver queen', 'oliver@gmail.com', '0112435785', 3, '2025-02-18', '21:09:00', 'front', '2025-02-09 11:35:23'),
(3, 'oliver queen', 'oliver@gmail.com', '0112435785', 5, '2025-03-03', '22:11:00', 'back', '2025-02-09 11:36:22'),
(4, 'bruce wayne', 'bruce@gmail.com', '0112435782', 2, '2025-02-27', '20:17:00', 'front', '2025-02-09 11:44:26'),
(5, 'bruce wayne', 'bruce@gmail.com', '0112435782', 4, '2025-03-04', '22:20:00', 'back', '2025-02-09 11:45:27'),
(17, 'clarkkent', 'clark@gmail.com', '0112435784', 1, '2025-03-25', '11:51:00', 'back', '2025-03-16 15:18:53');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `review_text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `rating` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `customer_name`, `review_text`, `rating`, `created_at`) VALUES
(1, 'clark', 'better', 4, '2025-03-16 16:15:15'),
(3, 'dexter', 'Best food', 5, '2025-03-17 08:38:17'),
(4, 'bruce', 'quality service', 4, '2025-03-17 08:39:05'),
(7, 'oliver', 'Good location', 4, '2025-03-17 08:50:46'),
(6, 'peter', 'Good menu', 5, '2025-03-17 08:41:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `u_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(222) NOT NULL,
  `f_name` varchar(222) NOT NULL,
  `l_name` varchar(222) NOT NULL,
  `email` varchar(222) NOT NULL,
  `phone` varchar(222) NOT NULL,
  `password` varchar(222) NOT NULL,
  `address` text NOT NULL,
  `status` int NOT NULL DEFAULT '1',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `loyalty_points` int DEFAULT '0',
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`, `loyalty_points`) VALUES
(10, 'clark', 'Clark', 'Kent', 'clark@gmail.com', '0112456679', 'e10adc3949ba59abbe56e057f20f883e', 'kohuwala', 1, '2025-03-10 15:36:27', 1400),
(11, 'peter', 'Peter', 'Parker', 'peter@gmail.com', '0112435789', 'e10adc3949ba59abbe56e057f20f883e', 'horana', 1, '2025-02-09 05:17:26', 1500),
(12, 'dexter', 'dexter', 'morgan', 'dexter@gmail.com', '0112435789', 'e10adc3949ba59abbe56e057f20f883e', 'colombo', 1, '2025-02-09 11:27:40', 1700),
(13, 'bruce', 'bruce', 'wayne', 'bruce@gmail.com', '0112435782', 'e10adc3949ba59abbe56e057f20f883e', 'polgasowita', 1, '2025-02-09 11:33:07', 1500),
(14, 'oliver', 'oliver', 'queen', 'oliver@gmail.com', '0112435785', 'e10adc3949ba59abbe56e057f20f883e', 'piliyandala', 1, '2025-02-09 11:34:34', 1500);

-- --------------------------------------------------------

--
-- Table structure for table `users_orders`
--

DROP TABLE IF EXISTS `users_orders`;
CREATE TABLE IF NOT EXISTS `users_orders` (
  `o_id` int NOT NULL AUTO_INCREMENT,
  `u_id` int NOT NULL,
  `title` varchar(222) NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` varchar(222) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`o_id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users_orders`
--

INSERT INTO `users_orders` (`o_id`, `u_id`, `title`, `quantity`, `price`, `status`, `date`) VALUES
(33, 12, 'Beef burger', 4, 2450.00, 'closed', '2025-02-09 11:49:17'),
(34, 12, 'Sea food rice', 2, 1150.00, 'closed', '2025-02-09 11:49:42'),
(35, 12, 'Templers special rice', 1, 3550.00, 'closed', '2025-02-09 11:50:14'),
(36, 14, 'Cappuccino', 1, 1150.00, 'closed', '2025-02-09 11:50:33'),
(37, 10, 'Cappuccino', 1, 1150.00, 'rejected', '2025-03-10 15:45:35'),
(38, 10, 'Beef burger', 2, 2450.00, 'in process', '2025-03-10 15:46:11');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
