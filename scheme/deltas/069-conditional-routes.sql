CREATE TABLE `ConditionalRoutes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `locutionId` int(10) unsigned DEFAULT NULL,
  `routeType` varchar(25) DEFAULT NULL COMMENT '[enum:user|number|IVRCommon|IVRCustom|huntGroup|voicemail|friend|queue|conferenceRoom|extension]',
  `IVRCommonId` int(10) unsigned DEFAULT NULL,
  `IVRCustomId` int(10) unsigned DEFAULT NULL,
  `huntGroupId` int(10) unsigned DEFAULT NULL,
  `voiceMailUserId` int(10) unsigned DEFAULT NULL,
  `userId` int(10) unsigned DEFAULT NULL,
  `numberValue` varchar(25) DEFAULT NULL,
  `friendValue` varchar(25) DEFAULT NULL,
  `queueId` int(10) unsigned DEFAULT NULL,
  `conferenceRoomId` int(10) unsigned DEFAULT NULL,
  `extensionId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  KEY `locutionId` (`locutionId`),
  KEY `IVRCommonId` (`IVRCommonId`),
  KEY `IVRCustomId` (`IVRCustomId`),
  KEY `huntGroupId` (`huntGroupId`),
  KEY `voiceMailUserId` (`voiceMailUserId`),
  KEY `userId` (`userId`),
  KEY `queueId` (`queueId`),
  KEY `conferenceRoomId` (`conferenceRoomId`),
  KEY `extensionId` (`extensionId`),
  CONSTRAINT `ConditionalRoutes_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ConditionalRoutes_ibfk_2` FOREIGN KEY (`IVRCommonId`) REFERENCES `IVRCommon` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutes_ibfk_3` FOREIGN KEY (`IVRCustomId`) REFERENCES `IVRCustom` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutes_ibfk_4` FOREIGN KEY (`huntGroupId`) REFERENCES `HuntGroups` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutes_ibfk_5` FOREIGN KEY (`voiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `ConditionalRoutes_ibfk_6` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutes_ibfk_7` FOREIGN KEY (`queueId`) REFERENCES `Queues` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutes_ibfk_8` FOREIGN KEY (`locutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutes_ibfk_9` FOREIGN KEY (`conferenceRoomId`) REFERENCES `ConferenceRooms` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutes_ibfk_10` FOREIGN KEY (`extensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';


CREATE TABLE `ConditionalRoutesConditions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conditionalRouteId` int(10) unsigned NOT NULL,
  `priority` smallint(6) NOT NULL DEFAULT '1',
  `locutionId` int(10) unsigned DEFAULT NULL,
  `routeType` varchar(25) DEFAULT NULL COMMENT '[enum:user|number|IVRCommon|IVRCustom|huntGroup|voicemail|friend|queue|conferenceRoom|extension]',
  `IVRCommonId` int(10) unsigned DEFAULT NULL,
  `IVRCustomId` int(10) unsigned DEFAULT NULL,
  `huntGroupId` int(10) unsigned DEFAULT NULL,
  `voiceMailUserId` int(10) unsigned DEFAULT NULL,
  `userId` int(10) unsigned DEFAULT NULL,
  `numberValue` varchar(25) DEFAULT NULL,
  `friendValue` varchar(25) DEFAULT NULL,
  `queueId` int(10) unsigned DEFAULT NULL,
  `conferenceRoomId` int(10) unsigned DEFAULT NULL,
  `extensionId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY (`conditionalRouteId`, `priority`),
  KEY `locutionId` (`locutionId`),
  KEY `IVRCommonId` (`IVRCommonId`),
  KEY `IVRCustomId` (`IVRCustomId`),
  KEY `huntGroupId` (`huntGroupId`),
  KEY `voiceMailUserId` (`voiceMailUserId`),
  KEY `userId` (`userId`),
  KEY `queueId` (`queueId`),
  KEY `conferenceRoomId` (`conferenceRoomId`),
  KEY `extensionId` (`extensionId`),
  CONSTRAINT `ConditionalRoutesConditions_ibfk_1` FOREIGN KEY (`conditionalRouteId`) REFERENCES `ConditionalRoutes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_2` FOREIGN KEY (`IVRCommonId`) REFERENCES `IVRCommon` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_3` FOREIGN KEY (`IVRCustomId`) REFERENCES `IVRCustom` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_4` FOREIGN KEY (`huntGroupId`) REFERENCES `HuntGroups` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_5` FOREIGN KEY (`voiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_6` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_7` FOREIGN KEY (`queueId`) REFERENCES `Queues` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_8` FOREIGN KEY (`locutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_9` FOREIGN KEY (`conferenceRoomId`) REFERENCES `ConferenceRooms` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_10` FOREIGN KEY (`extensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

CREATE TABLE `ConditionalRoutesConditionsRelMatchLists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conditionId` int(10) unsigned NOT NULL,
  `matchListId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `conditionId` (`conditionId`),
  KEY `matchListId` (`matchListId`),
  CONSTRAINT `ConditionalRoutesConditionsRelMatchLists_ibfk_1` FOREIGN KEY (`conditionId`) REFERENCES `ConditionalRoutesConditions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ConditionalRoutesConditionsRelMatchLists_ibfk_2` FOREIGN KEY (`matchListId`) REFERENCES `MatchLists` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

CREATE TABLE `ConditionalRoutesConditionsRelSchedules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conditionId` int(10) unsigned NOT NULL,
  `scheduleId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `conditionId` (`conditionId`),
  KEY `scheduleId` (`scheduleId`),
  CONSTRAINT `ConditionalRoutesConditionsRelSchedules_ibfk_1` FOREIGN KEY (`conditionId`) REFERENCES `ConditionalRoutesConditions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ConditionalRoutesConditionsRelSchedules_ibfk_2` FOREIGN KEY (`scheduleId`) REFERENCES `Schedules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

CREATE TABLE `ConditionalRoutesConditionsRelCalendars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conditionId` int(10) unsigned NOT NULL,
  `calendarId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `conditionId` (`conditionId`),
  KEY `calendarId` (`calendarId`),
  CONSTRAINT `ConditionalRoutesConditionsRelCalendars_ibfk_1` FOREIGN KEY (`conditionId`) REFERENCES `ConditionalRoutesConditions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ConditionalRoutesConditionsRelCalendars_ibfk_2` FOREIGN KEY (`calendarId`) REFERENCES `Calendars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

ALTER TABLE `Extensions` MODIFY `routeType` varchar(25) DEFAULT NULL COMMENT '[enum:user|number|IVRCommon|IVRCustom|huntGroup|conferenceRoom|friend|queue|retailAccount|conditional]';
ALTER TABLE `Extensions` ADD `conditionalRouteId` int(10) unsigned DEFAULT NULL;
ALTER TABLE `Extensions` ADD FOREIGN KEY (`conditionalRouteId`) REFERENCES `ConditionalRoutes` (`id`) ON DELETE SET NULL;

ALTER TABLE `DDIs` MODIFY `routeType` varchar(25) DEFAULT NULL COMMENT '[enum:user|IVRCommon|IVRCustom|huntGroup|fax|conferenceRoom|friend|queue|retailAccount|conditional]';
ALTER TABLE `DDIs` ADD `conditionalRouteId` int(10) unsigned DEFAULT NULL;
ALTER TABLE `DDIs` ADD FOREIGN KEY (`conditionalRouteId`) REFERENCES `ConditionalRoutes` (`id`) ON DELETE SET NULL;

ALTER TABLE `IVRCustomEntries` MODIFY `targetType` varchar(25) NOT NULL COMMENT '[enum:number|extension|voicemail|conditional]';
ALTER TABLE `IVRCustomEntries` ADD `targetConditionalRouteId` int(10) unsigned DEFAULT NULL;
ALTER TABLE `IVRCustomEntries` ADD FOREIGN KEY (`targetConditionalRouteId`) REFERENCES `ConditionalRoutes` (`id`) ON DELETE SET NULL;

