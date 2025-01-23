-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 23, 2025 at 06:51 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adm_id`, `username`, `password`, `email`, `code`, `date`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'admin@mail.com', '1', '2025-01-19 18:06:01');

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `username`, `f_name`, `l_name`, `email`, `phone`, `password`, `address`, `status`, `date`, `loyalty_points`) VALUES
(8, 'dexter', 'Dexter', 'Morgan', 'dex@gmail.com', '0112707817', 'e10adc3949ba59abbe56e057f20f883e', 'horana', 1, '2025-01-20 04:14:07', 1500),
(9, 'queen', 'oliver', 'queen', 'queen@gmail.com', '0112707817', '25f9e794323b453885f5181f1b624d0b', 'colombo', 1, '2025-01-21 14:29:38', 1500),
(10, 'bruce', 'Bruce', 'Wayne', 'brucewayne@gmail.com', '0112799999', 'e10adc3949ba59abbe56e057f20f883e', 'colombo', 1, '2025-01-23 06:39:48', 1500),
(11, 'clark', 'Clark', 'Kent', 'clark@gmail.com', '0112456679', 'e10adc3949ba59abbe56e057f20f883e', 'kohuwala', 1, '2025-01-23 06:42:10', 1500),
(12, 'peter', 'Peter', 'Parker', 'peter@gmail.com', '0112435789', 'e10adc3949ba59abbe56e057f20f883e', 'nugegoda', 1, '2025-01-23 06:45:08', 1500);

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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_orders`
--

INSERT INTO `users_orders` (`o_id`, `u_id`, `title`, `quantity`, `price`, `status`, `date`) VALUES
(28, 8, 'Mocha chocolate marathon', 5, 1200.00, NULL, '2025-01-23 05:51:07'),
(29, 12, 'Sea food rice', 1, 1150.00, NULL, '2025-01-23 06:46:53'),
(30, 12, 'Templers special rice', 1, 3550.00, NULL, '2025-01-23 06:46:53'),
(31, 12, 'Beef burger', 4, 2450.00, NULL, '2025-01-23 06:47:28'),
(32, 12, 'Chocolate fudge cake', 2, 900.00, NULL, '2025-01-23 06:48:24');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
