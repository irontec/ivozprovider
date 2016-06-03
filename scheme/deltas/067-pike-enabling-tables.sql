DROP TABLE `kam_users_trusted`;

CREATE TABLE `kam_pike_trusted` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `src_ip` varchar(50) DEFAULT NULL,
  `proto` varchar(4) DEFAULT NULL,
  `from_pattern` varchar(64) DEFAULT NULL,
  `ruri_pattern` varchar(64) DEFAULT NULL,
  `tag` varchar(64) DEFAULT NULL,
  `priority` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

UPDATE `version` SET table_name='kam_pike_trusted' WHERE table_name='kam_users_trusted';

CREATE TABLE `kam_trunks_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grp` int(11) UNSIGNED DEFAULT 1 NOT NULL,
  `ip_addr` varchar(50) DEFAULT NULL,
  `mask` int(10) NOT NULL DEFAULT '32',
  `port` int(5) NOT NULL DEFAULT '0',
  `tag` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `grp` (`grp`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

INSERT INTO `version` (table_name, table_version) VALUES ('kam_trunks_address', '6');
