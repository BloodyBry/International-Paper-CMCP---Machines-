-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 23 juin 2024 à 16:37
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
-- Base de données : `machines`
--

-- --------------------------------------------------------

--
-- Structure de la table `machines_saisies`
--

CREATE TABLE `machines_saisies` (
  `id` int(11) NOT NULL,
  `nom_machine` varchar(255) NOT NULL,
  `description_machine` text NOT NULL,
  `date_achat` date NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `Mois` int(11) DEFAULT NULL,
  `Production_Brut` int(11) DEFAULT NULL,
  `Production_Net_Bob` int(11) DEFAULT NULL,
  `Production_Net_Finish` int(11) DEFAULT NULL,
  `Consommation_MP` int(11) DEFAULT NULL,
  `Rendement_fibreux_percent` int(11) DEFAULT NULL,
  `Tonnage_livree_casa` int(11) DEFAULT NULL,
  `Tonnage_livree_Agadir` int(11) DEFAULT NULL,
  `Tonnage_livree_tanger` int(11) DEFAULT NULL,
  `Total_livree` int(11) DEFAULT NULL,
  `Total_livree_cumul` int(11) DEFAULT NULL,
  `Total_Rebobinee` int(11) DEFAULT NULL,
  `PM3_productivity_finished_Ton_Day` int(11) DEFAULT NULL,
  `Taux_dechet_BOB` int(11) DEFAULT NULL,
  `Taux_dechet_Glob` int(11) DEFAULT NULL,
  `Taux_d_allure` int(11) DEFAULT NULL,
  `Speed_OME` int(11) DEFAULT NULL,
  `Disponibilite` int(11) DEFAULT NULL,
  `Performance` int(11) DEFAULT NULL,
  `Stock_final` int(11) DEFAULT NULL,
  `RUD` int(11) DEFAULT NULL,
  `Grammage_moy_g_m2` int(11) DEFAULT NULL,
  `laize_moy_cm` int(11) DEFAULT NULL,
  `Conso_eaux_m3_T` int(11) DEFAULT NULL,
  `Conso_amidon` int(11) DEFAULT NULL,
  `Conso_VAP` int(11) DEFAULT NULL,
  `Conso_KWH` int(11) DEFAULT NULL,
  `Mecanique` int(11) DEFAULT NULL,
  `elec_autom` int(11) DEFAULT NULL,
  `RAK` int(11) DEFAULT NULL,
  `Energie` int(11) DEFAULT NULL,
  `Habillage` int(11) DEFAULT NULL,
  `Chang_fab` int(11) DEFAULT NULL,
  `Cable` int(11) DEFAULT NULL,
  `Nbre_Casses` int(11) DEFAULT NULL,
  `Taux_Casses` int(11) DEFAULT NULL,
  `Production` int(11) DEFAULT NULL,
  `Nbre_Reclamation` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `machines_saisies`
--

INSERT INTO `machines_saisies` (`id`, `nom_machine`, `description_machine`, `date_achat`, `image_path`, `Mois`, `Production_Brut`, `Production_Net_Bob`, `Production_Net_Finish`, `Consommation_MP`, `Rendement_fibreux_percent`, `Tonnage_livree_casa`, `Tonnage_livree_Agadir`, `Tonnage_livree_tanger`, `Total_livree`, `Total_livree_cumul`, `Total_Rebobinee`, `PM3_productivity_finished_Ton_Day`, `Taux_dechet_BOB`, `Taux_dechet_Glob`, `Taux_d_allure`, `Speed_OME`, `Disponibilite`, `Performance`, `Stock_final`, `RUD`, `Grammage_moy_g_m2`, `laize_moy_cm`, `Conso_eaux_m3_T`, `Conso_amidon`, `Conso_VAP`, `Conso_KWH`, `Mecanique`, `elec_autom`, `RAK`, `Energie`, `Habillage`, `Chang_fab`, `Cable`, `Nbre_Casses`, `Taux_Casses`, `Production`, `Nbre_Reclamation`) VALUES
(103, 'caisse bkkk', 'hgtshsthrtsh', '2024-06-23', 'uploads/FreeImageKit.com_Img-size(250x150)px (1).jpg', 7, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47),
(104, 'caisszzzz', 'grqggqergrqeg', '2024-06-23', 'uploads/FreeImageKit.com_Img-size(250x150)px (1).jpg', 7, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47),
(105, 'hhhhhhhhhhhhhhhhhhh', 'htehshfhfdhsghh', '2022-12-14', 'uploads/FreeImageKit.com_Img-size(250x150)px (2).jpg', 7, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47),
(106, 'amiii', 'gfggfgfg', '2024-06-23', 'uploads/FreeImageKit.com_Img-size(250x150)px (1).jpg', 7, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47, 47);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `machines_saisies`
--
ALTER TABLE `machines_saisies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `machines_saisies`
--
ALTER TABLE `machines_saisies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
