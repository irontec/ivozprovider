DROP TABLE IF EXISTS Services;
DROP TABLE IF EXISTS GenericServices;

CREATE TABLE `Services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iden` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '[ml]',
  `name_en` varchar(50) NOT NULL DEFAULT '',
  `name_es` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '[ml]',
  `description_en` varchar(255) NOT NULL DEFAULT '',
  `description_es` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';

CREATE TABLE `BrandServices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `serviceId` int(10) unsigned NOT NULL,
  `brandId` int(10) unsigned NOT NULL,
  `code` varchar(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brandId` (`brandId`),
  KEY `serviceId` (`serviceId`),
  CONSTRAINT `BrandServices_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `BrandServices_ibfk_2` FOREIGN KEY (`serviceId`) REFERENCES `Services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';

CREATE TABLE `CompanyServices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `serviceId` int(10) unsigned NOT NULL,
  `companyId` int(10) unsigned NOT NULL,
  `code` varchar(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  KEY `serviceId` (`serviceId`),
  CONSTRAINT `CompanyServices_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `CompanyServices_ibfk_2` FOREIGN KEY (`serviceId`) REFERENCES `Services` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';

LOCK TABLES `Services` WRITE;
/*!40000 ALTER TABLE `Services` DISABLE KEYS */;
INSERT INTO `Services` VALUES (1,'DirectPickUp','','Direct Pickup','Captura Directa','','Add the capture extension after the service code','AÃ±ada la extensiÃ³n a capturar tras el cÃ³digo de servicio'),(2,'GroupPickUp','','Group Pickup','Captura de Grupo','','Captura la llamada de un miembro de los grupos de captura del usuario','Captura la llamada de un miembro de los grupos de captura del usuario'),(3,'Voicemail','','Check Voicemail','Consultar buzÃ³n de voz','','Check and configure the voicemail of the user','Consulta y configura el buzÃ³n de voz del usuario');
/*!40000 ALTER TABLE `Services` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

