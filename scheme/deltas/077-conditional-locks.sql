CREATE TABLE `RouteLocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(100) NOT NULL DEFAULT '',
  `open` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `ConditionalRoutesLocks_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';

CREATE TABLE `ConditionalRoutesConditionsRelRouteLocks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conditionId` int(10) unsigned NOT NULL,
  `routeLockId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `conditionId` (`conditionId`),
  KEY `routeLockId` (`routeLockId`),
  CONSTRAINT `ConditionalRoutesConditionsRelRouteLocks_ibfk_1` FOREIGN KEY (`conditionId`) REFERENCES `ConditionalRoutesConditions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ConditionalRoutesConditionsRelRouteLocks_ibfk_2` FOREIGN KEY (`routeLockId`) REFERENCES `RouteLocks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';


INSERT INTO Services (iden, name_en, name_es, description_en, description_es, defaultCode, extraArgs)
  VALUES ('CloseLock', 'Close Lock', 'Cerrar candado', 'Disables a routes with the lock', 'Deshabilita rutas configuradas con el candado', '70', 1);

INSERT INTO Services (iden, name_en, name_es, description_en, description_es, defaultCode, extraArgs)
  VALUES ('OpenLock', 'Open Lock', 'Abrir candado', 'Enables a routes with the lock', 'Habilita rutas configuradas con el candado', '71', 1);

INSERT INTO Services (iden, name_en, name_es, description_en, description_es, defaultCode, extraArgs)
  VALUES ('ToggleLock', 'Toggle Lock', 'Alternar candado', 'Switch current lock status', 'Alterna el estado de un candado', '72', 1);

-- Create default services for demo data if still exists
INSERT IGNORE INTO BrandServices (brandId, serviceId, code) SELECT 1, id, defaultCode FROM Services WHERE iden IN ('CloseLock', 'OpenLock', 'ToggleLock');
INSERT IGNORE INTO CompanyServices (companyId, serviceId, code) SELECT 1, id, defaultCode FROM Services WHERE iden IN ('CloseLock', 'OpenLock', 'ToggleLock');
