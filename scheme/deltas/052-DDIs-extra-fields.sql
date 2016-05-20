ALTER TABLE `DDIs` ADD `DDIE164` varchar(25) DEFAULT NULL AFTER `DDI`;
ALTER TABLE `DDIs` ADD `peeringContractId` int(10) unsigned DEFAULT NULL;
ALTER TABLE `DDIs` ADD `countryId` int(10) unsigned DEFAULT NULL;

ALTER TABLE `DDIs` ADD FOREIGN KEY `Faxes_ibfk_8` (`peeringContractId`) REFERENCES `PeeringContracts` (`id`) ON DELETE SET NULL;
ALTER TABLE `DDIs` ADD FOREIGN KEY `Faxes_ibfk_9` (`countryId`) REFERENCES `Countries` (`id`) ON DELETE SET NULL;

