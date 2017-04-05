CREATE TABLE `Features` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iden` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '[ml]',
  `name_en` varchar(50) NOT NULL DEFAULT '',
  `name_es` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `featureIden` (`iden`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

INSERT INTO `Features` VALUES (1,'queues','','Queues','Colas'),(2,'recordings','','Recordings','Grabaciones'),(3,'faxes','','Faxes','Fax Virtual'),(4,'friends','','Friends','Friends'),(5,'conferences','','Conferences','Conferencias'),(6,'billing','','Billing','Tarificador'),(7,'invoices','','Invoices','Facturador');

CREATE TABLE `FeaturesRelBrands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandId` int(10) unsigned NOT NULL,
  `featureId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brandId` (`brandId`),
  KEY `featureId` (`featureId`),
  CONSTRAINT `FeaturesRelBrands_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FeaturesRelBrands_ibfk_2` FOREIGN KEY (`featureId`) REFERENCES `Features` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

CREATE TABLE `FeaturesRelCompanies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `featureId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  KEY `featureId` (`featureId`),
  CONSTRAINT `FeaturesRelCompanies_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FeaturesRelCompanies_ibfk_2` FOREIGN KEY (`featureId`) REFERENCES `Features` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

INSERT INTO FeaturesRelCompanies (`companyId`, `featureId`) SELECT c.id AS companyId, f.id AS featureId FROM Features AS f JOIN Companies AS c WHERE f.id NOT IN (6,7);
INSERT INTO FeaturesRelBrands (`brandId`, `featureId`) SELECT b.id AS brandId, f.id AS featureId FROM Features AS f JOIN Brands AS b WHERE f.id;
