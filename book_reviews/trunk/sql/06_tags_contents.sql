--
-- Definition of table `tagsContents`
--

DROP TABLE IF EXISTS tagsContents;

CREATE TABLE  `tagsContents` (
  `tagId`		int(10) unsigned NOT NULL,
  `contentId`	int(10) unsigned NOT NULL,
  `createdOn` 			datetime,
  `updatedOn` 			timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (`tagId`, `contentId`),
  FOREIGN KEY (tagId) REFERENCES tags(id)
  	ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (contentId) REFERENCES contents(id)
  	ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;