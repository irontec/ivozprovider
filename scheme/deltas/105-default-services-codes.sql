ALTER TABLE `Services` ADD `defaultCode` varchar(3) NOT NULL;
UPDATE `Services` SET defaultCode=94 WHERE `iden`='DirectPickUp';
UPDATE `Services` SET defaultCode=95 WHERE `iden`='GroupPickUp';
UPDATE `Services` SET defaultCode=93 WHERE `iden`='Voicemail';
