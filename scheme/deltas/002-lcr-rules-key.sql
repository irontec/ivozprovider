ALTER TABLE `LcrRules` ADD `outgoingRoutingId` int(10) unsigned NOT NULL;
ALTER TABLE `LcrRules` ADD FOREIGN KEY (`outgoingRoutingId`) REFERENCES `OutgoingRouting` (`id`) ON DELETE CASCADE;
