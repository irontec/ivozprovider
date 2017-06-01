/**
 * Add outgoingDDI to the company.
 * This DDI will be used by Users/Friends when they have no specific outgoingDDI
 */
ALTER TABLE `Companies` ADD `outgoingDDIId` int(10) unsigned DEFAULT NULL;
ALTER TABLE `Companies` ADD FOREIGN KEY (`outgoingDDIId`) REFERENCES `DDIs` (`id`) ON DELETE SET NULL;
