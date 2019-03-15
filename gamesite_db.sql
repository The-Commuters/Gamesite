-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14. Mar, 2019 20:01 PM
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
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `text` varchar(255) NOT NULL,
  `game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `friend_list`
--

CREATE TABLE `friend_list` (
  `id` int(11) NOT NULL,
  `user_1` int(10) NOT NULL,
  `user_2` int(10) NOT NULL,
  `status` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend_list`
--

INSERT INTO `friend_list` (`id`, `user_1`, `user_2`, `status`) VALUES
(94, 1, 2, 1),
(95, 1, 13, 1),
(96, 1, 12, 1),
(98, 1, 3, 1),
(100, 1, 1, 1),
(102, 1, 14, 0),
(103, 1, 17, 0);

-- --------------------------------------------------------

--
-- Table structure for table `gained_achievements`
--

CREATE TABLE `gained_achievements` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gained` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `games`
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
-- Dumping data for table `games`
--

INSERT INTO `games` (`id`, `title`, `genre`, `description`, `creator`, `foldername`, `filename`, `size`) VALUES
(1, 'The Coin-eating Snake', 'Action', '', 'Mona Clairvoyant', 'snakegame.zip', 'snakegame.php', 1455),
(2, 'There Can Only Be One', 'Slice Of Life', '', 'Clinter Coyote', 'breakout.zip', 'breakout.php', 1390),
(3, 'The Grand Card-game', 'Comedy', '', 'Mama Nokso', 'cardgame.zip', 'cardgame.php', 1117580),
(4, 'Collect The Diamonds', 'Goat Simulator', '', 'Heman Bermont', '2dgame.zip', '2dgame.php', 1634029);

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
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
(11, 1, 1, 4),
(12, 2, 1, 5),
(14, 3, 1, 4),
(15, 4, 1, 5),
(16, 1, 3, 4),
(17, 2, 3, 2),
(18, 4, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
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
  `privilege_level` tinyint(4) NOT NULL,
  `verify_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `user_image`, `joined`, `privilege_level`, `verify_code`) VALUES
(1, 'hehe@willi.no', 'WilliWonka', 'qwerty', 'Willy', 'Wonka', 'Wonksense', '1.png', '2019-01-23', 1, ''),
(2, 'Derp@Derpesen.no', 'Derperud', 'qwerty', 'Dermont', 'Derp', 'Derperu', '3.png', '2019-01-23', 0, ''),
(3, 'heman@willi.no', 'heman', 'qwerty', 'misterio', 'universio', 'Wonkondo', '2.png', '2019-01-23', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `id` int(11) NOT NULL,
  `act` varchar(25) NOT NULL,
  `user_id` int(11) NOT NULL,
  `target_id` int(11) NOT NULL,
  `type` varchar(25) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`id`, `act`, `user_id`, `target_id`, `type`, `date`) VALUES
(42, 'update', 1, 11, 'ratings', '2019-03-14 18:23:25'),
(43, 'update', 1, 11, 'ratings', '2019-03-14 18:23:26'),
(44, 'create', 1, 0, 'user_chat', '2019-03-14 18:27:07'),
(45, 'create', 1, 2, 'user_chat', '2019-03-14 18:33:08'),
(46, 'create', 1, 3, 'user_chat', '2019-03-14 18:33:11'),
(47, 'create', 1, 4, 'user_chat', '2019-03-14 18:37:46'),
(48, 'create', 1, 5, 'user_chat', '2019-03-14 18:38:15'),
(49, 'create', 1, 6, 'user_chat', '2019-03-14 18:38:55'),
(50, 'create', 1, 7, 'user_chat', '2019-03-14 18:38:57'),
(51, 'create', 1, 8, 'user_chat', '2019-03-14 18:39:01'),
(52, 'create', 1, 9, 'user_chat', '2019-03-14 18:39:04'),
(53, 'update', 1, 98, 'friend_list', '2019-03-14 18:40:06'),
(54, 'create', 1, 10, 'user_chat', '2019-03-14 18:45:57'),
(55, 'create', 1, 11, 'user_chat', '2019-03-14 18:46:22'),
(56, 'update', 1, 1, 'users', '2019-03-14 18:54:50'),
(57, 'update', 1, 1, 'users', '2019-03-14 18:54:53'),
(58, 'delete', 1, 16, 'users', '2019-03-14 18:59:30'),
(59, 'update', 1, 3, 'users', '2019-03-14 18:59:51'),
(60, 'update', 1, 3, 'users', '2019-03-14 18:59:54');

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
-- Dataark for tabell `user_chat`
--

INSERT INTO `user_chat` (`id`, `game_id`, `user_id`, `username`, `time`, `text`) VALUES
(5, 2, 1, 'WilliWonka', '2019-03-14 19:38:15', 'fgdgdfgf'),
(6, 2, 1, 'WilliWonka', '2019-03-14 19:38:55', 'sadasd'),
(7, 2, 1, 'WilliWonka', '2019-03-14 19:38:57', 'sadsadd'),
(8, 5, 1, 'WilliWonka', '2019-03-14 19:39:01', 'asdasd'),
(9, 5, 1, 'WilliWonka', '2019-03-14 19:39:04', 'asdasd'),
(10, 0, 1, 'WilliWonka', '2019-03-14 19:45:57', 'Hello'),
(11, 2, 1, 'WilliWonka', '2019-03-14 19:46:22', 'sadsadsad');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AchievementsGamesFN` (`game_id`);

--
-- Indexes for table `friend_list`
--
ALTER TABLE `friend_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UsersFriend_listFN1` (`user_1`),
  ADD KEY `UsersFriend_listFN2` (`user_2`);

--
-- Indexes for table `gained_achievements`
--
ALTER TABLE `gained_achievements`
  ADD PRIMARY KEY (`id`,`user_id`) USING BTREE,
  ADD KEY `Gained_achievementsUserFNs` (`user_id`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RatingsUserFN` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `User_activityUsersFN2` (`target_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_chat`
--
ALTER TABLE `user_chat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `User_chatUsersFN` (`user_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `user_chat`
--
ALTER TABLE `user_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Begrensninger for dumpede tabeller
--

--
-- Begrensninger for tabell `achievements`
--
ALTER TABLE `achievements`
  ADD CONSTRAINT `AchievementsGamesFN` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Begrensninger for tabell `friend_list`
--
ALTER TABLE `friend_list`
  ADD CONSTRAINT `UsersFriend_listFN1` FOREIGN KEY (`user_1`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UsersFriend_listFN2` FOREIGN KEY (`user_2`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Begrensninger for tabell `gained_achievements`
--
ALTER TABLE `gained_achievements`
  ADD CONSTRAINT `Gained_achievementsAchievementsFNs` FOREIGN KEY (`id`) REFERENCES `achievements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Gained_achievementsUserFNs` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Begrensninger for tabell `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `RatingsUserFN` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Begrensninger for tabell `user_activity`
--
ALTER TABLE `user_activity`
  ADD CONSTRAINT `User_activityUsersFN1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Begrensninger for tabell `user_chat`
--
ALTER TABLE `user_chat`
  ADD CONSTRAINT `User_chatUsersFN` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
