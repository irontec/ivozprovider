CREATE VIEW BillableCalls AS (SELECT * FROM kam_acc_cdrs WHERE peeringContractId IS NOT NULL AND peeringContractId != '');
