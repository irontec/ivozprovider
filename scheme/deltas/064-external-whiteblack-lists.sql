CREATE TABLE `MatchLists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `matchName` (`companyId`,`name`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `MatchList_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

CREATE TABLE `MatchListPatterns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `matchListId` int(10) unsigned NOT NULL,
  `description` varchar(55) DEFAULT NULL,
  `type` varchar(10) NOT NULL COMMENT '[enum:number|regexp]',
  `regExp` varchar(255) DEFAULT NULL,
  `numberCountryId` int(10) unsigned DEFAULT NULL,
  `numberValue` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `matchListId` (`matchListId`),
  CONSTRAINT `MatchListPatterns_ibfk_1` FOREIGN KEY (`matchListId`) REFERENCES `MatchLists` (`id`) ON DELETE CASCADE,
  CONSTRAINT `MatchListPatterns_ibfk_2` FOREIGN KEY (`numberCountryId`) REFERENCES `Countries` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

CREATE TABLE `ExternalCallFilterWhiteLists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filterId` int(10) unsigned NOT NULL,
  `matchListId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `filterId` (`filterId`),
  KEY `matchListId` (`matchListId`),
  CONSTRAINT `ExternalCallFilterWhiteLists_ibfk_1` FOREIGN KEY (`filterId`) REFERENCES `ExternalCallFilters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ExternalCallFilterWhiteLists_ibfk_2` FOREIGN KEY (`matchListId`) REFERENCES `MatchLists` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';


CREATE TABLE `ExternalCallFilterBlackLists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filterId` int(10) unsigned NOT NULL,
  `matchListId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `filterId` (`filterId`),
  KEY `matchListId` (`matchListId`),
  CONSTRAINT `ExternalCallFilterBlackLists_ibfk_1` FOREIGN KEY (`filterId`) REFERENCES `ExternalCallFilters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ExternalCallFilterBlackLists_ibfk_2` FOREIGN KEY (`matchListId`) REFERENCES `MatchLists` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';


ALTER TABLE `ExternalCallFilters` DROP `blackListRegExp`;
ALTER TABLE `ExternalCallFilters` DROP `whiteListRegExp`;
