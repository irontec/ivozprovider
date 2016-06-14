CREATE TABLE `Recordings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `callid` varchar(128) DEFAULT NULL,
  `calldate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `duration` float(10,3) NOT NULL DEFAULT '0.000',
  `caller` varchar(128) DEFAULT NULL,
  `callee` varchar(128) DEFAULT NULL,
  `recordedFileFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO:keepExtension|storeInBaseFolder]',
  `recordedFileMimeType` varchar(80) DEFAULT NULL,
  `recordedFileBaseName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `Recordings_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

ALTER TABLE `DDIs` ADD `recordCalls` varchar(25) NOT NULL DEFAULT 'none' COMMENT '[enum:none|all|inbound|outbound]' AFTER `externalCallFilterId`;
