--
-- Definition of table `quotes`
--

DROP TABLE IF EXISTS quotes;

CREATE TABLE  `quotes` (
  `id`			int(10) unsigned NOT NULL auto_increment,
  `body` 		text,
  `source` 		varchar(200),
  `contentId` 	int(10) unsigned,
  `random` 		bool NOT NULL DEFAULT 0,
  `createdOn` 	datetime,
  `updatedOn` 	timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `contentId` (`contentId`),
  KEY `random` (`random`),
  FOREIGN KEY (contentId) REFERENCES contents(id)
  	ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;