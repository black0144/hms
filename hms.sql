-- phpMyAdmin SQL Dump
-- version 2.11.9.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1:3306
-- 生成日期: 2012 年 05 月 31 日 12:47
-- 服务器版本: 5.1.28
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `hms`
--

-- --------------------------------------------------------

--
-- 表的结构 `bill`
--

CREATE TABLE IF NOT EXISTS `bill` (
  `billid` int(10) NOT NULL AUTO_INCREMENT,
  `id` varchar(20) COLLATE utf8_bin NOT NULL,
  `roomid` int(4) NOT NULL,
  `intime` date NOT NULL,
  `outtime` date DEFAULT NULL,
  `money` int(6) DEFAULT NULL,
  PRIMARY KEY (`billid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=14 ;

--
-- 导出表中的数据 `bill`
--

INSERT INTO `bill` (`billid`, `id`, `roomid`, `intime`, `outtime`, `money`) VALUES
(13, '32323628312938799', 401, '2012-05-29', NULL, NULL),
(11, '232423423472384729', 301, '2012-05-25', NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `bookid` int(10) NOT NULL AUTO_INCREMENT,
  `id` varchar(20) COLLATE utf8_bin NOT NULL,
  `type` varchar(10) COLLATE utf8_bin NOT NULL,
  `num` int(5) NOT NULL,
  `bookintime` date NOT NULL,
  PRIMARY KEY (`bookid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=25 ;

--
-- 导出表中的数据 `book`
--

INSERT INTO `book` (`bookid`, `id`, `type`, `num`, `bookintime`) VALUES
(1, '321084198911136734', '豪华间', 1, '2012-07-31'),
(20, '32876589434236723842', '标准间', 1, '2012-06-27'),
(9, '5435435435433543', '双人间', 1, '2012-06-29'),
(11, '321087654565454232', '单人间', 1, '2012-06-15'),
(12, '329865451511172635', '标准间', 1, '2012-06-21'),
(13, '432765498736458713', '豪华间', 2, '2012-06-06'),
(14, '321876549876567876', '单人间', 1, '2012-07-19'),
(15, '321098765465327865', '豪华间', 1, '2012-07-08'),
(16, '765432198765478453', '双人间', 1, '2012-06-14'),
(17, '321086548711765423', '单人间', 1, '2012-06-30'),
(18, '876543982763548173', '双人间', 1, '2012-10-01'),
(21, '765476538如7362847', '单人间', 1, '2012-09-29'),
(22, '765238612837219798', '单人间', 1, '2012-05-27'),
(23, '321084198911136734', '单人间', 1, '2012-07-07');

-- --------------------------------------------------------

--
-- 表的结构 `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` varchar(20) COLLATE utf8_bin NOT NULL,
  `name` varchar(10) COLLATE utf8_bin NOT NULL,
  `level` smallint(3) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 导出表中的数据 `customer`
--

INSERT INTO `customer` (`id`, `name`, `level`) VALUES
('77777', 'pxs', 2),
('hhh', 'pxs', 2),
('khk', 'hkk', 1),
('321084198911136734', '潘祥松', 3),
('110', '测试', 1),
('321084198911136732', '小张', 1),
('321084198911136731', '小张', 1),
('28364648273862886879', '小李', 1),
('321084198911136735', '小王', 1),
('ff', 'gff', 1),
('gbgb', 'bfbf', 1),
('gbb', 'ngtb', 1),
('ss', 's', 1),
('3342353543543543543', '小王', 1),
('5435353453', 'aaa', 1),
('777777777777777777', '生菜君', 1),
('886867', 'ttt', 1),
('rrfr', 'aad', 1),
('ddd', 'sdd', 1),
('1111', '小朱', 1),
('1233456456754767', '小王', 1),
('5435435435433543', '小李', 1),
('656565768787989', '小张', 1),
('223243242342342', '小朱', 1),
('5435435353', '张三', 1),
('6764554454435', '李四', 1),
('321087654565454232', '熊伟', 1),
('329865451511172635', '梁伟欣', 1),
('432765498736458713', '蒋登杰', 1),
('321876549876567876', '徐声雷', 1),
('321098765465327865', '黄科', 1),
('765432198765478453', '夏益锋', 1),
('321086548711765423', '范俊', 1),
('876543982763548173', '刘毅', 1),
('搜索', '啊啊啊啊', 1),
('32876589434236723842', '孙彬', 1),
('765476538如7362847', '许剑飞', 1),
('765238612837219798', '许剑飞', 1),
('3218765655657878979', '于爽', 1),
('232423423472384729', '王芳', 1),
('3263864384739249234', '朱琼', 1),
('32323628312938799', '孙彬', 1);

-- --------------------------------------------------------

--
-- 表的结构 `discount`
--

CREATE TABLE IF NOT EXISTS `discount` (
  `level` smallint(3) NOT NULL,
  `percent` double NOT NULL,
  PRIMARY KEY (`level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 导出表中的数据 `discount`
--

INSERT INTO `discount` (`level`, `percent`) VALUES
(1, 1),
(2, 0.98),
(3, 0.96),
(4, 0.94),
(5, 0.92),
(6, 0.9),
(7, 0.88),
(8, 0.86),
(0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `billid` int(10) NOT NULL,
  `id` varchar(20) COLLATE utf8_bin NOT NULL,
  `name` varchar(10) COLLATE utf8_bin NOT NULL,
  `roomid` int(4) NOT NULL,
  `intime` date NOT NULL,
  `outtime` date NOT NULL,
  `money` int(6) NOT NULL,
  PRIMARY KEY (`billid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 导出表中的数据 `report`
--

INSERT INTO `report` (`billid`, `id`, `name`, `roomid`, `intime`, `outtime`, `money`) VALUES
(9, '6764554454435', '蒋登杰', 402, '2012-05-10', '2012-05-29', 3800),
(1, '321084198911136732', '熊伟', 101, '2012-05-10', '2012-05-29', 1140),
(6, '656565768787989', '张飞', 102, '2012-05-10', '2012-05-19', 540),
(7, '223243242342342', '朱琳', 301, '2012-05-10', '2012-05-19', 1080),
(8, '5435435353', '李丽', 103, '2012-05-10', '2012-05-19', 540),
(3, '321084198911136734', '潘祥松', 401, '2012-05-10', '2012-05-29', 3648),
(12, '3263864384739249234', '朱琼', 201, '2012-05-24', '2012-05-29', 500),
(10, '3218765655657878979', '于爽', 101, '2012-05-27', '2012-05-29', 120);

-- --------------------------------------------------------

--
-- 表的结构 `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `roomid` int(4) NOT NULL,
  `type` varchar(10) COLLATE utf8_bin NOT NULL,
  `price` int(6) NOT NULL,
  `tel` varchar(10) COLLATE utf8_bin NOT NULL,
  `status` varchar(10) COLLATE utf8_bin NOT NULL,
  `desc` text COLLATE utf8_bin,
  PRIMARY KEY (`roomid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 导出表中的数据 `room`
--

INSERT INTO `room` (`roomid`, `type`, `price`, `tel`, `status`, `desc`) VALUES
(101, '单人间', 60, '12345678', '空房', ''),
(102, '单人间', 60, '12345678', '空房', ''),
(103, '单人间', 60, '12345678', '空房', NULL),
(104, '单人间', 60, '12345678', '空房', NULL),
(105, '单人间', 60, '12345678', '空房', NULL),
(106, '单人间', 60, '12345678', '空房', NULL),
(107, '单人间', 60, '12345678', '空房', NULL),
(108, '单人间', 60, '12345678', '空房', NULL),
(109, '单人间', 60, '12345678', '空房', NULL),
(110, '单人间', 60, '12345678', '空房', NULL),
(111, '单人间', 60, '12345678', '空房', NULL),
(112, '单人间', 60, '12345678', '空房', ''),
(201, '双人间', 100, '12345678', '空房', NULL),
(202, '双人间', 100, '12345678', '空房', NULL),
(203, '双人间', 100, '12345678', '空房', NULL),
(204, '双人间', 100, '12345678', '空房', NULL),
(205, '双人间', 100, '12345678', '空房', NULL),
(206, '双人间', 100, '12345678', '空房', NULL),
(207, '双人间', 100, '12345678', '空房', NULL),
(208, '双人间', 100, '12345678', '空房', NULL),
(209, '双人间', 100, '12345678', '空房', NULL),
(210, '双人间', 100, '12345678', '空房', NULL),
(211, '双人间', 100, '12345678', '空房', NULL),
(212, '双人间', 100, '12345678', '空房', NULL),
(301, '标准间', 120, '12345678', '已入住', NULL),
(302, '标准间', 120, '12345678', '空房', NULL),
(303, '标准间', 120, '12345678', '空房', NULL),
(304, '标准间', 120, '12345678', '空房', NULL),
(305, '标准间', 120, '12345678', '空房', NULL),
(306, '标准间', 120, '12345678', '空房', NULL),
(307, '标准间', 120, '12345678', '空房', NULL),
(308, '标准间', 120, '12345678', '空房', NULL),
(309, '标准间', 120, '12345678', '空房', NULL),
(310, '标准间', 120, '12345678', '空房', NULL),
(311, '标准间', 120, '12345678', '空房', NULL),
(312, '标准间', 120, '12345678', '空房', NULL),
(401, '豪华间', 200, '12345678', '已入住', NULL),
(402, '豪华间', 200, '12345678', '空房', NULL),
(403, '豪华间', 200, '12345678', '空房', NULL),
(404, '豪华间', 200, '12345678', '空房', NULL),
(405, '豪华间', 200, '12345678', '空房', NULL),
(406, '豪华间', 200, '12345678', '空房', NULL),
(407, '豪华间', 200, '12345678', '空房', NULL),
(408, '豪华间', 200, '12345678', '空房', NULL),
(409, '豪华间', 200, '12345678', '空房', NULL),
(410, '豪华间', 200, '12345678', '空房', NULL),
(411, '豪华间', 200, '12345678', '空房', NULL),
(412, '豪华间', 200, '12345678', '空房', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `username` varchar(30) COLLATE utf8_bin NOT NULL,
  `password` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 导出表中的数据 `user`
--

INSERT INTO `user` (`username`, `password`) VALUES
('admin', 'admin'),
('user1', 'user1'),
('user2', 'user2');
