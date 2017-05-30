ALTER TABLE `PeerServers` DROP `name`;
ALTER TABLE `PeerServers` DROP `description`;
UPDATE `LcrGateways` LG SET gw_name=(SELECT CONCAT('b', B.id, 'p', PC.id, 's', PS.id) FROM `PeerServers` PS LEFT JOIN `PeeringContracts` PC ON PC.id=PS.peeringContractId LEFT JOIN `Brands` B ON B.id=PC.brandId WHERE PS.id=LG.peerServerId);
