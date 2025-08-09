-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: restaurante
-- ------------------------------------------------------
-- Server version	8.0.42

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
-- Table structure for table `pratos`
--

DROP TABLE IF EXISTS `pratos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pratos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `tempo_preparo` int NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `tipo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pratos`
--

LOCK TABLES `pratos` WRITE;
/*!40000 ALTER TABLE `pratos` DISABLE KEYS */;
INSERT INTO `pratos` VALUES (1,'Lasanha Bolonhesa','Massa recheada com carne moída e molho branco.',45,35.90,'salgado'),(2,'Filé de Frango Grelhado','Acompanha arroz, feijão e salada.',25,28.50,'salgado'),(3,'Risoto de Cogumelos','Risoto cremoso com cogumelos frescos.',40,42.00,'salgado'),(4,'Hambúrguer Artesanal','Pão artesanal, hambúrguer 180g, queijo e bacon.',20,29.90,'salgado'),(29,'Cachorro Quente','Pão, salsicha, ketchup, batata palha e purê',3,10.90,'salgado'),(32,'Pudim de Leite Condensado','Clássico pudim com calda de caramelo.',180,12.00,'sobremesa'),(33,'Brownie com Sorvete','Brownie de chocolate servido com sorvete de baunilha.',15,16.50,'sobremesa'),(34,'Torta de Limão','Torta gelada com base crocante e cobertura de merengue.',20,14.00,'sobremesa'),(35,'Mousse de Maracujá','Mousse cremosa com calda de maracujá natural.',10,11.50,'sobremesa'),(36,'Tacos Mexicanos','Três tacos recheados com carne, alface e guacamole.',20,27.00,'salgado'),(37,'Camarão ao Alho e Óleo','Camarões salteados no alho com arroz branco.',30,49.00,'salgado'),(38,'Nhoque ao Sugo','Nhoque de batata com molho de tomate fresco.',35,31.00,'salgado'),(39,'Bife à Parmegiana','Bife empanado com queijo e molho, arroz e fritas.',40,36.50,'salgado'),(40,'Pizza Margherita','Molho de tomate, mussarela, tomate e manjericão.',25,33.90,'salgado'),(41,'Yakissoba de Carne','Macarrão oriental com carne e legumes.',30,29.00,'salgado'),(42,'Feijoada','Feijão preto com carnes',90,35.00,'salgado');
/*!40000 ALTER TABLE `pratos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed
