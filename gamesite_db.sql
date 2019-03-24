-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 24. Mar, 2019 19:27 PM
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
(110, 1, 3, '1X3', 1, 0),
(111, 1, 1, '1X1', 1, 0),
(112, 1, 22, '1X22', 1, 1),
(113, 1, 23, '1X23', 1, 1),
(118, 19, 2, '19X2', 1, 1),
(119, 19, 19, '19X19', 1, 0),
(120, 19, 22, '19X22', 1, 0),
(121, 1, 25, '', 0, 0);

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
(1, 0, 'hehe@willi.no', 'WilliWonka', '$2y$10$YerzCgB5wCTW723mUghP3.9xgu3cuKTaiIOLUy4665xtSOgRQiTe2', 'Willy', 'Wonka', 'Wonksense', '1.png', '2019-01-23', 1, '', 1),
(2, 0, 'Derp@Derpesen.no', 'Derperud', '$2y$10$YerzCgB5wCTW723mUghP3.9xgu3cuKTaiIOLUy4665xtSOgRQiTe2', 'Dermont', 'Derp', 'Derperu', '3.png', '2019-01-23', 1, '', 1),
(3, 0, 'heman@willi.no', 'heman', '$2y$10$YerzCgB5wCTW723mUghP3.9xgu3cuKTaiIOLUy4665xtSOgRQiTe2', 'misterio', 'universio', 'Wonkondo', '2.png', '2019-01-23', 1, '', 1),
(19, 0, 'DoubleD@DD.Dn', 'DonnieDarko#hYZKc', '$2y$10$YerzCgB5wCTW723mUghP3.9xgu3cuKTaiIOLUy4665xtSOgRQiTe2', 'Nini', 'Nono', 'Naanaa', '1.png', '2019-03-15', 1, '', 1),
(21, 43334, 'hehe@willi.nos', 'Hanness', '$2y$10$rKCVBxvyzi.9GLLWsiT.B.kNrSAKaD/K0UyFPXTq1YfdGSdQS4GiK', 'qwwqw', 'qwqw', 'qwqww', '1.png', '2019-03-17', 1, '', 1),
(22, 35567, 'hehe@willi.nodd', 'dscsdc', '$2y$10$.7aiv2vzoOB18HmP9rqjNOyqy1GW3cebr8oaaQ2V7T29w8o4gTuAm', 'sxcfdf', 'xcsc', 'scsc', '1.png', '2019-03-17', 1, '', 1),
(23, 23433, 'hehe@willi.nojjj', 'dflÃ¸mj', '$2y$10$2DCi4g7B5CihWZlPbedhpeVvIi3AlPN0NoCZiWVrIrbWduIE1vSxC', 'askld', 'lasjd', 'lijlij', '1.png', '2019-03-17', 1, '', 1),
(25, 76854, 'hdc@sdsd.ccd', 'ldfjvoijq', '$2y$10$3rA.M.YXUfd/KPc1JivCrenMLZt9ejKZmxtxYw6eq7W0ywGYCfLbO', 'qwe', 'jhb', 'khjb', '1.png', '2019-03-17', 1, '', 1);

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
(126, '1X19', 1, 'WilliWonka', '2019-03-24 18:57:45', 'Jebediah black.', 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_chat`
--
ALTER TABLE `user_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;

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
