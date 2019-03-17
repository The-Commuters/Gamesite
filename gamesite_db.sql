-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 17. Mar, 2019 20:41 PM
-- Tjener-versjon: 10.1.35-MariaDB
-- PHP Version: 7.2.9

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
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `text` varchar(255) NOT NULL,
  `game_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `friend_list`
--

CREATE TABLE `friend_list` (
  `id` int(11) NOT NULL,
  `user_1` int(10) NOT NULL,
  `user_2` int(10) NOT NULL,
  `status` tinyint(2) NOT NULL,
  `chatroom` varchar(23) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `friend_list`
--

INSERT INTO `friend_list` (`id`, `user_1`, `user_2`, `status`, `chatroom`) VALUES
(108, 1, 2, 1, '1#2'),
(109, 1, 19, 0, '1#19'),
(110, 1, 3, 0, ''),
(111, 1, 1, 1, '1#1');

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
-- Tabellstruktur for tabell `game_genre`
--

CREATE TABLE `game_genre` (
  `game_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  `genre_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `genres`
--

CREATE TABLE `genres` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(11, 1, 1, 4),
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
  `unique_id` int(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `user_image` varchar(100) NOT NULL,
  `joined` date NOT NULL,
  `privilege_level` tinyint(4) NOT NULL,
  `verify_code` text NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`id`, `unique_id`, `email`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `user_image`, `joined`, `privilege_level`, `verify_code`, `status`) VALUES
(1, 0, 'hehe@willi.no', 'WilliWonka', '$2y$10$YerzCgB5wCTW723mUghP3.9xgu3cuKTaiIOLUy4665xtSOgRQiTe2', 'Willy', 'Wonka', 'Wonksense', '1.png', '2019-01-23', 1, '', 0),
(2, 0, 'Derp@Derpesen.no', 'Derperud', '$2y$10$YerzCgB5wCTW723mUghP3.9xgu3cuKTaiIOLUy4665xtSOgRQiTe2', 'Dermont', 'Derp', 'Derperu', '3.png', '2019-01-23', 0, '', 0),
(3, 0, 'heman@willi.no', 'heman', '$2y$10$YerzCgB5wCTW723mUghP3.9xgu3cuKTaiIOLUy4665xtSOgRQiTe2', 'misterio', 'universio', 'Wonkondo', '2.png', '2019-01-23', 0, '', 0),
(19, 0, 'DoubleD@DD.Dn', 'DonnieDarko#hYZKc', '$2y$10$YerzCgB5wCTW723mUghP3.9xgu3cuKTaiIOLUy4665xtSOgRQiTe2', 'Nini', 'Nono', 'Naanaa', '1.png', '2019-03-15', 0, '', 0),
(20, 0, 'llkjn@nws.ws', 'Hannes#27732', '$2y$10$olLRICVAlbsDXREU9ulsBOTqAhWzRb/bMEvmpdNJ474BAPftAuXNu', 'sadasd', 'hbjhb', 'hjbhbjh', '1.png', '2019-03-17', 0, '', 0),
(21, 0, 'hehe@willi.nos', 'Hanness', '$2y$10$rKCVBxvyzi.9GLLWsiT.B.kNrSAKaD/K0UyFPXTq1YfdGSdQS4GiK', 'qwwqw', 'qwqw', 'qwqww', '1.png', '2019-03-17', 0, '', 0),
(22, 0, 'hehe@willi.nodd', 'dscsdc', '$2y$10$.7aiv2vzoOB18HmP9rqjNOyqy1GW3cebr8oaaQ2V7T29w8o4gTuAm', 'sxc', 'xcsc', 'scsc', '1.png', '2019-03-17', 0, '', 0),
(23, 0, 'hehe@willi.nojjj', 'dflÃ¸mj', '$2y$10$2DCi4g7B5CihWZlPbedhpeVvIi3AlPN0NoCZiWVrIrbWduIE1vSxC', 'askld', 'lasjd', 'lijlij', '1.png', '2019-03-17', 0, '', 0),
(24, 8, 'jnkj@sds.ssdd', 'kjndskn', '$2y$10$z0l8taL9bT0lZqSVjv7mh.zKAFaN8Hf6cBpyMrNVpUSR5yXAmVNbG', 'qsm', 'klmlm', 'kmlkm', '1.png', '2019-03-17', 0, '', 0),
(25, 76854, 'hdc@sdsd.ccd', 'ldfjvoijq', '$2y$10$3rA.M.YXUfd/KPc1JivCrenMLZt9ejKZmxtxYw6eq7W0ywGYCfLbO', 'qwe', 'jhb', 'khjb', '1.png', '2019-03-17', 0, '', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `user_activity`
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
-- Dataark for tabell `user_activity`
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
(60, 'update', 1, 3, 'users', '2019-03-14 18:59:54'),
(62, 'create', 19, 19, 'users', '2019-03-15 14:57:57'),
(63, 'create', 1, 12, 'user_chat', '2019-03-15 15:57:36'),
(64, 'update', 1, 111, 'friend_list', '2019-03-16 16:34:28'),
(65, 'update', 1, 108, 'friend_list', '2019-03-16 16:36:07'),
(66, 'create', 1, 13, 'user_chat', '2019-03-16 17:07:24'),
(67, 'create', 1, 14, 'user_chat', '2019-03-16 17:07:45'),
(68, 'create', 1, 15, 'user_chat', '2019-03-16 17:08:10'),
(69, 'create', 2, 16, 'user_chat', '2019-03-16 17:09:19'),
(70, 'create', 1, 17, 'user_chat', '2019-03-16 17:17:16'),
(71, 'create', 1, 18, 'user_chat', '2019-03-16 17:17:56'),
(72, 'create', 1, 19, 'user_chat', '2019-03-16 17:18:11'),
(73, 'create', 20, 20, 'users', '2019-03-16 23:23:07'),
(74, 'create', 21, 21, 'users', '2019-03-16 23:28:57'),
(75, 'create', 22, 22, 'users', '2019-03-16 23:32:47'),
(76, 'create', 23, 23, 'users', '2019-03-16 23:35:39'),
(77, 'create', 24, 24, 'users', '2019-03-16 23:36:49'),
(78, 'create', 25, 25, 'users', '2019-03-16 23:38:36'),
(79, 'create', 1, 20, 'user_chat', '2019-03-17 09:56:33'),
(80, 'update', 1, 12, 'ratings', '2019-03-17 12:25:34');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `user_chat`
--

CREATE TABLE `user_chat` (
  `id` int(11) NOT NULL,
  `room_id` varchar(23) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `time` datetime NOT NULL,
  `text` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `user_chat`
--

INSERT INTO `user_chat` (`id`, `room_id`, `user_id`, `username`, `time`, `text`) VALUES
(5, '2', 1, 'WilliWonka', '2019-03-14 19:38:15', 'fgdgdfgf'),
(6, '2', 1, 'WilliWonka', '2019-03-14 19:38:55', 'sadasd'),
(7, '2', 1, 'WilliWonka', '2019-03-14 19:38:57', 'sadsadd'),
(8, '5', 1, 'WilliWonka', '2019-03-14 19:39:01', 'asdasd'),
(9, '5', 1, 'WilliWonka', '2019-03-14 19:39:04', 'asdasd'),
(10, '0', 1, 'WilliWonka', '2019-03-14 19:45:57', 'Hello'),
(11, '2', 1, 'WilliWonka', '2019-03-14 19:46:22', 'sadsadsad'),
(12, '19', 1, 'WilliWonka', '2019-03-15 16:57:36', 'Hello There'),
(13, '1', 1, 'WilliWonka', '2019-03-16 18:07:24', 'Hello Derperud, Whats Up?'),
(14, '1', 1, 'WilliWonka', '2019-03-16 18:07:45', 'I\'m kinda bored right now...'),
(15, '1', 1, 'WilliWonka', '2019-03-16 18:08:10', '...and my parents are out...'),
(16, '1', 2, 'Derperud', '2019-03-16 18:09:19', 'Be right there!'),
(17, '', 1, 'WilliWonka', '2019-03-16 18:17:16', 'Hey Maddafaker?'),
(18, '1#2', 1, 'WilliWonka', '2019-03-16 18:17:56', 'Lol mate, you dun goofed!'),
(19, '1#1', 1, 'WilliWonka', '2019-03-16 18:18:11', 'Fak dat guy, you da boss!'),
(20, '1#1', 1, 'WilliWonka', '2019-03-17 10:56:33', 'dawg');

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
-- Indexes for table `game_genre`
--
ALTER TABLE `game_genre`
  ADD PRIMARY KEY (`game_id`,`genre_id`),
  ADD KEY `Game_genreGenresFN` (`genre_id`);

--
-- Indexes for table `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ratings`
--
ALTER TABLE `ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RatingsUserFN` (`user_id`),
  ADD KEY `RatingsGameFN` (`game_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `user_chat`
--
ALTER TABLE `user_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
-- Begrensninger for tabell `game_genre`
--
ALTER TABLE `game_genre`
  ADD CONSTRAINT `Game_genreGamesFN` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Game_genreGenresFN` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Begrensninger for tabell `ratings`
--
ALTER TABLE `ratings`
  ADD CONSTRAINT `RatingsGameFN` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `RatingsUserFN` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Begrensninger for tabell `user_activity`
--
ALTER TABLE `user_activity`
  ADD CONSTRAINT `User_activityUsersFN1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Begrensninger for tabell `user_chat`
--
ALTER TABLE `user_chat`
  ADD CONSTRAINT `User_chatUsersFN` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
