-- MySQL dump 10.13  Distrib 5.6.24, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: control_vehiculos
-- ------------------------------------------------------
-- Server version	5.7.10-log

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
-- Table structure for table `conductores`
--

DROP TABLE IF EXISTS `conductores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conductores` (
  `persona_DNI` char(8) NOT NULL,
  `estado` char(1) NOT NULL,
  `licencia` varchar(45) NOT NULL,
  `vencimiento` date NOT NULL,
  `categoria` varchar(10) NOT NULL,
  `cnrt_personal` char(1) DEFAULT NULL,
  `cnrt_gral` char(1) DEFAULT NULL,
  `cnrt_peligroso` char(1) DEFAULT NULL,
  `cnrt_vencimiento` date DEFAULT NULL,
  `escribania` char(1) DEFAULT NULL,
  PRIMARY KEY (`persona_DNI`),
  KEY `fk_conductor_persona_idx` (`persona_DNI`),
  CONSTRAINT `fk_conductor_persona` FOREIGN KEY (`persona_DNI`) REFERENCES `personas` (`DNI`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conductores`
--

LOCK TABLES `conductores` WRITE;
/*!40000 ALTER TABLE `conductores` DISABLE KEYS */;
INSERT INTO `conductores` VALUES ('14686987','I','1484714-B','2017-09-13','Conductor','S','S','S','2015-11-01','N'),('33978109','A','31345678-B','2016-11-08','Conductor','S','N','N','2017-12-08','S');
/*!40000 ALTER TABLE `conductores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `historial_viajes`
--

DROP TABLE IF EXISTS `historial_viajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `historial_viajes` (
  `vehiculos_numero` smallint(6) NOT NULL DEFAULT '0',
  `viajes_idviajes` int(11) NOT NULL DEFAULT '0',
  `km` varchar(45) DEFAULT NULL,
  `litros` varchar(45) DEFAULT NULL,
  `promedio` varchar(45) DEFAULT NULL,
  `lugar` varchar(60) DEFAULT NULL,
  `pago` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`vehiculos_numero`,`viajes_idviajes`),
  KEY `fk_vehiculos_idx` (`vehiculos_numero`),
  KEY `fk_viajes_idx` (`viajes_idviajes`),
  CONSTRAINT `fk_vehiculos` FOREIGN KEY (`vehiculos_numero`) REFERENCES `vehiculos` (`numero`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_viajes` FOREIGN KEY (`viajes_idviajes`) REFERENCES `viajes` (`idviajes`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `historial_viajes`
--

LOCK TABLES `historial_viajes` WRITE;
/*!40000 ALTER TABLE `historial_viajes` DISABLE KEYS */;
/*!40000 ALTER TABLE `historial_viajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `mantenimiento`
--

DROP TABLE IF EXISTS `mantenimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mantenimiento` (
  `idmantenimiento` int(11) NOT NULL,
  `proveedores_idproveedores` int(11) NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `km` varchar(45) DEFAULT NULL,
  `precio` varchar(20) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `titulo` varchar(200) DEFAULT NULL,
  `horas` int(11) DEFAULT NULL,
  `descripcion` text,
  PRIMARY KEY (`idmantenimiento`,`proveedores_idproveedores`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mantenimiento`
--

LOCK TABLES `mantenimiento` WRITE;
/*!40000 ALTER TABLE `mantenimiento` DISABLE KEYS */;
INSERT INTO `mantenimiento` VALUES (1,6,'2015-12-15','2015-12-15','100','','Realizado','Revision gral',NULL,'Revision del tren delantero y el tren trasero'),(2,6,'2015-12-16','2015-12-16','100','','Realizado','Revision completa',NULL,''),(3,6,'2015-12-16','2015-12-16','1500','','Realizado','Revision completa',NULL,''),(4,6,'2015-12-16','2015-12-16','1500','','Realizado','Revision completa',NULL,''),(5,6,'2015-12-16','2015-12-16','1500','','Realizado','Service gral',NULL,'Cambio de aceite y filtro de aire, revision de cubiertas, lavado, aspirado y alineado');
/*!40000 ALTER TABLE `mantenimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partes`
--

DROP TABLE IF EXISTS `partes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partes` (
  `idpartes` int(11) NOT NULL,
  `partes_idpartes` int(11) NOT NULL DEFAULT '0',
  `vehiculos_numero` smallint(6) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `kmInicial` varchar(45) DEFAULT NULL,
  `kmFinal` varchar(45) DEFAULT NULL,
  `fechaInicial` date DEFAULT NULL,
  `fechaProxima` date DEFAULT NULL,
  `descripcion` text,
  `especificaciones` text,
  PRIMARY KEY (`idpartes`,`partes_idpartes`,`vehiculos_numero`),
  KEY `partes_idx` (`partes_idpartes`),
  KEY `vehiculos_idx` (`vehiculos_numero`),
  CONSTRAINT `vehiculos` FOREIGN KEY (`vehiculos_numero`) REFERENCES `vehiculos` (`numero`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partes`
--

LOCK TABLES `partes` WRITE;
/*!40000 ALTER TABLE `partes` DISABLE KEYS */;
INSERT INTO `partes` VALUES (1,0,20,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(2,0,20,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(3,0,20,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(4,0,20,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(5,0,20,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(6,0,20,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(7,0,20,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(8,0,20,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(9,0,20,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(10,0,20,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(11,0,20,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(12,0,20,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(13,0,19,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(14,0,19,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(15,0,19,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(16,0,19,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(17,0,19,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(18,0,19,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(19,0,19,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(20,0,19,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(21,0,19,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(22,0,19,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(23,0,19,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(24,0,19,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(25,0,18,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(26,0,18,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(27,0,18,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(28,0,18,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(29,0,18,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(30,0,18,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(31,0,18,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(32,0,18,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(33,0,18,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(34,0,18,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(35,0,18,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(36,0,18,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(37,0,17,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(38,0,17,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(39,0,17,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(40,0,17,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(41,0,17,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(42,0,17,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(43,0,17,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(44,0,17,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(45,0,17,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(46,0,17,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(47,0,17,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(48,0,17,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(49,0,16,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(50,0,16,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(51,0,16,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(52,0,16,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(53,0,16,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(54,0,16,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(55,0,16,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(56,0,16,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(57,0,16,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(58,0,16,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(59,0,16,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(60,0,16,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(61,0,15,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(62,0,15,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(63,0,15,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(64,0,15,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(65,0,15,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(66,0,15,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(67,0,15,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(68,0,15,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(69,0,15,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(70,0,15,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(71,0,15,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(72,0,15,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(73,0,14,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(74,0,14,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(75,0,14,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(76,0,14,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(77,0,14,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(78,0,14,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(79,0,14,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(80,0,14,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(81,0,14,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(82,0,14,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(83,0,14,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(84,0,14,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(85,0,13,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(86,0,13,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(87,0,13,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(88,0,13,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(89,0,13,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(90,0,13,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(91,0,13,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(92,0,13,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(93,0,13,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(94,0,13,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(95,0,13,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(96,0,13,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(97,0,12,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(98,0,12,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(99,0,12,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(100,0,12,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(101,0,12,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(102,0,12,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(103,0,12,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(104,0,12,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(105,0,12,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(106,0,12,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(107,0,12,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(108,0,12,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(109,0,11,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(110,0,11,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(111,0,11,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(112,0,11,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(113,0,11,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(114,0,11,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(115,0,11,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(116,0,11,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(117,0,11,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(118,0,11,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(119,0,11,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(120,0,11,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(121,0,10,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(122,0,10,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(123,0,10,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(124,0,10,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(125,0,10,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(126,0,10,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(127,0,10,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(128,0,10,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(129,0,10,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(130,0,10,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(131,0,10,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(132,0,10,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(133,0,9,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(134,0,9,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(135,0,9,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(136,0,9,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(137,0,9,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(138,0,9,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(139,0,9,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(140,0,9,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(141,0,9,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(142,0,9,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(143,0,9,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(144,0,9,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(145,0,8,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(146,0,8,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(147,0,8,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(148,0,8,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(149,0,8,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(150,0,8,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(151,0,8,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(152,0,8,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(153,0,8,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(154,0,8,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(155,0,8,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(156,0,8,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(157,0,7,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(158,0,7,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(159,0,7,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(160,0,7,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(161,0,7,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(162,0,7,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(163,0,7,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(164,0,7,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(165,0,7,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(166,0,7,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(167,0,7,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(168,0,7,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(169,0,6,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(170,0,6,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(171,0,6,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(172,0,6,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(173,0,6,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(174,0,6,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(175,0,6,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(176,0,6,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(177,0,6,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(178,0,6,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(179,0,6,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(180,0,6,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(181,0,5,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(182,0,5,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(183,0,5,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(184,0,5,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(185,0,5,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(186,0,5,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(187,0,5,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(188,0,5,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(189,0,5,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(190,0,5,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(191,0,5,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(192,0,5,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(193,0,4,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(194,0,4,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(195,0,4,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(196,0,4,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(197,0,4,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(198,0,4,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(199,0,4,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(200,0,4,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(201,0,4,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(202,0,4,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(203,0,4,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(204,0,4,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(205,0,3,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(206,0,3,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(207,0,3,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(208,0,3,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(209,0,3,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(210,0,3,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(211,0,3,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(212,0,3,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(213,0,3,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(214,0,3,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(215,0,3,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(216,0,3,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(217,0,2,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(218,0,2,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(219,0,2,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(220,0,2,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(221,0,2,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(222,0,2,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(223,0,2,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(224,0,2,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(225,0,2,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(226,0,2,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(227,0,2,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(228,0,2,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(229,0,1,'Sistema eléctrico','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(230,0,1,'Tren delantero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(231,0,1,'Tren trasero','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(232,0,1,'Carrocería y chasis','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(233,0,1,'Motor','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(234,0,1,'Sistema de dirección','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(235,0,1,'Sistema de transmisión','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(236,0,1,'Interior','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(237,0,1,'Caja de cambios','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(238,0,1,'Sistema de frenos','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(239,0,1,'Sistema de refrigeración','Parte',NULL,NULL,NULL,NULL,NULL,NULL),(240,0,1,'Sistema de iluminación','Parte',NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `partes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partespormantenimiento`
--

DROP TABLE IF EXISTS `partespormantenimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partespormantenimiento` (
  `mantenimientos_idmantenimiento` int(11) NOT NULL,
  `partes_idpartes` int(11) NOT NULL,
  `descripcion` text,
  `observaciones` text,
  `operacion` varchar(100) NOT NULL,
  PRIMARY KEY (`mantenimientos_idmantenimiento`,`partes_idpartes`),
  KEY `partes_idx` (`partes_idpartes`),
  CONSTRAINT `mantenimiento` FOREIGN KEY (`mantenimientos_idmantenimiento`) REFERENCES `mantenimiento` (`idmantenimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `partes` FOREIGN KEY (`partes_idpartes`) REFERENCES `partes` (`idpartes`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partespormantenimiento`
--

LOCK TABLES `partespormantenimiento` WRITE;
/*!40000 ALTER TABLE `partespormantenimiento` DISABLE KEYS */;
INSERT INTO `partespormantenimiento` VALUES (5,233,'','','Reparacion');
/*!40000 ALTER TABLE `partespormantenimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `partesporplanmantenimiento`
--

DROP TABLE IF EXISTS `partesporplanmantenimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `partesporplanmantenimiento` (
  `planmantenimiento_idplan` int(11) NOT NULL,
  `partes_idpartes` int(11) NOT NULL,
  `operacion` varchar(45) DEFAULT NULL,
  `descripcion` varchar(140) DEFAULT NULL,
  PRIMARY KEY (`planmantenimiento_idplan`,`partes_idpartes`),
  KEY `fk_partes_idx` (`partes_idpartes`),
  CONSTRAINT `fk_partes` FOREIGN KEY (`partes_idpartes`) REFERENCES `partes` (`idpartes`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_planmantenimiento` FOREIGN KEY (`planmantenimiento_idplan`) REFERENCES `planmantenimiento` (`idplanMantenimiento`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `partesporplanmantenimiento`
--

LOCK TABLES `partesporplanmantenimiento` WRITE;
/*!40000 ALTER TABLE `partesporplanmantenimiento` DISABLE KEYS */;
INSERT INTO `partesporplanmantenimiento` VALUES (1,1,'Cambio',NULL),(1,2,'Revision',NULL),(2,1,'Revision',NULL),(2,5,'Cambio',NULL);
/*!40000 ALTER TABLE `partesporplanmantenimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personas`
--

DROP TABLE IF EXISTS `personas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personas` (
  `DNI` char(8) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `telefono` varchar(45) NOT NULL,
  `foto` blob,
  `tipo` char(1) NOT NULL,
  PRIMARY KEY (`DNI`),
  UNIQUE KEY `DNI_UNIQUE` (`DNI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personas`
--

LOCK TABLES `personas` WRITE;
/*!40000 ALTER TABLE `personas` DISABLE KEYS */;
INSERT INTO `personas` VALUES ('14686987','Alberto','Parodi','a.parodi@sermico.com.ar','3815026801',NULL,''),('33978109','Gabriel','Parodi','gabrielparodigap@gmail.com','3814425821',NULL,'');
/*!40000 ALTER TABLE `personas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `planmantenimiento`
--

DROP TABLE IF EXISTS `planmantenimiento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `planmantenimiento` (
  `idplanMantenimiento` int(11) NOT NULL,
  `titulo` varchar(80) NOT NULL,
  `km` char(4) DEFAULT NULL,
  `horas` char(4) DEFAULT NULL,
  `dias` char(4) DEFAULT NULL,
  `meses` char(4) DEFAULT NULL,
  `años` char(4) DEFAULT NULL,
  `descripcion` text,
  `ultimoVencimiento` date DEFAULT NULL,
  `estado` char(10) DEFAULT NULL,
  `ultimoKm` char(6) DEFAULT NULL,
  `ultimaHora` char(4) DEFAULT NULL,
  PRIMARY KEY (`idplanMantenimiento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='		';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `planmantenimiento`
--

LOCK TABLES `planmantenimiento` WRITE;
/*!40000 ALTER TABLE `planmantenimiento` DISABLE KEYS */;
INSERT INTO `planmantenimiento` VALUES (1,'Plan 1','5000',NULL,NULL,NULL,'5','Plan de mantenimiento para prueba del sisitema','2015-10-18','Activo','1000',NULL),(2,'Plan 2','1000',NULL,'20',NULL,NULL,'Plan de mantenimiento 2 para prueba del sisitema','2015-11-20','Activo','0',NULL);
/*!40000 ALTER TABLE `planmantenimiento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proveedores` (
  `idproveedores` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `CUIT/CUIL` varchar(45) DEFAULT NULL,
  `Provincia` varchar(60) DEFAULT NULL,
  `Localidad` varchar(60) DEFAULT NULL,
  `CP` varchar(6) DEFAULT NULL,
  `Direccion` varchar(200) DEFAULT NULL,
  `Mail` varchar(100) DEFAULT NULL,
  `Telefono` varchar(45) DEFAULT NULL,
  `Tipo` varchar(60) DEFAULT NULL,
  `Descripcion` text,
  `Calificacion` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idproveedores`),
  UNIQUE KEY `idproveedores_UNIQUE` (`idproveedores`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'Lubricentro Simonetto',NULL,'Tucuman','S.M de tucuman','4000','Av. Belgrano 2100',NULL,'4237865','Externo','Cambio de aceite y filtros',NULL),(2,'Mecanica Parodi','','','','','','','','','',''),(3,'JGD Neumaticos',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(4,'Tucuman Diesel',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,'Sermico',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(6,'-',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `user` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `estado` char(1) NOT NULL,
  `persona_DNI` char(8) NOT NULL,
  PRIMARY KEY (`user`,`persona_DNI`),
  KEY `fk_usuario_persona1_idx` (`persona_DNI`),
  CONSTRAINT `fk_usuario_persona1` FOREIGN KEY (`persona_DNI`) REFERENCES `personas` (`DNI`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES ('1','1','A','33978109'),('gparodi','1234','A','33978109');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehiculos`
--

DROP TABLE IF EXISTS `vehiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehiculos` (
  `numero` smallint(6) NOT NULL,
  `idInterno` varchar(45) NOT NULL,
  `marca` varchar(45) DEFAULT NULL,
  `modelo` varchar(45) DEFAULT NULL,
  `patente` varchar(45) DEFAULT NULL,
  `kilometros` varchar(45) DEFAULT NULL,
  `estado` varchar(45) DEFAULT NULL,
  `combustible` varchar(45) DEFAULT NULL,
  `foto` longblob,
  `año` char(4) DEFAULT NULL,
  `peso_max` char(6) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `modeloMotor` varchar(45) DEFAULT NULL,
  `descripcion` text,
  `numero_de_chasis` varchar(45) DEFAULT NULL,
  `motor` varchar(45) DEFAULT NULL,
  `cobertura` varchar(60) DEFAULT NULL,
  `consumo` varchar(4) DEFAULT NULL,
  `ot` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`numero`),
  UNIQUE KEY `numero_UNIQUE` (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculos`
--

LOCK TABLES `vehiculos` WRITE;
/*!40000 ALTER TABLE `vehiculos` DISABLE KEYS */;
INSERT INTO `vehiculos` VALUES (1,'01','TOYOTA','HILUX','DJR-177','2000',NULL,NULL,NULL,'2001',NULL,'Camioneta','2.8 D',NULL,'8AJ33LNA54930018','3L-4922524','Ninguna',NULL,'100-177'),(2,'02','FORD','RANGER','OPK339','100',NULL,NULL,NULL,'2015',NULL,'Camioneta','2.5',NULL,'8AFAR21J1FJ308321','QW2PFJ308321','Ninguna',NULL,'100-339'),(3,'03','TOYOTA','HILUX','FMM-454',NULL,NULL,NULL,NULL,'2006',NULL,'Camioneta','2.5 TD',NULL,'8AJFR226064507695','2KD-7078381','Carga Peligrosa',NULL,'100-454'),(4,'04','TOYOTA','HILUX','FMM-453',NULL,NULL,NULL,NULL,'2006',NULL,'Camioneta','2.5 TD',NULL,'8AJFR226264507410','2KD-7072528','Carga Peligrosa',NULL,'100-453'),(5,'05','TOYOTA','HILUX','GXX-048',NULL,NULL,NULL,NULL,'2008',NULL,'Camioneta','2.5 TD',NULL,'8AJFR226384526857','2KD-7466735','Carga Peligrosa',NULL,'100-048'),(6,'06','TOYOTA','HILUX','HRM-703',NULL,NULL,NULL,NULL,'2009',NULL,'Camioneta','2.5 TD',NULL,'8AJFR226794533229','2KD-7698829','Carga Peligrosa',NULL,'100-703'),(7,'07','TOYOTA','HILUX','HTY-645',NULL,NULL,NULL,NULL,'2009',NULL,'Camioneta','2.5 TD',NULL,'8AJFR226494533656','2KD-7715720','Carga Peligrosa',NULL,'100-645'),(8,'08','TOYOTA','HILUX','MKJ-683',NULL,NULL,NULL,NULL,'2013',NULL,'Camioneta','3.0 TDI',NULL,'88AJFZ2268D5023264','1KD-1000082','Ninguna',NULL,'100-683'),(9,'09','VOLKSWAGEN','AMAROK','MMH313',NULL,NULL,NULL,NULL,'2013',NULL,'Camioneta','2.0TDI',NULL,'8AWDB42H3DA015848','CNE024604','Ninguna',NULL,'100-313'),(10,'10','	NISSAN','FRONTIER','GLK-690',NULL,NULL,NULL,NULL,'2007',NULL,'Camioneta','2.8 TDI',NULL,'94DCEUD228J858582','M1A292656','Ninguna',NULL,'100-690'),(11,'11','	TOYOTA','HILUX CAB. SIMPLE','CRP 679',NULL,NULL,NULL,NULL,'1999',NULL,'Camioneta','2.5 STD',NULL,'8AJ31LN86X9505043','3L-4688738','Ninguna',NULL,'100-679'),(12,'12','JEEP','GRAN CHEROKEE','HRM-702',NULL,NULL,NULL,NULL,'2009',NULL,'Camioneta','-',NULL,'1J8HC58M78Y13771','8Y13771','Ninguna',NULL,'100-702'),(13,'13','FORD','RANGER DC 4X4 XL SAFETY','OUP 715','32456',NULL,NULL,NULL,'2015',NULL,'Camioneta','-',NULL,'8AFAR23J2FJ332060','QW2PFJ332060','Ninguna',NULL,'100-715'),(14,'14','FIAT','STRADA TREAKKING 1,3  JTD','KKS 742',NULL,NULL,NULL,NULL,'2011',NULL,'Camioneta','1.3 JTD',NULL,'9BD27833RC7421758','223A90004185366','Ninguna',NULL,'100-742'),(15,'15','FIAT','STRADA TREAKKING 1,3  JTD','KKS 774',NULL,NULL,NULL,NULL,'2011',NULL,'Camioneta','1.3 JTD',NULL,'9BD27833RC7422198','223A90004170540','Ninguna',NULL,'100-774'),(16,'16','FIAT','STRADA TREKKING 1,3  JTD',' KOA 153',NULL,NULL,NULL,NULL,'2011',NULL,'Camioneta','1.3 JTD',NULL,'9BD27833RC7422430','223A90004170559','Ninguna',NULL,'100-153'),(17,'17','FIAT','STRADA ADVENTURE 1.6','KNU 497',NULL,NULL,NULL,NULL,'2011',NULL,'Camioneta','1.6',NULL,'9BD27826VC7424439','178F4055214163','Ninguna',NULL,'100-497'),(18,'18','FORD','RANGER XL2.2 TDI DC 4X2','NWL592',NULL,NULL,NULL,NULL,'2014',NULL,'Camioneta','2.2 TDI',NULL,'8AFAR22J5EJ220952','QW2PEJ220952','Ninguna',NULL,'100-592'),(19,'19','FORD','RANGER XL2.2 TDI DC 4X2','NWL591',NULL,NULL,NULL,NULL,'2014',NULL,'Camioneta','2.2 TDI',NULL,'8AFAR22J5EJ218361','QW2PEJ218361','Ninguna',NULL,'100-591'),(20,'20','FORD','RANGER XL 4x2 SAFETY 2.2L DSL','OQY385','1000',NULL,NULL,NULL,'2015',NULL,'Camioneta','2.2 6SPED',NULL,'8AFAR22J1FJ310018','QW2PFJ310018','Ninguna',NULL,'100-385'),(21,'22','MERCEDES BENZ','SPRINTER 413 CDI/C 4025','KCA 971',NULL,NULL,NULL,NULL,'2011',NULL,'Minibus','413CDI',NULL,'8AC904663CE047899','611,981 70 124695','Ninguna',NULL,'100-971'),(22,'23','MERCEDES BENZ','SPRINTER 515 CDI','MIC819',NULL,NULL,NULL,NULL,'2013',NULL,'Minibus','515CDI',NULL,'8AC906657DE076084','651955W0014186','Ninguna',NULL,'100-819'),(23,'24','MERCEDES BENZ','SPRINTER 515 CDI','PDG 128',NULL,NULL,NULL,NULL,'2015',NULL,'Minibus','515CDI',NULL,'8AC906657GE112151','651955W0050198','Ninguna',NULL,'100-128'),(24,'31','FORD','14000','EIF-033',NULL,NULL,NULL,NULL,'2004',NULL,'Camión','F.14000',NULL,'9BFXK84F04BO97996','30777663','Ninguna',NULL,'100-033'),(25,'32','FORD','CARGO 915E',' HTY-644',NULL,NULL,NULL,NULL,'2009',NULL,'Camión','915E',NULL,'9BFVCE1N19BB18508','36058724','Ninguna',NULL,'100-644'),(26,'33','MERCEDES BENZ','LS-1634','HRM-709',NULL,NULL,NULL,NULL,'2009',NULL,'Camión','1634',NULL,'9BM6950539B633480','457914U0930617','Ninguna',NULL,'100-6709'),(27,'34','MERCEDES BENZ','AXOR 2831','HIO131',NULL,NULL,NULL,NULL,'2008',NULL,'Camión','2831/48 6X4',NULL,'9BM9582649B597501','926930U0778675','Ninguna',NULL,'100-131'),(28,'35','MERCEDES BENZ','ATEGO 1725 A','OYX759',NULL,NULL,NULL,NULL,'2015',NULL,'Camión','',NULL,'9BM958078GB010895','906985U1150035','Ninguna',NULL,''),(29,'37','SALTO','','JTU451',NULL,NULL,NULL,NULL,'2009',NULL,'Semi Remolque','',NULL,'8AAG1363SB0014300','','Carga Peligrosa',NULL,''),(30,'38','SALTO','','NXK886',NULL,NULL,NULL,NULL,'2014',NULL,'Semi Remolque','',NULL,'8AAG1363SE0016278','','Ninguna',NULL,''),(31,'45','MANITOU','1440','',NULL,NULL,NULL,NULL,'2007',NULL,'Manipulador Telescópico','PERKIN',NULL,'4.9','U432376P','Ninguna',NULL,'100-001'),(32,'46','SKY TRACK','8042','',NULL,NULL,NULL,NULL,'2004',NULL,'Manipulador Telescópico','CUMMINS',NULL,'','','Ninguna',NULL,'100-002');
/*!40000 ALTER TABLE `vehiculos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `viajes`
--

DROP TABLE IF EXISTS `viajes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `viajes` (
  `idviajes` int(11) NOT NULL,
  `conductores_dni` char(8) NOT NULL,
  `dia_inicio` datetime NOT NULL,
  `dia_fin` datetime NOT NULL,
  `origen` varchar(50) NOT NULL,
  `destino` varchar(50) NOT NULL,
  `descripcion` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`idviajes`,`conductores_dni`),
  UNIQUE KEY `idviajes_UNIQUE` (`idviajes`),
  KEY `conductores_dni_idx` (`conductores_dni`),
  CONSTRAINT `conductores_dni` FOREIGN KEY (`conductores_dni`) REFERENCES `conductores` (`persona_DNI`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `viajes`
--

LOCK TABLES `viajes` WRITE;
/*!40000 ALTER TABLE `viajes` DISABLE KEYS */;
/*!40000 ALTER TABLE `viajes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'control_vehiculos'
--
/*!50003 DROP FUNCTION IF EXISTS `poblar_partes_vehiculos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `poblar_partes_vehiculos`() RETURNS int(11)
BEGIN
DECLARE i INT DEFAULT 20;

  WHILE i > 0 DO
    
call alta_partes(0 ,i,'Aceite de motor','Insumo',null,null,null,null,null,null);
call alta_partes(0 ,i,'Filtro de aire','Insumo',null,null,null,null,null,null);
call alta_partes(0 ,i,'Correa de distribucion','Insumo',null,null,null,null,null,null);
call alta_partes(0 ,i,'Motor','Parte',null,null,null,null,null,null);
call alta_partes(0 ,i,'Filtro de combustible','Insumo',null,null,null,null,null,null);
call alta_partes(0 ,i,'Faro delantero izq','Parte',null,null,null,null,null,null);
call alta_partes(0 ,i,'Faro trasero izq','Parte',null,null,null,null,null,null);
call alta_partes(0 ,i,'Faro delantero der','Parte',null,null,null,null,null,null);
call alta_partes(0 ,i,'Faro trasero der','Parte',null,null,null,null,null,null);
call alta_partes(0 ,i,'Interior','Parte',null,null,null,null,null,null);
call alta_partes(0 ,i,'Caja de cambios','Parte',null,null,null,null,null,null);
call alta_partes(0 ,i,'Diferencial','Parte',null,null,null,null,null,null);
call alta_partes(0 ,i,'Tren delantero','Parte',null,null,null,null,null,null);
call alta_partes(0 ,i,'Tren trasero','Parte',null,null,null,null,null,null);
call alta_partes(0 ,i,'Cubiertas delanteras','Cubiertas',null,null,null,null,null,null);
call alta_partes(0 ,i,'Cubiertas traseras','Cubiertas',null,null,null,null,null,null);
SET i = i - 1;
  END WHILE;
RETURN 1;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `alta_conductor` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_conductor`(ppersona_dni CHAR(8),plicencia varchar(45),
pvencimiento DATE,pestado CHAR, pcnrt_ppersonal char(1),pcnrt_peligroso char(1),pcnrt_gral char(1),
cnrt_vencimiento DATE,escribania char(1),pcategoria varchar(10))
SALIR:BEGIN
DECLARE mensaje VARCHAR(45);
	IF(ppersona_dni IS NULL OR pdni="") THEN
		SET mensaje= 'El dni no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(pestado IS NULL) THEN
		SET mensaje= 'El estado no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(plincencia IS NULL OR plicencia="") THEN
		SET mensaje= 'La licencia no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(ptipo IS NULL OR ptipo="") THEN
		SET mensaje= 'El tipo no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(pvencimiento IS NULL) THEN
		SET mensaje= 'Fecha de vencimiento no valida';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;

START TRANSACTION;
	INSERT INTO conductores VALUES (ppersona_dni,pestado,plicencia,pvencimiento,
	pcategoria,pcnrt_personal, pcnrt_gral,pcnrt_peligroso,pcnrt_vencimiento,escribania);
COMMIT;
	SET mensaje='OK';
	SELECT mensaje;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `alta_mantenimiento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_mantenimiento`(pproveedores VARCHAR(45), pfechaInicio VARCHAR(20),
pfechaFin varchar(20),pkm VARCHAR(45),pprecio VARCHAR(20),pestado VARCHAR(45),ptitulo VARCHAR(200),pdescripcion TEXT)
SALIR: BEGIN
DECLARE fechaInicio DATE;
DECLARE fechaFin DATE;
DECLARE pid INT;
DECLARE pidProveedores INT;
	SET fechaInicio=STR_TO_DATE(pFechaInicio,'%d/%m/%Y');
	IF(pfechaInicio='0000-00-00'OR fechaInicio='0000-00-00'OR fechaInicio=NULL OR pfechaInicio=NULL)THEN
		SET fechaInicio=NULL;
	END IF;

	SET fechaFin=STR_TO_DATE(pFechaFin,'%d/%m/%Y');
	IF(pfechaFin='0000-00-00'OR fechaFin='0000-00-00'OR fechaFin=NULL OR pfechaFin=NULL)THEN
		SET fechaFin=NULL;
	END IF;
SET pid=1 + (SELECT COALESCE(MAX(idMantenimiento),0) FROM mantenimiento);
SET pidProveedores=(SELECT p.idProveedores FROM proveedores p WHERE p.Nombre=pproveedores);
START TRANSACTION;
INSERT INTO mantenimiento VALUES (pid, pidproveedores, fechaInicio,
fechaFin ,pkm ,pprecio,pestado,ptitulo,null,pdescripcion);
COMMIT;
SELECT idMantenimiento FROM mantenimiento WHERE idmantenimiento=pid;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `alta_partes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_partes`(partes_idpartes INT,ppadre VARCHAR(60),vehiculo_numero SMALLINT, nombre VARCHAR(45),tipo VARCHAR(45),kmInicial VARCHAR(45),
kmFinal VARCHAR(45),pfechaInicial VARCHAR(20),pfechaProxima VARCHAR(20), descripcion TEXT, especificaciones TEXT)
SALIR:BEGIN
DECLARE mensaje VARCHAR(65);
DECLARE idParte INT;
DECLARE fechaInicial DATE;
DECLARE fechaProxima DATE;
DECLARE parte_de INT;

	
	SET fechaInicial=STR_TO_DATE(pFechaInicial,'%d/%m/%Y');
	IF(pfechaInicial='0000-00-00'OR fechaInicial='0000-00-00'OR fechaInicial=NULL OR pfechaInicial=NULL)THEN
		SET fechaInicial=NULL;
	END IF;

	SET fechaProxima=STR_TO_DATE(pFechaProxima,'%d/%m/%Y');
	IF(pfechaProxima='0000-00-00'OR fechaProxima='0000-00-00'OR fechaProxima=NULL OR pfechaProxima=NULL)THEN
		SET fechaProxima=NULL;
	END IF;
IF(nombre IS NULL OR nombre='')THEN
	SET mensaje='El nombre no puede ser nulo';
	SELECT mensaje;
	LEAVE SALIR;
END IF;

IF NOT EXISTS (SELECT * FROM partes WHERE idPartes=partes_idpartes)THEN
IF(partes_idpartes!=0)THEN
	SET mensaje=CONCAT('NOK,','No puede crear un componente de una parte que no existe');
	SELECT mensaje;
	LEAVE SALIR;
END IF;
END IF;
IF(ppadre IS NULL)THEN
SET parte_de=partes_idpartes;
ELSE
SET parte_de=(SELECT p.idpartes FROM partes p WHERE p.nombre=ppadre AND p.vehiculos_numero=vehiculo_numero);
END IF;
SET idParte=1 + (SELECT COALESCE(MAX(idPartes),0) FROM partes);
START TRANSACTION;
INSERT INTO partes VALUES (idParte,parte_de ,vehiculo_numero , nombre ,tipo ,kmInicial,kmFinal,
fechaInicial ,fechaProxima  , descripcion , especificaciones);
COMMIT;
SET mensaje=CONCAT('OK',idParte);
SELECT mensaje;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `alta_partespormantenimiento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_partespormantenimiento`(pidmantenimiento INT,pidVehiculo INT,ppartes VARCHAR(60),pdescripcion TEXT,pobservaciones TEXT, poperacion VARCHAR(60))
BEGIN
DECLARE pidpartes INT;
SET pidpartes=(SELECT idPartes FROM partes WHERE nombre=ppartes AND vehiculos_numero=pidVehiculo);
START TRANSACTION;
INSERT INTO partespormantenimiento VALUES (pidmantenimiento,pidpartes,pdescripcion,pobservaciones,poperacion);
COMMIT;
SELECT 'OK';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `alta_persona` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_persona`(pdni CHAR(8),pnombre varchar(45), papellido varchar(45), pmail varchar(50),
 ptelefono varchar(45), pfoto BLOB,ptipo CHAR(1))
SALIR:BEGIN
	DECLARE mensaje VARCHAR(45);
	IF(pdni IS NULL OR pdni="") THEN
		SET mensaje= 'El dni no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(pnombre IS NULL OR pnombre="") THEN
		SET mensaje= 'El nombre no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(ptipo IS NULL) THEN
		SET mensaje= 'El tipo no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(ptipo!='E')THEN
		IF(papellido IS NULL OR papellido="") THEN
			SET mensaje= 'El apellido no puede ser nulo';
			SELECT mensaje;
			LEAVE SALIR;
		END IF;
	END IF;
	IF(pmail IS NULL OR pmail="") THEN
		SET mensaje= 'El mail no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(ptelefono IS NULL OR ptelefono="") THEN
		SET mensaje= 'El telefono no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF EXISTS (SELECT dni FROM personas WHERE dni=pdni)THEN
		SET mensaje='Ya existe una persona con ese dni.';
        SELECT mensaje;
        LEAVE SALIR;
	END IF;

	START TRANSACTION;
	INSERT INTO Personas VALUES (pdni,pnombre,papellido,pmail,ptelefono,pfoto,pfechanac,ptipo);
	SET mensaje= CONCAT('OK',pdni);
	SELECT mensaje;
	COMMIT;	
	

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `alta_planmantenimiento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_planmantenimiento`(idplan INT,partes_idpartes INT,partes_idpartes2 INT,vehiculo_numero SMALLINT,
nombre VARCHAR(45),tipo VARCHAR(45),km VARCHAR(45),fecha DATE,descripcion TEXT)
SALIR:BEGIN
DECLARE mensaje VARCHAR(45);
DECLARE pidplanMantenimiento INT;
IF(idplan=0)THEN
SET pidplanMantenimiento=1+ (SELECT COALESCE(MAX(idplanmantenimiento),0) FROM planmantenimiento);
ELSE
SET pidplanmantenimiento=idplan;
END IF;
START TRANSACTION;
INSERT INTO planmantenimiento VALUES (pidplanmantenimiento,partes_idpartes,partes_idpartes2,vehiculo_numero,
nombre,tipo,km,fecha,descripcion);
COMMIT;
SELECT CONCAT('OK',pidplanmantenimiento);


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `alta_proveedores` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_proveedores`(pnombre VARCHAR(100),pCUIT VARCHAR(45),pprovincia VARCHAR(60),plocalidad VARCHAR(60),
pcp VARCHAR(6),pdireccion VARCHAR(200),pmail VARCHAR(100),ptelefono VARCHAR(45),ptipo VARCHAR(60),pdescripcion TEXT,pcalificacion VARCHAR(20))
SALIR:BEGIN
DECLARE pid INT;

SET pid= 1 + (SELECT COALESCE(MAX(idProveedores),0) FROM Proveedores);
START TRANSACTION;
INSERT INTO proveedores VALUES (pid,pnombre,pCUIT,pprovincia ,plocalidad,
pcp,pdireccion,pmail,ptelefono,ptipo,pdescripcion,pcalificacion);
COMMIT;
SELECT CONCAT('OK',pid);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `alta_proveedor_simple` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_proveedor_simple`(pnombre VARCHAR(60))
SALIR:BEGIN
DECLARE pid INT;
DECLARE mensaje VARCHAR(45);
IF EXISTS((SELECT nombre FROM proveedores WHERE nombre=pnombre))THEN
	SET mensaje='NOK';
	SELECT  mensaje;
	LEAVE SALIR;
END IF;
SET pid= 1 + (SELECT COALESCE(MAX(idProveedores),0) FROM Proveedores);
START TRANSACTION;
INSERT INTO proveedores VALUES (pid,pnombre,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
COMMIT;
SET mensaje='OK';
SELECT  mensaje;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `alta_vehiculo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `alta_vehiculo`(pidInterno VARCHAR(45),ppatente varchar(45),pmarca varchar(45),
pmodelo varchar(45),paño CHAR(4),pcobertura VARCHAR(60),pmotor varchar(45),pchasis varchar(45),pmodeloMotor VARCHAR(45),
pot VARCHAR(45),ptipo VARCHAR(60))
SALIR:BEGIN
DECLARE mensaje varchar(45);
DECLARE pnumero smallint;
	
	
START TRANSACTION;
		SET pnumero=1+(SELECT COALESCE(MAX(numero),0)FROM vehiculos);
		INSERT INTO vehiculos VALUES (pnumero,pidInterno,pmarca,pmodelo,ppatente,null,null,null,
		null,paño,null,ptipo,pmodeloMotor,null,pchasis,pmotor,pcobertura,null,pot);
		
COMMIT;
SELECT idInterno FROM vehiculos WHERE idInterno=pidInterno;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `borrar_parte` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `borrar_parte`(pidPartes INT)
SALIR:BEGIN

DELETE FROM partes WHERE idPartes=pidpartes;
SELECT 'OK';
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `borrar_planmantenimiento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `borrar_planmantenimiento`(pidplanmentenimiento INT, ppartes_idpartes INT)
SALIR:BEGIN
DECLARE mensaje VARCHAR(45);
IF(ppartes_idpartes!=0)THEN
	DELETE FROM planmantenimiento WHERE idplanmantenimiento=pidplanmantenimiento AND partes_idpartes=ppartes_idpartes;
	SELECT 'OK';
	LEAVE SALIR;
ELSE
	DELETE FROM planmantenimiento WHERE idplanmantenimiento=pidplanmanteniminento;
	SELECT'OK';
END IF;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `buscar_conductor` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_conductor`(cadena varchar(45))
SALIR:BEGIN
	SET cadena=TRIM(cadena);
	
	SELECT p.dni,p.apellido,p.nombre,p.mail,p.telefono,c.licencia,c.vencimiento,c.estado,c.cnrt_personal,
			c.cnrt_peligroso,c.cnrt_gral,c.cnrt_vencimiento,c.escribania,c.categoria
	FROM conductores c JOIN personas p ON c.persona_DNI=p.DNI
	WHERE p.DNI LIKE CONCAT(cadena,'%')||p.Apellido LIKE CONCAT(cadena,'%')||p.Nombre LIKE CONCAT(cadena,'%');

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `buscar_mantenimiento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_mantenimiento`(pnumero int)
SALIR: BEGIN
SELECT *,pr.nombre  FROM mantenimiento m
JOIN proveedores pr ON m.proveedores_idproveedores=pr.idproveedores
WHERE m.idmantenimiento=pnumero;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `buscar_parte` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_parte`(pvehiculos_numero SMALLINT,nivel INT,ppartes_idpartes INT,ptipo VARCHAR(45))
SALIR:BEGIN
IF (ppartes_idpartes IS NOT NULL AND ppartes_idpartes!=0)THEN
	SELECT * FROM partes
	WHERE vehiculos_numero=pvehiculos_numero AND idpartes LIKE CONCAT(ppartes_idpartes,'%'); 
	LEAVE SALIR;
END IF;

IF (ptipo IS NULL OR ptipo='')THEN
	SELECT * FROM partes
	WHERE vehiculos_numero=pvehiculos_numero AND partes_idpartes=nivel;
	LEAVE SALIR;
END IF;
IF (ptipo IS NOT NULL AND ptipo!='')THEN
	SELECT * FROM partes
	WHERE vehiculos_numero=pvehiculos_numero AND partes_idpartes=nivel AND tipo LIKE CONCAT(ptipo,'%'); 
	LEAVE SALIR;
END IF;


SELECT 'NOK';


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `buscar_partespormantenimiento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_partespormantenimiento`(pid INT)
BEGIN
SELECT m.idmantenimiento,p.idpartes,pxm.descripcion,pxm.observaciones
FROM partespormantenimiento pxm JOIN mantenimiento m ON pxm.mantenimientos_idmantenimiento=m.idmantenimiento
JOIN partes p ON pxm.partes_idpartes=p.idpartes 
WHERE m.idmantenimiento=pid;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `buscar_persona` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_persona`(cadena varchar(45))
SALIR:BEGIN
	SET cadena=TRIM(cadena);
	SELECT *
	FROM personas
	WHERE DNI LIKE CONCAT(cadena,'%')||Apellido LIKE CONCAT(cadena,'%')||Nombre LIKE CONCAT(cadena,'%');

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `buscar_planmantenimiento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_planmantenimiento`(pvehiculo SMALLINT)
SALIR:BEGIN

SELECT pm.vehiculo_numero,pm.partes_idpartes,p.nombre,pm.nombre,pm.tipo,pm.km,pm.fecha,pm.descripcion
FROM planmantenimiento pm JOIN partes p ON p.idpartes=pm.vehiculo_numero
WHERE vehiculo_numero=pvehiculo;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `buscar_plan_mantenimiento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_plan_mantenimiento`(pid INT)
BEGIN

SELECT ppm.operacion,
p.nombre, p.kmInicial,p.kmFinal,p.fechaInicial,p.fechaProxima,p.tipo,ppm.descripcion FROM 
planmantenimiento pm JOIN partesporplanmantenimiento ppm ON pm.idplanMantenimiento=ppm.planmantenimiento_idplan
JOIN partes p ON ppm.partes_idpartes=p.idpartes JOIN vehiculos v ON p.vehiculos_numero=v.numero
WHERE pm.idplanmantenimiento=pid;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `buscar_proveedores` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_proveedores`()
SALIR:BEGIN

SELECT *
FROM proveedores;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `buscar_usuario` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_usuario`(cadena varchar(45))
SALIR:BEGIN
	SET cadena=TRIM(cadena);
	SELECT u.user,u.password,u.estado,p.Apellido,p.Nombre,p.Dni,p.Mail,p.Telefono,p.foto
	FROM usuarios u join personas p ON u.persona_DNI=p.Dni
	WHERE u.user LIKE CONCAT(cadena,'%');

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `buscar_vehiculo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `buscar_vehiculo`(cadena varchar(45))
SALIR:BEGIN
	SET cadena=TRIM(cadena);
	SELECT *
	FROM vehiculos
	WHERE idInterno LIKE CONCAT(cadena,'%')||patente LIKE CONCAT(cadena,'%');

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `dametipos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `dametipos`(pid INT)
BEGIN

SELECT tipo from partes
WHERE partes.vehiculos_numero=pid
GROUP BY tipo;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `eliminar_conductor` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_conductor`(ppersona_dni CHAR(8))
SALIR:BEGIN
DECLARE mensaje VARCHAR(45);

	IF EXISTS(SELECT conductores_dni FROM viajes v JOIN conductores c ON v.conductores_dni=c.persona_dni)THEN
		SET mensaje='No es posible borrar al conductor por tener viajes asociados';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	DELETE FROM conductores
	WHERE persona_dni=ppersona_dni;
	SET mensaje='OK';
	SELECT mensaje;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `eliminar_persona` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_persona`(pdni CHAR(8))
SALIR:BEGIN
DECLARE mensaje varchar(45);
	IF EXISTS (SELECT persona_dni FROM Conductores WHERE persona_dni=pdni)THEN
		SET mensaje='No es posible borrar esta persona por tener conductores asociados';
		SELECT mensaje;
	END IF;
	IF EXISTS (SELECT persona_dni FROM Usuarios WHERE persona_dni=pdni)THEN
		SET mensaje='No es posible borrar esta persona por tener usuarios asociados';
		SELECT mensaje;
	END IF;
	IF EXISTS (SELECT persona_dni FROM Mantenimiento  WHERE persona_dni=pdni)THEN
		SET mensaje='No es posible borrar esta persona por tener mantenimientos asociados';
		SELECT mensaje;
	END IF;
	
	DELETE FROM personas
	WHERE dni=pdni;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `eliminar_vehiculo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_vehiculo`(pid int)
SALIR:BEGIN
	DELETE FROM vehiculos
	WHERE numero=pid;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `get_proximo_Mantenimiento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `get_proximo_Mantenimiento`()
BEGIN
DECLARE pid INT;

SET pid=1 + (SELECT COALESCE(MAX(idMantenimiento),0) FROM mantenimiento);
SELECT pid;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `listar_mantenimiento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_mantenimiento`(pnumero INT)
SALIR:BEGIN

IF(pnumero IS NOT NULL AND pnumero!=0)THEN
	SELECT m.idmantenimiento,m.titulo,pr.nombre,m.km,m.fechaInicio,m.fechaFin,m.horas,m.precio,m.estado  FROM mantenimiento m
	JOIN partespormantenimiento pxm ON pxm.mantenimientos_idmantenimiento=m.idmantenimiento
	JOIN partes p ON pxm.partes_idpartes=p.idpartes JOIN proveedores pr ON m.proveedores_idproveedores=pr.idproveedores
	WHERE p.vehiculos_numero=pnumero
	GROUP BY idmantenimiento;
	
ELSE
	SELECT m.idmantenimiento,p.vehiculos_numero,m.titulo,pr.nombre,m.km,m.fechaInicio,m.fechaFin,m.estado  FROM mantenimiento m
	JOIN partespormantenimiento pxm ON pxm.mantenimientos_idmantenimiento=m.idmantenimiento
	JOIN partes p ON pxm.partes_idpartes=p.idpartes JOIN proveedores pr ON m.proveedores_idproveedores=pr.idproveedores
	GROUP BY idmantenimiento;
END IF;	

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `listar_partes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_partes`(pnumero INT,ppadre INT,ptipo VARCHAR(45))
SALIR:BEGIN

IF(ptipo IS NOT NULL)THEN
SELECT p.idpartes,p.nombre FROM partes p
JOIN vehiculos v ON v.numero=p.vehiculos_numero
WHERE v.idInterno=pnumero AND p.partes_idpartes=ppadre AND p.tipo=ptipo;
ELSE
SELECT p.idpartes,p.nombre FROM partes p
JOIN vehiculos v ON v.numero=p.vehiculos_numero
WHERE v.idInterno=pnumero AND p.partes_idpartes=ppadre;
END IF;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `listar_partes_de_partes` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_partes_de_partes`(pnumero INT,ptipo VARCHAR(60),pnombre VARCHAR(60))
SALIR:BEGIN
SELECT p.idPartes,p.nombre FROM partes p 
WHERE p.vehiculos_numero=pnumero AND p.tipo=ptipo AND p.partes_idpartes=(SELECT p3.idPartes FROM partes p3 WHERE p3.nombre=pnombre
AND p3.partes_idpartes=0 AND p3.vehiculos_numero=pnumero);
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `listar_partes_por_mantenimiento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_partes_por_mantenimiento`(pidmantenimiento INT)
BEGIN
	SELECT p.idpartes,p.partes_idpartes,p.nombre,pm.operacion,pm.descripcion,pm.observaciones,p.tipo FROM mantenimiento m
	JOIN partespormantenimiento pm ON m.idmantenimiento=pm.mantenimientos_idmantenimiento
	JOIN partes p ON p.idpartes=pm.partes_idpartes
	WHERE m.idmantenimiento=pidmantenimiento;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `listar_planes_mantenimiento` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_planes_mantenimiento`()
BEGIN
SELECT pm.*,v.idInterno,v.marca,v.modelo,v.patente,v.kilometros 'kmVehiculo',v.ot FROM 
planmantenimiento pm JOIN partesporplanmantenimiento ppm ON pm.idplanMantenimiento=ppm.planmantenimiento_idplan
JOIN partes p ON ppm.partes_idpartes=p.idpartes JOIN vehiculos v ON p.vehiculos_numero=v.numero
GROUP BY idplanMantenimiento;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `listar_proveedores` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_proveedores`()
SALIR:BEGIN
SELECT nombre from proveedores
GROUP BY nombre;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `listar_tipos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_tipos`()
SALIR:BEGIN
	SELECT tipo FROM vehiculos
	GROUP BY tipo;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `listar_vehiculos` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_vehiculos`()
SALIR:BEGIN
	SELECT *
	FROM vehiculos;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `listar_vehiculos_por_tipo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `listar_vehiculos_por_tipo`(ptipo VARCHAR(60))
BEGIN
SELECT idInterno FROM vehiculos
WHERE tipo =ptipo;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `modificar_conductor` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_conductor`(ppersona_dni CHAR(8),plicencia varchar(45),
svencimiento varchar(20),pestado CHAR, pcnrt_ppersonal char(1),pcnrt_peligroso char(1),pcnrt_gral char(1),
scnrt_vencimiento varchar(20),pescribania char(1),pcategoria varchar(10))
SALIR:BEGIN
DECLARE mensaje VARCHAR(45);
DECLARE pcnrt_vencimiento DATE;
DECLARE pvencimiento DATE;
SET pvencimiento=STR_TO_DATE(svencimiento,'%d-%m-%Y');
SET pcnrt_vencimiento=STR_TO_DATE(scnrt_vencimiento,'%d-%m-%Y');

	IF(ppersona_dni IS NULL OR pdni="") THEN
		SET mensaje= 'El dni no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(pestado IS NULL) THEN
		SET mensaje= 'El estado no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(plincencia IS NULL OR plicencia="") THEN
		SET mensaje= 'La licencia no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(ptipo IS NULL OR ptipo="") THEN
		SET mensaje= 'El tipo no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(pvencimiento IS NULL) THEN
		SET mensaje= 'Fecha de vencimiento no valida';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;

	-- UPDATE conductores SET persona_dni=ppersona_dni,estado=pestado,licencia=plicencia,vencimiento=pvencimiento,
	-- categoria=pcategoria,cnrt_personal=pcnrt_personal,cnrt_gral=pcnrt_gral,cnrt_peligroso=pcnrt_peligroso,
	-- cnrt_vencimiento=pcnrt_vencimiento,escribania=pescribania,categoria=pcategoria
	-- WHERE persona_dni=ppersona_dni;
	SET mensaje='OK';
	SELECT mensaje;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `modificar_parte` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_parte`(pidpartes INT,ppartes_idpartes INT,pvehiculo_numero SMALLINT, pnombre VARCHAR(45),ptipo VARCHAR(45),pkmInicial VARCHAR(45),
pkmFinal VARCHAR(45),pfechaInicial DATE,pfechaProxima DATE, pproveedor VARCHAR(45), pdescripcion TEXT, pespecificaciones TEXT)
SALIR:BEGIN

UPDATE partes SET partes_idpartes=ppartes_idpartes ,vehiculos_numero=pvehiculo_numero,nombre=pnombre,tipo=ptipo ,kmInicial=pkmInicial,
kmFinal=pkmFinal ,fechaInicial=pfechaInicial,fechaProxima=pfechaProxima,proveedor=pproveedor,descripcion=pdescripcion,especificaciones=pespecificaciones
WHERE idpartes=pidpartes;
SELECT 'OK';

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `modificar_persona` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_persona`(pdni CHAR(8),pnombre varchar(45), papellido varchar(45), pmail varchar(50),
 ptelefono varchar(45), pfoto BLOB,pfechanac DATE,ptipo CHAR(1))
SALIR:BEGIN
DECLARE mensaje VARCHAR(45);
	IF(pdni IS NULL OR pdni="") THEN
		SET mensaje= 'El dni no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(pnombre IS NULL OR pnombre="") THEN
		SET mensaje= 'El nombre no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(ptipo IS NULL) THEN
		SET mensaje= 'El tipo no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(ptipo!='E')THEN
		IF(papellido IS NULL OR papellido="") THEN
			SET mensaje= 'El apellido no puede ser nulo';
			SELECT mensaje;
			LEAVE SALIR;
		END IF;
	END IF;
	IF(pmail IS NULL OR pmail="") THEN
		SET mensaje= 'El mail no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(ptelefono IS NULL OR ptelefono="") THEN
		SET mensaje= 'El telefono no puede ser nulo';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	

	UPDATE personas SET dni=pdni,nombre=pnombre,apellido=papellido,mail=pmail,
	telefono=ptelefono,foto=pfoto,fecha_nacimiento=pfechanac,tipo=ptipo
	WHERE dni=pdni;

	SET mensaje='OK';
	SELECT mensaje;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `modificar_vehiculo` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `modificar_vehiculo`(pnumero smallint,pmarca varchar(45),pmodelo varchar(45),ppatente varchar(45),
pkm char(6),pcombustible varchar(20),pestado varchar (45),pfoto longblob, paño CHAR(4),ppeso char(10),
ptipo varchar(45),pcilindrada char(4),pdescripcion text,pchasis varchar(45),pmotor varchar(45))
SALIR:BEGIN
DECLARE mensaje varchar(45);

	
	IF(pnumero IS NULL)THEN
		SET mensaje='El numero es obligatorio';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	
	IF(pmarca IS NULL OR pmarca='')THEN
		SET mensaje='La marca es obligatoria';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(pmodelo IS NULL OR pmodelo='')THEN
		SET mensaje='El modelo es obligatorio';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(ppatente IS NULL OR ppatente='')THEN
		SET mensaje='La patente es obligatoria';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(pkm IS NULL OR pkm='')THEN
		SET mensaje='El kilometraje es obligatorio';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(pcombustible IS NULL OR pcombustible='')THEN
		SET mensaje='El combustible es obligatorio';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(pestado IS NULL OR pestado='')THEN
		SET mensaje='El estado es obligatorio';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(ptipo IS NULL OR ptipo='')THEN
		SET mensaje='El tipo es obligatorio';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	
		IF(paño IS NULL)THEN
		SET mensaje='El año es obligatorio';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(ppeso IS NULL)THEN
		SET mensaje='La carga maxima es obligatorio';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;
	IF(pcilindrada IS NULL)THEN
		SET mensaje='La cilindrada es obligatorio';
		SELECT mensaje;
		LEAVE SALIR;
	END IF;

	UPDATE vehiculos SET marca=pmarca,modelo=pmodelo,patente=ppatente,kilometros=pkm,
	combustible=pcombustible,estado=pestado,foto=pfoto,año=paño,peso_max=ppeso,
	tipo=ptipo,cilindrada=pcilindrada,descripcion=pdescripcion,numero_de_chasis=pchasis,motor=pmotor
	WHERE numero=pnumero;

	SET mensaje='OK';
	SELECT mensaje;


END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `poblar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `poblar`()
SALIR:BEGIN
DECLARE i INT DEFAULT 20;

  WHILE i > 0 DO
    
call alta_partes(0,null,i,'Sistema eléctrico','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Tren delantero','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Tren trasero','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Carrocería y chasis','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Motor','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Sistema de dirección','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Sistema de transmisión','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Interior','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Caja de cambios','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Sistema de frenos','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Sistema de refrigeración','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Sistema de iluminación',null,null,null,null,null,null);

SET i = i - 1;
  END WHILE;
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_poblar` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_poblar`()
BEGIN
DECLARE i INT DEFAULT 20;

  WHILE i > 0 DO
    
call alta_partes(0,null,i,'Sistema eléctrico','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Tren delantero','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Tren trasero','Parte',null,null,null,null,null,null);


call alta_partes(0,null,i,'Carrocería y chasis','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Motor','Parte',null,null,null,null,null,null);


call alta_partes(0,null,i,'Sistema de dirección','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Sistema de transmisión','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Interior','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Caja de cambios','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Sistema de frenos','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Sistema de refrigeración','Parte',null,null,null,null,null,null);

call alta_partes(0,null,i,'Sistema de iluminación','Parte',null,null,null,null,null,null);


SET i = i - 1;
  END WHILE;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `sp_prueba` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_prueba`(sfecha_inicio varchar(45))
SALIR:BEGIN
DECLARE mensaje varchar(45);
DECLARE pfecha_inicio DATETIME;
DECLARE pfecha_fin DATETIME;

SET pfecha_fin=DATE(STR_TO_DATE(sfecha_inicio,'%Y-%m-%d %H.%i'));
SELECT pfecha_fin;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 DROP PROCEDURE IF EXISTS `update_km` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` PROCEDURE `update_km`(pidvehiculo VARCHAR(45),pkm VARCHAR(20))
BEGIN
DECLARE mensaje VARCHAR(45);
UPDATE vehiculos SET kilometros=pkm
WHERE idInterno=pidvehiculo;
SET mensaje='OK';
SELECT mensaje;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-12-22 10:36:42
