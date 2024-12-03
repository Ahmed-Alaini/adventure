-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 26 نوفمبر 2024 الساعة 11:56
-- إصدار الخادم: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

START TRANSACTION;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adventure`
--

-- --------------------------------------------------------

-- --------------------------------------------------------

--
-- Table structure for `users`
--

CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `fullname` VARCHAR(255) DEFAULT NULL,
  `username` VARCHAR(255) DEFAULT NULL UNIQUE,
  `password` VARCHAR(255) DEFAULT NULL,
  `email` VARCHAR(255) DEFAULT NULL,
  `id_number` VARCHAR(10) DEFAULT NULL,
  `birth_date` DATE DEFAULT NULL,
  `city` VARCHAR(255) DEFAULT NULL,
  `phone` VARCHAR(10) DEFAULT NULL,
  `gender` VARCHAR(10) DEFAULT NULL,
  `medical_record` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Table structure for `bookings`
--

CREATE TABLE `bookings` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `num_people` INT(11) NOT NULL,
  `trip_date` DATE NOT NULL,
  `payment_method` VARCHAR(50) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `user_id` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Data for table `bookings`
--

INSERT INTO `bookings` (`id`, `num_people`, `trip_date`, `payment_method`, `created_at`, `user_id`) VALUES
(1, 13, '2024-11-14', 'bank-transfer', '2024-11-26 08:45:18', NULL),
(2, 13, '2024-11-14', 'bank-transfer', '2024-11-26 09:28:38', NULL),
(3, 4, '2024-11-20', 'credit-card', '2024-11-26 10:18:42', NULL),
(4, 8, '2024-11-22', 'bank-transfer', '2024-11-26 10:21:12', NULL),
(5, 4, '2024-11-29', 'credit-card', '2024-11-26 10:25:51', NULL),
(6, 8, '2024-11-22', 'bank-transfer', '2024-11-26 10:31:57', NULL),
(7, 2, '2024-11-28', 'paypal', '2024-11-26 10:32:28', NULL),
(8, 4, '2024-11-22', 'credit-card', '2024-11-26 10:35:03', NULL),
(9, 4, '2024-11-22', 'paypal', '2024-11-26 10:35:50', NULL),
(10, 4, '2024-11-26', 'paypal', '2024-11-26 10:36:20', NULL),
(11, 4, '2024-11-19', 'credit-card', '2024-11-26 10:38:52', NULL),
(12, 7, '2024-10-29', 'credit-card', '2024-11-26 10:54:28', NULL),
(13, 7, '2024-10-29', 'credit-card', '2024-11-26 10:55:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `subject` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `sent_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for `trips`
--

CREATE TABLE `trips` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `image` VARCHAR(255) DEFAULT NULL,
  `location` VARCHAR(255) DEFAULT NULL,
  `description` TEXT DEFAULT NULL,
  `rating` INT(11) DEFAULT NULL,
  `price` DECIMAL(10,2) DEFAULT NULL,
  `original_price` DECIMAL(10,2) DEFAULT NULL,
  `link` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Data for table `trips`
--

INSERT INTO `trips` (`id`, `image`, `location`, `description`, `rating`, `price`, `original_price`, `link`) VALUES
(1, 'p-1.jpg', 'العلا', 'جبال الصخرة الجرة', 4, 120.00, 250.00, 'alula.php'),
(2, 'p-2.jpg', 'المدينة المنورة', 'جبل أحد', 4, 120.00, 250.00, 'medina.php'),
(3, 'p-3.jpg', 'الرياض', 'جبل طويق', 4, 120.00, 250.00, 'riyadh.php'),
(4, 'p-4.jpg', 'حائل', 'جبال اجا', 4, 120.00, 250.00, 'hail.php'),
(5, 'p-5.jpg', 'الطائف', 'جبال دكا', 4, 120.00, 250.00, 'taif.php'),
(6, 'p-6.jpg', 'عسير', 'جبال السروات', 4, 120.00, 250.00, 'asir.php');


COMMIT;