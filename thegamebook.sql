-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2014 at 04:54 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `thegamebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `contests`
--

CREATE TABLE IF NOT EXISTS `contests` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `deadline` varchar(10) NOT NULL,
  `image` varchar(200) NOT NULL,
  `shortDesc` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contests`
--

INSERT INTO `contests` (`id`, `title`, `description`, `deadline`, `image`, `shortDesc`) VALUES
(1, 'Yolo Giveaway', 'Get some free YOLO here!!!', '2014-06-02', 'contests/yolo.jpg', 'Want Free YOLO?'),
(2, 'Test Contest', 'This no short description, yes? ok? ok.', '2014-05-23', 'contests/10.jpg', 'No?');

-- --------------------------------------------------------

--
-- Table structure for table `forums`
--

CREATE TABLE IF NOT EXISTS `forums` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `threadCount` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `forums`
--

INSERT INTO `forums` (`id`, `title`, `description`, `threadCount`) VALUES
(1, 'Test Forum', 'This is a test forum for random purposes.', 2),
(2, 'Test Forum 2', 'This is another test forum for random purposes.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `headlines`
--

CREATE TABLE IF NOT EXISTS `headlines` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(80) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `image` varchar(400) NOT NULL,
  `link` varchar(400) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `headlines`
--

INSERT INTO `headlines` (`id`, `title`, `date`, `description`, `image`, `link`) VALUES
(1, 'Test Headline', '2014-05-10', 'lorem ipsum whatever whatever whatever', 'headlines/imgTest.jpg', 'news.php?id=1'),
(2, 'Test News Post', '2014-05-21', '***Filler Text***', 'headlines/img.jpg', 'news.php?id=2'),
(3, 'Another News Post', '2014-05-21', '***Some more filler text***', 'headlines/gamepic.png', 'news.php?id=3');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `fromUser` int(255) NOT NULL,
  `toUser` int(255) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL,
  `text` text NOT NULL,
  `state` int(1) NOT NULL,
  `subject` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `fromUser`, `toUser`, `date`, `time`, `text`, `state`, `subject`) VALUES
(3, 3, 1, '2014-05-18', '13:55:02', 'yolo reply test message', 1, 'reply'),
(4, 2, 2, '2014-05-21', '03:28:36', 'A B C D E F G H I J K L M N O P Q R S T U V W X Y Z', 1, 'Hello World'),
(5, 1, 3, '2014-05-22', '15:39:57', 'Well bye.', 1, 'Hello');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `image` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `date`, `description`, `image`) VALUES
(1, 'Test Headline', '2014-05-10', 'lorem ipsum whatever whatever whatever', 'headlines/imgTest.jpg'),
(2, 'Test News Post', '2014-05-21', '***Filler Text***', 'headlines/img.jpg'),
(3, 'Another News Post', '2014-05-21', '***Some more filler text***', 'headlines/gamepic.png');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `threadId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `text` text NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `threadId`, `userId`, `text`, `date`, `time`) VALUES
(1, 1, 1, 'Post text and some text and more text.\r\n\r\nAnd Some Edit text.', '2014-05-21', '23:44:21'),
(2, 1, 2, 'Ok, I will Yolo.', '2014-05-22', '10:08:18'),
(3, 1, 3, 'But why do you want to Yolo?', '2014-05-22', '10:10:05'),
(4, 1, 1, 'No.', '2014-05-22', '14:26:14'),
(5, 1, 2, 'Why not?', '2014-05-22', '14:29:00'),
(6, 1, 1, 'I don''t know. I guess because I say so.', '2014-05-22', '15:35:15'),
(9, 2, 2, 'So... what should I write here?', '2014-05-22', '23:32:35'),
(10, 6, 3, 'Please, just shut up.', '2014-05-22', '23:52:17');

-- --------------------------------------------------------

--
-- Table structure for table `threads`
--

CREATE TABLE IF NOT EXISTS `threads` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `forumId` int(255) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `startUser` int(255) NOT NULL,
  `postCount` int(255) NOT NULL,
  `startDate` varchar(10) NOT NULL,
  `lastPostDate` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `threads`
--

INSERT INTO `threads` (`id`, `forumId`, `title`, `description`, `startUser`, `postCount`, `startDate`, `lastPostDate`) VALUES
(1, 1, 'Test Thread/Discussion', 'This test discussion thread is a child of thread id 1 i.e. Test Forum.', 1, 6, '2014-05-21', '2014-05-22'),
(2, 1, 'Some Other Thread', 'Hello World', 2, 1, '2014-05-22', '2014-05-22'),
(6, 2, 'What now?', 'Leave Me Alone.', 3, 1, '2014-05-22', '2014-05-22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(70) NOT NULL,
  `location` varchar(30) NOT NULL,
  `rank` int(3) NOT NULL,
  `banStatus` int(1) NOT NULL,
  `displayPic` varchar(64) NOT NULL DEFAULT 'displaypics/nopic.jpg',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `email`, `location`, `rank`, `banStatus`, `displayPic`) VALUES
(1, 'Abdul Sami Farrukh', 'sammy', 'administrator', 'sam@yolo.com', 'yolo', 3, 0, 'displaypics/Administrator.jpg'),
(2, 'Yolo Khan', 'yoloyolo', 'root', 'yolo@khan.khurram', 'Brazil', 1, 0, 'displaypics/nopic.jpg'),
(3, 'test', 'testuser', 'test', 'test@test.com', 'testlocation', 1, 0, 'displaypics/dp.jpg'),
(4, 'Bottle', 'bottle', 'bottle', 'bottle@arslan.com', 'South Africa', 2, 0, 'displaypics/nopic.jpg'),
(5, 'user', 'useruser', 'root', 'user@user.com', 'random', 1, 0, 'displaypics/nopic.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
