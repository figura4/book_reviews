--
-- Definition of table `authors`
--

DROP TABLE IF EXISTS authors;

CREATE TABLE  `authors` (
  `id` 			int(10) unsigned NOT NULL auto_increment,
  `firstName` 	varchar(50) NOT NULL,
  `lastName` 	varchar(50) NOT NULL,
  `bio` 		text,
  `bioUrl` 		varchar(200),
  `picture`  	varchar(100),
  `createdOn` 	datetime,
  `updatedOn` 	timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  INDEX `lastName` (`lastName`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;