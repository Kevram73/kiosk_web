-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 16, 2023 at 12:18 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bplus_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `amortissements`
--

CREATE TABLE `amortissements` (
                                  `id` int(10) UNSIGNED NOT NULL,
                                  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                                  `taux` double NOT NULL,
                                  `duree_vie` int(11) NOT NULL,
                                  `created_at` timestamp NULL DEFAULT NULL,
                                  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `boutiques`
--

CREATE TABLE `boutiques` (
                             `id` int(10) UNSIGNED NOT NULL,
                             `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `telephone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
                             `created_at` timestamp NULL DEFAULT NULL,
                             `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `boutiques`
--

INSERT INTO `boutiques` (`id`, `nom`, `adresse`, `telephone`, `contact`, `created_at`, `updated_at`) VALUES
    (1, 'MINGOUBE & FILS SARL   VIRTUEL', 'Djapieni, Route Numéro 1 (Carrefour) non loin de l\'EPP Djapieni, Cinkasse', '90913500 / 99063033', 'kmingoube@gmail.com', '2022-10-23 00:27:07', '2022-10-26 14:37:26'),
(3, 'DAPAONG CENTRE', 'DAPAONG, ROND POINT BTD, FACE ORABANK DAPAONG', '92357718', '92357718', '2022-10-24 09:44:57', '2022-10-26 13:41:12'),
(4, 'WORGOU', 'WORGOU, QUARTIER WORGOU, SORTIE SUD DAPAONG', '96156587', '96156587', '2022-10-24 09:50:27', '2022-10-26 13:34:55'),
(5, 'TOAGA', 'TOAGA, SUR LA ROUTE KORBONGOU DE DAPAONG', '92618750', '92618750', '2022-10-24 09:52:14', '2022-10-26 13:30:36'),
(6, 'CINKASSE N°1', 'CINKASSE, CHEZ DRAMANE, FACE LYCEE CINKASSE', '93345938', '93345938', '2022-10-24 09:54:06', '2022-10-26 13:40:14'),
(7, 'CINKASSE N°2', 'CINKASSE, ROUTE N° 1 CONTOURNEMENT, CINKASSE', '92000760', '92000760', '2022-10-26 13:22:26', '2022-10-26 13:22:26'),
(8, 'KPEGUI', 'DAPAONG, FACE SYNDICAT A LA SORTIE NORD DAPAONG', '91293176', '91293176', '2022-10-26 13:27:28', '2022-10-26 13:27:28'),
(9, 'NADJOUNDI N°1', 'NADJOUNDI, NON LOIN DE MISSION CATHOLIQUE NADJOUNDI', '90103998', '90103998', '2022-10-26 14:01:48', '2022-10-26 14:01:48'),
(10, 'NADJOUNDI N°2', 'NADJOUNDI, DANS LE MARCHE DE NADJOUNDI', '90574854', '90574854', '2022-10-26 14:06:12', '2022-10-26 14:06:12'),
(11, 'FANWORGOU', 'FANWORGOU, GRAND CARREFOUR FANWORGOU', '90799062', '90799062', '2022-10-26 14:15:05', '2022-10-26 14:15:05'),
(12, 'DJAPIENI', 'DJAPIENI, FACE PETIT PARIS, ROUTE N°1 CARREFOUR DJAPIENI', '91793974', '91793974', '2022-10-26 14:34:44', '2022-10-26 14:34:44'),
(14, 'BOUTIQUE', 'CINKASSE, SUR LA ROUTE N°1 PRET DE LA DOUANE, CINKASSE', '93522529', '93522529', '2022-11-04 05:17:58', '2022-11-04 05:17:58'),
(15, 'TIMBOU', 'TIMBOU, NOUVEAU MARCHE, SUR LA NATIONALE CINKASSE', '93364667', '93364667', '2022-11-09 10:37:56', '2022-11-09 10:37:56'),
(16, 'LOME', 'LOME - CARREFOUR KPALA - LOME', '91534293', '91534293', '2022-12-31 11:22:40', '2022-12-31 11:22:40');

-- --------------------------------------------------------

--
-- Table structure for table `boutique_settings`
--

CREATE TABLE `boutique_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `setting_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `boutique_settings`
--

INSERT INTO `boutique_settings` (`id`, `is_active`, `key`, `value`, `boutique_id`, `setting_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL, 1, 1, '2022-10-23 18:03:46', '2022-10-23 18:03:46'),
(2, 1, NULL, NULL, 1, 2, '2022-10-23 18:03:46', '2022-10-23 18:03:46'),
(3, 1, NULL, NULL, 1, 3, '2022-10-23 18:03:46', '2022-10-23 18:03:46'),
(4, 1, NULL, NULL, 1, 4, '2022-10-23 18:03:46', '2022-10-23 18:03:46'),
(5, 1, NULL, NULL, 1, 5, '2022-10-23 18:03:46', '2022-10-23 18:03:46'),
(6, 1, NULL, NULL, 1, 6, '2022-10-23 18:03:46', '2022-10-23 18:03:46'),
(7, 1, NULL, NULL, 1, 7, '2022-10-23 18:03:46', '2022-10-23 18:03:46'),
(8, 1, NULL, NULL, 1, 8, '2022-10-23 18:03:46', '2022-10-23 18:03:46'),
(9, 1, NULL, NULL, 1, 10, '2022-10-23 18:03:46', '2022-10-23 18:03:46'),
(10, 1, NULL, NULL, 1, 11, '2022-10-23 18:03:46', '2022-10-23 18:03:46'),
(11, 1, NULL, NULL, 1, 12, '2022-10-23 18:03:46', '2022-10-23 18:03:46'),
(12, 1, NULL, NULL, 1, 13, '2022-10-23 18:03:46', '2022-10-23 18:03:46'),
(13, 1, NULL, NULL, 1, 14, '2022-10-23 18:03:46', '2022-10-23 18:03:46'),
(14, 1, NULL, NULL, 1, 15, '2022-10-23 18:03:46', '2022-10-23 18:03:46'),
(15, 1, NULL, NULL, 3, 1, '2022-12-29 10:06:16', '2023-01-03 11:31:08'),
(16, 1, NULL, NULL, 3, 2, '2022-12-29 10:06:16', '2023-01-03 11:31:08'),
(17, 1, NULL, NULL, 3, 3, '2022-12-29 10:06:16', '2023-01-03 11:31:08'),
(18, 1, NULL, NULL, 3, 4, '2022-12-29 10:06:16', '2023-01-03 11:31:08'),
(19, 1, NULL, NULL, 3, 5, '2022-12-29 10:06:16', '2023-01-03 11:31:08'),
(20, 1, NULL, NULL, 3, 6, '2022-12-29 10:06:16', '2023-01-03 11:31:08'),
(21, 1, NULL, NULL, 3, 7, '2022-12-29 10:06:16', '2023-01-03 11:31:08'),
(22, 1, NULL, NULL, 3, 8, '2022-12-29 10:06:16', '2023-01-03 11:31:08'),
(23, 1, NULL, NULL, 3, 10, '2022-12-29 10:06:16', '2023-01-03 11:31:08'),
(24, 1, NULL, NULL, 3, 11, '2022-12-29 10:06:16', '2023-01-03 11:31:08'),
(25, 1, NULL, NULL, 3, 13, '2022-12-29 10:06:16', '2023-01-03 11:31:08'),
(26, 1, NULL, NULL, 3, 14, '2022-12-29 10:06:16', '2023-01-03 11:31:08'),
(27, 1, NULL, NULL, 3, 15, '2022-12-29 10:06:16', '2023-01-03 11:31:08'),
(28, 1, NULL, NULL, 4, 1, '2023-01-03 01:19:41', '2023-01-03 01:20:00'),
(29, 1, NULL, NULL, 4, 2, '2023-01-03 01:19:41', '2023-01-03 01:20:00'),
(30, 1, NULL, NULL, 4, 3, '2023-01-03 01:19:41', '2023-01-03 01:20:00'),
(31, 1, NULL, NULL, 4, 4, '2023-01-03 01:19:41', '2023-01-03 01:20:00'),
(32, 1, NULL, NULL, 4, 5, '2023-01-03 01:19:41', '2023-01-03 01:20:00'),
(33, 1, NULL, NULL, 4, 6, '2023-01-03 01:19:41', '2023-01-03 01:20:00'),
(34, 1, NULL, NULL, 4, 7, '2023-01-03 01:19:41', '2023-01-03 01:20:00'),
(35, 1, NULL, NULL, 4, 8, '2023-01-03 01:19:41', '2023-01-03 01:20:00'),
(36, 1, NULL, NULL, 4, 10, '2023-01-03 01:19:41', '2023-01-03 01:20:00'),
(37, 1, NULL, NULL, 4, 11, '2023-01-03 01:19:41', '2023-01-03 01:20:00'),
(38, 1, NULL, NULL, 4, 12, '2023-01-03 01:19:41', '2023-01-03 01:20:00'),
(39, 1, NULL, NULL, 4, 13, '2023-01-03 01:19:41', '2023-01-03 01:20:00'),
(40, 1, NULL, NULL, 4, 14, '2023-01-03 01:19:41', '2023-01-03 01:20:00'),
(41, 1, NULL, NULL, 4, 15, '2023-01-03 01:19:41', '2023-01-03 01:20:00'),
(42, 1, NULL, NULL, 6, 1, '2023-01-03 11:28:50', '2023-01-03 11:29:05'),
(43, 1, NULL, NULL, 6, 2, '2023-01-03 11:28:50', '2023-01-03 11:29:05'),
(44, 1, NULL, NULL, 6, 3, '2023-01-03 11:28:50', '2023-01-03 11:29:05'),
(45, 1, NULL, NULL, 6, 4, '2023-01-03 11:28:50', '2023-01-03 11:29:05'),
(46, 1, NULL, NULL, 6, 5, '2023-01-03 11:28:50', '2023-01-03 11:29:05'),
(47, 1, NULL, NULL, 6, 6, '2023-01-03 11:28:50', '2023-01-03 11:29:05'),
(48, 1, NULL, NULL, 6, 7, '2023-01-03 11:28:50', '2023-01-03 11:29:05'),
(49, 1, NULL, NULL, 6, 8, '2023-01-03 11:28:50', '2023-01-03 11:29:05'),
(50, 1, NULL, NULL, 6, 10, '2023-01-03 11:28:50', '2023-01-03 11:29:05'),
(51, 1, NULL, NULL, 6, 11, '2023-01-03 11:28:50', '2023-01-03 11:29:05'),
(52, 1, NULL, NULL, 6, 12, '2023-01-03 11:28:50', '2023-01-03 11:29:05'),
(53, 1, NULL, NULL, 6, 13, '2023-01-03 11:28:50', '2023-01-03 11:29:05'),
(54, 1, NULL, NULL, 6, 14, '2023-01-03 11:28:50', '2023-01-03 11:29:05'),
(55, 1, NULL, NULL, 6, 15, '2023-01-03 11:28:50', '2023-01-03 11:29:05'),
(56, 1, NULL, NULL, 7, 1, '2023-01-03 11:30:09', '2023-01-03 11:30:14'),
(57, 1, NULL, NULL, 7, 2, '2023-01-03 11:30:09', '2023-01-03 11:30:14'),
(58, 1, NULL, NULL, 7, 3, '2023-01-03 11:30:09', '2023-01-03 11:30:14'),
(59, 1, NULL, NULL, 7, 4, '2023-01-03 11:30:09', '2023-01-03 11:30:14'),
(60, 1, NULL, NULL, 7, 5, '2023-01-03 11:30:09', '2023-01-03 11:30:14'),
(61, 1, NULL, NULL, 7, 6, '2023-01-03 11:30:09', '2023-01-03 11:30:14'),
(62, 1, NULL, NULL, 7, 7, '2023-01-03 11:30:09', '2023-01-03 11:30:14'),
(63, 1, NULL, NULL, 7, 8, '2023-01-03 11:30:09', '2023-01-03 11:30:14'),
(64, 1, NULL, NULL, 7, 10, '2023-01-03 11:30:09', '2023-01-03 11:30:14'),
(65, 1, NULL, NULL, 7, 11, '2023-01-03 11:30:09', '2023-01-03 11:30:14'),
(66, 1, NULL, NULL, 7, 12, '2023-01-03 11:30:09', '2023-01-03 11:30:14'),
(67, 1, NULL, NULL, 7, 13, '2023-01-03 11:30:09', '2023-01-03 11:30:14'),
(68, 1, NULL, NULL, 7, 14, '2023-01-03 11:30:09', '2023-01-03 11:30:14'),
(69, 1, NULL, NULL, 7, 15, '2023-01-03 11:30:09', '2023-01-03 11:30:14'),
(70, 1, NULL, NULL, 3, 12, '2023-01-03 11:31:08', '2023-01-03 11:31:08'),
(71, 1, NULL, NULL, 11, 1, '2023-01-03 11:31:37', '2023-01-03 11:31:37'),
(72, 1, NULL, NULL, 11, 2, '2023-01-03 11:31:37', '2023-01-03 11:31:37'),
(73, 1, NULL, NULL, 11, 3, '2023-01-03 11:31:37', '2023-01-03 11:31:37'),
(74, 1, NULL, NULL, 11, 4, '2023-01-03 11:31:37', '2023-01-03 11:31:37'),
(75, 1, NULL, NULL, 11, 5, '2023-01-03 11:31:37', '2023-01-03 11:31:37'),
(76, 1, NULL, NULL, 11, 6, '2023-01-03 11:31:37', '2023-01-03 11:31:37'),
(77, 1, NULL, NULL, 11, 7, '2023-01-03 11:31:37', '2023-01-03 11:31:37'),
(78, 1, NULL, NULL, 11, 8, '2023-01-03 11:31:37', '2023-01-03 11:31:37'),
(79, 1, NULL, NULL, 11, 10, '2023-01-03 11:31:37', '2023-01-03 11:31:37'),
(80, 1, NULL, NULL, 11, 11, '2023-01-03 11:31:37', '2023-01-03 11:31:37'),
(81, 1, NULL, NULL, 11, 12, '2023-01-03 11:31:37', '2023-01-03 11:31:37'),
(82, 1, NULL, NULL, 11, 13, '2023-01-03 11:31:37', '2023-01-03 11:31:37'),
(83, 1, NULL, NULL, 11, 14, '2023-01-03 11:31:37', '2023-01-03 11:31:37'),
(84, 1, NULL, NULL, 11, 15, '2023-01-03 11:31:37', '2023-01-03 11:31:37'),
(85, 1, NULL, NULL, 8, 1, '2023-01-03 11:32:11', '2023-01-03 11:32:11'),
(86, 1, NULL, NULL, 8, 2, '2023-01-03 11:32:11', '2023-01-03 11:32:11'),
(87, 1, NULL, NULL, 8, 3, '2023-01-03 11:32:11', '2023-01-03 11:32:11'),
(88, 1, NULL, NULL, 8, 4, '2023-01-03 11:32:11', '2023-01-03 11:32:11'),
(89, 1, NULL, NULL, 8, 5, '2023-01-03 11:32:11', '2023-01-03 11:32:11'),
(90, 1, NULL, NULL, 8, 6, '2023-01-03 11:32:11', '2023-01-03 11:32:11'),
(91, 1, NULL, NULL, 8, 7, '2023-01-03 11:32:11', '2023-01-03 11:32:11'),
(92, 1, NULL, NULL, 8, 8, '2023-01-03 11:32:11', '2023-01-03 11:32:11'),
(93, 1, NULL, NULL, 8, 10, '2023-01-03 11:32:11', '2023-01-03 11:32:11'),
(94, 1, NULL, NULL, 8, 11, '2023-01-03 11:32:11', '2023-01-03 11:32:11'),
(95, 1, NULL, NULL, 8, 12, '2023-01-03 11:32:11', '2023-01-03 11:32:11'),
(96, 1, NULL, NULL, 8, 13, '2023-01-03 11:32:11', '2023-01-03 11:32:11'),
(97, 1, NULL, NULL, 8, 14, '2023-01-03 11:32:11', '2023-01-03 11:32:11'),
(98, 1, NULL, NULL, 8, 15, '2023-01-03 11:32:11', '2023-01-03 11:32:11'),
(99, 1, NULL, NULL, 16, 1, '2023-01-03 11:32:52', '2023-01-03 11:32:52'),
(100, 1, NULL, NULL, 16, 2, '2023-01-03 11:32:52', '2023-01-03 11:32:52'),
(101, 1, NULL, NULL, 16, 3, '2023-01-03 11:32:52', '2023-01-03 11:32:52'),
(102, 1, NULL, NULL, 16, 4, '2023-01-03 11:32:52', '2023-01-03 11:32:52'),
(103, 1, NULL, NULL, 16, 5, '2023-01-03 11:32:52', '2023-01-03 11:32:52'),
(104, 1, NULL, NULL, 16, 6, '2023-01-03 11:32:52', '2023-01-03 11:32:52'),
(105, 1, NULL, NULL, 16, 7, '2023-01-03 11:32:52', '2023-01-03 11:32:52'),
(106, 1, NULL, NULL, 16, 8, '2023-01-03 11:32:52', '2023-01-03 11:32:52'),
(107, 1, NULL, NULL, 16, 10, '2023-01-03 11:32:52', '2023-01-03 11:32:52'),
(108, 1, NULL, NULL, 16, 11, '2023-01-03 11:32:52', '2023-01-03 11:32:52'),
(109, 1, NULL, NULL, 16, 12, '2023-01-03 11:32:52', '2023-01-03 11:32:52'),
(110, 1, NULL, NULL, 16, 13, '2023-01-03 11:32:52', '2023-01-03 11:32:52'),
(111, 1, NULL, NULL, 16, 14, '2023-01-03 11:32:52', '2023-01-03 11:32:52'),
(112, 1, NULL, NULL, 16, 15, '2023-01-03 11:32:52', '2023-01-03 11:32:52'),
(113, 1, NULL, NULL, 9, 1, '2023-01-03 11:33:27', '2023-01-03 11:33:27'),
(114, 1, NULL, NULL, 9, 2, '2023-01-03 11:33:27', '2023-01-03 11:33:27'),
(115, 1, NULL, NULL, 9, 3, '2023-01-03 11:33:27', '2023-01-03 11:33:27'),
(116, 1, NULL, NULL, 9, 4, '2023-01-03 11:33:27', '2023-01-03 11:33:27'),
(117, 1, NULL, NULL, 9, 5, '2023-01-03 11:33:27', '2023-01-03 11:33:27'),
(118, 1, NULL, NULL, 9, 6, '2023-01-03 11:33:27', '2023-01-03 11:33:27'),
(119, 1, NULL, NULL, 9, 7, '2023-01-03 11:33:27', '2023-01-03 11:33:27'),
(120, 1, NULL, NULL, 9, 8, '2023-01-03 11:33:27', '2023-01-03 11:33:27'),
(121, 1, NULL, NULL, 9, 10, '2023-01-03 11:33:27', '2023-01-03 11:33:27'),
(122, 1, NULL, NULL, 9, 11, '2023-01-03 11:33:27', '2023-01-03 11:33:27'),
(123, 1, NULL, NULL, 9, 12, '2023-01-03 11:33:27', '2023-01-03 11:33:27'),
(124, 1, NULL, NULL, 9, 13, '2023-01-03 11:33:27', '2023-01-03 11:33:27'),
(125, 1, NULL, NULL, 9, 14, '2023-01-03 11:33:27', '2023-01-03 11:33:27'),
(126, 1, NULL, NULL, 9, 15, '2023-01-03 11:33:27', '2023-01-03 11:33:27'),
(127, 1, NULL, NULL, 10, 1, '2023-01-03 11:34:43', '2023-01-03 11:34:43'),
(128, 1, NULL, NULL, 10, 2, '2023-01-03 11:34:43', '2023-01-03 11:34:43'),
(129, 1, NULL, NULL, 10, 3, '2023-01-03 11:34:43', '2023-01-03 11:34:43'),
(130, 1, NULL, NULL, 10, 4, '2023-01-03 11:34:43', '2023-01-03 11:34:43'),
(131, 1, NULL, NULL, 10, 5, '2023-01-03 11:34:43', '2023-01-03 11:34:43'),
(132, 1, NULL, NULL, 10, 6, '2023-01-03 11:34:43', '2023-01-03 11:34:43'),
(133, 1, NULL, NULL, 10, 7, '2023-01-03 11:34:43', '2023-01-03 11:34:43'),
(134, 1, NULL, NULL, 10, 8, '2023-01-03 11:34:43', '2023-01-03 11:34:43'),
(135, 1, NULL, NULL, 10, 10, '2023-01-03 11:34:43', '2023-01-03 11:34:43'),
(136, 1, NULL, NULL, 10, 11, '2023-01-03 11:34:43', '2023-01-03 11:34:43'),
(137, 1, NULL, NULL, 10, 12, '2023-01-03 11:34:43', '2023-01-03 11:34:43'),
(138, 1, NULL, NULL, 10, 13, '2023-01-03 11:34:43', '2023-01-03 11:34:43'),
(139, 1, NULL, NULL, 10, 14, '2023-01-03 11:34:43', '2023-01-03 11:34:43'),
(140, 1, NULL, NULL, 10, 15, '2023-01-03 11:34:43', '2023-01-03 11:34:43'),
(141, 1, NULL, NULL, 15, 1, '2023-01-03 11:35:11', '2023-01-03 11:35:11'),
(142, 1, NULL, NULL, 15, 2, '2023-01-03 11:35:11', '2023-01-03 11:35:11'),
(143, 1, NULL, NULL, 15, 3, '2023-01-03 11:35:11', '2023-01-03 11:35:11'),
(144, 1, NULL, NULL, 15, 4, '2023-01-03 11:35:11', '2023-01-03 11:35:11'),
(145, 1, NULL, NULL, 15, 5, '2023-01-03 11:35:11', '2023-01-03 11:35:11'),
(146, 1, NULL, NULL, 15, 6, '2023-01-03 11:35:11', '2023-01-03 11:35:11'),
(147, 1, NULL, NULL, 15, 7, '2023-01-03 11:35:11', '2023-01-03 11:35:11'),
(148, 1, NULL, NULL, 15, 8, '2023-01-03 11:35:11', '2023-01-03 11:35:11'),
(149, 1, NULL, NULL, 15, 10, '2023-01-03 11:35:11', '2023-01-03 11:35:11'),
(150, 1, NULL, NULL, 15, 11, '2023-01-03 11:35:11', '2023-01-03 11:35:11'),
(151, 1, NULL, NULL, 15, 12, '2023-01-03 11:35:11', '2023-01-03 11:35:11'),
(152, 1, NULL, NULL, 15, 13, '2023-01-03 11:35:11', '2023-01-03 11:35:11'),
(153, 1, NULL, NULL, 15, 14, '2023-01-03 11:35:11', '2023-01-03 11:35:11'),
(154, 1, NULL, NULL, 15, 15, '2023-01-03 11:35:11', '2023-01-03 11:35:11'),
(155, 1, NULL, NULL, 5, 1, '2023-01-03 11:36:11', '2023-01-03 11:36:11'),
(156, 1, NULL, NULL, 5, 2, '2023-01-03 11:36:11', '2023-01-03 11:36:11'),
(157, 1, NULL, NULL, 5, 3, '2023-01-03 11:36:11', '2023-01-03 11:36:11'),
(158, 1, NULL, NULL, 5, 4, '2023-01-03 11:36:11', '2023-01-03 11:36:11'),
(159, 1, NULL, NULL, 5, 5, '2023-01-03 11:36:11', '2023-01-03 11:36:11'),
(160, 1, NULL, NULL, 5, 6, '2023-01-03 11:36:11', '2023-01-03 11:36:11'),
(161, 1, NULL, NULL, 5, 7, '2023-01-03 11:36:11', '2023-01-03 11:36:11'),
(162, 1, NULL, NULL, 5, 8, '2023-01-03 11:36:11', '2023-01-03 11:36:11'),
(163, 1, NULL, NULL, 5, 10, '2023-01-03 11:36:11', '2023-01-03 11:36:11'),
(164, 1, NULL, NULL, 5, 11, '2023-01-03 11:36:11', '2023-01-03 11:36:11'),
(165, 1, NULL, NULL, 5, 12, '2023-01-03 11:36:11', '2023-01-03 11:36:11'),
(166, 1, NULL, NULL, 5, 13, '2023-01-03 11:36:11', '2023-01-03 11:36:11'),
(167, 1, NULL, NULL, 5, 14, '2023-01-03 11:36:11', '2023-01-03 11:36:11'),
(168, 1, NULL, NULL, 5, 15, '2023-01-03 11:36:11', '2023-01-03 11:36:11');

-- --------------------------------------------------------

--
-- Table structure for table `caisses`
--

CREATE TABLE `caisses` (
  `id` int(10) UNSIGNED NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `nom`, `description`, `created_at`, `updated_at`) VALUES
(1, 'QUINCAILLERIE', 'Vente des Matériaux de Construction', '2022-10-24 06:38:47', '2022-10-24 06:43:34'),
(2, 'BOUTIQUE', 'Vente des Boissons, Vêtements et Autres', '2022-10-24 06:42:54', '2022-10-24 06:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `id` int(10) UNSIGNED NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT '2022-08-26 17:36:24',
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `journal_divers_id` int(10) UNSIGNED DEFAULT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `email`, `contact`, `adresse`, `boutique_id`, `created_at`, `updated_at`) VALUES
(14, 'CLIENT COMPTOIR', 'comptoir@mingoube.com', '0', '', 1, '2022-11-09 16:00:13', '2022-12-24 17:12:47'),
(16, 'CLIENT COMPTOIR', 'comptoir@mingoube.com', '0', '', 3, '2022-11-09 16:00:13', '2022-12-24 17:12:47'),
(17, 'CLIENT COMPTOIR', 'comptoir@mingoube.com', '0', '', 4, '2022-11-09 16:00:13', '2022-12-24 17:12:47'),
(18, 'CLIENT COMPTOIR', 'comptoir@mingoube.com', '0', '', 5, '2022-11-09 16:00:13', '2022-12-24 17:12:47'),
(19, 'CLIENT COMPTOIR', 'comptoir@mingoube.com', '0', '', 6, '2022-11-09 16:00:13', '2022-12-24 17:12:47'),
(20, 'CLIENT COMPTOIR', 'comptoir@mingoube.com', '0', '', 7, '2022-11-09 16:00:13', '2022-12-24 17:12:47'),
(21, 'CLIENT COMPTOIR', 'comptoir@mingoube.com', '0', '', 8, '2022-11-09 16:00:13', '2022-12-24 17:12:47'),
(22, 'CLIENT COMPTOIR', 'comptoir@mingoube.com', '0', '', 9, '2022-11-09 16:00:13', '2022-12-24 17:12:47'),
(23, 'CLIENT COMPTOIR', 'comptoir@mingoube.com', '0', '', 10, '2022-11-09 16:00:13', '2022-12-24 17:12:47'),
(24, 'CLIENT COMPTOIR', 'comptoir@mingoube.com', '0', '', 11, '2022-11-09 16:00:13', '2022-12-24 17:12:47'),
(25, 'CLIENT COMPTOIR', 'comptoir@mingoube.com', '0', '', 12, '2022-11-09 16:00:13', '2022-12-24 17:12:47'),
(26, 'CLIENT COMPTOIR', 'comptoir@mingoube.com', '0', '', 14, '2022-11-09 16:00:13', '2022-12-24 17:12:47'),
(27, 'CLIENT COMPTOIR', 'comptoir@mingoube.com', '0', '', 15, '2022-11-09 16:00:13', '2022-12-24 17:12:47'),
(32, 'KOMBATE KOLANI', NULL, '91733344', 'Dapaong', 1, '2022-12-29 15:40:01', '2022-12-29 15:40:01'),
(33, 'DOUTI kodjo', NULL, '692132', 'dapaong', 11, '2023-01-03 11:52:08', '2023-01-03 11:52:08'),
(34, 'LAREBA KOMBATE', NULL, '91646446', 'dapaong', 11, '2023-01-03 12:00:46', '2023-01-03 12:00:46');

-- --------------------------------------------------------

--
-- Table structure for table `commandes`
--

CREATE TABLE `commandes` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_commande` datetime NOT NULL DEFAULT '2022-08-26 17:36:29',
  `journal_achat_id` int(10) UNSIGNED DEFAULT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `type_commande` int(11) DEFAULT 0,
  `totaux` double DEFAULT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT 0,
  `credit` tinyint(1) DEFAULT 0,
  `fournisseur_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commandes`
--

INSERT INTO `commandes` (`id`, `numero`, `date_commande`, `journal_achat_id`, `boutique_id`, `type_commande`, `totaux`, `etat`, `credit`, `fournisseur_id`, `created_at`, `updated_at`) VALUES
(36, 'COM2023-1', '2023-01-05 14:15:00', 18, 6, 2, 1760000, 0, 0, 8, '2023-01-05 19:15:00', '2023-01-05 19:15:00'),
(37, 'COM2023-37', '2023-01-05 14:23:47', 18, 7, 1, 1440000, 0, 0, 8, '2023-01-05 19:23:47', '2023-01-05 19:23:47'),
(38, 'COM2023-38', '2023-01-06 21:27:17', 19, 1, 1, 15000, 0, 0, 9, '2023-01-07 02:27:17', '2023-01-07 02:27:17'),
(39, 'COM2023-39', '2023-01-06 21:28:42', 20, 1, 2, 60000, 0, 0, 9, '2023-01-07 02:28:42', '2023-01-07 02:28:42');

-- --------------------------------------------------------

--
-- Table structure for table `commande_modeles`
--

CREATE TABLE `commande_modeles` (
  `id` int(10) UNSIGNED NOT NULL,
  `modele_fournisseur_id` int(10) UNSIGNED DEFAULT NULL,
  `commande_id` int(10) UNSIGNED DEFAULT NULL,
  `quantite` double NOT NULL,
  `prix` double NOT NULL,
  `total` double NOT NULL,
  `modele` int(11) DEFAULT NULL,
  `etat` tinyint(1) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `commande_modeles`
--

INSERT INTO `commande_modeles` (`id`, `modele_fournisseur_id`, `commande_id`, `quantite`, `prix`, `total`, `modele`, `etat`, `created_at`, `updated_at`) VALUES
(30, NULL, 36, 440, 4000, 1760000, 28, 1, '2023-01-05 19:15:00', '2023-01-05 19:15:00'),
(31, NULL, 37, 360, 4000, 1440000, 29, 0, '2023-01-05 19:23:47', '2023-01-05 19:23:47'),
(32, NULL, 38, 10, 1500, 15000, 10, 0, '2023-01-07 02:27:17', '2023-01-07 02:27:17'),
(33, NULL, 39, 10, 6000, 60000, 186, 1, '2023-01-07 02:28:42', '2023-01-07 02:28:42');

-- --------------------------------------------------------

--
-- Table structure for table `depenses`
--

CREATE TABLE `depenses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montant` double DEFAULT NULL,
  `motif` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `justifier` tinyint(1) NOT NULL DEFAULT 0,
  `date_dep` date NOT NULL DEFAULT '2022-08-26',
  `sold_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `journal_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `depense_files`
--

CREATE TABLE `depense_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `depense_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devis_lignes_ventes`
--

CREATE TABLE `devis_lignes_ventes` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantite` double NOT NULL,
  `prix` double NOT NULL,
  `reduction` double DEFAULT 0,
  `prixtotal` double NOT NULL,
  `modele_fournisseur_id` int(10) UNSIGNED DEFAULT NULL,
  `devis_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `devis_ventes`
--

CREATE TABLE `devis_ventes` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `client_id` int(10) UNSIGNED DEFAULT NULL,
  `date_devis` datetime NOT NULL,
  `filename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `with_tva` tinyint(1) DEFAULT 0,
  `tva` int(11) DEFAULT 18,
  `montant_tva` double DEFAULT NULL,
  `montant_ht` double DEFAULT NULL,
  `montant_reduction` double DEFAULT 0,
  `totaux` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employes`
--

CREATE TABLE `employes` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `factures`
--

CREATE TABLE `factures` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prixapayer` double NOT NULL,
  `montant_reduction` double DEFAULT 0,
  `vente_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `factures`
--

INSERT INTO `factures` (`id`, `numero`, `prixapayer`, `montant_reduction`, `vente_id`, `created_at`, `updated_at`) VALUES
(55, 'FACT2023-1', 319800, 0, 61, '2023-01-04 21:40:13', '2023-01-04 21:40:13'),
(56, 'FACT2023-56', 226600, 0, 62, '2023-01-06 13:59:15', '2023-01-06 13:59:15'),
(57, 'FACT2023-57', 406350, 0, 63, '2023-01-06 14:10:36', '2023-01-06 14:10:36'),
(58, 'FACT2023-58', 124350, 0, 64, '2023-01-07 13:36:48', '2023-01-07 13:36:48'),
(59, 'FACT2023-59', 323900, 0, 65, '2023-01-07 13:41:20', '2023-01-07 13:41:20'),
(60, 'FACT2023-60', 212200, 0, 66, '2023-01-07 13:49:11', '2023-01-07 13:49:11'),
(61, 'FACT2023-61', 194300, 0, 67, '2023-01-07 14:03:52', '2023-01-07 14:03:52'),
(62, 'FACT2023-62', 194300, 0, 68, '2023-01-07 14:20:33', '2023-01-07 14:20:33'),
(63, 'FACT2023-63', 169250, 0, 69, '2023-01-07 14:37:38', '2023-01-07 14:37:38'),
(64, 'FACT2023-64', 900950, 5750, 70, '2023-01-07 15:11:28', '2023-01-07 15:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `facture_fictives`
--

CREATE TABLE `facture_fictives` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `with_tva` tinyint(1) DEFAULT 0,
  `tva` int(11) DEFAULT 18,
  `montant_tva` double DEFAULT NULL,
  `montant_ht` double DEFAULT NULL,
  `montant_ttc` double DEFAULT NULL,
  `vente_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fournisseurs`
--

CREATE TABLE `fournisseurs` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fournisseurs`
--

INSERT INTO `fournisseurs` (`id`, `nom`, `adresse`, `contact`, `description`, `email`, `created_at`, `updated_at`) VALUES
(7, 'ETS AKLA ET FRERE', 'KARA', '90171513', 'VENTE DU CIMENT', NULL, '2022-12-24 16:00:30', '2022-12-24 16:00:30'),
(8, 'ETS DIF  BAT', 'LOME', '90313933', 'VENTE DU CIMENT', NULL, '2022-12-24 16:01:28', '2022-12-24 16:01:28'),
(9, 'TOROMETAL CUBE STEEL', 'KARA', '90172351', 'VENTE DES FERS A BETON', 'torometal21@gmail.com', '2022-12-24 16:04:30', '2022-12-24 16:04:30');

-- --------------------------------------------------------

--
-- Table structure for table `historiques`
--

CREATE TABLE `historiques` (
  `id` int(10) UNSIGNED NOT NULL,
  `actions` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cible` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT 0,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `historiques`
--

INSERT INTO `historiques` (`id`, `actions`, `cible`, `etat`, `user_id`, `created_at`, `updated_at`) VALUES
(2381, 'Connecté', 'Compte', 0, 6, '2023-01-04 18:37:50', '2023-01-04 18:37:50'),
(2382, 'Liste', 'Utilisateurs', 0, 6, '2023-01-04 18:41:08', '2023-01-04 18:41:08'),
(2383, 'Affichage', 'Compte', 0, 6, '2023-01-04 18:41:47', '2023-01-04 18:41:47'),
(2384, 'Modifier', 'Compte', 0, 6, '2023-01-04 18:42:44', '2023-01-04 18:42:44'),
(2385, 'Affichage', 'Compte', 0, 6, '2023-01-04 18:42:45', '2023-01-04 18:42:45'),
(2386, 'Connecté', 'Compte', 0, 6, '2023-01-04 18:43:05', '2023-01-04 18:43:05'),
(2387, 'Connecté', 'Compte', 0, 6, '2023-01-04 18:43:20', '2023-01-04 18:43:20'),
(2388, 'Liste', 'Utilisateurs', 0, 6, '2023-01-04 18:43:29', '2023-01-04 18:43:29'),
(2389, 'Liste', 'Utilisateurs', 0, 6, '2023-01-04 18:43:35', '2023-01-04 18:43:35'),
(2390, 'Affichage', 'Compte', 0, 6, '2023-01-04 18:43:38', '2023-01-04 18:43:38'),
(2391, 'Connecté', 'Compte', 0, 6, '2023-01-04 20:18:39', '2023-01-04 20:18:39'),
(2392, 'Liste', 'Modeles', 0, 6, '2023-01-04 20:20:10', '2023-01-04 20:20:10'),
(2393, 'Liste', 'Utilisateurs', 0, 6, '2023-01-04 20:20:29', '2023-01-04 20:20:29'),
(2394, 'Creer', 'Utilisateurs', 0, 6, '2023-01-04 20:26:19', '2023-01-04 20:26:19'),
(2395, 'Connecté', 'Compte', 0, 32, '2023-01-04 20:27:37', '2023-01-04 20:27:37'),
(2396, 'Liste', 'Modeles', 0, 32, '2023-01-04 20:27:42', '2023-01-04 20:27:42'),
(2397, 'Connecté', 'Compte', 0, 6, '2023-01-04 20:46:53', '2023-01-04 20:46:53'),
(2398, 'Liste', 'Utilisateurs', 0, 6, '2023-01-04 20:46:55', '2023-01-04 20:46:55'),
(2399, 'Creer', 'Utilisateurs', 0, 6, '2023-01-04 20:49:15', '2023-01-04 20:49:15'),
(2400, 'Connecté', 'Compte', 0, 33, '2023-01-04 20:49:47', '2023-01-04 20:49:47'),
(2401, 'Liste', 'Modeles', 0, 33, '2023-01-04 20:50:27', '2023-01-04 20:50:27'),
(2402, 'Liste', 'Modeles', 0, 33, '2023-01-04 20:51:21', '2023-01-04 20:51:21'),
(2403, 'Connecté', 'Compte', 0, 6, '2023-01-04 20:55:17', '2023-01-04 20:55:17'),
(2404, 'Liste', 'Utilisateurs', 0, 6, '2023-01-04 20:55:20', '2023-01-04 20:55:20'),
(2405, 'Creer', 'Utilisateurs', 0, 6, '2023-01-04 20:59:56', '2023-01-04 20:59:56'),
(2406, 'Connecté', 'Compte', 0, 34, '2023-01-04 21:01:24', '2023-01-04 21:01:24'),
(2407, 'Liste', 'Modeles', 0, 34, '2023-01-04 21:01:28', '2023-01-04 21:01:28'),
(2408, 'Creer', 'Modeles', 0, 34, '2023-01-04 21:05:32', '2023-01-04 21:05:32'),
(2409, 'Detail', 'Modeles', 0, 34, '2023-01-04 21:06:27', '2023-01-04 21:06:27'),
(2410, 'Modifier', 'Modeles', 0, 34, '2023-01-04 21:07:50', '2023-01-04 21:07:50'),
(2411, 'Connecté', 'Compte', 0, 34, '2023-01-04 21:14:36', '2023-01-04 21:14:36'),
(2412, 'Liste', 'Modeles', 0, 34, '2023-01-04 21:14:41', '2023-01-04 21:14:41'),
(2413, 'Detail', 'Modeles', 0, 34, '2023-01-04 21:14:48', '2023-01-04 21:14:48'),
(2414, 'Modifier', 'Modeles', 0, 34, '2023-01-04 21:16:32', '2023-01-04 21:16:32'),
(2415, 'Connecté', 'Compte', 0, 32, '2023-01-04 21:17:11', '2023-01-04 21:17:11'),
(2416, 'Liste', 'Modeles', 0, 32, '2023-01-04 21:17:15', '2023-01-04 21:17:15'),
(2417, 'Detail', 'Modeles', 0, 32, '2023-01-04 21:17:33', '2023-01-04 21:17:33'),
(2418, 'Modifier', 'Modeles', 0, 32, '2023-01-04 21:17:53', '2023-01-04 21:17:53'),
(2419, 'Connecté', 'Compte', 0, 32, '2023-01-04 21:18:05', '2023-01-04 21:18:05'),
(2420, 'Liste', 'Modeles', 0, 32, '2023-01-04 21:18:13', '2023-01-04 21:18:13'),
(2421, 'Connecté', 'Compte', 0, 6, '2023-01-04 21:28:24', '2023-01-04 21:28:24'),
(2422, 'Liste', 'Utilisateurs', 0, 6, '2023-01-04 21:28:26', '2023-01-04 21:28:26'),
(2423, 'Creer', 'Utilisateurs', 0, 6, '2023-01-04 21:29:46', '2023-01-04 21:29:46'),
(2424, 'Liste', 'Utilisateurs', 0, 6, '2023-01-04 21:30:06', '2023-01-04 21:30:06'),
(2425, 'Liste', 'Utilisateurs', 0, 6, '2023-01-04 21:30:23', '2023-01-04 21:30:23'),
(2426, 'Detail', 'Utilisateurs', 0, 6, '2023-01-04 21:31:02', '2023-01-04 21:31:02'),
(2427, 'Connecté', 'Compte', 0, 34, '2023-01-04 21:32:33', '2023-01-04 21:32:33'),
(2428, 'Connecté', 'Compte', 0, 35, '2023-01-04 21:33:14', '2023-01-04 21:33:14'),
(2429, 'Liste', 'Modeles', 0, 35, '2023-01-04 21:33:18', '2023-01-04 21:33:18'),
(2430, 'Connecté', 'Compte', 0, 32, '2023-01-04 21:36:20', '2023-01-04 21:36:20'),
(2431, 'Liste', 'Ventes', 0, 32, '2023-01-04 21:36:59', '2023-01-04 21:36:59'),
(2432, 'Creer', 'Journal', 0, 32, '2023-01-04 21:37:12', '2023-01-04 21:37:12'),
(2433, 'Creer', 'Ventes', 0, 32, '2023-01-04 21:40:13', '2023-01-04 21:40:13'),
(2434, 'Liste', 'Ventes', 0, 32, '2023-01-04 21:40:59', '2023-01-04 21:40:59'),
(2435, 'Connecté', 'Compte', 0, 32, '2023-01-04 21:42:56', '2023-01-04 21:42:56'),
(2436, 'Liste', 'Modeles', 0, 32, '2023-01-04 21:43:30', '2023-01-04 21:43:30'),
(2437, 'Connecté', 'Compte', 0, 32, '2023-01-04 21:44:59', '2023-01-04 21:44:59'),
(2438, 'Connecté', 'Compte', 0, 6, '2023-01-04 21:46:46', '2023-01-04 21:46:46'),
(2439, 'Liste', 'Utilisateurs', 0, 6, '2023-01-04 21:46:48', '2023-01-04 21:46:48'),
(2440, 'Creer', 'Utilisateurs', 0, 6, '2023-01-04 21:51:02', '2023-01-04 21:51:02'),
(2441, 'Detail', 'Utilisateurs', 0, 6, '2023-01-04 21:51:18', '2023-01-04 21:51:18'),
(2442, 'Modifier', 'Utilisateurs', 0, 6, '2023-01-04 21:52:02', '2023-01-04 21:52:02'),
(2443, 'Connecté', 'Compte', 0, 35, '2023-01-04 21:53:01', '2023-01-04 21:53:01'),
(2444, 'Connecté', 'Compte', 0, 32, '2023-01-04 23:12:43', '2023-01-04 23:12:43'),
(2445, 'Liste', 'Ventes', 0, 32, '2023-01-04 23:14:40', '2023-01-04 23:14:40'),
(2446, 'Detail', 'Ventes', 0, 32, '2023-01-04 23:15:13', '2023-01-04 23:15:13'),
(2447, 'Detail', 'Ventes', 0, 32, '2023-01-04 23:15:14', '2023-01-04 23:15:14'),
(2448, 'Liste', 'Ventes', 0, 32, '2023-01-04 23:16:44', '2023-01-04 23:16:44'),
(2449, 'Detail', 'Ventes', 0, 32, '2023-01-04 23:18:05', '2023-01-04 23:18:05'),
(2450, 'Detail', 'Ventes', 0, 32, '2023-01-04 23:18:06', '2023-01-04 23:18:06'),
(2451, 'Connecté', 'Compte', 0, 32, '2023-01-04 23:19:46', '2023-01-04 23:19:46'),
(2452, 'Connecté', 'Compte', 0, 4, '2023-01-05 01:38:33', '2023-01-05 01:38:33'),
(2453, 'Connecté', 'Compte', 0, 4, '2023-01-05 01:38:50', '2023-01-05 01:38:50'),
(2454, 'Connecté', 'Compte', 0, 4, '2023-01-05 01:41:19', '2023-01-05 01:41:19'),
(2455, 'Liste', 'Modeles', 0, 4, '2023-01-05 01:42:36', '2023-01-05 01:42:36'),
(2456, 'Connecté', 'Compte', 0, 32, '2023-01-05 01:43:14', '2023-01-05 01:43:14'),
(2457, 'Liste', 'Modeles', 0, 32, '2023-01-05 01:43:28', '2023-01-05 01:43:28'),
(2458, 'Liste', 'Ventes', 0, 32, '2023-01-05 01:43:43', '2023-01-05 01:43:43'),
(2459, 'liste', 'Clients', 0, 32, '2023-01-05 01:44:27', '2023-01-05 01:44:27'),
(2460, 'Connecté', 'Compte', 0, 32, '2023-01-05 01:50:59', '2023-01-05 01:50:59'),
(2461, 'Connecté', 'Compte', 0, 6, '2023-01-05 01:51:15', '2023-01-05 01:51:15'),
(2462, 'Connecté', 'Compte', 0, 6, '2023-01-05 01:51:29', '2023-01-05 01:51:29'),
(2463, 'liste', 'Boutique', 0, 6, '2023-01-05 01:51:33', '2023-01-05 01:51:33'),
(2464, 'Liste', 'Utilisateurs', 0, 6, '2023-01-05 01:51:56', '2023-01-05 01:51:56'),
(2465, 'Detail', 'Utilisateurs', 0, 6, '2023-01-05 01:53:12', '2023-01-05 01:53:12'),
(2466, 'Modifier', 'Utilisateurs', 0, 6, '2023-01-05 01:53:31', '2023-01-05 01:53:31'),
(2467, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 02:01:22', '2023-01-05 02:01:22'),
(2468, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 02:03:06', '2023-01-05 02:03:06'),
(2469, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 02:05:32', '2023-01-05 02:05:32'),
(2470, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 02:07:58', '2023-01-05 02:07:58'),
(2471, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 02:09:33', '2023-01-05 02:09:33'),
(2472, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 02:14:30', '2023-01-05 02:14:30'),
(2473, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 02:27:33', '2023-01-05 02:27:33'),
(2474, 'Detail', 'Utilisateurs', 0, 6, '2023-01-05 02:28:13', '2023-01-05 02:28:13'),
(2475, 'Modifier', 'Utilisateurs', 0, 6, '2023-01-05 02:29:41', '2023-01-05 02:29:41'),
(2476, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 02:32:02', '2023-01-05 02:32:02'),
(2477, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 02:33:42', '2023-01-05 02:33:42'),
(2478, 'Bloqué', 'Utilisateurs', 0, 6, '2023-01-05 02:34:01', '2023-01-05 02:34:01'),
(2479, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 02:38:28', '2023-01-05 02:38:28'),
(2480, 'Bloqué', 'Utilisateurs', 0, 6, '2023-01-05 02:38:43', '2023-01-05 02:38:43'),
(2481, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 02:39:55', '2023-01-05 02:39:55'),
(2482, 'Bloqué', 'Utilisateurs', 0, 6, '2023-01-05 02:40:10', '2023-01-05 02:40:10'),
(2483, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 02:43:28', '2023-01-05 02:43:28'),
(2484, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 02:47:39', '2023-01-05 02:47:39'),
(2485, 'Bloqué', 'Utilisateurs', 0, 6, '2023-01-05 02:47:51', '2023-01-05 02:47:51'),
(2486, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 02:50:35', '2023-01-05 02:50:35'),
(2487, 'Bloqué', 'Utilisateurs', 0, 6, '2023-01-05 02:50:48', '2023-01-05 02:50:48'),
(2488, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 02:59:44', '2023-01-05 02:59:44'),
(2489, 'Bloqué', 'Utilisateurs', 0, 6, '2023-01-05 02:59:58', '2023-01-05 02:59:58'),
(2490, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 03:00:59', '2023-01-05 03:00:59'),
(2491, 'Detail', 'Utilisateurs', 0, 6, '2023-01-05 03:02:01', '2023-01-05 03:02:01'),
(2492, 'Modifier', 'Utilisateurs', 0, 6, '2023-01-05 03:03:26', '2023-01-05 03:03:26'),
(2493, 'Bloqué', 'Utilisateurs', 0, 6, '2023-01-05 03:03:47', '2023-01-05 03:03:47'),
(2494, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 03:05:48', '2023-01-05 03:05:48'),
(2495, 'Bloqué', 'Utilisateurs', 0, 6, '2023-01-05 03:06:25', '2023-01-05 03:06:25'),
(2496, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 03:07:44', '2023-01-05 03:07:44'),
(2497, 'Bloqué', 'Utilisateurs', 0, 6, '2023-01-05 03:08:04', '2023-01-05 03:08:04'),
(2498, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 03:09:34', '2023-01-05 03:09:34'),
(2499, 'Bloqué', 'Utilisateurs', 0, 6, '2023-01-05 03:09:53', '2023-01-05 03:09:53'),
(2500, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 03:11:33', '2023-01-05 03:11:33'),
(2501, 'Bloqué', 'Utilisateurs', 0, 6, '2023-01-05 03:11:51', '2023-01-05 03:11:51'),
(2502, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 03:13:27', '2023-01-05 03:13:27'),
(2503, 'Bloqué', 'Utilisateurs', 0, 6, '2023-01-05 03:13:42', '2023-01-05 03:13:42'),
(2504, 'Detail', 'Utilisateurs', 0, 6, '2023-01-05 03:14:27', '2023-01-05 03:14:27'),
(2505, 'Modifier', 'Utilisateurs', 0, 6, '2023-01-05 03:15:00', '2023-01-05 03:15:00'),
(2506, 'Detail', 'Utilisateurs', 0, 6, '2023-01-05 03:15:18', '2023-01-05 03:15:18'),
(2507, 'Modifier', 'Utilisateurs', 0, 6, '2023-01-05 03:15:36', '2023-01-05 03:15:36'),
(2508, 'Detail', 'Utilisateurs', 0, 6, '2023-01-05 03:15:42', '2023-01-05 03:15:42'),
(2509, 'Modifier', 'Utilisateurs', 0, 6, '2023-01-05 03:15:59', '2023-01-05 03:15:59'),
(2510, 'Detail', 'Utilisateurs', 0, 6, '2023-01-05 03:16:24', '2023-01-05 03:16:24'),
(2511, 'Modifier', 'Utilisateurs', 0, 6, '2023-01-05 03:17:04', '2023-01-05 03:17:04'),
(2512, 'Detail', 'Utilisateurs', 0, 6, '2023-01-05 03:17:32', '2023-01-05 03:17:32'),
(2513, 'Modifier', 'Utilisateurs', 0, 6, '2023-01-05 03:18:10', '2023-01-05 03:18:10'),
(2514, 'Bloqué', 'Utilisateurs', 0, 6, '2023-01-05 03:18:28', '2023-01-05 03:18:28'),
(2515, 'Detail', 'Utilisateurs', 0, 6, '2023-01-05 03:18:43', '2023-01-05 03:18:43'),
(2516, 'Modifier', 'Utilisateurs', 0, 6, '2023-01-05 03:19:02', '2023-01-05 03:19:02'),
(2517, 'Detail', 'Utilisateurs', 0, 6, '2023-01-05 03:19:27', '2023-01-05 03:19:27'),
(2518, 'Modifier', 'Utilisateurs', 0, 6, '2023-01-05 03:19:46', '2023-01-05 03:19:46'),
(2519, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 03:22:56', '2023-01-05 03:22:56'),
(2520, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 03:24:14', '2023-01-05 03:24:14'),
(2521, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 03:28:41', '2023-01-05 03:28:41'),
(2522, 'Detail', 'Utilisateurs', 0, 6, '2023-01-05 03:28:54', '2023-01-05 03:28:54'),
(2523, 'Detail', 'Utilisateurs', 0, 6, '2023-01-05 03:29:48', '2023-01-05 03:29:48'),
(2524, 'Modifier', 'Utilisateurs', 0, 6, '2023-01-05 03:30:18', '2023-01-05 03:30:18'),
(2525, 'Bloqué', 'Utilisateurs', 0, 6, '2023-01-05 03:30:39', '2023-01-05 03:30:39'),
(2526, 'Bloqué', 'Utilisateurs', 0, 6, '2023-01-05 03:31:02', '2023-01-05 03:31:02'),
(2527, 'Creer', 'Utilisateurs', 0, 6, '2023-01-05 03:32:54', '2023-01-05 03:32:54'),
(2528, 'Bloqué', 'Utilisateurs', 0, 6, '2023-01-05 03:33:11', '2023-01-05 03:33:11'),
(2529, 'Detail', 'Ventes', 0, 6, '2023-01-05 03:36:04', '2023-01-05 03:36:04'),
(2530, 'Detail', 'Ventes', 0, 6, '2023-01-05 03:36:04', '2023-01-05 03:36:04'),
(2531, 'Affichage', 'Compte', 0, 6, '2023-01-05 03:37:48', '2023-01-05 03:37:48'),
(2532, 'Modifier', 'Compte', 0, 6, '2023-01-05 03:38:57', '2023-01-05 03:38:57'),
(2533, 'Affichage', 'Compte', 0, 6, '2023-01-05 03:38:57', '2023-01-05 03:38:57'),
(2534, 'Connecté', 'Compte', 0, 6, '2023-01-05 03:39:18', '2023-01-05 03:39:18'),
(2535, 'liste', 'Boutique', 0, 6, '2023-01-05 03:39:26', '2023-01-05 03:39:26'),
(2536, 'liste', 'Boutique', 0, 6, '2023-01-05 03:39:41', '2023-01-05 03:39:41'),
(2537, 'Connecté', 'Compte', 0, 32, '2023-01-05 03:39:59', '2023-01-05 03:39:59'),
(2538, 'Connecté', 'Compte', 0, 40, '2023-01-05 03:40:21', '2023-01-05 03:40:21'),
(2539, 'Connecté', 'Compte', 0, 43, '2023-01-05 03:40:39', '2023-01-05 03:40:39'),
(2540, 'Connecté', 'Compte', 0, 43, '2023-01-05 03:40:44', '2023-01-05 03:40:44'),
(2541, 'Connecté', 'Compte', 0, 6, '2023-01-05 03:41:44', '2023-01-05 03:41:44'),
(2542, 'Liste', 'Utilisateurs', 0, 6, '2023-01-05 03:41:49', '2023-01-05 03:41:49'),
(2543, 'Renitialisé mot de passe', 'Utilisateurs', 0, 6, '2023-01-05 03:42:26', '2023-01-05 03:42:26'),
(2544, 'Renitialisé mot de passe', 'Utilisateurs', 0, 6, '2023-01-05 03:42:39', '2023-01-05 03:42:39'),
(2545, 'Connecté', 'Compte', 0, 39, '2023-01-05 03:43:36', '2023-01-05 03:43:36'),
(2546, 'Connecté', 'Compte', 0, 38, '2023-01-05 03:43:50', '2023-01-05 03:43:50'),
(2547, 'Connecté', 'Compte', 0, 34, '2023-01-05 03:44:48', '2023-01-05 03:44:48'),
(2548, 'Connecté', 'Compte', 0, 37, '2023-01-05 03:45:11', '2023-01-05 03:45:11'),
(2549, 'Connecté', 'Compte', 0, 41, '2023-01-05 03:45:29', '2023-01-05 03:45:29'),
(2550, 'Connecté', 'Compte', 0, 42, '2023-01-05 03:45:51', '2023-01-05 03:45:51'),
(2551, 'Connecté', 'Compte', 0, 36, '2023-01-05 03:46:11', '2023-01-05 03:46:11'),
(2552, 'Connecté', 'Compte', 0, 47, '2023-01-05 03:46:36', '2023-01-05 03:46:36'),
(2553, 'Connecté', 'Compte', 0, 35, '2023-01-05 03:47:15', '2023-01-05 03:47:15'),
(2554, 'Connecté', 'Compte', 0, 46, '2023-01-05 03:47:34', '2023-01-05 03:47:34'),
(2555, 'Connecté', 'Compte', 0, 32, '2023-01-05 03:54:08', '2023-01-05 03:54:08'),
(2556, 'Connecté', 'Compte', 0, 32, '2023-01-05 13:23:22', '2023-01-05 13:23:22'),
(2557, 'liste', 'Inventaire', 0, 32, '2023-01-05 13:28:12', '2023-01-05 13:28:12'),
(2558, 'Connecté', 'Compte', 0, 32, '2023-01-05 13:28:33', '2023-01-05 13:28:33'),
(2559, 'Connecté', 'Compte', 0, 33, '2023-01-05 13:48:43', '2023-01-05 13:48:43'),
(2560, 'Liste', 'Modeles', 0, 33, '2023-01-05 13:52:25', '2023-01-05 13:52:25'),
(2561, 'Detail', 'Modeles', 0, 33, '2023-01-05 13:52:43', '2023-01-05 13:52:43'),
(2562, 'Modifier', 'Modeles', 0, 33, '2023-01-05 13:53:07', '2023-01-05 13:53:07'),
(2563, 'Connecté', 'Compte', 0, 33, '2023-01-05 13:56:00', '2023-01-05 13:56:00'),
(2564, 'Liste', 'Modeles', 0, 33, '2023-01-05 13:56:13', '2023-01-05 13:56:13'),
(2565, 'Detail', 'Modeles', 0, 33, '2023-01-05 13:56:36', '2023-01-05 13:56:36'),
(2566, 'Modifier', 'Modeles', 0, 33, '2023-01-05 13:56:58', '2023-01-05 13:56:58'),
(2567, 'Detail', 'Modeles', 0, 33, '2023-01-05 13:57:06', '2023-01-05 13:57:06'),
(2568, 'Modifier', 'Modeles', 0, 33, '2023-01-05 13:57:29', '2023-01-05 13:57:29'),
(2569, 'Detail', 'Modeles', 0, 33, '2023-01-05 13:57:35', '2023-01-05 13:57:35'),
(2570, 'Modifier', 'Modeles', 0, 33, '2023-01-05 13:57:51', '2023-01-05 13:57:51'),
(2571, 'Connecté', 'Compte', 0, 33, '2023-01-05 13:58:01', '2023-01-05 13:58:01'),
(2572, 'Liste', 'Modeles', 0, 33, '2023-01-05 13:58:15', '2023-01-05 13:58:15'),
(2573, 'Detail', 'Modeles', 0, 33, '2023-01-05 13:58:30', '2023-01-05 13:58:30'),
(2574, 'Detail', 'Modeles', 0, 33, '2023-01-05 13:58:57', '2023-01-05 13:58:57'),
(2575, 'Modifier', 'Modeles', 0, 33, '2023-01-05 13:59:11', '2023-01-05 13:59:11'),
(2576, 'Detail', 'Modeles', 0, 33, '2023-01-05 13:59:19', '2023-01-05 13:59:19'),
(2577, 'Modifier', 'Modeles', 0, 33, '2023-01-05 13:59:34', '2023-01-05 13:59:34'),
(2578, 'Detail', 'Modeles', 0, 33, '2023-01-05 13:59:41', '2023-01-05 13:59:41'),
(2579, 'Modifier', 'Modeles', 0, 33, '2023-01-05 13:59:53', '2023-01-05 13:59:53'),
(2580, 'Connecté', 'Compte', 0, 33, '2023-01-05 14:00:07', '2023-01-05 14:00:07'),
(2581, 'Liste', 'Modeles', 0, 33, '2023-01-05 14:00:26', '2023-01-05 14:00:26'),
(2582, 'Detail', 'Modeles', 0, 33, '2023-01-05 14:00:40', '2023-01-05 14:00:40'),
(2583, 'Detail', 'Modeles', 0, 33, '2023-01-05 14:00:57', '2023-01-05 14:00:57'),
(2584, 'Modifier', 'Modeles', 0, 33, '2023-01-05 14:01:07', '2023-01-05 14:01:07'),
(2585, 'Connecté', 'Compte', 0, 33, '2023-01-05 14:01:11', '2023-01-05 14:01:11'),
(2586, 'Connecté', 'Compte', 0, 40, '2023-01-05 14:25:36', '2023-01-05 14:25:36'),
(2587, 'Liste', 'Modeles', 0, 40, '2023-01-05 14:25:44', '2023-01-05 14:25:44'),
(2588, 'Detail', 'Modeles', 0, 40, '2023-01-05 14:25:52', '2023-01-05 14:25:52'),
(2589, 'Modifier', 'Modeles', 0, 40, '2023-01-05 14:27:23', '2023-01-05 14:27:23'),
(2590, 'Connecté', 'Compte', 0, 40, '2023-01-05 14:27:39', '2023-01-05 14:27:39'),
(2591, 'Connecté', 'Compte', 0, 42, '2023-01-05 14:28:57', '2023-01-05 14:28:57'),
(2592, 'Liste', 'Modeles', 0, 42, '2023-01-05 14:29:03', '2023-01-05 14:29:03'),
(2593, 'Detail', 'Modeles', 0, 42, '2023-01-05 14:29:31', '2023-01-05 14:29:31'),
(2594, 'Modifier', 'Modeles', 0, 42, '2023-01-05 14:30:12', '2023-01-05 14:30:12'),
(2595, 'Detail', 'Modeles', 0, 42, '2023-01-05 14:30:20', '2023-01-05 14:30:20'),
(2596, 'Modifier', 'Modeles', 0, 42, '2023-01-05 14:33:05', '2023-01-05 14:33:05'),
(2597, 'Detail', 'Modeles', 0, 42, '2023-01-05 14:33:10', '2023-01-05 14:33:10'),
(2598, 'Modifier', 'Modeles', 0, 42, '2023-01-05 14:33:42', '2023-01-05 14:33:42'),
(2599, 'Detail', 'Modeles', 0, 42, '2023-01-05 14:33:46', '2023-01-05 14:33:46'),
(2600, 'Modifier', 'Modeles', 0, 42, '2023-01-05 14:34:12', '2023-01-05 14:34:12'),
(2601, 'Detail', 'Modeles', 0, 42, '2023-01-05 14:34:18', '2023-01-05 14:34:18'),
(2602, 'Modifier', 'Modeles', 0, 42, '2023-01-05 14:34:40', '2023-01-05 14:34:40'),
(2603, 'Detail', 'Modeles', 0, 42, '2023-01-05 14:34:46', '2023-01-05 14:34:46'),
(2604, 'Modifier', 'Modeles', 0, 42, '2023-01-05 14:36:10', '2023-01-05 14:36:10'),
(2605, 'Detail', 'Modeles', 0, 42, '2023-01-05 14:36:37', '2023-01-05 14:36:37'),
(2606, 'Modifier', 'Modeles', 0, 42, '2023-01-05 14:37:12', '2023-01-05 14:37:12'),
(2607, 'Connecté', 'Compte', 0, 42, '2023-01-05 14:37:30', '2023-01-05 14:37:30'),
(2608, 'Connecté', 'Compte', 0, 36, '2023-01-05 14:38:45', '2023-01-05 14:38:45'),
(2609, 'Liste', 'Modeles', 0, 36, '2023-01-05 14:38:50', '2023-01-05 14:38:50'),
(2610, 'Detail', 'Modeles', 0, 36, '2023-01-05 14:39:10', '2023-01-05 14:39:10'),
(2611, 'Modifier', 'Modeles', 0, 36, '2023-01-05 14:39:21', '2023-01-05 14:39:21'),
(2612, 'Detail', 'Modeles', 0, 36, '2023-01-05 14:39:37', '2023-01-05 14:39:37'),
(2613, 'Modifier', 'Modeles', 0, 36, '2023-01-05 14:39:55', '2023-01-05 14:39:55'),
(2614, 'Detail', 'Modeles', 0, 36, '2023-01-05 14:40:01', '2023-01-05 14:40:01'),
(2615, 'Modifier', 'Modeles', 0, 36, '2023-01-05 14:40:19', '2023-01-05 14:40:19'),
(2616, 'Detail', 'Modeles', 0, 36, '2023-01-05 14:40:31', '2023-01-05 14:40:31'),
(2617, 'Modifier', 'Modeles', 0, 36, '2023-01-05 14:40:45', '2023-01-05 14:40:45'),
(2618, 'Detail', 'Modeles', 0, 36, '2023-01-05 14:40:56', '2023-01-05 14:40:56'),
(2619, 'Modifier', 'Modeles', 0, 36, '2023-01-05 14:41:06', '2023-01-05 14:41:06'),
(2620, 'Detail', 'Modeles', 0, 36, '2023-01-05 14:41:11', '2023-01-05 14:41:11'),
(2621, 'Modifier', 'Modeles', 0, 36, '2023-01-05 14:41:27', '2023-01-05 14:41:27'),
(2622, 'Detail', 'Modeles', 0, 36, '2023-01-05 14:41:44', '2023-01-05 14:41:44'),
(2623, 'Modifier', 'Modeles', 0, 36, '2023-01-05 14:42:06', '2023-01-05 14:42:06'),
(2624, 'Detail', 'Modeles', 0, 36, '2023-01-05 14:42:14', '2023-01-05 14:42:14'),
(2625, 'Modifier', 'Modeles', 0, 36, '2023-01-05 14:42:33', '2023-01-05 14:42:33'),
(2626, 'Detail', 'Modeles', 0, 36, '2023-01-05 14:42:43', '2023-01-05 14:42:43'),
(2627, 'Modifier', 'Modeles', 0, 36, '2023-01-05 14:43:16', '2023-01-05 14:43:16'),
(2628, 'Detail', 'Modeles', 0, 36, '2023-01-05 14:43:23', '2023-01-05 14:43:23'),
(2629, 'Modifier', 'Modeles', 0, 36, '2023-01-05 14:43:39', '2023-01-05 14:43:39'),
(2630, 'Detail', 'Modeles', 0, 36, '2023-01-05 14:44:05', '2023-01-05 14:44:05'),
(2631, 'Modifier', 'Modeles', 0, 36, '2023-01-05 14:44:24', '2023-01-05 14:44:24'),
(2632, 'Detail', 'Modeles', 0, 36, '2023-01-05 14:44:29', '2023-01-05 14:44:29'),
(2633, 'Modifier', 'Modeles', 0, 36, '2023-01-05 14:44:38', '2023-01-05 14:44:38'),
(2634, 'Detail', 'Modeles', 0, 36, '2023-01-05 14:44:43', '2023-01-05 14:44:43'),
(2635, 'Modifier', 'Modeles', 0, 36, '2023-01-05 14:44:59', '2023-01-05 14:44:59'),
(2636, 'Detail', 'Modeles', 0, 36, '2023-01-05 14:45:09', '2023-01-05 14:45:09'),
(2637, 'Modifier', 'Modeles', 0, 36, '2023-01-05 14:45:23', '2023-01-05 14:45:23'),
(2638, 'Connecté', 'Compte', 0, 36, '2023-01-05 14:45:51', '2023-01-05 14:45:51'),
(2639, 'Connecté', 'Compte', 0, 39, '2023-01-05 14:49:36', '2023-01-05 14:49:36'),
(2640, 'Liste', 'Modeles', 0, 39, '2023-01-05 14:50:14', '2023-01-05 14:50:14'),
(2641, 'Detail', 'Modeles', 0, 39, '2023-01-05 14:50:24', '2023-01-05 14:50:24'),
(2642, 'Modifier', 'Modeles', 0, 39, '2023-01-05 14:51:06', '2023-01-05 14:51:06'),
(2643, 'Connecté', 'Compte', 0, 39, '2023-01-05 14:51:12', '2023-01-05 14:51:12'),
(2644, 'Connecté', 'Compte', 0, 38, '2023-01-05 14:52:12', '2023-01-05 14:52:12'),
(2645, 'Liste', 'Modeles', 0, 38, '2023-01-05 14:52:29', '2023-01-05 14:52:29'),
(2646, 'Detail', 'Modeles', 0, 38, '2023-01-05 14:52:37', '2023-01-05 14:52:37'),
(2647, 'Modifier', 'Modeles', 0, 38, '2023-01-05 14:53:38', '2023-01-05 14:53:38'),
(2648, 'Detail', 'Modeles', 0, 38, '2023-01-05 14:54:06', '2023-01-05 14:54:06'),
(2649, 'Modifier', 'Modeles', 0, 38, '2023-01-05 14:54:57', '2023-01-05 14:54:57'),
(2650, 'Detail', 'Modeles', 0, 38, '2023-01-05 14:55:11', '2023-01-05 14:55:11'),
(2651, 'Modifier', 'Modeles', 0, 38, '2023-01-05 14:55:32', '2023-01-05 14:55:32'),
(2652, 'Detail', 'Modeles', 0, 38, '2023-01-05 14:55:38', '2023-01-05 14:55:38'),
(2653, 'Modifier', 'Modeles', 0, 38, '2023-01-05 14:55:57', '2023-01-05 14:55:57'),
(2654, 'Detail', 'Modeles', 0, 38, '2023-01-05 14:56:13', '2023-01-05 14:56:13'),
(2655, 'Modifier', 'Modeles', 0, 38, '2023-01-05 14:56:29', '2023-01-05 14:56:29'),
(2656, 'Detail', 'Modeles', 0, 38, '2023-01-05 14:56:32', '2023-01-05 14:56:32'),
(2657, 'Modifier', 'Modeles', 0, 38, '2023-01-05 14:56:44', '2023-01-05 14:56:44'),
(2658, 'Detail', 'Modeles', 0, 38, '2023-01-05 14:56:53', '2023-01-05 14:56:53'),
(2659, 'Modifier', 'Modeles', 0, 38, '2023-01-05 14:57:46', '2023-01-05 14:57:46'),
(2660, 'Detail', 'Modeles', 0, 38, '2023-01-05 14:57:51', '2023-01-05 14:57:51'),
(2661, 'Modifier', 'Modeles', 0, 38, '2023-01-05 14:58:15', '2023-01-05 14:58:15'),
(2662, 'Detail', 'Modeles', 0, 38, '2023-01-05 14:58:36', '2023-01-05 14:58:36'),
(2663, 'Modifier', 'Modeles', 0, 38, '2023-01-05 14:58:46', '2023-01-05 14:58:46'),
(2664, 'Detail', 'Modeles', 0, 38, '2023-01-05 14:58:49', '2023-01-05 14:58:49'),
(2665, 'Modifier', 'Modeles', 0, 38, '2023-01-05 14:59:11', '2023-01-05 14:59:11'),
(2666, 'Connecté', 'Compte', 0, 33, '2023-01-05 14:59:15', '2023-01-05 14:59:15'),
(2667, 'Detail', 'Modeles', 0, 38, '2023-01-05 14:59:23', '2023-01-05 14:59:23'),
(2668, 'Modifier', 'Modeles', 0, 38, '2023-01-05 14:59:45', '2023-01-05 14:59:45'),
(2669, 'Liste', 'Modeles', 0, 33, '2023-01-05 14:59:47', '2023-01-05 14:59:47'),
(2670, 'Detail', 'Modeles', 0, 38, '2023-01-05 14:59:50', '2023-01-05 14:59:50'),
(2671, 'Liste', 'Fournisseurs', 0, 33, '2023-01-05 14:59:55', '2023-01-05 14:59:55'),
(2672, 'Modifier', 'Modeles', 0, 38, '2023-01-05 15:00:11', '2023-01-05 15:00:11'),
(2673, 'Detail', 'Modeles', 0, 38, '2023-01-05 15:00:15', '2023-01-05 15:00:15'),
(2674, 'Modifier', 'Modeles', 0, 38, '2023-01-05 15:00:34', '2023-01-05 15:00:34'),
(2675, 'Detail', 'Modeles', 0, 38, '2023-01-05 15:00:37', '2023-01-05 15:00:37'),
(2676, 'Modifier', 'Modeles', 0, 38, '2023-01-05 15:00:49', '2023-01-05 15:00:49'),
(2677, 'Connecté', 'Compte', 0, 40, '2023-01-05 15:34:08', '2023-01-05 15:34:08'),
(2678, 'Liste', 'Modeles', 0, 40, '2023-01-05 15:34:28', '2023-01-05 15:34:28'),
(2679, 'Connecté', 'Compte', 0, 40, '2023-01-05 15:34:48', '2023-01-05 15:34:48'),
(2680, 'Connecté', 'Compte', 0, 39, '2023-01-05 15:35:37', '2023-01-05 15:35:37'),
(2681, 'Liste', 'Modeles', 0, 39, '2023-01-05 15:35:40', '2023-01-05 15:35:40'),
(2682, 'Connecté', 'Compte', 0, 39, '2023-01-05 15:35:52', '2023-01-05 15:35:52'),
(2683, 'Connecté', 'Compte', 0, 38, '2023-01-05 15:36:31', '2023-01-05 15:36:31'),
(2684, 'Liste', 'Modeles', 0, 38, '2023-01-05 15:36:43', '2023-01-05 15:36:43'),
(2685, 'Detail', 'Modeles', 0, 38, '2023-01-05 15:37:04', '2023-01-05 15:37:04'),
(2686, 'Connecté', 'Compte', 0, 38, '2023-01-05 15:38:42', '2023-01-05 15:38:42'),
(2687, 'Connecté', 'Compte', 0, 42, '2023-01-05 15:39:41', '2023-01-05 15:39:41'),
(2688, 'Liste', 'Modeles', 0, 42, '2023-01-05 15:39:46', '2023-01-05 15:39:46'),
(2689, 'Detail', 'Modeles', 0, 42, '2023-01-05 15:39:51', '2023-01-05 15:39:51'),
(2690, 'Connecté', 'Compte', 0, 42, '2023-01-05 15:41:01', '2023-01-05 15:41:01'),
(2691, 'Connecté', 'Compte', 0, 36, '2023-01-05 15:41:48', '2023-01-05 15:41:48'),
(2692, 'Liste', 'Modeles', 0, 36, '2023-01-05 15:41:57', '2023-01-05 15:41:57'),
(2693, 'Detail', 'Modeles', 0, 36, '2023-01-05 15:42:10', '2023-01-05 15:42:10'),
(2694, 'Connecté', 'Compte', 0, 36, '2023-01-05 15:42:31', '2023-01-05 15:42:31'),
(2695, 'Connecté', 'Compte', 0, 36, '2023-01-05 18:15:18', '2023-01-05 18:15:18'),
(2696, 'Liste', 'Modeles', 0, 36, '2023-01-05 18:15:39', '2023-01-05 18:15:39'),
(2697, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:15:45', '2023-01-05 18:15:45'),
(2698, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:17:52', '2023-01-05 18:17:52'),
(2699, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:18:10', '2023-01-05 18:18:10'),
(2700, 'Modifier', 'Modeles', 0, 36, '2023-01-05 18:18:19', '2023-01-05 18:18:19'),
(2701, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:18:24', '2023-01-05 18:18:24'),
(2702, 'Modifier', 'Modeles', 0, 36, '2023-01-05 18:18:30', '2023-01-05 18:18:30'),
(2703, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:18:34', '2023-01-05 18:18:34'),
(2704, 'Modifier', 'Modeles', 0, 36, '2023-01-05 18:18:40', '2023-01-05 18:18:40'),
(2705, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:18:54', '2023-01-05 18:18:54'),
(2706, 'Modifier', 'Modeles', 0, 36, '2023-01-05 18:19:04', '2023-01-05 18:19:04'),
(2707, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:19:09', '2023-01-05 18:19:09'),
(2708, 'Modifier', 'Modeles', 0, 36, '2023-01-05 18:19:17', '2023-01-05 18:19:17'),
(2709, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:19:34', '2023-01-05 18:19:34'),
(2710, 'Modifier', 'Modeles', 0, 36, '2023-01-05 18:19:46', '2023-01-05 18:19:46'),
(2711, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:19:50', '2023-01-05 18:19:50'),
(2712, 'Modifier', 'Modeles', 0, 36, '2023-01-05 18:20:01', '2023-01-05 18:20:01'),
(2713, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:20:09', '2023-01-05 18:20:09'),
(2714, 'Modifier', 'Modeles', 0, 36, '2023-01-05 18:20:14', '2023-01-05 18:20:14'),
(2715, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:20:17', '2023-01-05 18:20:17'),
(2716, 'Modifier', 'Modeles', 0, 36, '2023-01-05 18:20:22', '2023-01-05 18:20:22'),
(2717, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:20:26', '2023-01-05 18:20:26'),
(2718, 'Modifier', 'Modeles', 0, 36, '2023-01-05 18:20:31', '2023-01-05 18:20:31'),
(2719, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:20:40', '2023-01-05 18:20:40'),
(2720, 'Modifier', 'Modeles', 0, 36, '2023-01-05 18:20:45', '2023-01-05 18:20:45'),
(2721, 'Connecté', 'Compte', 0, 36, '2023-01-05 18:20:54', '2023-01-05 18:20:54'),
(2722, 'Liste', 'Modeles', 0, 36, '2023-01-05 18:21:53', '2023-01-05 18:21:53'),
(2723, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:21:58', '2023-01-05 18:21:58'),
(2724, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:22:06', '2023-01-05 18:22:06'),
(2725, 'Modifier', 'Modeles', 0, 36, '2023-01-05 18:22:19', '2023-01-05 18:22:19'),
(2726, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:22:39', '2023-01-05 18:22:39'),
(2727, 'Modifier', 'Modeles', 0, 36, '2023-01-05 18:22:55', '2023-01-05 18:22:55'),
(2728, 'Connecté', 'Compte', 0, 36, '2023-01-05 18:23:04', '2023-01-05 18:23:04'),
(2729, 'Liste', 'Modeles', 0, 36, '2023-01-05 18:23:21', '2023-01-05 18:23:21'),
(2730, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:23:41', '2023-01-05 18:23:41'),
(2731, 'Supprimer', 'Modeles', 0, 36, '2023-01-05 18:24:02', '2023-01-05 18:24:02'),
(2732, 'Supprimer', 'Modeles', 0, 36, '2023-01-05 18:24:10', '2023-01-05 18:24:10'),
(2733, 'Connecté', 'Compte', 0, 36, '2023-01-05 18:24:16', '2023-01-05 18:24:16'),
(2734, 'Liste', 'Modeles', 0, 36, '2023-01-05 18:24:37', '2023-01-05 18:24:37'),
(2735, 'Detail', 'Modeles', 0, 36, '2023-01-05 18:24:46', '2023-01-05 18:24:46'),
(2736, 'Supprimer', 'Modeles', 0, 36, '2023-01-05 18:25:10', '2023-01-05 18:25:10'),
(2737, 'Supprimer', 'Modeles', 0, 36, '2023-01-05 18:25:16', '2023-01-05 18:25:16'),
(2738, 'Supprimer', 'Modeles', 0, 36, '2023-01-05 18:25:29', '2023-01-05 18:25:29'),
(2739, 'Supprimer', 'Modeles', 0, 36, '2023-01-05 18:25:34', '2023-01-05 18:25:34'),
(2740, 'Supprimer', 'Modeles', 0, 36, '2023-01-05 18:26:15', '2023-01-05 18:26:15'),
(2741, 'Supprimer', 'Modeles', 0, 36, '2023-01-05 18:26:21', '2023-01-05 18:26:21'),
(2742, 'Connecté', 'Compte', 0, 36, '2023-01-05 18:26:38', '2023-01-05 18:26:38'),
(2743, 'Connecté', 'Compte', 0, 40, '2023-01-05 18:28:20', '2023-01-05 18:28:20'),
(2744, 'Liste', 'Modeles', 0, 40, '2023-01-05 18:28:25', '2023-01-05 18:28:25'),
(2745, 'Supprimer', 'Modeles', 0, 40, '2023-01-05 18:28:46', '2023-01-05 18:28:46'),
(2746, 'Supprimer', 'Modeles', 0, 40, '2023-01-05 18:28:50', '2023-01-05 18:28:50'),
(2747, 'Supprimer', 'Modeles', 0, 40, '2023-01-05 18:28:53', '2023-01-05 18:28:53'),
(2748, 'Supprimer', 'Modeles', 0, 40, '2023-01-05 18:28:56', '2023-01-05 18:28:56'),
(2749, 'Supprimer', 'Modeles', 0, 40, '2023-01-05 18:28:59', '2023-01-05 18:28:59'),
(2750, 'Supprimer', 'Modeles', 0, 40, '2023-01-05 18:29:03', '2023-01-05 18:29:03'),
(2751, 'Supprimer', 'Modeles', 0, 40, '2023-01-05 18:29:07', '2023-01-05 18:29:07'),
(2752, 'Supprimer', 'Modeles', 0, 40, '2023-01-05 18:29:11', '2023-01-05 18:29:11'),
(2753, 'Supprimer', 'Modeles', 0, 40, '2023-01-05 18:29:15', '2023-01-05 18:29:15'),
(2754, 'Supprimer', 'Modeles', 0, 40, '2023-01-05 18:29:24', '2023-01-05 18:29:24'),
(2755, 'Supprimer', 'Modeles', 0, 40, '2023-01-05 18:29:28', '2023-01-05 18:29:28'),
(2756, 'Supprimer', 'Modeles', 0, 40, '2023-01-05 18:29:32', '2023-01-05 18:29:32'),
(2757, 'Supprimer', 'Modeles', 0, 40, '2023-01-05 18:29:37', '2023-01-05 18:29:37'),
(2758, 'Detail', 'Modeles', 0, 40, '2023-01-05 18:29:55', '2023-01-05 18:29:55'),
(2759, 'Modifier', 'Modeles', 0, 40, '2023-01-05 18:30:04', '2023-01-05 18:30:04'),
(2760, 'Connecté', 'Compte', 0, 40, '2023-01-05 18:31:17', '2023-01-05 18:31:17'),
(2761, 'Connecté', 'Compte', 0, 42, '2023-01-05 18:31:47', '2023-01-05 18:31:47'),
(2762, 'Liste', 'Modeles', 0, 42, '2023-01-05 18:31:57', '2023-01-05 18:31:57'),
(2763, 'Detail', 'Modeles', 0, 42, '2023-01-05 18:32:30', '2023-01-05 18:32:30'),
(2764, 'Detail', 'Modeles', 0, 42, '2023-01-05 18:33:47', '2023-01-05 18:33:47'),
(2765, 'Modifier', 'Modeles', 0, 42, '2023-01-05 18:33:56', '2023-01-05 18:33:56'),
(2766, 'Detail', 'Modeles', 0, 42, '2023-01-05 18:34:23', '2023-01-05 18:34:23'),
(2767, 'Supprimer', 'Modeles', 0, 42, '2023-01-05 18:34:44', '2023-01-05 18:34:44'),
(2768, 'Supprimer', 'Modeles', 0, 42, '2023-01-05 18:34:49', '2023-01-05 18:34:49'),
(2769, 'Connecté', 'Compte', 0, 42, '2023-01-05 18:34:54', '2023-01-05 18:34:54'),
(2770, 'Liste', 'Modeles', 0, 42, '2023-01-05 18:35:22', '2023-01-05 18:35:22'),
(2771, 'Detail', 'Modeles', 0, 42, '2023-01-05 18:35:26', '2023-01-05 18:35:26'),
(2772, 'Supprimer', 'Modeles', 0, 42, '2023-01-05 18:35:41', '2023-01-05 18:35:41'),
(2773, 'Supprimer', 'Modeles', 0, 42, '2023-01-05 18:35:44', '2023-01-05 18:35:44'),
(2774, 'Supprimer', 'Modeles', 0, 42, '2023-01-05 18:35:48', '2023-01-05 18:35:48'),
(2775, 'Supprimer', 'Modeles', 0, 42, '2023-01-05 18:35:52', '2023-01-05 18:35:52'),
(2776, 'Connecté', 'Compte', 0, 42, '2023-01-05 18:36:10', '2023-01-05 18:36:10'),
(2777, 'Connecté', 'Compte', 0, 39, '2023-01-05 18:36:40', '2023-01-05 18:36:40'),
(2778, 'Liste', 'Modeles', 0, 39, '2023-01-05 18:36:44', '2023-01-05 18:36:44'),
(2779, 'Detail', 'Modeles', 0, 39, '2023-01-05 18:36:50', '2023-01-05 18:36:50'),
(2780, 'Supprimer', 'Modeles', 0, 39, '2023-01-05 18:36:59', '2023-01-05 18:36:59'),
(2781, 'Supprimer', 'Modeles', 0, 39, '2023-01-05 18:37:02', '2023-01-05 18:37:02'),
(2782, 'Supprimer', 'Modeles', 0, 39, '2023-01-05 18:37:05', '2023-01-05 18:37:05'),
(2783, 'Supprimer', 'Modeles', 0, 39, '2023-01-05 18:37:08', '2023-01-05 18:37:08'),
(2784, 'Supprimer', 'Modeles', 0, 39, '2023-01-05 18:37:11', '2023-01-05 18:37:11'),
(2785, 'Supprimer', 'Modeles', 0, 39, '2023-01-05 18:37:15', '2023-01-05 18:37:15'),
(2786, 'Supprimer', 'Modeles', 0, 39, '2023-01-05 18:37:18', '2023-01-05 18:37:18'),
(2787, 'Supprimer', 'Modeles', 0, 39, '2023-01-05 18:37:21', '2023-01-05 18:37:21'),
(2788, 'Supprimer', 'Modeles', 0, 39, '2023-01-05 18:37:24', '2023-01-05 18:37:24'),
(2789, 'Supprimer', 'Modeles', 0, 39, '2023-01-05 18:37:27', '2023-01-05 18:37:27'),
(2790, 'Supprimer', 'Modeles', 0, 39, '2023-01-05 18:37:30', '2023-01-05 18:37:30'),
(2791, 'Supprimer', 'Modeles', 0, 39, '2023-01-05 18:37:34', '2023-01-05 18:37:34'),
(2792, 'Supprimer', 'Modeles', 0, 39, '2023-01-05 18:37:37', '2023-01-05 18:37:37'),
(2793, 'Detail', 'Modeles', 0, 39, '2023-01-05 18:37:49', '2023-01-05 18:37:49'),
(2794, 'Modifier', 'Modeles', 0, 39, '2023-01-05 18:37:57', '2023-01-05 18:37:57'),
(2795, 'Connecté', 'Compte', 0, 39, '2023-01-05 18:38:01', '2023-01-05 18:38:01'),
(2796, 'Connecté', 'Compte', 0, 38, '2023-01-05 18:38:34', '2023-01-05 18:38:34'),
(2797, 'Liste', 'Modeles', 0, 38, '2023-01-05 18:38:42', '2023-01-05 18:38:42'),
(2798, 'Detail', 'Modeles', 0, 38, '2023-01-05 18:38:48', '2023-01-05 18:38:48'),
(2799, 'Supprimer', 'Modeles', 0, 38, '2023-01-05 18:39:11', '2023-01-05 18:39:11'),
(2800, 'Creer', 'Modeles', 0, 38, '2023-01-05 18:40:51', '2023-01-05 18:40:51'),
(2801, 'Supprimer', 'Modeles', 0, 38, '2023-01-05 18:41:38', '2023-01-05 18:41:38'),
(2802, 'Supprimer', 'Modeles', 0, 38, '2023-01-05 18:42:00', '2023-01-05 18:42:00'),
(2803, 'Detail', 'Modeles', 0, 38, '2023-01-05 18:42:13', '2023-01-05 18:42:13'),
(2804, 'Modifier', 'Modeles', 0, 38, '2023-01-05 18:42:39', '2023-01-05 18:42:39'),
(2805, 'Detail', 'Modeles', 0, 38, '2023-01-05 18:42:42', '2023-01-05 18:42:42'),
(2806, 'Modifier', 'Modeles', 0, 38, '2023-01-05 18:43:12', '2023-01-05 18:43:12'),
(2807, 'Supprimer', 'Modeles', 0, 38, '2023-01-05 18:43:41', '2023-01-05 18:43:41'),
(2808, 'Supprimer', 'Modeles', 0, 38, '2023-01-05 18:43:45', '2023-01-05 18:43:45'),
(2809, 'Detail', 'Modeles', 0, 38, '2023-01-05 18:44:48', '2023-01-05 18:44:48'),
(2810, 'Modifier', 'Modeles', 0, 38, '2023-01-05 18:45:01', '2023-01-05 18:45:01'),
(2811, 'Detail', 'Modeles', 0, 38, '2023-01-05 18:45:31', '2023-01-05 18:45:31'),
(2812, 'Detail', 'Modeles', 0, 38, '2023-01-05 18:45:53', '2023-01-05 18:45:53'),
(2813, 'Detail', 'Modeles', 0, 38, '2023-01-05 18:46:20', '2023-01-05 18:46:20'),
(2814, 'Modifier', 'Modeles', 0, 38, '2023-01-05 18:46:27', '2023-01-05 18:46:27'),
(2815, 'Detail', 'Modeles', 0, 38, '2023-01-05 18:46:35', '2023-01-05 18:46:35'),
(2816, 'Modifier', 'Modeles', 0, 38, '2023-01-05 18:46:45', '2023-01-05 18:46:45'),
(2817, 'Detail', 'Modeles', 0, 38, '2023-01-05 18:46:50', '2023-01-05 18:46:50'),
(2818, 'Modifier', 'Modeles', 0, 38, '2023-01-05 18:46:57', '2023-01-05 18:46:57'),
(2819, 'Detail', 'Modeles', 0, 38, '2023-01-05 18:47:03', '2023-01-05 18:47:03'),
(2820, 'Modifier', 'Modeles', 0, 38, '2023-01-05 18:47:09', '2023-01-05 18:47:09'),
(2821, 'Detail', 'Modeles', 0, 38, '2023-01-05 18:47:18', '2023-01-05 18:47:18'),
(2822, 'Modifier', 'Modeles', 0, 38, '2023-01-05 18:47:24', '2023-01-05 18:47:24'),
(2823, 'Detail', 'Modeles', 0, 38, '2023-01-05 18:47:27', '2023-01-05 18:47:27'),
(2824, 'Modifier', 'Modeles', 0, 38, '2023-01-05 18:47:32', '2023-01-05 18:47:32'),
(2825, 'Connecté', 'Compte', 0, 38, '2023-01-05 18:48:22', '2023-01-05 18:48:22'),
(2826, 'Connecté', 'Compte', 0, 35, '2023-01-05 18:49:42', '2023-01-05 18:49:42'),
(2827, 'Connecté', 'Compte', 0, 35, '2023-01-05 18:51:43', '2023-01-05 18:51:43'),
(2828, 'Connecté', 'Compte', 0, 35, '2023-01-05 18:52:06', '2023-01-05 18:52:06'),
(2829, 'Liste', 'Modeles', 0, 35, '2023-01-05 18:52:39', '2023-01-05 18:52:39'),
(2830, 'Detail', 'Modeles', 0, 35, '2023-01-05 18:52:42', '2023-01-05 18:52:42'),
(2831, 'Detail', 'Modeles', 0, 35, '2023-01-05 18:53:15', '2023-01-05 18:53:15'),
(2832, 'Modifier', 'Modeles', 0, 35, '2023-01-05 18:53:37', '2023-01-05 18:53:37'),
(2833, 'Detail', 'Modeles', 0, 35, '2023-01-05 18:53:41', '2023-01-05 18:53:41'),
(2834, 'Modifier', 'Modeles', 0, 35, '2023-01-05 18:54:37', '2023-01-05 18:54:37'),
(2835, 'Detail', 'Modeles', 0, 35, '2023-01-05 18:54:42', '2023-01-05 18:54:42'),
(2836, 'Modifier', 'Modeles', 0, 35, '2023-01-05 18:55:04', '2023-01-05 18:55:04'),
(2837, 'Detail', 'Modeles', 0, 35, '2023-01-05 18:55:09', '2023-01-05 18:55:09'),
(2838, 'Modifier', 'Modeles', 0, 35, '2023-01-05 18:57:18', '2023-01-05 18:57:18'),
(2839, 'Detail', 'Modeles', 0, 35, '2023-01-05 18:57:23', '2023-01-05 18:57:23'),
(2840, 'Modifier', 'Modeles', 0, 35, '2023-01-05 18:57:58', '2023-01-05 18:57:58'),
(2841, 'Detail', 'Modeles', 0, 35, '2023-01-05 18:58:01', '2023-01-05 18:58:01'),
(2842, 'Modifier', 'Modeles', 0, 35, '2023-01-05 18:59:31', '2023-01-05 18:59:31'),
(2843, 'Detail', 'Modeles', 0, 35, '2023-01-05 18:59:36', '2023-01-05 18:59:36'),
(2844, 'Modifier', 'Modeles', 0, 35, '2023-01-05 18:59:44', '2023-01-05 18:59:44'),
(2845, 'Detail', 'Modeles', 0, 35, '2023-01-05 18:59:50', '2023-01-05 18:59:50'),
(2846, 'Modifier', 'Modeles', 0, 35, '2023-01-05 19:00:12', '2023-01-05 19:00:12'),
(2847, 'Detail', 'Modeles', 0, 35, '2023-01-05 19:00:45', '2023-01-05 19:00:45'),
(2848, 'Modifier', 'Modeles', 0, 35, '2023-01-05 19:01:17', '2023-01-05 19:01:17'),
(2849, 'Detail', 'Modeles', 0, 35, '2023-01-05 19:01:21', '2023-01-05 19:01:21'),
(2850, 'Modifier', 'Modeles', 0, 35, '2023-01-05 19:01:49', '2023-01-05 19:01:49'),
(2851, 'Detail', 'Modeles', 0, 35, '2023-01-05 19:01:53', '2023-01-05 19:01:53'),
(2852, 'Modifier', 'Modeles', 0, 35, '2023-01-05 19:02:01', '2023-01-05 19:02:01'),
(2853, 'Detail', 'Modeles', 0, 35, '2023-01-05 19:02:12', '2023-01-05 19:02:12'),
(2854, 'Modifier', 'Modeles', 0, 35, '2023-01-05 19:02:23', '2023-01-05 19:02:23'),
(2855, 'Detail', 'Modeles', 0, 35, '2023-01-05 19:02:30', '2023-01-05 19:02:30'),
(2856, 'Modifier', 'Modeles', 0, 35, '2023-01-05 19:03:04', '2023-01-05 19:03:04'),
(2857, 'Detail', 'Modeles', 0, 35, '2023-01-05 19:03:09', '2023-01-05 19:03:09'),
(2858, 'Modifier', 'Modeles', 0, 35, '2023-01-05 19:03:26', '2023-01-05 19:03:26'),
(2859, 'Detail', 'Modeles', 0, 35, '2023-01-05 19:03:39', '2023-01-05 19:03:39'),
(2860, 'Modifier', 'Modeles', 0, 35, '2023-01-05 19:04:17', '2023-01-05 19:04:17'),
(2861, 'Detail', 'Modeles', 0, 35, '2023-01-05 19:04:23', '2023-01-05 19:04:23'),
(2862, 'Modifier', 'Modeles', 0, 35, '2023-01-05 19:04:50', '2023-01-05 19:04:50'),
(2863, 'Detail', 'Modeles', 0, 35, '2023-01-05 19:04:54', '2023-01-05 19:04:54'),
(2864, 'Modifier', 'Modeles', 0, 35, '2023-01-05 19:05:22', '2023-01-05 19:05:22'),
(2865, 'Detail', 'Modeles', 0, 35, '2023-01-05 19:05:26', '2023-01-05 19:05:26'),
(2866, 'Modifier', 'Modeles', 0, 35, '2023-01-05 19:05:49', '2023-01-05 19:05:49'),
(2867, 'Detail', 'Modeles', 0, 35, '2023-01-05 19:06:08', '2023-01-05 19:06:08'),
(2868, 'Modifier', 'Modeles', 0, 35, '2023-01-05 19:06:15', '2023-01-05 19:06:15'),
(2869, 'Connecté', 'Compte', 0, 35, '2023-01-05 19:06:31', '2023-01-05 19:06:31'),
(2870, 'Connecté', 'Compte', 0, 35, '2023-01-05 19:07:36', '2023-01-05 19:07:36'),
(2871, 'Liste', 'Commandes', 0, 35, '2023-01-05 19:07:54', '2023-01-05 19:07:54'),
(2872, 'Creer', 'Journal', 0, 35, '2023-01-05 19:08:07', '2023-01-05 19:08:07'),
(2873, 'Connecté', 'Compte', 0, 35, '2023-01-05 19:09:11', '2023-01-05 19:09:11'),
(2874, 'Liste', 'Fournisseurs', 0, 35, '2023-01-05 19:09:17', '2023-01-05 19:09:17'),
(2875, 'Detail', 'Fournisseurs', 0, 35, '2023-01-05 19:09:24', '2023-01-05 19:09:24'),
(2876, 'Connecté', 'Compte', 0, 35, '2023-01-05 19:10:19', '2023-01-05 19:10:19'),
(2877, 'Liste', 'Commandes', 0, 35, '2023-01-05 19:10:24', '2023-01-05 19:10:24'),
(2878, 'Connecté', 'Compte', 0, 35, '2023-01-05 19:12:43', '2023-01-05 19:12:43'),
(2879, 'Liste', 'Commandes', 0, 35, '2023-01-05 19:13:34', '2023-01-05 19:13:34'),
(2880, 'Creer', 'Commandes indirecte', 0, 35, '2023-01-05 19:15:00', '2023-01-05 19:15:00'),
(2881, 'Liste', 'Commandes', 0, 35, '2023-01-05 19:15:00', '2023-01-05 19:15:00'),
(2882, 'Detail', 'Commandes', 0, 35, '2023-01-05 19:15:08', '2023-01-05 19:15:08'),
(2883, 'Detail', 'Commandes', 0, 35, '2023-01-05 19:15:09', '2023-01-05 19:15:09'),
(2884, 'Connecté', 'Compte', 0, 35, '2023-01-05 19:15:39', '2023-01-05 19:15:39'),
(2885, 'Liste', 'Modeles', 0, 35, '2023-01-05 19:15:42', '2023-01-05 19:15:42'),
(2886, 'Liste', 'Commandes', 0, 35, '2023-01-05 19:16:07', '2023-01-05 19:16:07'),
(2887, 'Detail', 'Commandes', 0, 35, '2023-01-05 19:16:10', '2023-01-05 19:16:10'),
(2888, 'Detail', 'Commandes', 0, 35, '2023-01-05 19:16:10', '2023-01-05 19:16:10'),
(2889, 'Liste', 'Livraisons', 0, 35, '2023-01-05 19:16:41', '2023-01-05 19:16:41'),
(2890, 'Creer', 'Livraisons', 0, 35, '2023-01-05 19:16:45', '2023-01-05 19:16:45'),
(2891, 'Creer', 'Livraisons', 0, 35, '2023-01-05 19:18:06', '2023-01-05 19:18:06'),
(2892, 'Liste', 'Livraisons', 0, 35, '2023-01-05 19:18:07', '2023-01-05 19:18:07'),
(2893, 'Detail', 'Livraisons', 0, 35, '2023-01-05 19:18:11', '2023-01-05 19:18:11'),
(2894, 'Detail', 'Livraisons', 0, 35, '2023-01-05 19:18:11', '2023-01-05 19:18:11'),
(2895, 'Connecté', 'Compte', 0, 35, '2023-01-05 19:18:28', '2023-01-05 19:18:28'),
(2896, 'Liste', 'Modeles', 0, 35, '2023-01-05 19:18:34', '2023-01-05 19:18:34'),
(2897, 'Connecté', 'Compte', 0, 35, '2023-01-05 19:18:45', '2023-01-05 19:18:45'),
(2898, 'liste', 'Transferts', 0, 35, '2023-01-05 19:19:51', '2023-01-05 19:19:51'),
(2899, 'Connecté', 'Compte', 0, 35, '2023-01-05 19:21:44', '2023-01-05 19:21:44'),
(2900, 'Connecté', 'Compte', 0, 36, '2023-01-05 19:21:59', '2023-01-05 19:21:59'),
(2901, 'Liste', 'Modeles', 0, 36, '2023-01-05 19:22:16', '2023-01-05 19:22:16'),
(2902, 'Liste', 'Commandes', 0, 36, '2023-01-05 19:22:31', '2023-01-05 19:22:31'),
(2903, 'Connecté', 'Compte', 0, 36, '2023-01-05 19:22:45', '2023-01-05 19:22:45'),
(2904, 'Liste', 'Commandes', 0, 36, '2023-01-05 19:22:54', '2023-01-05 19:22:54'),
(2905, 'Creer', 'Commandes directe', 0, 36, '2023-01-05 19:23:47', '2023-01-05 19:23:47'),
(2906, 'Liste', 'Commandes', 0, 36, '2023-01-05 19:23:47', '2023-01-05 19:23:47'),
(2907, 'Liste', 'Modeles', 0, 36, '2023-01-05 19:24:17', '2023-01-05 19:24:17'),
(2908, 'Connecté', 'Compte', 0, 33, '2023-01-05 19:31:19', '2023-01-05 19:31:19'),
(2909, 'Liste', 'Modeles', 0, 33, '2023-01-05 19:32:09', '2023-01-05 19:32:09'),
(2910, 'Detail', 'Modeles', 0, 33, '2023-01-05 19:34:16', '2023-01-05 19:34:16'),
(2911, 'Modifier', 'Modeles', 0, 33, '2023-01-05 19:34:26', '2023-01-05 19:34:26'),
(2912, 'Detail', 'Modeles', 0, 33, '2023-01-05 19:34:32', '2023-01-05 19:34:32'),
(2913, 'Modifier', 'Modeles', 0, 33, '2023-01-05 19:34:50', '2023-01-05 19:34:50'),
(2914, 'Detail', 'Modeles', 0, 33, '2023-01-05 19:34:55', '2023-01-05 19:34:55'),
(2915, 'Modifier', 'Modeles', 0, 33, '2023-01-05 19:35:07', '2023-01-05 19:35:07'),
(2916, 'Detail', 'Modeles', 0, 33, '2023-01-05 19:35:12', '2023-01-05 19:35:12'),
(2917, 'Modifier', 'Modeles', 0, 33, '2023-01-05 19:35:40', '2023-01-05 19:35:40'),
(2918, 'Detail', 'Modeles', 0, 33, '2023-01-05 19:35:47', '2023-01-05 19:35:47'),
(2919, 'Modifier', 'Modeles', 0, 33, '2023-01-05 19:36:47', '2023-01-05 19:36:47'),
(2920, 'Detail', 'Modeles', 0, 33, '2023-01-05 19:36:54', '2023-01-05 19:36:54'),
(2921, 'Modifier', 'Modeles', 0, 33, '2023-01-05 19:37:12', '2023-01-05 19:37:12'),
(2922, 'Detail', 'Modeles', 0, 33, '2023-01-05 19:37:26', '2023-01-05 19:37:26'),
(2923, 'Modifier', 'Modeles', 0, 33, '2023-01-05 19:37:46', '2023-01-05 19:37:46'),
(2924, 'Detail', 'Modeles', 0, 33, '2023-01-05 19:37:52', '2023-01-05 19:37:52'),
(2925, 'Modifier', 'Modeles', 0, 33, '2023-01-05 19:38:08', '2023-01-05 19:38:08'),
(2926, 'Detail', 'Modeles', 0, 33, '2023-01-05 19:38:13', '2023-01-05 19:38:13'),
(2927, 'Modifier', 'Modeles', 0, 33, '2023-01-05 19:38:48', '2023-01-05 19:38:48'),
(2928, 'Detail', 'Modeles', 0, 33, '2023-01-05 19:38:53', '2023-01-05 19:38:53'),
(2929, 'Modifier', 'Modeles', 0, 33, '2023-01-05 19:39:03', '2023-01-05 19:39:03'),
(2930, 'Detail', 'Modeles', 0, 33, '2023-01-05 19:39:13', '2023-01-05 19:39:13'),
(2931, 'Supprimer', 'Modeles', 0, 33, '2023-01-05 19:39:30', '2023-01-05 19:39:30'),
(2932, 'Supprimer', 'Modeles', 0, 33, '2023-01-05 19:39:34', '2023-01-05 19:39:34'),
(2933, 'Supprimer', 'Modeles', 0, 33, '2023-01-05 19:39:37', '2023-01-05 19:39:37'),
(2934, 'Supprimer', 'Modeles', 0, 33, '2023-01-05 19:39:41', '2023-01-05 19:39:41'),
(2935, 'Connecté', 'Compte', 0, 33, '2023-01-05 19:39:52', '2023-01-05 19:39:52'),
(2936, 'Connecté', 'Compte', 0, 34, '2023-01-05 19:40:30', '2023-01-05 19:40:30'),
(2937, 'Liste', 'Modeles', 0, 34, '2023-01-05 19:40:45', '2023-01-05 19:40:45'),
(2938, 'Detail', 'Modeles', 0, 34, '2023-01-05 19:41:03', '2023-01-05 19:41:03'),
(2939, 'Modifier', 'Modeles', 0, 34, '2023-01-05 19:41:18', '2023-01-05 19:41:18'),
(2940, 'Detail', 'Modeles', 0, 34, '2023-01-05 19:41:24', '2023-01-05 19:41:24'),
(2941, 'Modifier', 'Modeles', 0, 34, '2023-01-05 19:41:38', '2023-01-05 19:41:38'),
(2942, 'Detail', 'Modeles', 0, 34, '2023-01-05 19:41:59', '2023-01-05 19:41:59'),
(2943, 'Modifier', 'Modeles', 0, 34, '2023-01-05 19:42:12', '2023-01-05 19:42:12'),
(2944, 'Detail', 'Modeles', 0, 34, '2023-01-05 19:42:17', '2023-01-05 19:42:17'),
(2945, 'Modifier', 'Modeles', 0, 34, '2023-01-05 19:42:34', '2023-01-05 19:42:34'),
(2946, 'Supprimer', 'Modeles', 0, 34, '2023-01-05 19:43:01', '2023-01-05 19:43:01'),
(2947, 'Detail', 'Modeles', 0, 34, '2023-01-05 19:43:14', '2023-01-05 19:43:14'),
(2948, 'Modifier', 'Modeles', 0, 34, '2023-01-05 19:43:25', '2023-01-05 19:43:25'),
(2949, 'Detail', 'Modeles', 0, 34, '2023-01-05 19:43:31', '2023-01-05 19:43:31'),
(2950, 'Modifier', 'Modeles', 0, 34, '2023-01-05 19:44:08', '2023-01-05 19:44:08'),
(2951, 'Detail', 'Modeles', 0, 34, '2023-01-05 19:44:13', '2023-01-05 19:44:13'),
(2952, 'Modifier', 'Modeles', 0, 34, '2023-01-05 19:44:39', '2023-01-05 19:44:39'),
(2953, 'Supprimer', 'Modeles', 0, 34, '2023-01-05 19:45:04', '2023-01-05 19:45:04'),
(2954, 'Detail', 'Modeles', 0, 34, '2023-01-05 19:45:08', '2023-01-05 19:45:08'),
(2955, 'Modifier', 'Modeles', 0, 34, '2023-01-05 19:45:28', '2023-01-05 19:45:28'),
(2956, 'Detail', 'Modeles', 0, 34, '2023-01-05 19:45:44', '2023-01-05 19:45:44'),
(2957, 'Modifier', 'Modeles', 0, 34, '2023-01-05 19:46:04', '2023-01-05 19:46:04'),
(2958, 'Detail', 'Modeles', 0, 34, '2023-01-05 19:46:16', '2023-01-05 19:46:16'),
(2959, 'Modifier', 'Modeles', 0, 34, '2023-01-05 19:46:25', '2023-01-05 19:46:25'),
(2960, 'Detail', 'Modeles', 0, 34, '2023-01-05 19:46:35', '2023-01-05 19:46:35'),
(2961, 'Modifier', 'Modeles', 0, 34, '2023-01-05 19:46:59', '2023-01-05 19:46:59'),
(2962, 'Detail', 'Modeles', 0, 34, '2023-01-05 19:47:03', '2023-01-05 19:47:03'),
(2963, 'Modifier', 'Modeles', 0, 34, '2023-01-05 19:47:20', '2023-01-05 19:47:20'),
(2964, 'Supprimer', 'Modeles', 0, 34, '2023-01-05 19:47:35', '2023-01-05 19:47:35'),
(2965, 'Supprimer', 'Modeles', 0, 34, '2023-01-05 19:47:42', '2023-01-05 19:47:42'),
(2966, 'Connecté', 'Compte', 0, 34, '2023-01-05 19:47:50', '2023-01-05 19:47:50'),
(2967, 'Connecté', 'Compte', 0, 37, '2023-01-05 19:48:41', '2023-01-05 19:48:41'),
(2968, 'Liste', 'Modeles', 0, 37, '2023-01-05 19:48:50', '2023-01-05 19:48:50'),
(2969, 'Detail', 'Modeles', 0, 37, '2023-01-05 19:48:57', '2023-01-05 19:48:57'),
(2970, 'Modifier', 'Modeles', 0, 37, '2023-01-05 19:49:12', '2023-01-05 19:49:12'),
(2971, 'Detail', 'Modeles', 0, 37, '2023-01-05 19:49:16', '2023-01-05 19:49:16'),
(2972, 'Modifier', 'Modeles', 0, 37, '2023-01-05 19:49:51', '2023-01-05 19:49:51'),
(2973, 'Detail', 'Modeles', 0, 37, '2023-01-05 19:49:54', '2023-01-05 19:49:54'),
(2974, 'Modifier', 'Modeles', 0, 37, '2023-01-05 19:50:08', '2023-01-05 19:50:08'),
(2975, 'Detail', 'Modeles', 0, 37, '2023-01-05 19:50:14', '2023-01-05 19:50:14'),
(2976, 'Modifier', 'Modeles', 0, 37, '2023-01-05 19:50:27', '2023-01-05 19:50:27'),
(2977, 'Detail', 'Modeles', 0, 37, '2023-01-05 19:50:31', '2023-01-05 19:50:31'),
(2978, 'Modifier', 'Modeles', 0, 37, '2023-01-05 19:50:58', '2023-01-05 19:50:58'),
(2979, 'Detail', 'Modeles', 0, 37, '2023-01-05 19:51:03', '2023-01-05 19:51:03'),
(2980, 'Modifier', 'Modeles', 0, 37, '2023-01-05 19:51:17', '2023-01-05 19:51:17'),
(2981, 'Detail', 'Modeles', 0, 37, '2023-01-05 19:51:22', '2023-01-05 19:51:22'),
(2982, 'Modifier', 'Modeles', 0, 37, '2023-01-05 19:51:41', '2023-01-05 19:51:41'),
(2983, 'Detail', 'Modeles', 0, 37, '2023-01-05 19:51:49', '2023-01-05 19:51:49'),
(2984, 'Modifier', 'Modeles', 0, 37, '2023-01-05 19:52:14', '2023-01-05 19:52:14'),
(2985, 'Detail', 'Modeles', 0, 37, '2023-01-05 19:52:19', '2023-01-05 19:52:19'),
(2986, 'Modifier', 'Modeles', 0, 37, '2023-01-05 19:52:37', '2023-01-05 19:52:37'),
(2987, 'Detail', 'Modeles', 0, 37, '2023-01-05 19:52:41', '2023-01-05 19:52:41'),
(2988, 'Modifier', 'Modeles', 0, 37, '2023-01-05 19:53:00', '2023-01-05 19:53:00'),
(2989, 'Detail', 'Modeles', 0, 37, '2023-01-05 19:53:05', '2023-01-05 19:53:05'),
(2990, 'Modifier', 'Modeles', 0, 37, '2023-01-05 19:53:14', '2023-01-05 19:53:14'),
(2991, 'Detail', 'Modeles', 0, 37, '2023-01-05 19:53:31', '2023-01-05 19:53:31'),
(2992, 'Modifier', 'Modeles', 0, 37, '2023-01-05 19:53:50', '2023-01-05 19:53:50');
INSERT INTO `historiques` (`id`, `actions`, `cible`, `etat`, `user_id`, `created_at`, `updated_at`) VALUES
(2993, 'Detail', 'Modeles', 0, 37, '2023-01-05 19:53:53', '2023-01-05 19:53:53'),
(2994, 'Modifier', 'Modeles', 0, 37, '2023-01-05 19:54:20', '2023-01-05 19:54:20'),
(2995, 'Detail', 'Modeles', 0, 37, '2023-01-05 19:54:38', '2023-01-05 19:54:38'),
(2996, 'Modifier', 'Modeles', 0, 37, '2023-01-05 19:55:07', '2023-01-05 19:55:07'),
(2997, 'Detail', 'Modeles', 0, 37, '2023-01-05 19:55:16', '2023-01-05 19:55:16'),
(2998, 'Supprimer', 'Modeles', 0, 37, '2023-01-05 19:55:21', '2023-01-05 19:55:21'),
(2999, 'Supprimer', 'Modeles', 0, 37, '2023-01-05 19:55:26', '2023-01-05 19:55:26'),
(3000, 'Connecté', 'Compte', 0, 37, '2023-01-05 19:55:42', '2023-01-05 19:55:42'),
(3001, 'Connecté', 'Compte', 0, 41, '2023-01-05 19:56:37', '2023-01-05 19:56:37'),
(3002, 'Liste', 'Modeles', 0, 41, '2023-01-05 19:56:50', '2023-01-05 19:56:50'),
(3003, 'Detail', 'Modeles', 0, 41, '2023-01-05 19:56:55', '2023-01-05 19:56:55'),
(3004, 'Modifier', 'Modeles', 0, 41, '2023-01-05 19:57:16', '2023-01-05 19:57:16'),
(3005, 'Detail', 'Modeles', 0, 41, '2023-01-05 19:57:21', '2023-01-05 19:57:21'),
(3006, 'Modifier', 'Modeles', 0, 41, '2023-01-05 19:57:55', '2023-01-05 19:57:55'),
(3007, 'Detail', 'Modeles', 0, 41, '2023-01-05 19:57:58', '2023-01-05 19:57:58'),
(3008, 'Modifier', 'Modeles', 0, 41, '2023-01-05 19:58:10', '2023-01-05 19:58:10'),
(3009, 'Detail', 'Modeles', 0, 41, '2023-01-05 19:58:16', '2023-01-05 19:58:16'),
(3010, 'Modifier', 'Modeles', 0, 41, '2023-01-05 19:58:27', '2023-01-05 19:58:27'),
(3011, 'Detail', 'Modeles', 0, 41, '2023-01-05 19:58:43', '2023-01-05 19:58:43'),
(3012, 'Modifier', 'Modeles', 0, 41, '2023-01-05 19:58:57', '2023-01-05 19:58:57'),
(3013, 'Detail', 'Modeles', 0, 41, '2023-01-05 19:59:03', '2023-01-05 19:59:03'),
(3014, 'Modifier', 'Modeles', 0, 41, '2023-01-05 19:59:16', '2023-01-05 19:59:16'),
(3015, 'Detail', 'Modeles', 0, 41, '2023-01-05 19:59:22', '2023-01-05 19:59:22'),
(3016, 'Modifier', 'Modeles', 0, 41, '2023-01-05 19:59:45', '2023-01-05 19:59:45'),
(3017, 'Detail', 'Modeles', 0, 41, '2023-01-05 19:59:51', '2023-01-05 19:59:51'),
(3018, 'Modifier', 'Modeles', 0, 41, '2023-01-05 20:00:16', '2023-01-05 20:00:16'),
(3019, 'Detail', 'Modeles', 0, 41, '2023-01-05 20:00:24', '2023-01-05 20:00:24'),
(3020, 'Modifier', 'Modeles', 0, 41, '2023-01-05 20:00:40', '2023-01-05 20:00:40'),
(3021, 'Detail', 'Modeles', 0, 41, '2023-01-05 20:00:44', '2023-01-05 20:00:44'),
(3022, 'Modifier', 'Modeles', 0, 41, '2023-01-05 20:01:08', '2023-01-05 20:01:08'),
(3023, 'Detail', 'Modeles', 0, 41, '2023-01-05 20:01:19', '2023-01-05 20:01:19'),
(3024, 'Modifier', 'Modeles', 0, 41, '2023-01-05 20:01:39', '2023-01-05 20:01:39'),
(3025, 'Detail', 'Modeles', 0, 41, '2023-01-05 20:01:43', '2023-01-05 20:01:43'),
(3026, 'Modifier', 'Modeles', 0, 41, '2023-01-05 20:02:12', '2023-01-05 20:02:12'),
(3027, 'Detail', 'Modeles', 0, 41, '2023-01-05 20:02:17', '2023-01-05 20:02:17'),
(3028, 'Modifier', 'Modeles', 0, 41, '2023-01-05 20:02:41', '2023-01-05 20:02:41'),
(3029, 'Detail', 'Modeles', 0, 41, '2023-01-05 20:02:45', '2023-01-05 20:02:45'),
(3030, 'Modifier', 'Modeles', 0, 41, '2023-01-05 20:03:08', '2023-01-05 20:03:08'),
(3031, 'Connecté', 'Compte', 0, 41, '2023-01-05 20:03:43', '2023-01-05 20:03:43'),
(3032, 'Connecté', 'Compte', 0, 35, '2023-01-05 20:05:00', '2023-01-05 20:05:00'),
(3033, 'Liste', 'Modeles', 0, 35, '2023-01-05 20:05:06', '2023-01-05 20:05:06'),
(3034, 'Detail', 'Modeles', 0, 35, '2023-01-05 20:05:13', '2023-01-05 20:05:13'),
(3035, 'Connecté', 'Compte', 0, 35, '2023-01-05 20:05:38', '2023-01-05 20:05:38'),
(3036, 'Connecté', 'Compte', 0, 36, '2023-01-05 20:05:51', '2023-01-05 20:05:51'),
(3037, 'Liste', 'Modeles', 0, 36, '2023-01-05 20:05:56', '2023-01-05 20:05:56'),
(3038, 'Detail', 'Modeles', 0, 36, '2023-01-05 20:05:59', '2023-01-05 20:05:59'),
(3039, 'Detail', 'Modeles', 0, 36, '2023-01-05 20:06:11', '2023-01-05 20:06:11'),
(3040, 'Modifier', 'Modeles', 0, 36, '2023-01-05 20:06:31', '2023-01-05 20:06:31'),
(3041, 'Detail', 'Modeles', 0, 36, '2023-01-05 20:06:36', '2023-01-05 20:06:36'),
(3042, 'Modifier', 'Modeles', 0, 36, '2023-01-05 20:06:41', '2023-01-05 20:06:41'),
(3043, 'Detail', 'Modeles', 0, 36, '2023-01-05 20:06:46', '2023-01-05 20:06:46'),
(3044, 'Modifier', 'Modeles', 0, 36, '2023-01-05 20:06:52', '2023-01-05 20:06:52'),
(3045, 'Detail', 'Modeles', 0, 36, '2023-01-05 20:07:06', '2023-01-05 20:07:06'),
(3046, 'Modifier', 'Modeles', 0, 36, '2023-01-05 20:07:13', '2023-01-05 20:07:13'),
(3047, 'Detail', 'Modeles', 0, 36, '2023-01-05 20:07:17', '2023-01-05 20:07:17'),
(3048, 'Modifier', 'Modeles', 0, 36, '2023-01-05 20:07:25', '2023-01-05 20:07:25'),
(3049, 'Connecté', 'Compte', 0, 36, '2023-01-05 20:07:55', '2023-01-05 20:07:55'),
(3050, 'Connecté', 'Compte', 0, 43, '2023-01-05 20:08:28', '2023-01-05 20:08:28'),
(3051, 'Liste', 'Modeles', 0, 43, '2023-01-05 20:08:42', '2023-01-05 20:08:42'),
(3052, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:20:56', '2023-01-05 20:20:56'),
(3053, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:21:00', '2023-01-05 20:21:00'),
(3054, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:21:07', '2023-01-05 20:21:07'),
(3055, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:21:09', '2023-01-05 20:21:09'),
(3056, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:21:15', '2023-01-05 20:21:15'),
(3057, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:21:18', '2023-01-05 20:21:18'),
(3058, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:21:19', '2023-01-05 20:21:19'),
(3059, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:21:20', '2023-01-05 20:21:20'),
(3060, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:21:21', '2023-01-05 20:21:21'),
(3061, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:21:21', '2023-01-05 20:21:21'),
(3062, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:21:22', '2023-01-05 20:21:22'),
(3063, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:21:24', '2023-01-05 20:21:24'),
(3064, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:21:29', '2023-01-05 20:21:29'),
(3065, 'Modifier', 'Modeles', 0, 43, '2023-01-05 20:21:51', '2023-01-05 20:21:51'),
(3066, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:22:04', '2023-01-05 20:22:04'),
(3067, 'Modifier', 'Modeles', 0, 43, '2023-01-05 20:22:34', '2023-01-05 20:22:34'),
(3068, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:22:50', '2023-01-05 20:22:50'),
(3069, 'Modifier', 'Modeles', 0, 43, '2023-01-05 20:23:05', '2023-01-05 20:23:05'),
(3070, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:23:12', '2023-01-05 20:23:12'),
(3071, 'Modifier', 'Modeles', 0, 43, '2023-01-05 20:23:37', '2023-01-05 20:23:37'),
(3072, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:23:44', '2023-01-05 20:23:44'),
(3073, 'Modifier', 'Modeles', 0, 43, '2023-01-05 20:23:59', '2023-01-05 20:23:59'),
(3074, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:24:05', '2023-01-05 20:24:05'),
(3075, 'Modifier', 'Modeles', 0, 43, '2023-01-05 20:24:24', '2023-01-05 20:24:24'),
(3076, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:24:32', '2023-01-05 20:24:32'),
(3077, 'Supprimer', 'Modeles', 0, 43, '2023-01-05 20:24:49', '2023-01-05 20:24:49'),
(3078, 'Supprimer', 'Modeles', 0, 43, '2023-01-05 20:24:56', '2023-01-05 20:24:56'),
(3079, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:25:20', '2023-01-05 20:25:20'),
(3080, 'Modifier', 'Modeles', 0, 43, '2023-01-05 20:25:34', '2023-01-05 20:25:34'),
(3081, 'Supprimer', 'Modeles', 0, 43, '2023-01-05 20:25:42', '2023-01-05 20:25:42'),
(3082, 'Liste', 'Modeles', 0, 43, '2023-01-05 20:26:00', '2023-01-05 20:26:00'),
(3083, 'Supprimer', 'Modeles', 0, 43, '2023-01-05 20:26:29', '2023-01-05 20:26:29'),
(3084, 'Supprimer', 'Modeles', 0, 43, '2023-01-05 20:26:36', '2023-01-05 20:26:36'),
(3085, 'Supprimer', 'Modeles', 0, 43, '2023-01-05 20:26:57', '2023-01-05 20:26:57'),
(3086, 'Supprimer', 'Modeles', 0, 43, '2023-01-05 20:27:04', '2023-01-05 20:27:04'),
(3087, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:27:26', '2023-01-05 20:27:26'),
(3088, 'Detail', 'Modeles', 0, 43, '2023-01-05 20:27:59', '2023-01-05 20:27:59'),
(3089, 'Connecté', 'Compte', 0, 43, '2023-01-05 20:28:03', '2023-01-05 20:28:03'),
(3090, 'Connecté', 'Compte', 0, 32, '2023-01-05 20:28:45', '2023-01-05 20:28:45'),
(3091, 'Connecté', 'Compte', 0, 6, '2023-01-06 01:48:45', '2023-01-06 01:48:45'),
(3092, 'liste', 'Boutique', 0, 6, '2023-01-06 01:49:05', '2023-01-06 01:49:05'),
(3093, 'Liste', 'Utilisateurs', 0, 6, '2023-01-06 01:49:16', '2023-01-06 01:49:16'),
(3094, 'Affichage', 'Compte', 0, 6, '2023-01-06 01:49:36', '2023-01-06 01:49:36'),
(3095, 'Connecté', 'Compte', 0, 4, '2023-01-06 01:50:19', '2023-01-06 01:50:19'),
(3096, 'Liste', 'Modeles', 0, 4, '2023-01-06 01:51:42', '2023-01-06 01:51:42'),
(3097, 'Connecté', 'Compte', 0, 4, '2023-01-06 01:51:59', '2023-01-06 01:51:59'),
(3098, 'Connecté', 'Compte', 0, 32, '2023-01-06 01:56:34', '2023-01-06 01:56:34'),
(3099, 'Liste', 'Modeles', 0, 32, '2023-01-06 01:56:49', '2023-01-06 01:56:49'),
(3100, 'liste', 'Clients', 0, 32, '2023-01-06 01:57:01', '2023-01-06 01:57:01'),
(3101, 'liste', 'Clients', 0, 32, '2023-01-06 01:57:01', '2023-01-06 01:57:01'),
(3102, 'liste', 'Clients', 0, 32, '2023-01-06 01:57:02', '2023-01-06 01:57:02'),
(3103, 'Liste', 'Modeles', 0, 32, '2023-01-06 01:57:10', '2023-01-06 01:57:10'),
(3104, 'Connecté', 'Compte', 0, 35, '2023-01-06 01:57:42', '2023-01-06 01:57:42'),
(3105, 'liste', 'Categories', 0, 35, '2023-01-06 01:58:03', '2023-01-06 01:58:03'),
(3106, 'Liste', 'Modeles', 0, 35, '2023-01-06 01:58:12', '2023-01-06 01:58:12'),
(3107, 'Connecté', 'Compte', 0, 36, '2023-01-06 01:59:40', '2023-01-06 01:59:40'),
(3108, 'Liste', 'Modeles', 0, 36, '2023-01-06 01:59:48', '2023-01-06 01:59:48'),
(3109, 'Connecté', 'Compte', 0, 42, '2023-01-06 02:00:14', '2023-01-06 02:00:14'),
(3110, 'Liste', 'Modeles', 0, 42, '2023-01-06 02:00:20', '2023-01-06 02:00:20'),
(3111, 'Rapport', 'Modeles', 0, 42, '2023-01-06 02:00:32', '2023-01-06 02:00:32'),
(3112, 'Connecté', 'Compte', 0, 42, '2023-01-06 02:01:06', '2023-01-06 02:01:06'),
(3113, 'Connecté', 'Compte', 0, 47, '2023-01-06 02:01:42', '2023-01-06 02:01:42'),
(3114, 'Connecté', 'Compte', 0, 33, '2023-01-06 02:02:55', '2023-01-06 02:02:55'),
(3115, 'Liste', 'Modeles', 0, 33, '2023-01-06 02:03:08', '2023-01-06 02:03:08'),
(3116, 'Liste', 'Utilisateurs', 0, 33, '2023-01-06 02:03:22', '2023-01-06 02:03:22'),
(3117, 'Connecté', 'Compte', 0, 33, '2023-01-06 02:03:38', '2023-01-06 02:03:38'),
(3118, 'Connecté', 'Compte', 0, 33, '2023-01-06 13:46:46', '2023-01-06 13:46:46'),
(3119, 'Liste', 'Modeles', 0, 33, '2023-01-06 13:49:36', '2023-01-06 13:49:36'),
(3120, 'Detail', 'Modeles', 0, 33, '2023-01-06 13:50:00', '2023-01-06 13:50:00'),
(3121, 'Detail', 'Modeles', 0, 33, '2023-01-06 13:50:01', '2023-01-06 13:50:01'),
(3122, 'Detail', 'Modeles', 0, 33, '2023-01-06 13:50:43', '2023-01-06 13:50:43'),
(3123, 'Modifier', 'Modeles', 0, 33, '2023-01-06 13:50:58', '2023-01-06 13:50:58'),
(3124, 'Modifier', 'Modeles', 0, 33, '2023-01-06 13:50:58', '2023-01-06 13:50:58'),
(3125, 'Detail', 'Modeles', 0, 33, '2023-01-06 13:51:04', '2023-01-06 13:51:04'),
(3126, 'Modifier', 'Modeles', 0, 33, '2023-01-06 13:51:11', '2023-01-06 13:51:11'),
(3127, 'Liste', 'Modeles', 0, 33, '2023-01-06 13:53:20', '2023-01-06 13:53:20'),
(3128, 'Detail', 'Modeles', 0, 33, '2023-01-06 13:53:25', '2023-01-06 13:53:25'),
(3129, 'Detail', 'Modeles', 0, 33, '2023-01-06 13:53:31', '2023-01-06 13:53:31'),
(3130, 'Modifier', 'Modeles', 0, 33, '2023-01-06 13:53:44', '2023-01-06 13:53:44'),
(3131, 'Detail', 'Modeles', 0, 33, '2023-01-06 13:53:48', '2023-01-06 13:53:48'),
(3132, 'Modifier', 'Modeles', 0, 33, '2023-01-06 13:53:58', '2023-01-06 13:53:58'),
(3133, 'Liste', 'Ventes', 0, 33, '2023-01-06 13:54:36', '2023-01-06 13:54:36'),
(3134, 'Creer', 'Journal', 0, 33, '2023-01-06 13:54:46', '2023-01-06 13:54:46'),
(3135, 'Creer', 'Ventes', 0, 33, '2023-01-06 13:59:15', '2023-01-06 13:59:15'),
(3136, 'Liste', 'Ventes', 0, 33, '2023-01-06 14:00:07', '2023-01-06 14:00:07'),
(3137, 'Liste', 'Modeles', 0, 33, '2023-01-06 14:03:34', '2023-01-06 14:03:34'),
(3138, 'Connecté', 'Compte', 0, 37, '2023-01-06 14:04:24', '2023-01-06 14:04:24'),
(3139, 'Liste', 'Ventes', 0, 37, '2023-01-06 14:07:44', '2023-01-06 14:07:44'),
(3140, 'Creer', 'Ventes', 0, 37, '2023-01-06 14:10:36', '2023-01-06 14:10:36'),
(3141, 'Liste', 'Ventes', 0, 37, '2023-01-06 14:11:19', '2023-01-06 14:11:19'),
(3142, 'Liste', 'Modeles', 0, 37, '2023-01-06 14:12:07', '2023-01-06 14:12:07'),
(3143, 'Detail', 'Modeles', 0, 37, '2023-01-06 14:12:11', '2023-01-06 14:12:11'),
(3144, 'Detail', 'Modeles', 0, 37, '2023-01-06 14:13:27', '2023-01-06 14:13:27'),
(3145, 'Modifier', 'Modeles', 0, 37, '2023-01-06 14:13:38', '2023-01-06 14:13:38'),
(3146, 'Detail', 'Modeles', 0, 37, '2023-01-06 14:13:51', '2023-01-06 14:13:51'),
(3147, 'Modifier', 'Modeles', 0, 37, '2023-01-06 14:14:04', '2023-01-06 14:14:04'),
(3148, 'Connecté', 'Compte', 0, 4, '2023-01-07 00:12:13', '2023-01-07 00:12:13'),
(3149, 'Connecté', 'Compte', 0, 32, '2023-01-07 00:36:43', '2023-01-07 00:36:43'),
(3150, 'Liste', 'Ventes', 0, 32, '2023-01-07 00:36:51', '2023-01-07 00:36:51'),
(3151, 'Liste', 'Modeles', 0, 32, '2023-01-07 00:37:12', '2023-01-07 00:37:12'),
(3152, 'liste', 'Clients', 0, 32, '2023-01-07 00:51:31', '2023-01-07 00:51:31'),
(3153, 'liste', 'Clients', 0, 32, '2023-01-07 00:51:31', '2023-01-07 00:51:31'),
(3154, 'Connecté', 'Compte', 0, 32, '2023-01-07 00:51:35', '2023-01-07 00:51:35'),
(3155, 'Liste', 'Modeles', 0, 32, '2023-01-07 00:53:46', '2023-01-07 00:53:46'),
(3156, 'Connecté', 'Compte', 0, 4, '2023-01-07 00:54:10', '2023-01-07 00:54:10'),
(3157, 'Liste', 'Modeles', 0, 4, '2023-01-07 00:54:27', '2023-01-07 00:54:27'),
(3158, 'liste', 'Categories', 0, 4, '2023-01-07 00:55:57', '2023-01-07 00:55:57'),
(3159, 'Liste', 'Produits', 0, 4, '2023-01-07 01:01:02', '2023-01-07 01:01:02'),
(3160, 'Liste', 'Produits', 0, 4, '2023-01-07 01:01:59', '2023-01-07 01:01:59'),
(3161, 'Detail', 'Produits', 0, 4, '2023-01-07 01:02:05', '2023-01-07 01:02:05'),
(3162, 'Modifier', 'Produits', 0, 4, '2023-01-07 01:02:13', '2023-01-07 01:02:13'),
(3163, 'Liste', 'Produits', 0, 4, '2023-01-07 01:04:41', '2023-01-07 01:04:41'),
(3164, 'Liste', 'Modeles', 0, 4, '2023-01-07 01:13:25', '2023-01-07 01:13:25'),
(3165, 'liste', 'Categories', 0, 4, '2023-01-07 01:13:33', '2023-01-07 01:13:33'),
(3166, 'Liste', 'Produits', 0, 4, '2023-01-07 01:15:11', '2023-01-07 01:15:11'),
(3167, 'Liste', 'Modeles', 0, 4, '2023-01-07 01:15:25', '2023-01-07 01:15:25'),
(3168, 'liste', 'Categories', 0, 4, '2023-01-07 01:15:34', '2023-01-07 01:15:34'),
(3169, 'Detail', 'Produits', 0, 4, '2023-01-07 01:15:47', '2023-01-07 01:15:47'),
(3170, 'Detail', 'Produits', 0, 4, '2023-01-07 01:16:13', '2023-01-07 01:16:13'),
(3171, 'Detail', 'Produits', 0, 4, '2023-01-07 01:16:16', '2023-01-07 01:16:16'),
(3172, 'Detail', 'Produits', 0, 4, '2023-01-07 01:16:28', '2023-01-07 01:16:28'),
(3173, 'Supprimer', 'Produits', 0, 4, '2023-01-07 01:16:45', '2023-01-07 01:16:45'),
(3174, 'Liste', 'Produits', 0, 4, '2023-01-07 01:17:26', '2023-01-07 01:17:26'),
(3175, 'Detail', 'Produits', 0, 4, '2023-01-07 01:17:34', '2023-01-07 01:17:34'),
(3176, 'Detail', 'Produits', 0, 4, '2023-01-07 01:17:42', '2023-01-07 01:17:42'),
(3177, 'Liste', 'Modeles', 0, 4, '2023-01-07 01:17:56', '2023-01-07 01:17:56'),
(3178, 'Connecté', 'Compte', 0, 4, '2023-01-07 01:18:17', '2023-01-07 01:18:17'),
(3179, 'Liste', 'Modeles', 0, 4, '2023-01-07 01:18:23', '2023-01-07 01:18:23'),
(3180, 'Creer', 'Modeles', 0, 4, '2023-01-07 01:32:39', '2023-01-07 01:32:39'),
(3181, 'Creer', 'Modeles', 0, 4, '2023-01-07 01:34:13', '2023-01-07 01:34:13'),
(3182, 'Creer', 'Modeles', 0, 4, '2023-01-07 01:43:35', '2023-01-07 01:43:35'),
(3183, 'Connecté', 'Compte', 0, 32, '2023-01-07 01:44:04', '2023-01-07 01:44:04'),
(3184, 'Connecté', 'Compte', 0, 32, '2023-01-07 01:44:10', '2023-01-07 01:44:10'),
(3185, 'liste', 'Categories', 0, 32, '2023-01-07 01:44:23', '2023-01-07 01:44:23'),
(3186, 'Connecté', 'Compte', 0, 32, '2023-01-07 01:45:02', '2023-01-07 01:45:02'),
(3187, 'Connecté', 'Compte', 0, 43, '2023-01-07 01:45:16', '2023-01-07 01:45:16'),
(3188, 'Connecté', 'Compte', 0, 43, '2023-01-07 01:45:24', '2023-01-07 01:45:24'),
(3189, 'Liste', 'Modeles', 0, 43, '2023-01-07 01:45:28', '2023-01-07 01:45:28'),
(3190, 'Liste', 'Modeles', 0, 43, '2023-01-07 01:45:55', '2023-01-07 01:45:55'),
(3191, 'Creer', 'Modeles', 0, 43, '2023-01-07 01:51:18', '2023-01-07 01:51:18'),
(3192, 'Creer', 'Modeles', 0, 43, '2023-01-07 01:53:28', '2023-01-07 01:53:28'),
(3193, 'Creer', 'Modeles', 0, 43, '2023-01-07 01:53:29', '2023-01-07 01:53:29'),
(3194, 'Supprimer', 'Modeles', 0, 43, '2023-01-07 01:54:26', '2023-01-07 01:54:26'),
(3195, 'Connecté', 'Compte', 0, 43, '2023-01-07 01:54:43', '2023-01-07 01:54:43'),
(3196, 'Liste', 'Modeles', 0, 43, '2023-01-07 01:54:57', '2023-01-07 01:54:57'),
(3197, 'Creer', 'Modeles', 0, 43, '2023-01-07 01:57:01', '2023-01-07 01:57:01'),
(3198, 'Creer', 'Modeles', 0, 43, '2023-01-07 02:00:47', '2023-01-07 02:00:47'),
(3199, 'Creer', 'Modeles', 0, 43, '2023-01-07 02:02:56', '2023-01-07 02:02:56'),
(3200, 'Creer', 'Modeles', 0, 43, '2023-01-07 02:04:11', '2023-01-07 02:04:11'),
(3201, 'Creer', 'Modeles', 0, 43, '2023-01-07 02:05:18', '2023-01-07 02:05:18'),
(3202, 'Creer', 'Modeles', 0, 43, '2023-01-07 02:06:30', '2023-01-07 02:06:30'),
(3203, 'Creer', 'Modeles', 0, 43, '2023-01-07 02:08:12', '2023-01-07 02:08:12'),
(3204, 'Creer', 'Modeles', 0, 43, '2023-01-07 02:08:13', '2023-01-07 02:08:13'),
(3205, 'Supprimer', 'Modeles', 0, 43, '2023-01-07 02:08:39', '2023-01-07 02:08:39'),
(3206, 'Detail', 'Modeles', 0, 43, '2023-01-07 02:09:34', '2023-01-07 02:09:34'),
(3207, 'Modifier', 'Modeles', 0, 43, '2023-01-07 02:09:49', '2023-01-07 02:09:49'),
(3208, 'Creer', 'Modeles', 0, 43, '2023-01-07 02:13:53', '2023-01-07 02:13:53'),
(3209, 'Creer', 'Modeles', 0, 43, '2023-01-07 02:13:54', '2023-01-07 02:13:54'),
(3210, 'Supprimer', 'Modeles', 0, 43, '2023-01-07 02:14:27', '2023-01-07 02:14:27'),
(3211, 'Creer', 'Modeles', 0, 43, '2023-01-07 02:15:37', '2023-01-07 02:15:37'),
(3212, 'Creer', 'Modeles', 0, 43, '2023-01-07 02:16:41', '2023-01-07 02:16:41'),
(3213, 'Creer', 'Modeles', 0, 43, '2023-01-07 02:17:52', '2023-01-07 02:17:52'),
(3214, 'Creer', 'Modeles', 0, 43, '2023-01-07 02:18:44', '2023-01-07 02:18:44'),
(3215, 'liste', 'Categories', 0, 43, '2023-01-07 02:19:42', '2023-01-07 02:19:42'),
(3216, 'Detail', 'Produits', 0, 43, '2023-01-07 02:20:03', '2023-01-07 02:20:03'),
(3217, 'Liste', 'Modeles', 0, 43, '2023-01-07 02:20:40', '2023-01-07 02:20:40'),
(3218, 'Creer', 'Modeles', 0, 43, '2023-01-07 02:22:16', '2023-01-07 02:22:16'),
(3219, 'Detail', 'Modeles', 0, 43, '2023-01-07 02:23:04', '2023-01-07 02:23:04'),
(3220, 'Detail', 'Modeles', 0, 43, '2023-01-07 02:23:09', '2023-01-07 02:23:09'),
(3221, 'Detail', 'Modeles', 0, 43, '2023-01-07 02:23:11', '2023-01-07 02:23:11'),
(3222, 'Detail', 'Modeles', 0, 43, '2023-01-07 02:23:12', '2023-01-07 02:23:12'),
(3223, 'Detail', 'Modeles', 0, 43, '2023-01-07 02:23:14', '2023-01-07 02:23:14'),
(3224, 'Detail', 'Modeles', 0, 43, '2023-01-07 02:23:14', '2023-01-07 02:23:14'),
(3225, 'Detail', 'Modeles', 0, 43, '2023-01-07 02:23:15', '2023-01-07 02:23:15'),
(3226, 'Detail', 'Modeles', 0, 43, '2023-01-07 02:23:18', '2023-01-07 02:23:18'),
(3227, 'Detail', 'Modeles', 0, 43, '2023-01-07 02:23:19', '2023-01-07 02:23:19'),
(3228, 'Modifier', 'Modeles', 0, 43, '2023-01-07 02:23:52', '2023-01-07 02:23:52'),
(3229, 'Detail', 'Modeles', 0, 43, '2023-01-07 02:24:07', '2023-01-07 02:24:07'),
(3230, 'Detail', 'Modeles', 0, 43, '2023-01-07 02:24:09', '2023-01-07 02:24:09'),
(3231, 'Detail', 'Modeles', 0, 43, '2023-01-07 02:24:10', '2023-01-07 02:24:10'),
(3232, 'Supprimer', 'Modeles', 0, 43, '2023-01-07 02:24:45', '2023-01-07 02:24:45'),
(3233, 'Connecté', 'Compte', 0, 43, '2023-01-07 02:25:02', '2023-01-07 02:25:02'),
(3234, 'Connecté', 'Compte', 0, 4, '2023-01-07 02:25:45', '2023-01-07 02:25:45'),
(3235, 'Liste', 'Commandes', 0, 4, '2023-01-07 02:25:51', '2023-01-07 02:25:51'),
(3236, 'Creer', 'Journal', 0, 4, '2023-01-07 02:25:57', '2023-01-07 02:25:57'),
(3237, 'Creer', 'Commandes directe', 0, 4, '2023-01-07 02:27:17', '2023-01-07 02:27:17'),
(3238, 'Liste', 'Commandes', 0, 4, '2023-01-07 02:27:21', '2023-01-07 02:27:21'),
(3239, 'Connecté', 'Compte', 0, 4, '2023-01-07 02:27:31', '2023-01-07 02:27:31'),
(3240, 'Liste', 'Commandes', 0, 4, '2023-01-07 02:27:37', '2023-01-07 02:27:37'),
(3241, 'Creer', 'Journal', 0, 4, '2023-01-07 02:27:44', '2023-01-07 02:27:44'),
(3242, 'Creer', 'Commandes indirecte', 0, 4, '2023-01-07 02:28:42', '2023-01-07 02:28:42'),
(3243, 'Liste', 'Commandes', 0, 4, '2023-01-07 02:28:43', '2023-01-07 02:28:43'),
(3244, 'Liste', 'Livraisons', 0, 4, '2023-01-07 02:28:55', '2023-01-07 02:28:55'),
(3245, 'Creer', 'Livraisons', 0, 4, '2023-01-07 02:29:00', '2023-01-07 02:29:00'),
(3246, 'Creer', 'Livraisons', 0, 4, '2023-01-07 02:29:21', '2023-01-07 02:29:21'),
(3247, 'Liste', 'Livraisons', 0, 4, '2023-01-07 02:29:22', '2023-01-07 02:29:22'),
(3248, 'Connecté', 'Compte', 0, 4, '2023-01-07 02:29:29', '2023-01-07 02:29:29'),
(3249, 'Liste', 'Modeles', 0, 4, '2023-01-07 02:29:39', '2023-01-07 02:29:39'),
(3250, 'liste', 'Categories', 0, 4, '2023-01-07 02:31:25', '2023-01-07 02:31:25'),
(3251, 'Detail', 'Produits', 0, 4, '2023-01-07 02:31:39', '2023-01-07 02:31:39'),
(3252, 'Modifier', 'Produits', 0, 4, '2023-01-07 02:32:02', '2023-01-07 02:32:02'),
(3253, 'Liste', 'Modeles', 0, 4, '2023-01-07 02:32:31', '2023-01-07 02:32:31'),
(3254, 'liste', 'Clients', 0, 4, '2023-01-07 02:51:22', '2023-01-07 02:51:22'),
(3255, 'liste', 'Clients', 0, 4, '2023-01-07 02:51:22', '2023-01-07 02:51:22'),
(3256, 'Connecté', 'Compte', 0, 4, '2023-01-07 02:51:40', '2023-01-07 02:51:40'),
(3257, 'Connecté', 'Compte', 0, 35, '2023-01-07 12:54:52', '2023-01-07 12:54:52'),
(3258, 'Liste', 'Modeles', 0, 35, '2023-01-07 12:55:16', '2023-01-07 12:55:16'),
(3259, 'Detail', 'Modeles', 0, 35, '2023-01-07 12:55:20', '2023-01-07 12:55:20'),
(3260, 'Detail', 'Modeles', 0, 35, '2023-01-07 12:56:17', '2023-01-07 12:56:17'),
(3261, 'Modifier', 'Modeles', 0, 35, '2023-01-07 12:57:36', '2023-01-07 12:57:36'),
(3262, 'Detail', 'Modeles', 0, 35, '2023-01-07 12:57:46', '2023-01-07 12:57:46'),
(3263, 'Modifier', 'Modeles', 0, 35, '2023-01-07 12:57:54', '2023-01-07 12:57:54'),
(3264, 'Connecté', 'Compte', 0, 35, '2023-01-07 12:58:13', '2023-01-07 12:58:13'),
(3265, 'Connecté', 'Compte', 0, 36, '2023-01-07 12:58:33', '2023-01-07 12:58:33'),
(3266, 'Liste', 'Modeles', 0, 36, '2023-01-07 12:58:37', '2023-01-07 12:58:37'),
(3267, 'Detail', 'Modeles', 0, 36, '2023-01-07 12:59:12', '2023-01-07 12:59:12'),
(3268, 'Modifier', 'Modeles', 0, 36, '2023-01-07 12:59:27', '2023-01-07 12:59:27'),
(3269, 'Detail', 'Modeles', 0, 36, '2023-01-07 13:00:30', '2023-01-07 13:00:30'),
(3270, 'Detail', 'Modeles', 0, 36, '2023-01-07 13:00:36', '2023-01-07 13:00:36'),
(3271, 'Detail', 'Modeles', 0, 36, '2023-01-07 13:00:41', '2023-01-07 13:00:41'),
(3272, 'Detail', 'Modeles', 0, 36, '2023-01-07 13:00:45', '2023-01-07 13:00:45'),
(3273, 'Detail', 'Modeles', 0, 36, '2023-01-07 13:00:53', '2023-01-07 13:00:53'),
(3274, 'Detail', 'Modeles', 0, 36, '2023-01-07 13:00:53', '2023-01-07 13:00:53'),
(3275, 'Detail', 'Modeles', 0, 36, '2023-01-07 13:00:53', '2023-01-07 13:00:53'),
(3276, 'Supprimer', 'Modeles', 0, 36, '2023-01-07 13:00:57', '2023-01-07 13:00:57'),
(3277, 'Creer', 'Modeles', 0, 36, '2023-01-07 13:04:38', '2023-01-07 13:04:38'),
(3278, 'Connecté', 'Compte', 0, 41, '2023-01-07 13:05:02', '2023-01-07 13:05:02'),
(3279, 'Liste', 'Modeles', 0, 41, '2023-01-07 13:05:08', '2023-01-07 13:05:08'),
(3280, 'Detail', 'Modeles', 0, 41, '2023-01-07 13:05:11', '2023-01-07 13:05:11'),
(3281, 'Detail', 'Modeles', 0, 41, '2023-01-07 13:05:25', '2023-01-07 13:05:25'),
(3282, 'Modifier', 'Modeles', 0, 41, '2023-01-07 13:05:54', '2023-01-07 13:05:54'),
(3283, 'Connecté', 'Compte', 0, 33, '2023-01-07 13:06:59', '2023-01-07 13:06:59'),
(3284, 'Liste', 'Modeles', 0, 33, '2023-01-07 13:07:30', '2023-01-07 13:07:30'),
(3285, 'Detail', 'Modeles', 0, 33, '2023-01-07 13:07:35', '2023-01-07 13:07:35'),
(3286, 'Connecté', 'Compte', 0, 42, '2023-01-07 13:08:51', '2023-01-07 13:08:51'),
(3287, 'Liste', 'Modeles', 0, 42, '2023-01-07 13:09:01', '2023-01-07 13:09:01'),
(3288, 'Detail', 'Modeles', 0, 42, '2023-01-07 13:09:15', '2023-01-07 13:09:15'),
(3289, 'Modifier', 'Modeles', 0, 42, '2023-01-07 13:09:40', '2023-01-07 13:09:40'),
(3290, 'Liste', 'Modeles', 0, 42, '2023-01-07 13:09:50', '2023-01-07 13:09:50'),
(3291, 'Connecté', 'Compte', 0, 43, '2023-01-07 13:10:52', '2023-01-07 13:10:52'),
(3292, 'Liste', 'Modeles', 0, 43, '2023-01-07 13:11:47', '2023-01-07 13:11:47'),
(3293, 'Detail', 'Modeles', 0, 43, '2023-01-07 13:11:51', '2023-01-07 13:11:51'),
(3294, 'Connecté', 'Compte', 0, 42, '2023-01-07 13:30:45', '2023-01-07 13:30:45'),
(3295, 'Liste', 'Modeles', 0, 42, '2023-01-07 13:31:58', '2023-01-07 13:31:58'),
(3296, 'Liste', 'Ventes', 0, 42, '2023-01-07 13:33:28', '2023-01-07 13:33:28'),
(3297, 'Creer', 'Journal', 0, 42, '2023-01-07 13:33:38', '2023-01-07 13:33:38'),
(3298, 'Creer', 'Ventes', 0, 42, '2023-01-07 13:36:48', '2023-01-07 13:36:48'),
(3299, 'Liste', 'Ventes', 0, 42, '2023-01-07 13:37:27', '2023-01-07 13:37:27'),
(3300, 'Connecté', 'Compte', 0, 42, '2023-01-07 13:38:39', '2023-01-07 13:38:39'),
(3301, 'Liste', 'Modeles', 0, 42, '2023-01-07 13:38:42', '2023-01-07 13:38:42'),
(3302, 'Connecté', 'Compte', 0, 42, '2023-01-07 13:38:53', '2023-01-07 13:38:53'),
(3303, 'Connecté', 'Compte', 0, 32, '2023-01-07 13:39:14', '2023-01-07 13:39:14'),
(3304, 'Liste', 'Modeles', 0, 32, '2023-01-07 13:39:20', '2023-01-07 13:39:20'),
(3305, 'Liste', 'Ventes', 0, 32, '2023-01-07 13:40:19', '2023-01-07 13:40:19'),
(3306, 'Liste', 'Ventes', 0, 32, '2023-01-07 13:40:43', '2023-01-07 13:40:43'),
(3307, 'Creer', 'Ventes', 0, 32, '2023-01-07 13:41:20', '2023-01-07 13:41:20'),
(3308, 'Liste', 'Ventes', 0, 32, '2023-01-07 13:42:24', '2023-01-07 13:42:24'),
(3309, 'Connecté', 'Compte', 0, 32, '2023-01-07 13:42:31', '2023-01-07 13:42:31'),
(3310, 'Liste', 'Modeles', 0, 32, '2023-01-07 13:42:36', '2023-01-07 13:42:36'),
(3311, 'Connecté', 'Compte', 0, 32, '2023-01-07 13:42:42', '2023-01-07 13:42:42'),
(3312, 'Connecté', 'Compte', 0, 33, '2023-01-07 13:43:07', '2023-01-07 13:43:07'),
(3313, 'Liste', 'Modeles', 0, 33, '2023-01-07 13:44:08', '2023-01-07 13:44:08'),
(3314, 'Detail', 'Modeles', 0, 33, '2023-01-07 13:44:11', '2023-01-07 13:44:11'),
(3315, 'Liste', 'Ventes', 0, 33, '2023-01-07 13:45:43', '2023-01-07 13:45:43'),
(3316, 'Creer', 'Ventes', 0, 33, '2023-01-07 13:49:11', '2023-01-07 13:49:11'),
(3317, 'Liste', 'Ventes', 0, 33, '2023-01-07 13:49:37', '2023-01-07 13:49:37'),
(3318, 'Connecté', 'Compte', 0, 33, '2023-01-07 13:49:53', '2023-01-07 13:49:53'),
(3319, 'Liste', 'Modeles', 0, 33, '2023-01-07 13:49:57', '2023-01-07 13:49:57'),
(3320, 'Detail', 'Modeles', 0, 33, '2023-01-07 13:50:35', '2023-01-07 13:50:35'),
(3321, 'Connecté', 'Compte', 0, 33, '2023-01-07 13:51:21', '2023-01-07 13:51:21'),
(3322, 'Connecté', 'Compte', 0, 37, '2023-01-07 13:51:40', '2023-01-07 13:51:40'),
(3323, 'Liste', 'Modeles', 0, 37, '2023-01-07 13:51:46', '2023-01-07 13:51:46'),
(3324, 'Detail', 'Modeles', 0, 37, '2023-01-07 13:51:50', '2023-01-07 13:51:50'),
(3325, 'Connecté', 'Compte', 0, 37, '2023-01-07 13:52:37', '2023-01-07 13:52:37'),
(3326, 'Liste', 'Ventes', 0, 37, '2023-01-07 13:52:43', '2023-01-07 13:52:43'),
(3327, 'Connecté', 'Compte', 0, 37, '2023-01-07 13:59:26', '2023-01-07 13:59:26'),
(3328, 'Connecté', 'Compte', 0, 36, '2023-01-07 13:59:36', '2023-01-07 13:59:36'),
(3329, 'Liste', 'Modeles', 0, 36, '2023-01-07 13:59:42', '2023-01-07 13:59:42'),
(3330, 'Connecté', 'Compte', 0, 36, '2023-01-07 14:00:12', '2023-01-07 14:00:12'),
(3331, 'Liste', 'Ventes', 0, 36, '2023-01-07 14:00:14', '2023-01-07 14:00:14'),
(3332, 'Connecté', 'Compte', 0, 36, '2023-01-07 14:01:30', '2023-01-07 14:01:30'),
(3333, 'Liste', 'Modeles', 0, 36, '2023-01-07 14:01:34', '2023-01-07 14:01:34'),
(3334, 'Connecté', 'Compte', 0, 36, '2023-01-07 14:01:42', '2023-01-07 14:01:42'),
(3335, 'Liste', 'Ventes', 0, 36, '2023-01-07 14:01:44', '2023-01-07 14:01:44'),
(3336, 'Liste', 'Modeles', 0, 36, '2023-01-07 14:02:17', '2023-01-07 14:02:17'),
(3337, 'Detail', 'Modeles', 0, 36, '2023-01-07 14:02:22', '2023-01-07 14:02:22'),
(3338, 'Modifier', 'Modeles', 0, 36, '2023-01-07 14:02:29', '2023-01-07 14:02:29'),
(3339, 'Creer', 'Ventes', 0, 36, '2023-01-07 14:03:52', '2023-01-07 14:03:52'),
(3340, 'Connecté', 'Compte', 0, 4, '2023-01-07 14:09:10', '2023-01-07 14:09:10'),
(3341, 'liste', 'Categories', 0, 4, '2023-01-07 14:09:25', '2023-01-07 14:09:25'),
(3342, 'Detail', 'Produits', 0, 4, '2023-01-07 14:10:19', '2023-01-07 14:10:19'),
(3343, 'Detail', 'Produits', 0, 4, '2023-01-07 14:10:23', '2023-01-07 14:10:23'),
(3344, 'Detail', 'Produits', 0, 4, '2023-01-07 14:10:24', '2023-01-07 14:10:24'),
(3345, 'Modifier', 'Produits', 0, 4, '2023-01-07 14:10:30', '2023-01-07 14:10:30'),
(3346, 'Connecté', 'Compte', 0, 4, '2023-01-07 14:11:10', '2023-01-07 14:11:10'),
(3347, 'Connecté', 'Compte', 0, 37, '2023-01-07 14:11:38', '2023-01-07 14:11:38'),
(3348, 'Liste', 'Modeles', 0, 37, '2023-01-07 14:12:13', '2023-01-07 14:12:13'),
(3349, 'Supprimer', 'Modeles', 0, 37, '2023-01-07 14:14:27', '2023-01-07 14:14:27'),
(3350, 'Detail', 'Modeles', 0, 37, '2023-01-07 14:14:37', '2023-01-07 14:14:37'),
(3351, 'Modifier', 'Modeles', 0, 37, '2023-01-07 14:14:48', '2023-01-07 14:14:48'),
(3352, 'Liste', 'Ventes', 0, 36, '2023-01-07 14:16:42', '2023-01-07 14:16:42'),
(3353, 'Connecté', 'Compte', 0, 36, '2023-01-07 14:16:58', '2023-01-07 14:16:58'),
(3354, 'liste', 'Categories', 0, 37, '2023-01-07 14:17:29', '2023-01-07 14:17:29'),
(3355, 'Liste', 'Modeles', 0, 37, '2023-01-07 14:17:35', '2023-01-07 14:17:35'),
(3356, 'Liste', 'Modeles', 0, 36, '2023-01-07 14:17:41', '2023-01-07 14:17:41'),
(3357, 'Detail', 'Modeles', 0, 36, '2023-01-07 14:17:46', '2023-01-07 14:17:46'),
(3358, 'Detail', 'Modeles', 0, 36, '2023-01-07 14:17:51', '2023-01-07 14:17:51'),
(3359, 'Detail', 'Modeles', 0, 36, '2023-01-07 14:17:53', '2023-01-07 14:17:53'),
(3360, 'Supprimer', 'Modeles', 0, 36, '2023-01-07 14:18:54', '2023-01-07 14:18:54'),
(3361, 'Detail', 'Modeles', 0, 36, '2023-01-07 14:19:06', '2023-01-07 14:19:06'),
(3362, 'Creer', 'Modeles', 0, 37, '2023-01-07 14:19:11', '2023-01-07 14:19:11'),
(3363, 'Modifier', 'Modeles', 0, 36, '2023-01-07 14:19:14', '2023-01-07 14:19:14'),
(3364, 'Connecté', 'Compte', 0, 36, '2023-01-07 14:19:19', '2023-01-07 14:19:19'),
(3365, 'Liste', 'Ventes', 0, 36, '2023-01-07 14:19:30', '2023-01-07 14:19:30'),
(3366, 'Connecté', 'Compte', 0, 43, '2023-01-07 14:19:36', '2023-01-07 14:19:36'),
(3367, 'Liste', 'Modeles', 0, 43, '2023-01-07 14:19:59', '2023-01-07 14:19:59'),
(3368, 'Creer', 'Ventes', 0, 36, '2023-01-07 14:20:33', '2023-01-07 14:20:33'),
(3369, 'Liste', 'Ventes', 0, 36, '2023-01-07 14:21:09', '2023-01-07 14:21:09'),
(3370, 'Creer', 'Modeles', 0, 43, '2023-01-07 14:21:13', '2023-01-07 14:21:13'),
(3371, 'Connecté', 'Compte', 0, 36, '2023-01-07 14:21:22', '2023-01-07 14:21:22'),
(3372, 'Liste', 'Modeles', 0, 36, '2023-01-07 14:21:31', '2023-01-07 14:21:31'),
(3373, 'Connecté', 'Compte', 0, 6, '2023-01-07 14:22:51', '2023-01-07 14:22:51'),
(3374, 'Affichage', 'Compte', 0, 6, '2023-01-07 14:24:20', '2023-01-07 14:24:20'),
(3375, 'Connecté', 'Compte', 0, 33, '2023-01-07 14:26:40', '2023-01-07 14:26:40'),
(3376, 'Liste', 'Modeles', 0, 33, '2023-01-07 14:26:46', '2023-01-07 14:26:46'),
(3377, 'Detail', 'Modeles', 0, 33, '2023-01-07 14:26:50', '2023-01-07 14:26:50'),
(3378, 'Detail', 'Modeles', 0, 33, '2023-01-07 14:26:59', '2023-01-07 14:26:59'),
(3379, 'Modifier', 'Modeles', 0, 33, '2023-01-07 14:27:05', '2023-01-07 14:27:05'),
(3380, 'Connecté', 'Compte', 0, 33, '2023-01-07 14:27:23', '2023-01-07 14:27:23'),
(3381, 'Modifier', 'Compte', 0, 6, '2023-01-07 14:27:33', '2023-01-07 14:27:33'),
(3382, 'Affichage', 'Compte', 0, 6, '2023-01-07 14:27:33', '2023-01-07 14:27:33'),
(3383, 'Connecté', 'Compte', 0, 35, '2023-01-07 14:27:36', '2023-01-07 14:27:36'),
(3384, 'Liste', 'Modeles', 0, 35, '2023-01-07 14:27:43', '2023-01-07 14:27:43'),
(3385, 'Detail', 'Modeles', 0, 35, '2023-01-07 14:27:46', '2023-01-07 14:27:46'),
(3386, 'Detail', 'Modeles', 0, 35, '2023-01-07 14:28:03', '2023-01-07 14:28:03'),
(3387, 'Modifier', 'Modeles', 0, 35, '2023-01-07 14:28:23', '2023-01-07 14:28:23'),
(3388, 'Modifier', 'Compte', 0, 6, '2023-01-07 14:28:24', '2023-01-07 14:28:24'),
(3389, 'Affichage', 'Compte', 0, 6, '2023-01-07 14:28:24', '2023-01-07 14:28:24'),
(3390, 'Detail', 'Modeles', 0, 35, '2023-01-07 14:28:35', '2023-01-07 14:28:35'),
(3391, 'Modifier', 'Modeles', 0, 35, '2023-01-07 14:28:59', '2023-01-07 14:28:59'),
(3392, 'Connecté', 'Compte', 0, 41, '2023-01-07 14:29:40', '2023-01-07 14:29:40'),
(3393, 'Liste', 'Modeles', 0, 41, '2023-01-07 14:29:49', '2023-01-07 14:29:49'),
(3394, 'Detail', 'Modeles', 0, 41, '2023-01-07 14:29:52', '2023-01-07 14:29:52'),
(3395, 'Detail', 'Modeles', 0, 41, '2023-01-07 14:30:42', '2023-01-07 14:30:42'),
(3396, 'Supprimer', 'Modeles', 0, 41, '2023-01-07 14:30:59', '2023-01-07 14:30:59'),
(3397, 'Connecté', 'Compte', 0, 41, '2023-01-07 14:31:07', '2023-01-07 14:31:07'),
(3398, 'Connecté', 'Compte', 0, 42, '2023-01-07 14:32:45', '2023-01-07 14:32:45'),
(3399, 'Liste', 'Modeles', 0, 42, '2023-01-07 14:32:58', '2023-01-07 14:32:58'),
(3400, 'Detail', 'Modeles', 0, 42, '2023-01-07 14:33:02', '2023-01-07 14:33:02'),
(3401, 'Supprimer', 'Modeles', 0, 42, '2023-01-07 14:33:17', '2023-01-07 14:33:17'),
(3402, 'Connecté', 'Compte', 0, 34, '2023-01-07 14:34:02', '2023-01-07 14:34:02'),
(3403, 'Liste', 'Modeles', 0, 34, '2023-01-07 14:34:17', '2023-01-07 14:34:17'),
(3404, 'Detail', 'Modeles', 0, 34, '2023-01-07 14:34:21', '2023-01-07 14:34:21'),
(3405, 'Liste', 'Ventes', 0, 34, '2023-01-07 14:34:52', '2023-01-07 14:34:52'),
(3406, 'Creer', 'Ventes', 0, 34, '2023-01-07 14:37:38', '2023-01-07 14:37:38'),
(3407, 'Liste', 'Ventes', 0, 34, '2023-01-07 14:38:07', '2023-01-07 14:38:07'),
(3408, 'Liste', 'Modeles', 0, 34, '2023-01-07 14:41:24', '2023-01-07 14:41:24'),
(3409, 'Connecté', 'Compte', 0, 41, '2023-01-07 14:42:49', '2023-01-07 14:42:49'),
(3410, 'Detail', 'Ventes', 0, 6, '2023-01-07 14:42:55', '2023-01-07 14:42:55'),
(3411, 'Detail', 'Ventes', 0, 6, '2023-01-07 14:42:56', '2023-01-07 14:42:56'),
(3412, 'Liste', 'Modeles', 0, 41, '2023-01-07 14:42:58', '2023-01-07 14:42:58'),
(3413, 'Detail', 'Modeles', 0, 41, '2023-01-07 14:43:02', '2023-01-07 14:43:02'),
(3414, 'Liste', 'Utilisateurs', 0, 6, '2023-01-07 14:44:13', '2023-01-07 14:44:13'),
(3415, 'Liste', 'Ventes', 0, 41, '2023-01-07 14:44:58', '2023-01-07 14:44:58'),
(3416, 'Liste', 'Ventes', 0, 41, '2023-01-07 14:45:08', '2023-01-07 14:45:08'),
(3417, 'Liste', 'Ventes', 0, 41, '2023-01-07 14:45:27', '2023-01-07 14:45:27'),
(3418, 'Liste', 'Modeles', 0, 41, '2023-01-07 14:45:50', '2023-01-07 14:45:50'),
(3419, 'Liste', 'Ventes', 0, 41, '2023-01-07 14:46:04', '2023-01-07 14:46:04'),
(3420, 'Connecté', 'Compte', 0, 35, '2023-01-07 14:46:57', '2023-01-07 14:46:57'),
(3421, 'Liste', 'Modeles', 0, 35, '2023-01-07 14:47:04', '2023-01-07 14:47:04'),
(3422, 'Detail', 'Modeles', 0, 35, '2023-01-07 14:52:46', '2023-01-07 14:52:46'),
(3423, 'Liste', 'Ventes', 0, 35, '2023-01-07 14:59:44', '2023-01-07 14:59:44'),
(3424, 'Liste', 'Modeles', 0, 35, '2023-01-07 15:06:20', '2023-01-07 15:06:20'),
(3425, 'Liste', 'Ventes', 0, 35, '2023-01-07 15:06:40', '2023-01-07 15:06:40'),
(3426, 'Creer', 'Ventes', 0, 35, '2023-01-07 15:11:28', '2023-01-07 15:11:28'),
(3427, 'Liste', 'Ventes', 0, 35, '2023-01-07 15:14:45', '2023-01-07 15:14:45'),
(3428, 'Liste', 'Modeles', 0, 35, '2023-01-07 15:15:53', '2023-01-07 15:15:53'),
(3429, 'Detail', 'Modeles', 0, 35, '2023-01-07 15:15:56', '2023-01-07 15:15:56'),
(3430, 'Connecté', 'Compte', 0, 37, '2023-01-07 15:19:06', '2023-01-07 15:19:06'),
(3431, 'Liste', 'Modeles', 0, 37, '2023-01-07 15:19:15', '2023-01-07 15:19:15'),
(3432, 'Detail', 'Modeles', 0, 37, '2023-01-07 15:19:19', '2023-01-07 15:19:19'),
(3433, 'Detail', 'Modeles', 0, 37, '2023-01-07 15:19:54', '2023-01-07 15:19:54'),
(3434, 'Modifier', 'Modeles', 0, 37, '2023-01-07 15:22:12', '2023-01-07 15:22:12'),
(3435, 'Liste', 'Ventes', 0, 37, '2023-01-07 15:22:24', '2023-01-07 15:22:24'),
(3436, 'Liste', 'Modeles', 0, 37, '2023-01-07 15:26:21', '2023-01-07 15:26:21'),
(3437, 'Detail', 'Modeles', 0, 37, '2023-01-07 15:26:25', '2023-01-07 15:26:25'),
(3438, 'Detail', 'Modeles', 0, 37, '2023-01-07 15:26:42', '2023-01-07 15:26:42'),
(3439, 'Modifier', 'Modeles', 0, 37, '2023-01-07 15:27:08', '2023-01-07 15:27:08'),
(3440, 'Liste', 'Livraisons', 0, 37, '2023-01-07 15:27:33', '2023-01-07 15:27:33'),
(3441, 'Liste', 'Ventes', 0, 37, '2023-01-07 15:27:41', '2023-01-07 15:27:41'),
(3442, 'Connecté', 'Compte', 0, 41, '2023-01-07 15:28:18', '2023-01-07 15:28:18'),
(3443, 'Liste', 'Modeles', 0, 41, '2023-01-07 15:28:27', '2023-01-07 15:28:27'),
(3444, 'Detail', 'Modeles', 0, 41, '2023-01-07 15:28:46', '2023-01-07 15:28:46'),
(3445, 'Liste', 'Ventes', 0, 41, '2023-01-07 15:29:29', '2023-01-07 15:29:29'),
(3446, 'Liste', 'Modeles', 0, 41, '2023-01-07 15:30:10', '2023-01-07 15:30:10'),
(3447, 'Connecté', 'Compte', 0, 58, '2023-01-07 15:30:54', '2023-01-07 15:30:54'),
(3448, 'Liste', 'Commandes', 0, 58, '2023-01-07 15:31:15', '2023-01-07 15:31:15'),
(3449, 'Creer', 'Journal', 0, 58, '2023-01-07 15:31:33', '2023-01-07 15:31:33'),
(3450, 'Connecté', 'Compte', 0, 4, '2023-01-07 18:04:28', '2023-01-07 18:04:28'),
(3451, 'Connecté', 'Compte', 0, 4, '2023-01-07 18:05:17', '2023-01-07 18:05:17'),
(3452, 'Liste', 'Modeles', 0, 4, '2023-01-07 18:05:22', '2023-01-07 18:05:22'),
(3453, 'Liste', 'Modeles', 0, 4, '2023-01-07 18:07:01', '2023-01-07 18:07:01'),
(3454, 'Liste', 'Modeles', 0, 4, '2023-01-07 18:07:03', '2023-01-07 18:07:03'),
(3455, 'Creer', 'Modeles', 0, 4, '2023-01-07 18:07:28', '2023-01-07 18:07:28'),
(3456, 'Supprimer', 'Modeles', 0, 4, '2023-01-07 18:07:51', '2023-01-07 18:07:51'),
(3457, 'Creer', 'Modeles', 0, 4, '2023-01-07 18:08:25', '2023-01-07 18:08:25'),
(3458, 'Liste', 'Modeles', 0, 4, '2023-01-07 18:08:30', '2023-01-07 18:08:30'),
(3459, 'Liste', 'Modeles', 0, 4, '2023-01-07 18:08:32', '2023-01-07 18:08:32'),
(3460, 'Supprimer', 'Modeles', 0, 4, '2023-01-07 18:08:39', '2023-01-07 18:08:39'),
(3461, 'Liste', 'Modeles', 0, 4, '2023-01-07 18:29:12', '2023-01-07 18:29:12'),
(3462, 'Creer', 'Modeles', 0, 4, '2023-01-07 18:30:05', '2023-01-07 18:30:05'),
(3463, 'Detail', 'Modeles', 0, 4, '2023-01-07 18:30:12', '2023-01-07 18:30:12'),
(3464, 'Detail', 'Modeles', 0, 4, '2023-01-07 18:30:37', '2023-01-07 18:30:37'),
(3465, 'Modifier', 'Modeles', 0, 4, '2023-01-07 18:30:46', '2023-01-07 18:30:46'),
(3466, 'Creer', 'Modeles', 0, 4, '2023-01-07 18:31:17', '2023-01-07 18:31:17'),
(3467, 'Supprimer', 'Modeles', 0, 4, '2023-01-07 18:31:26', '2023-01-07 18:31:26'),
(3468, 'Supprimer', 'Modeles', 0, 4, '2023-01-07 18:31:35', '2023-01-07 18:31:35'),
(3469, 'Connecté', 'Compte', 0, 6, '2023-01-07 18:34:22', '2023-01-07 18:34:22'),
(3470, 'liste', 'Boutique', 0, 6, '2023-01-07 18:34:30', '2023-01-07 18:34:30'),
(3471, 'Liste', 'Ventes', 0, 4, '2023-01-12 20:29:29', '2023-01-12 20:29:29'),
(3472, 'Connecté', 'Compte', 0, 4, '2023-01-13 19:49:08', '2023-01-13 19:49:08'),
(3473, 'Liste', 'Ventes', 0, 4, '2023-01-13 19:49:36', '2023-01-13 19:49:36'),
(3474, 'liste', 'Reglements', 0, 4, '2023-01-13 21:10:49', '2023-01-13 21:10:49'),
(3475, 'Liste', 'Ventes', 0, 4, '2023-01-13 23:35:46', '2023-01-13 23:35:46'),
(3476, 'Creer', 'Devis', 0, 4, '2023-01-13 23:37:07', '2023-01-13 23:37:07'),
(3477, 'Creer', 'Clients', 0, 4, '2023-01-14 00:07:28', '2023-01-14 00:07:28'),
(3478, 'Modifier', 'Clients', 0, 4, '2023-01-14 00:09:44', '2023-01-14 00:09:44'),
(3479, 'Creer', 'Devis', 0, 4, '2023-01-14 00:58:34', '2023-01-14 00:58:34'),
(3480, 'Creer', 'Devis', 0, 4, '2023-01-14 01:04:04', '2023-01-14 01:04:04'),
(3481, 'Creer', 'Devis', 0, 4, '2023-01-14 11:24:31', '2023-01-14 11:24:31'),
(3482, 'Creer', 'Devis', 0, 4, '2023-01-14 21:00:09', '2023-01-14 21:00:09'),
(3483, 'Creer', 'Devis', 0, 4, '2023-01-14 21:01:04', '2023-01-14 21:01:04'),
(3484, 'Creer', 'Devis', 0, 4, '2023-01-14 21:14:13', '2023-01-14 21:14:13');

-- --------------------------------------------------------

--
-- Table structure for table `immobilisations`
--

CREATE TABLE `immobilisations` (
  `id` int(10) UNSIGNED NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `montant` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT '2022-08-26 17:36:25',
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `amortissement_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventaires`
--

CREATE TABLE `inventaires` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `boutique_id` int(11) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `user_valide_id` int(10) UNSIGNED DEFAULT NULL,
  `date_inventaire` datetime NOT NULL DEFAULT '2022-08-26 17:36:27',
  `date_inventaire_prevu` timestamp NULL DEFAULT NULL,
  `date_inventaire_valider` timestamp NULL DEFAULT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT 0,
  `categorie_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `pdf_pending` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pdf_valider` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventaire_modeles`
--

CREATE TABLE `inventaire_modeles` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantite_reelle` double NOT NULL,
  `quantite` double NOT NULL,
  `modele_id` int(10) UNSIGNED DEFAULT NULL,
  `inventaire_id` int(10) UNSIGNED DEFAULT NULL,
  `justify` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` int(10) UNSIGNED NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT '2022-08-26 17:36:15',
  `date_fermeture` datetime DEFAULT NULL,
  `mois` int(11) DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `date_creation`, `date_fermeture`, `mois`, `annee`, `user_id`, `boutique_id`, `created_at`, `updated_at`) VALUES
(17, '2023-01-04 16:37:12', '2023-01-06 08:54:46', 1, 2023, 32, 3, '2023-01-04 21:37:12', '2023-01-06 13:54:46'),
(18, '2023-01-06 08:54:46', '2023-01-07 08:33:38', 1, 2023, 33, 4, '2023-01-06 13:54:46', '2023-01-07 13:33:38'),
(19, '2023-01-07 08:33:38', NULL, 1, 2023, 42, 15, '2023-01-07 13:33:38', '2023-01-07 13:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `journal_achats`
--

CREATE TABLE `journal_achats` (
  `id` int(10) UNSIGNED NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT '2022-08-26 17:36:28',
  `date_fermeture` datetime DEFAULT NULL,
  `mois` int(11) DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `journal_achats`
--

INSERT INTO `journal_achats` (`id`, `date_creation`, `date_fermeture`, `mois`, `annee`, `user_id`, `boutique_id`, `created_at`, `updated_at`) VALUES
(18, '2023-01-05 14:08:07', NULL, 1, 2023, 35, 6, '2023-01-05 19:08:07', '2023-01-05 19:08:07'),
(19, '2023-01-06 21:25:57', '2023-01-06 21:27:25', 1, 2023, 4, 1, '2023-01-07 02:25:57', '2023-01-07 02:27:25'),
(20, '2023-01-06 21:27:44', NULL, 1, 2023, 4, 1, '2023-01-07 02:27:44', '2023-01-07 02:27:44'),
(21, '2023-01-07 10:31:33', NULL, 1, 2023, 58, 1, '2023-01-07 15:31:33', '2023-01-07 15:31:33');

-- --------------------------------------------------------

--
-- Table structure for table `journal_depenses`
--

CREATE TABLE `journal_depenses` (
  `id` int(10) UNSIGNED NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT '2022-08-26 17:36:41',
  `date_fermeture` datetime DEFAULT NULL,
  `mois` int(11) DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journal_divers`
--

CREATE TABLE `journal_divers` (
  `id` int(10) UNSIGNED NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT '2022-08-26 17:36:23',
  `date_fermeture` datetime DEFAULT NULL,
  `mois` int(11) DEFAULT NULL,
  `annee` int(11) DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `livraisons`
--

CREATE TABLE `livraisons` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_livraison` datetime NOT NULL DEFAULT '2022-08-26 17:36:30',
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `livraisons`
--

INSERT INTO `livraisons` (`id`, `numero`, `date_livraison`, `boutique_id`, `created_at`, `updated_at`) VALUES
(13, 'LIV2023-1', '2023-01-05 14:18:06', 6, '2023-01-05 19:18:06', '2023-01-05 19:18:06'),
(14, 'LIV2023-14', '2023-01-06 21:29:21', 1, '2023-01-07 02:29:21', '2023-01-07 02:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `livraison_commandes`
--

CREATE TABLE `livraison_commandes` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantite_livre` double NOT NULL,
  `quantite_restante` double NOT NULL,
  `commande_modele_id` int(10) UNSIGNED DEFAULT NULL,
  `livraison_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `livraison_commandes`
--

INSERT INTO `livraison_commandes` (`id`, `quantite_livre`, `quantite_restante`, `commande_modele_id`, `livraison_id`, `created_at`, `updated_at`) VALUES
(13, 440, 0, 30, 13, '2023-01-05 19:18:06', '2023-01-05 19:18:06'),
(14, 10, 0, 33, 14, '2023-01-07 02:29:21', '2023-01-07 02:29:21');

-- --------------------------------------------------------

--
-- Table structure for table `livraison_ventes`
--

CREATE TABLE `livraison_ventes` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantite_livre` double NOT NULL,
  `quantite_restante` double NOT NULL,
  `prevente_id` int(10) UNSIGNED DEFAULT NULL,
  `livraison_v_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `livraison_v_s`
--

CREATE TABLE `livraison_v_s` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_livraison` datetime NOT NULL DEFAULT '2022-08-26 17:36:32',
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modeles`
--

CREATE TABLE `modeles` (
  `id` int(10) UNSIGNED NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `quantite` double NOT NULL,
  `prix` double NOT NULL,
  `prix_de_gros` double DEFAULT 0,
  `prix_achat` double NOT NULL DEFAULT 0,
  `seuil` int(11) NOT NULL DEFAULT 1,
  `produit_id` int(10) UNSIGNED DEFAULT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modeles`
--

INSERT INTO `modeles` (`id`, `libelle`, `numero`, `quantite`, `prix`, `prix_de_gros`, `prix_achat`, `seuil`, `produit_id`, `boutique_id`, `created_at`, `updated_at`) VALUES
(1, 'Barre de Fer n°6', 'MOD2022-1', 450, 850, 800, 0, 100, 6, 1, '2022-10-24 07:20:27', '2023-01-02 12:46:14'),
(2, 'Barre de Fer n°8', 'MOD2022-2', 1100, 1350, 1300, 0, 100, 6, 1, '2022-10-24 07:21:42', '2023-01-02 12:46:14'),
(3, 'Barre de Fer n°10', 'MOD2022-3', 170, 2100, 2000, 0, 100, 6, 1, '2022-10-24 07:22:40', '2022-12-29 15:46:24'),
(4, 'Barre de Fer n°12', 'MOD2022-4', 188, 3100, 3000, 0, 50, 6, 1, '2022-10-24 07:24:09', '2022-10-24 07:26:21'),
(5, 'Barre de Fer n°14', 'MOD2022-5', 78, 5000, 4900, 0, 50, 6, 1, '2022-10-24 07:25:36', '2022-11-30 06:41:48'),
(6, 'Cimtogo', 'MOD2022-6', 1020, 4100, 4000, 0, 50, 7, 1, '2022-10-24 07:28:47', '2023-01-02 12:15:04'),
(10, 'Fil de fer petit', 'MOD2022-10', 310, 1500, 1450, 0, 100, 10, 1, '2022-10-24 07:40:53', '2023-01-07 02:27:17'),
(13, 'Tôle ondulée n°0,20', 'MOD2022-13', 400, 3000, 2900, 0, 100, 9, 1, '2022-10-24 07:52:24', '2022-12-30 11:15:40'),
(15, 'Tôle Vrai n°0,40', 'MOD2022-15', 300, 3500, 3400, 0, 100, 9, 1, '2022-10-24 07:56:55', '2022-12-30 11:52:15'),
(16, 'Pointe ordinaire n°80', 'MOD2022-16', 500, 1000, 9000, 0, 100, 8, 1, '2022-10-24 07:59:34', '2022-11-09 10:50:34'),
(21, 'PILS', 'MOD2022-21', 100, 9000, 7500, 0, 50, 2, 1, '2022-11-09 10:41:04', '2022-11-09 10:41:04'),
(23, 'FLAG', 'MOD2022-23', 100, 9000, 7500, 0, 50, 2, 1, '2022-11-09 10:42:24', '2022-11-09 10:42:24'),
(24, 'BEAUFORT', 'MOD2022-24', 100, 9000, 7500, 0, 50, 2, 1, '2022-11-09 10:46:22', '2022-11-09 10:46:22'),
(25, 'Cimco', 'MOD2022-25', 500, 4100, 4000, 0, 50, 7, 1, '2022-11-09 10:51:46', '2023-01-02 12:11:14'),
(26, 'Fil de fer gros', 'MOD2022-26', 300, 2000, 1800, 0, 50, 10, 1, '2022-11-09 17:48:48', '2023-01-02 12:46:14'),
(27, 'cimtogo', 'MOD2022-27', 41, 4100, 4000, 0, 100, 7, 3, '2022-12-29 18:52:09', '2023-01-07 14:03:52'),
(28, 'Cimtogo', 'MOD2022-28', 831, 4100, 4000, 0, 100, 7, 6, '2022-12-30 12:03:00', '2023-01-07 15:11:27'),
(29, 'Cimtogo', 'MOD2022-29', 953, 4100, 4000, 0, 100, 7, 7, '2022-12-30 12:08:30', '2023-01-07 14:20:33'),
(30, 'Cimtogo', 'MOD2022-30', 727, 4100, 4000, 0, 100, 7, 15, '2022-12-30 12:33:19', '2023-01-07 13:36:48'),
(31, 'Barre de Fer n°14', 'MOD2022-31', 966, 4500, 4300, 0, 100, 6, 15, '2022-12-30 12:34:53', '2023-01-05 14:33:05'),
(32, 'Cimtogo', 'MOD2022-32', 440, 4150, 4000, 0, 100, 7, 12, '2022-12-30 12:39:40', '2023-01-05 19:57:16'),
(34, 'Cimtogo', 'MOD2022-34', 503, 4150, 4100, 0, 100, 7, 9, '2022-12-30 13:08:30', '2023-01-05 18:45:01'),
(35, 'Cimco', 'MOD2022-35', 422, 4150, 4100, 0, 100, 7, 10, '2022-12-30 13:24:22', '2023-01-05 18:37:57'),
(36, 'Cimtogo', 'MOD2022-36', 278, 4150, 4000, 0, 100, 7, 11, '2022-12-30 13:39:25', '2023-01-05 18:30:04'),
(37, 'CIMTOGO', 'MOD2022-37', 892, 4100, 4000, 0, 100, 7, 4, '2022-12-30 13:52:13', '2023-01-07 13:49:11'),
(38, 'Barre de Fer N°6', 'MOD2022-38', 4121, 800, 775, 0, 100, 6, 4, '2022-12-30 14:29:00', '2023-01-07 13:49:11'),
(39, 'Barre de Fer N°8', 'MOD2022-39', 2676, 1250, 1200, 0, 100, 6, 4, '2022-12-30 14:30:18', '2023-01-07 13:49:11'),
(40, 'Barre de Fer N°10', 'MOD2022-40', 1115, 1850, 1800, 0, 100, 6, 4, '2022-12-30 14:31:05', '2023-01-07 13:49:11'),
(41, 'Barre de Fer N°12', 'MOD2022-41', 1201, 2800, 2700, 0, 100, 6, 4, '2022-12-30 14:33:19', '2023-01-05 19:36:47'),
(42, 'Barre de Fer N°14', 'MOD2022-42', 276, 4500, 4400, 0, 100, 6, 4, '2022-12-30 14:34:30', '2023-01-05 19:37:12'),
(43, 'Pointe de Tôle', 'MOD2022-43', 5, 4000, 3900, 0, 20, 8, 4, '2022-12-30 14:36:28', '2023-01-05 19:37:46'),
(44, 'Pointe ordinaire de 100', 'MOD2022-44', 59, 1000, 1000, 0, 20, 8, 4, '2022-12-30 14:39:31', '2023-01-06 13:59:15'),
(49, 'Roulot de fil de Fer petit', 'MOD2022-49', 2, 1500, 1300, 0, 50, 10, 4, '2022-12-30 14:50:28', '2023-01-06 13:53:58'),
(50, 'Roulot de fil de Fer gros', 'MOD2022-50', 0, 2000, 1300, 0, 50, 10, 4, '2022-12-30 14:51:31', '2023-01-07 14:27:05'),
(51, 'Barre de Fer N°6', 'MOD2022-51', 2249, 800, 775, 0, 100, 6, 6, '2022-12-30 14:54:48', '2023-01-07 15:11:27'),
(52, 'Barre de Fer N°8', 'MOD2022-52', 1956, 1250, 1200, 0, 100, 6, 6, '2022-12-30 14:55:21', '2023-01-07 15:11:27'),
(53, 'Barre de Fer N°10', 'MOD2022-53', 730, 1850, 1800, 0, 100, 6, 6, '2022-12-30 14:55:57', '2023-01-07 15:11:27'),
(54, 'Barre de Fer N°12', 'MOD2022-54', 1028, 2850, 2700, 0, 100, 6, 6, '2022-12-30 14:56:28', '2023-01-07 15:11:27'),
(55, 'Barre de Fer N°14', 'MOD2022-55', 596, 4500, 4300, 0, 100, 6, 6, '2022-12-30 14:57:28', '2023-01-05 18:59:31'),
(56, 'Pointe de Tôle', 'MOD2022-56', 30, 4000, 3800, 0, 50, 8, 6, '2022-12-30 14:58:16', '2023-01-07 15:11:27'),
(57, 'Pointe ordinaire de 100', 'MOD2022-57', 274, 1000, 900, 0, 50, 8, 6, '2022-12-30 14:58:43', '2023-01-05 19:02:23'),
(58, 'Tôle ondulée 0,15', 'MOD2022-58', 180, 2500, 2400, 0, 60, 9, 6, '2022-12-30 14:59:27', '2023-01-05 19:04:17'),
(59, 'Tôle ondulée 0,20', 'MOD2022-59', 179, 3000, 2900, 0, 60, 9, 6, '2022-12-30 15:00:09', '2023-01-05 19:04:50'),
(60, 'Tôle ondulée 0,25', 'MOD2022-60', 4, 2750, 2700, 0, 60, 9, 6, '2022-12-30 15:00:46', '2023-01-05 19:05:22'),
(61, 'Tôle ondulé 0,40', 'MOD2022-61', 91, 3500, 3400, 0, 60, 9, 6, '2022-12-30 15:02:17', '2023-01-07 15:11:28'),
(62, 'Roulot de fil de Fer petit', 'MOD2022-62', 2, 1500, 1300, 0, 20, 10, 6, '2022-12-30 15:02:55', '2023-01-07 15:11:28'),
(63, 'Roulot de fil de Fer gros', 'MOD2022-63', 0, 2000, 1300, 0, 20, 6, 6, '2022-12-30 15:03:26', '2023-01-07 14:28:59'),
(64, 'Barre de Fer N°6', 'MOD2022-64', 485, 800, 775, 0, 100, 6, 7, '2022-12-30 15:05:27', '2023-01-07 14:20:33'),
(65, 'Barre de Fer N°8', 'MOD2022-65', 1763, 1250, 1200, 0, 100, 6, 7, '2022-12-30 15:05:57', '2023-01-05 20:06:41'),
(66, 'Barre de Fer N°10', 'MOD2022-66', 666, 1900, 1800, 0, 100, 6, 7, '2022-12-30 15:06:26', '2023-01-05 20:06:52'),
(75, 'Roulot de fil de Fer petit', 'MOD2022-75', 2, 1500, 1300, 0, 20, 10, 7, '2022-12-30 15:15:07', '2023-01-05 20:07:13'),
(77, 'Barre de Fer N°6', 'MOD2022-77', 691, 800, 775, 0, 100, 6, 12, '2022-12-30 15:18:06', '2023-01-05 19:57:55'),
(78, 'Barre de Fer N°8', 'MOD2022-78', 2955, 1250, 1200, 0, 100, 6, 12, '2022-12-30 15:18:36', '2023-01-05 19:58:10'),
(79, 'Barre de Fer N°10', 'MOD2022-79', 352, 1900, 1800, 0, 100, 6, 12, '2022-12-30 15:19:34', '2023-01-05 19:58:27'),
(80, 'Barre de Fer N°12', 'MOD2022-80', 338, 2800, 2700, 0, 100, 6, 12, '2022-12-30 15:20:09', '2023-01-05 19:58:57'),
(81, 'Barre de Fer N°14', 'MOD2022-81', 138, 4500, 4400, 0, 100, 6, 12, '2022-12-30 15:21:01', '2023-01-05 19:59:16'),
(82, 'Pointe de Tôle', 'MOD2022-82', 12, 4000, 3900, 0, 50, 8, 12, '2022-12-30 15:21:43', '2023-01-05 19:59:45'),
(83, 'Pointe ordinaire de 100', 'MOD2022-83', 176, 1000, 900, 0, 50, 8, 12, '2022-12-30 15:22:22', '2023-01-05 20:00:16'),
(84, 'Tôle ondulée 0,15', 'MOD2022-84', 148, 2500, 2400, 0, 60, 9, 12, '2022-12-30 15:23:24', '2023-01-05 20:01:39'),
(85, 'Tôle ondulée 0,20', 'MOD2022-85', 114, 3000, 2900, 0, 60, 9, 12, '2022-12-30 15:23:58', '2023-01-05 20:02:12'),
(86, 'Tôle ondulée 0,25', 'MOD2022-86', 0, 2750, 2700, 0, 60, 9, 12, '2022-12-30 15:24:29', '2023-01-05 20:02:41'),
(87, 'Tôle ondulé 0,40', 'MOD2022-87', -26, 3500, 3400, 0, 60, 9, 12, '2022-12-30 15:25:25', '2023-01-05 20:03:08'),
(88, 'Roulot de fil de Fer petit', 'MOD2022-88', -2, 1500, 1300, 0, 20, 10, 12, '2022-12-30 15:26:21', '2023-01-05 20:00:40'),
(90, 'Barre de Fer N°6', 'MOD2022-90', 558, 800, 775, 0, 100, 6, 5, '2022-12-30 15:30:25', '2023-01-07 14:37:38'),
(91, 'Barre de Fer N°8', 'MOD2022-91', 1274, 1250, 1200, 0, 100, 6, 5, '2022-12-30 15:30:52', '2023-01-07 14:37:38'),
(92, 'Barre de Fer N°10', 'MOD2022-92', 180, 1900, 1800, 0, 100, 6, 5, '2022-12-30 15:31:20', '2023-01-05 19:42:34'),
(93, 'Barre de Fer N°12', 'MOD2022-93', 0, 2800, 2700, 0, 100, 6, 5, '2022-12-30 15:31:46', '2023-01-05 19:43:25'),
(95, 'Pointe de Tôle', 'MOD2022-95', 18, 4000, 3900, 0, 50, 8, 5, '2022-12-30 15:32:50', '2023-01-05 19:44:39'),
(96, 'Pointe ordinaire de 100', 'MOD2022-96', 11, 1000, 900, 0, 50, 8, 5, '2022-12-30 15:33:20', '2023-01-05 19:45:28'),
(97, 'Tôle ondulée 0,15', 'MOD2022-97', 146, 2500, 2400, 0, 60, 9, 5, '2022-12-30 15:33:54', '2023-01-05 19:46:59'),
(98, 'Tôle ondulée 0,20', 'MOD2022-98', 161, 3000, 2900, 0, 60, 9, 5, '2022-12-30 15:34:26', '2023-01-05 19:47:20'),
(101, 'Roulot de fil de Fer petit', 'MOD2022-101', 4, 1500, 1300, 0, 20, 10, 5, '2022-12-30 15:36:09', '2023-01-07 14:37:38'),
(102, 'Roulot de fil de Fer gros', 'MOD2022-102', 0, 2000, 1300, 0, 20, 10, 5, '2022-12-30 15:36:39', '2023-01-05 19:46:25'),
(103, 'CIMTOGO', 'MOD2022-103', 858, 4100, 4000, 0, 100, 7, 8, '2022-12-30 15:38:54', '2023-01-06 14:10:36'),
(104, 'Barre de Fer N°6', 'MOD2022-104', 6005, 800, 775, 0, 100, 6, 8, '2022-12-30 15:39:22', '2023-01-06 14:13:38'),
(105, 'Barre de Fer N°8', 'MOD2022-105', 1674, 1250, 1200, 0, 100, 6, 8, '2022-12-30 15:39:48', '2023-01-06 14:10:36'),
(106, 'Barre de Fer N°10', 'MOD2022-106', 2119, 1850, 1800, 0, 100, 6, 8, '2022-12-30 15:40:14', '2023-01-06 14:10:36'),
(107, 'Barre de Fer N°12', 'MOD2022-107', 1494, 2850, 2800, 0, 100, 6, 8, '2022-12-30 15:40:46', '2023-01-05 19:50:58'),
(108, 'Barre de Fer N°14', 'MOD2022-108', 530, 4500, 4400, 0, 100, 6, 8, '2022-12-30 15:41:10', '2023-01-05 19:51:41'),
(109, 'Pointe de Tôle', 'MOD2022-109', 15, 4000, 3900, 0, 50, 8, 8, '2022-12-30 15:41:37', '2023-01-05 19:52:14'),
(110, 'Pointe ordinaire de 100', 'MOD2022-110', 53, 1000, 900, 0, 50, 8, 8, '2022-12-30 15:42:03', '2023-01-05 19:52:37'),
(111, 'Tôle ondulée 0,15', 'MOD2022-111', 180, 2500, 2400, 0, 60, 9, 8, '2022-12-30 15:42:31', '2023-01-05 19:53:50'),
(112, 'Tôle ondulée 0,20', 'MOD2022-112', 200, 2500, 2400, 0, 60, 9, 8, '2022-12-30 15:42:58', '2023-01-05 19:55:07'),
(116, 'Roulot de fil de Fer gros', 'MOD2022-116', 0, 2000, 1300, 0, 20, 10, 8, '2022-12-30 15:47:21', '2023-01-07 15:22:12'),
(130, 'Barre de Fer N°6', 'MOD2022-130', 118, 850, 800, 0, 100, 6, 9, '2022-12-30 16:16:36', '2023-01-05 14:54:57'),
(131, 'Barre de Fer N°8', 'MOD2022-131', 549, 1250, 1200, 0, 100, 6, 9, '2022-12-30 16:17:06', '2023-01-05 14:55:32'),
(132, 'Barre de Fer N°10', 'MOD2022-132', 252, 1900, 1800, 0, 100, 6, 9, '2022-12-30 16:17:38', '2023-01-05 14:55:57'),
(135, 'Pointe de Tôle', 'MOD2022-135', 6, 4100, 4000, 0, 60, 8, 9, '2022-12-30 16:19:19', '2023-01-05 18:46:27'),
(136, 'Pointe ordinaire de 100', 'MOD2022-136', 48, 1000, 1000, 0, 40, 8, 9, '2022-12-30 16:19:52', '2023-01-05 18:46:45'),
(138, 'Tôle ondulée 0,15', 'MOD2022-138', 50, 2500, 2400, 0, 60, 9, 9, '2022-12-30 16:22:07', '2023-01-05 18:47:24'),
(141, 'Roulot de fil de Fer petit', 'MOD2022-141', 2, 1500, 1300, 0, 50, 10, 9, '2022-12-30 16:24:05', '2023-01-05 18:47:09'),
(142, 'Roulot de fil de Fer gros', 'MOD2022-142', 0, 2000, 1300, 0, 50, 10, 9, '2022-12-30 16:24:44', '2023-01-05 18:46:57'),
(156, 'Barre de Fer N°6', 'MOD2022-156', 3111, 800, 750, 0, 100, 6, 15, '2022-12-30 16:36:44', '2023-01-07 13:36:48'),
(157, 'Barre de Fer N°8', 'MOD2022-157', 3895, 1250, 1200, 0, 100, 6, 15, '2022-12-30 16:37:08', '2023-01-07 13:36:48'),
(158, 'Barre de Fer N°10', 'MOD2022-158', 3690, 1900, 1800, 0, 100, 6, 15, '2022-12-30 16:37:36', '2023-01-05 14:34:40'),
(159, 'Barre de Fer N°12', 'MOD2022-159', 1880, 2800, 2700, 0, 100, 6, 15, '2022-12-30 16:38:05', '2023-01-05 14:36:10'),
(166, 'Roulot de fil de Fer petit', 'MOD2022-166', 2, 1500, 1300, 0, 50, 10, 15, '2022-12-30 16:41:42', '2023-01-05 14:37:12'),
(168, 'CIMTOGO', 'MOD2022-168', 454, 3800, 3500, 0, 100, 7, 16, '2022-12-31 11:45:02', '2023-01-07 02:23:52'),
(169, 'Barre de Fer N°6', 'MOD2022-169', 1098, 3750, 3700, 0, 100, 6, 16, '2022-12-31 14:48:16', '2023-01-05 20:22:34'),
(170, 'Barre de Fer N°8', 'MOD2022-170', 327, 1250, 1200, 0, 100, 6, 16, '2022-12-31 14:50:59', '2023-01-05 20:23:05'),
(171, 'Barre de Fer N°10', 'MOD2022-171', 224, 1900, 1800, 0, 100, 6, 16, '2022-12-31 14:52:12', '2023-01-05 20:23:37'),
(172, 'Barre de Fer N°12', 'MOD2022-172', 241, 2800, 2700, 0, 100, 6, 16, '2022-12-31 14:53:49', '2023-01-05 20:23:59'),
(173, 'Barre de Fer N°14', 'MOD2022-173', 268, 4500, 4400, 0, 100, 6, 16, '2022-12-31 14:55:26', '2023-01-05 20:24:24'),
(180, 'Fil de Fer petit', 'MOD2022-180', 153, 1500, 1300, 0, 20, 10, 16, '2022-12-31 15:11:30', '2023-01-07 02:09:49'),
(183, 'CIMTOGO', 'MOD2023-183', 819, 4100, 4000, 0, 100, 7, 5, '2023-01-04 21:05:32', '2023-01-07 14:37:38'),
(184, 'Tôle ondulée 0,20', 'MOD2023-184', 57, 3000, 2900, 0, 60, 9, 9, '2023-01-05 18:40:51', '2023-01-05 18:47:32'),
(185, 'ORANGE N°11', 'MOD2023-185', 11, 6000, 5000, 0, 10, 11, 1, '2023-01-07 01:32:39', '2023-01-07 01:32:39'),
(186, 'ORANGE N°13', 'MOD2023-186', 18, 6000, 5000, 0, 10, 11, 1, '2023-01-07 01:34:13', '2023-01-07 02:29:21'),
(187, 'TUYAU N°100', 'MOD2023-187', 15, 3500, 3000, 0, 10, 11, 1, '2023-01-07 01:43:35', '2023-01-07 01:43:35'),
(188, 'ORANGE N°11', 'MOD2023-188', 11, 6000, 5000, 0, 10, 11, 16, '2023-01-07 01:51:18', '2023-01-07 01:51:18'),
(189, 'ORANGE N°13', 'MOD2023-189', 8, 6000, 5000, 0, 10, 11, 16, '2023-01-07 01:53:28', '2023-01-07 01:53:28'),
(191, 'TUYAU N°100', 'MOD2023-190', 15, 3500, 3000, 0, 10, 11, 16, '2023-01-07 01:57:01', '2023-01-07 01:57:01'),
(192, 'THE N°100', 'MOD2023-192', 30, 2500, 2000, 0, 10, 13, 16, '2023-01-07 02:00:47', '2023-01-07 02:00:47'),
(193, 'COUDE N°100', 'MOD2023-193', 11, 1000, 500, 0, 10, 12, 16, '2023-01-07 02:02:56', '2023-01-07 02:02:56'),
(194, 'TUYAU N°75', 'MOD2023-194', 18, 2500, 2000, 0, 10, 11, 16, '2023-01-07 02:04:11', '2023-01-07 02:04:11'),
(195, 'THE N°75', 'MOD2023-195', 20, 750, 700, 0, 10, 13, 16, '2023-01-07 02:05:18', '2023-01-07 02:05:18'),
(196, 'COUDE N°75', 'MOD2023-196', 50, 2000, 1500, 0, 10, 12, 16, '2023-01-07 02:06:30', '2023-01-07 02:06:30'),
(197, 'PRESSION N°25', 'MOD2023-197', 71, 2400, 2000, 0, 10, 11, 16, '2023-01-07 02:08:12', '2023-01-07 02:08:12'),
(200, 'PRESSION N°25', 'MOD2023-200', 28, 2000, 1500, 0, 10, 12, 16, '2023-01-07 02:13:54', '2023-01-07 02:13:54'),
(201, 'PRESSION N°25', 'MOD2023-201', 42, 2000, 1500, 0, 10, 13, 16, '2023-01-07 02:15:37', '2023-01-07 02:15:37'),
(202, 'PRESSION N°32', 'MOD2023-202', 50, 4000, 3500, 0, 10, 11, 16, '2023-01-07 02:16:41', '2023-01-07 02:16:41'),
(203, 'PRESSION N°32', 'MOD2023-203', 34, 3000, 2500, 0, 10, 13, 16, '2023-01-07 02:17:52', '2023-01-07 02:17:52'),
(204, 'PRESSION N°32', 'MOD2023-204', 14, 2500, 2000, 0, 10, 12, 16, '2023-01-07 02:18:44', '2023-01-07 02:18:44'),
(205, 'PELLE', 'MOD2023-205', 2, 2000, 1700, 0, 10, 15, 16, '2023-01-07 02:22:16', '2023-01-07 02:22:16'),
(207, 'CIMCO', 'MOD2023-206', 100, 3700, 3650, 0, 100, 7, 8, '2023-01-07 14:19:11', '2023-01-07 14:19:11'),
(208, 'CIMCO', 'MOD2023-208', 400, 3700, 3650, 0, 100, 7, 16, '2023-01-07 14:21:13', '2023-01-07 14:21:13');

-- --------------------------------------------------------

--
-- Table structure for table `modele_fournisseurs`
--

CREATE TABLE `modele_fournisseurs` (
  `id` int(10) UNSIGNED NOT NULL,
  `fournisseur_id` int(10) UNSIGNED DEFAULT NULL,
  `modele_id` int(10) UNSIGNED DEFAULT NULL,
  `prix` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `modele_fournisseurs`
--

INSERT INTO `modele_fournisseurs` (`id`, `fournisseur_id`, `modele_id`, `prix`, `created_at`, `updated_at`) VALUES
(20, 7, 36, 4000, '2023-01-03 12:25:32', '2023-01-03 12:25:32'),
(21, 9, 117, 800, '2023-01-03 12:26:17', '2023-01-03 12:27:23'),
(22, 8, 36, 4000, '2023-01-03 12:26:40', '2023-01-03 12:26:40'),
(23, 9, 118, 1200, '2023-01-03 12:27:07', '2023-01-03 12:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 2),
(1, 'App\\User', 4),
(1, 'App\\User', 17),
(1, 'App\\User', 18),
(1, 'App\\User', 20),
(1, 'App\\User', 21),
(1, 'App\\User', 22),
(1, 'App\\User', 23),
(1, 'App\\User', 24),
(1, 'App\\User', 25),
(1, 'App\\User', 26),
(1, 'App\\User', 27),
(1, 'App\\User', 28),
(1, 'App\\User', 29),
(1, 'App\\User', 30),
(1, 'App\\User', 31),
(1, 'App\\User', 32),
(1, 'App\\User', 33),
(1, 'App\\User', 34),
(1, 'App\\User', 35),
(1, 'App\\User', 36),
(1, 'App\\User', 37),
(1, 'App\\User', 38),
(1, 'App\\User', 39),
(1, 'App\\User', 40),
(1, 'App\\User', 41),
(1, 'App\\User', 42),
(1, 'App\\User', 43),
(1, 'App\\User', 44),
(1, 'App\\User', 53),
(1, 'App\\User', 54),
(1, 'App\\User', 55),
(1, 'App\\User', 56),
(1, 'App\\User', 57),
(1, 'App\\User', 58),
(1, 'App\\User', 59),
(1, 'App\\User', 60),
(2, 'App\\User', 14),
(3, 'App\\User', 9),
(3, 'App\\User', 10),
(3, 'App\\User', 11),
(3, 'App\\User', 12),
(3, 'App\\User', 15),
(3, 'App\\User', 16),
(3, 'App\\User', 19),
(3, 'App\\User', 46),
(3, 'App\\User', 47),
(3, 'App\\User', 48),
(3, 'App\\User', 49),
(3, 'App\\User', 50),
(3, 'App\\User', 51),
(3, 'App\\User', 52),
(3, 'App\\User', 61),
(4, 'App\\User', 8),
(4, 'App\\User', 13),
(4, 'App\\User', 45),
(5, 'App\\User', 1),
(5, 'App\\User', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `preventes`
--

CREATE TABLE `preventes` (
  `id` int(10) UNSIGNED NOT NULL,
  `quantite` double NOT NULL,
  `prix` double NOT NULL,
  `reduction` double DEFAULT 0,
  `prixtotal` double NOT NULL,
  `modele_fournisseur_id` int(10) UNSIGNED DEFAULT NULL,
  `vente_id` int(10) UNSIGNED DEFAULT NULL,
  `etat` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `preventes`
--

INSERT INTO `preventes` (`id`, `quantite`, `prix`, `reduction`, `prixtotal`, `modele_fournisseur_id`, `vente_id`, `etat`, `created_at`, `updated_at`) VALUES
(116, 78, 4100, 0, 319800, 27, 61, 0, '2023-01-04 21:40:13', '2023-01-04 21:40:13'),
(117, 51, 4100, 0, 209100, 37, 62, 0, '2023-01-06 13:59:15', '2023-01-06 13:59:15'),
(118, 2, 800, 0, 1600, 38, 62, 0, '2023-01-06 13:59:15', '2023-01-06 13:59:15'),
(119, 6, 1250, 0, 7500, 39, 62, 0, '2023-01-06 13:59:15', '2023-01-06 13:59:15'),
(120, 4, 1850, 0, 7400, 40, 62, 0, '2023-01-06 13:59:15', '2023-01-06 13:59:15'),
(121, 1, 1000, 0, 1000, 44, 62, 0, '2023-01-06 13:59:15', '2023-01-06 13:59:15'),
(122, 76, 4100, 0, 311600, 103, 63, 0, '2023-01-06 14:10:36', '2023-01-06 14:10:36'),
(123, 8, 800, 0, 6400, 104, 63, 0, '2023-01-06 14:10:36', '2023-01-06 14:10:36'),
(124, 66, 1250, 0, 82500, 105, 63, 0, '2023-01-06 14:10:36', '2023-01-06 14:10:36'),
(125, 1, 1850, 0, 1850, 106, 63, 0, '2023-01-06 14:10:36', '2023-01-06 14:10:36'),
(126, 2, 2000, 0, 4000, 116, 63, 0, '2023-01-06 14:10:36', '2023-01-06 14:10:36'),
(127, 27, 4100, 0, 110700, 30, 64, 0, '2023-01-07 13:36:48', '2023-01-07 13:36:48'),
(128, 3, 800, 0, 2400, 156, 64, 0, '2023-01-07 13:36:48', '2023-01-07 13:36:48'),
(129, 9, 1250, 0, 11250, 157, 64, 0, '2023-01-07 13:36:48', '2023-01-07 13:36:48'),
(130, 79, 4100, 0, 323900, 27, 65, 0, '2023-01-07 13:41:20', '2023-01-07 13:41:20'),
(131, 50, 4100, 0, 205000, 37, 66, 0, '2023-01-07 13:49:11', '2023-01-07 13:49:11'),
(132, 2, 800, 0, 1600, 38, 66, 0, '2023-01-07 13:49:11', '2023-01-07 13:49:11'),
(133, 3, 1250, 0, 3750, 39, 66, 0, '2023-01-07 13:49:11', '2023-01-07 13:49:11'),
(134, 1, 1850, 0, 1850, 40, 66, 0, '2023-01-07 13:49:11', '2023-01-07 13:49:11'),
(135, 47, 4100, 0, 192700, 27, 67, 0, '2023-01-07 14:03:52', '2023-01-07 14:03:52'),
(136, 2, 800, 0, 1600, 64, 67, 0, '2023-01-07 14:03:52', '2023-01-07 14:03:52'),
(137, 47, 4100, 0, 192700, 29, 68, 0, '2023-01-07 14:20:33', '2023-01-07 14:20:33'),
(138, 2, 800, 0, 1600, 64, 68, 0, '2023-01-07 14:20:33', '2023-01-07 14:20:33'),
(139, 39, 4100, 0, 159900, 183, 69, 0, '2023-01-07 14:37:38', '2023-01-07 14:37:38'),
(140, 2, 800, 0, 1600, 90, 69, 0, '2023-01-07 14:37:38', '2023-01-07 14:37:38'),
(141, 5, 1250, 0, 6250, 91, 69, 0, '2023-01-07 14:37:38', '2023-01-07 14:37:38'),
(142, 1, 1500, 0, 1500, 101, 69, 0, '2023-01-07 14:37:38', '2023-01-07 14:37:38'),
(143, 143, 4100, 5750, 580550, 28, 70, 0, '2023-01-07 15:11:27', '2023-01-07 15:11:27'),
(144, 42, 800, 0, 33600, 51, 70, 0, '2023-01-07 15:11:27', '2023-01-07 15:11:27'),
(145, 80, 1250, 0, 100000, 52, 70, 0, '2023-01-07 15:11:27', '2023-01-07 15:11:27'),
(146, 40, 1850, 0, 74000, 53, 70, 0, '2023-01-07 15:11:27', '2023-01-07 15:11:27'),
(147, 8, 2850, 0, 22800, 54, 70, 0, '2023-01-07 15:11:27', '2023-01-07 15:11:27'),
(148, 2, 4000, 0, 8000, 56, 70, 0, '2023-01-07 15:11:27', '2023-01-07 15:11:27'),
(149, 1, 1500, 0, 1500, 62, 70, 0, '2023-01-07 15:11:27', '2023-01-07 15:11:27'),
(150, 23, 3500, 0, 80500, 61, 70, 0, '2023-01-07 15:11:28', '2023-01-07 15:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `produits`
--

CREATE TABLE `produits` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categorie_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produits`
--

INSERT INTO `produits` (`id`, `nom`, `numero`, `categorie_id`, `created_at`, `updated_at`) VALUES
(1, 'PAGNES', 'PROD2022-1', 2, '2022-10-24 06:53:13', '2022-10-24 07:06:10'),
(2, 'BOISSONS', 'PROD2022-2', 2, '2022-10-24 06:53:46', '2022-10-24 07:05:42'),
(3, 'EAU', 'PROD2022-3', 2, '2022-10-24 06:54:35', '2022-10-24 06:54:35'),
(4, 'PANTALONS', 'PROD2022-4', 2, '2022-10-24 07:04:20', '2022-10-24 07:07:12'),
(5, 'HABITS', 'PROD2022-5', 2, '2022-10-24 07:04:21', '2022-10-24 07:07:42'),
(6, 'FERS A BETON', 'PROD2022-6', 1, '2022-10-24 07:08:55', '2022-10-24 07:08:55'),
(7, 'CIMENTS', 'PROD2022-7', 1, '2022-10-24 07:09:41', '2022-10-24 07:09:41'),
(8, 'POINTES', 'PROD2022-8', 1, '2022-10-24 07:10:29', '2022-10-24 07:10:29'),
(9, 'TOLES', 'PROD2022-9', 1, '2022-10-24 07:11:06', '2022-10-24 07:11:06'),
(10, 'FILS DE FER', 'PROD2022-10', 1, '2022-10-24 07:13:55', '2023-01-07 14:10:30'),
(11, 'TUYAUX', 'PROD2023-11', 1, '2023-01-07 01:01:02', '2023-01-07 01:02:13'),
(12, 'COUDES', 'PROD2023-12', 1, '2023-01-07 01:01:59', '2023-01-07 01:01:59'),
(13, 'THE', 'PROD2023-13', 1, '2023-01-07 01:04:41', '2023-01-07 01:04:41'),
(15, 'PELLES', 'PROD2023-14', 1, '2023-01-07 01:17:26', '2023-01-07 01:17:26');

-- --------------------------------------------------------

--
-- Table structure for table `projets`
--

CREATE TABLE `projets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `debut` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `status` int(10) UNSIGNED DEFAULT 0,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `projet_models`
--

CREATE TABLE `projet_models` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantite` double NOT NULL,
  `prix` double NOT NULL,
  `prixtotal` double NOT NULL,
  `modele_id` int(10) UNSIGNED DEFAULT NULL,
  `projet_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recettes`
--

CREATE TABLE `recettes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `montant` double DEFAULT NULL,
  `observation` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fournisseur_id` int(10) UNSIGNED DEFAULT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `type_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reglements`
--

CREATE TABLE `reglements` (
  `id` int(10) UNSIGNED NOT NULL,
  `montant_donne` double NOT NULL,
  `montant_restant` double NOT NULL,
  `total` double DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `date_reglement` datetime NOT NULL DEFAULT '2022-08-26 17:36:23',
  `vente_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reglement_achats`
--

CREATE TABLE `reglement_achats` (
  `id` int(10) UNSIGNED NOT NULL,
  `montant_donne` double NOT NULL,
  `montant_restant` double NOT NULL,
  `total` double DEFAULT NULL,
  `fournisseur_id` int(11) DEFAULT NULL,
  `date_reglement` datetime NOT NULL DEFAULT '2022-08-26 17:36:39',
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `commande_id` int(10) UNSIGNED DEFAULT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `retours`
--

CREATE TABLE `retours` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `totaux` double DEFAULT NULL,
  `payer` double DEFAULT NULL,
  `vente_id` int(10) UNSIGNED DEFAULT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `retour_lignes`
--

CREATE TABLE `retour_lignes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantite_retourner` double DEFAULT NULL,
  `quantite_restante` double DEFAULT NULL,
  `montant` double DEFAULT NULL,
  `payer` tinyint(1) DEFAULT 1,
  `rayon` tinyint(1) DEFAULT 1,
  `prevente_id` int(10) UNSIGNED DEFAULT NULL,
  `vente_id` int(10) UNSIGNED DEFAULT NULL,
  `retour_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'ADMINISTRATEUR', 'Web', NULL, NULL),
(2, 'CAISSIER', 'Web', NULL, NULL),
(3, 'MAGASINIER', 'Web', NULL, NULL),
(4, 'VENDEUR', 'Web', NULL, NULL),
(5, 'SUPER ADMINISTRATEUR', 'Web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prix` double NOT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_ventes`
--

CREATE TABLE `service_ventes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `quantite` double NOT NULL,
  `prix` double NOT NULL,
  `prixtotal` double NOT NULL,
  `service_id` int(10) UNSIGNED DEFAULT NULL,
  `vente_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT 0,
  `status` tinyint(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `tag`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'VENTE SIMPLE', 'vente_simple', 0, 1, '2022-10-12 01:52:36', '2022-10-12 01:52:36'),
(2, 'VENTE A CREDIT', 'vente_credit', 0, 1, '2022-10-12 01:52:36', '2022-10-12 01:52:36'),
(3, 'VENTE NON LIVREE', 'vente_livree', 0, 1, '2022-10-12 01:52:36', '2022-10-12 01:52:36'),
(4, 'DEVIS', 'vente_fictive', 0, 1, '2022-10-12 01:52:36', '2022-10-12 01:52:36'),
(5, 'LIVRAISON VENTE', 'livraison_vente', 0, 1, '2022-10-12 01:52:36', '2022-10-12 01:52:36'),
(6, 'TVA', 'tva', 0, 1, '2022-10-12 01:52:36', '2022-10-12 01:52:36'),
(7, 'REGLEMENT', 'reglement', 0, 1, '2022-10-12 01:52:36', '2022-10-12 01:52:36'),
(8, 'REGLEMENT ACHAT', 'reglement_achat', 0, 1, '2022-10-12 01:52:36', '2022-10-12 01:52:36'),
(10, 'COMMANDE DIRECT', 'commande_direct', 0, 1, '2022-10-12 01:52:36', '2022-10-12 01:52:36'),
(11, 'COMMANDE NON LIVREE', 'commande_indirect', 0, 1, '2022-10-12 01:52:36', '2022-10-12 01:52:36'),
(12, 'COMMANDE A CREDIT', 'commande_a_credit', 0, 1, '2022-10-12 01:52:36', '2022-10-12 01:52:36'),
(13, 'LIVRAISON COMMANDE', 'livraison_commande', 0, 1, '2022-10-12 01:52:36', '2022-10-12 01:52:36'),
(14, 'INVENTAIRE', 'inventaire', 0, 1, '2022-10-12 01:52:36', '2022-10-12 01:52:36'),
(15, 'CHARGE', 'charge', 0, 1, '2022-10-12 01:52:36', '2022-10-12 01:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `solds`
--

CREATE TABLE `solds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `boutique_id` int(11) DEFAULT NULL,
  `montant` double DEFAULT 0,
  `seuil` double DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sold_depots`
--

CREATE TABLE `sold_depots` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `montant` double DEFAULT NULL,
  `motif` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `justifier` tinyint(1) NOT NULL DEFAULT 0,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_dep` date NOT NULL DEFAULT '2022-08-26',
  `sold_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `journal_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transferts`
--

CREATE TABLE `transferts` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT 0,
  `magasin_transfert_id` int(10) UNSIGNED DEFAULT NULL,
  `magasin_reception_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transfert_lignes`
--

CREATE TABLE `transfert_lignes` (
  `id` int(10) UNSIGNED NOT NULL,
  `transfert_id` int(10) UNSIGNED DEFAULT NULL,
  `modele_libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modele_qte` double NOT NULL,
  `modele_transfert_id` int(10) UNSIGNED DEFAULT NULL,
  `modele_reception_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_paiements`
--

CREATE TABLE `type_paiements` (
  `id` int(10) UNSIGNED NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_recettes`
--

CREATE TABLE `type_recettes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `type_recettes`
--

INSERT INTO `type_recettes` (`id`, `label`, `created_at`, `updated_at`) VALUES
(1, 'Commission sur Vente', '2022-10-12 01:52:36', '2022-10-12 01:52:36'),
(2, 'Commission sur Transport', '2022-10-12 01:52:36', '2022-10-12 01:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` enum('M','F') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `flag_etat` tinyint(1) NOT NULL DEFAULT 0,
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nom`, `prenom`, `sexe`, `email`, `contact`, `password`, `flag_etat`, `boutique_id`, `created_at`, `updated_at`) VALUES
(4, 'Mingoube', 'Kanfitine', 'M', 'mingoube1@mingoube.com', '91533700', '$2y$10$eCpOJdsNDdmADvoHnDSemOmMqVZ12FjNywffQq5I.zLLSp7SuEI1G', 0, 1, '2022-10-23 17:57:44', '2022-10-26 14:39:47'),
(6, 'Super', 'Mingoube', 'M', 'mingoube@mingoube.com', '90913500', '$2y$10$eCpOJdsNDdmADvoHnDSemOmMqVZ12FjNywffQq5I.zLLSp7SuEI1G', 0, 1, '2022-10-24 04:42:17', '2023-01-05 03:38:57'),
(32, 'KONGON', 'ODILE', 'F', 'dapaong@mingoube.com', '92357718', '$2y$10$9kDrAOjDJg1xFI1yOe0FdeW5ANXMba0THzb2Uh0M.TdN60pmoTtja', 0, 3, '2023-01-04 20:26:19', '2023-01-05 03:15:36'),
(33, 'SONG', 'TADJA', 'M', 'worgou@mingoube.com', '70090694/ 96156587', '$2y$10$7OGOBA/8o08b06PTuFZqdu2C/CRoCBHpXVoqPWpUHowLP53CaGw06', 0, 4, '2023-01-04 20:49:15', '2023-01-05 03:42:39'),
(34, 'LARE', 'SOANTCHEIBE', 'M', 'toaga@mingoube.com', '92618750', '$2y$10$BVoY9cEiTq/MnZENzteSKes8qqFxP.gyFAm6SzN5NvOFF/LtnuzP.', 0, 5, '2023-01-04 20:59:56', '2023-01-05 03:18:10'),
(35, 'DOUTI', 'KALMOCK', 'M', 'cinkasse1@mingoube.com', '93345938', '$2y$10$90cghvwLljW68zj2RBf/mOZ.UFFYow1nPXaQe4wW898uzZmIE1dfG', 0, 6, '2023-01-04 21:29:46', '2023-01-05 03:15:00'),
(36, 'YENDOUBAN', 'YANNALE', 'M', 'cinkasse2@mingoube.com', '90000760', '$2y$10$F0x5pnzOfymlcl/EUupxqu0FrwLRnzchn1LvwJDU/POrLkwPu/zAK', 0, 7, '2023-01-04 21:51:02', '2023-01-05 03:19:46'),
(37, 'KAMPADIBE', 'YENDOUKOA', 'M', 'kpegui@mingoube.com', '91293176', '$2y$10$m.Dbaz3bMFx5udUa/rc0QOSl4YY/dJoFOd62SE0VSn3WUVc27JsPe', 0, 8, '2023-01-05 02:01:22', '2023-01-05 02:01:22'),
(38, 'DAPOUGUIDI', 'AROUNA', 'M', 'nadjoundi1@mingoube.com', '90103998', '$2y$10$l3Md26RKUaEpoHilVIByJuXvYYDiNTq94K436sm5QacmshtbHOsTm', 0, 9, '2023-01-05 02:03:06', '2023-01-05 03:03:26'),
(39, 'TCHINTCHANE', 'SONOU', 'M', 'nadjoundi2@mingoube.com', '90574854', '$2y$10$ZZEINMwylnMwJ4owsbtVVuI/gO2ayw2LDBKMcl8O/yH5IVqsdqyOO', 0, 10, '2023-01-05 02:05:32', '2023-01-05 02:05:32'),
(40, 'DOUNGUE', 'LENE', 'M', 'fanworgou@mingoube.com', '98098954', '$2y$10$R/rCtkMkd0p9DrUoPsjULOaGMHFDgNS0ocVeQyE8Dirkvoo1bpB3C', 0, 11, '2023-01-05 02:07:58', '2023-01-05 02:07:58'),
(41, 'DIOGBENE', 'YOMLENE', 'M', 'djapieni@mingoube.com', '99566973', '$2y$10$n5cUZAutdHcKi6DhY1rp3.sDh1lmy7rQ9U3JxmrATk/jviHfOsdvG', 0, 12, '2023-01-05 02:09:33', '2023-01-05 02:09:33'),
(42, 'MOMBIQUE', 'DANIEL', 'M', 'timbou@mingoube.com', '91243938', '$2y$10$MLAeHbUjlycVwmm7uN/XMuEKzoPX1RHsitqquFwsZeqrs6y8m81cG', 0, 15, '2023-01-05 02:14:30', '2023-01-05 02:14:30'),
(43, 'KONLANI', 'ABOU', 'M', 'lome@mingoube.com', '91534293', '$2y$10$29RePgh6N0w5IhIU/Qece..Djxwc0ySVH95cjnFY.qcsR9docgEe6', 0, 16, '2023-01-05 02:27:33', '2023-01-05 02:29:41'),
(44, 'JONAS', 'JONAS', 'M', 'boutique@mingoube.com', '93522529', '$2y$10$a7V.Py/Lf7y4wftREBRla.3tH6/bMU9MB2dCcWjSPGzclGTct/29K', 0, 14, '2023-01-05 02:32:02', '2023-01-05 02:32:02'),
(45, 'JONAS', 'JONAS', 'M', 'jonas@mingoube.com', '93522529', '$2y$10$N7AI0bs6QS2qaTLuqMqC6OjyA5jrRfcKWEmJZ5xlzheQc32K6SivG', 1, 14, '2023-01-05 02:33:42', '2023-01-05 02:34:01'),
(46, 'KONGON', 'ODILE', 'F', 'odile@mingoube.com', '92357718', '$2y$10$O8Jze0EhZ9Rla8RrhmK2dODSCRmZ19k46bWTcHe9znNmdLA/YOifu', 1, 3, '2023-01-05 02:38:28', '2023-01-05 03:15:59'),
(47, 'SONG', 'TADJA', 'M', 'song@mingoube.com', '96156587', '$2y$10$nHt6YSbgFx/gs5SLGUpp2ugB1I1QE9E4JVOLUdaiahIgRx7ePGqmm', 1, 4, '2023-01-05 02:39:55', '2023-01-05 02:40:10'),
(48, 'LARE', 'SOANTCHEIBE', 'M', 'sontcheibe@mingoube.com', '92618750', '$2y$10$JLVtUJ0IP5lQije4hkC58u/IYh3ImBbDOGrRxFJs2wZ2ZyolFJOpW', 1, 5, '2023-01-05 02:43:28', '2023-01-05 03:30:18'),
(49, 'DOUTI', 'KALMOCK', 'M', 'kalmock@mingoube.com', '93344538', '$2y$10$bpnx8yVRFnPUXtK3bpivWO00ZaQ9t3pfDYVBpT.3MfCxesRav29JG', 1, 6, '2023-01-05 02:47:39', '2023-01-05 02:47:51'),
(50, 'YENDOUBAN', 'YANNALE', 'M', 'yannale@mingoube.com', '90000760', '$2y$10$E39HGSu3RQ0qkIwXZaOGsOQc7yrvAZV8I6xHSDRVdk6tfb.yW31Nm', 1, 7, '2023-01-05 02:50:35', '2023-01-05 02:50:48'),
(51, 'KAMPADIBE', 'YENDOUKOA', 'M', 'yendoukoa@mingoube.com', '91293176', '$2y$10$4eAaZbKOMDMq1ZQeHBTKyehhqcAAb0ZdUZEgbacRQlyh3d9MhSjL.', 1, 8, '2023-01-05 02:59:44', '2023-01-05 02:59:58'),
(52, 'DAPOUGUIDI', 'AROUNA', 'M', 'arouna@mingoube.com', '90103998', '$2y$10$dYmjqi1./Jeo2Dly6FSInuiQvgOF6CnFsWhB704v6b7a/5Y9uh3Q6', 1, 9, '2023-01-05 03:00:59', '2023-01-05 03:03:47'),
(53, 'TCHINTCHANE', 'SONOU', 'M', 'sonou@mingoube.com', '90574854', '$2y$10$jk9ZWUxyKeuYkecwYotsEuqrVHzQWGq7sKVSAPcWRvu4V42MfK7sy', 1, 10, '2023-01-05 03:05:48', '2023-01-05 03:06:25'),
(54, 'DOUNGUE', 'LENE', 'M', 'lene@mingoube.com', '98098954', '$2y$10$Sq2TNYVG8Qed13KGjmBSz.72ebdDqlDpP19VUuW4B7XHfcIdoD4ba', 1, 11, '2023-01-05 03:07:44', '2023-01-05 03:08:04'),
(55, 'DIOGBENE', 'YOMLENE', 'M', 'yomlene@mingoube.com', '99566973', '$2y$10$eBX3SzHwBX6443V2mqcmf.vtWtXXxu3SfKBSHbVgc3ZvrwpHlCDKq', 1, 12, '2023-01-05 03:09:34', '2023-01-05 03:09:53'),
(56, 'MOMBIQUE', 'DANIEL', 'M', 'daniel@mingoube.com', '91243938', '$2y$10$DnpMaQRO/1hSOowZi0K.UuuuJ8aUpnfpB74hqmP9qjInWQN.VDMvm', 1, 15, '2023-01-05 03:11:33', '2023-01-05 03:11:51'),
(57, 'KONLANI', 'ABOU', 'M', 'abou@mingoube.com', '91534293', '$2y$10$FV8Zfk/QxJSDrdWkDR8Ate4wZBou/MX9mC7I.FZNopwoCOfZlFJkW', 1, 16, '2023-01-05 03:13:27', '2023-01-05 03:13:42'),
(58, 'BANIMPO', 'KOUNTONE', 'F', 'grace@mingoube.com', '91733344   /  99528380', '$2y$10$3uNUY0IRSppyFo/eQcrSveVN8fdE6jEI4FpolkF70O0NQk6NugIu2', 0, 1, '2023-01-05 03:22:56', '2023-01-05 03:22:56'),
(59, 'BLAGOU', 'MASSABI', 'F', 'massabi@mingoube.com', '92651503', '$2y$10$QLTZMQjlsFGgD019W7E.NObswCyjeL38a2WcVbaRkTCjKV7Ri22ha', 1, 1, '2023-01-05 03:24:14', '2023-01-05 03:31:02'),
(60, 'LENGUE', 'GBALIBOA', 'F', 'gbaliboa@mingoube.com', '91775466', '$2y$10$frma1jQmod5F.O1CpLs6Fe..a6SH.9URL2.rPwu15FA8XR8TY3HJC', 1, 1, '2023-01-05 03:28:41', '2023-01-05 03:30:39'),
(61, 'LALLE', 'KANFITINE', 'M', 'lalle@mingoube.com', '93364667', '$2y$10$f5QKP0svVYudaHF2riDV3eFDLKbwxMpFgh0nt.BEtP5KX4mmmcJWe', 1, 1, '2023-01-05 03:32:54', '2023-01-05 03:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `ventes`
--

CREATE TABLE `ventes` (
  `id` int(10) UNSIGNED NOT NULL,
  `numero` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_id` int(10) UNSIGNED DEFAULT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `journal_id` int(10) UNSIGNED DEFAULT NULL,
  `type_vente` int(11) DEFAULT 0,
  `date_vente` datetime NOT NULL DEFAULT '2022-08-26 17:36:15',
  `boutique_id` int(10) UNSIGNED DEFAULT NULL,
  `with_tva` tinyint(1) DEFAULT 0,
  `tva` int(11) DEFAULT 18,
  `montant_tva` double DEFAULT NULL,
  `montant_ht` double DEFAULT NULL,
  `montant_reduction` double DEFAULT 0,
  `totaux` double DEFAULT NULL,
  `facture` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ventes`
--

INSERT INTO `ventes` (`id`, `numero`, `client_id`, `user_id`, `journal_id`, `type_vente`, `date_vente`, `boutique_id`, `with_tva`, `tva`, `montant_tva`, `montant_ht`, `montant_reduction`, `totaux`, `facture`, `created_at`, `updated_at`) VALUES
(61, 'VENT2023-1', 16, 32, 17, 1, '2023-01-04 16:40:13', 3, 0, 18, NULL, NULL, 0, 319800, 'facture_2023-01-04_16-40-46.pdf', '2023-01-04 21:40:13', '2023-01-04 21:40:13'),
(62, 'VENT2023-62', 17, 33, 18, 1, '2023-01-06 08:59:15', 4, 0, 18, NULL, NULL, 0, 226600, 'facture_2023-01-06_08-59-54.pdf', '2023-01-06 13:59:15', '2023-01-06 13:59:15'),
(63, 'VENT2023-63', 21, 37, 18, 1, '2023-01-06 09:10:36', 8, 0, 18, NULL, NULL, 0, 406350, 'facture_2023-01-06_09-11-05.pdf', '2023-01-06 14:10:36', '2023-01-06 14:10:36'),
(64, 'VENT2023-64', 27, 42, 19, 1, '2023-01-07 08:36:48', 15, 0, 18, NULL, NULL, 0, 124350, 'facture_2023-01-07_08-37-14.pdf', '2023-01-07 13:36:48', '2023-01-07 13:36:48'),
(65, 'VENT2023-65', 16, 32, 19, 1, '2023-01-07 08:41:20', 3, 0, 18, NULL, NULL, 0, 323900, 'facture_2023-01-07_08-42-11.pdf', '2023-01-07 13:41:20', '2023-01-07 13:41:20'),
(66, 'VENT2023-66', 17, 33, 19, 1, '2023-01-07 08:49:11', 4, 0, 18, NULL, NULL, 0, 212200, 'facture_2023-01-07_08-49-24.pdf', '2023-01-07 13:49:11', '2023-01-07 13:49:11'),
(67, 'VENT2023-67', 20, 36, 19, 1, '2023-01-07 09:03:52', 7, 0, 18, NULL, NULL, 0, 194300, 'facture_2023-01-07_09-16-29.pdf', '2023-01-07 14:03:52', '2023-01-07 14:03:52'),
(68, 'VENT2023-68', 20, 36, 19, 1, '2023-01-07 09:20:33', 7, 0, 18, NULL, NULL, 0, 194300, 'facture_2023-01-07_09-20-56.pdf', '2023-01-07 14:20:33', '2023-01-07 14:20:33'),
(69, 'VENT2023-69', 18, 34, 19, 1, '2023-01-07 09:37:38', 5, 0, 18, NULL, NULL, 0, 169250, 'facture_2023-01-07_09-37-54.pdf', '2023-01-07 14:37:38', '2023-01-07 14:37:38'),
(70, 'VENT2023-70', 19, 35, 19, 1, '2023-01-07 10:11:27', 6, 0, 18, NULL, NULL, 5750, 900950, 'facture_2023-01-07_10-14-33.pdf', '2023-01-07 15:11:27', '2023-01-07 15:11:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amortissements`
--
ALTER TABLE `amortissements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boutiques`
--
ALTER TABLE `boutiques`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boutique_settings`
--
ALTER TABLE `boutique_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `caisses`
--
ALTER TABLE `caisses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `caisses_user_id_index` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `charges_journal_divers_id_index` (`journal_divers_id`),
  ADD KEY `charges_boutique_id_index` (`boutique_id`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `clients_boutique_id_index` (`boutique_id`);

--
-- Indexes for table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commandes_journal_achat_id_index` (`journal_achat_id`),
  ADD KEY `commandes_boutique_id_index` (`boutique_id`);

--
-- Indexes for table `commande_modeles`
--
ALTER TABLE `commande_modeles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commande_modeles_modele_fournisseur_id_index` (`modele_fournisseur_id`),
  ADD KEY `commande_modeles_commande_id_index` (`commande_id`);

--
-- Indexes for table `depenses`
--
ALTER TABLE `depenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `depenses_sold_id_index` (`sold_id`),
  ADD KEY `depenses_user_id_index` (`user_id`),
  ADD KEY `depenses_boutique_id_index` (`boutique_id`),
  ADD KEY `depenses_journal_id_index` (`journal_id`);

--
-- Indexes for table `depense_files`
--
ALTER TABLE `depense_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `depense_files_depense_id_index` (`depense_id`);

--
-- Indexes for table `devis_lignes_ventes`
--
ALTER TABLE `devis_lignes_ventes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `devis_lignes_ventes_modele_fournisseur_id_index` (`modele_fournisseur_id`),
  ADD KEY `devis_lignes_ventes_devis_id_index` (`devis_id`);

--
-- Indexes for table `devis_ventes`
--
ALTER TABLE `devis_ventes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `devis_ventes_boutique_id_index` (`boutique_id`),
  ADD KEY `devis_ventes_user_id_index` (`user_id`),
  ADD KEY `devis_ventes_client_id_index` (`client_id`);

--
-- Indexes for table `employes`
--
ALTER TABLE `employes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employes_boutique_id_index` (`boutique_id`);

--
-- Indexes for table `factures`
--
ALTER TABLE `factures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factures_vente_id_index` (`vente_id`);

--
-- Indexes for table `facture_fictives`
--
ALTER TABLE `facture_fictives`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `historiques`
--
ALTER TABLE `historiques`
  ADD PRIMARY KEY (`id`),
  ADD KEY `historiques_user_id_index` (`user_id`);

--
-- Indexes for table `immobilisations`
--
ALTER TABLE `immobilisations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `immobilisations_user_id_index` (`user_id`),
  ADD KEY `immobilisations_amortissement_id_index` (`amortissement_id`);

--
-- Indexes for table `inventaires`
--
ALTER TABLE `inventaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventaires_user_id_index` (`user_id`);

--
-- Indexes for table `inventaire_modeles`
--
ALTER TABLE `inventaire_modeles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inventaire_modeles_modele_id_index` (`modele_id`),
  ADD KEY `inventaire_modeles_inventaire_id_index` (`inventaire_id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journals_user_id_index` (`user_id`),
  ADD KEY `journals_boutique_id_index` (`boutique_id`);

--
-- Indexes for table `journal_achats`
--
ALTER TABLE `journal_achats`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journal_achats_user_id_index` (`user_id`),
  ADD KEY `journal_achats_boutique_id_index` (`boutique_id`);

--
-- Indexes for table `journal_depenses`
--
ALTER TABLE `journal_depenses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journal_depenses_user_id_index` (`user_id`),
  ADD KEY `journal_depenses_boutique_id_index` (`boutique_id`);

--
-- Indexes for table `journal_divers`
--
ALTER TABLE `journal_divers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `journal_divers_user_id_index` (`user_id`),
  ADD KEY `journal_divers_boutique_id_index` (`boutique_id`);

--
-- Indexes for table `livraisons`
--
ALTER TABLE `livraisons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livraisons_boutique_id_index` (`boutique_id`);

--
-- Indexes for table `livraison_commandes`
--
ALTER TABLE `livraison_commandes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livraison_commandes_commande_modele_id_index` (`commande_modele_id`),
  ADD KEY `livraison_commandes_livraison_id_index` (`livraison_id`);

--
-- Indexes for table `livraison_ventes`
--
ALTER TABLE `livraison_ventes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livraison_ventes_prevente_id_index` (`prevente_id`),
  ADD KEY `livraison_ventes_livraison_v_id_index` (`livraison_v_id`);

--
-- Indexes for table `livraison_v_s`
--
ALTER TABLE `livraison_v_s`
  ADD PRIMARY KEY (`id`),
  ADD KEY `livraison_v_s_boutique_id_index` (`boutique_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modeles`
--
ALTER TABLE `modeles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modeles_produit_id_index` (`produit_id`),
  ADD KEY `modeles_boutique_id_index` (`boutique_id`);

--
-- Indexes for table `modele_fournisseurs`
--
ALTER TABLE `modele_fournisseurs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modele_fournisseurs_fournisseur_id_index` (`fournisseur_id`),
  ADD KEY `modele_fournisseurs_modele_id_index` (`modele_id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `preventes`
--
ALTER TABLE `preventes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `preventes_modele_fournisseur_id_index` (`modele_fournisseur_id`),
  ADD KEY `preventes_vente_id_index` (`vente_id`);

--
-- Indexes for table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produits_categorie_id_index` (`categorie_id`);

--
-- Indexes for table `projets`
--
ALTER TABLE `projets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projets_boutique_id_index` (`boutique_id`);

--
-- Indexes for table `projet_models`
--
ALTER TABLE `projet_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `projet_models_modele_id_index` (`modele_id`),
  ADD KEY `projet_models_projet_id_index` (`projet_id`),
  ADD KEY `projet_models_user_id_index` (`user_id`);

--
-- Indexes for table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reglements`
--
ALTER TABLE `reglements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reglements_vente_id_index` (`vente_id`);

--
-- Indexes for table `reglement_achats`
--
ALTER TABLE `reglement_achats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `retours`
--
ALTER TABLE `retours`
  ADD PRIMARY KEY (`id`),
  ADD KEY `retours_vente_id_index` (`vente_id`),
  ADD KEY `retours_boutique_id_index` (`boutique_id`);

--
-- Indexes for table `retour_lignes`
--
ALTER TABLE `retour_lignes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `retour_lignes_prevente_id_index` (`prevente_id`),
  ADD KEY `retour_lignes_vente_id_index` (`vente_id`),
  ADD KEY `retour_lignes_retour_id_index` (`retour_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `services_boutique_id_index` (`boutique_id`);

--
-- Indexes for table `service_ventes`
--
ALTER TABLE `service_ventes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `service_ventes_service_id_index` (`service_id`),
  ADD KEY `service_ventes_vente_id_index` (`vente_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `solds`
--
ALTER TABLE `solds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sold_depots`
--
ALTER TABLE `sold_depots`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sold_depots_sold_id_index` (`sold_id`),
  ADD KEY `sold_depots_user_id_index` (`user_id`),
  ADD KEY `sold_depots_boutique_id_index` (`boutique_id`),
  ADD KEY `sold_depots_journal_id_index` (`journal_id`);

--
-- Indexes for table `transferts`
--
ALTER TABLE `transferts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transferts_magasin_transfert_id_index` (`magasin_transfert_id`),
  ADD KEY `transferts_magasin_reception_id_index` (`magasin_reception_id`);

--
-- Indexes for table `transfert_lignes`
--
ALTER TABLE `transfert_lignes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transferts_transfert_id_index` (`transfert_id`),
  ADD KEY `transferts_modele_transfert_id_index` (`modele_transfert_id`),
  ADD KEY `transferts_modele_reception_id_index` (`modele_reception_id`);

--
-- Indexes for table `type_paiements`
--
ALTER TABLE `type_paiements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_recettes`
--
ALTER TABLE `type_recettes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_boutique_id_index` (`boutique_id`);

--
-- Indexes for table `ventes`
--
ALTER TABLE `ventes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ventes_client_id_index` (`client_id`),
  ADD KEY `ventes_user_id_index` (`user_id`),
  ADD KEY `ventes_journal_id_index` (`journal_id`),
  ADD KEY `ventes_boutique_id_index` (`boutique_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amortissements`
--
ALTER TABLE `amortissements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `boutiques`
--
ALTER TABLE `boutiques`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `boutique_settings`
--
ALTER TABLE `boutique_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `caisses`
--
ALTER TABLE `caisses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `commande_modeles`
--
ALTER TABLE `commande_modeles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `depenses`
--
ALTER TABLE `depenses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `depense_files`
--
ALTER TABLE `depense_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `devis_lignes_ventes`
--
ALTER TABLE `devis_lignes_ventes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `devis_ventes`
--
ALTER TABLE `devis_ventes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `employes`
--
ALTER TABLE `employes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `factures`
--
ALTER TABLE `factures`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `facture_fictives`
--
ALTER TABLE `facture_fictives`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fournisseurs`
--
ALTER TABLE `fournisseurs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `historiques`
--
ALTER TABLE `historiques`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3485;

--
-- AUTO_INCREMENT for table `immobilisations`
--
ALTER TABLE `immobilisations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventaires`
--
ALTER TABLE `inventaires`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventaire_modeles`
--
ALTER TABLE `inventaire_modeles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `journal_achats`
--
ALTER TABLE `journal_achats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `journal_depenses`
--
ALTER TABLE `journal_depenses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `journal_divers`
--
ALTER TABLE `journal_divers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `livraisons`
--
ALTER TABLE `livraisons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `livraison_commandes`
--
ALTER TABLE `livraison_commandes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `livraison_ventes`
--
ALTER TABLE `livraison_ventes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `livraison_v_s`
--
ALTER TABLE `livraison_v_s`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modeles`
--
ALTER TABLE `modeles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `modele_fournisseurs`
--
ALTER TABLE `modele_fournisseurs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `preventes`
--
ALTER TABLE `preventes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT for table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `projets`
--
ALTER TABLE `projets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projet_models`
--
ALTER TABLE `projet_models`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reglements`
--
ALTER TABLE `reglements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `reglement_achats`
--
ALTER TABLE `reglement_achats`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retours`
--
ALTER TABLE `retours`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retour_lignes`
--
ALTER TABLE `retour_lignes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_ventes`
--
ALTER TABLE `service_ventes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `solds`
--
ALTER TABLE `solds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sold_depots`
--
ALTER TABLE `sold_depots`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transferts`
--
ALTER TABLE `transferts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transfert_lignes`
--
ALTER TABLE `transfert_lignes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `type_paiements`
--
ALTER TABLE `type_paiements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `type_recettes`
--
ALTER TABLE `type_recettes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `ventes`
--
ALTER TABLE `ventes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
