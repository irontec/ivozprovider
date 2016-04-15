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
-- Table structure for table `ast_ps_aors`
--

DROP TABLE IF EXISTS `ast_ps_aors`;
DROP VIEW IF EXISTS `ast_ps_aors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ast_ps_aors` (
  `id` binary(36) NOT NULL COMMENT '[uuid:php]',
  `sorcery_id` varchar(40) NOT NULL,
  `default_expiration` int(11) DEFAULT NULL,
  `max_contacts` int(11) DEFAULT NULL,
  `minimum_expiration` int(11) DEFAULT NULL,
  `remove_existing` enum('yes','no') DEFAULT NULL,
  `authenticate_qualify` enum('yes','no') DEFAULT NULL,
  `maximum_expiration` int(11) DEFAULT NULL,
  `support_path` enum('yes','no') DEFAULT NULL,
  `contact` varchar(40) DEFAULT NULL,
  `qualify_frequency` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sorcery_id` (`sorcery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ast_ps_contacts`
--

DROP TABLE IF EXISTS `ast_ps_contacts`;
DROP VIEW IF EXISTS `ast_ps_contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ast_ps_contacts` (
  `sorcery_id` varchar(40) NOT NULL,
  `uri` varchar(255) DEFAULT NULL,
  `expiration_time` varchar(40) DEFAULT NULL,
  `qualify_frequency` int(11) DEFAULT NULL,
  `qualify_timeout` int(11) DEFAULT NULL,
  `outbound_proxy` varchar(40) DEFAULT NULL,
  `path` text,
  `user_agent` varchar(255) DEFAULT NULL,
  UNIQUE KEY `sorcery_id` (`sorcery_id`),
  KEY `ast_ps_contacts_id` (`sorcery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ast_ps_endpoints`
--

DROP TABLE IF EXISTS `ast_ps_endpoints`;
DROP VIEW IF EXISTS `ast_ps_endpoints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ast_ps_endpoints` (
  `id` binary(36) NOT NULL COMMENT '[uuid:php]',
  `sorcery_id` varchar(40) NOT NULL,
  `transport` varchar(40) DEFAULT NULL,
  `aors` varchar(200) DEFAULT NULL,
  `auth` varchar(40) DEFAULT NULL,
  `context` varchar(40) NOT NULL DEFAULT 'outgoing',
  `disallow` varchar(200) NOT NULL DEFAULT 'all',
  `allow` varchar(200) NOT NULL DEFAULT 'all',
  `direct_media` enum('yes','no') DEFAULT 'yes',
  `direct_media_method` enum('invite','reinvite','update') DEFAULT 'update' COMMENT '[enum:update|invite|reinvite]',
  `dtmf_mode` enum('rfc4733','inband','info') DEFAULT NULL,
  `mailboxes` varchar(100) DEFAULT NULL,
  `send_diversion` enum('yes','no') DEFAULT NULL,
  `send_pai` enum('yes','no') DEFAULT NULL,
  `send_rpid` enum('yes','no') DEFAULT NULL,
  `subscribecontext` varchar(40) NOT NULL DEFAULT 'default',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sorcery_id` (`sorcery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `ast_ps_identify`
--

DROP TABLE IF EXISTS `ast_ps_identify`;
DROP VIEW IF EXISTS `ast_ps_identify`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ast_ps_identify` (
  `id` binary(36) NOT NULL COMMENT '[uuid:php]',
  `sorcery_id` varchar(40) NOT NULL,
  `endpoint` varchar(40) DEFAULT NULL,
  `match` varchar(80) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`sorcery_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `Terminals`
--

DROP TABLE IF EXISTS `Terminals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Terminals` (
  `id` binary(36) NOT NULL COMMENT '[uuid:php]',
  `TerminalModelId` binary(36) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `allow` varchar(200) NOT NULL DEFAULT 'alaw',
  `direct_media` enum('yes','no') NOT NULL DEFAULT 'yes',
  `password` varchar(25) NOT NULL DEFAULT '' COMMENT '[password]',
  `companyId` binary(36) NOT NULL,
  `mac` varchar(12) DEFAULT NULL,
  `lastProvisionDate` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `TerminalModelId` (`TerminalModelId`),
  KEY `Terminals_CompanyId_ibfk_2` (`companyId`),
  CONSTRAINT `Terminals_CompanyId_ibfk_2` FOREIGN KEY (`companyId`) REFERENCES `Companies` (`id`) ON DELETE CASCADE,
  CONSTRAINT `Terminals_ibfk_1` FOREIGN KEY (`TerminalModelId`) REFERENCES `TerminalModels` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `proxyTrunks`
--

DROP TABLE IF EXISTS `proxyTrunks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proxyTrunks` (
  `id` binary(36) NOT NULL COMMENT '[uuid:php]',
  `name` varchar(100) DEFAULT NULL,
  `ip` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ip` (`ip`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='[entity]';
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-15 16:09:32
