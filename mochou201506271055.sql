-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 27, 2015 at 02:55 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mochou`
--

-- --------------------------------------------------------

--
-- Table structure for table `case`
--

CREATE TABLE IF NOT EXISTS `case` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增id',
  `userid` int(11) NOT NULL COMMENT '发布者id',
  `title` varchar(20) NOT NULL COMMENT '标题',
  `content` text NOT NULL COMMENT '内容',
  `htmlcontent` text NOT NULL COMMENT '富文本内容',
  `feedback` text NOT NULL COMMENT '反馈',
  `contact` varchar(100) NOT NULL COMMENT '联系方式',
  `publishtime` datetime NOT NULL COMMENT '发布时间',
  `clicks` int(11) NOT NULL COMMENT '点击数',
  `focus` int(11) NOT NULL COMMENT '关注数',
  `state` int(11) NOT NULL COMMENT '状态',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `case`
--

INSERT INTO `case` (`id`, `userid`, `title`, `content`, `htmlcontent`, `feedback`, `contact`, `publishtime`, `clicks`, `focus`, `state`) VALUES
(1, 1, '想拍一部电影', '最近打算拍一部电影，剧本已定,现在在找演员，摄像。故事是这样的：“赤盗”是南韩头号通缉犯，与头号副手成功在生产浓缩铀原料的工厂夺走一批铀原料球。情报显示，他们会把铀原料球变成超级武器，并在香港与恐怖组织交易。来自中国内地的宋鞍跟助手袁晓文，联同香港警察李彦明、范家明及香港大学物理系客座教授肇志仁，加上南韩武器专家崔民浩、朴宇哲等人，一同追缉赤盗，拯救亚洲史上最威慑武器危机事件。', '<p><span style="font-size: 14px; color: rgb(31, 73, 125);">最近打算拍一部电影，剧本已定,现在在找演员，摄像。故事是这样的：“赤盗”是南韩头号通缉犯，与头号副手成功在生产浓缩铀原料的工厂夺走一批铀原料球。情报显示，他们会把铀原料球变成超级武器，并在香港与恐怖组织交易。来自中国内地的宋鞍跟助手袁晓文，联同香港警察李彦明、范家明及香港大学物理系客座教授肇志仁，加上南韩武器专家崔民浩、朴宇哲等人，一同追缉赤盗，拯救亚洲史上最威慑武器危机事件。</span></p><p><span style="font-size: 14px; color: rgb(31, 73, 125);"><img src="/mochou/uploads/image/20150625/1435177654267356.jpg" title="1435177654267356.jpg" alt="111.jpg" width="130" height="140" style="width: 130px; height: 140px;"/></span></p><p><br/></p>', '暂时没有回报', '8888888,yanshu1234,18888888888,admin@mochou.com', '2015-06-25 04:29:57', 57, 0, 2000),
(2, 3, '一次高空拍摄计划', '高空摄影是一种全新的摄影门类，属于一种新兴的高端摄影行业，它大大扩展了摄影的视角，使平面的摄影立体化，能够带来更加多姿多彩的摄影题材。高空摄影广义上泛指一切利用飞行设备（包括旋翼飞行器、飞机、直升机、热气球、飞艇、动力伞、滑翔伞等）在高低空中进行手动或者摇控拍摄的图片和视频题材，它既可能是拍摄的一幅成品，也可能是前期工作的半成品。在此寻找几个胆大的爱好摄影的朋友一起办一次高空摄影活动', '<p><strong><span style="color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; text-indent: 28px; background-color: rgb(255, 255, 255);">高空摄影是一种全新的摄影门类，属于一种新兴的高端摄影行业，它大大扩展了摄影的视角，使平面的摄影立体化，能够带来更加多姿多彩的摄影题材。高空摄影广义上泛指一切利用飞行设备（包括旋翼飞行器、飞机、直升机、热气球、飞艇、动力伞、滑翔伞等）在高低空中进行手动或者摇控拍摄的图片和视频题材，它既可能是拍摄的一幅成品，也可能是前期工作的半成品。</span></strong></p><p><strong><span style="color: rgb(51, 51, 51); font-family: arial, 宋体, sans-serif; font-size: 14px; line-height: 24px; text-indent: 28px; background-color: rgb(255, 255, 255);"><img src="/mochou/uploads/image/20150626/1435248142355872.jpg" title="1435248142355872.jpg" alt="123.jpg"/></span></strong></p><p style="text-indent: 28px;"><font color="#ff0000" face="arial, 宋体, sans-serif"><span style="font-size: 14px; line-height: 24px; background-color: rgb(255, 255, 255);"><b><u>在此寻找几个胆大的爱好摄影的朋友一起办一次高空摄影活动</u></b></span></font></p>', '木有', '666666666,xiangfuming,13812345678,afu@mochou.com', '2015-06-26 00:03:51', 13, 0, 2002),
(3, 2, '小明聚会', '我叫小明我想找也叫小明的朋友们来一场聚会', '<p>我叫<span style="color: rgb(0, 112, 192);"><strong><span style="font-size: 24px;">小明</span></strong></span></p><p>我想找也叫<strong style="white-space: normal;"><span style="color: rgb(0, 112, 192); font-size: 24px;">小明</span></strong><span style="color: rgb(0, 0, 0); font-size: 16px;">的朋友们来一场聚会</span></p><p><span style="color: rgb(0, 0, 0); font-size: 16px;"><img src="/mochou/uploads/image/20150626/1435252733394816.jpg" title="1435252733394816.jpg" alt="123.jpg" width="278" height="227" style="width: 278px; height: 227px;"/></span></p>', '参加一场聚会，有免费的食品饮料哦', '987654321,xiaoming,13765432100,xiaoming@mchou.com', '2015-06-26 01:20:46', 3, 0, 2000);

-- --------------------------------------------------------

--
-- Table structure for table `caseadd`
--

CREATE TABLE IF NOT EXISTS `caseadd` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增变量',
  `caseid` int(11) NOT NULL,
  `content` varchar(200) NOT NULL COMMENT '内容',
  `time` datetime NOT NULL COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `casefocus`
--

CREATE TABLE IF NOT EXISTS `casefocus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caseid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `sign` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `casefocus`
--

INSERT INTO `casefocus` (`id`, `caseid`, `userid`, `sign`) VALUES
(1, 1, 4, 3001),
(2, 1, 3, 3001);

-- --------------------------------------------------------

--
-- Table structure for table `casejoin`
--

CREATE TABLE IF NOT EXISTS `casejoin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caseid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `content` text NOT NULL,
  `contact` text NOT NULL,
  `time` date NOT NULL COMMENT '加入时间',
  `sign` int(11) NOT NULL,
  `score` int(11) NOT NULL DEFAULT '0',
  `isEvaluted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `casejoin`
--

INSERT INTO `casejoin` (`id`, `caseid`, `userid`, `content`, `contact`, `time`, `sign`, `score`, `isEvaluted`) VALUES
(1, 1, 4, '我要当主演！', '18811441234', '2015-06-25', 4001, 0, 0),
(2, 1, 3, '我啥都不会，打酱油行不？', '15655556666', '2015-06-25', 4000, 0, 0),
(3, 2, 4, '我会吃吃吃', '13121977328', '2015-06-27', 4001, 0, 0),
(4, 2, 1, '是我', '13121977328', '2015-06-27', 4001, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `caselabel`
--

CREATE TABLE IF NOT EXISTS `caselabel` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '自增变量',
  `caseid` int(11) NOT NULL,
  `content` varchar(20) NOT NULL COMMENT '标签描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `caselabel`
--

INSERT INTO `caselabel` (`id`, `caseid`, `content`) VALUES
(1, 1, '电影'),
(2, 1, '拍摄'),
(3, 2, '拍摄'),
(4, 2, '刺激'),
(5, 2, '聚会'),
(6, 3, '聚会'),
(7, 3, '小明');

-- --------------------------------------------------------

--
-- Table structure for table `casereply`
--

CREATE TABLE IF NOT EXISTS `casereply` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caseid` int(11) NOT NULL,
  `userid` int(11) NOT NULL COMMENT '回复者id',
  `content` varchar(200) NOT NULL COMMENT '回复内容',
  `time` datetime NOT NULL COMMENT '回复时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `casereply`
--

INSERT INTO `casereply` (`id`, `caseid`, `userid`, `content`, `time`) VALUES
(1, 1, 4, '挺有趣的', '2015-06-25 06:31:06'),
(2, 1, 3, '哈哈哈', '2015-06-25 06:58:27');

-- --------------------------------------------------------

--
-- Table structure for table `casestaff`
--

CREATE TABLE IF NOT EXISTS `casestaff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `caseid` int(11) NOT NULL,
  `job` varchar(20) NOT NULL,
  `number` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `casestaff`
--

INSERT INTO `casestaff` (`id`, `caseid`, `job`, `number`) VALUES
(1, 1, '主演', 1),
(2, 1, '演员', 5),
(3, 1, '摄像', 3),
(4, 2, '摄影爱好者', 15),
(5, 3, '名字叫小明的朋友', 30);

-- --------------------------------------------------------

--
-- Table structure for table `diary`
--

CREATE TABLE IF NOT EXISTS `diary` (
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发布时间',
  `caseid` int(11) NOT NULL COMMENT '日志对应项目id',
  `title` varchar(100) NOT NULL COMMENT '日志标题',
  `body` text NOT NULL COMMENT '日志正文',
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `click` int(11) NOT NULL DEFAULT '0',
  `support` int(11) NOT NULL DEFAULT '0',
  `userid` varchar(20) NOT NULL COMMENT '写日志的人',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `diary`
--

INSERT INTO `diary` (`time`, `caseid`, `title`, `body`, `id`, `click`, `support`, `userid`) VALUES
('2015-06-25 16:48:58', 2, '日志1', '<p><span style="color: rgb(255, 0, 0); text-decoration: underline;">日志内容</span></p>', 1, 0, 0, '3');

-- --------------------------------------------------------

--
-- Table structure for table `diarylabel`
--

CREATE TABLE IF NOT EXISTS `diarylabel` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `diaryId` int(11) NOT NULL COMMENT '日志id',
  `value` varchar(20) NOT NULL COMMENT '标签内容',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `diarylabel`
--

INSERT INTO `diarylabel` (`id`, `diaryId`, `value`) VALUES
(1, 1, '日志');

-- --------------------------------------------------------

--
-- Table structure for table `diarysupport`
--

CREATE TABLE IF NOT EXISTS `diarysupport` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主键',
  `diaryId` int(11) NOT NULL COMMENT '日志id',
  `supportId` int(11) NOT NULL COMMENT '用户id',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `label`
--

CREATE TABLE IF NOT EXISTS `label` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `content` varchar(20) NOT NULL,
  `value` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `label`
--

INSERT INTO `label` (`id`, `userid`, `content`, `value`) VALUES
(1, 1, '啊哈哈', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(40) NOT NULL COMMENT '邮箱等同于用户名',
  `password` varchar(50) NOT NULL COMMENT '密码',
  `nickname` varchar(30) NOT NULL COMMENT '昵称可以为空',
  `head` varchar(30) NOT NULL DEFAULT '/mochou/uploads/default.jpg' COMMENT '头像',
  `sign` int(11) NOT NULL COMMENT '标识',
  `ActiCode` varchar(100) NOT NULL COMMENT '注册验证码',
  `score` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `nickname`, `head`, `sign`, `ActiCode`, `score`) VALUES
(1, 'admin@mochou.com', '698d51a19d8a121ce581499d7b701668', '鼹鼠姐姐', '/mochou/uploads/1.jpg', 1001, '8fedd3eb3d0b8e2abf9e28a91ca30fee', 66),
(2, 'xiaoming@mochou.com', '698d51a19d8a121ce581499d7b701668', '小明', '/mochou/uploads/2.jpg', 1001, '876e07e877847f4b05f3e1766a6bbce7', 0),
(3, 'afu@mochou.com', '698d51a19d8a121ce581499d7b701668', '阿福', '/mochou/uploads/3.jpg', 1001, '5f659a1e5c589c3ccc6064043a1592a0', 0),
(4, 'song@mochou.com', '698d51a19d8a121ce581499d7b701668', '送送送', '/mochou/uploads/4.jpg', 1001, '978e07e877847f4b05f3e1766a6bbce', 89);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
