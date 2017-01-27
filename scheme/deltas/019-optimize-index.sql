CREATE INDEX `sorcery_idx` ON ast_ps_endpoints (`sorcery_id`);
CREATE INDEX `sorcery_idx` ON ast_ps_aors (`sorcery_id`);
CREATE INDEX `contact_idx` ON ast_ps_aors (`contact`);
CREATE INDEX `name_domain_idx` ON Terminals (`name`, `domain`);
