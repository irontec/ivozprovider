ALTER TABLE `LcrRules` ADD `outgoingRoutingId` int(10) unsigned NOT NULL;
SET foreign_key_checks = 0;
ALTER TABLE `LcrRules` ADD FOREIGN KEY (`outgoingRoutingId`) REFERENCES `OutgoingRouting` (`id`) ON DELETE CASCADE;
SET foreign_key_checks = 1;
