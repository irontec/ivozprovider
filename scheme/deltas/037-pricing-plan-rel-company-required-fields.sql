LOCK TABLE `PricingPlansRelCompanies` WRITE;
UPDATE `PricingPlansRelCompanies` SET `validFrom` = '1970-01-01 00:00:00' WHERE `validFrom` IS NULL;
UPDATE `PricingPlansRelCompanies` SET `validTo` = '2070-12-31 23:59:59' WHERE `validTo` IS NULL;
ALTER TABLE PricingPlansRelCompanies modify `validFrom` datetime NOT NULL, modify `validTo` datetime NOT NULL;
UNLOCK TABLES;
