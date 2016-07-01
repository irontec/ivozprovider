ALTER TABLE `PeerServers` ADD `from_user` varchar(64) DEFAULT NULL;
ALTER TABLE `PeerServers` ADD `from_domain` varchar(64) DEFAULT NULL;
ALTER TABLE `PeerServers` DROP `useAuthUserAsFromUser`;
