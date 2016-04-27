ALTER TABLE `kam_trunks_uacreg` ADD `flags` INT DEFAULT 0 NOT NULL AFTER `expires`;
ALTER TABLE `kam_trunks_uacreg` ADD `reg_delay` INT DEFAULT 0 NOT NULL AFTER `flags`;

UPDATE `version` SET table_version=2 WHERE table_name='kam_trunks_uacreg';

