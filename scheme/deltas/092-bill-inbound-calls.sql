ALTER TABLE `DDIs` ADD `billInboundCalls` tinyint(1) unsigned NOT NULL DEFAULT '0';
ALTER TABLE `kam_acc_cdrs` ADD `direction` ENUM('inbound', 'outbound') DEFAULT NULL;
ALTER TABLE `kam_acc_cdrs` ADD `reMeteringDate` DATETIME DEFAULT NULL;
