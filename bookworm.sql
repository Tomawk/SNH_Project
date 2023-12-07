-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2023 at 11:26 PM
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
-- Dumping data for table `books`
--

INSERT INTO `books` (`ISBN`, `title`, `author`, `publication_year`, `publisher`, `image_url`, `genre`, `price`) VALUES
('0002005018', 'Clara Callan', 'Richard Bruce Wright', '2001', 'HarperFlamingo Canada', 'http://images.amazon.com/images/P/0002005018.01.LZZZZZZZ.jpg', 'Novel', '11,28'),
('0060973129', 'Decision in Normandy', 'Carlo D\'Este', '1991', 'HarperPerennial', 'https://m.media-amazon.com/images/I/61wqP7zupAL._AC_UF1000,1000_QL80_.jpg', 'History', '17,59'),
('0195153448', 'Classical Mythology', 'Mark P. O. Morford', '2002', 'Oxford University Press', 'http://images.amazon.com/images/P/0195153448.01.LZZZZZZZ.jpg', 'History', '12,99'),
('0374157065', 'Flu: The Story of the Great Influenza Pandemi', 'Gina Bari Kolata', '1999', 'Farrar Straus Giroux', 'http://images.amazon.com/images/P/0374157065.01.LZZZZZZZ.jpg', 'History', '14,37'),
('0393045218', 'The Mummies of Urumchi', 'E. J. W. Barber', '1999', 'W. W. Norton &amp; Company', 'http://images.amazon.com/images/P/0393045218.01.LZZZZZZZ.jpg', 'Archeology', '12,37'),
('0399135782', 'The Kitchen God\'s Wife', 'Amy Tan', '1991', 'Putnam Pub Group', 'https://m.media-amazon.com/images/W/MEDIAX_792452-T1/images/I/91tsn2tvmsL._AC_UY327_FMwebp_QL65_.jpg', 'Novel', '16,99'),
('0425176428', 'What If?: The World\'s Foremost Military Histo', 'Robert Cowley', '2000', 'Berkley Publishing Group', 'http://images.amazon.com/images/P/0425176428.01.LZZZZZZZ.jpg', 'History', '14,74'),
('0671870432', 'PLEADING GUILTY', 'Scott Turow', '1993', 'Audioworks', 'http://images.amazon.com/images/P/0671870432.01.LZZZZZZZ.jpg', 'Thriller', '18,54'),
('0679425608', 'Under the Black Flag: The Romance and the Rea', 'David Cordingly', '1996', 'Random House', 'https://m.media-amazon.com/images/W/MEDIAX_792452-T1/images/I/71gEhEFI90L._AC_UY327_FMwebp_QL65_.jpg', 'History', '14,65'),
('074322678X', 'Where You\'ll Find Me: And Other Stories', 'Ann Beattie', '2002', 'Scribner', 'http://images.amazon.com/images/P/074322678X.01.LZZZZZZZ.jpg', 'Short Stories', '12,31'),
('0771074670', 'Nights Below Station Street', 'David Adams Richards', '1988', 'Emblem Editions', 'http://images.amazon.com/images/P/0771074670.01.LZZZZZZZ.jpg', 'Novel', '9,55');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `nome`, `cognome`, `username`, `password`, `citta`, `indirizzo`, `cap`, `trn_date`) VALUES
(1, 'gaso98@gmail.com', 'Tommaso', 'Gi', 'User1', 'e587466319da83fe4bdf4ceae9746357', 'Livono', 'Viale A It', '12456', '2023-12-06'),
(2, 'asd@asd.com', 'asd', 'asd', 'asd', '01a486ee1dbfae114fb4acd9dba16616', 'asd', 'asd', '12345', '2023-12-07');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
