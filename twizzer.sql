-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 23, 2015 at 07:40 PM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
Database: `twizzer`
--

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `id` int(8) NOT NULL,
  `follower_user_id` int(8) NOT NULL COMMENT 'follower',
  `followee_user_id` int(8) NOT NULL COMMENT 'person being followed'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `follower_user_id`, `followee_user_id`) VALUES
(5, 2, 3),
(8, 2, 4),
(9, 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tweets`
--

CREATE TABLE IF NOT EXISTS `tweets` (
  `id` int(8) NOT NULL,
  `user_id` int(8) NOT NULL,
  `tweet` varchar(140) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tweets`
--

INSERT INTO `tweets` (`id`, `user_id`, `tweet`, `datetime`) VALUES
(1, 2, 'hello again people!', '2015-07-18 17:07:17'),
(2, 2, 'hola sennor!#YOLO', '2015-07-18 17:16:10'),
(3, 2, 'Its the 3rd day of eid people!', '2015-07-20 05:20:52'),
(14, 2, 'tweeting at mid day to see if anyone is still awake...XD', '2015-07-20 10:18:56'),
(16, 2, 'people check this video out!!!https://www.youtube.com/watch?v=WvMrrQ0tMR4', '2015-07-20 21:03:29'),
(17, 2, 'Sorry guyz! posted the wrong link few mins ago, just wanted to share the latest', '2015-07-20 21:24:14'),
(18, 2, 'morning everybody!', '2015-07-22 03:57:57'),
(21, 4, 'Got this twizzer account to keep you guys updated on the situation up at the wall...', '2015-07-23 05:27:03'),
(22, 5, 'opened a new acct......', '2015-07-23 06:14:03'),
(23, 2, 'testing this new tweet feature in twizzer...', '2015-07-23 06:30:38'),
(24, 2, 'okay...trying again:/', '2015-07-23 06:34:55'),
(25, 2, 'argg....', '2015-07-23 06:39:04'),
(26, 4, 'Winter is coming...#whiteWalkers#crowsb4everything', '2015-07-23 09:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL,
  `name` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `mail` varchar(64) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `mail`, `datetime`) VALUES
(2, 'al amin', 'amin365', '4c0d3ab67889834b3fc3dc6cba5053ed0252cca4', 'alamin365@outlook.com', '0000-00-00 00:00:00'),
(3, 'oliver quinn', 'oliverdumb123', '996e4972b506373b33231042c2e24cb8779e76fc', 'oliver@gmail.com', '0000-00-00 00:00:00'),
(4, 'jhon snow', 'wallcrow13', '6be95b7bdcfece3da6f2bd1b91837eff975e9542', 'jhon.stark@gmail.com', '0000-00-00 00:00:00'),
(5, 'mohammad ali', 'ali6780', '339d63f5a1acebb69ff3e0563720b4f78d5c206c', 'ali6780@gmail.com', '0000-00-00 00:00:00'),
(6, 'abbas khan', 'abbasBOKO', '4862422396d28ae4aca4c00db3701f5376ec381b', 'abc@gmail.com', '0000-00-00 00:00:00'),
(7, 'abbasg', 'basada123', '3d7caaa6b0921ac39405942419353c75fa8aaa09', 'bnsabdn@bamam.com', '0000-00-00 00:00:00'),
(8, 'abbas', 'abbasBOBO', '06bda63fad1095aa26332c3ffa589b265eefa06c', 'abbas@gmail.com', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tweets`
--
ALTER TABLE `tweets`
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
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `tweets`
--
ALTER TABLE `tweets`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
