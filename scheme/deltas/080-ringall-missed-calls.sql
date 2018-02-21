ALTER TABLE `HuntGroups` ADD `preventMissedCalls` int(10) unsigned NOT NULL DEFAULT '1';
UPDATE `HuntGroups` SET preventMissedCalls = 0 WHERE strategy != 'ringAll';
