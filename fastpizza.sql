SET NAMES latin1; 
DROP DATABASE IF EXISTS `fastpizza`; 
CREATE DATABASE IF NOT EXISTS `fastpizza`; 
USE `fastpizza`; 
SET FOREIGN_KEY_CHECKS = 0; 
SET GLOBAL EVENT_SCHEDULER = ON; 

DROP TABLE IF EXISTS `prenotazioni`; 
CREATE TABLE `prenotazioni` ( 
`nome` VARCHAR(50) NOT NULL, 
`data` DATE NOT NULL, 
`orario` VARCHAR(50) NOT NULL, 
`numpersone` INT(11) NOT NULL,
PRIMARY KEY (`nome`,`data`,`orario`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 

DROP TABLE IF EXISTS `users`; 
CREATE TABLE IF NOT EXISTS `users` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `email` varchar(50) NOT NULL,
 `nome` varchar(50) NOT NULL,
 `cognome` varchar(50) NOT NULL,
 `username` varchar(50) NOT NULL,
 `password` varchar(50) NOT NULL,
 `citta` varchar(50) NOT NULL,
 `indirizzo` varchar(50) NOT NULL,
 `cap` varchar(50) NOT NULL,
 `trn_date` DATE NOT NULL,
 PRIMARY KEY (`id`)
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1; 

DROP TABLE IF EXISTS `pizzacustom_log`; 
CREATE TABLE `pizzacustom_log` ( 
`idpizza` VARCHAR(50) NOT NULL, 
`impasto` VARCHAR(50) NOT NULL, 
`salsa` VARCHAR(50), 
`formaggio` VARCHAR(50),
PRIMARY KEY (`idpizza`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 

DROP TABLE IF EXISTS `ingredienti_log`; 
CREATE TABLE `ingredienti_log` ( 
`pizza` VARCHAR(50) NOT NULL, 
`ingrediente` VARCHAR(50) NOT NULL, 
`costo` FLOAT(11) NOT NULL,
PRIMARY KEY (`pizza`,`ingrediente`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 

DROP TABLE IF EXISTS `bevande_log`; 
CREATE TABLE `bevande_log` ( 
`pizza` VARCHAR(50) NOT NULL, 
`bevanda` VARCHAR(50) NOT NULL, 
`quantita` VARCHAR(50) NOT NULL,
`totale` FLOAT(11) NOT NULL,
PRIMARY KEY (`pizza`,`bevanda`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 

DROP TABLE IF EXISTS `ordini_log`; 
CREATE TABLE `ordini_log` ( 
`codordine` INT(11) NOT NULL AUTO_INCREMENT,
`utente` VARCHAR(50) NOT NULL,  
`pizza` VARCHAR(50) NOT NULL,
`totale` FLOAT(11) NOT NULL DEFAULT 0,
`data` DATE NOT NULL,
PRIMARY KEY (`codordine`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 

DROP TABLE IF EXISTS `ordini_def`; 
CREATE TABLE `ordini_def` ( 
`codordine` VARCHAR(50) NOT NULL,
`utente` VARCHAR(50) NOT NULL,
`totale_ordine` FLOAT(11) NOT NULL DEFAULT 0,
`data_pagamento` DATE NOT NULL,
PRIMARY KEY (`codordine`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS `pizzacustom_def`; 
CREATE TABLE `pizzacustom_def` ( 
`codordine` VARCHAR(50) NOT NULL,
`idpizza` VARCHAR(50) NOT NULL, 
`impasto` VARCHAR(50) NOT NULL, 
`salsa` VARCHAR(50), 
`formaggio` VARCHAR(50),
`costo` FLOAT(11) NOT NULL,
PRIMARY KEY (`idpizza`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 

DROP TABLE IF EXISTS `ingredienti_def`; 
CREATE TABLE `ingredienti_def` ( 
`pizza` VARCHAR(50) NOT NULL, 
`ingrediente` VARCHAR(50) NOT NULL, 
`costo` FLOAT(11) NOT NULL,
PRIMARY KEY (`pizza`,`ingrediente`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 

DROP TABLE IF EXISTS `bevande_def`; 
CREATE TABLE `bevande_def` ( 
`pizza` VARCHAR(50) NOT NULL, 
`bevanda` VARCHAR(50) NOT NULL, 
`quantita` VARCHAR(50) NOT NULL,
`totale` FLOAT(11) NOT NULL,
PRIMARY KEY (`pizza`,`bevanda`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1; 
 