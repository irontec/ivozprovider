CREATE TABLE `kam_version` (
  `table_name` varchar(32) NOT NULL,
  `table_version` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `table_name_idx` (`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';

INSERT INTO `kam_version` SELECT * from `version`;
DROP TABLE `version`;
