ALTER TABLE `Terminals` CHANGE `allow` `allow_audio` varchar(200) NOT NULL DEFAULT 'alaw';
ALTER TABLE `Terminals` ADD `allow_video` varchar(200) DEFAULT NULL AFTER `allow_audio`;
