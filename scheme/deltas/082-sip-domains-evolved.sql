ALTER TABLE `ast_ps_endpoints` ADD `outbound_proxy` DEFAULT NULL;
ALTER TABLE `Terminals` ADD `domain` varchar(255) DEFAULT NULL AFTER `name`;
ALTER TABLE `Brands` DROP `domain_users`;
ALTER TABLE `Companies` MODIFY `domain_users` varchar(255) NOT NULL;
ALTER TABLE `Companies` ADD UNIQUE KEY `domain_unique` (domain_users);
ALTER TABLE `ast_ps_endpoints` MODIFY `sorcery_id` varchar(355) NOT NULL;
ALTER TABLE `ast_ps_aors` MODIFY `sorcery_id` varchar(355) NOT NULL;
ALTER TABLE `ast_ps_endpoints` MODIFY `aors` varchar(355) NOT NULL;
