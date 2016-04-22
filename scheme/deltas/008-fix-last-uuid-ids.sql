-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: ivozprovider
-- ------------------------------------------------------
-- Server version	5.5.47-0+deb8u1

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kam_dispatcher`
--

LOCK TABLES `kam_dispatcher` WRITE;
/*!40000 ALTER TABLE `kam_dispatcher` DISABLE KEYS */;
/*!40000 ALTER TABLE `kam_dispatcher` ENABLE KEYS */;
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
  `username` varchar(50) NOT NULL,
  `pass` varchar(80) NOT NULL COMMENT '[password]',
  `email` varchar(100) NOT NULL DEFAULT '',
  `active` tinyint(1) DEFAULT '1',
  `timezoneId` int(10) unsigned NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `companyId` (`companyId`),
  KEY `timezoneId` (`timezoneId`),
  CONSTRAINT `CompanyAdmins_ibfk_1` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `CompanyAdmins_ibfk_2` FOREIGN KEY (`timezoneId`) REFERENCES `Timezones` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CompanyAdmins`
--

LOCK TABLES `CompanyAdmins` WRITE;
/*!40000 ALTER TABLE `CompanyAdmins` DISABLE KEYS */;
/*!40000 ALTER TABLE `CompanyAdmins` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-22 16:50:57
