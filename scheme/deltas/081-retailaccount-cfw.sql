ALTER TABLE `CallForwardSettings` MODIFY `userId` int(10) unsigned DEFAULT NULL;
ALTER TABLE `CallForwardSettings` ADD `retailAccountId` int(10) unsigned DEFAULT NULL AFTER `userId`;
ALTER TABLE `CallForwardSettings` ADD FOREIGN KEY (`retailAccountId`) REFERENCES `RetailAccounts` (`id`) ON DELETE CASCADE;
