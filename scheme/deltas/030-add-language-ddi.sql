ALTER TABLE `DDIs` ADD `languageId` int(10) unsigned DEFAULT NULL;
ALTER TABLE `DDIs` ADD FOREIGN KEY (`languageId`) REFERENCES `Languages` (`id`) ON DELETE SET NULL;
