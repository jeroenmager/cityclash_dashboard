-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 11 sep 2017 om 11:28
-- Serverversie: 5.5.57-MariaDB
-- PHP-versie: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cityclash_db`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Answer`
--

CREATE TABLE `Answer` (
  `idAnswer` int(11) NOT NULL,
  `Text` text,
  `Photo` text,
  `Video` text,
  `Acctive` tinyint(4) DEFAULT '1',
  `User_idUser` int(11) NOT NULL,
  `Question_idQuestion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Event`
--

CREATE TABLE `Event` (
  `idEvent` int(11) NOT NULL,
  `Date_E` datetime DEFAULT NULL,
  `Name_E` varchar(200) DEFAULT NULL,
  `Desc` text,
  `Active` tinyint(4) DEFAULT '1',
  `LocSet_idLocSet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Location`
--

CREATE TABLE `Location` (
  `idLocation` int(11) NOT NULL,
  `latitude` decimal(10,8) NOT NULL,
  `longitude` decimal(10,0) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Desc` text,
  `Active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `Location`
--

INSERT INTO `Location` (`idLocation`, `latitude`, `longitude`, `Name`, `Desc`, `Active`) VALUES
(3, '48.00000000', '512', 'Boekverbranding', NULL, 0),
(6, '53.00000000', '13', 'Kasteel', NULL, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Location_set_location`
--

CREATE TABLE `Location_set_location` (
  `idEvent_Location` int(11) NOT NULL,
  `FK1` int(11) NOT NULL,
  `FK2` int(11) NOT NULL,
  `Datum` datetime NOT NULL,
  `Location_idLocation` int(11) NOT NULL,
  `LocSet_idLocSet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `LocSet`
--

CREATE TABLE `LocSet` (
  `idLocSet` int(11) NOT NULL,
  `Name` varchar(100) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `Active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `Question`
--

CREATE TABLE `Question` (
  `idQuestion` int(11) NOT NULL,
  `Text` text,
  `Photo` text,
  `Video` text,
  `Active` tinyint(4) DEFAULT '1',
  `Location_idLocation` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `results`
--

CREATE TABLE `results` (
  `id` int(11) NOT NULL,
  `questionName` varchar(1024) NOT NULL,
  `answered` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `results`
--

INSERT INTO `results` (`id`, `questionName`, `answered`) VALUES
(1, 'Coca-Cola, Tetris, Sahara, Slakken, Spieren', 'Cocaine, 23, 10%, 2 jaar, Hart'),
(2, 'Coca-Cola, Tetris, Sahara, Slakken, Spieren', 'Hoesselijn, 14, 40%, 2 jaar, Bicep');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `User`
--

CREATE TABLE `User` (
  `idUser` int(11) NOT NULL,
  `Role` int(11) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Active` tinyint(4) NOT NULL DEFAULT '1',
  `Event_idEvent` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `Answer`
--
ALTER TABLE `Answer`
  ADD PRIMARY KEY (`idAnswer`),
  ADD KEY `fk_Answer_User1_idx` (`User_idUser`),
  ADD KEY `fk_Answer_Question1_idx` (`Question_idQuestion`);

--
-- Indexen voor tabel `Event`
--
ALTER TABLE `Event`
  ADD PRIMARY KEY (`idEvent`),
  ADD KEY `fk_Event_LocSet1_idx` (`LocSet_idLocSet`);

--
-- Indexen voor tabel `Location`
--
ALTER TABLE `Location`
  ADD PRIMARY KEY (`idLocation`);

--
-- Indexen voor tabel `Location_set_location`
--
ALTER TABLE `Location_set_location`
  ADD PRIMARY KEY (`idEvent_Location`),
  ADD KEY `fk_Location_set_location_Location1_idx` (`Location_idLocation`),
  ADD KEY `fk_Location_set_location_LocSet1_idx` (`LocSet_idLocSet`);

--
-- Indexen voor tabel `LocSet`
--
ALTER TABLE `LocSet`
  ADD PRIMARY KEY (`idLocSet`);

--
-- Indexen voor tabel `Question`
--
ALTER TABLE `Question`
  ADD PRIMARY KEY (`idQuestion`),
  ADD KEY `fk_Question_Location1_idx` (`Location_idLocation`);

--
-- Indexen voor tabel `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `fk_User_Event_idx` (`Event_idEvent`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `Location`
--
ALTER TABLE `Location`
  MODIFY `idLocation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT voor een tabel `results`
--
ALTER TABLE `results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `Answer`
--
ALTER TABLE `Answer`
  ADD CONSTRAINT `fk_Answer_User1` FOREIGN KEY (`User_idUser`) REFERENCES `User` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Answer_Question1` FOREIGN KEY (`Question_idQuestion`) REFERENCES `Question` (`idQuestion`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `Event`
--
ALTER TABLE `Event`
  ADD CONSTRAINT `fk_Event_LocSet1` FOREIGN KEY (`LocSet_idLocSet`) REFERENCES `LocSet` (`idLocSet`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `Location_set_location`
--
ALTER TABLE `Location_set_location`
  ADD CONSTRAINT `fk_Location_set_location_Location1` FOREIGN KEY (`Location_idLocation`) REFERENCES `Location` (`idLocation`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Location_set_location_LocSet1` FOREIGN KEY (`LocSet_idLocSet`) REFERENCES `LocSet` (`idLocSet`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `Question`
--
ALTER TABLE `Question`
  ADD CONSTRAINT `fk_Question_Location1` FOREIGN KEY (`Location_idLocation`) REFERENCES `Location` (`idLocation`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `fk_User_Event` FOREIGN KEY (`Event_idEvent`) REFERENCES `Event` (`idEvent`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
