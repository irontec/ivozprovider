ALTER TABLE `ast_ps_endpoints` ADD `outbound_proxy` varchar(256) DEFAULT NULL;

ALTER TABLE `Brands` DROP `domain_users`;

ALTER TABLE `Companies` MODIFY `domain_users` varchar(255) NOT NULL;
ALTER TABLE `Companies` ADD UNIQUE KEY `domain_unique` (domain_users);

ALTER TABLE `Terminals` ADD `domain` varchar(255) DEFAULT NULL AFTER `name`;
ALTER TABLE `Terminals` DROP KEY  `name`;
ALTER TABLE `Terminals` ADD UNIQUE KEY `name_domain` (`name`, `domain`);

DROP VIEW `ast_hints`;
CREATE VIEW `ast_hints` AS select `e`.`number` AS `exten`,concat('company',`u`.`companyId`) AS `context`,concat('PJSIP/',`ape`.`sorcery_id`) AS `device` from (((`Users` `u` join `Terminals` `t` on((`u`.`terminalId` = `t`.`id`))) join `Extensions` `e` on((`u`.`extensionId` = `e`.`id`))) join `ast_ps_endpoints` `ape` on((`ape`.`terminalId` = `t`.`id`)));
