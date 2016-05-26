ALTER TABLE `DDIs` ADD `brandId` int(10) unsigned NOT NULL AFTER `id`;
UPDATE `DDIs` SET `brandId` = (SELECT `id` FROM `Brands` LIMIT 1);
ALTER TABLE `DDIs` ADD FOREIGN KEY `DDIs_ibfk_10` (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE;