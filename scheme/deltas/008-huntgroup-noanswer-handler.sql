--
-- Add post hunt group no answer optional handlers
--
-- This handlers only applies to finite hunt groups
--
ALTER TABLE `HuntGroups` ADD `noAnswerLocutionId` int(10) unsigned DEFAULT NULL;
ALTER TABLE `HuntGroups` ADD FOREIGN KEY (`noAnswerLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL;

ALTER TABLE `HuntGroups` ADD `noAnswerTargetType` varchar(25) DEFAULT NULL COMMENT '[enum:number|extension|voicemail]';
ALTER TABLE `HuntGroups` ADD `noAnswerNumberValue` varchar(25) DEFAULT NULL;
ALTER TABLE `HuntGroups` ADD `noAnswerExtensionId` int(10) unsigned DEFAULT NULL;
ALTER TABLE `HuntGroups` ADD `noAnswerVoiceMailUserId` int(10) unsigned DEFAULT NULL;
ALTER TABLE `HuntGroups` ADD FOREIGN KEY (`noAnswerExtensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL;
ALTER TABLE `HuntGroups` ADD FOREIGN KEY (`noAnswerVoiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL;

