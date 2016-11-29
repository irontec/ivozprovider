ALTER TABLE `Users` MODIFY `pass` varchar(80) DEFAULT NULL COMMENT '[password]';
ALTER TABLE `Users` MODIFY `active` tinyint(1) NOT NULL DEFAULT '0';
ALTER TABLE `Users` MODIFY `voicemailSendMail` tinyint(1) unsigned NOT NULL DEFAULT '0';
ALTER TABLE `ast_voicemail` MODIFY `password` varchar(80) NOT NULL DEFAULT '1234';
