CREATE TABLE `MediaRelaySets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '0',
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';

CREATE TABLE `kam_rtpproxy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setid` varchar(32) NOT NULL DEFAULT '0',
  `url` varchar(128) NOT NULL,
  `flags` int(10) unsigned NOT NULL DEFAULT '0',
  `weight` int(10) unsigned NOT NULL DEFAULT '1',
  `description` varchar(200) DEFAULT NULL,
  `mediaRelaySetsId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mediaRelaySetsId` (`mediaRelaySetsId`),
  CONSTRAINT `kam_rtpproxy_ibfk_1` FOREIGN KEY (`mediaRelaySetsId`) REFERENCES `MediaRelaySets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';

INSERT INTO version (table_name, table_version) values ('kam_rtpproxy','1');

SET SESSION sql_mode='NO_AUTO_VALUE_ON_ZERO';
INSERT INTO `MediaRelaySets` VALUES (0,'Default','Default media relay set');
INSERT INTO `kam_rtpproxy` VALUES (0,'0','udp:127.0.0.1:22222',0,1,'Local media relay',0);

ALTER TABLE `Companies` ADD `mediaRelaySetsId` int(10) unsigned DEFAULT NULL;
ALTER TABLE `Companies` ADD FOREIGN KEY (`mediaRelaySetsId`) REFERENCES `MediaRelaySets` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
