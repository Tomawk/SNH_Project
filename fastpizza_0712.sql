-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: fastpizza
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

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
-- Table structure for table `bevande_def`
--

DROP TABLE IF EXISTS `bevande_def`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bevande_def` (
  `pizza` varchar(50) NOT NULL,
  `bevanda` varchar(50) NOT NULL,
  `quantita` varchar(50) NOT NULL,
  `totale` float NOT NULL,
  PRIMARY KEY (`pizza`,`bevanda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bevande_def`
--

LOCK TABLES `bevande_def` WRITE;
/*!40000 ALTER TABLE `bevande_def` DISABLE KEYS */;
/*!40000 ALTER TABLE `bevande_def` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bevande_log`
--

DROP TABLE IF EXISTS `bevande_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bevande_log` (
  `pizza` varchar(50) NOT NULL,
  `bevanda` varchar(50) NOT NULL,
  `quantita` varchar(50) NOT NULL,
  `totale` float NOT NULL,
  PRIMARY KEY (`pizza`,`bevanda`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bevande_log`
--

LOCK TABLES `bevande_log` WRITE;
/*!40000 ALTER TABLE `bevande_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `bevande_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `ISBN` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `author` varchar(45) NOT NULL,
  `publication_year` varchar(45) NOT NULL,
  `publisher` varchar(45) NOT NULL,
  `image_url` varchar(300) NOT NULL,
  `genre` varchar(45) NOT NULL,
  `price` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ISBN`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES ('0002005018','Clara Callan','Richard Bruce Wright','2001','HarperFlamingo Canada','http://images.amazon.com/images/P/0002005018.01.LZZZZZZZ.jpg','Novel','11,28'),('0060973129','Decision in Normandy','Carlo D\'Este','1991','HarperPerennial','https://m.media-amazon.com/images/I/61wqP7zupAL._AC_UF1000,1000_QL80_.jpg','History','17,59'),('0195153448','Classical Mythology','Mark P. O. Morford','2002','Oxford University Press','http://images.amazon.com/images/P/0195153448.01.LZZZZZZZ.jpg','History','12,99'),('0374157065','Flu: The Story of the Great Influenza Pandemi','Gina Bari Kolata','1999','Farrar Straus Giroux','http://images.amazon.com/images/P/0374157065.01.LZZZZZZZ.jpg','History','14,37'),('0393045218','The Mummies of Urumchi','E. J. W. Barber','1999','W. W. Norton &amp; Company','http://images.amazon.com/images/P/0393045218.01.LZZZZZZZ.jpg','Archeology','12,37'),('0399135782','The Kitchen God\'s Wife','Amy Tan','1991','Putnam Pub Group','https://m.media-amazon.com/images/W/MEDIAX_792452-T1/images/I/91tsn2tvmsL._AC_UY327_FMwebp_QL65_.jpg','Novel','16,99'),('0425176428','What If?: The World\'s Foremost Military Histo','Robert Cowley','2000','Berkley Publishing Group','http://images.amazon.com/images/P/0425176428.01.LZZZZZZZ.jpg','History','14,74'),('0671870432','PLEADING GUILTY','Scott Turow','1993','Audioworks','http://images.amazon.com/images/P/0671870432.01.LZZZZZZZ.jpg','Thriller','18,54'),('0679425608','Under the Black Flag: The Romance and the Rea','David Cordingly','1996','Random House','https://m.media-amazon.com/images/W/MEDIAX_792452-T1/images/I/71gEhEFI90L._AC_UY327_FMwebp_QL65_.jpg','History','14,65'),('074322678X','Where You\'ll Find Me: And Other Stories','Ann Beattie','2002','Scribner','http://images.amazon.com/images/P/074322678X.01.LZZZZZZZ.jpg','Short Stories','12,31'),('0771074670','Nights Below Station Street','David Adams Richards','1988','Emblem Editions','http://images.amazon.com/images/P/0771074670.01.LZZZZZZZ.jpg','Novel','9,55');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredienti_def`
--

DROP TABLE IF EXISTS `ingredienti_def`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredienti_def` (
  `pizza` varchar(50) NOT NULL,
  `ingrediente` varchar(50) NOT NULL,
  `costo` float NOT NULL,
  PRIMARY KEY (`pizza`,`ingrediente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredienti_def`
--

LOCK TABLES `ingredienti_def` WRITE;
/*!40000 ALTER TABLE `ingredienti_def` DISABLE KEYS */;
/*!40000 ALTER TABLE `ingredienti_def` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingredienti_log`
--

DROP TABLE IF EXISTS `ingredienti_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ingredienti_log` (
  `pizza` varchar(50) NOT NULL,
  `ingrediente` varchar(50) NOT NULL,
  `costo` float NOT NULL,
  PRIMARY KEY (`pizza`,`ingrediente`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingredienti_log`
--

LOCK TABLES `ingredienti_log` WRITE;
/*!40000 ALTER TABLE `ingredienti_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `ingredienti_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordini_def`
--

DROP TABLE IF EXISTS `ordini_def`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ordini_def` (
  `codordine` varchar(50) NOT NULL,
  `utente` varchar(50) NOT NULL,
  `totale_ordine` float NOT NULL DEFAULT 0,
  `data_pagamento` date NOT NULL,
  PRIMARY KEY (`codordine`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordini_def`
--

LOCK TABLES `ordini_def` WRITE;
/*!40000 ALTER TABLE `ordini_def` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordini_def` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ordini_log`
--

DROP TABLE IF EXISTS `ordini_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ordini_log` (
  `codordine` int(11) NOT NULL AUTO_INCREMENT,
  `utente` varchar(50) NOT NULL,
  `pizza` varchar(50) NOT NULL,
  `totale` float NOT NULL DEFAULT 0,
  `data` date NOT NULL,
  PRIMARY KEY (`codordine`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ordini_log`
--

LOCK TABLES `ordini_log` WRITE;
/*!40000 ALTER TABLE `ordini_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `ordini_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pizzacustom_def`
--

DROP TABLE IF EXISTS `pizzacustom_def`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pizzacustom_def` (
  `codordine` varchar(50) NOT NULL,
  `idpizza` varchar(50) NOT NULL,
  `impasto` varchar(50) NOT NULL,
  `salsa` varchar(50) DEFAULT NULL,
  `formaggio` varchar(50) DEFAULT NULL,
  `costo` float NOT NULL,
  PRIMARY KEY (`idpizza`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pizzacustom_def`
--

LOCK TABLES `pizzacustom_def` WRITE;
/*!40000 ALTER TABLE `pizzacustom_def` DISABLE KEYS */;
/*!40000 ALTER TABLE `pizzacustom_def` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pizzacustom_log`
--

DROP TABLE IF EXISTS `pizzacustom_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pizzacustom_log` (
  `idpizza` varchar(50) NOT NULL,
  `impasto` varchar(50) NOT NULL,
  `salsa` varchar(50) DEFAULT NULL,
  `formaggio` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idpizza`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pizzacustom_log`
--

LOCK TABLES `pizzacustom_log` WRITE;
/*!40000 ALTER TABLE `pizzacustom_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `pizzacustom_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prenotazioni`
--

DROP TABLE IF EXISTS `prenotazioni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prenotazioni` (
  `nome` varchar(50) NOT NULL,
  `data` date NOT NULL,
  `orario` varchar(50) NOT NULL,
  `numpersone` int(11) NOT NULL,
  PRIMARY KEY (`nome`,`data`,`orario`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prenotazioni`
--

LOCK TABLES `prenotazioni` WRITE;
/*!40000 ALTER TABLE `prenotazioni` DISABLE KEYS */;
/*!40000 ALTER TABLE `prenotazioni` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `citta` varchar(50) NOT NULL,
  `indirizzo` varchar(50) NOT NULL,
  `cap` varchar(50) NOT NULL,
  `trn_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'giorgi.tommaso98@gmail.com','Tommaso','Giorgi','User1','e587466319da83fe4bdf4ceae9746357','Livorno','ucci 42, 12346, fgj , It','12346','2023-12-06');
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

-- Dump completed on 2023-12-07 19:44:12
