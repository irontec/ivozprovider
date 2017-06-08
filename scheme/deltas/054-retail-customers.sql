/** Company: add new field type (vpbx|retail) **/
ALTER TABLE `Companies` ADD `type` varchar(25) NOT NULL DEFAULT 'vpbx' COMMENT '[enum:vpbx|retail]' AFTER `brandId`;

/** Company: make domain_users optional **/
ALTER TABLE Companies MODIFY `domain_users` varchar(190) DEFAULT NULL;

/** Brand: reuse domain_trunks as domain_users **/
ALTER TABLE Brands CHANGE `domain_trunks` `domain_users` varchar(255) DEFAULT NULL;

/** RetailAccount: Add new entity table **/
CREATE TABLE `RetailAccounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandId` int(10) unsigned NOT NULL,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(65) NOT NULL,
  `domain` varchar(190) DEFAULT NULL,
  `description` varchar(500) NOT NULL DEFAULT '',
  `transport` varchar(25) NOT NULL COMMENT '[enum:udp|tcp|tls]',
  `ip` varchar(50) DEFAULT NULL,
  `port` smallint(5) unsigned DEFAULT NULL,
  `auth_needed` enum('yes','no') NOT NULL DEFAULT 'yes',
  `password` varchar(64) DEFAULT NULL,
  `countryId` int(10) unsigned DEFAULT NULL,
  `areaCode` varchar(10) DEFAULT NULL,
  `outgoingDDIId` int(10) unsigned DEFAULT NULL,
  `disallow` varchar(200) NOT NULL DEFAULT 'all',
  `allow` varchar(200) NOT NULL DEFAULT 'alaw',
  `direct_media_method` enum('invite','update') NOT NULL DEFAULT 'update' COMMENT '[enum:invite|update]',
  `callerid_update_header` enum('pai','rpid') NOT NULL DEFAULT 'pai' COMMENT '[enum:pai|rpid]',
  `update_callerid` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT '[enum:yes|no]',
  `from_domain` varchar(190) DEFAULT NULL,
  `directConnectivity` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT '[enum:yes|no]',
  `languageId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_domain` (`name`,`domain`),
  KEY `brandId` (`brandId`),
  KEY `companyId` (`companyId`),
  KEY `countryId` (`countryId`),
  KEY `outgoingDDIId` (`outgoingDDIId`),
  KEY `languageId` (`languageId`),
  CONSTRAINT `RetailAccounts_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `RetailAccounts_ibfk_2` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `RetailAccounts_ibfk_3` FOREIGN KEY (`countryId`) REFERENCES `Countries` (`id`) ON DELETE SET NULL,
  CONSTRAINT `RetailAccounts_ibfk_4` FOREIGN KEY (`outgoingDDIId`) REFERENCES `DDIs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `RetailAccounts_ibfk_5` FOREIGN KEY (`languageId`) REFERENCES `Languages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

/** Features: Add new brand feature **/
INSERT INTO Features VALUES (9, 'retail', '', 'Retail Clients', 'Clientes Retail');

/** DDI: Add new routable option accountId **/
ALTER TABLE `DDIs` MODIFY `routeType` varchar(25) DEFAULT NULL COMMENT '[enum:user|IVRCommon|IVRCustom|huntGroup|fax|conferenceRoom|friend|queue|retailAccount]';
ALTER TABLE `DDIs` ADD `retailAccountId` int(10) unsigned DEFAULT NULL AFTER `conferenceRoomId`;
ALTER TABLE `DDIs` ADD FOREIGN KEY (`retailAccountId`) REFERENCES `RetailAccounts` (`id`) ON DELETE SET NULL;

/** Endpoints: add new endpoint type retail account **/
ALTER TABLE `ast_ps_endpoints` ADD `retailAccountId` int(10) unsigned DEFAULT NULL AFTER `friendId`;
ALTER TABLE `ast_ps_endpoints` ADD FOREIGN KEY (`retailAccountId`) REFERENCES `RetailAccounts` (`id`) ON DELETE CASCADE;

/** kam_users: Update view to handle Retail Accounts authentication **/
DROP VIEW `kam_users`;

CREATE VIEW `kam_users` AS
SELECT 'friend' AS type, NULL AS terminalId, name, domain, password, companyId FROM Friends
UNION
SELECT 'terminal' AS type, id AS terminalId, name, domain, password, companyId FROM Terminals
UNION
SELECT 'retail' AS type, NULL AS terminalId, name, domain, password, companyId FROM RetailAccounts;

/** Update domain_attrs **/
DELETE FROM kam_users_domain_attrs;
ALTER TABLE `kam_users_domain_attrs` DROP FOREIGN KEY `kam_users_domain_attrs_ibfk_1`;
ALTER TABLE `kam_users_domain_attrs` ADD FOREIGN KEY (`did`) REFERENCES `Domains` (`domain`) ON DELETE CASCADE ON UPDATE CASCADE;
INSERT INTO `kam_users_domain_attrs` (did, name, type, value) SELECT domain, 'brandId', 0, C.brandId FROM Domains D LEFT JOIN Companies C ON C.id=D.companyId LEFT JOIN Brands B ON B.id=C.brandId WHERE pointsTo='proxyusers' AND companyId IS NOT NULL;
INSERT INTO `kam_users_domain_attrs` (did, name, type, value) SELECT domain, 'brandId', 0, brandId FROM Domains WHERE pointsTo='proxyusers' AND brandId IS NOT NULL;

