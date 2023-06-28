-- MySQL dump 10.13  Distrib 5.5.32, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: newsdb
-- ------------------------------------------------------
-- Server version	5.5.32-0ubuntu0.12.04.1

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
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_id` int(11) DEFAULT NULL,
  `comment` text,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `small_text` text,
  `full_text` text,
  `author` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES (1,'02.06.15 - NASA Television will provide live coverage of a news briefing on the Deep Space Climate Observatory (DSCOVR) mission, the National Oceanic and Atmospheric Administrationâ€™s (NOAA) new satellite mission to monitor space weather, at 1 p.m. EST Saturday, Feb. 7 from the Press Site at Kennedy Space','NASA Television will provide live coverage of a news briefing on the Deep Space Climate Observatory (DSCOVR) mission, the National Oceanic and Atmospheric Administrationâ€™s (NOAA) new satellite mission to monitor space weather, at 1 p.m. EST Saturday, Feb. 7 from the Press Site at Kennedy Space Center in Florida. The briefing also will stream live on the agencyâ€™s website. Reporters not at Kennedy may ask questions via phone by contacting the Kennedy newsroom at 321-867-2468 no later than 12:30 p.m. Saturday. Questions also can be submitted via social media using the hashtag #askDSCOVR.','admin'),(2,'02.04.15 - After delivering more than 5,000 pounds of supplies and experiments to the International Space Station last month, the SpaceX Dragon cargo spacecraft is set to leave the orbiting laboratory on Tuesday, Feb. 10.','After delivering more than 5,000 pounds of supplies and experiments to the International Space Station last month, the SpaceX Dragon cargo spacecraft is set to leave the orbiting laboratory on Tuesday, Feb. 10.','user01'),(3,'02.04.15 - NASAâ€™s New Horizons spacecraft returned its first new images of Pluto on Wednesday, as the probe closes in on the dwarf planet. Although still just a dot along with its largest moon, Charon, the images come on the 109th birthday of Clyde Tombaugh, who discovered the distant icy world in 1930.','NASAâ€™s New Horizons spacecraft returned its first new images of Pluto on Wednesday, as the probe closes in on the dwarf planet. Although still just a dot along with its largest moon, Charon, the images come on the 109th birthday of Clyde Tombaugh, who discovered the distant icy world in 1930.','admin'),(4,'01.31.15 - NASA successfully launched its first Earth satellite designed to collect global observations of the vital soil moisture hidden just beneath our feet. The Soil Moisture Active Passive (SMAP) observatory, a mission with broad applications for science and society, lifted off at 6:22 a.m.','NASA successfully launched its first Earth satellite designed to collect global observations of the vital soil moisture hidden just beneath our feet. About 57 minutes after liftoff, SMAP separated from the rocket\'s second stage into an initial 411- by 425-mile (661- by 685-kilometer) orbit. After a series of activation procedures, the spacecraft established communications with ground controllers and deployed its solar array. Initial telemetry shows the spacecraft is in excellent health.','user02'),(5,'01.29.15 - Media and social media followers are invited to watch as NASA tests the largest, most powerful booster ever built March 11 at ATK Aerospace System\'s test facility in Promontory, Utah. The booster will power NASAâ€™s Space Launch System (SLS), which will be used to help send humans to deep space','Media and social media followers are invited to watch as NASA tests the largest, most powerful booster ever built March 11 at ATK Aerospace System\'s test facility in Promontory, Utah. The booster will power NASAâ€™s Space Launch System (SLS), which will be used to help send humans to deep space destinations including an asteroid and Mars.','admin');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` text,
  `password` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','qwerty'),(2,'user01','password'),(3,'user02','password');
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

-- Dump completed on 2017-05-24 19:13:05
