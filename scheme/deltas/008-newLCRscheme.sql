DROP TABLE IF EXISTS `OutgoingRouting`;
DROP TABLE IF EXISTS `TargetGroupsRelPatterns`;
DROP TABLE IF EXISTS `TargetGroups`;

CREATE TABLE `TargetGroups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `description` varchar(55) DEFAULT NULL,
  `brandId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`, `brandId`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `TargetGroups_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';

CREATE TABLE `TargetGroupsRelPatterns` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `targetPatternId` mediumint(8) unsigned NOT NULL,
  `targetGroupId` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `targetPatternId` (`targetPatternId`),
  KEY `targetGroupId` (`targetGroupId`),
  UNIQUE KEY `rel` (`targetPatternId`, `targetGroupId`),
  CONSTRAINT `TargetGroupsRelPatterns_ibfk_1` FOREIGN KEY (`targetPatternId`) REFERENCES `TargetPatterns` (`id`) ON DELETE CASCADE,
  CONSTRAINT `TargetGroupsRelPatterns_ibfk_2` FOREIGN KEY (`targetGroupId`) REFERENCES `TargetGroups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';

CREATE TABLE `OutgoingRouting` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('pattern', 'group', 'regexp') DEFAULT 'group',
  `targetPatternId` mediumint(8) unsigned DEFAULT NULL,
  `targetGroupId` mediumint(8) unsigned DEFAULT NULL,
  `regexp` varchar(1024) DEFAULT NULL,
  `peeringContractId` binary(36) NOT NULL,
  `priority` tinyint(3) unsigned NOT NULL,
  `weight` int(10) unsigned NOT NULL DEFAULT '1',
  `companyId` binary(36) NOT NULL,
  `brandId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  KEY `brandId` (`brandId`),
  KEY `targetPatternId` (`targetPatternId`),
  KEY `targetGroupId` (`targetGroupId`),
  KEY `peeringContractId` (`peeringContractId`),
  CONSTRAINT `OutgoingRouting_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `OutgoingRouting_ibfk_2` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `OutgoingRouting_ibfk_3` FOREIGN KEY (`targetPatternId`) REFERENCES `TargetPatterns` (`id`) ON DELETE CASCADE,
  CONSTRAINT `OutgoingRouting_ibfk_4` FOREIGN KEY (`targetGroupId`) REFERENCES `TargetGroups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `OutgoingRouting_ibfk_5` FOREIGN KEY (`peeringContractId`) REFERENCES `PeeringContracts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';

ALTER TABLE `LcrRuleTarget` DROP FOREIGN KEY LcrRuleTarget_ibfk_5;
DROP TABLE IF EXISTS PeeringContractsRelLcrRules;

ALTER TABLE `LcrRules` ADD `targetPatternId` mediumint(8) unsigned NOT NULL;
ALTER TABLE `LcrRules` ADD FOREIGN KEY (`targetPatternId`) REFERENCES `TargetPatterns` (`id`) ON DELETE CASCADE;

ALTER TABLE `LcrRules` MODIFY `tag` varchar(55) NOT NULL;

ALTER TABLE `LcrRuleTarget` DROP KEY `peeringContractsRelLcrRulesId`;
ALTER TABLE `LcrRuleTarget` DROP `peeringContractsRelLcrRulesId`;

DROP TABLE IF EXISTS `LcrRuleTarget`;

CREATE TABLE `LcrRuleTarget` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandId` int(10) unsigned NOT NULL,
  `companyId` binary(36) NOT NULL,
  `outgoingRoutingId` mediumint(8) unsigned NOT NULL,
  `rule_id` int(10) unsigned NOT NULL,
  `gw_id` int(10) unsigned NOT NULL,
  `priority` tinyint(3) unsigned NOT NULL,
  `weight` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rule_id_gw_id_idx` (`rule_id`,`gw_id`),
  KEY `brandId` (`brandId`),
  KEY `companyId` (`companyId`),
  KEY `outgoingRoutingId` (`outgoingRoutingId`),
  KEY `rule_id` (`rule_id`),
  KEY `gw_id` (`gw_id`),
  CONSTRAINT `LcrRuleTarget_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `LcrRuleTarget_ibfk_2` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `LcrRuleTarget_ibfk_3` FOREIGN KEY (`outgoingRoutingId`) REFERENCES `OutgoingRouting` (`id`) ON DELETE CASCADE,
  CONSTRAINT `LcrRuleTarget_ibfk_4` FOREIGN KEY (`rule_id`) REFERENCES `LcrRules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `LcrRuleTarget_ibfk_5` FOREIGN KEY (`gw_id`) REFERENCES `PeerServers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='[entity]';

ALTER TABLE `LcrRules` MODIFY `targetPatternId` mediumint(8) unsigned DEFAULT NULL;

ALTER TABLE `LcrRules` ADD outgoingRoutingId mediumint(8) unsigned DEFAULT NULL;

ALTER TABLE `LcrRules` ADD FOREIGN KEY (`outgoingRoutingId`) REFERENCES `OutgoingRouting` (`id`) ON DELETE CASCADE;


