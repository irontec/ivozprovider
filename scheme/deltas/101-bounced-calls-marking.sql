ALTER TABLE `kam_acc_cdrs` ADD `bounced` enum('yes','no') NOT NULL DEFAULT 'no' AFTER `peeringContractId`;
DROP VIEW BillableCalls;
CREATE VIEW BillableCalls AS (SELECT * FROM kam_acc_cdrs WHERE peeringContractId IS NOT NULL AND peeringContractId != '');
