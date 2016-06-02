ALTER TABLE `kam_acc_cdrs` MODIFY `peeringContractId` varchar(64) DEFAULT NULL;
UPDATE `kam_acc_cdrs` SET peeringContractId='' WHERE peeringContractId=0;
