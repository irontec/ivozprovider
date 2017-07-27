ALTER TABLE `Users` ADD `voicemailLocutionId` int(10) unsigned DEFAULT NULL AFTER `voicemailEnabled`;
ALTER TABLE `Users` ADD FOREIGN KEY (`voicemailLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL;
