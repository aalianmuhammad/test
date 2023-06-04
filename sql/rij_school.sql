-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 02 jun 2023 om 15:41
-- Serverversie: 10.4.24-MariaDB
-- PHP-versie: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rij_school`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20230530084331', '2023-05-30 10:43:44', 90),
('DoctrineMigrations\\Version20230530092426', '2023-05-30 11:24:33', 19),
('DoctrineMigrations\\Version20230530121520', '2023-05-30 14:15:27', 163),
('DoctrineMigrations\\Version20230530121843', '2023-05-30 14:18:55', 21),
('DoctrineMigrations\\Version20230530122120', '2023-05-30 14:21:26', 89),
('DoctrineMigrations\\Version20230602080008', '2023-06-02 10:00:21', 185),
('DoctrineMigrations\\Version20230602080454', '2023-06-02 10:05:03', 138),
('DoctrineMigrations\\Version20230602080632', '2023-06-02 10:06:42', 180);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `examen_aanvraag`
--

CREATE TABLE `examen_aanvraag` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `tijd` time NOT NULL,
  `geslaagd` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `mededelingen`
--

CREATE TABLE `mededelingen` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `titel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `mededelingen`
--

INSERT INTO `mededelingen` (`id`, `datum`, `titel`, `rol`, `user_id`) VALUES
(1, '2023-06-01', 'ROC Mondriaan', 'instructeur', NULL),
(2, '2023-06-01', 'ROC Mondriaan - Jun 1', 'klant', NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `rijles`
--

CREATE TABLE `rijles` (
  `id` int(11) NOT NULL,
  `datum` date NOT NULL,
  `tijd` time NOT NULL,
  `ophaal_locatie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lesdoel` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annuleren` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `annuleer_reden` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opmerkingen_instructeur` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `opmerkingen_leerling` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instructeur_id` int(11) DEFAULT NULL,
  `klant_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `rijles`
--

INSERT INTO `rijles` (`id`, `datum`, `tijd`, `ophaal_locatie`, `lesdoel`, `annuleren`, `annuleer_reden`, `opmerkingen_instructeur`, `opmerkingen_leerling`, `instructeur_id`, `klant_id`) VALUES
(2, '2018-01-01', '02:00:00', 'Den Haag', 'Voorruit kijken', 'N.V.t.', 'Geen', 'Geen', 'Geen', 10, 2);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voornaam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tussenvoegsel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `achternaam` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adres` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `woonplaats` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Gegevens worden geëxporteerd voor tabel `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `voornaam`, `tussenvoegsel`, `achternaam`, `adres`, `woonplaats`, `postcode`) VALUES
(1, 'Muhammad.Aalian@outlook.com', '[\"ROLE_ADMIN\"]', '$2y$13$T.T0pNFz3qOLTmoWxmKzgOv7/fh9NAMV4GnxiiWmeizOcPnLmkMIa', '', NULL, '', NULL, '', NULL),
(2, 'Aalian@outlook.com', '[\"ROLE_KLANT\"]', '$2y$13$U1PNYA0AZXVP9OI/ppPH3uKNPkXSEnCpF14xfR9MCsTyUKl4fwVri', '', NULL, '', NULL, '', NULL),
(3, 'Koen@outlook.com', '[\"ROLE_KLANT\"]', '$2y$13$wLi7r2eTlfyFsDIAQe2NIuP4QpAO2G2P.vZAWwhXTRojCiClNlW0.', '', NULL, '', NULL, '', NULL),
(4, 'WimdeBie@outlook.com', '[\"ROLE_INSTRUCTEUR\"]', '$2y$13$T.T0pNFz3qOLTmoWxmKzgOv7/fh9NAMV4GnxiiWmeizOcPnLmkMIa', 'Wim', 'de', 'Bie', 'Tinwerf 16', 'Den Haag', '1234 AB'),
(5, 'Linden@outlook', '[\"ROLE_KLANT\"]', '$2y$13$pilbixanf42LCWQslmOpAu2M3dxg/wRy5dcU6YVrdLyf7u37WrBoW', 'Martin', 'van de', 'Linden', 'Tinwerf 16', 'Den Haag', '1234 AB'),
(6, 'Muhammad@gmail.com', '[\"ROLE_INSTRUCTEUR\"]', '$2y$13$U1PNYA0AZXVP9OI/ppPH3uKNPkXSEnCpF14xfR9MCsTyUKl4fwVri', 'Muhammad', NULL, 'Aalian', 'Tinwerf 16', 'Den Haag', '1234 AB'),
(10, 'Roc@gmail.com', '[\"ROLE_INSTRUCTEUR\"]', '$2y$13$U1PNYA0AZXVP9OI/ppPH3uKNPkXSEnCpF14xfR9MCsTyUKl4fwVri', 'Roc', NULL, 'Mondriaan', 'Tinwerf 16', 'Den Haag', '1234 AB'),
(12, 'Berke@gmail.com', '[\"ROLE_KLANT\"]', '$2y$13$IxEdR2f6Au2rV2plU4qLgOiCa72Ak.lXuad8X90ImwHI7fYiOR6DS', 'Berke', NULL, 'Ozturk', 'Tinwerf16', 'Den Haag', '1234 AB');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ziekmelding`
--

CREATE TABLE `ziekmelding` (
  `id` int(11) NOT NULL,
  `datum_ziek` date NOT NULL,
  `datum_beter` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexen voor tabel `examen_aanvraag`
--
ALTER TABLE `examen_aanvraag`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `mededelingen`
--
ALTER TABLE `mededelingen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_60896824A76ED395` (`user_id`);

--
-- Indexen voor tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexen voor tabel `rijles`
--
ALTER TABLE `rijles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_A7DA821225FCA809` (`instructeur_id`),
  ADD KEY `IDX_A7DA82123C427B2F` (`klant_id`);

--
-- Indexen voor tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`);

--
-- Indexen voor tabel `ziekmelding`
--
ALTER TABLE `ziekmelding`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `examen_aanvraag`
--
ALTER TABLE `examen_aanvraag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `mededelingen`
--
ALTER TABLE `mededelingen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `rijles`
--
ALTER TABLE `rijles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `ziekmelding`
--
ALTER TABLE `ziekmelding`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `mededelingen`
--
ALTER TABLE `mededelingen`
  ADD CONSTRAINT `FK_60896824A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Beperkingen voor tabel `rijles`
--
ALTER TABLE `rijles`
  ADD CONSTRAINT `FK_A7DA821225FCA809` FOREIGN KEY (`instructeur_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_A7DA82123C427B2F` FOREIGN KEY (`klant_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
