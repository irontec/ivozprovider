-- Create MatchLists for existing Boss assistant regular expressions

ALTER TABLE Users ADD bossAssistantWhiteListId int(10) unsigned DEFAULT NULL AFTER exceptionBoosAssistantRegExp;
ALTER TABLE Users ADD FOREIGN KEY (`bossAssistantWhiteListId`) REFERENCES `MatchLists` (`id`) ON DELETE SET NULL;

INSERT INTO MatchLists (companyId, name) SELECT companyId, CONCAT('Boss assistant for user ', name, ' ', lastname) FROM Users WHERE exceptionBoosAssistantRegExp != '';
UPDATE Users U SET bossAssistantWhiteListId = (SELECT id from MatchLists WHERE name = CONCAT('Boss assistant for user ', U.name, ' ', U.lastname) AND companyId = U.companyId) WHERE exceptionBoosAssistantRegExp != '';

INSERT INTO MatchListPatterns (matchListId, type, `regExp`) SELECT bossAssistantWhiteListId, 'regexp', exceptionBoosAssistantRegExp FROM Users WHERE bossAssistantWhiteListId IS NOT NULL;

ALTER TABLE Users DROP exceptionBoosAssistantRegExp;
