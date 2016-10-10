ALTER TABLE `TransformationRulesetGroupsTrunks` DROP KEY `name_idx`;
ALTER TABLE `TransformationRulesetGroupsTrunks` ADD UNIQUE KEY `name_brand` (`name`, `brandId`);
