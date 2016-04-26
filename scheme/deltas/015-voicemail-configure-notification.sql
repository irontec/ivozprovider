ALTER TABLE `Users` ADD `voicemailSendMail` tinyint(1) unsigned NOT NULL DEFAULT '1' AFTER voicemailEnabled;
UPDATE Users Set voicemailSendMail = attachVoicemailSound;
ALTER TABLE `Users` ADD `voicemailAttachSound` tinyint(1) unsigned NOT NULL DEFAULT '1' AFTER voicemailSendMail;
ALTER TABLE `Users` DROP attachVoicemailSound;
ALTER TABLE ast_voicemail ADD Column `userId` int(10) unsigned DEFAULT NULL,  ADD FOREIGN KEY `userId` (`userId`) REFERENCES Users(`id`) ON DELETE CASCADE;
