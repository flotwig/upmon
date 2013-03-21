CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  `url` text,
  `visible` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;

CREATE TABLE `servers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `server` text,
  `port` int(11) DEFAULT NULL,
  `checks` int(11) DEFAULT '0',
  `good` int(11) DEFAULT '0',
  `current` tinyint(4) DEFAULT NULL,
  `group` int(11) DEFAULT '0',
  `desc` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf32;
