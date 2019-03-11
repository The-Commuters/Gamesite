-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11. Mar, 2019 19:39 PM
-- Server-versjon: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamesite_db`
--

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `achievements`
--

CREATE TABLE `achievements` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `friend_list`
--

CREATE TABLE `friend_list` (
  `id` int(11) NOT NULL,
  `user_1` int(10) NOT NULL,
  `user_2` int(10) NOT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `friend_list`
--

INSERT INTO `friend_list` (`id`, `user_1`, `user_2`, `status`) VALUES
(94, 1, 2, 1),
(95, 1, 13, 1),
(96, 1, 12, 1),
(98, 1, 3, 1),
(100, 1, 1, 1),
(101, 1, 16, 0),
(102, 1, 14, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `gained_achievements`
--

CREATE TABLE `gained_achievements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gained` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `creator` varchar(100) NOT NULL,
  `foldername` varchar(25) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `games`
--

INSERT INTO `games` (`id`, `title`, `genre`, `description`, `creator`, `foldername`, `filename`, `size`) VALUES
(1, 'The Coin-eating Snake', 'Action', '', 'Mona Clairvoyant', 'snakegame.zip', 'snakegame.php', 1455),
(2, 'There Can Only Be One', 'Slice Of Life', '', 'Clinter Coyote', 'breakout.zip', 'breakout.php', 1390),
(3, 'The Grand Card-game', 'Comedy', '', 'Mama Nokso', 'cardgame.zip', 'cardgame.php', 1117580),
(4, 'Collect The Diamonds', 'Goat Simulator', '', 'Heman Bermont', '2dgame.zip', '2dgame.php', 1634029);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `ratings`
--

INSERT INTO `ratings` (`id`, `game_id`, `user_id`, `score`) VALUES
(11, 1, 1, 1),
(12, 2, 1, 5),
(14, 3, 1, 4),
(15, 4, 1, 5),
(16, 1, 3, 4),
(17, 2, 3, 2),
(18, 4, 3, 4);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `user_image` varchar(100) NOT NULL,
  `joined` date NOT NULL,
  `privilege_level` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `user_image`, `joined`, `privilege_level`) VALUES
(1, 'hehe@willi.no', 'WilliWonka', '$2y$10$JKhFJm5uGNYIL/qCWJY2bO.3vEOY8pW3n7t6qtzrmBvE69J7sDU82', 'Willy', 'Wonka', 'Wonksensen', '1.png', '2019-01-23', 1),
(2, 'Derp@Derpesen.no', 'Derperud', '$2y$10$JKhFJm5uGNYIL/qCWJY2bO.3vEOY8pW3n7t6qtzrmBvE69J7sDU82', 'Dermont', 'Derp', 'Derperud', '3.png', '2019-01-23', 0),
(3, 'heman@willi.no', 'heman', '$2y$10$JKhFJm5uGNYIL/qCWJY2bO.3vEOY8pW3n7t6qtzrmBvE69J7sDU82', 'misterio', 'universio', 'Wonkondo', '2.png', '2019-01-23', 0),
(10, 'qwert@lol.mon', 'WilliWonkabob', '$2y$10$JKhFJm5uGNYIL/qCWJY2bO.3vEOY8pW3n7t6qtzrmBvE69J7sDU82', 'asdoln', 'dolnes', 'papa', '1.png', '2019-02-08', 0),
(12, 'qwert@lol.mon', 'WilliWonkabobdsd', '$2y$10$JKhFJm5uGNYIL/qCWJY2bO.3vEOY8pW3n7t6qtzrmBvE69J7sDU82', 'asdoln', 'dolnes', 'papa', '1.png', '2019-02-08', 0),
(13, 'qwert@lol.mon', 'WilliWonkabobdsd', '$2y$10$JKhFJm5uGNYIL/qCWJY2bO.3vEOY8pW3n7t6qtzrmBvE69J7sDU82', 'asdoln', 'dolnes', 'papa', '1.png', '2019-02-08', 0),
(14, 'qwert@lol.mon', 'WilliWonkabobdsdsdsd', '$2y$10$JKhFJm5uGNYIL/qCWJY2bO.3vEOY8pW3n7t6qtzrmBvE69J7sDU82', 'asdoln', 'dolnes', 'papa', '1.png', '2019-02-08', 0),
(16, 'vovje@livve.no', 'JonasGStÃ¸re#eFl7B', '$2y$10$HXfGfnEQqrZzrtsUl.44F.YoNtB2DV46aYqS4Z6/8Sy1PohJQic6C', 'qwe', 'wer', 'ert', '1.png', '2019-02-13', 0),
(17, 'sadad@asda.aasss', 'vaskens#8Cp3D', '$2y$10$pSdsEy68UZ1wyYl.q/4ldOVp1Gzeqq316ZFSKTvT1VQLCfilbdVDq', 'qwe', 'qwe', 'qwre', '1.png', '2019-02-13', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `user_activity`
--

CREATE TABLE `user_activity` (
  `id` int(11) NOT NULL,
  `act` varchar(25) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `target_id` varchar(100) NOT NULL,
  `type` varchar(25) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `user_activity`
--

INSERT INTO `user_activity` (`id`, `act`, `user_id`, `target_id`, `type`, `date`) VALUES
(1, 'delete', '', '16', 'users', '2019-02-09 19:09:01'),
(2, 'update', '1', '94', 'friend_list', '2019-02-11 16:54:52'),
(3, 'update', '1', '96', 'friend_list', '2019-02-11 16:55:47'),
(4, 'update', '1', '97', 'friend_list', '2019-02-11 16:55:49'),
(5, 'update', '1', '95', 'friend_list', '2019-02-11 16:55:52'),
(6, 'update', '1', '98', 'friend_list', '2019-02-11 19:16:50'),
(7, 'update', '1', '98', 'friend_list', '2019-02-11 19:50:12'),
(8, 'update', '1', '94', 'friend_list', '2019-02-11 19:50:17'),
(9, 'update', '1', '97', 'friend_list', '2019-02-11 19:50:20'),
(10, 'update', '1', '95', 'friend_list', '2019-02-11 23:33:39'),
(11, 'update', '1', '96', 'friend_list', '2019-02-12 14:48:09'),
(12, 'update', '1', '95', 'friend_list', '2019-02-12 15:07:18'),
(13, 'update', '1', '96', 'friend_list', '2019-02-12 15:07:24'),
(14, 'delete', '1', '97', 'friend_list', '2019-02-12 15:07:27'),
(15, 'update', '1', '98', 'friend_list', '2019-02-12 15:07:29'),
(16, 'delete', '1', '99', 'friend_list', '2019-02-12 15:07:30'),
(17, 'create', '16', '16', 'users', '2019-02-13 14:04:57'),
(18, 'create', '17', '17', 'users', '2019-02-13 18:54:23'),
(19, 'update', '1', '100', 'friend_list', '2019-02-25 20:14:36'),
(20, 'delete', '1', '15', 'users', '2019-02-25 20:16:40'),
(21, 'create', '1', '0', 'user_chat', '2019-03-10 15:39:41'),
(22, 'create', '1', '0', 'user_chat', '2019-03-10 15:40:50'),
(23, 'create', '1', '0', 'user_chat', '2019-03-10 15:42:42'),
(24, 'create', '1', '0', 'user_chat', '2019-03-10 15:44:10'),
(25, 'create', '1', '0', 'user_chat', '2019-03-10 15:44:53'),
(26, 'create', '1', '0', 'user_chat', '2019-03-10 15:47:46'),
(27, 'create', '1', '0', 'user_chat', '2019-03-10 15:48:08'),
(28, 'create', '1', '0', 'user_chat', '2019-03-10 15:49:37'),
(29, 'create', '1', '0', 'user_chat', '2019-03-10 15:50:34'),
(30, 'create', '1', '0', 'user_chat', '2019-03-10 15:50:49'),
(31, 'create', '1', '0', 'user_chat', '2019-03-10 15:53:21'),
(32, 'update', '1', '11', 'ratings', '2019-03-10 16:05:46'),
(33, 'update', '1', '11', 'ratings', '2019-03-10 16:05:48'),
(34, 'update', '1', '11', 'ratings', '2019-03-10 16:05:50'),
(35, 'update', '1', '11', 'ratings', '2019-03-10 16:05:53'),
(36, 'update', '1', '11', 'ratings', '2019-03-10 16:05:55'),
(37, 'create', '1', '0', 'user_chat', '2019-03-10 16:37:16'),
(38, 'create', '1', '0', 'user_chat', '2019-03-10 17:26:18');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `user_chat`
--

CREATE TABLE `user_chat` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `time` datetime NOT NULL,
  `text` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_list`
--
ALTER TABLE `friend_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `friend_list`
--
ALTER TABLE `friend_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
