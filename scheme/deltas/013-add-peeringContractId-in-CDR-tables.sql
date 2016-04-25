ALTER TABLE `kam_trunks_acc_cdrs` ADD `peeringContractId` varchar(64) DEFAULT NULL;
ALTER TABLE `kam_users_acc_cdrs` ADD `peeringContractId` varchar(64) DEFAULT NULL;

DROP VIEW IF EXISTS `CDRs`;
CREATE VIEW `CDRs` AS select 'proxyusers' AS `proxy`,`kam_users_acc_cdrs`.`id` AS `id`,`kam_users_acc_cdrs`.`calldate` AS `calldate`,`kam_users_acc_cdrs`.`start_time` AS `start_time`,`kam_users_acc_cdrs`.`end_time` AS `end_time`,`kam_users_acc_cdrs`.`duration` AS `duration`,`kam_users_acc_cdrs`.`caller` AS `caller`,`kam_users_acc_cdrs`.`callee` AS `callee`,`kam_users_acc_cdrs`.`type` AS `type`,`kam_users_acc_cdrs`.`subtype` AS `subtype`,`kam_users_acc_cdrs`.`companyId` AS `companyId`,`kam_users_acc_cdrs`.`companyName` AS `companyName`,`kam_users_acc_cdrs`.`asIden` AS `asIden`,`kam_users_acc_cdrs`.`asAddress` AS `asAddress`,`kam_users_acc_cdrs`.`callid` AS `callid`,`kam_users_acc_cdrs`.`xcallid` AS `xcallid`,`kam_users_acc_cdrs`.`parsed` AS `parsed`,`kam_users_acc_cdrs`.`diversion` AS `diversion`,`kam_users_acc_cdrs`.`peeringContractId` AS `peeringContractId` from `kam_users_acc_cdrs` union select 'proxytrunks' AS `proxy`,`kam_trunks_acc_cdrs`.`id` AS `id`,`kam_trunks_acc_cdrs`.`calldate` AS `calldate`,`kam_trunks_acc_cdrs`.`start_time` AS `start_time`,`kam_trunks_acc_cdrs`.`end_time` AS `end_time`,`kam_trunks_acc_cdrs`.`duration` AS `duration`,`kam_trunks_acc_cdrs`.`caller` AS `caller`,`kam_trunks_acc_cdrs`.`callee` AS `callee`,`kam_trunks_acc_cdrs`.`type` AS `type`,`kam_trunks_acc_cdrs`.`subtype` AS `subtype`,`kam_trunks_acc_cdrs`.`companyId` AS `companyId`,`kam_trunks_acc_cdrs`.`companyName` AS `companyName`,`kam_trunks_acc_cdrs`.`asIden` AS `asIden`,`kam_trunks_acc_cdrs`.`asAddress` AS `asAddress`,`kam_trunks_acc_cdrs`.`callid` AS `callid`,`kam_trunks_acc_cdrs`.`xcallid` AS `xcallid`,`kam_trunks_acc_cdrs`.`parsed` AS `parsed`,`kam_trunks_acc_cdrs`.`diversion` AS `diversion`,`kam_trunks_acc_cdrs`.`peeringContractId` AS `peeringContractId` from `kam_trunks_acc_cdrs`;

DROP TABLE ParsedCDRs;

CREATE TABLE `ParsedCDRs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `calldate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Llamada establecida pata 1',
  `src` varchar(128) DEFAULT NULL COMMENT 'Real Caller',
  `src_dialed` varchar(128) DEFAULT NULL COMMENT 'Dialed Number',
  `src_duration` int(10) unsigned DEFAULT NULL COMMENT 'Duracion llamada pata 1',
  `dst` varchar(128) DEFAULT NULL COMMENT 'Final Callee, numero llamado en pata 2',
  `dst_src_cid` varchar(128) DEFAULT NULL COMMENT 'Numero mostrado como origen en pata 2',
  `dst_duration` int(10) unsigned DEFAULT NULL COMMENT 'Duracion llamada pata 2',
  `type` varchar(256) DEFAULT NULL COMMENT 'Mucha miga, needs work',
  `desc` varchar(256) DEFAULT NULL,
  `fw_desc` varchar(256) DEFAULT NULL,
  `ext_forwarder` varchar(32) DEFAULT NULL,
  `oasis_forwarder` varchar(32) DEFAULT NULL,
  `forward_to` varchar(32) DEFAULT NULL,
  `companyId` int(10) unsigned DEFAULT NULL,
  `brandId` int(10) unsigned DEFAULT NULL,
  `aleg` varchar(128) DEFAULT NULL COMMENT 'callid pata 1',
  `bleg` varchar(128) DEFAULT NULL COMMENT 'callid pata 2',
  `billCallID` varchar(128) DEFAULT NULL COMMENT 'callid pata facturable',
  `metered` tinyint(1) DEFAULT '0',
  `meteringDate` datetime DEFAULT '0000-00-00 00:00:00',
  `pricingPlanId` int(10) unsigned DEFAULT NULL,
  `targetPatternId` int(10) unsigned DEFAULT NULL,
  `price` decimal(10,3) DEFAULT NULL,
  `pricingPlanDetails` text,
  `invoiceId` int(10) unsigned DEFAULT NULL,
  `peeringContractId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brandId` (`brandId`),
  KEY `companyId` (`companyId`),
  KEY `pricingPlanId` (`pricingPlanId`),
  KEY `targetPatternId` (`targetPatternId`),
  KEY `invoiceId` (`invoiceId`),
  KEY `peeringContractId` (`peeringContractId`),
  CONSTRAINT `parsedCDRs_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `parsedCDRs_ibfk_2` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `parsedCDRs_ibfk_3` FOREIGN KEY (`pricingPlanId`) REFERENCES `PricingPlans` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `parsedCDRs_ibfk_4` FOREIGN KEY (`targetPatternId`) REFERENCES `TargetPatterns` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `parsedCDRs_ibfk_5` FOREIGN KEY (`invoiceId`) REFERENCES `Invoices` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `parsedCDRs_ibfk_6` FOREIGN KEY (`peeringContractId`) REFERENCES `PeeringContracts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56190 DEFAULT CHARSET=utf8 COMMENT='[entity]';

