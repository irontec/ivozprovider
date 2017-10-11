-- Fragment begins: 71 --
INSERT INTO changelog
                                (change_number, delta_set, start_dt, applied_by, description) VALUES (71, 'Main', NOW(), 'dbdeploy', '071-retailaccounts-name-constraint.sql');
DROP INDEX `name_domain` ON `RetailAccounts`;
CREATE UNIQUE INDEX `nameBrand` ON `RetailAccounts` (`name`, `brandId`);

UPDATE changelog
	                         SET complete_dt = NOW()
	                         WHERE change_number = 71
	                         AND delta_set = 'Main';
-- Fragment ends: 71 --
-- Fragment begins: 72 --
INSERT INTO changelog
                                (change_number, delta_set, start_dt, applied_by, description) VALUES (72, 'Main', NOW(), 'dbdeploy', '072-domain-length-fix.sql');
ALTER TABLE `Brands` MODIFY COLUMN `domain_users` varchar(190) DEFAULT NULL;
ALTER TABLE `Terminals` MODIFY COLUMN `domain` varchar(190) DEFAULT NULL;

UPDATE changelog
	                         SET complete_dt = NOW()
	                         WHERE change_number = 72
	                         AND delta_set = 'Main';
-- Fragment ends: 72 --
