-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 17, 2015 at 02:24 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `coffeebase`
--

-- --------------------------------------------------------

--
-- Table structure for table `ankete`
--

CREATE TABLE IF NOT EXISTS `ankete` (
`id_ankete` int(5) NOT NULL,
  `pitanje` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `aktivna` int(1) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `ankete`
--

INSERT INTO `ankete` (`id_ankete`, `pitanje`, `aktivna`) VALUES
(7, 'Do you like website?', 0),
(11, 'Whats your favorite coffee?', 1);

-- --------------------------------------------------------

--
-- Table structure for table `din_meni`
--

CREATE TABLE IF NOT EXISTS `din_meni` (
`id_meni` int(5) NOT NULL,
  `naziv` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `link` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `klasa` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `din_meni`
--

INSERT INTO `din_meni` (`id_meni`, `naziv`, `link`, `klasa`) VALUES
(1, 'home', 'index.php', 'first active'),
(2, 'meni', 'meni.php', 'second'),
(3, 'gallery', 'gallery.php', 'third'),
(4, 'contact', 'contact.php', 'fourth'),
(5, 'login', 'login.php', 'fifth');

-- --------------------------------------------------------

--
-- Table structure for table `galerija`
--

CREATE TABLE IF NOT EXISTS `galerija` (
`id_galerija` int(5) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `putanja_velika` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `putanja_mala` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `galerija`
--

INSERT INTO `galerija` (`id_galerija`, `naziv`, `putanja_velika`, `putanja_mala`) VALUES
(1, 'Coffee', 'gallery/01-big.jpg', 'gallery/01-thumb.jpg'),
(2, 'Coffee', 'gallery/02-big.jpg', 'gallery/02-thumb.jpg'),
(3, 'Coffee', 'gallery/03-big.jpg', 'gallery/03-thumb.jpg'),
(4, 'Coffee', 'gallery/04-big.jpg', 'gallery/04-thumb.jpg'),
(5, 'Coffee', 'gallery/05-big.jpg', 'gallery/05-thumb.jpg'),
(6, 'Coffee', 'gallery/06-big.png', 'gallery/06-thumb.png'),
(7, 'Coffee', 'gallery/07-big.jpg', 'gallery/07-thumb.jpg'),
(8, 'Coffee', 'gallery/08-big.jpg', 'gallery/08-thumb.jpg'),
(9, 'Coffee', 'gallery/01-big.jpg', 'gallery/01-thumb.jpg'),
(16, 'ludilo', 'gallery/1782089_659682974077929_1174308092_n.jpg', 'gallery/malaslika/1782089_659682974077929_1174308092_n.jpg'),
(17, 'lud', 'gallery/1601089_649270625119164_983690126_n.jpg', 'gallery/malaslika/1601089_649270625119164_983690126_n.jpg'),
(18, 'mmm', 'gallery/1376617_613039005408993_1338970672_n.jpg', 'gallery/malaslika/1376617_613039005408993_1338970672_n.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `katalog`
--

CREATE TABLE IF NOT EXISTS `katalog` (
`id_katalog` int(5) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sastav` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cena` double(20,2) NOT NULL,
  `cokolada` varchar(10) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `katalog`
--

INSERT INTO `katalog` (`id_katalog`, `naziv`, `sastav`, `cena`, `cokolada`) VALUES
(1, 'Americana small (150ml)', 'coffee / cream / sugar / cinnamon', 3.50, 'no'),
(2, 'Americana large (250ml)', 'coffee / cream / sugar / cinnamon / chilli', 5.50, 'no'),
(3, 'Darko (300ml)', ' chocolate / bunnies / persian hash', 3.50, 'yes'),
(4, 'Bazinga Coffee (500ml)', ' coffee / dmt / double cream / shrooms / chilli', 9.50, 'no'),
(5, 'Lounge cannabico (300ml)', 'coffee / ganja / tripple bass / brown sugar', 9.50, 'no'),
(6, 'Absinthi (250ml)', ' absinth / chocolate / double sugar', 5.50, 'yes'),
(7, 'Kemp (500ml)', ' double dmt / mushrooms / cannabis / indian arrow', 9.50, 'yes'),
(8, 'I shot the sheriff (300ml)', 'hashish / mistic aroma / god particle / chocolate', 9.50, 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE IF NOT EXISTS `korisnici` (
`id_korisnici` int(5) NOT NULL,
  `ime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `prezime` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lozinka` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `id_uloge` int(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id_korisnici`, `ime`, `prezime`, `username`, `email`, `lozinka`, `id_uloge`) VALUES
(1, 'Vladimir', 'Uskokovic', 'vladimir', 'vladimir.uskokovic.324.13@ict.edu.rs', '17388bbc1c11f4ac5e3f207da7164b12', 1),
(22, 'Mika', 'Mikic', 'mika', 'pera@gmail.com', 'd8795f0d07280328f80e59b1e8414c49', 2),
(23, 'Milena', 'Vesic', 'MilenaVesic', 'milena.vesic@ict.edu.rs', '134efc0136c90a3dc6ad0822efc7d88b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `odgovori`
--

CREATE TABLE IF NOT EXISTS `odgovori` (
`id_odgovori` int(5) NOT NULL,
  `id_ankete` int(5) NOT NULL,
  `odgovori` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `odgovori`
--

INSERT INTO `odgovori` (`id_odgovori`, `id_ankete`, `odgovori`) VALUES
(18, 7, 'This is awesome'),
(19, 7, 'Yeah'),
(20, 7, 'Not bad'),
(21, 7, 'Nah'),
(31, 11, 'Americana small'),
(32, 11, 'Americana large'),
(33, 11, 'Bazinga Coffee'),
(34, 11, 'Lounge cannabico');

-- --------------------------------------------------------

--
-- Table structure for table `rezultat`
--

CREATE TABLE IF NOT EXISTS `rezultat` (
`id_rezultat` int(5) NOT NULL,
  `id_ankete` int(5) NOT NULL,
  `id_odgovori` int(5) NOT NULL,
  `rezultat` int(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `rezultat`
--

INSERT INTO `rezultat` (`id_rezultat`, `id_ankete`, `id_odgovori`, `rezultat`) VALUES
(18, 7, 18, 0),
(19, 7, 19, 0),
(20, 7, 20, 0),
(21, 7, 21, 0),
(31, 11, 31, 4),
(32, 11, 32, 0),
(33, 11, 33, 1),
(34, 11, 34, 0);

-- --------------------------------------------------------

--
-- Table structure for table `uloge`
--

CREATE TABLE IF NOT EXISTS `uloge` (
`id_uloge` int(5) NOT NULL,
  `naziv_uloge` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `uloge`
--

INSERT INTO `uloge` (`id_uloge`, `naziv_uloge`) VALUES
(1, 'admin'),
(2, 'korisnik');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ankete`
--
ALTER TABLE `ankete`
 ADD PRIMARY KEY (`id_ankete`);

--
-- Indexes for table `din_meni`
--
ALTER TABLE `din_meni`
 ADD PRIMARY KEY (`id_meni`);

--
-- Indexes for table `galerija`
--
ALTER TABLE `galerija`
 ADD PRIMARY KEY (`id_galerija`);

--
-- Indexes for table `katalog`
--
ALTER TABLE `katalog`
 ADD PRIMARY KEY (`id_katalog`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
 ADD PRIMARY KEY (`id_korisnici`);

--
-- Indexes for table `odgovori`
--
ALTER TABLE `odgovori`
 ADD PRIMARY KEY (`id_odgovori`);

--
-- Indexes for table `rezultat`
--
ALTER TABLE `rezultat`
 ADD PRIMARY KEY (`id_rezultat`);

--
-- Indexes for table `uloge`
--
ALTER TABLE `uloge`
 ADD PRIMARY KEY (`id_uloge`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ankete`
--
ALTER TABLE `ankete`
MODIFY `id_ankete` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `din_meni`
--
ALTER TABLE `din_meni`
MODIFY `id_meni` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `galerija`
--
ALTER TABLE `galerija`
MODIFY `id_galerija` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `katalog`
--
ALTER TABLE `katalog`
MODIFY `id_katalog` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
MODIFY `id_korisnici` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `odgovori`
--
ALTER TABLE `odgovori`
MODIFY `id_odgovori` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `rezultat`
--
ALTER TABLE `rezultat`
MODIFY `id_rezultat` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `uloge`
--
ALTER TABLE `uloge`
MODIFY `id_uloge` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
