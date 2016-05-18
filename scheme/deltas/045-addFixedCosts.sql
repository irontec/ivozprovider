CREATE TABLE `FixedCosts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandId` int(10) unsigned NOT NULL,
  `description` varchar(255) NOT NULL,
  `cost` DECIMAL(10,3),
  PRIMARY KEY (`id`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `FixedCosts_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';

CREATE TABLE `FixedCostsRelInvoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandId` int(10) unsigned NOT NULL,
  `fixedCostId` int(10) unsigned NOT NULL,
  `invoiceId` int(10) unsigned NOT NULL,
  `quantity` int(10),
  PRIMARY KEY (`id`),
  KEY `brandId` (`brandId`),
  KEY `fixedCostId` (`fixedCostId`),
  KEY `invoiceId` (`invoiceId`),
  CONSTRAINT `FixedCostsRelInvoices_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FixedCostsRelInvoices_ibfk_2` FOREIGN KEY (`fixedCostId`) REFERENCES `FixedCosts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FixedCostsRelInvoices_ibfk_3` FOREIGN KEY (`invoiceId`) REFERENCES `Invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
