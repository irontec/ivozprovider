ALTER TABLE `Companies` ADD `onDemandRecord` tinyint(1) DEFAULT '0';
ALTER TABLE `Companies` ADD `onDemandRecordCode` varchar(3) DEFAULT NULL;

ALTER TABLE `Recordings` ADD `type` enum('ondemand','ddi') NOT NULL DEFAULT 'ddi' COMMENT '[enum:ondemand|ddi]' AFTER `calldate`;
ALTER TABLE `Recordings` ADD `recorder` varchar(128) DEFAULT NULL AFTER `callee`;
