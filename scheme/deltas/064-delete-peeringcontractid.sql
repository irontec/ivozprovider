ALTER TABLE `kam_acc_cdrs` DROP FOREIGN KEY `kam_acc_cdrs_ibfk_4`;
ALTER TABLE `kam_acc_cdrs` MODIFY `price` decimal(10,4) DEFAULT NULL;
