-- --------------------------------------------------------
-- Hôte :                        localhost
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             9.5.0.5332
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour gstock
CREATE DATABASE IF NOT EXISTS `gstock` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `gstock`;

-- Listage de la structure de la table gstock. amortissements
CREATE TABLE IF NOT EXISTS `amortissements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `taux` double NOT NULL,
  `duree_vie` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.amortissements : ~2 rows (environ)
/*!40000 ALTER TABLE `amortissements` DISABLE KEYS */;
INSERT INTO `amortissements` (`id`, `libelle`, `taux`, `duree_vie`, `created_at`, `updated_at`) VALUES
	(2, 'immobilier', 20, 5, '2020-01-08 00:21:41', '2020-01-08 00:21:51'),
	(3, 'Materiel informatique', 50, 2, '2020-01-08 00:26:44', '2020-01-08 00:26:44');
/*!40000 ALTER TABLE `amortissements` ENABLE KEYS */;

-- Listage de la structure de la table gstock. boutiques
CREATE TABLE IF NOT EXISTS `boutiques` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `telephone` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.boutiques : ~2 rows (environ)
/*!40000 ALTER TABLE `boutiques` DISABLE KEYS */;
INSERT INTO `boutiques` (`id`, `nom`, `adresse`, `telephone`, `created_at`, `updated_at`) VALUES
	(1, 'ETS MAWUPEASSI', 'lome-TOGO', 98765432, '2020-02-06 16:36:22', '2020-02-07 23:30:54'),
	(3, 'ETS GODWIN', 'Assigamé-TOGO', 98765432, '2020-02-07 10:58:48', '2020-02-07 23:30:39'),
	(4, 'ETS MAIN DIVINE', 'Assigamé-TOGO', 98765432, '2020-02-08 13:40:22', '2020-02-08 13:45:07');
/*!40000 ALTER TABLE `boutiques` ENABLE KEYS */;

-- Listage de la structure de la table gstock. caisses
CREATE TABLE IF NOT EXISTS `caisses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `caisses_user_id_index` (`user_id`),
  CONSTRAINT `caisses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.caisses : ~0 rows (environ)
/*!40000 ALTER TABLE `caisses` DISABLE KEYS */;
INSERT INTO `caisses` (`id`, `libelle`, `user_id`, `created_at`, `updated_at`) VALUES
	(1, 'CAISSE N* 1', 2, '2019-12-10 09:37:24', '2019-12-10 09:37:24');
/*!40000 ALTER TABLE `caisses` ENABLE KEYS */;

-- Listage de la structure de la table gstock. categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.categories : ~2 rows (environ)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `nom`, `description`, `created_at`, `updated_at`) VALUES
	(1, 'TOMATE', 'Produit fait a base de tomate', '2019-12-11 21:36:29', '2019-12-11 21:36:29'),
	(2, 'RIZ', 'Produit', '2019-12-11 21:37:00', '2019-12-11 21:37:00'),
	(3, 'HUILE', 'blablabla', '2020-01-22 21:35:34', '2020-01-22 21:35:34');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Listage de la structure de la table gstock. charges
CREATE TABLE IF NOT EXISTS `charges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT '2019-12-25 14:16:45',
  `journal_divers_id` int(10) unsigned DEFAULT NULL,
  `boutique_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `charges_journal_divers_id_index` (`journal_divers_id`),
  KEY `charges_boutique_id_foreign` (`boutique_id`),
  CONSTRAINT `charges_boutique_id_foreign` FOREIGN KEY (`boutique_id`) REFERENCES `boutiques` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `charges_journal_divers_id_foreign` FOREIGN KEY (`journal_divers_id`) REFERENCES `journal_divers` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.charges : ~4 rows (environ)
/*!40000 ALTER TABLE `charges` DISABLE KEYS */;
INSERT INTO `charges` (`id`, `libelle`, `montant`, `date`, `journal_divers_id`, `boutique_id`, `created_at`, `updated_at`) VALUES
	(1, 'Paiement d\'electricité', '25000', '2020-01-01 23:25:52', 1, 1, '2020-01-01 23:25:52', '2020-01-01 23:25:52'),
	(2, 'paiement de facture d\'eau', '15000', '2020-01-12 10:29:00', 2, 1, '2020-01-12 10:29:00', '2020-01-12 10:29:00'),
	(3, 'paiement de facture d\'eau', '15000', '2020-02-07 23:36:16', 3, 3, '2020-02-07 23:36:16', '2020-02-07 23:36:16'),
	(4, 'Paiementde la facture d\'electricité', '30000', '2020-02-07 23:36:43', 3, 3, '2020-02-07 23:36:43', '2020-02-07 23:36:43');
/*!40000 ALTER TABLE `charges` ENABLE KEYS */;

-- Listage de la structure de la table gstock. clients
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `boutique_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `clients_boutique_id_foreign` (`boutique_id`),
  CONSTRAINT `clients_boutique_id_foreign` FOREIGN KEY (`boutique_id`) REFERENCES `boutiques` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.clients : ~4 rows (environ)
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` (`id`, `nom`, `prenom`, `sexe`, `email`, `contact`, `boutique_id`, `created_at`, `updated_at`) VALUES
	(1, 'EDORH', 'Graca Bernadine', 'F', 'test@gmail.com', '99876543', 1, '2019-12-11 21:31:35', '2019-12-11 21:31:35'),
	(2, 'ZODJRAKPE', 'Pierre', 'M', 'test@gmail.com', '99225567', 1, '2019-12-11 21:33:32', '2019-12-11 21:33:32'),
	(3, 'TCHANTCHO', 'Leri', 'M', 'tchantcho10@gmail.com', '93605108', 1, '2019-12-17 19:32:38', '2019-12-17 19:32:38'),
	(4, 'H4', 'CC', 'M', 'yves@gmail.com', '4567890', 3, '2019-12-17 20:30:09', '2019-12-17 20:30:09'),
	(5, 'HOUNAKE', 'Kodjo Réné', 'M', 'rene@gmail.com', '4567890', 3, '2020-02-07 14:48:18', '2020-02-07 14:48:18');
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;

-- Listage de la structure de la table gstock. commandes
CREATE TABLE IF NOT EXISTS `commandes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_commande` datetime NOT NULL DEFAULT '2019-12-25 14:17:02',
  `journal_achat_id` int(10) unsigned DEFAULT NULL,
  `boutique_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commandes_journal_achat_id_index` (`journal_achat_id`),
  KEY `commandes_boutique_id_foreign` (`boutique_id`),
  CONSTRAINT `commandes_boutique_id_foreign` FOREIGN KEY (`boutique_id`) REFERENCES `boutiques` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `commandes_journal_achat_id_foreign` FOREIGN KEY (`journal_achat_id`) REFERENCES `journal_achats` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.commandes : ~12 rows (environ)
/*!40000 ALTER TABLE `commandes` DISABLE KEYS */;
INSERT INTO `commandes` (`id`, `numero`, `date_commande`, `journal_achat_id`, `boutique_id`, `created_at`, `updated_at`) VALUES
	(1, 'COM2019-1', '2019-12-26 06:52:51', 1, 1, '2019-12-26 06:52:51', '2019-12-26 06:52:51'),
	(2, 'COM2019-2', '2019-12-26 06:56:30', 2, 1, '2019-12-26 06:56:30', '2019-12-26 06:56:30'),
	(3, 'COM2020-3', '2020-01-14 23:21:16', 3, 1, '2020-01-14 23:21:16', '2020-01-14 23:21:16'),
	(4, 'COM2020-4', '2020-01-22 09:27:57', 7, 3, '2020-01-22 09:27:57', '2020-01-22 09:27:57'),
	(5, 'COM2020-5', '2020-01-22 09:49:36', 7, 3, '2020-01-22 09:49:36', '2020-01-22 09:49:36'),
	(6, 'COM2020-6', '2020-01-22 11:28:23', 7, 3, '2020-01-22 11:28:23', '2020-01-22 11:28:23'),
	(7, 'COM2020-7', '2020-01-22 11:40:03', 7, 3, '2020-01-22 11:40:03', '2020-01-22 11:40:03'),
	(8, 'COM2020-8', '2020-01-22 11:40:10', 7, 3, '2020-01-22 11:40:10', '2020-01-22 11:40:10'),
	(9, 'COM2020-9', '2020-01-22 11:40:17', 7, 3, '2020-01-22 11:40:17', '2020-01-22 11:40:17'),
	(10, 'COM2020-10', '2020-01-22 11:44:44', 7, 3, '2020-01-22 11:44:44', '2020-01-22 11:44:44'),
	(11, 'COM2020-11', '2020-01-22 11:55:57', 7, 3, '2020-01-22 11:55:57', '2020-01-22 11:55:57'),
	(12, 'COM2020-12', '2020-01-22 12:01:13', 7, 3, '2020-01-22 12:01:13', '2020-01-22 12:01:13');
/*!40000 ALTER TABLE `commandes` ENABLE KEYS */;

-- Listage de la structure de la table gstock. commande_modeles
CREATE TABLE IF NOT EXISTS `commande_modeles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `modele_fournisseur_id` int(10) unsigned DEFAULT NULL,
  `commande_id` int(10) unsigned DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `modele` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `commande_modeles_modele_fournisseur_id_index` (`modele_fournisseur_id`),
  KEY `commande_modeles_commande_id_index` (`commande_id`),
  CONSTRAINT `commande_modeles_commande_id_foreign` FOREIGN KEY (`commande_id`) REFERENCES `commandes` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `commande_modeles_modele_fournisseur_id_foreign` FOREIGN KEY (`modele_fournisseur_id`) REFERENCES `modele_fournisseurs` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.commande_modeles : ~13 rows (environ)
/*!40000 ALTER TABLE `commande_modeles` DISABLE KEYS */;
INSERT INTO `commande_modeles` (`id`, `modele_fournisseur_id`, `commande_id`, `quantite`, `prix`, `modele`, `total`, `etat`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 25, 5500, 1, 137500, 0, '2019-12-26 06:52:51', '2019-12-26 06:52:51'),
	(2, 3, 1, 100, 4000, 2, 400000, 0, '2019-12-26 06:52:52', '2019-12-26 06:52:52'),
	(3, 2, 2, 35, 15000, 3, 525000, 0, '2019-12-26 06:56:30', '2019-12-26 06:56:30'),
	(4, 4, 2, 100, 75000, 4, 7500000, 0, '2019-12-26 06:56:31', '2019-12-26 06:56:31'),
	(5, 1, 3, 100, 5500, 1, 550000, 0, '2020-01-14 23:21:16', '2020-01-14 23:21:16'),
	(6, 3, 3, 25, 4000, 2, 100000, 0, '2020-01-14 23:21:16', '2020-01-14 23:21:16'),
	(7, NULL, 4, 50, 14500, 6, 725000, 0, '2020-01-22 09:27:57', '2020-01-22 09:27:57'),
	(8, NULL, 4, 25, 4000, 8, 100000, 0, '2020-01-22 09:27:57', '2020-01-22 09:27:57'),
	(9, NULL, 5, 100, 7000, 5, 700000, 0, '2020-01-22 09:49:36', '2020-01-22 09:49:36'),
	(10, NULL, 5, 100, 4000, 7, 400000, 0, '2020-01-22 09:49:36', '2020-01-22 09:49:36'),
	(11, NULL, 6, 25, 4000, 3, 100000, 0, '2020-01-22 11:28:24', '2020-01-22 11:28:24'),
	(12, NULL, 6, 25, 3900, 7, 97500, 0, '2020-01-22 11:28:24', '2020-01-22 11:28:24'),
	(16, 5, 12, 100, 3900, 5, 390000, 1, '2020-01-22 12:01:13', '2020-01-22 12:01:13'),
	(17, 7, 12, 100, 3900, 6, 390000, 1, '2020-01-22 12:01:13', '2020-01-22 12:01:13');
/*!40000 ALTER TABLE `commande_modeles` ENABLE KEYS */;

-- Listage de la structure de la table gstock. employes
CREATE TABLE IF NOT EXISTS `employes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.employes : ~0 rows (environ)
/*!40000 ALTER TABLE `employes` DISABLE KEYS */;
/*!40000 ALTER TABLE `employes` ENABLE KEYS */;

-- Listage de la structure de la table gstock. factures
CREATE TABLE IF NOT EXISTS `factures` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prixapayer` int(11) NOT NULL,
  `vente_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `factures_vente_id_index` (`vente_id`),
  CONSTRAINT `factures_vente_id_foreign` FOREIGN KEY (`vente_id`) REFERENCES `ventes` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.factures : ~12 rows (environ)
/*!40000 ALTER TABLE `factures` DISABLE KEYS */;
INSERT INTO `factures` (`id`, `numero`, `prixapayer`, `vente_id`, `created_at`, `updated_at`) VALUES
	(1, 'FACT2020-1', 64000, 6, '2020-01-14 23:18:43', '2020-01-14 23:18:43'),
	(2, 'FACT2020-2', 106500, 7, '2020-01-31 06:28:20', '2020-01-31 06:28:20'),
	(3, 'FACT2020-3', 86900, 8, '2020-01-31 06:49:02', '2020-01-31 06:49:02'),
	(4, 'FACT2020-4', 30000, 9, '2020-02-05 13:37:06', '2020-02-05 13:37:06'),
	(5, 'FACT2020-5', 23700, 10, '2020-02-05 13:56:39', '2020-02-05 13:56:39'),
	(6, 'FACT2020-6', 150000, 11, '2020-02-05 13:59:41', '2020-02-05 13:59:41'),
	(7, 'FACT2020-7', 15800, 12, '2020-02-05 15:36:34', '2020-02-05 15:36:34'),
	(8, 'FACT2020-8', 15800, 13, '2020-02-09 20:51:38', '2020-02-09 20:51:38'),
	(9, 'FACT2020-9', 7900, 14, '2020-02-09 21:24:50', '2020-02-09 21:24:50'),
	(10, 'FACT2020-10', 7900, 15, '2020-02-09 21:29:49', '2020-02-09 21:29:49'),
	(11, 'FACT2020-11', 7900, 16, '2020-02-09 21:40:22', '2020-02-09 21:40:22'),
	(12, 'FACT2020-12', 7900, 17, '2020-02-09 21:41:59', '2020-02-09 21:41:59');
/*!40000 ALTER TABLE `factures` ENABLE KEYS */;

-- Listage de la structure de la table gstock. failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.failed_jobs : ~0 rows (environ)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Listage de la structure de la table gstock. fournisseurs
CREATE TABLE IF NOT EXISTS `fournisseurs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.fournisseurs : ~2 rows (environ)
/*!40000 ALTER TABLE `fournisseurs` DISABLE KEYS */;
INSERT INTO `fournisseurs` (`id`, `nom`, `adresse`, `contact`, `description`, `email`, `created_at`, `updated_at`) VALUES
	(1, 'DIEU EST GRAND', 'Assigamé', '99876543', 'vente de produits', 'test@gmail.com', '2019-12-14 15:49:13', '2019-12-14 15:49:13'),
	(2, 'GODWIN', 'Assigamé', '99225567', 'vente de produits bonita', 'test@gmail.com', '2019-12-14 15:49:41', '2019-12-14 15:49:41');
/*!40000 ALTER TABLE `fournisseurs` ENABLE KEYS */;

-- Listage de la structure de la table gstock. historiques
CREATE TABLE IF NOT EXISTS `historiques` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `actions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cible` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `historiques_user_id_index` (`user_id`),
  CONSTRAINT `historiques_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=868 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.historiques : ~263 rows (environ)
/*!40000 ALTER TABLE `historiques` DISABLE KEYS */;
INSERT INTO `historiques` (`id`, `actions`, `cible`, `etat`, `user_id`, `created_at`, `updated_at`) VALUES
	(603, 'Connecté', 'Compte', 0, 1, '2020-02-05 13:32:39', '2020-02-05 13:32:39'),
	(604, 'Connecté', 'Compte', 0, 1, '2020-02-05 13:32:40', '2020-02-05 13:32:40'),
	(605, 'Liste', 'Ventes', 0, 1, '2020-02-05 13:33:13', '2020-02-05 13:33:13'),
	(606, 'Liste', 'Ventes', 0, 1, '2020-02-05 13:35:01', '2020-02-05 13:35:01'),
	(607, 'liste', 'Reglements', 0, 1, '2020-02-05 13:35:24', '2020-02-05 13:35:24'),
	(608, 'Liste', 'Ventes', 0, 1, '2020-02-05 13:35:42', '2020-02-05 13:35:42'),
	(609, 'Creer', 'Journal', 0, 1, '2020-02-05 13:36:06', '2020-02-05 13:36:06'),
	(610, 'Creer', 'Ventes', 0, 1, '2020-02-05 13:37:06', '2020-02-05 13:37:06'),
	(611, 'Liste', 'Ventes', 0, 1, '2020-02-05 13:37:44', '2020-02-05 13:37:44'),
	(612, 'liste', 'Reglements', 0, 1, '2020-02-05 13:42:18', '2020-02-05 13:42:18'),
	(613, 'Liste', 'Ventes', 0, 1, '2020-02-05 13:44:22', '2020-02-05 13:44:22'),
	(614, 'liste', 'Reglements', 0, 1, '2020-02-05 13:44:54', '2020-02-05 13:44:54'),
	(615, 'Liste', 'Ventes', 0, 1, '2020-02-05 13:52:15', '2020-02-05 13:52:15'),
	(616, 'Liste', 'Ventes', 0, 1, '2020-02-05 13:56:02', '2020-02-05 13:56:02'),
	(617, 'Creer', 'Ventes', 0, 1, '2020-02-05 13:56:39', '2020-02-05 13:56:39'),
	(618, 'Liste', 'Ventes', 0, 1, '2020-02-05 13:57:25', '2020-02-05 13:57:25'),
	(619, 'Creer', 'Ventes', 0, 1, '2020-02-05 13:59:41', '2020-02-05 13:59:41'),
	(620, 'Liste', 'Ventes', 0, 1, '2020-02-05 14:10:09', '2020-02-05 14:10:09'),
	(621, 'liste', 'Reglements', 0, 1, '2020-02-05 14:10:31', '2020-02-05 14:10:31'),
	(622, 'Deconnexion', 'Compte', 0, 1, '2020-02-05 15:30:41', '2020-02-05 15:30:41'),
	(623, 'Connecté', 'Compte', 0, 1, '2020-02-05 15:30:52', '2020-02-05 15:30:52'),
	(624, 'Connecté', 'Compte', 0, 1, '2020-02-05 15:30:53', '2020-02-05 15:30:53'),
	(625, 'Liste', 'Ventes', 0, 1, '2020-02-05 15:31:06', '2020-02-05 15:31:06'),
	(626, 'Liste', 'Commandes', 0, 1, '2020-02-05 15:32:26', '2020-02-05 15:32:26'),
	(627, 'Liste', 'Ventes', 0, 1, '2020-02-05 15:35:59', '2020-02-05 15:35:59'),
	(628, 'Creer', 'Ventes', 0, 1, '2020-02-05 15:36:34', '2020-02-05 15:36:34'),
	(629, 'Liste', 'Ventes', 0, 1, '2020-02-05 15:37:27', '2020-02-05 15:37:27'),
	(630, 'Deconnexion', 'Compte', 0, 1, '2020-02-05 15:50:00', '2020-02-05 15:50:00'),
	(631, 'Connecté', 'Compte', 0, 1, '2020-02-06 07:52:32', '2020-02-06 07:52:32'),
	(632, 'Connecté', 'Compte', 0, 1, '2020-02-06 07:52:33', '2020-02-06 07:52:33'),
	(633, 'Connecté', 'Compte', 0, 1, '2020-02-06 07:59:14', '2020-02-06 07:59:14'),
	(634, 'Affichage', 'Compte', 0, 1, '2020-02-06 08:28:29', '2020-02-06 08:28:29'),
	(635, 'Connecté', 'Compte', 0, 1, '2020-02-06 16:29:45', '2020-02-06 16:29:45'),
	(636, 'Connecté', 'Compte', 0, 1, '2020-02-06 16:29:47', '2020-02-06 16:29:47'),
	(637, 'liste', 'Boutique', 0, 1, '2020-02-06 16:29:58', '2020-02-06 16:29:58'),
	(638, 'liste', 'Boutique', 0, 1, '2020-02-06 16:35:55', '2020-02-06 16:35:55'),
	(639, 'Creer', 'Boutique', 0, 1, '2020-02-06 16:36:22', '2020-02-06 16:36:22'),
	(640, 'detail', 'Boutique', 0, 1, '2020-02-06 16:36:27', '2020-02-06 16:36:27'),
	(641, 'detail', 'Boutique', 0, 1, '2020-02-06 16:36:34', '2020-02-06 16:36:34'),
	(642, 'modifier', 'Boutique', 0, 1, '2020-02-06 16:36:41', '2020-02-06 16:36:41'),
	(643, 'detail', 'Boutique', 0, 1, '2020-02-06 16:36:47', '2020-02-06 16:36:47'),
	(644, 'detail', 'Boutique', 0, 1, '2020-02-06 16:36:52', '2020-02-06 16:36:52'),
	(645, 'detail', 'Boutique', 0, 1, '2020-02-06 16:36:57', '2020-02-06 16:36:57'),
	(646, 'Creer', 'Boutique', 0, 1, '2020-02-06 16:37:25', '2020-02-06 16:37:25'),
	(647, 'supprimer', 'Boutique', 0, 1, '2020-02-06 16:37:34', '2020-02-06 16:37:34'),
	(648, 'Connecté', 'Compte', 0, 1, '2020-02-07 06:35:02', '2020-02-07 06:35:02'),
	(649, 'Connecté', 'Compte', 0, 1, '2020-02-07 06:35:03', '2020-02-07 06:35:03'),
	(650, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:11:47', '2020-02-07 09:11:47'),
	(651, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:11:48', '2020-02-07 09:11:48'),
	(652, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:12:53', '2020-02-07 09:12:53'),
	(653, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:14:12', '2020-02-07 09:14:12'),
	(654, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:17:02', '2020-02-07 09:17:02'),
	(655, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:17:43', '2020-02-07 09:17:43'),
	(656, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:27:05', '2020-02-07 09:27:05'),
	(657, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:28:32', '2020-02-07 09:28:32'),
	(658, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:29:47', '2020-02-07 09:29:47'),
	(659, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:31:07', '2020-02-07 09:31:07'),
	(660, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:33:11', '2020-02-07 09:33:11'),
	(661, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:34:22', '2020-02-07 09:34:22'),
	(662, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:35:28', '2020-02-07 09:35:28'),
	(663, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:37:20', '2020-02-07 09:37:20'),
	(664, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:38:43', '2020-02-07 09:38:43'),
	(665, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:39:01', '2020-02-07 09:39:01'),
	(666, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:39:16', '2020-02-07 09:39:16'),
	(667, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:39:37', '2020-02-07 09:39:37'),
	(668, 'Connecté', 'Compte', 0, 1, '2020-02-07 09:39:59', '2020-02-07 09:39:59'),
	(669, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 09:40:12', '2020-02-07 09:40:12'),
	(670, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 09:46:07', '2020-02-07 09:46:07'),
	(671, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 09:46:33', '2020-02-07 09:46:33'),
	(672, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 09:51:50', '2020-02-07 09:51:50'),
	(673, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 09:56:17', '2020-02-07 09:56:17'),
	(674, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 09:56:40', '2020-02-07 09:56:40'),
	(675, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 09:59:42', '2020-02-07 09:59:42'),
	(676, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 10:00:03', '2020-02-07 10:00:03'),
	(677, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 10:00:17', '2020-02-07 10:00:17'),
	(678, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 10:06:27', '2020-02-07 10:06:27'),
	(679, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 10:06:52', '2020-02-07 10:06:52'),
	(680, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 10:07:14', '2020-02-07 10:07:14'),
	(681, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 10:07:47', '2020-02-07 10:07:47'),
	(682, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 10:08:14', '2020-02-07 10:08:14'),
	(683, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 10:09:17', '2020-02-07 10:09:17'),
	(684, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 10:09:38', '2020-02-07 10:09:38'),
	(685, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 10:10:54', '2020-02-07 10:10:54'),
	(686, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 10:11:13', '2020-02-07 10:11:13'),
	(687, 'Liste', 'Fournisseurs', 0, 1, '2020-02-07 10:39:39', '2020-02-07 10:39:39'),
	(688, 'Deconnexion', 'Compte', 0, 1, '2020-02-07 10:40:02', '2020-02-07 10:40:02'),
	(689, 'Connecté', 'Compte', 0, 1, '2020-02-07 10:40:17', '2020-02-07 10:40:17'),
	(690, 'Connecté', 'Compte', 0, 1, '2020-02-07 10:40:18', '2020-02-07 10:40:18'),
	(691, 'Connecté', 'Compte', 0, 1, '2020-02-07 10:40:44', '2020-02-07 10:40:44'),
	(692, 'Liste', 'Utilisateurs', 0, 1, '2020-02-07 10:42:09', '2020-02-07 10:42:09'),
	(693, 'Liste', 'Utilisateurs', 0, 1, '2020-02-07 10:51:35', '2020-02-07 10:51:35'),
	(694, 'Liste', 'Utilisateurs', 0, 1, '2020-02-07 10:54:37', '2020-02-07 10:54:37'),
	(695, 'Detail', 'Utilisateurs', 0, 1, '2020-02-07 10:55:10', '2020-02-07 10:55:10'),
	(696, 'Liste', 'Utilisateurs', 0, 1, '2020-02-07 10:56:02', '2020-02-07 10:56:02'),
	(697, 'Connecté', 'Compte', 0, 1, '2020-02-07 10:57:59', '2020-02-07 10:57:59'),
	(698, 'liste', 'Boutique', 0, 1, '2020-02-07 10:58:01', '2020-02-07 10:58:01'),
	(699, 'Creer', 'Boutique', 0, 1, '2020-02-07 10:58:48', '2020-02-07 10:58:48'),
	(700, 'Liste', 'Utilisateurs', 0, 1, '2020-02-07 10:58:52', '2020-02-07 10:58:52'),
	(701, 'Creer', 'Utilisateurs', 0, 1, '2020-02-07 10:59:48', '2020-02-07 10:59:48'),
	(702, 'Deconnexion', 'Compte', 0, 1, '2020-02-07 10:59:54', '2020-02-07 10:59:54'),
	(703, 'Connecté', 'Compte', 0, 4, '2020-02-07 11:00:08', '2020-02-07 11:00:08'),
	(704, 'Deconnexion', 'Compte', 0, 4, '2020-02-07 11:02:01', '2020-02-07 11:02:01'),
	(705, 'Connecté', 'Compte', 0, 4, '2020-02-07 11:02:15', '2020-02-07 11:02:15'),
	(706, 'Connecté', 'Compte', 0, 4, '2020-02-07 11:02:17', '2020-02-07 11:02:17'),
	(707, 'Liste', 'Utilisateurs', 0, 4, '2020-02-07 11:02:27', '2020-02-07 11:02:27'),
	(708, 'Deconnexion', 'Compte', 0, 4, '2020-02-07 11:02:40', '2020-02-07 11:02:40'),
	(709, 'Connecté', 'Compte', 0, 1, '2020-02-07 11:02:54', '2020-02-07 11:02:54'),
	(710, 'Connecté', 'Compte', 0, 1, '2020-02-07 11:02:55', '2020-02-07 11:02:55'),
	(711, 'Connecté', 'Compte', 0, 1, '2020-02-07 11:16:11', '2020-02-07 11:16:11'),
	(712, 'Connecté', 'Compte', 0, 1, '2020-02-07 11:18:15', '2020-02-07 11:18:15'),
	(713, 'Connecté', 'Compte', 0, 1, '2020-02-07 11:21:20', '2020-02-07 11:21:20'),
	(714, 'liste', 'Clients', 0, 1, '2020-02-07 11:21:27', '2020-02-07 11:21:27'),
	(715, 'liste', 'Clients', 0, 1, '2020-02-07 11:22:38', '2020-02-07 11:22:38'),
	(716, 'liste', 'Clients', 0, 1, '2020-02-07 11:24:25', '2020-02-07 11:24:25'),
	(717, 'liste', 'Clients', 0, 1, '2020-02-07 11:25:46', '2020-02-07 11:25:46'),
	(718, 'Connecté', 'Compte', 0, 1, '2020-02-07 11:29:10', '2020-02-07 11:29:10'),
	(719, 'Liste', 'Modeles', 0, 1, '2020-02-07 11:29:15', '2020-02-07 11:29:15'),
	(720, 'Liste', 'Commandes', 0, 1, '2020-02-07 11:49:02', '2020-02-07 11:49:02'),
	(721, 'Liste', 'Commandes', 0, 1, '2020-02-07 11:53:03', '2020-02-07 11:53:03'),
	(722, 'Deconnexion', 'Compte', 0, 1, '2020-02-07 12:07:29', '2020-02-07 12:07:29'),
	(723, 'Connecté', 'Compte', 0, 4, '2020-02-07 12:07:42', '2020-02-07 12:07:42'),
	(724, 'Connecté', 'Compte', 0, 4, '2020-02-07 12:07:43', '2020-02-07 12:07:43'),
	(725, 'Liste', 'Modeles', 0, 4, '2020-02-07 12:07:50', '2020-02-07 12:07:50'),
	(726, 'Connecté', 'Compte', 0, 4, '2020-02-07 12:07:58', '2020-02-07 12:07:58'),
	(727, 'Liste', 'Commandes', 0, 4, '2020-02-07 12:08:10', '2020-02-07 12:08:10'),
	(728, 'Liste', 'Commandes', 0, 4, '2020-02-07 12:23:52', '2020-02-07 12:23:52'),
	(729, 'Liste', 'Ventes', 0, 4, '2020-02-07 12:23:58', '2020-02-07 12:23:58'),
	(730, 'Liste', 'Livraisons', 0, 4, '2020-02-07 12:24:18', '2020-02-07 12:24:18'),
	(731, 'liste', 'Charge', 0, 4, '2020-02-07 12:24:29', '2020-02-07 12:24:29'),
	(732, 'Liste', 'Ventes', 0, 4, '2020-02-07 12:24:41', '2020-02-07 12:24:41'),
	(733, 'Creer', 'Journal', 0, 4, '2020-02-07 12:24:56', '2020-02-07 12:24:56'),
	(734, 'Liste', 'Ventes', 0, 4, '2020-02-07 12:25:23', '2020-02-07 12:25:23'),
	(735, 'Connecté', 'Compte', 0, 4, '2020-02-07 14:42:39', '2020-02-07 14:42:39'),
	(736, 'Connecté', 'Compte', 0, 4, '2020-02-07 14:42:40', '2020-02-07 14:42:40'),
	(737, 'Liste', 'Ventes', 0, 4, '2020-02-07 14:42:51', '2020-02-07 14:42:51'),
	(738, 'Creer', 'Clients', 0, 4, '2020-02-07 14:48:18', '2020-02-07 14:48:18'),
	(739, 'Creer', 'Ventes', 0, 4, '2020-02-07 14:52:52', '2020-02-07 14:52:52'),
	(740, 'Connecté', 'Compte', 0, 4, '2020-02-07 19:09:03', '2020-02-07 19:09:03'),
	(741, 'Connecté', 'Compte', 0, 4, '2020-02-07 19:09:04', '2020-02-07 19:09:04'),
	(742, 'Liste', 'Ventes', 0, 4, '2020-02-07 19:21:28', '2020-02-07 19:21:28'),
	(743, 'Connecté', 'Compte', 0, 4, '2020-02-07 22:06:45', '2020-02-07 22:06:45'),
	(744, 'Connecté', 'Compte', 0, 4, '2020-02-07 22:06:46', '2020-02-07 22:06:46'),
	(745, 'Liste', 'Ventes', 0, 4, '2020-02-07 22:08:20', '2020-02-07 22:08:20'),
	(746, 'Creer', 'Ventes', 0, 4, '2020-02-07 22:10:10', '2020-02-07 22:10:10'),
	(747, 'Liste', 'Ventes', 0, 4, '2020-02-07 22:12:52', '2020-02-07 22:12:52'),
	(748, 'Connecté', 'Compte', 0, 4, '2020-02-07 22:13:21', '2020-02-07 22:13:21'),
	(749, 'Connecté', 'Compte', 0, 4, '2020-02-07 22:18:56', '2020-02-07 22:18:56'),
	(750, 'Connecté', 'Compte', 0, 4, '2020-02-07 22:37:52', '2020-02-07 22:37:52'),
	(751, 'Liste', 'Ventes', 0, 4, '2020-02-07 22:37:58', '2020-02-07 22:37:58'),
	(752, 'Liste', 'Ventes', 0, 4, '2020-02-07 22:37:59', '2020-02-07 22:37:59'),
	(753, 'Creer', 'Ventes', 0, 4, '2020-02-07 22:38:43', '2020-02-07 22:38:43'),
	(754, 'Liste', 'Ventes', 0, 4, '2020-02-07 22:45:15', '2020-02-07 22:45:15'),
	(755, 'Creer', 'Ventes', 0, 4, '2020-02-07 22:46:48', '2020-02-07 22:46:48'),
	(756, 'Creer', 'Ventes', 0, 4, '2020-02-07 22:53:34', '2020-02-07 22:53:34'),
	(757, 'Creer', 'Ventes', 0, 4, '2020-02-07 22:56:50', '2020-02-07 22:56:50'),
	(758, 'Connecté', 'Compte', 0, 4, '2020-02-07 23:01:35', '2020-02-07 23:01:35'),
	(759, 'Connecté', 'Compte', 0, 4, '2020-02-07 23:07:26', '2020-02-07 23:07:26'),
	(760, 'Connecté', 'Compte', 0, 4, '2020-02-07 23:09:40', '2020-02-07 23:09:40'),
	(761, 'Connecté', 'Compte', 0, 4, '2020-02-07 23:11:00', '2020-02-07 23:11:00'),
	(762, 'Connecté', 'Compte', 0, 4, '2020-02-07 23:14:07', '2020-02-07 23:14:07'),
	(763, 'Connecté', 'Compte', 0, 4, '2020-02-07 23:28:21', '2020-02-07 23:28:21'),
	(764, 'Liste', 'Modeles', 0, 4, '2020-02-07 23:28:41', '2020-02-07 23:28:41'),
	(765, 'Creer', 'Modeles', 0, 4, '2020-02-07 23:29:34', '2020-02-07 23:29:34'),
	(766, 'Detail', 'Modeles', 0, 4, '2020-02-07 23:29:41', '2020-02-07 23:29:41'),
	(767, 'Detail', 'Modeles', 0, 4, '2020-02-07 23:29:51', '2020-02-07 23:29:51'),
	(768, 'Detail', 'Modeles', 0, 4, '2020-02-07 23:30:02', '2020-02-07 23:30:02'),
	(769, 'liste', 'Boutique', 0, 4, '2020-02-07 23:30:17', '2020-02-07 23:30:17'),
	(770, 'detail', 'Boutique', 0, 4, '2020-02-07 23:30:28', '2020-02-07 23:30:28'),
	(771, 'modifier', 'Boutique', 0, 4, '2020-02-07 23:30:39', '2020-02-07 23:30:39'),
	(772, 'detail', 'Boutique', 0, 4, '2020-02-07 23:30:46', '2020-02-07 23:30:46'),
	(773, 'modifier', 'Boutique', 0, 4, '2020-02-07 23:30:54', '2020-02-07 23:30:54'),
	(774, 'Deconnexion', 'Compte', 0, 4, '2020-02-07 23:31:01', '2020-02-07 23:31:01'),
	(775, 'Connecté', 'Compte', 0, 1, '2020-02-07 23:31:20', '2020-02-07 23:31:20'),
	(776, 'Connecté', 'Compte', 0, 1, '2020-02-07 23:31:23', '2020-02-07 23:31:23'),
	(777, 'liste', 'Charge', 0, 1, '2020-02-07 23:33:25', '2020-02-07 23:33:25'),
	(778, 'Detail', 'Charge', 0, 1, '2020-02-07 23:33:38', '2020-02-07 23:33:38'),
	(779, 'Modifier', 'Clients', 0, 1, '2020-02-07 23:33:38', '2020-02-07 23:33:38'),
	(780, 'liste', 'Immobilisation', 0, 1, '2020-02-07 23:33:56', '2020-02-07 23:33:56'),
	(781, 'Modifier', 'Immobilisation', 0, 1, '2020-02-07 23:34:28', '2020-02-07 23:34:28'),
	(782, 'Deconnexion', 'Compte', 0, 1, '2020-02-07 23:34:43', '2020-02-07 23:34:43'),
	(783, 'Connecté', 'Compte', 0, 4, '2020-02-07 23:35:05', '2020-02-07 23:35:05'),
	(784, 'Connecté', 'Compte', 0, 4, '2020-02-07 23:35:07', '2020-02-07 23:35:07'),
	(785, 'liste', 'Charge', 0, 4, '2020-02-07 23:35:31', '2020-02-07 23:35:31'),
	(786, 'Creer', 'Journal des achats', 0, 4, '2020-02-07 23:35:54', '2020-02-07 23:35:54'),
	(787, 'Creer', 'Charges', 0, 4, '2020-02-07 23:36:16', '2020-02-07 23:36:16'),
	(788, 'Creer', 'Charges', 0, 4, '2020-02-07 23:36:43', '2020-02-07 23:36:43'),
	(789, 'liste', 'Immobilisation', 0, 4, '2020-02-07 23:37:38', '2020-02-07 23:37:38'),
	(790, 'Connecté', 'Compte', 0, 1, '2020-02-08 13:38:05', '2020-02-08 13:38:05'),
	(791, 'Connecté', 'Compte', 0, 1, '2020-02-08 13:38:07', '2020-02-08 13:38:07'),
	(792, 'liste', 'Boutique', 0, 1, '2020-02-08 13:38:15', '2020-02-08 13:38:15'),
	(793, 'Creer', 'Boutique', 0, 1, '2020-02-08 13:40:23', '2020-02-08 13:40:23'),
	(794, 'Liste', 'Utilisateurs', 0, 1, '2020-02-08 13:43:58', '2020-02-08 13:43:58'),
	(795, 'liste', 'Boutique', 0, 1, '2020-02-08 13:44:31', '2020-02-08 13:44:31'),
	(796, 'detail', 'Boutique', 0, 1, '2020-02-08 13:44:43', '2020-02-08 13:44:43'),
	(797, 'modifier', 'Boutique', 0, 1, '2020-02-08 13:45:07', '2020-02-08 13:45:07'),
	(798, 'Liste', 'Utilisateurs', 0, 1, '2020-02-08 13:45:22', '2020-02-08 13:45:22'),
	(799, 'Creer', 'Utilisateurs', 0, 1, '2020-02-08 13:46:47', '2020-02-08 13:46:47'),
	(800, 'Deconnexion', 'Compte', 0, 1, '2020-02-08 13:46:53', '2020-02-08 13:46:53'),
	(801, 'Connecté', 'Compte', 0, 5, '2020-02-08 13:47:24', '2020-02-08 13:47:24'),
	(802, 'Connecté', 'Compte', 0, 5, '2020-02-08 13:47:25', '2020-02-08 13:47:25'),
	(803, 'Connecté', 'Compte', 0, 1, '2020-02-09 09:14:40', '2020-02-09 09:14:40'),
	(804, 'Connecté', 'Compte', 0, 1, '2020-02-09 09:14:42', '2020-02-09 09:14:42'),
	(805, 'Connecté', 'Compte', 0, 1, '2020-02-09 09:34:29', '2020-02-09 09:34:29'),
	(806, 'Connecté', 'Compte', 0, 1, '2020-02-09 09:34:29', '2020-02-09 09:34:29'),
	(807, 'Deconnexion', 'Compte', 0, 1, '2020-02-09 09:40:21', '2020-02-09 09:40:21'),
	(808, 'Connecté', 'Compte', 0, 4, '2020-02-09 09:40:45', '2020-02-09 09:40:45'),
	(809, 'Connecté', 'Compte', 0, 4, '2020-02-09 09:40:46', '2020-02-09 09:40:46'),
	(810, 'Liste', 'Commandes', 0, 4, '2020-02-09 09:40:56', '2020-02-09 09:40:56'),
	(811, 'Deconnexion', 'Compte', 0, 4, '2020-02-09 10:07:59', '2020-02-09 10:07:59'),
	(812, 'Liste', 'Commandes', 0, 1, '2020-02-09 10:08:13', '2020-02-09 10:08:13'),
	(813, 'Connecté', 'Compte', 0, 5, '2020-02-09 10:08:43', '2020-02-09 10:08:43'),
	(814, 'Connecté', 'Compte', 0, 5, '2020-02-09 10:08:45', '2020-02-09 10:08:45'),
	(815, 'Liste', 'Commandes', 0, 5, '2020-02-09 10:08:55', '2020-02-09 10:08:55'),
	(816, 'Liste', 'Utilisateurs', 0, 1, '2020-02-09 11:01:25', '2020-02-09 11:01:25'),
	(817, 'Liste', 'Utilisateurs', 0, 1, '2020-02-09 11:01:27', '2020-02-09 11:01:27'),
	(818, 'Creer', 'Utilisateurs', 0, 1, '2020-02-09 11:04:17', '2020-02-09 11:04:17'),
	(819, 'Deconnexion', 'Compte', 0, 1, '2020-02-09 12:44:33', '2020-02-09 12:44:33'),
	(820, 'Connecté', 'Compte', 0, 6, '2020-02-09 12:45:07', '2020-02-09 12:45:07'),
	(821, 'Connecté', 'Compte', 0, 6, '2020-02-09 12:45:37', '2020-02-09 12:45:37'),
	(822, 'liste', 'Boutique', 0, 6, '2020-02-09 12:45:57', '2020-02-09 12:45:57'),
	(823, 'Connecté', 'Compte', 0, 6, '2020-02-09 12:47:07', '2020-02-09 12:47:07'),
	(824, 'Connecté', 'Compte', 0, 6, '2020-02-09 12:57:25', '2020-02-09 12:57:25'),
	(825, 'Connecté', 'Compte', 0, 6, '2020-02-09 12:58:40', '2020-02-09 12:58:40'),
	(826, 'Connecté', 'Compte', 0, 6, '2020-02-09 12:59:19', '2020-02-09 12:59:19'),
	(827, 'Deconnexion', 'Compte', 0, 6, '2020-02-09 13:00:51', '2020-02-09 13:00:51'),
	(828, 'Connecté', 'Compte', 0, 6, '2020-02-09 13:01:07', '2020-02-09 13:01:07'),
	(829, 'liste', 'Boutique', 0, 6, '2020-02-09 13:03:09', '2020-02-09 13:03:09'),
	(830, 'Connecté', 'Compte', 0, 6, '2020-02-09 13:04:11', '2020-02-09 13:04:11'),
	(831, 'Connecté', 'Compte', 0, 6, '2020-02-09 13:04:46', '2020-02-09 13:04:46'),
	(832, 'Affichage', 'Compte', 0, 6, '2020-02-09 13:05:20', '2020-02-09 13:05:20'),
	(833, 'Connecté', 'Compte', 0, 5, '2020-02-09 13:07:36', '2020-02-09 13:07:36'),
	(834, 'Connecté', 'Compte', 0, 5, '2020-02-09 13:07:38', '2020-02-09 13:07:38'),
	(835, 'Liste', 'Utilisateurs', 0, 5, '2020-02-09 13:07:57', '2020-02-09 13:07:57'),
	(836, 'Liste', 'Ventes', 0, 5, '2020-02-09 13:12:06', '2020-02-09 13:12:06'),
	(837, 'Affichage', 'Compte', 0, 6, '2020-02-09 13:22:41', '2020-02-09 13:22:41'),
	(838, 'Liste', 'Ventes', 0, 5, '2020-02-09 13:24:57', '2020-02-09 13:24:57'),
	(839, 'Affichage', 'Compte', 0, 6, '2020-02-09 13:53:18', '2020-02-09 13:53:18'),
	(840, 'Connecté', 'Compte', 0, 6, '2020-02-09 18:23:42', '2020-02-09 18:23:42'),
	(841, 'Connecté', 'Compte', 0, 1, '2020-02-09 20:35:17', '2020-02-09 20:35:17'),
	(842, 'Connecté', 'Compte', 0, 1, '2020-02-09 20:35:21', '2020-02-09 20:35:21'),
	(843, 'liste', 'Charge', 0, 1, '2020-02-09 20:36:06', '2020-02-09 20:36:06'),
	(844, 'Liste', 'Ventes', 0, 1, '2020-02-09 20:50:44', '2020-02-09 20:50:44'),
	(845, 'Creer', 'Ventes', 0, 1, '2020-02-09 20:51:38', '2020-02-09 20:51:38'),
	(846, 'Liste', 'Ventes', 0, 1, '2020-02-09 20:57:51', '2020-02-09 20:57:51'),
	(847, 'Liste', 'Ventes', 0, 1, '2020-02-09 21:17:35', '2020-02-09 21:17:35'),
	(848, 'Deconnexion', 'Compte', 0, 1, '2020-02-09 21:22:37', '2020-02-09 21:22:37'),
	(849, 'Connecté', 'Compte', 0, 4, '2020-02-09 21:22:49', '2020-02-09 21:22:49'),
	(850, 'Connecté', 'Compte', 0, 4, '2020-02-09 21:22:50', '2020-02-09 21:22:50'),
	(851, 'Liste', 'Ventes', 0, 4, '2020-02-09 21:22:56', '2020-02-09 21:22:56'),
	(852, 'Creer', 'Ventes', 0, 4, '2020-02-09 21:24:50', '2020-02-09 21:24:50'),
	(853, 'Creer', 'Ventes', 0, 4, '2020-02-09 21:29:49', '2020-02-09 21:29:49'),
	(854, 'Creer', 'Ventes', 0, 4, '2020-02-09 21:40:22', '2020-02-09 21:40:22'),
	(855, 'Liste', 'Ventes', 0, 4, '2020-02-09 21:41:01', '2020-02-09 21:41:01'),
	(856, 'Creer', 'Ventes', 0, 4, '2020-02-09 21:41:59', '2020-02-09 21:41:59'),
	(857, 'Liste', 'Ventes', 0, 4, '2020-02-09 21:42:14', '2020-02-09 21:42:14'),
	(858, 'Liste', 'Ventes', 0, 4, '2020-02-09 21:43:06', '2020-02-09 21:43:06'),
	(859, 'liste', 'Reglements', 0, 4, '2020-02-09 21:43:08', '2020-02-09 21:43:08'),
	(860, 'Liste', 'Ventes', 0, 4, '2020-02-09 21:43:13', '2020-02-09 21:43:13'),
	(861, 'liste', 'Reglements', 0, 4, '2020-02-09 21:43:16', '2020-02-09 21:43:16'),
	(862, 'liste', 'Reglements', 0, 4, '2020-02-09 21:47:33', '2020-02-09 21:47:33'),
	(863, 'Liste', 'Ventes', 0, 4, '2020-02-09 21:57:23', '2020-02-09 21:57:23'),
	(864, 'Liste', 'Ventes', 0, 4, '2020-02-09 22:16:51', '2020-02-09 22:16:51'),
	(865, 'liste', 'Reglements', 0, 4, '2020-02-09 22:16:54', '2020-02-09 22:16:54'),
	(866, 'liste', 'Reglements', 0, 4, '2020-02-09 22:19:24', '2020-02-09 22:19:24'),
	(867, 'Deconnexion', 'Compte', 0, 6, '2020-02-09 23:07:35', '2020-02-09 23:07:35');
/*!40000 ALTER TABLE `historiques` ENABLE KEYS */;

-- Listage de la structure de la table gstock. immobilisations
CREATE TABLE IF NOT EXISTS `immobilisations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL DEFAULT '2019-12-25',
  `user_id` int(10) unsigned DEFAULT NULL,
  `amortissement_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `immobilisations_user_id_index` (`user_id`),
  KEY `immobilisations_amortissement_id_index` (`amortissement_id`),
  CONSTRAINT `immobilisations_amortissement_id_foreign` FOREIGN KEY (`amortissement_id`) REFERENCES `amortissements` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `immobilisations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.immobilisations : ~4 rows (environ)
/*!40000 ALTER TABLE `immobilisations` DISABLE KEYS */;
INSERT INTO `immobilisations` (`id`, `libelle`, `montant`, `date`, `user_id`, `amortissement_id`, `created_at`, `updated_at`) VALUES
	(1, 'Ordinateur', '250000', '2020-01-08', 1, 3, '2020-01-08 01:00:27', '2020-01-08 02:42:24'),
	(2, 'chaise', '20000', '2020-01-07', 1, 2, '2020-01-08 01:13:44', '2020-01-08 01:14:14'),
	(3, 'Imprimante', '100000', '2020-01-12', 1, 3, '2020-01-12 11:22:49', '2020-01-12 11:22:49'),
	(4, 'Table de bureau', '160000', '2020-01-12', 1, 2, '2020-01-12 11:23:25', '2020-01-12 11:23:25');
/*!40000 ALTER TABLE `immobilisations` ENABLE KEYS */;

-- Listage de la structure de la table gstock. inventaires
CREATE TABLE IF NOT EXISTS `inventaires` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `date_inventaire` datetime NOT NULL DEFAULT '2019-12-25 14:16:56',
  `etat` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inventaires_user_id_index` (`user_id`),
  CONSTRAINT `inventaires_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.inventaires : ~2 rows (environ)
/*!40000 ALTER TABLE `inventaires` DISABLE KEYS */;
INSERT INTO `inventaires` (`id`, `numero`, `user_id`, `date_inventaire`, `etat`, `created_at`, `updated_at`) VALUES
	(1, 'INVENT2020-1', 1, '2019-12-25 14:16:56', 0, '2020-01-19 13:21:03', '2020-01-19 13:21:03');
/*!40000 ALTER TABLE `inventaires` ENABLE KEYS */;

-- Listage de la structure de la table gstock. inventaire_modeles
CREATE TABLE IF NOT EXISTS `inventaire_modeles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quantite_reelle` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `modele_id` int(10) unsigned DEFAULT NULL,
  `inventaire_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `inventaire_modeles_modele_id_index` (`modele_id`),
  KEY `inventaire_modeles_inventaire_id_index` (`inventaire_id`),
  CONSTRAINT `inventaire_modeles_inventaire_id_foreign` FOREIGN KEY (`inventaire_id`) REFERENCES `inventaires` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `inventaire_modeles_modele_id_foreign` FOREIGN KEY (`modele_id`) REFERENCES `modeles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.inventaire_modeles : ~4 rows (environ)
/*!40000 ALTER TABLE `inventaire_modeles` DISABLE KEYS */;
INSERT INTO `inventaire_modeles` (`id`, `quantite_reelle`, `quantite`, `modele_id`, `inventaire_id`, `created_at`, `updated_at`) VALUES
	(5, 600, 620, 2, 1, '2020-01-19 14:06:39', '2020-01-19 14:06:39'),
	(6, 400, 450, 4, 1, '2020-01-19 14:06:47', '2020-01-19 14:06:47'),
	(7, 350, 345, 1, 1, '2020-01-19 14:07:00', '2020-01-19 14:07:00'),
	(8, 450, 400, 3, 1, '2020-01-19 14:07:16', '2020-01-19 14:07:16');
/*!40000 ALTER TABLE `inventaire_modeles` ENABLE KEYS */;

-- Listage de la structure de la table gstock. journals
CREATE TABLE IF NOT EXISTS `journals` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_creation` datetime NOT NULL DEFAULT '2019-12-25 14:16:25',
  `date_fermeture` datetime DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `mois` int(10) unsigned DEFAULT NULL,
  `annee` int(10) unsigned DEFAULT NULL,
  `boutique_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `journals_user_id_index` (`user_id`),
  KEY `journals_boutique_id_foreign` (`boutique_id`),
  CONSTRAINT `journals_boutique_id_foreign` FOREIGN KEY (`boutique_id`) REFERENCES `boutiques` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `journals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.journals : ~4 rows (environ)
/*!40000 ALTER TABLE `journals` DISABLE KEYS */;
INSERT INTO `journals` (`id`, `date_creation`, `date_fermeture`, `user_id`, `mois`, `annee`, `boutique_id`, `created_at`, `updated_at`) VALUES
	(1, '2019-12-25 14:16:25', '2020-01-14 23:17:18', 1, 12, 2019, 1, NULL, '2020-01-14 23:17:18'),
	(2, '2020-01-14 23:17:18', '2020-01-31 06:48:10', 1, 1, 2020, 1, '2020-01-14 23:17:18', '2020-01-31 06:48:10'),
	(3, '2020-01-31 06:48:11', '2020-02-05 13:36:06', 1, 1, 2020, 1, '2020-01-31 06:48:11', '2020-02-05 13:36:06'),
	(4, '2020-02-05 13:36:06', '2020-02-07 12:24:56', 1, 2, 2020, 1, '2020-02-05 13:36:06', '2020-02-07 12:24:56'),
	(5, '2020-02-07 12:24:56', NULL, 4, 2, 2020, 3, '2020-02-07 12:24:56', '2020-02-07 12:24:56');
/*!40000 ALTER TABLE `journals` ENABLE KEYS */;

-- Listage de la structure de la table gstock. journal_achats
CREATE TABLE IF NOT EXISTS `journal_achats` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_creation` datetime NOT NULL DEFAULT '2019-12-25 00:00:00',
  `date_fermeture` datetime DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `mois` int(10) unsigned DEFAULT NULL,
  `annee` int(10) unsigned DEFAULT NULL,
  `boutique_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `journal_achats_user_id_index` (`user_id`),
  KEY `journal_achats_boutique_id_foreign` (`boutique_id`),
  CONSTRAINT `journal_achats_boutique_id_foreign` FOREIGN KEY (`boutique_id`) REFERENCES `boutiques` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `journal_achats_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.journal_achats : ~7 rows (environ)
/*!40000 ALTER TABLE `journal_achats` DISABLE KEYS */;
INSERT INTO `journal_achats` (`id`, `date_creation`, `date_fermeture`, `user_id`, `mois`, `annee`, `boutique_id`, `created_at`, `updated_at`) VALUES
	(1, '2019-12-26 00:00:00', '2019-12-26 07:17:05', 1, 12, 2019, 1, '2019-12-26 07:15:19', '2019-12-26 07:17:05'),
	(2, '2019-12-27 00:00:00', '2019-12-26 07:20:22', 1, 12, 2019, 1, '2019-12-26 07:19:37', '2019-12-26 07:20:22'),
	(3, '2020-01-01 00:00:00', '2020-01-01 01:14:57', 1, 1, 2020, 1, '2020-01-01 01:14:07', '2020-01-01 01:14:57'),
	(4, '2020-01-01 00:00:00', '2020-01-16 07:52:49', 1, 1, 2020, 1, '2020-01-01 01:15:12', '2020-01-16 07:52:49'),
	(5, '2020-01-16 07:54:32', '2020-01-16 12:15:33', 1, 1, 2020, 1, '2020-01-16 07:54:32', '2020-01-16 12:15:33'),
	(6, '2020-01-16 12:20:16', '2020-01-16 12:20:30', 1, 1, 2020, 3, '2020-01-16 12:20:16', '2020-01-16 12:20:16'),
	(7, '2020-01-16 12:25:50', NULL, 1, 1, 2020, 3, '2020-01-16 12:25:51', '2020-01-16 12:25:51');
/*!40000 ALTER TABLE `journal_achats` ENABLE KEYS */;

-- Listage de la structure de la table gstock. journal_divers
CREATE TABLE IF NOT EXISTS `journal_divers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_creation` datetime NOT NULL DEFAULT '2019-12-25 14:16:44',
  `date_fermeture` datetime DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `mois` int(10) unsigned DEFAULT NULL,
  `annee` int(10) unsigned DEFAULT NULL,
  `boutique_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `journal_divers_user_id_index` (`user_id`),
  KEY `journal_divers_boutique_id_foreign` (`boutique_id`),
  CONSTRAINT `journal_divers_boutique_id_foreign` FOREIGN KEY (`boutique_id`) REFERENCES `boutiques` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `journal_divers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.journal_divers : ~2 rows (environ)
/*!40000 ALTER TABLE `journal_divers` DISABLE KEYS */;
INSERT INTO `journal_divers` (`id`, `date_creation`, `date_fermeture`, `user_id`, `mois`, `annee`, `boutique_id`, `created_at`, `updated_at`) VALUES
	(1, '2020-01-01 23:32:03', '2020-01-01 23:34:30', 1, 1, 2020, 1, '2020-01-01 23:32:03', '2020-01-01 23:34:30'),
	(2, '2020-01-12 10:28:44', '2020-01-17 07:57:21', 1, 1, 2020, 1, '2020-01-12 10:28:44', '2020-01-12 10:28:44'),
	(3, '2020-02-07 23:35:54', NULL, 4, 2, 2020, 3, '2020-02-07 23:35:54', '2020-02-07 23:35:54');
/*!40000 ALTER TABLE `journal_divers` ENABLE KEYS */;

-- Listage de la structure de la table gstock. livraisons
CREATE TABLE IF NOT EXISTS `livraisons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_livraison` datetime NOT NULL DEFAULT '2019-12-25 14:17:06',
  `boutique_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `livraisons_boutique_id_foreign` (`boutique_id`),
  CONSTRAINT `livraisons_boutique_id_foreign` FOREIGN KEY (`boutique_id`) REFERENCES `boutiques` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.livraisons : ~20 rows (environ)
/*!40000 ALTER TABLE `livraisons` DISABLE KEYS */;
INSERT INTO `livraisons` (`id`, `numero`, `date_livraison`, `boutique_id`, `created_at`, `updated_at`) VALUES
	(13, 'LIV2020-1', '2020-01-13 23:35:09', 1, '2020-01-13 23:35:09', '2020-01-13 23:35:09'),
	(14, 'LIV2020-14', '2020-01-13 23:38:19', 1, '2020-01-13 23:38:20', '2020-01-13 23:38:20'),
	(15, 'LIV2020-15', '2020-01-13 23:56:50', 1, '2020-01-13 23:56:50', '2020-01-13 23:56:50'),
	(16, 'LIV2020-16', '2020-01-13 23:56:53', 1, '2020-01-13 23:56:53', '2020-01-13 23:56:53'),
	(17, 'LIV2020-17', '2020-01-13 23:56:56', 1, '2020-01-13 23:56:56', '2020-01-13 23:56:56'),
	(18, 'LIV2020-18', '2020-01-13 23:56:57', 1, '2020-01-13 23:56:57', '2020-01-13 23:56:57'),
	(19, 'LIV2020-19', '2020-01-13 23:56:58', 1, '2020-01-13 23:56:58', '2020-01-13 23:56:58'),
	(20, 'LIV2020-20', '2020-01-13 23:56:58', 1, '2020-01-13 23:56:58', '2020-01-13 23:56:58'),
	(21, 'LIV2020-21', '2020-01-13 23:56:59', 1, '2020-01-13 23:56:59', '2020-01-13 23:56:59'),
	(22, 'LIV2020-22', '2020-01-13 23:57:00', 1, '2020-01-13 23:57:00', '2020-01-13 23:57:00'),
	(23, 'LIV2020-23', '2020-01-13 23:57:00', 1, '2020-01-13 23:57:00', '2020-01-13 23:57:00'),
	(24, 'LIV2020-24', '2020-01-13 23:57:01', 1, '2020-01-13 23:57:01', '2020-01-13 23:57:01'),
	(25, 'LIV2020-25', '2020-01-13 23:57:02', 1, '2020-01-13 23:57:02', '2020-01-13 23:57:02'),
	(26, 'LIV2020-26', '2020-01-13 23:57:02', 1, '2020-01-13 23:57:02', '2020-01-13 23:57:02'),
	(27, 'LIV2020-27', '2020-01-13 23:57:03', 1, '2020-01-13 23:57:03', '2020-01-13 23:57:03'),
	(28, 'LIV2020-28', '2020-01-22 12:08:44', 1, '2020-01-22 12:08:44', '2020-01-22 12:08:44'),
	(29, 'LIV2020-29', '2020-01-22 21:23:51', 1, '2020-01-22 21:23:51', '2020-01-22 21:23:51'),
	(30, 'LIV2020-30', '2020-01-22 21:25:27', 1, '2020-01-22 21:25:27', '2020-01-22 21:25:27'),
	(31, 'LIV2020-31', '2020-01-22 21:26:23', 1, '2020-01-22 21:26:23', '2020-01-22 21:26:23'),
	(32, 'LIV2020-32', '2020-01-22 21:26:59', 1, '2020-01-22 21:26:59', '2020-01-22 21:26:59');
/*!40000 ALTER TABLE `livraisons` ENABLE KEYS */;

-- Listage de la structure de la table gstock. livraison_commandes
CREATE TABLE IF NOT EXISTS `livraison_commandes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quantite_livre` int(11) NOT NULL,
  `quantite_restante` int(11) NOT NULL,
  `commande_modele_id` int(10) unsigned DEFAULT NULL,
  `livraison_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `livraison_commandes_commande_modele_id_index` (`commande_modele_id`),
  KEY `livraison_commandes_livraison_id_index` (`livraison_id`),
  CONSTRAINT `livraison_commandes_commande_modele_id_foreign` FOREIGN KEY (`commande_modele_id`) REFERENCES `commande_modeles` (`id`),
  CONSTRAINT `livraison_commandes_livraison_id_foreign` FOREIGN KEY (`livraison_id`) REFERENCES `livraisons` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.livraison_commandes : ~6 rows (environ)
/*!40000 ALTER TABLE `livraison_commandes` DISABLE KEYS */;
INSERT INTO `livraison_commandes` (`id`, `quantite_livre`, `quantite_restante`, `commande_modele_id`, `livraison_id`, `created_at`, `updated_at`) VALUES
	(1, 100, 0, 16, 28, '2020-01-22 12:08:44', '2020-01-22 12:08:44'),
	(2, 10, 90, 17, 28, '2020-01-22 12:08:44', '2020-01-22 12:08:44'),
	(3, 80, 10, 17, 29, '2020-01-22 21:23:51', '2020-01-22 21:23:51'),
	(4, 9, 1, 17, 30, '2020-01-22 21:25:27', '2020-01-22 21:25:27'),
	(5, 0, 1, 17, 31, '2020-01-22 21:26:23', '2020-01-22 21:26:23'),
	(6, 1, 0, 17, 32, '2020-01-22 21:26:59', '2020-01-22 21:26:59');
/*!40000 ALTER TABLE `livraison_commandes` ENABLE KEYS */;

-- Listage de la structure de la table gstock. migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.migrations : ~28 rows (environ)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_06_09_182339_create_clients_table', 1),
	(4, '2019_06_28_162532_create_journals_table', 1),
	(5, '2019_06_29_153209_create_ventes_table', 1),
	(6, '2019_08_09_182339_create_employes_table', 1),
	(7, '2019_08_09_191256_create_type_paiements_table', 1),
	(8, '2019_08_11_175925_create_caisses_table', 1),
	(9, '2019_08_19_000000_create_failed_jobs_table', 1),
	(10, '2019_10_11_140312_create_permission_tables', 1),
	(11, '2019_12_01_071720_create_factures_table', 1),
	(12, '2019_12_01_074754_create_historiques_table', 1),
	(13, '2019_12_05_145753_create_reglements_table', 1),
	(14, '2019_12_23_121811_create_journal_divers_table', 1),
	(15, '2019_12_23_122028_create_charges_table', 1),
	(16, '2019_12_25_132630_create_amortissements_table', 1),
	(17, '2019_12_25_132636_create_immobilisations_table', 1),
	(18, '2019_5_09_182339_create_categories_table', 1),
	(19, '2019_5_28_121149_create_produits_table', 1),
	(20, '2019_5_29_094539_create_modeles_table', 1),
	(21, '2019_5_29_110353_create_fournisseurs_table', 1),
	(22, '2019_5_30_094702_create_modele_fournisseurs_table', 1),
	(23, '2019_5_30_113446_create_inventaires_table', 1),
	(24, '2019_5_30_114355_create_inventaire_modeles_table', 1),
	(25, '2019_6_28_141344_create_journal_achats_table', 1),
	(26, '2019_6_29_094845_create_commandes_table', 1),
	(27, '2019_6_29_163007_create_preventes_table', 1),
	(28, '2019_6_30_045448_create_livraisons_table', 1),
	(29, '2019_6_30_094850_create_commande_modeles_table', 1),
	(30, '2019_6_31_000421_create_livraison_commandes_table', 1),
	(31, '2020_02_06_083025_create_boutiques_table', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Listage de la structure de la table gstock. modeles
CREATE TABLE IF NOT EXISTS `modeles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `seuil` int(11) NOT NULL DEFAULT '1',
  `produit_id` int(10) unsigned DEFAULT NULL,
  `boutique_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `modeles_produit_id_index` (`produit_id`),
  KEY `modeles_boutique_id_foreign` (`boutique_id`),
  CONSTRAINT `modeles_boutique_id_foreign` FOREIGN KEY (`boutique_id`) REFERENCES `boutiques` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `modeles_produit_id_foreign` FOREIGN KEY (`produit_id`) REFERENCES `produits` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.modeles : ~9 rows (environ)
/*!40000 ALTER TABLE `modeles` DISABLE KEYS */;
INSERT INTO `modeles` (`id`, `libelle`, `numero`, `quantite`, `prix`, `seuil`, `produit_id`, `boutique_id`, `created_at`, `updated_at`) VALUES
	(1, '400g', 'MOD2019-1', 330, 5000, 10, 1, 1, '2019-12-14 15:34:50', '2020-02-09 20:51:38'),
	(2, '50Kg', 'MOD2019-2', 592, 15000, 10, 2, 1, '2019-12-14 15:35:15', '2020-02-07 22:46:48'),
	(3, '70g', 'MOD2019-3', 475, 4000, 10, 1, 1, '2019-12-14 15:35:38', '2020-01-22 11:28:24'),
	(4, '25Kg', 'MOD2019-4', 400, 75000, 10, 2, 1, '2019-12-14 15:35:58', '2020-01-19 14:06:47'),
	(5, '400g', 'MOD2020-5', 686, 75000, 10, 3, 3, '2020-01-22 09:24:45', '2020-02-09 21:41:59'),
	(6, '50Kg', 'MOD2020-6', 195, 15000, 10, 4, 1, '2020-01-22 09:25:12', '2020-01-31 06:28:20'),
	(7, '70g', 'MOD2020-7', 323, 4500, 10, 3, 1, '2020-01-22 09:25:41', '2020-01-31 06:28:19'),
	(8, '25Kg', 'MOD2020-8', 98, 12500, 10, 4, 1, '2020-01-22 09:26:09', '2020-02-05 13:59:41'),
	(9, '25Litre', 'MOD2020-9', 50, 15700, 10, 5, 3, '2020-02-07 23:29:34', '2020-02-07 23:29:34');
/*!40000 ALTER TABLE `modeles` ENABLE KEYS */;

-- Listage de la structure de la table gstock. modele_fournisseurs
CREATE TABLE IF NOT EXISTS `modele_fournisseurs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fournisseur_id` int(10) unsigned DEFAULT NULL,
  `modele_id` int(10) unsigned DEFAULT NULL,
  `prix` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `modele_fournisseurs_fournisseur_id_index` (`fournisseur_id`),
  KEY `modele_fournisseurs_modele_id_index` (`modele_id`),
  CONSTRAINT `modele_fournisseurs_fournisseur_id_foreign` FOREIGN KEY (`fournisseur_id`) REFERENCES `fournisseurs` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `modele_fournisseurs_modele_id_foreign` FOREIGN KEY (`modele_id`) REFERENCES `modeles` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.modele_fournisseurs : ~8 rows (environ)
/*!40000 ALTER TABLE `modele_fournisseurs` DISABLE KEYS */;
INSERT INTO `modele_fournisseurs` (`id`, `fournisseur_id`, `modele_id`, `prix`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, 7900, '2019-12-14 15:50:11', '2020-01-22 23:33:25'),
	(2, 1, 3, 4000, '2019-12-14 15:50:29', '2019-12-14 15:50:29'),
	(3, 2, 2, 15000, '2019-12-14 15:50:46', '2019-12-14 15:50:46'),
	(4, 2, 4, 75000, '2019-12-14 15:50:57', '2019-12-14 15:50:57'),
	(5, 1, 5, 7900, '2020-01-22 11:36:42', '2020-01-22 23:35:00'),
	(6, 1, 7, 3900, '2020-01-22 11:37:04', '2020-01-22 11:37:04'),
	(7, 2, 6, 15000, '2020-01-22 11:38:06', '2020-01-22 11:38:06'),
	(8, 2, 8, 75000, '2020-01-22 11:38:23', '2020-01-22 11:38:23');
/*!40000 ALTER TABLE `modele_fournisseurs` ENABLE KEYS */;

-- Listage de la structure de la table gstock. model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.model_has_permissions : ~0 rows (environ)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Listage de la structure de la table gstock. model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` int(10) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.model_has_roles : ~5 rows (environ)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(1, 'App\\User', 1),
	(2, 'App\\User', 2),
	(3, 'App\\User', 3),
	(1, 'App\\User', 4),
	(1, 'App\\User', 5),
	(5, 'App\\User', 6);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Listage de la structure de la table gstock. password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.password_resets : ~0 rows (environ)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Listage de la structure de la table gstock. permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.permissions : ~0 rows (environ)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Listage de la structure de la table gstock. preventes
CREATE TABLE IF NOT EXISTS `preventes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quantite` int(11) NOT NULL,
  `prix` int(11) NOT NULL,
  `prixtotal` int(11) NOT NULL,
  `modele_fournisseur_id` int(10) unsigned DEFAULT NULL,
  `vente_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `preventes_modele_fournisseur_id_index` (`modele_fournisseur_id`),
  KEY `preventes_vente_id_index` (`vente_id`),
  CONSTRAINT `preventes_modele_fournisseur_id_foreign` FOREIGN KEY (`modele_fournisseur_id`) REFERENCES `modele_fournisseurs` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `preventes_vente_id_foreign` FOREIGN KEY (`vente_id`) REFERENCES `ventes` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.preventes : ~18 rows (environ)
/*!40000 ALTER TABLE `preventes` DISABLE KEYS */;
INSERT INTO `preventes` (`id`, `quantite`, `prix`, `prixtotal`, `modele_fournisseur_id`, `vente_id`, `created_at`, `updated_at`) VALUES
	(9, 2, 5500, 11000, 1, 5, '2019-12-17 19:36:01', '2019-12-17 19:36:01'),
	(10, 3, 15000, 45000, 3, 5, '2019-12-17 19:36:02', '2019-12-17 19:36:02'),
	(11, 2, 5500, 11000, 1, 6, '2020-01-14 23:18:42', '2020-01-14 23:18:42'),
	(12, 2, 4000, 8000, 2, 6, '2020-01-14 23:18:42', '2020-01-14 23:18:42'),
	(13, 3, 15000, 45000, 3, 6, '2020-01-14 23:18:43', '2020-01-14 23:18:43'),
	(14, 2, 7900, 15800, 5, 7, '2020-01-31 06:28:19', '2020-01-31 06:28:19'),
	(15, 2, 3900, 7800, 6, 7, '2020-01-31 06:28:19', '2020-01-31 06:28:19'),
	(16, 1, 7900, 7900, 1, 7, '2020-01-31 06:28:19', '2020-01-31 06:28:19'),
	(17, 5, 15000, 75000, 7, 7, '2020-01-31 06:28:19', '2020-01-31 06:28:19'),
	(18, 6, 7900, 47400, 1, 8, '2020-01-31 06:49:02', '2020-01-31 06:49:02'),
	(19, 5, 7900, 39500, 5, 8, '2020-01-31 06:49:02', '2020-01-31 06:49:02'),
	(20, 2, 15000, 30000, 3, 9, '2020-02-05 13:37:06', '2020-02-05 13:37:06'),
	(21, 3, 7900, 23700, 5, 10, '2020-02-05 13:56:39', '2020-02-05 13:56:39'),
	(22, 2, 75000, 150000, 8, 11, '2020-02-05 13:59:41', '2020-02-05 13:59:41'),
	(23, 2, 7900, 15800, 1, 12, '2020-02-05 15:36:33', '2020-02-05 15:36:33'),
	(24, 2, 7900, 15800, 1, 13, '2020-02-09 20:51:38', '2020-02-09 20:51:38'),
	(25, 1, 7900, 7900, 5, 14, '2020-02-09 21:24:49', '2020-02-09 21:24:49'),
	(26, 1, 7900, 7900, 5, 15, '2020-02-09 21:29:49', '2020-02-09 21:29:49'),
	(27, 1, 7900, 7900, 5, 16, '2020-02-09 21:40:22', '2020-02-09 21:40:22'),
	(28, 1, 7900, 7900, 5, 17, '2020-02-09 21:41:59', '2020-02-09 21:41:59');
/*!40000 ALTER TABLE `preventes` ENABLE KEYS */;

-- Listage de la structure de la table gstock. produits
CREATE TABLE IF NOT EXISTS `produits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `produits_categorie_id_index` (`categorie_id`),
  CONSTRAINT `produits_categorie_id_foreign` FOREIGN KEY (`categorie_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.produits : ~4 rows (environ)
/*!40000 ALTER TABLE `produits` DISABLE KEYS */;
INSERT INTO `produits` (`id`, `nom`, `numero`, `categorie_id`, `created_at`, `updated_at`) VALUES
	(1, 'AICHA', 'PROD2019-1', 1, '2019-12-14 15:33:54', '2019-12-14 15:33:54'),
	(2, 'MAJESTE', 'PROD2019-2', 2, '2019-12-14 15:34:11', '2019-12-14 15:34:11'),
	(3, 'TOP CHEF', 'PROD2020-3', 1, '2020-01-22 09:20:42', '2020-01-22 09:20:42'),
	(4, 'LIZA', 'PROD2020-4', 2, '2020-01-22 09:21:04', '2020-01-22 09:21:04'),
	(5, 'AIGLE', 'PROD2020-5', 3, '2020-01-22 21:36:11', '2020-01-22 21:36:11');
/*!40000 ALTER TABLE `produits` ENABLE KEYS */;

-- Listage de la structure de la table gstock. reglements
CREATE TABLE IF NOT EXISTS `reglements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `montant_donne` int(11) NOT NULL,
  `montant_restant` int(11) NOT NULL,
  `total` int(11) DEFAULT '0',
  `date_reglement` datetime NOT NULL DEFAULT '2019-12-25 14:16:43',
  `vente_id` int(10) unsigned DEFAULT NULL,
  `client_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reglements_vente_id_index` (`vente_id`),
  CONSTRAINT `reglements_vente_id_foreign` FOREIGN KEY (`vente_id`) REFERENCES `ventes` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.reglements : ~12 rows (environ)
/*!40000 ALTER TABLE `reglements` DISABLE KEYS */;
INSERT INTO `reglements` (`id`, `montant_donne`, `montant_restant`, `total`, `date_reglement`, `vente_id`, `client_id`, `created_at`, `updated_at`) VALUES
	(7, 50000, 6000, 56000, '2019-12-10 09:18:40', 5, 3, '2019-12-17 19:36:20', '2019-12-17 19:36:20'),
	(8, 20000, 36000, 56000, '2019-12-10 09:18:40', 5, 3, '2019-12-17 19:36:58', '2019-12-17 19:36:58'),
	(9, 50000, 14000, 54000, '2019-12-25 14:16:43', 6, 3, '2020-01-14 23:19:16', '2020-01-14 23:19:16'),
	(10, 100000, 6500, 106500, '2019-12-25 14:16:43', 7, 1, '2020-01-31 06:29:23', '2020-01-31 06:29:23'),
	(11, 80000, 6900, 86900, '2019-12-25 14:16:43', 8, 2, '2020-01-31 06:49:18', '2020-01-31 06:49:18'),
	(13, 5000, 1500, 6500, '2019-12-25 14:16:43', NULL, 1, '2020-02-04 14:44:42', '2020-02-04 14:44:42'),
	(14, 20000, 10000, 30000, '2019-12-25 14:16:43', 9, 1, '2020-02-05 13:37:24', '2020-02-05 13:37:24'),
	(15, 5000, 5000, 10000, '2019-12-25 14:16:43', NULL, 1, '2020-02-05 13:44:14', '2020-02-05 13:44:14'),
	(16, 20000, 3700, 23700, '2019-12-25 14:16:43', 10, 2, '2020-02-05 13:56:53', '2020-02-05 13:56:53'),
	(18, 100000, 50000, 150000, '2019-12-25 14:16:43', 11, 3, '2020-02-05 14:09:11', '2020-02-05 14:09:11'),
	(21, 7000, 900, 7900, '2019-12-25 14:16:43', 16, 4, '2020-02-09 21:41:00', '2020-02-09 21:41:00'),
	(22, 7000, 1800, 8800, '2019-12-25 14:16:43', 17, 4, '2020-02-09 21:42:12', '2020-02-09 21:42:12'),
	(23, 1000, 800, 1800, '2019-12-25 14:16:43', NULL, 4, '2020-02-09 21:48:00', '2020-02-09 21:48:00');
/*!40000 ALTER TABLE `reglements` ENABLE KEYS */;

-- Listage de la structure de la table gstock. roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.roles : ~4 rows (environ)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'ADMINISTRATEUR', 'Web', '2019-12-10 09:22:08', '2019-12-10 09:22:09'),
	(2, 'CAISSIER', 'Web', '2019-12-10 09:22:23', '2019-12-10 09:22:25'),
	(3, 'MAGASINIER', 'Web', '2019-12-10 09:22:38', '2019-12-10 09:22:40'),
	(4, 'VENDEUR', 'Web', '2019-12-10 09:23:07', '2019-12-10 09:23:08'),
	(5, 'SUPER ADMINISTRATEUR', 'Web', '2020-02-09 10:59:08', '2020-02-09 10:59:10');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Listage de la structure de la table gstock. role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.role_has_permissions : ~0 rows (environ)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Listage de la structure de la table gstock. type_paiements
CREATE TABLE IF NOT EXISTS `type_paiements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.type_paiements : ~0 rows (environ)
/*!40000 ALTER TABLE `type_paiements` DISABLE KEYS */;
/*!40000 ALTER TABLE `type_paiements` ENABLE KEYS */;

-- Listage de la structure de la table gstock. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag_etat` tinyint(1) NOT NULL DEFAULT '0',
  `boutique_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_boutique_id_foreign` (`boutique_id`),
  CONSTRAINT `users_boutique_id_foreign` FOREIGN KEY (`boutique_id`) REFERENCES `boutiques` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.users : ~5 rows (environ)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `nom`, `prenom`, `sexe`, `email`, `contact`, `password`, `flag_etat`, `boutique_id`, `created_at`, `updated_at`) VALUES
	(1, 'AVOUSSOU', 'kodjo junior', 'M', 'admin@gmail.com', '99300377', '$2y$10$YLAhAITpK3tJTfATrMDiHuoGGIqSr.HhALAP7c1lbp1csXU2pbjSm', 0, 1, '2019-12-10 09:36:36', '2019-12-10 09:36:36'),
	(2, 'KAO', 'Madena', 'F', 'test@gmail.com', '99876543', '$2y$10$aw26HspZIGSF6oUxiKoMge3mbPLyIbEnn/PDxkh4KDCDsIan4GBTm', 0, 1, '2019-12-10 09:37:24', '2019-12-10 09:37:24'),
	(3, 'GADE', 'Raoul', 'M', 'yves@gmail.com', '99225567', '$2y$10$RARG.6niFgN5FLbYLGJ6DugEY2Yib6kjI2hA4Z0SyMdXJoplfvJR2', 0, 1, '2019-12-10 09:37:48', '2020-01-22 21:58:05'),
	(4, 'SOSSOU', 'Anani Jacques', 'M', 'sossou@gmail.com', '99876543', '$2y$10$cdRpbELHj9d6h4Zh7xOOo.Nr2nlamabhJESjSCC9RXEyKOnsu0Ds.', 0, 3, '2020-02-07 10:59:48', '2020-02-07 10:59:48'),
	(5, 'D\'ALMEIDA', 'Denis', 'M', 'denis@gmail.com', '99876543', '$2y$10$gWRgF..VoDed.7oUsrRwWeSKJuQtGT/Mh5ImNb5Qv8Q8Vl/1yGdRO', 0, 4, '2020-02-08 13:46:47', '2020-02-08 13:46:47'),
	(6, 'ADMINISTRATEUR', 'Super Admin', 'M', 'superadmin@gmail.com', '99876543', '$2y$10$szofHAyRCMM/1fJCeSEdEe7eRkRM/PYx/6PGY2l3ihNvbrnMmkozO', 0, 1, '2020-02-09 11:04:17', '2020-02-09 11:04:17');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Listage de la structure de la table gstock. ventes
CREATE TABLE IF NOT EXISTS `ventes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_id` int(10) unsigned DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `journal_id` int(10) unsigned DEFAULT NULL,
  `boutique_id` int(10) unsigned DEFAULT NULL,
  `date_vente` datetime NOT NULL DEFAULT '2019-12-25 14:16:27',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ventes_client_id_index` (`client_id`),
  KEY `ventes_user_id_index` (`user_id`),
  KEY `ventes_journal_id_index` (`journal_id`),
  KEY `ventes_boutique_id_foreign` (`boutique_id`),
  CONSTRAINT `ventes_boutique_id_foreign` FOREIGN KEY (`boutique_id`) REFERENCES `boutiques` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `ventes_client_id_foreign` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `ventes_journal_id_foreign` FOREIGN KEY (`journal_id`) REFERENCES `journals` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `ventes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Listage des données de la table gstock.ventes : ~11 rows (environ)
/*!40000 ALTER TABLE `ventes` DISABLE KEYS */;
INSERT INTO `ventes` (`id`, `numero`, `client_id`, `user_id`, `journal_id`, `boutique_id`, `date_vente`, `created_at`, `updated_at`) VALUES
	(5, 'VENT2019-1', 3, 1, 1, 1, '2019-12-17 19:36:01', '2019-12-17 19:36:01', '2019-12-17 19:36:01'),
	(6, 'VENT2020-6', 3, 1, 2, 1, '2020-01-14 23:18:42', '2020-01-14 23:18:42', '2020-01-14 23:18:42'),
	(7, 'VENT2020-7', 1, 1, 2, 1, '2020-01-31 06:28:19', '2020-01-31 06:28:19', '2020-01-31 06:28:19'),
	(8, 'VENT2020-8', 2, 1, 3, 1, '2020-01-31 06:49:02', '2020-01-31 06:49:02', '2020-01-31 06:49:02'),
	(9, 'VENT2020-9', 1, 1, 4, 1, '2020-02-05 13:37:06', '2020-02-05 13:37:06', '2020-02-05 13:37:06'),
	(10, 'VENT2020-10', 2, 1, 4, 1, '2020-02-05 13:56:39', '2020-02-05 13:56:39', '2020-02-05 13:56:39'),
	(11, 'VENT2020-11', 3, 1, 4, 1, '2020-02-05 13:59:40', '2020-02-05 13:59:40', '2020-02-05 13:59:40'),
	(12, 'VENT2020-12', 1, 1, 4, 1, '2020-02-05 15:36:33', '2020-02-05 15:36:33', '2020-02-05 15:36:33'),
	(13, 'VENT2020-13', 1, 1, 5, 1, '2020-02-09 20:51:38', '2020-02-09 20:51:38', '2020-02-09 20:51:38'),
	(14, 'VENT2020-14', 4, 4, 5, 3, '2020-02-09 21:24:49', '2020-02-09 21:24:49', '2020-02-09 21:24:49'),
	(15, 'VENT2020-15', 4, 4, 5, 3, '2020-02-09 21:29:48', '2020-02-09 21:29:49', '2020-02-09 21:29:49'),
	(16, 'VENT2020-16', 4, 4, 5, 3, '2020-02-09 21:40:22', '2020-02-09 21:40:22', '2020-02-09 21:40:22'),
	(17, 'VENT2020-17', 4, 4, 5, 3, '2020-02-09 21:41:59', '2020-02-09 21:41:59', '2020-02-09 21:41:59');
/*!40000 ALTER TABLE `ventes` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
