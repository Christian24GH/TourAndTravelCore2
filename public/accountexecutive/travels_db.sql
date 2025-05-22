-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2025 at 12:12 PM
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
-- Database: `travels_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `gender` enum('m','f','o') DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dateofbirth` date DEFAULT NULL,
  `role` enum('client','employee','admin') NOT NULL DEFAULT 'client',
  `email` varchar(100) NOT NULL,
  `contact_no` varchar(15) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`user_id`, `username`, `password`, `firstname`, `lastname`, `gender`, `address`, `dateofbirth`, `role`, `email`, `contact_no`, `notes`, `created_at`, `updated_at`) VALUES
(2, 'ron', '$2y$10$yLpY74NKjHO/4iwi3FqdV.BbAPLY6IibrIw26Lk87A8rw9suAth0G', 'Ron Dave', 'Insigne', 'm', 'Mendez', '2003-07-21', 'admin', 'ron', '912345678', 'main admin', '2024-11-23 05:57:38', '2025-03-04 15:23:55'),
(4, 'shizue', '$2y$10$reyp/8I1/U0vNXyOoFjouOLiXPshg6R8M08BKGstZ7TF6BToy/GD.', 'Mark Jade', 'Malisa', 'm', 'Nitang', '2000-01-01', 'employee', 'shizue', '912345678', 'heil hi-', '2024-11-23 05:57:38', '2025-03-04 15:23:56'),
(5, 'bankai', '$2y$10$GBMvWcCZnSwLsCBfukviXuPpdb5cnm1kuxeSI.UDHcv0OWGijYrQ6', 'Ivan Christopher', 'Bullo', 'm', 'Brgy. Manotoc', '2004-02-07', 'admin', 'bankai', '912345678', 'nang-f-flash ng kampi', '2024-11-23 05:57:38', '2025-03-04 15:23:56'),
(9, 'kent', '$2y$10$6walkLV94HwxGYCXuNDgMuK7IZFz6GKCyKzesH0ZYSGQXFrKHlMgq', 'Kent Cedric', 'Ancheta', 'm', 'Sangandaan', '2004-08-02', 'client', 'kent', '912345678', 'nagyayaya ng suntukan\r\n', '2024-11-23 05:57:38', '2025-03-04 15:23:56'),
(13, 'areyousure', '$2y$10$pFw1.hj7DQW9NJMqOr80LOAbdltqZgqfsld.xH/lRfb/MRa1drvRy', 'Rolando', 'Dela Pena', 'm', 'Talipapa', '2001-07-01', 'client', 'rolando', '912345678', 'lagi maganda nasa isip, nabaliw', '2024-11-23 05:57:38', '2025-03-04 15:23:56'),
(14, 'mark', '$2y$10$fqRrIePey8vJ5F4.SnIA/O3QquDM2NUmsd/8S6xkHGg/oFTsr.xx2', 'Mark Angelo', 'Painagan', 'm', 'Talipapa', '2003-12-12', 'employee', 'mark', '912345678', 'clan war grinderist', '2024-11-23 05:57:38', '2025-03-04 15:23:57'),
(24, 'balacy', '$2y$10$FYCo0SSavYXnW7Af3m03QezhmT63mpq46lN8VJDZEUkf4OS01yA22', 'John Mark', 'Balacy', 'm', 'Commonwealth Ave.', '2022-01-18', 'employee', 'balacy', '912345678', 'ryujin', '2024-11-23 05:57:38', '2025-03-04 15:23:57'),
(35, 'doritos', '$2y$10$4knMQEAhG9LUV9ff3GowHOOJS98o.GXFWXjYYOu3r0KGinKexS7di', 'Rainbow', 'Summer', 'f', 'Quezon City', '2006-05-29', 'admin', 'doritos@gmail.com', '09205292005', 'i like drums', '2025-03-04 14:39:10', '2025-03-04 15:23:57'),
(36, 'red', '$2y$10$cpS8KAHWV6sAt74438BiyuWU..xu8sjmIplXTHBNnsuGL/mlxmvsG', 'North', 'Walker', 'o', 'Norway', '2007-04-21', 'admin', 'north@gmail.com', '09904212007', 'ktaaaaa', '2025-03-07 08:07:48', '2025-03-07 08:50:00'),
(37, 'boy', '$2y$10$1X4.KLPpmH8Wx0ulsWiGHer7wmwgJOzvI9Gdtf1RvhcTe5sJLhv0m', 'One', 'Person', 'm', 'Quezon City', '2007-02-21', 'admin', 'boy@gmail.com', '09902212007', 'boi', '2025-03-07 08:55:01', NULL),
(47, 'jiji', '$2y$10$jrO6cK6i2/rUhr9S7R4hfuaixSyRbfajFZYwBlc2v30ZpOxi7IgTu', 'jijigen', 'genggeng', 'f', 'nihon desu', '1999-02-16', 'client', 'jiji@gmail.com', NULL, 'kusojiji', '2025-04-17 13:25:13', NULL),
(48, 'atesh', '$2y$10$.ebac28moSfzdFqEF.U0wubuwT.nKUnhmCRtdarrxoe1cbWA1OPoK', 'Chester', 'Barry', 'm', 'Holy Cross', '2003-07-21', '', 'dapatnapochesterbarry@gmail.com', NULL, 'TITE', '2025-04-23 08:06:44', NULL),
(49, 'asdf', '$2y$10$222uAiSMQZRJYZmtk1OTvuJhn7ak.8jrEVO3iY1UFdypGTqCnIXv.', 'asdf', 'asdf', 'f', 'asdf', '2025-04-02', '', 'asdf@gmail.com', NULL, 'asdf', '2025-04-23 08:08:36', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
