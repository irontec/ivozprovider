DROP TABLE IF EXISTS `LcrRuleTarget`;
DROP TABLE IF EXISTS `LcrRules`;
DROP TABLE `kam_users_address`;
DROP TABLE IF EXISTS `PeerServers`;

UPDATE `version` SET table_name='LcrRuleTargets' where table_name='LcrRuleTarget';
UPDATE `version` SET table_name='LcrGateways' where table_name='PeerServers';

CREATE TABLE `LcrRules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `prefix` varchar(100) DEFAULT NULL,
  `from_uri` varchar(64) DEFAULT NULL,
  `request_uri` varchar(100) DEFAULT NULL,
  `stopper` int(10) unsigned NOT NULL DEFAULT '0',
  `enabled` int(10) unsigned NOT NULL DEFAULT '1',
  `tag` varchar(55) NOT NULL,
  `description` varchar(500) NOT NULL DEFAULT '',
  `targetPatternId` int(10) unsigned DEFAULT NULL,
  `outgoingRoutingId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  KEY `targetPatternId` (`targetPatternId`),
  KEY `outgoingRoutingId` (`outgoingRoutingId`),
  CONSTRAINT `LcrRules_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `LcrRules_ibfk_2` FOREIGN KEY (`targetPatternId`) REFERENCES `TargetPatterns` (`id`) ON DELETE CASCADE,
  CONSTRAINT `LcrRules_ibfk_3` FOREIGN KEY (`outgoingRoutingId`) REFERENCES `OutgoingRouting` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='[entity]';

CREATE TABLE `PeerServers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `peeringContractId` int(10) unsigned NOT NULL,
  `ip` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` varchar(500) NOT NULL DEFAULT '',
  `brandId` int(10) unsigned NOT NULL,
  `hostname` varchar(64) DEFAULT NULL,
  `port` smallint(5) unsigned DEFAULT NULL,
  `params` varchar(64) DEFAULT NULL,
  `uri_scheme` tinyint(3) unsigned DEFAULT NULL,
  `transport` tinyint(3) unsigned DEFAULT NULL,
  `strip` tinyint(3) unsigned DEFAULT NULL,
  `prefix` varchar(16) DEFAULT NULL,
  `tag` varchar(64) DEFAULT NULL,
  `flags` int(10) unsigned NOT NULL DEFAULT '0',
  `defunct` int(10) unsigned DEFAULT NULL,
  `sendPAI` tinyint(1) unsigned DEFAULT '0',
  `sendRPID` tinyint(1) unsigned DEFAULT '0',
  `useAuthUserAsFromUser` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `peeringContractId` (`peeringContractId`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `PeerServers_ibfk_1` FOREIGN KEY (`peeringContractId`) REFERENCES `PeeringContracts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `PeerServers_ibfk_2` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='[entity]';

CREATE TABLE `LcrGateways` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `gw_name` varchar(200) NOT NULL,
  `ip` varchar(50) NOT NULL,
  `hostname` VARCHAR(64) DEFAULT NULL,
  `port` smallint(5) unsigned DEFAULT NULL,
  `params` varchar(64) DEFAULT NULL,
  `uri_scheme` tinyint(3) unsigned DEFAULT NULL,
  `transport` tinyint(3) unsigned DEFAULT NULL,
  `strip` tinyint(3) unsigned DEFAULT NULL,
  `prefix` varchar(16) DEFAULT NULL,
  `tag` varchar(64) DEFAULT NULL,
  `flags` int(10) unsigned NOT NULL DEFAULT '0',
  `defunct` int(10) unsigned DEFAULT NULL,
  `peerServerId` int(10) unsigned NOT NULL,
  `outgoingRoutingId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  KEY `peerServerId` (`peerServerId`),
  KEY `outgoingRoutingId` (`outgoingRoutingId`),
  CONSTRAINT `LcrGateways_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `LcrGateways_ibfk_2` FOREIGN KEY (`peerServerId`) REFERENCES `PeerServers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `LcrGateways_ibfk_3` FOREIGN KEY (`outgoingRoutingId`) REFERENCES `OutgoingRouting` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='[entity]';

CREATE TABLE `LcrRuleTargets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `rule_id` int(10) unsigned NOT NULL,
  `gw_id` int(10) unsigned NOT NULL,
  `priority` tinyint(3) unsigned NOT NULL,
  `weight` int(10) unsigned NOT NULL DEFAULT '1',
  `outgoingRoutingId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  KEY `rule_id` (`rule_id`),
  KEY `gw_id` (`gw_id`),
  KEY `outgoingRoutingId` (`outgoingRoutingId`),
  CONSTRAINT `LcrRuleTargets_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `LcrRuleTargets_ibfk_2` FOREIGN KEY (`rule_id`) REFERENCES `LcrRules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `LcrRuleTargets_ibfk_3` FOREIGN KEY (`gw_id`) REFERENCES `LcrGateways` (`id`) ON DELETE CASCADE,
  CONSTRAINT `LcrRuleTargets_ibfk_4` FOREIGN KEY (`outgoingRoutingId`) REFERENCES `OutgoingRouting` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='[entity]';

