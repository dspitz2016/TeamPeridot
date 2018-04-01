-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
--
-- Host: 127.0.0.1    Database: RapidsCemetery
-- ------------------------------------------------------
-- Server version	5.6.38

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
-- Table structure for table `Account`
--

DROP TABLE IF EXISTS `Account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Account` (
  `idAccount` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idAccount`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Account`
--

LOCK TABLES `Account` WRITE;
/*!40000 ALTER TABLE `Account` DISABLE KEYS */;
/*!40000 ALTER TABLE `Account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Contact`
--

DROP TABLE IF EXISTS `Contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Contact` (
  `idContact` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phoneNumber` varchar(45) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` blob,
  `idLocation` int(11) NOT NULL,
  PRIMARY KEY (`idContact`,`idLocation`),
  KEY `fk_Contact_Location_idx` (`idLocation`),
  CONSTRAINT `fk_Contact_Location` FOREIGN KEY (`idLocation`) REFERENCES `Location` (`idLocation`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Contact`
--

LOCK TABLES `Contact` WRITE;
/*!40000 ALTER TABLE `Contact` DISABLE KEYS */;
/*!40000 ALTER TABLE `Contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Event`
--

DROP TABLE IF EXISTS `Event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Event` (
  `idEvent` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` blob,
  `startTime` datetime DEFAULT NULL,
  `endTime` datetime DEFAULT NULL,
  `imagePath` varchar(200) DEFAULT NULL,
  `imageDescription` varchar(200) DEFAULT NULL,
  `idLocation` int(11) NOT NULL,
  PRIMARY KEY (`idEvent`,`idLocation`),
  KEY `fk_Event_Location1_idx` (`idLocation`),
  CONSTRAINT `fk_Event_Location1` FOREIGN KEY (`idLocation`) REFERENCES `Location` (`idLocation`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Event`
--

LOCK TABLES `Event` WRITE;
/*!40000 ALTER TABLE `Event` DISABLE KEYS */;
/*!40000 ALTER TABLE `Event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `FAQ`
--

DROP TABLE IF EXISTS `FAQ`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `FAQ` (
  `idFAQ` int(11) NOT NULL AUTO_INCREMENT,
  `question` varchar(200) DEFAULT NULL,
  `answer` blob,
  `idLocation` int(11) NOT NULL,
  PRIMARY KEY (`idFAQ`,`idLocation`),
  KEY `fk_FAQ_Location1_idx` (`idLocation`),
  CONSTRAINT `fk_FAQ_Location1` FOREIGN KEY (`idLocation`) REFERENCES `Location` (`idLocation`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FAQ`
--

LOCK TABLES `FAQ` WRITE;
/*!40000 ALTER TABLE `FAQ` DISABLE KEYS */;
/*!40000 ALTER TABLE `FAQ` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Flora`
--

DROP TABLE IF EXISTS `Flora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Flora` (
  `idFlora` int(11) NOT NULL AUTO_INCREMENT,
  `commonName` varchar(100) DEFAULT NULL,
  `scientificName` varchar(150) DEFAULT NULL,
  `description` blob,
  PRIMARY KEY (`idFlora`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Flora`
--

LOCK TABLES `Flora` WRITE;
/*!40000 ALTER TABLE `Flora` DISABLE KEYS */;
/*!40000 ALTER TABLE `Flora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Grave`
--

DROP TABLE IF EXISTS `Grave`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Grave` (
  `idGrave` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) DEFAULT NULL,
  `middleName` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `birth` date DEFAULT NULL,
  `death` date DEFAULT NULL,
  `description` blob,
  `idHistoricFilter` int(11) DEFAULT NULL,
  PRIMARY KEY (`idGrave`),
  KEY `fk_Grave_HistoricFilter1_idx` (`idHistoricFilter`),
  CONSTRAINT `fk_Grave_HistoricFilter1` FOREIGN KEY (`idHistoricFilter`) REFERENCES `HistoricFilter` (`idHistoricFilter`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Grave`
--

LOCK TABLES `Grave` WRITE;
/*!40000 ALTER TABLE `Grave` DISABLE KEYS */;
/*!40000 ALTER TABLE `Grave` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `HistoricFilter`
--

DROP TABLE IF EXISTS `HistoricFilter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `HistoricFilter` (
  `idHistoricFilter` int(11) NOT NULL AUTO_INCREMENT,
  `historicFilter` varchar(150) DEFAULT NULL,
  `description` blob,
  `buttonColor` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`idHistoricFilter`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HistoricFilter`
--

LOCK TABLES `HistoricFilter` WRITE;
/*!40000 ALTER TABLE `HistoricFilter` DISABLE KEYS */;
/*!40000 ALTER TABLE `HistoricFilter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Location`
--

DROP TABLE IF EXISTS `Location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Location` (
  `idLocation` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` blob,
  `url` varchar(2083) DEFAULT NULL,
  `longitude` decimal(9,6) DEFAULT NULL,
  `latitude` decimal(9,6) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `zipcode` int(11) DEFAULT NULL,
  `imagePath` varchar(200) DEFAULT NULL,
  `imageDescription` varchar(200) DEFAULT NULL,
  `pinDesign` varchar(2093) DEFAULT NULL,
  `trailOrder` int(11) DEFAULT NULL,
  PRIMARY KEY (`idLocation`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Location`
--

LOCK TABLES `Location` WRITE;
/*!40000 ALTER TABLE `Location` DISABLE KEYS */;
INSERT INTO `Location` VALUES (7,'Rapids Cemetery','Rapids Cemetery Description','http://mcnygenealogy.com/cem/rapids.htm',-77.639473,43.129366,'86 Congress Ave','Rochester','NY',14619,'http://api.ning.com/files/y7kCYIEatclT5iVzRPqE0gFrR55*qb5v-odLCEdh1GiCaCYBsLFjWNm-35MBiZtC0hn7ee4ulxjtrNIzuGgZT8MAUAYrmqDX/RAPIDSCEMETERYI.JPG','Path Description','http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=1|FE6256|000000',1);
/*!40000 ALTER TABLE `Location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `NaturalHistory`
--

DROP TABLE IF EXISTS `NaturalHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `NaturalHistory` (
  `idNaturalHistory` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` blob,
  PRIMARY KEY (`idNaturalHistory`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NaturalHistory`
--

LOCK TABLES `NaturalHistory` WRITE;
/*!40000 ALTER TABLE `NaturalHistory` DISABLE KEYS */;
/*!40000 ALTER TABLE `NaturalHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TrackableObject`
--

DROP TABLE IF EXISTS `TrackableObject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TrackableObject` (
  `idTrackableObject` int(11) NOT NULL AUTO_INCREMENT,
  `longitude` decimal(9,6) DEFAULT NULL,
  `latitude` decimal(9,6) DEFAULT NULL,
  `scavengerHuntHint` blob,
  `imagePath` varchar(200) DEFAULT NULL,
  `imageDescription` varchar(200) DEFAULT NULL,
  `idLocation` int(11) NOT NULL,
  `idType` int(11) NOT NULL,
  `idNaturalHistory` int(11) DEFAULT NULL,
  `idFlora` int(11) DEFAULT NULL,
  `idGrave` int(11) DEFAULT NULL,
  PRIMARY KEY (`idTrackableObject`,`idLocation`),
  KEY `fk_TrackableObject_Location1_idx` (`idLocation`),
  KEY `fk_TrackableObject_Type1_idx` (`idType`),
  KEY `fk_TrackableObject_NaturalHistory1_idx` (`idNaturalHistory`),
  KEY `fk_TrackableObject_Flora1_idx` (`idFlora`),
  KEY `fk_TrackableObject_Grave1_idx` (`idGrave`),
  CONSTRAINT `fk_TrackableObject_Flora1` FOREIGN KEY (`idFlora`) REFERENCES `Flora` (`idFlora`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_Grave1` FOREIGN KEY (`idGrave`) REFERENCES `Grave` (`idGrave`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_Location1` FOREIGN KEY (`idLocation`) REFERENCES `Location` (`idLocation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_NaturalHistory1` FOREIGN KEY (`idNaturalHistory`) REFERENCES `NaturalHistory` (`idNaturalHistory`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_Type1` FOREIGN KEY (`idType`) REFERENCES `Type` (`idType`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TrackableObject`
--

LOCK TABLES `TrackableObject` WRITE;
/*!40000 ALTER TABLE `TrackableObject` DISABLE KEYS */;
/*!40000 ALTER TABLE `TrackableObject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Type`
--

DROP TABLE IF EXISTS `Type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Type` (
  `idType` int(11) NOT NULL AUTO_INCREMENT,
  `typeFilter` varchar(150) DEFAULT NULL,
  `description` blob,
  `pinDesign` varchar(2083) DEFAULT NULL,
  `buttonColor` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`idType`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Type`
--

LOCK TABLES `Type` WRITE;
/*!40000 ALTER TABLE `Type` DISABLE KEYS */;
INSERT INTO `Type` VALUES (1,'Grave','?','http://maps.google.com/mapfiles/ms/icons/blue-dot.png','6a93ff'),(2,'Flora','?','http://maps.google.com/mapfiles/ms/icons/green-dot.png','00e74d'),(3,'Natural History','?','http://maps.google.com/mapfiles/ms/icons/yellow-dot.png','\'fdd8');
/*!40000 ALTER TABLE `Type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-01 13:09:00
