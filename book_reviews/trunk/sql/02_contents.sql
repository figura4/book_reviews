--
-- Definition of table `contents`
--

DROP TABLE IF EXISTS contents;

CREATE TABLE  `contents` (
  `id`					int(10) unsigned NOT NULL auto_increment,
  `pageTitle` 			varchar(200) NOT NULL,
  `userId`  			int(10) unsigned NOT NULL,
  `published` 			bool NOT NULL,
  `type` 				varchar(50) NOT NULL,
  `body` 				text NOT NULL,
  `cover`				varchar(100),
  `picture1`			varchar(100),
  `picture2`			varchar(100),
  `picture3`			varchar(100),			
  `italianTitle` 		varchar(200),
  `italianSubtitle` 	varchar(200),
  `originalTitle` 		varchar(200),
  `originalSubtitle` 	varchar(200),
  `year` 				varchar(4),
  `vote` 				smallint,
  `authorId` 			int(10) unsigned,
  `actors` 				text,
  `nation` 				varchar(30),
  `pages` 				varchar(5),
  `editor` 				varchar(50),
  `language`			varchar(20),
  `seasons`				varchar(200),
  `pubDate` 			date,
  `createdOn` 			datetime,
  `updatedOn` 			timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `userId` (`userId`),
  KEY `type` (`type`),
  KEY `vote` (`vote`),
  KEY `createdOn` (`createdOn`),
  KEY `italianTitle` (`italianTitle`),
  KEY `originalTitle` (`originalTitle`),
  FOREIGN KEY (authorId) REFERENCES authors(id)
  	ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (userId) REFERENCES users(id)
  	ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;
