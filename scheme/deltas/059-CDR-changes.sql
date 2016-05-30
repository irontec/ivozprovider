ALTER TABLE `kam_acc_cdrs` DROP `type`;
ALTER TABLE `kam_acc_cdrs` DROP `subtype`;
ALTER TABLE `kam_acc_cdrs` DROP `companyName`;
ALTER TABLE `kam_acc_cdrs` MODIFY `parsed` enum('yes','no','delayed','error') DEFAULT 'no';
