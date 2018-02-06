-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mer. 10 jan. 2018 à 11:47
-- Version du serveur :  10.1.28-MariaDB
-- Version de PHP :  7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Base de données :  `laria`
--

-- --------------------------------------------------------

--
-- Structure de la table `album`
--

CREATE TABLE `album` (
  `IDALBUM` int(11) NOT NULL,
  `TITREALBUM` varchar(50) DEFAULT NULL,
  `PHOTOALBUM` varbinary(8000) DEFAULT NULL,
  `DESCRIPTIONALBUM` varchar(50) DEFAULT NULL,
  `DATESORTIEALBUM` datetime DEFAULT NULL,
  `genre_IDGENRE` int(11) NOT NULL,
  `contenu_IDCONTENU` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `artiste`
--

CREATE TABLE `artiste` (
  `IDARTISTE` int(10) UNSIGNED NOT NULL,
  `PSEUDOARTISTE` varchar(100) NOT NULL,
  `TELARTISTE` varchar(10) NOT NULL,
  `DESCARTISTE` varchar(400) NOT NULL,
  `BIOARTISTE` varchar(400) DEFAULT NULL,
  `genre_IDGENRE` int(11) NOT NULL,
  `membre_IDMEMBRE` int(11) NOT NULL,
  `SITEINTERNETARTISTE` longtext,
  `FACEBOOKARTISTE` longtext,
  `TWITTERARTISTE` longtext,
  `SOUNDCLOUDARTISTE` longtext,
  `YOUTUBEARTISTE` longtext,
  `SNAPCHATARTISTE` longtext,
  `INSTAGRAMARTISTE` longtext,
  `PRENOMMANAGER` tinyint(4) DEFAULT NULL,
  `NOMMANAGER` tinyint(4) DEFAULT NULL,
  `EMAILMANAGER` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `discographie`
--

CREATE TABLE `discographie` (
  `artiste_IDARTISTE` int(10) UNSIGNED NOT NULL,
  `album_IDALBUM` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `disponibilite`
--

CREATE TABLE `disponibilite` (
  `IDDISPONIBILITE` int(11) NOT NULL,
  `DATEDEBUTDISPONIBILITE` datetime DEFAULT NULL,
  `DATEFINDISPONIBILITE` datetime DEFAULT NULL,
  `localisation_IDLOCALISATION1` int(11) NOT NULL,
  `typedisponibilite_IDTYPEDISPONIBILITE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `disponibiliteartiste`
--

CREATE TABLE `disponibiliteartiste` (
  `artiste_IDARTISTE` int(10) UNSIGNED NOT NULL,
  `disponibilite_IDDISPONIBILITE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `featured`
--

CREATE TABLE `featured` (
  `artiste_IDARTISTE` int(10) UNSIGNED NOT NULL,
  `contenu_IDCONTENU` int(11) NOT NULL,
  `FEATUREDCLIP` tinyint(4) DEFAULT NULL,
  `FEATUREDMP3` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `genre`
--

CREATE TABLE `genre` (
  `IDGENRE` int(11) NOT NULL,
  `NOMGENRE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `genre`
--

INSERT INTO `genre` (`IDGENRE`, `NOMGENRE`) VALUES
(1, 'R\'Nb'),
(2, 'Dancehall'),
(3, 'Hip Hop'),
(4, 'Reggae'),
(5, 'Traditionelle'),
(6, 'Slam'),
(7, 'Compas'),
(8, 'Zouk'),
(9, 'Trap');

-- --------------------------------------------------------

--
-- Structure de la table `localisation`
--

CREATE TABLE `localisation` (
  `IDLOCALISATION` int(11) NOT NULL,
  `PAYSLOCALISATION` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `localisation`
--

INSERT INTO `localisation` (`IDLOCALISATION`, `PAYSLOCALISATION`) VALUES
(1, 'Martinique'),
(2, 'Guadeloupe'),
(3, 'Guyane'),
(4, 'Réunion'),
(5, 'France'),
(6, 'Mayotte'),
(7, 'Polynésie');

-- --------------------------------------------------------

--
-- Structure de la table `log`
--

CREATE TABLE `log` (
  `IDLOG` int(11) NOT NULL,
  `IPADRESS` varchar(15) DEFAULT NULL,
  `TIMESTAMP` timestamp NULL DEFAULT NULL,
  `typelog_IDTYPELOG` int(11) NOT NULL,
  `membre_IDMEMBRE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE `membre` (
  `IDMEMBRE` int(11) NOT NULL,
  `NOMMEMBRE` varchar(45) NOT NULL,
  `PRENOMMEMBRE` varchar(45) DEFAULT NULL,
  `EMAILMEMBRE` varchar(45) NOT NULL,
  `MDPMEMBRE` longtext NOT NULL,
  `PHOTOMEMBRE` varbinary(8000) DEFAULT NULL,
  `ROLEMEMBRE` longtext,
  `DATEINSCRIPTION` timestamp NULL DEFAULT NULL,
  `LASTCOMEMBRE` datetime DEFAULT NULL,
  `LASTIPMEMBRE` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `titre`
--

CREATE TABLE `titre` (
  `IDTITRE` int(11) NOT NULL,
  `NOMTITRE` varchar(45) DEFAULT NULL,
  `MP3MUSIQUE` varbinary(8000) DEFAULT NULL,
  `CLIPTITRE` varchar(45) DEFAULT NULL,
  `AUTEURTITRE` varchar(45) DEFAULT NULL,
  `COMPOSITEURTITRE` varchar(45) DEFAULT NULL,
  `genre_IDGENRE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `typedisponibilite`
--

CREATE TABLE `typedisponibilite` (
  `IDTYPEDISPONIBILITE` int(11) NOT NULL,
  `LIBELLETYPEDISPONIBILITE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `typedisponibilite`
--

INSERT INTO `typedisponibilite` (`IDTYPEDISPONIBILITE`, `LIBELLETYPEDISPONIBILITE`) VALUES
(1, 'Interview Média'),
(2, 'Podium'),
(3, 'Pormo Gratuite'),
(4, 'Prestation Payante'),
(5, 'Featuring avec d\'autres Artistes');

-- --------------------------------------------------------

--
-- Structure de la table `typelog`
--

CREATE TABLE `typelog` (
  `IDTYPELOG` int(11) NOT NULL,
  `LIBELLETYPELOG` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`IDALBUM`),
  ADD KEY `fk_album_contenu1_idx` (`contenu_IDCONTENU`),
  ADD KEY `fk_album_genre1_idx` (`genre_IDGENRE`);

--
-- Index pour la table `artiste`
--
ALTER TABLE `artiste`
  ADD PRIMARY KEY (`IDARTISTE`,`genre_IDGENRE`,`membre_IDMEMBRE`),
  ADD KEY `fk_artiste_genre1_idx` (`genre_IDGENRE`),
  ADD KEY `fk_artiste_membre1_idx` (`membre_IDMEMBRE`);

--
-- Index pour la table `discographie`
--
ALTER TABLE `discographie`
  ADD PRIMARY KEY (`artiste_IDARTISTE`,`album_IDALBUM`),
  ADD KEY `fk_artiste_has_album_album1_idx` (`album_IDALBUM`),
  ADD KEY `fk_artiste_has_album_artiste1_idx` (`artiste_IDARTISTE`);

--
-- Index pour la table `disponibilite`
--
ALTER TABLE `disponibilite`
  ADD PRIMARY KEY (`IDDISPONIBILITE`),
  ADD KEY `fk_disponibilite_localisation1_idx` (`localisation_IDLOCALISATION1`),
  ADD KEY `fk_disponibilite_typedisponibilite1_idx` (`typedisponibilite_IDTYPEDISPONIBILITE`);

--
-- Index pour la table `disponibiliteartiste`
--
ALTER TABLE `disponibiliteartiste`
  ADD PRIMARY KEY (`artiste_IDARTISTE`,`disponibilite_IDDISPONIBILITE`),
  ADD KEY `fk_artiste_has_disponibilite_disponibilite1_idx` (`disponibilite_IDDISPONIBILITE`),
  ADD KEY `fk_artiste_has_disponibilite_artiste1_idx` (`artiste_IDARTISTE`);

--
-- Index pour la table `featured`
--
ALTER TABLE `featured`
  ADD PRIMARY KEY (`artiste_IDARTISTE`,`contenu_IDCONTENU`),
  ADD KEY `fk_artiste_has_contenu_contenu1_idx` (`contenu_IDCONTENU`),
  ADD KEY `fk_artiste_has_contenu_artiste1_idx` (`artiste_IDARTISTE`);

--
-- Index pour la table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`IDGENRE`);

--
-- Index pour la table `localisation`
--
ALTER TABLE `localisation`
  ADD PRIMARY KEY (`IDLOCALISATION`);

--
-- Index pour la table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`IDLOG`,`membre_IDMEMBRE`),
  ADD KEY `fk_log_typelog1_idx` (`typelog_IDTYPELOG`),
  ADD KEY `fk_log_membre1_idx` (`membre_IDMEMBRE`);

--
-- Index pour la table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`IDMEMBRE`);

--
-- Index pour la table `titre`
--
ALTER TABLE `titre`
  ADD PRIMARY KEY (`IDTITRE`),
  ADD KEY `fk_musique_genre1_idx` (`genre_IDGENRE`);

--
-- Index pour la table `typedisponibilite`
--
ALTER TABLE `typedisponibilite`
  ADD PRIMARY KEY (`IDTYPEDISPONIBILITE`);

--
-- Index pour la table `typelog`
--
ALTER TABLE `typelog`
  ADD PRIMARY KEY (`IDTYPELOG`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `artiste`
--
ALTER TABLE `artiste`
  MODIFY `IDARTISTE` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `disponibilite`
--
ALTER TABLE `disponibilite`
  MODIFY `IDDISPONIBILITE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `genre`
--
ALTER TABLE `genre`
  MODIFY `IDGENRE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `localisation`
--
ALTER TABLE `localisation`
  MODIFY `IDLOCALISATION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `log`
--
ALTER TABLE `log`
  MODIFY `IDLOG` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `membre`
--
ALTER TABLE `membre`
  MODIFY `IDMEMBRE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `titre`
--
ALTER TABLE `titre`
  MODIFY `IDTITRE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `typedisponibilite`
--
ALTER TABLE `typedisponibilite`
  MODIFY `IDTYPEDISPONIBILITE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `typelog`
--
ALTER TABLE `typelog`
  MODIFY `IDTYPELOG` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `fk_album_contenu1` FOREIGN KEY (`contenu_IDCONTENU`) REFERENCES `titre` (`IDTITRE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_album_genre1` FOREIGN KEY (`genre_IDGENRE`) REFERENCES `genre` (`IDGENRE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `artiste`
--
ALTER TABLE `artiste`
  ADD CONSTRAINT `fk_artiste_genre1` FOREIGN KEY (`genre_IDGENRE`) REFERENCES `genre` (`IDGENRE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_artiste_membre1` FOREIGN KEY (`membre_IDMEMBRE`) REFERENCES `membre` (`IDMEMBRE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `discographie`
--
ALTER TABLE `discographie`
  ADD CONSTRAINT `fk_artiste_has_album_album1` FOREIGN KEY (`album_IDALBUM`) REFERENCES `album` (`IDALBUM`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_artiste_has_album_artiste1` FOREIGN KEY (`artiste_IDARTISTE`) REFERENCES `artiste` (`IDARTISTE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `disponibilite`
--
ALTER TABLE `disponibilite`
  ADD CONSTRAINT `fk_disponibilite_localisation1` FOREIGN KEY (`localisation_IDLOCALISATION1`) REFERENCES `localisation` (`IDLOCALISATION`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_disponibilite_typedisponibilite1` FOREIGN KEY (`typedisponibilite_IDTYPEDISPONIBILITE`) REFERENCES `typedisponibilite` (`IDTYPEDISPONIBILITE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `disponibiliteartiste`
--
ALTER TABLE `disponibiliteartiste`
  ADD CONSTRAINT `fk_artiste_has_disponibilite_artiste1` FOREIGN KEY (`artiste_IDARTISTE`) REFERENCES `artiste` (`IDARTISTE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_artiste_has_disponibilite_disponibilite1` FOREIGN KEY (`disponibilite_IDDISPONIBILITE`) REFERENCES `disponibilite` (`IDDISPONIBILITE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `featured`
--
ALTER TABLE `featured`
  ADD CONSTRAINT `fk_artiste_has_contenu_artiste1` FOREIGN KEY (`artiste_IDARTISTE`) REFERENCES `artiste` (`IDARTISTE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_artiste_has_contenu_contenu1` FOREIGN KEY (`contenu_IDCONTENU`) REFERENCES `titre` (`IDTITRE`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `fk_log_membre1` FOREIGN KEY (`membre_IDMEMBRE`) REFERENCES `membre` (`IDMEMBRE`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_log_typelog1` FOREIGN KEY (`typelog_IDTYPELOG`) REFERENCES `typelog` (`IDTYPELOG`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `titre`
--
ALTER TABLE `titre`
  ADD CONSTRAINT `fk_musique_genre1` FOREIGN KEY (`genre_IDGENRE`) REFERENCES `genre` (`IDGENRE`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;