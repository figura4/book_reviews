--
-- Definition of table `figura4`.`tags`
--

DROP TABLE IF EXISTS tags;

CREATE TABLE  `tags` (
  `id`			int(10) unsigned NOT NULL auto_increment,
  `name`		varchar(50) NOT NULL,
  `description`		text NOT NULL,
  `order`			int(10) unsigned DEFAULT 1000,
  `createdOn` 			datetime,
  `updatedOn` 			timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `tagName` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
