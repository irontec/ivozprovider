ALTER TABLE `Friends` ADD `languageId` int(10) unsigned DEFAULT NULL;
ALTER TABLE `Friends` ADD FOREIGN KEY (`languageId`) REFERENCES `Languages` (`id`) ON DELETE SET NULL;
