-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 14. Sep 2013 um 15:10
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

--
-- Daten für Tabelle `collabmessages`
--

INSERT INTO `collabmessages` (`id`, `timestamp`, `absender`, `collab`, `message`, `censored`) VALUES
(1, 1372610993, 'webdesigner97', 2, '<p>Hallo?</p>', 1),
(2, 1373024940, 'webdesigner97', 2, '<p>Hallo</p>', 1),
(3, 1376044563, 'webdesigner97', 2, '<p><img src="scripts/tinymce/plugins/emoticons/img/smiley-smile.gif" alt="" /></p>', 1),
(4, 1376045008, 'webdesigner97', 2, '<p>Hallo,</p>\r\n<p>das hier ist eine <strong>Demonachricht</strong>, die <span style="text-decoration: underline;">eigentlich</span> <em>keinen</em> Inhalt hat.</p>\r\n<p>&nbsp;</p>\r\n<p><img src="https://www.google.de/images/srpr/logo4w.png" alt="Google" /></p>\r\n<p>&nbsp;</p>\r\n<p><a href="javascript: showsbpopup(11651684);"><img style="max-width: 387px; max-height: 387px; min-width: 482px; cursor: pointer;" src="img/sbplayer.php?id=11651684" alt="" width="482" height="387" /></a></p>', 1),
(5, 1376045070, 'webdesigner97', 2, '<p><img src="http://www.fertighaus-weiss.de/memoDATA/images/haeuser/8/9/1/0/0/0/0/haus_thumb1_eckle_aussen01.jpg" alt="" /></p>', 1),
(6, 1376055691, 'webdesigner97', 2, '<p><a href="javascript: showsbpopup(1594959);"><img style="max-width: 387px; max-height: 387px; min-width: 482px; cursor: pointer;" src="img/sbplayer.php?id=1594959" alt="" width="482" height="387" /></a></p>', 1),
(7, 1376056047, 'webdesigner97', 2, '<p><a href="javascript: showsbpopup(1);"><img style="max-width: 387px; max-height: 387px; min-width: 482px; cursor: pointer;" src="img/sbplayer.php?id=1" alt="" width="482" height="387" /></a></p>', 1),
(8, 1376058226, 'webdesigner97', 2, '<p><a href="javascript: showsbpopup(11618356);"><img style="max-width: 387px; max-height: 387px; min-width: 482px; cursor: pointer;" src="img/sbplayer.php?id=11618356" alt="" width="482" height="387" /></a></p>', 1),
(9, 1376512574, 'webdesigner97', 2, '<p><a href="javascript: showsbpopup(10449621);"><img style="max-width: 387px; max-height: 387px; min-width: 482px; cursor: pointer;" src="img/sbplayer.php?id=10449621" alt="" width="482" height="387" /></a></p>', 1),
(10, 1376926931, 'webdesigner97', 2, '<p><img src="scripts/tinymce/plugins/emoticons/img/smiley-tongue-out.gif" alt="" /></p>', 1),
(11, 1378403919, 'webdesigner97', 2, '<p><a href="javascript: showsbpopup(11704649);"><img style="max-width: 387px; max-height: 387px; min-width: 482px; cursor: pointer;" src="img/sbplayer.php?id=11704649" alt="" width="482" height="387" /></a></p>', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `collabs`
--

CREATE TABLE IF NOT EXISTS `collabs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `desc` text NOT NULL,
  `mitglieder` text NOT NULL,
  `status` char(20) NOT NULL DEFAULT 'open',
  `logo` char(100) NOT NULL DEFAULT 'none.png',
  `start` char(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `collabs`
--

INSERT INTO `collabs` (`id`, `name`, `desc`, `mitglieder`, `status`, `logo`, `start`) VALUES
(1, 'Das erste Collab', 'Die ist das allererste Collab im neuen CollabPortal. Hoffentlich wird alles klappen!', 'a:2:{s:7:"founder";s:13:"MaxMustermann";s:6:"people";a:1:{i:0;s:13:"webdesigner97";}}', 'open', 'none.png', '1368622874'),
(2, 'Erbeereis 4ever', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean metus sem, bibendum eu pretium at, accumsan ut ante. Donec interdum suscipit egestas. Nulla facilisi. Aenean lobortis mattis ante vitae egestas. Nulla ut neque laoreet risus gravida pellentesque. Vestibulum consequat, urna non elementum pharetra, lacus sem elementum turpis, sed dictum nunc odio vel ipsum. Nam eget diam ac augue ultrices facilisis. Aliquam consectetur, nisl at aliquam feugiat, mauris sem aliquam velit, eget fermentum orci nibh nec ligula. Duis eleifend, ligula ut ultrices imperdiet, lectus justo bibendum velit, sed tincidunt turpis quam sit amet nisi. Aliquam molestie nibh nec urna congue ac ullamcorper turpis suscipit. Aliquam sagittis consequat risus, non aliquet massa varius eu. Ut ante nunc, eleifend sit amet lobortis in, hendrerit non lorem. Quisque et tempus neque. Proin mattis, lectus id luctus feugiat, risus lorem porta risus, sagittis iaculis leo enim eget dui. Cras mauris velit, rhoncus sed metus', 'a:2:{s:7:"founder";s:13:"MaxMustermann";s:6:"people";a:1:{i:0;s:13:"webdesigner97";}}', 'open', '1.png', '1358111111');

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

--
-- Daten für Tabelle `featured_collab`
--

INSERT INTO `featured_collab` (`name`, `desc`, `img`, `mitglieder`, `url`) VALUES
('TestCollab', 'Dieses Testcollab ist einfach nur wunderbar! Es hat uns sehr viel Spaß gemacht und wir konnten gut miteinander arbeiten!\n\nWir werden auf jeden Fall wieder was zusammen machen!', 'http://cdn.scratch.mit.edu/get_image/project/10076267_240x180.png', 'MaxMustermann,Osterhase,Dirk', 'http://scratch.mit.edu/projects/10076267/');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `name`, `pass`, `mail`, `scratch`) VALUES
(1, 'webdesigner97', '33c64e1df7523d310d74bb836e3d790d', 'Christian_D_97@gmx.de', 'webdesigner97'),
(2, 'dieter', '33c64e1df7523d310d74bb836e3d790d', 'Dieter@t-online.de', 'akhof'),
(3, 'detlef', '33c64e1df7523d310d74bb836e3d790d', 'ich@du.er', 'webdesigner97');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
