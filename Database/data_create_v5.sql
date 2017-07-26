-- MySQL dump 10.13  Distrib 5.7.12, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: studentdata
-- ------------------------------------------------------
-- Server version	5.7.17-log

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
-- Dumping data for table `component`
--

LOCK TABLES `component` WRITE;
/*!40000 ALTER TABLE `component` DISABLE KEYS */;
INSERT INTO `component` VALUES (1,'System'),(2,'File'),(3,'Forum');
/*!40000 ALTER TABLE `component` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES ('1949cafa-1614-11e7-aeac-705a0f1aec02','course_move','Course: Distributed Systems, Semester 2, 2012',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL),('19555c57-1614-11e7-aeac-705a0f1aec02','course_view','Course: Distributed Systems, Semester 2, 2012',1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `eventtype`
--

LOCK TABLES `eventtype` WRITE;
/*!40000 ALTER TABLE `eventtype` DISABLE KEYS */;
INSERT INTO `eventtype` VALUES (1,'Course','Events related to courses'),(2,'Assignment','Events related to assignments'),(3,'Quiz','Events related to quiz'),(4,'Forum','Events related to forum'),(5,'Marking','Events related to marking'),(6,'Submission','Events related to submission');
/*!40000 ALTER TABLE `eventtype` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('0ddd7f51-160e-11e7-aeac-705a0f1aec02',1,NULL),('0e1750b9-160e-11e7-aeac-705a0f1aec02',2,NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `userevent`
--

LOCK TABLES `userevent` WRITE;
/*!40000 ALTER TABLE `userevent` DISABLE KEYS */;
INSERT INTO `userevent` VALUES ('91b81998-1614-11e7-aeac-705a0f1aec02','0ddd7f51-160e-11e7-aeac-705a0f1aec02','1949cafa-1614-11e7-aeac-705a0f1aec02','Course: Distributed Systems, Semester 2, 2012','2016-05-05 00:00:00'),('b02b1df3-1614-11e7-aeac-705a0f1aec02','0ddd7f51-160e-11e7-aeac-705a0f1aec02','19555c57-1614-11e7-aeac-705a0f1aec02','Course: Distributed Systems, Semester 2, 2012','2016-05-04 00:00:00');
/*!40000 ALTER TABLE `userevent` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping data for table `usertype`
--

LOCK TABLES `usertype` WRITE;
/*!40000 ALTER TABLE `usertype` DISABLE KEYS */;
INSERT INTO `usertype` VALUES (1,'Student','Student'),(2,'Teacher','Teacher');
/*!40000 ALTER TABLE `usertype` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-10 23:30:25
