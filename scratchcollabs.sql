-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 06. Feb 2014 um 14:29
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
  `internalID` int(11) NOT NULL,
  `timestamp` int(11) NOT NULL,
  `absender` char(50) NOT NULL,
  `collab` int(11) NOT NULL,
  `message` text NOT NULL,
  `censored` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

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
  `settings` char(255) NOT NULL DEFAULT ' a:4:{s:11:"members_max";b:0;s:12:"confirm_join";b:0;s:11:"new_members";b:1;s:8:"language";s:5:"en_US";}',
  `announcement` char(200) NOT NULL,
  `pid` char(20) NOT NULL,
  `lastInternalID` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `featured_collab`
--

CREATE TABLE IF NOT EXISTS `featured_collab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL,
  `desc` char(200) NOT NULL,
  `img` char(255) NOT NULL,
  `mitglieder` char(255) NOT NULL,
  `url` char(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `language` char(10) NOT NULL DEFAULT 'en_US',
  `pass` char(100) NOT NULL,
  `mail` char(100) NOT NULL,
  `scratch` char(100) NOT NULL,
  `class` char(30) NOT NULL DEFAULT 'user',
  `last_login` int(11) NOT NULL,
  `last_ip` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
