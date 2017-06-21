ALTER TABLE `Users` ADD `externalIpCalls` tinyint(1) NOT NULL DEFAULT '0' COMMENT '[enum:0|1|2|3]' AFTER `maxCalls`;

DROP VIEW IF EXISTS `kam_users_exten`;
CREATE VIEW `kam_users_exten` AS SELECT T.name AS name, T.domain AS domain, E.number AS extension, U.externalIpCalls FROM Users U INNER JOIN Terminals T ON T.id = U.terminalId INNER JOIN Extensions E ON E.id = U.extensionId;
