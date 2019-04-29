-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 29. Apr, 2019 21:13 PM
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
-- Database: `h18grdb5`
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Tabellstruktur for tabell `email_codes`
--

CREATE TABLE `email_codes` (
  `id` int(11) NOT NULL,
  `reset_code` varchar(64) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `used` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `friend_list`
--

INSERT INTO `friend_list` (`id`, `user_1`, `user_2`, `chat_id`, `friendship_status`, `chatroom_status`) VALUES
(110, 1, 3, '1X3', 1, 1),
(112, 1, 22, '1X22', 1, 1),
(113, 1, 23, '1X23', 1, 1),
(118, 3, 2, '19X2', 1, 1),
(120, 3, 22, '19X22', 1, 0),
(121, 2, 25, '', 0, 0),
(122, 2, 26, '1X26', 1, 1),
(123, 2, 1, '', 0, 0),
(124, 2, 1, '', 0, 0),
(125, 23, 2, '', 0, 0),
(126, 2, 25, '', 0, 0),
(128, 2, 19, '', 0, 0),
(129, 2, 32, '', 0, 0),
(130, 2, 22, '2X22', 1, 0),
(131, 2, 21, '2X21', 1, 1),
(132, 2, 33, '33X2', 1, 1),
(133, 2, 42, '2X42', 1, 0),
(134, 42, 1, '', 0, 0),
(135, 3, 42, '3X42', 1, 0),
(136, 43, 1, '', 0, 0),
(137, 2, 43, '2X43', 1, 0),
(138, 3, 43, '3X43', 1, 0),
(139, 3, 44, '3X44', 1, 0),
(140, 2, 44, '2X44', 1, 0),
(141, 44, 1, '', 0, 0),
(142, 45, 1, '', 0, 0),
(143, 3, 45, '3X45', 1, 0),
(144, 2, 45, '2X45', 1, 0);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `gained_achievements`
--

CREATE TABLE `gained_achievements` (
  `achievement_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gained` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `gained_achievements`
--

INSERT INTO `gained_achievements` (`achievement_id`, `user_id`, `gained`) VALUES
(2, 1, '2019-04-28 00:00:00'),
(2, 2, '2019-04-29 00:00:00'),
(2, 42, '2019-04-29 00:00:00'),
(2, 44, '2019-04-29 00:00:00'),
(2, 45, '2019-04-29 00:00:00'),
(2, 46, '2019-04-29 00:00:00'),
(3, 2, '2019-04-29 00:00:00'),
(4, 2, '2019-04-29 00:00:00');

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `games`
--

CREATE TABLE `games` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  `creator` varchar(100) NOT NULL,
  `foldername` varchar(25) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `rating` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `games`
--

INSERT INTO `games` (`id`, `title`, `genre`, `description`, `creator`, `foldername`, `filename`, `size`, `rating`) VALUES
(1, 'The Coin-eating Snake', 'Action', 'The SELECT TOP clause is useful on large tables with thousands of records. Returning a large number of records can impact on performance.', 'Mona Clairvoyant', 'snakegame.zip', 'snakegame.php', 1455, 345),
(2, 'There Can Only Be One', 'Rouglike', 'Text message, a short electronic message designed for communication between mobile phone users. Nowadays, text messages can include media (such as photos, music and videos) and are also called media messages.', 'Clinter Coyote', 'breakout.zip', 'breakout.php', 1390, 4),
(3, 'Shovel Game', 'Action', 'You have to get away from the dungeon that you are stuck in, but your shovels are made of soap, get out of there as fast as possible.', 'Daniel Larssen', 'adventureGame', 'shovelGame.php', 110222, 6546),
(15, 'Stormlords', 'Adventure', 'An exiting plantformer veare you eat all those other munchers. Go get em!', 'Unilax', '8BitMonster.zip', '8BitMonster.php', 0, 23),
(16, 'Cookie Champion 4', 'Idle', 'Need lots of cookie to munch on. So get baking!', 'cookie monster', 'CookieChampion4.zip', 'CookieChampion4.php', 0, 982),
(17, 'CYBERCRACKER XXIV', 'Adventure', 'A wonderful joint into the world of an AI trying to break out of its digital prison.\r\n', 'Zep Smith', 'CYBERCRACKERXXIV.zip', 'CYBERCRACKERXXIV.php', 0, 372),
(18, 'Stormlords', 'Adventure', 'Partake in the legend of the stormlord Azrael as he attempts to join his peers in legend.', 'Jane Andre', 'Stormlords.zip', 'Stormlords.php', 0, 122),
(19, 'Triviamaster', 'Strategy', 'Think you know a lot? Then test yourself with Triviamaster and answer the most obscure questions ever.', 'Anonymous', 'Triviamaster.zip', 'Triviamaster.php', 0, 108),
(20, 'Round runner', 'Sport', 'First to the end, who is the fastest?', 'Frank Russel', 'RoundRunner.zip', 'RoundRunner.php', 0, 1223),
(21, 'Ngurrulbs grand pool', 'Romance', 'Lovecraftian dating sim with great character customization', 'Superman22', 'NgurrulbsGrandPool.zip', 'NgurrulbsGrandPool.php', 0, 12),
(22, 'Spook troop', 'Rougelike', 'Spook troop is a single-player role-playing exploring game using Roguelike mechanics', 'N1tr0', 'SpookTroop.zip', 'SpookTroop.php', 0, 234),
(23, 'Bounce Ball!', 'Adventure', 'Bounce your way trough to the top of the level, try not to fall!', 'Daniel Larssen', 'bouncingBall', 'bouncingBall.php', 213123, 6554),
(24, 'Stormlords', 'Strategy', 'An exiting plantformer veare you eat all those other munchers. Go get em!', 'Unilax', 'exampleGame1', '8BitMonster.php', 0, 23),
(25, 'Cookie Champion 4', 'Idle', 'Need lots of cookie to munch on. So get baking!', 'cookie monster', 'exampleGame2', 'CookieChampion4.php', 0, 982),
(26, 'CYBERCRACKER XXIV', 'Adventure', 'A wonderful joint into the world of an AI trying to break out of its digital prison.\r\n', 'Zep Smith', 'exampleGame3', 'CYBERCRACKERXXIV.php', 0, 372),
(27, 'Stormlords', 'Adventure', 'Partake in the legend of the stormlord Azrael as he attempts to join his peers in legend.', 'Jane Andre', 'exampleGame4', 'Stormlords.php', 0, 122),
(28, 'Triviamaster', 'Strategy', 'Think you know a lot? Then test yourself with Triviamaster and answer the most obscure questions ever.', 'Anonymous', 'exampleGame5', 'Triviamaster.php', 0, 108),
(29, 'Round runner', 'Simulation', 'First to the end, who is the fastest?', 'Frank Russel', 'exampleGame6', 'RoundRunner.php', 0, 1223),
(30, 'Ngurrulbs grand pool', 'Fantasy', 'Lovecraftian dating sim with great character customization', 'Superman22', 'exampleGame7', 'NgurrulbsGrandPool.php', 0, 12),
(31, 'Spook troop', 'Comedy', 'Spook troop is a single-player role-playing exploring game using Roguelike mechanics', 'N1tr0', 'exampleGame8', 'SpookTroop.php', 0, 234);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `level`
--

CREATE TABLE `level` (
  `id` int(11) NOT NULL,
  `needed_xp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `level`
--

INSERT INTO `level` (`id`, `needed_xp`) VALUES
(0, 0),
(1, 25),
(2, 50),
(3, 100),
(4, 200),
(6, 300),
(7, 400),
(8, 500),
(9, 600),
(10, 700);

-- --------------------------------------------------------

--
-- Tabellstruktur for tabell `ratings`
--

CREATE TABLE `ratings` (
  `id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `ratings`
--

INSERT INTO `ratings` (`id`, `game_id`, `user_id`) VALUES
(51, 3, 2);

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
  `verify_code` mediumtext NOT NULL,
  `status` int(11) NOT NULL,
  `signed_in` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `users`
--

INSERT INTO `users` (`id`, `unique_id`, `email`, `username`, `password`, `first_name`, `middle_name`, `last_name`, `user_image`, `experience_points`, `joined`, `privilege_level`, `verify_code`, `status`, `signed_in`) VALUES
(1, 34322, 'nybruker@hotmail.no', 'TheOldDon', '$2y$10$YerzCgB5wCTW723mUghP3.9xgu3cuKTaiIOLUy4665xtSOgRQiTe2', 'Don', 'Vito', 'Corleone', '1.png', 0, '2019-01-23', 1, '', 1, 0),
(2, 34323, 'gammelbruker@hotmail.no', 'RandleMcMurphy', '$2y$10$cClBmtVwt57.fiHrglwLxuex/nc2TEs3SQIbAOl3efZUkTwYG5fx6', 'Randle', '', 'McMurphy', '1.png', 250, '2019-01-23', 1, '', 1, 0),
(3, 45433, 'adminbruker@hotmail.no', 'ApocaNow', '$2y$10$YerzCgB5wCTW723mUghP3.9xgu3cuKTaiIOLUy4665xtSOgRQiTe2', 'Robert', '', 'Rheault', '2.png', 553, '2019-01-23', 1, '', 1, 0),
(19, 43533, 'Double@hotmail.no', 'Dangros', '$2y$10$YerzCgB5wCTW723mUghP3.9xgu3cuKTaiIOLUy4665xtSOgRQiTe2', 'Al', 'Capino', 'Naanaa', '1.png', 0, '2019-03-15', 1, '', 1, 0),
(21, 43334, 'hehe@willi.no', 'JerryTheRat', '$2y$10$rKCVBxvyzi.9GLLWsiT.B.kNrSAKaD/K0UyFPXTq1YfdGSdQS4GiK', 'Martin', 'qwqw', 'qwqww', '1.png', 0, '2019-03-17', 1, '', 1, 0),
(22, 35567, 'hehe@willi.nodd', 'TapperTheDog', '$2y$10$.7aiv2vzoOB18HmP9rqjNOyqy1GW3cebr8oaaQ2V7T29w8o4gTuAm', 'Kalle', 'xcsc', 'scsc', '1.png', 0, '2019-03-17', 1, '', 1, 0),
(23, 23433, 'hehe@willi.nojjj', 'JhonnyBravo', '$2y$10$2DCi4g7B5CihWZlPbedhpeVvIi3AlPN0NoCZiWVrIrbWduIE1vSxC', 'Meni', 'lasjd', 'lijlij', '1.png', 0, '2019-03-17', 1, '', 1, 0),
(25, 76854, 'hdc@sdsd.ccd', 'Vertigo', '$2y$10$3rA.M.YXUfd/KPc1JivCrenMLZt9ejKZmxtxYw6eq7W0ywGYCfLbO', 'qwe', 'jhb', 'khjb', '1.png', 0, '2019-03-17', 1, '', 1, 0),
(26, 38503, 'Daniel@Daniel.Daniel', 'Daniel', '$2y$10$cClBmtVwt57.fiHrglwLxuex/nc2TEs3SQIbAOl3efZUkTwYG5fx6', 'Daniel', 'Daniels', 'Danielsen', '1.png', 0, '2019-03-26', 1, 'bc49e6eef94b163fa9b24f163780fd24', 1, 0),
(27, 43737, 'sadad@asda.aa', 'DennyNika', '$2y$10$ZJkHttv9Mpyx3Yoh9A9gXOVKGkkQBnFLDLm7Q2XpDTPErmIN7d1Ee', 'Lise', 'Johannesen', '', '1.png', 0, '2019-04-08', 0, '1c8818bcb422b45bfe95713ea768b4e9', 1, 0),
(28, 38596, 'voje@live.nosadss', 'MengZoo', '$2y$10$IfIlYqolqpugaDQHRIwaT.hN19vd/11TaaVOj9Jt8HPJ16ke5t2ii', 'Lisa', '', '', '1.png', 0, '2019-04-10', 0, '6f4ace1e0305d18d9e2a1694ee22ab15', 1, 0),
(29, 55491, 'voje@live.nosadssa', 'Dermont', '$2y$10$BMz8iSdmRKXNUwg6AQTEs.TPOcn.MXWyJnAILdyRvFM7uGXFve.y6', 'Mina', '', '', '2.png', 0, '2019-04-10', 0, 'a99d847337d71a82a185a2f2becc7929', 1, 0),
(30, 53866, 'hehe@willi.noss', 'MikaZika', '$2y$10$nlBJcgV1bl2aU4NRGsyctu5TDw3m2G1LohdL..qRu5cStig4nUnEW', 'Kalle', '', '', '1.png', 0, '2019-04-10', 0, '5f037b0ede7f7e637bdada8ad74b55f3', 1, 0),
(31, 98126, 'hehe@willi.nosss', 'ImVeryGood', '$2y$10$6GW8Zwk2Ir0w7SUKrBTFLe1aOCgTq.togz/k7X7N8cMLWgPdWmpDK', 'Kristine', 'Larssen', '', '1.png', 0, '2019-04-10', 0, 'dbc3556232a8068dac9945d5b8ea1385', 1, 0),
(32, 26604, 'hehe@willi.nossss', 'GordonFreeman', '$2y$10$1Op3gC8y1LUAcFD28jAEle/.8D.5qBkvZ23.NBSfRS1UjYad8eeB6', 'Kim', '', '', '1.png', 0, '2019-04-10', 0, '7fc06c280f63312384783c9e49213aba', 1, 0),
(33, 11909, 'hehe@willi.nossssg', 'HappyWheels', '$2y$10$HF7yD7uLPSWRg68UnnKnWek/Amp6KnO/xK64caUlg4cEGbDpvp7Q6', 'Kimette', '', '', '1.png', 0, '2019-04-10', 0, '2bae974ebb8cd97ee5918ccb3c146a16', 1, 0),
(34, 40877, 'qwert@lol.monaa', 'TakeMeHome', '$2y$10$VU8BhliDqPbACskdr6xMhONnbFzR0e8LvRes2StirubGVkeO0Nrp6', 'Kine', 'Kviteland', '', '1.png', 0, '2019-04-10', 0, 'f1a1412cf0e5d738b550bfdb335a3e1a', 1, 0),
(35, 74476, 'qwert@lol.monaas', 'EarnestJoe', '$2y$10$xJkxzfj5T1WTekuVQol97OHs2oVAN4QYWospxXVvRiE824AchjGv2', 'Kimmy', '', '', '1.png', 0, '2019-04-10', 0, '32dc22a9a29a8145134b624034331a25', 1, 0),
(36, 43219, 'qwert@lol.monaass', 'GoneHome', '$2y$10$FOUKE6MqqCSuvroO9kqeEevIFFG/SK5g1OdKxjL7id8BEvCEVN94q', 'Kalla', '', '', '1.png', 0, '2019-04-10', 0, '5dd5a978f838706a19eafd9e45bca7a6', 1, 0),
(37, 47043, 'qwert@lol.monaasss', 'MediocreFriend', '$2y$10$6aZLcYh1OsSWT3qg07gtGuw8Ua3/P8dZOxxAkvlRQNrfZjf2giPvC', 'Nike', '', 'Dermento', '1.png', 0, '2019-04-10', 0, 'a7390dc9ce2db29b5fd5930d057088c7', 1, 0),
(38, 23497, 'voje@live.noss', 'LondonFall', '$2y$10$86P.xINWB5W4KArqNc2r7ONfOpJoyYD4V5q7e4xEqmJJsQFIYgX4q', 'Devos', '', '', '1.png', 0, '2019-04-10', 0, '46921b7a245db10ade0803d7d36aa0da', 1, 0),
(39, 67621, 'voje@live.nosss', 'IWantPizzaNow', '$2y$10$WpDdjJ3ppXwaELU6TNCNrefUWIa3y6NuDwUcMrzNcZDx2lcXqOtbe', 'Jhonny', '', '', '1.png', 0, '2019-04-10', 0, '5face8b7c4affdc20daa31a8a8e30452', 1, 0),
(40, 67876, 'MonaLisa@outlook.com', 'KloppenMengle', '$2y$10$DQEbm/WqE/b2POr0kp2PY.GRHXm4QMjqxJMPTlaGuseFx8A81r7zq', 'Danielle', '', '', '1.png', 0, '2019-04-29', 0, '8a2d1677d193dad360c6b31decc79516', 0, 0),
(41, 48652, 'daniel_larssen@outlook.com', 'Zetor', '$2y$10$PrWW.F5wHH44WQ/7iCjUV.1p/PAVOL9qOAEHYaWcZb7BDKUOELDs6', 'Lisaka', '', '', '1.png', 0, '2019-04-29', 0, 'd1b71fffb371eff7f37d1d0ee5c192bd', 0, 0),
(42, 45455, 'david.naist@gmail.com', 'Ripmoff', '$2y$10$PrWW.F5wHH44WQ/7iCjUV.1p/PAVOL9qOAEHYaWcZb7BDKUOELDs6', 'David', 'Naist', 'Overnes', '1556561917_BM5R7125.jpg', 71, '0000-00-00', 1, '', 1, 0),
(43, 32983, 'madsfredrikhagen@hotmail.com', 'Harimir', '$2y$10$PrWW.F5wHH44WQ/7iCjUV.1p/PAVOL9qOAEHYaWcZb7BDKUOELDs6', 'Mads', 'Fredrik', 'Hagen', '1556562207_JPEG_20190429_201403.jpg', 27, '0000-00-00', 1, '', 1, 0),
(44, 84949, 'Markusfenes@gmail.com', 'Mafen', '$2y$10$PrWW.F5wHH44WQ/7iCjUV.1p/PAVOL9qOAEHYaWcZb7BDKUOELDs6', 'Markus', 'Madsen', 'Fenes', '1556562680_1687761.png', 71, '0000-00-00', 1, '', 1, 0),
(45, 42043, 'Daniellarssen@live.no', 'DanielLarssen', '$2y$10$PrWW.F5wHH44WQ/7iCjUV.1p/PAVOL9qOAEHYaWcZb7BDKUOELDs6', 'Daniel', 'Kviteberg', 'Larssen', '1556563005_1556183406_Flag.PNG', 76, '0000-12-24', 1, '', 1, 0),
(46, 56230, 'voje@live.no', 'lassks', '$2y$10$1htgdpJFtiOXbhjVpg2KBuixVOd.09C1145y38dr3/lChLmjKHSQi', '', '', '', '1.png', 50, '2019-04-29', 0, '18494d547234c7e7684935b61fab73d6', 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `user_activity`
--

INSERT INTO `user_activity` (`id`, `act`, `user_id`, `target_id`, `type`, `date`) VALUES
(1, 'create', 2, 157, 'user_chat', '2019-04-29 14:55:26'),
(2, 'create', 2, 158, 'user_chat', '2019-04-29 14:55:52'),
(3, 'create', 2, 159, 'user_chat', '2019-04-29 14:55:58'),
(4, 'create', 2, 160, 'user_chat', '2019-04-29 14:56:44'),
(5, 'create', 2, 161, 'user_chat', '2019-04-29 14:57:38'),
(6, 'create', 2, 162, 'user_chat', '2019-04-29 14:59:56'),
(7, 'create', 2, 163, 'user_chat', '2019-04-29 15:00:52'),
(8, 'create', 2, 164, 'user_chat', '2019-04-29 15:01:18'),
(9, 'create', 2, 165, 'user_chat', '2019-04-29 15:01:36'),
(10, 'create', 2, 166, 'user_chat', '2019-04-29 15:02:12'),
(11, 'create', 2, 167, 'user_chat', '2019-04-29 15:02:29'),
(12, 'create', 2, 51, 'ratings', '2019-04-29 16:01:54'),
(13, 'create', 42, 0, 'gained_achievements', '2019-04-29 18:17:21'),
(14, 'create', 44, 0, 'gained_achievements', '2019-04-29 18:30:26'),
(15, 'create', 45, 0, 'gained_achievements', '2019-04-29 18:37:33'),
(16, 'delete', 3, 119, 'friend_list', '2019-04-29 18:43:34'),
(17, 'create', 46, 46, 'users', '2019-04-29 18:56:57'),
(18, 'create', 46, 0, 'gained_achievements', '2019-04-29 18:58:20');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dataark for tabell `user_chat`
--

INSERT INTO `user_chat` (`id`, `room_id`, `user_id`, `username`, `time`, `text`, `viewed`) VALUES
(150, '23', 1, 'WilliWonka', '2019-04-27 21:41:25', 'Can someone please tell me how to play this game?', 1),
(151, '3', 1, 'WilliWonka', '2019-04-27 21:41:45', 'Ugh...', 1),
(152, '3', 1, 'WilliWonka', '2019-04-27 21:41:45', '\nWhy am I collecting shovels and what should I do with them?', 1),
(153, '3', 2, 'Derperud', '2019-04-27 22:19:16', 'You need to collect them to dig away the blocks of dirt.', 1),
(154, '3', 2, 'Derperud', '2019-04-27 22:19:27', '\nMove with the arrow keys!', 1),
(155, '23', 2, 'Derperud', '2019-04-27 22:58:14', 'Use the arrow keys, and try to get to the top. ', 1),
(156, '23', 2, 'Derperud', '2019-04-27 22:58:19', '\nBut you\'re not hardcore enough, I bet!', 0),
(157, '19X2', 2, 'RandleMcMurphy', '2019-04-29 16:55:26', 'Hello ApocaNow, Can you help me with my homework?', 0),
(158, '19X2', 2, 'RandleMcMurphy', '2019-04-29 16:55:52', 'I\'m struggling with the math assignment :)', 0),
(159, '19X2', 2, 'RandleMcMurphy', '2019-04-29 16:55:58', ':(*', 0),
(160, '1X26', 2, 'RandleMcMurphy', '2019-04-29 16:56:44', 'Take me down to the paradise city where...', 0),
(161, '2X21', 2, 'RandleMcMurphy', '2019-04-29 16:57:38', 'Hello, it\'s a pleasure to meet you!', 0),
(162, '33X2', 2, 'RandleMcMurphy', '2019-04-29 16:59:56', 'Ask someone else to do your dirty-work, I\'m done with you!', 0),
(163, '1X26', 2, 'RandleMcMurphy', '2019-04-29 17:00:52', 'Where the grass is green\nAnd the girls are pretty', 0),
(164, '1X26', 2, 'RandleMcMurphy', '2019-04-29 17:01:18', 'Oh, won\'t you please take me home', 0),
(165, '1X26', 2, 'RandleMcMurphy', '2019-04-29 17:01:36', 'Take me down\nTo the paradise city...', 0),
(166, '1X26', 2, 'RandleMcMurphy', '2019-04-29 17:02:12', 'Where the grass is green\nAnd the girls are pretty', 0),
(167, '1X26', 2, 'RandleMcMurphy', '2019-04-29 17:02:29', 'Oh, won\'t you please take me home ', 0);

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
-- Indexes for table `email_codes`
--
ALTER TABLE `email_codes`
  ADD PRIMARY KEY (`reset_code`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;

--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ratings`
--
ALTER TABLE `ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `user_chat`
--
ALTER TABLE `user_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

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
