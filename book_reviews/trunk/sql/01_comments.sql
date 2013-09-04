--
-- Definition of table `comments`
--

DROP TABLE IF EXISTS comments;

CREATE TABLE  `comments` (
  `id` 			int(10) unsigned NOT NULL auto_increment,
  `body` 		text NOT NULL,
  `author` 		varchar(50) NOT NULL,
  `email` 		varchar(80),
  `contentId` 	int(10) unsigned NOT NULL,
  `createdOn` 	datetime,
  `updatedOn` 	timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `contentId` (`contentId`),
  FOREIGN KEY (contentId) REFERENCES contents(id)
  	ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;