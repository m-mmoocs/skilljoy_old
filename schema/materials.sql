-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 26, 2014 at 03:43 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `skilljoy`
--

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE IF NOT EXISTS `materials` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `unit_id` bigint(20) unsigned NOT NULL,
  `content` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `content_type` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `updated_by` bigint(20) unsigned DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` bigint(20) unsigned DEFAULT NULL,
  `primary_mat` int(1) NOT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=41 ;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`id`, `unit_id`, `content`, `content_type`, `created_at`, `created_by`, `updated_at`, `updated_by`, `deleted_at`, `deleted_by`, `primary_mat`) VALUES
(1, 5, 'http://www.youtube.com/watch?v=qJxpa9plCfs', 1, '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL, 1),
(2, 5, 'http://www.idph.com.br/conteudos/ebooks/BraveNewWorld.pdf', 2, '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL, 0),
(3, 7, 'http://www.youtube.com/watch?v=afx1l0MITO4', 1, '2014-02-16 16:58:30', 2130706433, NULL, NULL, NULL, NULL, 0),
(4, 7, 'http://www.blacktieguide.com/Style_Basics/Tying_Bowties/Tying_a_Bow_Tie_rev_May_2009.pdf', 2, '2014-02-16 16:58:30', 2130706433, NULL, NULL, NULL, NULL, 1),
(17, 55, 'http://notalwaysright.com', 4, '2014-02-24 06:43:31', 0, NULL, NULL, NULL, NULL, 0),
(18, 55, 'http://notalwaysworking.com', 4, '2014-02-24 06:43:31', 0, NULL, NULL, NULL, NULL, 0),
(19, 55, 'http://notalwayslearning.com', 4, '2014-02-24 06:43:31', 0, NULL, NULL, NULL, NULL, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
