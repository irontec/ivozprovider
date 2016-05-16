ALTER TABLE `ParsedCDRs` ADD `billDuration` int(10) unsigned DEFAULT NULL AFTER `billCallID`;
ALTER TABLE `ParsedCDRs` ADD `billDestination` varchar(128) DEFAULT NULL AFTER `billDuration`; 
