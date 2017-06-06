ALTER TABLE `MainOperators` MODIFY `active` tinyint(1) NOT NULL DEFAULT '1';
ALTER TABLE `BrandOperators` MODIFY `active` tinyint(1) NOT NULL DEFAULT '1';
ALTER TABLE `CompanyAdmins` MODIFY `active` tinyint(1) NOT NULL DEFAULT '1';