CREATE TABLE `kam_rtpproxy` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
    `setid` VARCHAR(32) DEFAULT 0 NOT NULL,
    `url` VARCHAR(128) NOT NULL,
    `flags` int(10) unsigned NOT NULL DEFAULT '0',
    `weight` int(10) unsigned NOT NULL DEFAULT '1',
    `description` VARCHAR(200) DEFAULT NULL,
    PRIMARY KEY (`id`)
)ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='[entity]';

INSERT INTO version (table_name, table_version) values ('kam_rtpproxy','1');

INSERT INTO `kam_rtpproxy` (setid, url, description) VALUES ('0', 'udp:127.0.0.1:22222', 'Local media relay');

ALTER TABLE `Companies` ADD `mediarelay_setid` VARCHAR(32) DEFAULT 0 NOT NULL;

