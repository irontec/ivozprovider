ALTER TABLE `PeerServers` ADD `auth_needed` enum('yes', 'no') NOT NULL DEFAULT 'no';
ALTER TABLE `PeerServers` ADD `auth_user` varchar(64) DEFAULT NULL;
ALTER TABLE `PeerServers` ADD `auth_password` varchar(64) DEFAULT NULL;
ALTER TABLE `PeerServers` DROP `defunct`;
ALTER TABLE `PeerServers` DROP `tag`;
ALTER TABLE `PeerServers` DROP `flags`;
