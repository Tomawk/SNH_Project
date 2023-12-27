-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Dic 27, 2023 alle 08:57
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookworm`
--
CREATE DATABASE IF NOT EXISTS `bookworm` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bookworm`;

-- --------------------------------------------------------

--
-- Struttura della tabella `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE `books` (
  `ISBN` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `author` varchar(45) NOT NULL,
  `publication_year` varchar(45) NOT NULL,
  `publisher` varchar(45) NOT NULL,
  `image_url` varchar(300) NOT NULL,
  `genre` varchar(45) NOT NULL,
  `price` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `books`
--

INSERT INTO `books` (`ISBN`, `title`, `author`, `publication_year`, `publisher`, `image_url`, `genre`, `price`) VALUES
('0002005018', 'Clara Callan', 'Richard Bruce Wright', '2001', 'HarperFlamingo Canada', 'http://images.amazon.com/images/P/0002005018.01.LZZZZZZZ.jpg', 'Novel', '11.28'),
('0060973129', 'Decision in Normandy', 'Carlo D\'Este', '1991', 'HarperPerennial', 'https://m.media-amazon.com/images/I/61wqP7zupAL._AC_UF1000,1000_QL80_.jpg', 'History', '17.59'),
('0195153448', 'Classical Mythology', 'Mark P. O. Morford', '2002', 'Oxford University Press', 'http://images.amazon.com/images/P/0195153448.01.LZZZZZZZ.jpg', 'History', '12.99'),
('0374157065', 'Flu: The Story of the Great Influenza Pandemi', 'Gina Bari Kolata', '1999', 'Farrar Straus Giroux', 'http://images.amazon.com/images/P/0374157065.01.LZZZZZZZ.jpg', 'History', '14.37'),
('0393045218', 'The Mummies of Urumchi', 'E. J. W. Barber', '1999', 'W. W. Norton &amp; Company', 'http://images.amazon.com/images/P/0393045218.01.LZZZZZZZ.jpg', 'Archeology', '12.37'),
('0399135782', 'The Kitchen God\'s Wife', 'Amy Tan', '1991', 'Putnam Pub Group', 'https://m.media-amazon.com/images/W/MEDIAX_792452-T1/images/I/91tsn2tvmsL._AC_UY327_FMwebp_QL65_.jpg', 'Novel', '16.99'),
('0425176428', 'What If?: The World\'s Foremost Military Histo', 'Robert Cowley', '2000', 'Berkley Publishing Group', 'http://images.amazon.com/images/P/0425176428.01.LZZZZZZZ.jpg', 'History', '14.74'),
('0671870432', 'PLEADING GUILTY', 'Scott Turow', '1993', 'Audioworks', 'http://images.amazon.com/images/P/0671870432.01.LZZZZZZZ.jpg', 'Thriller', '18.54'),
('0679425608', 'Under the Black Flag: The Romance and the Rea', 'David Cordingly', '1996', 'Random House', 'https://m.media-amazon.com/images/W/MEDIAX_792452-T1/images/I/71gEhEFI90L._AC_UY327_FMwebp_QL65_.jpg', 'History', '14,65'),
('074322678X', 'Where You\'ll Find Me: And Other Stories', 'Ann Beattie', '2002', 'Scribner', 'http://images.amazon.com/images/P/074322678X.01.LZZZZZZZ.jpg', 'Short Stories', '12,31'),
('0771074670', 'Nights Below Station Street', 'David Adams Richards', '1988', 'Emblem Editions', 'http://images.amazon.com/images/P/0771074670.01.LZZZZZZZ.jpg', 'Novel', '9,55');

-- --------------------------------------------------------

--
-- Struttura della tabella `contenutoordini`
--

DROP TABLE IF EXISTS `contenutoordini`;
CREATE TABLE `contenutoordini` (
  `ISBN` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id` int(11) NOT NULL,
  `numero_item` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `contenutoordini`
--

INSERT INTO `contenutoordini` (`ISBN`, `username`, `id`, `numero_item`) VALUES
('0002005018', 'asd', 12, 2),
('0002005018', 'asd', 13, 1),
('0002005018', 'asd', 16, 11),
('0002005018', 'asd', 18, 1),
('0002005018', 'asd', 19, 1),
('0060973129', 'asd', 16, 12),
('0060973129', 'asd', 21, 1),
('0060973129', 'pol', 22, 1),
('0195153448', 'asd', 16, 11),
('0195153448', 'asd', 17, 1),
('0374157065', 'asd', 16, 4),
('0374157065', 'asd', 20, 1),
('0393045218', 'asd', 16, 2),
('0425176428', 'asd', 16, 2),
('0671870432', 'asd', 16, 1),
('0679425608', 'asd', 16, 1),
('0771074670', 'asd', 16, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

DROP TABLE IF EXISTS `ordini`;
CREATE TABLE `ordini` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `totale` int(11) NOT NULL,
  `stato_ordine` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `indirizzo` varchar(100) DEFAULT NULL,
  `citta` varchar(50) DEFAULT NULL,
  `paese` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ordini`
--

INSERT INTO `ordini` (`id`, `data`, `totale`, `stato_ordine`, `indirizzo`, `citta`, `paese`) VALUES
(16, '2023-12-09', 631, 'NULL', NULL, NULL, NULL),
(17, '2023-12-15', 12, 'NULL', NULL, NULL, NULL),
(18, '2023-12-15', 11, 'NULL', NULL, NULL, NULL),
(19, '2023-12-15', 11, 'NULL', NULL, NULL, NULL),
(20, '2023-12-15', 14, 'NULL', NULL, NULL, NULL),
(21, '2023-12-15', 18, 'shipped', 'asd', 'asd', 'ITA'),
(22, '2023-12-17', 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `salt` varchar(300) NOT NULL,
  `citta` varchar(50) NOT NULL,
  `indirizzo` varchar(50) NOT NULL,
  `cap` varchar(50) NOT NULL,
  `trn_date` date NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `timestamp` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `email`, `nome`, `cognome`, `username`, `password`, `salt`, `citta`, `indirizzo`, `cap`, `trn_date`, `link`, `timestamp`) VALUES
(1, 'gaso98@gmail.com', 'Tommaso', 'Gi', 'User1', 'e587466319da83fe4bdf4ceae9746357', '', 'Livono', 'Viale A It', '12456', '2023-12-06', NULL, NULL),
(2, 'antoninonigro00@gmail.com', 'asd', 'asd', 'asd', '00beb4499afb8a43ca10acd82b6d7bc9', '', 'asd', 'asd', '12345', '2023-12-07', '1736ea2d040a486c376fd27936fe55d9', '1703662260'),
(3, 'bau@bau.com', 'bau', 'bau', 'bau', 'ff3a6178371203a3b010f6d99df3f8c0', '', 'bau', 'bau', '12345', '2023-12-10', NULL, NULL),
(4, 'qwe@qweq.com', 'qwe', 'qwe', 'qwe', 'f388a1ddfab8eee2592069488de5370e', '', 'qwe', 'qwe', '12345', '2023-12-10', NULL, NULL),
(10, 'pol@pol.it', 'pol', 'pol', 'pol', 'e1fb1890d08437d8669c58481095bc316145ed80392dba5066b60d05e154b2f0', '1c16bdf8d51fa7a786719d95309d74d600c73f92dd8afc09a72978bd5be17db4', 'pol', 'pol', '12345', '2023-12-17', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `user_tokens`
--

DROP TABLE IF EXISTS `user_tokens`;
CREATE TABLE `user_tokens` (
  `id` int(11) NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashed_validator` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expiry` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `selector`, `hashed_validator`, `user_id`, `expiry`) VALUES
(47, 'da2837aee45334272e17d3322e3ed802', '$2y$10$KJoFeOnHJtbG34TCqiRGQu1YhcF2ukwkKEhJ9hdhFLgX6cOtAbw7.', 2, '2024-01-14 18:26:06');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indici per le tabelle `contenutoordini`
--
ALTER TABLE `contenutoordini`
  ADD PRIMARY KEY (`ISBN`,`username`,`id`);

--
-- Indici per le tabelle `ordini`
--
ALTER TABLE `ordini`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `user_tokens`
--
ALTER TABLE `user_tokens`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ordini`
--
ALTER TABLE `ordini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `user_tokens`
--
ALTER TABLE `user_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
