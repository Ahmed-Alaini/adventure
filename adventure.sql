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
  `username` VARCHAR(255) DEFAULT NULL,
  `password` VARCHAR(255) DEFAULT NULL,
  `email` VARCHAR(255) DEFAULT NULL,
  `id_number` VARCHAR(10) DEFAULT NULL,
  `birth_date` DATE DEFAULT NULL,
  `city` VARCHAR(255) DEFAULT NULL,
  `phone` VARCHAR(10) DEFAULT NULL,
  `gender` VARCHAR(10) DEFAULT NULL,
  `image` VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



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

INSERT INTO `trips` (`image`, `location`, `description`, `rating`, `price`, `original_price`, `link`) VALUES
('p-1.jpg', 'العلا', 'جبال الصخرة الجرة', 4, 120.00, 250.00, 'alula.php'),
('p-2.jpg', 'المدينة المنورة', 'جبل أحد', 4, 120.00, 250.00, 'medina.php'),
('p-3.jpg', 'الرياض', 'جبل طويق', 4, 120.00, 250.00, 'riyadh.php'),
('p-4.jpg', 'حائل', 'جبال اجا', 4, 120.00, 250.00, 'hail.php'),
('p-5.jpg', 'الطائف', 'جبال دكا', 4, 120.00, 250.00, 'taif.php'),
('p-6.jpg', 'عسير', 'جبال السروات', 4, 120.00, 250.00, 'asir.php');

 



--
-- Table structure for `bookings`
--

CREATE TABLE `bookings` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `num_people` INT(11) NOT NULL,
  `trip_date` DATE NOT NULL,
  `booked` TINYINT(1) NOT NULL DEFAULT 0,
  `payment_method` VARCHAR(50) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `user_id` INT(11) DEFAULT NULL,
  `trip_id` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `bookings_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `bookings_fk_trip_id` FOREIGN KEY (`trip_id`) REFERENCES `trips` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Data for table `bookings`
--

------------------------------------------------
-- Table structure for `contact_messages`
--

CREATE TABLE `comments` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `subject` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `sent_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `user_id` INT(11) DEFAULT NULL,
  CONSTRAINT `contact_fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

ALTER TABLE `comments`
ADD COLUMN `rating` INT(1) NOT NULL,
ADD CONSTRAINT `rating_check` CHECK (`rating` BETWEEN 1 AND 5);


COMMIT;