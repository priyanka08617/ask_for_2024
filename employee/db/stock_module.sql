-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: stock_module
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `inventory_transfer`
--

DROP TABLE IF EXISTS `inventory_transfer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_transfer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_of_change` datetime NOT NULL,
  `transfer_initiated_by` int(11) NOT NULL COMMENT 'employee_id',
  `transfer_reason` int(11) NOT NULL COMMENT '1 Sale\r\n2 Sale Return\r\n3 Purchase \r\n4 Purchase Return\r\n5 Scrapped\r\n6 Damaged\r\n7 Lost-in-transit\r\n8 Fraud\r\n9 Assembly\r\n',
  `transfer_reason_supporting_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 Pending\r\n2 Change Applied\r\n3 Discarded',
  `status_remarks` varchar(300) NOT NULL,
  `row_created_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_transfer`
--

LOCK TABLES `inventory_transfer` WRITE;
/*!40000 ALTER TABLE `inventory_transfer` DISABLE KEYS */;
INSERT INTO `inventory_transfer` VALUES (1,'2022-07-18 09:57:11',1,3,5,2,'AAA','2022-07-18 09:57:11'),(2,'2022-07-18 09:57:11',2,1,6,2,'','2022-07-18 09:57:11'),(3,'2022-07-18 13:17:45',6,3,3,2,'a','2022-07-18 13:17:45');
/*!40000 ALTER TABLE `inventory_transfer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventory_transfer_details`
--

DROP TABLE IF EXISTS `inventory_transfer_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory_transfer_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_transfer_id` int(11) NOT NULL,
  `transfer_type` int(11) NOT NULL COMMENT '1 Inward\r\n2 Outward',
  `item_id` int(11) NOT NULL,
  `item_type` int(11) NOT NULL COMMENT '1 Direct Purchase\r\n2 Assembled Product',
  `quantity` int(11) NOT NULL,
  `uom_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 pending\r\n2 active',
  `row_created_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory_transfer_details`
--

LOCK TABLES `inventory_transfer_details` WRITE;
/*!40000 ALTER TABLE `inventory_transfer_details` DISABLE KEYS */;
INSERT INTO `inventory_transfer_details` VALUES (1,1,1,1003,1,200,1,2,'2022-07-18 10:18:39'),(3,1,1,1004,2,100,1,2,'2022-07-18 10:18:39'),(4,2,2,1003,1,50,1,2,'2022-07-18 10:18:39'),(5,2,2,1004,2,80,1,2,'2022-07-18 10:18:39'),(6,3,1,1006,1,500,3,2,'2022-07-18 13:18:15');
/*!40000 ALTER TABLE `inventory_transfer_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_locations`
--

DROP TABLE IF EXISTS `stock_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locations_category_id` int(11) NOT NULL,
  `location_name` varchar(200) NOT NULL,
  `location_address` varchar(200) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `row_created_on` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_locations`
--

LOCK TABLES `stock_locations` WRITE;
/*!40000 ALTER TABLE `stock_locations` DISABLE KEYS */;
INSERT INTO `stock_locations` VALUES (5,2,'Warehouse A','ds','8820019026',1,2022),(6,2,'Warehouse B','BAS','8989898989',1,2022);
/*!40000 ALTER TABLE `stock_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_locations_category`
--

DROP TABLE IF EXISTS `stock_locations_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_locations_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locations_category` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `row_created_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_locations_category`
--

LOCK TABLES `stock_locations_category` WRITE;
/*!40000 ALTER TABLE `stock_locations_category` DISABLE KEYS */;
INSERT INTO `stock_locations_category` VALUES (2,'Warehouse',1,'2022-07-18 15:52:31'),(3,'Store',1,'2022-07-18 15:52:55'),(4,'Assembly Point',1,'2022-07-18 15:53:03');
/*!40000 ALTER TABLE `stock_locations_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stock_transfer_location`
--

DROP TABLE IF EXISTS `stock_transfer_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stock_transfer_location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `inventory_transfer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `transfer_type` int(11) NOT NULL COMMENT '1 inward\r\n2 outward',
  `location_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `row_created_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stock_transfer_location`
--

LOCK TABLES `stock_transfer_location` WRITE;
/*!40000 ALTER TABLE `stock_transfer_location` DISABLE KEYS */;
INSERT INTO `stock_transfer_location` VALUES (3,1,0,0,5,1,'2022-07-18 17:35:06'),(4,2,0,0,6,1,'2022-07-18 17:35:39'),(5,3,0,0,5,1,'2022-07-18 17:35:57');
/*!40000 ALTER TABLE `stock_transfer_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` int(11) NOT NULL,
  `password` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,1);
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

-- Dump completed on 2022-07-18 17:47:05
