ALTER TABLE `Companies` CHANGE `externalMaxCalls` `maxCalls` int(10) unsigned NOT NULL DEFAULT '0';
ALTER TABLE `Brands` ADD `maxCalls` int(10) unsigned NOT NULL DEFAULT '0';
