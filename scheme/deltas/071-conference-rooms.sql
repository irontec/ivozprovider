CREATE TABLE `ConferenceRooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `pinProtected` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pinCode` varchar(6) DEFAULT NULL,
  `maxMembers` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ConferenceRoomsUniqueCompanyname` (`companyId`,`name`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `ConferenceRooms_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

ALTER TABLE `DDIs` ADD `conferenceRoomId` int(10) unsigned DEFAULT NULL AFTER `faxId`;
ALTER TABLE `DDIs` ADD FOREIGN KEY (`conferenceRoomId`) REFERENCES `ConferenceRooms` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `DDIs` MODIFY `routeType` varchar(25) NOT NULL COMMENT '[enum:user|IVRCommon|IVRCustom|huntGroup|fax|conferenceRoom]';

ALTER TABLE `Extensions` ADD `conferenceRoomId` int(10) unsigned DEFAULT NULL;
ALTER TABLE `Extensions` ADD FOREIGN KEY (`conferenceRoomId`) REFERENCES `ConferenceRooms` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `Extensions` MODIFY `routeType` varchar(25) NOT NULL DEFAULT 'user' COMMENT '[enum:user|IVRCommon|IVRCustom|huntGroup|conferenceRoom]';
