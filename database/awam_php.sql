-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 24 oct. 2022 à 11:51
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `awam_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `awam_currency`
--

CREATE TABLE `awam_currency` (
  `Name` varchar(35) NOT NULL,
  `Name_reference` varchar(35) NOT NULL,
  `Percentage` float NOT NULL,
  `Id_reference` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `awam_currency`
--

INSERT INTO `awam_currency` (`Name`, `Name_reference`, `Percentage`, `Id_reference`) VALUES
('EURO', 'EUR', 1, 1),
('DOLLAR', 'USD', 1.32, 2);

-- --------------------------------------------------------

--
-- Structure de la table `awam_operation_list`
--

CREATE TABLE `awam_operation_list` (
  `Date` date NOT NULL DEFAULT current_timestamp(),
  `Currency_one` varchar(35) NOT NULL,
  `Amount_one` float NOT NULL,
  `Currency_two` varchar(35) NOT NULL,
  `Amount_two` float NOT NULL,
  `Total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `awam_operation_list`
--

INSERT INTO `awam_operation_list` (`Date`, `Currency_one`, `Amount_one`, `Currency_two`, `Amount_two`, `Total`) VALUES
('2022-10-23', '0', 9, '0', 2, 11),
('2022-10-23', '0', 9, '0', 2, 11),
('2022-10-23', '0', 9, '0', 2, 11),
('2022-10-23', '0', 9, '0', 2, 11),
('2022-10-23', 'EUR', 9, 'EUR', 2, 11),
('2022-10-23', 'EUR', 9, 'USD', 2, 11),
('2022-10-23', 'EUR', 9, 'USD', 2, 11),
('2022-10-23', 'EUR', 9.12, 'USD', 2, 11.76),
('2022-10-23', 'USD', 2, 'USD', 4, 6),
('2022-10-23', 'EUR', 3.1, 'EUR', 3.1, 6.2),
('2022-10-23', 'USD', 3.1, 'EUR', 3.1, 7.192),
('2022-10-23', 'EUR', 4.1, 'EUR', 2.1, 6.2),
('2022-10-23', 'USD', 4.1, 'EUR', 2.1, 7.512),
('2022-10-23', 'USD', 4.1, 'USD', 2.1, 6.2),
('2022-10-23', 'USD', 4.1, 'EUR', 5.1, 10.512),
('2022-10-23', 'USD', 0, 'EUR', 5.1, 5.1),
('2022-10-23', 'USD', 2, 'EUR', 5.1, 7.74),
('2022-10-23', 'EUR', 4.1, 'EUR', 2.1, 6.2),
('2022-10-23', 'EUR', 4.1, 'USD', 2.1, 6.872);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `awam_currency`
--
ALTER TABLE `awam_currency`
  ADD PRIMARY KEY (`Id_reference`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `awam_currency`
--
ALTER TABLE `awam_currency`
  MODIFY `Id_reference` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
