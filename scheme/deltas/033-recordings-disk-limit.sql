ALTER TABLE `Brands` ADD `recordingsLimitMB` INT(10) DEFAULT NULL;
ALTER TABLE `Brands` ADD `recordingsLimitEmail` VARCHAR(250) DEFAULT NULL;

ALTER TABLE `Companies` ADD `recordingsLimitMB` INT(10) DEFAULT NULL;
ALTER TABLE `Companies` ADD `recordingsLimitEmail` VARCHAR(250) DEFAULT NULL;
