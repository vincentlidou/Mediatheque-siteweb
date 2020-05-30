-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 30, 2020 at 04:25 PM
-- Server version: 5.7.26
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mediatheque`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `Id_Admin` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Identifiant_Admin` varchar(25) DEFAULT NULL,
  `Mot_De_Passe_Admin` varchar(25) DEFAULT NULL,
  `Nom_Admin` varchar(25) DEFAULT NULL,
  `Prenom_Admin` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`Id_Admin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `administrateur`
--

INSERT INTO `administrateur` (`Id_Admin`, `Identifiant_Admin`, `Mot_De_Passe_Admin`, `Nom_Admin`, `Prenom_Admin`) VALUES
(1, 'coucou', 'test', 'test', 'test'),
(2, 'jacques', 'test', 'test', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `auteur`
--

DROP TABLE IF EXISTS `auteur`;
CREATE TABLE IF NOT EXISTS `auteur` (
  `Id_Auteur` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nom_Auteur` varchar(25) DEFAULT NULL,
  `Prenom_Auteur` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`Id_Auteur`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auteur`
--

INSERT INTO `auteur` (`Id_Auteur`, `Nom_Auteur`, `Prenom_Auteur`) VALUES
(1, 'Huxley', 'Aldous'),
(2, 'Wells', 'H.G'),
(3, 'Goethe', 'Johann Wolfgang'),
(4, 'Tolkien', 'J.R.R'),
(5, 'Steinbeck', 'John'),
(6, 'Saint-Exupéry', 'Antoine'),
(7, 'Palahniuk', 'Chuck'),
(8, 'Musset', 'Alfred'),
(9, 'Beauvoir', 'Simone'),
(10, 'Malraux', 'André'),
(11, 'Maalouf', 'Amin');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `Id_Categorie` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nom_Categorie` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`Id_Categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`Id_Categorie`, `Nom_Categorie`) VALUES
(1, 'Horreur'),
(2, 'Policier'),
(4, 'Historique'),
(5, 'Roman'),
(6, 'Aventure'),
(8, 'Société');

-- --------------------------------------------------------

--
-- Table structure for table `consulte`
--

DROP TABLE IF EXISTS `consulte`;
CREATE TABLE IF NOT EXISTS `consulte` (
  `Id_Visiteur` int(10) UNSIGNED NOT NULL,
  `Id_Livre` smallint(5) UNSIGNED NOT NULL,
  `Chrono_Tag_Consulte` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_Visiteur`,`Id_Livre`),
  KEY `FK_Consulte_Id_Livre` (`Id_Livre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ecrit_par`
--

DROP TABLE IF EXISTS `ecrit_par`;
CREATE TABLE IF NOT EXISTS `ecrit_par` (
  `Id_Auteur` smallint(5) UNSIGNED NOT NULL,
  `Id_Livre` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`Id_Auteur`,`Id_Livre`),
  KEY `FK_Ecrit_par_Id_Livre` (`Id_Livre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ecrit_par`
--

INSERT INTO `ecrit_par` (`Id_Auteur`, `Id_Livre`) VALUES
(9, 9),
(10, 11),
(11, 12),
(8, 13),
(7, 14),
(6, 15),
(5, 16),
(4, 17),
(3, 18),
(2, 19);

-- --------------------------------------------------------

--
-- Table structure for table `edite`
--

DROP TABLE IF EXISTS `edite`;
CREATE TABLE IF NOT EXISTS `edite` (
  `Id_Admin` tinyint(3) UNSIGNED NOT NULL,
  `Id_Livre` smallint(5) UNSIGNED NOT NULL,
  `Chrono_Tag_Edite` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_Admin`,`Id_Livre`),
  KEY `FK_Edite_Id_Livre` (`Id_Livre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `editeur`
--

DROP TABLE IF EXISTS `editeur`;
CREATE TABLE IF NOT EXISTS `editeur` (
  `Id_Editeur` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nom_Editeur` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`Id_Editeur`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `editeur`
--

INSERT INTO `editeur` (`Id_Editeur`, `Nom_Editeur`) VALUES
(1, 'Hachette'),
(2, 'Gallimard'),
(3, 'PUF Rennes'),
(4, 'PUF Paris'),
(5, 'Libertalia');

-- --------------------------------------------------------

--
-- Table structure for table `langue`
--

DROP TABLE IF EXISTS `langue`;
CREATE TABLE IF NOT EXISTS `langue` (
  `Id_Langue` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nom_Langue` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id_Langue`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `langue`
--

INSERT INTO `langue` (`Id_Langue`, `Nom_Langue`) VALUES
(1, 'frenchy'),
(2, 'bilingue');

-- --------------------------------------------------------

--
-- Table structure for table `livre`
--

DROP TABLE IF EXISTS `livre`;
CREATE TABLE IF NOT EXISTS `livre` (
  `Id_Livre` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Titre` varchar(40) DEFAULT NULL,
  `Synopsis` varchar(600) DEFAULT NULL,
  `Nombre_Pages` smallint(5) UNSIGNED DEFAULT NULL,
  `ISBN` bigint(5) UNSIGNED DEFAULT NULL,
  `Annee_Publication` int(5) DEFAULT NULL,
  `Validation_Livre` varchar(50) DEFAULT NULL,
  `Id_Editeur` smallint(5) UNSIGNED DEFAULT NULL,
  `Id_Langue` smallint(5) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`Id_Livre`),
  KEY `FK_Livre_Id_Editeur` (`Id_Editeur`),
  KEY `FK_Livre_Id_Langue` (`Id_Langue`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `livre`
--

INSERT INTO `livre` (`Id_Livre`, `Titre`, `Synopsis`, `Nombre_Pages`, `ISBN`, `Annee_Publication`, `Validation_Livre`, `Id_Editeur`, `Id_Langue`) VALUES
(9, 'La Femme Rompue', 'Ce recueil met en scène trois femmes différentes, toutes en pleine crise existentielle. Il est articulé en trois partie, représentant des femmes venant de milieux différents.', 285, 901115487, 1972, 'VALIDE', 2, 1),
(11, 'La Condition Humaine', 'La Condition humaine relate le parcours d\'un groupe de révolutionnaires communistes préparant le soulèvement de la ville de Shanghai. Au moment où commence le récit, le 21 mars 1927, communistes et nationalistes préparent une insurrection contre le gouvernement.', 245, 178779787, 1962, 'VALIDE', 2, 1),
(12, 'Les croisades vues par les arabes', 'Le livre raconte le point de vue des Arabes sur les Croisés et les croisades, entre 1096 et 1291. Il raconte les pillages et les massacres perpétrés par les Franjs. On y voit les contrastes de l\'époque entre Orient et Occident. Il apporte en plus une réflexion sur l\'inversion de la domination de l\'Orient sur l\'Occident ces derniers siècles à cause des croisades, et malgré la victoire arabe.', 317, 978290477, 1983, 'VALIDE', 1, 1),
(13, 'Lorenzaccio', 'L\'action se déroule à Florence en janvier 1537. Le patricien florentin Lorenzo de Médicis1, âgé de 19 ans, jeune homme studieux, admirateur des héros de l\'Antiquité latine et grecque, se voue à la restauration de la République.', 348, 207037026, 1978, 'VALIDE', 4, 1),
(14, 'Fight Club', 'Le narrateur incarne parfaitement l\'individu lambda de la société de consommation, garde robe remplie de marques de luxe, appartement meublé par une panoplie de meubles suédois ; avec ceci, le narrateur se considère a priori comme « complet ». Puis il rencontre Tyler Durden, avec lequel il fonde le « Fight Club » après avoir perdu son appartement, incendié en réalité par ce même Tyler Durden.', 298, 978201745, 1996, 'VALIDE', 3, 1),
(15, 'Vol de Nuit', 'L\'action de ce roman se situe en Amérique du Sud, à l\'époque des débuts de l\'aviation commerciale. Saint-Exupéry, qui fut en 1929 directeur de l\'Aéropostale d\'Argentine, raconte la vie menée par le chef d\'une compagnie aéropostale, Rivière, et par son équipe de pilotes.', 188, 45856875, 1972, 'VALIDE', 1, 1),
(16, 'Des souris et des hommes', 'L\'histoire se déroule au début des années 1930. George Milton, un homme plutôt petit et Lennie Small, grand colosse un peu bêta, sont deux amis d\'enfance. Ils errent sur les routes de Californie en travaillant comme saisonniers dans des ranchs.', 174, 978256875, 1955, 'VALIDE', 2, 1),
(17, 'Bilbo le Hobbit', 'Le hobbit Bilbon Sacquet mène une existence paisible dans son trou de Cul-de-Sac jusqu’au jour où il croise le magicien Gandalf.', 379, 978125875, 1978, 'VALIDE', 5, 1),
(18, 'Faust', 'Dans l\'Allemagne du Moyen-Age, le Docteur Faust, vieux savant fatigué de la vie, songe à en finir une bonne fois pour toutes lorsque Méphistophélès, le Diable, lui apparaît en chair et en os : rusé, il fait signer à Faust un pacte qui lui garantit une nouvelle jeunesse en échange de son âme.', 158, 478655175, 1948, 'VALIDE', 4, 2),
(19, 'L\'Homme invisible', 'Après quinze ans de recherches ruineuses, l\'albinos Griffin invente une formule scientifique permettant de devenir invisible. Ayant réussi une expérience sur le chat de sa voisine, le savant décide d\'expérimenter la formule sur lui-même, notamment pour fuir ses créanciers, avant de déclencher un incendie visant à effacer ses traces.', 236, 97855175, 1897, 'VALIDE', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `modifie`
--

DROP TABLE IF EXISTS `modifie`;
CREATE TABLE IF NOT EXISTS `modifie` (
  `Id_Visiteur` int(10) UNSIGNED NOT NULL,
  `Id_Livre` smallint(5) UNSIGNED NOT NULL,
  `Chrono_Tag_Modification_Modifie` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_Visiteur`,`Id_Livre`),
  KEY `FK_Modifie_Id_Livre` (`Id_Livre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `rajoute`
--

DROP TABLE IF EXISTS `rajoute`;
CREATE TABLE IF NOT EXISTS `rajoute` (
  `Id_Admin` tinyint(3) UNSIGNED NOT NULL,
  `Id_Livre` smallint(5) UNSIGNED NOT NULL,
  `Chrono_Tag_Rajout` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_Admin`,`Id_Livre`),
  KEY `FK_Rajoute_Id_Livre` (`Id_Livre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `regarde`
--

DROP TABLE IF EXISTS `regarde`;
CREATE TABLE IF NOT EXISTS `regarde` (
  `Id_Admin` tinyint(3) UNSIGNED NOT NULL,
  `Id_Livre` smallint(5) UNSIGNED NOT NULL,
  `Chrono_Tag_Regarde` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_Admin`,`Id_Livre`),
  KEY `FK_Regarde_Id_Livre` (`Id_Livre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `telecharge`
--

DROP TABLE IF EXISTS `telecharge`;
CREATE TABLE IF NOT EXISTS `telecharge` (
  `Id_Visiteur` int(10) UNSIGNED NOT NULL,
  `Id_Livre` smallint(5) UNSIGNED NOT NULL,
  `Chrono_Tag_Telecharge` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_Visiteur`,`Id_Livre`),
  KEY `FK_Telecharge_Id_Livre` (`Id_Livre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `trie_par`
--

DROP TABLE IF EXISTS `trie_par`;
CREATE TABLE IF NOT EXISTS `trie_par` (
  `Id_Livre` smallint(5) UNSIGNED NOT NULL,
  `Id_Categorie` smallint(5) UNSIGNED NOT NULL,
  PRIMARY KEY (`Id_Livre`,`Id_Categorie`),
  KEY `FK_Trie_par_Id_Categorie` (`Id_Categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trie_par`
--

INSERT INTO `trie_par` (`Id_Livre`, `Id_Categorie`) VALUES
(19, 2),
(12, 4),
(9, 5),
(13, 5),
(16, 5),
(18, 5),
(15, 6),
(17, 6),
(11, 8),
(14, 8);

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

DROP TABLE IF EXISTS `upload`;
CREATE TABLE IF NOT EXISTS `upload` (
  `Id_Visiteur` int(10) UNSIGNED NOT NULL,
  `Id_Livre` smallint(5) UNSIGNED NOT NULL,
  `Chrono_Tag_Upload` datetime DEFAULT NULL,
  PRIMARY KEY (`Id_Visiteur`,`Id_Livre`),
  KEY `FK_Upload_Id_Livre` (`Id_Livre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visiteur`
--

DROP TABLE IF EXISTS `visiteur`;
CREATE TABLE IF NOT EXISTS `visiteur` (
  `Id_Visiteur` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `Nom_Visiteur` varchar(25) DEFAULT NULL,
  `Prenom_Visiteur` varchar(25) DEFAULT NULL,
  `Date_Naissance` date DEFAULT NULL,
  `Adresse_Mail_Visiteur` varchar(50) DEFAULT NULL,
  `Mot_De_Passe_Visiteur` varchar(25) DEFAULT NULL,
  `Adresse` varchar(30) DEFAULT NULL,
  `Code_Postal` int(5) UNSIGNED DEFAULT NULL,
  `Ville` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Id_Visiteur`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visiteur`
--

INSERT INTO `visiteur` (`Id_Visiteur`, `Nom_Visiteur`, `Prenom_Visiteur`, `Date_Naissance`, `Adresse_Mail_Visiteur`, `Mot_De_Passe_Visiteur`, `Adresse`, `Code_Postal`, `Ville`) VALUES
(6, 'Avoir', 'Etre', '1961-09-23', 'ahhhh@gmail.fr', 'viveLesChats.01', '1 rue test', 35000, 'Meuric'),
(7, 'Booooo', 'jean', '1901-09-23', 'ahhhh@gmail.fr', 'viveLesChats.01', '3 rue mainville', 35000, 'Rennes'),
(8, 'test', 'test', '1991-11-11', 'adresse@test.ntm', 'test', 'test', 35000, 'test'),
(9, 'jour', 'jour', '1991-11-11', 'jpur@jour.fr', 'jour', 'joure', 53533, 'jour'),
(10, 'plouc', 'plouc', '1997-12-12', 'ploc@plouc.plou', 'plouc', 'plouc', 35000, 'plouc'),
(11, 'plouc', 'plouc', '1997-12-12', 'ploc@plouc.plou', 'oui', 'plouc', 35000, 'plouc'),
(12, 'goup', 'goup', '1568-11-11', 'goup@goup.gou', 'goup', 'goup', 35000, 'goup'),
(13, 'jean', 'jean', '1565-11-11', 'gou@klk.fr', 'mou', 'mou', 35000, 'rennes'),
(14, 'jean', 'jean', '1565-11-11', 'gou@klk.fr', 'fre', 'mou', 35000, 'rennes'),
(15, 'moi', 'moi', '1889-12-12', 'moi@moi.moi', 'moi', 'moi', 10000, 'moi'),
(19, 'phi', 'phi', '1996-11-11', 'phi@phi.phi', 'fip', 'phi', 35000, 'phi');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `consulte`
--
ALTER TABLE `consulte`
  ADD CONSTRAINT `FK_Consulte_Id_Livre` FOREIGN KEY (`Id_Livre`) REFERENCES `livre` (`Id_Livre`),
  ADD CONSTRAINT `FK_Consulte_Id_Visiteur` FOREIGN KEY (`Id_Visiteur`) REFERENCES `visiteur` (`Id_Visiteur`);

--
-- Constraints for table `ecrit_par`
--
ALTER TABLE `ecrit_par`
  ADD CONSTRAINT `FK_Ecrit_par_Id_Auteur` FOREIGN KEY (`Id_Auteur`) REFERENCES `auteur` (`Id_Auteur`),
  ADD CONSTRAINT `FK_Ecrit_par_Id_Livre` FOREIGN KEY (`Id_Livre`) REFERENCES `livre` (`Id_Livre`);

--
-- Constraints for table `edite`
--
ALTER TABLE `edite`
  ADD CONSTRAINT `FK_Edite_Id_Admin` FOREIGN KEY (`Id_Admin`) REFERENCES `administrateur` (`Id_Admin`),
  ADD CONSTRAINT `FK_Edite_Id_Livre` FOREIGN KEY (`Id_Livre`) REFERENCES `livre` (`Id_Livre`);

--
-- Constraints for table `livre`
--
ALTER TABLE `livre`
  ADD CONSTRAINT `FK_Livre_Id_Editeur` FOREIGN KEY (`Id_Editeur`) REFERENCES `editeur` (`Id_Editeur`),
  ADD CONSTRAINT `FK_Livre_Id_Langue` FOREIGN KEY (`Id_Langue`) REFERENCES `langue` (`Id_Langue`);

--
-- Constraints for table `modifie`
--
ALTER TABLE `modifie`
  ADD CONSTRAINT `FK_Modifie_Id_Livre` FOREIGN KEY (`Id_Livre`) REFERENCES `livre` (`Id_Livre`),
  ADD CONSTRAINT `FK_Modifie_Id_Visiteur` FOREIGN KEY (`Id_Visiteur`) REFERENCES `visiteur` (`Id_Visiteur`);

--
-- Constraints for table `rajoute`
--
ALTER TABLE `rajoute`
  ADD CONSTRAINT `FK_Rajoute_Id_Admin` FOREIGN KEY (`Id_Admin`) REFERENCES `administrateur` (`Id_Admin`),
  ADD CONSTRAINT `FK_Rajoute_Id_Livre` FOREIGN KEY (`Id_Livre`) REFERENCES `livre` (`Id_Livre`);

--
-- Constraints for table `regarde`
--
ALTER TABLE `regarde`
  ADD CONSTRAINT `FK_Regarde_Id_Admin` FOREIGN KEY (`Id_Admin`) REFERENCES `administrateur` (`Id_Admin`),
  ADD CONSTRAINT `FK_Regarde_Id_Livre` FOREIGN KEY (`Id_Livre`) REFERENCES `livre` (`Id_Livre`);

--
-- Constraints for table `telecharge`
--
ALTER TABLE `telecharge`
  ADD CONSTRAINT `FK_Telecharge_Id_Livre` FOREIGN KEY (`Id_Livre`) REFERENCES `livre` (`Id_Livre`),
  ADD CONSTRAINT `FK_Telecharge_Id_Visiteur` FOREIGN KEY (`Id_Visiteur`) REFERENCES `visiteur` (`Id_Visiteur`);

--
-- Constraints for table `trie_par`
--
ALTER TABLE `trie_par`
  ADD CONSTRAINT `FK_Trie_par_Id_Categorie` FOREIGN KEY (`Id_Categorie`) REFERENCES `categories` (`Id_Categorie`),
  ADD CONSTRAINT `FK_Trie_par_Id_Livre` FOREIGN KEY (`Id_Livre`) REFERENCES `livre` (`Id_Livre`);

--
-- Constraints for table `upload`
--
ALTER TABLE `upload`
  ADD CONSTRAINT `FK_Upload_Id_Livre` FOREIGN KEY (`Id_Livre`) REFERENCES `livre` (`Id_Livre`),
  ADD CONSTRAINT `FK_Upload_Id_Visiteur` FOREIGN KEY (`Id_Visiteur`) REFERENCES `visiteur` (`Id_Visiteur`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
