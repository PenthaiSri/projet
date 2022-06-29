-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 29 juin 2022 à 13:58
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet`
--

-- --------------------------------------------------------

--
-- Structure de la table `tr_arduino_sensors`
--

CREATE TABLE `tr_arduino_sensors` (
  `ars_id` int(5) NOT NULL COMMENT 'id des capteurs arduino',
  `ars_name` varchar(64) NOT NULL COMMENT 'nom des capteurs arduino'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table relationnelle des capteurs';

-- --------------------------------------------------------

--
-- Structure de la table `tr_fonctions`
--

CREATE TABLE `tr_fonctions` (
  `ftn_id` int(5) NOT NULL,
  `ftn_name` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table des fonctions des utilisateurs';

-- --------------------------------------------------------

--
-- Structure de la table `tr_roles`
--

CREATE TABLE `tr_roles` (
  `role_id` int(1) NOT NULL COMMENT 'id du role',
  `role_name` varchar(20) NOT NULL COMMENT 'nom du role'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table des roles';

--
-- Déchargement des données de la table `tr_roles`
--

INSERT INTO `tr_roles` (`role_id`, `role_name`) VALUES
(1, 'ADMIN');

-- --------------------------------------------------------

--
-- Structure de la table `tr_states`
--

CREATE TABLE `tr_states` (
  `ste_id` int(5) NOT NULL COMMENT 'id de l''etat',
  `ste_name` int(32) NOT NULL COMMENT 'nom de l''etat',
  `ste_description` text DEFAULT NULL COMMENT 'description de l''etat'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table relationnelle des etats';

-- --------------------------------------------------------

--
-- Structure de la table `t_modules`
--

CREATE TABLE `t_modules` (
  `mde_id` int(5) NOT NULL COMMENT 'id du module',
  `mde_name` varchar(32) NOT NULL COMMENT 'nom du module',
  `ste_id` int(5) NOT NULL COMMENT 'id de l''etat du module',
  `plant_name` int(64) NOT NULL COMMENT 'nom de la plante',
  `mde_description` text DEFAULT NULL COMMENT 'description du module',
  `mde_max_soil_moisture` double NOT NULL COMMENT 'humidite du sol max',
  `mde_min_max_soil_moisture` double NOT NULL COMMENT 'humidite du sol min',
  `watering_state` tinyint(1) NOT NULL COMMENT 'arrosage auto (true, false)',
  `log_created_by` int(11) NOT NULL,
  `log_created_at` datetime(6) NOT NULL,
  `log_modify_by` int(11) NOT NULL,
  `log_modify_at` datetime(6) NOT NULL,
  `log_deleted_by` int(11) NOT NULL,
  `log_deleted_at` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table des modules';

-- --------------------------------------------------------

--
-- Structure de la table `t_readings`
--

CREATE TABLE `t_readings` (
  `rdg_id` int(5) NOT NULL COMMENT 'id de l''enregistrement',
  `ars_id` int(5) NOT NULL COMMENT 'id du capteurs',
  `ste_id` int(5) NOT NULL COMMENT 'id de l''etat',
  `rdg_datetime` datetime(6) NOT NULL COMMENT 'date de l''enregistrement effectue',
  `rdg_temperature` double NOT NULL COMMENT 'temperature releve',
  `rdg_soil_moisture` double NOT NULL COMMENT 'humidite du sol releve',
  `rgd_air_humidity` double NOT NULL COMMENT 'humidite de l''air releve',
  `rdg_datetime_watering` datetime(6) DEFAULT NULL COMMENT 'date de l''arrosage'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table des enregistrements';

-- --------------------------------------------------------

--
-- Structure de la table `t_users`
--

CREATE TABLE `t_users` (
  `usr_id` int(5) NOT NULL COMMENT 'ID de l''utilisateur',
  `role_id` int(1) NOT NULL COMMENT 'id du role',
  `ftn_id` int(11) NOT NULL COMMENT 'id de la fonction de l''utilisateur',
  `usr_password` varchar(128) NOT NULL COMMENT 'mot de passe de l''utilisateur',
  `usr_firstname` varchar(20) NOT NULL COMMENT 'prénom de l''utilisateur',
  `usr_lastname` varchar(20) NOT NULL COMMENT 'nom de l''utilisateur',
  `ust_email` varchar(64) NOT NULL COMMENT 'email de l''utilisateur',
  `usr_phone` int(10) DEFAULT NULL COMMENT 'telephone de l''utilisateur',
  `log_created_at` datetime(6) DEFAULT NULL,
  `log_modify_at` datetime(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table des utilisateurs';

--
-- Déchargement des données de la table `t_users`
--

INSERT INTO `t_users` (`usr_id`, `role_id`, `ftn_id`, `usr_password`, `usr_firstname`, `usr_lastname`, `ust_email`, `usr_phone`, `log_created_at`, `log_modify_at`) VALUES
(1, 1, 0, '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19', 'Admin', 'Projet', '', NULL, NULL, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `tr_arduino_sensors`
--
ALTER TABLE `tr_arduino_sensors`
  ADD PRIMARY KEY (`ars_id`);

--
-- Index pour la table `tr_fonctions`
--
ALTER TABLE `tr_fonctions`
  ADD PRIMARY KEY (`ftn_id`);

--
-- Index pour la table `tr_roles`
--
ALTER TABLE `tr_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Index pour la table `tr_states`
--
ALTER TABLE `tr_states`
  ADD PRIMARY KEY (`ste_id`);

--
-- Index pour la table `t_modules`
--
ALTER TABLE `t_modules`
  ADD PRIMARY KEY (`mde_id`);

--
-- Index pour la table `t_readings`
--
ALTER TABLE `t_readings`
  ADD PRIMARY KEY (`rdg_id`);

--
-- Index pour la table `t_users`
--
ALTER TABLE `t_users`
  ADD PRIMARY KEY (`usr_id`),
  ADD KEY `fk_role_id` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `tr_arduino_sensors`
--
ALTER TABLE `tr_arduino_sensors`
  MODIFY `ars_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'id des capteurs arduino';

--
-- AUTO_INCREMENT pour la table `tr_roles`
--
ALTER TABLE `tr_roles`
  MODIFY `role_id` int(1) NOT NULL AUTO_INCREMENT COMMENT 'id du role', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `tr_states`
--
ALTER TABLE `tr_states`
  MODIFY `ste_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'id de l''etat';

--
-- AUTO_INCREMENT pour la table `t_modules`
--
ALTER TABLE `t_modules`
  MODIFY `mde_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'id du module';

--
-- AUTO_INCREMENT pour la table `t_readings`
--
ALTER TABLE `t_readings`
  MODIFY `rdg_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'id de l''enregistrement';

--
-- AUTO_INCREMENT pour la table `t_users`
--
ALTER TABLE `t_users`
  MODIFY `usr_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'ID de l''utilisateur', AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_users`
--
ALTER TABLE `t_users`
  ADD CONSTRAINT `fk_role_users` FOREIGN KEY (`role_id`) REFERENCES `tr_roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
