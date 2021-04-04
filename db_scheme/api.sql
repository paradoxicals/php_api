-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2021 at 05:49 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `api`
--

-- --------------------------------------------------------

--
-- Table structure for table `mobile_users`
--

CREATE TABLE `mobile_users` (
  `uid` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `appid` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `language` int(2) NOT NULL,
  `os` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `client_token` varchar(30) COLLATE utf8_turkish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `mobile_users`
--

INSERT INTO `mobile_users` (`uid`, `appid`, `language`, `os`, `status`, `client_token`) VALUES
('123asdte', '26', 1, 'IOS', 1, '1e053c5e53ecd10bae8f47bc8c0269'),
('gt45a', '34', 2, 'Windows Mobile', 1, '1f0730c426bcaafd7cda1e05f23302'),
('wt57a', '43', 1, 'Android', 1, '774afcbaf8e70421f5feaba4ea55ec');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `uid` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `appid` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `receipt` varchar(30) COLLATE utf8_turkish_ci NOT NULL,
  `expire_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`uid`, `appid`, `receipt`, `expire_date`) VALUES
('123asdte', '26', '11126', '2021-04-04 09:44:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mobile_users`
--
ALTER TABLE `mobile_users`
  ADD PRIMARY KEY (`uid`,`appid`) USING BTREE,
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`uid`,`appid`) USING BTREE,
  ADD KEY `uid,receipt` (`uid`,`receipt`) USING BTREE,
  ADD KEY `expire_date` (`expire_date`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `mobile_users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
