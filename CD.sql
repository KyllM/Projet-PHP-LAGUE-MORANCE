-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : mysql-5.7
-- Généré le : ven. 25 oct. 2024 à 16:10
-- Version du serveur : 5.7.28
-- Version de PHP : 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `kmorance_bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `CD`
--

CREATE TABLE `CD` (
  `idCD` int(11) NOT NULL,
  `titreCD` varchar(50) NOT NULL,
  `auteurCD` varchar(50) NOT NULL,
  `prixCD` float NOT NULL,
  `genreCD` varchar(50) NOT NULL,
  `lienImage` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `CD`
--

INSERT INTO `CD` (`idCD`, `titreCD`, `auteurCD`, `prixCD`, `genreCD`, `lienImage`) VALUES
(1, 'testCD', 'testAuteur', 10, 'testGenre', 'images/Compact_disc_album.jpg'),
(2, 'after hours', 'the weeknd', 25, 'Electro', 'images/after-hours.jpg'),
(3, 'deux frÃ¨re', 'pnl', 5, 'rap', 'images/photo.jpg'),
(4, 'vivaldi Winter Drill', 'Veneris', 50, 'DRILL', 'https://th.bing.com/th/id/OIP.QdL5PLsHXclm8FdccWOVRgAAAA?rs=1&pid=ImgDetMain');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `CD`
--
ALTER TABLE `CD`
  ADD PRIMARY KEY (`idCD`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `CD`
--
ALTER TABLE `CD`
  MODIFY `idCD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
