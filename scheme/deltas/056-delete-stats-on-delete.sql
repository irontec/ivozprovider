/* Delete stats from deleted companies/brands */
DELETE FROM `ParsedCDRs` WHERE `brandId` IS NULL;
DELETE FROM `ParsedCDRs` WHERE `companyId` IS NULL;

ALTER TABLE `ParsedCDRs` DROP FOREIGN KEY `parsedCDRs_ibfk_1`;
ALTER TABLE `ParsedCDRs` DROP FOREIGN KEY `parsedCDRs_ibfk_2`;

ALTER TABLE `ParsedCDRs` ADD FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `ParsedCDRs` ADD FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

DELETE FROM `kam_acc_cdrs` WHERE `brandId` IS NULL;
DELETE FROM `kam_acc_cdrs` WHERE `companyId` IS NULL;

ALTER TABLE `kam_acc_cdrs` DROP FOREIGN KEY `kam_acc_cdrs_ibfk_5`;
ALTER TABLE `kam_acc_cdrs` DROP FOREIGN KEY `kam_acc_cdrs_ibfk_6`;

ALTER TABLE `kam_acc_cdrs` ADD FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `kam_acc_cdrs` ADD FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
