-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 12 月 20 日 08:38
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
-- 表的结构 `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL COMMENT '组名',
  `money` int(11) NOT NULL DEFAULT '0' COMMENT '群组当前财富值',
  `member_count` smallint(5) NOT NULL DEFAULT '0' COMMENT '群组成员数',
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '群组创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '群组状态(0删除1正常)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=537 ;

--
-- 转存表中的数据 `group`
--

INSERT INTO `group` (`id`, `name`, `money`, `member_count`, `ctime`, `status`) VALUES
(536, '536', -29464, 6, '2013-12-20 08:32:25', 1);

-- --------------------------------------------------------

--
-- 表的结构 `record`
--

CREATE TABLE IF NOT EXISTS `record` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `amount` int(10) NOT NULL DEFAULT '0' COMMENT '数额',
  `usage` varchar(255) NOT NULL DEFAULT '' COMMENT '用途',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '类型：1收入/2支出',
  `ctime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '记录产生时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态(0删除1正常)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `record`
--

INSERT INTO `record` (`id`, `amount`, `usage`, `type`, `ctime`, `status`) VALUES
(2, 33, 'aaaaaa', 1, '2013-12-20 08:33:26', 0),
(3, 3333, 'aaaa', 1, '2013-12-20 08:33:35', 1),
(4, 33333, 'aaaa', 2, '2013-12-20 08:35:34', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
