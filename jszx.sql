-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2019-03-15 10:01:55
-- 服务器版本： 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jszx`
--

-- --------------------------------------------------------

--
-- 表的结构 `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `num` char(11) NOT NULL,
  `name` char(10) NOT NULL,
  `password` char(32) NOT NULL,
  `phone` char(11) NOT NULL,
  `grade` char(4) NOT NULL,
  `major` varchar(10) NOT NULL,
  `origin` char(10) NOT NULL,
  `sex` char(2) NOT NULL,
  `birthday` char(20) NOT NULL,
  `admin` int(11) DEFAULT '0',
  `create_time` datetime DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `delete_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `employee`
--

INSERT INTO `employee` (`id`, `num`, `name`, `password`, `phone`, `grade`, `major`, `origin`, `sex`, `birthday`, `admin`, `create_time`, `update_time`, `delete_time`) VALUES
(1, '2016054114', '李芸菊', 'e10adc3949ba59abbe56e057f20f883e', '13680315632', '2016', '市场营销', '甘肃白银', '女', '1998-06-14', 0, NULL, NULL, NULL),
(2, '2016052402', '周美铧', 'e10adc3949ba59abbe56e057f20f883e', '13680327465', '2016', '电气工程及其自动化', '广东茂名', '男', '1998-10-31', 0, NULL, NULL, NULL),
(3, '2017052329', '卢杰华', 'e10adc3949ba59abbe56e057f20f883e', '13424003628', '2017', '软件工程', '广东广州', '男', '1998-12-05', 0, NULL, NULL, NULL),
(4, '2018052364', '张卓', 'e10adc3949ba59abbe56e057f20f883e', '19875601756', '2018', '电气工程及其自动化', '云南保山', '男', '1999-01-02', 0, NULL, NULL, NULL),
(5, '2018054465', '黄鸿杰', 'e10adc3949ba59abbe56e057f20f883e', '15119670582', '2018', '自动化', '广东茂名', '男', '1998-10-28', 0, NULL, NULL, NULL),
(6, '2016052405', '黄佩仪', 'e10adc3949ba59abbe56e057f20f883e', '0', '0', '', '', '女', '1998', 0, NULL, NULL, NULL),
(7, '2017050316', '史文欣', 'e10adc3949ba59abbe56e057f20f883e', '19875600462', '2017', '市场营销', '河北', '女', '1998-01-02', 0, NULL, NULL, NULL),
(8, '2018050077', '贺志超', 'e10adc3949ba59abbe56e057f20f883e', '13314857760', '2018', '自动化', '内蒙古包头', '男', '2000-06-16', 0, NULL, NULL, NULL),
(9, '2017052523', '陈梓熠', 'e10adc3949ba59abbe56e057f20f883e', '13671449542', '2017', '信息安全', '广东潮州', '男', '1999-11-15', 0, NULL, NULL, NULL),
(10, '2017052525', '钟嘉梓', 'e10adc3949ba59abbe56e057f20f883e', '15220542150', '2017', '信息安全', '广东广州', '女', '1999-01-16', 0, NULL, NULL, NULL),
(13, '111111', '1', 'e10adc3949ba59abbe56e057f20f883e', '0', '0', '', '', '男', '1998', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `name` char(10) NOT NULL,
  `mes` varchar(255) NOT NULL,
  `time` char(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`id`, `name`, `mes`, `time`) VALUES
(1, '周美铧', 'asdf', ''),
(2, '周美铧', 'asdf', '2019-02-28 19:40:50'),
(3, '周美铧', '', '2019-03-04 19:47:53'),
(4, '2016054114', 'asdf', '2019-03-04 19:50:56'),
(5, '李芸菊', 'asdf', '2019-03-04 19:56:51'),
(6, '张卓', 'asdf', '2019-03-07 09:29:35');

-- --------------------------------------------------------

--
-- 表的结构 `principal`
--

CREATE TABLE `principal` (
  `id` int(11) NOT NULL,
  `num` char(11) NOT NULL,
  `name` char(10) NOT NULL,
  `password` char(32) NOT NULL,
  `createTime` char(32) NOT NULL,
  `deleteTime` char(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `principal`
--

INSERT INTO `principal` (`id`, `num`, `name`, `password`, `createTime`, `deleteTime`) VALUES
(1, '2016054114', '李芸菊', 'e10adc3949ba59abbe56e057f20f883e', '2019-03-05 09:13:13', ''),
(2, '2016054111', '卢杰华', 'e10adc3949ba59abbe56e057f20f883e', '2019-03-05 09:13:13', '');

-- --------------------------------------------------------

--
-- 表的结构 `thing`
--

CREATE TABLE `thing` (
  `id` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `period` char(10) NOT NULL,
  `time` varchar(10) NOT NULL,
  `room` varchar(10) NOT NULL,
  `what` varchar(5) NOT NULL,
  `jpg` char(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `name` varchar(10) DEFAULT NULL,
  `num` varchar(10) DEFAULT NULL,
  `pro` varchar(10) DEFAULT NULL,
  `pick` varchar(20) DEFAULT NULL,
  `phone` int(11) DEFAULT NULL,
  `duty` varchar(5) DEFAULT NULL,
  `photo` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `thing`
--

INSERT INTO `thing` (`id`, `date`, `period`, `time`, `room`, `what`, `jpg`, `status`, `name`, `num`, `pro`, `pick`, `phone`, `duty`, `photo`) VALUES
(1, '2019-03-01', '', '09:06:48', 'c305', 'U盘', '', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '2019-03-04', '1', '20:44:53', 'c301', 'u盘', 'dc207d87cfe1b6c655ba9e682224b5c6.png', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `working_time`
--

CREATE TABLE `working_time` (
  `id` int(11) NOT NULL,
  `name` char(10) NOT NULL,
  `date` char(10) NOT NULL,
  `time` char(50) NOT NULL,
  `period` tinyint(4) NOT NULL,
  `working` float NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `working_time`
--

INSERT INTO `working_time` (`id`, `name`, `date`, `time`, `period`, `working`) VALUES
(1, '黄鸿杰', '2019-2-28', '2019年2月28日 08:52:36', 1, 2.5),
(2, '周美铧', '2019-02-28', '2019-02-28 09:53:37', 1, 2.3),
(3, '周美铧', '2019-02-28', '10:09:22', 1, 2.4),
(4, '卢杰华', '2019-02-28', '10:33:31', 1, 2.4),
(5, '李芸菊', '2019-03-04', '2019-03-04 09:25:17', 1, 2.5),
(6, '张卓', '2019-03-04', '09:35:13', 5, 2.4),
(7, '周美铧', '2019年03月04', '09:35:34', 1, 2.4),
(8, '李芸菊', '2019-03-05', '2019年3月4日 18:38:54', 1, 2.5),
(9, '李芸菊', '2019-03-05', '09:39:08', 1, 2.4),
(10, '李芸菊', '2019-03-05', '09:39:11', 1, 2.4),
(11, '周美铧', '2019-03-05', '09:39:13', 1, 2.4),
(12, '史文欣', '2019-03-05', '09:43:24', 1, 2.4),
(13, '黄佩仪', '2019-02-05', '09:43:27', 1, 2.4),
(14, '李芸菊', '2019-03-05', '11:31:55', 5, 2.5),
(15, '钟嘉梓', '2019-03-05', '2019年3月4日 18:38:54', 1, 2.5),
(16, '陈梓熠', '2019-03-05', '2019年3月4日 18:38:54', 1, 2.5),
(17, '贺志超', '2019-03-05', '2019年3月4日 18:38:54', 1, 2.5),
(18, '李芸菊', '2019-03-06', '21:21:21', 1, 2.4),
(19, '周美铧', '2019-03-07', '17:50:12', 1, 2.4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `principal`
--
ALTER TABLE `principal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thing`
--
ALTER TABLE `thing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `working_time`
--
ALTER TABLE `working_time`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- 使用表AUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `principal`
--
ALTER TABLE `principal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `thing`
--
ALTER TABLE `thing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `working_time`
--
ALTER TABLE `working_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
