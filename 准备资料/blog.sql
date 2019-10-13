/*
Navicat MySQL Data Transfer

Source Server         : 腾讯云docker
Source Server Version : 50642
Source Host           : 127.0.0.1:3306
Source Database       : blog

Target Server Type    : MYSQL
Target Server Version : 50642
File Encoding         : 65001

Date: 2019-10-13 11:12:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for bg_about_author
-- ----------------------------
DROP TABLE IF EXISTS `bg_about_author`;
CREATE TABLE `bg_about_author` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `img` text NOT NULL COMMENT '头像',
  `name` varchar(50) NOT NULL COMMENT '姓名',
  `introduce` text NOT NULL COMMENT '简介',
  `address` varchar(100) DEFAULT NULL COMMENT '地址',
  `phone` char(11) DEFAULT NULL COMMENT '电话',
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱',
  `gitee` varchar(100) DEFAULT NULL COMMENT '码云',
  `content` text NOT NULL COMMENT '内容',
  `author_name` char(30) NOT NULL COMMENT '关于作者模板名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='关于作者';

-- ----------------------------
-- Records of bg_about_author
-- ----------------------------
INSERT INTO `bg_about_author` VALUES ('1', '/static/upload/logo/1545822255.png', '凡心', '一枚90后程序猿,主攻后端,略懂Web前端,真的是略懂.', '上海', '1092702994', '1092702994@qq.com', 'https://gitlab.com/xqi31352/blog.com.git', '<p>&nbsp; &nbsp;&nbsp;</p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;凡心,凡心博客作者,江西上饶鄱阳人,目前是一名码农.</p><p><br/></p><p><strong><span style=\"font-size: 20px;\">个人信息</span></strong></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;暂无</p><p><br/></p><p><span style=\"font-size: 20px;\"><strong>个人介绍</strong></span></p><p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;暂无</p><p><br/></p><p><span style=\"font-size: 20px;\"><strong>未来</strong></span></p><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;还没想好<br/></p><p><br/></p>', '凡心博客');

-- ----------------------------
-- Table structure for bg_about_blog
-- ----------------------------
DROP TABLE IF EXISTS `bg_about_blog`;
CREATE TABLE `bg_about_blog` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT 'logo下面的标题',
  `blog_name` varchar(255) NOT NULL COMMENT '简介标题',
  `content` text NOT NULL COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='关于博客';

-- ----------------------------
-- Records of bg_about_blog
-- ----------------------------
INSERT INTO `bg_about_blog` VALUES ('1', '一个PHP程序员的个人博客,记录博主学习和成长之路,分享点点滴滴', '凡心博客', '<p>&nbsp; &nbsp; &nbsp;&nbsp;</p><p style=\"padding: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); font-size: 14px; text-indent: 2em; color: rgb(102, 102, 102); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">凡心博客是一个由PHP开发的个人博客网站，诞生于2018年12月24日，暂且称为凡心博客1.0。</p><h1 style=\"margin: 25px 0px 0px; padding: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); font-size: 16px; color: rgb(102, 102, 102); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">第一个版本(当前版本)</h1><p style=\"padding: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); font-size: 14px; text-indent: 2em; color: rgb(102, 102, 102); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\">诞生的版本，采用laravel5.4作为后台框架，layui作为UI框架，用了纯DIV布局！</p><h1 style=\"margin: 25px 0px 0px; padding: 0px; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); font-size: 16px; color: rgb(102, 102, 102); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, 微软雅黑, Tahoma, Arial, sans-serif; white-space: normal; background-color: rgb(255, 255, 255);\"><br/></h1>');

-- ----------------------------
-- Table structure for bg_album
-- ----------------------------
DROP TABLE IF EXISTS `bg_album`;
CREATE TABLE `bg_album` (
  `albumid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `album_name` varchar(50) NOT NULL COMMENT '相册名称',
  `auth` tinyint(1) unsigned NOT NULL COMMENT '0:仅管理员可见 1:仅登录kejian 2;所有人可见',
  `cover` text NOT NULL COMMENT '封面图',
  `user_id` int(11) unsigned NOT NULL COMMENT '关联账户',
  PRIMARY KEY (`albumid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='相册';

-- ----------------------------
-- Records of bg_album
-- ----------------------------

-- ----------------------------
-- Table structure for bg_article
-- ----------------------------
DROP TABLE IF EXISTS `bg_article`;
CREATE TABLE `bg_article` (
  `article_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '' COMMENT '文章标题',
  `content` text NOT NULL COMMENT '文章内容',
  `original` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0:转载 1:原创',
  `author` varchar(50) DEFAULT '0' COMMENT '作者',
  `label_id` int(11) unsigned DEFAULT '0' COMMENT '关联文章标签',
  `category_id` int(11) DEFAULT '0' COMMENT '关联分类',
  `create_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '热门文章(0:不推荐 1:推荐)',
  `lock` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0:不启用 1:启用',
  `del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '假删除(0:不删除 1:删除)',
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '关联账户',
  `img` varchar(100) NOT NULL COMMENT '封面图片',
  `content_title` varchar(150) DEFAULT '0' COMMENT '文章外面的概述(文章内容的前部分)',
  `date` char(20) NOT NULL DEFAULT '0' COMMENT '文章归档',
  `read` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '阅读数',
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='文章列表';

-- ----------------------------
-- Records of bg_article
-- ----------------------------
INSERT INTO `bg_article` VALUES ('2', '11', '<p>111111</p>', '1', '凡心', '1', '1', '1546739976', '1', '1', '1', '4', '/static/upload/logo/1544771106.png', '111111', '2019-01', '4');
INSERT INTO `bg_article` VALUES ('13', '我是一只小小鸟', '<p>完工后厚爱大红爱德华哦啊好的哦啊好好的后都会吗单片机毛面积怕<img src=\"/extend/ueditor/php/upload/image/20181225/1545729250.png\" title=\"1545729250.png\" alt=\"pic (6).png\"/>按时啊啊打阿达啊啊大大阿达啊啊adad啊打啊啊大大啊啊adad啊癖好骄傲你的今后爱哈佛年会佛爱好哦的好好冬奥会发生哦啊好地方哦啊活动好好喝哦啊好欧尼</p>', '1', '凡心', '1', '1', '1546739987', '1', '1', '0', '6', '/static/upload/logo/1545729184.png', '完工后厚爱大红爱德华哦啊好的哦啊好好的后都会吗单片机毛面积怕按时啊啊打阿达啊啊大大阿达啊啊adad啊打啊啊大大啊啊adad啊癖好骄傲你的今后爱哈佛年会佛爱好哦的好好冬奥会发生哦啊好地方哦啊活动好好喝哦啊好欧尼', '2019-01', '66');

-- ----------------------------
-- Table structure for bg_category
-- ----------------------------
DROP TABLE IF EXISTS `bg_category`;
CREATE TABLE `bg_category` (
  `category_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(50) NOT NULL COMMENT '分类名称',
  `life` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '生活(1:生活 0:编辑)',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间/修改时间',
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COMMENT='文章分类表';

-- ----------------------------
-- Records of bg_category
-- ----------------------------
INSERT INTO `bg_category` VALUES ('1', '随笔', '1', '2019-01-06 09:51:46');
INSERT INTO `bg_category` VALUES ('4', '心情', '1', '2019-01-06 09:51:53');
INSERT INTO `bg_category` VALUES ('2', 'Linux', '0', '2019-01-06 09:52:31');
INSERT INTO `bg_category` VALUES ('19', '数据库', '0', '2019-01-06 10:08:33');

-- ----------------------------
-- Table structure for bg_comment
-- ----------------------------
DROP TABLE IF EXISTS `bg_comment`;
CREATE TABLE `bg_comment` (
  `commentid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL COMMENT '评论内容',
  `user_id` int(11) unsigned NOT NULL COMMENT '评论用户 id',
  `nickname` char(30) NOT NULL COMMENT '评论用户昵称',
  `ip` char(16) NOT NULL COMMENT 'ip地址',
  `os` varchar(50) NOT NULL COMMENT '客户端',
  `create_time` datetime NOT NULL COMMENT '评论时间',
  `pid` int(10) unsigned NOT NULL COMMENT '父级id',
  `headurl` varchar(255) NOT NULL COMMENT '评论人头像',
  `status` tinyint(1) NOT NULL COMMENT '状态',
  `reply_nickname` varchar(255) NOT NULL COMMENT '回复人昵称',
  `reply_id` int(10) unsigned NOT NULL COMMENT '回复id',
  `article_id` int(10) unsigned NOT NULL COMMENT '文章id',
  `zan` int(10) unsigned NOT NULL COMMENT '点赞数',
  PRIMARY KEY (`commentid`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COMMENT='文章评论表';

-- ----------------------------
-- Records of bg_comment
-- ----------------------------
INSERT INTO `bg_comment` VALUES ('1', '我按第一条评论', '6', '凡心', '127.0.0.1', 'win7', '2018-12-29 17:12:27', '0', '/static/common/images/face/6.jpg', '1', '0', '0', '3', '1');
INSERT INTO `bg_comment` VALUES ('2', 'hah', '4', '凡心', '127.0.0.1', 'Win 10', '2018-12-29 18:25:29', '0', '/static/common/images/face/6.jpg', '1', '0', '0', '3', '0');
INSERT INTO `bg_comment` VALUES ('3', 'haha', '4', '凡心', '127.0.0.1', 'Win 10', '2018-12-29 18:26:11', '0', '/static/common/images/face/6.jpg', '1', '0', '0', '3', '0');
INSERT INTO `bg_comment` VALUES ('4', 'as', '4', '凡心', '127.0.0.1', 'Win 10', '2018-12-29 18:26:38', '0', '/static/common/images/face/6.jpg', '1', '0', '0', '3', '0');
INSERT INTO `bg_comment` VALUES ('5', 'as', '4', '凡心', '127.0.0.1', 'Win 10', '2018-12-29 18:27:56', '0', '/static/common/images/face/6.jpg', '1', '0', '0', '3', '0');
INSERT INTO `bg_comment` VALUES ('6', 'as', '4', '凡心', '127.0.0.1', 'Android', '2018-12-29 18:38:09', '0', '/static/common/images/face/6.jpg', '1', '0', '0', '3', '0');
INSERT INTO `bg_comment` VALUES ('7', 'as as', '4', '凡心', '127.0.0.1', 'Android', '2018-12-29 18:38:16', '0', '/static/common/images/face/6.jpg', '1', '0', '0', '3', '0');
INSERT INTO `bg_comment` VALUES ('8', '@<a href=\"javascript:;\" class=\"fly-aite\">凡心</a> as as a a s', '4', '凡心', '127.0.0.1', 'Android', '2018-12-29 18:40:36', '1', '/static/common/images/face/6.jpg', '1', '凡心 ', '1', '3', '0');
INSERT INTO `bg_comment` VALUES ('9', '@<a href=\"javascript:;\" class=\"fly-aite\">凡心</a> oad oa', '4', '凡心', '127.0.0.1', 'Win 10', '2018-12-29 18:41:42', '1', '/static/common/images/face/6.jpg', '1', '凡心', '8', '3', '0');
INSERT INTO `bg_comment` VALUES ('10', '@<a href=\"javascript:;\" class=\"fly-aite\">凡心</a> as as  as', '5', '哈根和', '127.0.0.1', 'Win 10', '2018-12-29 18:42:29', '1', '/static/common/images/face/1.jpg', '1', '凡心', '9', '3', '0');
INSERT INTO `bg_comment` VALUES ('11', '@<a href=\"javascript:;\" class=\"fly-aite\">凡心</a> da', '5', '哈根和', '127.0.0.1', 'Win 10', '2018-12-29 19:01:41', '2', '/static/common/images/face/1.jpg', '1', '凡心 ', '2', '3', '0');
INSERT INTO `bg_comment` VALUES ('12', 'as', '6', '哈根达斯', '116.235.53.214', 'Win 10', '2019-01-06 16:23:04', '0', '/static/common/images/face/2.jpg', '1', '0', '0', '13', '0');
INSERT INTO `bg_comment` VALUES ('13', '@<a href=\"javascript:;\" class=\"fly-aite\">哈根达斯</a> sa', '6', '哈根达斯', '116.235.53.214', 'Win 10', '2019-01-06 16:23:23', '12', '/static/common/images/face/2.jpg', '1', '哈根达斯 ', '12', '13', '0');
INSERT INTO `bg_comment` VALUES ('14', '@<a href=\"javascript:;\" class=\"fly-aite\">哈根达斯</a> as', '6', '哈根达斯', '116.235.53.214', 'Win 10', '2019-01-06 16:23:29', '12', '/static/common/images/face/2.jpg', '1', '哈根达斯', '13', '13', '0');
INSERT INTO `bg_comment` VALUES ('15', '看一看世界的繁华', '6', '哈根达斯', '116.235.53.214', 'Win 10', '2019-01-06 16:32:50', '0', '/static/common/images/face/2.jpg', '1', '0', '0', '13', '0');

-- ----------------------------
-- Table structure for bg_history
-- ----------------------------
DROP TABLE IF EXISTS `bg_history`;
CREATE TABLE `bg_history` (
  `historyid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL COMMENT '内容',
  `create_time` int(11) unsigned NOT NULL COMMENT '创建时间',
  `user_id` int(11) unsigned NOT NULL COMMENT '关联账户',
  PRIMARY KEY (`historyid`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='古今';

-- ----------------------------
-- Records of bg_history
-- ----------------------------
INSERT INTO `bg_history` VALUES ('1', '[{\"content\":\"\\u7b2c\\u4e00\\u5929\\u4e0a\\u7ebf\\u4e86\",\"time\":\"2018-12-24\"},{\"content\":\"\\u4fee\\u6539\\u540e\\u53f0\\u5b58\\u5728\\u7684\\u4e00\\u4e9b\\u5c0fbug\",\"time\":\"2018-12-31\"}]', '1546738293', '6');

-- ----------------------------
-- Table structure for bg_homepage
-- ----------------------------
DROP TABLE IF EXISTS `bg_homepage`;
CREATE TABLE `bg_homepage` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `logo` text NOT NULL COMMENT '右上角logo图',
  `banner` text NOT NULL COMMENT '首页轮播图',
  `notice` varchar(255) NOT NULL COMMENT '首页广播',
  `net` varchar(100) NOT NULL COMMENT '网名',
  `occupation` varchar(50) NOT NULL COMMENT '职业',
  `email` varchar(60) DEFAULT '0' COMMENT '邮箱',
  `hobby` varchar(100) DEFAULT '0' COMMENT '爱好',
  `motto` varchar(100) DEFAULT '0' COMMENT '座右铭',
  `friendship_link` text COMMENT '友情链接',
  `link_address` text COMMENT '链接地址',
  `btm_motto` varchar(255) DEFAULT '0' COMMENT '底部座右铭',
  `home_name` char(30) NOT NULL COMMENT '首页模板名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='博客首页';

-- ----------------------------
-- Records of bg_homepage
-- ----------------------------
INSERT INTO `bg_homepage` VALUES ('1', '/static/upload/logo/1544079841.png', '[\"\\/static\\/upload\\/banner\\/1545807581.png\",\"\\/static\\/upload\\/banner\\/1545807647.png\",\"\\/static\\/upload\\/banner\\/1545807659.png\"]', '按时,哈哈哈哈', '凡心', '自由职业', '1092702994@qq.com', '爬山、摄影、看书', '虽然过去不能改变，未来可以。', '李宏博客,倍数科技', 'http://liong.vip/,http://www.beishusoft.cn/', '三更灯火五更鸡，正是男儿读书时，黑发不知勤学早，白发方悔读书迟。', '七星瓢虫的模板');

-- ----------------------------
-- Table structure for bg_label
-- ----------------------------
DROP TABLE IF EXISTS `bg_label`;
CREATE TABLE `bg_label` (
  `label_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `label_name` varchar(50) NOT NULL COMMENT '标签颜色',
  `color` varchar(50) NOT NULL COMMENT '标签颜色',
  `create_time` datetime DEFAULT '0000-00-00 00:00:00' COMMENT '操作时间',
  PRIMARY KEY (`label_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='文章标签';

-- ----------------------------
-- Records of bg_label
-- ----------------------------
INSERT INTO `bg_label` VALUES ('1', '兴趣爱好', 'background: rgb(250, 212, 0);', '2019-01-10 19:06:32');
INSERT INTO `bg_label` VALUES ('7', '职业技巧', 'background: rgb(57, 61, 73);', '2019-01-10 19:06:41');

-- ----------------------------
-- Table structure for bg_login
-- ----------------------------
DROP TABLE IF EXISTS `bg_login`;
CREATE TABLE `bg_login` (
  `loginid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loginname` varchar(50) NOT NULL COMMENT '昵称(唯一值)',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `is_admin` tinyint(1) unsigned NOT NULL COMMENT '0:普通用户 1:后台管理员',
  `lock` tinyint(1) unsigned NOT NULL COMMENT '0:可用 1;不可用',
  `user_id` int(11) unsigned NOT NULL COMMENT '关联账户',
  PRIMARY KEY (`loginid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Records of bg_login
-- ----------------------------

-- ----------------------------
-- Table structure for bg_message
-- ----------------------------
DROP TABLE IF EXISTS `bg_message`;
CREATE TABLE `bg_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL COMMENT '留言内容',
  `user_id` int(10) unsigned NOT NULL COMMENT '用户id',
  `nickname` char(30) NOT NULL COMMENT '昵称',
  `ip` char(16) NOT NULL COMMENT '留言ip',
  `os` varchar(50) NOT NULL COMMENT '留言客户端',
  `create_time` datetime NOT NULL COMMENT '留言时间',
  `pid` int(10) unsigned NOT NULL COMMENT '父类id',
  `headurl` varchar(255) NOT NULL COMMENT '头像',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态 1开启 0关闭',
  `reply_nickname` varchar(255) NOT NULL COMMENT '回复人昵称',
  `reply_id` int(10) unsigned NOT NULL COMMENT '回复人 id',
  `admin_id` int(10) unsigned NOT NULL COMMENT '账号id',
  `zan` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '攒数量',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='留言';

-- ----------------------------
-- Records of bg_message
-- ----------------------------
INSERT INTO `bg_message` VALUES ('1', '第一条留言', '4', '凡心', '127.0.0.1', 'win10', '2018-12-29 12:53:24', '0', '/static/common/images/face/6.jpg', '1', '0', '0', '6', '1');
INSERT INTO `bg_message` VALUES ('2', '回复你', '5', '哈根和', '127.0.0.1', 'win7', '2018-12-12 12:53:49', '1', '/static/common/images/face/7.jpg', '1', '凡心', '4', '6', '1');
INSERT INTO `bg_message` VALUES ('3', '回复你', '5', '哈根和', '127.0.0.1', 'win7', '2018-12-20 12:53:28', '1', '/static/common/images/face/7.jpg', '1', '凡心', '4', '6', '1');
INSERT INTO `bg_message` VALUES ('4', '按时按时按时', '4', '凡心', '127.0.0.1', 'win7', '2018-12-20 12:53:45', '1', '/static/common/images/face/6.jpg', '1', '哈根和', '6', '6', '1');
INSERT INTO `bg_message` VALUES ('5', '第二条留言', '4', '凡心', '127.0.0.1', 'win10', '2018-12-07 12:53:53', '0', '/static/common/images/face/6.jpg', '1', '0', '0', '6', '0');
INSERT INTO `bg_message` VALUES ('6', '回复你', '5', '哈根和', '127.0.0.1', 'win7', '2018-12-14 12:53:32', '5', '/static/common/images/face/7.jpg', '1', '凡心', '4', '6', '0');
INSERT INTO `bg_message` VALUES ('7', '回复你', '5', '哈根和', '127.0.0.1', 'win7', '2018-12-07 12:53:57', '5', '/static/common/images/face/7.jpg', '1', '凡心', '4', '6', '0');
INSERT INTO `bg_message` VALUES ('8', '按时按时按时', '4', '凡心', '127.0.0.1', 'win7', '2018-12-07 12:54:01', '7', '/static/common/images/face/6.jpg', '1', '哈根和', '6', '6', '0');
INSERT INTO `bg_message` VALUES ('9', '11', '4', '凡心', '127.0.0.1', 'win10', '2018-12-13 12:54:04', '5', '/static/common/images/face/6.jpg', '1', '哈根达斯', '6', '6', '0');
INSERT INTO `bg_message` VALUES ('10', '第三条留言', '4', '凡心', '127.0.0.1', 'win10', '2018-12-29 12:53:24', '0', '/static/common/images/face/6.jpg', '1', '0', '0', '6', '0');
INSERT INTO `bg_message` VALUES ('11', 'as', '4', '凡心', '127.0.0.1', 'Android', '2018-12-29 15:36:27', '0', '/static/common/images/face/6.jpg', '1', '0', '0', '6', '0');
INSERT INTO `bg_message` VALUES ('12', 'as', '4', '凡心', '127.0.0.1', 'Win 10', '2018-12-29 15:36:50', '0', '/static/common/images/face/6.jpg', '1', '0', '0', '6', '0');
INSERT INTO `bg_message` VALUES ('13', 'as', '4', '凡心', '127.0.0.1', 'Win 10', '2018-12-29 15:37:36', '0', '/static/common/images/face/6.jpg', '1', '0', '0', '6', '0');
INSERT INTO `bg_message` VALUES ('14', 'as as', '4', '凡心', '127.0.0.1', 'Win 10', '2018-12-29 15:37:52', '0', '/static/common/images/face/6.jpg', '1', '0', '0', '6', '0');
INSERT INTO `bg_message` VALUES ('15', 'as', '4', '凡心', '127.0.0.1', 'Win 10', '2018-12-29 15:39:21', '0', '/static/common/images/face/6.jpg', '1', '0', '0', '6', '0');
INSERT INTO `bg_message` VALUES ('16', 'as', '4', '凡心', '127.0.0.1', 'Android', '2018-12-29 15:46:17', '0', '/static/common/images/face/6.jpg', '1', '0', '0', '6', '0');
INSERT INTO `bg_message` VALUES ('17', '@<a href=\"javascript:;\" class=\"fly-aite\">凡心</a> as', '4', '凡心', '127.0.0.1', 'Android', '2018-12-29 15:48:39', '1', '/static/common/images/face/6.jpg', '1', '凡心 ', '1', '6', '1');
INSERT INTO `bg_message` VALUES ('18', '@<a href=\"javascript:;\" class=\"fly-aite\">哈根和</a> as', '4', '凡心', '127.0.0.1', 'Win 10', '2018-12-29 15:49:08', '1', '/static/common/images/face/6.jpg', '1', '哈根和', '3', '6', '0');
INSERT INTO `bg_message` VALUES ('19', '@<a href=\"javascript:;\" class=\"fly-aite\">哈根和</a> nishi as', '4', '凡心', '127.0.0.1', 'Win 10', '2018-12-29 15:53:22', '1', '/static/common/images/face/6.jpg', '1', '哈根和', '2', '6', '0');
INSERT INTO `bg_message` VALUES ('20', '@<a href=\"javascript:;\" class=\"fly-aite\">凡心</a> <img alt=\"[衰]\" title=\"[衰]\" src=\"http://img.t.sinajs.cn/t4/appstyle/expression/ext/normal/af/cry.gif\">', '4', '凡心', '127.0.0.1', 'Win 10', '2018-12-29 16:42:39', '1', '/static/common/images/face/6.jpg', '1', '凡心 ', '1', '6', '0');
INSERT INTO `bg_message` VALUES ('21', '@<a href=\"javascript:;\" class=\"fly-aite\">凡心</a> 111', '4', '凡心', '127.0.0.1', 'Win 10', '2018-12-29 17:58:39', '1', '/static/common/images/face/6.jpg', '1', '凡心 ', '1', '6', '0');

-- ----------------------------
-- Table structure for bg_photo
-- ----------------------------
DROP TABLE IF EXISTS `bg_photo`;
CREATE TABLE `bg_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `img` text NOT NULL COMMENT '照片地址',
  `user_id` int(11) unsigned NOT NULL COMMENT '关联账户',
  `album_id` int(11) unsigned NOT NULL COMMENT '关联相册',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='照片';

-- ----------------------------
-- Records of bg_photo
-- ----------------------------

-- ----------------------------
-- Table structure for bg_user
-- ----------------------------
DROP TABLE IF EXISTS `bg_user`;
CREATE TABLE `bg_user` (
  `userid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT '账号名称',
  `programmer` tinyint(1) unsigned NOT NULL COMMENT '是否是程序猿 1是 0不是',
  `open` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否开启 1开启 0关闭',
  `del` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除 1删除 0不删除',
  `home_id` int(10) unsigned DEFAULT '0' COMMENT '关联博客首页id',
  `blog_id` int(10) unsigned DEFAULT '0' COMMENT '关于博客id',
  `author_id` int(10) unsigned DEFAULT '0' COMMENT '关于作者id',
  `create_time` datetime NOT NULL COMMENT '创建时间',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '性别 1男 0女',
  `password` char(32) NOT NULL COMMENT '密码',
  `Remarks` text COMMENT '备注',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bg_user
-- ----------------------------
INSERT INTO `bg_user` VALUES ('6', '凡心博客', '0', '1', '0', '1', '1', '1', '2018-11-27 14:24:18', '1', '1', '1');

-- ----------------------------
-- Table structure for bg_users
-- ----------------------------
DROP TABLE IF EXISTS `bg_users`;
CREATE TABLE `bg_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'id',
  `username` char(11) NOT NULL COMMENT '账号:手机号或者qq号',
  `nickname` char(30) NOT NULL COMMENT '昵称',
  `headurl` varchar(255) NOT NULL COMMENT '头像',
  `status` tinyint(1) unsigned NOT NULL COMMENT '状态 1可用 0冻结',
  `is_qq` tinyint(1) unsigned NOT NULL COMMENT '1qq 2不是qq',
  `create_time` int(10) unsigned NOT NULL COMMENT '创建账号时间',
  `ip` char(16) NOT NULL COMMENT '最后操作ip地址',
  `endtime` int(10) unsigned NOT NULL COMMENT '最后登录时间',
  `password` char(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bg_users
-- ----------------------------
INSERT INTO `bg_users` VALUES ('5', '18128556009', '哈根和', '/static/common/images/face/1.jpg', '1', '1', '1545912237', '127.0.0.1', '1546080142', '123456');
INSERT INTO `bg_users` VALUES ('6', '13262976383', '哈根达斯', '/static/common/images/face/2.jpg', '1', '0', '1545912237', '116.235.53.214', '1546762978', '123456');

-- ----------------------------
-- Table structure for bg_zan
-- ----------------------------
DROP TABLE IF EXISTS `bg_zan`;
CREATE TABLE `bg_zan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `message_id` int(10) unsigned NOT NULL COMMENT '留言 或 评论 id',
  `user_id` int(10) unsigned NOT NULL COMMENT '无符号 点赞人id',
  `type` tinyint(3) unsigned NOT NULL COMMENT '1:留言 2:文章评论',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of bg_zan
-- ----------------------------
INSERT INTO `bg_zan` VALUES ('1', '2', '4', '1');
INSERT INTO `bg_zan` VALUES ('2', '1', '4', '1');
INSERT INTO `bg_zan` VALUES ('3', '3', '4', '1');
INSERT INTO `bg_zan` VALUES ('4', '17', '4', '1');
INSERT INTO `bg_zan` VALUES ('5', '4', '4', '1');
INSERT INTO `bg_zan` VALUES ('6', '1', '5', '2');
INSERT INTO `bg_zan` VALUES ('7', '0', '5', '2');
