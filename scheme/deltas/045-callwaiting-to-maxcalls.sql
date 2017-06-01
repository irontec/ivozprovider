UPDATE Users SET `maxCalls`= 0 WHERE `callWaiting` = 1;
UPDATE Users SET `maxCalls`= 1 WHERE `callWaiting` = 0;
ALTER TABLE Users DROP `callWaiting`;
ALTER TABLE `Users` MODIFY `maxCalls` smallint(5) unsigned NOT NULL DEFAULT '0';
