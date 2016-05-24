CREATE TABLE IF NOT EXISTS `EtagVersions` (
    `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
    `table` varchar(55) DEFAULT NULL,
    `etag` varchar(255) DEFAULT NULL,
    `lastChange` timestamp NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';

