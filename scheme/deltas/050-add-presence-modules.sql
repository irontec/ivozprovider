/**
 * Due to the way phing works, delta 024 was not applied when it should on
 * oasis branch. Now, it's too late to apologize.
 *
 * We'll move delta 024 to 050 so it will apply after merging bleeding into oasis.
 */

/* Revert 024 in case it was applied */
DROP TABLE IF EXISTS `kam_users_presentity`;
DELETE FROM kam_version WHERE table_name = 'kam_users_presentity';

DROP TABLE IF EXISTS `kam_users_active_watchers`;
DELETE FROM kam_version WHERE table_name = 'kam_users_active_watchers';

DROP TABLE IF EXISTS `kam_users_watchers`;
DELETE FROM kam_version WHERE table_name = 'kam_users_watchers';

DROP TABLE IF EXISTS `kam_users_xcap`;
DELETE FROM kam_version WHERE table_name = 'kam_users_xcap';

DROP TABLE IF EXISTS `kam_users_pua`;
DELETE FROM kam_version WHERE table_name = 'kam_users_pua';

DROP VIEW IF EXISTS kam_users_dbaliases;
DELETE FROM kam_version WHERE table_name = 'kam_users_dbaliases';

/* Repeat 024 changes now */
CREATE TABLE `kam_users_presentity` (
    `id` INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `username` VARCHAR(64) NOT NULL,
    `domain` VARCHAR(64) NOT NULL,
    `event` VARCHAR(64) NOT NULL,
    `etag` VARCHAR(64) NOT NULL,
    `expires` INT(11) NOT NULL,
    `received_time` INT(11) NOT NULL,
    `body` BLOB NOT NULL,
    `sender` VARCHAR(128) NOT NULL,
    `priority` INT(11) DEFAULT 0 NOT NULL,
    CONSTRAINT kam_users_presentity_idx UNIQUE (`username`, `domain`, `event`, `etag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';

CREATE INDEX kam_users_presentity_expires ON kam_users_presentity (`expires`);
CREATE INDEX account_idx ON kam_users_presentity (`username`, `domain`, `event`);

INSERT INTO kam_version (table_name, table_version) values ('kam_users_presentity','4');

CREATE TABLE `kam_users_active_watchers` (
    `id` INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `presentity_uri` VARCHAR(128) NOT NULL,
    `watcher_username` VARCHAR(64) NOT NULL,
    `watcher_domain` VARCHAR(64) NOT NULL,
    `to_user` VARCHAR(64) NOT NULL,
    `to_domain` VARCHAR(64) NOT NULL,
    `event` VARCHAR(64) DEFAULT 'presence' NOT NULL,
    `event_id` VARCHAR(64),
    `to_tag` VARCHAR(64) NOT NULL,
    `from_tag` VARCHAR(64) NOT NULL,
    `callid` VARCHAR(255) NOT NULL,
    `local_cseq` INT(11) NOT NULL,
    `remote_cseq` INT(11) NOT NULL,
    `contact` VARCHAR(128) NOT NULL,
    `record_route` TEXT,
    `expires` INT(11) NOT NULL,
    `status` INT(11) DEFAULT 2 NOT NULL,
    `reason` VARCHAR(64) NOT NULL,
    `version` INT(11) DEFAULT 0 NOT NULL,
    `socket_info` VARCHAR(64) NOT NULL,
    `local_contact` VARCHAR(128) NOT NULL,
    `from_user` VARCHAR(64) NOT NULL,
    `from_domain` VARCHAR(64) NOT NULL,
    `updated` INT(11) NOT NULL,
    `updated_winfo` INT(11) NOT NULL,
    `flags` INT(11) DEFAULT 0 NOT NULL,
    `user_agent` VARCHAR(255) DEFAULT '' NOT NULL,
    CONSTRAINT kam_users_active_watchers_idx UNIQUE (`callid`, `to_tag`, `from_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';


CREATE INDEX kam_users_active_watchers_expires ON kam_users_active_watchers (`expires`);
CREATE INDEX kam_users_active_watchers_pres ON kam_users_active_watchers (`presentity_uri`, `event`);
CREATE INDEX updated_idx ON kam_users_active_watchers (`updated`);
CREATE INDEX updated_winfo_idx ON kam_users_active_watchers (`updated_winfo`, `presentity_uri`);

INSERT INTO kam_version (table_name, table_version) values ('kam_users_active_watchers','12');

CREATE TABLE `kam_users_watchers` (
    `id` INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `presentity_uri` VARCHAR(128) NOT NULL,
    `watcher_username` VARCHAR(64) NOT NULL,
    `watcher_domain` VARCHAR(64) NOT NULL,
    `event` VARCHAR(64) DEFAULT 'presence' NOT NULL,
    `status` INT(11) NOT NULL,
    `reason` VARCHAR(64),
    `inserted_time` INT(11) NOT NULL,
    CONSTRAINT kam_users_watchers_idx UNIQUE (`presentity_uri`, `watcher_username`, `watcher_domain`, `event`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';

INSERT INTO kam_version (table_name, table_version) values ('kam_users_watchers','3');

CREATE TABLE `kam_users_xcap` (
    `id` INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `username` VARCHAR(64) NOT NULL,
    `domain` VARCHAR(64) NOT NULL,
    `doc` MEDIUMBLOB NOT NULL,
    `doc_type` INT(11) NOT NULL,
    `etag` VARCHAR(64) NOT NULL,
    `source` INT(11) NOT NULL,
    `doc_uri` VARCHAR(255) NOT NULL,
    `port` INT(11) NOT NULL,
    CONSTRAINT doc_uri_idx UNIQUE (`doc_uri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';

CREATE INDEX account_doc_type_idx ON kam_users_xcap (`username`, `domain`, `doc_type`);
CREATE INDEX account_doc_type_uri_idx ON kam_users_xcap (`username`, `domain`, `doc_type`, `doc_uri`);
CREATE INDEX account_doc_uri_idx ON kam_users_xcap (`username`, `domain`, `doc_uri`);

INSERT INTO kam_version (table_name, table_version) values ('kam_users_xcap','4');

CREATE TABLE `kam_users_pua` (
    `id` INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    `pres_uri` VARCHAR(128) NOT NULL,
    `pres_id` VARCHAR(255) NOT NULL,
    `event` INT(11) NOT NULL,
    `expires` INT(11) NOT NULL,
    `desired_expires` INT(11) NOT NULL,
    `flag` INT(11) NOT NULL,
    `etag` VARCHAR(64) NOT NULL,
    `tuple_id` VARCHAR(64),
    `watcher_uri` VARCHAR(128) NOT NULL,
    `call_id` VARCHAR(255) NOT NULL,
    `to_tag` VARCHAR(64) NOT NULL,
    `from_tag` VARCHAR(64) NOT NULL,
    `cseq` INT(11) NOT NULL,
    `record_route` TEXT,
    `contact` VARCHAR(128) NOT NULL,
    `remote_contact` VARCHAR(128) NOT NULL,
    `version` INT(11) NOT NULL,
    `extra_headers` TEXT NOT NULL,
    CONSTRAINT kam_users_pua_idx UNIQUE (`etag`, `tuple_id`, `call_id`, `from_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';

CREATE INDEX expires_idx ON kam_users_pua (`expires`);
CREATE INDEX dialog1_idx ON kam_users_pua (`pres_id`, `pres_uri`);
CREATE INDEX dialog2_idx ON kam_users_pua (`call_id`, `from_tag`);
CREATE INDEX record_idx ON kam_users_pua (`pres_id`);

INSERT INTO kam_version (table_name, table_version) values ('kam_users_pua','7');

CREATE VIEW kam_users_dbaliases AS select T.name AS username, T.domain AS domain, E.number AS alias_username, T.domain AS alias_domain FROM Users U INNER JOIN Terminals T ON U.terminalId=T.id INNER JOIN Extensions E ON E.id=U.extensionId;

INSERT INTO kam_version (table_name, table_version) values ('kam_users_dbaliases','1');
