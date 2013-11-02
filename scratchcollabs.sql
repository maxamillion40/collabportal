-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 02. Nov 2013 um 16:10
-- Server Version: 5.5.32
-- PHP-Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `scratchcollabs`
--
CREATE DATABASE IF NOT EXISTS `scratchcollabs` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `scratchcollabs`;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` int(11) NOT NULL,
  `question` char(255) NOT NULL,
  `answer` char(255) NOT NULL DEFAULT 'unbeantwortet',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pic` char(25) NOT NULL,
  `date` int(11) NOT NULL,
  `headline` char(100) NOT NULL,
  `msg` char(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
