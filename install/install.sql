DROP TABLE IF EXISTS `msg_config`;</explode>
CREATE TABLE `msg_config` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
  `switch` int(1) NOT NULL DEFAULT '1',
  `user` varchar(250) NOT NULL,
  `pwd` varchar(250) NOT NULL,
  `login` text,
 `title` text,
 `qq` text,
 `face_image` text,
 `phone` text,
 `syskey` text,
 `jiage` text,
 `zsye` text,
 `kmtips` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

DROP TABLE IF EXISTS `msg_api`;</explode>
CREATE TABLE `msg_api` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
 `url` text,
 `post` text,
 `status` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

DROP TABLE IF EXISTS `msg_notice`;</explode>
CREATE TABLE `msg_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `center` text,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

DROP TABLE IF EXISTS `user_list`;</explode>
CREATE TABLE `user_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` text,
  `pass` varchar(30) DEFAULT NULL,
  `qq` varchar(30) DEFAULT NULL,
  `key` varchar(30) DEFAULT NULL,
  `status` text,
  `money` float DEFAULT NULL,
  `dta` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

DROP TABLE IF EXISTS `msg_km`;</explode>
CREATE TABLE `msg_km` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `km` text,
  `money` varchar(30) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

DROP TABLE IF EXISTS `msg_phone`;</explode>
CREATE TABLE `msg_phone` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
 `phone` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

DROP TABLE IF EXISTS `msg_log`;</explode>
CREATE TABLE `msg_log` (
  `id` int(1) NOT NULL AUTO_INCREMENT,
 `user` text, 
`phone` text,
`money` text,
`date` text,
`ip` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;</explode>

INSERT INTO `msg_config`(`id`, `switch`, `user`, `pwd`, `login`, `title`, `qq`, `face_image`, `phone`, `jiage`, `zsye`, `kmtips`) VALUES
('1', '1', 'admin', '123456','password','小Q短信轰炸系统','12345678','','13888888888','1','10','购买卡密可联系客服：12345678进行购买！');</explode>