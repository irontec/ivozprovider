ALTER TABLE `InvoiceTemplates` ADD COLUMN `templateFooter` TEXT DEFAULT NULL AFTER `template`;
ALTER TABLE `InvoiceTemplates` ADD COLUMN `templateHeader` TEXT DEFAULT NULL AFTER `template`;