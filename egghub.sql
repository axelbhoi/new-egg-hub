-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2013 at 01:32 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `egghub`
--

-- --------------------------------------------------------

--
-- Table structure for table `e_chat_table`
--

CREATE TABLE IF NOT EXISTS `e_chat_table` (
  `chat_message_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_email` varchar(80) NOT NULL,
  `user_name` text NOT NULL,
  `chat_message_content` varchar(150) NOT NULL,
  `created_date` date NOT NULL,
  `cremod` text NOT NULL,
  PRIMARY KEY (`chat_message_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `e_comments_tbl`
--

CREATE TABLE IF NOT EXISTS `e_comments_tbl` (
  `e_comment_id` varchar(250) NOT NULL,
  `e_post_id` varchar(250) NOT NULL,
  `e_comment_by` int(11) NOT NULL,
  `e_comment_content` varchar(300) NOT NULL,
  `e_comment_cremod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`e_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `e_login_tbl`
--

CREATE TABLE IF NOT EXISTS `e_login_tbl` (
  `e_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_login_email` varchar(128) NOT NULL,
  `e_login_password` varchar(32) NOT NULL,
  `e_login_fname` varchar(32) NOT NULL,
  `e_login_lname` varchar(32) NOT NULL,
  `e_login_picture` varchar(64) NOT NULL,
  `e_login_picture_sixty_four` text NOT NULL,
  `e_login_picture_thirty_two` text NOT NULL,
  `e_login_isActive` int(1) NOT NULL,
  `e_login_cremod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`e_login_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `e_login_tbl`
--

INSERT INTO `e_login_tbl` (`e_login_id`, `e_login_email`, `e_login_password`, `e_login_fname`, `e_login_lname`, `e_login_picture`, `e_login_picture_sixty_four`, `e_login_picture_thirty_two`, `e_login_isActive`, `e_login_cremod`) VALUES
(2, 'axelfelipe1224@gmail.com', '39fdd84f3fe8961866a6375a4172a54b', 'axel', 'felipe', 'asiong.jpg', 'asiong_thumb.jpg', 'asiong_thumb.jpg', 0, '2013-09-01 22:59:13'),
(3, 'pakitodantes1224@gmail.com', '39fdd84f3fe8961866a6375a4172a54b', 'pakito', 'dantes', '', '', '', 0, '2013-09-01 22:59:16'),
(4, 'axelfelipe1224@yahoo.com', '39fdd84f3fe8961866a6375a4172a54b', 'teteng', 'makati', 'char2.jpg', 'char2_thumb.jpg', 'char2_thumb.jpg', 0, '2013-09-01 18:55:53');

-- --------------------------------------------------------

--
-- Table structure for table `e_notification_tbl`
--

CREATE TABLE IF NOT EXISTS `e_notification_tbl` (
  `e_notification_id` int(11) NOT NULL AUTO_INCREMENT,
  `e_post_id` text NOT NULL,
  `e_comment_id` text NOT NULL,
  `e_comment_by` int(11) NOT NULL,
  `e_notification_for` text NOT NULL,
  `e_notification_isActive` int(11) NOT NULL,
  `e_notification_cremod` text NOT NULL,
  PRIMARY KEY (`e_notification_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `e_posts_tbl`
--

CREATE TABLE IF NOT EXISTS `e_posts_tbl` (
  `e_post_id` varchar(250) DEFAULT NULL,
  `e_post_by` text NOT NULL,
  `e_post_content` text NOT NULL,
  `e_post_like` text NOT NULL,
  `e_post_cremod` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `e_post_id` (`e_post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `e_profile_tbl`
--

CREATE TABLE IF NOT EXISTS `e_profile_tbl` (
  `e_profile_email` varchar(100) NOT NULL,
  `e_describe_yourself` text NOT NULL,
  `e_fave_quote` text NOT NULL,
  `e_month` varchar(20) NOT NULL,
  `e_day` varchar(2) NOT NULL,
  `e_year` varchar(4) NOT NULL,
  `e_gender` varchar(7) NOT NULL,
  `e_contact_number` varchar(11) NOT NULL,
  `e_status` varchar(30) NOT NULL,
  `e_college` varchar(30) NOT NULL,
  `e_highschool` varchar(40) NOT NULL,
  `e_mail` varchar(100) NOT NULL,
  PRIMARY KEY (`e_profile_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `e_profile_tbl`
--

INSERT INTO `e_profile_tbl` (`e_profile_email`, `e_describe_yourself`, `e_fave_quote`, `e_month`, `e_day`, `e_year`, `e_gender`, `e_contact_number`, `e_status`, `e_college`, `e_highschool`, `e_mail`) VALUES
('axelfelipe1224@gmail.com', '', '', '', '', '', '', '', '', '', '', ''),
('axelfelipe1224@yahoo.com', '', '', '', '', '', '', '', '', '', '', ''),
('pakitodantes1224@gmail.com', '', '', '', '', '', '', '', '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
