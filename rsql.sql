-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2015 at 07:12 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rsql`
--
CREATE DATABASE IF NOT EXISTS `rsql` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `rsql`;

-- --------------------------------------------------------

--
-- Table structure for table `remote_databases`
--

CREATE TABLE IF NOT EXISTS `remote_databases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hostname` varchar(250) NOT NULL,
  `port` varchar(250) NOT NULL,
  `db_name` varchar(250) NOT NULL,
  `db_username` varchar(250) NOT NULL,
  `db_password` varchar(250) NOT NULL,
  `user_id` int(11) NOT NULL,
  `slug` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `remote_databases`
--

INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(1, '127.0.0.1', '3306', 'sam', 'root', '', 1, '567bdd9dcb90f');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(2, '127.0.0.1', '3306', 'sam', 'root', '', 1, '567bdf086c7e8');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(3, '127.0.0.1', '3306', 'sam', 'root', '', 1, '567cdd044be22');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(4, '127.0.0.1', '3306', 'sam', 'root', '', 1, '567cfc4cd0940');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(5, '127.0.0.1', '3306', 'sam', 'root', '', 1, '567cfc4cf189a');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(6, '127.0.0.1', '3306', 'sam', 'root', '', 1, '567d43096f9e1');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(7, '127.0.0.1', '3306', 'sam', 'root', '', 1, '567d691ec8267');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(8, '127.0.0.1', '3306', 'sam', 'root', '', 1, '567e3e881d602');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(9, '127.0.0.1', '3306', 'sam', 'root', '', 1, '567e539e3b60d');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(10, '127.0.0.1', '3306', 'sam', 'root', '', 1, '567e539e567ab');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(11, '127.0.0.1', '3306', 'sam', 'root', '', 1, '567e77e8932a7');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(12, '127.0.0.1', '3306', 'sam', 'root', '', 1, '567e921fe4883');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(13, '127.0.0.1', '3306', 'sam', 'root', '', 1, '567f6b2ca5355');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(14, '127.0.0.1', '3306', 'sam', 'root', '', 1, '567fee707f9b5');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(15, '127.0.0.1', '3306', 'sam', 'root', '', 1, '5680c40570cae');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(16, '127.0.0.1', '3306', 'sam', 'root', '', 1, '5680d5ec8c114');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(17, '127.0.0.1', '3306', 'sam', 'root', '', 1, '5680f0a401c31');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(18, '127.0.0.1', '3306', 'sam', 'root', '', 1, '56810e25caa34');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(19, '127.0.0.1', '3306', 'sam', 'root', '', 1, '568132d7dce8e');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(20, '127.0.0.1', '3306', 'sam', 'root', '', 1, '568206bd2860b');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(21, '127.0.0.1', '3306', 'sam', 'root', '', 1, '56824cb4dc90b');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(22, '127.0.0.1', '3306', 'sam', 'root', '', 1, '568258b8db5f7');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(23, '127.0.0.1', '3306', 'sam', 'root', '', 1, '56825a8408854');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(24, '127.0.0.1', '3306', 'sam', 'root', '', 1, '5682bae6d3be6');
INSERT INTO `remote_databases` (`id`, `hostname`, `port`, `db_name`, `db_username`, `db_password`, `user_id`, `slug`) VALUES(25, '127.0.0.1', '3306', 'sam', 'root', '', 1, '5682cc420b8e2');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `joined_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `joined_date`, `email`) VALUES(1, 'admin', 'admin', '2015-12-24 15:52:41', 'admin@admin.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
