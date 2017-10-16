ALTER TABLE `Companies` ADD `distributeMethod` varchar(25) NOT NULL DEFAULT 'hash' COMMENT '[enum:static|rr|hash]' AFTER `defaultTimezoneId`;
UPDATE `Companies` SET distributeMethod='static' WHERE `applicationServerId` IS NOT NULL;
