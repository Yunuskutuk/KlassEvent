-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 21 jan. 2021 à 15:41
-- Version du serveur :  8.0.22-0ubuntu0.20.04.3
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `klass_event`
--

-- --------------------------------------------------------

--
-- Structure de la table `translate`
--

CREATE TABLE `translate` (
  `id` int NOT NULL,
  `yaml_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `french` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `turkish` longtext COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `translate`
--

INSERT INTO `translate` (`id`, `yaml_key`, `french`, `turkish`) VALUES
(47, 'home.event', 'Livraison de repas pour Entreprises et Particuliers', 'İşletmeler ve bireyler için yemek teslimi'),
(48, 'home.traiteur', 'Organisation de mariage / Fêtes familiales / Wedding Planner', 'Düğün organizasyonu / aile kutlamaları / Düğün planlayıcısı'),
(49, 'event.slogan', 'Organisateur de Mariages clef en Main', 'Anahtar teslimi düğün planlayıcısı'),
(50, 'event.index.titre', 'Choisissez', 'Seç'),
(51, 'event.index.titre2', 'Votre événement', 'Senin olay'),
(52, 'event.index.step1.1', 'Créez votre mariage de rêve sur mesure', 'Size özel rüya düğününüzü yaratın'),
(53, 'event.index.step1.2', 'Remplissez un devis en ligne', 'Çevrimiçi bir teklif tamamlayın'),
(54, 'event.index.step2.1', 'Nous vous contactons', 'Biz sizinle iletişim'),
(55, 'event.index.step2.2', 'Vous bénéficiez de nos conseils et de notre expérience, pour que votre fête soit parfaite', 'Partinizi mükemmel hale getirmek için tavsiyelerimizden ve deneyimlerimizden yararlanın'),
(56, 'event.index.step3.1', 'Klass Event s\'occupe de tout', 'Klass Event her şeyi halleder'),
(57, 'event.index.step3.2', 'Vous êtes pleinement disponible le jour J', 'Büyük günde tamamen müsaitsin'),
(58, 'event.index.perimetre', 'Déplacements jusqu\'à 350km autour de Strasbourg', 'Strasbourg çevresinde 350 km\'ye kadar seyahat edin'),
(59, 'event.index.validation', 'C\'est parti !', 'Hadi gidelim !'),
(70, 'accueil', 'Accueil', 'Ev'),
(71, 'demande.devis', 'Demande de devis', 'Teklif isteği'),
(72, 'services', 'Services', 'Teklif isteği'),
(73, 'location', 'Location', 'Kiralama'),
(74, 'contact', 'Contact', 'İletişim'),
(75, 'livraison.footer', 'Détail des livraisons', 'Teslimat detayları'),
(76, 'menu.footer', 'Liste des menus', 'Menü listesi'),
(82, 'contact.footer', 'Nous contacter', 'Bize Ulaşın'),
(83, 'horaires.footer', 'Tous les jours de ...h... à ...h...', 'Her gün ... h ... ila ... h ...');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `translate`
--
ALTER TABLE `translate`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `translate`
--
ALTER TABLE `translate`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
