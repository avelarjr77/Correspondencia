-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: baseprueba
-- ------------------------------------------------------
-- Server version	8.0.21

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `co_menu`
--

DROP TABLE IF EXISTS `co_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `co_menu` (
  `menuId` int NOT NULL AUTO_INCREMENT,
  `nombreMenu` varchar(45) DEFAULT NULL,
  `iconoId` int NOT NULL,
  `identificador` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`menuId`),
  KEY `iconoId _idx` (`iconoId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_menu`
--

LOCK TABLES `co_menu` WRITE;
/*!40000 ALTER TABLE `co_menu` DISABLE KEYS */;
INSERT INTO `co_menu` VALUES (1,'Inicio',30,'IN'),(2,'Administración ',28,'AD'),(3,'Configuración de Usuarios',4,'CU'),(12,'Informes',6,NULL);
/*!40000 ALTER TABLE `co_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_modulo`
--

DROP TABLE IF EXISTS `co_modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `co_modulo` (
  `moduloId` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`moduloId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_modulo`
--

LOCK TABLES `co_modulo` WRITE;
/*!40000 ALTER TABLE `co_modulo` DISABLE KEYS */;
INSERT INTO `co_modulo` VALUES (1,'Flujos'),(2,'Configuración');
/*!40000 ALTER TABLE `co_modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_modulo_menu`
--

DROP TABLE IF EXISTS `co_modulo_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `co_modulo_menu` (
  `moduloMenuId` int NOT NULL AUTO_INCREMENT,
  `moduloId` int NOT NULL,
  `menuId` int NOT NULL,
  PRIMARY KEY (`moduloMenuId`),
  KEY `FK_MODULO_MENU_MODULO_idx` (`moduloId`),
  KEY `FK_MODULO_MENU_MENU_idx` (`menuId`),
  CONSTRAINT `FK_MODULO_MENU_MENU` FOREIGN KEY (`menuId`) REFERENCES `co_menu` (`menuId`),
  CONSTRAINT `FK_MODULO_MENU_MODULO` FOREIGN KEY (`moduloId`) REFERENCES `co_modulo` (`moduloId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_modulo_menu`
--

LOCK TABLES `co_modulo_menu` WRITE;
/*!40000 ALTER TABLE `co_modulo_menu` DISABLE KEYS */;
INSERT INTO `co_modulo_menu` VALUES (1,2,2),(2,1,1),(4,2,3),(6,2,1);
/*!40000 ALTER TABLE `co_modulo_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_rol_modulo_menu`
--

DROP TABLE IF EXISTS `co_rol_modulo_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `co_rol_modulo_menu` (
  `rolModuloMenuId` int NOT NULL AUTO_INCREMENT,
  `rolId` int NOT NULL,
  `moduloMenuId` int NOT NULL,
  PRIMARY KEY (`rolModuloMenuId`),
  KEY `FK_ROL_MODULO_MENU_MODULO_MENU_idx` (`moduloMenuId`),
  KEY `FK_ROL_MODULO_MENU_ROL_idx` (`rolId`),
  CONSTRAINT `FK_ROL_MODULO_MENU_MODULO_MENU` FOREIGN KEY (`moduloMenuId`) REFERENCES `co_modulo_menu` (`moduloMenuId`),
  CONSTRAINT `FK_ROL_MODULO_MENU_ROL` FOREIGN KEY (`rolId`) REFERENCES `wk_rol` (`rolId`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_rol_modulo_menu`
--

LOCK TABLES `co_rol_modulo_menu` WRITE;
/*!40000 ALTER TABLE `co_rol_modulo_menu` DISABLE KEYS */;
INSERT INTO `co_rol_modulo_menu` VALUES (1,2,1);
/*!40000 ALTER TABLE `co_rol_modulo_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_submenu`
--

DROP TABLE IF EXISTS `co_submenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `co_submenu` (
  `subMenuId` int NOT NULL AUTO_INCREMENT,
  `nombreSubMenu` varchar(45) DEFAULT NULL,
  `menuId` int NOT NULL,
  `nombreArchivo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`subMenuId`),
  KEY `FK_SUBMENU_MENU_idx` (`menuId`),
  CONSTRAINT `FK_SUBMENU_MENU` FOREIGN KEY (`menuId`) REFERENCES `co_menu` (`menuId`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_submenu`
--

LOCK TABLES `co_submenu` WRITE;
/*!40000 ALTER TABLE `co_submenu` DISABLE KEYS */;
INSERT INTO `co_submenu` VALUES (1,'Inicio',1,'Home'),(2,'Admin. Roles',2,'adminRol'),(3,'Admin. Rol-Módulo-Menú ',2,'rolModMenu'),(7,'Admin. Menú',2,'menu_submenu'),(8,'Admin. Menú Detalle',2,'submenus'),(9,'Usuarios',3,'usuario'),(10,'Persona',3,'persona'),(13,'Informe Mensual',12,'/modAdministracion/informe');
/*!40000 ALTER TABLE `co_submenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_actividad`
--

DROP TABLE IF EXISTS `wk_actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_actividad` (
  `actividadId` int NOT NULL AUTO_INCREMENT,
  `nombreActividad` varchar(75) DEFAULT NULL,
  `descripcion` text,
  `etapaId` int DEFAULT NULL,
  `personaId` int NOT NULL,
  PRIMARY KEY (`actividadId`),
  KEY `FK_ACTIVIDAD_ETAPA_idx` (`etapaId`),
  KEY `FK_ACTIVIDAD_PERSONA_idx` (`personaId`),
  CONSTRAINT `FK_ACTIVIDAD_ETAPA` FOREIGN KEY (`etapaId`) REFERENCES `wk_etapa` (`etapaId`),
  CONSTRAINT `FK_ACTIVIDAD_PERSONA` FOREIGN KEY (`personaId`) REFERENCES `wk_persona` (`personaId`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_actividad`
--

LOCK TABLES `wk_actividad` WRITE;
/*!40000 ALTER TABLE `wk_actividad` DISABLE KEYS */;
INSERT INTO `wk_actividad` VALUES (3,'Envio de documento','enviar documento completo a MINED',2,1),(4,'Responder correo electronico','Correo electrónico de MINED ',2,1),(7,'Comprobar paquete de expedientes','Corroborar que el paquete de expedientes este completo',7,3),(8,'Recibir observaciones','Revisar correo electrónico para obtener correcciones',7,3),(12,'Descargar solicitud','Descargar solicitud del correo electronico',18,2),(13,'actividad 1','gfrt',26,1),(14,'iiiii','pjffffffffffffffffffffffffff',26,1),(15,'httt','eyyff',25,2),(16,'dgdgdg','qqq',49,3),(17,'errrr','aaaa',49,1),(18,'actividad','10',49,2),(19,'actividad3','55',49,3),(20,'gggg','222',65,2),(21,'actividad1','548848',64,2),(22,'actividad2','hdgdg',64,2),(23,'actividad','dydt',62,3),(24,'dhdtdtdf','dhdhd',68,2),(25,'dddd','www',68,1),(26,'Hast','hbdgd',69,1),(29,'ssysys','hdhd',69,1),(30,'wrwr','11',69,2),(32,'act1','Desc',68,1),(33,'act2','desc2',68,3);
/*!40000 ALTER TABLE `wk_actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_bitacora`
--

DROP TABLE IF EXISTS `wk_bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_bitacora` (
  `bitacoraId` int unsigned NOT NULL AUTO_INCREMENT,
  `usuarioId` int NOT NULL,
  `accion` varchar(1) DEFAULT NULL,
  `descripcion` varchar(100) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  PRIMARY KEY (`bitacoraId`),
  KEY `FK_BITACORA_USUARIO_idx` (`usuarioId`),
  CONSTRAINT `FK_BITACORA_USUARIO` FOREIGN KEY (`usuarioId`) REFERENCES `wk_usuario` (`usuarioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_bitacora`
--

LOCK TABLES `wk_bitacora` WRITE;
/*!40000 ALTER TABLE `wk_bitacora` DISABLE KEYS */;
/*!40000 ALTER TABLE `wk_bitacora` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_cargo`
--

DROP TABLE IF EXISTS `wk_cargo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_cargo` (
  `cargoId` int NOT NULL AUTO_INCREMENT,
  `cargo` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`cargoId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_cargo`
--

LOCK TABLES `wk_cargo` WRITE;
/*!40000 ALTER TABLE `wk_cargo` DISABLE KEYS */;
INSERT INTO `wk_cargo` VALUES (1,'Docente'),(2,'Rector'),(4,'Administrador');
/*!40000 ALTER TABLE `wk_cargo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_contacto`
--

DROP TABLE IF EXISTS `wk_contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_contacto` (
  `contactoId` int NOT NULL AUTO_INCREMENT,
  `personaId` int NOT NULL,
  `tipoContactoId` int NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `estado` varchar(15) NOT NULL,
  PRIMARY KEY (`contactoId`),
  KEY `FK_CONTACTO_PERSONA_idx` (`personaId`),
  KEY `FK_CONTACTO_TIPO_CONTACTO_idx` (`tipoContactoId`),
  CONSTRAINT `FK_CONTACTO_PERSONA` FOREIGN KEY (`personaId`) REFERENCES `wk_persona` (`personaId`),
  CONSTRAINT `FK_CONTACTO_TIPO_CONTACTO` FOREIGN KEY (`tipoContactoId`) REFERENCES `wk_tipo_contacto` (`tipoContactoId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_contacto`
--

LOCK TABLES `wk_contacto` WRITE;
/*!40000 ALTER TABLE `wk_contacto` DISABLE KEYS */;
INSERT INTO `wk_contacto` VALUES (1,1,1,'kattan@gmail.com','Activo');
/*!40000 ALTER TABLE `wk_contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_departamento`
--

DROP TABLE IF EXISTS `wk_departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_departamento` (
  `departamentoId` int NOT NULL AUTO_INCREMENT,
  `departamento` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`departamentoId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_departamento`
--

LOCK TABLES `wk_departamento` WRITE;
/*!40000 ALTER TABLE `wk_departamento` DISABLE KEYS */;
INSERT INTO `wk_departamento` VALUES (1,'Administración académica');
/*!40000 ALTER TABLE `wk_departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_depto`
--

DROP TABLE IF EXISTS `wk_depto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_depto` (
  `deptoId` int NOT NULL AUTO_INCREMENT,
  `paisId` int NOT NULL,
  `nombreDepto` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`deptoId`),
  KEY `FK_DEPTO_PAIS_idx` (`paisId`),
  CONSTRAINT `FK_DEPTO_PAIS` FOREIGN KEY (`paisId`) REFERENCES `wk_pais` (`paisId`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_depto`
--

LOCK TABLES `wk_depto` WRITE;
/*!40000 ALTER TABLE `wk_depto` DISABLE KEYS */;
INSERT INTO `wk_depto` VALUES (1,68,' Ahuachapán '),(2,68,' Santa Ana '),(3,68,' Sonsonate '),(4,68,' La Libertad '),(5,68,' Chalatenango '),(6,68,' San Salvador '),(7,68,' Cuscatlán '),(8,68,' La Paz '),(9,68,' Cabañas '),(10,68,' San Vicente '),(11,68,' Usulután '),(12,68,' Morazán '),(13,68,' San Miguel '),(14,68,' La Unión ');
/*!40000 ALTER TABLE `wk_depto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_direccion`
--

DROP TABLE IF EXISTS `wk_direccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_direccion` (
  `direccionId` int NOT NULL AUTO_INCREMENT,
  `personaId` int NOT NULL,
  `tipoDireccion` varchar(1) DEFAULT NULL COMMENT 'P=Principal, S=Secundaria',
  `nombreDireccion` varchar(150) DEFAULT NULL,
  `municipioId` int NOT NULL,
  PRIMARY KEY (`direccionId`),
  KEY `FK_DIRECCION_PERSONA_idx` (`personaId`),
  KEY `FK_DIRECCION_MUNICIPIO_idx` (`municipioId`),
  CONSTRAINT `FK_DIRECCION_MUNICIPIO` FOREIGN KEY (`municipioId`) REFERENCES `wk_municipio` (`municipioId`),
  CONSTRAINT `FK_DIRECCION_PERSONA` FOREIGN KEY (`personaId`) REFERENCES `wk_persona` (`personaId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_direccion`
--

LOCK TABLES `wk_direccion` WRITE;
/*!40000 ALTER TABLE `wk_direccion` DISABLE KEYS */;
INSERT INTO `wk_direccion` VALUES (1,1,'P','Col. Santa Lucia',15),(3,3,'P','Santa Ana',17);
/*!40000 ALTER TABLE `wk_direccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_documento`
--

DROP TABLE IF EXISTS `wk_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_documento` (
  `documentoId` int NOT NULL AUTO_INCREMENT,
  `nombreDocumento` varchar(75) DEFAULT NULL,
  `documento` varchar(45) DEFAULT NULL,
  `tipoDocumentoId` int NOT NULL,
  `tipoEnvioId` int NOT NULL,
  `transaccionActividadId` int NOT NULL,
  PRIMARY KEY (`documentoId`),
  KEY `FK_DOCUMENTO_TIPO_DOCUMENTO_idx` (`tipoDocumentoId`),
  KEY `FK_DOCUMENTO_TIPO_ENVIO_idx` (`tipoEnvioId`),
  KEY `FK_TRAACT_DOCUMENTO_idx` (`transaccionActividadId`),
  CONSTRAINT `FK_DOCUMENTO_TIPO_DOCUMENTO` FOREIGN KEY (`tipoDocumentoId`) REFERENCES `wk_tipo_documento` (`tipoDocumentoId`),
  CONSTRAINT `FK_DOCUMENTO_TIPO_ENVIO` FOREIGN KEY (`tipoEnvioId`) REFERENCES `wk_tipo_envio` (`tipoEnvioId`),
  CONSTRAINT `FK_TRAACT_DOCUMENTO` FOREIGN KEY (`transaccionActividadId`) REFERENCES `wk_transaccion_actividades` (`transaccionActividadId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_documento`
--

LOCK TABLES `wk_documento` WRITE;
/*!40000 ALTER TABLE `wk_documento` DISABLE KEYS */;
/*!40000 ALTER TABLE `wk_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_etapa`
--

DROP TABLE IF EXISTS `wk_etapa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_etapa` (
  `etapaId` int NOT NULL AUTO_INCREMENT,
  `nombreEtapa` varchar(75) DEFAULT NULL,
  `orden` int DEFAULT NULL,
  `procesoId` int DEFAULT NULL,
  PRIMARY KEY (`etapaId`),
  KEY `FK_PROCESO_ETAPA_idx` (`procesoId`),
  CONSTRAINT `FK_PROCESO_ETAPA` FOREIGN KEY (`procesoId`) REFERENCES `wk_proceso` (`procesoId`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_etapa`
--

LOCK TABLES `wk_etapa` WRITE;
/*!40000 ALTER TABLE `wk_etapa` DISABLE KEYS */;
INSERT INTO `wk_etapa` VALUES (2,'Envío de notificación a MINED ',1,1),(7,'Envío de paquete de expediente',1,4),(18,'Recepción de solicitud',1,3),(19,'Envio de documento Solicitado',2,3),(20,'prueba1',1,5),(21,'prueba 2',2,5),(22,'prueba3',3,5),(23,'prueba 4',4,5),(24,'prueba5',5,5),(25,'ejem 1',2,6),(26,'ejem 2',1,6),(49,'etapa3',13,7),(52,'etap3',3,3),(53,'etapa4',4,3),(54,'etapa5',5,3),(55,'prueba6',6,5),(59,'Etapa1',1,9),(62,'etapa1',2,10),(63,'etapa2',1,10),(64,'etapa3',4,10),(65,'etapa4',3,10),(66,'Prueba5',3,7),(67,'etapa1',10,8),(68,'etapa2',5,8),(69,'sss',10,10);
/*!40000 ALTER TABLE `wk_etapa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_icono`
--

DROP TABLE IF EXISTS `wk_icono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_icono` (
  `iconoId` int NOT NULL AUTO_INCREMENT,
  `nombreIcono` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iconoId`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_icono`
--

LOCK TABLES `wk_icono` WRITE;
/*!40000 ALTER TABLE `wk_icono` DISABLE KEYS */;
INSERT INTO `wk_icono` VALUES (1,'fa fa-address-book'),(2,'fa fa-address-card'),(3,'fa fa-adjust'),(4,'fa fa-angellist'),(5,'fa fa-archive'),(6,'fa fa-area-chart'),(7,'fa fa-bar-chart'),(8,'fa fa-bars'),(9,'fa fa-book'),(10,'fa fa-bookmark'),(11,'fa fa-building-o'),(12,'fa fa-calculator'),(13,'fa fa-calendar'),(14,'fa fa-check'),(15,'fa fa-comment-o'),(16,'fa fa-desktop'),(17,'fa fa-envelope'),(18,'fa fa-envelope-o'),(19,'fa fa-folder'),(20,'fa fa-folder-o'),(21,'fa fa-folder-open'),(22,'fa fa-folder-open-o'),(23,'fa fa-group'),(24,'fa fa-inbox'),(25,'fa fa-lock'),(26,'fa fa-mortar-board'),(27,'fa fa-pencil'),(28,'fa fa-pencil-square-o'),(29,'fa fa-plus'),(30,'fa fa-home');
/*!40000 ALTER TABLE `wk_icono` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_institucion`
--

DROP TABLE IF EXISTS `wk_institucion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_institucion` (
  `institucionId` int NOT NULL AUTO_INCREMENT,
  `nombreInstitucion` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`institucionId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_institucion`
--

LOCK TABLES `wk_institucion` WRITE;
/*!40000 ALTER TABLE `wk_institucion` DISABLE KEYS */;
INSERT INTO `wk_institucion` VALUES (1,'UCAD'),(2,'MINED');
/*!40000 ALTER TABLE `wk_institucion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_municipio`
--

DROP TABLE IF EXISTS `wk_municipio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_municipio` (
  `municipioId` int NOT NULL AUTO_INCREMENT,
  `deptoId` int NOT NULL,
  `nombreMunicipio` varchar(75) DEFAULT NULL,
  PRIMARY KEY (`municipioId`),
  KEY `FK_MUNICIPIO_DEPTO_idx` (`deptoId`),
  CONSTRAINT `FK_MUNICIPIO_DEPTO` FOREIGN KEY (`deptoId`) REFERENCES `wk_depto` (`deptoId`)
) ENGINE=InnoDB AUTO_INCREMENT=263 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_municipio`
--

LOCK TABLES `wk_municipio` WRITE;
/*!40000 ALTER TABLE `wk_municipio` DISABLE KEYS */;
INSERT INTO `wk_municipio` VALUES (1,1,'Ahuachapán'),(2,1,'Jujutla'),(3,1,'Atiquizaya'),(4,1,'Concepción de Ataco'),(5,1,'El Refugio'),(6,1,'Guaymango'),(7,1,'Apaneca'),(8,1,'San Francisco Menéndez'),(9,1,'San Lorenzo'),(10,1,'San Pedro Puxtla'),(11,1,'Tacuba'),(12,1,'Turín'),(13,2,'Candelaria de la Frontera'),(14,2,'Chalchuapa'),(15,2,'Coatepeque'),(16,2,'El Congo'),(17,2,'El Porvenir'),(18,2,'Masahuat'),(19,2,'Metapán'),(20,2,'San Antonio Pajonal'),(21,2,'San Sebastián Salitrillo'),(22,2,'Santa Ana'),(23,2,'Santa Rosa Guachipilín'),(24,2,'Santiago de la Frontera'),(25,2,'Texistepeque'),(26,3,'Acajutla'),(27,3,'Armenia'),(28,3,'Caluco'),(29,3,'Cuisnahuat'),(30,3,'Izalco'),(31,3,'Juayúa'),(32,3,'Nahuizalco'),(33,3,'Nahulingo'),(34,3,'Salcoatitán'),(35,3,'San Antonio del Monte'),(36,3,'San Julián'),(37,3,'Santa Catarina Masahuat'),(38,3,'Santa Isabel Ishuatán'),(39,3,'Santo Domingo de Guzmán'),(40,3,'Sonsonate'),(41,3,'Sonzacate'),(42,11,'Alegría'),(43,11,'Berlín'),(44,11,'California'),(45,11,'Concepción Batres'),(46,11,'El Triunfo'),(47,11,'Ereguayquín'),(48,11,'Estanzuelas'),(49,11,'Jiquilisco'),(50,11,'Jucuapa'),(51,11,'Jucuarán'),(52,11,'Mercedes Umaña'),(53,11,'Nueva Granada'),(54,11,'Ozatlán'),(55,11,'Puerto El Triunfo'),(56,11,'San Agustín'),(57,11,'San Buenaventura'),(58,11,'San Dionisio'),(59,11,'San Francisco Javier'),(60,11,'Santa Elena'),(61,11,'Santa María'),(62,11,'Santiago de María'),(63,11,'Tecapán'),(64,11,'Usulután'),(65,13,'Carolina'),(66,13,'Chapeltique'),(67,13,'Chinameca'),(68,13,'Chirilagua'),(69,13,'Ciudad Barrios'),(70,13,'Comacarán'),(71,13,'El Tránsito'),(72,13,'Lolotique'),(73,13,'Moncagua'),(74,13,'Nueva Guadalupe'),(75,13,'Nuevo Edén de San Juan'),(76,13,'Quelepa'),(77,13,'San Antonio del Mosco'),(78,13,'San Gerardo'),(79,13,'San Jorge'),(80,13,'San Luis de la Reina'),(81,13,'San Miguel'),(82,13,'San Rafael Oriente'),(83,13,'Sesori'),(84,13,'Uluazapa'),(85,12,'Arambala'),(86,12,'Cacaopera'),(87,12,'Chilanga'),(88,12,'Corinto'),(89,12,'Delicias de Concepción'),(90,12,'El Divisadero'),(91,12,'El Rosario (Morazán)'),(92,12,'Gualococti'),(93,12,'Guatajiagua'),(94,12,'Joateca'),(95,12,'Jocoaitique'),(96,12,'Jocoro'),(97,12,'Lolotiquillo'),(98,12,'Meanguera'),(99,12,'Osicala'),(100,12,'Perquín'),(101,12,'San Carlos'),(102,12,'San Fernando (Morazán)'),(103,12,'San Francisco Gotera'),(104,12,'San Isidro (Morazán)'),(105,12,'San Simón'),(106,12,'Sensembra'),(107,12,'Sociedad'),(108,12,'Torola'),(109,12,'Yamabal'),(110,12,'Yoloaiquín'),(111,14,'La Unión'),(112,14,'San Alejo'),(113,14,'Yucuaiquín'),(114,14,'Conchagua'),(115,14,'Intipucá'),(116,14,'San José'),(117,14,'El Carmen (La Unión)'),(118,14,'Yayantique'),(119,14,'Bolívar'),(120,14,'Meanguera del Golfo'),(121,14,'Santa Rosa de Lima'),(122,14,'Pasaquina'),(123,14,'Anamoros'),(124,14,'Nueva Esparta'),(125,14,'El Sauce'),(126,14,'Concepción de Oriente'),(127,14,'Polorós'),(128,14,'Lislique'),(129,4,'Antiguo Cuscatlán'),(130,4,'Chiltiupán'),(131,4,'Ciudad Arce'),(132,4,'Colón'),(133,4,'Comasagua'),(134,4,'Huizúcar'),(135,4,'Jayaque'),(136,4,'Jicalapa'),(137,4,'La Libertad'),(138,4,'Santa Tecla'),(139,4,'Nuevo Cuscatlán'),(140,4,'San Juan Opico'),(141,4,'Quezaltepeque'),(142,4,'Sacacoyo'),(143,4,'San José Villanueva'),(144,4,'San Matías'),(145,4,'San Pablo Tacachico'),(146,4,'Talnique'),(147,4,'Tamanique'),(148,4,'Teotepeque'),(149,4,'Tepecoyo'),(150,4,'Zaragoza'),(151,5,'Agua Caliente'),(152,5,'Arcatao'),(153,5,'Azacualpa'),(154,5,'Cancasque'),(155,5,'Chalatenango'),(156,5,'Citalá'),(157,5,'Comapala'),(158,5,'Concepción Quezaltepeque'),(159,5,'Dulce Nombre de María'),(160,5,'El Carrizal'),(161,5,'El Paraíso'),(162,5,'La Laguna'),(163,5,'La Palma'),(164,5,'La Reina'),(165,5,'Las Vueltas'),(166,5,'Nueva Concepción'),(167,5,'Nueva Trinidad'),(168,5,'Nombre de Jesús'),(169,5,'Ojos de Agua'),(170,5,'Potonico'),(171,5,'San Antonio de la Cruz'),(172,5,'San Antonio Los Ranchos'),(173,5,'San Fernando (Chalatenango)'),(174,5,'San Francisco Lempa'),(175,5,'San Francisco Morazán'),(176,5,'San Ignacio'),(177,5,'San Isidro Labrador'),(178,5,'Las Flores'),(179,5,'San Luis del Carmen'),(180,5,'San Miguel de Mercedes'),(181,5,'San Rafael'),(182,5,'Santa Rita'),(183,5,'Tejutla'),(184,7,'Cojutepeque'),(185,7,'Candelaria'),(186,7,'El Carmen (Cuscatlán)'),(187,7,'El Rosario (Cuscatlán)'),(188,7,'Monte San Juan'),(189,7,'Oratorio de Concepción'),(190,7,'San Bartolomé Perulapía'),(191,7,'San Cristóbal'),(192,7,'San José Guayabal'),(193,7,'San Pedro Perulapán'),(194,7,'San Rafael Cedros'),(195,7,'San Ramón'),(196,7,'Santa Cruz Analquito'),(197,7,'Santa Cruz Michapa'),(198,7,'Suchitoto'),(199,7,'Tenancingo'),(200,6,'Aguilares'),(201,6,'Apopa'),(202,6,'Ayutuxtepeque'),(203,6,'Cuscatancingo'),(204,6,'Ciudad Delgado'),(205,6,'El Paisnal'),(206,6,'Guazapa'),(207,6,'Ilopango'),(208,6,'Mejicanos'),(209,6,'Nejapa'),(210,6,'Panchimalco'),(211,6,'Rosario de Mora'),(212,6,'San Marcos'),(213,6,'San Martín'),(214,6,'San Salvador'),(215,6,'Santiago Texacuangos'),(216,6,'Santo Tomás'),(217,6,'Soyapango'),(218,6,'Tonacatepeque'),(219,8,'Zacatecoluca'),(220,8,'Cuyultitán'),(221,8,'El Rosario (La Paz)'),(222,8,'Jerusalén'),(223,8,'Mercedes La Ceiba'),(224,8,'Olocuilta'),(225,8,'Paraíso de Osorio'),(226,8,'San Antonio Masahuat'),(227,8,'San Emigdio'),(228,8,'San Francisco Chinameca'),(229,8,'San Pedro Masahuat'),(230,8,'San Juan Nonualco'),(231,8,'San Juan Talpa'),(232,8,'San Juan Tepezontes'),(233,8,'San Luis La Herradura'),(234,8,'San Luis Talpa'),(235,8,'San Miguel Tepezontes'),(236,8,'San Pedro Nonualco'),(237,8,'San Rafael Obrajuelo'),(238,8,'Santa María Ostuma'),(239,8,'Santiago Nonualco'),(240,8,'Tapalhuaca'),(241,9,'Cinquera'),(242,9,'Dolores'),(243,9,'Guacotecti'),(244,9,'Ilobasco'),(245,9,'Jutiapa'),(246,9,'San Isidro (Cabañas)'),(247,9,'Sensuntepeque'),(248,9,'Tejutepeque'),(249,9,'Victoria'),(250,10,'Apastepeque'),(251,10,'Guadalupe'),(252,10,'San Cayetano Istepeque'),(253,10,'San Esteban Catarina'),(254,10,'San Ildefonso'),(255,10,'San Lorenzo'),(256,10,'San Sebastián'),(257,10,'San Vicente'),(258,10,'Santa Clara'),(259,10,'Santo Domingo'),(260,10,'Tecoluca'),(261,10,'Tepetitán'),(262,10,'Verapaz');
/*!40000 ALTER TABLE `wk_municipio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_pais`
--

DROP TABLE IF EXISTS `wk_pais`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_pais` (
  `paisId` int NOT NULL AUTO_INCREMENT,
  `nombrePais` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`paisId`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_pais`
--

LOCK TABLES `wk_pais` WRITE;
/*!40000 ALTER TABLE `wk_pais` DISABLE KEYS */;
INSERT INTO `wk_pais` VALUES (1,'Afganistán'),(2,'Islas Gland'),(3,'Albania'),(4,'Alemania'),(5,'Andorra'),(6,'Angola'),(7,'Anguilla'),(8,'Antártida'),(9,'Antigua y Barbuda'),(10,'Antillas Holandesas'),(11,'Arabia Saudí'),(12,'Argelia'),(13,'Argentina'),(14,'Armenia'),(15,'Aruba'),(16,'Australia'),(17,'Austria'),(18,'Azerbaiyán'),(19,'Bahamas'),(20,'Bahréin'),(21,'Bangladesh'),(22,'Barbados'),(23,'Bielorrusia'),(24,'Bélgica'),(25,'Belice'),(26,'Benin'),(27,'Bermudas'),(28,'Bhután'),(29,'Bolivia'),(30,'Bosnia y Herzegovina'),(31,'Botsuana'),(32,'Isla Bouvet'),(33,'Brasil'),(34,'Brunéi'),(35,'Bulgaria'),(36,'Burkina Faso'),(37,'Burundi'),(38,'Cabo Verde'),(39,'Islas Caimán'),(40,'Camboya'),(41,'Camerún'),(42,'Canadá'),(43,'República Centroafricana'),(44,'Chad'),(45,'República Checa'),(46,'Chile'),(47,'China'),(48,'Chipre'),(49,'Isla de Navidad'),(50,'Ciudad del Vaticano'),(51,'Islas Cocos'),(52,'Colombia'),(53,'Comoras'),(54,'República Democrática del Congo'),(55,'Congo'),(56,'Islas Cook'),(57,'Corea del Norte'),(58,'Corea del Sur'),(59,'Costa de Marfil'),(60,'Costa Rica'),(61,'Croacia'),(62,'Cuba'),(63,'Dinamarca'),(64,'Dominica'),(65,'República Dominicana'),(66,'Ecuador'),(67,'Egipto'),(68,'El Salvador'),(69,'Emiratos Árabes Unidos'),(70,'Eritrea'),(71,'Eslovaquia'),(72,'Eslovenia'),(73,'España'),(74,'Islas ultramarinas de Estados Unidos'),(75,'Estados Unidos'),(76,'Estonia'),(77,'Etiopía'),(78,'Islas Feroe'),(79,'Filipinas'),(80,'Finlandia'),(81,'Fiyi'),(82,'Francia'),(83,'Gabón'),(84,'Gambia'),(85,'Georgia'),(86,'Islas Georgias del Sur y Sandwich del Sur'),(87,'Ghana'),(88,'Gibraltar'),(89,'Granada'),(90,'Grecia'),(91,'Groenlandia'),(92,'Guadalupe'),(93,'Guam'),(94,'Guatemala'),(95,'Guayana Francesa'),(96,'Guinea'),(97,'Guinea Ecuatorial'),(98,'Guinea-Bissau'),(99,'Guyana'),(100,'Haití'),(101,'Islas Heard y McDonald'),(102,'Honduras'),(103,'Hong Kong'),(104,'Hungría'),(105,'India'),(106,'Indonesia'),(107,'Irán'),(108,'Iraq'),(109,'Irlanda'),(110,'Islandia'),(111,'Israel'),(112,'Italia'),(113,'Jamaica'),(114,'Japón'),(115,'Jordania'),(116,'Kazajstán'),(117,'Kenia'),(118,'Kirguistán'),(119,'Kiribati'),(120,'Kuwait'),(121,'Laos'),(122,'Lesotho'),(123,'Letonia'),(124,'Líbano'),(125,'Liberia'),(126,'Libia'),(127,'Liechtenstein'),(128,'Lituania'),(129,'Luxemburgo'),(130,'Macao'),(131,'ARY Macedonia'),(132,'Madagascar'),(133,'Malasia'),(134,'Malawi'),(135,'Maldivas'),(136,'Malí'),(137,'Malta'),(138,'Islas Malvinas'),(139,'Islas Marianas del Norte'),(140,'Marruecos'),(141,'Islas Marshall'),(142,'Martinica'),(143,'Mauricio'),(144,'Mauritania'),(145,'Mayotte'),(146,'México'),(147,'Micronesia'),(148,'Moldavia'),(149,'Mónaco'),(150,'Mongolia'),(151,'Montserrat'),(152,'Mozambique'),(153,'Myanmar'),(154,'Namibia'),(155,'Nauru'),(156,'Nepal'),(157,'Nicaragua'),(158,'Níger'),(159,'Nigeria'),(160,'Niue'),(161,'Isla Norfolk'),(162,'Noruega'),(163,'Nueva Caledonia'),(164,'Nueva Zelanda'),(165,'Omán'),(166,'Países Bajos'),(167,'Pakistán'),(168,'Palau'),(169,'Palestina'),(170,'Panamá'),(171,'Papúa Nueva Guinea'),(172,'Paraguay'),(173,'Perú'),(174,'Islas Pitcairn'),(175,'Polinesia Francesa'),(176,'Polonia'),(177,'Portugal'),(178,'Puerto Rico'),(179,'Qatar'),(180,'Reino Unido'),(181,'Reunión'),(182,'Ruanda'),(183,'Rumania'),(184,'Rusia'),(185,'Sahara Occidental'),(186,'Islas Salomón'),(187,'Samoa'),(188,'Samoa Americana'),(189,'San Cristóbal y Nevis'),(190,'San Marino'),(191,'San Pedro y Miquelón'),(192,'San Vicente y las Granadinas'),(193,'Santa Helena'),(194,'Santa Lucía'),(195,'Santo Tomé y Príncipe'),(196,'Senegal'),(197,'Serbia y Montenegro'),(198,'Seychelles'),(199,'Sierra Leona'),(200,'Singapur'),(201,'Siria'),(202,'Somalia'),(203,'Sri Lanka'),(204,'Suazilandia'),(205,'Sudáfrica'),(206,'Sudán'),(207,'Suecia'),(208,'Suiza'),(209,'Surinam'),(210,'Svalbard y Jan Mayen'),(211,'Tailandia'),(212,'Taiwán'),(213,'Tanzania'),(214,'Tayikistán'),(215,'Territorio Británico del Océano Índico'),(216,'Territorios Australes Franceses'),(217,'Timor Oriental'),(218,'Togo'),(219,'Tokelau'),(220,'Tonga'),(221,'Trinidad y Tobago'),(222,'Túnez'),(223,'Islas Turcas y Caicos'),(224,'Turkmenistán'),(225,'Turquía'),(226,'Tuvalu'),(227,'Ucrania'),(228,'Uganda'),(229,'Uruguay'),(230,'Uzbekistán'),(231,'Vanuatu'),(232,'Venezuela'),(233,'Vietnam'),(234,'Islas Vírgenes Británicas'),(235,'Islas Vírgenes de los Estados Unidos'),(236,'Wallis y Futuna'),(237,'Yemen'),(238,'Yibuti'),(239,'Zambia'),(240,'Zimbabue');
/*!40000 ALTER TABLE `wk_pais` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_persona`
--

DROP TABLE IF EXISTS `wk_persona`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_persona` (
  `personaId` int NOT NULL AUTO_INCREMENT,
  `nombres` varchar(70) DEFAULT NULL,
  `primerApellido` varchar(45) DEFAULT NULL,
  `segundoApellido` varchar(45) DEFAULT NULL,
  `fechaNacimiento` date DEFAULT NULL,
  `genero` varchar(1) DEFAULT NULL,
  `cargoId` int NOT NULL,
  `departamentoId` int NOT NULL,
  `usuarioCrea` varchar(45) DEFAULT NULL,
  `fechaCrea` date DEFAULT NULL,
  `usuarioModifica` varchar(45) DEFAULT NULL,
  `fechaModifica` date DEFAULT NULL,
  PRIMARY KEY (`personaId`),
  KEY `FK_PERSONA_CARGO_idx` (`cargoId`),
  KEY `FK_PERSONA_DEPARTAMENTO_idx` (`departamentoId`),
  CONSTRAINT `FK_PERSONA_CARGO` FOREIGN KEY (`cargoId`) REFERENCES `wk_cargo` (`cargoId`),
  CONSTRAINT `FK_PERSONA_DEPARTAMENTO` FOREIGN KEY (`departamentoId`) REFERENCES `wk_departamento` (`departamentoId`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_persona`
--

LOCK TABLES `wk_persona` WRITE;
/*!40000 ALTER TABLE `wk_persona` DISABLE KEYS */;
INSERT INTO `wk_persona` VALUES (1,'Rebeca','Kattan','Toledo','1998-01-03','F',4,1,'rebeca','2022-04-17',NULL,NULL),(2,'Shelimber','Chinchilla','Huezo','1997-12-01','F',4,1,'rebeca','2022-04-18',NULL,NULL),(3,'Oscar','Avelar','Escobar','2022-04-12','M',1,1,'rebeca','2022-04-19',NULL,NULL);
/*!40000 ALTER TABLE `wk_persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_proceso`
--

DROP TABLE IF EXISTS `wk_proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_proceso` (
  `procesoId` int NOT NULL AUTO_INCREMENT,
  `nombreProceso` varchar(70) NOT NULL,
  `tipoProcesoId` int NOT NULL,
  PRIMARY KEY (`procesoId`),
  KEY `FK_PROCESO_TIPOPROCESO_idx` (`tipoProcesoId`),
  CONSTRAINT `FK_PROCESO_TIPOPROCESO` FOREIGN KEY (`tipoProcesoId`) REFERENCES `wk_tipo_proceso` (`tipoProcesoId`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_proceso`
--

LOCK TABLES `wk_proceso` WRITE;
/*!40000 ALTER TABLE `wk_proceso` DISABLE KEYS */;
INSERT INTO `wk_proceso` VALUES (1,'Plan de Estudio Teología 2022',1),(3,'Calificación Institucional',1),(4,'Expedientes Graduandos',1),(5,'Ministerio de economia',3),(6,'Proceso prueba',3),(7,'hh',1),(8,'Ejemplo 1',1),(9,'prueba2',1),(10,'prueba3',1);
/*!40000 ALTER TABLE `wk_proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_rol`
--

DROP TABLE IF EXISTS `wk_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_rol` (
  `rolId` int NOT NULL AUTO_INCREMENT,
  `nombreRol` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`rolId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_rol`
--

LOCK TABLES `wk_rol` WRITE;
/*!40000 ALTER TABLE `wk_rol` DISABLE KEYS */;
INSERT INTO `wk_rol` VALUES (2,'Super Administrador'),(3,'Administrador'),(9,'Usuario'),(12,'Consultores');
/*!40000 ALTER TABLE `wk_rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_tipo_contacto`
--

DROP TABLE IF EXISTS `wk_tipo_contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_tipo_contacto` (
  `tipoContactoId` int NOT NULL AUTO_INCREMENT,
  `tipoContacto` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tipoContactoId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_tipo_contacto`
--

LOCK TABLES `wk_tipo_contacto` WRITE;
/*!40000 ALTER TABLE `wk_tipo_contacto` DISABLE KEYS */;
INSERT INTO `wk_tipo_contacto` VALUES (1,'correo electronico ');
/*!40000 ALTER TABLE `wk_tipo_contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_tipo_documento`
--

DROP TABLE IF EXISTS `wk_tipo_documento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_tipo_documento` (
  `tipoDocumentoId` int NOT NULL AUTO_INCREMENT,
  `tipoDocumento` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tipoDocumentoId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_tipo_documento`
--

LOCK TABLES `wk_tipo_documento` WRITE;
/*!40000 ALTER TABLE `wk_tipo_documento` DISABLE KEYS */;
INSERT INTO `wk_tipo_documento` VALUES (1,'Notificación');
/*!40000 ALTER TABLE `wk_tipo_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_tipo_envio`
--

DROP TABLE IF EXISTS `wk_tipo_envio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_tipo_envio` (
  `tipoEnvioId` int NOT NULL AUTO_INCREMENT,
  `tipoEnvio` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`tipoEnvioId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_tipo_envio`
--

LOCK TABLES `wk_tipo_envio` WRITE;
/*!40000 ALTER TABLE `wk_tipo_envio` DISABLE KEYS */;
/*!40000 ALTER TABLE `wk_tipo_envio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_tipo_proceso`
--

DROP TABLE IF EXISTS `wk_tipo_proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_tipo_proceso` (
  `tipoProcesoId` int NOT NULL AUTO_INCREMENT,
  `tipoProceso` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tipoProcesoId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_tipo_proceso`
--

LOCK TABLES `wk_tipo_proceso` WRITE;
/*!40000 ALTER TABLE `wk_tipo_proceso` DISABLE KEYS */;
INSERT INTO `wk_tipo_proceso` VALUES (1,'Académico'),(3,'Institucional');
/*!40000 ALTER TABLE `wk_tipo_proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_transaccion`
--

DROP TABLE IF EXISTS `wk_transaccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_transaccion` (
  `transaccionId` int NOT NULL AUTO_INCREMENT,
  `procesoId` int NOT NULL,
  `personaId` int NOT NULL,
  `institucionId` int NOT NULL,
  `estadoTransaccion` varchar(1) DEFAULT NULL COMMENT 'A=Activa, F=finalizada',
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `horaInicio` time DEFAULT NULL,
  `horaFin` time DEFAULT NULL,
  `observaciones` text,
  `usuarioCrea` varchar(45) DEFAULT NULL,
  `fechaCrea` datetime DEFAULT NULL,
  `usuarioModifica` varchar(45) DEFAULT NULL,
  `fechaModifica` datetime DEFAULT NULL,
  PRIMARY KEY (`transaccionId`),
  KEY `FK_TRANSACCION_PERSONA_idx` (`personaId`),
  KEY `FK_TRANSCCION_PROCESO_idx` (`procesoId`),
  KEY `FK_TRANSACCION_INSTITUCION_idx` (`institucionId`),
  CONSTRAINT `FK_TRANSACCION_INSTITUCION` FOREIGN KEY (`institucionId`) REFERENCES `wk_institucion` (`institucionId`),
  CONSTRAINT `FK_TRANSACCION_PERSONA` FOREIGN KEY (`personaId`) REFERENCES `wk_persona` (`personaId`),
  CONSTRAINT `FK_TRANSCCION_PROCESO` FOREIGN KEY (`procesoId`) REFERENCES `wk_proceso` (`procesoId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_transaccion`
--

LOCK TABLES `wk_transaccion` WRITE;
/*!40000 ALTER TABLE `wk_transaccion` DISABLE KEYS */;
INSERT INTO `wk_transaccion` VALUES (1,1,1,1,'A','2022-05-07','2022-05-14','17:16:00','19:16:00','Ninguna',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `wk_transaccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_transaccion_actividades`
--

DROP TABLE IF EXISTS `wk_transaccion_actividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_transaccion_actividades` (
  `transaccionActividadId` int NOT NULL AUTO_INCREMENT,
  `transaccionDetalleId` int NOT NULL,
  `actividadId` int NOT NULL,
  `fechaInicio` date NOT NULL,
  `horaInicio` time NOT NULL,
  `fechaFin` date DEFAULT NULL,
  `horaFin` time DEFAULT NULL,
  `estado` int NOT NULL,
  `observaciones` text,
  PRIMARY KEY (`transaccionActividadId`),
  KEY `FK_TRANACT_TRADET_idx` (`transaccionDetalleId`),
  CONSTRAINT `FK_TRANACT_TRADET` FOREIGN KEY (`transaccionDetalleId`) REFERENCES `wk_transaccion_detalle` (`transaccionDetalleId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_transaccion_actividades`
--

LOCK TABLES `wk_transaccion_actividades` WRITE;
/*!40000 ALTER TABLE `wk_transaccion_actividades` DISABLE KEYS */;
/*!40000 ALTER TABLE `wk_transaccion_actividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_transaccion_detalle`
--

DROP TABLE IF EXISTS `wk_transaccion_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_transaccion_detalle` (
  `transaccionDetalleId` int NOT NULL AUTO_INCREMENT,
  `transaccionId` int NOT NULL,
  `etapaId` int NOT NULL,
  `fechaInicio` date NOT NULL,
  `horaInicio` time NOT NULL,
  `fechaFin` date DEFAULT NULL,
  `horaFin` time DEFAULT NULL,
  `estado` int NOT NULL,
  PRIMARY KEY (`transaccionDetalleId`),
  KEY `FK_TRANDET_TRANSACCION_idx` (`transaccionId`),
  CONSTRAINT `FK_TRANDET_TRANSACCION` FOREIGN KEY (`transaccionId`) REFERENCES `wk_transaccion` (`transaccionId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_transaccion_detalle`
--

LOCK TABLES `wk_transaccion_detalle` WRITE;
/*!40000 ALTER TABLE `wk_transaccion_detalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `wk_transaccion_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_usuario`
--

DROP TABLE IF EXISTS `wk_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_usuario` (
  `usuarioId` int NOT NULL AUTO_INCREMENT,
  `personaId` int NOT NULL,
  `usuario` varchar(25) DEFAULT NULL,
  `clave` varchar(45) DEFAULT NULL,
  `estado` varchar(1) DEFAULT NULL,
  `rolId` int NOT NULL,
  PRIMARY KEY (`usuarioId`),
  KEY `FK_USUARIO_PERSONA_idx` (`personaId`),
  KEY `FK_USUARIO_ROL_idx` (`rolId`),
  CONSTRAINT `FK_USUARIO_PERSONA` FOREIGN KEY (`personaId`) REFERENCES `wk_persona` (`personaId`),
  CONSTRAINT `FK_USUARIO_ROL` FOREIGN KEY (`rolId`) REFERENCES `wk_rol` (`rolId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_usuario`
--

LOCK TABLES `wk_usuario` WRITE;
/*!40000 ALTER TABLE `wk_usuario` DISABLE KEYS */;
INSERT INTO `wk_usuario` VALUES (1,1,'rebeca','123456','A',2);
/*!40000 ALTER TABLE `wk_usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-23 11:26:03
