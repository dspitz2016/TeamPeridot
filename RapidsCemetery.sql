-- MySQL dump 10.14  Distrib 5.5.56-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: RapidsCemetery
-- ------------------------------------------------------
-- Server version	5.5.56-MariaDB

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
INSERT INTO `Account` VALUES (1,'Dustin','Spitz','dts5425@rit.edu','c02c8e4776c5a2135fa88f31652b8d79b81a437a'),(2,'David','Camacho','dac6892@rit.edu ','c02c8e4776c5a2135fa88f31652b8d79b81a437a');
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Event`
--

LOCK TABLES `Event` WRITE;
/*!40000 ALTER TABLE `Event` DISABLE KEYS */;
INSERT INTO `Event` VALUES (2,'Childrens Tour','A wonderful tour','2018-04-20 16:20:00','2018-04-20 17:20:00',NULL,NULL,1);
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
INSERT INTO `FAQ` VALUES (1,'Can we host an event with Rapids Cemetery?','?',1),(2,'How many graves do you have here?','?',1),(3,'How old is the cemetery?','?',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Flora`
--

LOCK TABLES `Flora` WRITE;
/*!40000 ALTER TABLE `Flora` DISABLE KEYS */;
INSERT INTO `Flora` VALUES (1,'Black Raspberries','Rubus occidentalis','?'),(2,'Decorative Flower Border West',NULL,'?');
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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Grave`
--

LOCK TABLES `Grave` WRITE;
/*!40000 ALTER TABLE `Grave` DISABLE KEYS */;
INSERT INTO `Grave` VALUES (1,'Richardson Family',' ',' ',NULL,NULL,'?',NULL),(2,' ',' ','Loomis',NULL,NULL,'?',1),(3,' ',' ','Peiffer',NULL,NULL,'?',2),(4,'Bartlett Family',' ',' ',NULL,NULL,'?',NULL),(15,'Dustin','Tyler','Spitz','1994-06-27','2018-03-17','I Tried...',4);
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
  `startDate` date DEFAULT NULL,
  `endDate` date DEFAULT NULL,
  `imagePath` varchar(200) DEFAULT NULL,
  `imageDescription` varchar(200) DEFAULT NULL,
  `buttonColor` varchar(6) DEFAULT NULL,
  PRIMARY KEY (`idHistoricFilter`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HistoricFilter`
--

LOCK TABLES `HistoricFilter` WRITE;
/*!40000 ALTER TABLE `HistoricFilter` DISABLE KEYS */;
INSERT INTO `HistoricFilter` VALUES (1,'War of 1812','?',NULL,NULL,NULL,NULL,'b0bec5'),(2,'Spanish American War','?',NULL,NULL,NULL,NULL,'b0bec5'),(3,'Civil War','?',NULL,NULL,NULL,NULL,'b0bec5'),(4,'Other',NULL,NULL,NULL,NULL,NULL,'b0bec5');
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Location`
--

LOCK TABLES `Location` WRITE;
/*!40000 ALTER TABLE `Location` DISABLE KEYS */;
INSERT INTO `Location` VALUES (1,'Rapids Cemetery','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed convallis tempor sapien, eu commodo neque molestie a. Proin gravida ultrices nibh, nec pulvinar mi porttitor ut. Donec placerat lacus vitae pulvinar tempus. Cras magna erat, luctus ut commodo fringilla, semper quis sapien. Vestibulum cursus, libero a vestibulum pharetra,','http://mcnygenealogy.com/cem/rapids.htm',-77.639473,43.129366,'86 Congress Ave','Rochester','NY',14619,'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVnutSU0-j17GcIdBb-Kr93Hg7mwr1CXzcbTvjmsVhSrSDWn5C',NULL,'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=1|FE6256|000000',1),(2,'Brooks Landing','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed convallis tempor sapien, eu commodo neque molestie a. Proin gravida ultrices','http://www.cityofrochester.gov/assets/0/117/8589934987/0d6698e2-d71d-4ba8-bb93-b8971a4b38c4.jpg',-77.635597,43.132335,'904 Genesee St','Rochester','NY',14611,NULL,NULL,'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=2|FE6256|000000',2),(3,'Susan B. Anthony House and Museum','Lorem ipsum dolor sit amet, consectetur adipiscing ','https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/Susan-b-anthony-house.jpg/250px-Susan-b-anthony-house.jpg',-77.628064,43.153187,'\n17 Madison St','Rochester','NY',14608,'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/Susan-b-anthony-house.jpg/250px-Susan-b-anthony-house.jpg',NULL,'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=3|FE6256|000000',3),(4,'Corn Hill','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed convallis tempor sapien, eu commodo neque molestie a. Proin gravida ultrices nibh, nec pulvinar mi porttitor ut. Donec placerat lacus vitae pulvinar tempus. Cras magna erat, ','http://www.canalny.com/uploads/photo_gallery//fullsize_897_02381308073170.JPG',-77.616380,43.148478,'\nCorn Hill','Rochester','NY',14608,NULL,NULL,'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=5|FE6256|000000',5),(5,'Susan B Anthony Square','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed convallis tempor sapien, eu commodo neque molestie a. Proin gravida ultrices nibh, nec pulvinar mi porttitor ut. Donec placerat lacus vitae pulvinar tempus. Cras magna erat, luctus ut commodo fringilla, semper quis sapien. Vestibulum cursus, libero a vestibulum pharetra,','https://en.wikipedia.org/wiki/Lehigh_Valley_Railroad_Station_(Rochester,_New_York)',-77.627226,43.154087,NULL,NULL,NULL,NULL,NULL,NULL,'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=4|FE6256|000000',4),(6,'Rundel Memorial Building','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed convallis tempor sapien, eu commodo neque molestie a. Proin gravida ultrices nibh, ','http://www.libraryweb.org/rochimag/architecture/SpecificBuildings/Rundel/Rundel.htm',-77.608443,43.154112,NULL,NULL,NULL,NULL,NULL,NULL,'http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=6|FE6256|000000',6);
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
INSERT INTO `NaturalHistory` VALUES (1,'Beehive','?'),(2,'Entrance','?'),(3,'Amphitheater','?');
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
  CONSTRAINT `fk_TrackableObject_Flora1` FOREIGN KEY (`idFlora`) REFERENCES `Flora` (`idFlora`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_Grave1` FOREIGN KEY (`idGrave`) REFERENCES `Grave` (`idGrave`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_Location1` FOREIGN KEY (`idLocation`) REFERENCES `Location` (`idLocation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_NaturalHistory1` FOREIGN KEY (`idNaturalHistory`) REFERENCES `NaturalHistory` (`idNaturalHistory`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_TrackableObject_Type1` FOREIGN KEY (`idType`) REFERENCES `Type` (`idType`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TrackableObject`
--

LOCK TABLES `TrackableObject` WRITE;
/*!40000 ALTER TABLE `TrackableObject` DISABLE KEYS */;
INSERT INTO `TrackableObject` VALUES (1,-77.639403,43.129651,'?','http://www.usgwarchives.net/wi/cemetery/images/onieda/nokomistwp-prairierapids/nokomistwp-prairierapids019.jpg',NULL,0,1,NULL,NULL,1),(2,-77.639383,43.129570,'?','http://www.usgwarchives.net/wi/cemetery/images/onieda/nokomistwp-prairierapids/nokomistwp-prairierapids012.jpg',NULL,0,1,NULL,NULL,2),(3,-77.639386,43.129531,'?','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSKI0_Ybixgi7NJhL1L87yzKLeXillww0LQop-PygsA7VSeo5gnSg',NULL,0,1,NULL,NULL,3),(4,-77.639084,43.129632,'?','https://i.pinimg.com/236x/38/f0/b7/38f0b744fb2ea6f4a19bddb80b100ec5.jpg',NULL,0,1,NULL,NULL,4),(5,-77.639495,43.129704,'?','https://img.aws.livestrongcdn.com/ls-article-image-673/ds-photo/getty/article/211/54/156208423.jpg',NULL,0,2,NULL,1,NULL),(6,-77.639650,43.129484,'?','http://dreamicus.com/data/garden/garden-01.jpg',NULL,0,2,NULL,2,NULL),(7,-77.639171,43.129683,'?','https://wonderopolis.org/_img?img=/wp-content/uploads/2010/11/Wonder-51-Bees-Winter-Static-Image.jpg',NULL,0,3,1,NULL,NULL),(9,-77.639361,43.129313,'?',NULL,NULL,0,4,2,NULL,NULL),(10,-77.638945,43.129698,'?','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTBBxCr1LVEjZUU8hcoMNb4G9gMr0SZkQFKq7hWK_0KNRz2Q-og',NULL,0,4,3,NULL,NULL),(11,-77.639091,43.129458,'You might find him','','',1,1,NULL,NULL,NULL),(12,-77.639091,43.129458,'You might find him','','',1,1,NULL,NULL,NULL),(13,-77.639091,43.129458,'You might find him','','',1,1,NULL,NULL,15);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Type`
--

LOCK TABLES `Type` WRITE;
/*!40000 ALTER TABLE `Type` DISABLE KEYS */;
INSERT INTO `Type` VALUES (1,'Grave','?','http://maps.google.com/mapfiles/ms/icons/blue-dot.png','6a93ff'),(2,'Flora','?','http://maps.google.com/mapfiles/ms/icons/green-dot.png','00e74d'),(3,'Natural History','?','http://maps.google.com/mapfiles/ms/icons/yellow-dot.png','\'fdd8'),(4,'Location Marker','?','http://maps.google.com/mapfiles/ms/icons/red-dot.png','fd7667');
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

-- Dump completed on 2018-03-22 18:08:32
