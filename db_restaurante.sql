-- MariaDB dump 10.19-11.0.2-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: db_restaurante
-- ------------------------------------------------------
-- Server version	11.0.2-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tb_produtos`
--

DROP TABLE IF EXISTS `tb_produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_produtos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(100) NOT NULL,
  `valor` float(6,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_produtos`
--

LOCK TABLES `tb_produtos` WRITE;
/*!40000 ALTER TABLE `tb_produtos` DISABLE KEYS */;
INSERT INTO `tb_produtos` VALUES
(1,'Pizza',25.00),
(2,'FilÃ© Mignon ao molho',25.25),
(4,'Coca Cola Lata',6.99),
(5,'Hamburger',5.96),
(6,'AAA',4.99);
/*!40000 ALTER TABLE `tb_produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tb_restaurantes`
--

DROP TABLE IF EXISTS `tb_restaurantes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tb_restaurantes` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tb_restaurantes`
--

LOCK TABLES `tb_restaurantes` WRITE;
/*!40000 ALTER TABLE `tb_restaurantes` DISABLE KEYS */;
INSERT INTO `tb_restaurantes` VALUES
(1,'Yooki Sushi','Rua NÃ£o Lembro, 166','2023-11-29 23:52:02','2023-11-29 20:52:02'),
(2,'Covil Rockbar','Av. 13 de Maio, 666','2023-11-29 23:52:02','2023-11-29 20:52:02'),
(3,'Pizza Hut','Av. Eng. Santana Jr, 666','2023-11-29 23:52:02','2023-11-29 20:52:02'),
(7,'CulinÃ¡ria da Van','Av. BarÃ£o de Studart','2023-12-13 00:08:23',NULL),
(8,'Carneiro do Ordones','Av. Jovita Feitosa','2023-12-20 00:55:32',NULL),
(9,'Bulls Beer House','R. Azevedo BolÃ£o','2023-12-20 00:57:50',NULL),
(10,'Bulls Beer House','R. Coronel JucÃ¡','2023-12-20 00:59:50',NULL),
(11,'House Garden Pub','R. JosÃ© Lino','2023-12-20 01:20:19',NULL),
(12,'Habibs','Av. 13 de maio','2023-12-29 00:18:59',NULL);
/*!40000 ALTER TABLE `tb_restaurantes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-01-06 14:26:56

ALTER TABLE tb_produtos ADD COLUMN created_at timestamp NULL DEFAULT current_timestamp();
ALTER TABLE tb_produtos ADD COLUMN updated_at datetime DEFAULT NULL;
