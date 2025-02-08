-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3308
-- Generation Time: Feb 08, 2025 at 01:51 PM
-- Server version: 9.1.0
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shariefguesthouse_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking_tbl`
--

DROP TABLE IF EXISTS `booking_tbl`;
CREATE TABLE IF NOT EXISTS `booking_tbl` (
  `id` int NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `checkin_date` date NOT NULL,
  `checkout_date` date NOT NULL,
  `guests` int NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `booking_id` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `remarks` text,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `booking_id` (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_tbl`
--

INSERT INTO `booking_tbl` (`id`, `full_name`, `email`, `phone`, `checkin_date`, `checkout_date`, `guests`, `room_type`, `created_at`, `booking_id`, `status`, `remarks`, `updated_at`) VALUES
(1, 'Aamir', 'aan@gmail.co', '9797101010', '2025-02-07', '2025-02-08', 3, '1', '2025-02-06 17:28:47', 'SGH-0024', 'Cancelled', 'sfsdfsdfsdf', '2025-02-07 18:13:47'),
(2, 'Aamir', 'aan@gmail.co', '9797101010', '2025-02-07', '2025-02-08', 3, '1', '2025-02-07 17:28:47', 'SGH-0025', 'Confirmed', 'sdfsdfsd', '2025-02-07 18:05:39'),
(3, 'asdas', 'asdas@gmail.com', 'asdas', '2025-02-08', '2025-02-08', 0, 'Double Room', '2025-02-07 20:39:48', 'SGH-26', 'Pending', NULL, '2025-02-07 20:39:48'),
(4, 'asdas', 'asdas@gmail.com', 'asdas', '2025-02-08', '2025-02-08', 0, 'Double Room', '2025-02-07 20:43:29', 'SGH-27', 'Cancelled', 'I don\'t like you', '2025-02-07 20:46:09');

-- --------------------------------------------------------

--
-- Table structure for table `room_types_tbl`
--

DROP TABLE IF EXISTS `room_types_tbl`;
CREATE TABLE IF NOT EXISTS `room_types_tbl` (
  `id` int NOT NULL AUTO_INCREMENT,
  `room_type` varchar(50) NOT NULL,
  `status` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_types_tbl`
--

INSERT INTO `room_types_tbl` (`id`, `room_type`, `status`) VALUES
(1, 'Single Room', 1),
(2, 'Double Room', 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `setting_id` int NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `favicon` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `site_align` varchar(50) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `title`, `description`, `email`, `phone`, `logo`, `favicon`, `language`, `site_align`, `footer_text`) VALUES
(1, 'Sharief Guest house', 'Sharief Guest house', 'shariefguesthouse@gmail.com', '9797813577', 'uploads/site/logo/2022-02-25/S2.jpg', 'uploads/site/logo/2022-02-25/f.png', '0', NULL, '2022©Copy Sharief Guest house');

-- --------------------------------------------------------

--
-- Table structure for table `user_role_tbl`
--

DROP TABLE IF EXISTS `user_role_tbl`;
CREATE TABLE IF NOT EXISTS `user_role_tbl` (
  `ur_id` int NOT NULL AUTO_INCREMENT,
  `ur_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ur_status` int NOT NULL,
  PRIMARY KEY (`ur_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_role_tbl`
--

INSERT INTO `user_role_tbl` (`ur_id`, `ur_name`, `ur_status`) VALUES
(1, 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

DROP TABLE IF EXISTS `user_tbl`;
CREATE TABLE IF NOT EXISTS `user_tbl` (
  `u_id` int NOT NULL,
  `u_user_role` int NOT NULL,
  `u_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `u_username` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `u_email` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `u_password` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `u_mobile` varchar(15) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `u_adress` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `u_picture` varchar(11) COLLATE utf8mb4_general_ci NOT NULL,
  `u_doc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `u_dou` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `u_status` int NOT NULL,
  PRIMARY KEY (`u_id`),
  KEY `u_user_role` (`u_user_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`u_id`, `u_user_role`, `u_name`, `u_username`, `u_email`, `u_password`, `u_mobile`, `u_adress`, `u_picture`, `u_doc`, `u_dou`, `u_status`) VALUES
(1, 1, 'Admin', 'admin', 'admin@sgh.com', '21232f297a57a5a743894a0e4a801fc3', NULL, '', '', '2025-02-08 12:44:49', '2025-02-08 12:44:49', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
