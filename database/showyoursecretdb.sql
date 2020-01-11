-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2020-01-07 20:27:22
-- 服务器版本： 10.4.8-MariaDB
-- PHP 版本： 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `showyoursecretdb`
--

-- --------------------------------------------------------

--
-- 表的结构 `secret`
--

CREATE TABLE `secret` (
  `secret_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `secret_content` varchar(225) NOT NULL,
  `anonymous` enum('yes','no') NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `secret`
--

INSERT INTO `secret` (`secret_id`, `user_id`, `secret_content`, `anonymous`) VALUES
(1, 1, 'first secret', 'yes'),
(2, 1, 'second secret', 'no'),
(3, 1, 'third secret', 'yes'),
(4, 1, '4th', 'no'),
(5, 1, '5th', 'yes'),
(6, 1, '6th', 'no'),
(7, 1, '7th', 'no'),
(8, 1, '8th', 'no'),
(9, 1, '9th', 'no'),
(10, 1, '10th', 'no'),
(11, 1, '11th', 'no'),
(12, 1, '12th', 'yes'),
(13, 2, '13th', 'no');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `password` varchar(30) NOT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `interests` varchar(100) DEFAULT NULL,
  `my_picture_name` varchar(100) DEFAULT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `password`, `gender`, `interests`, `my_picture_name`, `remark`) VALUES
(1, 'admin', 'admin', 'male', 'music', '', 'hello'),
(2, 'sjs', 'sjs', 'male', 'game', '', ''),
(3, 'test12', 'test12', 'male', '', '', ''),
(4, 'test13', 'test13', 'male', '', '', '');

--
-- 转储表的索引
--

--
-- 表的索引 `secret`
--
ALTER TABLE `secret`
  ADD PRIMARY KEY (`secret_id`,`secret_content`),
  ADD KEY `idx_fk_user_id` (`user_id`);

--
-- 表的索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`,`user_name`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `secret`
--
ALTER TABLE `secret`
  MODIFY `secret_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 限制导出的表
--

--
-- 限制表 `secret`
--
ALTER TABLE `secret`
  ADD CONSTRAINT `usernameFK` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
