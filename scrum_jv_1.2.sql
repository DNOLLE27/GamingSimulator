-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 16 nov. 2022 à 10:47
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `scrum_jv`
--

-- --------------------------------------------------------

--
-- Structure de la table `console`
--

DROP TABLE IF EXISTS `console`;
CREATE TABLE IF NOT EXISTS `console` (
  `idCons` int(11) NOT NULL AUTO_INCREMENT,
  `nomCons` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `marqueCons` int(11) NOT NULL,
  PRIMARY KEY (`idCons`),
  KEY `FK1` (`marqueCons`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `console`
--

INSERT INTO `console` (`idCons`, `nomCons`, `marqueCons`) VALUES
(1, 'PS5', 1),
(2, 'PS4', 1),
(3, 'Nintendo Switch', 2),
(4, 'iPhone', 4),
(5, 'Androïd', 5),
(6, 'Wii U', 2),
(7, 'PC', 6);

-- --------------------------------------------------------

--
-- Structure de la table `droit`
--

DROP TABLE IF EXISTS `droit`;
CREATE TABLE IF NOT EXISTS `droit` (
  `idDroit` int(11) NOT NULL AUTO_INCREMENT,
  `libelleDroit` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`idDroit`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `droit`
--

INSERT INTO `droit` (`idDroit`, `libelleDroit`) VALUES
(1, 'utilisateur'),
(2, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

DROP TABLE IF EXISTS `etat`;
CREATE TABLE IF NOT EXISTS `etat` (
  `idEtat` int(11) NOT NULL AUTO_INCREMENT,
  `libelleEtat` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `descriptionEtat` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`idEtat`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`idEtat`, `libelleEtat`, `descriptionEtat`) VALUES
(1, 'Complet', 'boite + livre'),
(2, 'Partiel', 'boite ou livre manquant'),
(3, 'Incomplet', 'boite et livre manquants'),
(4, 'Demat', 'Dématérialisé');

-- --------------------------------------------------------

--
-- Structure de la table `jeux`
--

DROP TABLE IF EXISTS `jeux`;
CREATE TABLE IF NOT EXISTS `jeux` (
  `idJeux` int(11) NOT NULL AUTO_INCREMENT,
  `nomJeux` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `imageJeux` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `consoleJeux` int(11) NOT NULL,
  `etatJeux` int(11) NOT NULL,
  PRIMARY KEY (`idJeux`),
  KEY `FK1` (`consoleJeux`),
  KEY `FK2` (`etatJeux`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `jeux`
--

INSERT INTO `jeux` (`idJeux`, `nomJeux`, `imageJeux`, `consoleJeux`, `etatJeux`) VALUES
(1, 'Demon\'s souls remastered', NULL, 1, 1),
(2, 'Elden Ring', NULL, 1, 1),
(3, 'Dark souls remastered', NULL, 2, 2),
(4, 'Dark souls II Scholar of the first sin', NULL, 2, 1),
(5, 'Dark souls 3', NULL, 2, 3),
(6, 'Bloodborne', NULL, 2, 1),
(7, 'Sekiro Shadows Die Twice', NULL, 2, 2),
(8, 'Super Smash Bros Ultimate', NULL, 3, 1),
(9, 'Xenoblade Chronicles Definitive Edition', NULL, 3, 1),
(10, 'Xenoblade Chronicles X', NULL, 6, 3),
(11, 'Xenoblade Chronicles 2', NULL, 3, 2),
(12, 'Xenoblade Chronicles 3', NULL, 3, 1),
(13, 'Tetris 99', NULL, 3, 4),
(14, 'Genshin Impact', NULL, 4, 4),
(15, 'Minecraft', NULL, 7, 4),
(16, 'Fire Emblem Three Houses', NULL, 3, 2),
(17, 'Pokemon Epee', NULL, 3, 3),
(18, 'GTA V', NULL, 2, 1),
(19, 'The Legend of Zelda Breath of The Wild', NULL, 3, 2),
(20, 'Nioh', NULL, 2, 1),
(21, 'Nioh 2', NULL, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

DROP TABLE IF EXISTS `marque`;
CREATE TABLE IF NOT EXISTS `marque` (
  `idMarque` int(11) NOT NULL AUTO_INCREMENT,
  `libelleMarque` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`idMarque`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`idMarque`, `libelleMarque`) VALUES
(1, 'Sony'),
(2, 'Nintendo'),
(3, 'Microsoft'),
(4, 'Apple'),
(5, 'Google'),
(6, 'Windows');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `mailUser` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `mdpUser` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `droitUser` int(11) NOT NULL,
  PRIMARY KEY (`idUser`),
  KEY `FK1` (`droitUser`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
