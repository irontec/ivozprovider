DROP INDEX peerServerId ON LcrGateways;
DROP INDEX name_domain_idx ON Terminals;
DROP INDEX terminalId ON Users;

ALTER TABLE Users MODIFY active TINYINT(1) UNSIGNED DEFAULT '0' NOT NULL;
ALTER TABLE Users MODIFY maxCalls SMALLINT UNSIGNED DEFAULT 2 NOT NULL;

/* Mysql's unique keys (`domain_users`) can not be larger than 255 characters: 190 domain char + 65 username char  */
ALTER TABLE Companies MODIFY domain_users VARCHAR(190) NOT NULL;
ALTER TABLE Domains MODIFY domain varchar(190) NOT NULL;

ALTER TABLE kam_users_domain_attrs MODIFY did VARCHAR(190) NOT NULL;
ALTER TABLE kam_users_location_attrs MODIFY domain VARCHAR(190) DEFAULT NULL;
ALTER TABLE kam_users_location MODIFY domain VARCHAR(190) DEFAULT NULL;

ALTER TABLE kam_trunks_uacreg MODIFY l_domain VARCHAR(190) DEFAULT 'unused' NOT NULL;
ALTER TABLE kam_trunks_uacreg MODIFY r_domain VARCHAR(190) DEFAULT '' NOT NULL;
ALTER TABLE kam_users_missed_calls MODIFY from_domain VARCHAR(190) DEFAULT NULL;
ALTER TABLE kam_users_missed_calls MODIFY ruri_domain VARCHAR(190) DEFAULT NULL;
ALTER TABLE PeerServers MODIFY from_domain VARCHAR(190) DEFAULT NULL;
ALTER TABLE CompanyAdmins MODIFY username VARCHAR(65) NOT NULL;
ALTER TABLE kam_users_acc MODIFY from_domain VARCHAR(190) DEFAULT NULL;
ALTER TABLE kam_users_acc MODIFY ruri_domain VARCHAR(190) DEFAULT NULL;
ALTER TABLE kam_trunks_domain_attrs MODIFY did VARCHAR(190) NOT NULL;
ALTER TABLE Users MODIFY username VARCHAR(65) DEFAULT NULL;
ALTER TABLE BrandOperators MODIFY username VARCHAR(65) NOT NULL;
ALTER TABLE Friends MODIFY from_domain VARCHAR(190) DEFAULT NULL;
ALTER TABLE Friends MODIFY `name` varchar(65) NOT NULL;
ALTER TABLE Friends MODIFY `domain` varchar(190) DEFAULT NULL;
ALTER TABLE ast_ps_endpoints MODIFY `from_domain` varchar(190) DEFAULT NULL;
ALTER TABLE MainOperators MODIFY username VARCHAR(65) NOT NULL;
