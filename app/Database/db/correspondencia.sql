-- MySQL dump 10.13  Distrib 8.0.21, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: correspondencia
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
  `menuId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del menú',
  `nombreMenu` varchar(45) DEFAULT NULL COMMENT 'Campo que almacena el nombre del menú',
  `iconoId` int NOT NULL COMMENT 'Campo que almacena el ID del icono que se agregará al menú',
  PRIMARY KEY (`menuId`),
  KEY `iconoId _idx` (`iconoId`),
  CONSTRAINT `FK_MENU_ICONO` FOREIGN KEY (`iconoId`) REFERENCES `wk_icono` (`iconoId`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_menu`
--

LOCK TABLES `co_menu` WRITE;
/*!40000 ALTER TABLE `co_menu` DISABLE KEYS */;
INSERT INTO `co_menu` VALUES (1,'Inicio',30),(2,'Admin.Rol-Módulo',8),(3,'Configuración de Cátalogos',31),(12,'Configuración de Proceso',32),(13,'Configuración de Transacción',33),(14,'Reportes',5),(15,'Configuración de Usuario',34),(16,'Gráficas',36);
/*!40000 ALTER TABLE `co_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_modulo`
--

DROP TABLE IF EXISTS `co_modulo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `co_modulo` (
  `moduloId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del módulo',
  `nombre` varchar(45) DEFAULT NULL COMMENT 'Campo que almacena el nombre del módulo',
  `descripcion` varchar(200) DEFAULT NULL COMMENT 'Campo que almacena la descripción del módulo',
  PRIMARY KEY (`moduloId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_modulo`
--

LOCK TABLES `co_modulo` WRITE;
/*!40000 ALTER TABLE `co_modulo` DISABLE KEYS */;
INSERT INTO `co_modulo` VALUES (1,'Workflow','Este módulo contiene todos los menú referentes al flujo de trabajo de la correspondencia');
/*!40000 ALTER TABLE `co_modulo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_modulo_menu`
--

DROP TABLE IF EXISTS `co_modulo_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `co_modulo_menu` (
  `moduloMenuId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del moduloMenu',
  `moduloId` int NOT NULL COMMENT 'Campo que almacena el ID del módulo',
  `menuId` int NOT NULL COMMENT 'Campo que almacena el ID del menú',
  PRIMARY KEY (`moduloMenuId`),
  KEY `FK_MODULO_MENU_MODULO_idx` (`moduloId`),
  KEY `FK_MODULO_MENU_MENU_idx` (`menuId`),
  CONSTRAINT `FK_MODULO_MENU_MENU` FOREIGN KEY (`menuId`) REFERENCES `co_menu` (`menuId`),
  CONSTRAINT `FK_MODULO_MENU_MODULO` FOREIGN KEY (`moduloId`) REFERENCES `co_modulo` (`moduloId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_modulo_menu`
--

LOCK TABLES `co_modulo_menu` WRITE;
/*!40000 ALTER TABLE `co_modulo_menu` DISABLE KEYS */;
INSERT INTO `co_modulo_menu` VALUES (1,1,2),(2,1,3),(4,1,15),(6,1,12),(7,1,13),(12,1,16);
/*!40000 ALTER TABLE `co_modulo_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_rol_modulo_menu`
--

DROP TABLE IF EXISTS `co_rol_modulo_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `co_rol_modulo_menu` (
  `rolModuloMenuId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID de rolModuloMenu',
  `rolId` int NOT NULL COMMENT 'Campo que almacena el ID del rol',
  `moduloMenuId` int NOT NULL COMMENT 'Campo que almacena el ID del moduloMenu',
  PRIMARY KEY (`rolModuloMenuId`),
  KEY `FK_ROL_MODULO_MENU_MODULO_MENU_idx` (`moduloMenuId`),
  KEY `FK_ROL_MODULO_MENU_ROL_idx` (`rolId`),
  CONSTRAINT `FK_ROL_MODULO_MENU_MODULO_MENU` FOREIGN KEY (`moduloMenuId`) REFERENCES `co_modulo_menu` (`moduloMenuId`),
  CONSTRAINT `FK_ROL_MODULO_MENU_ROL` FOREIGN KEY (`rolId`) REFERENCES `wk_rol` (`rolId`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_rol_modulo_menu`
--

LOCK TABLES `co_rol_modulo_menu` WRITE;
/*!40000 ALTER TABLE `co_rol_modulo_menu` DISABLE KEYS */;
INSERT INTO `co_rol_modulo_menu` VALUES (12,2,6),(13,2,4),(14,2,1),(15,2,2),(16,2,7),(21,2,12);
/*!40000 ALTER TABLE `co_rol_modulo_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `co_submenu`
--

DROP TABLE IF EXISTS `co_submenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `co_submenu` (
  `subMenuId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del submenú',
  `nombreSubMenu` varchar(45) DEFAULT NULL COMMENT 'Campo que almacena el nombre del submenú',
  `menuId` int NOT NULL COMMENT 'Campo que almacena el ID del menú al que pertenece el submenú',
  `nombreArchivo` varchar(45) DEFAULT NULL COMMENT 'Campo que almacena el nombre de la ruta del submenú',
  PRIMARY KEY (`subMenuId`),
  KEY `FK_SUBMENU_MENU_idx` (`menuId`),
  CONSTRAINT `FK_SUBMENU_MENU` FOREIGN KEY (`menuId`) REFERENCES `co_menu` (`menuId`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `co_submenu`
--

LOCK TABLES `co_submenu` WRITE;
/*!40000 ALTER TABLE `co_submenu` DISABLE KEYS */;
INSERT INTO `co_submenu` VALUES (1,'Inicio',1,'home'),(2,'Admin. Roles',2,'adminRol'),(3,'Admin. Rol-Módulo-Menú ',2,'rolModMenu'),(7,'Admin. Menú',2,'menu_submenu'),(8,'Admin. Menú Detalle',2,'submenus'),(9,'Usuarios',15,'usuario'),(10,'Persona',3,'persona'),(13,'Cargo',3,'cargo'),(14,'Departamento',3,'departamento'),(15,'Contacto',3,'contacto'),(16,'Dirección',3,'direccion'),(17,'Tipo de Envio',3,'tipoEnvio'),(18,'Tipo de Proceso',3,'tipoProceso'),(19,'Tipo de Documento',3,'tipoDocumento'),(20,'Institución',3,'institucion'),(21,'Proceso',12,'proceso'),(22,'Transacción',13,'transaccionConfig'),(23,'Listado Procesos',13,'transaccionLista'),(24,'Módulo-Menú',2,'moduloMenu'),(25,'Gráficas Usuarios',16,'graficas'),(26,'Gráficas Actividades',16,'graficaLineal'),(27,'Gráficas Procesos',16,'graficasProceso');
/*!40000 ALTER TABLE `co_submenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary view structure for view `vista_con_procesos`
--

DROP TABLE IF EXISTS `vista_con_procesos`;
/*!50001 DROP VIEW IF EXISTS `vista_con_procesos`*/;
SET @saved_cs_client     = @@character_set_client;
/*!50503 SET character_set_client = utf8mb4 */;
/*!50001 CREATE VIEW `vista_con_procesos` AS SELECT 
 1 AS `procesoId`,
 1 AS `nombreProceso`,
 1 AS `tipoProcesoId`,
 1 AS `ordenEtapa`,
 1 AS `etapaId`,
 1 AS `nombreEtapa`,
 1 AS `ordenActividad`,
 1 AS `actividadId`,
 1 AS `descripcion`,
 1 AS `nombreActividad`,
 1 AS `personaId`,
 1 AS `nombreResponsable`*/;
SET character_set_client = @saved_cs_client;

--
-- Table structure for table `wk_actividad`
--

DROP TABLE IF EXISTS `wk_actividad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_actividad` (
  `actividadId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID de la actividad',
  `nombreActividad` varchar(75) DEFAULT NULL COMMENT 'Campo que almacena el nombre de la actividad',
  `descripcion` text COMMENT 'Campo que almacena la descripción de la actividad',
  `ordenActividad` int NOT NULL COMMENT 'Campo que almacena el orden de la actividad',
  `etapaId` int DEFAULT NULL COMMENT 'Campo que almacena el ID de la etapa a la que pertenece la actividad',
  `personaId` int NOT NULL COMMENT 'Campo que almacena el ID de la persona a la que se le asigna la actividad',
  PRIMARY KEY (`actividadId`),
  KEY `FK_ACTIVIDAD_ETAPA_idx` (`etapaId`),
  KEY `FK_ACTIVIDAD_PERSONA_idx` (`personaId`),
  CONSTRAINT `FK_ACTIVIDAD_ETAPA` FOREIGN KEY (`etapaId`) REFERENCES `wk_etapa` (`etapaId`),
  CONSTRAINT `FK_ACTIVIDAD_PERSONA` FOREIGN KEY (`personaId`) REFERENCES `wk_persona` (`personaId`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_actividad`
--

LOCK TABLES `wk_actividad` WRITE;
/*!40000 ALTER TABLE `wk_actividad` DISABLE KEYS */;
INSERT INTO `wk_actividad` VALUES (3,'Envio de documento','enviar documento completo a MINED',1,2,1),(4,'Responder correo electronico','Correo electrónico de MINED ',2,2,1),(7,'Comprobar paquete de expedientes','Corroborar que el paquete de expedientes este completo',3,7,1),(8,'Recibir observaciones','Revisar correo electrónico para obtener correcciones',1,7,3),(12,'Descargar solicitud','Descargar solicitud del correo electronico',1,18,1),(13,'actividad 1','gfrt',2,26,1),(14,'iiiii','pjffffffffffffffffffffffffff',3,26,1),(15,'httt','eyyff',4,25,2),(16,'Dgdgdg','qqq',1,49,1),(19,'actividad3','55',5,49,1),(20,'gggg','222',6,65,2),(21,'actividad1','548848',1,64,2),(22,'actividad2','hdgdg',2,64,2),(23,'actividad','dydt',3,62,3),(24,'dhdtdtdf','dhdhd',4,68,2),(26,'Hast','hbdgd',5,69,1),(29,'ssysys','hdhd',8,69,1),(30,'wrwr','11',2,69,2),(32,'act1','Desc',1,68,1),(33,'act2','desc2',3,68,3),(40,'Enviar documento x','jugkjahdgdugygd',1,19,1),(48,'actividad1','jhsd',1,79,1),(49,'Actividad 1','descrip actividad 1',1,82,2),(50,'att','gff',1,67,2),(51,'ac','hjhg',1,88,1),(52,'ww','wwr',2,88,2),(53,'resef','dsds',2,88,3),(54,'ef','ss',2,88,1);
/*!40000 ALTER TABLE `wk_actividad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_bitacora`
--

DROP TABLE IF EXISTS `wk_bitacora`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_bitacora` (
  `bitacoraId` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID de la bitácora',
  `usuarioId` int NOT NULL COMMENT 'Campo que almacena el ID del usuario que realiza la acción',
  `accion` varchar(1) DEFAULT NULL COMMENT 'Campo que almacena la acción que realiza el usuario',
  `descripcion` varchar(100) DEFAULT NULL COMMENT 'Campo que almacena la descripción del movimiento',
  `fecha` date DEFAULT NULL COMMENT 'Campo que almacena la fecha del movimiento',
  `hora` time DEFAULT NULL COMMENT 'Campo que almacena la hora del movimiento',
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
  `cargoId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del cargo',
  `cargo` varchar(75) DEFAULT NULL COMMENT 'Campo que almacena el nombre del cargo',
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
  `contactoId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del contacto',
  `personaId` int NOT NULL COMMENT 'Campo que almacena el ID de la persona a la que se le asigna un contacto',
  `tipoContactoId` int NOT NULL COMMENT 'Campo que almacena el ID del tipo de contacto',
  `contacto` varchar(100) NOT NULL COMMENT 'Campo que almacena el nombre del contacto',
  `estado` varchar(1) NOT NULL COMMENT 'Campo que almacena el estado del contacto. (A=ACTIVO , I=INACTIVO)',
  PRIMARY KEY (`contactoId`),
  KEY `FK_CONTACTO_PERSONA_idx` (`personaId`),
  KEY `FK_CONTACTO_TIPO_CONTACTO_idx` (`tipoContactoId`),
  CONSTRAINT `FK_CONTACTO_PERSONA` FOREIGN KEY (`personaId`) REFERENCES `wk_persona` (`personaId`),
  CONSTRAINT `FK_CONTACTO_TIPO_CONTACTO` FOREIGN KEY (`tipoContactoId`) REFERENCES `wk_tipo_contacto` (`tipoContactoId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_contacto`
--

LOCK TABLES `wk_contacto` WRITE;
/*!40000 ALTER TABLE `wk_contacto` DISABLE KEYS */;
INSERT INTO `wk_contacto` VALUES (1,1,1,'kattan@gmail.com','A'),(2,2,1,'dghstyst','A');
/*!40000 ALTER TABLE `wk_contacto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_departamento`
--

DROP TABLE IF EXISTS `wk_departamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_departamento` (
  `departamentoId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del departamento de la universidad. ',
  `departamento` varchar(100) DEFAULT NULL COMMENT 'Campo que almacena el nombre del departamento de la universidad. ',
  PRIMARY KEY (`departamentoId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_departamento`
--

LOCK TABLES `wk_departamento` WRITE;
/*!40000 ALTER TABLE `wk_departamento` DISABLE KEYS */;
INSERT INTO `wk_departamento` VALUES (1,'Administración académica'),(3,'Dirección de Investigación'),(4,'Dirección de educación virtual'),(5,'Asistencia al estudiante');
/*!40000 ALTER TABLE `wk_departamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_depto`
--

DROP TABLE IF EXISTS `wk_depto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_depto` (
  `deptoId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del departamento del país. ',
  `paisId` int NOT NULL COMMENT 'Campo que almacena el ID del país al que pertenece el departamento',
  `nombreDepto` varchar(75) DEFAULT NULL COMMENT 'Campo que almacena el nombre del departamento (país)',
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
  `direccionId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID de la dirección',
  `personaId` int NOT NULL COMMENT 'Campo que almacena el ID de la persona a la que se le asigna la dirección',
  `tipoDireccion` varchar(1) DEFAULT NULL COMMENT 'Campo que almacena el tipo de dirección (P=PRINCIPAL, S=SECUNDARIA)',
  `nombreDireccion` varchar(150) DEFAULT NULL COMMENT 'Campo que almacena el nombre de la dirección',
  `municipioId` int NOT NULL COMMENT 'Campo que almacena el ID del municipio ',
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
  `documentoId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del documento',
  `nombreDocumento` varchar(75) DEFAULT NULL COMMENT 'Campo que almacena el nombre del documento',
  `tipoDocumentoId` int NOT NULL COMMENT 'Campo que almacena el ID del tipo de documento',
  `tipoEnvioId` int NOT NULL COMMENT 'Campo que almacena el ID del tipo de envio',
  `transaccionActividadId` int NOT NULL COMMENT 'Campo que almacena el ID de la transaccionActividad a la que se le anexa el documento',
  PRIMARY KEY (`documentoId`),
  KEY `FK_DOCUMENTO_TIPO_DOCUMENTO_idx` (`tipoDocumentoId`),
  KEY `FK_DOCUMENTO_TIPO_ENVIO_idx` (`tipoEnvioId`),
  KEY `FK_TRAACT_DOCUMENTO_idx` (`transaccionActividadId`),
  CONSTRAINT `FK_DOCUMENTO_TIPO_DOCUMENTO` FOREIGN KEY (`tipoDocumentoId`) REFERENCES `wk_tipo_documento` (`tipoDocumentoId`),
  CONSTRAINT `FK_DOCUMENTO_TIPO_ENVIO` FOREIGN KEY (`tipoEnvioId`) REFERENCES `wk_tipo_envio` (`tipoEnvioId`),
  CONSTRAINT `FK_TRAACT_DOCUMENTO` FOREIGN KEY (`transaccionActividadId`) REFERENCES `wk_transaccion_actividades` (`transaccionActividadId`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_documento`
--

LOCK TABLES `wk_documento` WRITE;
/*!40000 ALTER TABLE `wk_documento` DISABLE KEYS */;
INSERT INTO `wk_documento` VALUES (2,'archivo1',1,1,118),(3,'docs',1,1,127);
/*!40000 ALTER TABLE `wk_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_etapa`
--

DROP TABLE IF EXISTS `wk_etapa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_etapa` (
  `etapaId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID de la etapa',
  `nombreEtapa` varchar(75) DEFAULT NULL COMMENT 'Campo que almacena el nombre de la etapa',
  `orden` int DEFAULT NULL COMMENT 'Campo que almacena el orden de la etapa',
  `procesoId` int DEFAULT NULL COMMENT 'Campo que almacena el ID del proceso al que pertenece la etapa',
  PRIMARY KEY (`etapaId`),
  KEY `FK_PROCESO_ETAPA_idx` (`procesoId`),
  CONSTRAINT `FK_PROCESO_ETAPA` FOREIGN KEY (`procesoId`) REFERENCES `wk_proceso` (`procesoId`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_etapa`
--

LOCK TABLES `wk_etapa` WRITE;
/*!40000 ALTER TABLE `wk_etapa` DISABLE KEYS */;
INSERT INTO `wk_etapa` VALUES (2,'Envío de notificación a MINED ',1,1),(7,'Envío de paquete de expediente',1,4),(18,'Recepción de solicitud',1,3),(19,'Envio de documento Solicitado',2,3),(20,'prueba1',1,5),(21,'prueba 2',2,5),(22,'prueba3',3,5),(23,'prueba 4',4,5),(24,'prueba5',5,5),(25,'ejem 1',2,6),(26,'ejem 2',1,6),(49,'etapa3',13,7),(52,'etap3',3,3),(53,'etapa4',4,3),(54,'etapa5',5,3),(55,'prueba6',6,5),(59,'Etapa1',1,9),(62,'etapa1',2,10),(63,'etapa2',1,10),(64,'etapa3',4,10),(65,'etapa4',3,10),(67,'Etapa1',10,8),(68,'etapa2',5,8),(69,'sss',10,10),(79,'etapa1',1,15),(80,'etapa1',1,16),(81,'etapa2',2,16),(82,'Etapa 1',1,17),(83,'et',2,18),(84,'et2',1,18),(85,'et3',5,18),(86,'etapa2',3,17),(87,'gg',3,18),(88,'et',1,13),(89,'et2',2,13);
/*!40000 ALTER TABLE `wk_etapa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_icono`
--

DROP TABLE IF EXISTS `wk_icono`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_icono` (
  `iconoId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del icono',
  `nombreIcono` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL COMMENT 'Campo que almacena el nombre del icono',
  PRIMARY KEY (`iconoId`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_icono`
--

LOCK TABLES `wk_icono` WRITE;
/*!40000 ALTER TABLE `wk_icono` DISABLE KEYS */;
INSERT INTO `wk_icono` VALUES (1,'fa fa-address-book'),(2,'fa fa-address-card'),(3,'fa fa-adjust'),(4,'fa fa-angellist'),(5,'fa fa-archive'),(6,'fa fa-area-chart'),(7,'fa fa-bar-chart'),(8,'fa fa-bars'),(9,'fa fa-book'),(10,'fa fa-bookmark'),(11,'fa fa-building-o'),(12,'fa fa-calculator'),(13,'fa fa-calendar'),(14,'fa fa-check'),(15,'fa fa-comment-o'),(16,'fa fa-desktop'),(17,'fa fa-envelope'),(18,'fa fa-envelope-o'),(19,'fa fa-folder'),(20,'fa fa-folder-o'),(21,'fa fa-folder-open'),(22,'fa fa-folder-open-o'),(23,'fa fa-group'),(24,'fa fa-inbox'),(25,'fa fa-lock'),(26,'fa fa-mortar-board'),(27,'fa fa-pencil'),(28,'fa fa-pencil-square-o'),(29,'fa fa-plus'),(30,'fa fa-home'),(31,'fa fa-th-list'),(32,'fa fa-cogs'),(33,'fa fa-exchange'),(34,'fa fa-cog'),(35,'fa fa-user'),(36,'fa fa-bar-chart');
/*!40000 ALTER TABLE `wk_icono` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_institucion`
--

DROP TABLE IF EXISTS `wk_institucion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_institucion` (
  `institucionId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID de la institución',
  `nombreInstitucion` varchar(100) DEFAULT NULL COMMENT 'Campo que almacena el nombre de la institución',
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
  `municipioId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del municipio',
  `deptoId` int NOT NULL COMMENT 'Campo que almacena el ID del departamento al que pertenece el municipio',
  `nombreMunicipio` varchar(75) DEFAULT NULL COMMENT 'Campo que almacena el nombre del municipio',
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
  `paisId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del país',
  `nombrePais` varchar(50) DEFAULT NULL COMMENT 'Campo que almacena el nombre del país',
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
  `personaId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID de la persona',
  `dui` varchar(10) DEFAULT NULL COMMENT 'Campo que almacena el dui de la persona',
  `nombres` varchar(70) DEFAULT NULL COMMENT 'Campo que almacena el nombre de la persona',
  `primerApellido` varchar(45) DEFAULT NULL COMMENT 'Campo que almacena el primer apellido de la persona',
  `segundoApellido` varchar(45) DEFAULT NULL COMMENT 'Campo que almacena el segundo apellido de la persona',
  `fechaNacimiento` date DEFAULT NULL COMMENT 'Campo que almacena la fecha de nacimiento de la persona',
  `genero` varchar(1) DEFAULT NULL COMMENT 'Campo que almacena el género de la persona',
  `cargoId` int NOT NULL COMMENT 'Campo que almacena el cargo que se le asigna a la persona',
  `departamentoId` int NOT NULL COMMENT 'Campo que almacena el departamento que se le asigna a la persona',
  `usuarioCrea` varchar(45) DEFAULT NULL COMMENT 'Campo que almacena el usuario que creó a la persona',
  `fechaCrea` datetime DEFAULT NULL COMMENT 'Campo que almacena la fecha y hora en que se creó la persona',
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
INSERT INTO `wk_persona` VALUES (1,NULL,'Rebeca','Kattan','Toledo','1998-01-03','F',4,1,'rebeca','2022-04-17 00:00:00'),(2,NULL,'Shelimber','Chinchilla','Huezo','1997-12-01','F',4,3,'rebeca','2022-04-18 00:00:00'),(3,NULL,'Oscar','Avelar','Escobar','2022-04-12','M',1,5,'rebeca','2022-04-19 00:00:00');
/*!40000 ALTER TABLE `wk_persona` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_proceso`
--

DROP TABLE IF EXISTS `wk_proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_proceso` (
  `procesoId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del proceso',
  `nombreProceso` varchar(70) NOT NULL COMMENT 'Campo que almacena el nombre del proceso',
  `tipoProcesoId` int NOT NULL COMMENT 'Campo que almacena el ID del tipo de proceso',
  PRIMARY KEY (`procesoId`),
  KEY `FK_PROCESO_TIPOPROCESO_idx` (`tipoProcesoId`),
  CONSTRAINT `FK_PROCESO_TIPOPROCESO` FOREIGN KEY (`tipoProcesoId`) REFERENCES `wk_tipo_proceso` (`tipoProcesoId`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_proceso`
--

LOCK TABLES `wk_proceso` WRITE;
/*!40000 ALTER TABLE `wk_proceso` DISABLE KEYS */;
INSERT INTO `wk_proceso` VALUES (1,'Plan de Estudio Teología 2022',1),(3,'Calificación Institucional',1),(4,'Expedientes Graduandos',1),(5,'Ministerio de economia',3),(6,'Proceso prueba',3),(7,'hh',1),(8,'Ejemplo 1',1),(9,'prueba2',1),(10,'prueba3',1),(11,'30/5',1),(12,'PruebaTransaccion',1),(13,'x',1),(14,'y',3),(15,'prueba',1),(16,'prueba 2',1),(17,'Plan de Estudio x',1),(18,'x',3),(19,'dffe',3);
/*!40000 ALTER TABLE `wk_proceso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_rol`
--

DROP TABLE IF EXISTS `wk_rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_rol` (
  `rolId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del rol',
  `nombreRol` varchar(50) DEFAULT NULL COMMENT 'Campo que almacena el nombre del rol',
  PRIMARY KEY (`rolId`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_rol`
--

LOCK TABLES `wk_rol` WRITE;
/*!40000 ALTER TABLE `wk_rol` DISABLE KEYS */;
INSERT INTO `wk_rol` VALUES (2,'Super Admin'),(3,'Administrador'),(9,'Usuario'),(12,'Consultores');
/*!40000 ALTER TABLE `wk_rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_tipo_contacto`
--

DROP TABLE IF EXISTS `wk_tipo_contacto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_tipo_contacto` (
  `tipoContactoId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del tipo de contacto',
  `tipoContacto` varchar(50) DEFAULT NULL COMMENT 'Campo que almacena el nombre del tipo de contacto',
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
  `tipoDocumentoId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del tipo de documento',
  `tipoDocumento` varchar(50) DEFAULT NULL COMMENT 'Campo que almacena el nombre del tipo de documento',
  PRIMARY KEY (`tipoDocumentoId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_tipo_documento`
--

LOCK TABLES `wk_tipo_documento` WRITE;
/*!40000 ALTER TABLE `wk_tipo_documento` DISABLE KEYS */;
INSERT INTO `wk_tipo_documento` VALUES (1,'Notificacion');
/*!40000 ALTER TABLE `wk_tipo_documento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_tipo_envio`
--

DROP TABLE IF EXISTS `wk_tipo_envio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_tipo_envio` (
  `tipoEnvioId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del tipo de envio',
  `tipoEnvio` varchar(45) DEFAULT NULL COMMENT 'Campo que almacena el nombre del tipo de envio',
  PRIMARY KEY (`tipoEnvioId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_tipo_envio`
--

LOCK TABLES `wk_tipo_envio` WRITE;
/*!40000 ALTER TABLE `wk_tipo_envio` DISABLE KEYS */;
INSERT INTO `wk_tipo_envio` VALUES (1,'correo electronico'),(2,'correo');
/*!40000 ALTER TABLE `wk_tipo_envio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_tipo_proceso`
--

DROP TABLE IF EXISTS `wk_tipo_proceso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_tipo_proceso` (
  `tipoProcesoId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del tipo de proceso',
  `tipoProceso` varchar(50) DEFAULT NULL COMMENT 'Campo que almacena el nombre del tipo de proceso',
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
  `transaccionId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID de la transacción',
  `procesoId` int NOT NULL COMMENT 'Campo que almacena el ID del proceso que se agrega a transacción',
  `personaId` int NOT NULL COMMENT 'Campo que almacena el ID de la persona encargada del proceso',
  `institucionId` int NOT NULL COMMENT 'Campo que almacena el ID de la institución para la que se realiza la transacción',
  `estadoTransaccion` varchar(1) DEFAULT NULL COMMENT 'Campo que almacena el estado de la transacción (P=EN PROGRESO, F=FINALIZADO, I=INACTIVO, A=ANULADA)',
  `fechaInicio` date DEFAULT NULL COMMENT 'Campo que almacena la fecha de inicio de la transacción',
  `fechaFin` date DEFAULT NULL COMMENT 'Campo que almacena la fecha de finalización de la transacción',
  `horaInicio` time DEFAULT NULL COMMENT 'Campo que almacena la hora de inicio de la transacción',
  `horaFin` time DEFAULT NULL COMMENT 'Campo que almacena la hora de finalización de la transacción',
  `observaciones` text COMMENT 'Campo que almacenan las observaciones de la transacción',
  `usuarioCrea` varchar(45) DEFAULT NULL COMMENT 'Campo que almacena el usuario que creó la transacción',
  `fechaCrea` datetime DEFAULT NULL COMMENT 'Campo que almacena la fecha y hora en que se creó la transacción',
  PRIMARY KEY (`transaccionId`),
  KEY `FK_TRANSACCION_PERSONA_idx` (`personaId`),
  KEY `FK_TRANSCCION_PROCESO_idx` (`procesoId`),
  KEY `FK_TRANSACCION_INSTITUCION_idx` (`institucionId`),
  CONSTRAINT `FK_TRANSACCION_INSTITUCION` FOREIGN KEY (`institucionId`) REFERENCES `wk_institucion` (`institucionId`),
  CONSTRAINT `FK_TRANSACCION_PERSONA` FOREIGN KEY (`personaId`) REFERENCES `wk_persona` (`personaId`),
  CONSTRAINT `FK_TRANSCCION_PROCESO` FOREIGN KEY (`procesoId`) REFERENCES `wk_proceso` (`procesoId`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_transaccion`
--

LOCK TABLES `wk_transaccion` WRITE;
/*!40000 ALTER TABLE `wk_transaccion` DISABLE KEYS */;
INSERT INTO `wk_transaccion` VALUES (70,12,2,2,'F','2022-06-10','2022-06-10','13:55:33','14:11:30','Proceso con fines internos.',NULL,NULL),(71,1,1,1,'F','2022-06-11','2022-06-11','16:44:05','18:31:01',NULL,NULL,NULL),(72,1,1,1,'F','2022-06-11','2022-06-12','18:33:39','19:52:04',NULL,NULL,NULL),(74,7,1,1,'F','2022-06-12','2022-06-12','19:28:21','19:52:05',NULL,NULL,NULL),(77,8,1,1,'A',NULL,NULL,NULL,NULL,'Agilizar proceso X',NULL,NULL),(78,9,2,2,'A','2022-06-14',NULL,'17:38:48',NULL,'sss',NULL,NULL),(80,3,1,1,'A','2022-06-14',NULL,'19:55:04',NULL,'Creado para agilizar las tareas relacionadas con y',NULL,NULL),(81,3,3,2,'P','2022-06-20',NULL,'15:33:56',NULL,'xx',NULL,NULL),(82,5,2,1,'P','2022-06-20',NULL,'15:35:31',NULL,'gg',NULL,NULL),(83,8,2,2,'F','2022-06-20','2022-06-20','15:39:14','15:44:50','ggg',NULL,NULL),(84,8,2,1,'P','2022-06-21',NULL,'19:03:47',NULL,'eww',NULL,NULL),(85,13,1,1,'P','2022-06-21',NULL,'19:07:35',NULL,'ddd',NULL,NULL),(86,15,1,1,'P','2022-06-27',NULL,'18:12:10',NULL,'obs',NULL,NULL);
/*!40000 ALTER TABLE `wk_transaccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_transaccion_actividades`
--

DROP TABLE IF EXISTS `wk_transaccion_actividades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_transaccion_actividades` (
  `transaccionActividadId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID de transaccionActividad',
  `transaccionDetalleId` int NOT NULL COMMENT 'Campo que almacena el ID de transaccionDetalle a la que pertenece transaccionActividad',
  `actividadId` int NOT NULL COMMENT 'Campo que almacena el ID de la actividad involucrada en la transacción',
  `fechaCreacion` date NOT NULL COMMENT 'Campo que almacena la fecha en que se creó transaccionActividad',
  `horaCreacion` time NOT NULL COMMENT 'Campo que almacena la hora en que se creó transaccionActividad',
  `fechaInicio` date NOT NULL COMMENT 'Campo que almacena la fecha en que se inició transaccionActividad',
  `horaInicio` time NOT NULL COMMENT 'Campo que almacena la hora en que se inició transaccionActividad',
  `fechaFin` date NOT NULL COMMENT 'Campo que almacena la fecha en que se finalizo transaccionActividad',
  `horaFin` time NOT NULL COMMENT 'Campo que almacena la hora en que se finalizo transaccionActividad',
  `estado` varchar(1) DEFAULT NULL COMMENT 'Campo que almacena el estado de  transaccionActividad (E=EN PROGRESO, F= FINALIZADO, I=INACTIVO)',
  `observaciones` text COMMENT 'Campo que almacena las observaciones de transaccionActividad ',
  PRIMARY KEY (`transaccionActividadId`),
  KEY `FK_TRANACT_TRADET_idx` (`transaccionDetalleId`),
  CONSTRAINT `FK_TRANACT_TRADET` FOREIGN KEY (`transaccionDetalleId`) REFERENCES `wk_transaccion_detalle` (`transaccionDetalleId`)
) ENGINE=InnoDB AUTO_INCREMENT=142 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_transaccion_actividades`
--

LOCK TABLES `wk_transaccion_actividades` WRITE;
/*!40000 ALTER TABLE `wk_transaccion_actividades` DISABLE KEYS */;
INSERT INTO `wk_transaccion_actividades` VALUES (118,151,41,'2022-04-09','13:55:34','2022-05-10','14:05:12','2022-06-10','14:07:31','F',NULL),(119,151,42,'2022-04-08','14:07:31','2022-04-10','14:09:24','2022-06-10','14:10:25','F',NULL),(120,152,43,'2022-01-10','14:10:25','2022-02-10','14:11:16','2022-06-05','14:11:30','F',NULL),(121,153,3,'2022-06-01','16:44:06','2022-06-03','18:27:11','2022-06-11','18:27:26','F',NULL),(122,153,4,'2022-06-10','18:27:26','2022-06-11','18:30:56','2022-06-12','18:31:01','F',NULL),(123,154,3,'2022-06-10','18:33:40','2022-06-11','18:34:45','2022-06-12','18:34:52','F',NULL),(124,154,4,'2022-06-07','18:34:52','2022-06-11','18:35:01','2022-06-12','18:35:08','F',NULL),(125,155,44,'2022-06-05','18:35:08','2022-06-11','19:48:23','2022-06-12','16:52:04','F',NULL),(127,157,16,'2022-01-11','19:28:21','2022-01-12','19:29:47','2022-06-12','19:29:57','F','dsds'),(128,157,19,'2022-01-03','19:29:57','2022-02-12','19:51:44','2022-05-12','19:52:05','F','observacion 1'),(129,158,0,'2022-05-01','17:38:51','2022-05-01','00:00:00','0000-00-00','00:00:00','I',NULL),(130,159,12,'2022-05-14','19:55:04','2022-06-20','20:25:48','2022-06-20','10:26:07','F',NULL),(131,160,40,'2022-04-20','10:26:07','2022-05-28','00:00:00','0000-00-00','00:00:00','I',NULL),(132,161,12,'2022-05-20','15:33:57','2022-05-28','00:00:00','0000-00-00','00:00:00','I',NULL),(133,162,0,'2022-05-20','15:35:31','2022-05-28','00:00:00','0000-00-00','00:00:00','I',NULL),(134,163,32,'2022-01-20','15:39:14','2022-01-20','15:39:38','2022-06-20','15:39:48','F',NULL),(135,163,33,'2022-04-20','15:39:48','2022-05-18','15:41:53','2022-06-20','15:41:58','F',NULL),(136,163,24,'2022-05-05','15:41:58','2022-05-19','15:44:23','2022-06-20','15:44:30','F',NULL),(137,164,50,'2022-03-20','15:44:30','2022-04-20','15:44:45','2022-06-20','15:44:50','F',NULL),(138,165,32,'2022-05-21','19:03:49','2022-05-28','00:00:00','2022-06-20','15:44:50','I',NULL),(139,166,51,'2022-06-20','19:07:36','2022-06-21','19:08:00','2022-06-27','18:38:37','F',NULL),(140,167,48,'2022-06-27','18:12:13','2022-06-27','18:14:07','0000-00-00','00:00:00','P',NULL),(141,166,52,'2022-06-27','18:38:37','0000-00-00','00:00:00','0000-00-00','00:00:00','I',NULL);
/*!40000 ALTER TABLE `wk_transaccion_actividades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_transaccion_detalle`
--

DROP TABLE IF EXISTS `wk_transaccion_detalle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_transaccion_detalle` (
  `transaccionDetalleId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID de transaccionDetalle',
  `transaccionId` int NOT NULL,
  `etapaId` int NOT NULL COMMENT 'Campo que almacena el ID de la etapa involucrada en la transacción',
  `fechaInicio` date DEFAULT NULL COMMENT 'Campo que almacena la fecha en que se inició transaccionDetalle',
  `horaInicio` time DEFAULT NULL COMMENT 'Campo que almacena la hora en que se inició transaccionDetalle',
  `fechaFin` date DEFAULT NULL COMMENT 'Campo que almacena la fecha en que se finalizó transaccionDetalle',
  `horaFin` time DEFAULT NULL COMMENT 'Campo que almacena la hora en que se finalizó transaccionDetalle',
  `estado` varchar(1) DEFAULT NULL COMMENT 'Campo que almacena el estado de transaccionDetalle (E=EN PROGRESO, F= FINALIZADO, I=INACTIVO)',
  PRIMARY KEY (`transaccionDetalleId`),
  KEY `FK_TRANDET_TRANSACCION_idx` (`transaccionId`),
  CONSTRAINT `FK_TRANDET_TRANSACCION` FOREIGN KEY (`transaccionId`) REFERENCES `wk_transaccion` (`transaccionId`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_transaccion_detalle`
--

LOCK TABLES `wk_transaccion_detalle` WRITE;
/*!40000 ALTER TABLE `wk_transaccion_detalle` DISABLE KEYS */;
INSERT INTO `wk_transaccion_detalle` VALUES (151,70,71,'2022-06-10','13:55:33','2022-06-10','14:10:25','F'),(152,70,72,'2022-06-10','14:10:25','2022-06-10','14:11:30','F'),(153,71,2,'2022-06-11','16:44:05','2022-06-11','18:31:01','F'),(154,72,2,'2022-06-11','18:33:39','2022-06-11','18:35:08','F'),(155,72,73,'2022-06-11','18:35:08','2022-06-12','16:52:04','F'),(157,74,49,'2022-06-12','19:28:21','2022-06-12','19:52:05','F'),(158,78,59,'2022-06-14','17:38:48',NULL,NULL,'P'),(159,80,18,'2022-06-14','19:55:04','2022-06-20','10:26:07','F'),(160,80,19,'2022-06-20','10:26:07',NULL,NULL,'I'),(161,81,18,'2022-06-20','15:33:56',NULL,NULL,'P'),(162,82,20,'2022-06-20','15:35:31',NULL,NULL,'P'),(163,83,68,'2022-06-20','15:39:14','2022-06-20','15:44:30','F'),(164,83,67,'2022-06-20','15:44:30','2022-06-20','15:44:50','F'),(165,84,68,'2022-06-21','19:03:47',NULL,NULL,'P'),(166,85,88,'2022-06-21','19:07:35',NULL,NULL,'P'),(167,86,79,'2022-06-27','18:12:10',NULL,NULL,'P');
/*!40000 ALTER TABLE `wk_transaccion_detalle` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wk_usuario`
--

DROP TABLE IF EXISTS `wk_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wk_usuario` (
  `usuarioId` int NOT NULL AUTO_INCREMENT COMMENT 'Campo que almacena el ID del usuario',
  `personaId` int NOT NULL COMMENT 'Campo que almacena el ID de la persona a la que se le crea el usuario',
  `usuario` varchar(25) DEFAULT NULL COMMENT 'Campo que almacena el nombre del usuario',
  `clave` varchar(45) DEFAULT NULL COMMENT 'Campo que almacena la contraseña del usuario',
  `estado` varchar(1) DEFAULT NULL COMMENT 'Campo que almacena el estado del usuario (A=ACTIVO, I=INACTIVO)',
  `rolId` int NOT NULL COMMENT 'Campo que almacena el ID del rol que se le asigna al usuario',
  PRIMARY KEY (`usuarioId`),
  KEY `FK_USUARIO_PERSONA_idx` (`personaId`),
  KEY `FK_USUARIO_ROL_idx` (`rolId`),
  CONSTRAINT `FK_USUARIO_PERSONA` FOREIGN KEY (`personaId`) REFERENCES `wk_persona` (`personaId`),
  CONSTRAINT `FK_USUARIO_ROL` FOREIGN KEY (`rolId`) REFERENCES `wk_rol` (`rolId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wk_usuario`
--

LOCK TABLES `wk_usuario` WRITE;
/*!40000 ALTER TABLE `wk_usuario` DISABLE KEYS */;
INSERT INTO `wk_usuario` VALUES (1,1,'rebeca','123456','A',2),(3,2,'Mar97','1234','A',2),(4,3,'Oscar','147','A',2),(5,2,'shelimber','14736987','A',3),(6,1,'abcd','258','I',2);
/*!40000 ALTER TABLE `wk_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Final view structure for view `vista_con_procesos`
--

/*!50001 DROP VIEW IF EXISTS `vista_con_procesos`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8mb4 */;
/*!50001 SET character_set_results     = utf8mb4 */;
/*!50001 SET collation_connection      = utf8mb4_0900_ai_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `vista_con_procesos` AS select `p`.`procesoId` AS `procesoId`,`p`.`nombreProceso` AS `nombreProceso`,`p`.`tipoProcesoId` AS `tipoProcesoId`,`e`.`orden` AS `ordenEtapa`,`e`.`etapaId` AS `etapaId`,`e`.`nombreEtapa` AS `nombreEtapa`,`a`.`ordenActividad` AS `ordenActividad`,`a`.`actividadId` AS `actividadId`,`a`.`descripcion` AS `descripcion`,`a`.`nombreActividad` AS `nombreActividad`,`a`.`personaId` AS `personaId`,concat(`per`.`nombres`,' ',`per`.`primerApellido`,' ',`per`.`segundoApellido`) AS `nombreResponsable` from (((`wk_proceso` `p` left join `wk_etapa` `e` on((`e`.`procesoId` = `p`.`procesoId`))) left join `wk_actividad` `a` on((`a`.`etapaId` = `e`.`etapaId`))) left join `wk_persona` `per` on((`per`.`personaId` = `a`.`personaId`))) order by `e`.`orden`,`a`.`ordenActividad` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-07-11 11:10:23
