-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Apr 20, 2019 at 04:28 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `id_news` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `date_comment` datetime NOT NULL,
  `rating_comment` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `id_news`, `author`, `comment`, `date_comment`, `rating_comment`) VALUES
(1, 4, 'junight', 'Heloo super article', '2018-09-03 09:53:37', 0),
(2, 4, 'junight', 'Heloo super article', '2018-09-03 09:54:18', 0),
(3, 4, 'junight', 'Test', '2018-09-03 09:59:12', 0),
(4, 4, 'junight', 'Test', '2018-09-03 09:59:42', 0),
(5, 4, 'junight', 'Bonjour', '2018-09-06 13:59:37', 0),
(6, 4, 'junight', 'Bonjour', '2018-09-06 14:01:23', 0),
(7, 4, 'junight', 'Bonjour', '2018-09-06 14:02:53', 0),
(8, 5, 'junight', 'Test', '2018-09-06 14:17:07', 0),
(10, 6, 'junight', 'Bonjour superv article', '2018-09-10 10:17:46', 0),
(12, 6, 'junight', '<script>alert(\'bonjour\')</script>', '2018-09-10 10:18:30', 0),
(14, 13, 'junight', 'Wow super article', '2018-10-03 15:05:01', 0),
(15, 7, 'junight', 'Bonjour', '2018-10-03 15:30:03', 0),
(21, 15, 'junight', 'Coca cola', '2018-10-03 15:51:09', 2),
(38, 16, 'junight', 'Wooow', '2018-10-04 12:01:16', 5),
(40, 12, 'junight', 'boul', '2018-10-04 12:31:53', 1),
(41, 15, 'junight', 'bbb', '2018-10-04 12:38:45', 0),
(42, 15, 'junight', 'Bonjour', '2018-10-08 11:09:16', 0),
(43, 15, 'junight', 'test', '2018-10-08 11:25:34', 0),
(44, 15, 'junight', 'test', '2018-10-08 11:25:46', 0),
(45, 15, 'junight', 'Wesh', '2018-12-10 22:06:02', 0),
(46, 15, 'junight', 'Salut', '2018-12-11 19:39:19', 0),
(48, 15, 'junight', 'c fn fn fn ', '2018-12-27 15:37:04', 0),
(54, 15, 'junight', 'jjjjj', '2018-12-27 16:20:04', 0),
(63, 25, 'junight', 'bmfgbfkmjbnkfjnkjfnbkjenb', '2018-12-30 16:41:45', 2),
(64, 25, 'junight', 'juninininin', '2018-12-30 16:49:14', 0),
(65, 25, 'junight', 'g', '2018-12-30 18:07:56', 4),
(66, 25, 'junight', 'hh', '2018-12-31 15:33:23', 1),
(69, 25, 'junight', 'Halo', '2019-01-11 14:44:48', 1),
(71, 27, 'junight', 'cv k,fvkldf,', '2019-01-24 21:13:24', 3),
(72, 27, 'junight', 'HGFDDD', '2019-02-08 13:24:56', 0),
(73, 20, 'junight', 'Hello', '2019-03-01 12:46:00', 5),
(75, 20, 'junight', 'jkjkj', '2019-03-01 13:18:46', 2),
(76, 22, 'junight', 'Hohohho', '2019-03-22 13:29:59', 0),
(77, 40, 'junight', '', '2019-04-05 12:45:37', 0),
(78, 37, 'junight', 'Hello', '2019-04-05 13:06:46', 2),
(83, 39, 'junight', '', '2019-04-05 13:26:49', 1),
(85, 39, 'junight', 'Hello', '2019-04-05 13:50:31', 0),
(86, 39, 'junight', '', '2019-04-20 15:36:42', 0),
(87, 39, 'junight', 'j', '2019-04-20 15:42:14', 0),
(88, 39, 'junight', 'k', '2019-04-20 15:43:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `date_creation`) VALUES
(20, 'Quartiers Rouges .06 : Fusion mes couilles (L\'anniversaire)', '<p>kljmkljmkljmkljmkljmkl</p>', '2018-12-27 17:37:11'),
(33, 'Quartiers Rouges .06 : Fusion mes couilles (L\'anniversaire)', '<p>ulkgklgljkgjkgjkgjklgjlgjklgjkgjklgjklgjklgjklgjkl</p>', '2019-03-29 12:41:05'),
(34, 'Your Page Title Goes here..', '<p>lmhkmklhmklhmklhmklhmklhkmlhlmkh</p>', '2019-03-29 12:41:32'),
(35, 'Open Minded : Closing 2018', '<p>Constituendi autem sunt qui sint in amicitia fines et quasi termini diligendi. De quibus tres video sententias ferri, quarum nullam probo, unam, ut eodem modo erga amicum adfecti simus, quo erga nosmet ipsos, alteram, ut nostra in amicos benevolentia i', '2019-04-05 12:42:33'),
(36, 'Hello', '<p>Constituendi autem sunt qui sint in amicitia fines et quasi termini diligendi. De quibus tres video sententias ferri, quarum nullam probo, unam, ut eodem modo erga amicum adfecti simus, quo erga nosmet ipsos, alteram, ut nostra in amicos benevolentia i', '2019-04-05 12:42:47'),
(37, 'Archibal 1er', '<p>Constituendi autem sunt qui sint in amicitia fines et quasi termini diligendi. De quibus tres video sententias ferri, quarum nullam probo, unam, ut eodem modo erga amicum adfecti simus, quo erga no\" &gt;Constituendi autem sunt qui sint in amicitia fine', '2019-04-05 12:43:02'),
(38, 'Azy', '<p style=\"color: #5e5737; font-size: 10px; margin: 10px;\">Constituendi autem sunt qui sint in</p>', '2019-04-05 12:43:27'),
(39, 'Mort', '<p>fgkjsgklmzfjdmklsfjamklfjzemkljmkljfgkjsgklmzfjdmklsfja</p>', '2019-04-05 12:43:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  `remember_token` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `confirmation_token` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `reset_token` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `admin`, `remember_token`, `confirmation_token`, `confirmed_at`, `reset_token`, `reset_at`) VALUES
(23, 'junight', 'juniegrat@gmail.com', '$2y$10$020fNevJtzA7k1s0Dlo15O0BS0sgsDu98uJhX4gNtmebhzPohstqy', 1, 'd7jFfgXAo1Y2pk0hn3neceU1RKLEW2v0tqGwJRJdsj8lfFBG4AAouVNn4DB67azSB8ZUkJz8Xq18sM1ghwLkg9KmVM5NpEpCwHHKbvYqhN1ByZkEUQm6c1H5MZjXfucO88NDlIDUVboO7YOZIGsLLEwyccat6VmQt5dNKJHjtHmJVYoHe8NtAMQRLB6zLNUVRC9zO220i3sjeZyooKggf5SmPDJk6Gv4Nej8pQmwCIRzyAgUfQrAK1mQDM', '', '2018-12-29 20:15:05', 'hLcyXoCypUXNXXXSMLoMtIZy8MfeP8odPw8VRqqtTcwAMXp4ZTTsTi3dpa4u', '2019-04-20 16:16:56'),
(24, 'simax75', 'gsg.digit@gmail.com', '$2y$10$gx9npVIZKgqB7OQ.ezus5.o/iGyXxmgWnnGqDSpR.J4nAsx4NFddO', NULL, NULL, '0U9s2sI7SFQt76UQiOi7BFdE94Z9812TSV46kBe6lBJ3Il39bTUdxNT58TaB', NULL, NULL, NULL),
(25, 'infos', 'infos@studio-404-paris.fr', '$2y$10$Fa1bbx8ca0AarGrOtj/Ph.XoIAMqZ2ymY4Z8IfL95zbc12NK5uo6i', NULL, NULL, 'ItTCQ5RwxoiqJuiL0RNgopd6AFQNEHSCoAG6ZB2T5yPElbzE5afmZMecw6za', NULL, NULL, NULL),
(26, 'user', 'hy@k', '$2y$10$gUAKKzOVFFbS6Z.ESABhWuyOF33AZN6Cd18WPqblXScb4bXhBjpN2', NULL, NULL, 'wPKVjIFxo3WoKIFHPZbe8MB1q6HuQA7LgQifRGKtAiArkvvcMbvsaOUsELM4', NULL, NULL, NULL),
(27, 'juniegrat@gmail.com', 'ju@j', '$2y$10$SQl0qnWEJZ4r86yZ2fVPL..Up.PAKQe4gsthICKTgNo03K2ApoC1i', NULL, NULL, '4pjyop8ocqRV2wGC3oEvToJ4QTrqmKGWnhigujSEToLr33fEhe5WBFCzZg56', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
