ALTER TABLE FixedCosts ADD name VARCHAR(255) DEFAULT NULL AFTER `brandId`;
UPDATE FixedCosts SET name = description;
ALTER TABLE FixedCosts MODIFY name VARCHAR(255) NOT NULL;

ALTER TABLE FixedCosts DROP INDEX `descBrand`;
ALTER TABLE FixedCosts ADD UNIQUE KEY `descBrand` (`brandId`,`name`);

ALTER TABLE FixedCosts MODIFY description TEXT DEFAULT NULL;
UPDATE FixedCosts SET description = NULL;
UPDATE InvoiceTemplates SET template = REPLACE(template, '{{fixedCost.description}}', '{{fixedCost.name}}');