-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 22. Okt 2020 um 18:47
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
(41, 'Fadime Konuk', 'fadime.konuk@stud.fh-campuswien.ac.at', '$2y$10$lDw40Ipvw5ALUcdUS6XMfeEM/2dxMR1vVWoa09xC5rq9Gi5mpInGu', 'bb5e7c7b8de7fda0146a72a21b0fb8fd', 'verified');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `register_user`
--
ALTER TABLE `register_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `register_user`
--
ALTER TABLE `register_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
