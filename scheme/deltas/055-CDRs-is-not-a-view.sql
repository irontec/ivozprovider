DROP VIEW `CDRs`;
DROP TABLE `kam_users_acc_cdrs`;
DROP TABLE `kam_trunks_acc_cdrs`;

CREATE TABLE `kam_acc_cdrs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proxy` varchar(64) DEFAULT NULL,
  `calldate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `start_time` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `end_time` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `duration` float(10,3) NOT NULL DEFAULT '0.000',
  `caller` varchar(128) DEFAULT NULL,
  `callee` varchar(128) DEFAULT NULL,
  `referee` varchar(128) DEFAULT NULL,
  `referrer` varchar(128) DEFAULT NULL,
  `type` varchar(64) DEFAULT NULL,
  `subtype` varchar(64) DEFAULT NULL,
  `companyId` varchar(64) DEFAULT NULL,
  `companyName` varchar(64) DEFAULT NULL,
  `asIden` varchar(64) DEFAULT NULL,
  `asAddress` varchar(64) DEFAULT NULL,
  `callid` varchar(128) DEFAULT NULL,
  `xcallid` varchar(128) DEFAULT NULL,
  `parsed` enum('yes','no','error') DEFAULT 'no',
  `diversion` varchar(64) DEFAULT NULL,
  `peeringContractId` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `start_time_idx` (`start_time`),
  KEY `calldate_idx` (`calldate`),
  KEY `callid_idx` (`callid`),
  KEY `xcallid_idx` (`xcallid`),
  KEY `peeringContractId_idx` (`peeringContractId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';

UPDATE version SET table_name='kam_acc_cdrs' where table_name='kam_users_acc_cdrs';
DELETE FROM version WHERE table_name='kam_trunks_acc_cdrs';
