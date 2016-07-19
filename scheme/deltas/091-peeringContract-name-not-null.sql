ALTER TABLE `PeeringContracts` MODIFY `name` varchar(200) NOT NULL;
ALTER TABLE `PeeringContracts` ADD UNIQUE KEY `name_per_brand` (`name`, `brandId`);
