-- MySQL dump 10.13  Distrib 8.0.20, for Linux (x86_64)
--
-- Host: localhost    Database: chefia_db
-- ------------------------------------------------------
-- Server version	8.0.20-0ubuntu0.19.10.1

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
-- Table structure for table `alternatives`
--

DROP TABLE IF EXISTS `alternatives`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `alternatives` (
  `alternatives_id` int NOT NULL AUTO_INCREMENT,
  `alternatives_text` text,
  `alternatives_next_state_id_fk` int DEFAULT NULL,
  `states_id_fk` int DEFAULT NULL,
  `menu_categories_id_fk` int DEFAULT NULL,
  `menu_items_id_fk` int DEFAULT NULL,
  PRIMARY KEY (`alternatives_id`),
  KEY `alternatives_next_state_id_fk` (`alternatives_next_state_id_fk`),
  KEY `states_id_fk` (`states_id_fk`),
  KEY `menu_categories_id_fk` (`menu_categories_id_fk`),
  KEY `menu_items_id_fk` (`menu_items_id_fk`),
  CONSTRAINT `alternatives_ibfk_1` FOREIGN KEY (`alternatives_next_state_id_fk`) REFERENCES `states` (`states_id`),
  CONSTRAINT `alternatives_ibfk_2` FOREIGN KEY (`states_id_fk`) REFERENCES `states` (`states_id`),
  CONSTRAINT `alternatives_ibfk_3` FOREIGN KEY (`menu_categories_id_fk`) REFERENCES `menu_categories` (`menu_categories_id`),
  CONSTRAINT `alternatives_ibfk_4` FOREIGN KEY (`menu_items_id_fk`) REFERENCES `menu_items` (`menu_items_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alternatives`
--

LOCK TABLES `alternatives` WRITE;
/*!40000 ALTER TABLE `alternatives` DISABLE KEYS */;
INSERT INTO `alternatives` VALUES (1,'Bebidas',2,1,1,NULL),(2,'Porções',2,1,NULL,NULL),(3,'Voltar ao cardápio',1,2,NULL,NULL);
/*!40000 ALTER TABLE `alternatives` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `general_settings`
--

DROP TABLE IF EXISTS `general_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `general_settings` (
  `general_settings_key` varchar(32) NOT NULL,
  `general_settings_value` varchar(1024) DEFAULT NULL,
  PRIMARY KEY (`general_settings_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `general_settings`
--

LOCK TABLES `general_settings` WRITE;
/*!40000 ALTER TABLE `general_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `general_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_categories`
--

DROP TABLE IF EXISTS `menu_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_categories` (
  `menu_categories_id` int NOT NULL AUTO_INCREMENT,
  `menu_categories_text` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`menu_categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_categories`
--

LOCK TABLES `menu_categories` WRITE;
/*!40000 ALTER TABLE `menu_categories` DISABLE KEYS */;
INSERT INTO `menu_categories` VALUES (1,'Bebidas'),(2,'Porções');
/*!40000 ALTER TABLE `menu_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_images`
--

DROP TABLE IF EXISTS `menu_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_images` (
  `menu_images_id` int NOT NULL AUTO_INCREMENT,
  `menu_images_path` varchar(1024) DEFAULT NULL,
  `menu_items_id_fk` int DEFAULT NULL,
  PRIMARY KEY (`menu_images_id`),
  KEY `menu_items_id_fk` (`menu_items_id_fk`),
  CONSTRAINT `menu_images_ibfk_1` FOREIGN KEY (`menu_items_id_fk`) REFERENCES `menu_items` (`menu_items_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_images`
--

LOCK TABLES `menu_images` WRITE;
/*!40000 ALTER TABLE `menu_images` DISABLE KEYS */;
/*!40000 ALTER TABLE `menu_images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_items`
--

DROP TABLE IF EXISTS `menu_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `menu_items` (
  `menu_items_id` int NOT NULL AUTO_INCREMENT,
  `menu_items_name` varchar(128) DEFAULT NULL,
  `menu_items_description` varchar(1024) DEFAULT NULL,
  `menu_items_price` decimal(10,2) DEFAULT NULL,
  `menu_items_stock` int DEFAULT NULL,
  `menu_categories_id_fk` int DEFAULT NULL,
  PRIMARY KEY (`menu_items_id`),
  KEY `menu_categories_id_fk` (`menu_categories_id_fk`),
  CONSTRAINT `menu_items_ibfk_1` FOREIGN KEY (`menu_categories_id_fk`) REFERENCES `menu_categories` (`menu_categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_items`
--

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` VALUES (1,'Água Mineral','',2.50,300,1),(2,'Cerveja','',3.00,900,1);
/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requests` (
  `requests_id` int NOT NULL AUTO_INCREMENT,
  `requests_datetime` datetime DEFAULT NULL,
  `requests_total_cost` decimal(10,2) DEFAULT NULL,
  `requests_pay_method` int DEFAULT NULL,
  `requests_table` int DEFAULT NULL,
  PRIMARY KEY (`requests_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests_items`
--

DROP TABLE IF EXISTS `requests_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `requests_items` (
  `requests_id_fk` int DEFAULT NULL,
  `menu_items_id_fk` int DEFAULT NULL,
  `menu_items_quantity` int DEFAULT NULL,
  KEY `requests_id_fk` (`requests_id_fk`),
  KEY `menu_items_id_fk` (`menu_items_id_fk`),
  CONSTRAINT `requests_items_ibfk_1` FOREIGN KEY (`requests_id_fk`) REFERENCES `requests` (`requests_id`),
  CONSTRAINT `requests_items_ibfk_2` FOREIGN KEY (`menu_items_id_fk`) REFERENCES `menu_items` (`menu_items_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests_items`
--

LOCK TABLES `requests_items` WRITE;
/*!40000 ALTER TABLE `requests_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `requests_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `restaurant_tables`
--

DROP TABLE IF EXISTS `restaurant_tables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `restaurant_tables` (
  `restaurant_tables_id` int NOT NULL AUTO_INCREMENT,
  `restaurant_tables_alias` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`restaurant_tables_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `restaurant_tables`
--

LOCK TABLES `restaurant_tables` WRITE;
/*!40000 ALTER TABLE `restaurant_tables` DISABLE KEYS */;
/*!40000 ALTER TABLE `restaurant_tables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `states` (
  `states_id` int NOT NULL AUTO_INCREMENT,
  `states_text` text,
  PRIMARY KEY (`states_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (1,'Boa noite, posso ajudar?'),(2,'Claro! Segue o nosso cardápio.');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-12 23:00:35
