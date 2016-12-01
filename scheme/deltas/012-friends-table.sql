--
-- Main Friends table
-- Basic required fields to configure a trunk for both asterisk and kamailio
--
CREATE TABLE `Friends` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(200) NOT NULL,
  `domain` varchar(255) DEFAULT NULL,
  `description` varchar(500) NOT NULL DEFAULT '',
  `transport` varchar(25) NOT NULL COMMENT '[enum:udp|tcp|tls]',
  `ip` varchar(50) DEFAULT NULL,
  `port` smallint(5) unsigned DEFAULT NULL,
  `auth_needed` enum('yes','no') NOT NULL DEFAULT 'yes',
  `password` varchar(64) DEFAULT NULL,
  `callACLId` int(10) unsigned DEFAULT NULL,
  `countryId` int(10) unsigned DEFAULT NULL,
  `areaCode` varchar(10) DEFAULT NULL,
  `outgoingDDIId` int(10) unsigned DEFAULT NULL,
  `priority` smallint(6) NOT NULL DEFAULT '1',
  `disallow` varchar(200) NOT NULL DEFAULT 'all',
  `allow` varchar(200) NOT NULL DEFAULT 'alaw',
  `direct_media_method` enum('invite','update') NOT NULL DEFAULT 'update' COMMENT '[enum:invite|update]',
  `callerid_update_header` enum('pai','rpid') NOT NULL DEFAULT 'pai' COMMENT '[enum:pai|rpid]',
  `update_callerid` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT '[enum:yes|no]',
  `from_domain` varchar(64) DEFAULT NULL,
  `directConnectivity` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT '[enum:yes|no]',
  PRIMARY KEY (`id`),
  UNIQUE KEY `companyPrio` (`companyId`,`priority`),
  KEY `companyId` (`companyId`),
  KEY `countryId` (`countryId`),
  KEY `callACLId` (`callACLId`),
  KEY `outgoingDDIId` (`outgoingDDIId`),
  CONSTRAINT `Friends_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `Friends_ibfk_2` FOREIGN KEY (`countryId`) REFERENCES `Countries` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Friends_ibfk_3` FOREIGN KEY (`callACLId`) REFERENCES `CallACL` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Friends_ibfk_4` FOREIGN KEY (`outgoingDDIId`) REFERENCES `DDIs` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

--
-- Friends Patterns
-- This table is used to determine if a dialed number (that doesn't match an existing Extension) will
-- be routed through this trunk
--
CREATE TABLE `FriendsPatterns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `friendId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `regExp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `friendId` (`friendId`),
  CONSTRAINT `FriendsPatterns_ibfk_1` FOREIGN KEY (`friendId`) REFERENCES `Friends` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

--
-- A simple view to authenticate friendly trunks or terminals with just a single query
--
CREATE VIEW `kam_users_authdb` AS SELECT name, domain, password FROM `Friends` UNION SELECT name, domain, password FROM `Terminals`;

--
-- Friends are configured in Asterisk Endpoint table more or less like terminals do
--
ALTER TABLE `ast_ps_endpoints` ADD `trust_id_inbound` enum('yes','no') DEFAULT NULL;
ALTER TABLE `ast_ps_endpoints` ADD `friendId` int(10) unsigned DEFAULT NULL AFTER `terminalId`;
ALTER TABLE `ast_ps_endpoints` ADD FOREIGN KEY (`friendId`) REFERENCES `Friends` (`id`) ON DELETE CASCADE;

-- We also updated the endpoints contexts in asterisk
-- * proxyTrunks will now use [trunks] (statically defined in pjsip.conf)
-- * users/terminals will now use [users]
-- * friendly trunks will now use [friends]
UPDATE `ast_ps_endpoints` SET `context` = 'users' where `terminalId` IS NOT NULL;

--
-- We now allow Extensions and DDIs to route a number through a friendly trunk
-- Which trunk will be used is based on the patterns avaialable in FriendPatterns table (see above)
--
ALTER TABLE `Extensions` MODIFY `routeType` varchar(25) DEFAULT NULL COMMENT '[enum:user|number|IVRCommon|IVRCustom|huntGroup|conferenceRoom|friend]';
ALTER TABLE `Extensions` ADD `friendValue` varchar(25) DEFAULT NULL;
ALTER TABLE `DDIs` MODIFY `routeType` varchar(25) DEFAULT NULL COMMENT '[enum:user|IVRCommon|IVRCustom|huntGroup|fax|conferenceRoom|friend]';
ALTER TABLE `DDIs` ADD `friendValue` varchar(25) DEFAULT NULL;

