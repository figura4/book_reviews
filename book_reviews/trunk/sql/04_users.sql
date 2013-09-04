--
-- Definition of table `users`
--

DROP TABLE IF EXISTS users;

CREATE TABLE  `users` (
  `id`					int(10) unsigned NOT NULL auto_increment,
  `username` 			varchar(20),
  `hashedPassword` 	varchar(200),
  `salt` 				varchar (200),
  `email` 				varchar(200),
  `homepage` 			varchar(200),
  `avatar`				varchar(100),
  `role` 				varchar(100) NOT NULL default 'guest',
  `createdOn` 			datetime,
  `updatedOn` 			timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`),
  KEY `username` (`username`),
  KEY `role` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `username`, `hashedPassword`,                          `salt`,                             `role`)
VALUES              (1, 'figura4',  'da93b36067b42a697a8183adcccc593af980498d', '950cc1a15e8bb6fcfad3914bf0122e19', 'admin');