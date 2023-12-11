-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 01:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
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

--
-- Truncate table before insert `books`
--

TRUNCATE TABLE `books`;
--
-- Dumping data for table `books`
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
-- Table structure for table `contenutoordini`
--

DROP TABLE IF EXISTS `contenutoordini`;
CREATE TABLE IF NOT EXISTS `contenutoordini` (
  `ISBN` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `username` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `id` int(11) NOT NULL,
  `numero_item` int(11) NOT NULL,
  PRIMARY KEY (`ISBN`,`username`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `contenutoordini`
--

TRUNCATE TABLE `contenutoordini`;
--
-- Dumping data for table `contenutoordini`
--

INSERT INTO `contenutoordini` (`ISBN`, `username`, `id`, `numero_item`) VALUES
('0002005018', 'asd', 12, 2),
('0002005018', 'asd', 13, 1),
('0002005018', 'asd', 16, 8),
('0060973129', 'asd', 16, 4),
('0195153448', 'asd', 16, 7),
('0374157065', 'asd', 16, 2),
('0393045218', 'asd', 16, 2),
('0425176428', 'asd', 16, 2),
('0671870432', 'asd', 16, 1),
('0679425608', 'asd', 16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordini`
--

DROP TABLE IF EXISTS `ordini`;
CREATE TABLE IF NOT EXISTS `ordini` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date NOT NULL,
  `totale` int(11) NOT NULL,
  `stato_ordine` varchar(45) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `ordini`
--

TRUNCATE TABLE `ordini`;
--
-- Dumping data for table `ordini`
--

INSERT INTO `ordini` (`id`, `data`, `totale`, `stato_ordine`) VALUES
(16, '2023-12-09', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

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
  `trn_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `nome`, `cognome`, `username`, `password`, `citta`, `indirizzo`, `cap`, `trn_date`) VALUES
(1, 'gaso98@gmail.com', 'Tommaso', 'Gi', 'User1', 'e587466319da83fe4bdf4ceae9746357', 'Livono', 'Viale A It', '12456', '2023-12-06'),
(2, 'asd@asd.com', 'asd', 'asd', 'asd', '7815696ecbf1c96e6894b779456d330e', 'asd', 'asd', '12345', '2023-12-07'),
(3, 'bau@bau.com', 'bau', 'bau', 'bau', 'ff3a6178371203a3b010f6d99df3f8c0', 'bau', 'bau', '12345', '2023-12-10'),
(4, 'qwe@qweq.com', 'qwe', 'qwe', 'qwe', 'f388a1ddfab8eee2592069488de5370e', 'qwe', 'qwe', '12345', '2023-12-10');

-- --------------------------------------------------------

--
-- Table structure for table `user_tokens`
--

DROP TABLE IF EXISTS `user_tokens`;
CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `selector` varchar(255) NOT NULL,
  `hashed_validator` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `expiry` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `user_tokens`
--

TRUNCATE TABLE `user_tokens`;
--
-- Dumping data for table `user_tokens`
--

INSERT INTO `user_tokens` (`id`, `selector`, `hashed_validator`, `user_id`, `expiry`) VALUES
(1, 'ccbdfbe9c214320c00b24ccaefa4fe06', '$2y$10$k36r96bdP3xb0E6GpI0Yue2nOusu5h96vZPe5jjpdodpXtOY2rwLS', 4, '2024-01-09 17:49:44'),
(2, '63e101d35f085dc08c9f211c22d977e3', '$2y$10$josw8w/8JQKPjODDf3SmBuLW7lUq7PmmFQOpLz5FmtPxhcVqdLN3K', 4, '2024-01-09 18:05:47'),
(3, '85c707d0a9286ee28de6d07ffec2bc1d', '$2y$10$UL29jbkhOONSXRgSDEGoIeAbkFnhXHpMW2I7cW5yxJyI3JIkv7BxC', 2, '2024-01-10 01:09:37'),
(4, '83fcab543220b850fe2fe725efe1058b', '$2y$10$zl3KefRKMr9kK5GSo3rmVu159ySJRyimXu.ZM4lB67uAlKbGBDnsC', 2, '2024-01-10 01:16:53'),
(5, 'c9be20a39338bc878c56b7c6a2e9da0a', '$2y$10$kueiql5QNe0Ft53IeShe5etlywWEWiwjf8ezmqZq5.1pXPUPmk0d.', 2, '2024-01-10 01:17:51'),
(6, 'c6356c439c2a11a04fd56ffaf9ce108b', '$2y$10$cROEZG5atkwFMStuLe5jmOwwTwJCoQZfIksL0XN9gIC68Eg9FKwW2', 2, '2024-01-10 01:22:58'),
(7, 'b19ca3f4e5a6772737d009bd651ec1e5', '$2y$10$.SjqMpyXm3NjEe7FbKqZaOjPFRFuX7rj0U5UEJ/Fr0/7kkWOPvaDC', 2, '2024-01-10 01:34:17'),
(8, '8898f9a0afb70f08f0809bd5e520e2fb', '$2y$10$GzMtotaATbZl5P5mV0047.m9fg2hlTsxP1tcpQ5QlBQXQr2HFPp/G', 2, '2024-01-10 01:44:53');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
