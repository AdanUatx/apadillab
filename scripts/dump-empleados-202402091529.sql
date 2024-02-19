-- MySQL dump 10.13  Distrib 8.0.19, for Win64 (x86_64)
--
-- Host: localhost    Database: empleados
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `det_empleados`
--

DROP TABLE IF EXISTS `det_empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `det_empleados` (
  `id_empleado` int(11) DEFAULT NULL,
  `puesto` varchar(100) DEFAULT NULL,
  `experiencia_profesional` varchar(255) DEFAULT NULL,
  KEY `id_empleado` (`id_empleado`),
  CONSTRAINT `det_empleados_ibfk_1` FOREIGN KEY (`id_empleado`) REFERENCES `ms_empleados` (`id_empleado`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `det_empleados`
--

LOCK TABLES `det_empleados` WRITE;
/*!40000 ALTER TABLE `det_empleados` DISABLE KEYS */;
INSERT INTO `det_empleados` VALUES (19,'Desarrollador Jr','Jr');
/*!40000 ALTER TABLE `det_empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ms_empleados`
--

DROP TABLE IF EXISTS `ms_empleados`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_empleados` (
  `id_empleado` int(11) NOT NULL AUTO_INCREMENT,
  `clave_empleado` varchar(50) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `edad` int(11) DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `genero` varchar(10) DEFAULT NULL,
  `sueldo_base` decimal(10,2) DEFAULT NULL,
  `apellido_paterno` varchar(100) DEFAULT NULL,
  `apellido_materno` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_empleado`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ms_empleados`
--

LOCK TABLES `ms_empleados` WRITE;
/*!40000 ALTER TABLE `ms_empleados` DISABLE KEYS */;
INSERT INTO `ms_empleados` VALUES (19,'20240209APADILLAB','Adan',23,'2001-05-14','masculino',4500.00,'Padilla','Baeza');
/*!40000 ALTER TABLE `ms_empleados` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ms_usuarios`
--

DROP TABLE IF EXISTS `ms_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ms_usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(100) NOT NULL,
  `apellido_usuario` varchar(100) DEFAULT NULL,
  `rol` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ms_usuarios`
--

LOCK TABLES `ms_usuarios` WRITE;
/*!40000 ALTER TABLE `ms_usuarios` DISABLE KEYS */;
INSERT INTO `ms_usuarios` VALUES (1,'Adan','Padilla Baeza','Administrador','adancho19'),(2,'Juan','Perez','Empleado','general');
/*!40000 ALTER TABLE `ms_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'empleados'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-02-09 15:29:06
