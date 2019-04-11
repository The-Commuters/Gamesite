-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11. Apr, 2019 22:16 PM
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
  `game_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `experience_points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `achievements`
--

INSERT INTO `achievements` (`id`, `game_id`, `title`, `image`, `text`, `experience_points`) VALUES
(1, 3, 'Passed the first level!', '7.png', 'You won the shovel game!', 50),
(2, 3, 'Baby\'s first shovel!', '1.png', 'Congratulations on finding your first shovel, I remember finding my own, when I was five years younger than you...', 50),
(3, 3, 'Baby\'s second shovel!', '2.png', 'Finding two shovels is pretty good... For a child with no legs and brain damage!', 50),
(4, 3, 'They grow up so fast ;(', '3.png', 'Incredible, three shovels? It feels like it was only 1.44 second since you got your first.', 50),
(5, 3, 'I have no idea what to write here.', '4.png', 'Nicely done, I guess?', 50);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `friend_list`
--

CREATE TABLE `friend_list` (
  `id` int(11) NOT NULL,
  `user_1` int(10) NOT NULL,
  `user_2` int(10) NOT NULL,
  `chat_id` varchar(23) NOT NULL,
  `friendship_status` tinyint(1) NOT NULL,
  `chatroom_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `friend_list`
--

INSERT INTO `friend_list` (`id`, `user_1`, `user_2`, `chat_id`, `friendship_status`, `chatroom_status`) VALUES
(108, 1, 2, '1X2', 1, 1),
(109, 1, 19, '1X19', 1, 1),
(110, 1, 3, '1X3', 1, 1),
(111, 1, 1, '1X1', 1, 0),
(112, 1, 22, '1X22', 1, 1),
(113, 1, 23, '1X23', 1, 1),
(118, 19, 2, '19X2', 1, 1),
(119, 19, 19, '19X19', 1, 0),
(120, 19, 22, '19X22', 1, 0),
(121, 1, 25, '', 0, 0),
(122, 1, 26, '1X26', 1, 1),
(123, 1, 21, '', 0, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `gained_achievements`
--

CREATE TABLE `gained_achievements` (
  `achievement_id` int(11) NOT NULL,
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
  `size` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `games`
--

INSERT INTO `games` (`id`, `title`, `genre`, `description`, `creator`, `foldername`, `filename`, `size`, `rating`) VALUES
(1, 'The Coin-eating Snake', 'Action', 'The SELECT TOP clause is useful on large tables with thousands of records. Returning a large number of records can impact on performance.', 'Mona Clairvoyant', 'snakegame.zip', 'snakegame.php', 1455, 345),
(2, 'There Can Only Be One', 'Slice Of Life', 'Text message, a short electronic message designed for communication between mobile phone users. Nowadays, text messages can include media (such as photos, music and videos) and are also called media messages.', 'Clinter Coyote', 'breakout.zip', 'breakout.php', 1390, 4),
(3, 'Shovel Game', 'Slice Of Life', 'You have to get away from the dungeon that you are stuck in, but your shovels are made of soap, get out of there as fast as possible.', 'Daniel Larssen', 'adventureGame', 'shovelGame.php', 110222, 6545),
(15, 'Stormlords', 'Adventure', 'An exiting plantformer veare you eat all those other munchers. Go get em!', 'Unilax', '8BitMonster.zip', '8BitMonster.php', 0, 23),
(16, 'Cookie Champion 4', 'Idle', 'Need lots of cookie to munch on. So get baking!', 'cookie monster', 'CookieChampion4.zip', 'CookieChampion4.php', 0, 982),
(17, 'CYBERCRACKER XXIV', 'Adventure', 'A wonderful joint into the world of an AI trying to break out of its digital prison.\r\n', 'Zep Smith', 'CYBERCRACKERXXIV.zip', 'CYBERCRACKERXXIV.php', 0, 372),
(18, 'Stormlords', 'Adventure', 'Partake in the legend of the stormlord Azrael as he attempts to join his peers in legend.', 'Jane Andre', 'Stormlords.zip', 'Stormlords.php', 0, 122),
(19, 'Triviamaster', 'Strategy', 'Think you know a lot? Then test yourself with Triviamaster and answer the most obscure questions ever.', 'Anonymous', 'Triviamaster.zip', 'Triviamaster.php', 0, 108),
(20, 'Round runner', 'Sport', 'First to the end, who is the fastest?', 'Frank Russel', 'RoundRunner.zip', 'RoundRunner.php', 0, 1223),
(21, 'Ngurrulbs grand pool', 'Romance', 'Lovecraftian dating sim with great character customization', 'Superman22', 'NgurrulbsGrandPool.zip', 'NgurrulbsGrandPool.php', 0, 12),
(22, 'Spook troop', 'Rouglike', 'Spook troop is a single-player role-playing exploring game using Roguelike mechanics', 'N1tr0', 'SpookTroop.zip', 'SpookTroop.php', 0, 234);

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
-- Tabellstruktur for tabell `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `needed_xp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `level`
--

INSERT INTO `level` (`id`, `needed_xp`) VALUES
(1, 25),
(2, 50),
(3, 100),
(4, 200);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `ratings`
--

INSERT INTO `ratings` (`id`, `game_id`, `user_id`) VALUES
(46, 2, 1),
(49, 3, 1);

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
  `experience_points` int(11) NOT NULL,
  `joined` date NOT NULL,
  `privilege_level` tinyint(4) NOT NULL,
  `verify_code` text NOT NULL,
  `status` int(11) NOT NULL,
  `signed_in` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`id`, `unique_id`, `email`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `user_image`, `experience_points`, `joined`, `privilege_level`, `verify_code`, `status`, `signed_in`) VALUES
(1, 0, 'hehe@willi.no', 'WilliWonka', '$2y$10$YerzCgB5wCTW723mUghP3.9xgu3cuKTaiIOLUy4665xtSOgRQiTe2', 'Willy', 'Wonka', 'Wonksense', '3.png', 1450, '2019-01-23', 1, '', 1, 1),
(2, 0, 'Derp@Derpesen.no', 'Derperud', '$2y$10$YerzCgB5wCTW723mUghP3.9xgu3cuKTaiIOLUy4665xtSOgRQiTe2', 'Dermont', 'Derp', 'Derperu', '3.png', 0, '2019-01-23', 1, '', 1, 0),
(3, 0, 'heman@willi.no', 'heman', '$2y$10$YerzCgB5wCTW723mUghP3.9xgu3cuKTaiIOLUy4665xtSOgRQiTe2', 'misterio', 'universio', 'Wonkondo', '2.png', 0, '2019-01-23', 1, '', 1, 0),
(19, 0, 'DoubleD@DD.Dn', 'DonnieDarko#hYZKc', '$2y$10$YerzCgB5wCTW723mUghP3.9xgu3cuKTaiIOLUy4665xtSOgRQiTe2', 'Nini', 'Nono', 'Naanaa', '1.png', 0, '2019-03-15', 1, '', 1, 0),
(21, 43334, 'hehe@willi.nos', 'Hanness', '$2y$10$rKCVBxvyzi.9GLLWsiT.B.kNrSAKaD/K0UyFPXTq1YfdGSdQS4GiK', 'qwwqw', 'qwqw', 'qwqww', '1.png', 0, '2019-03-17', 1, '', 1, 0),
(22, 35567, 'hehe@willi.nodd', 'dscsdc', '$2y$10$.7aiv2vzoOB18HmP9rqjNOyqy1GW3cebr8oaaQ2V7T29w8o4gTuAm', 'sxcfdf', 'xcsc', 'scsc', '1.png', 0, '2019-03-17', 1, '', 1, 0),
(23, 23433, 'hehe@willi.nojjj', 'dflÃ¸mj', '$2y$10$2DCi4g7B5CihWZlPbedhpeVvIi3AlPN0NoCZiWVrIrbWduIE1vSxC', 'askld', 'lasjd', 'lijlij', '1.png', 0, '2019-03-17', 1, '', 1, 0),
(25, 76854, 'hdc@sdsd.ccd', 'ldfjvoijq', '$2y$10$3rA.M.YXUfd/KPc1JivCrenMLZt9ejKZmxtxYw6eq7W0ywGYCfLbO', 'qwe', 'jhb', 'khjb', '1.png', 0, '2019-03-17', 1, '', 1, 0),
(26, 38503, 'Daniel@Daniel.Daniel', 'Daniel', '$2y$10$cClBmtVwt57.fiHrglwLxuex/nc2TEs3SQIbAOl3efZUkTwYG5fx6', 'Daniel', 'Daniels', 'Danielsen', '1.png', 0, '2019-03-26', 1, 'bc49e6eef94b163fa9b24f163780fd24', 1, 0),
(27, 43737, 'sadad@asda.aa', 'WilliWonkanom', '$2y$10$ZJkHttv9Mpyx3Yoh9A9gXOVKGkkQBnFLDLm7Q2XpDTPErmIN7d1Ee', '', '', '', '1.png', 0, '2019-04-08', 0, '1c8818bcb422b45bfe95713ea768b4e9', 1, 0),
(28, 38596, 'voje@live.nosadss', 'asdsad', '$2y$10$IfIlYqolqpugaDQHRIwaT.hN19vd/11TaaVOj9Jt8HPJ16ke5t2ii', '', '', '', '1.png', 0, '2019-04-10', 0, '6f4ace1e0305d18d9e2a1694ee22ab15', 1, 0),
(29, 55491, 'voje@live.nosadssa', 'asdsad', '$2y$10$BMz8iSdmRKXNUwg6AQTEs.TPOcn.MXWyJnAILdyRvFM7uGXFve.y6', '', '', '', '1.png', 0, '2019-04-10', 0, 'a99d847337d71a82a185a2f2becc7929', 1, 0),
(30, 53866, 'hehe@willi.noss', 'sadasdsad', '$2y$10$nlBJcgV1bl2aU4NRGsyctu5TDw3m2G1LohdL..qRu5cStig4nUnEW', '', '', '', '1.png', 0, '2019-04-10', 0, '5f037b0ede7f7e637bdada8ad74b55f3', 1, 0),
(31, 98126, 'hehe@willi.nosss', 'sadasdsad', '$2y$10$6GW8Zwk2Ir0w7SUKrBTFLe1aOCgTq.togz/k7X7N8cMLWgPdWmpDK', '', '', '', '1.png', 0, '2019-04-10', 0, 'dbc3556232a8068dac9945d5b8ea1385', 1, 0),
(32, 26604, 'hehe@willi.nossss', 'sadasdsad', '$2y$10$1Op3gC8y1LUAcFD28jAEle/.8D.5qBkvZ23.NBSfRS1UjYad8eeB6', '', '', '', '1.png', 0, '2019-04-10', 0, '7fc06c280f63312384783c9e49213aba', 1, 0),
(33, 11909, 'hehe@willi.nossssg', 'sadasdsad', '$2y$10$HF7yD7uLPSWRg68UnnKnWek/Amp6KnO/xK64caUlg4cEGbDpvp7Q6', '', '', '', '1.png', 0, '2019-04-10', 0, '2bae974ebb8cd97ee5918ccb3c146a16', 1, 0),
(34, 40877, 'qwert@lol.monaa', 'sdfsdfgggnbmnmss', '$2y$10$VU8BhliDqPbACskdr6xMhONnbFzR0e8LvRes2StirubGVkeO0Nrp6', '', '', '', '1.png', 0, '2019-04-10', 0, 'f1a1412cf0e5d738b550bfdb335a3e1a', 1, 0),
(35, 74476, 'qwert@lol.monaas', 'sdfsdfgggnbmnmss', '$2y$10$xJkxzfj5T1WTekuVQol97OHs2oVAN4QYWospxXVvRiE824AchjGv2', '', '', '', '1.png', 0, '2019-04-10', 0, '32dc22a9a29a8145134b624034331a25', 1, 0),
(36, 43219, 'qwert@lol.monaass', 'sdfsdfgggnbmnmss', '$2y$10$FOUKE6MqqCSuvroO9kqeEevIFFG/SK5g1OdKxjL7id8BEvCEVN94q', '', '', '', '1.png', 0, '2019-04-10', 0, '5dd5a978f838706a19eafd9e45bca7a6', 1, 0),
(37, 47043, 'qwert@lol.monaasss', 'sdfsdfgggnbmnmss', '$2y$10$6aZLcYh1OsSWT3qg07gtGuw8Ua3/P8dZOxxAkvlRQNrfZjf2giPvC', '', '', '', '1.png', 0, '2019-04-10', 0, 'a7390dc9ce2db29b5fd5930d057088c7', 1, 0),
(38, 23497, 'voje@live.noss', 'vaskens', '$2y$10$86P.xINWB5W4KArqNc2r7ONfOpJoyYD4V5q7e4xEqmJJsQFIYgX4q', '', '', '', '1.png', 0, '2019-04-10', 0, '46921b7a245db10ade0803d7d36aa0da', 1, 0),
(39, 67621, 'voje@live.nosss', 'vaskens', '$2y$10$WpDdjJ3ppXwaELU6TNCNrefUWIa3y6NuDwUcMrzNcZDx2lcXqOtbe', '', '', '', '1.png', 0, '2019-04-10', 0, '5face8b7c4affdc20daa31a8a8e30452', 1, 0);

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
(1, 'create', 1, 127, 'user_chat', '2019-03-26 11:10:37'),
(2, 'create', 1, 128, 'user_chat', '2019-03-26 11:10:44'),
(3, 'create', 1, 129, 'user_chat', '2019-03-26 11:11:47'),
(4, 'create', 26, 26, 'users', '2019-03-26 11:32:08'),
(5, 'create', 1, 130, 'user_chat', '2019-03-26 11:35:08'),
(6, 'create', 1, 131, 'user_chat', '2019-03-26 11:35:20'),
(7, 'create', 26, 132, 'user_chat', '2019-03-26 11:37:42'),
(8, 'create', 26, 133, 'user_chat', '2019-03-26 11:38:02'),
(9, 'create', 26, 134, 'user_chat', '2019-03-26 11:38:10'),
(10, 'create', 1, 135, 'user_chat', '2019-03-26 11:40:58'),
(11, 'create', 1, 136, 'user_chat', '2019-03-26 11:41:04'),
(12, 'create', 1, 137, 'user_chat', '2019-03-26 11:42:36'),
(13, 'create', 26, 138, 'user_chat', '2019-03-26 11:44:20'),
(14, 'create', 1, 139, 'user_chat', '2019-03-26 11:46:50'),
(15, 'create', 1, 140, 'user_chat', '2019-03-26 11:47:36'),
(16, 'create', 1, 141, 'user_chat', '2019-03-26 11:47:38'),
(17, 'create', 1, 142, 'user_chat', '2019-03-26 11:47:44'),
(18, 'create', 1, 143, 'user_chat', '2019-03-26 11:47:49'),
(19, 'create', 1, 144, 'user_chat', '2019-03-26 11:47:52'),
(20, 'create', 1, 145, 'user_chat', '2019-03-26 11:47:56'),
(21, 'create', 26, 146, 'user_chat', '2019-03-26 11:58:55'),
(22, 'create', 26, 147, 'user_chat', '2019-03-26 11:58:57'),
(23, 'create', 26, 148, 'user_chat', '2019-03-26 11:59:01'),
(24, 'create', 1, 0, 'gained_achievements', '2019-04-08 09:20:53'),
(25, 'create', 1, 20, 'ratings', '2019-04-08 09:21:03'),
(26, 'create', 1, 0, 'gained_achievements', '2019-04-08 09:33:25'),
(27, 'create', 1, 0, 'gained_achievements', '2019-04-08 09:50:56'),
(28, 'create', 1, 0, 'gained_achievements', '2019-04-08 09:53:02'),
(29, 'create', 1, 0, 'gained_achievements', '2019-04-08 09:55:25'),
(30, 'create', 1, 0, 'gained_achievements', '2019-04-08 10:40:13'),
(31, 'create', 1, 0, 'gained_achievements', '2019-04-08 10:43:09'),
(32, 'create', 1, 0, 'gained_achievements', '2019-04-08 10:49:32'),
(33, 'create', 1, 0, 'gained_achievements', '2019-04-08 10:53:04'),
(34, 'create', 1, 0, 'gained_achievements', '2019-04-08 12:25:58'),
(35, 'create', 27, 27, 'users', '2019-04-08 16:38:51'),
(36, 'create', 1, 21, 'ratings', '2019-04-09 16:09:17'),
(37, 'delete', 1, 21, 'ratings', '2019-04-09 16:11:09'),
(38, 'create', 1, 22, 'ratings', '2019-04-09 16:11:16'),
(39, 'delete', 1, 22, 'ratings', '2019-04-09 16:11:22'),
(40, 'create', 1, 23, 'ratings', '2019-04-09 16:11:26'),
(41, 'delete', 1, 23, 'ratings', '2019-04-09 16:11:33'),
(42, 'create', 1, 24, 'ratings', '2019-04-09 16:11:34'),
(43, 'delete', 1, 24, 'ratings', '2019-04-09 16:11:34'),
(44, 'create', 1, 25, 'ratings', '2019-04-09 16:11:34'),
(45, 'delete', 1, 25, 'ratings', '2019-04-09 16:11:34'),
(46, 'create', 1, 26, 'ratings', '2019-04-09 16:11:34'),
(47, 'delete', 1, 26, 'ratings', '2019-04-09 16:11:34'),
(48, 'create', 1, 27, 'ratings', '2019-04-09 16:11:34'),
(49, 'delete', 1, 27, 'ratings', '2019-04-09 16:11:35'),
(50, 'create', 1, 28, 'ratings', '2019-04-09 16:11:35'),
(51, 'delete', 1, 28, 'ratings', '2019-04-09 16:11:35'),
(52, 'create', 1, 29, 'ratings', '2019-04-09 16:11:35'),
(53, 'delete', 1, 29, 'ratings', '2019-04-09 16:11:35'),
(54, 'create', 1, 30, 'ratings', '2019-04-09 16:11:35'),
(55, 'delete', 1, 30, 'ratings', '2019-04-09 16:11:35'),
(56, 'create', 1, 31, 'ratings', '2019-04-09 16:11:42'),
(57, 'delete', 1, 31, 'ratings', '2019-04-09 16:12:49'),
(58, 'create', 1, 32, 'ratings', '2019-04-09 16:13:01'),
(59, 'delete', 1, 32, 'ratings', '2019-04-09 17:03:41'),
(60, 'create', 1, 33, 'ratings', '2019-04-09 17:03:42'),
(61, 'delete', 1, 33, 'ratings', '2019-04-09 17:03:46'),
(62, 'create', 1, 34, 'ratings', '2019-04-09 17:11:06'),
(63, 'delete', 1, 34, 'ratings', '2019-04-09 17:11:07'),
(64, 'create', 1, 35, 'ratings', '2019-04-09 17:11:08'),
(65, 'delete', 1, 35, 'ratings', '2019-04-09 17:11:08'),
(66, 'create', 1, 36, 'ratings', '2019-04-09 17:11:09'),
(67, 'create', 1, 0, 'gained_achievements', '2019-04-09 17:14:59'),
(68, 'create', 1, 37, 'ratings', '2019-04-09 18:26:14'),
(69, 'create', 1, 38, 'ratings', '2019-04-09 18:26:17'),
(70, 'delete', 1, 37, 'ratings', '2019-04-09 18:26:19'),
(71, 'create', 1, 0, 'gained_achievements', '2019-04-09 19:04:31'),
(72, 'create', 1, 0, 'gained_achievements', '2019-04-09 21:31:08'),
(73, 'create', 1, 0, 'gained_achievements', '2019-04-09 21:34:36'),
(74, 'delete', 1, 38, 'ratings', '2019-04-09 23:00:29'),
(75, 'create', 1, 39, 'ratings', '2019-04-09 23:00:31'),
(76, 'delete', 1, 39, 'ratings', '2019-04-09 23:00:36'),
(77, 'delete', 1, 36, 'ratings', '2019-04-10 09:45:58'),
(78, 'create', 1, 40, 'ratings', '2019-04-10 09:45:59'),
(79, 'create', 1, 41, 'ratings', '2019-04-10 09:46:02'),
(80, 'delete', 1, 40, 'ratings', '2019-04-10 09:46:06'),
(81, 'create', 1, 42, 'ratings', '2019-04-10 10:34:11'),
(82, 'create', 1, 43, 'ratings', '2019-04-10 10:34:30'),
(83, 'delete', 1, 41, 'ratings', '2019-04-10 10:34:35'),
(84, 'delete', 1, 43, 'ratings', '2019-04-10 10:34:52'),
(85, 'delete', 1, 42, 'ratings', '2019-04-10 10:45:06'),
(86, 'create', 1, 44, 'ratings', '2019-04-10 10:56:11'),
(87, 'create', 1, 45, 'ratings', '2019-04-10 11:20:30'),
(88, 'create', 1, 46, 'ratings', '2019-04-10 11:20:34'),
(89, 'delete', 1, 45, 'ratings', '2019-04-10 11:25:14'),
(90, 'delete', 1, 44, 'ratings', '2019-04-10 14:10:59'),
(91, 'create', 1, 47, 'ratings', '2019-04-10 14:10:59'),
(92, 'delete', 1, 47, 'ratings', '2019-04-10 14:11:00'),
(93, 'create', 1, 48, 'ratings', '2019-04-10 14:12:03'),
(94, 'delete', 1, 48, 'ratings', '2019-04-10 14:12:04'),
(95, 'create', 1, 49, 'ratings', '2019-04-10 14:12:06'),
(96, 'create', 28, 28, 'users', '2019-04-10 16:17:11'),
(97, 'create', 29, 29, 'users', '2019-04-10 16:18:15'),
(98, 'create', 30, 30, 'users', '2019-04-10 16:19:11'),
(99, 'create', 31, 31, 'users', '2019-04-10 16:20:24'),
(100, 'create', 32, 32, 'users', '2019-04-10 16:20:40'),
(101, 'create', 33, 33, 'users', '2019-04-10 16:21:30'),
(102, 'create', 34, 34, 'users', '2019-04-10 16:24:30'),
(103, 'create', 35, 35, 'users', '2019-04-10 16:24:55'),
(104, 'create', 36, 36, 'users', '2019-04-10 16:25:38'),
(105, 'create', 37, 37, 'users', '2019-04-10 16:59:05'),
(106, 'create', 38, 38, 'users', '2019-04-10 16:59:20'),
(107, 'create', 39, 39, 'users', '2019-04-10 16:59:40'),
(108, 'create', 1, 50, 'ratings', '2019-04-11 15:18:56'),
(109, 'create', 1, 0, 'gained_achievements', '2019-04-11 19:38:24'),
(110, 'create', 1, 0, 'gained_achievements', '2019-04-11 19:47:53'),
(111, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:03:49'),
(112, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:03:49'),
(113, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:03:49'),
(114, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:03:49'),
(115, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:04:54'),
(116, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:05:46'),
(117, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:06:01'),
(118, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:06:32'),
(119, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:06:34'),
(120, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:06:40'),
(121, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:06:56'),
(122, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:07:24'),
(123, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:09:40'),
(124, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:09:44'),
(125, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:12:29'),
(126, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:12:33'),
(127, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:13:02'),
(128, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:13:06'),
(129, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:13:13'),
(130, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:14:25'),
(131, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:14:43'),
(132, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:15:29'),
(133, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:15:34'),
(134, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:15:39'),
(135, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:15:55'),
(136, 'create', 1, 0, 'gained_achievements', '2019-04-11 20:16:12');

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
  `text` varchar(1000) NOT NULL,
  `viewed` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dataark for tabell `user_chat`
--

INSERT INTO `user_chat` (`id`, `room_id`, `user_id`, `username`, `time`, `text`, `viewed`) VALUES
(5, '2', 1, 'WilliWonka', '2019-03-14 19:38:15', 'fgdgdfgf', 0),
(6, '2', 1, 'WilliWonka', '2019-03-14 19:38:55', 'sadasd', 0),
(7, '2', 1, 'WilliWonka', '2019-03-14 19:38:57', 'sadsadd', 0),
(8, '5', 1, 'WilliWonka', '2019-03-14 19:39:01', 'asdasd', 0),
(9, '5', 1, 'WilliWonka', '2019-03-14 19:39:04', 'asdasd', 0),
(11, '2', 1, 'WilliWonka', '2019-03-14 19:46:22', 'sadsadsad', 0),
(12, '19', 1, 'WilliWonka', '2019-03-15 16:57:36', 'Hello There', 0),
(13, '1', 1, 'WilliWonka', '2019-03-16 18:07:24', 'Hello Derperud, Whats Up?', 0),
(14, '1', 1, 'WilliWonka', '2019-03-16 18:07:45', 'I\'m kinda bored right now...', 0),
(15, '1', 1, 'WilliWonka', '2019-03-16 18:08:10', '...and my parents are out...', 0),
(16, '1', 2, 'Derperud', '2019-03-16 18:09:19', 'Be right there!', 0),
(18, '1#2', 1, 'WilliWonka', '2019-03-16 18:17:56', 'Lol mate, you dun goofed!', 0),
(19, '1#1', 1, 'WilliWonka', '2019-03-16 18:18:11', 'Fak dat guy, you da boss!', 0),
(20, '1#1', 1, 'WilliWonka', '2019-03-17 10:56:33', 'dawg', 0),
(21, '1', 1, 'WilliWonka', '2019-03-17 23:29:08', 'sdfdsfdsf', 0),
(22, '1#2', 2, 'Derperud', '2019-03-18 14:56:40', 'Nah, mate, I aint been shackled, yknow?', 0),
(23, '1', 1, 'WilliWonka', '2019-03-19 18:56:02', 'Hehe, Thats to cool dud.', 0),
(24, '1', 1, 'WilliWonka', '2019-03-19 19:12:06', 'Thisiscool', 0),
(25, '1', 1, 'WilliWonka', '2019-03-19 19:27:27', 'Hello There Matey!', 0),
(26, '1', 1, 'WilliWonka', '2019-03-19 19:27:37', 'Hello', 0),
(27, '1', 1, 'WilliWonka', '2019-03-19 19:28:20', 'Message Mna', 0),
(28, '1', 1, 'WilliWonka', '2019-03-19 19:30:14', 'xsxsx', 0),
(29, '1', 1, 'WilliWonka', '2019-03-19 19:30:17', '\n', 0),
(30, '1', 1, 'WilliWonka', '2019-03-19 19:30:20', '\n', 0),
(31, '1', 1, 'WilliWonka', '2019-03-19 19:30:20', '', 0),
(32, '1', 1, 'WilliWonka', '2019-03-19 19:30:21', '\n', 0),
(33, '1', 1, 'WilliWonka', '2019-03-19 19:30:22', '\nXS', 0),
(34, '1', 1, 'WilliWonka', '2019-03-19 19:31:40', 'Sesdsd', 0),
(35, '1', 1, 'WilliWonka', '2019-03-19 19:32:58', 'SDsdsdsdsd', 0),
(36, '1', 1, 'WilliWonka', '2019-03-19 19:34:46', '\n', 0),
(37, '1', 1, 'WilliWonka', '2019-03-19 19:34:46', '\n', 0),
(38, '1', 1, 'WilliWonka', '2019-03-19 19:34:46', '\n', 0),
(39, '1', 1, 'WilliWonka', '2019-03-19 19:45:03', '\n', 0),
(40, '1', 1, 'WilliWonka', '2019-03-19 19:45:03', '\n', 0),
(41, '1', 1, 'WilliWonka', '2019-03-19 19:45:05', '\n', 0),
(42, '1', 1, 'WilliWonka', '2019-03-19 19:45:09', '\nsaxsax', 0),
(43, '1', 1, 'WilliWonka', '2019-03-19 19:46:27', 'sadsadsaddsad', 0),
(44, '1', 1, 'WilliWonka', '2019-03-19 19:51:48', 'hjhjgbjhbjh', 0),
(45, '1', 1, 'WilliWonka', '2019-03-19 19:51:55', 'hh', 0),
(46, '1', 1, 'WilliWonka', '2019-03-19 19:52:04', 'SSDSDASDDSA\nSDASDASDASD\n', 0),
(47, '1', 1, 'WilliWonka', '2019-03-19 20:40:04', '\n\n\n\n\nSxsxxsxsxsx', 0),
(48, 'undefined', 1, 'WilliWonka', '2019-03-19 20:55:29', 'Hello mate', 0),
(49, '1#1', 1, 'WilliWonka', '2019-03-19 21:57:07', 'Thats Cool!', 0),
(50, '1#1', 1, 'WilliWonka', '2019-03-19 22:10:48', 'Yeah', 0),
(51, '1#1', 1, 'WilliWonka', '2019-03-19 22:10:53', 'Im takliascsacasc', 0),
(52, '1#19', 1, 'WilliWonka', '2019-03-19 23:46:54', 'Donnie my man!', 0),
(53, '1#19', 1, 'WilliWonka', '2019-03-20 00:04:29', 'The day have changed!', 0),
(54, '1#19', 1, 'WilliWonka', '2019-03-20 00:04:45', 'Sdsdd\n\nSays the snakeman\n', 0),
(55, '1#19', 1, 'WilliWonka', '2019-03-20 00:09:57', 'Hello to you man!', 0),
(56, '1#19', 1, 'WilliWonka', '2019-03-20 00:10:15', '\n\n\n\nWhat do you want to talk about?', 0),
(57, '', 1, 'WilliWonka', '2019-03-20 00:10:31', 'Hohoho!', 1),
(58, '', 1, 'WilliWonka', '2019-03-20 00:37:47', 'Dodooodododododd!\n', 1),
(59, '1#2', 1, 'WilliWonka', '2019-03-20 00:50:03', 'U wot m8?', 0),
(60, '1#1', 1, 'WilliWonka', '2019-03-20 00:51:53', 'sdgsdgsdgsdgsdg', 0),
(61, '1X1', 1, 'WilliWonka', '2019-03-20 17:30:38', 'Hello', 0),
(62, '1X19', 1, 'WilliWonka', '2019-03-20 17:30:53', 'Yeak!', 1),
(63, '1X2', 1, 'WilliWonka', '2019-03-20 18:05:37', 'DERPERUD!', 1),
(64, '1X19', 1, 'WilliWonka', '2019-03-20 18:33:59', 'My rythm is...', 1),
(65, '1X19', 1, 'WilliWonka', '2019-03-20 18:34:05', 'WHACK!', 1),
(66, '1X19', 1, 'WilliWonka', '2019-03-20 18:34:15', 'My dance is...', 1),
(67, '1X19', 1, 'WilliWonka', '2019-03-20 18:34:20', 'WHACK!', 1),
(68, '1X19', 1, 'WilliWonka', '2019-03-20 18:34:28', 'YEET!\n', 1),
(69, '1X3', 1, 'WilliWonka', '2019-03-20 18:56:55', 'HEMAN, MASTERS OF THE UNIVERSE!', 0),
(70, '1X22', 1, 'WilliWonka', '2019-03-20 18:57:23', 'dscsdc dcssdcs sdcsdcsd sdxcsdcsdcsdc sdcsdc sd csd  csd cdscsdcsdcs dcsd csd c sdcsd', 0),
(71, '1X23', 1, 'WilliWonka', '2019-03-20 18:57:37', 'sdcsdcsdcsddfwefrfwerwefffwwe wefewf wee wfeefeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee ', 0),
(72, '1X23', 1, 'WilliWonka', '2019-03-20 18:57:47', '\n\n\n\nsdfsedfewfwefwef\n\n\n\nsedfsefesfdsdfsdf', 0),
(73, '1X2', 1, 'WilliWonka', '2019-03-21 13:19:49', 'Hello, Derperud is me!', 1),
(74, '1X2', 1, 'WilliWonka', '2019-03-21 14:07:56', 'Hello', 1),
(75, '1X2', 1, 'WilliWonka', '2019-03-21 14:08:06', 'Aesdfsdf', 1),
(76, '1X2', 1, 'WilliWonka', '2019-03-21 14:08:09', 'dsfsdfsdf', 1),
(77, '1X2', 1, 'WilliWonka', '2019-03-21 14:09:31', 'asdasdasd', 1),
(78, '1X2', 1, 'WilliWonka', '2019-03-21 14:11:19', 'hehehe', 1),
(79, '1X2', 1, 'WilliWonka', '2019-03-21 14:11:21', 'skdmflksdm ', 1),
(80, '1X2', 1, 'WilliWonka', '2019-03-21 14:11:42', 'dsfsdf', 1),
(81, '1X2', 1, 'WilliWonka', '2019-03-21 14:14:00', 'sdsad', 1),
(82, '1X2', 1, 'WilliWonka', '2019-03-21 14:17:40', 'SSS', 1),
(83, '1X2', 1, 'WilliWonka', '2019-03-21 14:29:36', 'Hello', 1),
(84, '1X2', 1, 'WilliWonka', '2019-03-21 14:29:40', 'Im boreed', 1),
(85, '1X2', 1, 'WilliWonka', '2019-03-21 14:29:44', 'Mok', 1),
(86, '1X2', 1, 'WilliWonka', '2019-03-21 14:40:00', 'Hehhe', 1),
(87, '1X2', 1, 'WilliWonka', '2019-03-21 14:40:02', 'Heheheh', 1),
(88, '1X19', 1, 'WilliWonka', '2019-03-21 15:15:32', 'Heet!', 1),
(89, '1X19', 1, 'WilliWonka', '2019-03-21 16:16:04', 'Wooo', 1),
(90, '1X19', 1, 'WilliWonka', '2019-03-21 16:16:08', 'WOO', 1),
(95, '1X19', 1, 'WilliWonka', '2019-03-22 18:51:25', 's das das dasdsaass das das dasdsaass das das dasdsaass das das dasdsaass das das dasdsaass das das dasdsaass das das dasdsaass ', 1),
(96, '1X19', 1, 'WilliWonka', '2019-03-22 18:54:42', 'Hehehhee', 1),
(97, '1X19', 1, 'WilliWonka', '2019-03-22 18:55:12', 'sdfjdshfiudhfds', 1),
(98, '1X19', 1, 'WilliWonka', '2019-03-22 18:55:12', '', 1),
(99, '1X19', 1, 'WilliWonka', '2019-03-22 18:55:17', 'dfdsfsdf', 1),
(100, '1X19', 1, 'WilliWonka', '2019-03-23 17:11:04', 'But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure? On the other hand, we denounc', 1),
(101, '1X19', 1, 'WilliWonka', '2019-03-23 17:17:58', '<h1>Hello there</h1>', 1),
(102, '1X19', 1, 'WilliWonka', '2019-03-23 18:35:24', 'Hello', 1),
(103, '1X19', 1, 'WilliWonka', '2019-03-23 18:35:31', 'Whats up)', 1),
(104, '1X19', 19, 'DonnieDarko#hYZKc', '2019-03-23 22:46:14', '<h1> Hello! </h1>', 1),
(105, '', 19, 'DonnieDarko#hYZKc', '2019-03-24 18:41:01', 'Hello you!', 0),
(106, '', 19, 'DonnieDarko#hYZKc', '2019-03-24 18:41:12', 'What are you doing at the moment?', 0),
(107, '', 19, 'DonnieDarko#hYZKc', '2019-03-24 18:41:24', 'I\'m having a good time at home', 0),
(108, '', 19, 'DonnieDarko#hYZKc', '2019-03-24 18:41:45', 'Give me a call if you want to do something?', 0),
(109, '', 19, 'DonnieDarko#hYZKc', '2019-03-24 18:41:55', '...Okay?', 0),
(110, '', 19, 'DonnieDarko#hYZKc', '2019-03-24 18:42:06', '1 Minute please...', 0),
(111, '', 19, 'DonnieDarko#hYZKc', '2019-03-24 18:42:09', 'YES!', 0),
(112, '', 19, 'DonnieDarko#hYZKc', '2019-03-24 18:52:46', 'Hello mister!', 0),
(113, '', 19, 'DonnieDarko#hYZKc', '2019-03-24 18:52:56', 'Thats cool!\n', 0),
(114, '1X19', 19, 'DonnieDarko#hYZKc', '2019-03-24 18:54:11', 'My name is jebediah.', 1),
(115, '1X2', 2, 'Derperud', '2019-03-24 18:54:42', 'Hello Willy!', 1),
(116, '1X2', 2, 'Derperud', '2019-03-24 18:54:52', 'How is old age treating you?', 1),
(117, '1X2', 2, 'Derperud', '2019-03-24 18:55:04', 'Dunnoe what to do these days!\n', 1),
(118, '1X2', 2, 'Derperud', '2019-03-24 18:55:10', 'Maybe dance', 1),
(119, '1X2', 2, 'Derperud', '2019-03-24 18:55:14', 'or something', 1),
(120, '1X2', 2, 'Derperud', '2019-03-24 18:55:27', 'neeed to make sure that im within 1 minute ', 1),
(121, '1X2', 2, 'Derperud', '2019-03-24 18:55:33', 'hasty hasty writing', 1),
(122, '1X2', 2, 'Derperud', '2019-03-24 18:55:40', 'cool right?\n', 1),
(123, '19X2', 2, 'Derperud', '2019-03-24 18:56:02', 'We have never talked before...', 1),
(124, '19X2', 2, 'Derperud', '2019-03-24 18:56:14', '...But know that i care for you like a brother.', 1),
(125, '1X2', 1, 'WilliWonka', '2019-03-24 18:57:29', 'Super cool mate, Super cool!', 0),
(126, '1X19', 1, 'WilliWonka', '2019-03-24 18:57:45', 'Jebediah black.', 0),
(127, '1X19', 1, 'WilliWonka', '2019-03-26 12:10:37', 'Hello', 0),
(128, '1X19', 1, 'WilliWonka', '2019-03-26 12:10:44', ' Whats up', 0),
(129, '1X2', 1, 'WilliWonka', '2019-03-26 12:11:47', ' gfhgfhgfghfghfgfhgfhgfhg', 0),
(130, '1X26', 1, 'WilliWonka', '2019-03-26 12:35:08', 'Hello Daniel!', 1),
(131, '1X26', 1, 'WilliWonka', '2019-03-26 12:35:20', 'This is Willy speaking.', 1),
(132, '1X26', 26, 'Daniel', '2019-03-26 12:37:42', 'Joho!', 1),
(133, '1X26', 26, 'Daniel', '2019-03-26 12:38:02', 'What the hell are...', 1),
(134, '1X26', 26, 'Daniel', '2019-03-26 12:38:10', 'Bla bla bla bla...', 1),
(135, '1X26', 1, 'WilliWonka', '2019-03-26 12:40:58', 'Daniel!', 1),
(136, '1X26', 1, 'WilliWonka', '2019-03-26 12:41:04', 'Take care.', 1),
(137, '1X26', 1, 'WilliWonka', '2019-03-26 12:42:36', 'Hello', 1),
(138, '1X26', 26, 'Daniel', '2019-03-26 12:44:20', 'Hello', 1),
(139, '1X2', 1, 'WilliWonka', '2019-03-26 12:46:50', 'Hello hello Hello hello Hello hello Hello helloHello hello Hello hello Hello hello Hello hello Hello helloHello hello Hello helloHello helloHello helloHello helloHello helloHello helloHello helloHello helloHello helloHello helloHello helloHello helloHello helloHello helloHello helloHello helloHello helloHello helloHello helloHello helloHello helloHello helloHello helloHello hello', 0),
(140, '1X2', 1, 'WilliWonka', '2019-03-26 12:47:36', ' Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello ', 0),
(141, '1X2', 1, 'WilliWonka', '2019-03-26 12:47:38', ' Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello ', 0),
(142, '1X19', 1, 'WilliWonka', '2019-03-26 12:47:44', ' Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello ', 0),
(143, '1X22', 1, 'WilliWonka', '2019-03-26 12:47:49', ' Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello ', 0),
(144, '1X23', 1, 'WilliWonka', '2019-03-26 12:47:52', ' Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello ', 0),
(145, '1X26', 1, 'WilliWonka', '2019-03-26 12:47:56', ' Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello  Hello Hello Hello Hello ', 1),
(146, '1X26', 26, 'Daniel', '2019-03-26 12:58:55', 'Hekko', 1),
(147, '1X26', 26, 'Daniel', '2019-03-26 12:58:57', 'Hekko', 1),
(148, '1X26', 26, 'Daniel', '2019-03-26 12:59:01', 'Heook', 1);

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
  ADD PRIMARY KEY (`achievement_id`,`user_id`) USING BTREE,
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
-- Indexes for table `level`
--
ALTER TABLE `level`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `friend_list`
--
ALTER TABLE `friend_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `user_chat`
--
ALTER TABLE `user_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

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
  ADD CONSTRAINT `Gained_achievementsAchievementsFNs` FOREIGN KEY (`achievement_id`) REFERENCES `achievements` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
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
