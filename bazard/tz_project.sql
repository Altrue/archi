-- phpMyAdmin SQL Dump
-- version 4.3.6
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mer 01 Avril 2015 à 09:14
-- Version du serveur :  5.6.12-log
-- Version de PHP :  5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `tz_project`
--

-- --------------------------------------------------------

--
-- Structure de la table `timezone`
--

CREATE TABLE IF NOT EXISTS `TIMEZONE` (
  `id` int(11) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `gtm` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `USER` (
  `id` int(11) NOT NULL,
  `loginUser` varchar(100) NOT NULL,
  `mdpUser` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `zoneuser`
--

CREATE TABLE IF NOT EXISTS `ZONEUSER` (
  `id` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idZone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `timezone`
--
ALTER TABLE `TIMEZONE`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `zoneuser`
--
ALTER TABLE `ZONEUSER`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_id_user` (`idUser`), ADD KEY `fk_id_zone` (`idZone`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `timezone`
--
ALTER TABLE `TIMEZONE`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `USER`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `zoneuser`
--
ALTER TABLE `ZONEUSER`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `zoneuser`
--
ALTER TABLE `ZONEUSER`
ADD CONSTRAINT `fk_id_zone` FOREIGN KEY (`idZone`) REFERENCES `TIMEZONE` (`id`),
ADD CONSTRAINT `fk_id_user` FOREIGN KEY (`idUser`) REFERENCES `USER` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
