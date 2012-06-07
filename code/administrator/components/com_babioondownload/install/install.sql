--
-- BABIOONDOWNLOAD by Robert Deutz Business Solution www.rdbs.de
--

CREATE TABLE IF NOT EXISTS `#__babioondownload_downloads` (
  `id` int(11) NOT NULL auto_increment,
  `text` text character set utf8 NOT NULL,
  `filename` varchar(100) character set utf8 NOT NULL,
  `klicks` varchar(9) character set utf8 NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` INTEGER UNSIGNED NOT NULL DEFAULT '0',
  `checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
