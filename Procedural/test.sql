-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 11, 2018 at 07:30 PM
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
(38, 16, 'junight', 'Wooow', '2018-10-04 12:01:16', 4),
(39, 16, 'junight', 'Wooow', '2018-10-04 12:02:05', 8),
(40, 12, 'junight', 'boul', '2018-10-04 12:31:53', 1),
(41, 15, 'junight', 'bbb', '2018-10-04 12:38:45', 0),
(42, 15, 'junight', 'Bonjour', '2018-10-08 11:09:16', 0),
(43, 15, 'junight', 'test', '2018-10-08 11:25:34', 0),
(44, 15, 'junight', 'test', '2018-10-08 11:25:46', 0),
(45, 15, 'junight', 'Wesh', '2018-12-10 22:06:02', 0);

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
(12, 'Woooow', '<h1 style=\"text-align: center;\">Woooow</h1>', '2018-10-03 15:03:08'),
(15, 'Mon super titre !', '<h1 style=\"text-align: center;\">Mon Super Contenu...</h1>', '2018-10-03 15:30:49');

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
(3, 'junight', 'juniegrat@gmail.com', '$2y$10$s3NzVMdPXFq5Kag6X7ZAg.aFvwCCR5mRFjIjr6FTVsAiDORyy6Lni', 1, 'Uspqb3rrTvivbumtaltcm7B6RG5rwClhoYQ0zVOCiVbo0ZqBkm8zERl8tL1JarNFJXdzpRu9k41PEq1jTpBrGaEwQxEoqdoB2B02WT7YK8z7rtLFpDP9eMNUBRJ0odhDbmgdCg0RRow5QOQbBp3BhC5HrPWoq9qaXDKyZ7CvcPzeKkkbDNk9PU6tWgoDQ2fG1m8xXKTUESKI9GW0Bg17VSGE7h6FhocZGd6yUYGNzbtV7X0s7DBGKhF9yM', '', '2018-08-26 15:47:40', 'fDJVpOwah6URcovNviGvfiZhdbD69WEEGuvDv2fqH5pqTdJZIR26Sdo3wqxU', '2018-08-26 16:08:26');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
