-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-06-11 01:47:30
-- 服务器版本： 5.6.26
-- PHP Version: 7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sjhy`
--

-- --------------------------------------------------------

--
-- 表的结构 `tb_comment`
--

CREATE TABLE `tb_comment` (
  `id` bigint(20) NOT NULL COMMENT '评论表唯一标识',
  `clickcomment_user_id` bigint(20) NOT NULL COMMENT '参与评论的用户的id',
  `commented_user_id` bigint(20) NOT NULL COMMENT '被评论的用户的id',
  `content_id` bigint(20) NOT NULL COMMENT '属于哪条说说的评论',
  `comment` varchar(256) NOT NULL COMMENT '评论',
  `comment_datetime` datetime NOT NULL COMMENT '发表评论时的时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论表';

--
-- 转存表中的数据 `tb_comment`
--

INSERT INTO `tb_comment` (`id`, `clickcomment_user_id`, `commented_user_id`, `content_id`, `comment`, `comment_datetime`) VALUES
(8, 53, 52, 26, '师傅，独孤九剑学完了，可以下山了吧。', '2016-04-24 06:00:00'),
(9, 53, 53, 25, '找任盈盈去。。。', '2016-04-24 06:04:00'),
(10, 52, 51, 27, '买把伞吧。', '2016-04-24 06:09:00'),
(11, 52, 51, 27, '前面不远处有卖伞的！', '2016-04-24 06:11:00'),
(12, 51, 52, 26, '武功高强，剑法了得啊！', '2016-04-24 06:10:20'),
(13, 51, 53, 25, '过得挺逍遥啊。', '2016-04-24 06:13:12'),
(14, 51, 52, 26, '还收徒弟不？', '2016-04-24 06:13:25'),
(15, 51, 51, 27, '今天天气晴朗。', '2016-04-24 08:13:35'),
(16, 51, 52, 24, '是的', '2016-04-24 09:42:22'),
(17, 51, 52, 24, '多少岁了', '2016-04-24 09:43:08'),
(18, 51, 53, 19, '这句话倒是真理', '2016-04-24 15:08:32'),
(19, 54, 52, 26, '你给洗发水代过言。', '2016-04-24 15:11:34');

-- --------------------------------------------------------

--
-- 表的结构 `tb_content`
--

CREATE TABLE `tb_content` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `msg` text NOT NULL COMMENT '消息内容',
  `sent_time` datetime NOT NULL COMMENT '发表消息时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='说说内容表';

--
-- 转存表中的数据 `tb_content`
--

INSERT INTO `tb_content` (`id`, `user_id`, `msg`, `sent_time`) VALUES
(1, 51, '你好！', '0000-00-00 00:00:00'),
(2, 51, '晚安！', '2016-04-20 02:28:30'),
(3, 51, '今天天气好晴朗，处处好风光！', '2016-04-20 23:25:14'),
(4, 51, '床前明月光，意思地上霜！', '2016-04-20 23:28:04'),
(5, 51, '你好吗', '2016-04-20 23:28:51'),
(6, 51, '早餐吃什么？', '2016-04-20 23:30:33'),
(7, 51, '天气好热！', '2016-04-20 23:33:08'),
(8, 51, 'Today is a good day!', '2016-04-21 00:05:57'),
(9, 51, '春风右路江南岸，明月何时找我还！', '2016-04-21 00:06:54'),
(10, 52, 'sdfsd', '2016-04-21 00:15:23'),
(11, 52, 'hello', '2016-04-21 00:24:37'),
(12, 52, 'abc', '2016-04-21 00:24:43'),
(13, 52, '剑法高明！', '2016-04-21 00:27:01'),
(14, 51, '我是李四。', '2016-04-21 01:06:21'),
(15, 52, '我是风清扬！', '2016-04-21 01:09:49'),
(16, 53, '我是令狐冲，初来乍到，请多多关照！', '2016-04-21 20:09:28'),
(17, 53, '给点个赞吧。。。', '2016-04-21 20:12:56'),
(18, 53, '想学独孤九剑吗？', '2016-04-21 20:14:31'),
(19, 53, '要勤练武功才能成为武林高手:)', '2016-04-21 20:15:49'),
(20, 51, '李四，做社会四有新人。', '2016-04-21 21:49:02'),
(21, 51, '李四，加油！', '2016-04-21 22:03:03'),
(22, 52, '我老了，把独孤九剑传给了令狐冲了。', '2016-04-21 22:15:00'),
(23, 52, '令狐冲是我的好徒儿', '2016-04-21 22:24:00'),
(24, 52, '武林的事我少插手。', '2016-04-21 22:26:00'),
(25, 53, '令狐少侠', '2016-04-21 23:16:00'),
(26, 52, '清扬前辈', '2016-04-21 23:17:00'),
(27, 51, '下雨了。。。', '2016-04-22 00:51:01'),
(28, 55, '今天天气好', '2016-05-14 15:00:50');

-- --------------------------------------------------------

--
-- 表的结构 `tb_user`
--

CREATE TABLE `tb_user` (
  `id` bigint(20) NOT NULL,
  `username` varchar(64) CHARACTER SET utf8 NOT NULL COMMENT '账号，用于用户登录，可能为密码或手机号等，不能有中文字符',
  `password` varchar(64) CHARACTER SET utf8 NOT NULL,
  `nickname` varchar(64) CHARACTER SET utf8 NOT NULL COMMENT '用户昵称',
  `email` varchar(64) CHARACTER SET utf8 NOT NULL,
  `save_pwd_answer` varchar(64) CHARACTER SET utf8 NOT NULL COMMENT '密保问题答案'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='用户表，用户存储用户账号等个人信息';

--
-- 转存表中的数据 `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `nickname`, `email`, `save_pwd_answer`) VALUES
(51, 'lisi', 'ed2b1f468c5f915f3f1cf75d7068baae', '李四', '12345@qq.com', '张三'),
(52, 'fqy', 'f5bb0c8de146c67b44babbf4e6584cc0', '风清扬', 'fqy@gmail.com', '小风'),
(53, 'lfc@qq.com', 'b0d5690cb90f949ccec65136e4e44dec', '令狐冲', 'lfc@qq.com', '小狐'),
(54, 'zhangsan', '01d7f40760960e7bd9443513f22ab9af', '张三', 'zhangsan@gmail.com', '李四'),
(55, '3333@qq.com', '1bbd886460827015e5d605ed44252251', '令狐冲', '3333@qq.com', '小林');

-- --------------------------------------------------------

--
-- 表的结构 `tb_zan`
--

CREATE TABLE `tb_zan` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL COMMENT '点赞用户的id',
  `content_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户点赞记录表';

--
-- 转存表中的数据 `tb_zan`
--

INSERT INTO `tb_zan` (`id`, `user_id`, `content_id`) VALUES
(55, 51, 23),
(57, 51, 22),
(58, 51, 21),
(70, 52, 25),
(71, 52, 24),
(73, 51, 26),
(75, 51, 25),
(77, 53, 26),
(78, 53, 25),
(79, 53, 23),
(82, 53, 21),
(84, 53, 27),
(85, 53, 24),
(88, 52, 27),
(89, 52, 26),
(90, 54, 26),
(93, 51, 27),
(94, 55, 28);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_comment`
--
ALTER TABLE `tb_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`clickcomment_user_id`),
  ADD KEY `content_id` (`content_id`),
  ADD KEY `commented_user_id` (`commented_user_id`);

--
-- Indexes for table `tb_content`
--
ALTER TABLE `tb_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tb_user_username_unique` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tb_zan`
--
ALTER TABLE `tb_zan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `content_id` (`content_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tb_comment`
--
ALTER TABLE `tb_comment`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT '评论表唯一标识', AUTO_INCREMENT=20;
--
-- 使用表AUTO_INCREMENT `tb_content`
--
ALTER TABLE `tb_content`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- 使用表AUTO_INCREMENT `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- 使用表AUTO_INCREMENT `tb_zan`
--
ALTER TABLE `tb_zan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- 限制导出的表
--

--
-- 限制表 `tb_comment`
--
ALTER TABLE `tb_comment`
  ADD CONSTRAINT `tb_comment_ibfk_1` FOREIGN KEY (`clickcomment_user_id`) REFERENCES `tb_user` (`id`),
  ADD CONSTRAINT `tb_comment_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `tb_content` (`id`),
  ADD CONSTRAINT `tb_comment_ibfk_3` FOREIGN KEY (`commented_user_id`) REFERENCES `tb_user` (`id`);

--
-- 限制表 `tb_content`
--
ALTER TABLE `tb_content`
  ADD CONSTRAINT `tb_content_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id`);

--
-- 限制表 `tb_zan`
--
ALTER TABLE `tb_zan`
  ADD CONSTRAINT `tb_zan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tb_user` (`id`),
  ADD CONSTRAINT `tb_zan_ibfk_2` FOREIGN KEY (`content_id`) REFERENCES `tb_content` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
