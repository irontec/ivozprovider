ALTER TABLE `ParsedCDRs` ADD `cleg` varchar(128) DEFAULT NULL COMMENT 'cleg CallID' AFTER `bleg`;
