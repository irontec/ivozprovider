ALTER TABLE `LcrGateways` MODIFY `ip` varchar(50) DEFAULT NULL;
ALTER TABLE `PeerServers` ADD `sip_proxy` varchar(128) DEFAULT NULL;
ALTER TABLE `PeerServers` ADD `outbound_proxy` varchar(128) DEFAULT NULL;
