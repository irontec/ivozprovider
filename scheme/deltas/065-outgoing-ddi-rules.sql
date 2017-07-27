CREATE TABLE `OutgoingDDIRules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `defaultAction` varchar(10) NOT NULL COMMENT '[enum:keep|force]',
  `forcedDDIId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ruleName` (`companyId`,`name`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `OutgoingDDIRules_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `OutgoingDDIRules_ibfk_2` FOREIGN KEY (`forcedDDIId`) REFERENCES `DDIs` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

CREATE TABLE `OutgoingDDIRulesPatterns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `outgoingDDIRuleId` int(10) unsigned NOT NULL,
  `matchListId` int(10) unsigned NOT NULL,
  `action` varchar(10) NOT NULL COMMENT '[enum:keep|force]',
  `forcedDDIId` int(10) unsigned DEFAULT NULL,
  `priority` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `patternPriority` (`outgoingDDIRuleId`,`priority`),
  CONSTRAINT `OutgoingDDIRulesPatterns_ibfk_1` FOREIGN KEY (`outgoingDDIRuleId`) REFERENCES `OutgoingDDIRules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `OutgoingDDIRulesPatterns_ibfk_2` FOREIGN KEY (`matchListId`) REFERENCES `MatchLists` (`id`) ON DELETE CASCADE,
  CONSTRAINT `OutgoingDDIRulesPatterns_ibfk_3` FOREIGN KEY (`forcedDDIId`) REFERENCES `DDIs` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

ALTER TABLE `Users` ADD `outgoingDDIRuleId` int(10) unsigned DEFAULT NULL AFTER `outgoingDDIId`;
ALTER TABLE `Users` ADD FOREIGN KEY (`outgoingDDIRuleId`) REFERENCES `OutgoingDDIRules` (`id`) ON DELETE SET NULL;


ALTER TABLE `Companies` ADD `outgoingDDIRuleId` int(10) unsigned DEFAULT NULL AFTER `outgoingDDIId`;
ALTER TABLE `Companies` ADD FOREIGN KEY (`outgoingDDIRuleId`) REFERENCES `OutgoingDDIRules` (`id`) ON DELETE SET NULL;
