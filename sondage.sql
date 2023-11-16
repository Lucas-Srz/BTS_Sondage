-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 16 nov. 2023 à 14:29
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `sondage`
--

-- --------------------------------------------------------

--
-- Structure de la table `table_login`
--

DROP TABLE IF EXISTS `table_login`;
CREATE TABLE IF NOT EXISTS `table_login` (
  `utilisateur` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `mot_de_passe` varchar(20) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`utilisateur`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `table_login`
--

INSERT INTO `table_login` (`utilisateur`, `mot_de_passe`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Structure de la table `table_sondage`
--

DROP TABLE IF EXISTS `table_sondage`;
CREATE TABLE IF NOT EXISTS `table_sondage` (
  `utilisateur` varchar(50) COLLATE latin1_bin NOT NULL,
  `date_inscription` date NOT NULL,
  `genre` varchar(50) COLLATE latin1_bin NOT NULL,
  `age` varchar(50) COLLATE latin1_bin NOT NULL,
  `lieux` varchar(50) COLLATE latin1_bin NOT NULL,
  `vote` varchar(50) COLLATE latin1_bin NOT NULL,
  PRIMARY KEY (`utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Déchargement des données de la table `table_sondage`
--

INSERT INTO `table_sondage` (`utilisateur`, `date_inscription`, `genre`, `age`, `lieux`, `vote`) VALUES
('Nom_Prenom', '2023-11-16', 'male', '18', '1', 'Oui'),
('Lucas_SUAREZ', '2023-11-16', 'male', '21', '1', 'Non');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
