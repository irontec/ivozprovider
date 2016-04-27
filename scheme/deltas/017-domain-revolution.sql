DROP VIEW `kam_users_domain`;
DROP VIEW `kam_trunks_domain`;

CREATE TABLE `Domains` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) NOT NULL,
  `scope` enum('global','company','brand') NOT NULL DEFAULT 'global',
  `pointsTo` enum('proxyusers','proxytrunks') NOT NULL DEFAULT 'proxyusers',
  `brandId` int(10) unsigned DEFAULT NULL,
  `companyId` int(10) unsigned DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `domain` (`domain`),
  UNIQUE KEY `one_domain_per_brand` (`pointsTo`, `brandId`),
  UNIQUE KEY `one_domain_per_company` (`pointsTo`, `companyId`),
  KEY `brandId` (`brandId`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `Domains_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON UPDATE CASCADE ON DELETE CASCADE,
  CONSTRAINT `Domains_ibfk_2` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='[entity]';

CREATE VIEW `kam_users_domain` AS SELECT domain, NULL AS did FROM Domains WHERE pointsTo='proxyusers';
CREATE VIEW `kam_trunks_domain` AS SELECT domain, NULL AS did FROM Domains WHERE pointsTo='proxytrunks';

ALTER TABLE `Brands` ADD `domain_trunks` varchar(255) DEFAULT NULL AFTER `domain`;
ALTER TABLE `Brands` ADD `domain_users` varchar(255) DEFAULT NULL AFTER `domain_trunks`;
ALTER TABLE `Brands` DROP `domain`;
ALTER TABLE `Companies` ADD `domain_users` varchar(255) DEFAULT NULL AFTER `name`;


