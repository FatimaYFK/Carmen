-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Okt 2020 um 18:45
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
-- Tabellenstruktur für Tabelle `bestellungen`
--

CREATE TABLE `bestellungen` (
  `id` int(11) NOT NULL,
  `kundenname` varchar(50) NOT NULL,
  `menge` text NOT NULL,
  `kundenadresse` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `bestellungen`
--

INSERT INTO `bestellungen` (`id`, `kundenname`, `menge`, `kundenadresse`) VALUES
(18, 'fadime', '2kg', 'simmering 1110 wien');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `produkte`
--

CREATE TABLE `produkte` (
  `id` int(11) NOT NULL,
  `kaffee` varchar(50) NOT NULL,
  `preis` text NOT NULL,
  `lagerbestand` text CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `produkte`
--

INSERT INTO `produkte` (`id`, `kaffee`, `preis`, `lagerbestand`) VALUES
(3, 'Americano', '90€', 'verfügbar'),
(4, 'Espressoyy', '9€', 'verfügbar'),
(8, 'Mocha', '7€', 'verfügbar'),
(9, 'Coffee Latte', '7€', 'nicht verfügbar'),
(10, 'Piccolo Latte', '7€', 'verfügbar'),
(11, 'Ristretto', '7€', 'nicht verfügbar'),
(12, 'Affogato', '9€', 'verfügbar'),
(17, 'coffee', '5€', 'verfügbar'),
(22, 'Türkisches Kaffee', '5€', 'nicht verfügbar');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `register_user`
--

CREATE TABLE `register_user` (
  `id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `user_activation_code` varchar(250) NOT NULL,
  `user_email_status` enum('not verified','verified') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `register_user`
--

INSERT INTO `register_user` (`id`, `user_name`, `user_email`, `user_password`, `user_activation_code`, `user_email_status`) VALUES
(8, 'yavuz konuk', 'cmdyavuzkonuk@gmail.com', '$2y$10$v2CgDVP7mn9p3Qh03rBUXO/c379hppfM5PwJxdmOPm0RFjuDP8XAy', 'c00f0a7ce218d04e33e603b55392eb44', 'verified'),
(45, 'Fadime Konuk', 'fykonuk@gmail.com', '$2y$10$dnd.X62N2va6vBfrVNMnK.gZCpNogsu6I7oN9N/0dvxVdx/p/wxBi', '4e8192f7b595e326f05db7a924413890', 'verified'),
(41, 'Fadime Konuk', 'fadime.konuk@stud.fh-campuswien.ac.at', '$2y$10$lDw40Ipvw5ALUcdUS6XMfeEM/2dxMR1vVWoa09xC5rq9Gi5mpInGu', 'bb5e7c7b8de7fda0146a72a21b0fb8fd', 'verified');

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
-- Indizes für die Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `produkte`
--
ALTER TABLE `produkte`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `register_user`
--
ALTER TABLE `register_user`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `reservieren`
--
ALTER TABLE `reservieren`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bestellungen`
--
ALTER TABLE `bestellungen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT für Tabelle `produkte`
--
ALTER TABLE `produkte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT für Tabelle `register_user`
--
ALTER TABLE `register_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT für Tabelle `reservieren`
--
ALTER TABLE `reservieren`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
