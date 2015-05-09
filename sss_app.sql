-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 08, 2012 at 12:10 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `cakephp_uscms`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `comment` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `created`, `modified`) VALUES(12, 43, 8, 'This is my favourite image ever.', '2012-04-08 10:39:12', '2012-04-08 11:20:15');
INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `created`, `modified`) VALUES(13, 43, 14, 'I agree, it''s wonderful!', '2012-04-08 10:40:30', '2012-04-08 10:40:30');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  `file_size` mediumint(9) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=92 ;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `file_name`, `file_type`, `file_size`, `content`, `user_id`) VALUES(43, 'png #4', 'FireFTPopen.png', 'image/png', 59209, 'png #4 png #4 png #4', 8);
INSERT INTO `posts` (`id`, `title`, `file_name`, `file_type`, `file_size`, `content`, `user_id`) VALUES(44, 'blah', 'FireFTP for Internet Scripting Feb 2011.pdf', 'application/pdf', 215109, 'pdf then doc then create png then pdf', 8);
INSERT INTO `posts` (`id`, `title`, `file_name`, `file_type`, `file_size`, `content`, `user_id`) VALUES(91, 'Lorem Ipsum', '', '', 0, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 8);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(40) NOT NULL,
  `role` enum('regular','admin') NOT NULL DEFAULT 'regular',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`) VALUES(8, 'Head Honcho', 'admin', '853d394b5df905139186ea9e2428b1711f337986', 'admin');
INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`) VALUES(13, 'Wilma Flintstone', 'wilma', '7d6663881e61aaa1f1158252557bf29d59814eba', 'regular');
INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`) VALUES(14, 'Fred Flintstone', 'fred', 'f818e7bf9f1826d852c2d9171630decfa85f5556', 'regular');
