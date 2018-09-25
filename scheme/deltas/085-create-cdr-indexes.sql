CREATE INDEX `peeringContractId_brandId` ON `kam_acc_cdrs` (`peeringContractId`, `brandId`);
CREATE INDEX `start_time_utc` ON `kam_acc_cdrs` (`start_time_utc`);
CREATE INDEX `calldate` ON `ParsedCDRs` (`calldate`);
