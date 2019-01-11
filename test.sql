-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 11, 2019 at 03:00 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

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
(57, 22, 'junight', 'Afoerughofb', '2018-12-27 18:04:36', 1),
(59, 20, 'junight', 'fddfkpokpo', '2018-12-30 16:23:45', 0),
(61, 22, 'junight', 'Gougou', '2018-12-30 16:38:21', 0),
(62, 22, 'junight', 'Radio gougou', '2018-12-30 16:38:26', 0),
(63, 25, 'junight', 'bmfgbfkmjbnkfjnkjfnbkjenb', '2018-12-30 16:41:45', 2),
(64, 25, 'junight', 'juninininin', '2018-12-30 16:49:14', 0),
(65, 25, 'junight', 'g', '2018-12-30 18:07:56', 4),
(66, 25, 'junight', 'hh', '2018-12-31 15:33:23', 1),
(67, 22, 'junight', 'jjjj', '2018-12-31 15:34:31', 1),
(68, 22, 'junight', 'hh', '2018-12-31 15:34:35', 0),
(69, 25, 'junight', 'Halo', '2019-01-11 14:44:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` varchar(255) NOT NULL,
  `date_creation` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `content`, `date_creation`) VALUES
(20, 'TECHNO MAGIQUE w/ Emmanuel & Introversion', '<p>vb vb vb vdbgvnvxbnvbcnb bn vbc cb&nbsp;</p>', '2018-12-27 17:37:11'),
(22, 'Anceztral w/ Rey & Kjavik, Jugurtha / 002', '<p>hlkmhhmml</p>', '2018-12-27 18:02:52'),
(23, 'Anceztral w/ Rey & Kjavik, Jugurtha / 002', '<p>bonjour</p>', '2018-12-28 18:45:25'),
(24, 'Quartiers Rouges .06 : Fusion mes couilles (L\'anniversaire)', '<p>kdfhvlmsdfbhvmldkbhjsvmsld</p>', '2018-12-29 20:29:46'),
(25, 'lkjlkjjlk', '<p>ojlkjljlkj</p>', '2018-12-29 20:44:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `remember_token` varchar(255) NOT NULL,
  `confirmation_token` varchar(255) NOT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `reset_token` varchar(255) NOT NULL,
  `reset_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `admin`, `remember_token`, `confirmation_token`, `confirmed_at`, `reset_token`, `reset_at`) VALUES
(23, 'junight', 'juniegrat@gmail.com', '$2y$10$LHJ6DkL3R0IIaFwMlbP6MuzXfnFm0wVtlIkDQMbuAlHzrOznaVcrS', 1, '2iKf0OhnaBS5YieDJYM25aI8ZaNgtvsue6PXx3fQBv53oOSF5EXLQhPUQqP555UodWZDgogsawYIIxCenqoihA81XULA5wR6OYWHQ6IqwWbkTU5nyru9osLfKZzLQcoxF0Nq8QHAfCTHfFWOe17ilfu4to5RVwvSHY6wm0oqAkR9Z7aXiJ517x6TSzPkmAo74l1to06mllsb9RSChlEYAUccyWHUSpTw5kmp7WJZ0FAwLFLZcoA4L6Kcum', '', '2018-12-29 20:15:05', '', NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
