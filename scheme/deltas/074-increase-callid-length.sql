ALTER TABLE `ParsedCDRs` MODIFY `cid` varchar(255) DEFAULT NULL;
ALTER TABLE `ParsedCDRs` MODIFY `xcid` varchar(255) DEFAULT NULL;
ALTER TABLE `ParsedCDRs` MODIFY `initialLeg` varchar(255) DEFAULT NULL;
ALTER TABLE `kam_acc_cdrs` MODIFY `callid` varchar(255) DEFAULT NULL;
ALTER TABLE `kam_acc_cdrs` MODIFY `xcallid` varchar(255) DEFAULT NULL;
ALTER TABLE `Recordings` MODIFY `callid` varchar(255) DEFAULT NULL;
