-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 20. Mar, 2019 17:56 PM
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
  `chatroom` varchar(23) NOT NULL,
  `chatroom_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `friend_list`
--

INSERT INTO `friend_list` (`id`, `user_1`, `user_2`, `status`, `chatroom`, `chatroom_status`) VALUES
(108, 1, 2, 1, '1X2', 1),
(109, 1, 19, 1, '1X19', 1),
(110, 1, 3, 1, '1X3', 1),
(111, 1, 1, 1, '1X1', 1),
(112, 1, 22, 1, '1X22', 1),
(113, 1, 23, 1, '1X23', 1);

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
(11, 1, 1, 2),
(12, 2, 1, 5),
(14, 3, 1, 4),
(15, 4, 1, 5),
(16, 1, 3, 4),
(17, 2, 3, 2),
(18, 4, 3, 4),
(19, 1, 2, 4);

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
(21, 0, 'hehe@willi.nos', 'Hanness', '$2y$10$rKCVBxvyzi.9GLLWsiT.B.kNrSAKaD/K0UyFPXTq1YfdGSdQS4GiK', 'qwwqw', 'qwqw', 'qwqww', '1.png', '2019-03-17', 0, '', 0),
(22, 0, 'hehe@willi.nodd', 'dscsdc', '$2y$10$.7aiv2vzoOB18HmP9rqjNOyqy1GW3cebr8oaaQ2V7T29w8o4gTuAm', 'sxcfdf', 'xcsc', 'scsc', '1.png', '2019-03-17', 0, '', 0),
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
(74, 'create', 21, 21, 'users', '2019-03-16 23:28:57'),
(75, 'create', 22, 22, 'users', '2019-03-16 23:32:47'),
(76, 'create', 23, 23, 'users', '2019-03-16 23:35:39'),
(77, 'create', 24, 24, 'users', '2019-03-16 23:36:49'),
(78, 'create', 25, 25, 'users', '2019-03-16 23:38:36'),
(79, 'create', 1, 20, 'user_chat', '2019-03-17 09:56:33'),
(80, 'update', 1, 12, 'ratings', '2019-03-17 12:25:34'),
(81, 'update', 1, 11, 'ratings', '2019-03-17 22:29:01'),
(82, 'update', 1, 11, 'ratings', '2019-03-17 22:29:02'),
(83, 'update', 1, 11, 'ratings', '2019-03-17 22:29:03'),
(84, 'create', 1, 21, 'user_chat', '2019-03-17 22:29:08'),
(85, 'delete', 1, 20, 'users', '2019-03-17 22:29:44'),
(86, 'update', 1, 22, 'users', '2019-03-17 22:29:50'),
(87, 'create', 2, 19, 'ratings', '2019-03-18 13:55:50'),
(88, 'update', 2, 19, 'ratings', '2019-03-18 13:55:51'),
(89, 'create', 2, 22, 'user_chat', '2019-03-18 13:56:40'),
(90, 'update', 1, 11, 'ratings', '2019-03-18 17:00:53'),
(91, 'update', 1, 11, 'ratings', '2019-03-18 17:00:55'),
(92, 'update', 1, 11, 'ratings', '2019-03-18 17:00:57'),
(93, 'update', 1, 11, 'ratings', '2019-03-18 17:00:58'),
(94, 'update', 1, 11, 'ratings', '2019-03-18 17:01:00'),
(95, 'create', 1, 23, 'user_chat', '2019-03-19 17:56:02'),
(96, 'create', 1, 24, 'user_chat', '2019-03-19 18:12:06'),
(97, 'create', 1, 25, 'user_chat', '2019-03-19 18:27:27'),
(98, 'create', 1, 26, 'user_chat', '2019-03-19 18:27:37'),
(99, 'create', 1, 27, 'user_chat', '2019-03-19 18:28:20'),
(100, 'create', 1, 28, 'user_chat', '2019-03-19 18:30:14'),
(101, 'create', 1, 29, 'user_chat', '2019-03-19 18:30:17'),
(102, 'create', 1, 30, 'user_chat', '2019-03-19 18:30:20'),
(103, 'create', 1, 31, 'user_chat', '2019-03-19 18:30:20'),
(104, 'create', 1, 32, 'user_chat', '2019-03-19 18:30:21'),
(105, 'create', 1, 33, 'user_chat', '2019-03-19 18:30:22'),
(106, 'create', 1, 34, 'user_chat', '2019-03-19 18:31:40'),
(107, 'create', 1, 35, 'user_chat', '2019-03-19 18:32:58'),
(108, 'create', 1, 36, 'user_chat', '2019-03-19 18:34:46'),
(109, 'create', 1, 37, 'user_chat', '2019-03-19 18:34:46'),
(110, 'create', 1, 38, 'user_chat', '2019-03-19 18:34:46'),
(111, 'create', 1, 39, 'user_chat', '2019-03-19 18:45:03'),
(112, 'create', 1, 40, 'user_chat', '2019-03-19 18:45:03'),
(113, 'create', 1, 41, 'user_chat', '2019-03-19 18:45:05'),
(114, 'create', 1, 42, 'user_chat', '2019-03-19 18:45:09'),
(115, 'create', 1, 43, 'user_chat', '2019-03-19 18:46:27'),
(116, 'create', 1, 44, 'user_chat', '2019-03-19 18:51:48'),
(117, 'create', 1, 45, 'user_chat', '2019-03-19 18:51:55'),
(118, 'create', 1, 46, 'user_chat', '2019-03-19 18:52:04'),
(119, 'create', 1, 47, 'user_chat', '2019-03-19 19:40:04'),
(120, 'create', 1, 48, 'user_chat', '2019-03-19 19:55:29'),
(121, 'create', 1, 49, 'user_chat', '2019-03-19 20:57:07'),
(122, 'create', 1, 50, 'user_chat', '2019-03-19 21:10:48'),
(123, 'create', 1, 51, 'user_chat', '2019-03-19 21:10:53'),
(124, 'create', 1, 52, 'user_chat', '2019-03-19 22:46:54'),
(125, 'create', 1, 53, 'user_chat', '2019-03-19 23:04:29'),
(126, 'create', 1, 54, 'user_chat', '2019-03-19 23:04:45'),
(127, 'create', 1, 55, 'user_chat', '2019-03-19 23:09:57'),
(128, 'create', 1, 56, 'user_chat', '2019-03-19 23:10:15'),
(129, 'create', 1, 57, 'user_chat', '2019-03-19 23:10:31'),
(130, 'create', 1, 58, 'user_chat', '2019-03-19 23:37:47'),
(131, 'create', 1, 59, 'user_chat', '2019-03-19 23:50:03'),
(132, 'create', 1, 60, 'user_chat', '2019-03-19 23:51:53'),
(133, 'update', 1, 100, 'friend_list', '2019-03-20 14:20:21'),
(134, 'create', 1, 61, 'user_chat', '2019-03-20 16:30:38'),
(135, 'create', 1, 62, 'user_chat', '2019-03-20 16:30:53'),
(136, 'update', 1, 109, 'friend_list', '2019-03-20 16:32:52'),
(137, 'update', 1, 111, 'friend_list', '2019-03-20 16:36:20'),
(138, 'update', 1, 109, 'friend_list', '2019-03-20 16:41:48'),
(139, 'update', 1, 110, 'friend_list', '2019-03-20 16:46:36'),
(140, 'update', 1, 108, 'friend_list', '2019-03-20 16:46:49'),
(141, 'update', 1, 108, 'friend_list', '2019-03-20 16:46:49'),
(142, 'update', 1, 108, 'friend_list', '2019-03-20 16:46:49'),
(143, 'update', 1, 108, 'friend_list', '2019-03-20 16:46:49'),
(144, 'update', 1, 108, 'friend_list', '2019-03-20 16:46:49'),
(145, 'update', 1, 108, 'friend_list', '2019-03-20 16:46:49'),
(146, 'update', 1, 108, 'friend_list', '2019-03-20 16:46:49'),
(147, 'update', 1, 111, 'friend_list', '2019-03-20 16:46:49'),
(148, 'update', 1, 111, 'friend_list', '2019-03-20 16:46:49'),
(149, 'update', 1, 111, 'friend_list', '2019-03-20 16:46:49'),
(150, 'update', 1, 111, 'friend_list', '2019-03-20 16:46:49'),
(151, 'update', 1, 111, 'friend_list', '2019-03-20 16:46:49'),
(152, 'update', 1, 111, 'friend_list', '2019-03-20 16:46:49'),
(153, 'update', 1, 111, 'friend_list', '2019-03-20 16:46:49'),
(154, 'update', 1, 111, 'friend_list', '2019-03-20 16:46:49'),
(155, 'update', 1, 112, 'friend_list', '2019-03-20 16:46:50'),
(156, 'update', 1, 112, 'friend_list', '2019-03-20 16:46:50'),
(157, 'update', 1, 112, 'friend_list', '2019-03-20 16:46:50'),
(158, 'update', 1, 112, 'friend_list', '2019-03-20 16:46:50'),
(159, 'update', 1, 112, 'friend_list', '2019-03-20 16:46:50'),
(160, 'update', 1, 112, 'friend_list', '2019-03-20 16:46:50'),
(161, 'update', 1, 112, 'friend_list', '2019-03-20 16:46:50'),
(162, 'update', 1, 112, 'friend_list', '2019-03-20 16:46:50'),
(163, 'update', 1, 112, 'friend_list', '2019-03-20 16:46:50'),
(164, 'update', 1, 113, 'friend_list', '2019-03-20 16:46:51'),
(165, 'update', 1, 113, 'friend_list', '2019-03-20 16:46:51'),
(166, 'update', 1, 113, 'friend_list', '2019-03-20 16:46:51'),
(167, 'update', 1, 113, 'friend_list', '2019-03-20 16:46:51'),
(168, 'update', 1, 113, 'friend_list', '2019-03-20 16:46:51'),
(169, 'update', 1, 113, 'friend_list', '2019-03-20 16:46:51'),
(170, 'update', 1, 113, 'friend_list', '2019-03-20 16:46:51'),
(171, 'update', 1, 113, 'friend_list', '2019-03-20 16:46:51'),
(172, 'update', 1, 113, 'friend_list', '2019-03-20 16:46:51'),
(173, 'update', 1, 113, 'friend_list', '2019-03-20 16:46:51');

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
(11, '2', 1, 'WilliWonka', '2019-03-14 19:46:22', 'sadsadsad'),
(12, '19', 1, 'WilliWonka', '2019-03-15 16:57:36', 'Hello There'),
(13, '1', 1, 'WilliWonka', '2019-03-16 18:07:24', 'Hello Derperud, Whats Up?'),
(14, '1', 1, 'WilliWonka', '2019-03-16 18:07:45', 'I\'m kinda bored right now...'),
(15, '1', 1, 'WilliWonka', '2019-03-16 18:08:10', '...and my parents are out...'),
(16, '1', 2, 'Derperud', '2019-03-16 18:09:19', 'Be right there!'),
(18, '1#2', 1, 'WilliWonka', '2019-03-16 18:17:56', 'Lol mate, you dun goofed!'),
(19, '1#1', 1, 'WilliWonka', '2019-03-16 18:18:11', 'Fak dat guy, you da boss!'),
(20, '1#1', 1, 'WilliWonka', '2019-03-17 10:56:33', 'dawg'),
(21, '1', 1, 'WilliWonka', '2019-03-17 23:29:08', 'sdfdsfdsf'),
(22, '1#2', 2, 'Derperud', '2019-03-18 14:56:40', 'Nah, mate, I aint been shackled, yknow?'),
(23, '1', 1, 'WilliWonka', '2019-03-19 18:56:02', 'Hehe, Thats to cool dud.'),
(24, '1', 1, 'WilliWonka', '2019-03-19 19:12:06', 'Thisiscool'),
(25, '1', 1, 'WilliWonka', '2019-03-19 19:27:27', 'Hello There Matey!'),
(26, '1', 1, 'WilliWonka', '2019-03-19 19:27:37', 'Hello'),
(27, '1', 1, 'WilliWonka', '2019-03-19 19:28:20', 'Message Mna'),
(28, '1', 1, 'WilliWonka', '2019-03-19 19:30:14', 'xsxsx'),
(29, '1', 1, 'WilliWonka', '2019-03-19 19:30:17', '\n'),
(30, '1', 1, 'WilliWonka', '2019-03-19 19:30:20', '\n'),
(31, '1', 1, 'WilliWonka', '2019-03-19 19:30:20', ''),
(32, '1', 1, 'WilliWonka', '2019-03-19 19:30:21', '\n'),
(33, '1', 1, 'WilliWonka', '2019-03-19 19:30:22', '\nXS'),
(34, '1', 1, 'WilliWonka', '2019-03-19 19:31:40', 'Sesdsd'),
(35, '1', 1, 'WilliWonka', '2019-03-19 19:32:58', 'SDsdsdsdsd'),
(36, '1', 1, 'WilliWonka', '2019-03-19 19:34:46', '\n'),
(37, '1', 1, 'WilliWonka', '2019-03-19 19:34:46', '\n'),
(38, '1', 1, 'WilliWonka', '2019-03-19 19:34:46', '\n'),
(39, '1', 1, 'WilliWonka', '2019-03-19 19:45:03', '\n'),
(40, '1', 1, 'WilliWonka', '2019-03-19 19:45:03', '\n'),
(41, '1', 1, 'WilliWonka', '2019-03-19 19:45:05', '\n'),
(42, '1', 1, 'WilliWonka', '2019-03-19 19:45:09', '\nsaxsax'),
(43, '1', 1, 'WilliWonka', '2019-03-19 19:46:27', 'sadsadsaddsad'),
(44, '1', 1, 'WilliWonka', '2019-03-19 19:51:48', 'hjhjgbjhbjh'),
(45, '1', 1, 'WilliWonka', '2019-03-19 19:51:55', 'hh'),
(46, '1', 1, 'WilliWonka', '2019-03-19 19:52:04', 'SSDSDASDDSA\nSDASDASDASD\n'),
(47, '1', 1, 'WilliWonka', '2019-03-19 20:40:04', '\n\n\n\n\nSxsxxsxsxsx'),
(48, 'undefined', 1, 'WilliWonka', '2019-03-19 20:55:29', 'Hello mate'),
(49, '1#1', 1, 'WilliWonka', '2019-03-19 21:57:07', 'Thats Cool!'),
(50, '1#1', 1, 'WilliWonka', '2019-03-19 22:10:48', 'Yeah'),
(51, '1#1', 1, 'WilliWonka', '2019-03-19 22:10:53', 'Im takliascsacasc'),
(52, '1#19', 1, 'WilliWonka', '2019-03-19 23:46:54', 'Donnie my man!'),
(53, '1#19', 1, 'WilliWonka', '2019-03-20 00:04:29', 'The day have changed!'),
(54, '1#19', 1, 'WilliWonka', '2019-03-20 00:04:45', 'Sdsdd\n\nSays the snakeman\n'),
(55, '1#19', 1, 'WilliWonka', '2019-03-20 00:09:57', 'Hello to you man!'),
(56, '1#19', 1, 'WilliWonka', '2019-03-20 00:10:15', '\n\n\n\nWhat do you want to talk about?'),
(57, '', 1, 'WilliWonka', '2019-03-20 00:10:31', 'Hohoho!'),
(58, '', 1, 'WilliWonka', '2019-03-20 00:37:47', 'Dodooodododododd!\n'),
(59, '1#2', 1, 'WilliWonka', '2019-03-20 00:50:03', 'U wot m8?'),
(60, '1#1', 1, 'WilliWonka', '2019-03-20 00:51:53', 'sdgsdgsdgsdgsdg'),
(61, '1X1', 1, 'WilliWonka', '2019-03-20 17:30:38', 'Hello'),
(62, '1X19', 1, 'WilliWonka', '2019-03-20 17:30:53', 'Yeak!');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT for table `user_chat`
--
ALTER TABLE `user_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

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
