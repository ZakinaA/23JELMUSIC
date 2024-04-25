-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : jeu. 25 avr. 2024 à 17:00
-- Version du serveur : 11.3.2-MariaDB
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `23jelmusic`
--

-- --------------------------------------------------------

--
-- Structure de la table `accessoire`
--

DROP TABLE IF EXISTS `accessoire`;
CREATE TABLE IF NOT EXISTS `accessoire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `instrument_id` int(11) NOT NULL,
  `libelle` varchar(70) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8FD026ACF11D9C` (`instrument_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `accessoire`
--

INSERT INTO `accessoire` (`id`, `instrument_id`, `libelle`) VALUES
(1, 1, 'Corde'),
(2, 2, 'Grattoir');

-- --------------------------------------------------------

--
-- Structure de la table `classe_instrument`
--

DROP TABLE IF EXISTS `classe_instrument`;
CREATE TABLE IF NOT EXISTS `classe_instrument` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `classe_instrument`
--

INSERT INTO `classe_instrument` (`id`, `libelle`) VALUES
(1, 'Claviers'),
(2, 'Instrument amplifié'),
(3, 'Bois'),
(4, 'Cuivres'),
(5, 'Cordes'),
(6, 'Percussions');

-- --------------------------------------------------------

--
-- Structure de la table `contrat_pret`
--

DROP TABLE IF EXISTS `contrat_pret`;
CREATE TABLE IF NOT EXISTS `contrat_pret` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eleve_id` int(11) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `attestation_assurance` varchar(255) DEFAULT NULL,
  `etat_detaille_debut` varchar(255) DEFAULT NULL,
  `etat_detaille_retour` varchar(255) DEFAULT NULL,
  `instrument_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_1FB84C67A6CC7B2` (`eleve_id`),
  KEY `IDX_1FB84C67CF11D9C` (`instrument_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `contrat_pret`
--

INSERT INTO `contrat_pret` (`id`, `eleve_id`, `date_debut`, `date_fin`, `attestation_assurance`, `etat_detaille_debut`, `etat_detaille_retour`, `instrument_id`) VALUES
(1, 1, '2023-10-30', '2023-11-04', 'pièce jointe', 'bon état', 'mauvais', 2),
(2, 2, '2021-08-09', '2021-11-30', 'egrzgreg', 'neuf', 'excellent état ', 5),
(4, 3, '2023-11-07', '2023-11-29', 'piece jointe', 'neuf', 'bonne etat', 7),
(11, 2, '2023-11-27', '2023-12-23', NULL, 'bon état', NULL, 5);

-- --------------------------------------------------------

--
-- Structure de la table `couleur`
--

DROP TABLE IF EXISTS `couleur`;
CREATE TABLE IF NOT EXISTS `couleur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `couleur`
--

INSERT INTO `couleur` (`id`, `nom`) VALUES
(1, 'Blanc'),
(2, 'Jaune'),
(3, 'Bleu'),
(4, 'Rouge');

-- --------------------------------------------------------

--
-- Structure de la table `cours`
--

DROP TABLE IF EXISTS `cours`;
CREATE TABLE IF NOT EXISTS `cours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_cours_id` int(11) DEFAULT NULL,
  `jours_id` int(11) DEFAULT NULL,
  `professeur_id` int(11) DEFAULT NULL,
  `age_mini` varchar(20) NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL,
  `nb_places` int(11) NOT NULL,
  `age_maxi` varchar(20) NOT NULL,
  `type_instruments_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FDCA8C9CB3305F4C` (`type_cours_id`),
  KEY `IDX_FDCA8C9C6180639B` (`jours_id`),
  KEY `IDX_FDCA8C9CBAB22EE9` (`professeur_id`),
  KEY `IDX_FDCA8C9C4807BAC3` (`type_instruments_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cours`
--

INSERT INTO `cours` (`id`, `type_cours_id`, `jours_id`, `professeur_id`, `age_mini`, `heure_debut`, `heure_fin`, `nb_places`, `age_maxi`, `type_instruments_id`) VALUES
(1, 2, 3, 1, '5', '18:00:00', '19:00:00', 15, '12', 2),
(2, 2, 3, 1, '13', '17:00:00', '18:00:00', 6, '15', 1),
(3, 2, 1, 1, '13', '10:00:00', '11:00:00', 6, '15', 1),
(4, 2, 1, 2, '5', '10:30:00', '11:30:00', 10, '9', 12);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE IF NOT EXISTS `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20231122094656', '2023-11-27 10:45:44', 10275),
('DoctrineMigrations\\Version20231129075015', '2023-11-29 07:50:20', 1489),
('DoctrineMigrations\\Version20231129085614', '2023-11-29 08:56:57', 4448),
('DoctrineMigrations\\Version20231206124148', '2023-12-06 12:41:58', 1891),
('DoctrineMigrations\\Version20231213072342', '2023-12-13 07:24:20', 1013);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

DROP TABLE IF EXISTS `eleve`;
CREATE TABLE IF NOT EXISTS `eleve` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `num_rue` varchar(20) NOT NULL,
  `rue` varchar(50) NOT NULL,
  `copos` varchar(10) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `mail` varchar(30) NOT NULL,
  -- `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 'Etienne', 'Cador', '16', 'rue du parc', '14000', 'Caen', '0231545612', 'c.etienne@gmail.com'),
(2, 'Simon', 'Zoe', '4685', 'Rue du moulin', '45000', 'Caen', '0256963847', 'Simon@gmail.com'),
(3, 'Varin', 'Joy', '2', 'Rue du monde', '27500', 'Pont-audemer', '0215147495', 'Varin@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `eleve_responsable`
--

DROP TABLE IF EXISTS `eleve_responsable`;
CREATE TABLE IF NOT EXISTS `eleve_responsable` (
  `eleve_id` int(11) NOT NULL,
  `responsable_id` int(11) NOT NULL,
  PRIMARY KEY (`eleve_id`,`responsable_id`),
  KEY `IDX_D7350730A6CC7B2` (`eleve_id`),
  KEY `IDX_D735073053C59D72` (`responsable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `eleve_responsable`
--

INSERT INTO `eleve_responsable` (`eleve_id`, `responsable_id`) VALUES
(1, 1),
(1, 2),
(2, 2),
(3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `inscription`
--

DROP TABLE IF EXISTS `inscription`;
CREATE TABLE IF NOT EXISTS `inscription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cours_id` int(11) DEFAULT NULL,
  `eleve_id` int(11) DEFAULT NULL,
  `date_inscription` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5E90F6D67ECF78B0` (`cours_id`),
  KEY `IDX_5E90F6D6A6CC7B2` (`eleve_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `inscription`
--

INSERT INTO `inscription` (`id`, `cours_id`, `eleve_id`, `date_inscription`) VALUES
(1, 1, 1, '2023-11-02');

-- --------------------------------------------------------

--
-- Structure de la table `instrument`
--

DROP TABLE IF EXISTS `instrument`;
CREATE TABLE IF NOT EXISTS `instrument` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marque_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `num_serie` varchar(255) NOT NULL,
  `date_achat` date NOT NULL,
  `prix_achat` double NOT NULL,
  `utilisation` varchar(100) DEFAULT NULL,
  `chemin_image` varchar(255) DEFAULT NULL,
  `nom` varchar(70) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_3CBF69DD4827B9B2` (`marque_id`),
  KEY `IDX_3CBF69DDC54C8C93` (`type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `instrument`
--

INSERT INTO `instrument` (`id`, `marque_id`, `type_id`, `num_serie`, `date_achat`, `prix_achat`, `utilisation`, `chemin_image`, `nom`) VALUES
(1, 1, 5, '5', '2023-11-01', 350.99, 'prêt', '/imgBasse Electrique', 'BE-1'),
(2, 2, 4, '2', '2023-11-03', 400, 'prêt', 'Guittare Electrique', 'GE-1'),
(3, 4, 7, '3', '2018-01-01', 199.99, 'prêt', '/img/imgClarinette', 'Cla-1'),
(4, 4, 12, 'VIO-01', '2018-01-01', 200, 'prêt', '/imgViolon', 'Vio-1'),
(5, 4, 9, '3', '2018-01-01', 200, 'prêt', 'Trombonne', 'Tro-1'),
(6, 4, 6, '3', '2018-01-01', 200, 'prêt', '/imgSaxophone', 'Sax-1'),
(7, 4, 2, '5', '2018-01-01', 300, 'prêt', 'Piano', 'Pia-1'),
(8, 4, 5, 'BE-02', '2023-12-09', 299.95, 'Cours', '/img/img', 'BE-2'),
(9, 3, 5, 'BE-03', '2023-12-28', 1199.99, 'Cours', '/img/img', 'BE-3'),
(10, 3, 13, '1201511', '2023-12-11', 552, 'prêt', '/img', 'VIo-332');

-- --------------------------------------------------------

--
-- Structure de la table `instrument_couleur`
--

DROP TABLE IF EXISTS `instrument_couleur`;
CREATE TABLE IF NOT EXISTS `instrument_couleur` (
  `instrument_id` int(11) NOT NULL,
  `couleur_id` int(11) NOT NULL,
  PRIMARY KEY (`instrument_id`,`couleur_id`),
  KEY `IDX_443EF844CF11D9C` (`instrument_id`),
  KEY `IDX_443EF844C31BA576` (`couleur_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `instrument_couleur`
--

INSERT INTO `instrument_couleur` (`instrument_id`, `couleur_id`) VALUES
(1, 3),
(2, 4),
(5, 2),
(6, 4),
(8, 3),
(10, 1),
(10, 3);

-- --------------------------------------------------------

--
-- Structure de la table `intervention`
--

DROP TABLE IF EXISTS `intervention`;
CREATE TABLE IF NOT EXISTS `intervention` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `instrument_id` int(11) DEFAULT NULL,
  `professionnel_id` int(11) DEFAULT NULL,
  `date_debut` date DEFAULT NULL,
  `date_fin` date DEFAULT NULL,
  `descriptif` varchar(255) DEFAULT NULL,
  `prix` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D11814ABCF11D9C` (`instrument_id`),
  KEY `IDX_D11814AB8A49CC82` (`professionnel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `intervention`
--

INSERT INTO `intervention` (`id`, `instrument_id`, `professionnel_id`, `date_debut`, `date_fin`, `descriptif`, `prix`) VALUES
(1, 2, 2, '2023-11-08', '2023-11-24', 'Changement des cordages', 49.99),
(2, 1, 1, '2023-11-06', '2023-11-10', 'Changement des cordages', 49.99),
(3, 3, 1, '2023-11-13', '2023-11-15', 'Changement du bec', 80),
(10, 1, 2, '2023-12-02', '2023-12-10', 'Réparation de le structure', 349.99),
(11, 1, 2, '2023-12-01', '2023-12-02', 'Accordement de la guitare', 25),
(12, 3, 1, '2023-12-01', '2023-12-08', 'Nettoyage de l\'instrument', 30);

-- --------------------------------------------------------

--
-- Structure de la table `inter_pret`
--

DROP TABLE IF EXISTS `inter_pret`;
CREATE TABLE IF NOT EXISTS `inter_pret` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `intervention_id` int(11) DEFAULT NULL,
  `contrat_pret_id` int(11) DEFAULT NULL,
  `quotite` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_244C23678EAE3863` (`intervention_id`),
  KEY `IDX_244C2367B2AF233D` (`contrat_pret_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `inter_pret`
--

INSERT INTO `inter_pret` (`id`, `intervention_id`, `contrat_pret_id`, `quotite`) VALUES
(1, 3, 4, 30),
(2, 1, 1, 20);

-- --------------------------------------------------------

--
-- Structure de la table `jours`
--

DROP TABLE IF EXISTS `jours`;
CREATE TABLE IF NOT EXISTS `jours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `jours`
--

INSERT INTO `jours` (`id`, `libelle`) VALUES
(1, 'Lundi'),
(2, 'Mardi'),
(3, 'Mercredi'),
(4, 'Jeudi'),
(5, 'Vendredi'),
(6, 'Samedi'),
(7, 'Dimanche');

-- --------------------------------------------------------

--
-- Structure de la table `marque`
--

DROP TABLE IF EXISTS `marque`;
CREATE TABLE IF NOT EXISTS `marque` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `marque`
--

INSERT INTO `marque` (`id`, `libelle`) VALUES
(1, 'Shiver'),
(2, 'Fender'),
(3, 'Gibson'),
(4, 'Yamaha');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE IF NOT EXISTS `messenger_messages` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `metier`
--

DROP TABLE IF EXISTS `metier`;
CREATE TABLE IF NOT EXISTS `metier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `metier`
--

INSERT INTO `metier` (`id`, `libelle`) VALUES
(1, 'plombier'),
(2, 'chauffagiste'),
(3, 'paysagiste'),
(4, 'chauffeur poids lourd');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

DROP TABLE IF EXISTS `professeur`;
CREATE TABLE IF NOT EXISTS `professeur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `num_rue` varchar(10) NOT NULL,
  `rue` varchar(50) NOT NULL,
  `copos` varchar(20) NOT NULL,
  `ville` varchar(30) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `mail` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `professeur`
--

INSERT INTO `professeur` (`id`, `nom`, `prenom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 'Thomas', 'Bouquet', '12', 'rue des coclicos', '14000', 'Caen', '0231547217', 'b.thomas@gmail.com'),
(2, 'Guerinet', 'Serge', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Structure de la table `professionnel`
--

DROP TABLE IF EXISTS `professionnel`;
CREATE TABLE IF NOT EXISTS `professionnel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(150) DEFAULT NULL,
  `num_rue` int(11) DEFAULT NULL,
  `rue` varchar(150) DEFAULT NULL,
  `copos` int(11) DEFAULT NULL,
  `ville` varchar(255) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `professionnel`
--

INSERT INTO `professionnel` (`id`, `nom`, `num_rue`, `rue`, `copos`, `ville`, `tel`, `mail`) VALUES
(1, 'Neusy', 23, 'Rue du lac', 76600, 'Havre', 245967455, 'Neusy@gmail.com'),
(2, 'Guerard', 3, 'Rue de l\'horloge', 76000, 'Rouen', 247856633, 'guerard@gmail.com');

-- --------------------------------------------------------

--
-- Structure de la table `professionnel_metier`
--

DROP TABLE IF EXISTS `professionnel_metier`;
CREATE TABLE IF NOT EXISTS `professionnel_metier` (
  `professionnel_id` int(11) NOT NULL,
  `metier_id` int(11) NOT NULL,
  PRIMARY KEY (`professionnel_id`,`metier_id`),
  KEY `IDX_715C73CA8A49CC82` (`professionnel_id`),
  KEY `IDX_715C73CAED16FA20` (`metier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `professionnel_metier`
--

INSERT INTO `professionnel_metier` (`professionnel_id`, `metier_id`) VALUES
(1, 3),
(2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `responsable`
--

DROP TABLE IF EXISTS `responsable`;
CREATE TABLE IF NOT EXISTS `responsable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) DEFAULT NULL,
  `prenom` varchar(255) DEFAULT NULL,
  `num_rue` int(11) DEFAULT NULL,
  `rue` varchar(255) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  -- `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `responsable`
--

INSERT INTO `responsable` (`id`, `nom`, `prenom`, `num_rue`, `rue`, `tel`, `mail`) VALUES
(1, 'Iffam', 'Annais', 17, 'Rue des Saules', 215368874, 'Iffam@gmail.com'),
(2, 'Quildbeuf', 'Romane', 26, 'Rue des libellule ', 236561477, 'Quildbeuf');

-- --------------------------------------------------------

--
-- Structure de la table `type_cours`
--

DROP TABLE IF EXISTS `type_cours`;
CREATE TABLE IF NOT EXISTS `type_cours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_cours`
--

INSERT INTO `type_cours` (`id`, `libelle`) VALUES
(1, 'Cours Individuel'),
(2, 'Cours Collectif');

-- --------------------------------------------------------

--
-- Structure de la table `type_instrument`
--

DROP TABLE IF EXISTS `type_instrument`;
CREATE TABLE IF NOT EXISTS `type_instrument` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `classe_id` int(11) NOT NULL,
  `libelle` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_21BCBFF88F5EA509` (`classe_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `type_instrument`
--

INSERT INTO `type_instrument` (`id`, `classe_id`, `libelle`) VALUES
(1, 1, 'Orgue'),
(2, 1, 'Piano'),
(3, 2, 'Clavier Amplifier'),
(4, 2, 'Guitare Electrique'),
(5, 2, 'Basse Electrique'),
(6, 3, 'Saxophone'),
(7, 3, 'Clarinette'),
(8, 3, 'Flute Traversière'),
(9, 4, 'Trombone'),
(10, 4, 'Trompette'),
(11, 4, 'Tuba'),
(12, 5, 'Violon'),
(13, 5, 'Violoncelle'),
(14, 5, 'Harpe Celtique'),
(15, 6, 'Batterie');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES
(4, 'resp@jelmusic.com', '[\"ROLE_RESP\"]', '$2y$13$kEqH3f832C83tQp4vF6g0OxMWJgd28gBdfygi/P0aOZo0MILt94lm'),
(5, 'eleve@jelmusic.com', '[\"ROLE_ELEVE\"]', '$2y$13$LrGEaLsorZ1tiSHVX2POM.7dNqSaK7V/qkUpvtKNhp0H15qf5xhr.'),
(10, 'admin@jelmusic.com', '[\"ROLE_ADMIN\"]', '$2y$13$fOLacv73jbu4cqn77qUUiuz3ZXlVPFqvubOmL67sLQxXas4RDgYeu'),
(11, 'simon@gmail.com', '[\"ROLE_ELEVE\"]', '$2y$13$WHOLIHOyNlybB1dD7vXYX.fe/1Fnq6p6XXOK5b7GvIJz/Ekb0eHV6'),
(12, 'iffam@gmail.com', '[\"ROLE_RESP\"]', '$2y$13$fmVuB1t/8B/kfD1D6M8A0.GaAATlBnj1SXkMfHnMTGA4HGeWjEHti');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `accessoire`
--
ALTER TABLE `accessoire`
  ADD CONSTRAINT `FK_3CBF69DD4827B9C2` FOREIGN KEY (`instrument_id`) REFERENCES `instrument` (`id`);

--
-- Contraintes pour la table `contrat_pret`
--
ALTER TABLE `contrat_pret`
  ADD CONSTRAINT `FK_1FB84C67A6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `FK_1FB84C67CF11D9C` FOREIGN KEY (`instrument_id`) REFERENCES `instrument` (`id`);

--
-- Contraintes pour la table `cours`
--
ALTER TABLE `cours`
  ADD CONSTRAINT `FK_FDCA8C9C4807BAC3` FOREIGN KEY (`type_instruments_id`) REFERENCES `type_instrument` (`id`),
  ADD CONSTRAINT `FK_FDCA8C9C6180639B` FOREIGN KEY (`jours_id`) REFERENCES `jours` (`id`),
  ADD CONSTRAINT `FK_FDCA8C9CB3305F4C` FOREIGN KEY (`type_cours_id`) REFERENCES `type_cours` (`id`),
  ADD CONSTRAINT `FK_FDCA8C9CBAB22EE9` FOREIGN KEY (`professeur_id`) REFERENCES `professeur` (`id`);

-- --
-- -- Contraintes pour la table `eleve`
-- --
-- ALTER TABLE `eleve`
--   ADD CONSTRAINT `FK_9FB84C67A6CC7S2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);


--
-- Contraintes pour la table `eleve_responsable`
--
ALTER TABLE `eleve_responsable`
  ADD CONSTRAINT `FK_1FB84C67A6CC7S2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `FK_1FB84C67C311D9C` FOREIGN KEY (`responsable_id`) REFERENCES `responsable` (`id`);

--
-- Contraintes pour la table `inscription`
--
ALTER TABLE `inscription`
  ADD CONSTRAINT `FK_1FB74C67A6CC7B2` FOREIGN KEY (`eleve_id`) REFERENCES `eleve` (`id`),
  ADD CONSTRAINT `FK_1FB84C67CF11D9D` FOREIGN KEY (`cours_id`) REFERENCES `cours` (`id`);

--
-- Contraintes pour la table `instrument`
--
ALTER TABLE `instrument`
  ADD CONSTRAINT `FK_3CBF69DD4827B9B2` FOREIGN KEY (`marque_id`) REFERENCES `marque` (`id`),
  ADD CONSTRAINT `FK_3CBF69DDC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type_instrument` (`id`);

--
-- Contraintes pour la table `instrument_couleur`
--
ALTER TABLE `instrument_couleur`
  ADD CONSTRAINT `FK_1FB84C67CF11D6C` FOREIGN KEY (`instrument_id`) REFERENCES `instrument` (`id`),
  ADD CONSTRAINT `FK_3CBF69DDC5668C93` FOREIGN KEY (`couleur_id`) REFERENCES `couleur` (`id`);

--
-- Contraintes pour la table `intervention`
--
ALTER TABLE `intervention`
  ADD CONSTRAINT `FK_D11814AB8A49CC82` FOREIGN KEY (`professionnel_id`) REFERENCES `professionnel` (`id`),
  ADD CONSTRAINT `FK_D11814ABCF11D9C` FOREIGN KEY (`instrument_id`) REFERENCES `instrument` (`id`);

--
-- Contraintes pour la table `inter_pret`
--
ALTER TABLE `inter_pret`
  ADD CONSTRAINT `FK_D11814AB8C49CC82` FOREIGN KEY (`intervention_id`) REFERENCES `intervention` (`id`),
  ADD CONSTRAINT `FK_D11814ABCF91D9C` FOREIGN KEY (`contrat_pret_id`) REFERENCES `contrat_pret` (`id`);

--
-- Contraintes pour la table `professionnel_metier`
--
ALTER TABLE `professionnel_metier`
  ADD CONSTRAINT `FK_715C73CA8A49CC82` FOREIGN KEY (`professionnel_id`) REFERENCES `professionnel` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_715C73CAED16FA20` FOREIGN KEY (`metier_id`) REFERENCES `metier` (`id`) ON DELETE CASCADE;

-- --
-- -- Contraintes pour la table `responsable`
-- --
-- ALTER TABLE `responsable`
--   ADD CONSTRAINT `FK_9FB84C67N6CC7S2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `type_instrument`
--
ALTER TABLE `type_instrument`
  ADD CONSTRAINT `FK_21BCBFF88F5EA509` FOREIGN KEY (`classe_id`) REFERENCES `classe_instrument` (`id`);


COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
