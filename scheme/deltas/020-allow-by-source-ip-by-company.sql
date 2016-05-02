CREATE TABLE `kam_users_trusted` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `src_ip` VARCHAR(50),
    `proto` VARCHAR(4),
    `from_pattern` VARCHAR(64) DEFAULT NULL,
    `ruri_pattern` VARCHAR(64) DEFAULT NULL,
    `tag` VARCHAR(64),
    `priority` INT(10) DEFAULT 0 NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='[ignore]';

CREATE TABLE `kam_users_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `source_address` VARCHAR(100) NOT NULL,
  `ip_addr` VARCHAR(50),
  `mask` int(10) DEFAULT 32 NOT NULL,
  `port` int(5) DEFAULT 0 NOT NULL,
  `tag` VARCHAR(64) DEFAULT NULL,
  `description` VARCHAR(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  UNIQUE KEY `address4company` (`companyId`,`source_address`),
  CONSTRAINT `kam_users_address_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='[entity]';

INSERT INTO version (table_name, table_version) values ('kam_users_trusted','6');
INSERT INTO version (table_name, table_version) values ('kam_users_address','6');

