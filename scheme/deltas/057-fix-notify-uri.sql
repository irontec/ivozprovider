DROP VIEW IF EXISTS `kam_users_dbaliases`;

DELETE FROM `kam_version` WHERE table_name='kam_users_dbaliases';

DROP VIEW IF EXISTS `kam_users_exten`;
CREATE VIEW `kam_users_exten` AS SELECT T.name AS name, T.domain AS domain, E.number AS extension FROM Users U INNER JOIN Terminals T ON T.id = U.terminalId INNER JOIN Extensions E ON E.id = U.extensionId;

