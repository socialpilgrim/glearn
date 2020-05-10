-- MySQL dump 10.14  Distrib 5.5.65-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: elearn
-- ------------------------------------------------------
-- Server version	5.5.65-MariaDB

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
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lms_admins`
--

DROP TABLE IF EXISTS `lms_admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lms_admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_no` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lms_admins`
--

LOCK TABLES `lms_admins` WRITE;
/*!40000 ALTER TABLE `lms_admins` DISABLE KEYS */;
INSERT INTO `lms_admins` VALUES (1,'support@lms.com','3949494996','$2y$10$7BiXIWim9bvDwWMMdVU43uZd2e648mpRpJZ3r2lPIfUlg4oBO4TTC',NULL,'2020-04-20 02:52:23','2020-04-28 08:06:25');
/*!40000 ALTER TABLE `lms_admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lms_assignments`
--

DROP TABLE IF EXISTS `lms_assignments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lms_assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `new_assignment_url` text NOT NULL,
  `old_assignment_url` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lms_assignments`
--

LOCK TABLES `lms_assignments` WRITE;
/*!40000 ALTER TABLE `lms_assignments` DISABLE KEYS */;
INSERT INTO `lms_assignments` VALUES (1,1,1,1,'https://google.com','https://xipetech.com','2020-04-25 09:55:07','2020-04-25 09:55:07'),(2,1,2,2,'https://www.firstassignmenthelp.com/math-assignment-help','https://quizizz.com/join','2020-04-27 13:22:14','2020-04-27 13:23:12'),(3,1,7,7,'http://xipetech.xyz/lms/assignment','http://xipetech.xyz/lms/assignment','2020-04-28 09:40:35','2020-04-28 09:40:35'),(4,1,4,4,'https://physics.williams.edu/physics-links/','https://commodity.com/chemical-elements/chemistry-links/','2020-04-28 09:44:41','2020-04-28 09:44:41');
/*!40000 ALTER TABLE `lms_assignments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lms_class_timings_old`
--

DROP TABLE IF EXISTS `lms_class_timings_old`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lms_class_timings_old` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `class_day` char(10) NOT NULL,
  `from_timing` time NOT NULL,
  `to_timing` time NOT NULL,
  `is_lunch` tinyint(1) NOT NULL COMMENT '0=>not lunch, 1=>lunch',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lms_class_timings_old`
--

LOCK TABLES `lms_class_timings_old` WRITE;
/*!40000 ALTER TABLE `lms_class_timings_old` DISABLE KEYS */;
INSERT INTO `lms_class_timings_old` VALUES (1,1,1,1,'Monday','09:00:00','10:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(2,1,2,2,'Monday','10:00:00','11:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(3,1,3,3,'Monday','11:00:00','12:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(4,1,4,4,'Monday','12:00:00','12:40:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(5,1,5,0,'Monday','12:40:00','13:20:00',1,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(6,1,6,5,'Monday','14:00:00','15:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(7,1,7,4,'Monday','15:00:00','16:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(8,1,8,6,'Monday','16:00:00','17:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(9,1,4,4,'Monday','17:00:00','18:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(10,1,1,1,'Monday','18:00:00','19:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(11,1,1,1,'Tuesday','09:00:00','10:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(12,1,2,2,'Tuesday','10:00:00','11:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(13,1,3,3,'Tuesday','11:00:00','12:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(14,1,4,4,'Tuesday','12:00:00','12:40:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(15,1,5,0,'Tuesday','12:40:00','13:20:00',1,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(16,1,6,5,'Tuesday','14:00:00','15:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(17,1,7,4,'Tuesday','15:00:00','16:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(18,1,8,6,'Tuesday','16:00:00','17:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(19,1,4,4,'Tuesday','17:00:00','18:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(20,1,1,1,'Tuesday','18:00:00','19:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(21,1,1,1,'Wednesday','09:00:00','10:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(22,1,2,2,'Wednesday','10:00:00','11:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(23,1,3,3,'Wednesday','11:00:00','12:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(24,1,4,4,'Wednesday','12:00:00','12:40:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(25,1,5,0,'Wednesday','12:40:00','13:20:00',1,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(26,1,6,5,'Wednesday','14:00:00','15:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(27,1,7,4,'Wednesday','15:00:00','16:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(28,1,8,6,'Wednesday','16:00:00','17:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(29,1,4,4,'Wednesday','17:00:00','18:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(30,1,1,1,'Wednesday','18:00:00','19:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(31,1,1,1,'Thursday','09:00:00','10:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(32,1,2,2,'Thursday','10:00:00','11:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(33,1,3,3,'Thursday','11:00:00','12:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(34,1,4,4,'Thursday','12:00:00','12:40:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(35,1,5,0,'Thursday','12:40:00','13:20:00',1,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(36,1,6,5,'Thursday','14:00:00','15:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(37,1,7,4,'Thursday','15:00:00','16:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(38,1,8,6,'Thursday','16:00:00','17:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(39,1,4,4,'Thursday','17:00:00','18:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(40,1,1,1,'Thursday','18:00:00','19:00:00',0,'2020-04-28 10:13:22','2020-04-28 10:13:22'),(41,1,1,1,'Friday','09:00:00','10:00:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(42,1,2,2,'Friday','10:00:00','11:00:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(43,1,3,3,'Friday','11:00:00','12:00:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(44,1,4,4,'Friday','12:00:00','12:40:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(45,1,5,0,'Friday','12:40:00','13:20:00',1,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(46,1,6,5,'Friday','14:00:00','15:00:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(47,1,7,4,'Friday','15:00:00','16:00:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(48,1,8,6,'Friday','16:00:00','17:00:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(49,1,4,4,'Friday','17:00:00','18:00:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(50,1,1,1,'Friday','18:00:00','19:00:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(51,1,1,1,'Saturday','09:00:00','10:00:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(52,1,2,2,'Saturday','10:00:00','11:00:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(53,1,3,3,'Saturday','11:00:00','12:00:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(54,1,4,4,'Saturday','12:00:00','12:40:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(55,1,5,0,'Saturday','12:40:00','13:20:00',1,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(56,1,6,5,'Saturday','14:00:00','15:00:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(57,1,7,4,'Saturday','15:00:00','16:00:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(58,1,8,6,'Saturday','16:00:00','17:00:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(59,1,4,4,'Saturday','17:00:00','18:00:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(60,1,1,1,'Saturday','18:00:00','19:00:00',0,'2020-04-28 10:13:23','2020-04-28 10:13:23'),(61,1,1,7,'Monday','06:15:00','06:40:00',0,'2020-04-28 10:14:31','2020-04-28 10:14:31'),(62,1,9,8,'Monday','06:40:00','07:20:00',0,'2020-04-28 10:14:31','2020-04-28 10:14:31'),(63,1,10,9,'Monday','07:20:00','08:40:00',0,'2020-04-28 10:14:31','2020-04-28 10:14:31'),(64,1,7,10,'Monday','08:40:00','09:20:00',0,'2020-04-28 10:14:31','2020-04-28 10:14:31'),(65,1,5,0,'Monday','09:20:00','09:40:00',1,'2020-04-28 10:14:31','2020-04-28 10:14:31'),(66,1,1,11,'Monday','09:40:00','10:20:00',0,'2020-04-28 10:14:31','2020-04-28 10:14:31'),(67,1,11,12,'Monday','10:20:00','10:40:00',0,'2020-04-28 10:14:31','2020-04-28 10:14:31'),(68,1,10,13,'Monday','10:40:00','11:20:00',0,'2020-04-28 10:14:31','2020-04-28 10:14:31'),(69,1,12,14,'Monday','11:20:00','12:40:00',0,'2020-04-28 10:14:31','2020-04-28 10:14:31'),(70,1,13,15,'Monday','12:40:00','01:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(71,1,2,16,'Monday','01:30:00','02:00:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(72,1,1,7,'Tuesday','06:15:00','06:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(73,1,9,8,'Tuesday','06:40:00','07:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(74,1,10,9,'Tuesday','07:20:00','08:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(75,1,7,10,'Tuesday','08:40:00','09:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(76,1,5,0,'Tuesday','09:20:00','09:40:00',1,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(77,1,1,11,'Tuesday','09:40:00','10:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(78,1,11,12,'Tuesday','10:20:00','10:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(79,1,10,13,'Tuesday','10:40:00','11:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(80,1,12,14,'Tuesday','11:20:00','12:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(81,1,13,15,'Tuesday','12:40:00','01:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(82,1,2,16,'Tuesday','01:30:00','02:00:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(83,1,1,7,'Wednesday','06:15:00','06:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(84,1,9,8,'Wednesday','06:40:00','07:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(85,1,10,9,'Wednesday','07:20:00','08:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(86,1,7,10,'Wednesday','08:40:00','09:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(87,1,5,0,'Wednesday','09:20:00','09:40:00',1,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(88,1,1,11,'Wednesday','09:40:00','10:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(89,1,11,12,'Wednesday','10:20:00','10:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(90,1,10,13,'Wednesday','10:40:00','11:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(91,1,12,14,'Wednesday','11:20:00','12:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(92,1,13,15,'Wednesday','12:40:00','01:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(93,1,2,16,'Wednesday','01:30:00','02:00:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(94,1,1,7,'Thursday','06:15:00','06:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(95,1,9,8,'Thursday','06:40:00','07:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(96,1,10,9,'Thursday','07:20:00','08:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(97,1,7,10,'Thursday','08:40:00','09:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(98,1,5,0,'Thursday','09:20:00','09:40:00',1,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(99,1,1,11,'Thursday','09:40:00','10:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(100,1,11,12,'Thursday','10:20:00','10:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(101,1,10,13,'Thursday','10:40:00','11:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(102,1,12,14,'Thursday','11:20:00','12:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(103,1,13,15,'Thursday','12:40:00','01:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(104,1,2,16,'Thursday','01:30:00','02:00:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(105,1,1,7,'Friday','06:15:00','06:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(106,1,9,8,'Friday','06:40:00','07:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(107,1,10,9,'Friday','07:20:00','08:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(108,1,7,10,'Friday','08:40:00','09:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(109,1,5,0,'Friday','09:20:00','09:40:00',1,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(110,1,1,11,'Friday','09:40:00','10:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(111,1,11,12,'Friday','10:20:00','10:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(112,1,10,13,'Friday','10:40:00','11:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(113,1,12,14,'Friday','11:20:00','12:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(114,1,13,15,'Friday','12:40:00','01:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(115,1,2,16,'Friday','01:30:00','02:00:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(116,1,1,7,'Saturday','06:15:00','06:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(117,1,9,8,'Saturday','06:40:00','07:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(118,1,10,9,'Saturday','07:20:00','08:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(119,1,7,10,'Saturday','08:40:00','09:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(120,1,5,0,'Saturday','09:20:00','09:40:00',1,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(121,1,1,11,'Saturday','09:40:00','10:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(122,1,11,12,'Saturday','10:20:00','10:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(123,1,10,13,'Saturday','10:40:00','11:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(124,1,12,14,'Saturday','11:20:00','12:40:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(125,1,13,15,'Saturday','12:40:00','01:20:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(126,1,2,16,'Saturday','01:30:00','02:00:00',0,'2020-04-28 10:14:32','2020-04-28 10:14:32'),(127,1,6,1,'Tuesday','06:03:00','08:00:00',0,'2020-04-28 10:34:13','2020-04-28 10:34:13'),(128,1,12,1,'Tuesday','06:04:00','07:00:00',0,'2020-04-28 10:34:50','2020-04-28 10:34:50'),(129,1,6,9,'Tuesday','18:58:00','21:00:00',0,'2020-04-28 10:58:57','2020-04-28 10:58:57'),(130,1,6,9,'Tuesday','19:00:00','21:00:00',0,'2020-04-28 11:00:24','2020-04-28 11:00:24'),(131,1,1,1,'Tuesday','06:29:00','11:00:00',0,'2020-04-28 11:00:35','2020-04-28 11:00:35'),(132,1,1,9,'Tuesday','16:02:00','17:00:00',0,'2020-04-28 11:02:49','2020-04-28 11:02:49');
/*!40000 ALTER TABLE `lms_class_timings_old` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lms_failed_jobs`
--

DROP TABLE IF EXISTS `lms_failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lms_failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lms_failed_jobs`
--

LOCK TABLES `lms_failed_jobs` WRITE;
/*!40000 ALTER TABLE `lms_failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lms_jobs`
--

DROP TABLE IF EXISTS `lms_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lms_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lms_jobs`
--

LOCK TABLES `lms_jobs` WRITE;
/*!40000 ALTER TABLE `lms_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lms_migrations`
--

DROP TABLE IF EXISTS `lms_migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lms_migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lms_migrations`
--

LOCK TABLES `lms_migrations` WRITE;
/*!40000 ALTER TABLE `lms_migrations` DISABLE KEYS */;
INSERT INTO `lms_migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_07_03_084807_create_jobs_table',1),(4,'2019_07_03_084832_create_failed_jobs_table',1),(5,'2019_12_18_101106_create_admins_table',1);
/*!40000 ALTER TABLE `lms_migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lms_password_resets`
--

DROP TABLE IF EXISTS `lms_password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lms_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(191))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lms_password_resets`
--

LOCK TABLES `lms_password_resets` WRITE;
/*!40000 ALTER TABLE `lms_password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `lms_password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lms_past_classes`
--

DROP TABLE IF EXISTS `lms_past_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lms_past_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `from_timing` time NOT NULL,
  `to_timing` time NOT NULL,
  `class_date` date NOT NULL,
  `class_description` text NOT NULL,
  `class_liveurl` varchar(255) NOT NULL,
  `class_code` varchar(255) NOT NULL,
  `class_quizurl` varchar(255) NOT NULL,
  `class_student_msg` text NOT NULL,
  `is_past` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>Upcoming 1=> Past',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lms_past_classes`
--

LOCK TABLES `lms_past_classes` WRITE;
/*!40000 ALTER TABLE `lms_past_classes` DISABLE KEYS */;
INSERT INTO `lms_past_classes` VALUES (1,1,6,1,'06:03:00','08:00:00','2020-04-28','','https://web.whatsapp.com/','','','',0,'2020-04-28 10:34:13','2020-04-28 10:34:13'),(2,1,12,1,'06:04:00','07:00:00','2020-04-28','','https://web.whatsapp.com/','','','',0,'2020-04-28 10:34:50','2020-04-28 10:34:50'),(3,1,6,9,'18:58:00','21:00:00','2020-04-28','','https://in.godaddy.com/','','','',0,'2020-04-28 10:58:57','2020-04-28 10:58:57'),(4,1,6,9,'19:00:00','21:00:00','2020-04-28','','https://in.godaddy.com/','','','',0,'2020-04-28 11:00:24','2020-04-28 11:00:24'),(5,1,1,1,'06:29:00','11:00:00','2020-04-28','','https://web.whatsapp.com/','','','',0,'2020-04-28 11:00:35','2020-04-28 11:00:35'),(6,1,1,9,'16:02:00','17:00:00','2020-04-28','','https://in.godaddy.com/','','','',0,'2020-04-28 11:02:49','2020-04-28 11:02:49');
/*!40000 ALTER TABLE `lms_past_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lms_support_helps`
--

DROP TABLE IF EXISTS `lms_support_helps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lms_support_helps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teacher_id` int(11) NOT NULL,
  `help_type` smallint(2) NOT NULL COMMENT '1=>Generic, 2=>Specific Class',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_join_link` text NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `status` smallint(2) NOT NULL DEFAULT '1',
  `read_status` int(11) NOT NULL DEFAULT '0' COMMENT '0=no, 1=yes',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lms_support_helps`
--

LOCK TABLES `lms_support_helps` WRITE;
/*!40000 ALTER TABLE `lms_support_helps` DISABLE KEYS */;
INSERT INTO `lms_support_helps` VALUES (1,9,2,'The branch of science concerned with the nature and properties of matter and energy.','',1,3,1,1,'2020-04-28 12:53:57','2020-04-28 10:23:57'),(2,9,2,'The branch of science concerned with the nature and properties of matter and energy.','',1,3,1,1,'2020-04-28 12:53:56','2020-04-28 10:23:56'),(3,9,2,'dsf','',1,NULL,1,1,'2020-04-28 12:53:47','2020-04-28 10:23:47'),(4,1,1,'Need Help','',0,NULL,1,1,'2020-04-28 13:06:06','2020-04-28 10:36:06'),(5,1,1,'Need Help','',0,NULL,1,1,'2020-04-28 13:06:30','2020-04-28 10:36:30'),(6,1,2,'The branch of science concerned with the nature and properties of matter and energy.','',1,1,1,1,'2020-04-28 13:06:40','2020-04-28 10:36:40'),(7,1,2,'The branch of science concerned with the nature and properties of matter and energy.','',1,1,1,1,'2020-04-28 13:06:50','2020-04-28 10:36:50'),(8,1,1,'Need Help','',0,NULL,1,1,'2020-04-28 13:07:00','2020-04-28 10:37:00'),(9,1,1,'Need Help','',0,NULL,1,1,'2020-04-28 13:11:35','2020-04-28 10:41:35'),(10,1,1,'Need Help','',0,NULL,1,1,'2020-04-28 13:11:45','2020-04-28 10:41:45'),(11,1,2,'The branch of science concerned with the nature and properties of matter and energy.','',1,1,1,1,'2020-04-28 13:12:07','2020-04-28 10:42:07'),(12,1,2,'The branch of science concerned with the nature and properties of matter and energy.','',1,1,1,1,'2020-04-28 13:12:47','2020-04-28 10:42:47'),(13,1,2,'The branch of science concerned with the nature and properties of matter and energy.','',1,1,1,1,'2020-04-28 13:12:17','2020-04-28 10:42:17'),(14,1,2,'The branch of science concerned with the nature and properties of matter and energy.','',1,1,1,1,'2020-04-28 13:12:37','2020-04-28 10:42:37'),(15,1,2,'The branch of science concerned with the nature and properties of matter and energy.','',1,1,1,1,'2020-04-28 13:12:27','2020-04-28 10:42:27');
/*!40000 ALTER TABLE `lms_support_helps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lms_users`
--

DROP TABLE IF EXISTS `lms_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lms_users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pin` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lms_users`
--

LOCK TABLES `lms_users` WRITE;
/*!40000 ALTER TABLE `lms_users` DISABLE KEYS */;
INSERT INTO `lms_users` VALUES (1,'Anjali Singh','anjali_singh@lms.com','9363',NULL,'$2y$10$z7fSSzaO0YVNu1Z8K8t9/O.Wu/EPgq6Ja6MSi2THePY/LnQ3w/22O',NULL,NULL,'2020-04-28 10:13:22','2020-04-28 10:13:22',NULL),(2,'Aslam Khan','aslam_khan@lms.com','3547',NULL,'$2y$10$flb2PeTN8kShrjxaQljKnuv0oQT.6xKIMDJ8fi.AK0sTOeOo0OUqK',NULL,NULL,'2020-04-28 10:13:22','2020-04-28 10:13:22',NULL),(3,'Mansi Sharma','mansi_sharma@lms.com','3881',NULL,'$2y$10$0.dLri7L6EQGuE/6TkJeRuaTpYAsUj73z.2J8cHdf9ZJmS5sYBzqa',NULL,NULL,'2020-04-28 10:13:22','2020-04-28 10:13:22',NULL),(4,'Rajeev Kumar','rajeev_kumar@lms.com','9021',NULL,'$2y$10$CZWgzxlvh3ZpePyndPhMfeff3Y7YYs9b.U98ocfmeYlnH3iYn3yvO',NULL,NULL,'2020-04-28 10:13:22','2020-04-28 10:13:22',NULL),(5,'Divya Pandey','divya_pandey@lms.com','9632',NULL,'$2y$10$MGM903X/kUGfL4y7w6Etv.CAv/.PfGYzbNPLSFrA.RHC.yevo.Fj6',NULL,NULL,'2020-04-28 10:13:22','2020-04-28 10:13:22',NULL),(6,'Asalam Khan','asalam_khan@lms.com','1375',NULL,'$2y$10$TIfOy3zNvHRRdxrskRc6xeSguTL6CPdfIbY.p7fofhJyvsuaAHAHq',NULL,NULL,'2020-04-28 10:13:22','2020-04-28 10:13:22',NULL),(7,'Tina Singh','tina_singh@lms.com','6642',NULL,'$2y$10$UpWVujrc7nvFuKUei/YAVuR8cY4IMOsenuQCI8VsUW4vxPXh9YxMm',NULL,NULL,'2020-04-28 10:14:31','2020-04-28 10:14:31',NULL),(8,'Firoz Khan','firoz_khan@lms.com','3596',NULL,'$2y$10$EjFI3dshoQwa.jD20B.oqu3KV6zoJFJ4KfIdES3EZjFx390HQHjo.',NULL,NULL,'2020-04-28 10:14:31','2020-04-28 10:14:31',NULL),(9,'Arti Sharma','arti_sharma@lms.com','5860',NULL,'$2y$10$uLruilzLxhU/SfjLdRst3.9osh.N1iyTioCUvXyQxc99r7kpQF0FW',NULL,NULL,'2020-04-28 10:14:31','2020-04-28 10:14:31',NULL),(10,'Amit Singh','amit_singh@lms.com','1532',NULL,'$2y$10$wakM9Oro1gZzn35yhrpNmeSxc0uwBA5Ocsagss27jViGEu7fTHHky',NULL,NULL,'2020-04-28 10:14:31','2020-04-28 10:14:31',NULL),(11,'Archana Singh','archana_singh@lms.com','8582',NULL,'$2y$10$ZYu9D5ZNOooWDwKz5W/m6.wOcQgCviICHoaaBVfqALjuVwkQm1nhi',NULL,NULL,'2020-04-28 10:14:31','2020-04-28 10:14:31',NULL),(12,'Usha Pandey','usha_pandey@lms.com','2883',NULL,'$2y$10$aK.kmxYaqIt8COXbcJc5o.Gd47jk4HeotsTkvgZZOi/9J4UMDv6d.',NULL,NULL,'2020-04-28 10:14:31','2020-04-28 10:14:31',NULL),(13,'Shifa Khan','shifa_khan@lms.com','4153',NULL,'$2y$10$nCHKANAVsGCigS9D2sXq9.Wmh/fO/mNZZ36CkMjZohKmZY3OcmDv2',NULL,NULL,'2020-04-28 10:14:31','2020-04-28 10:14:31',NULL),(14,'Shradha Kumar','shradha_kumar@lms.com','1451',NULL,'$2y$10$ZFdiPsN7UUaoQLo/iqRnIun/r4gXBXS6J9ElIHB8PLuLExEmPUZia',NULL,NULL,'2020-04-28 10:14:31','2020-04-28 10:14:31',NULL),(15,'Awasthi Singh','awasthi_singh@lms.com','1017',NULL,'$2y$10$kAnkKm5BiL9Tk/bUOnzv5.iQpJAXpeQBAQXl9A6dZqgXdKyI34Zzi',NULL,NULL,'2020-04-28 10:14:32','2020-04-28 10:14:32',NULL),(16,'Dr. P Kumar','dr._p_kumar@lms.com','4811',NULL,'$2y$10$B7JTSBefNB91A8C2EZq.TuNBTas4lQd4IU5hI9z8b78zx1GMoHSN2',NULL,NULL,'2020-04-28 10:14:32','2020-04-28 10:14:32',NULL);
/*!40000 ALTER TABLE `lms_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2019_08_19_000000_create_failed_jobs_table',1),(3,'2020_05_02_190645_create_tbl_teachers_table',1),(4,'2020_05_02_191355_create_tbl_admin_table',2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_admin`
--

DROP TABLE IF EXISTS `tbl_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_admin` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_admin`
--

LOCK TABLES `tbl_admin` WRITE;
/*!40000 ALTER TABLE `tbl_admin` DISABLE KEYS */;
INSERT INTO `tbl_admin` VALUES (3,'eLearn','System','elearn.admin@montbit.tech','0','','2020-05-25 18:30:00','2020-05-05 01:03:26');
/*!40000 ALTER TABLE `tbl_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_class_timings`
--

DROP TABLE IF EXISTS `tbl_class_timings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_class_timings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL DEFAULT '0',
  `teacher_id` int(11) NOT NULL,
  `class_day` char(10) NOT NULL,
  `from_timing` time NOT NULL,
  `to_timing` time NOT NULL,
  `is_lunch` tinyint(1) DEFAULT '0' COMMENT '0=>not lunch, 1=>lunch',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_class_timings`
--

LOCK TABLES `tbl_class_timings` WRITE;
/*!40000 ALTER TABLE `tbl_class_timings` DISABLE KEYS */;
INSERT INTO `tbl_class_timings` VALUES (11,9,4,5,'Saturday','05:00:00','06:00:00',NULL,'2020-05-05 20:59:20','2020-05-05 20:59:20'),(12,10,1,5,'Monday','10:00:00','10:40:00',0,'2020-05-06 09:37:00','2020-05-06 09:37:00'),(13,11,12,4,'Wednesday','12:00:00','01:00:00',0,'2020-05-08 03:11:27','2020-05-08 03:11:27');
/*!40000 ALTER TABLE `tbl_class_timings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_classwork`
--

DROP TABLE IF EXISTS `tbl_classwork`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_classwork` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `g_live_link` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_class_id` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `classwork_type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Assignment/Material/Queestion',
  `topic_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_points` int(3) DEFAULT NULL,
  `g_status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_action` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'assign/ask/post',
  `g_title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `g_due_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT '0000-00-00 00:00:00',
  `teacher_id` int(11) DEFAULT NULL,
  `timetable_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `g_class_id` (`class_id`,`topic_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_classwork`
--

LOCK TABLES `tbl_classwork` WRITE;
/*!40000 ALTER TABLE `tbl_classwork` DISABLE KEYS */;
INSERT INTO `tbl_classwork` VALUES (1,10,'https://classroom.google.com/c/OTcwNTI1MzUwOTFa/a/MTAwMTg3MDQ0Nzg5/details','97052535091','ASSIGNMENT','100190468586',NULL,NULL,NULL,'Assignent 01',NULL,'2020-05-08 13:35:52','2020-05-08 13:35:52',5,12,1),(2,10,'https://classroom.google.com/c/OTcwNTI1MzUwOTFa/a/MTAwMTkyMTIxNzQ1/details','97052535091','ASSIGNMENT','100192394944',NULL,NULL,NULL,'Assignmetn 2',NULL,'2020-05-08 13:44:32','2020-05-08 13:44:32',5,12,1),(3,9,'https://classroom.google.com/c/OTY4MzIwNTA5MDZa/a/MTAwMjA3MjEwMzMw/details','96832050906','ASSIGNMENT','100207271267',NULL,NULL,NULL,'Asssignemtnt 01',NULL,'2020-05-08 13:52:12','2020-05-08 13:52:12',5,11,4);
/*!40000 ALTER TABLE `tbl_classwork` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_invite_teacher`
--

DROP TABLE IF EXISTS `tbl_invite_teacher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_invite_teacher` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `g_code` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_responce` text COLLATE utf8mb4_unicode_ci,
  `is_accept` int(11) DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_invite_teacher`
--

LOCK TABLES `tbl_invite_teacher` WRITE;
/*!40000 ALTER TABLE `tbl_invite_teacher` DISABLE KEYS */;
INSERT INTO `tbl_invite_teacher` VALUES (1,9,5,'OTY4MzIwNTA5MDZ8MTA0MDY3NTI5NjMyNTgzMzM1NTkz','{\n  \"id\": \"OTY4MzIwNTA5MDZ8MTA0MDY3NTI5NjMyNTgzMzM1NTkz\",\n  \"userId\": \"104067529632583335593\",\n  \"courseId\": \"96832050906\",\n  \"role\": \"TEACHER\"\n}\n',0,'2020-05-05 20:59:22','2020-05-05 20:59:22'),(2,10,5,'OTcwNTI1MzUwOTF8MTA0MDY3NTI5NjMyNTgzMzM1NTkz','{\n  \"id\": \"OTcwNTI1MzUwOTF8MTA0MDY3NTI5NjMyNTgzMzM1NTkz\",\n  \"userId\": \"104067529632583335593\",\n  \"courseId\": \"97052535091\",\n  \"role\": \"TEACHER\"\n}\n',0,'2020-05-06 09:37:00','2020-05-06 09:37:00'),(3,11,4,'OTc4NTk2Njg3Mjl8MTE1NjI4ODY4MzA4NDk0Njc0Nzc0','{\n  \"id\": \"OTc4NTk2Njg3Mjl8MTE1NjI4ODY4MzA4NDk0Njc0Nzc0\",\n  \"userId\": \"115628868308494674774\",\n  \"courseId\": \"97859668729\",\n  \"role\": \"TEACHER\"\n}\n',0,'2020-05-08 03:11:29','2020-05-08 03:11:29');
/*!40000 ALTER TABLE `tbl_invite_teacher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_student_classes`
--

DROP TABLE IF EXISTS `tbl_student_classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_student_classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_name` int(11) NOT NULL,
  `section_name` char(5) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `g_class_id` varchar(100) NOT NULL,
  `g_link` varchar(255) NOT NULL,
  `g_response` text NOT NULL,
  `student_numbers` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_student_classes`
--

LOCK TABLES `tbl_student_classes` WRITE;
/*!40000 ALTER TABLE `tbl_student_classes` DISABLE KEYS */;
INSERT INTO `tbl_student_classes` VALUES (1,12,'B',6,'96656399164','https://classroom.google.com/c/OTY2NTYzOTkxNjRa','{\n  \"id\": \"96656399164\",\n  \"name\": \"12 Chemistry\",\n  \"section\": \"B\",\n  \"descriptionHeading\": \"Chemistry class\",\n  \"description\": \"welcome to the chemistry class\",\n  \"room\": \"201\",\n  \"ownerId\": \"104067529632583335593\",\n  \"creationTime\": \"2020-05-05T16:54:02.004Z\",\n  \"updateTime\": \"2020-05-05T16:54:01.020Z\",\n  \"enrollmentCode\": \"3htgr2w\",\n  \"courseState\": \"PROVISIONED\",\n  \"alternateLink\": \"https://classroom.google.com/c/OTY2NTYzOTkxNjRa\",\n  \"teacherGroupEmail\": \"12_Chemistry_B_teachers_b23dde44@montbit.tech\",\n  \"courseGroupEmail\": \"12_Chemistry_B_4eb6ec82@montbit.tech\",\n  \"teacherFolder\": {\n    \"id\": \"0B51wOuS_OZFafmFnbENBQjhFMTlYbnh6QlVUdjl1LVNzRVBrbFRzVWV1QUFmTTJYSkNaN3c\"\n  },\n  \"guardiansEnabled\": false\n}\n',NULL,'2020-05-05 11:24:05','2020-05-05 11:24:05'),(2,5,'M',3,'96802410412','https://classroom.google.com/c/OTY4MDI0MTA0MTJa','{\n  \"id\": \"96802410412\",\n  \"name\": \"5 Geography\",\n  \"section\": \"M\",\n  \"descriptionHeading\": \"akljd\",\n  \"description\": \"asjdkl\",\n  \"room\": \"12\",\n  \"ownerId\": \"106082983519815361859\",\n  \"creationTime\": \"2020-05-05T23:55:18.620Z\",\n  \"updateTime\": \"2020-05-05T23:55:17.254Z\",\n  \"enrollmentCode\": \"2b55xgj\",\n  \"courseState\": \"PROVISIONED\",\n  \"alternateLink\": \"https://classroom.google.com/c/OTY4MDI0MTA0MTJa\",\n  \"teacherGroupEmail\": \"5_Geography_M_teachers_cb24935b@montbit.tech\",\n  \"courseGroupEmail\": \"5_Geography_M_91dcbde0@montbit.tech\",\n  \"teacherFolder\": {\n    \"id\": \"0B20Uo3pxaLYjfmlXSmpaNmo3LUlmZ3FQTkhPWXoyU1dhMjA0REFzcnhSVDVXc2FhU25JNDg\"\n  },\n  \"guardiansEnabled\": false\n}\n',NULL,'2020-05-05 18:25:22','2020-05-05 18:25:22'),(3,5,'M',3,'96804697776','https://classroom.google.com/c/OTY4MDQ2OTc3NzZa','{\n  \"id\": \"96804697776\",\n  \"name\": \"5 Geography\",\n  \"section\": \"M\",\n  \"descriptionHeading\": \"akljd\",\n  \"description\": \"asjdkl\",\n  \"room\": \"12\",\n  \"ownerId\": \"106082983519815361859\",\n  \"creationTime\": \"2020-05-06T00:00:24.361Z\",\n  \"updateTime\": \"2020-05-06T00:00:23.454Z\",\n  \"enrollmentCode\": \"k76x2js\",\n  \"courseState\": \"PROVISIONED\",\n  \"alternateLink\": \"https://classroom.google.com/c/OTY4MDQ2OTc3NzZa\",\n  \"teacherGroupEmail\": \"5_Geography_M_teachers_740033ea@montbit.tech\",\n  \"courseGroupEmail\": \"5_Geography_M_5fb4050e@montbit.tech\",\n  \"teacherFolder\": {\n    \"id\": \"0B20Uo3pxaLYjfk9NNWtZWWhIYXRIUjA1UnkxM3hsaldCcTB6c1FVTnhCWnA0TGJfUEFYd2M\"\n  },\n  \"guardiansEnabled\": false\n}\n',NULL,'2020-05-05 18:30:28','2020-05-05 18:30:28'),(4,12,'E',2,'96821146341','https://classroom.google.com/c/OTY4MjExNDYzNDFa','{\n  \"id\": \"96821146341\",\n  \"name\": \"12 Physics\",\n  \"section\": \"E\",\n  \"descriptionHeading\": \"Physics\",\n  \"description\": \"jhsfjshfkjsd\",\n  \"room\": \"12\",\n  \"ownerId\": \"108435816664206184955\",\n  \"creationTime\": \"2020-05-06T01:51:51.628Z\",\n  \"updateTime\": \"2020-05-06T01:51:50.764Z\",\n  \"enrollmentCode\": \"zdh27fu\",\n  \"courseState\": \"PROVISIONED\",\n  \"alternateLink\": \"https://classroom.google.com/c/OTY4MjExNDYzNDFa\",\n  \"teacherGroupEmail\": \"12_Physics_E_teachers_44db55ee@classroom.google.com\",\n  \"courseGroupEmail\": \"12_Physics_E_b08218a0@classroom.google.com\",\n  \"teacherFolder\": {\n    \"id\": \"0Bw52WDKsiZzJfjV4RXh6YVNWb3pxZWFFTjFCWi05YTF4YVVoRlI5U05XNkViaTFXeTVlLWs\"\n  },\n  \"guardiansEnabled\": false\n}\n',NULL,'2020-05-05 20:21:55','2020-05-05 20:21:55'),(5,4,'Q',10,'96823681031','https://classroom.google.com/c/OTY4MjM2ODEwMzFa','{\n  \"id\": \"96823681031\",\n  \"name\": \"4 Social Science\",\n  \"section\": \"Q\",\n  \"descriptionHeading\": \"rwer\",\n  \"description\": \"werwer\",\n  \"room\": \"32\",\n  \"ownerId\": \"108435816664206184955\",\n  \"creationTime\": \"2020-05-06T02:01:55.286Z\",\n  \"updateTime\": \"2020-05-06T02:01:54.279Z\",\n  \"enrollmentCode\": \"irv7375\",\n  \"courseState\": \"PROVISIONED\",\n  \"alternateLink\": \"https://classroom.google.com/c/OTY4MjM2ODEwMzFa\",\n  \"teacherGroupEmail\": \"4_Social_Science_Q_teachers_b2ac51f9@classroom.google.com\",\n  \"courseGroupEmail\": \"4_Social_Science_Q_18de503c@classroom.google.com\",\n  \"teacherFolder\": {\n    \"id\": \"0Bw52WDKsiZzJfkdHa3AyNnBvWjBOTWpzQ3JBd0M2UDBKUC1kZTJBOWV6OERrVTYtcEJPT1U\"\n  },\n  \"guardiansEnabled\": false\n}\n',NULL,'2020-05-05 20:31:59','2020-05-05 20:31:59'),(6,6,'R',8,'96831140016','https://classroom.google.com/c/OTY4MzExNDAwMTZa','{\n  \"id\": \"96831140016\",\n  \"name\": \"6 Maths\",\n  \"section\": \"R\",\n  \"descriptionHeading\": \"fsdf\",\n  \"description\": \"sdd\",\n  \"room\": \"12\",\n  \"ownerId\": \"106082983519815361859\",\n  \"creationTime\": \"2020-05-06T02:05:09.531Z\",\n  \"updateTime\": \"2020-05-06T02:05:08.507Z\",\n  \"enrollmentCode\": \"vaqpbqa\",\n  \"courseState\": \"PROVISIONED\",\n  \"alternateLink\": \"https://classroom.google.com/c/OTY4MzExNDAwMTZa\",\n  \"teacherGroupEmail\": \"6_Maths_R_teachers_b1e8f10b@montbit.tech\",\n  \"courseGroupEmail\": \"6_Maths_R_c3243bf4@montbit.tech\",\n  \"teacherFolder\": {\n    \"id\": \"0B20Uo3pxaLYjflEwWG1oVzhBSkFjT1BiN04xN0N3bXhjekhhLVNCbmxoVkpMUG1nbVhNXzA\"\n  },\n  \"guardiansEnabled\": false\n}\n',NULL,'2020-05-05 20:35:13','2020-05-05 20:35:13'),(7,13,'T',11,'96822686667','https://classroom.google.com/c/OTY4MjI2ODY2Njda','{\n  \"id\": \"96822686667\",\n  \"name\": \"13 PT\",\n  \"section\": \"T\",\n  \"descriptionHeading\": \"werwerwe\",\n  \"description\": \"wr rwe rwerwer\",\n  \"room\": \"21\",\n  \"ownerId\": \"106082983519815361859\",\n  \"creationTime\": \"2020-05-06T02:14:48.918Z\",\n  \"updateTime\": \"2020-05-06T02:14:48.044Z\",\n  \"enrollmentCode\": \"fb3w6k5\",\n  \"courseState\": \"PROVISIONED\",\n  \"alternateLink\": \"https://classroom.google.com/c/OTY4MjI2ODY2Njda\",\n  \"teacherGroupEmail\": \"13_PT_T_teachers_8ef7ac0e@montbit.tech\",\n  \"courseGroupEmail\": \"13_PT_T_694a3d37@montbit.tech\",\n  \"teacherFolder\": {\n    \"id\": \"0B20Uo3pxaLYjfmQxMjc5RXo1YmE1anBaR1R0NkswbVZLbnFRN0Q4VFpjMDlkdFQ1U0M3Ymc\"\n  },\n  \"guardiansEnabled\": false\n}\n',NULL,'2020-05-05 20:44:52','2020-05-05 20:44:52'),(8,98,'D',4,'96830370064','https://classroom.google.com/c/OTY4MzAzNzAwNjRa','{\n  \"id\": \"96830370064\",\n  \"name\": \"98 Meditation\",\n  \"section\": \"D\",\n  \"descriptionHeading\": \"adasd\",\n  \"description\": \"asasd\",\n  \"room\": \"2\",\n  \"ownerId\": \"106082983519815361859\",\n  \"creationTime\": \"2020-05-06T02:28:18.152Z\",\n  \"updateTime\": \"2020-05-06T02:28:17.195Z\",\n  \"enrollmentCode\": \"35zyc4f\",\n  \"courseState\": \"PROVISIONED\",\n  \"alternateLink\": \"https://classroom.google.com/c/OTY4MzAzNzAwNjRa\",\n  \"teacherGroupEmail\": \"98_Meditation_D_teachers_cdf04e8f@montbit.tech\",\n  \"courseGroupEmail\": \"98_Meditation_D_f656ea71@montbit.tech\",\n  \"teacherFolder\": {\n    \"id\": \"0B20Uo3pxaLYjfnN2STdUNnZoZ2R0c2J4YUZ4UU04T3R3R3U4UXVtRFVRc2dablJtMksxXzQ\"\n  },\n  \"guardiansEnabled\": false\n}\n',NULL,'2020-05-05 20:58:22','2020-05-05 20:58:22'),(9,98,'D',4,'96832050906','https://classroom.google.com/c/OTY4MzIwNTA5MDZa','{\n  \"id\": \"96832050906\",\n  \"name\": \"98 Meditation\",\n  \"section\": \"D\",\n  \"descriptionHeading\": \"adasd\",\n  \"description\": \"asasd\",\n  \"room\": \"2\",\n  \"ownerId\": \"106082983519815361859\",\n  \"creationTime\": \"2020-05-06T02:29:17.771Z\",\n  \"updateTime\": \"2020-05-06T02:29:16.843Z\",\n  \"enrollmentCode\": \"u7jiyu7\",\n  \"courseState\": \"PROVISIONED\",\n  \"alternateLink\": \"https://classroom.google.com/c/OTY4MzIwNTA5MDZa\",\n  \"teacherGroupEmail\": \"98_Meditation_D_teachers_f5669d26@montbit.tech\",\n  \"courseGroupEmail\": \"98_Meditation_D_16a23587@montbit.tech\",\n  \"teacherFolder\": {\n    \"id\": \"0B20Uo3pxaLYjflczYXVNMTF2dXVxQk5PTTJVdEd1NDJGOWIwVnRJQ3NNNGpaVnNzQ0VKbTg\"\n  },\n  \"guardiansEnabled\": false\n}\n',NULL,'2020-05-05 20:59:20','2020-05-05 20:59:20'),(10,6,'A',1,'97052535091','https://classroom.google.com/c/OTcwNTI1MzUwOTFa','{\n  \"id\": \"97052535091\",\n  \"name\": \"6 English\",\n  \"section\": \"A\",\n  \"ownerId\": \"106082983519815361859\",\n  \"creationTime\": \"2020-05-06T15:06:55.990Z\",\n  \"updateTime\": \"2020-05-06T15:06:54.984Z\",\n  \"enrollmentCode\": \"cayko6b\",\n  \"courseState\": \"PROVISIONED\",\n  \"alternateLink\": \"https://classroom.google.com/c/OTcwNTI1MzUwOTFa\",\n  \"teacherGroupEmail\": \"6_English_A_teachers_880db139@montbit.tech\",\n  \"courseGroupEmail\": \"6_English_A_d64e695e@montbit.tech\",\n  \"teacherFolder\": {\n    \"id\": \"0B20Uo3pxaLYjfjZBc2hzTE8yRllEWUNtRi1Wdkk1N0FfdFNoeGxOZG9KMUFUaHVQSGx2Nk0\"\n  },\n  \"guardiansEnabled\": false\n}\n',NULL,'2020-05-06 09:36:59','2020-05-06 09:36:59'),(11,90,'F',12,'97859668729','https://classroom.google.com/c/OTc4NTk2Njg3Mjla','{\n  \"id\": \"97859668729\",\n  \"name\": \"90 History\",\n  \"section\": \"F\",\n  \"descriptionHeading\": \"xyz\",\n  \"description\": \"xuyz\",\n  \"room\": \"10\",\n  \"ownerId\": \"106082983519815361859\",\n  \"creationTime\": \"2020-05-08T08:41:24.222Z\",\n  \"updateTime\": \"2020-05-08T08:41:23.024Z\",\n  \"enrollmentCode\": \"syi2zpv\",\n  \"courseState\": \"PROVISIONED\",\n  \"alternateLink\": \"https://classroom.google.com/c/OTc4NTk2Njg3Mjla\",\n  \"teacherGroupEmail\": \"90_History_F_teachers_bcae49f1@montbit.tech\",\n  \"courseGroupEmail\": \"90_History_F_93d85732@montbit.tech\",\n  \"teacherFolder\": {\n    \"id\": \"0B20Uo3pxaLYjfk1lNEhjb2dJSTJnVVp6TG5tSEFETzd1dTF3SXluZ2tlZUxCci0zOWRzR28\"\n  },\n  \"guardiansEnabled\": false\n}\n',NULL,'2020-05-08 03:11:27','2020-05-08 03:11:27');
/*!40000 ALTER TABLE `tbl_student_classes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_student_subjects`
--

DROP TABLE IF EXISTS `tbl_student_subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_student_subjects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_student_subjects`
--

LOCK TABLES `tbl_student_subjects` WRITE;
/*!40000 ALTER TABLE `tbl_student_subjects` DISABLE KEYS */;
INSERT INTO `tbl_student_subjects` VALUES (1,'English','2020-04-28 10:13:22','2020-04-28 10:13:22'),(2,'Physics','2020-04-28 10:13:22','2020-04-28 10:13:22'),(3,'Geography','2020-04-28 10:13:22','2020-04-28 10:13:22'),(4,'Meditation','2020-04-28 10:13:22','2020-04-28 10:13:22'),(5,'Lunch','2020-04-28 10:13:22','2020-04-28 10:13:22'),(6,'Chemistry','2020-04-28 10:13:22','2020-04-28 10:13:22'),(7,'Games','2020-04-28 10:13:22','2020-04-28 10:13:22'),(8,'Maths','2020-04-28 10:13:22','2020-04-28 10:13:22'),(9,'Science','2020-04-28 10:14:31','2020-04-28 10:14:31'),(10,'Social Science','2020-04-28 10:14:31','2020-04-28 10:14:31'),(11,'PT','2020-04-28 10:14:31','2020-04-28 10:14:31'),(12,'History','2020-04-28 10:14:31','2020-04-28 10:14:31'),(13,'P.ed','2020-04-28 10:14:31','2020-04-28 10:14:31');
/*!40000 ALTER TABLE `tbl_student_subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_techers`
--

DROP TABLE IF EXISTS `tbl_techers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_techers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `login_pin` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_user_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_customer_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `g_response` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_techers`
--

LOCK TABLES `tbl_techers` WRITE;
/*!40000 ALTER TABLE `tbl_techers` DISABLE KEYS */;
INSERT INTO `tbl_techers` VALUES (3,'Dev','Test','test@montbit.tech','0123456789',NULL,NULL,NULL,NULL,NULL,'100360287889321708883','C04a3igj5','{\n  \"kind\": \"admin#directory#user\",\n  \"id\": \"100360287889321708883\",\n  \"etag\": \"\\\"kpmjWQmbeslvpzX9UtjQmrj1W9VbEReX0JTV2AAzWcY/WYGSOBZVjThJtqtvvH1UYKSv5M8\\\"\",\n  \"primaryEmail\": \"test@montbit.tech\",\n  \"name\": {\n    \"givenName\": \"Test\",\n    \"familyName\": \"Dev\",\n    \"fullName\": \"Dev Test\"\n  },\n  \"isAdmin\": false,\n  \"isDelegatedAdmin\": false,\n  \"creationTime\": \"2020-05-04T13:01:55.000Z\",\n  \"customerId\": \"C04a3igj5\",\n  \"orgUnitPath\": \"/\",\n  \"isMailboxSetup\": false,\n  \"recoveryEmail\": \"elearn.admin@montbit.tech\"\n}\n','2020-05-04 07:31:56','2020-05-04 07:31:56','0000-00-00 00:00:00'),(4,'Shusil','raj','sush@montbit.tech','7894561230',NULL,NULL,NULL,NULL,NULL,'115628868308494674774','C04a3igj5','{\n  \"kind\": \"admin#directory#user\",\n  \"id\": \"115628868308494674774\",\n  \"etag\": \"\\\"kpmjWQmbeslvpzX9UtjQmrj1W9VbEReX0JTV2AAzWcY/xBA-Rywgy_Z-EnzE5PfstHEn6zM\\\"\",\n  \"primaryEmail\": \"sush@montbit.tech\",\n  \"name\": {\n    \"givenName\": \"raj\",\n    \"familyName\": \"Shusil\",\n    \"fullName\": \"Shusil raj\"\n  },\n  \"isAdmin\": false,\n  \"isDelegatedAdmin\": false,\n  \"creationTime\": \"2020-05-04T19:15:56.000Z\",\n  \"customerId\": \"C04a3igj5\",\n  \"orgUnitPath\": \"/\",\n  \"isMailboxSetup\": false,\n  \"recoveryEmail\": \"elearn.admin@montbit.tech\"\n}\n','2020-05-04 13:45:57','2020-05-04 13:45:57','0000-00-00 00:00:00'),(5,'ritesh','patel','ritesh@montbit.tech','7016669433',NULL,NULL,NULL,NULL,NULL,'104067529632583335593','C04a3igj5','{\n  \"kind\": \"admin#directory#user\",\n  \"id\": \"104067529632583335593\",\n  \"etag\": \"\\\"DbaN4VipxhQRWt40bkGtbRfJcyrRYyVsLj5bypXL58g/65NG2HhMYCpti-EqQhgOf3fRE7k\\\"\",\n  \"primaryEmail\": \"ritesh@montbit.tech\",\n  \"name\": {\n    \"givenName\": \"patel\",\n    \"familyName\": \"ritesh\",\n    \"fullName\": \"ritesh patel\"\n  },\n  \"isAdmin\": false,\n  \"isDelegatedAdmin\": false,\n  \"lastLoginTime\": \"2020-05-05T16:52:38.000Z\",\n  \"creationTime\": \"2020-05-04T19:18:35.000Z\",\n  \"agreedToTerms\": true,\n  \"suspended\": false,\n  \"archived\": false,\n  \"changePasswordAtNextLogin\": false,\n  \"ipWhitelisted\": false,\n  \"emails\": [\n    {\n      \"address\": \"ritesh@montbit.tech\",\n      \"primary\": true\n    },\n    {\n      \"address\": \"ritesh@montbit.tech.test-google-a.com\"\n    }\n  ],\n  \"nonEditableAliases\": [\n    \"ritesh@montbit.tech.test-google-a.com\"\n  ],\n  \"customerId\": \"C04a3igj5\",\n  \"orgUnitPath\": \"/\",\n  \"isMailboxSetup\": true,\n  \"includeInGlobalAddressList\": true,\n  \"recoveryEmail\": \"elearn.admin@montbit.tech\"\n}\n','2020-05-04 13:48:36','2020-05-05 17:37:59','0000-00-00 00:00:00'),(6,'Sushil','Rajput','socialpilgrim@montbit.tech','8698849300',NULL,NULL,NULL,NULL,NULL,'114206764000984035665','C04a3igj5','{\n  \"kind\": \"admin#directory#user\",\n  \"id\": \"114206764000984035665\",\n  \"etag\": \"\\\"DbaN4VipxhQRWt40bkGtbRfJcyrRYyVsLj5bypXL58g/3JMj4riydE-t30losFSFl0KCBTc\\\"\",\n  \"primaryEmail\": \"socialpilgrim@montbit.tech\",\n  \"name\": {\n    \"givenName\": \"Rajput\",\n    \"familyName\": \"Sushil\",\n    \"fullName\": \"Sushil Rajput\"\n  },\n  \"isAdmin\": false,\n  \"isDelegatedAdmin\": false,\n  \"creationTime\": \"2020-05-04T19:22:50.000Z\",\n  \"customerId\": \"C04a3igj5\",\n  \"orgUnitPath\": \"/\",\n  \"isMailboxSetup\": false,\n  \"recoveryEmail\": \"elearn.admin@montbit.tech\"\n}\n','2020-05-04 13:52:51','2020-05-04 13:52:51','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `tbl_techers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_topics`
--

DROP TABLE IF EXISTS `tbl_topics`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topicname` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `g_topic_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_topics`
--

LOCK TABLES `tbl_topics` WRITE;
/*!40000 ALTER TABLE `tbl_topics` DISABLE KEYS */;
INSERT INTO `tbl_topics` VALUES (1,'topic 01',10,'100190468586','2020-05-08 13:35:51','2020-05-08 13:35:51'),(2,'Topic 02',10,'100192394944','2020-05-08 13:44:31','2020-05-08 13:44:31'),(3,'Topic 01',9,'100207271267','2020-05-08 13:52:11','2020-05-08 13:52:11');
/*!40000 ALTER TABLE `tbl_topics` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-09  2:22:07
