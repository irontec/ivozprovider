ALTER TABLE `IVRCustomEntries` DROP FOREIGN KEY `IVRCustomEntries_ibfk_3`;
ALTER TABLE `IVRCustomEntries` DROP FOREIGN KEY `IVRCustomEntries_ibfk_4`;
ALTER TABLE `IVRCustomEntries` DROP FOREIGN KEY `IVRCustomEntries_ibfk_5`;

ALTER TABLE `IVRCustomEntries` ADD CONSTRAINT `IVRCustomEntries_ibfk_3` FOREIGN KEY (`targetExtensionId`) REFERENCES `Extensions` (`id`) ON DELETE CASCADE;
ALTER TABLE `IVRCustomEntries` ADD CONSTRAINT `IVRCustomEntries_ibfk_4` FOREIGN KEY (`targetVoiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE CASCADE;
ALTER TABLE `IVRCustomEntries` ADD CONSTRAINT `IVRCustomEntries_ibfk_5` FOREIGN KEY (`targetConditionalRouteId`) REFERENCES `ConditionalRoutes` (`id`) ON DELETE CASCADE;
