-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Okt 2020 um 18:48
-- Server-Version: 10.4.13-MariaDB
-- PHP-Version: 7.3.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `carmen`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `reservieren`
--

CREATE TABLE `reservieren` (
  `id` int(11) NOT NULL,
  `kundenname` varchar(50) NOT NULL,
  `telefonnummer` text NOT NULL,
  `datum` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `reservieren`
--

INSERT INTO `reservieren` (`id`, `kundenname`, `telefonnummer`, `datum`) VALUES
(22, 'stephan siebelhofer', '06602275532', '11.01.2020 um 10:00Uhr'),
(26, 'Nisa Konuk', '0676333222444', '10.04.2020'),
(21, 'Yavuz Konuk', '066603338844', '02 08 2020 um 20.00 uhr'),
(25, 'Max Mustermann', '066603338844', 'am Samstag 14.00 uhr'),
(24, 'fadime konuk', '067989898989', '11.01.2020 um 10:00Uhr');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `reservieren`
--
ALTER TABLE `reservieren`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `reservieren`
--
ALTER TABLE `reservieren`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
