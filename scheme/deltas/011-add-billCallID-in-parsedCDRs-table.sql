ALTER TABLE `ParsedCDRs` ADD `billCallID` varchar(128) DEFAULT NULL COMMENT 'callid pata facturable' AFTER `bleg`;
