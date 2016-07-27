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

LOCK TABLES `TransformationRulesetGroupsTrunks` WRITE;
/*!40000 ALTER TABLE `TransformationRulesetGroupsTrunks` DISABLE KEYS */;
INSERT IGNORE INTO `TransformationRulesetGroupsTrunks` VALUES (1,1,'Operador español',2,1,4,3,'Operador español');
/*!40000 ALTER TABLE `TransformationRulesetGroupsTrunks` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

LOCK TABLES `kam_trunks_dialplan` WRITE;
/*!40000 ALTER TABLE `kam_trunks_dialplan` DISABLE KEYS */;
INSERT IGNORE INTO `kam_trunks_dialplan` VALUES (1,1,1,1,'^(00|\\+)([1-9][0-9]+)$',0,'^(00|\\+)([1-9][0-9]+)$','\\2','International to E.164',1),(2,1,2,1,'^([1-9][0-9]{8})$',0,'^([1-9][0-9]{8})$','34\\1','Nacional to E.164',1),(3,2,1,1,'^(00|\\+)([1-9][0-9]+)$',0,'^(00|\\+)([1-9][0-9]+)$','\\2','International to E.164',1),(4,2,2,1,'^([1-9][0-9]{8})$',0,'^([1-9][0-9]{8})$','34\\1','Nacional to E.164',1),(5,3,1,1,'^34([0-9]+)$',0,'^34([0-9]+)$','\\1','E164 to National',1),(6,4,1,1,'^34([0-9]+)$',0,'^34([0-9]+)$','\\1','E164 to National',1);
/*!40000 ALTER TABLE `kam_trunks_dialplan` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

