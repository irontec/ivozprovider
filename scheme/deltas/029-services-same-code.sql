
ALTER TABLE Services ADD `extraArgs` tinyint(1) unsigned NOT NULL DEFAULT '0';

UPDATE Services SET extraArgs = 1 WHERE iden IN ('DirectPickUp', 'Voicemail');
