-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 12 月 05 日 07:24
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `wallet`
--

-- --------------------------------------------------------

--
-- 表的结构 `record`
--

CREATE TABLE IF NOT EXISTS `record` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `amount` int(10) NOT NULL DEFAULT '0' COMMENT '数额',
  `usage` varchar(255) NOT NULL DEFAULT '' COMMENT '用途',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型：1收入/2支出',
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- 转存表中的数据 `record`
--

INSERT INTO `record` (`id`, `amount`, `usage`, `type`, `ctime`) VALUES
(1, 0, '', 0, '0000-00-00 00:00:00'),
(2, 0, '', 2, '0000-00-00 00:00:00'),
(3, 0, '', 2, '2013-12-05 03:32:18'),
(4, 0, '', 1, '2013-12-05 03:32:35'),
(5, 0, '', 2, '2013-12-05 03:37:57'),
(6, 0, '', 1, '2013-12-05 03:37:59'),
(7, 0, '', 2, '2013-12-05 03:38:01'),
(8, 0, '', 2, '2013-12-05 03:38:01'),
(9, 0, '', 1, '2013-12-05 03:38:02'),
(10, 0, '', 2, '2013-12-05 03:38:03'),
(11, 0, '', 1, '2013-12-05 03:38:04'),
(12, 33, 'sssssss', 2, '2013-12-05 03:40:38'),
(13, 0, '', 2, '2013-12-05 03:40:44'),
(14, 0, '', 2, '2013-12-05 03:40:46'),
(15, 0, '', 2, '2013-12-05 03:40:47'),
(16, 0, '', 2, '2013-12-05 03:40:48'),
(17, 0, '', 2, '2013-12-05 03:40:49'),
(18, 0, '', 2, '2013-12-05 03:40:49'),
(19, 0, '', 2, '2013-12-05 03:40:50'),
(20, 0, '', 2, '2013-12-05 03:40:50'),
(21, 0, '', 1, '2013-12-05 03:45:59'),
(22, 0, '', 1, '2013-12-05 03:46:00'),
(23, 0, '', 2, '2013-12-05 03:46:01'),
(24, 0, '', 2, '2013-12-05 03:48:26'),
(25, 0, '', 2, '2013-12-05 03:48:28'),
(26, 0, '', 1, '2013-12-05 03:48:28'),
(27, 0, '', 1, '2013-12-05 03:48:29'),
(28, 0, '', 1, '2013-12-05 03:48:30'),
(29, 0, '', 2, '2013-12-05 03:48:32'),
(30, 1, 'S', 2, '2013-12-05 03:54:54');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
