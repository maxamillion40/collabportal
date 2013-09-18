-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Sep 2013 um 19:44
-- Server Version: 5.5.27
-- PHP-Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `scratchcollabs`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `collabmessages`
--

CREATE TABLE IF NOT EXISTS `collabmessages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` int(11) NOT NULL,
  `absender` char(50) NOT NULL,
  `collab` int(11) NOT NULL,
  `message` text NOT NULL,
  `censored` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `collabs`
--

CREATE TABLE IF NOT EXISTS `collabs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `owner` char(25) NOT NULL,
  `desc` text NOT NULL,
  `mitglieder` text NOT NULL,
  `status` char(20) NOT NULL DEFAULT 'open',
  `logo` char(100) NOT NULL DEFAULT 'none.png',
  `start` char(50) NOT NULL,
  `settings` char(255) NOT NULL DEFAULT 'a:2:{s:11:"members_max";b:0;s:12:"confirm_join";b:0;}',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `featured_collab`
--

CREATE TABLE IF NOT EXISTS `featured_collab` (
  `name` char(30) NOT NULL,
  `desc` char(200) NOT NULL,
  `img` char(255) NOT NULL,
  `mitglieder` char(255) NOT NULL,
  `url` char(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` char(50) NOT NULL,
  `regard` char(50) NOT NULL,
  `read` tinyint(4) NOT NULL DEFAULT '0',
  `sender` char(50) NOT NULL,
  `to` char(50) NOT NULL,
  `msg` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `pass` char(100) NOT NULL,
  `mail` char(100) NOT NULL,
  `scratch` char(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
