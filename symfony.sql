-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 03 Juillet 2015 à 12:18
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `symfony`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `video_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `datePublish` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `content`, `video_id`, `user_id`, `datePublish`) VALUES
(1, 'Super épisode merci', 3, 2, '2015-07-03'),
(2, 'J''avoue quand sheldon meur c''est ouf', 3, 3, '2015-07-03');

-- --------------------------------------------------------

--
-- Structure de la table `serie`
--

CREATE TABLE IF NOT EXISTS `serie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `nbSaisons` int(11) NOT NULL,
  `genre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `annee` longtext COLLATE utf8_unicode_ci NOT NULL,
  `urlImage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Contenu de la table `serie`
--

INSERT INTO `serie` (`id`, `titre`, `nbSaisons`, `genre`, `description`, `annee`, `urlImage`) VALUES
(1, 'Big Bang Theory', 5, 'Drole', 'C''est cool', '2005', 'http://www.radiohead.fr/wp-content/uploads/2015/02/Big-Bang-Theory.jpg'),
(2, 'Game of throne', 35, 'Viole', 'Incest ++ et pire que pornhub', '1850', 'https://draganovkarapatof.files.wordpress.com/2015/03/ned-stark-2.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Contenu de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id`, `login`, `password`, `mail`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'tanguy@gmail.com'),
(2, 'Tanguy', 'd2a550fe0b4de921fc0b371413b3dbdc', 'tng@gmail.com'),
(3, 'Marlene', 'f231c1677b9e5b7fbae89d82b13a364f', 'marl@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

CREATE TABLE IF NOT EXISTS `video` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `serie_id` int(11) NOT NULL,
  `saison` int(11) NOT NULL,
  `episode` int(11) NOT NULL,
  `urlImage` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Contenu de la table `video`
--

INSERT INTO `video` (`id`, `titre`, `url`, `serie_id`, `saison`, `episode`, `urlImage`) VALUES
(1, 'Danse des flammes', 'http://st402.u1.videomega.tv/v/ff937122ab743d877c21cc2359e7f1b0.mp4?st=t947ePIwC5zw7MobaQB3FA&hash=XMPIKQZSR6kbv9_uZxu87A', 2, 5, 10, 'http://awoiaf.westeros.org/images/thumb/0/05/Deaths_of_Lucerys_and_Arrax.jpg/350px-Deaths_of_Lucerys_and_Arrax.jpg'),
(2, 'Episode super', 'https://www.youtube.com/embed/7Muk_Jk9RmM', 0, 2, 4, 'http://img1.wikia.nocookie.net/__cb20111115052028/bigbangtheory/images/9/91/THE-BIG-BANG-THEORY-The-Flaming-Spittoon-Acquisition-Season-5-Episode-10-6.jpg'),
(3, 'Episode super', 'https://www.youtube.com/embed/7Muk_Jk9RmM', 1, 2, 4, 'http://img1.wikia.nocookie.net/__cb20111115052028/bigbangtheory/images/9/91/THE-BIG-BANG-THEORY-The-Flaming-Spittoon-Acquisition-Season-5-Episode-10-6.jpg'),
(4, 'Sheldon est cool', 'https://www.youtube.com/embed/YQMhrVSR6X0', 1, 1, 2, 'http://img1.wikia.nocookie.net/__cb20111115052028/bigbangtheory/images/9/91/THE-BIG-BANG-THEORY-The-Flaming-Spittoon-Acquisition-Season-5-Episode-10-6.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
