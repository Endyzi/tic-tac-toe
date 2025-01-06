-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: tic_tac_toe_test_db:3306
-- Generation Time: Jan 06, 2025 at 07:46 PM
-- Server version: 10.6.3-MariaDB-1:10.6.3+maria~focal
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tic_tac_toe`
--

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE `players` (
  `player_id` int(10) UNSIGNED NOT NULL COMMENT 'Player ID',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Player name',
  `grid_size` int(11) NOT NULL DEFAULT 3 COMMENT 'Grid size',
  `play_time_seconds` int(11) NOT NULL DEFAULT 0 COMMENT 'Play time in seconds',
  `ctime` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'Date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`player_id`, `name`, `grid_size`, `play_time_seconds`, `ctime`) VALUES
(1, 'Player 1', 10, 40, '2023-09-20 14:01:23'),
(2, 'Alex', 10, 244, '2023-09-21 15:41:51'),
(3, 'Maria', 8, 100, '2023-09-22 13:22:12'),
(4, 'User123', 5, 10, '2023-09-23 01:51:01'),
(5, 'pelle', 3, 60, '2025-01-05 13:22:57'),
(6, 'Felicia', 4, 18, '2025-01-05 13:22:57'),
(7, 'Gabriel', 3, 60, '2025-01-05 13:22:57'),
(8, 'Sofia', 4, 18, '2025-01-05 13:22:57'),
(9, 'iwinalways', 10, 40, '2023-09-20 14:01:23'),
(10, 'best_', 10, 324, '2023-09-21 15:41:51'),
(11, 'Amanda', 10, 100, '2023-09-22 13:22:12'),
(12, 'cian', 5, 10, '2023-09-23 01:51:01'),
(13, 'peter', 3, 60, '2025-01-05 13:22:57'),
(14, 'Fia', 4, 18, '2025-01-05 13:22:57'),
(15, 'Niel', 3, 60, '2025-01-05 13:22:57'),
(16, 'Judy', 4, 18, '2025-01-05 13:22:57'),
(17, 'Wesker', 3, 60, '2025-01-05 13:22:57'),
(18, 'Sono', 4, 18, '2025-01-05 13:22:57'),
(19, 'ilosealways', 10, 40, '2023-09-20 14:01:23'),
(20, 'waynard', 10, 654, '2023-09-21 15:41:51'),
(21, 'Dufus', 10, 100, '2023-09-22 13:22:12'),
(22, 'Zed', 5, 10, '2023-09-23 01:51:01'),
(23, 'Kate', 3, 60, '2025-01-05 13:22:57'),
(24, 'Brody', 4, 18, '2025-01-05 13:22:57'),
(25, 'Nelson', 3, 60, '2025-01-05 13:22:57'),
(26, 'Jay', 4, 18, '2025-01-05 13:22:57'),
(27, 'test4', 3, 0, '2025-01-06 13:10:46'),
(28, 'test 5', 3, 0, '2025-01-06 13:11:40'),
(29, 'Test8', 3, 0, '2025-01-06 14:45:14'),
(30, 'Jonatan', 3, 0, '2025-01-06 19:14:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Player ID', AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
