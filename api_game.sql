-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 11 déc. 2019 à 13:41
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `api_game`
--

-- --------------------------------------------------------

--
-- Structure de la table `aventurier`
--

DROP TABLE IF EXISTS `aventurier`;
CREATE TABLE IF NOT EXISTS `aventurier` (
  `id_aventurier` int(1) NOT NULL AUTO_INCREMENT,
  `av_pos_x` float DEFAULT NULL,
  `av_pos_y` float DEFAULT NULL,
  `av_pts_vie` float DEFAULT NULL,
  PRIMARY KEY (`id_aventurier`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

DROP TABLE IF EXISTS `joueur`;
CREATE TABLE IF NOT EXISTS `joueur` (
  `id_joueur` int(3) NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fk_joueur_partie` int(3) DEFAULT NULL,
  `fk_joueur_aventurier` int(1) DEFAULT NULL,
  PRIMARY KEY (`id_joueur`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `joueur`
--

INSERT INTO `joueur` (`id_joueur`, `pseudo`, `fk_joueur_partie`, `fk_joueur_aventurier`) VALUES
(1, 'joueur1', 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `monstre`
--

DROP TABLE IF EXISTS `monstre`;
CREATE TABLE IF NOT EXISTS `monstre` (
  `id_monstre` int(2) NOT NULL AUTO_INCREMENT,
  `nom_monstre` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mons_pos_x` float DEFAULT NULL,
  `mons_pos_y` float DEFAULT NULL,
  `mons_pts_vie` float DEFAULT NULL,
  PRIMARY KEY (`id_monstre`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `obstacle`
--

DROP TABLE IF EXISTS `obstacle`;
CREATE TABLE IF NOT EXISTS `obstacle` (
  `id_obstacle` int(1) NOT NULL AUTO_INCREMENT,
  `obs_pos_x` float DEFAULT NULL,
  `obs_pos_y` float DEFAULT NULL,
  PRIMARY KEY (`id_obstacle`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `partie`
--

DROP TABLE IF EXISTS `partie`;
CREATE TABLE IF NOT EXISTS `partie` (
  `id_partie` int(3) NOT NULL AUTO_INCREMENT,
  `nom_partie` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nbr_joueurs` int(1) DEFAULT NULL,
  `joueur1` int(3) DEFAULT NULL,
  `joueur2` int(3) DEFAULT NULL,
  `joueur3` int(3) DEFAULT NULL,
  `joueur4` int(3) DEFAULT NULL,
  PRIMARY KEY (`id_partie`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
