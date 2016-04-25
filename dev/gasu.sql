-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: gasu
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

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
-- Table structure for table `cilindros`
--

DROP TABLE IF EXISTS `cilindros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cilindros` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(50) DEFAULT NULL,
  `capacidad` int(5) DEFAULT NULL,
  `usuario` int(9) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario` (`usuario`),
  CONSTRAINT `cilindros_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cilindros`
--

LOCK TABLES `cilindros` WRITE;
/*!40000 ALTER TABLE `cilindros` DISABLE KEYS */;
INSERT INTO `cilindros` VALUES (1,'Av. Universidad 2507',35,2,'Taller'),(2,'Hacienda del Charco 2807',45,3,'Casa Tia'),(3,'Calle 9na 5505',45,2,'Abuelita'),(4,'Av. Vallarta',45,4,'Casa');
/*!40000 ALTER TABLE `cilindros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registros`
--

DROP TABLE IF EXISTS `registros`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `registros` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` datetime DEFAULT NULL,
  `tanque` int(9) DEFAULT NULL,
  `porcentaje` decimal(5,5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tanque` (`tanque`),
  CONSTRAINT `registros_ibfk_1` FOREIGN KEY (`tanque`) REFERENCES `tanques` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registros`
--

LOCK TABLES `registros` WRITE;
/*!40000 ALTER TABLE `registros` DISABLE KEYS */;
INSERT INTO `registros` VALUES (1,'2016-04-04 10:27:37',1,0.17000),(2,'2016-04-11 10:27:15',3,0.75000),(3,'2016-04-14 11:34:47',1,0.48000);
/*!40000 ALTER TABLE `registros` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tanques`
--

DROP TABLE IF EXISTS `tanques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tanques` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `direccion` varchar(50) DEFAULT NULL,
  `capacidad` int(5) DEFAULT NULL,
  `usuario` int(9) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario` (`usuario`),
  CONSTRAINT `tanques_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tanques`
--

LOCK TABLES `tanques` WRITE;
/*!40000 ALTER TABLE `tanques` DISABLE KEYS */;
INSERT INTO `tanques` VALUES (1,'Calle 33 1905',500,2,'Casa'),(2,'Av. Universidad 1523',400,3,'Casa'),(3,'Celedonia Gonzalez 5507',118,2,'Oficina'),(4,'Carlos Fuero 904',200,3,'Departamento');
/*!40000 ALTER TABLE `tanques` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `nombres` varchar(50) DEFAULT NULL,
  `apPaterno` varchar(30) DEFAULT NULL,
  `apMaterno` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `contrasenia` varchar(50) DEFAULT NULL,
  `nivel` int(1) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'Hector Manuel','Olivas','Prieto','holivas','tyholivas',2,'holivas24@gmail.com'),(2,'Alan Daniel','Villatoro','Ochoa','dvillatoro','asdf',1,'advillatoro1@gmail.com'),(3,'Tania Vianey','Jaquez','Chacon','tjaquez','qwerty',1,'tjaquez24@gmail.com'),(4,'Derek','Jeter','','djeter','zxcv',1,'djeter@gmail.com');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-04-25 11:27:57
