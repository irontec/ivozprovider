-- Delete Company services for Retail
DELETE FROM CompanyServices WHERE companyId IN (SELECT id FROM Companies WHERE type = 'retail');

-- Add retail to voicemail table
ALTER TABLE `ast_voicemail` ADD `retailAccountId` int(10) unsigned DEFAULT NULL AFTER `userId`;
ALTER TABLE `ast_voicemail` ADD FOREIGN KEY (`retailAccountId`) REFERENCES `RetailAccounts` (`id`) ON DELETE CASCADE;

-- Create voicemail for existing Retail Accounts
INSERT INTO ast_voicemail (context, mailbox, tz, retailAccountId) SELECT CONCAT('company', R.companyId), CONCAT('retail', R.id), T.tz, R.id FROM RetailAccounts AS R INNER JOIN Companies AS C ON R.companyId = C.id INNER JOIN Timezones AS T ON T.id = C.defaultTimezoneId;


