ALTER TABLE `Locutions` DROP `fileFileSize`;
ALTER TABLE `Locutions` DROP `fileMimeType`;
ALTER TABLE `Locutions` DROP `fileBaseName`;

ALTER TABLE `Locutions` ADD `originalFileFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO:keepExtension]';
ALTER TABLE `Locutions` ADD `originalFileMimeType` varchar(80) DEFAULT NULL;
ALTER TABLE `Locutions` ADD `originalFileBaseName` varchar(255) DEFAULT NULL;
ALTER TABLE `Locutions` ADD `encodedFileFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO:keepExtension|storeInBaseFolder]';
ALTER TABLE `Locutions` ADD `encodedFileMimeType` varchar(80) DEFAULT NULL;
ALTER TABLE `Locutions` ADD `encodedFileBaseName` varchar(255) DEFAULT NULL;
ALTER TABLE `Locutions` ADD `status` varchar(20) DEFAULT NULL COMMENT '[enum:pending|encoding|ready|error]';
