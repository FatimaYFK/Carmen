-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 12. Jul 2020 um 22:11
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
(2, 'Cappucino', '7€', 'verfügbar'),
(3, 'Americano', '9€', 'nicht verfügbar'),
(4, 'Espresso', '9€', 'verfügbar'),
(6, 'Macchiato', '7€', 'verfügbar'),
(8, 'Mocha', '7€', 'verfügbar'),
(9, 'Coffee Latte', '7€', 'nicht verfügbar'),
(10, 'Piccolo Latte', '7€', 'verfügbar'),
(11, 'Ristretto', '7€', 'nicht verfügbar'),
(12, 'Affogato', '9€', 'verfügbar'),
(14, 'hotschokolade', '10€', 'verfügbar  (neu)');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `register_user`
--

CREATE TABLE `register_user` (
  `register_user_id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `user_activation_code` varchar(250) NOT NULL,
  `user_email_status` enum('not verified','verified') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `register_user`
--

INSERT INTO `register_user` (`register_user_id`, `user_name`, `user_email`, `user_password`, `user_activation_code`, `user_email_status`) VALUES
(14, 'nisa konuk', 'nisa@gmail.com', '3543513asd3a854sdas', 'c00f0a7ce218d04e33e603a55392eb44\r\n', ''),
(15, 'hira konuk', 'hirakonuk@gmail.com', 'df748574sdfsadfsdfaesd4575', 'c00f0a7casdsf04e33e603b55392eb44\r\n', ''),
(11, 'yapraklar sarmalar', 'yapraklarsamalar@gmail.com', 'xcvcjgujeergtfadfsdfg3250354', 'asdf054sadf54sdf068s4df0684s', ''),
(8, 'yavuz konuk', 'cmdyavuzkonuk@gmail.com', '$2y$10$v2CgDVP7mn9p3Qh03rBUXO/c379hppfM5PwJxdmOPm0RFjuDP8XAy', 'c00f0a7ce218d04e33e603b55392eb44', 'verified'),
(16, 'suayip konuk', 'suayip@gmail.com', 'afsdfasdfgsdfgsdfrasdfsdf', 'c00f0a7ce21sdfsdfe33e603b55392eb44\r\n', ''),
(17, 'ahmet urul', 'ahmet@gmail.com', 'asdfasdfasdfsdfghsdfs', 'c00f0a7ce218dfge33e603b55392eb44\r\n', ''),
(18, 'idris urul', 'idirs@gmail.com', 'asgfsdgfhasdas', 'c00f0a7casdasd4e33e603b55392eb44\r\n', ''),
(19, 'gullu urul', 'gullu@gmail.com', 'eaukdgahsdakhakljsdbaj', 'c00fasdgfg8d04e33e603b55392eb44\r\n', ''),
(20, 'gullu cetinceviz', 'gulucetincezi@gmail.com', 'pojasdkfdkljfsäkljsdf', 'asejaslöekjfsdkljfsdkljfsdkln', 'not verified'),
(21, 'Max Mustermann', 'maxmusterman@gmail.com', '$2y$10$pzGS03aNHrxA9AdVV/na1.cVD7Jk8CtGku8m/Ez7op3EFIHFINI9.', 'ec05fb4d9f662ea77033313e8a74ec38', 'not verified'),
(29, 'Fadime Konuk', 'fadime.konuk@stud.fh-campuswien.ac.at', '$2y$10$aumHz/aot9inyWhB2.BCxeNQKh1xOzE39z2VkInXM54lt.NiEaqQC', '6c6922f10c628f65d6a142b797683243', 'verified');

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
(17, 'sandra yaprakcioooo', '006606666665', '14 05 2020'),
(16, 'lisa xxxx', '0066056565', '10 06 2020'),
(15, 'josef', '066075543545', '02 08 2020');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `produkte`
--
ALTER TABLE `produkte`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `register_user`
--
ALTER TABLE `register_user`
  ADD PRIMARY KEY (`register_user_id`);

--
-- Indizes für die Tabelle `reservieren`
--
ALTER TABLE `reservieren`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `produkte`
--
ALTER TABLE `produkte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT für Tabelle `register_user`
--
ALTER TABLE `register_user`
  MODIFY `register_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT für Tabelle `reservieren`
--
ALTER TABLE `reservieren`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
