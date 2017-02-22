-- MySQL dump 10.13  Distrib 5.6.35, for FreeBSD11.0 (amd64)
--
-- Host: localhost    Database: DNS
-- ------------------------------------------------------
-- Server version	5.6.35

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
-- Table structure for table `users_info`
--

DROP TABLE IF EXISTS `users_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(40) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `hash` char(129) NOT NULL,
  `salt` char(16) NOT NULL,
  `sex` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nickname` (`nickname`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_info`
--

LOCK TABLES `users_info` WRITE;
/*!40000 ALTER TABLE `users_info` DISABLE KEYS */;
INSERT INTO `users_info` VALUES (8,'luobo','mengyi','sulitsrc@foxmail.com','$6$zuZhDEy8eVkAm6Ox$PShTdP6J36d1EPKMrTj3ZG23SHYRrpQEQapIlZ/CbtYg4CDgdo1w8hq2s5/IjtfQNB0CCbvgi0FOK8y8G3Q2l0','zuZhDEy8eVkAm6Ox','1'),(9,'sulit','mengyi','sulitsrc@163.com','$6$OUdyqkhh7hVYc402$bO9EdlXV6cHmVid4BWbpnsrq3jzYppr3bmJvuTZ/96MSoTPKd.mHEfIUVd9yA422WEqVrrBSZwQAbuj.hDUcX/','OUdyqkhh7hVYc402','1');
/*!40000 ALTER TABLE `users_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dns_records`
--

DROP TABLE IF EXISTS `dns_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dns_records` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zone` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL DEFAULT '@',
  `type` enum('MX','CNAME','NS','SOA','A','PTR') NOT NULL,
  `data` varchar(255) DEFAULT NULL,
  `ttl` int(11) NOT NULL DEFAULT '800',
  `mx_priority` int(11) DEFAULT NULL,
  `refresh` int(11) NOT NULL DEFAULT '3600',
  `retry` int(11) NOT NULL DEFAULT '3600',
  `expire` int(11) NOT NULL DEFAULT '86400',
  `minimum` int(11) NOT NULL DEFAULT '3600',
  `serial` bigint(20) NOT NULL DEFAULT '2008082700',
  `resp_person` varchar(64) NOT NULL DEFAULT 'root.chinafreebsd.cn.',
  `primary_ns` varchar(64) NOT NULL DEFAULT 'ns1.chinafreebsd.cn.',
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `dns_records_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users_info` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dns_records`
--

LOCK TABLES `dns_records` WRITE;
/*!40000 ALTER TABLE `dns_records` DISABLE KEYS */;
INSERT INTO `dns_records` VALUES (4,'test.com','@','SOA','test.com.',86400,NULL,3600,15,86400,3600,2008082700,'root.domain.com.','ns1.domain.com.',0),(5,'test.com','@','NS','ns1.test.com.',86400,NULL,3600,15,86400,3600,2008082700,'root.domain.com.','ns1.domain.com.',0),(6,'test.com','ns1','A','192.168.5.23',86400,NULL,3600,15,86400,3600,2008082700,'root.domain.com.','ns1.domain.com.',0),(7,'test.com','www','A','192.168.5.23',86400,NULL,3600,15,86400,3600,2008082700,'root.domain.com.','ns1.domain.com.',0);
/*!40000 ALTER TABLE `dns_records` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-23  3:09:04
