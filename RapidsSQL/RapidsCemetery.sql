-- MySQL dump 10.13  Distrib 5.7.17, for macos10.12 (x86_64)
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
INSERT INTO `Account` VALUES (1,'Dustin','Spitz','dts5425@rit.edu','c02c8e4776c5a2135fa88f31652b8d79b81a437a'),(2,'David','Camacho','dac6892@rit.edu',NULL);
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
  `imagePath` varchar(2083) DEFAULT NULL,
  `idLocation` int(11) NOT NULL,
  PRIMARY KEY (`idContact`,`idLocation`),
  KEY `fk_Contact_Location_idx` (`idLocation`),
  CONSTRAINT `fk_Contact_Location` FOREIGN KEY (`idLocation`) REFERENCES `Location` (`idLocation`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Contact`
--

LOCK TABLES `Contact` WRITE;
/*!40000 ALTER TABLE `Contact` DISABLE KEYS */;
INSERT INTO `Contact` VALUES (1,'Dustin','Spitz','dts5425@rit.edu',NULL,'RIT Student','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque augue augue, suscipit sit amet pharetra a, consequat posuere leo. Aliquam ac ex nisl. Nam volutpat condimentum efficitur. Pellentesque non porttitor sem. Nam porttitor ornare mauris. Nulla vel blandit ante. Etiam id luctus ipsum. Donec a risus pellentesque, suscipit quam ut, efficitur lorem.','http://www.buira.org/assets/images/shared/default-profile.png',1),(2,'John','Smith','jsmith@email.com',NULL,'Grounds Keeper','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque augue augue, suscipit sit amet pharetra a, consequat posuere leo. Aliquam ac ex nisl. Nam volutpat condimentum efficitur. Pellentesque non porttitor sem. Nam porttitor ornare mauris. Nulla vel blandit ante. Etiam id luctus ipsum. Donec a risus pellentesque, suscipit quam ut, efficitur lorem.','http://www.buira.org/assets/images/shared/default-profile.png',1),(3,'Amanda','Simmons','',NULL,'Donations Manager','Lorem ipsum I manage the funding for rapids cemetery. We hold fundraisers...','https://roiproperties.com/wp-content/uploads/2017/06/user_profile_female.jpg',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Event`
--

LOCK TABLES `Event` WRITE;
/*!40000 ALTER TABLE `Event` DISABLE KEYS */;
INSERT INTO `Event` VALUES (9,'Children&#39;s History Tour','An event where children can learn about the things found here at Rapids Cemetery.','2018-04-12 15:00:00','2018-04-12 18:00:00','','',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `FAQ`
--

LOCK TABLES `FAQ` WRITE;
/*!40000 ALTER TABLE `FAQ` DISABLE KEYS */;
INSERT INTO `FAQ` VALUES (1,'How can I host an event here?','You can contact one of our representatives to schedule a time at the site.',1),(2,'How many people visit the cemetery?','lots.',1),(3,'How many trees are here?','Approximately 16 or so trees.',1),(4,'Does this application look easy to use?','Hopefully so.',1);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Flora`
--

LOCK TABLES `Flora` WRITE;
/*!40000 ALTER TABLE `Flora` DISABLE KEYS */;
INSERT INTO `Flora` VALUES (1,'Dandelions','Scientific Dandelions','Wonders of the universe'),(2,'Blackberries','Scientific Blackberries','ubus occidentalis is a species of Rubus native to eastern North America. Its common name black raspberry is shared with th'),(3,'Forget me Knots','Scientific forget me not','Myosotis is a genus of flowering plants in the family Boraginaceae. In the northern hemisphere they are co');
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Grave`
--

LOCK TABLES `Grave` WRITE;
/*!40000 ALTER TABLE `Grave` DISABLE KEYS */;
INSERT INTO `Grave` VALUES (2,'John','T.','Smith','1922-03-26','2000-04-20','He was one of the last members of a family to pass who still live in this cemetery',NULL),(3,'Jim','H.','Jones','1907-03-13','1987-07-07','A good member',1),(4,'Abby','N.','Smithy','1921-07-17','2001-11-07','Loved living in Rochester',1),(5,'Gloria','R.','Leblanc','1922-04-14','1922-04-14','A medical nurse.',2),(6,'Arnold','L.','Sholtz','1922-04-14','1922-04-14','In the airforce units.',NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `HistoricFilter`
--

LOCK TABLES `HistoricFilter` WRITE;
/*!40000 ALTER TABLE `HistoricFilter` DISABLE KEYS */;
INSERT INTO `HistoricFilter` VALUES (1,'Civil War',NULL,'b0bec5'),(2,'Spanish War',NULL,'b0bec5'),(4,'World War 1',NULL,'b0bec5');
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Location`
--

LOCK TABLES `Location` WRITE;
/*!40000 ALTER TABLE `Location` DISABLE KEYS */;
INSERT INTO `Location` VALUES (1,'Rapids Cemetery','This cemetery was probably founded between 1810 and 1812. The property was originally owned by the Wadsworth family which owned land from Geneseo to Rochester. The Wadsworths set aside one and a quarter acre for a burial place of area residents. The cemetery resided in the Town of Gates until 1902 when the area was annexed into the City of Rochester. The road leading to the cemetery was originally called Cemetery Road. Then between 1880 and 1890 the name was changed to Chester Street. In 1899, Chester Street became Congress Avenue.','http://mcnygenealogy.com/cem/rapids.htm',-77.639473,43.129366,'86 Congress Ave','Rochester','NY',14619,'http://api.ning.com/files/y7kCYIEatclT5iVzRPqE0gFrR55*qb5v-odLCEdh1GiCaCYBsLFjWNm-35MBiZtC0hn7ee4ulxjtrNIzuGgZT8MAUAYrmqDX/RAPIDSCEMETERYI.JPG','Path Description','http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=1|FE6256|000000',0),(2,'The National Susan B. Anthony Museum & House','The National Susan B. Anthony Museum & House in Rochester, NY was the home of the legendary American civil rights leader, and the site of her famous arrest for voting in 1872. This home was the headquarters of the National American Woman Suffrage Association when she was its president. This is also where she died in 1906 at age 86, following her &#34;Failure is Impossible&#34; speech in Baltimore. We invite you to tour our website to learn more about this great reformer and the many programs we offer to inspire others to change the world for the better. Visit through the Photo Gallery, browse through the merchandise in our museum shop, and learn about our ever-expanding programs. ','http://susanbanthonyhouse.org/index.php',-77.628064,43.153187,'17 Madison Street','Rochester','NY',14608,'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d5/Susan-b-anthony-house.jpg/250px-Susan-b-anthony-house.jpg','Susan B. Anthony Museum and House','http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=3|FE6256|000000',3),(5,'Susan B. Anthony Square','Located off West Main Street just west of downtown, the park is situated close to the home of Susan B. Anthony. It is a perfect place to rest after a visit to the Susan B. Anthony Museum. \r\n\r\nThe park&#39;s focal point is a bronzed sculpture called &#34;Let&#39;s Have Tea.&#34; The work portrays Ms. Anthony and Frederick Douglass, two early local champions of civil rights. The famous suffragist and abolitionist were close friends who shared the common goals of social justice and civil rights. Now they share a proud place in Rochester&#39;s history.\r\n\r\n&#34;Let&#39;s Have Tea&#34; was created by Rochester sculptor Pepsy Kettavong and erected in 2001 -- at the behest of the Susan B. Anthony Neighborhood Association -- across the street from the Susan B. Anthony House Museum.','http://www.cityofrochester.gov/article.aspx?id=8589936553',-77.627226,43.154087,'31 Madison Street','Rochester','NY',14608,'http://sbawalkingtour.weebly.com/uploads/2/9/8/9/29897167/5186831.jpg','Susan B. Anthony Square','http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=4|FE6256|000000',4),(6,'Frederick Douglass Gravesight','Social Reformer, Human Rights Leader. Black American who was one of the most eminent human rights leaders of the 19th century. His oratorical and literary brilliance thrust him into the forefront of the U.S. abolition movement and he became the first black citizen to hold hight rank in the U.S government. Separated as an infant from his slave mother, he never knew his white father, Frederick lived with his grandmother on a Maryland plantation until at the age of eight, his owner sent him to Baltimore to live as a house servant with the family of Hugh Auld, whose wife defied state law by teaching the boy to read. But Auld declared that learning would make him unfit for slavery and Frederick was forced to continue his education surreptitously with the aid of schoolboys in the street. Upon the death of his master, he was returned to the plantation as a field hand at 16. Later he was hired out in Baltimore as a ship caulker. He tried to escape with the three others in 1833, but the plot was discovered before they could get away. five years later, however','https://www.findagrave.com/memorial/6110193/frederick-douglass',-77.614477,43.130988,'Mt. Hope Cemetery, Mt Hope Ave','Rochester','NY',14620,'https://images.findagrave.com/photos/2015/134/6110193_1431731086.jpg','Frederick Douglass Tombstone','http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=2|FE6256|000000',2),(7,'People&#39;s Choice Kitchen','Van has been in business for 14 years, starting out at 507 Chili Avenue across from the bank by Thurston. Then she moved to the former Turn-in-Tavern at 651 Chili Avenue just down the road. Now she is here at 575 Brooks. This is the capital for jerk chicken in Rochester! The savory meat melts off the bone, and has been Van’s claim to fame since she first opened in 2001. People’s Choice Kitchen offers a variety of Caribbean-style foods. Many traditional, some unique. Turkey now available as well, and wraps are popular, big enough to wrap your hand around.','https://www.facebook.com/Peoples-Choice-Kitchen-165686636926466/',-77.651087,43.130797,'575 Brooks Ave','Rochester','NY',14619,'http://api.ning.com/files/ylRDB7-m0MoKffBkp0D4BCf3N-NJZOGCXRlOG6CbroQvix-fppjfvO7TCebjj2M3jyyshkZy5fs4cfDvsG6vgsN4FesotWCc/IMG_1918amr.JPG','','http://www.googlemapsmarkers.com/v1/F/0000FF/FFFFFF/FF0000/',0),(11,'Brue Coffee','Coffee Shop','https://www.facebook.com/bruecoffee/',-77.635809,43.131244,'960 Genesee St','Rochester','NY',14619,'http://honolulumagazine-images.dashdigital.com/images/Blogs/BitingCommentary/2013/October2013/Brue%20Bar%20Cappuccino.jpg','descriptions','http://www.googlemapsmarkers.com/v1/F/0000FF/FFFFFF/FF0000/',0);
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
INSERT INTO `NaturalHistory` VALUES (1,'Beehive','Full of bees.'),(2,'Amphitheater','An amphitheatre or amphitheater is an open-air venue used for entertainment, performances, and sports. The term derives from the ancient Greek');
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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TrackableObject`
--

LOCK TABLES `TrackableObject` WRITE;
/*!40000 ALTER TABLE `TrackableObject` DISABLE KEYS */;
INSERT INTO `TrackableObject` VALUES (8,-77.639472,43.129565,'sadfdsfdfdf','https://www.organicfacts.net/wp-content/uploads/Dandelion.jpg','adsfdf',1,2,NULL,1,NULL),(9,-77.639381,43.129572,'','http://www.usgwarchives.net/wi/cemetery/images/onieda/nokomistwp-prairierapids/nokomistwp-prairierapids011.jpg','description',1,1,NULL,NULL,2),(10,-77.639377,43.129515,'','http://www.usgwarchives.net/wi/cemetery/images/onieda/nokomistwp-prairierapids/nokomistwp-prairierapids019.jpg','description',1,1,NULL,NULL,3),(11,-77.639305,43.129478,'','http://www.usgwarchives.net/wi/cemetery/images/onieda/nokomistwp-prairierapids/nokomistwp-prairierapids035.jpg','description',1,1,NULL,NULL,4),(12,-77.639003,43.129533,'','http://www.usgwarchives.net/wi/cemetery/images/onieda/nokomistwp-prairierapids/nokomistwp-prairierapids008.jpg','description',1,1,NULL,NULL,5),(13,-77.638979,43.129482,'','http://www.usgwarchives.net/wi/cemetery/images/onieda/nokomistwp-prairierapids/nokomistwp-prairierapids012.jpg','description',1,1,NULL,NULL,6),(14,-77.639473,43.129682,'','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTzBCfbxFlK2hTdo4upIYcfTf2moDMqiRRF-GlBnGhywU-dS87c','image descriptions',1,2,NULL,2,NULL),(15,-77.639711,43.129484,'','https://i.ytimg.com/vi/bPeh07foWAA/hqdefault.jpg','image descriptions',1,2,NULL,3,NULL),(16,-77.639174,43.129635,'','https://d3i6fh83elv35t.cloudfront.net/newshour/app/uploads/2015/11/RTXZ3DT-e1487891078282-1024x629.jpg','images descripty',1,3,1,NULL,NULL),(17,-77.638936,43.129683,'','https://upload.wikimedia.org/wikipedia/commons/6/67/Kalmanovitz_Hall_amphitheater.jpg','images descripty',1,4,2,NULL,NULL);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Type`
--

LOCK TABLES `Type` WRITE;
/*!40000 ALTER TABLE `Type` DISABLE KEYS */;
INSERT INTO `Type` VALUES (1,'Grave','?','http://maps.google.com/mapfiles/ms/icons/blue-dot.png','6a93ff'),(2,'Flora','?','http://maps.google.com/mapfiles/ms/icons/green-dot.png','00e74d'),(3,'Natural History','?','http://maps.google.com/mapfiles/ms/icons/yellow-dot.png','fbc02d'),(4,'Location Marker','','http://maps.google.com/mapfiles/ms/icons/red-dot.png','c62828');
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

-- Dump completed on 2018-04-06 19:41:23
