ALTER TABLE `TransformationRulesetGroupsTrunks` ADD `automatic` tinyint(1) unsigned NOT NULL DEFAULT '0';
ALTER TABLE `TransformationRulesetGroupsTrunks` ADD `countryId` int(10) unsigned DEFAULT NULL;
ALTER TABLE `TransformationRulesetGroupsTrunks` ADD `internationalCode` varchar(10) DEFAULT NULL;
ALTER TABLE `TransformationRulesetGroupsTrunks` ADD `nationalNumLength` int(10) unsigned DEFAULT NULL;
ALTER TABLE `TransformationRulesetGroupsTrunks` ADD FOREIGN KEY (`countryId`) REFERENCES `Countries` (`id`) ON DELETE SET NULL;
