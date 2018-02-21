ALTER TABLE `CallForwardSettings` ADD `enabled` tinyint(1) unsigned NOT NULL DEFAULT '1';
ALTER TABLE `CallForwardSettings` DROP KEY `callFwTypeUser`;
