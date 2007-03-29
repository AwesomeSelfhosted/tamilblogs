-- 
-- Database: `tamilblogs`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `tamilblogs_feeds`
-- 

DROP TABLE IF EXISTS `tamilblogs_feeds`;
CREATE TABLE IF NOT EXISTS `tamilblogs_feeds` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `url` varchar(255) NOT NULL default '',
  `name` varchar(255) default NULL,
  `lastmod` varchar(255) default NULL,
  `etag` varchar(255) default NULL,
  `added` datetime NOT NULL default '0000-00-00 00:00:00',
  `website` VARCHAR(255)  NULL,
  `no_of_links` VARCHAR(255)  NULL,  
  PRIMARY KEY  (`id`),
  UNIQUE KEY `url` (`url`)
) TYPE=MyISAM ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tamilblogs_items`
-- 

DROP TABLE IF EXISTS `tamilblogs_items`;
CREATE TABLE IF NOT EXISTS `tamilblogs_items` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `feed_id` int(10) unsigned NOT NULL default '0',
  `url` varchar(255) NOT NULL default '',
  `title` varchar(255) NOT NULL default '''no title''',
  `body` text,
  `dt` datetime NOT NULL default '0000-00-00 00:00:00',
  `hits` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `feed_id` (`feed_id`,`url`)
) TYPE=MyISAM ;

-- --------------------------------------------------------

-- 
-- Table structure for table `tamilblogs_userfeeds`
-- 

DROP TABLE IF EXISTS `tamilblogs_userfeeds`;
CREATE TABLE IF NOT EXISTS `tamilblogs_userfeeds` (
  `feed_id` int(10) unsigned NOT NULL default '0',
  `user_id` int(10) unsigned NOT NULL default '0',
  PRIMARY KEY  (`feed_id`,`user_id`)
) TYPE=MyISAM;

-- --------------------------------------------------------

-- 
-- Table structure for table `tamilblogs_users`
-- 

DROP TABLE IF EXISTS `tamilblogs_users`;
CREATE TABLE IF NOT EXISTS `tamilblogs_users` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `login` varchar(255) NOT NULL default '',
  `pass` varchar(255) NOT NULL default '',
  `magic` varchar(32) default NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `login` (`login`)
) TYPE=MyISAM AUTO_INCREMENT=3 ;

-- 
-- Table structure for table `tamilblogs_hits_cache_tmp`
-- 

DROP TABLE IF EXISTS `tamilblogs_hits_cache_tmp`;
CREATE TABLE IF NOT EXISTS `tamilblogs_hits_cache_tmp` (
  `url` varchar(255) NOT NULL default '',
  `ip` varchar(255) NOT NULL default '',
  `added` datetime NOT NULL default '0000-00-00 00:00:00'
) TYPE=MyISAM ;


INSERT INTO tamilblogs_users SET id='1', login='admin', pass='$1$1397484d$xt7b9DtY9aJt3XWjAQwJ//';

