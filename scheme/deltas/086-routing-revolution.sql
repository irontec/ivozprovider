CREATE TABLE `RoutingPatterns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL COMMENT '[ml]',
  `name_en` varchar(55) NOT NULL,
  `name_es` varchar(55) NOT NULL,
  `description` varchar(55) DEFAULT NULL COMMENT '[ml]',
  `description_en` varchar(55) NOT NULL DEFAULT '',
  `description_es` varchar(55) NOT NULL DEFAULT '',
  `regExp` varchar(80) NOT NULL,
  `brandId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `RoutingPatterns_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';


CREATE TABLE `RoutingPatternGroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `description` varchar(55) DEFAULT NULL,
  `brandId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`brandId`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `RoutingPatternGroups_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

CREATE TABLE `RoutingPatternGroupsRelPatterns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `routingPatternId` int(10) unsigned NOT NULL,
  `routingPatternGroupId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rel` (`routingPatternId`,`routingPatternGroupId`),
  KEY `routingPatternId` (`routingPatternId`),
  KEY `routingPatternGroupId` (`routingPatternGroupId`),
  CONSTRAINT `RoutingPatternGroupsRelPatterns_ibfk_1` FOREIGN KEY (`routingPatternId`) REFERENCES `RoutingPatterns` (`id`) ON DELETE CASCADE,
  CONSTRAINT `RoutingPatternGroupsRelPatterns_ibfk_2` FOREIGN KEY (`routingPatternGroupId`) REFERENCES `RoutingPatternGroups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6310 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

ALTER TABLE `Countries` ADD `zone` varchar(55) DEFAULT NULL COMMENT '[ml]' AFTER `name_es`;
ALTER TABLE `Countries` ADD `zone_en` varchar(55) NOT NULL DEFAULT '' AFTER `zone`;
ALTER TABLE `Countries` ADD `zone_es` varchar(55) NOT NULL DEFAULT '' AFTER `zone_en`;

DELETE FROM `OutgoingRouting`;

ALTER TABLE `OutgoingRouting` DROP FOREIGN KEY OutgoingRouting_ibfk_4;
ALTER TABLE `OutgoingRouting` DROP FOREIGN KEY OutgoingRouting_ibfk_3;
ALTER TABLE `OutgoingRouting` DROP `targetPatternId`;
ALTER TABLE `OutgoingRouting` DROP `targetGroupId`;

ALTER TABLE `OutgoingRouting` ADD `routingPatternId` int(10) unsigned DEFAULT NULL AFTER `type`;
ALTER TABLE `OutgoingRouting` ADD FOREIGN KEY (`routingPatternId`) REFERENCES RoutingPatterns (`id`) ON DELETE CASCADE;

ALTER TABLE `OutgoingRouting` ADD `routingPatternGroupId` int(10) unsigned DEFAULT NULL AFTER `routingPatternId`;
ALTER TABLE `OutgoingRouting` ADD FOREIGN KEY (`routingPatternGroupId`) REFERENCES RoutingPatternGroups (`id`) ON DELETE CASCADE;

DROP TABLE `TargetGroupsRelPatterns`;
DROP TABLE `TargetGroups`;

ALTER TABLE `LcrRules` DROP FOREIGN KEY LcrRules_ibfk_2;
ALTER TABLE `LcrRules` DROP `targetPatternId`;
ALTER TABLE `LcrRules` ADD `routingPatternId` int(10) unsigned DEFAULT NULL AFTER `description`;
ALTER TABLE `LcrRules` ADD FOREIGN KEY (`routingPatternId`) REFERENCES RoutingPatterns (`id`) ON DELETE CASCADE;

