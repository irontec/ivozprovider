-- MySQL dump 10.13  Distrib 5.5.57, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ivozprovider
-- ------------------------------------------------------
-- Server version	5.5.57-0+deb8u1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ApplicationServers`
--

DROP TABLE IF EXISTS `ApplicationServers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ApplicationServers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ip`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ApplicationServers`
--

LOCK TABLES `ApplicationServers` WRITE;
/*!40000 ALTER TABLE `ApplicationServers` DISABLE KEYS */;
INSERT INTO `ApplicationServers` VALUES (1,'127.0.0.1','as001');
/*!40000 ALTER TABLE `ApplicationServers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `BillableCalls`
--

DROP TABLE IF EXISTS `BillableCalls`;
/*!50001 DROP VIEW IF EXISTS `BillableCalls`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `BillableCalls` (
  `id` tinyint NOT NULL,
  `proxy` tinyint NOT NULL,
  `start_time_utc` tinyint NOT NULL,
  `end_time_utc` tinyint NOT NULL,
  `start_time` tinyint NOT NULL,
  `end_time` tinyint NOT NULL,
  `duration` tinyint NOT NULL,
  `caller` tinyint NOT NULL,
  `callee` tinyint NOT NULL,
  `referee` tinyint NOT NULL,
  `referrer` tinyint NOT NULL,
  `companyId` tinyint NOT NULL,
  `brandId` tinyint NOT NULL,
  `asIden` tinyint NOT NULL,
  `asAddress` tinyint NOT NULL,
  `callid` tinyint NOT NULL,
  `callidHash` tinyint NOT NULL,
  `xcallid` tinyint NOT NULL,
  `parsed` tinyint NOT NULL,
  `diversion` tinyint NOT NULL,
  `peeringContractId` tinyint NOT NULL,
  `bounced` tinyint NOT NULL,
  `externallyRated` tinyint NOT NULL,
  `metered` tinyint NOT NULL,
  `meteringDate` tinyint NOT NULL,
  `pricingPlanId` tinyint NOT NULL,
  `pricingPlanName` tinyint NOT NULL,
  `targetPatternId` tinyint NOT NULL,
  `targetPatternName` tinyint NOT NULL,
  `price` tinyint NOT NULL,
  `pricingPlanDetails` tinyint NOT NULL,
  `invoiceId` tinyint NOT NULL,
  `direction` tinyint NOT NULL,
  `reMeteringDate` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `BrandOperators`
--

DROP TABLE IF EXISTS `BrandOperators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BrandOperators` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandId` int(10) unsigned NOT NULL,
  `username` varchar(65) NOT NULL,
  `pass` varchar(80) NOT NULL COMMENT '[password]',
  `email` varchar(100) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `timezoneId` int(10) unsigned DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `MainOperatorsUniqueBrandUsername` (`brandId`,`username`),
  KEY `brandId` (`brandId`),
  KEY `timezoneId` (`timezoneId`),
  CONSTRAINT `BrandOperators_ibfk_3` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `BrandOperators_ibfk_4` FOREIGN KEY (`timezoneId`) REFERENCES `Timezones` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BrandOperators`
--

LOCK TABLES `BrandOperators` WRITE;
/*!40000 ALTER TABLE `BrandOperators` DISABLE KEYS */;
/*!40000 ALTER TABLE `BrandOperators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BrandServices`
--

DROP TABLE IF EXISTS `BrandServices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BrandServices`
--

LOCK TABLES `BrandServices` WRITE;
/*!40000 ALTER TABLE `BrandServices` DISABLE KEYS */;
INSERT INTO `BrandServices` VALUES (1,1,1,'94'),(2,2,1,'95'),(3,3,1,'93'),(4,4,1,'00');
/*!40000 ALTER TABLE `BrandServices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BrandURLs`
--

DROP TABLE IF EXISTS `BrandURLs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BrandURLs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandId` int(10) unsigned NOT NULL,
  `url` varchar(255) NOT NULL,
  `klearTheme` varchar(200) DEFAULT '',
  `urlType` varchar(25) NOT NULL COMMENT '[enum:god|brand|admin|user]',
  `name` varchar(200) DEFAULT '',
  `logoFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO]',
  `logoMimeType` varchar(80) DEFAULT NULL,
  `logoBaseName` varchar(255) DEFAULT NULL,
  `userTheme` varchar(200) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `BrandURLs_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BrandURLs`
--

LOCK TABLES `BrandURLs` WRITE;
/*!40000 ALTER TABLE `BrandURLs` DISABLE KEYS */;
INSERT INTO `BrandURLs` VALUES (1,1,'https://example.com','redmond','god','Platform Administration Portal',NULL,NULL,NULL,'default');
/*!40000 ALTER TABLE `BrandURLs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Brands`
--

DROP TABLE IF EXISTS `Brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Brands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `nif` varchar(25) NOT NULL,
  `domain_users` varchar(190) DEFAULT NULL,
  `defaultTimezoneId` int(10) unsigned DEFAULT NULL,
  `logoFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO]',
  `logoMimeType` varchar(80) DEFAULT NULL,
  `logoBaseName` varchar(255) DEFAULT NULL,
  `postalAddress` varchar(255) NOT NULL,
  `postalCode` varchar(10) NOT NULL,
  `town` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `registryData` varchar(1024) DEFAULT NULL,
  `languageId` int(10) unsigned DEFAULT NULL,
  `FromName` varchar(255) DEFAULT NULL,
  `FromAddress` varchar(255) DEFAULT NULL,
  `recordingsLimitMB` int(10) DEFAULT NULL,
  `recordingsLimitEmail` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `defaultTimezoneId` (`defaultTimezoneId`),
  KEY `languageId` (`languageId`),
  CONSTRAINT `Brands_ibfk_2` FOREIGN KEY (`languageId`) REFERENCES `Languages` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Brands_ibfk_3` FOREIGN KEY (`defaultTimezoneId`) REFERENCES `Timezones` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Brands`
--

LOCK TABLES `Brands` WRITE;
/*!40000 ALTER TABLE `Brands` DISABLE KEYS */;
INSERT INTO `Brands` VALUES (1,'DemoBrand','1234567890','',145,NULL,NULL,NULL,'Demo Postal Address','12345','DemoTown','DemoProvince','DemoCountry','Demo Registry Data',1,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `Brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Calendars`
--

DROP TABLE IF EXISTS `Calendars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Calendars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameCompany` (`name`,`companyId`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `Calendars_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Calendars`
--

LOCK TABLES `Calendars` WRITE;
/*!40000 ALTER TABLE `Calendars` DISABLE KEYS */;
/*!40000 ALTER TABLE `Calendars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CallACL`
--

DROP TABLE IF EXISTS `CallACL`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CallACL` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `defaultPolicy` varchar(10) NOT NULL COMMENT '[enum:allow|deny]',
  PRIMARY KEY (`id`),
  UNIQUE KEY `companyId_2` (`companyId`,`name`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `CallAcl_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CallACL`
--

LOCK TABLES `CallACL` WRITE;
/*!40000 ALTER TABLE `CallACL` DISABLE KEYS */;
/*!40000 ALTER TABLE `CallACL` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CallACLPatterns`
--

DROP TABLE IF EXISTS `CallACLPatterns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CallACLPatterns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `regExp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameCompany` (`name`,`companyId`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `CallACLPatterns_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CallACLPatterns`
--

LOCK TABLES `CallACLPatterns` WRITE;
/*!40000 ALTER TABLE `CallACLPatterns` DISABLE KEYS */;
/*!40000 ALTER TABLE `CallACLPatterns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CallACLRelPatterns`
--

DROP TABLE IF EXISTS `CallACLRelPatterns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CallACLRelPatterns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CallACLId` int(10) unsigned NOT NULL,
  `CallACLPatternId` int(10) unsigned NOT NULL,
  `priority` smallint(6) NOT NULL,
  `policy` varchar(25) NOT NULL COMMENT '[enum:allow|deny]',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_callACLId_priority` (`CallACLId`,`priority`),
  KEY `CallACLId` (`CallACLId`),
  KEY `CallACLPatternId` (`CallACLPatternId`),
  CONSTRAINT `CallACLRelPatterns_ibfk_1` FOREIGN KEY (`CallACLId`) REFERENCES `CallACL` (`id`) ON DELETE CASCADE,
  CONSTRAINT `CallACLRelPatterns_ibfk_2` FOREIGN KEY (`CallACLPatternId`) REFERENCES `CallACLPatterns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CallACLRelPatterns`
--

LOCK TABLES `CallACLRelPatterns` WRITE;
/*!40000 ALTER TABLE `CallACLRelPatterns` DISABLE KEYS */;
/*!40000 ALTER TABLE `CallACLRelPatterns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CallForwardSettings`
--

DROP TABLE IF EXISTS `CallForwardSettings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CallForwardSettings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `userId` int(10) unsigned NOT NULL,
  `callTypeFilter` varchar(25) NOT NULL COMMENT '[enum:internal|external|both]',
  `callForwardType` varchar(25) NOT NULL COMMENT '[enum:inconditional|noAnswer|busy|userNotRegistered]',
  `targetType` varchar(25) NOT NULL COMMENT '[enum:number|extension|voicemail]',
  `numberValue` varchar(25) DEFAULT NULL,
  `extensionId` int(10) unsigned DEFAULT NULL,
  `voiceMailUserId` int(10) unsigned DEFAULT NULL,
  `noAnswerTimeout` smallint(4) NOT NULL DEFAULT '10',
  PRIMARY KEY (`id`),
  UNIQUE KEY `callFwTypeUser` (`callForwardType`,`userId`,`callTypeFilter`),
  KEY `userId` (`userId`),
  KEY `extensionId` (`extensionId`),
  KEY `voiceMailUserId` (`voiceMailUserId`),
  CONSTRAINT `CallForwardSettings_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `CallForwardSettings_ibfk_2` FOREIGN KEY (`extensionId`) REFERENCES `Extensions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `CallForwardSettings_ibfk_3` FOREIGN KEY (`voiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CallForwardSettings`
--

LOCK TABLES `CallForwardSettings` WRITE;
/*!40000 ALTER TABLE `CallForwardSettings` DISABLE KEYS */;
/*!40000 ALTER TABLE `CallForwardSettings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ChangeHistory`
--

DROP TABLE IF EXISTS `ChangeHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ChangeHistory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `action` varchar(15) NOT NULL,
  `table` varchar(50) NOT NULL,
  `objid` int(10) unsigned NOT NULL,
  `field` varchar(50) NOT NULL,
  `old_value` varchar(250) DEFAULT NULL,
  `new_value` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ChangeHistory`
--

LOCK TABLES `ChangeHistory` WRITE;
/*!40000 ALTER TABLE `ChangeHistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `ChangeHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Companies`
--

DROP TABLE IF EXISTS `Companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandId` int(10) unsigned NOT NULL,
  `type` varchar(25) NOT NULL DEFAULT 'vpbx' COMMENT '[enum:vpbx|retail]',
  `name` varchar(80) NOT NULL,
  `domain_users` varchar(190) DEFAULT NULL,
  `nif` varchar(25) NOT NULL,
  `defaultTimezoneId` int(10) unsigned DEFAULT NULL,
  `distributeMethod` varchar(25) NOT NULL DEFAULT 'hash' COMMENT '[enum:static|rr|hash]',
  `applicationServerId` int(10) unsigned DEFAULT NULL,
  `externalMaxCalls` int(10) unsigned NOT NULL DEFAULT '0',
  `postalAddress` varchar(255) NOT NULL,
  `postalCode` varchar(10) NOT NULL,
  `town` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `outbound_prefix` varchar(255) DEFAULT NULL,
  `countryId` int(10) unsigned DEFAULT NULL,
  `languageId` int(10) unsigned DEFAULT NULL,
  `mediaRelaySetsId` int(10) unsigned DEFAULT NULL,
  `ipFilter` tinyint(1) DEFAULT '1',
  `onDemandRecord` tinyint(1) DEFAULT '0',
  `onDemandRecordCode` varchar(3) DEFAULT NULL,
  `areaCode` varchar(10) DEFAULT NULL,
  `externallyExtraOpts` text,
  `recordingsLimitMB` int(10) DEFAULT NULL,
  `recordingsLimitEmail` varchar(250) DEFAULT NULL,
  `outgoingDDIId` int(10) unsigned DEFAULT NULL,
  `outgoingDDIRuleId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameBrand` (`name`,`brandId`),
  UNIQUE KEY `domain_unique` (`domain_users`),
  KEY `brandId` (`brandId`),
  KEY `defaultTimezoneId` (`defaultTimezoneId`),
  KEY `applicationServerId` (`applicationServerId`),
  KEY `countryId` (`countryId`),
  KEY `languageId` (`languageId`),
  KEY `mediaRelaySetsId` (`mediaRelaySetsId`),
  KEY `outgoingDDIId` (`outgoingDDIId`),
  KEY `outgoingDDIRuleId` (`outgoingDDIRuleId`),
  CONSTRAINT `Companies_ibfk_10` FOREIGN KEY (`languageId`) REFERENCES `Languages` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Companies_ibfk_11` FOREIGN KEY (`mediaRelaySetsId`) REFERENCES `MediaRelaySets` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `Companies_ibfk_12` FOREIGN KEY (`defaultTimezoneId`) REFERENCES `Timezones` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Companies_ibfk_13` FOREIGN KEY (`outgoingDDIId`) REFERENCES `DDIs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Companies_ibfk_14` FOREIGN KEY (`outgoingDDIRuleId`) REFERENCES `OutgoingDDIRules` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Companies_ibfk_4` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `Companies_ibfk_5` FOREIGN KEY (`applicationServerId`) REFERENCES `ApplicationServers` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Companies_ibfk_9` FOREIGN KEY (`countryId`) REFERENCES `Countries` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Companies`
--

LOCK TABLES `Companies` WRITE;
/*!40000 ALTER TABLE `Companies` DISABLE KEYS */;
INSERT INTO `Companies` VALUES (1,1,'vpbx','DemoCompany','127.0.0.1','12345678A',145,'hash',NULL,0,'Company Address','54321','Company Town','Company Province','Company Country','',70,1,0,0,0,'',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `Companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CompanyAdmins`
--

DROP TABLE IF EXISTS `CompanyAdmins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CompanyAdmins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `username` varchar(65) NOT NULL,
  `pass` varchar(80) NOT NULL COMMENT '[password]',
  `email` varchar(100) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `timezoneId` int(10) unsigned DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  KEY `timezoneId` (`timezoneId`),
  CONSTRAINT `CompanyAdmins_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `CompanyAdmins_ibfk_2` FOREIGN KEY (`timezoneId`) REFERENCES `Timezones` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CompanyAdmins`
--

LOCK TABLES `CompanyAdmins` WRITE;
/*!40000 ALTER TABLE `CompanyAdmins` DISABLE KEYS */;
/*!40000 ALTER TABLE `CompanyAdmins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CompanyServices`
--

DROP TABLE IF EXISTS `CompanyServices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CompanyServices`
--

LOCK TABLES `CompanyServices` WRITE;
/*!40000 ALTER TABLE `CompanyServices` DISABLE KEYS */;
INSERT INTO `CompanyServices` VALUES (1,1,1,'94'),(2,2,1,'95'),(3,3,1,'93'),(4,4,1,'00');
/*!40000 ALTER TABLE `CompanyServices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ConditionalRoutes`
--

DROP TABLE IF EXISTS `ConditionalRoutes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ConditionalRoutes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `locutionId` int(10) unsigned DEFAULT NULL,
  `routeType` varchar(25) DEFAULT NULL COMMENT '[enum:user|number|IVRCommon|IVRCustom|huntGroup|voicemail|friend|queue|conferenceRoom|extension]',
  `IVRCommonId` int(10) unsigned DEFAULT NULL,
  `IVRCustomId` int(10) unsigned DEFAULT NULL,
  `huntGroupId` int(10) unsigned DEFAULT NULL,
  `voiceMailUserId` int(10) unsigned DEFAULT NULL,
  `userId` int(10) unsigned DEFAULT NULL,
  `numberValue` varchar(25) DEFAULT NULL,
  `friendValue` varchar(25) DEFAULT NULL,
  `queueId` int(10) unsigned DEFAULT NULL,
  `conferenceRoomId` int(10) unsigned DEFAULT NULL,
  `extensionId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  KEY `locutionId` (`locutionId`),
  KEY `IVRCommonId` (`IVRCommonId`),
  KEY `IVRCustomId` (`IVRCustomId`),
  KEY `huntGroupId` (`huntGroupId`),
  KEY `voiceMailUserId` (`voiceMailUserId`),
  KEY `userId` (`userId`),
  KEY `queueId` (`queueId`),
  KEY `conferenceRoomId` (`conferenceRoomId`),
  KEY `extensionId` (`extensionId`),
  CONSTRAINT `ConditionalRoutes_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ConditionalRoutes_ibfk_10` FOREIGN KEY (`extensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutes_ibfk_2` FOREIGN KEY (`IVRCommonId`) REFERENCES `IVRCommon` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutes_ibfk_3` FOREIGN KEY (`IVRCustomId`) REFERENCES `IVRCustom` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutes_ibfk_4` FOREIGN KEY (`huntGroupId`) REFERENCES `HuntGroups` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutes_ibfk_5` FOREIGN KEY (`voiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `ConditionalRoutes_ibfk_6` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutes_ibfk_7` FOREIGN KEY (`queueId`) REFERENCES `Queues` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutes_ibfk_8` FOREIGN KEY (`locutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutes_ibfk_9` FOREIGN KEY (`conferenceRoomId`) REFERENCES `ConferenceRooms` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ConditionalRoutes`
--

LOCK TABLES `ConditionalRoutes` WRITE;
/*!40000 ALTER TABLE `ConditionalRoutes` DISABLE KEYS */;
/*!40000 ALTER TABLE `ConditionalRoutes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ConditionalRoutesConditions`
--

DROP TABLE IF EXISTS `ConditionalRoutesConditions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ConditionalRoutesConditions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conditionalRouteId` int(10) unsigned NOT NULL,
  `priority` smallint(6) NOT NULL DEFAULT '1',
  `locutionId` int(10) unsigned DEFAULT NULL,
  `routeType` varchar(25) DEFAULT NULL COMMENT '[enum:user|number|IVRCommon|IVRCustom|huntGroup|voicemail|friend|queue|conferenceRoom|extension]',
  `IVRCommonId` int(10) unsigned DEFAULT NULL,
  `IVRCustomId` int(10) unsigned DEFAULT NULL,
  `huntGroupId` int(10) unsigned DEFAULT NULL,
  `voiceMailUserId` int(10) unsigned DEFAULT NULL,
  `userId` int(10) unsigned DEFAULT NULL,
  `numberValue` varchar(25) DEFAULT NULL,
  `friendValue` varchar(25) DEFAULT NULL,
  `queueId` int(10) unsigned DEFAULT NULL,
  `conferenceRoomId` int(10) unsigned DEFAULT NULL,
  `extensionId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `conditionalRouteId` (`conditionalRouteId`,`priority`),
  KEY `locutionId` (`locutionId`),
  KEY `IVRCommonId` (`IVRCommonId`),
  KEY `IVRCustomId` (`IVRCustomId`),
  KEY `huntGroupId` (`huntGroupId`),
  KEY `voiceMailUserId` (`voiceMailUserId`),
  KEY `userId` (`userId`),
  KEY `queueId` (`queueId`),
  KEY `conferenceRoomId` (`conferenceRoomId`),
  KEY `extensionId` (`extensionId`),
  CONSTRAINT `ConditionalRoutesConditions_ibfk_1` FOREIGN KEY (`conditionalRouteId`) REFERENCES `ConditionalRoutes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_10` FOREIGN KEY (`extensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_2` FOREIGN KEY (`IVRCommonId`) REFERENCES `IVRCommon` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_3` FOREIGN KEY (`IVRCustomId`) REFERENCES `IVRCustom` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_4` FOREIGN KEY (`huntGroupId`) REFERENCES `HuntGroups` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_5` FOREIGN KEY (`voiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_6` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_7` FOREIGN KEY (`queueId`) REFERENCES `Queues` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_8` FOREIGN KEY (`locutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ConditionalRoutesConditions_ibfk_9` FOREIGN KEY (`conferenceRoomId`) REFERENCES `ConferenceRooms` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ConditionalRoutesConditions`
--

LOCK TABLES `ConditionalRoutesConditions` WRITE;
/*!40000 ALTER TABLE `ConditionalRoutesConditions` DISABLE KEYS */;
/*!40000 ALTER TABLE `ConditionalRoutesConditions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ConditionalRoutesConditionsRelCalendars`
--

DROP TABLE IF EXISTS `ConditionalRoutesConditionsRelCalendars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ConditionalRoutesConditionsRelCalendars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conditionId` int(10) unsigned NOT NULL,
  `calendarId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `conditionId` (`conditionId`),
  KEY `calendarId` (`calendarId`),
  CONSTRAINT `ConditionalRoutesConditionsRelCalendars_ibfk_1` FOREIGN KEY (`conditionId`) REFERENCES `ConditionalRoutesConditions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ConditionalRoutesConditionsRelCalendars_ibfk_2` FOREIGN KEY (`calendarId`) REFERENCES `Calendars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ConditionalRoutesConditionsRelCalendars`
--

LOCK TABLES `ConditionalRoutesConditionsRelCalendars` WRITE;
/*!40000 ALTER TABLE `ConditionalRoutesConditionsRelCalendars` DISABLE KEYS */;
/*!40000 ALTER TABLE `ConditionalRoutesConditionsRelCalendars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ConditionalRoutesConditionsRelMatchLists`
--

DROP TABLE IF EXISTS `ConditionalRoutesConditionsRelMatchLists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ConditionalRoutesConditionsRelMatchLists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conditionId` int(10) unsigned NOT NULL,
  `matchListId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `conditionId` (`conditionId`),
  KEY `matchListId` (`matchListId`),
  CONSTRAINT `ConditionalRoutesConditionsRelMatchLists_ibfk_1` FOREIGN KEY (`conditionId`) REFERENCES `ConditionalRoutesConditions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ConditionalRoutesConditionsRelMatchLists_ibfk_2` FOREIGN KEY (`matchListId`) REFERENCES `MatchLists` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ConditionalRoutesConditionsRelMatchLists`
--

LOCK TABLES `ConditionalRoutesConditionsRelMatchLists` WRITE;
/*!40000 ALTER TABLE `ConditionalRoutesConditionsRelMatchLists` DISABLE KEYS */;
/*!40000 ALTER TABLE `ConditionalRoutesConditionsRelMatchLists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ConditionalRoutesConditionsRelSchedules`
--

DROP TABLE IF EXISTS `ConditionalRoutesConditionsRelSchedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ConditionalRoutesConditionsRelSchedules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conditionId` int(10) unsigned NOT NULL,
  `scheduleId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `conditionId` (`conditionId`),
  KEY `scheduleId` (`scheduleId`),
  CONSTRAINT `ConditionalRoutesConditionsRelSchedules_ibfk_1` FOREIGN KEY (`conditionId`) REFERENCES `ConditionalRoutesConditions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ConditionalRoutesConditionsRelSchedules_ibfk_2` FOREIGN KEY (`scheduleId`) REFERENCES `Schedules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ConditionalRoutesConditionsRelSchedules`
--

LOCK TABLES `ConditionalRoutesConditionsRelSchedules` WRITE;
/*!40000 ALTER TABLE `ConditionalRoutesConditionsRelSchedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `ConditionalRoutesConditionsRelSchedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ConferenceRooms`
--

DROP TABLE IF EXISTS `ConferenceRooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ConferenceRooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `pinProtected` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pinCode` varchar(6) DEFAULT NULL,
  `maxMembers` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ConferenceRoomsUniqueCompanyname` (`companyId`,`name`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `ConferenceRooms_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ConferenceRooms`
--

LOCK TABLES `ConferenceRooms` WRITE;
/*!40000 ALTER TABLE `ConferenceRooms` DISABLE KEYS */;
/*!40000 ALTER TABLE `ConferenceRooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Countries`
--

DROP TABLE IF EXISTS `Countries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Countries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(100) DEFAULT NULL COMMENT '[ml]',
  `name_en` varchar(100) DEFAULT NULL,
  `name_es` varchar(100) DEFAULT NULL,
  `zone` varchar(55) DEFAULT NULL COMMENT '[ml]',
  `zone_en` varchar(55) NOT NULL DEFAULT '',
  `zone_es` varchar(55) NOT NULL DEFAULT '',
  `calling_code` int(11) unsigned DEFAULT NULL,
  `intCode` varchar(5) DEFAULT NULL,
  `e164Pattern` varchar(250) DEFAULT NULL,
  `nationalCC` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `languageCode` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=252 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Countries`
--

LOCK TABLES `Countries` WRITE;
/*!40000 ALTER TABLE `Countries` DISABLE KEYS */;
INSERT INTO `Countries` VALUES (1,'AD',NULL,'Andorra','Andorra',NULL,'Europe','Europa',376,'00','/^(\\+|00)?(?<cc>376)?(?<sn>\\d{9})$/',0),(2,'AE',NULL,'United Arab Emirates','Emiratos Árabes Unidos',NULL,'Asia','Asia',971,'00','/^(\\+|00)?(?<cc>971)?(?<sn>\\d{9})$/',0),(3,'AF',NULL,'Afghanistan','Afganistán',NULL,'Asia','Asia',93,'00','/^(\\+|00)?(?<cc>93)?(?<sn>\\d{9})$/',0),(4,'AG',NULL,'Antigua and Barbuda','Antigua y Barbuda',NULL,'North america','América del norte',1268,'00','/^(\\+|00)?(?<cc>1268)?(?<sn>\\d{9})$/',0),(5,'AI',NULL,'Anguilla','Anguila',NULL,'North america','América del norte',1264,'00','/^(\\+|00)?(?<cc>1264)?(?<sn>\\d{9})$/',0),(6,'AL',NULL,'Albania','Albania',NULL,'Europe','Europa',355,'00','/^(\\+|00)?(?<cc>355)?(?<sn>\\d{9})$/',0),(7,'AM',NULL,'Armenia','Armenia',NULL,'Asia','Asia',374,'00','/^(\\+|00)?(?<cc>374)?(?<sn>\\d{9})$/',0),(8,'AO',NULL,'Angola','Angola',NULL,'Africa','África',244,'00','/^(\\+|00)?(?<cc>244)?(?<sn>\\d{9})$/',0),(9,'AQ',NULL,'Antarctica','Antártida',NULL,'Antarctica','Antártida',672,'00','/^(\\+|00)?(?<cc>672)?(?<sn>\\d{9})$/',0),(10,'AR',NULL,'Argentina','Argentina',NULL,'South america','América del sur',54,'00','/^(\\+|00)?(?<cc>54)?(?<sn>\\d{9})$/',0),(11,'AS',NULL,'American Samoa','Samoa Americana',NULL,'Oceania','Oceanía',1684,'00','/^(\\+|00)?(?<cc>1684)?(?<sn>\\d{9})$/',0),(12,'AT',NULL,'Austria','Austria',NULL,'Europe','Europa',43,'00','/^(\\+|00)?(?<cc>43)?(?<sn>\\d{9})$/',0),(13,'AU',NULL,'Australia','Australia',NULL,'Oceania','Oceanía',61,'0011','/^(\\+|0011)?(?<cc>61)?(?<sn>\\d{9})$/',0),(14,'AW',NULL,'Aruba','Aruba',NULL,'North america','América del norte',297,'00','/^(\\+|00)?(?<cc>297)?(?<sn>\\d{9})$/',0),(15,'AX',NULL,'Åland Islands','Islas de Åland',NULL,'Europe','Europa',358,'00','/^(\\+|00)?(?<cc>358)?(?<sn>\\d{9})$/',0),(16,'AZ',NULL,'Azerbaijan','Azerbayán',NULL,'Asia','Asia',994,'00','/^(\\+|00)?(?<cc>994)?(?<sn>\\d{9})$/',0),(17,'BA',NULL,'Bosnia and Herzegovina','Bosnia y Herzegovina',NULL,'Europe','Europa',387,'00','/^(\\+|00)?(?<cc>387)?(?<sn>\\d{9})$/',0),(18,'BB',NULL,'Barbados','Barbados',NULL,'North america','América del norte',1246,'00','/^(\\+|00)?(?<cc>1246)?(?<sn>\\d{9})$/',0),(19,'BD',NULL,'Bangladesh','Bangladesh',NULL,'Asia','Asia',880,'00','/^(\\+|00)?(?<cc>880)?(?<sn>\\d{9})$/',0),(20,'BE',NULL,'Belgium','Bélgica',NULL,'Europe','Europa',32,'00','/^(\\+|00)?(?<cc>32)?(?<sn>\\d{9})$/',0),(21,'BF',NULL,'Burkina Faso','Burkina Faso',NULL,'Africa','África',226,'00','/^(\\+|00)?(?<cc>226)?(?<sn>\\d{9})$/',0),(22,'BG',NULL,'Bulgaria','Bulgaria',NULL,'Europe','Europa',359,'00','/^(\\+|00)?(?<cc>359)?(?<sn>\\d{9})$/',0),(23,'BH',NULL,'Bahrain','Bahrein',NULL,'Asia','Asia',973,'00','/^(\\+|00)?(?<cc>973)?(?<sn>\\d{9})$/',0),(24,'BI',NULL,'Burundi','Burundi',NULL,'Africa','África',257,'00','/^(\\+|00)?(?<cc>257)?(?<sn>\\d{9})$/',0),(25,'BJ',NULL,'Benin','Benín',NULL,'Africa','África',229,'00','/^(\\+|00)?(?<cc>229)?(?<sn>\\d{9})$/',0),(26,'BL',NULL,'Saint Barthélemy','San Bartolomé',NULL,'North america','América del norte',590,'00','/^(\\+|00)?(?<cc>590)?(?<sn>\\d{9})$/',0),(27,'BM',NULL,'Bermuda Islands','Islas Bermudas',NULL,'North america','América del norte',1441,'00','/^(\\+|00)?(?<cc>1441)?(?<sn>\\d{9})$/',0),(28,'BN',NULL,'Brunei','Brunéi',NULL,'Asia','Asia',673,'00','/^(\\+|00)?(?<cc>673)?(?<sn>\\d{9})$/',0),(29,'BO',NULL,'Bolivia','Bolivia',NULL,'South america','América del sur',591,'00','/^(\\+|00)?(?<cc>591)?(?<sn>\\d{9})$/',0),(30,'BQ',NULL,'Bonaire','Bonaire',NULL,'South america','América del sur',599,'00','/^(\\+|00)?(?<cc>599)?(?<sn>\\d{9})$/',0),(31,'BR',NULL,'Brazil','Brasil',NULL,'South america','América del sur',55,'00','/^(\\+|00)?(?<cc>55)?(?<sn>\\d{9})$/',0),(32,'BS',NULL,'Bahamas','Bahamas',NULL,'North america','América del norte',1242,'00','/^(\\+|00)?(?<cc>1242)?(?<sn>\\d{9})$/',0),(33,'BT',NULL,'Bhutan','Bhután',NULL,'Asia','Asia',975,'00','/^(\\+|00)?(?<cc>975)?(?<sn>\\d{9})$/',0),(34,'BV',NULL,'Bouvet Island','Isla Bouvet',NULL,'Antarctica','Antártida',47,'00','/^(\\+|00)?(?<cc>47)?(?<sn>\\d{9})$/',0),(35,'BW',NULL,'Botswana','Botsuana',NULL,'Africa','África',267,'00','/^(\\+|00)?(?<cc>267)?(?<sn>\\d{9})$/',0),(36,'BY',NULL,'Belarus','Bielorrusia',NULL,'Europe','Europa',375,'00','/^(\\+|00)?(?<cc>375)?(?<sn>\\d{9})$/',0),(37,'BZ',NULL,'Belize','Belice',NULL,'North america','América del norte',501,'00','/^(\\+|00)?(?<cc>501)?(?<sn>\\d{9})$/',0),(38,'CA',NULL,'Canada','Canadá',NULL,'North america','América del norte',1,'011','/^(\\+|011)?(?<cc>1)?(?<sn>\\d{9})$/',0),(39,'CC',NULL,'Cocos (Keeling) Islands','Islas Cocos (Keeling)',NULL,'Asia','Asia',61,'00','/^(\\+|00)?(?<cc>61)?(?<sn>\\d{9})$/',0),(40,'CD',NULL,'Congo','Congo',NULL,'Africa','África',243,'00','/^(\\+|00)?(?<cc>243)?(?<sn>\\d{9})$/',0),(41,'CF',NULL,'Central African Republic','República Centroafricana',NULL,'Africa','África',236,'00','/^(\\+|00)?(?<cc>236)?(?<sn>\\d{9})$/',0),(42,'CG',NULL,'Congo','Congo',NULL,'Africa','África',242,'00','/^(\\+|00)?(?<cc>242)?(?<sn>\\d{9})$/',0),(43,'CH',NULL,'Switzerland','Suiza',NULL,'Europe','Europa',41,'00','/^(\\+|00)?(?<cc>41)?(?<sn>\\d{9})$/',0),(44,'CI',NULL,'Ivory Coast','Costa de Marfil',NULL,'Africa','África',225,'00','/^(\\+|00)?(?<cc>225)?(?<sn>\\d{9})$/',0),(45,'CK',NULL,'Cook Islands','Islas Cook',NULL,'Oceania','Oceanía',682,'00','/^(\\+|00)?(?<cc>682)?(?<sn>\\d{9})$/',0),(46,'CL',NULL,'Chile','Chile',NULL,'South america','América del sur',56,'00','/^(\\+|1[0-9][0-9]0|00)?(?<cc>56)?(?<sn>\\d{9})$/',0),(47,'CM',NULL,'Cameroon','Camerún',NULL,'Africa','África',237,'00','/^(\\+|00)?(?<cc>237)?(?<sn>\\d{9})$/',0),(48,'CN',NULL,'China','China',NULL,'Asia','Asia',86,'00','/^(\\+|00)?(?<cc>86)?(?<sn>\\d{9})$/',0),(49,'CO',NULL,'Colombia','Colombia',NULL,'South america','América del sur',57,'00','/^(\\+|00)?(?<cc>57)?(?<sn>\\d{9})$/',0),(50,'CR',NULL,'Costa Rica','Costa Rica',NULL,'North america','América del norte',506,'00','/^(\\+|00)?(?<cc>506)?(?<sn>\\d{9})$/',0),(51,'CU',NULL,'Cuba','Cuba',NULL,'North america','América del norte',53,'00','/^(\\+|00)?(?<cc>53)?(?<sn>\\d{9})$/',0),(52,'CV',NULL,'Cape Verde','Cabo Verde',NULL,'Africa','África',238,'00','/^(\\+|00)?(?<cc>238)?(?<sn>\\d{9})$/',0),(53,'CW',NULL,'Curaçao','Curaçao',NULL,'South america','América del sur',599,'00','/^(\\+|00)?(?<cc>599)?(?<sn>\\d{9})$/',0),(54,'CX',NULL,'Christmas Island','Isla de Navidad',NULL,'Asia','Asia',61,'00','/^(\\+|00)?(?<cc>61)?(?<sn>\\d{9})$/',0),(55,'CY',NULL,'Cyprus','Chipre',NULL,'Asia','Asia',357,'00','/^(\\+|00)?(?<cc>357)?(?<sn>\\d{9})$/',0),(56,'CZ',NULL,'Czech Republic','República Checa',NULL,'Europe','Europa',420,'00','/^(\\+|00)?(?<cc>420)?(?<sn>\\d{9})$/',0),(57,'DE',NULL,'Germany','Alemania',NULL,'Europe','Europa',49,'00','/^(\\+|00)?(?<cc>49)?(?<sn>\\d{9})$/',0),(58,'DJ',NULL,'Djibouti','Yibuti',NULL,'Africa','África',253,'00','/^(\\+|00)?(?<cc>253)?(?<sn>\\d{9})$/',0),(59,'DK',NULL,'Denmark','Dinamarca',NULL,'Europe','Europa',45,'00','/^(\\+|00)?(?<cc>45)?(?<sn>\\d{9})$/',0),(60,'DM',NULL,'Dominica','Dominica',NULL,'North america','América del norte',1767,'00','/^(\\+|00)?(?<cc>1767)?(?<sn>\\d{9})$/',0),(61,'DO',NULL,'Dominican Republic','República Dominicana',NULL,'North america','América del norte',1809,'00','/^(\\+|00)?(?<cc>1809)?(?<sn>\\d{9})$/',0),(64,'DZ',NULL,'Algeria','Algeria',NULL,'Africa','África',213,'00','/^(\\+|00)?(?<cc>213)?(?<sn>\\d{9})$/',0),(65,'EC',NULL,'Ecuador','Ecuador',NULL,'South america','América del sur',593,'00','/^(\\+|00)?(?<cc>593)?(?<sn>\\d{9})$/',0),(66,'EE',NULL,'Estonia','Estonia',NULL,'Europe','Europa',372,'00','/^(\\+|00)?(?<cc>372)?(?<sn>\\d{9})$/',0),(67,'EG',NULL,'Egypt','Egipto',NULL,'Africa','África',20,'00','/^(\\+|00)?(?<cc>20)?(?<sn>\\d{9})$/',0),(68,'EH',NULL,'Western Sahara','Sahara Occidental',NULL,'Africa','África',212,'00','/^(\\+|00)?(?<cc>212)?(?<sn>\\d{9})$/',0),(69,'ER',NULL,'Eritrea','Eritrea',NULL,'Africa','África',291,'00','/^(\\+|00)?(?<cc>291)?(?<sn>\\d{9})$/',0),(70,'ES',NULL,'Spain','España',NULL,'Europe','Europa',34,'00','/^(\\+|00)?(?<cc>34)?(?<sn>\\d{9})$/',0),(71,'ET',NULL,'Ethiopia','Etiopía',NULL,'Africa','África',251,'00','/^(\\+|00)?(?<cc>251)?(?<sn>\\d{9})$/',0),(72,'FI',NULL,'Finland','Finlandia',NULL,'Europe','Europa',358,'00','/^(\\+|00)?(?<cc>358)?(?<sn>\\d{9})$/',0),(73,'FJ',NULL,'Fiji','Fiyi',NULL,'Oceania','Oceanía',679,'00','/^(\\+|00)?(?<cc>679)?(?<sn>\\d{9})$/',0),(74,'FK',NULL,'Falkland Islands (Malvinas)','Islas Malvinas',NULL,'South america','América del sur',500,'00','/^(\\+|00)?(?<cc>500)?(?<sn>\\d{9})$/',0),(75,'FM',NULL,'Estados Federados de','Micronesia',NULL,'Oceania','Oceanía',691,'00','/^(\\+|00)?(?<cc>691)?(?<sn>\\d{9})$/',0),(76,'FO',NULL,'Faroe Islands','Islas Feroe',NULL,'Europe','Europa',298,'00','/^(\\+|00)?(?<cc>298)?(?<sn>\\d{9})$/',0),(77,'FR',NULL,'France','Francia',NULL,'Europe','Europa',33,'00','/^(\\+|00)?(?<cc>33)?(?<sn>\\d{9})$/',0),(78,'GA',NULL,'Gabon','Gabón',NULL,'Africa','África',241,'00','/^(\\+|00)?(?<cc>241)?(?<sn>\\d{9})$/',0),(79,'GB',NULL,'United Kingdom','Reino Unido',NULL,'Europe','Europa',44,'00','/^(\\+|00)?(?<cc>44)?(?<sn>\\d{9})$/',0),(80,'GD',NULL,'Grenada','Granada',NULL,'North america','América del norte',1473,'00','/^(\\+|00)?(?<cc>1473)?(?<sn>\\d{9})$/',0),(81,'GE',NULL,'Georgia','Georgia',NULL,'Asia','Asia',995,'00','/^(\\+|00)?(?<cc>995)?(?<sn>\\d{9})$/',0),(82,'GF',NULL,'French Guiana','Guayana Francesa',NULL,'South america','América del sur',594,'00','/^(\\+|00)?(?<cc>594)?(?<sn>\\d{9})$/',0),(83,'GG',NULL,'Guernsey','Guernsey',NULL,'Europe','Europa',44,'00','/^(\\+|00)?(?<cc>44)?(?<sn>\\d{9})$/',0),(84,'GH',NULL,'Ghana','Ghana',NULL,'Africa','África',233,'00','/^(\\+|00)?(?<cc>233)?(?<sn>\\d{9})$/',0),(85,'GI',NULL,'Gibraltar','Gibraltar',NULL,'Europe','Europa',350,'00','/^(\\+|00)?(?<cc>350)?(?<sn>\\d{9})$/',0),(86,'GL',NULL,'Greenland','Groenlandia',NULL,'North america','América del norte',299,'00','/^(\\+|00)?(?<cc>299)?(?<sn>\\d{9})$/',0),(87,'GM',NULL,'Gambia','Gambia',NULL,'Africa','África',220,'00','/^(\\+|00)?(?<cc>220)?(?<sn>\\d{9})$/',0),(88,'GN',NULL,'Guinea','Guinea',NULL,'Africa','África',224,'00','/^(\\+|00)?(?<cc>224)?(?<sn>\\d{9})$/',0),(89,'GP',NULL,'Guadeloupe','Guadalupe',NULL,'North america','América del norte',590,'00','/^(\\+|00)?(?<cc>590)?(?<sn>\\d{9})$/',0),(90,'GQ',NULL,'Equatorial Guinea','Guinea Ecuatorial',NULL,'Africa','África',240,'00','/^(\\+|00)?(?<cc>240)?(?<sn>\\d{9})$/',0),(91,'GR',NULL,'Greece','Grecia',NULL,'Europe','Europa',30,'00','/^(\\+|00)?(?<cc>30)?(?<sn>\\d{9})$/',0),(92,'GS',NULL,'South Georgia and the South Sandwich Islands','Islas Georgias del Sur y Sandwich del Sur',NULL,'Antarctica','Antártida',500,'00','/^(\\+|00)?(?<cc>500)?(?<sn>\\d{9})$/',0),(93,'GT',NULL,'Guatemala','Guatemala',NULL,'North america','América del norte',502,'00','/^(\\+|00)?(?<cc>502)?(?<sn>\\d{9})$/',0),(94,'GU',NULL,'Guam','Guam',NULL,'Oceania','Oceanía',1671,'00','/^(\\+|00)?(?<cc>1671)?(?<sn>\\d{9})$/',0),(95,'GW',NULL,'Guinea-Bissau','Guinea-Bissau',NULL,'Africa','África',245,'00','/^(\\+|00)?(?<cc>245)?(?<sn>\\d{9})$/',0),(96,'GY',NULL,'Guyana','Guyana',NULL,'South america','América del sur',592,'00','/^(\\+|00)?(?<cc>592)?(?<sn>\\d{9})$/',0),(97,'HK',NULL,'Hong Kong','Hong kong',NULL,'Asia','Asia',852,'00','/^(\\+|00)?(?<cc>852)?(?<sn>\\d{9})$/',0),(98,'HM',NULL,'Heard Island and McDonald Islands','Islas Heard y McDonald',NULL,'Antarctica','Antártida',672,'00','/^(\\+|00)?(?<cc>672)?(?<sn>\\d{9})$/',0),(99,'HN',NULL,'Honduras','Honduras',NULL,'North america','América del norte',504,'00','/^(\\+|00)?(?<cc>504)?(?<sn>\\d{9})$/',0),(100,'HR',NULL,'Croatia','Croacia',NULL,'Europe','Europa',385,'00','/^(\\+|00)?(?<cc>385)?(?<sn>\\d{9})$/',0),(101,'HT',NULL,'Haiti','Haití',NULL,'North america','América del norte',509,'00','/^(\\+|00)?(?<cc>509)?(?<sn>\\d{9})$/',0),(102,'HU',NULL,'Hungary','Hungría',NULL,'Europe','Europa',36,'00','/^(\\+|00)?(?<cc>36)?(?<sn>\\d{9})$/',0),(103,'ID',NULL,'Indonesia','Indonesia',NULL,'Asia','Asia',62,'00','/^(\\+|00)?(?<cc>62)?(?<sn>\\d{9})$/',0),(104,'IE',NULL,'Ireland','Irlanda',NULL,'Europe','Europa',353,'00','/^(\\+|00)?(?<cc>353)?(?<sn>\\d{9})$/',0),(105,'IL',NULL,'Israel','Israel',NULL,'Asia','Asia',972,'00','/^(\\+|00)?(?<cc>972)?(?<sn>\\d{9})$/',0),(106,'IM',NULL,'Isle of Man','Isla de Man',NULL,'Europe','Europa',44,'00','/^(\\+|00)?(?<cc>44)?(?<sn>\\d{9})$/',0),(107,'IN',NULL,'India','India',NULL,'Asia','Asia',91,'00','/^(\\+|00)?(?<cc>91)?(?<sn>\\d{9})$/',0),(108,'IO',NULL,'British Indian Ocean Territory','Territorio Británico del Océano Índico',NULL,'Asia','Asia',246,'00','/^(\\+|00)?(?<cc>246)?(?<sn>\\d{9})$/',0),(109,'IQ',NULL,'Iraq','Irak',NULL,'Asia','Asia',964,'00','/^(\\+|00)?(?<cc>964)?(?<sn>\\d{9})$/',0),(110,'IR',NULL,'Iran','Irán',NULL,'Asia','Asia',98,'00','/^(\\+|00)?(?<cc>98)?(?<sn>\\d{9})$/',0),(111,'IS',NULL,'Iceland','Islandia',NULL,'Europe','Europa',354,'00','/^(\\+|00)?(?<cc>354)?(?<sn>\\d{9})$/',0),(112,'IT',NULL,'Italy','Italia',NULL,'Europe','Europa',39,'00','/^(\\+|00)?(?<cc>39)?(?<sn>\\d{9})$/',0),(113,'JE',NULL,'Jersey','Jersey',NULL,'Europe','Europa',44,'00','/^(\\+|00)?(?<cc>44)?(?<sn>\\d{9})$/',0),(114,'JM',NULL,'Jamaica','Jamaica',NULL,'North america','América del norte',1876,'00','/^(\\+|00)?(?<cc>1876)?(?<sn>\\d{9})$/',0),(115,'JO',NULL,'Jordan','Jordania',NULL,'Asia','Asia',962,'00','/^(\\+|00)?(?<cc>962)?(?<sn>\\d{9})$/',0),(116,'JP',NULL,'Japan','Japón',NULL,'Asia','Asia',81,'010','/^(\\+|010)?(?<cc>81)?(?<sn>\\d{9})$/',0),(117,'KE',NULL,'Kenya','Kenia',NULL,'Africa','África',254,'00','/^(\\+|00)?(?<cc>254)?(?<sn>\\d{9})$/',0),(118,'KG',NULL,'Kyrgyzstan','Kirgizstán',NULL,'Asia','Asia',996,'00','/^(\\+|00)?(?<cc>996)?(?<sn>\\d{9})$/',0),(119,'KH',NULL,'Cambodia','Camboya',NULL,'Asia','Asia',855,'00','/^(\\+|00)?(?<cc>855)?(?<sn>\\d{9})$/',0),(120,'KI',NULL,'Kiribati','Kiribati',NULL,'Oceania','Oceanía',686,'00','/^(\\+|00)?(?<cc>686)?(?<sn>\\d{9})$/',0),(121,'KM',NULL,'Comoros','Comoras',NULL,'Africa','África',269,'00','/^(\\+|00)?(?<cc>269)?(?<sn>\\d{9})$/',0),(122,'KN',NULL,'Saint Kitts and Nevis','San Cristóbal y Nieves',NULL,'North america','América del norte',1869,'00','/^(\\+|00)?(?<cc>1869)?(?<sn>\\d{9})$/',0),(123,'KP',NULL,'North Korea','Corea del Norte',NULL,'Asia','Asia',850,'00','/^(\\+|00)?(?<cc>850)?(?<sn>\\d{9})$/',0),(124,'KR',NULL,'South Korea','Corea del Sur',NULL,'Asia','Asia',82,'00','/^(\\+|00)?(?<cc>82)?(?<sn>\\d{9})$/',0),(125,'KW',NULL,'Kuwait','Kuwait',NULL,'Asia','Asia',965,'00','/^(\\+|00)?(?<cc>965)?(?<sn>\\d{9})$/',0),(126,'KY',NULL,'Cayman Islands','Islas Caimán',NULL,'North america','América del norte',1345,'00','/^(\\+|00)?(?<cc>1345)?(?<sn>\\d{9})$/',0),(127,'KZ',NULL,'Kazakhstan','Kazajistán',NULL,'Asia','Asia',7,'00','/^(\\+|00)?(?<cc>7)?(?<sn>\\d{9})$/',0),(128,'LA',NULL,'Laos','Laos',NULL,'Asia','Asia',856,'00','/^(\\+|00)?(?<cc>856)?(?<sn>\\d{9})$/',0),(129,'LB',NULL,'Lebanon','Líbano',NULL,'Asia','Asia',961,'00','/^(\\+|00)?(?<cc>961)?(?<sn>\\d{9})$/',0),(130,'LC',NULL,'Saint Lucia','Santa Lucía',NULL,'North america','América del norte',1758,'00','/^(\\+|00)?(?<cc>1758)?(?<sn>\\d{9})$/',0),(131,'LI',NULL,'Liechtenstein','Liechtenstein',NULL,'Europe','Europa',423,'00','/^(\\+|00)?(?<cc>423)?(?<sn>\\d{9})$/',0),(132,'LK',NULL,'Sri Lanka','Sri lanka',NULL,'Asia','Asia',94,'00','/^(\\+|00)?(?<cc>94)?(?<sn>\\d{9})$/',0),(133,'LR',NULL,'Liberia','Liberia',NULL,'Africa','África',231,'00','/^(\\+|00)?(?<cc>231)?(?<sn>\\d{9})$/',0),(134,'LS',NULL,'Lesotho','Lesoto',NULL,'Africa','África',266,'00','/^(\\+|00)?(?<cc>266)?(?<sn>\\d{9})$/',0),(135,'LT',NULL,'Lithuania','Lituania',NULL,'Europe','Europa',370,'00','/^(\\+|00)?(?<cc>370)?(?<sn>\\d{9})$/',0),(136,'LU',NULL,'Luxembourg','Luxemburgo',NULL,'Europe','Europa',352,'00','/^(\\+|00)?(?<cc>352)?(?<sn>\\d{9})$/',0),(137,'LV',NULL,'Latvia','Letonia',NULL,'Europe','Europa',371,'00','/^(\\+|00)?(?<cc>371)?(?<sn>\\d{9})$/',0),(138,'LY',NULL,'Libya','Libia',NULL,'Africa','África',218,'00','/^(\\+|00)?(?<cc>218)?(?<sn>\\d{9})$/',0),(139,'MA',NULL,'Morocco','Marruecos',NULL,'Africa','África',212,'00','/^(\\+|00)?(?<cc>212)?(?<sn>\\d{9})$/',0),(140,'MC',NULL,'Monaco','Mónaco',NULL,'Europe','Europa',377,'00','/^(\\+|00)?(?<cc>377)?(?<sn>\\d{9})$/',0),(141,'MD',NULL,'Moldova','Moldavia',NULL,'Europe','Europa',373,'00','/^(\\+|00)?(?<cc>373)?(?<sn>\\d{9})$/',0),(142,'ME',NULL,'Montenegro','Montenegro',NULL,'Europe','Europa',382,'00','/^(\\+|00)?(?<cc>382)?(?<sn>\\d{9})$/',0),(143,'MF',NULL,'Saint Martin (French part)','San Martín (Francia)',NULL,'North america','América del norte',1599,'00','/^(\\+|00)?(?<cc>1599)?(?<sn>\\d{9})$/',0),(144,'MG',NULL,'Madagascar','Madagascar',NULL,'Africa','África',261,'00','/^(\\+|00)?(?<cc>261)?(?<sn>\\d{9})$/',0),(145,'MH',NULL,'Marshall Islands','Islas Marshall',NULL,'Oceania','Oceanía',692,'00','/^(\\+|00)?(?<cc>692)?(?<sn>\\d{9})$/',0),(146,'MK',NULL,'Macedonia','Macedônia',NULL,'Europe','Europa',389,'00','/^(\\+|00)?(?<cc>389)?(?<sn>\\d{9})$/',0),(147,'ML',NULL,'Mali','Mali',NULL,'Africa','África',223,'00','/^(\\+|00)?(?<cc>223)?(?<sn>\\d{9})$/',0),(148,'MM',NULL,'Myanmar','Birmania',NULL,'Asia','Asia',95,'00','/^(\\+|00)?(?<cc>95)?(?<sn>\\d{9})$/',0),(149,'MN',NULL,'Mongolia','Mongolia',NULL,'Asia','Asia',976,'00','/^(\\+|00)?(?<cc>976)?(?<sn>\\d{9})$/',0),(150,'MO',NULL,'Macao','Macao',NULL,'Asia','Asia',853,'00','/^(\\+|00)?(?<cc>853)?(?<sn>\\d{9})$/',0),(151,'MP',NULL,'Northern Mariana Islands','Islas Marianas del Norte',NULL,'Oceania','Oceanía',1670,'00','/^(\\+|00)?(?<cc>1670)?(?<sn>\\d{9})$/',0),(152,'MQ',NULL,'Martinique','Martinica',NULL,'North america','América del norte',596,'00','/^(\\+|00)?(?<cc>596)?(?<sn>\\d{9})$/',0),(153,'MR',NULL,'Mauritania','Mauritania',NULL,'Africa','África',222,'00','/^(\\+|00)?(?<cc>222)?(?<sn>\\d{9})$/',0),(154,'MS',NULL,'Montserrat','Montserrat',NULL,'North america','América del norte',1664,'00','/^(\\+|00)?(?<cc>1664)?(?<sn>\\d{9})$/',0),(155,'MT',NULL,'Malta','Malta',NULL,'Europe','Europa',356,'00','/^(\\+|00)?(?<cc>356)?(?<sn>\\d{9})$/',0),(156,'MU',NULL,'Mauritius','Mauricio',NULL,'Africa','África',230,'00','/^(\\+|00)?(?<cc>230)?(?<sn>\\d{9})$/',0),(157,'MV',NULL,'Maldives','Islas Maldivas',NULL,'Asia','Asia',960,'00','/^(\\+|00)?(?<cc>960)?(?<sn>\\d{9})$/',0),(158,'MW',NULL,'Malawi','Malawi',NULL,'Africa','África',265,'00','/^(\\+|00)?(?<cc>265)?(?<sn>\\d{9})$/',0),(159,'MX',NULL,'Mexico','México',NULL,'North america','América del norte',52,'00','/^(\\+|00)?(?<cc>52)?(?<sn>\\d{9})$/',0),(160,'MY',NULL,'Malaysia','Malasia',NULL,'Asia','Asia',60,'00','/^(\\+|00)?(?<cc>60)?(?<sn>\\d{9})$/',0),(161,'MZ',NULL,'Mozambique','Mozambique',NULL,'Africa','África',258,'00','/^(\\+|00)?(?<cc>258)?(?<sn>\\d{9})$/',0),(162,'NA',NULL,'Namibia','Namibia',NULL,'Africa','África',264,'00','/^(\\+|00)?(?<cc>264)?(?<sn>\\d{9})$/',0),(163,'NC',NULL,'New Caledonia','Nueva Caledonia',NULL,'Oceania','Oceanía',687,'00','/^(\\+|00)?(?<cc>687)?(?<sn>\\d{9})$/',0),(164,'NE',NULL,'Niger','Niger',NULL,'Africa','África',227,'00','/^(\\+|00)?(?<cc>227)?(?<sn>\\d{9})$/',0),(165,'NF',NULL,'Norfolk Island','Isla Norfolk',NULL,'Oceania','Oceanía',672,'00','/^(\\+|00)?(?<cc>672)?(?<sn>\\d{9})$/',0),(166,'NG',NULL,'Nigeria','Nigeria',NULL,'Africa','África',234,'00','/^(\\+|00)?(?<cc>234)?(?<sn>\\d{9})$/',0),(167,'NI',NULL,'Nicaragua','Nicaragua',NULL,'North america','América del norte',505,'00','/^(\\+|00)?(?<cc>505)?(?<sn>\\d{9})$/',0),(168,'NL',NULL,'Netherlands','Países Bajos',NULL,'Europe','Europa',31,'00','/^(\\+|00)?(?<cc>31)?(?<sn>\\d{9})$/',0),(169,'NO',NULL,'Norway','Noruega',NULL,'Europe','Europa',47,'00','/^(\\+|00)?(?<cc>47)?(?<sn>\\d{9})$/',0),(170,'NP',NULL,'Nepal','Nepal',NULL,'Asia','Asia',977,'00','/^(\\+|00)?(?<cc>977)?(?<sn>\\d{9})$/',0),(171,'NR',NULL,'Nauru','Nauru',NULL,'Oceania','Oceanía',674,'00','/^(\\+|00)?(?<cc>674)?(?<sn>\\d{9})$/',0),(172,'NU',NULL,'Niue','Niue',NULL,'Oceania','Oceanía',683,'00','/^(\\+|00)?(?<cc>683)?(?<sn>\\d{9})$/',0),(173,'NZ',NULL,'New Zealand','Nueva Zelanda',NULL,'Oceania','Oceanía',64,'00','/^(\\+|00)?(?<cc>64)?(?<sn>\\d{9})$/',0),(174,'OM',NULL,'Oman','Omán',NULL,'Asia','Asia',968,'00','/^(\\+|00)?(?<cc>968)?(?<sn>\\d{9})$/',0),(175,'PA',NULL,'Panama','Panamá',NULL,'North america','América del norte',507,'00','/^(\\+|00)?(?<cc>507)?(?<sn>\\d{9})$/',0),(176,'PE',NULL,'Peru','Perú',NULL,'South america','América del sur',51,'00','/^(\\+|00)?(?<cc>51)?(?<sn>\\d{9})$/',0),(177,'PF',NULL,'French Polynesia','Polinesia Francesa',NULL,'Oceania','Oceanía',689,'00','/^(\\+|00)?(?<cc>689)?(?<sn>\\d{9})$/',0),(178,'PG',NULL,'Papua New Guinea','Papúa Nueva Guinea',NULL,'Oceania','Oceanía',675,'00','/^(\\+|00)?(?<cc>675)?(?<sn>\\d{9})$/',0),(179,'PH',NULL,'Philippines','Filipinas',NULL,'Asia','Asia',63,'00','/^(\\+|00)?(?<cc>63)?(?<sn>\\d{9})$/',0),(180,'PK',NULL,'Pakistan','Pakistán',NULL,'Asia','Asia',92,'00','/^(\\+|00)?(?<cc>92)?(?<sn>\\d{9})$/',0),(181,'PL',NULL,'Poland','Polonia',NULL,'Europe','Europa',48,'00','/^(\\+|00)?(?<cc>48)?(?<sn>\\d{9})$/',0),(182,'PM',NULL,'Saint Pierre and Miquelon','San Pedro y Miquelón',NULL,'North america','América del norte',508,'00','/^(\\+|00)?(?<cc>508)?(?<sn>\\d{9})$/',0),(183,'PN',NULL,'Pitcairn Islands','Islas Pitcairn',NULL,'Oceania','Oceanía',870,'00','/^(\\+|00)?(?<cc>870)?(?<sn>\\d{9})$/',0),(184,'PR',NULL,'Puerto Rico','Puerto Rico',NULL,'North america','América del norte',1,'00','/^(\\+|00)?(?<cc>1)?(?<sn>\\d{9})$/',0),(185,'PS',NULL,'Palestine','Palestina',NULL,'Asia','Asia',970,'00','/^(\\+|00)?(?<cc>970)?(?<sn>\\d{9})$/',0),(186,'PT',NULL,'Portugal','Portugal',NULL,'Europe','Europa',351,'00','/^(\\+|00)?(?<cc>351)?(?<sn>\\d{9})$/',0),(187,'PW',NULL,'Palau','Palau',NULL,'Oceania','Oceanía',680,'00','/^(\\+|00)?(?<cc>680)?(?<sn>\\d{9})$/',0),(188,'PY',NULL,'Paraguay','Paraguay',NULL,'South america','América del sur',595,'00','/^(\\+|00)?(?<cc>595)?(?<sn>\\d{9})$/',0),(189,'QA',NULL,'Qatar','Qatar',NULL,'Asia','Asia',974,'00','/^(\\+|00)?(?<cc>974)?(?<sn>\\d{9})$/',0),(190,'RE',NULL,'Réunion','Reunión',NULL,'Africa','África',262,'00','/^(\\+|00)?(?<cc>262)?(?<sn>\\d{9})$/',0),(191,'RO',NULL,'Romania','Rumanía',NULL,'Europe','Europa',40,'00','/^(\\+|00)?(?<cc>40)?(?<sn>\\d{9})$/',0),(192,'RS',NULL,'Serbia','Serbia',NULL,'Europe','Europa',381,'00','/^(\\+|00)?(?<cc>381)?(?<sn>\\d{9})$/',0),(193,'RU',NULL,'Russia','Rusia',NULL,'Europe','Europa',7,'00','/^(\\+|00)?(?<cc>7)?(?<sn>\\d{9})$/',0),(194,'RW',NULL,'Rwanda','Ruanda',NULL,'Africa','África',250,'00','/^(\\+|00)?(?<cc>250)?(?<sn>\\d{9})$/',0),(195,'SA',NULL,'Saudi Arabia','Arabia Saudita',NULL,'Asia','Asia',966,'00','/^(\\+|00)?(?<cc>966)?(?<sn>\\d{9})$/',0),(196,'SB',NULL,'Solomon Islands','Islas Salomón',NULL,'Oceania','Oceanía',677,'00','/^(\\+|00)?(?<cc>677)?(?<sn>\\d{9})$/',0),(197,'SC',NULL,'Seychelles','Seychelles',NULL,'Africa','África',248,'00','/^(\\+|00)?(?<cc>248)?(?<sn>\\d{9})$/',0),(198,'SD',NULL,'Sudan','Sudán',NULL,'Africa','África',249,'00','/^(\\+|00)?(?<cc>249)?(?<sn>\\d{9})$/',0),(199,'SE',NULL,'Sweden','Suecia',NULL,'Europe','Europa',46,'00','/^(\\+|00)?(?<cc>46)?(?<sn>\\d{9})$/',0),(200,'SG',NULL,'Singapore','Singapur',NULL,'Asia','Asia',65,'00','/^(\\+|00)?(?<cc>65)?(?<sn>\\d{9})$/',0),(201,'SH',NULL,'Ascensión y Tristán de Acuña','Santa Elena',NULL,'Africa','África',290,'00','/^(\\+|00)?(?<cc>290)?(?<sn>\\d{9})$/',0),(202,'SI',NULL,'Slovenia','Eslovenia',NULL,'Europe','Europa',386,'00','/^(\\+|00)?(?<cc>386)?(?<sn>\\d{9})$/',0),(203,'SJ',NULL,'Svalbard and Jan Mayen','Svalbard y Jan Mayen',NULL,'Europe','Europa',47,'00','/^(\\+|00)?(?<cc>47)?(?<sn>\\d{9})$/',0),(204,'SK',NULL,'Slovakia','Eslovaquia',NULL,'Europe','Europa',421,'00','/^(\\+|00)?(?<cc>421)?(?<sn>\\d{9})$/',0),(205,'SL',NULL,'Sierra Leone','Sierra Leona',NULL,'Africa','África',232,'00','/^(\\+|00)?(?<cc>232)?(?<sn>\\d{9})$/',0),(206,'SM',NULL,'San Marino','San Marino',NULL,'Europe','Europa',378,'00','/^(\\+|00)?(?<cc>378)?(?<sn>\\d{9})$/',0),(207,'SN',NULL,'Senegal','Senegal',NULL,'Africa','África',221,'00','/^(\\+|00)?(?<cc>221)?(?<sn>\\d{9})$/',0),(208,'SO',NULL,'Somalia','Somalia',NULL,'Africa','África',252,'00','/^(\\+|00)?(?<cc>252)?(?<sn>\\d{9})$/',0),(209,'SR',NULL,'Suriname','Surinám',NULL,'South america','América del sur',597,'00','/^(\\+|00)?(?<cc>597)?(?<sn>\\d{9})$/',0),(210,'SS',NULL,'South Sudan','Sudán del Sur',NULL,'Africa','África',211,'00','/^(\\+|00)?(?<cc>211)?(?<sn>\\d{9})$/',0),(211,'ST',NULL,'Sao Tome and Principe','Santo Tomé y Príncipe',NULL,'Africa','África',239,'00','/^(\\+|00)?(?<cc>239)?(?<sn>\\d{9})$/',0),(212,'SV',NULL,'El Salvador','El Salvador',NULL,'North america','América del norte',503,'00','/^(\\+|00)?(?<cc>503)?(?<sn>\\d{9})$/',0),(213,'SX',NULL,'Sint Maarten (Dutch part)','Sint Maarten (parte neerlandesa)',NULL,'North america','América del norte',1721,'00','/^(\\+|00)?(?<cc>1721)?(?<sn>\\d{9})$/',0),(214,'SY',NULL,'Syria','Siria',NULL,'Asia','Asia',963,'00','/^(\\+|00)?(?<cc>963)?(?<sn>\\d{9})$/',0),(215,'SZ',NULL,'Swaziland','Swazilandia',NULL,'Africa','África',268,'00','/^(\\+|00)?(?<cc>268)?(?<sn>\\d{9})$/',0),(216,'TC',NULL,'Turks and Caicos Islands','Islas Turcas y Caicos',NULL,'North america','América del norte',1649,'00','/^(\\+|00)?(?<cc>1649)?(?<sn>\\d{9})$/',0),(217,'TD',NULL,'Chad','Chad',NULL,'Africa','África',235,'00','/^(\\+|00)?(?<cc>235)?(?<sn>\\d{9})$/',0),(218,'TF',NULL,'French Southern Territories','Territorios Australes y Antárticas Franceses',NULL,'Antarctica','Antártida',262,'00','/^(\\+|00)?(?<cc>262)?(?<sn>\\d{9})$/',0),(219,'TG',NULL,'Togo','Togo',NULL,'Africa','África',228,'00','/^(\\+|00)?(?<cc>228)?(?<sn>\\d{9})$/',0),(220,'TH',NULL,'Thailand','Tailandia',NULL,'Asia','Asia',66,'00','/^(\\+|00)?(?<cc>66)?(?<sn>\\d{9})$/',0),(221,'TJ',NULL,'Tajikistan','Tadjikistán',NULL,'Asia','Asia',992,'00','/^(\\+|00)?(?<cc>992)?(?<sn>\\d{9})$/',0),(222,'TK',NULL,'Tokelau','Tokelau',NULL,'Oceania','Oceanía',690,'00','/^(\\+|00)?(?<cc>690)?(?<sn>\\d{9})$/',0),(223,'TL',NULL,'East Timor','Timor Oriental',NULL,'Asia','Asia',670,'00','/^(\\+|00)?(?<cc>670)?(?<sn>\\d{9})$/',0),(224,'TM',NULL,'Turkmenistan','Turkmenistán',NULL,'Asia','Asia',993,'00','/^(\\+|00)?(?<cc>993)?(?<sn>\\d{9})$/',0),(225,'TN',NULL,'Tunisia','Tunez',NULL,'Africa','África',216,'00','/^(\\+|00)?(?<cc>216)?(?<sn>\\d{9})$/',0),(226,'TO',NULL,'Tonga','Tonga',NULL,'Oceania','Oceanía',676,'00','/^(\\+|00)?(?<cc>676)?(?<sn>\\d{9})$/',0),(227,'TR',NULL,'Turkey','Turquía',NULL,'Europe','Europa',90,'00','/^(\\+|00)?(?<cc>90)?(?<sn>\\d{9})$/',0),(228,'TT',NULL,'Trinidad and Tobago','Trinidad y Tobago',NULL,'North america','América del norte',1868,'00','/^(\\+|00)?(?<cc>1868)?(?<sn>\\d{9})$/',0),(229,'TV',NULL,'Tuvalu','Tuvalu',NULL,'Oceania','Oceanía',688,'00','/^(\\+|00)?(?<cc>688)?(?<sn>\\d{9})$/',0),(230,'TW',NULL,'Taiwan','Taiwán',NULL,'Asia','Asia',886,'00','/^(\\+|00)?(?<cc>886)?(?<sn>\\d{9})$/',0),(231,'TZ',NULL,'Tanzania','Tanzania',NULL,'Africa','África',255,'00','/^(\\+|00)?(?<cc>255)?(?<sn>\\d{9})$/',0),(232,'UA',NULL,'Ukraine','Ucrania',NULL,'Europe','Europa',380,'00','/^(\\+|00)?(?<cc>380)?(?<sn>\\d{9})$/',0),(233,'UG',NULL,'Uganda','Uganda',NULL,'Africa','África',256,'00','/^(\\+|00)?(?<cc>256)?(?<sn>\\d{9})$/',0),(234,'UM',NULL,'United States Minor Outlying Islands','Islas Ultramarinas Menores de Estados Unidos',NULL,'Oceania','Oceanía',1,'00','/^(\\+|00)?(?<cc>1)?(?<sn>\\d{9})$/',0),(235,'US',NULL,'United States of America','Estados Unidos de América',NULL,'North america','América del norte',1,'011','/^(\\+|011)?(?<cc>1)?(?<ac>\\d{3})?(?<sn>\\d{7})$/',1),(236,'UY',NULL,'Uruguay','Uruguay',NULL,'South america','América del sur',598,'00','/^(\\+|00)?(?<cc>598)?(?<sn>\\d{9})$/',0),(237,'UZ',NULL,'Uzbekistan','Uzbekistán',NULL,'Asia','Asia',998,'00','/^(\\+|00)?(?<cc>998)?(?<sn>\\d{9})$/',0),(238,'VA',NULL,'Vatican City State','Ciudad del Vaticano',NULL,'Europe','Europa',39,'00','/^(\\+|00)?(?<cc>39)?(?<sn>\\d{9})$/',0),(239,'VC',NULL,'Saint Vincent and the Grenadines','San Vicente y las Granadinas',NULL,'North america','América del norte',1784,'00','/^(\\+|00)?(?<cc>1784)?(?<sn>\\d{9})$/',0),(240,'VE',NULL,'Venezuela','Venezuela',NULL,'South america','América del sur',58,'00','/^(\\+|00)?(?<cc>58)?(?<sn>\\d{9})$/',0),(241,'VG',NULL,'Virgin Islands','Islas Vírgenes Británicas',NULL,'North america','América del norte',1284,'00','/^(\\+|00)?(?<cc>1284)?(?<sn>\\d{9})$/',0),(242,'VI',NULL,'United States Virgin Islands','Islas Vírgenes de los Estados Unidos',NULL,'North america','América del norte',1340,'00','/^(\\+|00)?(?<cc>1340)?(?<sn>\\d{9})$/',0),(243,'VN',NULL,'Vietnam','Vietnam',NULL,'Asia','Asia',84,'00','/^(\\+|00)?(?<cc>84)?(?<sn>\\d{9})$/',0),(244,'VU',NULL,'Vanuatu','Vanuatu',NULL,'Oceania','Oceanía',678,'00','/^(\\+|00)?(?<cc>678)?(?<sn>\\d{9})$/',0),(245,'WF',NULL,'Wallis and Futuna','Wallis y Futuna',NULL,'Oceania','Oceanía',681,'00','/^(\\+|00)?(?<cc>681)?(?<sn>\\d{9})$/',0),(246,'WS',NULL,'Samoa','Samoa',NULL,'Oceania','Oceanía',685,'00','/^(\\+|00)?(?<cc>685)?(?<sn>\\d{9})$/',0),(247,'YE',NULL,'Yemen','Yemen',NULL,'Asia','Asia',967,'00','/^(\\+|00)?(?<cc>967)?(?<sn>\\d{9})$/',0),(248,'YT',NULL,'Mayotte','Mayotte',NULL,'Africa','África',262,'00','/^(\\+|00)?(?<cc>262)?(?<sn>\\d{9})$/',0),(249,'ZA',NULL,'South Africa','Sudáfrica',NULL,'Africa','África',27,'00','/^(\\+|00)?(?<cc>27)?(?<sn>\\d{9})$/',0),(250,'ZM',NULL,'Zambia','Zambia',NULL,'Africa','África',260,'00','/^(\\+|00)?(?<cc>260)?(?<sn>\\d{9})$/',0),(251,'ZW',NULL,'Zimbabwe','Zimbabue',NULL,'Africa','África',263,'00','/^(\\+|00)?(?<cc>263)?(?<sn>\\d{9})$/',0);
/*!40000 ALTER TABLE `Countries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `DDIs`
--

DROP TABLE IF EXISTS `DDIs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `DDIs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandId` int(10) unsigned NOT NULL,
  `companyId` int(10) unsigned NOT NULL,
  `DDI` varchar(25) NOT NULL,
  `DDIE164` varchar(25) DEFAULT NULL,
  `externalCallFilterId` int(10) unsigned DEFAULT NULL,
  `recordCalls` varchar(25) NOT NULL DEFAULT 'none' COMMENT '[enum:none|all|inbound|outbound]',
  `displayName` varchar(50) DEFAULT NULL,
  `routeType` varchar(25) DEFAULT NULL COMMENT '[enum:user|IVRCommon|IVRCustom|huntGroup|fax|conferenceRoom|friend|queue|retailAccount|conditional]',
  `userId` int(10) unsigned DEFAULT NULL,
  `IVRCommonId` int(10) unsigned DEFAULT NULL,
  `IVRCustomId` int(10) unsigned DEFAULT NULL,
  `huntGroupId` int(10) unsigned DEFAULT NULL,
  `faxId` int(10) unsigned DEFAULT NULL,
  `conferenceRoomId` int(10) unsigned DEFAULT NULL,
  `retailAccountId` int(10) unsigned DEFAULT NULL,
  `peeringContractId` int(10) unsigned DEFAULT NULL,
  `countryId` int(10) unsigned DEFAULT NULL,
  `billInboundCalls` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `friendValue` varchar(25) DEFAULT NULL,
  `languageId` int(10) unsigned DEFAULT NULL,
  `queueId` int(10) unsigned DEFAULT NULL,
  `conditionalRouteId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `DDIcountry` (`DDI`,`countryId`),
  KEY `companyId` (`companyId`),
  KEY `externalCallFilterId` (`externalCallFilterId`),
  KEY `userId` (`userId`),
  KEY `IVRCommonId` (`IVRCommonId`),
  KEY `IVRCustomId` (`IVRCustomId`),
  KEY `huntGroupId` (`huntGroupId`),
  KEY `faxId` (`faxId`),
  KEY `Faxes_ibfk_8` (`peeringContractId`),
  KEY `Faxes_ibfk_9` (`countryId`),
  KEY `DDIs_ibfk_10` (`brandId`),
  KEY `conferenceRoomId` (`conferenceRoomId`),
  KEY `languageId` (`languageId`),
  KEY `queueId` (`queueId`),
  KEY `retailAccountId` (`retailAccountId`),
  KEY `conditionalRouteId` (`conditionalRouteId`),
  CONSTRAINT `DDIs_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `DDIs_ibfk_10` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `DDIs_ibfk_11` FOREIGN KEY (`conferenceRoomId`) REFERENCES `ConferenceRooms` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `DDIs_ibfk_12` FOREIGN KEY (`languageId`) REFERENCES `Languages` (`id`) ON DELETE SET NULL,
  CONSTRAINT `DDIs_ibfk_13` FOREIGN KEY (`queueId`) REFERENCES `Queues` (`id`) ON DELETE SET NULL,
  CONSTRAINT `DDIs_ibfk_14` FOREIGN KEY (`retailAccountId`) REFERENCES `RetailAccounts` (`id`) ON DELETE SET NULL,
  CONSTRAINT `DDIs_ibfk_15` FOREIGN KEY (`conditionalRouteId`) REFERENCES `ConditionalRoutes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `DDIs_ibfk_2` FOREIGN KEY (`externalCallFilterId`) REFERENCES `ExternalCallFilters` (`id`) ON DELETE SET NULL,
  CONSTRAINT `DDIs_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `DDIs_ibfk_4` FOREIGN KEY (`IVRCommonId`) REFERENCES `IVRCommon` (`id`) ON DELETE SET NULL,
  CONSTRAINT `DDIs_ibfk_5` FOREIGN KEY (`IVRCustomId`) REFERENCES `IVRCustom` (`id`) ON DELETE SET NULL,
  CONSTRAINT `DDIs_ibfk_6` FOREIGN KEY (`huntGroupId`) REFERENCES `HuntGroups` (`id`) ON DELETE SET NULL,
  CONSTRAINT `DDIs_ibfk_7` FOREIGN KEY (`faxId`) REFERENCES `Faxes` (`id`) ON DELETE SET NULL,
  CONSTRAINT `DDIs_ibfk_8` FOREIGN KEY (`peeringContractId`) REFERENCES `PeeringContracts` (`id`) ON DELETE SET NULL,
  CONSTRAINT `DDIs_ibfk_9` FOREIGN KEY (`countryId`) REFERENCES `Countries` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `DDIs`
--

LOCK TABLES `DDIs` WRITE;
/*!40000 ALTER TABLE `DDIs` DISABLE KEYS */;
/*!40000 ALTER TABLE `DDIs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Domains`
--

DROP TABLE IF EXISTS `Domains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Domains` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `domain` varchar(190) NOT NULL,
  `scope` enum('global','company','brand') NOT NULL DEFAULT 'global',
  `pointsTo` enum('proxyusers','proxytrunks') NOT NULL DEFAULT 'proxyusers',
  `brandId` int(10) unsigned DEFAULT NULL,
  `companyId` int(10) unsigned DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `domain` (`domain`),
  UNIQUE KEY `one_domain_per_brand` (`pointsTo`,`brandId`),
  UNIQUE KEY `one_domain_per_company` (`pointsTo`,`companyId`),
  KEY `brandId` (`brandId`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `Domains_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `Domains_ibfk_2` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Domains`
--

LOCK TABLES `Domains` WRITE;
/*!40000 ALTER TABLE `Domains` DISABLE KEYS */;
INSERT INTO `Domains` VALUES (1,'users.ivozprovider.local','global','proxyusers',NULL,NULL,'Minimal proxyusers global domain'),(2,'trunks.ivozprovider.local','global','proxytrunks',NULL,NULL,'Minimal proxytrunks global domain'),(3,'127.0.0.1','company','proxyusers',NULL,1,'DemoCompany proxyusers domain');
/*!40000 ALTER TABLE `Domains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `EtagVersions`
--

DROP TABLE IF EXISTS `EtagVersions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `EtagVersions` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `table` varchar(55) DEFAULT NULL,
  `etag` varchar(255) DEFAULT NULL,
  `lastChange` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `EtagVersions`
--

LOCK TABLES `EtagVersions` WRITE;
/*!40000 ALTER TABLE `EtagVersions` DISABLE KEYS */;
INSERT INTO `EtagVersions` VALUES (1,'Brands','0fa1f07c877fb305111786e5cb056753','2016-10-20 11:40:50'),(2,'ChangeHistory','60097b96791c32512e13dd8eb2883089','2016-10-20 13:32:56'),(3,'RoutingPatterns','70d0a4934a0b2f4258b553e16b53aca2','2016-10-20 11:40:54'),(4,'RoutingPatternGroups','62993bced3edf7673f482ae290cf142b','2016-10-20 11:40:51'),(5,'RoutingPatternGroupsRelPatterns','c2236adec0da313b628dcd56e2aeeee7','2016-10-20 11:40:54'),(6,'BrandServices','a4c375ea3923e5648ea0d5f0d3590046','2016-10-20 11:40:54'),(7,'TransformationRulesetGroupsTrunks','2a8f7f0ea4cf60611a1e99d5b616c404','2016-10-20 11:41:10'),(8,'ApplicationServers','b72cd8c15afa9c0e6edbae67eade9420','2016-10-20 11:47:12'),(9,'KamDispatcher','302c763f350d7a7d60936305be6f622d','2016-10-20 11:47:12'),(10,'Companies','320b6aabbbdf3b0c4b7f220b5002964c','2016-10-20 13:32:56'),(11,'CompanyServices','7f5fb6793b8806558c7d31a79492e428','2016-10-20 11:51:01'),(12,'Domains','139fa5871775fdce1a21019fc70fe725','2016-10-20 13:32:56'),(13,'KamUsersDomainAttrs','4fe007d66285ff82561007bbb6c093ae','2016-10-20 13:32:56'),(14,'TerminalManufacturers','13ff01e20cac2d21542c819dcc9b6308','2016-10-20 11:51:36'),(15,'Users','fb76161b93682315398c7ab8a82ca673','2016-10-20 13:31:21'),(16,'AstVoicemail','3a1ffc162e9904a30ee6f1c6ff9cae15','2016-10-20 13:31:21'),(17,'Terminals','1818be7bd0d4fce148bcea647cccfa20','2016-10-20 13:32:56'),(18,'AstPsEndpoints','bde056fa6d40a52c2a99279dbcca9900','2016-10-20 13:32:56'),(19,'AstPsAors','2fff97c22d9b58cf5ad88a01f3bd20d2','2016-10-20 13:32:56'),(20,'Extensions','8d8cfc9027b2d6732f1c382639699b50','2016-10-20 13:25:29');
/*!40000 ALTER TABLE `EtagVersions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Extensions`
--

DROP TABLE IF EXISTS `Extensions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Extensions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `number` varchar(10) NOT NULL,
  `routeType` varchar(25) DEFAULT NULL COMMENT '[enum:user|number|IVRCommon|IVRCustom|huntGroup|conferenceRoom|friend|queue|retailAccount|conditional]',
  `IVRCommonId` int(10) unsigned DEFAULT NULL,
  `IVRCustomId` int(10) unsigned DEFAULT NULL,
  `huntGroupId` int(10) unsigned DEFAULT NULL,
  `conferenceRoomId` int(10) unsigned DEFAULT NULL,
  `userId` int(10) unsigned DEFAULT NULL,
  `numberValue` varchar(25) DEFAULT NULL,
  `friendValue` varchar(25) DEFAULT NULL,
  `queueId` int(10) unsigned DEFAULT NULL,
  `conditionalRouteId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `companyId_2` (`companyId`,`number`),
  KEY `companyId` (`companyId`),
  KEY `IVRCommonId` (`IVRCommonId`),
  KEY `IVRCustomId` (`IVRCustomId`),
  KEY `huntGroupId` (`huntGroupId`),
  KEY `conferenceRoomId` (`conferenceRoomId`),
  KEY `userId` (`userId`),
  KEY `queueId` (`queueId`),
  KEY `conditionalRouteId` (`conditionalRouteId`),
  CONSTRAINT `Extensions_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `Extensions_ibfk_2` FOREIGN KEY (`IVRCommonId`) REFERENCES `IVRCommon` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Extensions_ibfk_3` FOREIGN KEY (`IVRCustomId`) REFERENCES `IVRCustom` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Extensions_ibfk_4` FOREIGN KEY (`huntGroupId`) REFERENCES `HuntGroups` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Extensions_ibfk_5` FOREIGN KEY (`conferenceRoomId`) REFERENCES `ConferenceRooms` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `Extensions_ibfk_6` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Extensions_ibfk_7` FOREIGN KEY (`queueId`) REFERENCES `Queues` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Extensions_ibfk_8` FOREIGN KEY (`conditionalRouteId`) REFERENCES `ConditionalRoutes` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Extensions`
--

LOCK TABLES `Extensions` WRITE;
/*!40000 ALTER TABLE `Extensions` DISABLE KEYS */;
INSERT INTO `Extensions` VALUES (1,1,'101','user',NULL,NULL,NULL,NULL,1,NULL,NULL,NULL,NULL),(2,1,'102','user',NULL,NULL,NULL,NULL,2,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `Extensions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ExternalCallFilterBlackLists`
--

DROP TABLE IF EXISTS `ExternalCallFilterBlackLists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ExternalCallFilterBlackLists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filterId` int(10) unsigned NOT NULL,
  `matchListId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `filterId` (`filterId`),
  KEY `matchListId` (`matchListId`),
  CONSTRAINT `ExternalCallFilterBlackLists_ibfk_1` FOREIGN KEY (`filterId`) REFERENCES `ExternalCallFilters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ExternalCallFilterBlackLists_ibfk_2` FOREIGN KEY (`matchListId`) REFERENCES `MatchLists` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ExternalCallFilterBlackLists`
--

LOCK TABLES `ExternalCallFilterBlackLists` WRITE;
/*!40000 ALTER TABLE `ExternalCallFilterBlackLists` DISABLE KEYS */;
/*!40000 ALTER TABLE `ExternalCallFilterBlackLists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ExternalCallFilterRelCalendars`
--

DROP TABLE IF EXISTS `ExternalCallFilterRelCalendars`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ExternalCallFilterRelCalendars` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filterId` int(10) unsigned NOT NULL,
  `calendarId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `filterId` (`filterId`),
  KEY `calendarId` (`calendarId`),
  CONSTRAINT `ExternalCallFilterRelCalendars_ibfk_1` FOREIGN KEY (`filterId`) REFERENCES `ExternalCallFilters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ExternalCallFilterRelCalendars_ibfk_2` FOREIGN KEY (`calendarId`) REFERENCES `Calendars` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ExternalCallFilterRelCalendars`
--

LOCK TABLES `ExternalCallFilterRelCalendars` WRITE;
/*!40000 ALTER TABLE `ExternalCallFilterRelCalendars` DISABLE KEYS */;
/*!40000 ALTER TABLE `ExternalCallFilterRelCalendars` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ExternalCallFilterRelSchedules`
--

DROP TABLE IF EXISTS `ExternalCallFilterRelSchedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ExternalCallFilterRelSchedules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filterId` int(10) unsigned NOT NULL,
  `scheduleId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `filterId` (`filterId`),
  KEY `scheduleId` (`scheduleId`),
  CONSTRAINT `ExternalCallFilterRelSchedules_ibfk_1` FOREIGN KEY (`filterId`) REFERENCES `ExternalCallFilters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ExternalCallFilterRelSchedules_ibfk_2` FOREIGN KEY (`scheduleId`) REFERENCES `Schedules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ExternalCallFilterRelSchedules`
--

LOCK TABLES `ExternalCallFilterRelSchedules` WRITE;
/*!40000 ALTER TABLE `ExternalCallFilterRelSchedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `ExternalCallFilterRelSchedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ExternalCallFilterWhiteLists`
--

DROP TABLE IF EXISTS `ExternalCallFilterWhiteLists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ExternalCallFilterWhiteLists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filterId` int(10) unsigned NOT NULL,
  `matchListId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `filterId` (`filterId`),
  KEY `matchListId` (`matchListId`),
  CONSTRAINT `ExternalCallFilterWhiteLists_ibfk_1` FOREIGN KEY (`filterId`) REFERENCES `ExternalCallFilters` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ExternalCallFilterWhiteLists_ibfk_2` FOREIGN KEY (`matchListId`) REFERENCES `MatchLists` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ExternalCallFilterWhiteLists`
--

LOCK TABLES `ExternalCallFilterWhiteLists` WRITE;
/*!40000 ALTER TABLE `ExternalCallFilterWhiteLists` DISABLE KEYS */;
/*!40000 ALTER TABLE `ExternalCallFilterWhiteLists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ExternalCallFilters`
--

DROP TABLE IF EXISTS `ExternalCallFilters`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ExternalCallFilters` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `welcomeLocutionId` int(10) unsigned DEFAULT NULL,
  `holidayLocutionId` int(10) unsigned DEFAULT NULL,
  `outOfScheduleLocutionId` int(10) unsigned DEFAULT NULL,
  `holidayTargetType` varchar(25) DEFAULT NULL COMMENT '[enum:number|extension|voicemail]',
  `holidayNumberValue` varchar(25) DEFAULT NULL,
  `holidayExtensionId` int(10) unsigned DEFAULT NULL,
  `holidayVoiceMailUserId` int(10) unsigned DEFAULT NULL,
  `outOfScheduleTargetType` varchar(25) DEFAULT NULL COMMENT '[enum:number|extension|voicemail]',
  `outOfScheduleNumberValue` varchar(25) DEFAULT NULL,
  `outOfScheduleExtensionId` int(10) unsigned DEFAULT NULL,
  `outOfScheduleVoiceMailUserId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameCompany` (`name`,`companyId`),
  KEY `companyId` (`companyId`),
  KEY `welcomeLocutionId` (`welcomeLocutionId`),
  KEY `holidayLocutionId` (`holidayLocutionId`),
  KEY `outOfScheduleLocutionId` (`outOfScheduleLocutionId`),
  KEY `holidayExtensionId` (`holidayExtensionId`),
  KEY `outOfScheduleExtensionId` (`outOfScheduleExtensionId`),
  KEY `holidayVoiceMailUserId` (`holidayVoiceMailUserId`),
  KEY `outOfScheduleVoiceMailUserId` (`outOfScheduleVoiceMailUserId`),
  CONSTRAINT `ExternalCallFilters_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ExternalCallFilters_ibfk_2` FOREIGN KEY (`welcomeLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ExternalCallFilters_ibfk_3` FOREIGN KEY (`holidayLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ExternalCallFilters_ibfk_4` FOREIGN KEY (`outOfScheduleLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ExternalCallFilters_ibfk_5` FOREIGN KEY (`holidayExtensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ExternalCallFilters_ibfk_6` FOREIGN KEY (`outOfScheduleExtensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ExternalCallFilters_ibfk_7` FOREIGN KEY (`holidayVoiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `ExternalCallFilters_ibfk_8` FOREIGN KEY (`outOfScheduleVoiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ExternalCallFilters`
--

LOCK TABLES `ExternalCallFilters` WRITE;
/*!40000 ALTER TABLE `ExternalCallFilters` DISABLE KEYS */;
/*!40000 ALTER TABLE `ExternalCallFilters` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Faxes`
--

DROP TABLE IF EXISTS `Faxes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Faxes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `sendByEmail` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `outgoingDDIId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `FaxesUniqueCompanyfaxname` (`companyId`,`name`),
  KEY `companyId` (`companyId`),
  KEY `outgoingDDIId` (`outgoingDDIId`),
  CONSTRAINT `Faxes_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `Faxes_ibfk_2` FOREIGN KEY (`outgoingDDIId`) REFERENCES `DDIs` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Faxes`
--

LOCK TABLES `Faxes` WRITE;
/*!40000 ALTER TABLE `Faxes` DISABLE KEYS */;
/*!40000 ALTER TABLE `Faxes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FaxesInOut`
--

DROP TABLE IF EXISTS `FaxesInOut`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FaxesInOut` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `calldate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Hora de recepcion del fax',
  `faxId` int(10) unsigned NOT NULL,
  `src` varchar(128) DEFAULT NULL,
  `dst` varchar(128) DEFAULT NULL,
  `type` varchar(20) DEFAULT 'Out' COMMENT '[enum:In|Out]',
  `pages` varchar(64) DEFAULT NULL,
  `status` enum('error','pending','inprogress','completed') DEFAULT NULL,
  `fileFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO]',
  `fileMimeType` varchar(80) DEFAULT NULL,
  `fileBaseName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `faxId` (`faxId`),
  CONSTRAINT `FaxesInOut_ibfk_2` FOREIGN KEY (`faxId`) REFERENCES `Faxes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FaxesInOut`
--

LOCK TABLES `FaxesInOut` WRITE;
/*!40000 ALTER TABLE `FaxesInOut` DISABLE KEYS */;
/*!40000 ALTER TABLE `FaxesInOut` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Features`
--

DROP TABLE IF EXISTS `Features`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Features` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iden` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '[ml]',
  `name_en` varchar(50) NOT NULL DEFAULT '',
  `name_es` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `featureIden` (`iden`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Features`
--

LOCK TABLES `Features` WRITE;
/*!40000 ALTER TABLE `Features` DISABLE KEYS */;
INSERT INTO `Features` VALUES (1,'queues','','Queues','Colas'),(2,'recordings','','Recordings','Grabaciones'),(3,'faxes','','Faxes','Fax Virtual'),(4,'friends','','Friends','Friends'),(5,'conferences','','Conferences','Conferencias'),(6,'billing','','Billing','Tarificador'),(7,'invoices','','Invoices','Facturador'),(8,'progress','','Voice Notifications','Notificaciones de voz'),(9,'retail','','Retail Clients','Clientes Retail');
/*!40000 ALTER TABLE `Features` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FeaturesRelBrands`
--

DROP TABLE IF EXISTS `FeaturesRelBrands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FeaturesRelBrands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandId` int(10) unsigned NOT NULL,
  `featureId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brandId` (`brandId`),
  KEY `featureId` (`featureId`),
  CONSTRAINT `FeaturesRelBrands_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FeaturesRelBrands_ibfk_2` FOREIGN KEY (`featureId`) REFERENCES `Features` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FeaturesRelBrands`
--

LOCK TABLES `FeaturesRelBrands` WRITE;
/*!40000 ALTER TABLE `FeaturesRelBrands` DISABLE KEYS */;
INSERT INTO `FeaturesRelBrands` VALUES (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5),(6,1,6),(7,1,7);
/*!40000 ALTER TABLE `FeaturesRelBrands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FeaturesRelCompanies`
--

DROP TABLE IF EXISTS `FeaturesRelCompanies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FeaturesRelCompanies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `featureId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  KEY `featureId` (`featureId`),
  CONSTRAINT `FeaturesRelCompanies_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FeaturesRelCompanies_ibfk_2` FOREIGN KEY (`featureId`) REFERENCES `Features` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FeaturesRelCompanies`
--

LOCK TABLES `FeaturesRelCompanies` WRITE;
/*!40000 ALTER TABLE `FeaturesRelCompanies` DISABLE KEYS */;
INSERT INTO `FeaturesRelCompanies` VALUES (1,1,1),(2,1,2),(3,1,3),(4,1,4),(5,1,5);
/*!40000 ALTER TABLE `FeaturesRelCompanies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FixedCosts`
--

DROP TABLE IF EXISTS `FixedCosts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FixedCosts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandId` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `cost` decimal(10,4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `descBrand` (`brandId`,`name`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `FixedCosts_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FixedCosts`
--

LOCK TABLES `FixedCosts` WRITE;
/*!40000 ALTER TABLE `FixedCosts` DISABLE KEYS */;
/*!40000 ALTER TABLE `FixedCosts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FixedCostsRelInvoices`
--

DROP TABLE IF EXISTS `FixedCostsRelInvoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FixedCostsRelInvoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandId` int(10) unsigned NOT NULL,
  `fixedCostId` int(10) unsigned NOT NULL,
  `invoiceId` int(10) unsigned NOT NULL,
  `quantity` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brandId` (`brandId`),
  KEY `fixedCostId` (`fixedCostId`),
  KEY `invoiceId` (`invoiceId`),
  CONSTRAINT `FixedCostsRelInvoices_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FixedCostsRelInvoices_ibfk_2` FOREIGN KEY (`fixedCostId`) REFERENCES `FixedCosts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FixedCostsRelInvoices_ibfk_3` FOREIGN KEY (`invoiceId`) REFERENCES `Invoices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FixedCostsRelInvoices`
--

LOCK TABLES `FixedCostsRelInvoices` WRITE;
/*!40000 ALTER TABLE `FixedCostsRelInvoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `FixedCostsRelInvoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Friends`
--

DROP TABLE IF EXISTS `Friends`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Friends` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(65) NOT NULL,
  `domain` varchar(190) DEFAULT NULL,
  `description` varchar(500) NOT NULL DEFAULT '',
  `transport` varchar(25) NOT NULL COMMENT '[enum:udp|tcp|tls]',
  `ip` varchar(50) DEFAULT NULL,
  `port` smallint(5) unsigned DEFAULT NULL,
  `auth_needed` enum('yes','no') NOT NULL DEFAULT 'yes',
  `password` varchar(64) DEFAULT NULL,
  `callACLId` int(10) unsigned DEFAULT NULL,
  `countryId` int(10) unsigned DEFAULT NULL,
  `areaCode` varchar(10) DEFAULT NULL,
  `outgoingDDIId` int(10) unsigned DEFAULT NULL,
  `priority` smallint(6) NOT NULL DEFAULT '1',
  `disallow` varchar(200) NOT NULL DEFAULT 'all',
  `allow` varchar(200) NOT NULL DEFAULT 'alaw',
  `direct_media_method` enum('invite','update') NOT NULL DEFAULT 'update' COMMENT '[enum:invite|update]',
  `callerid_update_header` enum('pai','rpid') NOT NULL DEFAULT 'pai' COMMENT '[enum:pai|rpid]',
  `update_callerid` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT '[enum:yes|no]',
  `from_domain` varchar(190) DEFAULT NULL,
  `directConnectivity` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT '[enum:yes|no]',
  `languageId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `companyPrio` (`companyId`,`priority`),
  KEY `companyId` (`companyId`),
  KEY `countryId` (`countryId`),
  KEY `callACLId` (`callACLId`),
  KEY `outgoingDDIId` (`outgoingDDIId`),
  KEY `languageId` (`languageId`),
  CONSTRAINT `Friends_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `Friends_ibfk_2` FOREIGN KEY (`countryId`) REFERENCES `Countries` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Friends_ibfk_3` FOREIGN KEY (`callACLId`) REFERENCES `CallACL` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Friends_ibfk_4` FOREIGN KEY (`outgoingDDIId`) REFERENCES `DDIs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Friends_ibfk_5` FOREIGN KEY (`languageId`) REFERENCES `Languages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Friends`
--

LOCK TABLES `Friends` WRITE;
/*!40000 ALTER TABLE `Friends` DISABLE KEYS */;
/*!40000 ALTER TABLE `Friends` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FriendsPatterns`
--

DROP TABLE IF EXISTS `FriendsPatterns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FriendsPatterns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `friendId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `regExp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `friendId` (`friendId`),
  CONSTRAINT `FriendsPatterns_ibfk_1` FOREIGN KEY (`friendId`) REFERENCES `Friends` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FriendsPatterns`
--

LOCK TABLES `FriendsPatterns` WRITE;
/*!40000 ALTER TABLE `FriendsPatterns` DISABLE KEYS */;
/*!40000 ALTER TABLE `FriendsPatterns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GenericCallACLPatterns`
--

DROP TABLE IF EXISTS `GenericCallACLPatterns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GenericCallACLPatterns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `regExp` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameBrand` (`name`,`brandId`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `GenericCallACLPatterns_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GenericCallACLPatterns`
--

LOCK TABLES `GenericCallACLPatterns` WRITE;
/*!40000 ALTER TABLE `GenericCallACLPatterns` DISABLE KEYS */;
/*!40000 ALTER TABLE `GenericCallACLPatterns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `GenericMusicOnHold`
--

DROP TABLE IF EXISTS `GenericMusicOnHold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `GenericMusicOnHold` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `originalFileFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO:keepExtension]',
  `originalFileMimeType` varchar(80) DEFAULT NULL,
  `originalFileBaseName` varchar(255) DEFAULT NULL,
  `encodedFileFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO:keepExtension|storeInBaseFolder]',
  `encodedFileMimeType` varchar(80) DEFAULT NULL,
  `encodedFileBaseName` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL COMMENT '[enum:pending|encoding|ready|error]',
  `brandId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameBrand` (`name`,`brandId`),
  KEY `fGenericMusicOnHold_ibfk_1` (`brandId`),
  CONSTRAINT `fGenericMusicOnHold_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `GenericMusicOnHold`
--

LOCK TABLES `GenericMusicOnHold` WRITE;
/*!40000 ALTER TABLE `GenericMusicOnHold` DISABLE KEYS */;
/*!40000 ALTER TABLE `GenericMusicOnHold` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HolidayDates`
--

DROP TABLE IF EXISTS `HolidayDates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HolidayDates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `calendarId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `eventDate` date NOT NULL,
  `locutionId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dateCalendar` (`eventDate`,`calendarId`),
  KEY `calendarId` (`calendarId`),
  KEY `locutionId` (`locutionId`),
  CONSTRAINT `HolidayDates_ibfk_1` FOREIGN KEY (`calendarId`) REFERENCES `Calendars` (`id`) ON DELETE CASCADE,
  CONSTRAINT `HolidayDates_ibfk_2` FOREIGN KEY (`locutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HolidayDates`
--

LOCK TABLES `HolidayDates` WRITE;
/*!40000 ALTER TABLE `HolidayDates` DISABLE KEYS */;
/*!40000 ALTER TABLE `HolidayDates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HuntGroups`
--

DROP TABLE IF EXISTS `HuntGroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HuntGroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(500) NOT NULL DEFAULT '',
  `companyId` int(10) unsigned NOT NULL,
  `strategy` varchar(25) NOT NULL COMMENT '[enum:ringAll|linear|roundRobin|random]',
  `ringAllTimeout` smallint(6) NOT NULL,
  `nextUserPosition` smallint(4) unsigned DEFAULT '0',
  `noAnswerLocutionId` int(10) unsigned DEFAULT NULL,
  `noAnswerTargetType` varchar(25) DEFAULT NULL COMMENT '[enum:number|extension|voicemail]',
  `noAnswerNumberValue` varchar(25) DEFAULT NULL,
  `noAnswerExtensionId` int(10) unsigned DEFAULT NULL,
  `noAnswerVoiceMailUserId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameCompany` (`name`,`companyId`),
  KEY `companyId` (`companyId`),
  KEY `noAnswerLocutionId` (`noAnswerLocutionId`),
  KEY `noAnswerExtensionId` (`noAnswerExtensionId`),
  KEY `noAnswerVoiceMailUserId` (`noAnswerVoiceMailUserId`),
  CONSTRAINT `HuntGroups_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `HuntGroups_ibfk_2` FOREIGN KEY (`noAnswerLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `HuntGroups_ibfk_3` FOREIGN KEY (`noAnswerExtensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `HuntGroups_ibfk_4` FOREIGN KEY (`noAnswerVoiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HuntGroups`
--

LOCK TABLES `HuntGroups` WRITE;
/*!40000 ALTER TABLE `HuntGroups` DISABLE KEYS */;
/*!40000 ALTER TABLE `HuntGroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HuntGroupsRelUsers`
--

DROP TABLE IF EXISTS `HuntGroupsRelUsers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HuntGroupsRelUsers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `huntGroupId` int(10) unsigned NOT NULL,
  `userId` int(10) unsigned NOT NULL,
  `timeoutTime` smallint(6) DEFAULT NULL,
  `priority` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userHuntgroup` (`userId`,`huntGroupId`),
  UNIQUE KEY `prioHuntgroup` (`priority`,`huntGroupId`),
  KEY `huntGroupId` (`huntGroupId`),
  KEY `userId` (`userId`),
  CONSTRAINT `HuntGroupsRelUsers_ibfk_1` FOREIGN KEY (`huntGroupId`) REFERENCES `HuntGroups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `HuntGroupsRelUsers_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HuntGroupsRelUsers`
--

LOCK TABLES `HuntGroupsRelUsers` WRITE;
/*!40000 ALTER TABLE `HuntGroupsRelUsers` DISABLE KEYS */;
/*!40000 ALTER TABLE `HuntGroupsRelUsers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `IVRCommon`
--

DROP TABLE IF EXISTS `IVRCommon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IVRCommon` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `blackListRegExp` varchar(255) DEFAULT NULL,
  `welcomeLocutionId` int(10) unsigned DEFAULT NULL,
  `noAnswerLocutionId` int(10) unsigned DEFAULT NULL,
  `errorLocutionId` int(10) unsigned DEFAULT NULL,
  `successLocutionId` int(10) unsigned DEFAULT NULL,
  `timeout` smallint(5) unsigned NOT NULL,
  `maxDigits` smallint(5) unsigned NOT NULL,
  `noAnswerTimeout` mediumint(9) DEFAULT '10',
  `timeoutTargetType` varchar(25) DEFAULT NULL COMMENT '[enum:number|extension|voicemail]',
  `timeoutNumberValue` varchar(25) DEFAULT NULL,
  `timeoutExtensionId` int(10) unsigned DEFAULT NULL,
  `timeoutVoiceMailUserId` int(10) unsigned DEFAULT NULL,
  `errorTargetType` varchar(25) DEFAULT NULL COMMENT '[enum:number|extension|voicemail]',
  `errorNumberValue` varchar(25) DEFAULT NULL,
  `errorExtensionId` int(10) unsigned DEFAULT NULL,
  `errorVoiceMailUserId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameCompany` (`name`,`companyId`),
  KEY `companyId` (`companyId`),
  KEY `welcomeLocutionId` (`welcomeLocutionId`),
  KEY `noAnswerLocutionId` (`noAnswerLocutionId`),
  KEY `errorLocutionId` (`errorLocutionId`),
  KEY `successLocutionId` (`successLocutionId`),
  KEY `noAnswerExtensionId` (`timeoutExtensionId`),
  KEY `errorExtensionId` (`errorExtensionId`),
  KEY `noAnswerVoiceMailUserId` (`timeoutVoiceMailUserId`),
  KEY `errorVoiceMailUserId` (`errorVoiceMailUserId`),
  CONSTRAINT `IVRCommon_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `IVRCommon_ibfk_2` FOREIGN KEY (`welcomeLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCommon_ibfk_3` FOREIGN KEY (`noAnswerLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCommon_ibfk_4` FOREIGN KEY (`errorLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCommon_ibfk_5` FOREIGN KEY (`successLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCommon_ibfk_6` FOREIGN KEY (`timeoutExtensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCommon_ibfk_7` FOREIGN KEY (`errorExtensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCommon_ibfk_8` FOREIGN KEY (`timeoutVoiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCommon_ibfk_9` FOREIGN KEY (`errorVoiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `IVRCommon`
--

LOCK TABLES `IVRCommon` WRITE;
/*!40000 ALTER TABLE `IVRCommon` DISABLE KEYS */;
/*!40000 ALTER TABLE `IVRCommon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `IVRCustom`
--

DROP TABLE IF EXISTS `IVRCustom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IVRCustom` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `welcomeLocutionId` int(10) unsigned DEFAULT NULL,
  `noAnswerLocutionId` int(10) unsigned DEFAULT NULL,
  `errorLocutionId` int(10) unsigned DEFAULT NULL,
  `successLocutionId` int(10) unsigned DEFAULT NULL,
  `timeout` smallint(5) unsigned NOT NULL,
  `maxDigits` smallint(5) unsigned NOT NULL,
  `noAnswerTimeout` mediumint(9) DEFAULT '10',
  `timeoutTargetType` varchar(25) DEFAULT NULL COMMENT '[enum:number|extension|voicemail]',
  `timeoutNumberValue` varchar(25) DEFAULT NULL,
  `timeoutExtensionId` int(10) unsigned DEFAULT NULL,
  `timeoutVoiceMailUserId` int(10) unsigned DEFAULT NULL,
  `errorTargetType` varchar(25) DEFAULT NULL COMMENT '[enum:number|extension|voicemail]',
  `errorNumberValue` varchar(25) DEFAULT NULL,
  `errorExtensionId` int(10) unsigned DEFAULT NULL,
  `errorVoiceMailUserId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameCompany` (`name`,`companyId`),
  KEY `companyId` (`companyId`),
  KEY `welcomeLocutionId` (`welcomeLocutionId`),
  KEY `noAnswerLocutionId` (`noAnswerLocutionId`),
  KEY `errorLocutionId` (`errorLocutionId`),
  KEY `successLocutionId` (`successLocutionId`),
  KEY `noAnswerExtensionId` (`timeoutExtensionId`),
  KEY `errorExtensionId` (`errorExtensionId`),
  KEY `noAnswerVoiceMailUserId` (`timeoutVoiceMailUserId`),
  KEY `errorVoiceMailUserId` (`errorVoiceMailUserId`),
  CONSTRAINT `IVRCustom_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `IVRCustom_ibfk_2` FOREIGN KEY (`welcomeLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCustom_ibfk_3` FOREIGN KEY (`noAnswerLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCustom_ibfk_4` FOREIGN KEY (`errorLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCustom_ibfk_5` FOREIGN KEY (`successLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCustom_ibfk_6` FOREIGN KEY (`timeoutExtensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCustom_ibfk_7` FOREIGN KEY (`errorExtensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCustom_ibfk_8` FOREIGN KEY (`timeoutVoiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCustom_ibfk_9` FOREIGN KEY (`errorVoiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `IVRCustom`
--

LOCK TABLES `IVRCustom` WRITE;
/*!40000 ALTER TABLE `IVRCustom` DISABLE KEYS */;
/*!40000 ALTER TABLE `IVRCustom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `IVRCustomEntries`
--

DROP TABLE IF EXISTS `IVRCustomEntries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IVRCustomEntries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `IVRCustomId` int(10) unsigned NOT NULL,
  `entry` varchar(40) NOT NULL,
  `welcomeLocutionId` int(10) unsigned DEFAULT NULL,
  `targetType` varchar(25) NOT NULL COMMENT '[enum:number|extension|voicemail|conditional]',
  `targetNumberValue` varchar(25) DEFAULT NULL,
  `targetExtensionId` int(10) unsigned DEFAULT NULL,
  `targetVoiceMailUserId` int(10) unsigned DEFAULT NULL,
  `targetConditionalRouteId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UniqueIVRCutomIdAndEntry` (`IVRCustomId`,`entry`),
  KEY `IVRCustomId` (`IVRCustomId`),
  KEY `welcomeLocutionId` (`welcomeLocutionId`),
  KEY `targetExtensionId` (`targetExtensionId`),
  KEY `targetVoiceMailUserId` (`targetVoiceMailUserId`),
  KEY `targetConditionalRouteId` (`targetConditionalRouteId`),
  CONSTRAINT `IVRCustomEntries_ibfk_1` FOREIGN KEY (`IVRCustomId`) REFERENCES `IVRCustom` (`id`) ON DELETE CASCADE,
  CONSTRAINT `IVRCustomEntries_ibfk_2` FOREIGN KEY (`welcomeLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCustomEntries_ibfk_3` FOREIGN KEY (`targetExtensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCustomEntries_ibfk_4` FOREIGN KEY (`targetVoiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `IVRCustomEntries_ibfk_5` FOREIGN KEY (`targetConditionalRouteId`) REFERENCES `ConditionalRoutes` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `IVRCustomEntries`
--

LOCK TABLES `IVRCustomEntries` WRITE;
/*!40000 ALTER TABLE `IVRCustomEntries` DISABLE KEYS */;
/*!40000 ALTER TABLE `IVRCustomEntries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `InvoiceTemplates`
--

DROP TABLE IF EXISTS `InvoiceTemplates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `InvoiceTemplates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `template` text NOT NULL,
  `templateHeader` text,
  `templateFooter` text,
  `brandId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameBrand` (`name`,`brandId`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `InvoiceTemplates_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `InvoiceTemplates`
--

LOCK TABLES `InvoiceTemplates` WRITE;
/*!40000 ALTER TABLE `InvoiceTemplates` DISABLE KEYS */;
/*!40000 ALTER TABLE `InvoiceTemplates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Invoices`
--

DROP TABLE IF EXISTS `Invoices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(30) NOT NULL,
  `inDate` datetime DEFAULT NULL,
  `outDate` datetime DEFAULT NULL,
  `total` decimal(10,3) DEFAULT NULL,
  `taxRate` decimal(10,3) DEFAULT NULL,
  `totalWithTax` decimal(10,3) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL COMMENT '[enum:waiting|processing|created|error]',
  `companyId` int(10) unsigned NOT NULL,
  `brandId` int(10) unsigned NOT NULL,
  `pdfFileFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO]',
  `pdfFileMimeType` varchar(80) DEFAULT NULL,
  `pdfFileBaseName` varchar(255) DEFAULT NULL,
  `invoiceTemplateId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `numberBrand` (`number`,`brandId`),
  KEY `brandId` (`brandId`),
  KEY `companyId` (`companyId`),
  KEY `invoiceTemplateId` (`invoiceTemplateId`),
  CONSTRAINT `Invoices_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `Invoices_ibfk_2` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `Invoices_ibfk_4` FOREIGN KEY (`invoiceTemplateId`) REFERENCES `InvoiceTemplates` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Invoices`
--

LOCK TABLES `Invoices` WRITE;
/*!40000 ALTER TABLE `Invoices` DISABLE KEYS */;
/*!40000 ALTER TABLE `Invoices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Languages`
--

DROP TABLE IF EXISTS `Languages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iden` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT '[ml]',
  `name_en` varchar(100) NOT NULL DEFAULT '',
  `name_es` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `languageIden` (`iden`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Languages`
--

LOCK TABLES `Languages` WRITE;
/*!40000 ALTER TABLE `Languages` DISABLE KEYS */;
INSERT INTO `Languages` VALUES (1,'es','','Spanish','Español'),(2,'en','','English','Inglés');
/*!40000 ALTER TABLE `Languages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LcrGateways`
--

DROP TABLE IF EXISTS `LcrGateways`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LcrGateways` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lcr_id` int(10) unsigned NOT NULL DEFAULT '1',
  `gw_name` varchar(200) NOT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `hostname` varchar(64) DEFAULT NULL,
  `port` smallint(5) unsigned DEFAULT NULL,
  `params` varchar(64) DEFAULT NULL,
  `uri_scheme` tinyint(3) unsigned DEFAULT NULL,
  `transport` tinyint(3) unsigned DEFAULT NULL,
  `strip` tinyint(3) unsigned DEFAULT NULL,
  `prefix` varchar(16) DEFAULT NULL,
  `tag` varchar(64) DEFAULT NULL,
  `flags` int(10) unsigned NOT NULL DEFAULT '0',
  `defunct` int(10) unsigned DEFAULT NULL,
  `peerServerId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `peerServerIdUnique` (`peerServerId`),
  KEY `lcr_id` (`lcr_id`),
  CONSTRAINT `LcrGateways_ibfk_2` FOREIGN KEY (`peerServerId`) REFERENCES `PeerServers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LcrGateways`
--

LOCK TABLES `LcrGateways` WRITE;
/*!40000 ALTER TABLE `LcrGateways` DISABLE KEYS */;
/*!40000 ALTER TABLE `LcrGateways` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LcrRuleTargets`
--

DROP TABLE IF EXISTS `LcrRuleTargets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LcrRuleTargets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lcr_id` int(10) unsigned NOT NULL DEFAULT '1',
  `rule_id` int(10) unsigned NOT NULL,
  `gw_id` int(10) unsigned NOT NULL,
  `priority` tinyint(3) unsigned NOT NULL,
  `weight` int(10) unsigned NOT NULL DEFAULT '1',
  `outgoingRoutingId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `rule_id` (`rule_id`),
  KEY `gw_id` (`gw_id`),
  KEY `outgoingRoutingId` (`outgoingRoutingId`),
  KEY `lcr_id` (`lcr_id`),
  CONSTRAINT `LcrRuleTargets_ibfk_2` FOREIGN KEY (`rule_id`) REFERENCES `LcrRules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `LcrRuleTargets_ibfk_3` FOREIGN KEY (`gw_id`) REFERENCES `LcrGateways` (`id`) ON DELETE CASCADE,
  CONSTRAINT `LcrRuleTargets_ibfk_4` FOREIGN KEY (`outgoingRoutingId`) REFERENCES `OutgoingRouting` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LcrRuleTargets`
--

LOCK TABLES `LcrRuleTargets` WRITE;
/*!40000 ALTER TABLE `LcrRuleTargets` DISABLE KEYS */;
/*!40000 ALTER TABLE `LcrRuleTargets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `LcrRules`
--

DROP TABLE IF EXISTS `LcrRules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `LcrRules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lcr_id` int(10) unsigned NOT NULL DEFAULT '1',
  `prefix` varchar(100) DEFAULT NULL,
  `from_uri` varchar(255) DEFAULT NULL,
  `request_uri` varchar(100) DEFAULT NULL,
  `stopper` int(10) unsigned NOT NULL DEFAULT '0',
  `enabled` int(10) unsigned NOT NULL DEFAULT '1',
  `tag` varchar(55) NOT NULL,
  `description` varchar(500) NOT NULL DEFAULT '',
  `routingPatternId` int(10) unsigned DEFAULT NULL,
  `outgoingRoutingId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `routingPatternId` (`routingPatternId`),
  KEY `lcr_id` (`lcr_id`),
  KEY `outgoingRoutingId` (`outgoingRoutingId`),
  CONSTRAINT `LcrRules_ibfk_4` FOREIGN KEY (`routingPatternId`) REFERENCES `RoutingPatterns` (`id`) ON DELETE CASCADE,
  CONSTRAINT `LcrRules_ibfk_5` FOREIGN KEY (`outgoingRoutingId`) REFERENCES `OutgoingRouting` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `LcrRules`
--

LOCK TABLES `LcrRules` WRITE;
/*!40000 ALTER TABLE `LcrRules` DISABLE KEYS */;
/*!40000 ALTER TABLE `LcrRules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Locutions`
--

DROP TABLE IF EXISTS `Locutions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Locutions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `originalFileFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO:keepExtension]',
  `originalFileMimeType` varchar(80) DEFAULT NULL,
  `originalFileBaseName` varchar(255) DEFAULT NULL,
  `encodedFileFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO:keepExtension]',
  `encodedFileMimeType` varchar(80) DEFAULT NULL,
  `encodedFileBaseName` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL COMMENT '[enum:pending|encoding|ready|error]',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameCompany` (`name`,`companyId`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `Locutions_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Locutions`
--

LOCK TABLES `Locutions` WRITE;
/*!40000 ALTER TABLE `Locutions` DISABLE KEYS */;
/*!40000 ALTER TABLE `Locutions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MainOperators`
--

DROP TABLE IF EXISTS `MainOperators`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MainOperators` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(65) NOT NULL,
  `pass` varchar(80) NOT NULL COMMENT '[password]',
  `email` varchar(100) NOT NULL DEFAULT '',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `timezoneId` int(10) unsigned DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `timezoneId` (`timezoneId`),
  CONSTRAINT `MainOperators_ibfk_1` FOREIGN KEY (`timezoneId`) REFERENCES `Timezones` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MainOperators`
--

LOCK TABLES `MainOperators` WRITE;
/*!40000 ALTER TABLE `MainOperators` DISABLE KEYS */;
INSERT INTO `MainOperators` VALUES (1,'admin','$2a$08$ToDhikHKFDznPJVrbPGpeONfmbr3Y9dIrvnyNgN8S7QZ918SeCF0W','admin@example.com',1,145,'admin','ivozprovider');
/*!40000 ALTER TABLE `MainOperators` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MatchListPatterns`
--

DROP TABLE IF EXISTS `MatchListPatterns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MatchListPatterns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `matchListId` int(10) unsigned NOT NULL,
  `description` varchar(55) DEFAULT NULL,
  `type` varchar(10) NOT NULL COMMENT '[enum:number|regexp]',
  `regExp` varchar(255) DEFAULT NULL,
  `numberCountryId` int(10) unsigned DEFAULT NULL,
  `numberValue` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `matchListId` (`matchListId`),
  KEY `MatchListPatterns_ibfk_2` (`numberCountryId`),
  CONSTRAINT `MatchListPatterns_ibfk_1` FOREIGN KEY (`matchListId`) REFERENCES `MatchLists` (`id`) ON DELETE CASCADE,
  CONSTRAINT `MatchListPatterns_ibfk_2` FOREIGN KEY (`numberCountryId`) REFERENCES `Countries` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MatchListPatterns`
--

LOCK TABLES `MatchListPatterns` WRITE;
/*!40000 ALTER TABLE `MatchListPatterns` DISABLE KEYS */;
/*!40000 ALTER TABLE `MatchListPatterns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MatchLists`
--

DROP TABLE IF EXISTS `MatchLists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MatchLists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `matchName` (`companyId`,`name`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `MatchList_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MatchLists`
--

LOCK TABLES `MatchLists` WRITE;
/*!40000 ALTER TABLE `MatchLists` DISABLE KEYS */;
/*!40000 ALTER TABLE `MatchLists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MediaRelaySets`
--

DROP TABLE IF EXISTS `MediaRelaySets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MediaRelaySets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL DEFAULT '0',
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MediaRelaySets`
--

LOCK TABLES `MediaRelaySets` WRITE;
/*!40000 ALTER TABLE `MediaRelaySets` DISABLE KEYS */;
INSERT INTO `MediaRelaySets` VALUES (0,'Default','Default media relay set');
/*!40000 ALTER TABLE `MediaRelaySets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MusicOnHold`
--

DROP TABLE IF EXISTS `MusicOnHold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MusicOnHold` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `originalFileFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO:keepExtension]',
  `originalFileMimeType` varchar(80) DEFAULT NULL,
  `originalFileBaseName` varchar(255) DEFAULT NULL,
  `encodedFileFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO:keepExtension|storeInBaseFolder]',
  `encodedFileMimeType` varchar(80) DEFAULT NULL,
  `encodedFileBaseName` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL COMMENT '[enum:pending|encoding|ready|error]',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameCompany` (`name`,`companyId`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `MusicOnHold_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MusicOnHold`
--

LOCK TABLES `MusicOnHold` WRITE;
/*!40000 ALTER TABLE `MusicOnHold` DISABLE KEYS */;
/*!40000 ALTER TABLE `MusicOnHold` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OutgoingDDIRules`
--

DROP TABLE IF EXISTS `OutgoingDDIRules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OutgoingDDIRules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `defaultAction` varchar(10) NOT NULL COMMENT '[enum:keep|force]',
  `forcedDDIId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ruleName` (`companyId`,`name`),
  KEY `companyId` (`companyId`),
  KEY `OutgoingDDIRules_ibfk_2` (`forcedDDIId`),
  CONSTRAINT `OutgoingDDIRules_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `OutgoingDDIRules_ibfk_2` FOREIGN KEY (`forcedDDIId`) REFERENCES `DDIs` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OutgoingDDIRules`
--

LOCK TABLES `OutgoingDDIRules` WRITE;
/*!40000 ALTER TABLE `OutgoingDDIRules` DISABLE KEYS */;
/*!40000 ALTER TABLE `OutgoingDDIRules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OutgoingDDIRulesPatterns`
--

DROP TABLE IF EXISTS `OutgoingDDIRulesPatterns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OutgoingDDIRulesPatterns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `outgoingDDIRuleId` int(10) unsigned NOT NULL,
  `matchListId` int(10) unsigned NOT NULL,
  `action` varchar(10) NOT NULL COMMENT '[enum:keep|force]',
  `forcedDDIId` int(10) unsigned DEFAULT NULL,
  `priority` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `patternPriority` (`outgoingDDIRuleId`,`priority`),
  KEY `OutgoingDDIRulesPatterns_ibfk_2` (`matchListId`),
  KEY `OutgoingDDIRulesPatterns_ibfk_3` (`forcedDDIId`),
  CONSTRAINT `OutgoingDDIRulesPatterns_ibfk_1` FOREIGN KEY (`outgoingDDIRuleId`) REFERENCES `OutgoingDDIRules` (`id`) ON DELETE CASCADE,
  CONSTRAINT `OutgoingDDIRulesPatterns_ibfk_2` FOREIGN KEY (`matchListId`) REFERENCES `MatchLists` (`id`) ON DELETE CASCADE,
  CONSTRAINT `OutgoingDDIRulesPatterns_ibfk_3` FOREIGN KEY (`forcedDDIId`) REFERENCES `DDIs` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OutgoingDDIRulesPatterns`
--

LOCK TABLES `OutgoingDDIRulesPatterns` WRITE;
/*!40000 ALTER TABLE `OutgoingDDIRulesPatterns` DISABLE KEYS */;
/*!40000 ALTER TABLE `OutgoingDDIRulesPatterns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OutgoingRouting`
--

DROP TABLE IF EXISTS `OutgoingRouting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OutgoingRouting` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` enum('pattern','group','fax') DEFAULT 'group',
  `routingPatternId` int(10) unsigned DEFAULT NULL,
  `routingPatternGroupId` int(10) unsigned DEFAULT NULL,
  `peeringContractId` int(10) unsigned NOT NULL,
  `priority` tinyint(3) unsigned NOT NULL,
  `weight` int(10) unsigned NOT NULL DEFAULT '1',
  `companyId` int(10) unsigned DEFAULT NULL,
  `brandId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  KEY `brandId` (`brandId`),
  KEY `peeringContractId` (`peeringContractId`),
  KEY `routingPatternId` (`routingPatternId`),
  KEY `routingPatternGroupId` (`routingPatternGroupId`),
  CONSTRAINT `OutgoingRouting_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `OutgoingRouting_ibfk_2` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `OutgoingRouting_ibfk_5` FOREIGN KEY (`peeringContractId`) REFERENCES `PeeringContracts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `OutgoingRouting_ibfk_6` FOREIGN KEY (`routingPatternId`) REFERENCES `RoutingPatterns` (`id`) ON DELETE CASCADE,
  CONSTRAINT `OutgoingRouting_ibfk_7` FOREIGN KEY (`routingPatternGroupId`) REFERENCES `RoutingPatternGroups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OutgoingRouting`
--

LOCK TABLES `OutgoingRouting` WRITE;
/*!40000 ALTER TABLE `OutgoingRouting` DISABLE KEYS */;
/*!40000 ALTER TABLE `OutgoingRouting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ParsedCDRs`
--

DROP TABLE IF EXISTS `ParsedCDRs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ParsedCDRs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `statId` int(10) unsigned DEFAULT NULL,
  `xstatId` int(10) unsigned DEFAULT NULL,
  `statType` varchar(256) DEFAULT NULL,
  `initialLeg` varchar(255) DEFAULT NULL,
  `initialLegHash` varchar(128) DEFAULT NULL,
  `cid` varchar(255) DEFAULT NULL,
  `cidHash` varchar(128) DEFAULT NULL,
  `xcid` varchar(255) DEFAULT NULL,
  `xcidHash` varchar(128) DEFAULT NULL,
  `proxies` varchar(32) DEFAULT NULL,
  `type` varchar(32) DEFAULT NULL,
  `subtype` varchar(64) DEFAULT NULL,
  `calldate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `duration` int(10) unsigned DEFAULT NULL,
  `aParty` varchar(128) DEFAULT NULL,
  `bParty` varchar(128) DEFAULT NULL,
  `caller` varchar(128) DEFAULT NULL,
  `callee` varchar(128) DEFAULT NULL,
  `xCaller` varchar(128) DEFAULT NULL,
  `xCallee` varchar(128) DEFAULT NULL,
  `initialReferrer` varchar(128) DEFAULT NULL,
  `referrer` varchar(128) DEFAULT NULL,
  `referee` varchar(128) DEFAULT NULL,
  `lastForwarder` varchar(32) DEFAULT NULL,
  `brandId` int(10) unsigned DEFAULT NULL,
  `companyId` int(10) unsigned DEFAULT NULL,
  `peeringContractId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cid` (`cid`),
  KEY `brandId` (`brandId`),
  KEY `companyId` (`companyId`),
  KEY `peeringContractId` (`peeringContractId`),
  CONSTRAINT `ParsedCDRs_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ParsedCDRs_ibfk_2` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `parsedCDRs_ibfk_6` FOREIGN KEY (`peeringContractId`) REFERENCES `PeeringContracts` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ParsedCDRs`
--

LOCK TABLES `ParsedCDRs` WRITE;
/*!40000 ALTER TABLE `ParsedCDRs` DISABLE KEYS */;
/*!40000 ALTER TABLE `ParsedCDRs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PeerServers`
--

DROP TABLE IF EXISTS `PeerServers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PeerServers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `peeringContractId` int(10) unsigned NOT NULL,
  `ip` varchar(50) DEFAULT NULL,
  `brandId` int(10) unsigned NOT NULL,
  `hostname` varchar(64) DEFAULT NULL,
  `port` smallint(5) unsigned DEFAULT NULL,
  `params` varchar(64) DEFAULT NULL,
  `uri_scheme` tinyint(3) unsigned DEFAULT NULL,
  `transport` tinyint(3) unsigned DEFAULT NULL,
  `strip` tinyint(3) unsigned DEFAULT NULL,
  `prefix` varchar(16) DEFAULT NULL,
  `sendPAI` tinyint(1) unsigned DEFAULT '0',
  `sendRPID` tinyint(1) unsigned DEFAULT '0',
  `auth_needed` enum('yes','no') NOT NULL DEFAULT 'no',
  `auth_user` varchar(64) DEFAULT NULL,
  `auth_password` varchar(64) DEFAULT NULL,
  `sip_proxy` varchar(128) DEFAULT NULL,
  `outbound_proxy` varchar(128) DEFAULT NULL,
  `from_user` varchar(64) DEFAULT NULL,
  `from_domain` varchar(190) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `peeringContractId` (`peeringContractId`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `PeerServers_ibfk_1` FOREIGN KEY (`peeringContractId`) REFERENCES `PeeringContracts` (`id`) ON DELETE CASCADE,
  CONSTRAINT `PeerServers_ibfk_2` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PeerServers`
--

LOCK TABLES `PeerServers` WRITE;
/*!40000 ALTER TABLE `PeerServers` DISABLE KEYS */;
/*!40000 ALTER TABLE `PeerServers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PeeringContracts`
--

DROP TABLE IF EXISTS `PeeringContracts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PeeringContracts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandId` int(10) unsigned NOT NULL,
  `description` varchar(500) NOT NULL DEFAULT '',
  `name` varchar(200) NOT NULL,
  `transformationRulesetGroupsTrunksId` int(10) unsigned DEFAULT NULL,
  `externallyRated` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_per_brand` (`name`,`brandId`),
  KEY `brandId` (`brandId`),
  KEY `PeeringContracts_ibfk_2` (`transformationRulesetGroupsTrunksId`),
  CONSTRAINT `PeeringContracts_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `PeeringContracts_ibfk_2` FOREIGN KEY (`transformationRulesetGroupsTrunksId`) REFERENCES `TransformationRulesetGroupsTrunks` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PeeringContracts`
--

LOCK TABLES `PeeringContracts` WRITE;
/*!40000 ALTER TABLE `PeeringContracts` DISABLE KEYS */;
/*!40000 ALTER TABLE `PeeringContracts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PickUpGroups`
--

DROP TABLE IF EXISTS `PickUpGroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PickUpGroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `companyId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameCompany` (`name`,`companyId`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `PickUpGroups_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PickUpGroups`
--

LOCK TABLES `PickUpGroups` WRITE;
/*!40000 ALTER TABLE `PickUpGroups` DISABLE KEYS */;
/*!40000 ALTER TABLE `PickUpGroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PickUpRelUsers`
--

DROP TABLE IF EXISTS `PickUpRelUsers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PickUpRelUsers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pickUpGroupId` int(10) unsigned NOT NULL,
  `userId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pickUpGroupId` (`pickUpGroupId`),
  KEY `userId` (`userId`),
  CONSTRAINT `PickUpRelUsers_ibfk_1` FOREIGN KEY (`pickUpGroupId`) REFERENCES `PickUpGroups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `PickUpRelUsers_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PickUpRelUsers`
--

LOCK TABLES `PickUpRelUsers` WRITE;
/*!40000 ALTER TABLE `PickUpRelUsers` DISABLE KEYS */;
/*!40000 ALTER TABLE `PickUpRelUsers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PricingPlans`
--

DROP TABLE IF EXISTS `PricingPlans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PricingPlans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL COMMENT '[ml]',
  `name_en` varchar(55) NOT NULL,
  `name_es` varchar(55) NOT NULL,
  `description` varchar(55) NOT NULL COMMENT '[ml]',
  `description_en` varchar(55) NOT NULL,
  `description_es` varchar(55) NOT NULL,
  `createdOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `brandId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameEsBrand` (`name_es`,`brandId`),
  UNIQUE KEY `nameEnBrand` (`name_en`,`brandId`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `PricingPlans_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PricingPlans`
--

LOCK TABLES `PricingPlans` WRITE;
/*!40000 ALTER TABLE `PricingPlans` DISABLE KEYS */;
/*!40000 ALTER TABLE `PricingPlans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PricingPlansRelCompanies`
--

DROP TABLE IF EXISTS `PricingPlansRelCompanies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PricingPlansRelCompanies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pricingPlanId` int(10) unsigned NOT NULL,
  `companyId` int(10) unsigned NOT NULL,
  `validFrom` datetime NOT NULL,
  `validTo` datetime NOT NULL,
  `metric` int(10) NOT NULL DEFAULT '10',
  `brandId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pricingPlanIdCompanyId` (`pricingPlanId`,`companyId`),
  UNIQUE KEY `metricCompanyId` (`companyId`,`metric`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `PricingPlansRelCompanies_ibfk_1` FOREIGN KEY (`pricingPlanId`) REFERENCES `PricingPlans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `PricingPlansRelCompanies_ibfk_2` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `PricingPlansRelCompanies_ibfk_3` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PricingPlansRelCompanies`
--

LOCK TABLES `PricingPlansRelCompanies` WRITE;
/*!40000 ALTER TABLE `PricingPlansRelCompanies` DISABLE KEYS */;
/*!40000 ALTER TABLE `PricingPlansRelCompanies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PricingPlansRelTargetPatterns`
--

DROP TABLE IF EXISTS `PricingPlansRelTargetPatterns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PricingPlansRelTargetPatterns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `connectionCharge` decimal(10,4) NOT NULL,
  `periodTime` mediumint(8) NOT NULL,
  `perPeriodCharge` decimal(10,4) NOT NULL,
  `pricingPlanId` int(10) unsigned NOT NULL,
  `targetPatternId` int(10) unsigned NOT NULL,
  `brandId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pricingPlanId` (`pricingPlanId`,`targetPatternId`),
  KEY `targetPatternId` (`targetPatternId`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `PricingPlansRelTargetPatterns_ibfk_1` FOREIGN KEY (`pricingPlanId`) REFERENCES `PricingPlans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `PricingPlansRelTargetPatterns_ibfk_2` FOREIGN KEY (`targetPatternId`) REFERENCES `TargetPatterns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `PricingPlansRelTargetPatterns_ibfk_3` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PricingPlansRelTargetPatterns`
--

LOCK TABLES `PricingPlansRelTargetPatterns` WRITE;
/*!40000 ALTER TABLE `PricingPlansRelTargetPatterns` DISABLE KEYS */;
/*!40000 ALTER TABLE `PricingPlansRelTargetPatterns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProxyTrunks`
--

DROP TABLE IF EXISTS `ProxyTrunks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProxyTrunks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `ip` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ip`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProxyTrunks`
--

LOCK TABLES `ProxyTrunks` WRITE;
/*!40000 ALTER TABLE `ProxyTrunks` DISABLE KEYS */;
INSERT INTO `ProxyTrunks` VALUES (1,'proxytrunks','127.0.0.1');
/*!40000 ALTER TABLE `ProxyTrunks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProxyUsers`
--

DROP TABLE IF EXISTS `ProxyUsers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProxyUsers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `ip` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ip`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProxyUsers`
--

LOCK TABLES `ProxyUsers` WRITE;
/*!40000 ALTER TABLE `ProxyUsers` DISABLE KEYS */;
INSERT INTO `ProxyUsers` VALUES (1,'proxyusers','127.0.0.1');
/*!40000 ALTER TABLE `ProxyUsers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `QueueMembers`
--

DROP TABLE IF EXISTS `QueueMembers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `QueueMembers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `queueId` int(10) unsigned DEFAULT NULL,
  `userId` int(10) unsigned DEFAULT NULL,
  `penalty` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `queueId` (`queueId`),
  KEY `userId` (`userId`),
  CONSTRAINT `QueueMembers_ibfk_1` FOREIGN KEY (`queueId`) REFERENCES `Queues` (`id`) ON DELETE CASCADE,
  CONSTRAINT `QueueMembers_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `QueueMembers`
--

LOCK TABLES `QueueMembers` WRITE;
/*!40000 ALTER TABLE `QueueMembers` DISABLE KEYS */;
/*!40000 ALTER TABLE `QueueMembers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Queues`
--

DROP TABLE IF EXISTS `Queues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Queues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(128) DEFAULT NULL,
  `maxWaitTime` int(11) DEFAULT NULL,
  `timeoutLocutionId` int(10) unsigned DEFAULT NULL,
  `timeoutTargetType` varchar(25) DEFAULT NULL COMMENT '[enum:number|extension|voicemail]',
  `timeoutNumberValue` varchar(25) DEFAULT NULL,
  `timeoutExtensionId` int(10) unsigned DEFAULT NULL,
  `timeoutVoiceMailUserId` int(10) unsigned DEFAULT NULL,
  `maxlen` int(11) DEFAULT NULL,
  `fullLocutionId` int(10) unsigned DEFAULT NULL,
  `fullTargetType` varchar(25) DEFAULT NULL COMMENT '[enum:number|extension|voicemail]',
  `fullNumberValue` varchar(25) DEFAULT NULL,
  `fullExtensionId` int(10) unsigned DEFAULT NULL,
  `fullVoiceMailUserId` int(10) unsigned DEFAULT NULL,
  `periodicAnnounceLocutionId` int(10) unsigned DEFAULT NULL,
  `periodicAnnounceFrequency` int(11) DEFAULT NULL,
  `memberCallRest` int(11) DEFAULT NULL,
  `memberCallTimeout` int(11) DEFAULT NULL,
  `strategy` enum('ringall','leastrecent','fewestcalls','random','rrmemory','linear','wrandom','rrordered') DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `company_queuename` (`companyId`,`name`),
  KEY `companyId` (`companyId`),
  KEY `periodicAnnounceLocutionId` (`periodicAnnounceLocutionId`),
  KEY `timeoutLocutionId` (`timeoutLocutionId`),
  KEY `timeoutExtensionId` (`timeoutExtensionId`),
  KEY `timeoutVoiceMailUserId` (`timeoutVoiceMailUserId`),
  KEY `fullLocutionId` (`fullLocutionId`),
  KEY `fullExtensionId` (`fullExtensionId`),
  KEY `fullVoiceMailUserId` (`fullVoiceMailUserId`),
  CONSTRAINT `Queues_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `Queues_ibfk_2` FOREIGN KEY (`periodicAnnounceLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Queues_ibfk_3` FOREIGN KEY (`timeoutLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Queues_ibfk_4` FOREIGN KEY (`timeoutExtensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Queues_ibfk_5` FOREIGN KEY (`timeoutVoiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Queues_ibfk_6` FOREIGN KEY (`fullLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Queues_ibfk_7` FOREIGN KEY (`fullExtensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Queues_ibfk_8` FOREIGN KEY (`fullVoiceMailUserId`) REFERENCES `Users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Queues`
--

LOCK TABLES `Queues` WRITE;
/*!40000 ALTER TABLE `Queues` DISABLE KEYS */;
/*!40000 ALTER TABLE `Queues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Recordings`
--

DROP TABLE IF EXISTS `Recordings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Recordings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `callid` varchar(255) DEFAULT NULL,
  `calldate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` enum('ondemand','ddi') NOT NULL DEFAULT 'ddi' COMMENT '[enum:ondemand|ddi]',
  `duration` float(10,3) NOT NULL DEFAULT '0.000',
  `caller` varchar(128) DEFAULT NULL,
  `callee` varchar(128) DEFAULT NULL,
  `recorder` varchar(128) DEFAULT NULL,
  `recordedFileFileSize` int(11) unsigned DEFAULT NULL COMMENT '[FSO:keepExtension]',
  `recordedFileMimeType` varchar(80) DEFAULT NULL,
  `recordedFileBaseName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `Recordings_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Recordings`
--

LOCK TABLES `Recordings` WRITE;
/*!40000 ALTER TABLE `Recordings` DISABLE KEYS */;
/*!40000 ALTER TABLE `Recordings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RetailAccounts`
--

DROP TABLE IF EXISTS `RetailAccounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RetailAccounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandId` int(10) unsigned NOT NULL,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(65) NOT NULL,
  `domain` varchar(190) DEFAULT NULL,
  `description` varchar(500) NOT NULL DEFAULT '',
  `transport` varchar(25) NOT NULL COMMENT '[enum:udp|tcp|tls]',
  `ip` varchar(50) DEFAULT NULL,
  `port` smallint(5) unsigned DEFAULT NULL,
  `auth_needed` enum('yes','no') NOT NULL DEFAULT 'yes',
  `password` varchar(64) DEFAULT NULL,
  `countryId` int(10) unsigned DEFAULT NULL,
  `areaCode` varchar(10) DEFAULT NULL,
  `outgoingDDIId` int(10) unsigned DEFAULT NULL,
  `disallow` varchar(200) NOT NULL DEFAULT 'all',
  `allow` varchar(200) NOT NULL DEFAULT 'alaw',
  `direct_media_method` enum('invite','update') NOT NULL DEFAULT 'update' COMMENT '[enum:invite|update]',
  `callerid_update_header` enum('pai','rpid') NOT NULL DEFAULT 'pai' COMMENT '[enum:pai|rpid]',
  `update_callerid` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT '[enum:yes|no]',
  `from_domain` varchar(190) DEFAULT NULL,
  `directConnectivity` enum('yes','no') NOT NULL DEFAULT 'yes' COMMENT '[enum:yes|no]',
  `languageId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameBrand` (`name`,`brandId`),
  KEY `brandId` (`brandId`),
  KEY `companyId` (`companyId`),
  KEY `countryId` (`countryId`),
  KEY `outgoingDDIId` (`outgoingDDIId`),
  KEY `languageId` (`languageId`),
  CONSTRAINT `RetailAccounts_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `RetailAccounts_ibfk_2` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `RetailAccounts_ibfk_3` FOREIGN KEY (`countryId`) REFERENCES `Countries` (`id`) ON DELETE SET NULL,
  CONSTRAINT `RetailAccounts_ibfk_4` FOREIGN KEY (`outgoingDDIId`) REFERENCES `DDIs` (`id`) ON DELETE SET NULL,
  CONSTRAINT `RetailAccounts_ibfk_5` FOREIGN KEY (`languageId`) REFERENCES `Languages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RetailAccounts`
--

LOCK TABLES `RetailAccounts` WRITE;
/*!40000 ALTER TABLE `RetailAccounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `RetailAccounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RoutingPatternGroups`
--

DROP TABLE IF EXISTS `RoutingPatternGroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RoutingPatternGroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `description` varchar(55) DEFAULT NULL,
  `brandId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`,`brandId`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `RoutingPatternGroups_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RoutingPatternGroups`
--

LOCK TABLES `RoutingPatternGroups` WRITE;
/*!40000 ALTER TABLE `RoutingPatternGroups` DISABLE KEYS */;
INSERT INTO `RoutingPatternGroups` VALUES (7,'Europe',NULL,1),(8,'Asia',NULL,1),(9,'North america',NULL,1),(10,'Africa',NULL,1),(11,'Antarctica',NULL,1),(12,'South america',NULL,1),(13,'Oceania',NULL,1);
/*!40000 ALTER TABLE `RoutingPatternGroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RoutingPatternGroupsRelPatterns`
--

DROP TABLE IF EXISTS `RoutingPatternGroupsRelPatterns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RoutingPatternGroupsRelPatterns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `routingPatternId` int(10) unsigned NOT NULL,
  `routingPatternGroupId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rel` (`routingPatternId`,`routingPatternGroupId`),
  KEY `routingPatternId` (`routingPatternId`),
  KEY `routingPatternGroupId` (`routingPatternGroupId`),
  CONSTRAINT `RoutingPatternGroupsRelPatterns_ibfk_1` FOREIGN KEY (`routingPatternId`) REFERENCES `RoutingPatterns` (`id`) ON DELETE CASCADE,
  CONSTRAINT `RoutingPatternGroupsRelPatterns_ibfk_2` FOREIGN KEY (`routingPatternGroupId`) REFERENCES `RoutingPatternGroups` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6559 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RoutingPatternGroupsRelPatterns`
--

LOCK TABLES `RoutingPatternGroupsRelPatterns` WRITE;
/*!40000 ALTER TABLE `RoutingPatternGroupsRelPatterns` DISABLE KEYS */;
INSERT INTO `RoutingPatternGroupsRelPatterns` VALUES (6310,1,7),(6311,2,8),(6312,3,8),(6313,4,9),(6314,5,9),(6315,6,7),(6316,7,8),(6317,8,10),(6318,9,11),(6319,10,12),(6320,11,13),(6321,12,7),(6322,13,13),(6323,14,9),(6324,15,7),(6325,16,8),(6326,17,7),(6327,18,9),(6328,19,8),(6329,20,7),(6330,21,10),(6331,22,7),(6332,23,8),(6333,24,10),(6334,25,10),(6335,26,9),(6336,27,9),(6337,28,8),(6338,29,12),(6339,30,12),(6340,31,12),(6341,32,9),(6342,33,8),(6343,34,11),(6344,35,10),(6345,36,7),(6346,37,9),(6347,38,9),(6348,39,8),(6349,40,10),(6350,41,10),(6351,42,10),(6352,43,7),(6353,44,10),(6354,45,13),(6355,46,12),(6356,47,10),(6357,48,8),(6358,49,12),(6359,50,9),(6360,51,9),(6361,52,10),(6362,53,12),(6363,54,8),(6364,55,8),(6365,56,7),(6366,57,7),(6367,58,10),(6368,59,7),(6369,60,9),(6370,61,9),(6371,62,10),(6372,63,12),(6373,64,7),(6374,65,10),(6375,66,10),(6376,67,10),(6377,68,7),(6378,69,10),(6379,70,7),(6380,71,13),(6381,72,12),(6382,73,13),(6383,74,7),(6384,75,7),(6385,76,10),(6386,77,7),(6387,78,9),(6388,79,8),(6389,80,12),(6390,81,7),(6391,82,10),(6392,83,7),(6393,84,9),(6394,85,10),(6395,86,10),(6396,87,9),(6397,88,10),(6398,89,7),(6399,90,11),(6400,91,9),(6401,92,13),(6402,93,10),(6403,94,12),(6404,95,8),(6405,96,11),(6406,97,9),(6407,98,7),(6408,99,9),(6409,100,7),(6410,101,8),(6411,102,7),(6412,103,8),(6413,104,7),(6414,105,8),(6415,106,8),(6416,107,8),(6417,108,8),(6418,109,7),(6419,110,7),(6420,111,7),(6421,112,9),(6422,113,8),(6423,114,8),(6424,115,10),(6425,116,8),(6426,117,8),(6427,118,13),(6428,119,10),(6429,120,9),(6430,121,8),(6431,122,8),(6432,123,8),(6433,124,9),(6434,125,8),(6435,126,8),(6436,127,8),(6437,128,9),(6438,129,7),(6439,130,8),(6440,131,10),(6441,132,10),(6442,133,7),(6443,134,7),(6444,135,7),(6445,136,10),(6446,137,10),(6447,138,7),(6448,139,7),(6449,140,7),(6450,141,9),(6451,142,10),(6452,143,13),(6453,144,7),(6454,145,10),(6455,146,8),(6456,147,8),(6457,148,8),(6458,149,13),(6459,150,9),(6460,151,10),(6461,152,9),(6462,153,7),(6463,154,10),(6464,155,8),(6465,156,10),(6466,157,9),(6467,158,8),(6468,159,10),(6469,160,10),(6470,161,13),(6471,162,10),(6472,163,13),(6473,164,10),(6474,165,9),(6475,166,7),(6476,167,7),(6477,168,8),(6478,169,13),(6479,170,13),(6480,171,13),(6481,172,8),(6482,173,9),(6483,174,12),(6484,175,13),(6485,176,13),(6486,177,8),(6487,178,8),(6488,179,7),(6489,180,9),(6490,181,13),(6491,182,9),(6492,183,8),(6493,184,7),(6494,185,13),(6495,186,12),(6496,187,8),(6497,188,10),(6498,189,7),(6499,190,7),(6500,191,7),(6501,192,10),(6502,193,8),(6503,194,13),(6504,195,10),(6505,196,10),(6506,197,7),(6507,198,8),(6508,199,10),(6509,200,7),(6510,201,7),(6511,202,7),(6512,203,10),(6513,204,7),(6514,205,10),(6515,206,10),(6516,207,12),(6517,208,10),(6518,209,10),(6519,210,9),(6520,211,9),(6521,212,8),(6522,213,10),(6523,214,9),(6524,215,10),(6525,216,11),(6526,217,10),(6527,218,8),(6528,219,8),(6529,220,13),(6530,221,8),(6531,222,8),(6532,223,10),(6533,224,13),(6534,225,7),(6535,226,9),(6536,227,13),(6537,228,8),(6538,229,10),(6539,230,7),(6540,231,10),(6541,232,13),(6542,233,9),(6543,234,12),(6544,235,8),(6545,236,7),(6546,237,9),(6547,238,12),(6548,239,9),(6549,240,9),(6550,241,8),(6551,242,13),(6552,243,13),(6553,244,13),(6554,245,8),(6555,246,10),(6556,247,10),(6557,248,10),(6558,249,10);
/*!40000 ALTER TABLE `RoutingPatternGroupsRelPatterns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RoutingPatterns`
--

DROP TABLE IF EXISTS `RoutingPatterns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RoutingPatterns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL COMMENT '[ml]',
  `name_en` varchar(55) NOT NULL,
  `name_es` varchar(55) NOT NULL,
  `description` varchar(55) DEFAULT NULL COMMENT '[ml]',
  `description_en` varchar(55) DEFAULT NULL,
  `description_es` varchar(55) DEFAULT NULL,
  `regExp` varchar(80) NOT NULL,
  `brandId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `RoutingPatterns_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=250 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RoutingPatterns`
--

LOCK TABLES `RoutingPatterns` WRITE;
/*!40000 ALTER TABLE `RoutingPatterns` DISABLE KEYS */;
INSERT INTO `RoutingPatterns` VALUES (1,'','Andorra','Andorra',NULL,'','','376',1),(2,'','United Arab Emirates','Emiratos Árabes Unidos',NULL,'','','971',1),(3,'','Afghanistan','Afganistán',NULL,'','','93',1),(4,'','Antigua and Barbuda','Antigua y Barbuda',NULL,'','','1268',1),(5,'','Anguilla','Anguila',NULL,'','','1264',1),(6,'','Albania','Albania',NULL,'','','355',1),(7,'','Armenia','Armenia',NULL,'','','374',1),(8,'','Angola','Angola',NULL,'','','244',1),(9,'','Antarctica','Antártida',NULL,'','','672',1),(10,'','Argentina','Argentina',NULL,'','','54',1),(11,'','American Samoa','Samoa Americana',NULL,'','','1684',1),(12,'','Austria','Austria',NULL,'','','43',1),(13,'','Australia','Australia',NULL,'','','61',1),(14,'','Aruba','Aruba',NULL,'','','297',1),(15,'','Åland Islands','Islas de Åland',NULL,'','','358',1),(16,'','Azerbaijan','Azerbayán',NULL,'','','994',1),(17,'','Bosnia and Herzegovina','Bosnia y Herzegovina',NULL,'','','387',1),(18,'','Barbados','Barbados',NULL,'','','1246',1),(19,'','Bangladesh','Bangladesh',NULL,'','','880',1),(20,'','Belgium','Bélgica',NULL,'','','32',1),(21,'','Burkina Faso','Burkina Faso',NULL,'','','226',1),(22,'','Bulgaria','Bulgaria',NULL,'','','359',1),(23,'','Bahrain','Bahrein',NULL,'','','973',1),(24,'','Burundi','Burundi',NULL,'','','257',1),(25,'','Benin','Benín',NULL,'','','229',1),(26,'','Saint Barthélemy','San Bartolomé',NULL,'','','590',1),(27,'','Bermuda Islands','Islas Bermudas',NULL,'','','1441',1),(28,'','Brunei','Brunéi',NULL,'','','673',1),(29,'','Bolivia','Bolivia',NULL,'','','591',1),(30,'','Bonaire','Bonaire',NULL,'','','599',1),(31,'','Brazil','Brasil',NULL,'','','55',1),(32,'','Bahamas','Bahamas',NULL,'','','1242',1),(33,'','Bhutan','Bhután',NULL,'','','975',1),(34,'','Bouvet Island','Isla Bouvet',NULL,'','','47',1),(35,'','Botswana','Botsuana',NULL,'','','267',1),(36,'','Belarus','Bielorrusia',NULL,'','','375',1),(37,'','Belize','Belice',NULL,'','','501',1),(38,'','Canada','Canadá',NULL,'','','1',1),(39,'','Cocos (Keeling) Islands','Islas Cocos (Keeling)',NULL,'','','61',1),(40,'','Congo','Congo',NULL,'','','243',1),(41,'','Central African Republic','República Centroafricana',NULL,'','','236',1),(42,'','Congo','Congo',NULL,'','','242',1),(43,'','Switzerland','Suiza',NULL,'','','41',1),(44,'','Ivory Coast','Costa de Marfil',NULL,'','','225',1),(45,'','Cook Islands','Islas Cook',NULL,'','','682',1),(46,'','Chile','Chile',NULL,'','','56',1),(47,'','Cameroon','Camerún',NULL,'','','237',1),(48,'','China','China',NULL,'','','86',1),(49,'','Colombia','Colombia',NULL,'','','57',1),(50,'','Costa Rica','Costa Rica',NULL,'','','506',1),(51,'','Cuba','Cuba',NULL,'','','53',1),(52,'','Cape Verde','Cabo Verde',NULL,'','','238',1),(53,'','Curaçao','Curaçao',NULL,'','','599',1),(54,'','Christmas Island','Isla de Navidad',NULL,'','','61',1),(55,'','Cyprus','Chipre',NULL,'','','357',1),(56,'','Czech Republic','República Checa',NULL,'','','420',1),(57,'','Germany','Alemania',NULL,'','','49',1),(58,'','Djibouti','Yibuti',NULL,'','','253',1),(59,'','Denmark','Dinamarca',NULL,'','','45',1),(60,'','Dominica','Dominica',NULL,'','','1767',1),(61,'','Dominican Republic','República Dominicana',NULL,'','','1809',1),(62,'','Algeria','Algeria',NULL,'','','213',1),(63,'','Ecuador','Ecuador',NULL,'','','593',1),(64,'','Estonia','Estonia',NULL,'','','372',1),(65,'','Egypt','Egipto',NULL,'','','20',1),(66,'','Western Sahara','Sahara Occidental',NULL,'','','212',1),(67,'','Eritrea','Eritrea',NULL,'','','291',1),(68,'','Spain','España',NULL,'','','34',1),(69,'','Ethiopia','Etiopía',NULL,'','','251',1),(70,'','Finland','Finlandia',NULL,'','','358',1),(71,'','Fiji','Fiyi',NULL,'','','679',1),(72,'','Falkland Islands (Malvinas)','Islas Malvinas',NULL,'','','500',1),(73,'','Estados Federados de','Micronesia',NULL,'','','691',1),(74,'','Faroe Islands','Islas Feroe',NULL,'','','298',1),(75,'','France','Francia',NULL,'','','33',1),(76,'','Gabon','Gabón',NULL,'','','241',1),(77,'','United Kingdom','Reino Unido',NULL,'','','44',1),(78,'','Grenada','Granada',NULL,'','','1473',1),(79,'','Georgia','Georgia',NULL,'','','995',1),(80,'','French Guiana','Guayana Francesa',NULL,'','','594',1),(81,'','Guernsey','Guernsey',NULL,'','','44',1),(82,'','Ghana','Ghana',NULL,'','','233',1),(83,'','Gibraltar','Gibraltar',NULL,'','','350',1),(84,'','Greenland','Groenlandia',NULL,'','','299',1),(85,'','Gambia','Gambia',NULL,'','','220',1),(86,'','Guinea','Guinea',NULL,'','','224',1),(87,'','Guadeloupe','Guadalupe',NULL,'','','590',1),(88,'','Equatorial Guinea','Guinea Ecuatorial',NULL,'','','240',1),(89,'','Greece','Grecia',NULL,'','','30',1),(90,'','South Georgia and the South Sandwich Islands','Islas Georgias del Sur y Sandwich del Sur',NULL,'','','500',1),(91,'','Guatemala','Guatemala',NULL,'','','502',1),(92,'','Guam','Guam',NULL,'','','1671',1),(93,'','Guinea-Bissau','Guinea-Bissau',NULL,'','','245',1),(94,'','Guyana','Guyana',NULL,'','','592',1),(95,'','Hong Kong','Hong kong',NULL,'','','852',1),(96,'','Heard Island and McDonald Islands','Islas Heard y McDonald',NULL,'','','672',1),(97,'','Honduras','Honduras',NULL,'','','504',1),(98,'','Croatia','Croacia',NULL,'','','385',1),(99,'','Haiti','Haití',NULL,'','','509',1),(100,'','Hungary','Hungría',NULL,'','','36',1),(101,'','Indonesia','Indonesia',NULL,'','','62',1),(102,'','Ireland','Irlanda',NULL,'','','353',1),(103,'','Israel','Israel',NULL,'','','972',1),(104,'','Isle of Man','Isla de Man',NULL,'','','44',1),(105,'','India','India',NULL,'','','91',1),(106,'','British Indian Ocean Territory','Territorio Británico del Océano Índico',NULL,'','','246',1),(107,'','Iraq','Irak',NULL,'','','964',1),(108,'','Iran','Irán',NULL,'','','98',1),(109,'','Iceland','Islandia',NULL,'','','354',1),(110,'','Italy','Italia',NULL,'','','39',1),(111,'','Jersey','Jersey',NULL,'','','44',1),(112,'','Jamaica','Jamaica',NULL,'','','1876',1),(113,'','Jordan','Jordania',NULL,'','','962',1),(114,'','Japan','Japón',NULL,'','','81',1),(115,'','Kenya','Kenia',NULL,'','','254',1),(116,'','Kyrgyzstan','Kirgizstán',NULL,'','','996',1),(117,'','Cambodia','Camboya',NULL,'','','855',1),(118,'','Kiribati','Kiribati',NULL,'','','686',1),(119,'','Comoros','Comoras',NULL,'','','269',1),(120,'','Saint Kitts and Nevis','San Cristóbal y Nieves',NULL,'','','1869',1),(121,'','North Korea','Corea del Norte',NULL,'','','850',1),(122,'','South Korea','Corea del Sur',NULL,'','','82',1),(123,'','Kuwait','Kuwait',NULL,'','','965',1),(124,'','Cayman Islands','Islas Caimán',NULL,'','','1345',1),(125,'','Kazakhstan','Kazajistán',NULL,'','','7',1),(126,'','Laos','Laos',NULL,'','','856',1),(127,'','Lebanon','Líbano',NULL,'','','961',1),(128,'','Saint Lucia','Santa Lucía',NULL,'','','1758',1),(129,'','Liechtenstein','Liechtenstein',NULL,'','','423',1),(130,'','Sri Lanka','Sri lanka',NULL,'','','94',1),(131,'','Liberia','Liberia',NULL,'','','231',1),(132,'','Lesotho','Lesoto',NULL,'','','266',1),(133,'','Lithuania','Lituania',NULL,'','','370',1),(134,'','Luxembourg','Luxemburgo',NULL,'','','352',1),(135,'','Latvia','Letonia',NULL,'','','371',1),(136,'','Libya','Libia',NULL,'','','218',1),(137,'','Morocco','Marruecos',NULL,'','','212',1),(138,'','Monaco','Mónaco',NULL,'','','377',1),(139,'','Moldova','Moldavia',NULL,'','','373',1),(140,'','Montenegro','Montenegro',NULL,'','','382',1),(141,'','Saint Martin (French part)','San Martín (Francia)',NULL,'','','1599',1),(142,'','Madagascar','Madagascar',NULL,'','','261',1),(143,'','Marshall Islands','Islas Marshall',NULL,'','','692',1),(144,'','Macedonia','Macedônia',NULL,'','','389',1),(145,'','Mali','Mali',NULL,'','','223',1),(146,'','Myanmar','Birmania',NULL,'','','95',1),(147,'','Mongolia','Mongolia',NULL,'','','976',1),(148,'','Macao','Macao',NULL,'','','853',1),(149,'','Northern Mariana Islands','Islas Marianas del Norte',NULL,'','','1670',1),(150,'','Martinique','Martinica',NULL,'','','596',1),(151,'','Mauritania','Mauritania',NULL,'','','222',1),(152,'','Montserrat','Montserrat',NULL,'','','1664',1),(153,'','Malta','Malta',NULL,'','','356',1),(154,'','Mauritius','Mauricio',NULL,'','','230',1),(155,'','Maldives','Islas Maldivas',NULL,'','','960',1),(156,'','Malawi','Malawi',NULL,'','','265',1),(157,'','Mexico','México',NULL,'','','52',1),(158,'','Malaysia','Malasia',NULL,'','','60',1),(159,'','Mozambique','Mozambique',NULL,'','','258',1),(160,'','Namibia','Namibia',NULL,'','','264',1),(161,'','New Caledonia','Nueva Caledonia',NULL,'','','687',1),(162,'','Niger','Niger',NULL,'','','227',1),(163,'','Norfolk Island','Isla Norfolk',NULL,'','','672',1),(164,'','Nigeria','Nigeria',NULL,'','','234',1),(165,'','Nicaragua','Nicaragua',NULL,'','','505',1),(166,'','Netherlands','Países Bajos',NULL,'','','31',1),(167,'','Norway','Noruega',NULL,'','','47',1),(168,'','Nepal','Nepal',NULL,'','','977',1),(169,'','Nauru','Nauru',NULL,'','','674',1),(170,'','Niue','Niue',NULL,'','','683',1),(171,'','New Zealand','Nueva Zelanda',NULL,'','','64',1),(172,'','Oman','Omán',NULL,'','','968',1),(173,'','Panama','Panamá',NULL,'','','507',1),(174,'','Peru','Perú',NULL,'','','51',1),(175,'','French Polynesia','Polinesia Francesa',NULL,'','','689',1),(176,'','Papua New Guinea','Papúa Nueva Guinea',NULL,'','','675',1),(177,'','Philippines','Filipinas',NULL,'','','63',1),(178,'','Pakistan','Pakistán',NULL,'','','92',1),(179,'','Poland','Polonia',NULL,'','','48',1),(180,'','Saint Pierre and Miquelon','San Pedro y Miquelón',NULL,'','','508',1),(181,'','Pitcairn Islands','Islas Pitcairn',NULL,'','','870',1),(182,'','Puerto Rico','Puerto Rico',NULL,'','','1',1),(183,'','Palestine','Palestina',NULL,'','','970',1),(184,'','Portugal','Portugal',NULL,'','','351',1),(185,'','Palau','Palau',NULL,'','','680',1),(186,'','Paraguay','Paraguay',NULL,'','','595',1),(187,'','Qatar','Qatar',NULL,'','','974',1),(188,'','Réunion','Reunión',NULL,'','','262',1),(189,'','Romania','Rumanía',NULL,'','','40',1),(190,'','Serbia','Serbia',NULL,'','','381',1),(191,'','Russia','Rusia',NULL,'','','7',1),(192,'','Rwanda','Ruanda',NULL,'','','250',1),(193,'','Saudi Arabia','Arabia Saudita',NULL,'','','966',1),(194,'','Solomon Islands','Islas Salomón',NULL,'','','677',1),(195,'','Seychelles','Seychelles',NULL,'','','248',1),(196,'','Sudan','Sudán',NULL,'','','249',1),(197,'','Sweden','Suecia',NULL,'','','46',1),(198,'','Singapore','Singapur',NULL,'','','65',1),(199,'','Ascensión y Tristán de Acuña','Santa Elena',NULL,'','','290',1),(200,'','Slovenia','Eslovenia',NULL,'','','386',1),(201,'','Svalbard and Jan Mayen','Svalbard y Jan Mayen',NULL,'','','47',1),(202,'','Slovakia','Eslovaquia',NULL,'','','421',1),(203,'','Sierra Leone','Sierra Leona',NULL,'','','232',1),(204,'','San Marino','San Marino',NULL,'','','378',1),(205,'','Senegal','Senegal',NULL,'','','221',1),(206,'','Somalia','Somalia',NULL,'','','252',1),(207,'','Suriname','Surinám',NULL,'','','597',1),(208,'','South Sudan','Sudán del Sur',NULL,'','','211',1),(209,'','Sao Tome and Principe','Santo Tomé y Príncipe',NULL,'','','239',1),(210,'','El Salvador','El Salvador',NULL,'','','503',1),(211,'','Sint Maarten (Dutch part)','Sint Maarten (parte neerlandesa)',NULL,'','','1721',1),(212,'','Syria','Siria',NULL,'','','963',1),(213,'','Swaziland','Swazilandia',NULL,'','','268',1),(214,'','Turks and Caicos Islands','Islas Turcas y Caicos',NULL,'','','1649',1),(215,'','Chad','Chad',NULL,'','','235',1),(216,'','French Southern Territories','Territorios Australes y Antárticas Franceses',NULL,'','','262',1),(217,'','Togo','Togo',NULL,'','','228',1),(218,'','Thailand','Tailandia',NULL,'','','66',1),(219,'','Tajikistan','Tadjikistán',NULL,'','','992',1),(220,'','Tokelau','Tokelau',NULL,'','','690',1),(221,'','East Timor','Timor Oriental',NULL,'','','670',1),(222,'','Turkmenistan','Turkmenistán',NULL,'','','993',1),(223,'','Tunisia','Tunez',NULL,'','','216',1),(224,'','Tonga','Tonga',NULL,'','','676',1),(225,'','Turkey','Turquía',NULL,'','','90',1),(226,'','Trinidad and Tobago','Trinidad y Tobago',NULL,'','','1868',1),(227,'','Tuvalu','Tuvalu',NULL,'','','688',1),(228,'','Taiwan','Taiwán',NULL,'','','886',1),(229,'','Tanzania','Tanzania',NULL,'','','255',1),(230,'','Ukraine','Ucrania',NULL,'','','380',1),(231,'','Uganda','Uganda',NULL,'','','256',1),(232,'','United States Minor Outlying Islands','Islas Ultramarinas Menores de Estados Unidos',NULL,'','','1',1),(233,'','United States of America','Estados Unidos de América',NULL,'','','1',1),(234,'','Uruguay','Uruguay',NULL,'','','598',1),(235,'','Uzbekistan','Uzbekistán',NULL,'','','998',1),(236,'','Vatican City State','Ciudad del Vaticano',NULL,'','','39',1),(237,'','Saint Vincent and the Grenadines','San Vicente y las Granadinas',NULL,'','','1784',1),(238,'','Venezuela','Venezuela',NULL,'','','58',1),(239,'','Virgin Islands','Islas Vírgenes Británicas',NULL,'','','1284',1),(240,'','United States Virgin Islands','Islas Vírgenes de los Estados Unidos',NULL,'','','1340',1),(241,'','Vietnam','Vietnam',NULL,'','','84',1),(242,'','Vanuatu','Vanuatu',NULL,'','','678',1),(243,'','Wallis and Futuna','Wallis y Futuna',NULL,'','','681',1),(244,'','Samoa','Samoa',NULL,'','','685',1),(245,'','Yemen','Yemen',NULL,'','','967',1),(246,'','Mayotte','Mayotte',NULL,'','','262',1),(247,'','South Africa','Sudáfrica',NULL,'','','27',1),(248,'','Zambia','Zambia',NULL,'','','260',1),(249,'','Zimbabwe','Zimbabue',NULL,'','','263',1);
/*!40000 ALTER TABLE `RoutingPatterns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Schedules`
--

DROP TABLE IF EXISTS `Schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Schedules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `timeIn` time NOT NULL,
  `timeout` time NOT NULL,
  `monday` tinyint(1) unsigned DEFAULT '0',
  `tuesday` tinyint(1) unsigned DEFAULT '0',
  `wednesday` tinyint(1) unsigned DEFAULT '0',
  `thursday` tinyint(1) unsigned DEFAULT '0',
  `friday` tinyint(1) unsigned DEFAULT '0',
  `saturday` tinyint(1) unsigned DEFAULT '0',
  `sunday` tinyint(1) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nameCompany` (`name`,`companyId`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `Schedules_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Schedules`
--

LOCK TABLES `Schedules` WRITE;
/*!40000 ALTER TABLE `Schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `Schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Services`
--

DROP TABLE IF EXISTS `Services`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iden` varchar(50) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '[ml]',
  `name_en` varchar(50) NOT NULL DEFAULT '',
  `name_es` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(255) NOT NULL DEFAULT '' COMMENT '[ml]',
  `description_en` varchar(255) NOT NULL DEFAULT '',
  `description_es` varchar(255) NOT NULL DEFAULT '',
  `defaultCode` varchar(3) NOT NULL,
  `extraArgs` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Services`
--

LOCK TABLES `Services` WRITE;
/*!40000 ALTER TABLE `Services` DISABLE KEYS */;
INSERT INTO `Services` VALUES (1,'DirectPickUp','','Direct Pickup','Captura Directa','','Add the capture extension after the service code','Añada la extensión a capturar tras el código de servicio','94',1),(2,'GroupPickUp','','Group Pickup','Captura de Grupo','','Captura la llamada de un miembro de los grupos de captura del usuario','Captura la llamada de un miembro de los grupos de captura del usuario','95',0),(3,'Voicemail','','Check Voicemail','Consultar buzón de voz','','Check and configure the voicemail of the user','Consulta y configura el buzón de voz del usuario','93',1),(4,'RecordLocution','','Record Locution','Grabar Locucion','','Add the locution code after the service code','Añada el código de locución tras el código de servicio','00',1);
/*!40000 ALTER TABLE `Services` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TargetPatterns`
--

DROP TABLE IF EXISTS `TargetPatterns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TargetPatterns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL COMMENT '[ml]',
  `name_en` varchar(55) NOT NULL,
  `name_es` varchar(55) NOT NULL,
  `description` varchar(55) NOT NULL COMMENT '[ml]',
  `description_en` varchar(55) NOT NULL,
  `description_es` varchar(55) NOT NULL,
  `regExp` varchar(80) NOT NULL,
  `brandId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `regExpBrand` (`regExp`,`brandId`),
  KEY `brandId` (`brandId`),
  CONSTRAINT `TargetPatterns_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TargetPatterns`
--

LOCK TABLES `TargetPatterns` WRITE;
/*!40000 ALTER TABLE `TargetPatterns` DISABLE KEYS */;
/*!40000 ALTER TABLE `TargetPatterns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TerminalManufacturers`
--

DROP TABLE IF EXISTS `TerminalManufacturers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TerminalManufacturers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iden` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(500) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `iden` (`iden`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TerminalManufacturers`
--

LOCK TABLES `TerminalManufacturers` WRITE;
/*!40000 ALTER TABLE `TerminalManufacturers` DISABLE KEYS */;
INSERT INTO `TerminalManufacturers` VALUES (1,'Generic','Generic SIP Manufacturer','Generic SIP Manufacturer'),(2,'Yealink','Yealink',''),(3,'Cisco','Cisco','');
/*!40000 ALTER TABLE `TerminalManufacturers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TerminalModels`
--

DROP TABLE IF EXISTS `TerminalModels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TerminalModels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `iden` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(500) NOT NULL DEFAULT '',
  `TerminalManufacturerId` int(10) unsigned NOT NULL,
  `genericTemplate` text,
  `specificTemplate` text,
  `genericUrlPattern` varchar(225) DEFAULT NULL,
  `specificUrlPattern` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iden` (`iden`),
  KEY `TerminalManufacturerId` (`TerminalManufacturerId`),
  CONSTRAINT `TerminalModels_ibfk_1` FOREIGN KEY (`TerminalManufacturerId`) REFERENCES `TerminalManufacturers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TerminalModels`
--

LOCK TABLES `TerminalModels` WRITE;
/*!40000 ALTER TABLE `TerminalModels` DISABLE KEYS */;
INSERT INTO `TerminalModels` VALUES (1,'Generic','Generic SIP Model','Generic SIP Model',1,NULL,NULL,NULL,NULL),(2,'YealinkT21P_E2','YealinkT21P_E2','',2,NULL,NULL,'y000000000052.cfg','{mac}'),(3,'SPA502G','SPA502G','',3,NULL,NULL,'spa502G.cfg','{mac}'),(4,'YealinkT21P','YealinkT21P','',2,NULL,NULL,'y000000000034.cfg','{mac}'),(5,'YealinkT27P','YealinkT27P','',2,NULL,NULL,'y000000000045.cfg','{mac}'),(6,'SPA504G','SPA504G','',3,NULL,NULL,'spa504G.cfg','{mac}'),(7,'SPA509G','SPA509G','',3,NULL,NULL,'spa509G.cfg','{mac}'),(8,'SPA525G2','SPA525G2','',3,NULL,NULL,'spa525G2.cfg','{mac}'),(9,'SPA514G','SPA514G','',3,NULL,NULL,'spa514G.cfg','{mac}'),(10,'YealinkT46G','YealinkT46G','',2,NULL,NULL,'y000000000028.cfg','{mac}'),(11,'YealinkT48G','YealinkT48G','',2,NULL,NULL,'y000000000035.cfg','{mac}'),(12,'YealinkT23P','YealinkT23P','',2,NULL,NULL,'y000000000044.cfg','{mac}'),(13,'YealinkW5XP','Yealink W5XP','',2,NULL,NULL,'y000000000025.cfg','{mac}');
/*!40000 ALTER TABLE `TerminalModels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Terminals`
--

DROP TABLE IF EXISTS `Terminals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Terminals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `TerminalModelId` int(10) unsigned DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `domain` varchar(190) DEFAULT NULL,
  `disallow` varchar(200) NOT NULL DEFAULT 'all',
  `allow_audio` varchar(200) NOT NULL DEFAULT 'alaw',
  `allow_video` varchar(200) DEFAULT NULL,
  `direct_media_method` enum('invite','reinvite','update') NOT NULL DEFAULT 'update' COMMENT '[enum:update|invite|reinvite]',
  `password` varchar(25) NOT NULL DEFAULT '' COMMENT '[password]',
  `companyId` int(10) unsigned NOT NULL,
  `mac` varchar(12) DEFAULT NULL,
  `lastProvisionDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_domain` (`name`,`domain`),
  KEY `TerminalModelId` (`TerminalModelId`),
  KEY `Terminals_CompanyId_ibfk_2` (`companyId`),
  CONSTRAINT `Terminals_CompanyId_ibfk_2` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `Terminals_ibfk_1` FOREIGN KEY (`TerminalModelId`) REFERENCES `TerminalModels` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Terminals`
--

LOCK TABLES `Terminals` WRITE;
/*!40000 ALTER TABLE `Terminals` DISABLE KEYS */;
INSERT INTO `Terminals` VALUES (1,1,'alice','127.0.0.1','all','alaw',NULL,'invite','alice',1,'',NULL),(2,1,'bob','127.0.0.1','all','alaw',NULL,'invite','bob',1,'',NULL);
/*!40000 ALTER TABLE `Terminals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Timezones`
--

DROP TABLE IF EXISTS `Timezones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Timezones` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `countryId` int(10) unsigned DEFAULT NULL,
  `tz` varchar(255) NOT NULL,
  `comment` varchar(150) DEFAULT '',
  `timeZoneLabel` varchar(20) NOT NULL DEFAULT '' COMMENT '[ml]',
  `timeZoneLabel_en` varchar(20) NOT NULL DEFAULT '',
  `timeZoneLabel_es` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `countryId` (`countryId`),
  CONSTRAINT `Timezones_ibfk_2` FOREIGN KEY (`countryId`) REFERENCES `Countries` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=417 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Timezones`
--

LOCK TABLES `Timezones` WRITE;
/*!40000 ALTER TABLE `Timezones` DISABLE KEYS */;
INSERT INTO `Timezones` VALUES (1,4,'Europe/Andorra',NULL,'','',''),(2,58,'Asia/Dubai',NULL,'','',''),(3,1,'Asia/Kabul',NULL,'','',''),(4,8,'America/Antigua',NULL,'','',''),(5,6,'America/Anguilla',NULL,'','',''),(6,2,'Europe/Tirane',NULL,'','',''),(7,12,'Asia/Yerevan',NULL,'','',''),(8,5,'Africa/Luanda',NULL,'','',''),(9,7,'Antarctica/McMurdo','McMurdo, South Pole, Scott (New Zealand time)','','',''),(10,7,'Antarctica/Rothera','Rothera Station, Adelaide Island','','',''),(11,7,'Antarctica/Palmer','Palmer Station, Anvers Island','','',''),(12,7,'Antarctica/Mawson','Mawson Station, Holme Bay','','',''),(13,7,'Antarctica/Davis','Davis Station, Vestfold Hills','','',''),(14,7,'Antarctica/Casey','Casey Station, Bailey Peninsula','','',''),(15,7,'Antarctica/Vostok','Vostok Station, Lake Vostok','','',''),(16,7,'Antarctica/DumontDUrville','Dumont-d\'Urville Station, Adelie Land','','',''),(17,7,'Antarctica/Syowa','Syowa Station, E Ongul I','','',''),(18,7,'Antarctica/Troll','Troll Station, Queen Maud Land','','',''),(19,11,'America/Argentina/Buenos_Aires','Buenos Aires (BA, CF)','','',''),(20,11,'America/Argentina/Cordoba','most locations (CB, CC, CN, ER, FM, MN, SE, SF)','','',''),(21,11,'America/Argentina/Salta','(SA, LP, NQ, RN)','','',''),(22,11,'America/Argentina/Jujuy','Jujuy (JY)','','',''),(23,11,'America/Argentina/Tucuman','Tucuman (TM)','','',''),(24,11,'America/Argentina/Catamarca','Catamarca (CT), Chubut (CH)','','',''),(25,11,'America/Argentina/La_Rioja','La Rioja (LR)','','',''),(26,11,'America/Argentina/San_Juan','San Juan (SJ)','','',''),(27,11,'America/Argentina/Mendoza','Mendoza (MZ)','','',''),(28,11,'America/Argentina/San_Luis','San Luis (SL)','','',''),(29,11,'America/Argentina/Rio_Gallegos','Santa Cruz (SC)','','',''),(30,11,'America/Argentina/Ushuaia','Tierra del Fuego (TF)','','',''),(31,193,'Pacific/Pago_Pago',NULL,'','',''),(32,15,'Europe/Vienna',NULL,'','',''),(33,14,'Australia/Lord_Howe','Lord Howe Island','','',''),(34,14,'Antarctica/Macquarie','Macquarie Island','','',''),(35,14,'Australia/Hobart','Tasmania - most locations','','',''),(36,14,'Australia/Currie','Tasmania - King Island','','',''),(37,14,'Australia/Melbourne','Victoria','','',''),(38,14,'Australia/Sydney','New South Wales - most locations','','',''),(39,14,'Australia/Broken_Hill','New South Wales - Yancowinna','','',''),(40,14,'Australia/Brisbane','Queensland - most locations','','',''),(41,14,'Australia/Lindeman','Queensland - Holiday Islands','','',''),(42,14,'Australia/Adelaide','South Australia','','',''),(43,14,'Australia/Darwin','Northern Territory','','',''),(44,14,'Australia/Perth','Western Australia - most locations','','',''),(45,14,'Australia/Eucla','Western Australia - Eucla area','','',''),(46,13,'America/Aruba',NULL,'','',''),(47,101,'Europe/Mariehamn',NULL,'','',''),(48,16,'Asia/Baku',NULL,'','',''),(49,27,'Europe/Sarajevo',NULL,'','',''),(50,20,'America/Barbados',NULL,'','',''),(51,19,'Asia/Dhaka',NULL,'','',''),(52,21,'Europe/Brussels',NULL,'','',''),(53,32,'Africa/Ouagadougou',NULL,'','',''),(54,31,'Europe/Sofia',NULL,'','',''),(55,18,'Asia/Bahrain',NULL,'','',''),(56,33,'Africa/Bujumbura',NULL,'','',''),(57,23,'Africa/Porto-Novo',NULL,'','',''),(58,194,'America/St_Barthelemy',NULL,'','',''),(59,24,'Atlantic/Bermuda',NULL,'','',''),(60,30,'Asia/Brunei',NULL,'','',''),(61,26,'America/La_Paz',NULL,'','',''),(62,246,'America/Kralendijk',NULL,'','',''),(63,29,'America/Noronha','Atlantic islands','','',''),(64,29,'America/Belem','Amapa, E Para','','',''),(65,29,'America/Fortaleza','NE Brazil (MA, PI, CE, RN, PB)','','',''),(66,29,'America/Recife','Pernambuco','','',''),(67,29,'America/Araguaina','Tocantins','','',''),(68,29,'America/Maceio','Alagoas, Sergipe','','',''),(69,29,'America/Bahia','Bahia','','',''),(70,29,'America/Sao_Paulo','S & SE Brazil (GO, DF, MG, ES, RJ, SP, PR, SC, RS)','','',''),(71,29,'America/Campo_Grande','Mato Grosso do Sul','','',''),(72,29,'America/Cuiaba','Mato Grosso','','',''),(73,29,'America/Santarem','W Para','','',''),(74,29,'America/Porto_Velho','Rondonia','','',''),(75,29,'America/Boa_Vista','Roraima','','',''),(76,29,'America/Manaus','E Amazonas','','',''),(77,29,'America/Eirunepe','W Amazonas','','',''),(78,29,'America/Rio_Branco','Acre','','',''),(79,17,'America/Nassau',NULL,'','',''),(80,34,'Asia/Thimphu',NULL,'','',''),(81,28,'Africa/Gaborone',NULL,'','',''),(82,25,'Europe/Minsk',NULL,'','',''),(83,22,'America/Belize',NULL,'','',''),(84,38,'America/St_Johns','Newfoundland Time, including SE Labrador','','',''),(85,38,'America/Halifax','Atlantic Time - Nova Scotia (most places), PEI','','',''),(86,38,'America/Glace_Bay','Atlantic Time - Nova Scotia - places that did not observe DST 1966-1971','','',''),(87,38,'America/Moncton','Atlantic Time - New Brunswick','','',''),(88,38,'America/Goose_Bay','Atlantic Time - Labrador - most locations','','',''),(89,38,'America/Blanc-Sablon','Atlantic Standard Time - Quebec - Lower North Shore','','',''),(90,38,'America/Toronto','Eastern Time - Ontario & Quebec - most locations','','',''),(91,38,'America/Nipigon','Eastern Time - Ontario & Quebec - places that did not observe DST 1967-1973','','',''),(92,38,'America/Thunder_Bay','Eastern Time - Thunder Bay, Ontario','','',''),(93,38,'America/Iqaluit','Eastern Time - east Nunavut - most locations','','',''),(94,38,'America/Pangnirtung','Eastern Time - Pangnirtung, Nunavut','','',''),(95,38,'America/Resolute','Central Time - Resolute, Nunavut','','',''),(96,38,'America/Atikokan','Eastern Standard Time - Atikokan, Ontario and Southampton I, Nunavut','','',''),(97,38,'America/Rankin_Inlet','Central Time - central Nunavut','','',''),(98,38,'America/Winnipeg','Central Time - Manitoba & west Ontario','','',''),(99,38,'America/Rainy_River','Central Time - Rainy River & Fort Frances, Ontario','','',''),(100,38,'America/Regina','Central Standard Time - Saskatchewan - most locations','','',''),(101,38,'America/Swift_Current','Central Standard Time - Saskatchewan - midwest','','',''),(102,38,'America/Edmonton','Mountain Time - Alberta, east British Columbia & west Saskatchewan','','',''),(103,38,'America/Cambridge_Bay','Mountain Time - west Nunavut','','',''),(104,38,'America/Yellowknife','Mountain Time - central Northwest Territories','','',''),(105,38,'America/Inuvik','Mountain Time - west Northwest Territories','','',''),(106,38,'America/Creston','Mountain Standard Time - Creston, British Columbia','','',''),(107,38,'America/Dawson_Creek','Mountain Standard Time - Dawson Creek & Fort Saint John, British Columbia','','',''),(108,38,'America/Vancouver','Pacific Time - west British Columbia','','',''),(109,38,'America/Whitehorse','Pacific Time - south Yukon','','',''),(110,38,'America/Dawson','Pacific Time - north Yukon','','',''),(111,103,'Indian/Cocos',NULL,'','',''),(112,185,'Africa/Kinshasa','west Dem. Rep. of Congo','','',''),(113,185,'Africa/Lubumbashi','east Dem. Rep. of Congo','','',''),(114,183,'Africa/Bangui',NULL,'','',''),(115,46,'Africa/Brazzaville',NULL,'','',''),(116,215,'Europe/Zurich',NULL,'','',''),(117,49,'Africa/Abidjan',NULL,'','',''),(118,104,'Pacific/Rarotonga',NULL,'','',''),(119,40,'America/Santiago','most locations','','',''),(120,40,'Pacific/Easter','Easter Island','','',''),(121,37,'Africa/Douala',NULL,'','',''),(122,41,'Asia/Shanghai','Beijing Time','','',''),(123,41,'Asia/Urumqi','Xinjiang Time','','',''),(124,44,'America/Bogota',NULL,'','',''),(125,50,'America/Costa_Rica',NULL,'','',''),(126,52,'America/Havana',NULL,'','',''),(127,35,'Atlantic/Cape_Verde',NULL,'','',''),(128,247,'America/Curacao',NULL,'','',''),(129,96,'Indian/Christmas',NULL,'','',''),(130,42,'Asia/Nicosia',NULL,'','',''),(131,184,'Europe/Prague',NULL,'','',''),(132,3,'Europe/Berlin','most locations','','',''),(133,3,'Europe/Busingen','Busingen','','',''),(134,243,'Africa/Djibouti',NULL,'','',''),(135,53,'Europe/Copenhagen',NULL,'','',''),(136,54,'America/Dominica',NULL,'','',''),(137,186,'America/Santo_Domingo',NULL,'','',''),(138,10,'Africa/Algiers',NULL,'','',''),(139,55,'America/Guayaquil','mainland','','',''),(140,55,'Pacific/Galapagos','Galapagos Islands','','',''),(141,64,'Europe/Tallinn',NULL,'','',''),(142,56,'Africa/Cairo',NULL,'','',''),(143,191,'Africa/El_Aaiun',NULL,'','',''),(144,59,'Africa/Asmara',NULL,'','',''),(145,70,'Europe/Madrid','mainland','','',''),(146,70,'Africa/Ceuta','Ceuta & Melilla','','',''),(147,70,'Atlantic/Canary','Canary Islands','','',''),(148,65,'Africa/Addis_Ababa',NULL,'','',''),(149,67,'Europe/Helsinki',NULL,'','',''),(150,68,'Pacific/Fiji',NULL,'','',''),(151,108,'Atlantic/Stanley',NULL,'','',''),(152,150,'Pacific/Chuuk','Chuuk (Truk) and Yap','','',''),(153,150,'Pacific/Pohnpei','Pohnpei (Ponape)','','',''),(154,150,'Pacific/Kosrae','Kosrae','','',''),(155,105,'Atlantic/Faroe',NULL,'','',''),(156,69,'Europe/Paris',NULL,'','',''),(157,70,'Africa/Libreville',NULL,'','',''),(158,182,'Europe/London',NULL,'','',''),(159,75,'America/Grenada',NULL,'','',''),(160,72,'Asia/Tbilisi',NULL,'','',''),(161,81,'America/Cayenne',NULL,'','',''),(162,82,'Europe/Guernsey',NULL,'','',''),(163,73,'Africa/Accra',NULL,'','',''),(164,74,'Europe/Gibraltar',NULL,'','',''),(165,77,'America/Godthab','most locations','','',''),(166,77,'America/Danmarkshavn','east coast, north of Scoresbysund','','',''),(167,77,'America/Scoresbysund','Scoresbysund / Ittoqqortoormiit','','',''),(168,77,'America/Thule','Thule / Pituffik','','',''),(169,71,'Africa/Banjul',NULL,'','',''),(170,83,'Africa/Conakry',NULL,'','',''),(171,78,'America/Guadeloupe',NULL,'','',''),(172,84,'Africa/Malabo',NULL,'','',''),(173,76,'Europe/Athens',NULL,'','',''),(174,106,'Atlantic/South_Georgia',NULL,'','',''),(175,80,'America/Guatemala',NULL,'','',''),(176,79,'Pacific/Guam',NULL,'','',''),(177,85,'Africa/Bissau',NULL,'','',''),(178,86,'America/Guyana',NULL,'','',''),(179,180,'Asia/Hong_Kong',NULL,'','',''),(180,88,'America/Tegucigalpa',NULL,'','',''),(181,51,'Europe/Zagreb',NULL,'','',''),(182,87,'America/Port-au-Prince',NULL,'','',''),(183,89,'Europe/Budapest',NULL,'','',''),(184,91,'Asia/Jakarta','Java & Sumatra','','',''),(185,91,'Asia/Pontianak','west & central Borneo','','',''),(186,91,'Asia/Makassar','east & south Borneo, Sulawesi (Celebes), Bali, Nusa Tengarra, west Timor','','',''),(187,91,'Asia/Jayapura','west New Guinea (Irian Jaya) & Malukus (Moluccas)','','',''),(188,94,'Europe/Dublin',NULL,'','',''),(189,117,'Asia/Jerusalem',NULL,'','',''),(190,97,'Europe/Isle_of_Man',NULL,'','',''),(191,90,'Asia/Kolkata',NULL,'','',''),(192,222,'Indian/Chagos',NULL,'','',''),(193,93,'Asia/Baghdad',NULL,'','',''),(194,92,'Asia/Tehran',NULL,'','',''),(195,100,'Atlantic/Reykjavik',NULL,'','',''),(196,118,'Europe/Rome',NULL,'','',''),(197,121,'Europe/Jersey',NULL,'','',''),(198,119,'America/Jamaica',NULL,'','',''),(199,122,'Asia/Amman',NULL,'','',''),(200,120,'Asia/Tokyo',NULL,'','',''),(201,124,'Africa/Nairobi',NULL,'','',''),(202,125,'Asia/Bishkek',NULL,'','',''),(203,36,'Asia/Phnom_Penh',NULL,'','',''),(204,126,'Pacific/Tarawa','Gilbert Islands','','',''),(205,126,'Pacific/Enderbury','Phoenix Islands','','',''),(206,126,'Pacific/Kiritimati','Line Islands','','',''),(207,45,'Indian/Comoro',NULL,'','',''),(208,195,'America/St_Kitts',NULL,'','',''),(209,47,'Asia/Pyongyang',NULL,'','',''),(210,48,'Asia/Seoul',NULL,'','',''),(211,127,'Asia/Kuwait',NULL,'','',''),(212,102,'America/Cayman',NULL,'','',''),(213,123,'Asia/Almaty','most locations','','',''),(214,123,'Asia/Qyzylorda','Qyzylorda (Kyzylorda, Kzyl-Orda)','','',''),(215,123,'Asia/Aqtobe','Aqtobe (Aktobe)','','',''),(216,123,'Asia/Aqtau','Atyrau (Atirau, Gur\'yev), Mangghystau (Mankistau)','','',''),(217,123,'Asia/Oral','West Kazakhstan','','',''),(218,128,'Asia/Vientiane',NULL,'','',''),(219,131,'Asia/Beirut',NULL,'','',''),(220,201,'America/St_Lucia',NULL,'','',''),(221,134,'Europe/Vaduz',NULL,'','',''),(222,210,'Asia/Colombo',NULL,'','',''),(223,132,'Africa/Monrovia',NULL,'','',''),(224,129,'Africa/Maseru',NULL,'','',''),(225,135,'Europe/Vilnius',NULL,'','',''),(226,136,'Europe/Luxembourg',NULL,'','',''),(227,130,'Europe/Riga',NULL,'','',''),(228,133,'Africa/Tripoli',NULL,'','',''),(229,144,'Africa/Casablanca',NULL,'','',''),(230,152,'Europe/Monaco',NULL,'','',''),(231,151,'Europe/Chisinau',NULL,'','',''),(232,154,'Europe/Podgorica',NULL,'','',''),(233,197,'America/Marigot',NULL,'','',''),(234,138,'Indian/Antananarivo',NULL,'','',''),(235,110,'Pacific/Majuro','most locations','','',''),(236,110,'Pacific/Kwajalein','Kwajalein','','',''),(237,137,'Europe/Skopje',NULL,'','',''),(238,142,'Africa/Bamako',NULL,'','',''),(239,157,'Asia/Rangoon',NULL,'','',''),(240,153,'Asia/Ulaanbaatar','most locations','','',''),(241,153,'Asia/Hovd','Bayan-Olgiy, Govi-Altai, Hovd, Uvs, Zavkhan','','',''),(242,153,'Asia/Choibalsan','Dornod, Sukhbaatar','','',''),(243,181,'Asia/Macau',NULL,'','',''),(244,109,'Pacific/Saipan',NULL,'','',''),(245,145,'America/Martinique',NULL,'','',''),(246,147,'Africa/Nouakchott',NULL,'','',''),(247,155,'America/Montserrat',NULL,'','',''),(248,143,'Europe/Malta',NULL,'','',''),(249,146,'Indian/Mauritius',NULL,'','',''),(250,141,'Indian/Maldives',NULL,'','',''),(251,140,'Africa/Blantyre',NULL,'','',''),(252,149,'America/Mexico_City','Central Time - most locations','','',''),(253,149,'America/Cancun','Central Time - Quintana Roo','','',''),(254,149,'America/Merida','Central Time - Campeche, Yucatan','','',''),(255,149,'America/Monterrey','Mexican Central Time - Coahuila, Durango, Nuevo Leon, Tamaulipas away from US border','','',''),(256,149,'America/Matamoros','US Central Time - Coahuila, Durango, Nuevo Leon, Tamaulipas near US border','','',''),(257,149,'America/Mazatlan','Mountain Time - S Baja, Nayarit, Sinaloa','','',''),(258,149,'America/Chihuahua','Mexican Mountain Time - Chihuahua away from US border','','',''),(259,149,'America/Ojinaga','US Mountain Time - Chihuahua near US border','','',''),(260,149,'America/Hermosillo','Mountain Standard Time - Sonora','','',''),(261,149,'America/Tijuana','US Pacific Time - Baja California near US border','','',''),(262,149,'America/Santa_Isabel','Mexican Pacific Time - Baja California away from US border','','',''),(263,149,'America/Bahia_Banderas','Mexican Central Time - Bahia de Banderas','','',''),(264,139,'Asia/Kuala_Lumpur','peninsular Malaysia','','',''),(265,139,'Asia/Kuching','Sabah & Sarawak','','',''),(266,156,'Africa/Maputo',NULL,'','',''),(267,158,'Africa/Windhoek',NULL,'','',''),(268,165,'Pacific/Noumea',NULL,'','',''),(269,162,'Africa/Niamey',NULL,'','',''),(270,99,'Pacific/Norfolk',NULL,'','',''),(271,163,'Africa/Lagos',NULL,'','',''),(272,161,'America/Managua',NULL,'','',''),(273,168,'Europe/Amsterdam',NULL,'','',''),(274,164,'Europe/Oslo',NULL,'','',''),(275,160,'Asia/Kathmandu',NULL,'','',''),(276,159,'Pacific/Nauru',NULL,'','',''),(277,98,'Pacific/Niue',NULL,'','',''),(278,166,'Pacific/Auckland','most locations','','',''),(279,166,'Pacific/Chatham','Chatham Islands','','',''),(280,167,'Asia/Muscat',NULL,'','',''),(281,171,'America/Panama',NULL,'','',''),(282,174,'America/Lima',NULL,'','',''),(283,175,'Pacific/Tahiti','Society Islands','','',''),(284,175,'Pacific/Marquesas','Marquesas Islands','','',''),(285,175,'Pacific/Gambier','Gambier Islands','','',''),(286,172,'Pacific/Port_Moresby','most locations','','',''),(287,172,'Pacific/Bougainville','Bougainville','','',''),(288,66,'Asia/Manila',NULL,'','',''),(289,169,'Asia/Karachi',NULL,'','',''),(290,176,'Europe/Warsaw',NULL,'','',''),(291,198,'America/Miquelon',NULL,'','',''),(292,112,'Pacific/Pitcairn',NULL,'','',''),(293,178,'America/Puerto_Rico',NULL,'','',''),(294,224,'Asia/Gaza','Gaza Strip','','',''),(295,224,'Asia/Hebron','West Bank','','',''),(296,177,'Europe/Lisbon','mainland','','',''),(297,177,'Atlantic/Madeira','Madeira Islands','','',''),(298,177,'Atlantic/Azores','Azores','','',''),(299,170,'Pacific/Palau',NULL,'','',''),(300,173,'America/Asuncion',NULL,'','',''),(301,179,'Asia/Qatar',NULL,'','',''),(302,187,'Indian/Reunion',NULL,'','',''),(303,189,'Europe/Bucharest',NULL,'','',''),(304,204,'Europe/Belgrade',NULL,'','',''),(305,190,'Europe/Kaliningrad','Moscow-01 - Kaliningrad','','',''),(306,190,'Europe/Moscow','Moscow+00 - west Russia','','',''),(307,190,'Europe/Simferopol','Moscow+00 - Crimea','','',''),(308,190,'Europe/Volgograd','Moscow+00 - Caspian Sea','','',''),(309,190,'Europe/Samara','Moscow+00 (Moscow+01 after 2014-10-26) - Samara, Udmurtia','','',''),(310,190,'Asia/Yekaterinburg','Moscow+02 - Urals','','',''),(311,190,'Asia/Omsk','Moscow+03 - west Siberia','','',''),(312,190,'Asia/Novosibirsk','Moscow+03 - Novosibirsk','','',''),(313,190,'Asia/Novokuznetsk','Moscow+03 (Moscow+04 after 2014-10-26) - Kemerovo','','',''),(314,190,'Asia/Krasnoyarsk','Moscow+04 - Yenisei River','','',''),(315,190,'Asia/Irkutsk','Moscow+05 - Lake Baikal','','',''),(316,190,'Asia/Chita','Moscow+06 (Moscow+05 after 2014-10-26) - Zabaykalsky','','',''),(317,190,'Asia/Yakutsk','Moscow+06 - Lena River','','',''),(318,190,'Asia/Khandyga','Moscow+06 - Tomponsky, Ust-Maysky','','',''),(319,190,'Asia/Vladivostok','Moscow+07 - Amur River','','',''),(320,190,'Asia/Sakhalin','Moscow+07 - Sakhalin Island','','',''),(321,190,'Asia/Ust-Nera','Moscow+07 - Oymyakonsky','','',''),(322,190,'Asia/Magadan','Moscow+08 (Moscow+07 after 2014-10-26) - Magadan','','',''),(323,190,'Asia/Srednekolymsk','Moscow+08 - E Sakha, N Kuril Is','','',''),(324,190,'Asia/Kamchatka','Moscow+08 (Moscow+09 after 2014-10-26) - Kamchatka','','',''),(325,190,'Asia/Anadyr','Moscow+08 (Moscow+09 after 2014-10-26) - Bering Sea','','',''),(326,188,'Africa/Kigali',NULL,'','',''),(327,9,'Asia/Riyadh',NULL,'','',''),(328,113,'Pacific/Guadalcanal',NULL,'','',''),(329,205,'Indian/Mahe',NULL,'','',''),(330,213,'Africa/Khartoum',NULL,'','',''),(331,214,'Europe/Stockholm',NULL,'','',''),(332,207,'Asia/Singapore',NULL,'','',''),(333,200,'Atlantic/St_Helena',NULL,'','',''),(334,61,'Europe/Ljubljana',NULL,'','',''),(335,217,'Arctic/Longyearbyen',NULL,'','',''),(336,60,'Europe/Bratislava',NULL,'','',''),(337,206,'Africa/Freetown',NULL,'','',''),(338,196,'Europe/San_Marino',NULL,'','',''),(339,203,'Africa/Dakar',NULL,'','',''),(340,209,'Africa/Mogadishu',NULL,'','',''),(341,216,'America/Paramaribo',NULL,'','',''),(342,249,'Africa/Juba',NULL,'','',''),(343,202,'Africa/Sao_Tome',NULL,'','',''),(344,57,'America/El_Salvador',NULL,'','',''),(345,248,'America/Lower_Princes',NULL,'','',''),(346,208,'Asia/Damascus',NULL,'','',''),(347,211,'Africa/Mbabane',NULL,'','',''),(348,114,'America/Grand_Turk',NULL,'','',''),(349,39,'Africa/Ndjamena',NULL,'','',''),(350,223,'Indian/Kerguelen',NULL,'','',''),(351,226,'Africa/Lome',NULL,'','',''),(352,218,'Asia/Bangkok',NULL,'','',''),(353,221,'Asia/Dushanbe',NULL,'','',''),(354,227,'Pacific/Fakaofo',NULL,'','',''),(355,225,'Asia/Dili',NULL,'','',''),(356,231,'Asia/Ashgabat',NULL,'','',''),(357,230,'Africa/Tunis',NULL,'','',''),(358,228,'Pacific/Tongatapu',NULL,'','',''),(359,232,'Europe/Istanbul',NULL,'','',''),(360,229,'America/Port_of_Spain',NULL,'','',''),(361,233,'Pacific/Funafuti',NULL,'','',''),(362,219,'Asia/Taipei',NULL,'','',''),(363,220,'Africa/Dar_es_Salaam',NULL,'','',''),(364,234,'Europe/Kiev','most locations','','',''),(365,234,'Europe/Uzhgorod','Ruthenia','','',''),(366,234,'Europe/Zaporozhye','Zaporozh\'ye, E Lugansk / Zaporizhia, E Luhansk','','',''),(367,235,'Africa/Kampala',NULL,'','',''),(368,111,'Pacific/Johnston','Johnston Atoll','','',''),(369,111,'Pacific/Midway','Midway Islands','','',''),(370,111,'Pacific/Wake','Wake Island','','',''),(371,70,'America/New_York','Eastern Time','','',''),(372,70,'America/Detroit','Eastern Time - Michigan - most locations','','',''),(373,70,'America/Kentucky/Louisville','Eastern Time - Kentucky - Louisville area','','',''),(374,70,'America/Kentucky/Monticello','Eastern Time - Kentucky - Wayne County','','',''),(375,70,'America/Indiana/Indianapolis','Eastern Time - Indiana - most locations','','',''),(376,70,'America/Indiana/Vincennes','Eastern Time - Indiana - Daviess, Dubois, Knox & Martin Counties','','',''),(377,70,'America/Indiana/Winamac','Eastern Time - Indiana - Pulaski County','','',''),(378,70,'America/Indiana/Marengo','Eastern Time - Indiana - Crawford County','','',''),(379,70,'America/Indiana/Petersburg','Eastern Time - Indiana - Pike County','','',''),(380,70,'America/Indiana/Vevay','Eastern Time - Indiana - Switzerland County','','',''),(381,70,'America/Chicago','Central Time','','',''),(382,70,'America/Indiana/Tell_City','Central Time - Indiana - Perry County','','',''),(383,70,'America/Indiana/Knox','Central Time - Indiana - Starke County','','',''),(384,70,'America/Menominee','Central Time - Michigan - Dickinson, Gogebic, Iron & Menominee Counties','','',''),(385,70,'America/North_Dakota/Center','Central Time - North Dakota - Oliver County','','',''),(386,70,'America/North_Dakota/New_Salem','Central Time - North Dakota - Morton County (except Mandan area)','','',''),(387,70,'America/North_Dakota/Beulah','Central Time - North Dakota - Mercer County','','',''),(388,70,'America/Denver','Mountain Time','','',''),(389,70,'America/Boise','Mountain Time - south Idaho & east Oregon','','',''),(390,70,'America/Phoenix','Mountain Standard Time - Arizona (except Navajo)','','',''),(391,70,'America/Los_Angeles','Pacific Time','','',''),(392,70,'America/Metlakatla','Pacific Standard Time - Annette Island, Alaska','','',''),(393,70,'America/Anchorage','Alaska Time','','',''),(394,70,'America/Juneau','Alaska Time - Alaska panhandle','','',''),(395,70,'America/Sitka','Alaska Time - southeast Alaska panhandle','','',''),(396,70,'America/Yakutat','Alaska Time - Alaska panhandle neck','','',''),(397,70,'America/Nome','Alaska Time - west Alaska','','',''),(398,70,'America/Adak','Aleutian Islands','','',''),(399,70,'Pacific/Honolulu','Hawaii','','',''),(400,236,'America/Montevideo',NULL,'','',''),(401,237,'Asia/Samarkand','west Uzbekistan','','',''),(402,237,'Asia/Tashkent','east Uzbekistan','','',''),(403,43,'Europe/Vatican',NULL,'','',''),(404,199,'America/St_Vincent',NULL,'','',''),(405,239,'America/Caracas',NULL,'','',''),(406,115,'America/Tortola',NULL,'','',''),(407,116,'America/St_Thomas',NULL,'','',''),(408,240,'Asia/Ho_Chi_Minh',NULL,'','',''),(409,238,'Pacific/Efate',NULL,'','',''),(410,241,'Pacific/Wallis',NULL,'','',''),(411,192,'Pacific/Apia',NULL,'','',''),(412,242,'Asia/Aden',NULL,'','',''),(413,148,'Indian/Mayotte',NULL,'','',''),(414,212,'Africa/Johannesburg',NULL,'','',''),(415,244,'Africa/Lusaka',NULL,'','',''),(416,245,'Africa/Harare',NULL,'','','');
/*!40000 ALTER TABLE `Timezones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TransformationRulesetGroupsTrunks`
--

DROP TABLE IF EXISTS `TransformationRulesetGroupsTrunks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TransformationRulesetGroupsTrunks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brandId` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `caller_in` int(11) DEFAULT NULL,
  `callee_in` int(11) DEFAULT NULL,
  `caller_out` int(11) DEFAULT NULL,
  `callee_out` int(11) DEFAULT NULL,
  `description` varchar(500) NOT NULL DEFAULT '',
  `automatic` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `countryId` int(10) unsigned DEFAULT NULL,
  `internationalCode` varchar(10) DEFAULT NULL,
  `nationalNumLength` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_brand` (`name`,`brandId`),
  KEY `brandId` (`brandId`),
  KEY `countryId` (`countryId`),
  CONSTRAINT `TransformationRulesetGroupsTrunks_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `TransformationRulesetGroupsTrunks_ibfk_2` FOREIGN KEY (`countryId`) REFERENCES `Countries` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TransformationRulesetGroupsTrunks`
--

LOCK TABLES `TransformationRulesetGroupsTrunks` WRITE;
/*!40000 ALTER TABLE `TransformationRulesetGroupsTrunks` DISABLE KEYS */;
/*!40000 ALTER TABLE `TransformationRulesetGroupsTrunks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(80) DEFAULT NULL COMMENT '[password]',
  `timezoneId` int(10) unsigned DEFAULT NULL,
  `terminalId` int(10) unsigned DEFAULT NULL,
  `extensionId` int(10) unsigned DEFAULT NULL,
  `outgoingDDIId` int(10) unsigned DEFAULT NULL,
  `outgoingDDIRuleId` int(10) unsigned DEFAULT NULL,
  `callACLId` int(10) unsigned DEFAULT NULL,
  `doNotDisturb` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `isBoss` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bossAssistantId` int(10) unsigned DEFAULT NULL,
  `bossAssistantWhiteListId` int(10) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `maxCalls` smallint(5) unsigned NOT NULL DEFAULT '0',
  `externalIpCalls` tinyint(1) NOT NULL DEFAULT '0' COMMENT '[enum:0|1|2|3]',
  `voicemailEnabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `voicemailLocutionId` int(10) unsigned DEFAULT NULL,
  `voicemailSendMail` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `voicemailAttachSound` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `tokenKey` varchar(125) DEFAULT NULL,
  `countryId` int(10) unsigned DEFAULT NULL,
  `languageId` int(10) unsigned DEFAULT NULL,
  `areaCode` varchar(10) DEFAULT NULL,
  `gsQRCode` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniqueTerminalId` (`terminalId`),
  UNIQUE KEY `uniqueExtensionId` (`extensionId`),
  UNIQUE KEY `duplicateEmail` (`email`),
  KEY `companyId` (`companyId`),
  KEY `timezoneId` (`timezoneId`),
  KEY `outgoingDDIId` (`outgoingDDIId`),
  KEY `callACLId` (`callACLId`),
  KEY `bossAssistantId` (`bossAssistantId`),
  KEY `countryId` (`countryId`),
  KEY `languageId` (`languageId`),
  KEY `outgoingDDIRuleId` (`outgoingDDIRuleId`),
  KEY `voicemailLocutionId` (`voicemailLocutionId`),
  KEY `bossAssistantWhiteListId` (`bossAssistantWhiteListId`),
  CONSTRAINT `Users_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `Users_ibfk_10` FOREIGN KEY (`callACLId`) REFERENCES `CallACL` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Users_ibfk_11` FOREIGN KEY (`bossAssistantId`) REFERENCES `Users` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Users_ibfk_12` FOREIGN KEY (`countryId`) REFERENCES `Countries` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Users_ibfk_13` FOREIGN KEY (`languageId`) REFERENCES `Languages` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Users_ibfk_14` FOREIGN KEY (`outgoingDDIRuleId`) REFERENCES `OutgoingDDIRules` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Users_ibfk_15` FOREIGN KEY (`voicemailLocutionId`) REFERENCES `Locutions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Users_ibfk_16` FOREIGN KEY (`bossAssistantWhiteListId`) REFERENCES `MatchLists` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Users_ibfk_3` FOREIGN KEY (`terminalId`) REFERENCES `Terminals` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Users_ibfk_7` FOREIGN KEY (`extensionId`) REFERENCES `Extensions` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Users_ibfk_8` FOREIGN KEY (`timezoneId`) REFERENCES `Timezones` (`id`) ON DELETE SET NULL,
  CONSTRAINT `Users_ibfk_9` FOREIGN KEY (`outgoingDDIId`) REFERENCES `DDIs` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,1,'Alice','Allison','alice@democompany.com','$5$rounds=5000$a73b96fd$XGSEyikkLGgFNo8/TV4.IrnkfN6UecTusCVQX6Qjbl8',145,1,1,NULL,NULL,NULL,0,0,NULL,NULL,1,1,0,1,NULL,1,1,'4c18027290f0c1ed517680bb4bcf2402',NULL,NULL,NULL,0),(2,1,'Bob','Bobson','bob@democompany.com','$5$rounds=5000$b1e18dba$71SpUyDy6TCqe3vg/zeZJPiV.MmF6Ip2Lc0sLeZW8u2',145,2,2,NULL,NULL,NULL,0,0,NULL,NULL,1,1,0,1,NULL,1,1,'10fd9fbe1c6861fb0a14a57e78f871c5',NULL,NULL,NULL,0);
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `XMLRPCLogs`
--

DROP TABLE IF EXISTS `XMLRPCLogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `XMLRPCLogs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proxy` varchar(10) NOT NULL,
  `module` varchar(10) NOT NULL,
  `method` varchar(10) NOT NULL,
  `mapperName` varchar(20) NOT NULL,
  `startDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `execDate` datetime DEFAULT NULL,
  `finishDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `XMLRPCLogs`
--

LOCK TABLES `XMLRPCLogs` WRITE;
/*!40000 ALTER TABLE `XMLRPCLogs` DISABLE KEYS */;
/*!40000 ALTER TABLE `XMLRPCLogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `ast_hints`
--

DROP TABLE IF EXISTS `ast_hints`;
/*!50001 DROP VIEW IF EXISTS `ast_hints`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `ast_hints` (
  `exten` tinyint NOT NULL,
  `context` tinyint NOT NULL,
  `device` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `ast_musiconhold`
--

DROP TABLE IF EXISTS `ast_musiconhold`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ast_musiconhold` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `mode` enum('custom','files','mp3nb','quietmp3nb','quietmp3') DEFAULT NULL,
  `directory` varchar(255) DEFAULT NULL,
  `application` varchar(255) DEFAULT NULL,
  `digit` varchar(1) DEFAULT NULL,
  `sort` varchar(10) DEFAULT NULL,
  `format` varchar(10) DEFAULT NULL,
  `stamp` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ast_musiconhold`
--

LOCK TABLES `ast_musiconhold` WRITE;
/*!40000 ALTER TABLE `ast_musiconhold` DISABLE KEYS */;
/*!40000 ALTER TABLE `ast_musiconhold` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ast_ps_aors`
--

DROP TABLE IF EXISTS `ast_ps_aors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ast_ps_aors` (
  `id` int(10) unsigned NOT NULL,
  `sorcery_id` varchar(40) NOT NULL,
  `default_expiration` int(11) DEFAULT NULL,
  `max_contacts` int(11) DEFAULT NULL,
  `minimum_expiration` int(11) DEFAULT NULL,
  `remove_existing` enum('yes','no') DEFAULT NULL,
  `authenticate_qualify` enum('yes','no') DEFAULT NULL,
  `maximum_expiration` int(11) DEFAULT NULL,
  `support_path` enum('yes','no') DEFAULT NULL,
  `contact` varchar(200) DEFAULT NULL,
  `qualify_frequency` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `sorcery_idx` (`sorcery_id`),
  KEY `contact_idx` (`contact`),
  CONSTRAINT `ast_ps_aors_ibfk_1` FOREIGN KEY (`id`) REFERENCES `ast_ps_endpoints` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ast_ps_aors`
--

LOCK TABLES `ast_ps_aors` WRITE;
/*!40000 ALTER TABLE `ast_ps_aors` DISABLE KEYS */;
INSERT INTO `ast_ps_aors` VALUES (1,'b1c1t1_alice',NULL,1,NULL,'yes',NULL,NULL,NULL,'sip:alice@127.0.0.1',0),(2,'b1c1t2_bob',NULL,1,NULL,'yes',NULL,NULL,NULL,'sip:bob@127.0.0.1',0);
/*!40000 ALTER TABLE `ast_ps_aors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ast_ps_endpoints`
--

DROP TABLE IF EXISTS `ast_ps_endpoints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ast_ps_endpoints` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sorcery_id` varchar(40) NOT NULL,
  `from_domain` varchar(190) DEFAULT NULL,
  `terminalId` int(10) unsigned DEFAULT NULL,
  `friendId` int(10) unsigned DEFAULT NULL,
  `retailAccountId` int(10) unsigned DEFAULT NULL,
  `aors` varchar(200) DEFAULT NULL,
  `callerid` varchar(100) DEFAULT NULL,
  `context` varchar(40) NOT NULL DEFAULT 'users',
  `disallow` varchar(200) NOT NULL DEFAULT 'all',
  `allow` varchar(200) NOT NULL DEFAULT 'all',
  `direct_media` enum('yes','no') DEFAULT 'yes',
  `direct_media_method` enum('invite','reinvite','update') DEFAULT 'update' COMMENT '[enum:update|invite|reinvite]',
  `mailboxes` varchar(100) DEFAULT NULL,
  `named_pickup_group` varchar(40) DEFAULT NULL,
  `send_diversion` enum('yes','no') DEFAULT 'yes',
  `send_pai` enum('yes','no') DEFAULT 'yes',
  `100rel` enum('no','required','yes') NOT NULL DEFAULT 'no',
  `outbound_proxy` varchar(256) DEFAULT NULL,
  `trust_id_inbound` enum('yes','no') DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  KEY `terminalId` (`terminalId`),
  KEY `friendId` (`friendId`),
  KEY `sorcery_idx` (`sorcery_id`),
  KEY `retailAccountId` (`retailAccountId`),
  CONSTRAINT `ast_ps_endpoints_ibfk_1` FOREIGN KEY (`terminalId`) REFERENCES `Terminals` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ast_ps_endpoints_ibfk_2` FOREIGN KEY (`friendId`) REFERENCES `Friends` (`id`) ON DELETE CASCADE,
  CONSTRAINT `ast_ps_endpoints_ibfk_3` FOREIGN KEY (`retailAccountId`) REFERENCES `RetailAccounts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ast_ps_endpoints`
--

LOCK TABLES `ast_ps_endpoints` WRITE;
/*!40000 ALTER TABLE `ast_ps_endpoints` DISABLE KEYS */;
INSERT INTO `ast_ps_endpoints` VALUES (1,'b1c1t1_alice',NULL,1,NULL,NULL,'b1c1t1_alice','Alice  <101>','users','all','alaw',NULL,'invite','101@company1','','yes','yes','no',NULL,NULL),(2,'b1c1t2_bob',NULL,2,NULL,NULL,'b1c1t2_bob','Bob  <102>','users','all','alaw',NULL,'invite','102@company1','','yes','yes','no',NULL,NULL);
/*!40000 ALTER TABLE `ast_ps_endpoints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ast_queue_members`
--

DROP TABLE IF EXISTS `ast_queue_members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ast_queue_members` (
  `uniqueid` int(11) unsigned NOT NULL,
  `queue_name` varchar(80) NOT NULL,
  `interface` varchar(80) NOT NULL,
  `membername` varchar(80) DEFAULT NULL,
  `state_interface` varchar(80) DEFAULT NULL,
  `penalty` int(11) DEFAULT NULL,
  `paused` int(11) DEFAULT NULL,
  `queueMemberId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`uniqueid`),
  KEY `queueMemberId` (`queueMemberId`),
  CONSTRAINT `ast_queue_members_ibfk_1` FOREIGN KEY (`queueMemberId`) REFERENCES `QueueMembers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ast_queue_members`
--

LOCK TABLES `ast_queue_members` WRITE;
/*!40000 ALTER TABLE `ast_queue_members` DISABLE KEYS */;
/*!40000 ALTER TABLE `ast_queue_members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ast_queues`
--

DROP TABLE IF EXISTS `ast_queues`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ast_queues` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `periodic_announce` varchar(128) DEFAULT NULL,
  `periodic_announce_frequency` int(11) DEFAULT NULL,
  `timeout` int(11) DEFAULT NULL,
  `autopause` enum('yes','no','all') NOT NULL DEFAULT 'no',
  `ringinuse` enum('yes','no') NOT NULL DEFAULT 'no',
  `wrapuptime` int(11) DEFAULT NULL,
  `maxlen` int(11) DEFAULT NULL,
  `strategy` enum('ringall','leastrecent','fewestcalls','random','rrmemory','linear','wrandom','rrordered') DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `queueId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `queueId` (`queueId`),
  CONSTRAINT `ast_queues_ibfk_1` FOREIGN KEY (`queueId`) REFERENCES `Queues` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ast_queues`
--

LOCK TABLES `ast_queues` WRITE;
/*!40000 ALTER TABLE `ast_queues` DISABLE KEYS */;
/*!40000 ALTER TABLE `ast_queues` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ast_voicemail`
--

DROP TABLE IF EXISTS `ast_voicemail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ast_voicemail` (
  `uniqueid` int(11) NOT NULL AUTO_INCREMENT,
  `context` varchar(80) NOT NULL,
  `mailbox` varchar(80) NOT NULL,
  `password` varchar(80) DEFAULT NULL,
  `fullname` varchar(80) DEFAULT NULL,
  `alias` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `pager` varchar(80) DEFAULT NULL,
  `attach` enum('yes','no') DEFAULT NULL,
  `attachfmt` varchar(10) DEFAULT NULL,
  `serveremail` varchar(80) DEFAULT NULL,
  `language` varchar(20) DEFAULT NULL,
  `tz` varchar(30) DEFAULT NULL,
  `deleteast_voicemail` enum('yes','no') DEFAULT NULL,
  `saycid` enum('yes','no') DEFAULT NULL,
  `sendast_voicemail` enum('yes','no') DEFAULT NULL,
  `review` enum('yes','no') DEFAULT NULL,
  `tempgreetwarn` enum('yes','no') DEFAULT NULL,
  `operator` enum('yes','no') DEFAULT NULL,
  `envelope` enum('yes','no') DEFAULT NULL,
  `sayduration` int(11) DEFAULT NULL,
  `forcename` enum('yes','no') DEFAULT NULL,
  `forcegreetings` enum('yes','no') DEFAULT NULL,
  `callback` varchar(80) DEFAULT NULL,
  `dialout` varchar(80) DEFAULT NULL,
  `exitcontext` varchar(80) DEFAULT NULL,
  `maxmsg` int(11) DEFAULT NULL,
  `volgain` decimal(5,2) DEFAULT NULL,
  `imapuser` varchar(80) DEFAULT NULL,
  `imappassword` varchar(80) DEFAULT NULL,
  `imapserver` varchar(80) DEFAULT NULL,
  `imapport` varchar(8) DEFAULT NULL,
  `imapflags` varchar(80) DEFAULT NULL,
  `stamp` datetime DEFAULT NULL,
  `userId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`uniqueid`),
  KEY `ast_voicemail_mailbox` (`mailbox`),
  KEY `ast_voicemail_context` (`context`),
  KEY `ast_voicemail_mailbox_context` (`mailbox`,`context`),
  KEY `ast_voicemail_imapuser` (`imapuser`),
  KEY `userId` (`userId`),
  CONSTRAINT `ast_voicemail_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `Users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ast_voicemail`
--

LOCK TABLES `ast_voicemail` WRITE;
/*!40000 ALTER TABLE `ast_voicemail` DISABLE KEYS */;
INSERT INTO `ast_voicemail` VALUES (1,'company1','user1',NULL,'Alice Allison',NULL,'alice@democompany.com',NULL,'yes',NULL,NULL,NULL,'Europe/Madrid',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(2,'company1','user2',NULL,'Bob Bobson',NULL,'bob@democompany.com',NULL,'yes',NULL,NULL,NULL,'Europe/Madrid',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,2);
/*!40000 ALTER TABLE `ast_voicemail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `changelog`
--

DROP TABLE IF EXISTS `changelog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `changelog` (
  `change_number` bigint(20) NOT NULL,
  `delta_set` varchar(10) NOT NULL,
  `start_dt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `complete_dt` timestamp NULL DEFAULT NULL,
  `applied_by` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`change_number`,`delta_set`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `changelog`
--

LOCK TABLES `changelog` WRITE;
/*!40000 ALTER TABLE `changelog` DISABLE KEYS */;
INSERT INTO `changelog` VALUES (1,'Main','2017-10-17 16:19:05','2017-10-17 16:19:05','dbdeploy','001-oasis.sql'),(2,'Main','2017-10-17 16:19:05','2017-10-17 16:19:05','dbdeploy','002-lcr-rules-key.sql'),(3,'Main','2017-10-17 16:19:05','2017-10-17 16:19:05','dbdeploy','003-e164-detection.sql'),(4,'Main','2017-10-17 16:19:05','2017-10-17 16:19:05','dbdeploy','004-extension-route-number.sql'),(5,'Main','2017-10-17 16:19:05','2017-10-17 16:19:05','dbdeploy','005-chile-calling-format.sql'),(6,'Main','2017-10-17 16:19:05','2017-10-17 16:19:05','dbdeploy','006-users-defaults.sql'),(7,'Main','2017-10-17 16:19:05','2017-10-17 16:19:05','dbdeploy','007-hints-user-extensions.sql'),(8,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','008-huntgroup-noanswer-handler.sql'),(9,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','009-sane-defaults.sql'),(10,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','010-call-fw-unique.sql'),(11,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','011-kam_users_location-models.sql'),(12,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','012-friends-table.sql'),(13,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','013-endpoints-default-context.sql'),(14,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','014-username-is-email.sql'),(15,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','015-multiddi-support.sql'),(16,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','016-merge-terminals-n-friends.sql'),(17,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','017-company-admin-unique.sql'),(18,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','018-user-email-unique.sql'),(19,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','019-optimize-index.sql'),(20,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','020-parsed-cdrs.sql'),(21,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','021-external-rater-extra-opts.sql'),(22,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','022-from_domain-astpsendpoints.sql'),(23,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','023-ddi-screen-name.sql'),(24,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','024-add-presence-modules.sql'),(25,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','025-ivr-max-digits.sql'),(26,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','026-ivr-entry-regexp.sql'),(27,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','027-mail-from-Brands.sql'),(28,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','028-disable-voicemail-password.sql'),(29,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','029-services-same-code.sql'),(30,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','030-add-language-ddi.sql'),(31,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','031-add-language-friends.sql'),(32,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','032-language-users-null.sql'),(33,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','033-recordings-disk-limit.sql'),(34,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','034-basic-queue-support.sql'),(35,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','035-features-by-brand.sql'),(36,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','036-friend-use-reinvite.sql'),(37,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','037-pricing-plan-rel-company-required-fields.sql'),(38,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','038-voice-error-notifications.sql'),(39,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','039-duid-not-used.sql'),(40,'Main','2017-10-17 16:19:06','2017-10-17 16:19:06','dbdeploy','040-kamailio-version.sql'),(41,'Main','2017-10-17 16:19:07','2017-10-17 16:19:07','dbdeploy','041-general-review.sql'),(42,'Main','2017-10-17 16:19:07','2017-10-17 16:19:07','dbdeploy','042-add-description-fixedCosts.sql'),(43,'Main','2017-10-17 16:19:07','2017-10-17 16:19:07','dbdeploy','043-company-outgoing-ddi.sql'),(44,'Main','2017-10-17 16:19:07','2017-10-17 16:19:07','dbdeploy','044-disable-lcr-strip-n-prefix.sql'),(45,'Main','2017-10-17 16:19:07','2017-10-17 16:19:07','dbdeploy','045-callwaiting-to-maxcalls.sql'),(46,'Main','2017-10-17 16:19:07','2017-10-17 16:19:07','dbdeploy','046-operators-required-fields.sql'),(47,'Main','2017-10-17 16:19:07','2017-10-17 16:19:07','dbdeploy','047-users-drop-username.sql'),(48,'Main','2017-10-17 16:19:07','2017-10-17 16:19:07','dbdeploy','048-ip-lengths.sql'),(49,'Main','2017-10-17 16:19:07','2017-10-17 16:19:07','dbdeploy','049-peerserver-name.sql'),(50,'Main','2017-10-17 16:19:07','2017-10-17 16:19:07','dbdeploy','050-add-presence-modules.sql'),(51,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','051-fix-missing-delta-041.sql'),(52,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','052-terminals-video-support.sql'),(53,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','053-active-operators.sql'),(54,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','054-retail-customers.sql'),(55,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','055-record-locution-service.sql'),(56,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','056-delete-stats-on-delete.sql'),(57,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','057-fix-notify-uri.sql'),(58,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','058-Invoice-templates-footer-and-header.sql'),(59,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','059-simplify-kam_users-view.sql'),(60,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','060-skip-ip-check-roadwarriors.sql'),(61,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','061-fix-recordings-storage-path.sql'),(62,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','062-Increase-companies-externallyExtraOpts.sql'),(63,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','063-Specific-provision-route-fix.sql'),(64,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','064-external-whiteblack-lists.sql'),(65,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','065-outgoing-ddi-rules.sql'),(66,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','066-users-add-gsQRCode.sql'),(67,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','067-voicemail-locution.sql'),(68,'Main','2017-10-17 16:19:08','2017-10-17 16:19:08','dbdeploy','068-asterisk-subscribecontext.sql'),(69,'Main','2017-10-17 16:19:09','2017-10-17 16:19:09','dbdeploy','069-conditional-routes.sql'),(70,'Main','2017-10-17 16:19:09','2017-10-17 16:19:09','dbdeploy','070-asterisk-named-pickup.sql'),(71,'Main','2017-10-17 16:36:54','2017-10-17 16:36:54','dbdeploy','071-retailaccounts-name-constraint.sql'),(72,'Main','2017-10-17 16:36:54','2017-10-17 16:36:54','dbdeploy','072-domain-length-fix.sql'),(73,'Main','2017-10-17 16:36:54','2017-10-17 16:36:54','dbdeploy','073-ast_queues-id-primary-key.sql'),(74,'Main','2017-10-17 16:36:54','2017-10-17 16:36:54','dbdeploy','074-distribute-calls.sql');
/*!40000 ALTER TABLE `changelog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_acc_cdrs`
--

DROP TABLE IF EXISTS `kam_acc_cdrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_acc_cdrs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `proxy` varchar(64) DEFAULT NULL,
  `start_time_utc` timestamp NOT NULL DEFAULT '2000-01-01 00:00:00',
  `end_time_utc` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `start_time` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `end_time` datetime NOT NULL DEFAULT '2000-01-01 00:00:00',
  `duration` float(10,3) NOT NULL DEFAULT '0.000',
  `caller` varchar(128) DEFAULT NULL,
  `callee` varchar(128) DEFAULT NULL,
  `referee` varchar(128) DEFAULT NULL,
  `referrer` varchar(128) DEFAULT NULL,
  `companyId` int(10) unsigned DEFAULT NULL,
  `brandId` int(10) unsigned DEFAULT NULL,
  `asIden` varchar(64) DEFAULT NULL,
  `asAddress` varchar(64) DEFAULT NULL,
  `callid` varchar(255) DEFAULT NULL,
  `callidHash` varchar(128) DEFAULT NULL,
  `xcallid` varchar(255) DEFAULT NULL,
  `parsed` enum('yes','no','error') DEFAULT 'no',
  `diversion` varchar(64) DEFAULT NULL,
  `peeringContractId` varchar(64) DEFAULT NULL,
  `bounced` enum('yes','no') NOT NULL DEFAULT 'no',
  `externallyRated` tinyint(1) DEFAULT NULL,
  `metered` tinyint(1) DEFAULT '0',
  `meteringDate` datetime DEFAULT '0000-00-00 00:00:00',
  `pricingPlanId` int(10) unsigned DEFAULT NULL,
  `pricingPlanName` varchar(55) DEFAULT NULL,
  `targetPatternId` int(10) unsigned DEFAULT NULL,
  `targetPatternName` varchar(55) DEFAULT NULL,
  `price` decimal(10,4) DEFAULT NULL,
  `pricingPlanDetails` text,
  `invoiceId` int(10) unsigned DEFAULT NULL,
  `direction` enum('inbound','outbound') DEFAULT NULL,
  `reMeteringDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `start_time_idx` (`start_time`),
  KEY `calldate_idx` (`end_time_utc`),
  KEY `callid_idx` (`callid`),
  KEY `xcallid_idx` (`xcallid`),
  KEY `peeringContractId_idx` (`peeringContractId`),
  KEY `pricingPlanId` (`pricingPlanId`),
  KEY `targetPatternId` (`targetPatternId`),
  KEY `invoiceId` (`invoiceId`),
  KEY `brandId` (`brandId`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `kam_acc_cdrs_ibfk_1` FOREIGN KEY (`pricingPlanId`) REFERENCES `PricingPlans` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `kam_acc_cdrs_ibfk_2` FOREIGN KEY (`targetPatternId`) REFERENCES `TargetPatterns` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `kam_acc_cdrs_ibfk_3` FOREIGN KEY (`invoiceId`) REFERENCES `Invoices` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `kam_acc_cdrs_ibfk_4` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `kam_acc_cdrs_ibfk_5` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_acc_cdrs`
--

LOCK TABLES `kam_acc_cdrs` WRITE;
/*!40000 ALTER TABLE `kam_acc_cdrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_acc_cdrs` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'NO_AUTO_VALUE_ON_ZERO' */ ;

--
-- Table structure for table `kam_dispatcher`
--

DROP TABLE IF EXISTS `kam_dispatcher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_dispatcher` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setid` int(11) NOT NULL DEFAULT '0',
  `destination` varchar(192) NOT NULL DEFAULT '',
  `flags` int(11) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL DEFAULT '0',
  `attrs` varchar(128) NOT NULL DEFAULT '',
  `description` varchar(64) NOT NULL DEFAULT '',
  `applicationServerId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `applicationServerId` (`applicationServerId`),
  CONSTRAINT `kam_dispatcher_ibfk_1` FOREIGN KEY (`applicationServerId`) REFERENCES `ApplicationServers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_dispatcher`
--

LOCK TABLES `kam_dispatcher` WRITE;
/*!40000 ALTER TABLE `kam_dispatcher` DISABLE KEYS */;
INSERT INTO `kam_dispatcher` VALUES (1,1,'sip:127.0.0.1:6060',0,0,'','as001',1);
/*!40000 ALTER TABLE `kam_dispatcher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_pike_trusted`
--

DROP TABLE IF EXISTS `kam_pike_trusted`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_pike_trusted` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `src_ip` varchar(50) DEFAULT NULL,
  `proto` varchar(4) DEFAULT NULL,
  `from_pattern` varchar(64) DEFAULT NULL,
  `ruri_pattern` varchar(64) DEFAULT NULL,
  `tag` varchar(64) DEFAULT NULL,
  `priority` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_pike_trusted`
--

LOCK TABLES `kam_pike_trusted` WRITE;
/*!40000 ALTER TABLE `kam_pike_trusted` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_pike_trusted` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_rtpproxy`
--

DROP TABLE IF EXISTS `kam_rtpproxy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_rtpproxy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setid` varchar(32) NOT NULL DEFAULT '0',
  `url` varchar(128) NOT NULL,
  `flags` int(10) unsigned NOT NULL DEFAULT '0',
  `weight` int(10) unsigned NOT NULL DEFAULT '1',
  `description` varchar(200) DEFAULT NULL,
  `mediaRelaySetsId` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mediaRelaySetsId` (`mediaRelaySetsId`),
  CONSTRAINT `kam_rtpproxy_ibfk_1` FOREIGN KEY (`mediaRelaySetsId`) REFERENCES `MediaRelaySets` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_rtpproxy`
--

LOCK TABLES `kam_rtpproxy` WRITE;
/*!40000 ALTER TABLE `kam_rtpproxy` DISABLE KEYS */;
INSERT INTO `kam_rtpproxy` VALUES (0,'0','udp:127.0.0.1:22222',0,1,'Local media relay',0);
/*!40000 ALTER TABLE `kam_rtpproxy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_trunks_acc`
--

DROP TABLE IF EXISTS `kam_trunks_acc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_trunks_acc` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `method` varchar(16) NOT NULL DEFAULT '',
  `from_tag` varchar(64) NOT NULL DEFAULT '',
  `to_tag` varchar(64) NOT NULL DEFAULT '',
  `callid` varchar(255) NOT NULL DEFAULT '',
  `sip_code` varchar(3) NOT NULL DEFAULT '',
  `sip_reason` varchar(128) NOT NULL DEFAULT '',
  `src_ip` varchar(64) DEFAULT NULL,
  `from_user` varchar(64) DEFAULT NULL,
  `from_domain` varchar(64) DEFAULT NULL,
  `ruri_user` varchar(64) DEFAULT NULL,
  `ruri_domain` varchar(64) DEFAULT NULL,
  `cseq` int(10) unsigned DEFAULT NULL,
  `localtime` datetime NOT NULL,
  `utctime` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `callid_idx` (`callid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_trunks_acc`
--

LOCK TABLES `kam_trunks_acc` WRITE;
/*!40000 ALTER TABLE `kam_trunks_acc` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_trunks_acc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_trunks_address`
--

DROP TABLE IF EXISTS `kam_trunks_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_trunks_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `grp` int(11) unsigned NOT NULL DEFAULT '1',
  `ip_addr` varchar(50) DEFAULT NULL,
  `mask` int(10) NOT NULL DEFAULT '32',
  `port` int(5) NOT NULL DEFAULT '0',
  `tag` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `grp` (`grp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_trunks_address`
--

LOCK TABLES `kam_trunks_address` WRITE;
/*!40000 ALTER TABLE `kam_trunks_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_trunks_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_trunks_dialplan`
--

DROP TABLE IF EXISTS `kam_trunks_dialplan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_trunks_dialplan` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dpid` int(11) NOT NULL,
  `pr` int(11) NOT NULL,
  `match_op` int(11) NOT NULL,
  `match_exp` varchar(64) NOT NULL,
  `match_len` int(11) NOT NULL,
  `subst_exp` varchar(64) NOT NULL,
  `repl_exp` varchar(64) NOT NULL,
  `attrs` varchar(64) NOT NULL,
  `transformationRulesetGroupsTrunksId` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `kam_trunks_dialplan_ibfk_2` (`transformationRulesetGroupsTrunksId`),
  CONSTRAINT `kam_trunks_dialplan_ibfk_2` FOREIGN KEY (`transformationRulesetGroupsTrunksId`) REFERENCES `TransformationRulesetGroupsTrunks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_trunks_dialplan`
--

LOCK TABLES `kam_trunks_dialplan` WRITE;
/*!40000 ALTER TABLE `kam_trunks_dialplan` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_trunks_dialplan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `kam_trunks_domain`
--

DROP TABLE IF EXISTS `kam_trunks_domain`;
/*!50001 DROP VIEW IF EXISTS `kam_trunks_domain`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `kam_trunks_domain` (
  `domain` tinyint NOT NULL,
  `did` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `kam_trunks_domain_attrs`
--

DROP TABLE IF EXISTS `kam_trunks_domain_attrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_trunks_domain_attrs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `did` varchar(190) NOT NULL,
  `name` varchar(32) NOT NULL,
  `type` int(10) unsigned NOT NULL,
  `value` varchar(255) NOT NULL,
  `last_modified` datetime NOT NULL DEFAULT '1900-01-01 00:00:01',
  PRIMARY KEY (`id`),
  UNIQUE KEY `domain_attrs_idx` (`did`,`name`,`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_trunks_domain_attrs`
--

LOCK TABLES `kam_trunks_domain_attrs` WRITE;
/*!40000 ALTER TABLE `kam_trunks_domain_attrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_trunks_domain_attrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_trunks_htable`
--

DROP TABLE IF EXISTS `kam_trunks_htable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_trunks_htable` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key_name` varchar(64) NOT NULL DEFAULT '',
  `key_type` int(11) NOT NULL DEFAULT '0',
  `value_type` int(11) NOT NULL DEFAULT '0',
  `key_value` varchar(128) NOT NULL DEFAULT '',
  `expires` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_trunks_htable`
--

LOCK TABLES `kam_trunks_htable` WRITE;
/*!40000 ALTER TABLE `kam_trunks_htable` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_trunks_htable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_trunks_uacreg`
--

DROP TABLE IF EXISTS `kam_trunks_uacreg`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_trunks_uacreg` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `l_uuid` varchar(64) NOT NULL DEFAULT '',
  `l_username` varchar(64) NOT NULL DEFAULT 'unused',
  `l_domain` varchar(190) NOT NULL DEFAULT 'unused',
  `r_username` varchar(64) NOT NULL DEFAULT '',
  `r_domain` varchar(190) NOT NULL DEFAULT '',
  `realm` varchar(64) NOT NULL DEFAULT '',
  `auth_username` varchar(64) NOT NULL DEFAULT '',
  `auth_password` varchar(64) NOT NULL DEFAULT '',
  `auth_proxy` varchar(64) NOT NULL DEFAULT '',
  `expires` int(11) NOT NULL DEFAULT '0',
  `flags` int(11) NOT NULL DEFAULT '0',
  `reg_delay` int(11) NOT NULL DEFAULT '0',
  `brandId` int(10) unsigned NOT NULL,
  `peeringContractId` int(10) unsigned NOT NULL,
  `multiDDI` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `l_uuid_idx` (`l_uuid`),
  KEY `brandId` (`brandId`),
  KEY `peeringContractId` (`peeringContractId`),
  CONSTRAINT `kam_trunks_uacreg_ibfk_1` FOREIGN KEY (`brandId`) REFERENCES `Brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `kam_trunks_uacreg_ibfk_2` FOREIGN KEY (`peeringContractId`) REFERENCES `PeeringContracts` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_trunks_uacreg`
--

LOCK TABLES `kam_trunks_uacreg` WRITE;
/*!40000 ALTER TABLE `kam_trunks_uacreg` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_trunks_uacreg` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `kam_users`
--

DROP TABLE IF EXISTS `kam_users`;
/*!50001 DROP VIEW IF EXISTS `kam_users`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `kam_users` (
  `type` tinyint NOT NULL,
  `name` tinyint NOT NULL,
  `domain` tinyint NOT NULL,
  `password` tinyint NOT NULL,
  `companyId` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `kam_users_acc`
--

DROP TABLE IF EXISTS `kam_users_acc`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_users_acc` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `method` varchar(16) NOT NULL DEFAULT '',
  `from_tag` varchar(64) NOT NULL DEFAULT '',
  `to_tag` varchar(64) NOT NULL DEFAULT '',
  `callid` varchar(255) NOT NULL DEFAULT '',
  `sip_code` varchar(3) NOT NULL DEFAULT '',
  `sip_reason` varchar(128) NOT NULL DEFAULT '',
  `src_ip` varchar(64) DEFAULT NULL,
  `from_user` varchar(64) DEFAULT NULL,
  `from_domain` varchar(190) DEFAULT NULL,
  `ruri_user` varchar(64) DEFAULT NULL,
  `ruri_domain` varchar(190) DEFAULT NULL,
  `cseq` int(10) unsigned DEFAULT NULL,
  `localtime` datetime NOT NULL,
  `utctime` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `callid_idx` (`callid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_users_acc`
--

LOCK TABLES `kam_users_acc` WRITE;
/*!40000 ALTER TABLE `kam_users_acc` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_users_acc` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_users_active_watchers`
--

DROP TABLE IF EXISTS `kam_users_active_watchers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_users_active_watchers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `presentity_uri` varchar(128) NOT NULL,
  `watcher_username` varchar(64) NOT NULL,
  `watcher_domain` varchar(64) NOT NULL,
  `to_user` varchar(64) NOT NULL,
  `to_domain` varchar(190) NOT NULL,
  `event` varchar(64) NOT NULL DEFAULT 'presence',
  `event_id` varchar(64) DEFAULT NULL,
  `to_tag` varchar(64) NOT NULL,
  `from_tag` varchar(64) NOT NULL,
  `callid` varchar(255) NOT NULL,
  `local_cseq` int(11) NOT NULL,
  `remote_cseq` int(11) NOT NULL,
  `contact` varchar(128) NOT NULL,
  `record_route` text,
  `expires` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '2',
  `reason` varchar(64) NOT NULL,
  `version` int(11) NOT NULL DEFAULT '0',
  `socket_info` varchar(64) NOT NULL,
  `local_contact` varchar(128) NOT NULL,
  `from_user` varchar(64) NOT NULL,
  `from_domain` varchar(190) NOT NULL,
  `updated` int(11) NOT NULL,
  `updated_winfo` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `kam_users_active_watchers_idx` (`callid`,`to_tag`,`from_tag`),
  KEY `kam_users_active_watchers_expires` (`expires`),
  KEY `kam_users_active_watchers_pres` (`presentity_uri`,`event`),
  KEY `updated_idx` (`updated`),
  KEY `updated_winfo_idx` (`updated_winfo`,`presentity_uri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_users_active_watchers`
--

LOCK TABLES `kam_users_active_watchers` WRITE;
/*!40000 ALTER TABLE `kam_users_active_watchers` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_users_active_watchers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_users_address`
--

DROP TABLE IF EXISTS `kam_users_address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_users_address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyId` int(10) unsigned NOT NULL,
  `source_address` varchar(100) NOT NULL,
  `ip_addr` varchar(50) DEFAULT NULL,
  `mask` int(10) NOT NULL DEFAULT '32',
  `port` int(5) NOT NULL DEFAULT '0',
  `tag` varchar(64) DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  CONSTRAINT `kam_users_address_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_users_address`
--

LOCK TABLES `kam_users_address` WRITE;
/*!40000 ALTER TABLE `kam_users_address` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_users_address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `kam_users_domain`
--

DROP TABLE IF EXISTS `kam_users_domain`;
/*!50001 DROP VIEW IF EXISTS `kam_users_domain`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `kam_users_domain` (
  `domain` tinyint NOT NULL,
  `did` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `kam_users_domain_attrs`
--

DROP TABLE IF EXISTS `kam_users_domain_attrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_users_domain_attrs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `did` varchar(190) NOT NULL,
  `name` varchar(32) NOT NULL,
  `type` int(10) unsigned NOT NULL,
  `value` varchar(255) NOT NULL,
  `last_modified` datetime NOT NULL DEFAULT '1900-01-01 00:00:01',
  PRIMARY KEY (`id`),
  UNIQUE KEY `domain_attrs_idx` (`did`,`name`,`value`),
  CONSTRAINT `kam_users_domain_attrs_ibfk_1` FOREIGN KEY (`did`) REFERENCES `Domains` (`domain`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_users_domain_attrs`
--

LOCK TABLES `kam_users_domain_attrs` WRITE;
/*!40000 ALTER TABLE `kam_users_domain_attrs` DISABLE KEYS */;
INSERT INTO `kam_users_domain_attrs` VALUES (2,'127.0.0.1','brandId',0,'1','1900-01-01 00:00:01');
/*!40000 ALTER TABLE `kam_users_domain_attrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `kam_users_exten`
--

DROP TABLE IF EXISTS `kam_users_exten`;
/*!50001 DROP VIEW IF EXISTS `kam_users_exten`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `kam_users_exten` (
  `name` tinyint NOT NULL,
  `domain` tinyint NOT NULL,
  `extension` tinyint NOT NULL,
  `externalIpCalls` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `kam_users_htable`
--

DROP TABLE IF EXISTS `kam_users_htable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_users_htable` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key_name` varchar(64) NOT NULL DEFAULT '',
  `key_type` int(11) NOT NULL DEFAULT '0',
  `value_type` int(11) NOT NULL DEFAULT '0',
  `key_value` varchar(128) NOT NULL DEFAULT '',
  `expires` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_users_htable`
--

LOCK TABLES `kam_users_htable` WRITE;
/*!40000 ALTER TABLE `kam_users_htable` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_users_htable` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_users_location`
--

DROP TABLE IF EXISTS `kam_users_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_users_location` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ruid` varchar(64) NOT NULL DEFAULT '',
  `username` varchar(64) NOT NULL DEFAULT '',
  `domain` varchar(190) DEFAULT NULL,
  `contact` varchar(255) NOT NULL DEFAULT '',
  `received` varchar(128) DEFAULT NULL,
  `path` varchar(512) DEFAULT NULL,
  `expires` datetime NOT NULL DEFAULT '2030-05-28 21:32:15',
  `q` float(10,2) NOT NULL DEFAULT '1.00',
  `callid` varchar(255) NOT NULL DEFAULT 'Default-Call-ID',
  `cseq` int(11) NOT NULL DEFAULT '1',
  `last_modified` datetime NOT NULL DEFAULT '1900-01-01 00:00:01',
  `flags` int(11) NOT NULL DEFAULT '0',
  `cflags` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(255) NOT NULL DEFAULT '',
  `socket` varchar(64) DEFAULT NULL,
  `methods` int(11) DEFAULT NULL,
  `instance` varchar(255) DEFAULT NULL,
  `reg_id` int(11) NOT NULL DEFAULT '0',
  `server_id` int(11) NOT NULL DEFAULT '0',
  `connection_id` int(11) NOT NULL DEFAULT '0',
  `keepalive` int(11) NOT NULL DEFAULT '0',
  `partition` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ruid_idx` (`ruid`),
  KEY `account_contact_idx` (`username`,`domain`,`contact`),
  KEY `expires_idx` (`expires`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity][rest]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_users_location`
--

LOCK TABLES `kam_users_location` WRITE;
/*!40000 ALTER TABLE `kam_users_location` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_users_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_users_location_attrs`
--

DROP TABLE IF EXISTS `kam_users_location_attrs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_users_location_attrs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ruid` varchar(64) NOT NULL DEFAULT '',
  `username` varchar(64) NOT NULL DEFAULT '',
  `domain` varchar(190) DEFAULT NULL,
  `aname` varchar(64) NOT NULL DEFAULT '',
  `atype` int(11) NOT NULL DEFAULT '0',
  `avalue` varchar(255) NOT NULL DEFAULT '',
  `last_modified` datetime NOT NULL DEFAULT '1900-01-01 00:00:01',
  PRIMARY KEY (`id`),
  KEY `account_record_idx` (`username`,`domain`,`ruid`),
  KEY `last_modified_idx` (`last_modified`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_users_location_attrs`
--

LOCK TABLES `kam_users_location_attrs` WRITE;
/*!40000 ALTER TABLE `kam_users_location_attrs` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_users_location_attrs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_users_missed_calls`
--

DROP TABLE IF EXISTS `kam_users_missed_calls`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_users_missed_calls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `method` varchar(16) NOT NULL DEFAULT '',
  `from_tag` varchar(64) NOT NULL DEFAULT '',
  `to_tag` varchar(64) NOT NULL DEFAULT '',
  `callid` varchar(255) NOT NULL DEFAULT '',
  `sip_code` varchar(3) NOT NULL DEFAULT '',
  `sip_reason` varchar(128) NOT NULL DEFAULT '',
  `src_ip` varchar(64) DEFAULT NULL,
  `from_user` varchar(64) DEFAULT NULL,
  `from_domain` varchar(190) DEFAULT NULL,
  `ruri_user` varchar(64) DEFAULT NULL,
  `ruri_domain` varchar(190) DEFAULT NULL,
  `cseq` int(10) unsigned DEFAULT NULL,
  `localtime` datetime NOT NULL,
  `utctime` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `callid_idx` (`callid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_users_missed_calls`
--

LOCK TABLES `kam_users_missed_calls` WRITE;
/*!40000 ALTER TABLE `kam_users_missed_calls` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_users_missed_calls` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_users_presentity`
--

DROP TABLE IF EXISTS `kam_users_presentity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_users_presentity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `domain` varchar(190) NOT NULL,
  `event` varchar(64) NOT NULL,
  `etag` varchar(64) NOT NULL,
  `expires` int(11) NOT NULL,
  `received_time` int(11) NOT NULL,
  `body` blob NOT NULL,
  `sender` varchar(128) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `kam_users_presentity_idx` (`username`,`domain`,`event`,`etag`),
  KEY `kam_users_presentity_expires` (`expires`),
  KEY `account_idx` (`username`,`domain`,`event`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_users_presentity`
--

LOCK TABLES `kam_users_presentity` WRITE;
/*!40000 ALTER TABLE `kam_users_presentity` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_users_presentity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_users_pua`
--

DROP TABLE IF EXISTS `kam_users_pua`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_users_pua` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pres_uri` varchar(128) NOT NULL,
  `pres_id` varchar(255) NOT NULL,
  `event` int(11) NOT NULL,
  `expires` int(11) NOT NULL,
  `desired_expires` int(11) NOT NULL,
  `flag` int(11) NOT NULL,
  `etag` varchar(64) NOT NULL,
  `tuple_id` varchar(64) DEFAULT NULL,
  `watcher_uri` varchar(128) NOT NULL,
  `call_id` varchar(255) NOT NULL,
  `to_tag` varchar(64) NOT NULL,
  `from_tag` varchar(64) NOT NULL,
  `cseq` int(11) NOT NULL,
  `record_route` text,
  `contact` varchar(128) NOT NULL,
  `remote_contact` varchar(128) NOT NULL,
  `version` int(11) NOT NULL,
  `extra_headers` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kam_users_pua_idx` (`etag`,`tuple_id`,`call_id`,`from_tag`),
  KEY `expires_idx` (`expires`),
  KEY `dialog1_idx` (`pres_id`,`pres_uri`),
  KEY `dialog2_idx` (`call_id`,`from_tag`),
  KEY `record_idx` (`pres_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_users_pua`
--

LOCK TABLES `kam_users_pua` WRITE;
/*!40000 ALTER TABLE `kam_users_pua` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_users_pua` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_users_watchers`
--

DROP TABLE IF EXISTS `kam_users_watchers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_users_watchers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `presentity_uri` varchar(128) NOT NULL,
  `watcher_username` varchar(64) NOT NULL,
  `watcher_domain` varchar(190) NOT NULL,
  `event` varchar(64) NOT NULL DEFAULT 'presence',
  `status` int(11) NOT NULL,
  `reason` varchar(64) DEFAULT NULL,
  `inserted_time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kam_users_watchers_idx` (`presentity_uri`,`watcher_username`,`watcher_domain`,`event`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_users_watchers`
--

LOCK TABLES `kam_users_watchers` WRITE;
/*!40000 ALTER TABLE `kam_users_watchers` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_users_watchers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_users_xcap`
--

DROP TABLE IF EXISTS `kam_users_xcap`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_users_xcap` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `domain` varchar(190) NOT NULL,
  `doc` mediumblob NOT NULL,
  `doc_type` int(11) NOT NULL,
  `etag` varchar(64) NOT NULL,
  `source` int(11) NOT NULL,
  `doc_uri` varchar(255) NOT NULL,
  `port` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `doc_uri_idx` (`doc_uri`),
  KEY `account_doc_type_idx` (`username`,`domain`,`doc_type`),
  KEY `account_doc_type_uri_idx` (`username`,`domain`,`doc_type`,`doc_uri`),
  KEY `account_doc_uri_idx` (`username`,`domain`,`doc_uri`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_users_xcap`
--

LOCK TABLES `kam_users_xcap` WRITE;
/*!40000 ALTER TABLE `kam_users_xcap` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_users_xcap` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kam_version`
--

DROP TABLE IF EXISTS `kam_version`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kam_version` (
  `table_name` varchar(32) NOT NULL,
  `table_version` int(10) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `table_name_idx` (`table_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[ignore]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_version`
--

LOCK TABLES `kam_version` WRITE;
/*!40000 ALTER TABLE `kam_version` DISABLE KEYS */;
INSERT INTO `kam_version` VALUES ('kam_acc_cdrs',2),('kam_dispatcher',4),('kam_pike_trusted',6),('kam_rtpproxy',1),('kam_trunks_acc',5),('kam_trunks_address',6),('kam_trunks_dialplan',2),('kam_trunks_domain',2),('kam_trunks_domain_attrs',1),('kam_trunks_htable',2),('kam_trunks_uacreg',2),('kam_users_acc',5),('kam_users_active_watchers',12),('kam_users_address',6),('kam_users_domain',2),('kam_users_domain_attrs',1),('kam_users_htable',2),('kam_users_location',8),('kam_users_location_attrs',1),('kam_users_missed_calls',4),('kam_users_presentity',4),('kam_users_pua',7),('kam_users_watchers',3),('kam_users_xcap',4),('LcrGateways',3),('LcrRules',2),('LcrRuleTargets',1);
/*!40000 ALTER TABLE `kam_version` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `BillableCalls`
--

/*!50001 DROP TABLE IF EXISTS `BillableCalls`*/;
/*!50001 DROP VIEW IF EXISTS `BillableCalls`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `BillableCalls` AS (select `kam_acc_cdrs`.`id` AS `id`,`kam_acc_cdrs`.`proxy` AS `proxy`,`kam_acc_cdrs`.`start_time_utc` AS `start_time_utc`,`kam_acc_cdrs`.`end_time_utc` AS `end_time_utc`,`kam_acc_cdrs`.`start_time` AS `start_time`,`kam_acc_cdrs`.`end_time` AS `end_time`,`kam_acc_cdrs`.`duration` AS `duration`,`kam_acc_cdrs`.`caller` AS `caller`,`kam_acc_cdrs`.`callee` AS `callee`,`kam_acc_cdrs`.`referee` AS `referee`,`kam_acc_cdrs`.`referrer` AS `referrer`,`kam_acc_cdrs`.`companyId` AS `companyId`,`kam_acc_cdrs`.`brandId` AS `brandId`,`kam_acc_cdrs`.`asIden` AS `asIden`,`kam_acc_cdrs`.`asAddress` AS `asAddress`,`kam_acc_cdrs`.`callid` AS `callid`,`kam_acc_cdrs`.`callidHash` AS `callidHash`,`kam_acc_cdrs`.`xcallid` AS `xcallid`,`kam_acc_cdrs`.`parsed` AS `parsed`,`kam_acc_cdrs`.`diversion` AS `diversion`,`kam_acc_cdrs`.`peeringContractId` AS `peeringContractId`,`kam_acc_cdrs`.`bounced` AS `bounced`,`kam_acc_cdrs`.`externallyRated` AS `externallyRated`,`kam_acc_cdrs`.`metered` AS `metered`,`kam_acc_cdrs`.`meteringDate` AS `meteringDate`,`kam_acc_cdrs`.`pricingPlanId` AS `pricingPlanId`,`kam_acc_cdrs`.`pricingPlanName` AS `pricingPlanName`,`kam_acc_cdrs`.`targetPatternId` AS `targetPatternId`,`kam_acc_cdrs`.`targetPatternName` AS `targetPatternName`,`kam_acc_cdrs`.`price` AS `price`,`kam_acc_cdrs`.`pricingPlanDetails` AS `pricingPlanDetails`,`kam_acc_cdrs`.`invoiceId` AS `invoiceId`,`kam_acc_cdrs`.`direction` AS `direction`,`kam_acc_cdrs`.`reMeteringDate` AS `reMeteringDate` from `kam_acc_cdrs` where ((`kam_acc_cdrs`.`peeringContractId` is not null) and (`kam_acc_cdrs`.`peeringContractId` <> ''))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `ast_hints`
--

/*!50001 DROP TABLE IF EXISTS `ast_hints`*/;
/*!50001 DROP VIEW IF EXISTS `ast_hints`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `ast_hints` AS select `e`.`number` AS `exten`,concat('company',`e`.`companyId`) AS `context`,concat('PJSIP/',`a`.`sorcery_id`) AS `device` from (((`Extensions` `e` join `Users` `u` on((`u`.`id` = `e`.`userId`))) join `Terminals` `t` on((`t`.`id` = `u`.`terminalId`))) join `ast_ps_endpoints` `a` on((`a`.`terminalId` = `t`.`id`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `kam_trunks_domain`
--

/*!50001 DROP TABLE IF EXISTS `kam_trunks_domain`*/;
/*!50001 DROP VIEW IF EXISTS `kam_trunks_domain`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `kam_trunks_domain` AS select `Domains`.`domain` AS `domain`,NULL AS `did` from `Domains` where (`Domains`.`pointsTo` = 'proxytrunks') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `kam_users`
--

/*!50001 DROP TABLE IF EXISTS `kam_users`*/;
/*!50001 DROP VIEW IF EXISTS `kam_users`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `kam_users` AS select 'friend' AS `type`,`Friends`.`name` AS `name`,`Friends`.`domain` AS `domain`,`Friends`.`password` AS `password`,`Friends`.`companyId` AS `companyId` from `Friends` union select 'terminal' AS `type`,`Terminals`.`name` AS `name`,`Terminals`.`domain` AS `domain`,`Terminals`.`password` AS `password`,`Terminals`.`companyId` AS `companyId` from `Terminals` union select 'retail' AS `type`,`RetailAccounts`.`name` AS `name`,`RetailAccounts`.`domain` AS `domain`,`RetailAccounts`.`password` AS `password`,`RetailAccounts`.`companyId` AS `companyId` from `RetailAccounts` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `kam_users_domain`
--

/*!50001 DROP TABLE IF EXISTS `kam_users_domain`*/;
/*!50001 DROP VIEW IF EXISTS `kam_users_domain`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `kam_users_domain` AS select `Domains`.`domain` AS `domain`,NULL AS `did` from `Domains` where (`Domains`.`pointsTo` = 'proxyusers') */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `kam_users_exten`
--

/*!50001 DROP TABLE IF EXISTS `kam_users_exten`*/;
/*!50001 DROP VIEW IF EXISTS `kam_users_exten`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `kam_users_exten` AS select `T`.`name` AS `name`,`T`.`domain` AS `domain`,`E`.`number` AS `extension`,`U`.`externalIpCalls` AS `externalIpCalls` from ((`Users` `U` join `Terminals` `T` on((`T`.`id` = `U`.`terminalId`))) join `Extensions` `E` on((`E`.`id` = `U`.`extensionId`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-17 18:49:50

-- Add needed users to db
GRANT USAGE ON *.* TO 'asterisk'@'%' IDENTIFIED BY PASSWORD '*B1745AABE8FF81695592076E0F0D90D3FAB17F67';
GRANT ALL PRIVILEGES ON `ivozprovider`.* TO 'asterisk'@'%';
GRANT USAGE ON *.* TO 'kamailio'@'%' IDENTIFIED BY PASSWORD '*B1745AABE8FF81695592076E0F0D90D3FAB17F67';
GRANT ALL PRIVILEGES ON `ivozprovider`.* TO 'kamailio'@'%';
