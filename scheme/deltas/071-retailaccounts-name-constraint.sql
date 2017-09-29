DROP INDEX `name_domain` ON `RetailAccounts`;
CREATE UNIQUE INDEX `nameBrand` ON `RetailAccounts` (`name`, `brandId`);
