CREATE TABLE `Queues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `maxWaitTime` int(11) DEFAULT NULL,
  `timeoutLocutionId` int(10) unsigned DEFAULT NULL,
  `timeoutTargetType` varchar(25) DEFAULT NULL COMMENT '[enum:number|extension|voicemail]',
  `timeoutNumberValue` varchar(25) DEFAULT NULL,
  `timeoutExtensionId` int(10) unsigned DEFAULT NULL,
  `timeoutVoiceMailUserId` int(10) unsigned DEFAULT NULL,
  `maxlen` int(11) DEFAULT NULL,
  `fullLocutionId` int(10) unsigned DEFAULT NULL,
  `fullTargetType` varchar(25) DEFAULT NULL COMMENT '[enum:number|extension|voicemail]',
  `fullNumberValue` varchar(25) DEFAULT NULL,
  `fullExtensionId` int(10) unsigned DEFAULT NULL,
  `fullVoiceMailUserId` int(10) unsigned DEFAULT NULL,
  `periodicAnnounceLocutionId` int(10) unsigned DEFAULT NULL,
  `periodicAnnounceFrequency` int(11) DEFAULT NULL,
  `memberCallRest` int(11) DEFAULT NULL,
  `memberCallTimeout` int(11) DEFAULT NULL,
  `strategy` enum('ringall','leastrecent','fewestcalls','random','rrmemory','linear','wrandom','rrordered') DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  KEY `periodicAnnounceLocutionId` (`periodicAnnounceLocutionId`),
  KEY `timeoutLocutionId` (`timeoutLocutionId`),
  KEY `timeoutExtensionId` (`timeoutExtensionId`),
  KEY `timeoutVoiceMailUserId` (`timeoutVoiceMailUserId`),
  KEY `fullLocutionId` (`fullLocutionId`),
  KEY `fullExtensionId` (`fullExtensionId`),
  KEY `fullVoiceMailUserId` (`fullVoiceMailUserId`),
  UNIQUE KEY `company_queuename` (`companyId`,`name`),
  CONSTRAINT `Queues_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `Queues_ibfk_2` FOREIGN KEY (`periodicAnnounceLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Queues_ibfk_3` FOREIGN KEY (`timeoutLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Queues_ibfk_4` FOREIGN KEY (`timeoutExtensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Queues_ibfk_5` FOREIGN KEY (`timeoutVoiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Queues_ibfk_6` FOREIGN KEY (`fullLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Queues_ibfk_7` FOREIGN KEY (`fullExtensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Queues_ibfk_8` FOREIGN KEY (`fullVoiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

CREATE TABLE `ast_queues` (
  `name` varchar(128) NOT NULL,
  `periodic_announce` varchar(128) DEFAULT NULL,
  `periodic_announce_frequency` int(11) DEFAULT NULL,
  `timeout` int(11) DEFAULT NULL,
  `autopause` enum('yes','no','all') NOT NULL DEFAULT 'no',
  `ringinuse` enum('yes','no') NOT NULL DEFAULT 'no',
  `wrapuptime` int(11) DEFAULT NULL,
  `maxlen` int(11) DEFAULT NULL,
  `strategy` enum('ringall','leastrecent','fewestcalls','random','rrmemory','linear','wrandom','rrordered') DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `queueId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`name`),
  KEY `queueId` (`queueId`),
  CONSTRAINT `ast_queues_ibfk_1` FOREIGN KEY (`queueId`) REFERENCES `Queues` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';

CREATE TABLE `QueueMembers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `queueId` int(10) unsigned DEFAULT NULL,
  `userId` int(10) unsigned DEFAULT NULL,
  `penalty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `queueId` (`queueId`),
  KEY `userId` (`userId`),
  CONSTRAINT `QueueMembers_ibfk_1` FOREIGN KEY (`queueId`) REFERENCES `Queues` (`id`) ON DELETE CASCADE,
  CONSTRAINT `QueueMembers_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

CREATE TABLE `ast_queue_members` (
  `uniqueid` int(11) unsigned NOT NULL,
  `queue_name` varchar(80) NOT NULL,
  `interface` varchar(80) NOT NULL,
  `membername` varchar(80) DEFAULT NULL,
  `state_interface` varchar(80) DEFAULT NULL,
  `penalty` int(11) DEFAULT NULL,
  `paused` int(11) DEFAULT NULL,
  `queueMemberId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`uniqueid`),
  KEY `queueMemberId` (`queueMemberId`),
  CONSTRAINT `ast_queue_members_ibfk_1` FOREIGN KEY (`queueMemberId`) REFERENCES `QueueMembers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';

ALTER TABLE `Extensions` MODIFY `routeType` varchar(25) DEFAULT NULL COMMENT '[enum:user|number|IVRCommon|IVRCustom|huntGroup|conferenceRoom|friend|queue]';
ALTER TABLE `Extensions` ADD `queueId` int(10) unsigned DEFAULT NULL;
ALTER TABLE `Extensions` ADD FOREIGN KEY (`queueId`) REFERENCES `Queues` (`id`) ON DELETE SET NULL;


ALTER TABLE `DDIs` MODIFY `routeType` varchar(25) DEFAULT NULL COMMENT '[enum:user|IVRCommon|IVRCustom|huntGroup|fax|conferenceRoom|friend|queue]';
ALTER TABLE `DDIs` ADD `queueId` int(10) unsigned DEFAULT NULL;
ALTER TABLE `DDIs` ADD FOREIGN KEY (`queueId`) REFERENCES `Queues` (`id`) ON DELETE SET NULL;

